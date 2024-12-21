@extends("layouts.master")
@section('title', "Course Play")
@section('styles')
    <link rel="stylesheet" href="{{asset("css/courseplay.css")}}">
@endsection
@section('content')
    <section class="main">
        <div class="main-video">
            <video id="main-video" controls>
                <source src="{{$videos[0]->path}}" type="video/mp4">
            </video>
            <div class="title" id="main-title">{{$videos[0]->title}}</div>
        </div>
        <div class="playlist">
            @foreach($videos as $video)
                <div class="playlist-item">
                    <a onclick="changeVideo('{{$video->path}}','{{$video->title}}')" class="video-link">

                        <video muted>
                            <source src="{{$video->path}}" type="video/mp4">
                        </video>
                        <div class="title">{{$video->title}}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
    <script>
        function changeVideo(videoPath, videoTitle) {
            var mainVideo = document.getElementById('main-video');
            var mainTitle = document.getElementById('main-title');
            mainVideo.src = videoPath;
            mainTitle.textContent = videoTitle;
            mainVideo.play();
        }
    </script>
@endsection
