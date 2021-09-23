<div class="sidebar-box ftco-animate">
    <h3 class="sidebar-heading">Categories</h3>
    <ul class="categories">
        @foreach (\App\Category::withCount('posts')->get() as $item)
            <li><a href="#">{{ $item->name }} <span>({{ $item->posts_count }})</span></a></li>
        @endforeach
    </ul>
</div>
