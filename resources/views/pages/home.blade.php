@extends('layouts.app')
@section('content')
    <div class="col-xl-8 py-5 px-md-5">
        <div class="row pt-md-4">
            @foreach ($posts as $post)
                <div class="col-md-12">
                    <div class="blog-entry ftco-animate d-md-flex">
                        <a href="single.html" class="img img-2"
                            style="background-image: url({{ asset($post->image) }});"></a>
                        <div class="text text-2 pl-md-4">
                            <h3 class="mb-2"><a href="single.html">{{ $post->title }}</a></h3>
                            <div class="meta-wrap">
                                <p class="meta">
                                    <span><i
                                            class="icon-calendar mr-2"></i>{{ date('F j, Y', strtotime($post->updated_at)) }}</span>
                                    <span><i class="icon-comment2 mr-2"></i>5 Comment</span>
                                </p>
                            </div>
                            @foreach ($post->categories as $category)
                                <span><a href="single.html"><i
                                            class="icon-folder-o mr-2"></i>{{ $category->name }}</a></span>
                            @endforeach
                            <p class="mb-4">{!! $post->summery !!}</p>
                            <p class="row justify-content-between">
                                <a href="#" class="btn-custom">Read More <span class="ion-ios-arrow-forward"></span></a>
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-info">Edit</a>
                            </p>
                        </div>
                    </div>
                </div>
                {{-- @empty
                <h1>No Blog Available</h1> --}}
            @endforeach

        </div><!-- END-->
        <div class="row">
            <div class="col">
                <div class="block-27">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
