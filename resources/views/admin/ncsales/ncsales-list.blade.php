@extends('layouts.dashboard')
@section('title', 'NC Sales List')
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
                <h6 class="h2 mb-0 text-gray-800">NC SALES</h6>
            </div>
            <div class=" d-flex gap-2 justify-content-md-end p-0">
				
                <a href="{{url('add-nc-sale')}}"><button class="JewelleryPrimaryButton"> <i class="bi bi-file-earmark-plus"></i>
                        Create New NC Sales Order
                    </button></a>
            </div>
    </div>

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
    <div class="card my-4 m-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color:#df9700; color:#fff">
                        <tr>
							<th>Date</th>
                            <th>Mobile</th>
                            <th>Customer Name</th>
							<th>Total Amount</th>
							<th>Paid Amount</th>
							<th>Due Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($ncsales as $sale)
                        <tr data-href="{{ route('view.NCsales.items', $sale->id) }}">
							<td>{{$sale->created_at->format('d-y-m')}}</td>
							
							<td>{{ ''.substr($sale->customer->mobile_no, 0, 4).' '.substr($sale->customer->mobile_no, 4, 3).' '.substr($sale->customer->mobile_no, 7, 3).' '.substr($sale->customer->mobile_no, 10) }}
								
								</td>
							
							<td>{{ $sale->customer->first_name }} {{ $sale->customer->last_name }}</td>
							
							<td>£{{ number_format($sale->total_cost) }}</td>
							<td>£{{ number_format($sale->paid_amount) }}</td>
							<td>£{{ number_format($sale->due_amount) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->


@endsection