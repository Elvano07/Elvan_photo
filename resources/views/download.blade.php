@extends('layout')

@section('title', 'Photo Preview')

@section('content')
<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='col-md-5'>
                <img src='/storage/{{ $photos->filelocation }}' class='img-responsive' title='preview' id='preview'>
                <br>
                <h4>{{$photos->title}}</h4>
                @php
                $tag    = explode(',', $photos->tag);
                @endphp
                <table>
                <tr><td width='25px'><span class='fa fa-map-marker'></span></td>    <td width='80px'><b>Location</b></td>   <td width='30px' class='text-center'>:</td>     <td>{{ $photos->location }}</td></tr>
                <tr><td width='25px'><span class='fa fa-list'></span></td>          <td width='80px'><b>Category</b></td>   <td width='30px' class='text-center'>:</td>     <td>{{ $photos->categories->name }}</td></tr>
                <tr><td width='25px'><span class='fa fa-tag'></span></td>           <td width='80px'><b>Tag</b></td>        <td width='30px' class='text-center'>:</td>     <td>@foreach($tag as $key => $value) <span class='label label-primary'>{{$value}}</span> @endforeach</td></tr>
                <tr><td width='25px'><span class='fa fa-calendar'></span></td>      <td width='80px'><b>Upload Date</b></td>   <td width='30px' class='text-center'>:</td>  <td>{{ $photos->created_at }}</td></tr>
                </table>
            </div>
            <div class='visible-xs'><br></div>
            <div class='col-md-7'>
                <label for='description'>Description</label>
                <p>{{$photos->description}}</p>
                <label>Downloaded Time : {{$photos->download}}</label>
                <br>
                <label for='description'>Exif</label>
                <p>{{ dump($exif) }}</p>
                <br>
                <form method='POST' autocomplete='off' action='{{ route("download") }}' id='downloadform' target='_new' onsubmit='setTimeout(function () {window.location.reload(); }, 10)'>
                {!! csrf_field() !!}
                <input type='hidden' value='{{$photos->id}}' name='id'>
                <button class='btn btn-primary' type='submit' id='download' name='download'><i class='fa fa-download'></i> &nbsp;&nbsp;Download</button>
                @if($auth->id == $photos->user_id)
                <a class='btn btn-danger' href='/photo/delete/{{ $photos->id }}'><i class='fa fa-trash'></i> &nbsp;&nbsp;Hapus</a>
                @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
$(document).ready(function() {

    $("#download").on("click", function() {
        location.reload();
    })

});
</script>
@endsection