@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Organizers</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('organizers.update', $results["id"]) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="organizerName" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="organizerName" type="organizerName" class="form-control @error('organizerName') is-invalid @enderror" name="organizerName" value="{{ old('organizerName') ?? $results["organizerName"] }}" autofocus>

                                @error('organizerName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="imageLocation" class="col-md-4 col-form-label text-md-end">Image Location</label>

                            <div class="col-md-6">
                                <input id="imageLocation" type="imageLocation" class="form-control @error('imageLocation') is-invalid @enderror" name="imageLocation" value="{{ old('imageLocation') ?? $results["imageLocation"] }}">

                                @error('imageLocation')
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

                                <a class="btn btn-link" href="{{ route('organizers.index') }}">
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
