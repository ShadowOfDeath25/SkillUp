@extends("layouts.master")
@section("title","Edit Course")
@section('styles')
    <link rel="stylesheet" href="{{asset("css/videoUpload.css")}}">
@endsection
@section("content")
    <section class="course-upload">
        <form action="{{route("course.update",['course'=>$course])}}" class="upload-form" method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-left">
                    <label for="author">Course Author</label>
                    <input type="text" name="author" id="author" class="text" value="{{$course->author->email}}"
                           placeholder="author@mail.com">
                    <label for="category">Course Category</label>
                    <input type="text" class="text" name="category" value="{{$course->category}}" id="category">
                    <label for="title">Course Title</label>
                    <input type="text" class="text" name="title" value="{{$course->title}}" id="title">
                    <label for="price">Course Price</label>
                    <input type="text" class="text" value="{{$course->price}}" name="price" placeholder id="price">
                </div>
                <div class="form-right">
                    <label for="time">Course Time</label>
                    <input type="text" class="text" value="{{$course->time}}" name="time" placeholder="Time in hours"
                           id="time">
                    <div class="descriptions">
                        <div class="description">
                            <label for="description">Description</label>
                            <textarea name="description"
                                      placeholder="A detailed description about the course"
                                      id="description">{{$course->description}}</textarea>
                        </div>
                        <div class="description">
                            <label for="brief">Brief</label>
                            <textarea name="brief" id="brief"
                                      placeholder="A brief description about the course">{{$course->brief}}</textarea>
                        </div>
                    </div>
                    <div class="buttons">
                        <label>Add Videos:</label>
                        <input type="file" class="uploader" id="video" name="videos[]" accept="video/*" multiple>
                        <label>Change Thumbnail:</label>
                        <input type="file" class="uploader" id="thumb" name="thumb" accept="image/*">
                    </div>
                </div>
            </div>
            @include("layouts.components._errors")
            <div class="confirm">
                <button type="submit" class="confirm-btn">Confirm</button>
                <button type="button" onclick="confirmDelete()" class="delete-btn">Delete Course</button>
            </div>
        </form>
        <form id="deleteForm" name="deleteForm" action="{{route('course.delete')}}" method="POST"
              style="display: none;">
            @csrf
            <input type="text" name="course" value="{{$course->id}}" hidden>
        </form>
        <script>
            function confirmDelete() {
                if (confirm('Are you sure you want to delete this course?')) {
                    var x = document.getElementById('deleteForm');
                    x.submit();
                }
            }
        </script>
    </section>
@endsection
