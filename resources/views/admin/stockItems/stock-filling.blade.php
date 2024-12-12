@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	
	<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	
	 <a href="{{ route('dashboard') }}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
            </a>
            <h1 class="h2 mb-0 text-gray-800">STOCK FILLING</h1>
	 <button type="button" class="px-5 mx-5"></button>
       
	</div>
	
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="customer__page">
            <div class="">
                <div class="my-4">
                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-warning">
                                        Stock Filling List
                                    </h6>
                                </div>
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
                                                    <th>Id</th>
                                                    <th>Location</th>
                                                    <th>Sub Location</th>
                                                    <th>Weight</th>
                                                    <th>Capacity</th>
                                                    <!--<th>Filled Capacity</th>-->
                                                    <th>Remaining To Fill</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($sublocations as $sublocation)
                                                @php
                                                $itemsCount = $sublocation->stockItems->count();
                                                $remainingCapacity = $sublocation->capacity - $itemsCount;
                                                @endphp
                                                @if ($itemsCount < $sublocation->capacity)
                                                    <tr>
                                                        <td>{{ $sublocation->sub_location_id }}</td>
                                                        <td>{{ $sublocation->Location->location_name }}</td>
                                                        <td>
                                                            <a
                                                                href="{{ route('show.stock.items', ['subLocationId' => $sublocation->sub_location_id]) }}">
                                                                {{ $sublocation->sub_location_name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $sublocation->weight }}</td>
                                                        <td>{{ $sublocation->capacity }}</td>
                                                        <!--<td>{{ $itemsCount }}</td>-->
                                                        <td>{{ $remainingCapacity }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#fillModal"
                                                                data-id="{{ $sublocation->sub_location_id }}">
                                                                Fill
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="fillModal" tabindex="-1" role="dialog"
                                    aria-labelledby="fillModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="fillModalLabel">Fill Sub Location</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="fillForm" action="{{ route('update-stock.items') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" id="subLocationId" name="sub_location_id">
                                                    <input type="hidden" id="itemIds" name="item_ids">
                                                    <div class="form-group">
                                                        <label for="subLocationName">Sub Location Name</label>
                                                        <input type="text" class="form-control" id="subLocationName"
                                                            name="sub_location_name" readonly>
                                                    </div>
                                                     <div class="form-group">
													<label for="itemId">Item ID</label>
													<input type="text" class="form-control" id="itemId" name="item_id" placeholder="Enter Repair Item ID">
												</div>
												<!-- New Add Button -->
												<button type="button" id="addItemBtn" class="btn btn-info mb-3">Add ID</button>

												<div class="form-group">
													<label>Added Items</label>
													<ul class="list-group" id="itemList"></ul>
												</div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
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
    });

   
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle Add Item Button Click
    document.getElementById('addItemBtn').addEventListener('click', function() {
        var itemIdInput = document.getElementById('itemId');
        var itemId = itemIdInput.value.trim();

        if (itemId) {
            var itemList = document.getElementById('itemList');
            var itemIdsField = document.getElementById('itemIds');

            // Create new list item
            var listItem = document.createElement('li');
            listItem.className = 'list-group-item';
            listItem.textContent = itemId;

            // Append list item to the list
            itemList.appendChild(listItem);

            // Update hidden field with item IDs
            var currentIds = itemIdsField.value ? itemIdsField.value.split(',') : [];
            currentIds.push(itemId);
            itemIdsField.value = currentIds.join(',');

            // Clear the input field
            itemIdInput.value = '';
        }
    });
});
</script>

@endsection