@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sport Events</div>

                <div class="card-body">
                    <form id="perPageForm" action="{{ route('organizers.index') }}" method="GET">
                        <label for="perPage">Items Per Page:</label>
                        <select name="perPage" id="perPage">
                            <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                    <table class="table table-bordered" id="organizers-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event Name</th>
                                <th>Event Type</th>
                                <th>Event Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                            <tr>
                                <td>{{ $result["id"] }}</td>
                                <td><a href="{{ route("sport-events.show", $result["id"])}}">{{ $result["eventName"] }}</a></td>
                                <td>{{ $result["eventType"] }}</td>
                                <td>{{ $result["eventDate"] }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route("sport-events.edit", $result["id"])}}">
                                            <button type="button" class="btn btn-primary">Edit</button>
                                        </a>
                                        &nbsp;
                                        <form action="{{ route('sport-events.destroy', $result["id"]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </a>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end">
                        {{ $paginator->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script te>
    document.getElementById('perPage').addEventListener('change', function () {
        document.getElementById('perPageForm').submit();
    });
</script>
@endsection
