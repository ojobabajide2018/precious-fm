<?php

namespace App\Http\Controllers;

use App\Models\LoanApproval;
use App\Models\LoanAquire;
use App\Models\LoanRefund;
use App\Models\Saving;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class ExecutiveController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        $user = Auth::user();

        $hour = date('H');
        $dayTerm = ($hour > 17) ? "Evening" : (($hour > 12) ? "Afternoon" : "Morning");

        $getUserCount = User::all()->count();
        $getUsers = User::latest()->take(5)->get();
        $date = Carbon::now()->format('d-m-Y');

        /*get shares remaining*/
        $shares_sold_amount = DB::table('shares_aquires')->sum('amount');
        if ($shares_sold_amount == null){
            $shares_sold = 0.00;
        }else{
            $shares_sold = $shares_sold_amount;
        }

        $amount_saved = DB::table('savings')->sum('savings_amount');

        return view('executive.dashboard', [
            'user' => $user,
            'dayterm' => $dayTerm,
            'membercount' => $getUserCount,
            'members' => $getUsers,
            'date' => $date,
            'shares_sold' => $shares_sold,
            'amount_saved' => $amount_saved,
        ]);
    }

    /*ordinary loan*/
    public function ordinaryLoanRequests(User $user){

        $users = User::all();

        $user_id = DB::table('users')->select('id')->get();

        $ordinary_loan_requests = LoanAquire::all()->where('loan_type','=','Ordinary Loan');

        return view('executive.ordinary-loan.requests', [
            "users" => $users,
            "ordinary_loan_requests" => $ordinary_loan_requests,
        ]);
    }

    public function approveOrdinaryLoan(Request $request){

        /*get executive user details*/
        $executive_id = Auth::user()->id;
        $approval_check =  LoanApproval::where('loan_id', $request->loan_id)->count();

        /*check if loan has been previously approve*/
        $loan_approval_status = DB::table('loan_aquires')->where('id', $request->loan_id)->first();

        /*check if executive has approved*/
        /*if (LoanApproval::select('admin_id')
            ->where('loan_id', $request->loan_id)
            ->where('admin_id', $executive_id)->exists()){
            return back()->with('error', "Sorry, you have previously approved this loan");
        }*/

        if ($approval_check == 6){
            return back()->with('error', "Loan has reach maximum number of approvals");
        }
        $status = "Waiting for Second Approval";

        if ($approval_check == 1){
            $status = "Waiting for Second Approval";
        }
        if ($approval_check == 2){
            $status = "Waiting for third Approval";
        }
        if ($approval_check == 3){
            $status = "Waiting for 4th Approval";
        }
        if ($approval_check == 4){
            $status = "Waiting for 5th Approval";
        }
        if ($approval_check == 5){
            $status = "Waiting for 6th Approval";
        }
        if ($approval_check == 6){
            $status = "Approved";
        }
        if ($approval_check == 7){
            $status = "Approved";
        }
        LoanAquire::where('id', $request->loan_id)
            ->update([
                'status' => $status
            ]);
        LoanApproval::
        create([
            'loan_id' => $request->loan_id,
            'admin_id' => $executive_id,
        ]);

        return back()->with('message', "Special Loan has successfully been approved");

    }
    public function deleteOrdinaryLoan(Request $request){
        DB::table('loan_aquires')->where('id', '=', $request->loan_id)->delete();
        return back()->with('message', "Loan has successfully been deleted successfully");
    }

    public function refundOrdinaryLoan(Request $request){

        $current_date = date('Y-m-d H:i:s');

        /*get executive user details*/
        $executive_id = Auth::user()->id;

        /*check member total contribution*/
        $total_contribution =  DB::table('savings')->where('user_id', '=', $request->user_id)->latest('id')->first();


        /*check dureation of loan*/
        $loan_check = LoanAquire::where('id', $request->loan_id)->first();

            $duration = 12;

        /*check current month*/
        $current_month = (new Carbon(now()))->format('m');

        $existing_refund_check =  LoanRefund::select('payback_date')->where('loan_id', $request->loan_id)->first();


        $loan_amount_collected = $loan_check->amount;
        $amount_to_deduct = $loan_amount_collected + ($loan_amount_collected * 0.1);
        $amount_to_deduct_monthly = $amount_to_deduct / $duration;

        /*deduction calculation*/
        $total_contribution_after_refund = $total_contribution->savings_amount - $amount_to_deduct_monthly;

        $refund_check_count =  LoanRefund::where('loan_id', $request->loan_id)->count();

        if ($refund_check_count == $duration || $refund_check_count > $duration){
            LoanAquire::where('id', $request->loan_id)
                ->update([
                    'status' => "Cleared"
                ]);
            return back()->with('error', "Loan has been fully paid!. You cannot refund for this member");
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
        if ($refund_check_count == 6){
            $status = "Refunded for 7th Month";
        }
        if ($refund_check_count == 7){
            $status = "Refunded for 8th Month";
        }
        if ($refund_check_count == 8){
            $status = "Refunded for 9th Month";
        }
        if ($refund_check_count == 9){
            $status = "Refunded for 10th Month";
        }
        if ($refund_check_count == 10){
            $status = "Refunded for 11th Month";
        }
        if ($refund_check_count == 11){
            $status = "Refunded for 12th Month";
        }
        if ($refund_check_count == 12){
            $status = "Refunded for 13th Month";
        }
        if ($refund_check_count == 13){
            $status = "Refunded for 14th Month";
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
                'loan_type' => "Ordinary Loan",
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
    public function liquidateOrdinaryLoan(Request $request){

        /*check for loan amount*/
        $loan_check = LoanAquire::select('amount')->where('id', $request->loan_id)->first();


        /*check for loan refunded amount*/
        $refunded_amount = DB::table('loan_refunds')->where('loan_id', '=', $request->loan_id)->sum('amount_refunded');


        /*check for amount to liquidate (i.e, Amount collected minus refunded_amount)*/
        $loan_check = LoanAquire::select('amount')->where('id', $request->loan_id)->first();
        $loan_amount_collected = $loan_check->amount;

        $amount_to_liquidate = $loan_amount_collected - $refunded_amount;

        /*To liquidate, user must take a loan to liquidate previous loan, so we proceed to apply for this amount as a loan*/



        if ($amount_to_liquidate > 0 && $amount_to_liquidate){
            $duration = "24 Month";
        }elseif ($amount_to_liquidate > 999999 && $amount_to_liquidate < 1999999){
            $duration = "36 Month";
        }elseif ($amount_to_liquidate > 2000000){
            $duration = "48 Month";
        }

        /*store loan request in loanaquires table*/
        LoanAquire::create([
            'user_id' => $request->user_id,
            'amount' => $amount_to_liquidate,
            'interest' => 10,
            'duration' => $duration,
            'status' => "Active",
            'loan_types_id' => "",
            'loan_type' => "Special Loan",
            'guarantor_one_name' => "",
            'guarantor_one_phone' => "",
            'guarantor_one_address' => "",
            'guarantor_two_name' => "",
            'guarantor_two_phone' => "",
            'guarantor_two_address' => "",
        ]);

        $total_contribution =  DB::table('savings')->where('user_id', '=', $request->user_id)->first();

        /*do the liquidation*/
        $total_contribution_after_liquidation = $total_contribution->savings_amount - $amount_to_liquidate;


        Saving::where('user_id', $request->user_id)
            ->update([
                'savings_amount' => $total_contribution_after_liquidation
            ]);

        LoanAquire::where('id', $request->loan_id)
            ->update([
                'status' => "Approved"
            ]);


    }





    /*Appliance loan*/

    public function applianceLoanRequests(User $user){
        $users = User::all();
        $user_id = DB::table('users')->select('id')->get();
        $appliance_loan_requests = LoanAquire::all()->where('loan_type','=','Appliance Loan');
        return view('executive.appliance-loan.requests', [
            "users" => $users,
            "appliance_loan_requests" => $appliance_loan_requests,
        ]);
    }

    public function approveApplianceLoan(Request $request){

        /*get applicant's name*/
        $get_loan_applicant = User::select('firstname', 'lastname')->whereId($request->user_id)->first();
        $loan_applicant = $get_loan_applicant->firstname.' '. $get_loan_applicant->lastname;

        /*check if loan has been previously approve*/
        $loan_approval_status = DB::table('loan_aquires')->where('id', $request->loan_id)->first();

        if ($loan_approval_status->status == "Approved"){
            return back()->with('error', "This Loan has previously been approved for $loan_applicant! - You cannot approve again");
        }else
            /*proceed to approve request*/
        {
            LoanAquire::where('id', $request->loan_id)->first()
                ->update([
                    'status' => 'Approved',
                ]);
        }
        return back()->with('message', "Appliance Loan has successfully been approved for $loan_applicant");
    }

    public function deleteApplianceLoan(Request $request){

        DB::table('loan_aquires')->where('id', '=', $request->loan_id)->delete();

        return back()->with('message', "Loan has successfully been deleted");
    }

    public function refundApplianceLoan(Request $request){

        $current_date = date('Y-m-d H:i:s');

        /*get executive user details*/
        $executive_id = Auth::user()->id;

        /*check member total contribution*/
        $total_contribution =  DB::table('savings')->where('user_id', '=', $request->user_id)->first();


        $loan_check = LoanAquire::select('amount')->where('id', $request->loan_id)->first();


        /*check current month*/
        $current_month = (new Carbon(now()))->format('m');

        $existing_refund_check =  LoanRefund::select('created_at')->where('loan_id', $request->loan_id)->first();

        $loan_amount_collected = $loan_check->amount;
        $amount_to_deduct = $loan_amount_collected + ($loan_amount_collected * 0.7);
        $amount_to_deduct_monthly = $amount_to_deduct / 12;



        /*deduction calculation*/
        $total_contribution_after_refund = $total_contribution->savings_amount - $amount_to_deduct_monthly;


        $refund_check_count =  LoanRefund::where('loan_id', $request->loan_id)->count();

        if ($refund_check_count == 7){
            return back()->with('error', "Loan has been fully paid!. You cannot refund again");
        }

        $status = "Refunded for 1st Month";

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
        if ($refund_check_count == 6){
            $status = "Cleared";
        }



        /*check if no refund was made...if none, then enter insert first refund*/

        if ($existing_refund_check == ""){
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
                'user_id' => $request->user_id,
                'loan_type' => "Appliance Loan",
                'admin_id' => $executive_id,
                'amount_refunded' => $amount_to_deduct_monthly,
                'payback_date' => $current_date,
            ]);
            return back()->with('message', "Loan has successfully been refunded for this month");
        }else{

            $refund_check =  LoanRefund::select('payback_date')->where('loan_id', $request->loan_id)->latest('id')->first();

            /*check month refund was done*/
            $refund_month = (new Carbon($refund_check->payback_date))->format('m');

            if ($refund_month == $current_month){
                return back()->with('error', 'Sorry, Refund has been made for this user already this month, You cannot refund until next month');
            }else{
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

    public function liquidateApplianceLoan(Request $request){

        /*check for loan amount*/
        $loan_check = LoanAquire::select('amount')->where('id', $request->loan_id)->first();
        $loan_amount_collected = $loan_check->amount;


        /*check for loan refunded amount*/
        $refunded_amount = LoanRefund::where('loan_id', $request->loan_id);

        /*check for amount to liquidate*/


    }




}
