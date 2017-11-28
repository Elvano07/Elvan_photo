@extends('layout')

@section('title', 'Edit Profile')

@section('content')
<div class='col-md-12'>
    <div class="box">
        <div class="box-body">
            <div class='col-md-3'>
                <ul class='nav nav-stacked'>
                    <li class="active"><a href="#pp" data-toggle='tab'>Profile Picture</a></li>
                    <li><a href="#info" data-toggle='tab'>Account Info</a></li>
                    <li><a href="#pass" data-toggle='tab'>Change Password</a></li>
                </ul>

                
            </div>
            <div class='col-md-9 tab-content'>
                <br>
                <div class='tab-pane active' id='pp'>
                    <div class='col-md-12'>
                        <h4>Update Profile Picture</h4>
                        <hr>
                        <img class='profile-user-img img-responsive img-circle' src='/storage/{{ $auth->photo }}' style='height: 100px; width: 100px;'>
                        <br>
                        <br>
                        <form action='/profile/edit/photo' method='POST' autocomplete='off' enctype='multipart/form-data'>
                        {!! csrf_field() !!}
                        <div class='form-group col-md-12 @if ($errors->pp->first('photo') || $errors->pp->first('image')) has-error @endif'>
                            <label for='photo'>Pilih Photo</label>
                            @if ($errors->pp->first('photo') || $errors->pp->first('image'))
                            <br>
                            <label class="control-label" for="photo"><i class="fa fa-times-circle-o"></i> {{ $errors->pp->first('photo') }} {{ $errors->pp->first('image') }}</label>
                            @endif
                            <input type='file' class='form-control' name='photo' id='photo' placeholder='Photo...' onchange="loadFile(event)" value='{{old('photo')}}'>
                            <span class="help-block"></span>
                        </div>

                        <div class='form-group'>
                            <button class='btn btn-primary' type='submit' name='profile'>Upload</button> <button class='btn btn-default' type='reset' name='reset'>Reset</button>
                        </div>
                        </form>
                    </div>    
                </div>
                <div class='tab-pane' id='info'>
                    <h4>Update Account Information</h4>
                    <hr>

                    <form action='/profile/edit/information' method='POST' autocomplete='off'>

                        {!! csrf_field() !!}

                        <div class='form-group col-md-12 @if ($errors->info->first('username')) has-error @endif'>
                            <label for='username'>Username</label>
                            @if ($errors->info->first('username'))
                            <br>
                            <label class="control-label" for="username"><i class="fa fa-times-circle-o"></i> {{ $errors->info->first('username') }}</label>
                            @endif
                            <input type='text' class='form-control' name='username' id='username' placeholder='Username...' value='{{ $auth->username }}'>
                            <span class="help-block"></span>
                        </div>

                        <br>

                        <div class='form-group col-md-12 @if ($errors->info->first('email')) has-error @endif'>
                            <label for='email'>Email</label>
                            @if ($errors->info->first('email'))
                            <br>
                            <label class="control-label" for="email"><i class="fa fa-times-circle-o"></i> {{ $errors->info->first('email') }}</label>
                            @endif
                            <input type='text' class='form-control' name='email' id='email' placeholder='Email...' value='{{ $auth->email }}'>
                            <span class="help-block"></span>
                        </div>

                        <br>

                        <div class='form-group col-md-12 @if ($errors->info->first('gender')) has-error @endif'>
                            <label for='gender'>Gender</label>
                            @if ($errors->info->first('gender'))
                            <br>
                            <label class="control-label" for="gender"><i class="fa fa-times-circle-o"></i> {{ $errors->info->first('gender') }}</label>
                            @endif
                            <select class='form-control' name='gender' id='gender'>
                                <option value="Male" @if($auth->gender == "Male") selected @endif>Male</option>
                                <option value="Female" @if($auth->gender == "Female") selected @endif>Female</option>
                            </select>
                            <span class="help-block"></span>
                        </div>

                        <br>

                        <div class='form-group col-md-12 @if ($errors->info->first('fullname')) has-error @endif'>
                            <label for='fullname'>Fullname</label>
                            @if ($errors->info->first('fullname'))
                            <br>
                            <label class="control-label" for="fullname"><i class="fa fa-times-circle-o"></i> {{ $errors->info->first('fullname') }}</label>
                            @endif
                            <input type='text' class='form-control' name='fullname' id='fullname' placeholder='Fullname...' value='{{ $auth->fullname }}'>
                            <span class="help-block"></span>
                        </div>

                        <div class='form-group col-md-12 @if ($errors->info->first('description')) has-error @endif'>
                            <label for='description'>Description</label>
                            @if ($errors->info->first('description'))
                            <br>
                            <label class="control-label" for="description"><i class="fa fa-times-circle-o"></i> {{ $errors->info->first('description') }}</label>
                            @endif
                            <textarea class='form-control' name='description' id='description' placeholder='Description...' style='resize: none; height: 300px' maxlength='255'>{{ $auth->description }}</textarea>
                            <span class="help-block"></span>
                        </div>

                        <div class='form-group'>
                            <button class='btn btn-primary' type='submit' name='update'>update</button> <button class='btn btn-default' type='reset' name='reset'>Reset</button>
                        </div>

                    </form>
                </div>
                <div class='tab-pane' id='pass'>
                    <h4>Change Password</h4>
                    <hr>
                    <form action='/profile/edit/pass' method='POST' autocomplete='off'>
                        {!! csrf_field() !!}
                        <div class='form-group col-md-12 @if ($errors->pass->first('oldpass')) has-error @endif'>
                            <label for='oldpass'>Password Lama</label>
                            @if ($errors->pass->first('oldpass'))
                            <br>
                            <label class="control-label" for="oldpass"><i class="fa fa-times-circle-o"></i> {{ $errors->pass->first('oldpass') }}</label>
                            @endif
                            <input type='password' class='form-control' name='oldpass' id='oldpass' placeholder='Password Lama...'>
                            <span class="help-block"></span>
                        </div>

                        <br>

                        <div class='form-group col-md-12 @if ($errors->pass->first('newpass')) has-error @endif'>
                            <label for='newpass'>Password Baru</label>
                            @if ($errors->pass->first('newpass'))
                            <br>
                            <label class="control-label" for="newpass"><i class="fa fa-times-circle-o"></i> {{ $errors->pass->first('newpass') }}</label>
                            @endif
                            <input type='password' class='form-control' name='newpass' id='newpass' placeholder='Password Baru...'>
                            <span class="help-block"></span>
                        </div>

                        <br>

                        <div class='form-group col-md-12 @if ($errors->pass->first('retype')) has-error @endif'>
                            <label for='retype'>Ketik Ulang Password Baru</label>
                            @if ($errors->pass->first('retype'))
                            <br>
                            <label class="control-label" for="retype"><i class="fa fa-times-circle-o"></i> {{ $errors->pass->first('retype') }}</label>
                            @endif
                            <input type='password' class='form-control' name='retype' id='retype' placeholder='Ketik Ulang Password Baru...'>
                            <span class="help-block"></span>
                        </div>

                        <br>

                        <div class='form-group'>
                            <button class='btn btn-primary' type='submit' name='update'>Update</button> <button class='btn btn-default' type='reset' name='reset'>Reset</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
/*@if (session('status'))*/
    swal({
        title   : '',
        text    : '{{ session("status") }}',
        type    : 'success'
    });
/*@endif*/

$(document).ready(function() {

@if($errors->pp->any())
    $('.nav-stacked a[href="#pp"]').tab('show');
@elseif($errors->info->any())
    $('.nav-stacked a[href="#info"]').tab('show');
@elseif($errors->pass->any())
    $('.nav-stacked a[href="#pass"]').tab('show');
@endif

});
</script>
@endsection