@extends('layout')

@section('title', 'Profile')

@section('content')
<div class='col-md-12'>
    <div class="box">
        <div class="box-body">
            <div class='col-md-3'>
                <img class='profile-user-img img-responsive img-circle' src='/storage/img/user/5LpZTSoakuTybx4xrqI0spvS7LK6zlV1WnADKVFE{{ $auth->photo }}' style='height: 250px; width: 800px;'>
            </div>
            <div class='col-md-9'>
                <h3 class="profile-username">
                    {{ $auth->username }}
                </h3>
                <h4 class="text-muted">{{ $auth->email }}</h4>
                <a class='btn btn-default btn-sm btn-flat' href='/profile/edit'>Ubah Profile</a>
                <a class='btn btn-default btn-sm btn-flat' href='/trash'><i class='fa fa-trash'></i> Trash</a>
                <hr>
                <p><b>{{ $auth->fullname }}</b> {{ $auth->description }}</p>
            </div>
        </div>
    </div>
</div>

@php
$counter = 0;
@endphp
<div class='container-fluid'>
@foreach($photos as $key => $value)
@if($counter % 3 == 0) <div class='row'> @endif
<div class='col-md-4 col-sm-6'>
    <div class="box box-default">
        <div class="box-body">
            <div class='hovereffect'>
                <img class='img-responsive' src='/storage/{{ $value->filelocation }}'>
                <div class="overlay">
                    <h2>Info</h2>
                    <a class="info" style='cursor: pointer' href="photo/{{$value->id}}">Click here</a>
                </div>
            </div>
            
            <div class='row'>
            <div class='col-md-12'>
                <h4>{{ $value->title }}</h4>
               <!-- <p>{{ $value->description }}</p>-->
                <hr>
                @php
                    $tag = explode(',', $value->tag);
                @endphp
                <table>
                  <!--  <tr><td width='25px'><span class='fa fa-map-marker'></span></td>    <td width='80px'><b>Location</b></td>   <td width='30px' class='text-center'>:</td>     <td>{{ $value->location }}</td></tr>
                    <tr><td width='25px'><span class='fa fa-list'></span></td>          <td width='80px'><b>Category</b></td>   <td width='30px' class='text-center'>:</td>     <td>{{ $value->categories->name }}</td></tr>
                    <tr><td width='25px'><span class='fa fa-tag'></span></td>           <td width='80px'><b>Tag</b></td>        <td width='30px' class='text-center'>:</td>     <td>@foreach($tag as $key => $value2) <span class='label label-primary'>{{$value2}}</span> @endforeach</td></tr>
                    --><tr><td width='25px'><span class='fa fa-calendar'></span></td>      <td width='80px'><b>Upload Date</b></td>   <td width='30px' class='text-center'>:</td>  <td>{{ $value->created_at }}</td></tr>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
@if($counter % 3 == 2) </div> @endif
@php
$counter++;
@endphp
@endforeach
</div>
@endsection