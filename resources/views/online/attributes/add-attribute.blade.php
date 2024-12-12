@extends('layouts.dashboard')

@section('title', 'Create Sale Order')
@section('meta_description', 'System user list.')

@section('content')
<div id="content">

    <!-- Header Section -->
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header"
        style="position: sticky; top: 0; z-index: 100;">
        <a href="{{ url('product-attribute-list') }}" class="JewelleryPrimaryButton" id="backButton">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <h6 class="h3 mb-0 text-gray-800">CREATE NEW ATTRIBUTE</h6>
        <div class="text-center d-flex gap-2">
            <button class="JewelleryPrimaryButton" data-toggle="modal" data-target="#simpleModal">
                <i class="bi bi-person-add"></i> Add New Attribute
            </button>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container-fluid">
        <div class="customer__page">
            <form action="{{ route('add-new-attribute') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                                required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="slug" class="col-sm-2 col-form-label">Slug <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug"
                                readonly>
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
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="text-center">
                                            <input type="radio" name="is_default" class="form-check-input" value="0">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="attribute_title[]"
                                                placeholder="Enter title" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="attribute_slug[]"
                                                placeholder="Enter slug" required>
                                        </td>
                                        <td>
                                            <input type="color" class="form-control form-control-color"
                                                name="attribute_color[]" value="#000000">
                                        </td>
                                        <td>
                                            <input type="file" class="form-control" name="attribute_image[]"
                                                accept="image/*">
                                        </td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-row">Remove</button>
                                        </td>
                                    </tr>
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