<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;

class Wizard extends Component
{
    public $currentStep = 1;
    public $firstname, $lastname, $email, $phone, $password, $account_type, $ippis_no, $staff_no, $department, $address, $gender, $nok_fname, $nok_lname, $nok_gender, $nok_relationship, $nok_address;
    public $successMessage = '';

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function render()
    {
        return view('livewire.wizard');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $this->currentStep = 2;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'ippis_no' => 'required',
            'staff_no' => 'required',
            'department' => 'required',
        ]);

        $this->currentStep = 3;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function thirdStepSubmit()
    {
        $validatedData = $this->validate([
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'nok_fname' => 'required',
            'nok_lname' => 'required',
            'nok_gender' => 'required',
            'nok_relationship' => 'required',
            'nok_address' => 'required',
        ]);
        $this->currentStep = 4;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForm()
    {



        $password = Hash::make($this->password);
        User::create([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => $password,
            'account_type' => $this->account_type,
            'ippis_no' => $this->ippis_no,
            'staff_no' => $this->staff_no,
            'department' => $this->department,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'nok_fname' => $this->nok_fname,
            'nok_lname' => $this->nok_lname,
            'nok_relationship' => $this->nok_relationship,
            'nok_address' => $this->nok_address,
        ]);
        $this->successMessage = 'Account Created Successfully.';


        $this->clearForm();

        $this->currentStep = 1;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clearForm()
    {
        $this->firstname = '';
        $this->lastname = '';
        $this->password = '';
        $this->account_type = '';
        $this->ippis_no;
        $this->staff_no;
        $this->department;
        $this->phone;
        $this->address;
        $this->gender;
        $this->nok_fname;
        $this->nok_lname;
        $this->nok_relationship;
        $this->nok_address;
    }
}
