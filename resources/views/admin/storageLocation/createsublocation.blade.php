@extends('layouts.dashboard')
@section('title', 'Sub Location list')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	
	 <a href="{{ url('/sub-locations-list') }}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
            <h1 class="h2 mb-0 text-gray-800">SUB LOCATION </h1>
	 <button type="button" class="px-5 mx-5"></button>
       
	</div>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card p-md-4 my-5">
                    <div class="row">
                        <div class="col-md-6 d-none">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills py-3 nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " id="pills-customer-tab" data-toggle="pill"
                                        href="#pills-customer" role="tab" aria-controls="pills-customer"
                                        aria-selected="false">Sub Location List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="add-new-customer-tab" data-toggle="pill"
                                        href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                        aria-selected="true">Add Sub Location</a>
                                </li>
                            </ul>
                        </div>
                    </div>

						  @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
								  @if ($errors->any())
								<div class="alert alert-danger"> 
									<ul>
										@foreach ($errors->all() as $error) 
										<li>{{ $error }}</li>
										@endforeach </ul> 
								</div> 
								@endif 
                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class=" mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-warning">
                                        Sub Location List
                                    </h6>
                                </div>
                              
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Sub Location Name</th>
                                                    <th>Location</th>
                                                    <th>Weight</th>
                                                    <th>Capacity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($sublocations as $sublocation)
                                                <tr>
                                                    <td>{{ $sublocation->sub_location_id }}</td>
                                                    <td>
                                                            {{ $sublocation->sub_location_name }}
                                                    </td>
                                                    <td>{{ $sublocation->Location->location_name }}</td>
                                                    <td>{{ $sublocation->weight }}</td>
                                                    <td>{{ $sublocation->capacity }}</td>

                                                 

                                                    <td>
                                                      
                                                            <a class="btn btn-sm btn-primary"
                                                                href="{{ route('edit.sub.location', $sublocation->sub_location_id) }}">
                                                                Edit
                                                            </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                             
                            </div>
                        </div>
                        <div class="tab-pane fade  show active" id="add-new-customer" role="tabpanel"
                            aria-labelledby="add-new-customer-tab">
                            <!-- Add New Sub Location Form -->
                            <form action="{{ route('add.sub.location') }}" method="POST" id="addSubLocationForm"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row g-3">
                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Sub Location Name</label>
                                        <input type="text" class="form-control" id="textInput" name="sub_location_name"
                                            placeholder="Enter Sub Location Name" required />
                                    </div>

                                    <div class="col-md-6 form__fields">
                                        <label for="location" class="form-label">Location</label>
                                        <select class="form-control" id="location" name="location" required>
                                            <option value="">--Select Location--</option>
                                            @foreach($locations as $location)

                                            <option value="{{ $location->location_id }}">
                                                {{ $location->location_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Capacity</label>
                                        <input type="number" class="form-control" min="1" id="textInput" name="capacity"
                                            placeholder="Enter Capacity" required />
                                    </div>

                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Weight <small>(In Grams)</small></label>
                                        <input type="number" class="form-control" min="0.01" step="0.01" id="textInput" name="weight"
                                            placeholder="Enter Weight" />
                                    </div>


                                    <div class="col-12">

                                        <button type="submit" class="btn btn-sm btn-primary mt-3">Submit</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    $('#fillModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var subLocationId = button.data('id'); // Extract info from data-* attributes
       

        // Set the sub-location ID in the form
        document.getElementById('subLocationId').value = subLocationId;

        // Fetch sub-location data
        fetch(`https://demo.webwideit.solutions/raman-jeweller-erp/public/fill-sub-location/${subLocationId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('subLocationName').value = data.sub_location_name;
                } else {
                    document.getElementById('subLocationName').value = 'Data not available.';
                }
            })
            .catch(error => {
                console.error('Error fetching sub-location data:', error);
                document.getElementById('subLocationName').value = 'Error loading data.';
            });

        // Fetch categories for the current sub-location
        fetch(`https://demo.webwideit.solutions/raman-jeweller-erp/public/categories-excluding/${subLocationId}`)
            .then(response => response.json())
            .then(data => {
                const categorySelect = document.getElementById('categorySelect');
                categorySelect.innerHTML = ''; // Clear previous options

                if (data.length > 0) {
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.item_id;
                        option.textContent = item.category;
                        categorySelect.appendChild(option);
                    });
                } else {
                    const option = document.createElement('option');
                    option.textContent = 'No categories available';
                    categorySelect.appendChild(option);
                }
            })
            .catch(error => {
                console.error('Error fetching categories:', error);
            });
    });

    // Event listener for category selection
    document.getElementById('categorySelect').addEventListener('change', function() {
        const selectedCategory = this.value; // Get the selected category ID
        categorySelect.innerHTML = '<option value="">Select Item</option>';

        if (selectedCategory) {
            fetch(`https://demo.webwideit.solutions/raman-jeweller-erp/public/categories-excluding/${selectedCategory}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Response data:', data); // Debugging: log the entire response data

                    if (data.length > 0) {
                        const firstItem = data[0];
                        console.log('First item:', firstItem); // Debugging: log the first item

                        // Check if the related data exists and display it
                        document.getElementById('itemLocation').textContent =
                            (firstItem.location && firstItem.location.location_name) ? firstItem
                            .location.location_name : 'Location not available';

                        document.getElementById('subLocationnn').textContent =
                            (firstItem.sub_location && firstItem.sub_location.sub_location_name) ?
                            firstItem.sub_location.sub_location_name : 'Sub-location not available';

                        // Debugging: log the location and sub-location data specifically
                        console.log('Location:', firstItem.location ? firstItem.location
                            .location_name : 'Not found');
                        console.log('Sub-location:', firstItem.sub_location ? firstItem.sub_location
                            .sub_location_name : 'Not found');

                    } else {
                        document.getElementById('itemLocation').textContent =
                            'Location not available';
                        document.getElementById('subLocation').textContent =
                            'Sub-location not available';
                    }
                })
                .catch(error => {
                    console.error('Error fetching location and sub-location:', error);
                    document.getElementById('itemLocation').textContent = 'Error loading data.';
                    document.getElementById('subLocation').textContent = 'Error loading data.';
                });
        } else {
            // Clear location and sub-location if no category is selected
            document.getElementById('itemLocation').textContent = '';
            document.getElementById('subLocation').textContent = '';
        }
    });


});
</script>

@endsection