@extends('guestlayout')

@section('content')
@if(session('status'))
    <center>
        <p>{{ session("status") }}</p>
        <a href='{{ route('signin') }}'>Back to Sign In.</a>
    </center>
@else
<style>
    /* .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    .btn-circle.btn-lg {
        width: 50px;
        height: 50px;
        padding: 13px 13px;
        font-size: 18px;
        line-height: 1.33;
        border-radius: 25px;
    } */
</style>
<p class="login-box-msg">Sign Up to create an account.</p>

<form action="{{ route('signup') }}" method="post">
    <div class="form-group has-feedback @if ($errors->register->first('email')) has-error @endif">
        @if ($errors->register->first('email'))
            <label class="control-label" for="email"><i class="fa fa-times-circle-o"></i> {{ $errors->register->first('email') }}</label>
        @endif
        <input type="text" class="form-control" placeholder="Email..." maxlength='254' name='email' value="{{ old('email') }}">
        <span class="fa fa-envelope form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback @if ($errors->register->first('username')) has-error @endif">
        @if ($errors->register->first('username'))
            <label class="control-label" for="username"><i class="fa fa-times-circle-o"></i> {{ $errors->register->first('username') }}</label>
        @endif
        <input type="text" class="form-control" placeholder="Username..." maxlength='254' name='username' value="{{ old('username') }}">
        <span class="fa fa-user form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback @if ($errors->register->first('password')) has-error @endif">
        @if ($errors->register->first('password'))
            <label class="control-label" for="password"><i class="fa fa-times-circle-o"></i> {{ $errors->register->first('password') }}</label>
        @endif
        <input type="password" class="form-control" placeholder="Password..." maxlength='32' name='password' value="{{ old('fullname') }}">
        <span class="fa fa-lock form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback @if ($errors->register->first('fullname')) has-error @endif">
        @if ($errors->register->first('fullname'))
            <label class="control-label" for="fullname"><i class="fa fa-times-circle-o"></i> {{ $errors->register->first('fullname') }}</label>
        @endif
        <input type="text" class="form-control" placeholder="Full Name..." maxlength='254' name='fullname' value="{{ old('fullname') }}">
        <span class="fa fa-id-card form-control-feedback"></span>
    </div>

    <div class="form-group">
        @if ($errors->register->first('gender'))
            <label style='color: #dd4b39;'><i class="fa fa-times-circle-o"></i> {{ $errors->register->first('gender') }}</label>
            <br>
        @endif
        <label for='gender'>Gender</label>
        <br>
        <div data-toggle="buttons">
            <label class="btn btn-info btn-circle active"><input type="radio" name="gender" value="Male" checked><i class="fa fa-male"></i></label>
            <label class="btn btn-info btn-circle">       <input type="radio" name="gender" value="Female"><i class="fa fa-female"></i></label>
            &nbsp;&nbsp;&nbsp;&nbsp; <span id='radio-value'>Male</span>
        </div>
    </div>

    {!! csrf_field() !!}

    <div class="row">
        <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
        </div>
    </div> 
    <br>
    <p><a href='{{ route('signin') }}'>Already have an account? Sign In.</a></p>
</form>
@endsection

@section('js')
<script>
$(document).ready(function() {
    $('input[type=radio][name=gender]').change(function() {
        console.log("A");
        $("#radio-value").html($(this).val());
    });
});
</script>
@endif
@endsection