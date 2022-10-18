<div>
    @if(!empty($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                <p>Step 1</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                <p>Step 2</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">3</a>
                <p>Step 3</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-4" type="button" class="btn btn-circle {{ $currentStep != 4 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">4</a>
                <p>Step 4</p>
            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Step 1</h3>
                <div class="form-group">
                    <label for="title">First Name:</label>
                    <input type="text" wire:model="firstname" name="firstname" class="form-control" id="firstname">
                    @error('firstname') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Last name:</label>
                    <input type="text" wire:model="lastname" name="lastname" class="form-control" id="lastname"/>
                    @error('lastname') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Email:</label>
                    <input type="email" wire:model="email" name="email" class="form-control" id="productAmount"/>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Password:</label>
                    <input type="password" wire:model="password" name="password" class="form-control" id="productAmount"/>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <select for="description" name="account_type" wire:model="account_type" class="form-control">
                        <option value="">Choose Account Type</option>
                        <option value="Admin">Admin</option>
                        <option value="Member">Member</option>
                        <option value="Nonmember">Non Member</option>
                    </select>
                    @error('account_type') <span class="error">{{ $message }}</span> @enderror
                </div>
                <p><b>Already a member? Login <a href="/">here</a></b></p>
                <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Step 2</h3>
                <div class="form-group">
                    <label for="description">IPPIS NO:</label>
                    <input type="number" wire:model="ippis_no" name="ippis_no" class="form-control" id="productAmount"/>
                    @error('ippis_no') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Staff NO</label>
                    <input type="number" wire:model="staff_no" name="staff_no" class="form-control" id="productAmount"/>
                    @error('staff_no') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Department</label>
                    <input type="department" wire:model="department" name="department" class="form-control" id="productAmount"/>
                    @error('department') <span class="error">{{ $message }}</span> @enderror
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" wire:click="secondStepSubmit">Next</button>
                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Step 3</h3>
                <div class="form-group">
                    <label for="description">Phone NO:</label>
                    <input type="number" wire:model="phone" name="phone" class="form-control" id="productAmount"/>
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Address</label>
                    <input type="text" wire:model="address" name="address" class="form-control" id="productAmount"/>
                    @error('address') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <select for="description" name="gender" wire:model="gender" class="form-control">
                        <option value="">Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @error('gender') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Next of Kin's Firstname</label>
                    <input type="text" wire:model="nok_fname" name="nok_fname" class="form-control" id="productAmount"/>
                    @error('nok_fname') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Next of Kin's Lastname</label>
                    <input type="text" wire:model="nok_lname" name="nok_lname" class="form-control" id="productAmount"/>
                    @error('nok_lname') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <select for="description" name="nok_gender" wire:model="nok_gender" class="form-control">
                        <option value="">Next of Kin's Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @error('nok_gender') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Next of Kin's Relationship</label>
                    <input type="text" wire:model="nok_relationship" name="nok_relationship" class="form-control" id="productAmount"/>
                    @error('nok_relationship') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Next of Kin's Home Address</label>
                    <input type="text" wire:model="nok_address" name="nok_address" class="form-control" id="productAmount"/>
                    @error('nok_address') <span class="error">{{ $message }}</span> @enderror
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" wire:click="thirdStepSubmit">Next</button>
                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 4 ? 'displayNone' : '' }}" id="step-4">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Review you Data Below</h3>
                <table class="table">

                    <tr>
                        <td>Fullname Name:</td>
                        <td><strong>{{$firstname}} {{$lastname}}</strong></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><strong>{{$email}}</strong></td>
                    </tr>
                    <tr>
                        <td>Account Type:</td>
                        <td><strong>{{$account_type}}</strong></td>
                    </tr>
                    <tr>
                        <td>IPPIS NO:</td>
                        <td><strong>{{$ippis_no}}</strong></td>
                    </tr>
                    <tr>
                        <td>Staff NO:</td>
                        <td><strong>{{$staff_no}}</strong></td>
                    </tr>
                    <tr>
                        <td>Department:</td>
                        <td><strong>{{$department}}</strong></td>
                    </tr>
                    <tr>
                        <td>Phone NO:</td>
                        <td><strong>{{$phone}}</strong></td>
                    </tr>
                    <tr>
                        <td>Home Address:</td>
                        <td><strong>{{$address}}</strong></td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td><strong>{{$gender}}</strong></td>
                    </tr>
                    <tr>
                        <p>Next of Kin's Information</p>
                        <td>Name:</td>
                        <td><strong>{{$nok_fname}} {{$nok_lname}}</strong></td>
                    </tr>
                    <tr>php artisan ui vue --auth

                        <td>Gender:</td>
                        <td><strong>{{$nok_gender}}</strong></td>
                    </tr>
                    <tr>
                        <td>Relationship:</td>
                        <td><strong>{{$nok_relationship}}</strong></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><strong>{{$nok_address}}</strong></td>
                    </tr>
                </table>
                <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button>
                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button>
            </div>
        </div>
    </div>
</div>
