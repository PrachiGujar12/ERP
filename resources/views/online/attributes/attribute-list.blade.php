@extends('layouts.dashboard')
@section('title', 'Attribute List')
@section('meta_description', 'System user list.')
@section('content')

<div class="">
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
        <a href="{{route('online-dashboard')}}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back to Menu
        </a>
        <div class=" mb-2 mb-md-0 p-0">
            <h6 class="h2 mb-0 text-gray-800">PRODUCT ATTRIBUTE LIST</h6>
        </div>
        <div class=" d-flex gap-2 justify-content-md-end p-0">

            <a href="{{url('create-new-attribute')}}"><button class="JewelleryPrimaryButton"> <i
                        class="bi bi-file-earmark-plus"></i>
                    Create New Attribute
                </button></a>
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
        <!-- DataTales Example -->
        <div class="card my-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center" style="background-color:#df9700; color:#fff">
                            <tr>
                                <!-- <th>ID</th>  -->
                                <th>ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Created At</th>
                                <th>Action</th>

                                <!--  <th>Action</th> -->
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @foreach($productAttributes as $productAttribute)
                            <tr>
                                <td>{{ $productAttribute->product_attribute_id }}</td>
                                <td>{{ $productAttribute->title }}</td>

                                <td>{{ $productAttribute->slug }}</td>
                                <td>{{ \Carbon\Carbon::parse($productAttribute->created_at)->format('Y/m/d') }}</td>
                                <td>
                                    <!-- Edit button linking to the edit page -->
                                    <a href="{{ route('edit-product-attribute', $productAttribute->product_attribute_id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <!-- Delete button with confirmation -->
                                    <form
                                        action="{{ route('delete-product-attribute', $productAttribute->product_attribute_id) }}"
                                        method="POST" style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this attribute and attribute values?');">
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
    <!-- /.container-fluid -->
</div>


@endsection