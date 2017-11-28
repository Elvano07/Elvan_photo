@extends('layout')
@section('title', 'Upload')

<!--Dropzone-->
<link rel="stylesheet" href="dist/dropzone.css" type="text/css" />

@section('content')
<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-12'>
            <div class="box">
                <div class="box-body">
                    <div class="image_upload_div">
                        <form action="/upload" class="dropzone" id="my-awesome-dropzone">
                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                    <a href="adddesc"><button type="button" id="btn-add-desc" class='btn btn-primary'>Add Description</button></a>
                    <!-- <div class='col-md-5'>
                        <h4>Photo Preview</h4>
                        <br>
                        <img src='{{ asset("img/whitescreen.jpg") }}' class='img-responsive' title='preview' id='preview'>
                    </div>
                    <div class='visible-xs'><br></div>
                    <div class='col-md-7'>
                        <form action='' method='post' enctype='multipart/form-data'>
                            <div class='form-group col-md-12 @if ($errors->upload->first('title')) has-error @endif'>
                                <label for='title'>Title</label>
                                @if ($errors->upload->first('title'))
                                <br>
                                <label class="control-label" for="title"><i class="fa fa-times-circle-o"></i> {{ $errors->upload->first('title') }}</label>
                                @endif
                                <input type='text' class='form-control' name='title' id='title' placeholder='Title...' value='{{old('title')}}'>
                                <span class="help-block"></span>
                            </div>
                            <div class='form-group col-md-12 @if ($errors->upload->first('location')) has-error @endif'>
                                <label for='location'>Location</label>
                                @if ($errors->upload->first('location'))
                                <br>
                                <label class="control-label" for="location"><i class="fa fa-times-circle-o"></i> {{ $errors->upload->first('location') }}</label>
                                @endif
                                <input type='text' class='form-control' name='location' id='location' placeholder='Location...' value='{{old('location')}}'>
                                <span class="help-block"></span>
                            </div>
                            <div class='form-group col-md-12 @if ($errors->upload->first('category')) has-error @endif'>
                                <label for='category'>Category</label>
                                @if ($errors->upload->first('category'))
                                <br>
                                <label class="control-label" for="category"><i class="fa fa-times-circle-o"></i> {{ $errors->upload->first('category') }}</label>
                                @endif
                                <select class='form-control' name='category' id='category'>
                                    @foreach($categories as $key => $rows)
                                        <option value="{{ $rows->id }}" @if(old('category') == $rows->id) selected @endif>{{ $rows->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <div class='form-group col-md-12 @if ($errors->upload->first('tag')) has-error @endif'>
                                <label for='tag'>Tag</label>
                                @if ($errors->upload->first('tag'))
                                <br>
                                <label class="control-label" for="tag"><i class="fa fa-times-circle-o"></i> {{ $errors->upload->first('tag') }}</label>
                                @endif
                                <textarea class='form-control' name='tag' id='tag' placeholder='Tag...' style='resize: none' maxlength='255'>{{old('tag')}}</textarea>
                                <span class="help-block">Pisahkan tag dengan koma, contoh: olahraga, bola, kehidupan</span>
                            </div>
                            <div class='form-group col-md-12 @if ($errors->upload->first('description')) has-error @endif'>
                                <label for='description'>Description</label>
                                @if ($errors->upload->first('description'))
                                <br>
                                <label class="control-label" for="description"><i class="fa fa-times-circle-o"></i> {{ $errors->upload->first('description') }}</label>
                                @endif
                                <textarea class='form-control' name='description' id='description' placeholder='Description...' style='resize: none; height: 300px' maxlength='255'>{{old('description')}}</textarea>
                                <span class="help-block"></span>
                            </div>
                            <div class='form-group col-md-12 @if ($errors->upload->first('photo') || $errors->upload->first('image')) has-error @endif'>
                                <label for='photo'>Pilih Photo</label>
                                @if ($errors->upload->first('photo') || $errors->upload->first('image'))
                                <br>
                                <label class="control-label" for="photo"><i class="fa fa-times-circle-o"></i> {{ $errors->upload->first('photo') }} {{ $errors->upload->first('image') }}</label>
                                @endif
                                <input type='file' class='form-control' name='photo' id='photo' placeholder='Photo...' onchange="loadFile(event)" value='{{old('photo')}}'>
                                <span class="help-block"></span>
                            </div>
                            {!! csrf_field() !!} 
                            <div class='form-group col-md-12'>
                                <button class='btn btn-primary' type='submit' name='upload'>Upload</button><button class='btn btn-default' type='reset' name='reset'>Reset</button>
                            </div>
                        </form> -->
                        <!-- <a href="adddesc"><button class='btn btn-primary' type='button' name='upload'>Add Description</button></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="dist/dropzone.js"></script>
<script>
    var loadFile = function(event) {
        var output = document.getElementById('preview');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
/*@if (session('status'))*/
    swal({
        title   : '',
        text    : '{{ session("status") }}',
        type    : 'success'
    });
/*@endif*/
    var token = $("#token").val();
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-awesome-dropzone", {
        url: "{{ route('upload') }}",
        params: {
            _token: token
        }
    });

    myDropzone.on("complete", function(){
        var count = myDropzone.files.length;
        count--;
        $(".imgs").remove();
        $(".photos").remove();
        $("form").prepend('<input type="hidden" class="imgs" name="img[]" value="'+myDropzone.files[count].name+'">');
    });

    // $("#btn-add-desc").click(function(){
    //     $("#my-awesome-dropzone").submit();
    // });
</script>
@endsection