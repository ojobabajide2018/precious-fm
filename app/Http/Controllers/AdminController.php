<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\ImportSavings;
use App\Imports\MembersSavingsImport;
use App\Imports\SavingsImport;
use App\Imports\UsersImport;
use App\Models\BankDetail;
use App\Models\Saving;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    //

    public function login()
    {

        return view('auth.login');
    }

    public function loginAuth(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if (Auth::user()->account_type == 'Admin') {
                return redirect()->route('chairman.dashboard');
            } elseif (Auth::user()->account_type == 'Member') {
                return redirect()->route('member.dashboard');
            } elseif (Auth::user()->account_type == 'nonmember') {
                return redirect()->route('nonmember.dashboard');
            }elseif (Auth::user()->account_type == 'Chairman') {
                return redirect()->route('chairman.dashboard');
            }elseif (Auth::user()->account_type == 'Executive') {
                return redirect()->route('executive.dashboard');
            }elseif (Auth::user()->account_type == 'Board of Trustees') {
                return redirect()->route('board-of-trustees.dashboard');
            } else {
                return redirect()->back('401');
            }
        }
        return "Invalid Credentials";
    }


    public function adminDashboard()
    {

        $user = Auth::user();

        $hour = date('H');
        $dayTerm = ($hour > 17) ? "Evening" : (($hour > 12) ? "Afternoon" : "Morning");


        $getUserCount = User::all()->count();
        $getUsers = User::where('account_type', 'Member')->take(5)->get();
        $date = Carbon::now()->format('d-m-Y');


        return view('admin.dashboard', [
            'user' => $user,
            'dayterm' => $dayTerm,
            'membercount' => $getUserCount,
            'members' => $getUsers,
            'date' => $date,
        ]);
    }


    public function dashboard()
    {

        return view('admin.dashboard');
    }


    public function batchUpload()
    {


        $user = Auth::user();

        return view('admin.savings.import-savings', ['user' => $user]);
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


    /*get member savings amount*/

    public function savingsBalance(){

        $users = User::all();


    }


    public function bankDetails(){

        $user = Auth::user();

        foreach ($user->user_saving as $us)
        {
            $total_savings = ($us->savings_amount);
        }



        return view('admin.bank-details', [
            "user" => $user,
            "total_savings" => $total_savings,

        ]);

        $bank_details = BankDetail::all();
        return view('admin.bank-details', [
            "users" => $users,
            "bank_details" => $bank_details,
        ]);
    }





}
