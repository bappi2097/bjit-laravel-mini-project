@extends('layouts.app')
@section('title', 'Edit Profile | Blog')
@section('content')
    <div class="col-md-8">
        <div class="comment-form-wrap pt-5">
            <h3 class="mb-5">Profile</h3>
            <form action="{{ route('profile.update') }}" method="POST" class="p-3 p-md-5 bg-light"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address *</label>
                    <textarea class="form-control" id="address" name="address">{{ $user->profile->address }}</textarea>
                    @error('address')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea class="form-control" id="bio" name="bio">{!! $user->profile->bio !!}</textarea>
                    @error('bio')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="img_div">
                    <button type="button" class="img_btn">
                        <img id="user_img" class="show_img"
                            src="{{ asset($user->profile->image ?? 'template/images/placeholder.svg') }}" alt="Dummy" />
                    </button>
                    <input name="image" id="img_input" class="img_input" type="file" accept="image/*" />
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" value="Update Profile" class="btn py-3 mt-4 px-4 btn-primary">
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

            document.querySelector('#img_input').addEventListener('input', (input) => {
                if (input.target.files && input.target.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#user_img')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.target.files[0]);
                }
            });
            $('#bio').summernote({
                tabsize: 2,
                height: 300
            });
        }())
    </script>
@endpush
