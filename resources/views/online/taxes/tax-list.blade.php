@extends('layouts.dashboard')
@section('title', 'Tax List')
@section('meta_description', 'System user list.')
@section('content')

<div class="">
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header sticky-top"
        style="z-index: 100;">
        <a href="{{ route('online-dashboard') }}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back to Menu
        </a>
        <div class="mb-2 mb-md-0 p-0">
            <h6 class="h2 mb-0 text-gray-800">TAX LIST</h6>
        </div>
        <div class="d-flex gap-2 justify-content-md-end p-0">
            <a href="{{ url('create-new-tax') }}">
                <button class="JewelleryPrimaryButton">
                    <i class="bi bi-file-earmark-plus"></i> Create New Tax
                </button>
            </a>
        </div>
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

        <div class="card my-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center" style="background-color:#df9700; color:#fff">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Percentage %</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($taxes as $tax)
                            <tr>
                                <td>{{ $tax->tax_id }}</td>

                                <td>{{ $tax->name }}</td>
                                <td>{{ $tax->percentage }}%</td>
                                <td>{{ $tax->status }}</td>

                                <td>{{ \Carbon\Carbon::parse($tax->created_at)->format('Y/m/d') }}</td>
                                <td>
                                    <!-- Edit button linking to the edit page -->
                                    <a href="{{ route('edit-tax', $tax->tax_id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <!-- Delete button with confirmation -->
                                    <form
                                        action="{{ route('delete-tax', $tax->tax_id) }}"
                                        method="POST" style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this tax?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>


                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection