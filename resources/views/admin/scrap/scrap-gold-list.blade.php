@extends('layouts.dashboard')
@section('title', 'Scrap Gold List')
@section('meta_description', 'System user list.')
@section('content')

        <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header"
            style="
    position: sticky;
    top: 0;
    z-index: 100;">
            <!-- Page Heading -->
            <a href="{{ route('dashboard') }}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Back to Menu
            </a>
            <h1 class="h3 mb-0 text-gray-800 ">SCRAP GOLD LIST</h1>

			<a href="{{url('add-scrap-gold')}}"><button class="btn btn-secondary JewelleryPrimaryButton">
                        Create New Scrap Gold Order
                    </button></a>

        </div>
<div class="container-fluid">


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
        <div class="card-header py-3 row m-0 p-3 d-flex align-items-center">
            <div class="col-12 col-md-8 mb-2 mb-md-0 p-0">
                <h6 class="m-0 font-weight-bold text-secondary">Scrap Gold Table</h6>
            </div>
            <div class="col-12 col-md-4 d-flex justify-content-md-end p-0">
                
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background-color:#df9700; color:#fff">
                        <tr>
                            <th>Ref No.</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Grand Total</th>
                            <th>Due Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($scrapgolds as $scrapgold)
                        <tr>
                            <td>{{$scrapgold->scrap_id}}</td>
                            <td>{{$scrapgold->customer->first_name}} {{$scrapgold->customer->last_name}}</td>
                            <td>{{$scrapgold->created_at->format('d/m/Y')}}</td>
                            <td>£{{ number_format($scrapgold->grand_total) }}</td>
                            <td>£{{ number_format($scrapgold->due_amount) }}</td>
							
                            <td> @if($scrapgold->status == 'complete')
                                <span class="btn btn-sm btn-success">Complete</span>
                                @else
                                <span class="btn btn-sm btn-danger">{{ ucfirst($scrapgold->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <!-- View Button -->
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('view.scrap.items', $scrapgold->scrap_id) }}">
                                    View
                                </a>
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


@endsection