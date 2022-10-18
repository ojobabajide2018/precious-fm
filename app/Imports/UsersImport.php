<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'firstname' => $row[0],
            'lastname' => $row[1],
            'email' => $row[2],
            'account_type' => $row[3],
            'password' => $row[4],
            'ippis_no' => $row[5],
            'staff_no' => $row[6],
            'gender' => $row[7],
            'department' => $row[8],
            'address' => $row[9],
            'phone' => $row[10],
            'nok_fname' => $row[11],
            'nok_lname' => $row[12],
            'nok_phone' => $row[13],
            'nok_address' => $row[14],
            'nok_relationship' => $row[15],
        ]);
    }
}
