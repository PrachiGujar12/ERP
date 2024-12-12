@extends('layouts.dashboard')

@section('title', 'Edit Discount')
@section('meta_description', 'System attribute edit page.')

@section('content')
<div id="content">
    <!-- Header Section -->
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header"
        style="position: sticky; top: 0; z-index: 100;">
        <a href="{{ url('discount-list') }}" class="JewelleryPrimaryButton" id="backButton">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <h6 class="h3 mb-0 text-gray-800">EDIT DISCOUNT</h6>
        <div></div>
    </div>

    <!-- Page Content -->
    <div class="container-fluid py-4">
        <div class="card mt-3 p-4">
            <form action="{{ route('update-discount', $discount->discount_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <!-- Success and Error Messages -->
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

                <!-- Coupon Code and Discount On -->
                <div class="form-group row">
                    <!-- Coupon Code -->
                    <div class="col-md-6">
                        <label for="coupon-code">Coupon Code:
                            <a href="#" id="generate-code" style="font-size: 0.9em; margin-left: 10px;">Generate
                                Code</a>
                        </label>
                        <input type="text" class="form-control" placeholder="Enter Coupon Code" id="coupon-code"
                            name="coupon_code" value="{{ old('coupon_code', $discount->coupon_code) }}" required>
                    </div>

                    <!-- Discount On -->
                    <div class="col-md-6">
                        <label for="discount-on">Discount On:</label>
                        <select name="discount_on" id="discount-on" class="form-control" required>
                            <option value="" disabled
                                {{ old('discount_on', $discount->discount_on) == '' ? 'selected' : '' }}>
                                -- Select Discount Type --
                            </option>
                            <option value="category"
                                {{ old('discount_on', $discount->discount_on) == 'category' ? 'selected' : '' }}>
                                Category
                            </option>
                            <option value="product"
                                {{ old('discount_on', $discount->discount_on) == 'product' ? 'selected' : '' }}>
                                Product
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group row col-md-12" id="product-field" style="display: none;">
                    <label for="product-id">Selected Products:</label>
                    <input type="text" class="form-control" id="product-id" name=""
                        value="{{ old('product_id', $discount->product_id) }}" readonly>
                </div>

                <div class="form-group row col-md-12" id="category-field" style="display: none;">
                    <label for="category-id">Selected Category:</label>
                    <input type="text" class="form-control" id="category-id" name=""
                        value="{{ old('category_id', $discount->category_id) }}" readonly>
                </div>

                <!-- Category Selection -->
                <div class="form-group row" id="category-list-container" style="display: none;">
                    <!-- Select Category -->
                    <div class="col-md-6">
                        <label for="category-list">Select Category:</label>
                        <select id="category-list" name="category_id" class="form-control"></select>
                    </div>

                    <!-- Selected Categories -->
                    <div class="col-md-6">
                        <label for="selected-category-value">Selected Category:</label>
                        <div id="selected-category-value" class="p-3 border rounded bg-light"></div>
                        <input type="hidden" name="category_id" id="hidden-category-value">
                    </div>
                </div>

                <!-- Product Selection -->
                <div class="form-group row" id="product-list-container" style="display: none;">
                    <!-- Select Product -->
                    <div class="col-md-6">
                        <label for="product-list">Select Product:</label>
                        <select id="product-list" name="product_id" class="form-control"></select>
                    </div>

                    <!-- Selected Products -->
                    <div class="col-md-6 mt-2">
                        <label for="selected-product-value">Selected Products:</label>
                        <div id="selected-product-value" class="p-3 border rounded bg-light"></div>
                        <input type="hidden" name="product_id" id="hidden-product-value">
                    </div>
                </div>

                <!-- Discount Type -->
                <div class="form-group row">
                    <!-- Discount Type -->
                    <div class="col-md-6">
                        <label for="discount-type">Discount Type:</label>
                        <select id="discount-type" name="discount_type" class="form-control" required>
                            <option value="" disabled
                                {{ old('discount_type', $discount->discount_type) == '' ? 'selected' : '' }}>
                                Select Discount Type
                            </option>
                            <option value="percentage"
                                {{ old('discount_type', $discount->discount_type) == 'percentage' ? 'selected' : '' }}>
                                Percentage (%)
                            </option>
                            <option value="fixed"
                                {{ old('discount_type', $discount->discount_type) == 'fixed' ? 'selected' : '' }}>
                                Fixed Amount
                            </option>
                        </select>
                    </div>

                    <!-- Fixed Discount Value -->
                    <div id="fixed-discount" class="col-md-6" style="display: none;">
                        <label for="fixed-discount-value">Fixed Discount Value:</label>
                        <input type="number" id="fixed-discount-value" class="form-control" name="fixed_discount_value"
                            value="{{ old('fixed_discount_value', $discount->fixed_discount_value) }}"
                            placeholder="Enter fixed discount value">
                    </div>

                    <!-- Percentage Discount Value -->
                    <div id="percentage-discount" class="col-md-6" style="display: none;">
                        <label for="percentage-discount-value">Percentage Discount Value:</label>
                        <input type="number" id="percentage-discount-value" class="form-control"
                            name="percentage_discount_value"
                            value="{{ old('percentage_discount_value', $discount->percentage_discount_value) }}"
                            placeholder="Enter percentage value">
                    </div>
                </div>

                <!-- Date and Time Fields -->
                <div class="form-group row">
                    <!-- Start Date -->
                    <div class="col-md-6">
                        <label for="start-date">Start Date:</label>
                        <input type="date" id="start-date" class="form-control" name="start_date"
                            value="{{ old('start_date', $discount->start_date) }}" required>
                    </div>

                    <!-- Start Time -->
                    <div class="col-md-6">
                        <label for="start-time">Start Time:</label>
                        <input type="time" id="start-time" class="form-control" name="start_time"
                            value="{{ old('start_time', $discount->start_time) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <!-- End Date -->
                    <div class="col-md-6">
                        <label for="end-date">End Date:</label>
                        <input type="date" id="end-date" class="form-control" name="end_date"
                            value="{{ old('end_date', $discount->end_date) }}" required>
                    </div>

                    <!-- End Time -->
                    <div class="col-md-6">
                        <label for="end-time">End Time:</label>
                        <input type="time" id="end-time" class="form-control" name="end_time"
                            value="{{ old('end_time', $discount->end_time) }}" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end p-3">
                    <button type="submit" class="JewelleryPrimaryButton">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const discountType = document.getElementById('discount-type');
    const fixedDiscount = document.getElementById('fixed-discount');
    const percentageDiscount = document.getElementById('percentage-discount');
    const discountOnDropdown = document.getElementById('discount-on');
    const productListContainer = document.getElementById('product-list-container');
    const productList = document.getElementById('product-list');
    const selectedProductValue = document.getElementById('selected-product-value');
    const hiddenProductValue = document.getElementById('hidden-product-value');
    let selectedProducts = [];

    function toggleDiscountFields() {
        const value = discountType.value;
        fixedDiscount.style.display = value === 'fixed' ? 'block' : 'none';
        percentageDiscount.style.display = value === 'percentage' ? 'block' : 'none';
    }

    discountType.addEventListener('change', toggleDiscountFields);
    toggleDiscountFields();

    discountOnDropdown.addEventListener('change', function() {
        if (this.value === 'product') {
            productListContainer.style.display = 'block';
            fetch('{{ route('get-products') }}')
                .then(response => response.json())
                .then(products => {
                    productList.innerHTML =
                        '<option value="" disabled selected>-- Select Products --</option>';
                    products.forEach(product => {
                        const option = document.createElement('option');
                        option.value = product.product_id;
                        option.textContent = product.product_name;
                        productList.appendChild(option);
                    });
                })
                .catch(() => {
                    productList.innerHTML = '<option value="">Error fetching products</option>';
                });
        } else {
            productListContainer.style.display = 'none';
        }
    });

    productList.addEventListener('change', function() {
        const selectedOption = productList.options[productList.selectedIndex];
        if (selectedOption && !selectedProducts.includes(selectedOption.value)) {
            selectedProducts.push(selectedOption.value);
            selectedProductValue.textContent = selectedProducts
                .map(id => productList.querySelector(`option[value="${id}"]`).textContent)
                .join(', ');
            hiddenProductValue.value = selectedProducts.join(',');
        }
    });

    document.getElementById('generate-code').addEventListener('click', function(event) {
        event.preventDefault();
        const code = Array.from({
                length: 8
            }, () =>
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'.charAt(Math.floor(Math.random() * 36))
        ).join('');
        document.getElementById('coupon-code').value = code;
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const discountSelect = document.getElementById("discount-on");
        const productField = document.getElementById("product-field");
        const categoryField = document.getElementById("category-field");

        // Function to toggle fields based on selection
        function toggleFields() {
            const selectedValue = discountSelect.value;
            if (selectedValue === "product") {
                productField.style.display = "block";
                categoryField.style.display = "none";
            } else if (selectedValue === "category") {
                productField.style.display = "none";
                categoryField.style.display = "block";
            } else {
                productField.style.display = "none";
                categoryField.style.display = "none";
            }
        }

        // Attach change event to the dropdown
        discountSelect.addEventListener("change", toggleFields);

        // Initialize fields based on old values
        toggleFields();
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const discountOnDropdown = document.getElementById('discount-on');
    const categoryListContainer = document.getElementById('category-list-container');
    const categoryList = document.getElementById('category-list');
    const selectedCategoryValue = document.getElementById('selected-category-value');
    const hiddenCategoryValue = document.getElementById('hidden-category-value');

    let selectedCategories = [];

    // Handle dropdown change
    discountOnDropdown.addEventListener('change', function() {
        if (this.value === 'category') {
            categoryListContainer.style.display = 'block';

            // Fetch categories
            fetch('{{ route('get-product-category') }}')
                .then(response => response.json())
                .then(categories => {
                    categoryList.innerHTML =
                        '<option value="" disabled selected>-- Select Category --</option>';
                    categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name;
                        categoryList.appendChild(option);
                    });
                })
                .catch(() => {
                    categoryList.innerHTML = '<option value="">Error fetching categories</option>';
                });
        } else {
            categoryListContainer.style.display = 'none';
        }
    });

    // Handle category selection
    categoryList.addEventListener('change', function() {
        const selectedOption = categoryList.options[categoryList.selectedIndex];
        if (selectedOption && !selectedCategories.includes(selectedOption.value)) {
            selectedCategories.push(selectedOption.value);

            // Update selected categories display
            selectedCategoryValue.textContent = selectedCategories
                .map(id => categoryList.querySelector(`option[value="${id}"]`).textContent)
                .join(', ');

            // Update hidden input value
            hiddenCategoryValue.value = selectedCategories.join(',');
        }
    });
});
</script>
@endsection