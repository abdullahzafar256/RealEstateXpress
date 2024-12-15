@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">

    <nav class="page-breadcrumb">
        <a href="{{route('add.amenities')}}" type="button" class="btn btn-inverse-info">Add Amenity</a>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Amenities</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Id#</th>
                                    <th>Amenity Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($amenityTypes as $key => $amenityType)
                                <tr>
                                    <td> {{$key+1}}</td>
                                    <td>{{$amenityType->amenities_name}}</td>
                                    <td>
                                        <a href="{{ route('edit.amenities', $amenityType->id) }}" class="btn btn-outline-primary">Edit</a>
                                        <button class="btn btn-outline-danger" onclick="showDeleteConfirmation('{{$amenityType->id}}')">Delete</button>
                                        <form action="{{ route('delete.amenities', $amenityType->id) }}" method="POST" id="delete-form{{$amenityType->id}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection