@extends('layouts.master')
@section('title',"Upload Course")
@section('styles')
    <link rel="stylesheet" href="{{asset("css/videoUpload.css")}}"
@endsection
@section('content')
    <section class="course-upload">
        <form action="{{route("upload")}}" class="upload-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-left">
                    <label for="author">Course Author</label>
                    <input type="text" name="author" id="author" class="text" placeholder="author@mail.com">
                    <label for="category">Course Category</label>
                    <input type="text" class="text" name="category" id="category">
                    <label for="title">Course Title</label>
                    <input type="text" class="text" name="title" id="title">
                    <label for="price">Course Price</label>
                    <input type="text" class="text" name="price" placeholder id="price">
                </div>
                <div class="form-right">
                    <label for="time">Course Time</label>
                    <input type="text" class="text" name="time" placeholder="Time in hours" id="time">
                    <div class="descriptions">
                        <div class="description">
                            <label for="description">Description</label>
                            <textarea name="description"
                                      placeholder="A detailed description about the course"
                                      id="description"></textarea>
                        </div>
                        <div class="description">
                            <label for="brief">Brief</label>
                            <textarea name="brief" id="brief"
                                      placeholder="A brief description about the course"></textarea>
                        </div>
                    </div>
                    <div class="buttons">
                        <label>Choose Videos:</label>
                        <input type="file" class="uploader" id="video" name="videos[]" accept="video/*" multiple>
                        <label>Choose a Thumbnail</label>
                        <input type="file" class="uploader" id="thumb" name="thumb" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="errors">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="errors">
                        <i class="fa-solid fa-circle-exclamation"> error</i>

                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="confirm">
                <button type="submit" class="confirm-btn">Confirm</button>
            </div>
        </form>
    </section>
@endsection
