@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
           	
				<h1 class="h3 mb-0 text-gray-800">Assign Stock</h1>
		

        </div>
        <!-- Content Row -->
        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card shadow p-md-4">
                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="">
									<h6 class="m-0 font-weight-bold text-warning">Assign Stock Items</h6>
									</div>
									 	<div class="text-center mt-3">
                                            <button type="button" class="btn btn-primary" id="openModalBtn">Assign
                                                Selected</button>
                                        </div>
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
                                    <form id="assignStockForm">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%"
                                                cellspacing="0">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>Select</th>
                                                        <th>Id</th>
                                                        <th>Category</th>
                                                        <th>Item Type</th>
                                                        <th>Purity</th>
                                                        <th>Item Location</th>
                                                        <th>Sub Location</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @foreach($stockItems as $item)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="item_ids[]"
                                                                value="{{ $item->item_id }}">
                                                        </td>
                                                        <td>{{ $item->item_id }}</td>
                                                        <td>{{ $item->category }}</td>
                                                        <td>{{ $item->metal_type }}</td>
                                                        <td>{{ $item->purity }} Karat</td>
                                                        <td>{{ $item->location }}</td>
                                                        <td>{{ $item->sub_location }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M') }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <!-- /.container-fluid -->
</div>

<!-- Modal -->
<div class="modal fade" id="assignStockModal" tabindex="-1" aria-labelledby="assignStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignStockModalLabel">Assign Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignStockForm" action="{{ route('assign.stock') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <select class="form-control" id="location" name="location" required>
                            <option value="" disabled selected>Select Location</option>
                            @foreach($locations as $location)
                            <option value="{{ $location->location_id }}">{{ $location->location_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sub_location" class="form-label">Sub Location</label>
                        <select class="form-control" id="sub_location" name="sub_location" required>
                            <option value="" disabled selected>Select Sub Location</option>
                            <!-- Options will be populated based on the selected location -->
                        </select>
                    </div>
                    <input type="hidden" name="item_ids" id="hiddenItemIds">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const openModalBtn = document.getElementById('openModalBtn');
    const assignStockModal = new bootstrap.Modal(document.getElementById('assignStockModal'));
    const assignForm = document.getElementById('assignStockForm');
    const locationSelect = document.getElementById('location');
    const subLocationSelect = document.getElementById('sub_location');
    const hiddenItemIds = document.getElementById('hiddenItemIds');

    openModalBtn.addEventListener('click', function() {
        const checkedItems = Array.from(assignForm.querySelectorAll('input[name="item_ids[]"]:checked'));
        if (checkedItems.length === 0) {
            alert('Please select at least one item.');
            return;
        }

        // Set the hidden input with the selected item IDs
        hiddenItemIds.value = checkedItems.map(item => item.value).join(',');

        // Optionally reset dropdowns
        locationSelect.value = '';
        subLocationSelect.innerHTML = '<option value="" disabled selected>Select Sub Location</option>';

        assignStockModal.show();
    });

    locationSelect.addEventListener('change', function() {
        const locationId = locationSelect.value;

        if (locationId) {
            fetch(`https://demo.webwideit.solutions/raman-jeweller-erp/public/fetch-sublocations/${locationId}`)
                .then(response => response.json())
                .then(data => {
                    subLocationSelect.innerHTML =
                        '<option value="" disabled selected>Select Sub Location</option>';
                    data.forEach(subLocation => {
                        const option = document.createElement('option');
                        option.value = subLocation.sub_location_id;
                        option.textContent = subLocation.sub_location_name;
                        subLocationSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching sub-locations:', error));
        } else {
            subLocationSelect.innerHTML =
                '<option value="" disabled selected>Select Sub Location</option>';
        }
    });
});

</script>

@endsection