@extends('layouts.app')
@section('content')

    <div class="col-lg-8 px-md-5 py-5">
        <div class="pt-md-4">
            <h1 class="mb-3">{{ $post->title }}</h1>
            <p>{{ $post->summery }}</p>
            <p>
                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="img-fluid">
            </p>
            {!! $post->description !!}
            <div class="tag-widget post-tag-container mb-5 mt-5">
                <div class="tagcloud">
                    @foreach ($post->categories as $category)
                        <a href="{{ route('category-posts', $category->slug) }}"
                            class="tag-cloud-link">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="pt-5 mt-5">
                <h3 class="mb-5 font-weight-bold">6 Comments</h3>
                <ul class="comment-list">
                    <li class="comment">
                        <div class="vcard bio">
                            <img src="images/person_1.jpg" alt="Image placeholder">
                        </div>
                        <div class="comment-body">
                            <h3>John Doe</h3>
                            <div class="meta">October 03, 2018 at 2:21pm</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum
                                necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste
                                iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                            <p><a href="#" class="reply">Reply</a></p>
                        </div>
                    </li>
                </ul>
                <!-- END comment-list -->

                <div class="comment-form-wrap pt-5">
                    <h3 class="mb-5">Leave a comment</h3>
                    <form action="#" class="p-3 p-md-5 bg-light">

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- END-->
    </div>
@endsection
