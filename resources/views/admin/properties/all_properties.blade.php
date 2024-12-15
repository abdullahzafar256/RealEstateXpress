@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">

    <nav class="page-breadcrumb">
        <a href="{{route('add.properties')}}" type="button" class="btn btn-inverse-info">Add Properties</a>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Properties</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Id#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Property Type</th>
                                    <th>Property Status</th>
                                    <th>City</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($properties as $key => $property)
                                <tr>
                                    <td> {{$key+1}}</td>
                                    <td><img src="{{asset($property->property_thumbnail)}}" style="width: 70px; height:40px;"></td>
                                    <td>{{$property->property_name}}</td>
                                    <td>{{$property['propertyType']['type_name']}}</td>
                                    <td>{{$property->property_status}}</td>
                                    <td>{{$property->city}}</td>
                                    <td>{{$property->property_code}}</td>
                                    <td>
                                        @if($property->status ==1)
                                        <span class="badge rounded-pill bg-success"> Active</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger"> InActive</span>

                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.properties', $property->id) }}" class="btn btn-outline-primary">Edit</a>
                                        <button class="btn btn-outline-danger">Delete</button>
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