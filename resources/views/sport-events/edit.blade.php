@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Sport Events</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sport-events.update', $results["id"]) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="eventDate" class="col-md-4 col-form-label text-md-end">Event Date</label>

                            <div class="col-md-6">
                                <input id="eventDate" type="date" class="form-control @error('eventDate') is-invalid @enderror" name="eventDate" value="{{ old('eventDate') ?? $results["eventDate"] }}" autofocus>

                                @error('eventDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="eventName" class="col-md-4 col-form-label text-md-end">Event Name</label>

                            <div class="col-md-6">
                                <input id="eventName" type="text" class="form-control @error('eventName') is-invalid @enderror" name="eventName" value="{{ old('eventName') ?? $results["eventName"] }}" autofocus>

                                @error('eventName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="eventType" class="col-md-4 col-form-label text-md-end">Event Type</label>

                            <div class="col-md-6">
                                <input id="eventType" type="text" class="form-control @error('eventType') is-invalid @enderror" name="eventType" value="{{ old('eventType') ?? $results["eventType"] }}" autofocus>

                                @error('eventType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="organizerId" class="col-md-4 col-form-label text-md-end">Organizer</label>

                            <div class="col-md-6">
                                <select name="organizerId" id="organizerId" class="form-select @error('organizerId') is-invalid @enderror">
                                    <option value="">-Select Organizer-</option>
                                    @foreach($organizers as $organizer)
                                        <option value="{{ $organizer["id"] }}" {{ old('organizerId') == $organizer["id"] || $results["organizer"]["id"] == $organizer["id"] ? "selected" : "" }}>({{ $organizer["id"] }}) {{ $organizer["organizerName"] }}</option>
                                    @endforeach
                                </select>

                                @error('organizerId')
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

                                <a class="btn btn-link" href="{{ route('sport-events.index') }}">
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
