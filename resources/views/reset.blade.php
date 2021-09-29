@extends('layouts.master')

@section('title', 'Reset Password | Blog')

@section('master')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.reset-submit') }}">
                            <input type="hidden" name="access_token" value="{{ $token }}">

                            <div class="form-group row">
                                <label for="email" class="col-form-label ">{{ __('E-Mail Address') }}</label>

                                <div class="col">
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-form-label ">{{ __('Password') }}</label>

                                <div class="col">
                                    <input id="password" type="password" class="form-control" name="password" required
                                        autocomplete="new-password">


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-form-label ">{{ __('Confirm Password') }}</label>

                                <div class="col">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background-color: rgb(236, 236, 236);
        }

        .container {
            margin-top: 10%;
        }

        .card {
            box-shadow: 0px 0px 4px 0px gray;
        }

        .form-group {
            flex-direction: column;
            align-content: flex-start;
        }

    </style>
@endpush
