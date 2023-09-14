@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile Users</div>

                <div class="card-body">

                    @if ($results["id"] == currentUser()["id"])
                        <div class="d-flex justify-content-end">
                            <a href="{{ route("users.edit", $results["id"])}}">
                                <button type="button" class="btn btn-outline-primary">Edit</button>
                            </a>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <label for="firstName" class="col-md-4 col-form-label text-md-end">First Name</label>

                        <div class="col-md-6 align-self-center">
                            <strong>{{ $results["firstName"] ?? "-" }}</strong>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="lastName" class="col-md-4 col-form-label text-md-end">Last Name</label>

                        <div class="col-md-6 align-self-center">
                            <strong>{{ $results["lastName"] ?? "-" }}</strong>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                        <div class="col-md-6 align-self-center">
                            <strong>{{ $results["email"] ?? "-" }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
