@extends('layouts.app')
@section('content')
    <div class="col-xl-8 py-5 px-md-5">
        <h1>{{ $category_name }}</h1>
        <div class="row pt-md-4">
            @forelse ($posts as $post)
                <div class="col-md-12">
                    <div class="blog-entry ftco-animate d-md-flex">
                        <a href="{{ route('post.show', $post->slug) }}" class="img img-2"
                            style="background-image: url({{ Storage::url($post->image) }});"></a>
                        <div class="text text-2 pl-md-4">
                            <h3 class="mb-2"><a
                                    href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h3>
                            <div class="meta-wrap">
                                <p class="meta">
                                    <span><i
                                            class="icon-calendar mr-2"></i>{{ date('F j, Y', strtotime($post->updated_at)) }}</span>
                                    <span><i class="icon-comment2 mr-2"></i>5 Comment</span>
                                </p>
                            </div>
                            @foreach ($post->categories as $category)
                                <span><a href="{{ route('category-posts', $category->slug) }}"><i
                                            class="icon-folder-o mr-2"></i>{{ $category->name }}</a></span>
                            @endforeach
                            <p class="mb-4">{!! $post->summery !!}</p>
                            <p class="row justify-content-between">
                                <a href="{{ route('post.show', $post->slug) }}" class="btn-custom">Read More <span
                                        class="ion-ios-arrow-forward"></span></a>
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-info">Edit</a>
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <h1>No Post Available</h1>
            @endforelse

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
