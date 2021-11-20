@extends('layouts.blog')

@section('title')
    {{ $post->title }}
@endsection

@section('header')

@endsection

@section('content')
<div class="container">
    <div class="row my-5">
        <!-- Blog entries-->
        <div class="col-lg-8 ">
            <!-- Featured blog post-->
            <div class="card mb-4">
                <a href="#!"><img class="card-img-top" src="{{asset('uploads/'.$post->image)}}" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">By {{ $post->user->name}}</span></div>
                    <h2 class="card-title">{{$post->title}}</h2>
                    <p class="card-text">{{$post->description}}</p>
                    <p class="card-text">{!!$post->content!!}</p>
                    <div class="row">
                        <hr>
                        <div class="col-md-6">
                            <div class="addthis_inline_share_toolbox"></div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-between">
                            @foreach ($post->tags as $tag)
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="{{route('blog.tag', $tag->id)}}" class="btn btn-sm btn-dark" style="text-decoration: none">{{$tag->name}}</a></li>
                                    </ul>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Side widgets-->
        @include('partials.sidebar')
    </div>
    <div class="row">
        <div class="col-md-8">
            <div id="disqus_thread"></div>
            <script>
                /**
                *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                /*
                */
                var disqus_config = function () {
                this.page.url = "{{ config('app.url')}}/blog/posts/{{ $post->id }}";  // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = "{{$post->id}}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };

                (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                s.src = 'https://unique-blog.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>


        </div>
    </div>


</div>
@endsection
