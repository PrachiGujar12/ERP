@extends('layouts.dashboard')
@section('title', 'Karigar Items List')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	
		   <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
         <a href="{{route('karigar.list')}}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>

        <h1 class="h2 mb-0 text-gray-800">KARIGAR : {{$karagirs->karigar_name}}</h1>

       <a href="{{ route('settle.karigar.account', $karagirs->karigar_id) }}" class="JewelleryPrimaryButton">
           <i class="bi bi-wallet2"></i> Settle Account
        </a>
    </div>
	
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        

        <!-- Content Row -->
        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card p-md-4 my-4">
                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-warning">
                                        Order Items 
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
                                                    <!--<th>Id</th>-->
                                                    <th>Order Number</th>
                                                    <th>Category</th>
                                                    <th>Metal Type</th>
                                                    <th>Item Weight</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($Orderitems as $karagir)
                                                <tr>
                                                    <!--<td>{{ $karagir->category }}</td>-->
                                                    <td>RO_{{ $karagir->repair_order_no }}</td>
                                                    <td>{{ $karagir->categoryy->category_name }}</td>
                                                    <td>{{ $karagir->metal_type }}</td>
                                                    
                                                    <td>{{ $karagir->item_weight }}</td>
                                                    <td>
														@if($karagir->status == "Received")
														<button class="btn btn-sm {{ $karagir->status == 'complete' ? 'btn-success' : 'btn-success' }}">{{ $karagir->status }}</button>
														@elseif($karagir->status == "Assigned")
														<button class="btn btn-sm {{ $karagir->status == 'complete' ? 'btn-success' : 'btn-warning' }}">{{ $karagir->status }}</button>@else()
														<button class="btn btn-sm {{ $karagir->status == 'complete' ? 'btn-success' : 'btn-danger' }}">{{ $karagir->status }}</button>
														
														@endif
                                                        <!--<button class="btn btn-sm {{ $karagir->status == 'complete' ? 'btn-success' : 'btn-danger' }}" 
                                                            data-toggle="modal" 
                                                            data-target="#statusModal"
                                                            onclick="setStatus({{ $karagir->repair_id }}, '{{ $karagir->status }}')">
                                                            {{ ucfirst($karagir->status) }}
                                                        </button>-->
                                                    </td>
													<td><button class="btn btn-primary updateButton" data-repair-id="{{ $karagir->repair_id }}">Update</button></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
							
							<div class="card mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-warning">
                                       Repair Order Items 
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
                                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <!--<th>Id</th>-->
                                                    <th>Repair Order Number</th>
                                                    <th>Category</th>
                                                    <th>Metal Type</th>
                                                    
                                                    <th>Item Weight</th>
                                                    <th>Status</th>
													 <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($RepairOrderitems as $Orderitem)
                                                <tr>
                                                    <!--<td>{{ $Orderitem->category }}</td>-->
                                                    <td>{{ $Orderitem->repair_order_no }}</td>
                                                    <td>{{ $Orderitem->categoryy->category_name }}</td>
                                                    <td>{{ $Orderitem->metal_type }}</td>
                                                    
                                                    <td>{{ $Orderitem->item_weight }}</td>
                                                    <td>
                                                        @if($Orderitem->status == "Received")
														<button class="btn btn-sm {{ $karagir->Orderitem == 'complete' ? 'btn-success' : 'btn-success' }}">{{ $Orderitem->status }}</button>
														@elseif($Orderitem->status == "Assigned")
														<button class="btn btn-sm {{ $Orderitem->status == 'complete' ? 'btn-success' : 'btn-warning' }}">{{ $Orderitem->status }}</button>@else()
														<button class="btn btn-sm {{ $Orderitem->status == 'complete' ? 'btn-success' : 'btn-danger' }}">{{ $Orderitem->status }}</button>
														
														@endif
                                                    </td>
													<td><button class="btn btn-primary updateButton" data-repair-id="{{ $karagir->repair_id }}">Update</button></td>
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
</div>

<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for updating status -->
                <form id="updateStatusForm" action="" method="POST">
                    @csrf
                    <input type="hidden" name="repair_id" id="repair_id">
                    <div class="form-group">
                        <label for="status">Select Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="complete">Complete</option>
                            <option value="incomplete">Incomplete</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function setStatus(repairId, currentStatus) {
        // Define the route URL with a placeholder for the ID
        const url = '{{ route("karagir.updateStatus", ":karigar_id") }}';
        
        // Replace the placeholder with the actual repairId
        const actionUrl = url.replace(':karigar_id', repairId);

        // Set the form action to the dynamically generated URL
        document.getElementById('updateStatusForm').action = actionUrl;
        document.getElementById('repair_id').value = repairId;
        document.getElementById('status').value = currentStatus;
    }
</script>

<script>
document.querySelectorAll(".updateButton").forEach(button => {
    button.addEventListener("click", function() {
        const repairId = this.getAttribute("data-repair-id"); // Get the unique repair ID
        // Open SweetAlert2 and show the form
        Swal.fire({
            title: 'Update Information',
            html: `
                <input id="amount" class="swal2-input" placeholder="Enter Labour Due" type="number">
				<div class="pt-4">
					<label>
						<input type="radio" name="goldType" value="karigar_gold"> Karigar Gold
					</label>
					<label>
						<input type="radio" name="goldType" value="our_gold"> Our Gold
					</label>
				</div>
                <input id="name" class="swal2-input" placeholder="Enter Metal Account" type="text">
            `,
            showCancelButton: true,
            confirmButtonText: 'Save',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const amount = document.getElementById('amount').value;
                const name = document.getElementById('name').value;

                if (!amount || !name) {
                    Swal.showValidationMessage('Both fields are required');
                    return false;  // Prevent form submission
                }

                return { amount, name };  // Return data
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const { amount, name } = result.value;
                console.log('Repair ID:', repairId);
                console.log('Amount:', amount);
                console.log('Name:', name);
                
                // Handle saving the data here (e.g., make an AJAX call)
                
                Swal.fire('Saved!', 'Your data has been saved.', 'success');
            } else if (result.isDismissed) {
                console.log('Cancelled');
            }
        });
    });
});

</script>
@endsection
