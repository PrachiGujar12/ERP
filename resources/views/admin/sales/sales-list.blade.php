@extends('layouts.dashboard')
@section('title', 'Sales List')
@section('meta_description', 'System user list.')
@section('content')

<div class="">
<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	<a href="{{route('dashboard')}}" class="JewelleryPrimaryButton">
							<i class="fas fa-arrow-left mr-2"></i> Back to Menu
						</a>
            <div class=" mb-2 mb-md-0 p-0">
                <h6 class="h2 mb-0 text-gray-800">SALES</h6>
            </div>
            <div class=" d-flex gap-2 justify-content-md-end p-0">
				
                <a href="{{url('add-sale')}}"><button class="JewelleryPrimaryButton"> <i class="bi bi-file-earmark-plus"></i>
                        Create New Sales Invoice
                    </button></a>
            </div>
        
	
	</div>
<div class="container-fluid">
  <!--  <div class="row m-0 p-0">
        <div class="col-6 d-flex align-items-center">
            <div class="col-12 m-0 p-0">
               
                <h1 class="h3 mb-2 text-gray-800">Sales Order List</h1>
            </div>

        </div>
    </div> -->

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- DataTales Example -->
    <div class="card my-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead  class="text-center" style="background-color:#df9700; color:#fff">
                        <tr>
                           <!-- <th>ID</th>  -->
                            <th>Invoice</th>
							 <th class="mobile-number">Date</th>
                            <th>Customer</th>
							<th class="mobile-number">Mobile Number</th>
							<th>Note</th>
							
                           
                            <th>Total Amount</th>
                            <th>Paid Amount</th>
                            <th>Due Amount</th>
							
                          <th>Action</th>
                        </tr>
                    </thead>

                    <tbody  class="text-center">
                        @foreach($sales as $sale)
                        <tr>
                            <!-- <td>{{$sale->sale_id}}</td> -->
                            <td>
								
									{{$sale->invoice_no}}
								
							</td>
							<td class="mobile-number">
								{{ \Carbon\Carbon::parse($sale->created_at)->format('d-m-Y') }}
								
							</td>
                            <td>
								{{$sale->customer->first_name}} {{$sale->customer->last_name}}
								
							</td>
							
							<td class="mobile-number">{{ ''.substr($sale->customer->mobile_no, 0, 4).' '.substr($sale->customer->mobile_no, 4, 3).' '.substr($sale->customer->mobile_no, 7, 3).' '.substr($sale->customer->mobile_no, 10) }}
								
								
							</td>
							
							<td>
								{{$sale->note}}
								
							</td>
							
                            

                            <td>£{{ number_format($sale->total_amount) }}
								
							</td>
							
							<td>£{{ number_format($sale->paid_amount) }}
								
							</td>
							<td>£{{ number_format($sale->due_amount) }}
								
							</td>
							
                          <td>

        <button class="btn btn-primary" id="actionBtn_{{ $sale->sale_id }}">Action</button>


                               <!-- <a class="btn btn-primary"
                                    href="{{ route('view.sales.items', $sale->sale_id) }}">
                                    View
                                </a>-->
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->
	</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($sales as $sale)
        document.getElementById('actionBtn_{{ $sale->sale_id }}').addEventListener('click', function() {
            Swal.fire({
                title: 'Choose an action',
                showCancelButton: true,
                showConfirmButton: false,
                html: `
                    <button id="viewBtn_{{ $sale->sale_id }}" class="swal2-confirm swal2-styled" style="background-color: #3085d6;">View</button>
                    <button id="amendBtn_{{ $sale->sale_id }}" class="swal2-confirm swal2-styled" style="background-color: #3085d6;">Amend Invoice</button>
                    <button id="printBtn_{{ $sale->sale_id }}" class="swal2-confirm swal2-styled" style="background-color: #3085d6;">Print</button>
                    <button id="refundBtn_{{ $sale->sale_id }}" class="swal2-confirm swal2-styled" style="background-color: #d33;">Refund/Cancel</button>
                `,
                didOpen: () => {
                    document.getElementById('viewBtn_{{ $sale->sale_id }}').addEventListener('click', () => {
                        window.location.href = "{{ route('view.sales.items', $sale->sale_id) }}";
                    });

                    document.getElementById('amendBtn_{{ $sale->sale_id }}').addEventListener('click', () => {
                        Swal.fire({
                            icon: 'info',
                            title: 'Amend Invoice',
                            text: 'Feature coming soon!'
                        });
                    });

                    document.getElementById('printBtn_{{ $sale->sale_id }}').addEventListener('click', () => {
                        Swal.fire({
                            title: 'Choose Print Option',
                            showCancelButton: true,
                            showConfirmButton: false,
                            html: `
                                <button id="internalBtn_{{ $sale->sale_id }}" class="swal2-confirm swal2-styled" style="background-color: #3085d6;">Internal</button>
                                <button id="externalBtn_{{ $sale->sale_id }}" class="swal2-confirm swal2-styled" style="background-color: #3085d6;">External</button>
                            `,
                            didOpen: () => {
                                document.getElementById('internalBtn_{{ $sale->sale_id }}').addEventListener('click', () => {
                                    Swal.fire('Printing Internal...', '', 'success');
                                });
                                document.getElementById('externalBtn_{{ $sale->sale_id }}').addEventListener('click', () => {
                                    Swal.fire('Printing External...', '', 'success');
                                });
                            }
                        });
                    });

                    document.getElementById('refundBtn_{{ $sale->sale_id }}').addEventListener('click', () => {
                        Swal.fire({
                            title: 'Refund or Cancel',
                            showCancelButton: true,
                            showConfirmButton: false,
                            html: `
                                <button id="refundActionBtn_{{ $sale->sale_id }}" class="swal2-confirm swal2-styled" style="background-color: #3085d6;">Refund</button>
                                <button id="cancelActionBtn_{{ $sale->sale_id }}" class="swal2-confirm swal2-styled" style="background-color: #d33;">Cancel</button>
                            `,
                            didOpen: () => {
                                document.getElementById('refundActionBtn_{{ $sale->sale_id }}').addEventListener('click', () => {
                                    Swal.fire('Refund Processed', '', 'success');
                                });
                                document.getElementById('cancelActionBtn_{{ $sale->sale_id }}').addEventListener('click', () => {
                                    Swal.fire('Sale Cancelled', '', 'success');
                                });
                            }
                        });
                    });
                }
            });
        });
        @endforeach
    });
</script>
@endsection