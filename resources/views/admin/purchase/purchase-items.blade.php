@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	
	
<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	
	<a href="{{url('purchase-list')}}" class="JewelleryPrimaryButton">
							<i class="fas fa-arrow-left mr-2"></i> Back
						</a>
            <h1 class="h2 mb-0 text-gray-800">PURCHASE ORDER</h1>
	 <button type="button" class="btn btn-info" id="printBtn"><i class="bi bi-printer"></i> Print</button>
       
	</div>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="customer__page">
            <div class="">
                <div class="col-12">
                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="card  my-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold"> Total Amount: {{ $totalAmount }}</h6>
                                    <h6 class="m-0 font-weight-bold"> Suppiler: {{ $supplier }}</h6>

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
                                                    <th><input type="checkbox" id="select-all"></th>
                                                    <th>Id</th>
                                                    <th>Barcode</th>
                                                    <th>Category</th>
                                                    <th>Metal type</th>
                                                    <th>Purity</th>
                                                    <th>Weight</th>
                                                    <th>SubLocation</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach($stockItems as $stockItem)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="item_ids[]"
                                                            value="{{ $stockItem->item_id }}">
                                                    </td>
                                                    <td>{{ $stockItem->item_id }}</td>
                                                    <td><img src="{{ asset($stockItem->barcode) }}"
                                                            alt="Barcode for {{ $stockItem->item_name }}"
                                                            style="width: 100px; height: 100px; object-fit: contain;">
                                                    </td>
                                                    <td>{{ $stockItem->category }}</td>
                                                    <td>{{ $stockItem->metal_type }}</td>
                                                    <td>{{ $stockItem->purity }}</td>
                                                    <td>{{ $stockItem->item_weight }}</td>
                                                    <td>{{ $stockItem->sub_location }}</td>
                                                    <td>{{ $stockItem->amount }}</td>
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
    <!-- /.container-fluid -->
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const printBtn = document.getElementById('printBtn');

    // Event for printing selected items
    printBtn.addEventListener('click', function() {
        const checkedItems = Array.from(document.querySelectorAll('input[name="item_ids[]"]:checked'));

        if (checkedItems.length === 0) {
            alert('Please select at least one item to print.');
            return;
        }

        // Create a new window for printing
        let printWindow = window.open('', '', 'height=600,width=800');

        // Generate HTML for the print view
        let printContent = `
        <html>
        <head>
            <title>Print Selected Barcodes</title>
            <style>
                .barcode {
                    text-align: center;
                    margin-bottom: 10px;
                }
                .barcode img {
                    width: 150px;
                    height: 150px;
                    object-fit: contain;
                }
            </style>
        </head>
        <body>
            <h3>Selected Barcodes</h3>
    `;

        // Append selected barcodes to the print content
        checkedItems.forEach(item => {
            const row = item.closest('tr');
            const barcodeCell = row.querySelector('td:nth-child(3)');
            printContent += `
            <div class="barcode">
                ${barcodeCell.innerHTML}
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
