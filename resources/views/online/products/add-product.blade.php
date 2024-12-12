@extends('layouts.dashboard')

@section('title', 'Create Product')
@section('meta_description', 'System user list.')

@section('content')
<div id="content">
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
        <a href="{{url('product-list')}}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
        <div class=" mb-2 mb-md-0 p-0">
            <h6 class="h2 mb-0 text-gray-800">ADD NEW PRODUCT</h6>
        </div>
        <div class=" d-flex gap-2 justify-content-md-end p-0">

        </div>
    </div>

    <div class="container-fluid">
        <div class="customer__page">
            <!-- Page Content -->
            <form action="{{ route('store-product') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-md-7">
                        <!-- Product Details Card -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h2 class="card-title mb-3"><b>Product Details</b>
                                    <hr>
                                </h2>

                                <!-- Product Name -->
                                <div class="form-group mb-3">
                                    <label for="product_name"><b>Product Name</b></label>
                                    <input type="text" name="product_name" id="product_name" placeholder="Product Name"
                                        class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="permalink"><b>Permalink</b></label>
                                    <input type="text" name="permalink" id="permalink" placeholder="Permalink"
                                        class="form-control" readonly>
                                </div>

                                <!-- Description -->
                                <div class="form-group mb-3">
                                    <label for="description"><b>Description</b></label>
                                    <textarea name="description" id="description" placeholder="Description"
                                        class="form-control" rows="3" required></textarea>
                                </div>

                                <!-- SKU -->
                                <div class="form-group mb-3">
                                    <label for="sku"><b>SKU</b></label>
                                    <input type="text" name="sku" id="sku" placeholder="SKU" class="form-control"
                                        required>
                                </div>

                                <!-- Product Image -->
                                <div class="form-group mb-3">
                                    <label for="product_image"><b>Product Image</b></label>
                                    <input type="file" class="form-control" name="product_image" id="product_image"
                                        placeholder="Upload Product Image">
                                </div>

                                 <!-- Product Image -->
                                 <div class="form-group mb-3">
                                    <label for="top_view_image"><b>Top View Product Image</b></label>
                                    <input type="file" class="form-control" name="top_view_image" id="top_view_image"
                                        placeholder="Upload Top View Product Image">
                                </div>

                                <!-- Price -->
                                <div class="form-group mb-3">
                                    <label for="price"><b>Price</b></label>
                                    <input type="text" name="price" id="price" placeholder="Price" class="form-control"
                                        required>
                                </div>

                                <!-- Tax -->
                                <div class="row col-md-12 ">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="tax">Select Tax</label>
                                            <select name="taxes" id="tax" class="form-control" required>
                                                <option value="" selected="selected">Select Tax</option>
                                                @foreach($taxes as $tax)
                                                <option value="{{$tax->name}}">{{$tax->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div id="selected-taxes-values-container" class="form-group mb-3">
                                            <label class="text-title-field">Selected Taxes Values</label>
                                            <div id="selected-taxes-values" class="p-3 border rounded bg-light"></div>
                                            <input type="hidden" name="taxes[]" id="hidden-taxes-values">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Attributes Section Card -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h2 class="card-title"><b>Product Attributes</b></h2>
                                <hr>

                                <div id="attribute-container" class="list-product-attribute-values-wrap mt-3">
                                    <!-- Dynamic Attribute Rows -->
                                </div>
                                <button type="button" class="JewelleryPrimaryButton mt-2" id="add-attribute-btn">Add New
                                    Attribute</button>
                            </div>
                        </div>

                        <!-- SEO Meta Card -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h2 class="card-title mb-3"><b>Search Engine Optimize</b></h2>

                                </div>

                                <!-- SEO Meta Fields -->
                                <form>
                                    <div class="mb-3">
                                        <label for="seoTitle" class="form-label">SEO Title</label>
                                        <input type="text" class="form-control" id="seoTitle" name="seo_title"
                                            placeholder="Enter SEO Title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="seoDescription" class="form-label">SEO Description</label>
                                        <textarea class="form-control" id="seoDescription" rows="3"
                                            name="seo_description" placeholder="Enter SEO Description"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="JewelleryPrimaryButton mb-3 ">Save</button>
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
                                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                                class="me-2">
                                            <label class="mb-0"> <b> {{ $category->name }} </b></label>
                                        </div>
                                        <!-- Subcategories -->
                                        @if ($category->children->isNotEmpty())
                                        <ul class="list-unstyled ms-3">
                                            @foreach ($category->children as $child)
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <input type="checkbox" name="categories[]" value="{{ $child->id }}"
                                                        class="me-2">
                                                    <label class="mb-0"> {{ $child->name }}</label>
                                                </div>
                                                <!-- Grandchildren -->
                                                @if ($child->children->isNotEmpty())
                                                <ul class="list-unstyled ms-3">
                                                    @foreach ($child->children as $grandChild)
                                                    <li>
                                                        <div class="d-flex align-items-center">
                                                            <input type="checkbox" name="categories[]"
                                                                value="{{ $grandChild->id }}" class="me-2">
                                                            <label class="mb-0"> {{ $grandChild->name }}</label>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
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
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for Dynamic Attributes -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('product_name').addEventListener('blur', function() {
    const productName = this.value.trim();
    const permalink = 'https://demo.webwideit.solutions/online-raman-jeweller-erp/public/products/' +
        productName
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric characters with '-'
        .replace(/^-+|-+$/g, ''); // Remove leading/trailing dashes

    document.getElementById('permalink').value = permalink;
});
</script>
<script>
$(document).ready(function() {
    var selectedAttributes = []; // Store selected attribute names

    // Add new attribute when the "Add new attribute" button is clicked
    $('#add-attribute-btn').click(function(e) {
        e.preventDefault();

        var newAttributeHTML = `
            <div class="product-attribute-set-item mb-3 mt-2">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group mb-3">
                            <label class="text-title-field"><b>Attribute Name</b></label>
                            <select class="next-input product-select-attribute-item form-control" name="attribute_name[]">
                                <option value="">Select Attribute</option>
                                @foreach ($attributes as $attribute)
                                    <option value="{{ $attribute->product_attribute_id }}" class="attribute-option">{{ $attribute->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group mb-3">
                            <label class="text-title-field"><b>Attribute Value</b></label>
                            <select class="next-input product-select-attribute-value-item form-control">
                                <option value="">Select a value</option>
                            </select>
                        </div>
                    </div>

                    <div id="selected-attribute-values-container" class="form-group mb-3">
                        <label class="text-title-field">Selected Attribute Values</label>
                        <div id="selected-attribute-values" class="p-3 border rounded bg-light"></div>
                        <!-- Hidden input to store attribute values for submission -->
                        <input type="hidden" name="attribute_value[]" id="hidden-attribute-values">
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="form-group mb-3">
                            <label>&nbsp;</label>
                            <div>
                                <a href="#" class="btn btn-danger remove-attribute-btn">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        $('#attribute-container').append(newAttributeHTML);
        disableSelectedAttributes();
    });

    // Fetch attribute values via AJAX for the selected attribute
    $(document).on('change', '.product-select-attribute-item', function() {
        var selectedAttributeId = $(this).val();
        var valueDropdown = $(this).closest('.product-attribute-set-item').find(
            '.product-select-attribute-value-item');

        if (selectedAttributeId) {
            $.ajax({
                url: "{{ route('get-attribute-values') }}",
                method: 'GET',
                data: {
                    product_attribute_id: selectedAttributeId
                },
                success: function(response) {
                    var options = '<option value="">Select a value</option>';
                    $.each(response, function(index, value) {
                        options +=
                            `<option value="${value.attribute_value_id}">${value.title}</option>`;
                    });
                    valueDropdown.html(options);
                },
                error: function() {
                    valueDropdown.html('<option value="">No values found</option>');
                }
            });
        } else {
            valueDropdown.html('<option value="">Select a value</option>');
        }

        disableSelectedAttributes();
    });

    // Add the selected value to the display div
    $(document).on('change', '.product-select-attribute-value-item', function() {
        var selectedValue = $(this).find(":selected").text();
        var hiddenInput = $(this).closest('.product-attribute-set-item').find(
            '#hidden-attribute-values');
        var displayDiv = $(this).closest('.product-attribute-set-item').find(
            '#selected-attribute-values');

        if (selectedValue && selectedValue !== "Select a value") {
            var existingValues = hiddenInput.val() ? hiddenInput.val().split(',') : [];
            if (!existingValues.includes(selectedValue)) {
                existingValues.push(selectedValue);
                hiddenInput.val(existingValues.join(',')); // Update hidden input's value
                displayDiv.append(
                    `<span class="badge bg-primary text-white me-1 selected-value" data-value="${selectedValue}">
                        ${selectedValue} <span class="remove-value-btn ms-2 text-danger" style="cursor: pointer;">&times;</span>
                    </span>`
                );
            }
        }
    });

    // Remove a selected value when the remove button is clicked
    $(document).on('click', '.remove-value-btn', function() {
        var valueToRemove = $(this).closest('.selected-value').data('value'); // Get the value to remove
        var hiddenInput = $(this).closest('.product-attribute-set-item').find(
            '#hidden-attribute-values');
        var existingValues = hiddenInput.val() ? hiddenInput.val().split(',') : [];

        // Remove the value from the array
        existingValues = existingValues.filter(function(value) {
            return value !== valueToRemove;
        });

        hiddenInput.val(existingValues.join(',')); // Update the hidden input's value
        $(this).closest('.selected-value').remove(); // Remove the badge visually
    });

    // Disable already selected attributes in all dropdowns
    function disableSelectedAttributes() {
        $('.product-select-attribute-item').each(function() {
            var dropdown = $(this);
            dropdown.find('option').each(function() {
                var optionValue = $(this).val();
                if (selectedAttributes.includes(optionValue)) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).prop('disabled', false);
                }
            });
        });
    }

    // Remove an attribute row
    $(document).on('click', '.remove-attribute-btn', function(e) {
        e.preventDefault();
        $(this).closest('.product-attribute-set-item').remove();
        disableSelectedAttributes();
    });
});
</script>


<script>
const taxSelect = document.getElementById('tax');
const selectedTaxesDiv = document.getElementById('selected-taxes-values');
const hiddenTaxesInput = document.getElementById('hidden-taxes-values');

const selectedTaxes = []; // To store selected tax values

taxSelect.addEventListener('change', function() {
    const selectedTax = this.value;

    if (selectedTax && !selectedTaxes.includes(selectedTax)) {
        selectedTaxes.push(selectedTax);

        // Update the div with selected taxes
        selectedTaxesDiv.innerHTML = selectedTaxes
            .map(tax =>
                `<span class="badge badge-primary m-1">${tax} <button type="button" class="btn btn-sm btn-danger ml-1" onclick="removeTax('${tax}')">x</button></span>`
                )
            .join('');

        // Update the hidden input value as comma-separated
        hiddenTaxesInput.value = selectedTaxes.join(',');
    }
});

function removeTax(tax) {
    const index = selectedTaxes.indexOf(tax);
    if (index > -1) {
        selectedTaxes.splice(index, 1);

        // Update the div with selected taxes
        selectedTaxesDiv.innerHTML = selectedTaxes
            .map(t =>
                `<span class="badge badge-primary m-1">${t} <button type="button" class="btn btn-sm btn-danger ml-1" onclick="removeTax('${t}')">x</button></span>`
                )
            .join('');

        // Update the hidden input value as comma-separated
        hiddenTaxesInput.value = selectedTaxes.join(',');
    }
}
</script>

@endsection