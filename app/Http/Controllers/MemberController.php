<?php

namespace App\Http\Controllers;

use App\Models\BankDetail;
use App\Models\LoanAquire;
use App\Models\LoanRefund;
use App\Models\ordinaryLoanApproval;
use App\Models\ProfilePictures;
use App\Models\ReleasedShare;
use App\Models\Saving;
use App\Models\Shares;
use App\Models\SharesAquire;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    //

        public function __construct()
    {
        $this->middleware('auth');
    }

        public function memberDashboard(){

        $user =  Auth::user();


        $hour = date('H');

        $dayTerm = ($hour > 17) ? "Evening" : (($hour > 12) ? "Afternoon" : "Morning");

        /*get user savings*/
        /*foreach ($user->user_saving as $us)
        {
            $total_savings = ($us->savings_amount);
        }*/

        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

       $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");


        /*check member active loan*/
        /*get user savings*/



        /* user_id is must important is hasMany Relationship */
        $loan_aquire_table = $user->loan_aquires;


        /*method 1*/
        /*foreach ($user->loan_aquires as $la)

        {
            $active_loan = ($la->loan_type);
        }*/


        /*method 2*/
       /* $active_loan = DB::table('loan_aquires')
        ->where("user_id", "=", $user_id)
        ->where("status", "=", "Active")
        ->pluck('loan_type')->first();*/


        /*method 3*/
        $active_loan = $user->loan_aquires()
            ->where('status', '!=', 'Pending')
            ->where('status', '!=', 'Cleared')->get();


        return view('member.dashboard', [
                                                'user' => $user,
                                                'dayterm' => $dayTerm,
                                                "total_savings" => $total_savings,
                                                "active_loan" => $active_loan,
                                            ]);
    }

        public function memberProfile(){

        $user =  Auth::user();
        $user_id =  Auth::user()->id;
        $profile_pic = DB::table('profile_pictures')->where('user_id', '=', $user_id)->get();

        $bank_details = $user->bank()->where('user_id', '=', $user_id)->get();

        return view('member.profile', [
            'user' => $user,
            'profile_pic' => $profile_pic,
            'bank_details' => $bank_details,
        ]);
    }

        public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('welcome');
    }

        public function updateProfilePic(Request $request){

        $user_id = Auth::user()->id;

        // Get filename with the extension
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('image')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // Upload Image
        $path = $request->file('image')->storeAs('public/images', $fileNameToStore);


        $picture = ProfilePictures::whereUserId($user_id)->first();

        if(!$picture){
            ProfilePictures::create([
                'user_id' => $user_id,
                'image' => $fileNameToStore
            ]);
        }else{
            ProfilePictures::whereId($picture->id)->update([
                'user_id' => $user_id,
                'image' => $fileNameToStore
            ]);
        }
        return back()->with("message', 'Profile Picture Updated Successfully");
    }

        public function updateBankDetails(Request $request){

        $user_id = auth()->user()->id;

        $bank_details = $request->validate([
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
        ]);

        $bank_details = BankDetail::whereUserId($user_id)->first();

        if(!$bank_details){
            BankDetail::create([
                'user_id' => $user_id,
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
            ]);
        }else{
            BankDetail::whereId($bank_details->id)->update([
                'user_id' => $user_id,
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
            ]);
        }

        return back()->with('message', 'Bank Details Updated Successfully');

    }


        /*soft loan apply*/
        public function softLoan(){


            $user = Auth::user();
            $user_id = Auth::user()->id;

            $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");

        return view('member.loans.soft-loan.apply', [
            'user' => $user,
            "total_savings" => $total_savings,
            ]);
    }
        public function softLoanSubmit(Request $request){
        $user = Auth::user();
            $user_fname = Auth::user()->firstname;
            $user_lname = Auth::user()->lastname;
            $fullname = $user_fname ."_". $user_lname;
        $date_joined = $user = Auth::user()->created_at;
        $current_time = now();
       /* dd($current_time - $date_joined);*/

        /*Check how many days member has joined*/
        $diff = Carbon::parse( $date_joined )->diffInDays( $current_time );


        if ($diff < 90){

            return back()->with('error', 'Sorry, You do not qualify for this loan, You need to be a member for a minimum of 3 Months');
        }
        if ($request->amount == ""){

            return back()->with('error', 'You didnt fill in the Amount field, Kindly fill the Application form properly');
        }
        if ($request->guarantor_one_name == ""){

            return back()->with('error', "You didnt fill in the 1st Guarantor's name field, Kindly fill the Application form properly");
        }
        if ($request->guarantor_one_phone == ""){

            return back()->with('error', "You didnt fill in the 1st Guarantor's phone number field, Kindly fill the Application form properly");
        }
        if ($request->guarantor_one_address == ""){

            return back()->with('error', "You didnt fill in the 1st Guarantor's address field, Kindly fill the Application form properly");
        }
        if ($request->guarantor_two_name == ""){

            return back()->with('error', "You didnt fill in the 2st Guarantor's name field, Kindly fill the Application form properly");
        }
        if ($request->guarantor_two_phone == ""){

            return back()->with('error', "You didnt fill in the 2nd Guarantor's phone number field, Kindly fill the Application form properly");
        }
        if ($request->guarantor_two_address == ""){

            return back()->with('error', "You didnt fill in the 2nd Guarantor's address field, Kindly fill the Application form properly");
        }
        if ($request->amount > 20000){

            return back()->with('error', 'Sorry, You cannot apply above ₦20,000');
        }

        $validated = $request->validate([
            'amount' => 'required',
            'guarantor_one_name' => 'required',
            'guarantor_one_phone' => 'required',
            'guarantor_one_address' => 'required',
            'guarantor_two_name' => 'required',
            'guarantor_two_phone' => 'required',
            'guarantor_two_address' => 'required',
        ]);

            $loan_types_id = 1;
            $loan_type = "Soft Loan";
            $interest = 0;
            $user_id =  Auth::user()->id;
            $duration = "3 Month";
            $status = "Pending";


            /*pay_slip upload*/
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs("public/pay_slips/$fullname", $fileNameToStore);

            /*store loan request in loanaquires table*/
            LoanAquire::create([
            'user_id' => $user_id,
            'amount' => $request->amount,
            'interest' => $interest,
            'duration' => $duration,
            'status' => $status,
            'loan_types_id' => $loan_types_id,
            'loan_type' => $loan_type,
            'guarantor_one_name' => $request->guarantor_one_name,
            'guarantor_one_phone' => $request->guarantor_one_phone,
            'guarantor_one_address' => $request->guarantor_one_address,
            'guarantor_two_name' => $request->guarantor_two_name,
            'guarantor_two_phone' => $request->guarantor_two_phone,
            'guarantor_two_address' => $request->guarantor_two_address,
            'pay_slip' => $fileNameToStore,
            ]);


            /*get loan id*/
                /*store loan request in ordinary loan_approval table*/
           /* ordinaryLoanApproval::create([
            'user_id' => $user_id,
            'loan_id' => $request->loan_id,
            'loan_type' => $loan_type,
            'interest' => $interest,
            'amount' => $request->amount,
            'duration' => $duration,
            'status' => $status,
        ]);*/

        return back()->with('message', 'Soft Loan Application Successful! - Kindly exercise patience while the management processes your loan.');

    }
        public function softLoanRequests(){


                $user =  Auth::user();
                $user_id = Auth::user()->id;
                $loan_requests = DB::table('loan_aquires')
                    ->where('user_id', '=', $user_id)
                    ->where('loan_type', '=', 'Soft Loan')->get();


            return view('member.loans.soft-loan.requests', [
                'user' => $user,
                'user_id' => $user_id,
                'loan_requests' => $loan_requests,
            ]);
        }

        public function softLoanRefunds(){

            $user =  Auth::user();
            $user_id = Auth::user()->id;
            $num = 1;
            $loan_refunds =LoanRefund::where('user_id', '=', $user_id)
                ->where('loan_type', '=', 'Soft Loan')->get();

            return view('member.loans.soft-loan.refunds', ([
                "user" => $user,
                "num" => $num,
                "loan_refunds" => $loan_refunds
            ]));
        }



        /*emergency loan*/
        public function emergencyLoan(){

                $user = Auth::user();
                $user_id = Auth::user()->id;

                $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");

                $maximum_amount = 50000;

                return view('member.loans.emergency-loan.apply', [
                    'user' => $user,
                    "total_savings" => $total_savings,
                    "maximum_amount" => $maximum_amount,
                ]);
            }
        public function emergencyLoanSubmit(Request $request){


                $user_id = Auth::user()->id;
                $user_fname = Auth::user()->firstname;
                $user_lname = Auth::user()->lastname;
                $fullname = $user_fname ."_". $user_lname;

                $date_joined = $user = Auth::user()->created_at;
                $current_time = now();
                /* dd($current_time - $date_joined);*/

                /*Check how many days member has joined*/
                $diff = Carbon::parse( $date_joined )->diffInDays( $current_time );

                $user = Auth::user();
                $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");

                $maximum_amount = 50000;

                if ($diff < 90){

                    return back()->with('error', 'Sorry, You do not qualify for this loan, You need to be a member for a minimum of 3 Months');
                }
                if ($request->amount == ""){

                    return back()->with('error', 'You didnt fill in the Amount field, Kindly fill the Application form properly');
                }
                if ($request->guarantor_one_name == ""){

                    return back()->with('error', "You didnt fill in the 1st Guarantor's name field, Kindly fill the Application form properly");
                }
                if ($request->guarantor_one_phone == ""){

                    return back()->with('error', "You didnt fill in the 1st Guarantor's phone number field, Kindly fill the Application form properly");
                }
                if ($request->guarantor_one_address == ""){

                    return back()->with('error', "You didnt fill in the 1st Guarantor's address field, Kindly fill the Application form properly");
                }
                if ($request->guarantor_two_name == ""){

                    return back()->with('error', "You didnt fill in the 2st Guarantor's name field, Kindly fill the Application form properly");
                }
                if ($request->guarantor_two_phone == ""){

                    return back()->with('error', "You didnt fill in the 2nd Guarantor's phone number field, Kindly fill the Application form properly");
                }
                if ($request->guarantor_two_address == ""){

                    return back()->with('error', "You didnt fill in the 2nd Guarantor's address field, Kindly fill the Application form properly");
                }
                if ($request->amount > $maximum_amount){
                    return back()->with('error', "Sorry, You cannot apply above ₦$maximum_amount");
                }

                $validated = $request->validate([
                    'amount' => 'required',
                    'guarantor_one_name' => 'required',
                    'guarantor_one_phone' => 'required',
                    'guarantor_one_address' => 'required',
                    'guarantor_two_name' => 'required',
                    'guarantor_two_phone' => 'required',
                    'guarantor_two_address' => 'required',
                ]);

                $loan_types_id = 1;
                $loan_type = "Emergency Loan";
                $interest = 5;
                $user_id =  Auth::user()->id;
                $duration = "5 Months";
                $status = "Pending";


                /*pay_slip upload*/
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs("public/pay_slips/$fullname", $fileNameToStore);


                LoanAquire::create([
                    'user_id' => $user_id,
                    'amount' => $request->amount,
                    'interest' => $interest,
                    'duration' => $duration,
                    'status' => $status,
                    'loan_types_id' => $loan_types_id,
                    'loan_type' => $loan_type,
                    'guarantor_one_name' => $request->guarantor_one_name,
                    'guarantor_one_phone' => $request->guarantor_one_phone,
                    'guarantor_one_address' => $request->guarantor_one_address,
                    'guarantor_two_name' => $request->guarantor_two_name,
                    'guarantor_two_phone' => $request->guarantor_two_phone,
                    'guarantor_two_address' => $request->guarantor_two_address,
                    'pay_slip' => $fileNameToStore,
                ]);
                return back()->with('message', 'Emergency Loan Application Successful! - Kindly exercise patience while the management processes your loan.');

            }
        public function emergencyLoanRequests(){

                $user =  Auth::user();
                $user_id = Auth::user()->id;
            $user_fname = Auth::user()->firstname;
            $user_lname = Auth::user()->lastname;
            $fullname = $user_fname ."_". $user_lname;
                $loan_requests = DB::table('loan_aquires')
                    ->where('user_id', '=', $user_id)
                    ->where('loan_type', '=', 'Emergency Loan')->get();

                return view('member.loans.emergency-loan.requests', [
                    'user' => $user,
                    'user_id' => $user_id,
                    'loan_requests' => $loan_requests,
                    'fullname' => $fullname,
                ]);
            }
        public function emergencyLoanRefunds(){
            $user =  Auth::user();
            $user_id = Auth::user()->id;
            $num = 1;
            $loan_refunds =LoanRefund::where('user_id', '=', $user_id)
                ->where('loan_type', '=', 'Emergency Loan')->get();

            return view('member.loans.emergency-loan.refunds', ([
                "user" => $user,
                "num" => $num,
                "loan_refunds" => $loan_refunds
            ]));
        }



        /*ordinary loan apply*/
        public function ordinaryLoan(){

        $user = Auth::user();
        $user_id = Auth::user()->id;

        $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");

            $maximum_amount = $total_savings/100*70;

        return view('member.loans.ordinary-loan.apply', [
            'user' => $user,
            "total_savings" => $total_savings,
            "maximum_amount" => $maximum_amount,
            ]);
    }
        public function ordinaryLoanSubmit(Request $request){

            $user_fname = Auth::user()->firstname;
            $user_lname = Auth::user()->lastname;
            $fullname = $user_fname ."_". $user_lname;

        $user_id = Auth::user()->id;
        $date_joined = $user = Auth::user()->created_at;
        $current_time = now();
        /* dd($current_time - $date_joined);*/

        /*Check how many days member has joined*/
        $diff = Carbon::parse( $date_joined )->diffInDays( $current_time );


        $user = Auth::user();
        $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");

        $maximum_amount = $total_savings/100*70;



        if ($diff < 90){

            return back()->with('error', 'Sorry, You do not qualify for this loan, You need to be a member for a minimum of 3 Months');
        }
        if ($request->amount == ""){

            return back()->with('error', 'You didnt fill in the Amount field, Kindly fill the Application form properly');
        }
        if ($request->guarantor_one_name == ""){

            return back()->with('error', "You didnt fill in the 1st Guarantor's name field, Kindly fill the Application form properly");
        }
        if ($request->guarantor_one_phone == ""){

            return back()->with('error', "You didnt fill in the 1st Guarantor's phone number field, Kindly fill the Application form properly");
        }
        if ($request->guarantor_one_address == ""){

            return back()->with('error', "You didnt fill in the 1st Guarantor's address field, Kindly fill the Application form properly");
        }
        if ($request->guarantor_two_name == ""){

            return back()->with('error', "You didnt fill in the 2st Guarantor's name field, Kindly fill the Application form properly");
        }
        if ($request->guarantor_two_phone == ""){

            return back()->with('error', "You didnt fill in the 2nd Guarantor's phone number field, Kindly fill the Application form properly");
        }
        if ($request->guarantor_two_address == ""){

            return back()->with('error', "You didnt fill in the 2nd Guarantor's address field, Kindly fill the Application form properly");
        }
        if ($request->amount > $maximum_amount){

            return back()->with('error', "Sorry, You cannot apply above ₦$maximum_amount");
        }

        $validated = $request->validate([
            'amount' => 'required',
            'guarantor_one_name' => 'required',
            'guarantor_one_phone' => 'required',
            'guarantor_one_address' => 'required',
            'guarantor_two_name' => 'required',
            'guarantor_two_phone' => 'required',
            'guarantor_two_address' => 'required',
        ]);

        $loan_types_id = 1;
        $loan_type = "Ordinary Loan";
        $interest = 7;
        $user_id =  Auth::user()->id;
        $duration = "12 Month";
        $status = "Pending";


            /*pay_slip upload*/
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs("public/pay_slips/$fullname", $fileNameToStore);


        /*get values into loan aquires table*/
        LoanAquire::create([
            'user_id' => $user_id,
            'amount' => $request->amount,
            'interest' => $interest,
            'duration' => $duration,
            'status' => $status,
            'loan_types_id' => $loan_types_id,
            'loan_type' => $loan_type,
            'guarantor_one_name' => $request->guarantor_one_name,
            'guarantor_one_phone' => $request->guarantor_one_phone,
            'guarantor_one_address' => $request->guarantor_one_address,
            'guarantor_two_name' => $request->guarantor_two_name,
            'guarantor_two_phone' => $request->guarantor_two_phone,
            'guarantor_two_address' => $request->guarantor_two_address,
            'first_approval'  => $request->first_approval,
            'second_approval'  => $request->second_approval,
            'third_approval'  => $request->third_approval,
            'fourth_approval'  => $request->fourth_approval,
            'fifth_approval'  => $request->fifth_approval,
            'sixth_approval'  => $request->sixth_approval,
            'pay_slip' => $fileNameToStore,

        ]);

            /*get values into ordinary loan approval table*/
        /*ordinaryLoanApproval::create([
            'user_id' => $user_id,
            'amount' => $request->amount,
            'interest' => $interest,
            'duration' => $duration,
            'status' => $status,
            'loan_types_id' => $loan_types_id,
            'loan_type' => $loan_type,
            'guarantor_one_name' => $request->guarantor_one_name,
            'guarantor_one_phone' => $request->guarantor_one_phone,
            'guarantor_one_address' => $request->guarantor_one_address,
            'guarantor_two_name' => $request->guarantor_two_name,
            'guarantor_two_phone' => $request->guarantor_two_phone,
            'guarantor_two_address' => $request->guarantor_two_address,
            'first_approval' => $request->first_approval,
            'second_approval' => $request->second_approval,
            'third_approval' => $request->third_approval,
            'fourth_approval' => $request->fourth_approval,
            'fifth_approval' => $request->fifth_approval,
        ]);
*/

        return back()->with('message', 'Ordinary Loan Application Successful! - Kindly exercise patience while the management processes your loan.');

    }
        public function ordinaryLoanRequests(){

        $user =  Auth::user();
        $user_id = Auth::user()->id;
        $loan_requests = DB::table('loan_aquires')
            ->where('user_id', '=', $user_id)
            ->where('loan_type', '=', 'Ordinary Loan')->get();

        return view('member.loans.ordinary-loan.requests', [
            'user' => $user,
            'user_id' => $user_id,
            'loan_requests' => $loan_requests,
        ]);
    }
        public function ordinaryLoanRefunds(){

            $user =  Auth::user();
            $user_id = Auth::user()->id;
            $num = 1;
            $loan_refunds =LoanRefund::where('user_id', '=', $user_id)
                ->where('loan_type', '=', 'Ordinary Loan')->get();

            return view('member.loans.ordinary-loan.refunds', ([
                "user" => $user,
                "num" => $num,
                "loan_refunds" => $loan_refunds
            ]));
        }



        /*special loan apply*/
        public function specialLoan(){

            $user = Auth::user();
            $user_id = Auth::user()->id;

            $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");
            $maximum_amount = $total_savings/100*200;


            return view('member.loans.special-loan.apply', [
                'user' => $user,
                "total_savings" => $total_savings,
                "maximum_amount" => $maximum_amount,
                ]);
        }

        public function specialLoanSubmit(Request $request){

                $user = Auth::user();
                $user_id = Auth::user()->id;
                $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");

            $user_id = Auth::user()->id;
            $date_joined = $user = Auth::user()->created_at;
            $current_time = now();
            /* dd($current_time - $date_joined);*/

            /*Check how many days member has joined*/
            $diff = Carbon::parse( $date_joined )->diffInDays( $current_time );


                /*declare total savings and check for the percentage*/
                $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");
                $maximum_amount = $total_savings/100*200;

            if ($diff < 90){

                return back()->with('error', 'Sorry, You do not qualify for this loan, You need to be a member for a minimum of 3 Months');
            }
            if ($request->amount == ""){

                return back()->with('error', 'You didnt fill in the Amount field, Kindly fill the Application form properly');
            }
            if ($request->guarantor_one_name == ""){

                return back()->with('error', "You didnt fill in the 1st Guarantor's name field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_one_phone == ""){

                return back()->with('error', "You didnt fill in the 1st Guarantor's phone number field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_one_address == ""){

                return back()->with('error', "You didnt fill in the 1st Guarantor's address field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_two_name == ""){

                return back()->with('error', "You didnt fill in the 2st Guarantor's name field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_two_phone == ""){

                return back()->with('error', "You didnt fill in the 2nd Guarantor's phone number field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_two_address == ""){

                return back()->with('error', "You didnt fill in the 2nd Guarantor's address field, Kindly fill the Application form properly");
            }

            if ($request->amount > $maximum_amount){
                return back()->with('error', "Sorry, You cannot apply above ₦$maximum_amount");
            }


            if ($request->amount > 0 && $request->amount < 999999){
                $duration = "24 Month";
            }elseif ($request->amount > 999999 && $request->amount < 1999999){
                $duration = "36 Month";
            }elseif ($request->amount > 2000000){
                $duration = "48 Month";
            }


            $validated = $request->validate([
                'amount' => 'required',
                'guarantor_one_name' => 'required',
                'guarantor_one_phone' => 'required',
                'guarantor_one_address' => 'required',
                'guarantor_two_name' => 'required',
                'guarantor_two_phone' => 'required',
                'guarantor_two_address' => 'required',
            ]);

            $loan_types_id = 1;
            $loan_type = "Special Loan";
            $interest = 10;
            $user_id =  Auth::user()->id;
            $status = "Pending";

            LoanAquire::create([
                'user_id' => $user_id,
                'amount' => $request->amount,
                'interest' => $interest,
                'duration' => $duration,
                'status' => $status,
                'loan_types_id' => $loan_types_id,
                'loan_type' => $loan_type,
                'guarantor_one_name' => $request->guarantor_one_name,
                'guarantor_one_phone' => $request->guarantor_one_phone,
                'guarantor_one_address' => $request->guarantor_one_address,
                'guarantor_two_name' => $request->guarantor_two_name,
                'guarantor_two_phone' => $request->guarantor_two_phone,
                'guarantor_two_address' => $request->guarantor_two_address,
            ]);
            return back()->with('message', 'Special Loan Application Successful! - Kindly exercise patience while the management processes your loan.');

        }

        public function specialLoanRequests(){

            $user =  Auth::user();
            $user_id = Auth::user()->id;


            $loan_requests = DB::table('loan_aquires')
                ->where('user_id', '=', $user_id)
                ->where('loan_type', '=', 'Special Loan')->get();

            return view('member.loans.special-loan.requests', [
                'user' => $user,
                'user_id' => $user_id,
                'loan_requests' => $loan_requests,
            ]);
        }

        public function specialLoanRefunds(){

            $user =  Auth::user();
            $user_id = Auth::user()->id;
            $num = 1;
            $loan_refunds =LoanRefund::where('user_id', '=', $user_id)
                ->where('loan_type', '=', 'Special Loan')->get();

            return view('member.loans.special-loan.refunds', ([
                "user" => $user,
                "num" => $num,
                "loan_refunds" => $loan_refunds
            ]));
        }


    /*Special Topup loan*/
        public function specialTopUpLoan(){

            $user = Auth::user();
            $user_id = Auth::user()->id;

            $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");
            $maximum_amount = $total_savings/100*200;

            return view('member.loans.special-loan.apply-top-up',[
            'user' => $user,
                "total_savings" => $total_savings,
                "maximum_amount" => $maximum_amount,
                ]);
        }

        public function specialTopUpLoanSubmit(Request $request){

            $user = Auth::user();
            $user_id = Auth::user()->id;
            $user_fname = Auth::user()->firstname;
            $user_lname = Auth::user()->lastname;
            $fullname = $user_fname ."_". $user_lname;
            $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");

            $user_id = Auth::user()->id;
            $date_joined = $user = Auth::user()->created_at;
            $current_time = now();
            /* dd($current_time - $date_joined);*/

            /*Check how many days member has joined*/
            $diff = Carbon::parse( $date_joined )->diffInDays( $current_time );


            /*declare total savings and check for the percentage*/
            $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");
            $maximum_amount = $total_savings/100*200;

            if ($diff < 90){

                return back()->with('error', 'Sorry, You do not qualify for this loan, You need to be a member for a minimum of 3 Months');
            }
            if ($request->amount == ""){

                return back()->with('error', 'You didnt fill in the Amount field, Kindly fill the Application form properly');
            }
            if ($request->guarantor_one_name == ""){

                return back()->with('error', "You didnt fill in the 1st Guarantor's name field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_one_phone == ""){

                return back()->with('error', "You didnt fill in the 1st Guarantor's phone number field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_one_address == ""){

                return back()->with('error', "You didnt fill in the 1st Guarantor's address field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_two_name == ""){

                return back()->with('error', "You didnt fill in the 2st Guarantor's name field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_two_phone == ""){

                return back()->with('error', "You didnt fill in the 2nd Guarantor's phone number field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_two_address == ""){

                return back()->with('error', "You didnt fill in the 2nd Guarantor's address field, Kindly fill the Application form properly");
            }

            if ($request->amount > $maximum_amount){
                return back()->with('error', "Sorry, You cannot apply above ₦$maximum_amount");
            }


            if ($request->amount > 0 && $request->amount < 999999){
                $duration = "24 Month";
            }elseif ($request->amount > 999999 && $request->amount < 1999999){
                $duration = "36 Month";
            }elseif ($request->amount > 2000000){
                $duration = "48 Month";
            }


            /*pay_slip upload*/
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs("public/pay_slips/$fullname", $fileNameToStore);

            $validated = $request->validate([
                'amount' => 'required',
                'guarantor_one_name' => 'required',
                'guarantor_one_phone' => 'required',
                'guarantor_one_address' => 'required',
                'guarantor_two_name' => 'required',
                'guarantor_two_phone' => 'required',
                'guarantor_two_address' => 'required',
            ]);

            $loan_types_id = 1;
            $loan_type = "Special Top-Up Loan";
            $interest = 7;
            $user_id =  Auth::user()->id;
            $status = "Pending";

            LoanAquire::create([
                'user_id' => $user_id,
                'amount' => $request->amount,
                'interest' => $interest,
                'duration' => $duration,
                'status' => $status,
                'loan_types_id' => $loan_types_id,
                'loan_type' => $loan_type,
                'guarantor_one_name' => $request->guarantor_one_name,
                'guarantor_one_phone' => $request->guarantor_one_phone,
                'guarantor_one_address' => $request->guarantor_one_address,
                'guarantor_two_name' => $request->guarantor_two_name,
                'guarantor_two_phone' => $request->guarantor_two_phone,
                'guarantor_two_address' => $request->guarantor_two_address,
                'pay_slip' => $fileNameToStore
            ]);
            return back()->with('message', 'Special Top-Up Loan Application Successful! - Kindly exercise patience while the management processes your loan.');

        }





        /*food loan apply*/
        public function foodLoan(){

            $user = Auth::user();
            $user_id = Auth::user()->id;

            $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");
            $maximum_amount = 50000;

            return view('member.loans.food-loan.apply', [
                'user' => $user,
                "total_savings" => $total_savings,
                "maximum_amount" => $maximum_amount,
            ]);
        }
        public function foodLoanSubmit(Request $request){

            $user = Auth::user();
            $user_id = Auth::user()->id;
            $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");

            $user_id = Auth::user()->id;
            $date_joined = $user = Auth::user()->created_at;
            $current_time = now();
            /* dd($current_time - $date_joined);*/

            /*Check how many days member has joined*/
            $diff = Carbon::parse( $date_joined )->diffInDays( $current_time );

            $duration = "5 Months";

            /*declare total savings and check for the percentage*/
            $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");
            $maximum_amount = 50000;

            if ($diff < 90){

                return back()->with('error', 'Sorry, You do not qualify for this loan, You need to be a member for a minimum of 3 Months');
            }
            if ($request->amount == ""){

                return back()->with('error', 'You didnt fill in the Amount field, Kindly fill the Application form properly');
            }
            if ($request->guarantor_one_name == ""){

                return back()->with('error', "You didnt fill in the 1st Guarantor's name field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_one_phone == ""){

                return back()->with('error', "You didnt fill in the 1st Guarantor's phone number field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_one_address == ""){

                return back()->with('error', "You didnt fill in the 1st Guarantor's address field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_two_name == ""){

                return back()->with('error', "You didnt fill in the 2st Guarantor's name field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_two_phone == ""){

                return back()->with('error', "You didnt fill in the 2nd Guarantor's phone number field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_two_address == ""){

                return back()->with('error', "You didnt fill in the 2nd Guarantor's address field, Kindly fill the Application form properly");
            }
            if ($request->amount > $maximum_amount){

                return back()->with('error', "Sorry, You cannot apply above $maximum_amount");
            }


            $validated = $request->validate([
                'amount' => 'required',
                'guarantor_one_name' => 'required',
                'guarantor_one_phone' => 'required',
                'guarantor_one_address' => 'required',
                'guarantor_two_name' => 'required',
                'guarantor_two_phone' => 'required',
                'guarantor_two_address' => 'required',
            ]);

            $loan_types_id = 1;
            $loan_type = "Food Loan";
            $interest = 3;
            $user_id =  Auth::user()->id;
            $status = "Pending";

            LoanAquire::create([
                'user_id' => $user_id,
                'amount' => $request->amount,
                'interest' => $interest,
                'duration' => $duration,
                'status' => $status,
                'loan_types_id' => $loan_types_id,
                'loan_type' => $loan_type,
                'guarantor_one_name' => $request->guarantor_one_name,
                'guarantor_one_phone' => $request->guarantor_one_phone,
                'guarantor_one_address' => $request->guarantor_one_address,
                'guarantor_two_name' => $request->guarantor_two_name,
                'guarantor_two_phone' => $request->guarantor_two_phone,
                'guarantor_two_address' => $request->guarantor_two_address,
            ]);
            return back()->with('message', 'Food Loan Application Successful! - Kindly exercise patience while the management processes your loan.');

        }
        public function foodLoanRequests(){

            $user =  Auth::user();
            $user_id = Auth::user()->id;
            $loan_requests = DB::table('loan_aquires')
                ->where('user_id', '=', $user_id)
                ->where('loan_type', '=', 'Food Loan')->get();

            return view('member.loans.food-loan.requests', [
                'user' => $user,
                'user_id' => $user_id,
                'loan_requests' => $loan_requests,
            ]);
        }

        public function foodLoanRefunds(){
            $user =  Auth::user();
            $user_id = Auth::user()->id;
            $num = 1;
            $loan_refunds =LoanRefund::where('user_id', '=', $user_id)
                ->where('loan_type', '=', 'Food Loan')->get();

            return view('member.loans.food-loan.refunds', ([
                "user" => $user,
                "num" => $num,
                "loan_refunds" => $loan_refunds
            ]));
        }




        /*appliance loan apply*/
        public function applianceLoan(){

            $user = Auth::user();
            $user_id = Auth::user()->id;

            $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");
            $maximum_amount = $total_savings/100*200;

            return view('member.loans.appliance-loan.apply', [
                'user' => $user,
                "total_savings" => $total_savings,
                "maximum_amount" => $maximum_amount,
            ]);
        }
        public function applianceLoanSubmit(Request $request){

            $user = Auth::user();
            $user_id = Auth::user()->id;
            $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");

            $user_id = Auth::user()->id;
            $date_joined = $user = Auth::user()->created_at;
            $current_time = now();
            /* dd($current_time - $date_joined);*/

            /*Check how many days member has joined*/
            $diff = Carbon::parse( $date_joined )->diffInDays( $current_time );


            if ($request->amount > 0 && $request->amount < 999999){
                $duration = "24 Month";
            }elseif ($request->amount > 999999 && $request->amount < 1999999){
                $duration = "36 Month";
            }elseif ($request->amount > 2000000){
                $duration = "48 Month";
            }


            /*declare total savings and check for the percentage*/
            $total_savings =  DB::table('savings')->where('user_id', '=', $user_id)->get()->sum("savings_amount");
            $maximum_amount = 50000;

            if ($diff < 90){

                return back()->with('error', 'Sorry, You do not qualify for this loan, You need to be a member for a minimum of 3 Months');
            }
            if ($request->amount == ""){

                return back()->with('error', 'You didnt fill in the Amount field, Kindly fill the Application form properly');
            }
            if ($request->guarantor_one_name == ""){

                return back()->with('error', "You didnt fill in the 1st Guarantor's name field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_one_phone == ""){

                return back()->with('error', "You didnt fill in the 1st Guarantor's phone number field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_one_address == ""){

                return back()->with('error', "You didnt fill in the 1st Guarantor's address field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_two_name == ""){

                return back()->with('error', "You didnt fill in the 2st Guarantor's name field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_two_phone == ""){

                return back()->with('error', "You didnt fill in the 2nd Guarantor's phone number field, Kindly fill the Application form properly");
            }
            if ($request->guarantor_two_address == ""){

                return back()->with('error', "You didnt fill in the 2nd Guarantor's address field, Kindly fill the Application form properly");
            }
            if ($request->amount > $maximum_amount){

                return back()->with('error', "Sorry, You cannot apply above $maximum_amount");
            }


            $validated = $request->validate([
                'amount' => 'required',
                'guarantor_one_name' => 'required',
                'guarantor_one_phone' => 'required',
                'guarantor_one_address' => 'required',
                'guarantor_two_name' => 'required',
                'guarantor_two_phone' => 'required',
                'guarantor_two_address' => 'required',
            ]);

            $loan_types_id = 1;
            $loan_type = "Appliance Loan";
            $interest = 5;
            $user_id =  Auth::user()->id;
            $status = "Pending";

            LoanAquire::create([
                'user_id' => $user_id,
                'amount' => $request->amount,
                'interest' => $interest,
                'duration' => $duration,
                'status' => $status,
                'loan_types_id' => $loan_types_id,
                'loan_type' => $loan_type,
                'guarantor_one_name' => $request->guarantor_one_name,
                'guarantor_one_phone' => $request->guarantor_one_phone,
                'guarantor_one_address' => $request->guarantor_one_address,
                'guarantor_two_name' => $request->guarantor_two_name,
                'guarantor_two_phone' => $request->guarantor_two_phone,
                'guarantor_two_address' => $request->guarantor_two_address,
            ]);
            return back()->with('message', 'Appliance Loan Application Successful! - Kindly exercise patience while the management processes your loan.');

        }
        public function applianceLoanRequests(){

            $user =  Auth::user();
            $user_id = Auth::user()->id;
            $loan_requests = DB::table('loan_aquires')
                ->where('user_id', '=', $user_id)
                ->where('loan_type', '=', 'Appliance Loan')->get();

            return view('member.loans.appliance-loan.requests', [
                'user' => $user,
                'user_id' => $user_id,
                'loan_requests' => $loan_requests,
            ]);
        }
        public function applianceLoanRefunds(){
            $user =  Auth::user();
            $user_id = Auth::user()->id;
            $num = 1;
            $loan_refunds =LoanRefund::where('user_id', '=', $user_id)
                ->where('loan_type', '=', 'Appliance Loan')->get();

            return view('member.loans.appliance-loan.refunds', ([
                "user" => $user,
                "num" => $num,
                "loan_refunds" => $loan_refunds
            ]));
        }


        /*shares*/
        public function memberShares(){

            $user = Auth::user();
            $user_id = Auth::user()->id;

            /*get shares released*/
            $shares_check =  ReleasedShare::select('amount')->latest('id')->first();
            if ($shares_check == null){
                $shares_released =0.00;
            }else{
                $shares_released = $shares_check->amount;
            }

            /*get shares remaining*/
            $shares_remaining_check =  Shares::select('amount')->latest('id')->first();
            if ($shares_remaining_check == null){
                $shares_remaining = 0.00;
            }else{
                $shares_remaining = $shares_remaining_check->amount;
            }



            $member_shares_balance = DB::table('shares_aquires')
                ->where('user_id', $user_id)
                ->where('status', 'Approved')
                ->sum('amount');


            return view('member.shares.shares', ([
                "user" => $user,
                "shares_released" => $shares_released,
                "shares_remaining" => $shares_remaining,
                "member_shares_balance" => $member_shares_balance,
            ]));
        }
        public function buyShares(Request $request){

            SharesAquire::create([
                "user_id" => Auth::user()->id,
                "amount" => $request->amount,
                "status" => "Pending",
            ]);

            return back()->with('message', "Your request to purchase ₦ $request->amount has been submitted for processing.");

        }

        /*contributions*/
        public function memberContributions(){


            $user = Auth::user();
            $user_id = Auth::user()->id;


            $contributions = DB::table('savings')->where('user_id', '=', $user_id)->get();
            $num = 1;

            return view('member.contributions.contributions', ([
                "user" => $user,
                "contributions" => $contributions,
                "num" => $num
            ]));
        }

}
