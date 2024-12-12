@extends('layouts.dashboard')
@section('title', 'Quotation List')
@section('meta_description', 'System user list.')
@section('content')

<div class="">
<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
	<a href="{{route('dashboard')}}" class="JewelleryPrimaryButton">
							<i class="fas fa-arrow-left mr-2"></i> Back to Menu
						</a>
            <div class=" mb-2 mb-md-0 p-0">
                <h6 class="h2 mb-0 text-gray-800">ESTIMATE QUOTATION</h6>
            </div>
            <div class=" d-flex gap-2 justify-content-md-end p-0">
				
                <a href="{{url('create-sales-quotation')}}"><button class="JewelleryPrimaryButton"> <i class="bi bi-file-earmark-plus"></i>
                        Create New Estimate
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
                            <th>Estimate No.</th>
							<th>Date</th>
                            <th>Customer</th>
							<th>Mobile Number</th>
                            <th>Total Amount</th>
                            
                          <!--  <th>Action</th> -->
                        </tr>
                    </thead>

                    <tbody  class="text-center">
                        @foreach($sales as $sale)
						<tr data-href="{{route('view.quotation', $sale->quotation_id )}}">
							<!-- {{ route('view.customer', $sale->quotation_id) }} -->
							<td>{{$sale->quotation_id}}</td>
							<td>{{$sale->created_at->format('d-m-y ')}}</td>
							<td>{{$sale->customer->first_name}} {{$sale->customer->last_name}}</td>
							<td>{{ ''.substr($sale->customer->mobile_no, 0, 4).' '.substr($sale->customer->mobile_no, 4, 3).' '.substr($sale->customer->mobile_no, 7, 3).' '.substr($sale->customer->mobile_no, 10) }}
</td>
							<td>
								@php
									$amounts = explode(',', $sale->total_amount);
									$sum = array_sum($amounts);
								@endphp

									£{{ number_format($sum) }}</td>
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


@endsection