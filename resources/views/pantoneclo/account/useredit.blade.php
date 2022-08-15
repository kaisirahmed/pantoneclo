<form id="userUpdateForm">
    @csrf
    <input type="hidden" name="id" value="{{ $user->id }}">
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Email:</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ $user->email }}"
        placeholder="Enter Email Address..."/>
        <p class="invalid-feedback" role="alert">
        </p>
    </div>
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Name:</label>
        <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror" name="name" value="{{ $user->name }}" placeholder="First Name">
        <p class="invalid-feedback" role="alert">
        </p>
    </div>
    
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Phone:</label>
        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}" placeholder="Phone number">
        <p class="invalid-feedback" role="alert">
        </p>
    </div>
    <a href="javascript:void(0);" class="btn btn-primary float-right" onclick="updateUser()">{{ __('Update') }}</a>
</form>
