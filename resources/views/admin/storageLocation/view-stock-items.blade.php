@extends('layouts.dashboard')
@section('title', 'Stock Items for ' . $sublocation->sub_location_name)
@section('meta_description', 'List of stock items for a specific sub-location.')
@section('content')

<div id="content">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Stock Items for {{ $sublocation->sub_location_name }}</h1>
         
        </div>

        <!-- Stock Items Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning">Stock Items</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Item Category</th>
                                <th>Location</th>
                                <th>Material</th>
                                <th>Purity</th>
                                <th>Item Weight</th>

                              
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($stockItems as $item)
                            <tr>
                                <td>{{ $item->item_id}}</td>
                                <td>{{ $item->category }}</td>
                                <td>{{ $sublocation->Location->location_name }}</td>
                                <td>{{ $item->metal_type }}</td>
                                <td>{{ $item->purity }}</td>
                                <td>{{ $item->item_weight}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No stock items found for this sub-location.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
