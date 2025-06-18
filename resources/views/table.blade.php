@extends('layout.template')

@section('content')
<div class = "container mt-4 mb-4">
    <div class="card">
        <div class="card-header">
            <h4>Data Points</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="pointsTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Update At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($points as $point)
                <tr>
                    <td>{{ $point->id }}</td>
                    <td>{{ $point->name }}</td>
                    <td>{{ $point->description }}</td>
                    <td>
                        <img src="{{ asset('storage/images/' . $point->image) }}" alt=""
                        width="200" title="{{ $point->image }}">
                    </td>
                    <td>{{ $point->user_created }}</td>
                    <td>{{ $point->created_at }}</td>
                    <td>{{ $point->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h4>Data Polylines</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="polylinesTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Update At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($polylines as $polyline)
                <tr>
                    <td>{{ $polyline->id }}</td>
                    <td>{{ $polyline->name }}</td>
                    <td>{{ $polyline->description }}</td>
                    <td>
                        <img src="{{ asset('storage/images/' . $polyline->image) }}" alt=""
                        width="200" title="{{ $polyline->image }}">
                    </td>
                    <td>{{ $point->user_created }}</td>
                    <td>{{ $polyline->created_at }}</td>
                    <td>{{ $polyline->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h4>Data Polygons</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="polygonsTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Update At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($polygons as $polygon)
                <tr>
                    <td>{{ $polygon->id }}</td>
                    <td>{{ $polygon->name }}</td>
                    <td>{{ $polygon->description }}</td>
                    <td>
                        <img src="{{ asset('storage/images/' . $polygon->image) }}" alt=""
                        width="200" title="{{ $polygon->image }}">
                    </td>
                    <td>{{ $point->user_created }}</td>
                    <td>{{ $polygon->created_at }}</td>
                    <td>{{ $polygon->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>

</div>


@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
<script>
    let tablepoints = new DataTable('#pointsTable');
    let tablepolylines = new DataTable('#polylinesTable');
    let tablepolygons = new DataTable('#polygonsTable');
</script>
@endsection
