@extends('layouts.blog')

@section('title')
    Category {{ $category->name }}
@endsection

@section('header')
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Blog 007 !!!</h1>

        </div>
    </div>
</header>
@endsection

@section('content')
<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            {{-- <div class="card mb-4">
                <a href="#!"><img class="card-img-top" src="{{asset('uploads/'.$post->image)}}" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">January 1, 2021</div>
                    <h2 class="card-title">{{$post->title}}</h2>
                    <p class="card-text">{{$post->description}}</p>
                    <a class="btn btn-primary btn-sm" href="{{ route('blog.show', $post->id) }}">Read more →</a>
                </div>
            </div> --}}
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                @forelse ($posts as $post)
                <div class="col-lg-6">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="{{ route('blog.show', $post->id) }}"><img class="card-img-top" src="{{ asset('uploads/'.$post->image) }}" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted">January 1, 2021</div>
                            <h2 class="card-title h4">{{$post->title}}</h2>
                            <p class="card-text">{{$post->description}}</p>
                            <a class="btn btn-primary btn-sm" href="{{ route('blog.show', $post->id) }}">Read more →</a>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center">
                        No result found for <strong>{{ request()->query('search') }}</strong>
                </p>
                @endforelse
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                <hr class="my-0" />
                <ul class="pagination justify-content-center my-4">
                   {{$posts->appends(['search' => request()->query('search')])->links()}}
                </ul>
            </nav>
        </div>
        <!-- Side widgets-->
        @include('partials.sidebar')
    </div>
</div>
@endsection


