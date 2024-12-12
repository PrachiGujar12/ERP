@extends('layouts.dashboard')

@section('title', 'Edit Product')
@section('meta_description', 'System attribute edit page.')

@section('content')
<div id="content">
    <!-- Header Section -->
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header"
        style="position: sticky; top: 0; z-index: 100;">
        <a href="{{ url('product-list') }}" class="JewelleryPrimaryButton" id="backButton">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <h6 class="h3 mb-0 text-gray-800">EDIT PRODUCT</h6>
    </div>

    <!-- Page Content -->
    <div class="container-fluid">
        <form action="{{ route('update-product', $product->product_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <!-- Success/Error Messages -->
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

            <div class="container-fluid">
                <div class="customer__page">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-md-7">
                            <!-- Product Details Card -->
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h2 class="card-title mb-3"><b>Product Details</b>
                                        <hr>
                                    </h2>

                                    <div class="form-group mb-3">
                                        <label for="product_name"><b>Product Name</b></label>
                                        <input type="text" name="product_name" id="product_name"
                                            value="{{ $product->product_name }}" placeholder="Product Name"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="product_name"><b>Permalink</b></label>
                                        <a href="{{ url($product->permalink) }}" target="_blank">
                                            {{$product->permalink}}
                                        </a>
                                    </div>




                                    <div class="form-group mb-3">
                                        <label for="description"><b>Description</b></label>
                                        <textarea name="description" id="description" placeholder="Description"
                                            class="form-control" rows="3"
                                            required>{{ $product->description }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="sku"><b>SKU</b></label>
                                        <input type="text" name="sku" id="sku" value="{{ $product->sku }}"
                                            placeholder="SKU" class="form-control" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="product_image"><b>Product Image</b></label>
                                        <input type="file" class="form-control" name="product_image" id="product_image"
                                            placeholder="Upload Product Image">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="top_view_image"><b>Top View Product Image</b></label>
                                        <input type="file" class="form-control" name="top_view_image" id="top_view_image"
                                            placeholder="Upload Top Product Image">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="price"><b>Price</b></label>
                                        <input type="text" name="price" id="price" value="{{ $product->price }}"
                                            placeholder="Price" class="form-control" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="taxes"><b>Taxes</b></label>
                                        <input type="text" name="taxes" id="taxes" value="{{ $product->taxes }}"
                                            placeholder="Tax" class="form-control" readonly>
                                    </div>


                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="tax">Select Tax</label>
                                                <select name="tax" id="tax" class="form-control">
                                                    <option value="" selected="selected">Select Tax</option>
                                                    @foreach($taxes as $tax)
                                                    <option value="{{$tax->name}}"
                                                        {{ in_array($tax->name, explode(',', $product->taxes)) ? 'selected' : '' }}>
                                                        {{$tax->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div id="selected-taxes-values-container" class="form-group mb-3">
                                                <label class="text-title-field">Selected Taxes Values</label>
                                                <div id="selected-taxes-values" class="p-3 border rounded bg-light">
                                                </div>
                                                <input type="hidden" name="taxes" id="hidden-taxes-values"
                                                    value="{{ $product->taxes }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Attributes Section Card -->
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h2 class="card-title mb-3"><b>Product Attributes</b></h2>
                                        <!-- Button to Open Modal -->
                                        <a class="JewelleryPrimaryButton mb-3" data-bs-toggle="modal"
                                            data-bs-target="#generateVariationsModal-{{ $product->product_id }}">
                                            Generate Variations
                                        </a>

                                        <a href="#" id="generate-variations" class="JewelleryPrimaryButton mb-3"
                                            data-bs-toggle="modal" data-bs-target="#uploadExcelModal">
                                            Upload Excel
                                        </a>

                                    </div>

                                    <table class="table table-bordered mt-2">
                                        <thead>
                                            <tr>
                                                @foreach ($attributeNames as $attributeName)
                                                <td>{{ $attributeName->title }}</td>
                                                @endforeach
                                                <td>Price</td>
                                                <td>Image</td>
                                                <td>Top View Image</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody id="variationsTableBody">
                                            @isset($variations)
                                            @forelse ($variations as $index => $variation)
                                            @php
                                            // Split the attribute_combination string into an array
                                            $attributes = explode(',', $variation->attribute_combination);
                                            @endphp
                                            <tr>
                                                @foreach ($attributeNames as $key => $attribute)
                                                <td>{{ isset($attributes[$key]) ? $attributes[$key] : 'N/A' }}</td>
                                                @endforeach

                                                <td>{{ $variation->price }}</td>
                                                <td>
                                                    <img src="{{ asset($variation->combination_image) }}"
                                                        alt="Attribute Image" style="width: 50px; height: 50px;" />
                                                </td>
                                                <td>
                                                    <img src="{{ asset($variation->top_view_image) }}"
                                                        alt="Attribute Image" style="width: 50px; height: 50px;" />
                                                </td>

                                                <td>
                                                    <span class="btn-sm edit-attribute-btn"
                                                        onclick="openEditAttributeModal({{ $variation->id }}, {{ json_encode($variation->price) }})">
                                                        Edit
                                                    </span>

                                                    <!-- Delete Button -->
                                                    <!-- <span class="btn-sm btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal-{{ $variation->id }}">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </span> -->
                                                </td>
                                            </tr>

                                            <!-- Delete Variation Modal -->
                                            <!-- <div class="modal fade" id="deleteModal-{{ $variation->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel-{{ $variation->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('delete-variation', $variation->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel-{{ $variation->id }}">Delete
                                                                    Variation</h5>
                                                                <button type="button" class="close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this variation?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> -->

                                            @empty
                                            <p>No variations found.</p>
                                            @endforelse
                                            @else
                                            <p>No variations found.</p>
                                            @endisset
                                        </tbody>



                                    </table>



                                    <!-- Add Hidden Inputs for Variations -->
                                    @foreach(session('variations', []) as $index => $variation)
                                    <input type="hidden" name="variations[{{ $index }}]"
                                        value="{{ implode(',', $variation) }}">
                                    @endforeach

                                </div>
                            </div>

                            <!-- SEO Meta Card -->
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h2 class="card-title mb-3"><b>Search Engine Optimize</b></h2>

                                    </div>

                                    <div class="mb-3">
                                        <p class="mb-1" style="color: #1a0dab; font-size: 18px; font-weight: bold;">
                                            {{  $product->product_name }}
                                        </p>
                                        <p class="mb-1" style="color: #006621; font-size: 14px;">
                                            {{$product->permalink }}
                                        </p>
                                        <p style="color: #545454; font-size: 13px;">
                                            {{ \Carbon\Carbon::parse($product->created_at)->format('Y/m/d') }}
                                        </p>
                                    </div>

                                    <!-- SEO Meta Fields -->
                                    <form>
                                        <div class="mb-3">
                                            <label for="seoTitle" class="form-label"><b>SEO Title</b></label>
                                            <input type="text" class="form-control" id="seoTitle" name="seo_title"
                                                value="{{ $product->seo_title }}" placeholder="Enter SEO Title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="seoDescription" class="form-label"><b>SEO
                                                    Description</b></label>
                                            <textarea class="form-control" id="seoDescription" rows="3"
                                                name="seo_description"
                                                placeholder="Enter SEO Description">{{ $product->seo_description }}</textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>

                        <!-- Sidebar: Category Tree -->
                        <div class="col-md-5">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header JewelleryPrimaryButton">
                                    <h5 class="mb-0">Categories</h5>
                                </div>
                                <div class="card-body" id="categoryTree">
                                    <ul class="list-unstyled">
                                        @foreach ($categories as $category)
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" name="categories[]" value="{{ $category->id }} "
                                                    class="me-2" @if(in_array($category->id,
                                                $selectedCategories->pluck('id')->toArray())) checked @endif>
                                                <label class="mb-0"><b>{{ $category->name }}</b></label>
                                            </div>
                                            @if ($category->children->isNotEmpty())
                                            <ul class="list-unstyled ms-3">
                                                @foreach ($category->children as $child)
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <input type="checkbox" name="categories[]"
                                                            value="{{ $child->id }}" class="me-2"
                                                            @if(in_array($child->id,
                                                        $selectedCategories->pluck('id')->toArray())) checked @endif>
                                                        <label class="mb-0">{{ $child->name }}</label>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3 mr-3 d-flex justify-content-end">
                        <button type="submit" class="JewelleryPrimaryButton">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Edit Attribute Modal -->
<div class="modal fade" id="editAttributeModal" tabindex="-1" role="dialog" aria-labelledby="editAttributeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editAttributeForm" method="POST" action="{{ route('update.variations') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editAttributeModalLabel">Edit Product Attribute</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Input field to show the index -->
                    <div class="form-group mb-3">
                        <label for="id">Index</label>
                        <input type="text" class="form-control" id="id" name="id" readonly>
                    </div>
                    <!-- Form fields to edit attributes -->
                    <div class="form-group mb-3">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="Editprice" name="price">
                    </div>

                    <!-- Input field for uploading images -->
                    <div class="form-group mb-3">
                        <label for="images">Image</label>
                        <input type="file" class="form-control" id="images" name="combination_image">
                    </div>

                      <!-- Input field for uploading images -->
                      <div class="form-group mb-3">
                        <label for="images">Top View Image</label>
                        <input type="file" class="form-control" id="images" name="top_view_image">
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Cancel button with the data-bs-dismiss="modal" attribute to close the modal -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Generate Variation Modal -->
<div class="modal fade" id="generateVariationsModal-{{ $product->product_id }}" tabindex="-1"
    aria-labelledby="generateVariationsModalLabel-{{ $product->product_id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generateVariationsModalLabel-{{ $product->product_id }}">
                    Generate Variations
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to generate all variations for this
                product?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="generateVariationsForm" action="{{ route('generate-variations', $product->product_id) }}"
                    method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Yes,
                        Generate</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!--Excel Upload  Modal -->
<div class="modal fade" id="uploadExcelModal" tabindex="-1" aria-labelledby="uploadExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadExcelModalLabel">Upload Excel File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('upload-variations-excel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="variationsExcel">Upload Excel File</label>
                        <input type="file" name="variationsExcel" id="variationsExcel" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Upload and Update Variations</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
const generateButton = document.getElementById('generate-variations');
const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
const variationsTableBody = document.getElementById('variationsTableBody');

function openEditAttributeModal(id, price) {

    // Set values in modal input fields
    document.getElementById('id').value = id;
    document.getElementById('Editprice').value = price;

    // Open the modal using Bootstrap's modal class
    const modal = new bootstrap.Modal(document.getElementById('editAttributeModal'));
    modal.show();
}


// Show confirmation modal when the Generate Variations button is clicked
generateButton.addEventListener('click', function(event) {
    event.preventDefault();
    confirmationModal.show();
});

// Check if there are variations in the session
@if(session('variations'))
const variations = @json(session('variations'));

// Clear existing rows in the table
variationsTableBody.innerHTML = '';

// Loop through the variations and create table rows
variations.forEach((variation, index) => {
    const row = document.createElement('tr');
    let cells = `<td>${index + 1}</td>`; // Add the serial number

    variation.forEach(attributeValue => {
        cells += `<td>${attributeValue}</td>`; // Add each attribute value
    });

    cells += `<td>{{ $product->price }}</td>`;

    // Add Remove button
    cells += `<td><button class="btn btn-danger btn-sm remove-btn">Remove</button></td>`;

    row.innerHTML = cells;
    variationsTableBody.appendChild(row);
});

// Attach event listeners to remove buttons
document.querySelectorAll('.remove-btn').forEach((button, idx) => {
    button.addEventListener('click', function() {
        // Remove the corresponding row from the table
        variationsTableBody.deleteRow(idx);

        // Optionally, update the serial numbers
        updateSerialNumbers();
    });
});

// Function to update serial numbers after row removal
function updateSerialNumbers() {
    document.querySelectorAll('#variationsTableBody tr').forEach((row, newIndex) => {
        row.cells[0].textContent = newIndex + 1; // Update serial number
    });
}
@endif
</script>

<script>
document.getElementById('imageUpload').addEventListener('change', function(event) {
    const imagePreview = document.getElementById('imagePreview');
    imagePreview.innerHTML = ''; // Clear previous previews

    Array.from(event.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = file.name;
            img.style.width = '100px';
            img.style.height = '100px';
            img.style.objectFit = 'cover';
            img.classList.add('rounded', 'border');
            imagePreview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>

<script>
// Listen for the form submission (deletion)
document.querySelectorAll('.delete-variation-form').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        const formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // If successful, remove the row from the table
                    const row = form.closest('tr');
                    row.remove();
                } else {
                    alert('Failed to delete the variation.');
                }
            });
    });
});
</script>

