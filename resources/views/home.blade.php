@extends('layout')

@section('title', 'Home')

@section('content')
    <div class='container-fluid'>
    
    @foreach($photos as $key0 => $value0)
    @foreach($value0 as $key1 => $value1)
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
                                    <img class='img-responsive' src='/storage/{{ $value2->filelocation }}'>
                                    <div class="overlay">
                                        <h2>Info</h2>
                                        <a class="info" style='cursor: pointer' href="photo/{{$value2->id}}">Click here</a>
                                    </div>
                                </div>
                                
                                <div class='row'>
                                <div class='col-md-12'>
                                    <h4>{{ $value2->title }}</h4>
                                    <!-- <p>{{ $value2->description }}</p> -->
                                    <hr>
                                    @php
                                         $tag = explode(',', $value2->tag); 
                                    @endphp
                                    <table>
                                        <!-- <tr><td width='25px'><span class='fa fa-map-marker'></span></td>    <td width='80px'><b>Location</b></td>   <td width='30px' class='text-center'>:</td>     <td>{{ $value2->location }}</td></tr>
                                        <tr><td width='25px'><span class='fa fa-list'></span></td>          <td width='80px'><b>Category</b></td>   <td width='30px' class='text-center'>:</td>     <td>{{ $value2->categories->name }}</td></tr>
                                        <tr><td width='25px'><span class='fa fa-tag'></span></td>           <td width='80px'><b>Tag</b></td>        <td width='30px' class='text-center'>:</td>     <td>@foreach($tag as $key3 => $value3) <span class='label label-primary'>{{$value3}}</span> @endforeach</td></tr> -->
                                        <tr><td width='25px'><span class='fa fa-calendar'></span></td>      <td width='80px'><b>Upload Date</b></td>   <td width='30px' class='text-center'>:</td>  <td>{{ $value2->created_at }}</td></tr>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($counter % 3 == 2 || $value2 == end($value1)) </div> @endif
                    @php
                    $counter++;
                    @endphp
                    
                @endforeach
            </div>
        </div>
    @endforeach
    @endforeach

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