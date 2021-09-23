@extends('layouts.app')
@section('title', 'Category | Blog')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Category</h3>
                <form action="{{ route('category.update', $category->id) }}" method="POST" class="p-3 p-md-5 bg-light">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug *</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ $category->slug }}">
                        <div class="form-group">
                            <input type="submit" value="Add Category" class="btn py-3 mt-4 px-4 btn-primary">
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        (function() {
            document.querySelector('#name').addEventListener('input', (event) => {
                let name = event.target.value;
                if (name) {
                    document.querySelector('#slug').value = name.replace(/[^a-zA-Z0-9 -]/g, "").toLowerCase()
                        .split(" ").join(
                            '-');
                } else {
                    document.querySelector('#slug').value = "";
                }
            })
        }())
    </script>
@endpush
