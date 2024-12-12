@extends('layouts.dashboard')
@section('title', 'Products List')
@section('meta_description', 'System user list.')
@section('content')

<div class="">
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header sticky-top"
        style="z-index: 100;">
        <a href="{{ route('online-dashboard') }}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back to Menu
        </a>
        <div class="mb-2 mb-md-0 p-0">
            <h6 class="h2 mb-0 text-gray-800">PRODUCT LIST</h6>
        </div>
        <div class="d-flex gap-2 justify-content-md-end p-0">
            <a href="{{ url('create-new-product') }}">
                <button class="JewelleryPrimaryButton">
                    <i class="bi bi-file-earmark-plus"></i> Create New Product
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->product_id }}</td>
                                <td>
                                    <img src="{{ asset('assets/product_images/' . $product->product_image) }}"
                                        alt="Product Image" style="width: 50px; height: 50px;" />
                                </td>
                                <td>
                                    <a href="{{ route('edit-product', $product->product_id) }}">
                                        {{ $product->product_name }}
                                    </a>
                                </td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ implode(', ', $product->categoryNames()->toArray()) }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ \Carbon\Carbon::parse($product->created_at)->format('Y/m/d') }}</td>
                                <td>
                                    <!-- @if(DB::table('product_combinations')->where('product_id',
                                    $product->product_id)->count() == 0)
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#generateVariationsModal-{{ $product->product_id }}">
                                        Generate Variations
                                    </button>

                                    @else
                                    <a href="{{ route('edit-product', $product->product_id) }}"
                                        class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                    @endif -->

                                    <a href="{{ route('edit-product', $product->product_id) }}"
                                        class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="generateVariationsModal-{{ $product->product_id }}"
                                tabindex="-1" aria-labelledby="generateVariationsModalLabel-{{ $product->product_id }}"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="generateVariationsModalLabel-{{ $product->product_id }}">
                                                Generate Variations
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to generate all variations for this product?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form id="generateVariationsForm"
                                                action="{{ route('generate-variations', $product->product_id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Yes, Generate</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.btn-warning').forEach(button => {
    button.addEventListener('click', (e) => {
        const targetModal = document.querySelector(button.getAttribute('data-bs-target'));
        console.log('Modal Target:', targetModal);
        if (targetModal) {
            console.log('Modal exists in the DOM.');
        } else {
            console.error('Modal does not exist.');
        }
    });
});
</script>



@endsection