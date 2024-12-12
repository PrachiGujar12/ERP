@extends('layouts.dashboard')
@section('title', 'Stock Items')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	
	<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	
	 <a href="{{ route('dashboard') }}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Back to Menu
            </a>
            <h1 class="h2 mb-0 text-gray-800">STOCK ITEM </h1>
	 <button type="button" class="px-5 mx-5"></button>
       
	</div>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="container-fluid customer__page">
            <div class="row">
                <div class="my-4">
                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="m-0 font-weight-bold text-warning">Stock Items List</h6>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="button" class="btn btn-primary" id="openModalBtn">Assign
                                            Selected</button>
                                        <button type="button" class="btn btn-primary" id="printBtn">Print</button>
                                    </div>
                                </div>

                                @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th><input type="checkbox" id="select-all"></th>
                                                    <th>Id</th>
                                                    <th>Barcode</th>
                                                    <th>Category</th>
                                                    <th>Item Type</th>
                                                    <th>Purity</th>
                                                    <th>Item Location</th>
                                                    <th>Sub Location</th>
													<th>Weight <small>(In Gram)</small></th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach($items as $item)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="item_ids[]"
                                                            value="{{ $item->item_id }}">
                                                    </td>
                                                    <td>{{ $item->item_id }}</td>
                                                    <td>
                                                        <img src="{{ asset($item->barcode) }}"
                                                            alt="Barcode for {{ $item->item_name }}"
                                                            style="width: 100px; height: 100px; object-fit: contain;">
                                                    </td>
                                                    <td>{{ $item->category }}</td>
                                                    <td>{{ $item->metal_type }}</td>
                                                    <td>{{ $item->purity }} Karat</td>
												<td>{{ $item->Location ? $item->Location->location_name : ($item->location ?? 'Purchase')}}														</td>
												<td>{{ $item->subLocation ? $item->subLocation->sub_location_name : ($item->sub_location ?? 													'Purchase') }}</td>
													  <td>{{ $item->item_weight }}</td>
                                                    <td>
                                                        @if($item->assign)
                                                        <span class="badge bg-success">Assigned</span>
                                                        @else
                                                        <span class="badge bg-warning">Not Assigned</span>
                                                        @endif
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
                            @foreach($storageLocations as $location)
                            <option value="{{ $location->location_id }}">{{ $location->location_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sub_location" class="form-label">Sub Location</label>
                        <select class="form-control" id="sub_location" name="sub_location" required>
                            <option value="" disabled selected>Select Sub Location</option>
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
<!-- End Modal -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const openModalBtn = document.getElementById('openModalBtn');
    const printBtn = document.getElementById('printBtn');
    const assignStockModal = new bootstrap.Modal(document.getElementById('assignStockModal'));
    const assignForm = document.getElementById('assignStockForm');
    const locationSelect = document.getElementById('location');
    const subLocationSelect = document.getElementById('sub_location');
    const hiddenItemIds = document.getElementById('hiddenItemIds');

    // Event for opening the Assign Stock modal
    openModalBtn.addEventListener('click', function() {
        const checkedItems = Array.from(document.querySelectorAll('input[name="item_ids[]"]:checked'));

        if (checkedItems.length === 0) {
            alert('Please select at least one item.');
            return;
        }

        hiddenItemIds.value = checkedItems.map(item => item.value).join(',');

        locationSelect.value = '';
        subLocationSelect.innerHTML = '<option value="" disabled selected>Select Sub Location</option>';

        assignStockModal.show();
    });

    // Event for printing selected items
printBtn.addEventListener('click', function() {
    const checkedItems = Array.from(document.querySelectorAll('input[name="item_ids[]"]:checked'));

    if (checkedItems.length === 0) {
        alert('Please select at least one item to print.');
        return;
    }

    // Create a new window for printing
    let printWindow = window.open('', '', 'height=600,width=800');

    // Prepare an array to hold selected items' data
    let items = [];

    // Loop through selected checkboxes and get associated details
    checkedItems.forEach(item => {
        const row = item.closest('tr');
        const barcodeCell = row.querySelector('td:nth-child(3)'); 
		const categoryCell = row.querySelector('td:nth-child(4)');
		const weightCell = row.querySelector('td:nth-child(9)');
		
        const itemIdCell = row.querySelector('td:nth-child(2)');

        // Add the selected item data to the items array
        items.push({
            barcodeSrc: barcodeCell.querySelector('img').src, // Assuming barcode image
            category: categoryCell.textContent, 
			item_id: itemIdCell.textContent,
			item_weight: weightCell.textContent,
                    
        });
    });

    // Generate the HTML for print view
    let printContent = `
    <html>
    <head>
        <title>Print Selected Barcodes</title>
        <style>
            .barcode-container {
                text-align: center;
                margin-bottom: 20px;
            }
            .barcode img {
                width: 150px;
                height: 150px;
                object-fit: contain;
            }
            .item-details {
                font-size: 14px;
                margin-top: 5px;
            }
        </style>
    </head>
    <body>
        <h3>Selected Barcodes</h3>
    `;

    // Loop through items and generate HTML for each one
    items.forEach(item => {
        printContent += `
        <div class="barcode-container">
            <div class="barcode">
                <img src="${item.barcodeSrc}" alt="Barcode">
            </div>
            <div class="item-details">
				<p>${item.item_id}</p>
                <p>Category: ${item.category}</p>
				<p>Item Weight: ${item.item_weight} gm</p>
            </div>
        </div>
        `;
    });

    printContent += `
    </body>
    </html>
    `;

    // Write the content to the print window
    printWindow.document.write(printContent);
    printWindow.document.close();

    // Wait for the print window to load before executing the print
    printWindow.onload = function() {
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    };
});
    // Fetch sub-locations based on selected location
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
        }
    });

    // Select all checkboxes functionality
    document.getElementById('select-all').addEventListener('click', function() {
        const isChecked = this.checked;
        document.querySelectorAll('input[name="item_ids[]"]').forEach(checkbox => {
            checkbox.checked = isChecked;
        });
    });
});
</script>

@endsection