<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRefund extends Model
{
    use HasFactory;
    protected $fillable = [
        'loan_id',
        'loan_type',
        'user_id',
        'admin_id',
        'amount_refunded',
        'payback_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
