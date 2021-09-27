@extends('layouts.app')
@section('title', 'Create Post | Blog')
@section('content')
    <div class="col-md-8">
        <div class="comment-form-wrap pt-5">
            <h3 class="mb-5">Post</h3>
            <form action="{{ route('post.store') }}" method="POST" class="p-3 p-md-5 bg-light"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" class="form-control" id="title" name="title">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug">Slug *</label>
                    <input type="text" class="form-control" id="slug" name="slug">
                    @error('slug')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="summery">Summery *</label>
                    <textarea class="form-control" id="summery" name="summery"></textarea>
                    @error('summery')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="">
                    <label for=" Category">
                    Category
                    <span class="text-danger"> (Use CTRL for multiple select) </span>
                    </label>
                    <select class="form-control" id="Category" name="category[]" multiple
                        style="height: 200px !important">
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}" style="border-bottom: 1px solid black;">
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="summernote">Decription</label>
                    <textarea class="form-control" id="summernote" name="description"></textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="img_div">
                    <button type="button" class="img_btn">
                        <img id="post-img" class="show_img" src="{{ asset('template/images/placeholder.svg') }}"
                            alt="Dummy" />
                    </button>
                    <input name="image" id="img_input" class="img_input" type="file" accept="image/*" />
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" value="Add Post" class="btn py-3 mt-4 px-4 btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .note-toolbar {
            background: #f5f5f5 !important;
        }

    </style>
    <style>
        .img_div {
            position: relative;
            width: 150px;
            height: 150px;
            display: block;
            z-index: 0;
        }

        .img_btn {
            width: 100%;
            height: 100%;
            border: 1px solid #b0d5ff;
        }

        .img_btn .show_img {
            width: 100%;
            height: 100%;
        }

        .img_input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            width: 150px;
            height: 150px;
        }

    </style>
@endpush
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        (function() {
            document.querySelector('#title').addEventListener('input', (event) => {
                let name = event.target.value;
                if (name) {
                    document.querySelector('#slug').value = name.replace(/[^a-zA-Z0-9 -]/g, "").toLowerCase()
                        .split(" ").join(
                            '-');
                } else {
                    document.querySelector('#slug').value = "";
                }
            });

            document.querySelector('#img_input').addEventListener('input', (input) => {
                if (input.target.files && input.target.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#post-img')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.target.files[0]);
                }
            });
            $('#summernote').summernote({
                tabsize: 2,
                height: 300
            });
        }())
    </script>
@endpush
