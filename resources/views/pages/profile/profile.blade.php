@extends('layouts.app')
@section('content')
    <div class="col-md-8">
        <div class="row">

            <div class="col-md-6 d-flex">
                <div class="img w-100"
                    style="background-image:url({{ asset(Storage::url($user->profile->image)) }});">
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="text px-4 pt-5 pt-md-0 px-md-4 pr-md-5 ftco-animate">
                    <h2 class="mb-4">I'm <span>{{ $user->name }}</span> a Blogger &amp;
                        Explorer</h2>
                    <p>{!! $user->profile->bio !!}</p>
                </div>
            </div>
        </div>
        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary mt-3">Edit Profile</a>
    </div>
@endsection
