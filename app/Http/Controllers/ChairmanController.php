<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\ImportSavings;
use App\Models\LoanAquire;
use App\Models\LoanRefund;
use App\Models\ReleasedShare;
use App\Models\Saving;
use App\Models\Shares;
use App\Models\SharesAquire;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ChairmanController extends Controller
{
    //

    public function index(){

        $user = Auth::user();

        $hour = date('H');
        $dayTerm = ($hour > 17) ? "Evening" : (($hour > 12) ? "Afternoon" : "Morning");


        $getUserCount = User::all()->count();
        $getUsers = User::where('account_type', 'Member')->take(5)->get();
        $date = Carbon::now()->format('d-m-Y');


        /*get shares remaining*/
        $shares_sold_amount = DB::table('shares_aquires')->sum('amount');
        if ($shares_sold_amount == null){
            $shares_sold = 0.00;
        }else{
            $shares_sold = $shares_sold_amount;
        }

        $amount_saved = DB::table('savings')->sum('savings_amount');

        return view('chairman.dashboard', [
            'user' => $user,
            'dayterm' => $dayTerm,
            'membercount' => $getUserCount,
            'members' => $getUsers,
            'date' => $date,
            'shares_sold' => $shares_sold,
            'amount_saved' => $amount_saved,
        ]);
    }


    /*soft loan*/
    public function softloanRequests(User $user){

        $users = User::all();
        $user_id = DB::table('users')->select('id')->get();
        $soft_loan_requests = LoanAquire::all()->where('loan_type','=','Soft Loan');

        return view('chairman.soft-loan.requests', [
            "users" => $users,
            "soft_loan_requests" => $soft_loan_requests,
        ]);
    }

    public function approveSoftLoan(Request $request){

        /*get applicant's name*/

        $loan_applicants = DB::table('loan_aquires')->where('id', $request->loan_id)->first();


        /*check if loan has been previously approve*/
        $loan_approval_status = DB::table('loan_aquires')->where('id', $request->loan_id)->first();

        if ($loan_approval_status->status == "Approved"){
            return back()->with('error', "This Loan has previously been approved! - You cannot approve again");
        }else
        /*proceed to approve request*/
        {
            LoanAquire::where('id', $request->loan_id)->first()
                    ->update([
                        'status' => 'Approved',
                    ]);
}
        return back()->with('message', "Soft Loan has successfully been approved");
    }

    public function refundSoftLoan(Request $request){

        $current_date = date('Y-m-d H:i:s');

        /*get executive user details*/
        $executive_id = Auth::user()->id;

        /*check member total contribution*/
        $total_contribution =  DB::table('savings')->where('user_id', '=', $request->user_id)->latest('id')->first();


        /*check duration of loan*/
        $loan_check = LoanAquire::where('id', $request->loan_id)->first();

        $duration = 3;



        /*check current month*/
        $current_month = (new Carbon(now()))->format('m');

        $existing_refund_check =  LoanRefund::select('payback_date')->where('loan_id', $request->loan_id)->first();


        $loan_amount_collected = $loan_check->amount;
        $amount_to_deduct = $loan_amount_collected;

        $amount_to_deduct_monthly = $amount_to_deduct / $duration;

        /*deduction calculation*/
        $total_contribution_after_refund = $total_contribution->savings_amount - $amount_to_deduct_monthly;

        $refund_check_count =  LoanRefund::where('loan_id', $request->loan_id)->count();

        if ($refund_check_count == $duration || $refund_check_count > $duration){
            LoanAquire::where('id', $request->loan_id)
                ->update([
                    'status' => "Cleared"
                ]);
            return back()->with('error', "Loan has been fully paid!");
        }

        $status = "Refunded for 1st Month";


        if ($refund_check_count == $duration){
            $status = "Cleared";
        }
        if ($refund_check_count > $duration){
            return back()->with('error', 'This loan has been fully paid');
        }

        if ($refund_check_count == 1){
            $status = "Refunded for 2nd Month";
        }
        if ($refund_check_count == 2){
            $status = "Refunded for 3rd Month";
        }
        if ($refund_check_count == 3){
            $status = "Refunded for 4th Month";
        }


        /*check if no refund was made...if none, then enter insert first refund*/

        if ($existing_refund_check == ""){
            Saving::where('user_id', $request->user_id)->latest('id')->first()
                ->update([
                    'savings_amount' => $total_contribution_after_refund
                ]);

            LoanAquire::where('id', $request->loan_id)
                ->update([
                    'status' => $status
                ]);

            LoanRefund::
            create([
                'loan_id' => $request->loan_id,
                'user_id' => $request->user_id,
                'loan_type' => "Soft Loan",
                'admin_id' => $executive_id,
                'amount_refunded' => $amount_to_deduct_monthly,
                'payback_date' => $current_date,
            ]);
            return back()->with('message', "Loan has successfully been refunded for this month");
        }else {

            $refund_check = LoanRefund::select('payback_date')->where('loan_id', $request->loan_id)->latest('id')->first();

            /*check month refund was done*/
            $refund_month = (new Carbon($refund_check->payback_date))->format('m');

            if ($refund_month == $current_month) {
                return back()->with('error', 'Sorry, Refund has been made for this user already this month, You cannot refund until next month');
            } else {

                Saving::where('user_id', $request->user_id)
                    ->update([
                        'savings_amount' => $total_contribution_after_refund
                    ]);

                LoanAquire::where('id', $request->loan_id)
                    ->update([
                        'status' => $status
                    ]);

                LoanRefund::
                create([
                    'loan_id' => $request->loan_id,
                    'admin_id' => $executive_id,
                    'amount_refunded' => $amount_to_deduct_monthly,
                    'payback_date' => $current_date,
                ]);
                return back()->with('message', "Loan has successfully been refunded for this month");

            }


        }


    }

    public function deleteSoftLoan(Request $request){

        DB::table('loan_aquires')->where('id', '=', $request->loan_id)->delete();

        return back()->with('message', "Loan has successfully been deleted successfully");
    }


    /*emergency loan*/
    public function emergencyLoanRequests(User $user){

        $users = User::all();

        $user_id = DB::table('users')->select('id')->get();

        $emergency_loan_requests = LoanAquire::all()->where('loan_type','=','Emergency Loan');

        return view('chairman.emergency-loan.requests', [
            "users" => $users,
            "emergency_loan_requests" => $emergency_loan_requests,
        ]);
    }

    public function approveEmergencyLoan(Request $request){

        $loan_applicants = DB::table('loan_aquires')->where('id', $request->loan_id)->first();

        /*check if loan has been previously approve*/
        $loan_approval_status = DB::table('loan_aquires')->where('id', $request->loan_id)->first();

        if ($loan_approval_status->status == "Approved"){
            return back()->with('error', "This Loan has previously been approved! - You cannot approve again");
        }else
            /*proceed to approve request*/
        {
            LoanAquire::where('id', $request->loan_id)->first()
                ->update([
                    'status' => 'Approved',
                ]);
        }
        return back()->with('message', "Emergency Loan has successfully been approved for $loan_applicants");
    }

    public function deleteEmergencyLoan(Request $request){
        DB::table('loan_aquires')->where('id', '=', $request->loan_id)->delete();
        return back()->with('message', "Loan has successfully been deleted successfully");
    }

    public function refundEmergencyLoan(Request $request){

        $current_date = date('Y-m-d H:i:s');

        /*get executive user details*/
        $executive_id = Auth::user()->id;

        /*check member total contribution*/
        $total_contribution =  DB::table('savings')->where('user_id', '=', $request->user_id)->latest('id')->first();


        /*check duration of loan*/
        $loan_check = LoanAquire::where('id', $request->loan_id)->first();

        $duration = 5;

        /*check current month*/
        $current_month = (new Carbon(now()))->format('m');

        $existing_refund_check =  LoanRefund::select('payback_date')->where('loan_id', $request->loan_id)->first();




        $loan_amount_collected = $loan_check->amount;
        $amount_to_deduct = $loan_amount_collected + ($loan_amount_collected * 0.05);
        $amount_to_deduct_monthly = $amount_to_deduct / $duration;

        /*deduction calculation*/
        $total_contribution_after_refund = $total_contribution->savings_amount - $amount_to_deduct_monthly;

        $refund_check_count =  LoanRefund::where('loan_id', $request->loan_id)->count();

        if ($refund_check_count == $duration || $refund_check_count > $duration){
            LoanAquire::where('id', $request->loan_id)
                ->update([
                    'status' => "Cleared"
                ]);
            return back()->with('error', "Loan has been fully paid!");
        }

        $status = "Refunded for 1st Month";


        if ($refund_check_count == $duration){
            $status = "Cleared";
        }
        if ($refund_check_count > $duration){
            return back()->with('error', 'This loan has been fully paid');
        }

        if ($refund_check_count == 1){
            $status = "Refunded for 2nd Month";
        }
        if ($refund_check_count == 2){
            $status = "Refunded for 3rd Month";
        }
        if ($refund_check_count == 3){
            $status = "Refunded for 4th Month";
        }
        if ($refund_check_count == 4){
            $status = "Refunded for 5th Month";
        }

        if ($refund_check_count == 5){
            $status = "Refunded for 6th Month";
        }


        /*check if no refund was made...if none, then enter insert first refund*/

        if ($existing_refund_check == ""){
            Saving::where('user_id', $request->user_id)->latest('id')->first()
                ->update([
                    'savings_amount' => $total_contribution_after_refund
                ]);

            LoanAquire::where('id', $request->loan_id)
                ->update([
                    'status' => $status
                ]);

            LoanRefund::
            create([
                'loan_id' => $request->loan_id,
                'user_id' => $request->user_id,
                'loan_type' => "Emergency Loan",
                'admin_id' => $executive_id,
                'amount_refunded' => $amount_to_deduct_monthly,
                'payback_date' => $current_date,
            ]);
            return back()->with('message', "Loan has successfully been refunded for this month");
        }else {

            $refund_check = LoanRefund::select('payback_date')->where('loan_id', $request->loan_id)->latest('id')->first();

            /*check month refund was done*/
            $refund_month = (new Carbon($refund_check->payback_date))->format('m');

            if ($refund_month == $current_month) {
                return back()->with('error', 'Sorry, Refund has been made for this user already this month, You cannot refund until next month');
            } else {

                Saving::where('user_id', $request->user_id)
                    ->update([
                        'savings_amount' => $total_contribution_after_refund
                    ]);

                LoanAquire::where('id', $request->loan_id)
                    ->update([
                        'status' => $status
                    ]);

                LoanRefund::
                create([
                    'loan_id' => $request->loan_id,
                    'admin_id' => $executive_id,
                    'amount_refunded' => $amount_to_deduct_monthly,
                    'payback_date' => $current_date,
                ]);
                return back()->with('message', "Loan has successfully been refunded for this month");

            }


        }


    }


    /*food loan*/
    public function foodLoanRequests(User $user){

        $users = User::all();

        $user_id = DB::table('users')->select('id')->get();

        $food_loan_requests = LoanAquire::all()->where('loan_type','=','Food Loan');

        return view('chairman.food-loan.requests', [
            "users" => $users,
            "food_loan_requests" => $food_loan_requests,
        ]);
    }

    public function approveFoodLoan(Request $request){

        $loan_applicants = DB::table('loan_aquires')->where('id', $request->loan_id)->first();

        /*check if loan has been previously approve*/
        $loan_approval_status = DB::table('loan_aquires')->where('id', $request->loan_id)->first();

        if ($loan_approval_status->status == "Approved"){
            return back()->with('error', "This Loan has previously been approved! - You cannot approve again");
        }else
            /*proceed to approve request*/
        {
            LoanAquire::where('id', $request->loan_id)->first()
                ->update([
                    'status' => 'Approved',
                ]);
        }
        return back()->with('message', "Food Loan has successfully been approved");
    }

    public function deleteFoodLoan(Request $request){
        DB::table('loan_aquires')->where('id', '=', $request->loan_id)->delete();
        return back()->with('message', "Loan has successfully been deleted successfully");
    }

    public function refundFoodLoan(Request $request){
        $current_date = date('Y-m-d H:i:s');

        /*get executive user details*/
        $executive_id = Auth::user()->id;

        /*check member total contribution*/
        $total_contribution =  DB::table('savings')->where('user_id', '=', $request->user_id)->latest('id')->first();


        /*check duration of loan*/
        $loan_check = LoanAquire::where('id', $request->loan_id)->first();

        $duration = 5;

        /*check current month*/
        $current_month = (new Carbon(now()))->format('m');

        $existing_refund_check =  LoanRefund::select('payback_date')->where('loan_id', $request->loan_id)->first();




        $loan_amount_collected = $loan_check->amount;
        $amount_to_deduct = $loan_amount_collected + ($loan_amount_collected * 0.03);
        $amount_to_deduct_monthly = $amount_to_deduct / $duration;

        /*deduction calculation*/
        $total_contribution_after_refund = $total_contribution->savings_amount - $amount_to_deduct_monthly;

        $refund_check_count =  LoanRefund::where('loan_id', $request->loan_id)->count();

        if ($refund_check_count == $duration || $refund_check_count > $duration){
            LoanAquire::where('id', $request->loan_id)
                ->update([
                    'status' => "Cleared"
                ]);
            return back()->with('error', "Loan has been fully paid!");
        }

        $status = "Refunded for 1st Month";


        if ($refund_check_count == $duration){
            $status = "Cleared";
        }
        if ($refund_check_count > $duration){
            return back()->with('error', 'This loan has been fully paid');
        }

        if ($refund_check_count == 1){
            $status = "Refunded for 2nd Month";
        }
        if ($refund_check_count == 2){
            $status = "Refunded for 3rd Month";
        }
        if ($refund_check_count == 3){
            $status = "Refunded for 4th Month";
        }
        if ($refund_check_count == 4){
            $status = "Refunded for 5th Month";
        }

        if ($refund_check_count == 5){
            $status = "Refunded for 6th Month";
        }


        /*check if no refund was made...if none, then enter insert first refund*/

        if ($existing_refund_check == ""){
            Saving::where('user_id', $request->user_id)->latest('id')->first()
                ->update([
                    'savings_amount' => $total_contribution_after_refund
                ]);

            LoanAquire::where('id', $request->loan_id)
                ->update([
                    'status' => $status
                ]);

            LoanRefund::
            create([
                'loan_id' => $request->loan_id,
                'user_id' => $request->user_id,
                'loan_type' => "Food Loan",
                'admin_id' => $executive_id,
                'amount_refunded' => $amount_to_deduct_monthly,
                'payback_date' => $current_date,
            ]);
            return back()->with('message', "Loan has successfully been refunded for this month");
        }else {

            $refund_check = LoanRefund::select('payback_date')->where('loan_id', $request->loan_id)->latest('id')->first();

            /*check month refund was done*/
            $refund_month = (new Carbon($refund_check->payback_date))->format('m');

            if ($refund_month == $current_month) {
                return back()->with('error', 'Sorry, Refund has been made for this user already this month, You cannot refund until next month');
            } else {

                Saving::where('user_id', $request->user_id)
                    ->update([
                        'savings_amount' => $total_contribution_after_refund
                    ]);

                LoanAquire::where('id', $request->loan_id)
                    ->update([
                        'status' => $status
                    ]);

                LoanRefund::
                create([
                    'loan_id' => $request->loan_id,
                    'admin_id' => $executive_id,
                    'amount_refunded' => $amount_to_deduct_monthly,
                    'payback_date' => $current_date,
                ]);
                return back()->with('message', "Loan has successfully been refunded for this month");

            }


        }


    }



    /*shares*/
    public function adminShares(){



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



        return view('chairman.shares.add-shares', ([
            "shares_released" => $shares_released,
            "shares_remaining" => $shares_remaining
        ]));
    }


    public function addShares(Request $request)
    {

        ReleasedShare::create([
            "name" => $request->name,
            "amount" => $request->amount,
        ]);

        Shares::create([
            "name" => $request->name,
            "amount" => $request->amount,
        ]);


        return back()->with('message', 'Shares has been added successfully');
    }

    public function sharesRequests(){

        $users = User::all();
        $user_id = DB::table('users')->select('id')->get();

        $shares_requests = SharesAquire::all();
        return view('chairman.shares.requests', ([
            "users" => $users,
            "shares_requests" => $shares_requests
        ]));
    }

    public function approveShares(Request $request){

        /*get applicant's name*/

        $loan_applicants = DB::table('shares_aquires')->where('id', $request->loan_id)->first();


        /*check if loan has been previously approve*/
        $shares_approval_status = DB::table('shares_aquires')->where('id', $request->shares_id)->first();




        if ($shares_approval_status->status == "Approved"){
            return back()->with('error', "This Shares has previously been approved! - You cannot approve again");
        }else
            /*proceed to approve request*/
        {

            SharesAquire::where('id', $request->shares_id)->first()
                ->update([
                    'status' => 'Approved',
                ]);

            /*deduct the shares bought from shares released*/
            $shares_check =  Shares::select('amount')->latest('id')->first();
            $shares_id_check =  Shares::select('id')->latest('id')->first();
            $shares_released = $shares_check->amount;

            $amount_after_shares_deduction = $shares_released - $request->amount;

            /*proceed to update the shares released balance*/
            Shares::where('id', $shares_id_check->id)
                ->update([
                   "amount" =>  $amount_after_shares_deduction
                ]);
        }

        return back()->with('message', "Shares purchase request has successfully been approved");
    }




    /*savings*/
    public function batchUpload()
    {
        $user = Auth::user();

        return view('chairman.savings.import-savings', ['user' => $user]);
    }



    public function addSavings(){

        $user = Auth::user();
        $users = User::all();
        return view('admin.savings.add-savings', [
            'user' => $user,
            'users' => $users
        ]);
    }

    /*import user savings*/
    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new ImportSavings(),request()->file('file'));

        return back()->with('message', 'Batch Savings has been imported successfuly!');
    }

    public function contributions(){


        $all_contributions = Saving::all();
        $num = 1;

        return view('chairman.savings.contributions', ([
            "all_contributions" => $all_contributions,
            "num" => $num
        ]));
    }


    public function members(){

        $members = User::all()->where('account_type', "Member");
        $num = 1;

        return view('chairman.members', ([
            "num" => $num,
            "members" => $members
        ]));

    }


    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

}
