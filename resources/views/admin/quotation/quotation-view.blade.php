@extends('layouts.dashboard')
@section('title', 'Quotation View')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	
	    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
        <a ><button  onclick="history.back()" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back 
			</button></a>

        <h1 class="h2 mb-0 text-gray-800">Quotation Number: {{$salesItems->quotation_id}}</h1>

		<div>
        <button type="button" class="JewelleryPrimaryButton">Print</button>	
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
													<td>£{{ number_format($stockItem->aamount) }}</td>

                                            
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
