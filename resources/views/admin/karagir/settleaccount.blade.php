@extends('layouts.dashboard')
@section('title', 'Karigar Items List')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	
		   <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
         <a href="{{ route('view.karigar', $karagirs->karigar_id) }}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>

        <h1 class="h2 mb-0 text-gray-800">KARIGAR : {{$karagirs->karigar_name}}</h1>

       <a class="mx-5 px-5">
           
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
                            <div class="">
                                
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
									<h4 class="h4">Labour Due Amount : £8,761</h4>  
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
