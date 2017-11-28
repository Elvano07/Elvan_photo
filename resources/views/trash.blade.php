@extends('layout')

@section('title', 'Trash')

@section('content')
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
                        <button class="info restore" value='{{ $value->id }}'>Restore</button>
                        <button class="info delete" value='{{ $value->id }}'><i class='fa fa-trash'></i> Delete</button>
                    </div>
                </div>
                
                <div class='row'>
                <div class='col-md-12'>
                    <h4>{{ $value->title }}</h4>
                    <p>{{ $value->description }}</p>
                    <hr>
                    @php
                        $tag = explode(',', $value->tag);
                    @endphp
                    <table>
                        <tr><td width='25px'><span class='fa fa-map-marker'></span></td>    <td width='80px'><b>Location</b></td>   <td width='30px' class='text-center'>:</td>     <td>{{ $value->location }}</td></tr>
                        <tr><td width='25px'><span class='fa fa-list'></span></td>          <td width='80px'><b>Category</b></td>   <td width='30px' class='text-center'>:</td>     <td>{{ $value->categories->name }}</td></tr>
                        <tr><td width='25px'><span class='fa fa-tag'></span></td>           <td width='80px'><b>Tag</b></td>        <td width='30px' class='text-center'>:</td>     <td>@foreach($tag as $key => $value2) <span class='label label-primary'>{{$value2}}</span> @endforeach</td></tr>
                        <tr><td width='25px'><span class='fa fa-calendar'></span></td>      <td width='80px'><b>Upload Date</b></td>   <td width='30px' class='text-center'>:</td>  <td>{{ $value->created_at }}</td></tr>
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

@section('javascript')
<script>
$(document).ready(function() {
    var id = 0;

    $(".delete").on("click", function() {
        id      = $(this).val();
        
        swal({
        title: "",
        text: "Hapus foto permanen?",
        type: "warning",
        html: true,
        showCancelButton: true,					
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        closeOnCancel: true
        },
        function(isConfirm){
            if(!isConfirm){
                return false;
            }

            swal({
                title : "",
                text : "Harap tunggu sebentar",
                type : "info",
                showCancelButton: false,
                showConfirmButton : false,
                allowEscapeKey:false
            });

            jQuery.ajax({
                url     : "{{ route('trash.delete') }}",
                data    : {id : id},
                method  : "POST",
                dataType : 'json',
                headers : {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                success : function(e){
                    if(e['error'] == 'true'){
                    swal({
                        title: e[0],
                        text: e[1],
                        type: e[2],
                        html: true,
                        showCancelButton: false,
                        allowEscapeKey:false
                    });    
                    return false;
                    }

                    swal({
                        title: e[0],
                        text: e[1],
                        type: e[2],
                        html: true,
                        showCancelButton: false,
                        allowEscapeKey:false
                    },
                    function(){
                        location.reload();
                    });
                }
            });
        });
    });

    $(".restore").on("click", function() {
        id      = $(this).val();

        swal({
        title: "",
        text: "Restore foto?",
        type: "warning",
        html: true,
        showCancelButton: true,					
        confirmButtonText: "Restore",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        closeOnCancel: true
        },
        function(isConfirm){
            if(!isConfirm){
                return false;
            }

            swal({
                title : "",
                text : "Harap tunggu sebentar",
                type : "info",
                showCancelButton: false,
                showConfirmButton : false,
                allowEscapeKey:false
            });

            jQuery.ajax({
                url     : "{{ route('trash.restore') }}",
                data    : {id : id},
                method  : "POST",
                dataType : 'json',
                headers : {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                success : function(e){
                    if(e['error'] == 'true'){
                    swal({
                        title: e[0],
                        text: e[1],
                        type: e[2],
                        html: true,
                        showCancelButton: false,
                        allowEscapeKey:false
                    });    
                    return false;
                    }

                    swal({
                        title: e[0],
                        text: e[1],
                        type: e[2],
                        html: true,
                        showCancelButton: false,
                        allowEscapeKey:false
                    },
                    function(){
                        location.reload();
                    });
                }
            });
        });
    });

})
</script>
@endsection