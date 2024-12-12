@extends('layouts.dashboard')
@section('title', 'Scrap Items List')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
    <!-- Begin Page Content -->
	<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header mb-4"
            style="
    position: sticky;
    top: 0;
    z-index: 100;">
            <!-- Page Heading -->
            <a href="{{ url('/scrap-gold') }}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
            <h1 class="h3 mb-0 text-gray-800">SCRAP ITEMS LIST</h1>

			<a><button class="mx-5 px-5">
                       
                    </button></a>

        </div>
	
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card p-md-4">
                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="mb-4">
                                
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
                                                   
                                                    <th>Category</th>
                                                    <th>Metal Type</th>
                                                    <th>Purity</th>
                                                    <th>Item Weight</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($scrapItems as $scrapItem)
                                                <tr>
                                                    <td>{{ $scrapItem->category }}</td>
                                                    <td>{{ $scrapItem->metal_type }}</td>
                                                    <td>{{ $scrapItem->purity }}</td>
                                                    <td>{{ $scrapItem->item_weight }}</td>
                                                    <td>£{{ $scrapItem->amount }}</td>

                                                   
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



@endsection