<script>
const taxSelect = document.getElementById('tax');
const selectedTaxesDiv = document.getElementById('selected-taxes-values');
const hiddenTaxesInput = document.getElementById('hidden-taxes-values');

// Initialize selected taxes from the hidden input (if any)
const selectedTaxes = hiddenTaxesInput.value ? hiddenTaxesInput.value.split(',') : [];

const updateSelectedTaxes = () => {
    // Update the div with selected taxes
    selectedTaxesDiv.innerHTML = selectedTaxes
        .map(tax =>
            `<span class="badge badge-primary m-1">${tax} 
                <button type="button" class="btn btn-sm btn-danger ml-1" onclick="removeTax('${tax}')">x</button>
            </span>`
        )
        .join('');

    // Update the hidden input value as comma-separated
    hiddenTaxesInput.value = selectedTaxes.join(',');
};

// Add event listener to the select dropdown
taxSelect.addEventListener('change', function() {
    const selectedTax = this.value;

    if (selectedTax && !selectedTaxes.includes(selectedTax)) {
        selectedTaxes.push(selectedTax);
        updateSelectedTaxes(); // Update UI and hidden input
    }
});

function removeTax(tax) {
    const index = selectedTaxes.indexOf(tax);
    if (index > -1) {
        selectedTaxes.splice(index, 1);
        updateSelectedTaxes(); // Update UI and hidden input
    }
}

// Initialize selected taxes on page load
updateSelectedTaxes();
</script>



@endsection