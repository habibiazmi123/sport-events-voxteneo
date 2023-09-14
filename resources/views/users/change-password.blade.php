@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change Password Users</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.change-password.update', $id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="oldPassword" class="col-md-4 col-form-label text-md-end">Old Password</label>

                            <div class="col-md-6">
                                <input id="oldPassword" type="text" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword" autocomplete="oldPassword" autofocus>

                                @error('oldPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="newPassword" class="col-md-4 col-form-label text-md-end">New Password</label>

                            <div class="col-md-6">
                                <input id="newPassword" type="text" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword" autocomplete="newPassword" autofocus>

                                @error('newPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="repeatPassword" class="col-md-4 col-form-label text-md-end">Repeat Password</label>

                            <div class="col-md-6">
                                <input id="repeatPassword" type="text" class="form-control @error('repeatPassword') is-invalid @enderror" name="repeatPassword" autocomplete="repeatPassword">

                                @error('repeatPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>

                                <a class="btn btn-link" href="{{ route('users.index') }}">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
