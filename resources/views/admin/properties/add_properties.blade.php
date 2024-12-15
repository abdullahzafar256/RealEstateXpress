@extends('admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-4 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Add Properties</h6>
                            <form method="post" id="addPropertyForm" enctype="multipart/form-data" action="{{route('store.properties')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Property Name</label>
                                            <input type="text" name="property_name" class="form-control">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="property_status" class="form-label">Property Status</label>
                                            <select class="form-select" name="property_status" id="property_status">
                                                <option selected disabled>Select Status</option>
                                                <option value="rent">Rent</option>
                                                <option value="buy">Buy</option>
                                            </select>
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Min Price</label>
                                            <input type="text" name="min_price" class="form-control">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Max Price</label>
                                            <input type="text" name="max_price" class="form-control">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Main Image</label>
                                            <input type="file" name="property_thumbnail" class="form-control" onchange="mainThumbUrl(this)">
                                            <img src="" id="mainThumb">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Additional Images</label>
                                            <input type="file" id="multiImg" multiple="" name="multi_img[]" class="form-control" onchange="multiImgUrl(this)">
                                            <div class="row" id="preview_image"></div>
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Bedrooms</label>
                                            <input type="text" class="form-control" name="bedrooms">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Bathrooms</label>
                                            <input type="text" class="form-control" name="bathrooms">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Garage</label>
                                            <input type="text" class="form-control" name="garage">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Garage Size</label>
                                            <input type="text" class="form-control" name="garage_size">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" name="city">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" name="state">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" name="postal_code">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Size</label>
                                            <input type="text" class="form-control" name="property_size">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Video</label>
                                            <input type="text" class="form-control" name="property_video">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Neighborhood</label>
                                            <input type="text" class="form-control" name="neighborhood">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Latitude</label>
                                            <input type="text" class="form-control" name="latitude">
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get latitude of the address</a>
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Longitude</label>
                                            <input type="text" class="form-control" name="longitude">
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get longitude of the address</a>
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Type</label>
                                            <select class="form-select" name="propertytype_id" id="propertytype_id">
                                                <option selected disabled>Select Property Type</option>
                                                @foreach($propertyTypes as $propertyType)
                                                <option value="{{$propertyType->id}}">{{$propertyType->type_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Amenities</label>
                                            <select class="js-example-basic-multiple form-select" name="amenities_id[]" multiple="multiple" data-width="100%">
                                                @foreach($amenities as $amenity)
                                                <option value="{{$amenity->id}}">{{$amenity->amenities_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Agent</label>
                                            <select class="form-select" name="agent_id" id="agent_id">
                                                <option selected disabled>Select Agent</option>
                                                @foreach($activeAgents as $agent)
                                                <option value="{{$agent->id}}">{{$agent->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea class="form-control" name="short_description" id="exampleFormControlTextarea1" rows="5"></textarea>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Long Description</label>
                                        <textarea class="form-control" name="long_description" id="tinymceExample" rows="10"></textarea>
                                    </div>
                                </div><!-- Col -->

                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input name="featured" type="checkbox" value="1" class="form-check-input" id="featured_property">
                                        <label class="form-check-label" for="featured_property">
                                            Featured Property
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="hot" type="checkbox" value="1" class="form-check-input" id="hot_property">
                                        <label class="form-check-label" for="hot_property">
                                            Hot Property
                                        </label>
                                    </div>
                                </div>

                                <div class="row add_item">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="facility_name" class="form-label">Facilities </label>
                                            <select name="facility_name[]" id="facility_name" class="form-control">
                                                <option value="">Select Facility</option>
                                                <option value="Hospital">Hospital</option>
                                                <option value="SuperMarket">Super Market</option>
                                                <option value="School">School</option>
                                                <option value="Entertainment">Entertainment</option>
                                                <option value="Pharmacy">Pharmacy</option>
                                                <option value="Airport">Airport</option>
                                                <option value="Railways">Railways</option>
                                                <option value="Bus Stop">Bus Stop</option>
                                                <option value="Beach">Beach</option>
                                                <option value="Mall">Mall</option>
                                                <option value="Bank">Bank</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="distance" class="form-label"> Distance </label>
                                            <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" style="padding-top: 30px;">
                                        <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                                    </div>
                                </div> <!---end row-->
                                <button type="submit" class="btn btn-primary submit">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--========== Start of add multiple class with ajax ==============-->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
            <div class="container mt-2">
                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="facility_name">Facilities</label>
                        <select name="facility_name[]" id="facility_name" class="form-control">
                            <option value="">Select Facility</option>
                            <option value="Hospital">Hospital</option>
                            <option value="SuperMarket">Super Market</option>
                            <option value="School">School</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Pharmacy">Pharmacy</option>
                            <option value="Airport">Airport</option>
                            <option value="Railways">Railways</option>
                            <option value="Bus Stop">Bus Stop</option>
                            <option value="Beach">Beach</option>
                            <option value="Mall">Mall</option>
                            <option value="Bank">Bank</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="distance">Distance</label>
                        <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                    </div>
                    <div class="form-group col-md-4" style="padding-top: 20px">
                        <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                        <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!----For Section-------->
<script type="text/javascript">
    $(document).ready(function() {
        var counter = 0;
        $(document).on("click", ".addeventmore", function() {
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click", ".removeeventmore", function(event) {
            $(this).closest("#whole_extra_item_delete").remove();
            counter -= 1
        });
    });
</script>
<!--========== End of add multiple class with ajax ==============-->

<script>
    function mainThumbUrl(input) {
        var mainThumb = document.getElementById('mainThumb');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                mainThumb.src = e.target.result;
                mainThumb.style.width = '100px';
                mainThumb.style.height = '100px';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function multiImgUrl(input) {
        var previewContainer = document.getElementById('preview_image');

        previewContainer.innerHTML = '';

        if (input.files && input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();
                var imgElement = document.createElement('img');

                reader.onload = (function(img) {
                    return function(e) {
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = '100px';
                    };
                })(imgElement);

                reader.readAsDataURL(input.files[i]);
                previewContainer.appendChild(imgElement);
            }
        }
    }
</script>

@endsection