@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Organizers</div>

                <div class="card-body">

                    <div class="row mb-3">
                        <label for="organizerName" class="col-md-4 col-form-label text-md-end">Name</label>

                        <div class="col-md-6 align-self-center">
                            <strong>{{ $results["organizerName"] ?? "-" }}</strong>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="imageLocation" class="col-md-4 col-form-label text-md-end">Image Location</label>

                        <div class="col-md-6 align-self-center">
                            <strong>{{ $results["imageLocation"] ?? "-" }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
