@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	
	 <a href="{{ route('dashboard') }}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Back to Menu
            </a>
            <h1 class="h2 mb-0 text-gray-800">STOCK OUT LIST</h1>
	 <a href="{{ route('stock.adjustment') }}" class="JewelleryPrimaryButton">
                <i class="bi bi-plus-circle"></i> STOCK OUT 
            </a>
       
	</div>
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Content Row -->
        <div class="customer__page">
            <div class="my-4">
                <div class="">
                    <div class="row">
                        <div class="col-md-6 d-none">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills py-3 nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-customer-tab" data-toggle="pill"
                                        href="#pills-customer" role="tab" aria-controls="pills-customer"
                                        aria-selected="false">Stock Out List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="add-new-customer-tab" data-toggle="pill"
                                        href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                        aria-selected="true"> Stock Out</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="card mb-4">
                                
                                @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @endif
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th> Id </th>
                                                    <th> Item Name </th>
                                                    <th> Staff Name </th>
                                                    <th> Movement Date </th>
                                                    <th> From Location </th>
                                                    <th> To Location </th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach($stocks as $stock)
                                                <tr>
                                                    <td>{{ $stock->stock_out_id}}</td>
                                                    <td>{{ $stock->item_name }} </td>
                                                    <td>{{ $stock->staff_name }} </td>
                                                    <td>{{ $stock->movement_date}} </td>
                                                    <td>{{ $stock->from_location }} </td>
                                                    <td>{{ $stock->to_location}} </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="add-new-customer" role="tabpanel"
                            aria-labelledby="add-new-customer-tab">
                            <form class="form-sample" action="{{ route('adjust.stock') }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Transfer Type</label>
                                        <select class="form-control" name="transfer_type" id="transfer_type"
                                            data-url="{{ route('get.items') }}" required>
                                            <option value="">--Select Transfer Type --</option>
                                            <option value="individual">Individual</option>
                                            <option value="group">Group</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Item Name</label>
                                        <select class="form-control" name="item_name" id="item_name" required>
                                            <option value="">Select Item Transfer Type</option>


                                        </select>
                                    </div>
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Staff Member</label>
                                        <select class="form-control" name="staff_name" required>
                                            <option value="">--Select Staff --</option>
                                            @foreach($staffs as $staff)
                                            <option value="{{ $staff->name }}">{{ $staff->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Movement Date</label>
                                        <input type="date" class="form-control" name="movement_date" />
                                    </div>
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">From Location</label>
                                        <!-- <input type="text" class="form-control" name="from_location"
                                            id="from_location" readonly /> -->
                                        <select class="form-control" name="to_location" id="to_location" required>
                                            <option value="">--Select To Location --</option>
                                            @foreach($storageLocations as $location)
                                            <option value="{{ $location->location_name }}">
                                                {{ $location->location_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">To Location</label>
                                        <select class="form-control" name="to_location" id="to_location" required>
                                            <option value="">--Select To Location --</option>
                                            @foreach($storageLocations as $location)
                                            <option value="{{ $location->location_name }}">
                                                {{ $location->location_name }}</option>
                                            @endforeach
                                        </select>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {


    // Script to fetch and populate location based on selected item
    $('#item_name').on('change', function() {
        var selectedItem = this.value;
        var items = @json($items); // Convert PHP array to JavaScript array

        // Find the selected item in the items array
        var selectedItemData = items.find(function(item) {
            return item.item_name === selectedItem;
        });

        // Populate the from_location field with the location of the selected item
        var fromLocation = selectedItemData.item_location;
        $('#from_location').val(fromLocation);

        // Hide the from_location value in the to_location dropdown
        $('#to_location option').each(function() {
            if ($(this).val() === fromLocation) {
                $(this).hide();
            } else {
                $(this).show(); // Show other options
            }
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('transfer_type').addEventListener('change', function() {

        const url = this.getAttribute('data-url');
        const transfertype = this.value;

        // Clear product and part dropdowns
        document.getElementById('item_name').innerHTML = '<option value="">Select an option</option>';

        if (transfertype == 'individual') {

            fetch(`${url}?transfertype=${transfertype}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Individual Transfer:', data); // Debugging line
                    const nameSelect = document.getElementById('item_name');
                    data.items.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.item_id;
                        option.textContent = item.item_name;
                        nameSelect.appendChild(option);
                    });
                });
        } else {
            fetch(`${url}?transfertype=${transfertype}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Bulk Transfer:', data); // Debugging line
                    const nameSelect = document.getElementById('item_name');
                    data.subLocation.forEach(subLocation => {
                        console.log(
                        subLocation); // Debugging line to check each item structure
                        const option = document.createElement('option');
                        option.value = subLocation
                        .sub_location_id; // Use optional chaining to avoid errors

                        option.textContent = subLocation.sub_location_name; // Fallback text
                        nameSelect.appendChild(option);
                    });
                });
        }
    });

    $(document).ready(function() {
        $('#name').on('change', function() {
            // Clear the project_id select field
            $('#project_id').val('');

            // Clear the material_info div
            $('#material_info').html('');
        });
    });

    $(document).ready(function() {
        $('#material').on('change', function() {
            // Clear the project_id select field
            $('#project_id').val('');

            // Clear the material_info div
            $('#material_info').html('');
        });
    });



    document.getElementById('project_id').addEventListener('change', function() {
        const project = this.value;
        const material = document.getElementById('material').value;
        const name = document.getElementById('name').value;
        const url = this.getAttribute('data-url');
        document.getElementById('material_info').value = '';

        if (name) {
            fetch(`${url}?name=${name}&material=${material}&project=${project}`)
                .then(response => response.json())
                .then(data => {
                    const stockInfoDiv = document.getElementById('material_info');
                    stockInfoDiv.innerHTML = `
                    <h4 class="h5">Stock Information For ${data.projectname}</h4>
                    <p><strong>Material:</strong> ${data.material}</p>
                    <p><strong>Description:</strong> ${data.description}</p>
                    <p><strong>Total Stock Quantity Received:</strong> ${data.totalLength}${data.unit}</p>
                    <p><strong>Total Required Quantity:</strong> ${data.totalRequiredLength}${data.unit}</p>
                    <p><strong>Total Assigned Quantity:</strong> ${data.totalAssignedLength}${data.unit}</p>

                `;

                })
                .catch(error => console.error('Error fetching stock details:', error));
        } else {
            document.getElementById('material_info').innerHTML =
                ''; // Clear part info if no part selected
        }
    });
});
</script>

@endsection