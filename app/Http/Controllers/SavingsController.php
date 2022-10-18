<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\SavingsImport;
use Maatwebsite\Excel\Excel;




class SavingsController extends Controller
{
    //


    public function importForm(){


        $user = Auth::user();

        return view('admin.savings.import-savings', ['user' => $user]);
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new SavingsImport(),request()->file('file'));

        return back();
    }

}
