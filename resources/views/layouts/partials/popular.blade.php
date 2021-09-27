<div class="sidebar-box ftco-animate">
    <h3 class="sidebar-heading">Latest Articles</h3>
    @forelse ($posts as $post)
        <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url({{ asset(Storage::url($post->image)) }});"></a>
            <div class="text">
                <h3 class="heading"><a href="#">{{ $post->title }}</a></h3>
                <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span>
                            {{ date('F j, Y', strtotime($post->updated_at)) }}</a></div>
                    <div><a href="#"><span class="icon-person"></span> {{ $post->user->name }}</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                </div>
            </div>
        </div>
    @empty
        <h1>No Popular Post</h1>
    @endforelse
</div>
