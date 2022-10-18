<div>
    @if(!empty($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif

    <div class="row setup-content">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Login Beloww</h3>
                <div class="form-group">
                    <label for="title">Email:</label>
                    <input type="text" wire:model="email" name="email" class="form-control" id="email">
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Password:</label>
                    <input type="password" wire:model="password" name="password" class="form-control" id="password"/>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="login" type="button">Login</button>
                <h4>Don't have an account yet? Click <a href="/">here</a></h4>
            </div>
        </div>
    </div>
</div>
