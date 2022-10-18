<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanAquire extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'loan_types_id',
        'loan_type',
        'interest',
        'amount',
        'duration',
        'guarantor_one_name',
        'guarantor_one_phone',
        'guarantor_one_address',
        'guarantor_two_name',
        'guarantor_two_phone',
        'guarantor_two_address',
        'first_approval',
        'second_approval',
        'third_approval',
        'fourth_approval',
        'fifth_approval',
        'sixth_approval',
        'pay_slip',
        'status'
    ];


    public function user(){

        return $this->belongsTo(User::class);
    }


}
