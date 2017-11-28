@extends('layout')

@section('title', 'Home')

@section('content')
    <div class='container-fluid'>
    {{-- @foreach($photos as $key0 => $value0) --}}

   {{-- @foreach($value0 as $key1 => $value1)
    <div class='row'>
            <div class='col-md-12'>
                <h4>{{ $bulan[$key0][$key1]['bulan'] }} {{ $bulan[$key0]['tahun'] }}</h4>
                @php
                $counter = 0;
                @endphp

                @foreach($value1 as $key2 => $value2)
                    @if($counter % 3 == 0) <div class='row'> @endif
                    
                    <div class='col-md-4 col-sm-6'>
                        <div class="box box-default">
                            <div class="box-body">
                                <div class='hovereffect'>
                                    <img class='img-responsive' src='/storage/{{ $photo->filelocation }}'>
                                    <div class="overlay">
                                        <h2>Info</h2>
                                        <a class="info" style='cursor: pointer' href="photo/{{ $photo->id }}">Click here</a>
                                    </div>
                                </div>
                                
                                <div class='row'>
                                <div class='col-md-12'>
                                    <h4>{{ $photo->title }}</h4>
                                    <p>{{ $photo->description }}</p>
                                    <hr>
                                    @php
                                         $tag = explode(',', $photo->tag); 
                                    @endphp
                                    <table>
                                        <tr><td width='25px'><span class='fa fa-map-marker'></span></td>    <td width='80px'><b>Location</b></td>   <td width='30px' class='text-center'>:</td>     <td>{{ $photo->location }}</td></tr>
                                        <tr><td width='25px'><span class='fa fa-list'></span></td>          <td width='80px'><b>Category</b></td>   <td width='30px' class='text-center'>:</td>     <td>{{ $photo->categories->name }}</td></tr>
                                        <tr><td width='25px'><span class='fa fa-tag'></span></td>           <td width='80px'><b>Tag</b></td>        <td width='30px' class='text-center'>:</td>     <td>@foreach($tag as $key3 => $value3) <span class='label label-primary'>{{$value3}}</span> @endforeach</td></tr>
                                        <tr><td width='25px'><span class='fa fa-calendar'></span></td>      <td width='80px'><b>Upload Date</b></td>   <td width='30px' class='text-center'>:</td>  <td>{{ $photo->created_at }}</td></tr>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($counter % 3 == 2 || $photo == end($value1)) </div> @endif
                    @php
                    $counter++;
                    @endphp
                    
                @endforeach
            </div>
        </div>
    @endforeach --}}

    <div class='row'>
        <div class='col-md-12'>
            <!-- <h4>$bulan[$key0][$key1]['bulan'] $bulan[$key0]['tahun']</h4> -->
                <div class='row'>
                    @foreach($photo as $photo)                 
                        <div class='col-md-4 col-sm-6' style="height: 430px; box-sizing: border-box; margin: 10px 0;">
                            <div class="box box-default">
                                <div class="box-body">
                                    <div class='hovereffect'>
                                        <img class='img-responsive' src="/storage/{{ $photo->filelocation }}" style="height: 200px">
                                        <div class="overlay">
                                            <h2>Info</h2>
                                            <a class="info" style='cursor: pointer' href="photo/{{ $photo->id }}">Click here</a>
                                        </div>
                                    </div>
                                    
                                    <div class='row'>
                                        <div class="box-body">
                                            <div class='col-md-12' style="height: 200px;">
                                                <h4>{{ $photo->title }}</h4>
                                              <!--  <p>{{ $photo->description }}</p>-->
                                                <hr>
                                                <table>
                                                  <!--  <tr>
                                                        <td width='25px'><span class='fa fa-map-marker'></span></td>
                                                        <td width='80px'><b>Location</b></td>
                                                        <td width='30px' class='text-center'>:</td>
                                                        <td>{{ $photo->location }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width='25px'><span class='fa fa-list'></span></td>
                                                        <td width='80px'><b>Category</b></td>
                                                        <td width='30px' class='text-center'>:</td>
                                                        <td>{{ $photo->categories_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width='25px'><span class='fa fa-tag'></span></td>
                                                        <td width='80px'><b>Tag</b></td>
                                                        <td width='30px' class='text-center'>:</td>
                                                        <td><span class='label label-primary'>{{ $photo->tag }}</span></td>
                                                    </tr>-->
                                                    <tr>
                                                        <td width='25px'><span class='fa fa-calendar'></span></td>
                                                        <td width='80px'><b>Upload Date</b></td>
                                                        <td width='30px' class='text-center'>:</td>
                                                        <td>{{ $photo->created_at }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@if(session('status'))
<script>
$(document).ready(function(){
    swal("", "{{session('status')}}", "success");
});
</script>
@endif
@endsection