@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Organizers</div>

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
                                <th>Organizer Name</th>
                                <th>Image Location</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                            <tr>
                                <td>{{ $result["id"] }}</td>
                                <td><a href="{{ route("organizers.show", $result["id"])}}">{{ $result["organizerName"] }}</a></td>
                                <td>{{ $result["imageLocation"] }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route("organizers.edit", $result["id"])}}">
                                            <button type="button" class="btn btn-primary">Edit</button>
                                        </a>
                                        &nbsp;
                                        <form action="{{ route('organizers.destroy', $result["id"]) }}" method="POST">
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
