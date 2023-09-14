@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Sport Events</div>

                <div class="card-body">

                    <div class="row mb-3">
                        <label for="eventDate" class="col-md-4 col-form-label text-md-end">Event Date</label>

                        <div class="col-md-6 align-self-center">
                            <strong>{{ $results["eventDate"] ? now()->parse($results["eventDate"])->format("d M Y") : "-" }}</strong>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eventName" class="col-md-4 col-form-label text-md-end">Event Name</label>

                        <div class="col-md-6 align-self-center">
                            <strong>{{ $results["eventName"] ?? "-" }}</strong>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eventType" class="col-md-4 col-form-label text-md-end">Event Type</label>

                        <div class="col-md-6 align-self-center">
                            <strong>{{ $results["eventType"] ?? "-" }}</strong>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="organizer" class="col-md-4 col-form-label text-md-end">Organizer</label>

                        <div class="col-md-6 align-self-center">
                            <strong>{{ $results["organizer"] ? '('.$results["organizer"]["id"].') '. $results["organizer"]["organizerName"] : "-" }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
