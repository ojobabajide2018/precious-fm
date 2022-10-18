<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'account_type',
        'ippis_no',
        'staff_no',
        'gender',
        'address',
        'department',
        'phone',
        'nok_fname',
        'nok_lname',
        'nok_address',
        'nok_relationship',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];





public function user_saving(){

    return $this->hasMany(Saving::class);
}


public function loan_aquires(){

    return $this->hasMany(LoanAquire::class);
}



public function profile_picture(){

    return $this->hasOne(ProfilePictures::class);
}


public function bank(){

    return $this->hasOne(BankDetail::class);
}

public function shares(){

    return $this->hasMany(SharesAquire::class);
}
public function refunds(){

    return $this->hasMany(LoanRefund::class);
}

}
