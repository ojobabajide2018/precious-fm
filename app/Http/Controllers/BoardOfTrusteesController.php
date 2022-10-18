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

class BoardOfTrusteesController extends Controller
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

        return view('board-of-trustees.dashboard', [
            'user' => $user,
            'dayterm' => $dayTerm,
            'membercount' => $getUserCount,
            'members' => $getUsers,
            'date' => $date,
            'shares_sold' => $shares_sold,
            'amount_saved' => $amount_saved,
        ]);
    }


    /*special loan*/
    public function specialLoanRequests(User $user){

        $users = User::all();

        $user_id = DB::table('users')->select('id')->get();

        $special_loan_requests = LoanAquire::all()->where('loan_type','=','Special Loan');

        return view('board-of-trustees.special-loan.requests', [
            "users" => $users,
            "special_loan_requests" => $special_loan_requests,
        ]);
    }
    public function approveSpecialLoan(Request $request){
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

        if ($approval_check == 8){
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
            $status = "Waiting for 7th Approval";
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


    public function refundSpecialLoan(Request $request){

        $current_date = date('Y-m-d H:i:s');

        /*get executive user details*/
        $executive_id = Auth::user()->id;

        /*check member total contribution*/
        $total_contribution =  DB::table('savings')->where('user_id', '=', $request->user_id)->latest('id')->first();




        /*check dureation of loan*/
        $loan_check = LoanAquire::where('id', $request->loan_id)->first();
        $loan_duration_check = $loan_check->duration;

        if ($loan_duration_check == "12 Month"){
            $duration = 12;
        }elseif ($loan_duration_check == "24 Month"){
            $duration = 24;
        }elseif ($loan_duration_check == "36 Month"){
            $duration = 36;
        }

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
        if ($refund_check_count == 14){
            $status = "Refunded for 15th Month";
        }
        if ($refund_check_count == 15){
            $status = "Refunded for 16th Month";
        }
        if ($refund_check_count == 16){
            $status = "Refunded for 17th Month";
        }
        if ($refund_check_count == 17){
            $status = "Refunded for 18th Month";
        }
        if ($refund_check_count == 18){
            $status = "Refunded for 19th Month";
        }
        if ($refund_check_count == 19){
            $status = "Refunded for 20th Month";
        }
        if ($refund_check_count == 20){
            $status = "Refunded for 21st Month";
        }
        if ($refund_check_count == 21){
            $status = "Refunded for 22nd Month";
        }
        if ($refund_check_count == 22){
            $status = "Refunded for 23rd Month";
        }
        if ($refund_check_count == 23){
            $status = "Refunded for 24th Month";
        }
        if ($refund_check_count == 24){
            $status = "Refunded for 25th Month";
        }
        if ($refund_check_count == 25){
            $status = "Refunded for 26th Month";
        }
        if ($refund_check_count == 26){
            $status = "Refunded for 27th Month";
        }
        if ($refund_check_count == 27){
            $status = "Refunded for 28th Month";
        }
        if ($refund_check_count == 28){
            $status = "Refunded for 29th Month";
        }
        if ($refund_check_count == 29){
            $status = "Refunded for 30th Month";
        }
        if ($refund_check_count == 30){
            $status = "Refunded for 31st Month";
        }
        if ($refund_check_count == 31){
            $status = "Refunded for 32nd Month";
        }
        if ($refund_check_count == 32){
            $status = "Refunded for 33rd Month";
        }
        if ($refund_check_count == 33){
            $status = "Refunded for 34th Month";
        }
        if ($refund_check_count == 34){
            $status = "Refunded for 35th Month";
        }
        if ($refund_check_count == 35){
            $status = "Refunded for 36th Month";
        }
        if ($refund_check_count == 36){
            $status = "Refunded for 37th Month";
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
                'loan_type' => "Special loan",
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


    /*special topup loan*/
    public function specialTopUpLoanRequests(User $user){

        $users = User::all();

        $user_id = DB::table('users')->select('id')->get();

        $special_loan_requests = LoanAquire::all()->where('loan_type','=','Special Top-Up Loan');

        return view('board-of-trustees.special-loan.special-top-up-loan-requests', [
            "users" => $users,
            "special_loan_requests" => $special_loan_requests,
        ]);
    }
    public function approveSpecialTopUpLoan(Request $request){
        /*get executive user details*/
        $executive_id = Auth::user()->id;

        /*check if loan has been previously approve*/
        $topup_loan_check = DB::table('loan_aquires')->where('id', $request->loan_id)->first();
        $topup_amount_requested = $topup_loan_check->amount;



        /*check existing special loan of member and get the amount*/
        $existing_special_loan_check = DB::table("loan_aquires")
            ->where("user_id", "=", $request->user_id)
            ->where("loan_type", "=", "Special Loan")->latest('id')->first();
        $special_loan_previously_collected = $existing_special_loan_check->amount;

        $special_loan_id = $existing_special_loan_check->id;

        $amount_to_payback = $existing_special_loan_check->amount + ($existing_special_loan_check->amount *0.1);

        /*check if loan has been refunded, and get the amount refunded*/
        $refunded_amount = DB::table("loan_refunds")->where("loan_id", "=", $special_loan_id)->sum("amount_refunded");

        $amount_to_liquidate = $amount_to_payback - $refunded_amount;

        /*do the liquidation with the new top-up amount*/
        $amount_after_liquidation = $topup_amount_requested - $amount_to_liquidate;



        /*calculate duration function*/
        if ($amount_to_liquidate > 0 && $amount_to_liquidate){
            $duration = "24 Month";
        }elseif ($amount_to_liquidate > 999999 && $amount_to_liquidate < 1999999){
            $duration = "36 Month";
        }elseif ($amount_to_liquidate > 2000000){
            $duration = "48 Month";
        }


        /*get current month*/
        $date = Carbon::now();

        $monthName = $date->format('F');

        /*add the balance (after liquidation) to the member's contribution*/
        Saving::create([
            'user_id' => $request->user_id,
            'savings_amount' => $amount_after_liquidation,
            'month' => $monthName,
            'status' => "Top Up",
        ]);

            /*clear existing special loan*/
        LoanAquire::where("user_id", $request->user_id)->where("loan_type", "Special Loan")->latest('id')->first()
            ->update([
                "status" => "Cleared"
            ]);

        /*add the top up loan as fresh special loan for the member*/
        LoanAquire::create([
            'user_id' => $request->user_id,
            'loan_type' => "Special Loan",
            'amount' => $topup_amount_requested,
            'interest' => "10",
            'duration' => $duration,
            'month' => $monthName,
            'status' => "Top Up",
        ]);

        return back()->with('message', "Special Top-up Loan has successfully been approved & has liquidated the member's current special loan.");

    }

    public function deleteSpecialLoan(Request $request){

        DB::table('loan_aquires')->where('id', '=', $request->loan_id)->delete();

        return back()->with('message', "Loan has successfully been deleted");
    }



}
