@extends('layouts.dashboard')

@section('title', 'Edit Attribute')
@section('meta_description', 'System attribute edit page.')

@section('content')
<div id="content">

    <!-- Header Section -->
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header"
        style="position: sticky; top: 0; z-index: 100;">
        <a href="{{ url('product-attribute-list') }}" class="JewelleryPrimaryButton" id="backButton">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <h6 class="h3 mb-0 text-gray-800">EDIT ATTRIBUTE</h6>
        <div class="text-center d-flex gap-2">

        </div>
    </div>

    <!-- Page Content -->
    <div class="container-fluid">
        <div class="customer__page">
            <form action="{{ route('update-product-attribute', $productAttribute->product_attribute_id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Attribute Input Section -->
                <div class="col-12 py-3 mt-3 card">
                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Title <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title', $productAttribute->title) }}" placeholder="Enter title" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="slug" class="col-sm-2 col-form-label">Slug <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="slug" name="slug"
                                value="{{ old('slug', $productAttribute->slug) }}" placeholder="Enter slug" required>
                        </div>
                    </div>
                </div>

                <!-- Attributes Table Section -->
                <div class="col-12 p-0 mt-3 card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="attributesTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Is Default?</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Color</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productAttribute->attributeValues as $index => $attr)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-center">
                                            <input type="radio" name="is_default" class="form-check-input"
                                                value="{{ $index }}" {{ $attr->is_default ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="attribute_title[]"
                                                value="{{ old('attribute_title.' . $index, $attr->title) }}"
                                                placeholder="Enter title" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="attribute_slug[]"
                                                value="{{ old('attribute_slug.' . $index, $attr->slug) }}"
                                                placeholder="Enter slug" required>
                                        </td>
                                        <td>
                                            <input type="color" class="form-control form-control-color"
                                                name="attribute_color[]"
                                                value="{{ old('attribute_color.' . $index, $attr->color) }}">
                                        </td>
                                        <td>
                                            <input type="file" class="form-control" name="attribute_image[]"
                                                accept="image/*">
                                            @if (!empty($attr->attribute_image))
                                            <img src="{{ asset($attr->attribute_image) }}" alt="Uploaded Image"
                                                class="img-thumbnail mt-2" width="100">
                                            @endif
                                        </td>


                                        <td>
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-row">Remove</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="JewelleryPrimaryButton mt-3" id="addNewAttribute">Add New
                                Attribute</button>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mb-3 mr-3 d-flex justify-content-end">
                    <button type="submit" class="JewelleryPrimaryButton">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- JavaScript for Dynamic Row Management -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// JavaScript to dynamically add/remove attribute rows
document.getElementById('addNewAttribute').addEventListener('click', function() {
    const tableBody = document.querySelector('#attributesTable tbody');
    const rowCount = tableBody.rows.length + 1;

    const newRow = `
            <tr>
                <td>${rowCount}</td>
                <td class="text-center">
                    <input type="radio" name="is_default" class="form-check-input" value="${rowCount - 1}">
                </td>
                <td>
                    <input type="text" class="form-control" name="attribute_title[]" placeholder="Enter title" required>
                </td>
                <td>
                    <input type="text" class="form-control" name="attribute_slug[]" placeholder="Enter slug" required>
                </td>
                <td>
                    <input type="color" class="form-control form-control-color" name="attribute_color[]" value="#000000">
                </td>
                <td>
                    <input type="file" class="form-control" name="attribute_image[]" accept="image/*">
                </td>
              
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                </td>
            </tr>
        `;

    tableBody.insertAdjacentHTML('beforeend', newRow);
});

// Event delegation to handle row removal
document.querySelector('#attributesTable').addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-row')) {
        e.target.closest('tr').remove();
    }
});
</script>
@endsection