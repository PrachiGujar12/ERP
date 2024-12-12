@extends('layouts.dashboard')
@section('title', 'Sale View')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	
	    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
        <a href="{{route('view.customer', $salesItems->customer)}}"><button class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back 
			</button></a>

        <h1 class="h2 mb-0 text-gray-800">Invoice Number: {{$salesItems->sale_id}}</h1>

		<div>
        <button type="button" class="JewelleryPrimaryButton" onclick="printInvoice({{ $salesItems->sale_id }})">
           External Print
        </button>
			<button type="button" class="JewelleryPrimaryButton">
           Internal Print
        </button>
			<a href="{{ route('invoice.download.pdf', $salesItems->sale_id) }}" class="btn btn-primary">Download PDF</a>

		</div>
			
    </div>
	
    <!-- Begin Page Content -->
    <div class="container-fluid">
        

        <!-- Content Row -->
        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card p-md-4 my-4">
                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
							
							 <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex col-12 p-0">
										<div class="col-6 p-0">
										<p><b>Customer Name:</b> {{$salesItems->customer->first_name}} {{$salesItems->customer->last_name}}</p>
										<p><b>Mobile Number:</b> {{ ''.substr($salesItems->customer->mobile_no, 0, 4).' '.substr($salesItems->customer->mobile_no, 4, 3).' '.substr($salesItems->customer->mobile_no, 7, 3).' '.substr($salesItems->customer->mobile_no, 10) }}</p>
											
										</div>
										<div class="col-6 p-0">
										<p><b>Address:</b> {{$salesItems->customer->address}} <b>Town:</b> {{$salesItems->customer->town}}</p>
										
										<p><b>County:</b> {{$salesItems->customer->county}} {{$salesItems->customer->post_code}}</p>	
										</div>
									</div>
									
                                </div>
							
							<h4 class="h4">Item Details:</h4>
                            <div class="card mb-4 border-0">
                               
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
                                <div class="">
                                    <div class="table-responsive border-0">
                                        <table class="table table-bordered m-0" id="dataTable23" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th>Date</th>
                                                   
                                                    <th>Category</th>
                                                    <th>Metal Type</th>
                                                    
                                                    <th>Item Weight</th>
                                                    <th>Item Amount</th>
                                                    
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($stockItems as $stockItem)
                                                <tr>
                                                    <td>{{ $salesItems->created_at->format('d-m-Y') }}</td>
                                                    
                                                    <td>{{ $stockItem->category }}</td>
                                                    <td>{{ $stockItem->metal_type }}</td>
                                                    
                                                    <td>{{ $stockItem->item_weight }}</td>
                                                    <td>£
														{{ number_format($stockItem->sale_amount) }}</td>
                                            
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
							
							<h4 class="h4">Payment Details:</h4>
							 <div class="">
                                    <div class="table-responsive">
                                        <table class="table table-bordered m-0" id="dataTable12" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Payment Type</th>
                                                    <th>Amount</th>
                                                    <th>Ref. No</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->created_at->format('d-m-Y') }}</td>
                                                    
                                                    <td>{{ $payment->payment_type }}</td>
                                                    <td>£{{ number_format($payment->amount) }}</td>
                                                    <td>
														@if($payment->ref_no)
														{{ $payment->ref_no }}
													@else
														N/A
													@endif
													</td>
                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
							<hr class="mb-3">
							
							<div class="d-flex align-items-center justify-content-between">
								@if($salesItems->due_amount > 0)
								<a href="{{route('edit.sales.items',$salesItems->sale_id)}}" ><button class="JewelleryPrimaryButton"><i class="bi bi-pencil-square"></i> EDIT</button></a>
								@endif
									<div class="pr-4">
										<p> <b>Total Amount:</b> £{{ number_format($salesItems->total_amount) }}</p>
										<p> <b>Paid Amount:</b> £{{ number_format($salesItems->paid_amount) }}</p>
										<p> <b>Due Amount:</b> £{{ number_format($salesItems->due_amount) }}</p>
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

<script>
        function printInvoice(invoiceId) {
            var printWindow = window.open('/raman-jeweller-erp/public/print-invoice/' + invoiceId, '_blank', 'height=500,width=800');

            printWindow.onload = function () {
                printWindow.print();

                printWindow.onafterprint = function () {
                    printWindow.close();
                };
            };
        }
    </script>

@endsection
