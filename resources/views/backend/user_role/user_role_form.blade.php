@if ($errors->any())
    <div class="alert alert-danger border-left-danger" role="alert">
        <ul class="pl-4 my-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <input type="text" class="form-control form-control-user" name="nik" id="nik"
        placeholder="{{ __('NIK') }}" value="{{ old('nik') }}" required autofocus>
</div>

<div class="form-group">
    <input type="text" class="form-control form-control-user" name="name" id="name"
        placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
</div>

<div class="form-group">
    <input type="text" class="form-control form-control-user" name="username" id="username"
        placeholder="{{ __('Username') }}" value="{{ old('username') }}" required autofocus>
</div>
<div class="form-group">
    <input type="email" class="form-control form-control-user" name="email" id="email"
        placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required>
</div>

<div class="form-group">
    <input type="password" class="form-control form-control-user" name="password" id="password"
        placeholder="{{ __('Password') }}" required>
</div>

<div class="form-group">
    <input type="password" class="form-control form-control-user" name="password_confirmation"
        placeholder="{{ __('Confirm Password') }}" required>
</div>
