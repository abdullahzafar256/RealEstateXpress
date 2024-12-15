@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">

    <nav class="page-breadcrumb">
        <a href="{{route('add.type')}}" type="button" class="btn btn-inverse-info">Add Property Type</a>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Property Types</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Id#</th>
                                    <th>Type Name</th>
                                    <th>Type Icon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($propertyTypes as $key => $propertyType)
                                <tr>
                                    <td> {{$key+1}}</td>
                                    <td>{{$propertyType->type_name}}</td>
                                    <td>{{$propertyType->type_icon}}</td>
                                    <td>
                                        <a href="{{ route('edit.type', $propertyType->id) }}" class="btn btn-outline-primary">Edit</a>
                                        <button class="btn btn-outline-danger" onclick="showDeleteConfirmation('{{$propertyType->id}}')">Delete</button>
                                        <form action="{{ route('delete.type', $propertyType->id) }}" method="POST" id="delete-form{{$propertyType->id}}">
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