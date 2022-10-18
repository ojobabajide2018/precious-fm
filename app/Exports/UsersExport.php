<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all()->where('account_type', "Member")->map(function($member) {
            return [
                'id' => $member->id,
                'firstname' => $member->firstname,
                'lastname' => $member->lastname,
                'email' => $member->email,
                'ippis_no' => $member->email,
                'staff_no' => $member->staff_no,
                'department' => $member->department,
                'gender' => $member->gender,
                'address' => $member->address,
                'phone' => $member->phone,
            ];
        });


    }
}
