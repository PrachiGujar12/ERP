@extends('layouts.dashboard')

@section('title', 'Create Discount')
@section('meta_description', 'System user list.')

@section('content')
<div id="content">
    <!-- Header Section -->
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
        position: sticky;
        top: 0;
        z-index: 100;">
        <a href="{{ url('discount-list') }}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
        <div class="mb-2 mb-md-0 p-0">
            <h6 class="h2 mb-0 text-gray-800">ADD NEW DISCOUNT</h6>
        </div>
        <div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid py-4">
        <div class="customer__page">
            <div class="card p-4">
                <form action="{{ route('store-discount') }}" method="POST">
                    @csrf

                    <!-- Coupon Code and Discount On -->
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="coupon-code">Coupon Code:
                                <a href="#" id="generate-code" style="font-size: 0.9em; margin-left: 10px;">Generate
                                    Code</a>
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Coupon Code" id="coupon-code"
                                name="coupon_code" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="discount-on">Discount On:</label>
                            <select name="discount_on" id="discount-on" class="form-control" required>
                                <option value="" disabled selected>-- Select Discount Type --</option>
                                <option value="category">Category</option>
                                <option value="product">Product</option>
                            </select>
                        </div>
                    </div>

                      <!-- Category List and Selected category -->
                      <div class="form-row">
                        <div id="category-list-container" class="col-md-6 mb-3" style="display: none;">
                            <label for="category-list">Select Category:</label>
                            <select id="category-list" name="category_id" class="form-control">
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-title-field">Selected Category</label>
                            <div id="selected-category-value" class="p-3 border rounded bg-light"></div>
                            <input type="hidden" name="category_id" id="hidden-category-value">
                        </div>
                    </div>

                    <!-- Product List and Selected Product -->
                    <div class="form-row">
                        <div id="product-list-container" class="col-md-6 mb-3" style="display: none;">
                            <label for="product-list">Select Product:</label>
                            <select id="product-list" name="product_id" class="form-control">
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-title-field">Selected Product</label>
                            <div id="selected-product-value" class="p-3 border rounded bg-light"></div>
                            <input type="hidden" name="product_id" id="hidden-product-value">
                        </div>
                    </div>

                    <!-- Discount Type and Value -->
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="discount-type">Discount Type:</label>
                            <select id="discount-type" name="discount_type" class="form-control" required>
                                <option value="" disabled selected>Select Discount Type</option>
                                <option value="percentage">Percentage (%)</option>
                                <option value="fixed">Fixed Amount</option>
                            </select>
                        </div>
                        <div id="fixed-discount" class="col-md-6 mb-3" style="display: none;">
                            <label for="fixed-discount-value">Fixed Discount Value:</label>
                            <input type="number" id="fixed-discount-value" class="form-control"
                                name="fixed_discount_value" placeholder="Enter fixed discount value">
                        </div>
                        <div id="percentage-discount" class="col-md-6 mb-3" style="display: none;">
                            <label for="percentage-discount-value">Percentage Discount Value:</label>
                            <input type="number" id="percentage-discount-value" class="form-control"
                                name="percentage_discount_value" placeholder="Enter percentage value">
                        </div>
                    </div>

                    <!-- Date and Time Fields -->
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="start-date">Start Date:</label>
                            <input type="date" id="start-date" class="form-control" name="start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="start-time">Start Time:</label>
                            <input type="time" id="start-time" class="form-control" name="start_time" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="end-date">End Date:</label>
                            <input type="date" id="end-date" class="form-control" name="end_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end-time">End Time:</label>
                            <input type="time" id="end-time" class="form-control" name="end_time" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="JewelleryPrimaryButton">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const discountTypeSelect = document.getElementById('discount-type');
    const fixedDiscountDiv = document.getElementById('fixed-discount');
    const percentageDiscountDiv = document.getElementById('percentage-discount');
    const fixedDiscountInput = document.getElementById('fixed-discount-value');
    const percentageDiscountInput = document.getElementById('percentage-discount-value');

    discountTypeSelect.addEventListener('change', function() {
        // Hide both inputs by default
        fixedDiscountDiv.style.display = 'none';
        percentageDiscountDiv.style.display = 'none';

        // Remove required attribute from both inputs
        fixedDiscountInput.removeAttribute('required');
        percentageDiscountInput.removeAttribute('required');

        // Show and add required attribute to the selected input
        if (this.value === 'fixed') {
            fixedDiscountDiv.style.display = 'block';
            fixedDiscountInput.setAttribute('required', 'required');
        } else if (this.value === 'percentage') {
            percentageDiscountDiv.style.display = 'block';
            percentageDiscountInput.setAttribute('required', 'required');
        }
    });
});
</script>

<script>
// Function to generate a random coupon code
function generateCouponCode(length = 8) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let couponCode = '';
    for (let i = 0; i < length; i++) {
        couponCode += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return couponCode;
}

// Event listener for the "Generate Code" link
document.getElementById('generate-code').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default link behavior
    const couponCode = generateCouponCode(); // Generate the code
    document.getElementById('coupon-code').value = couponCode; // Set the value of the input
});
</script>


<script>
    //script for product list
document.addEventListener("DOMContentLoaded", function() {
    const discountOnDropdown = document.getElementById('discount-on');
    const productListContainer = document.getElementById('product-list-container');
    const productList = document.getElementById('product-list');
    const selectedAttributeValuesContainer = document.getElementById('selected-product-value-container');
    const selectedAttributeValues = document.getElementById('selected-product-value');
    const hiddenAttributeValuesInput = document.getElementById('hidden-product-value');



    let selectedProducts = []; // Array to hold the selected product IDs

    discountOnDropdown.addEventListener('change', function() {
        if (this.value === 'product') {
            productListContainer.style.display = 'block';

            // Fetch products using AJAX
            fetch('{{ route('get-products') }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(products => {
                    // Clear previous options
                    productList.innerHTML =
                        '<option value="" disabled selected>-- Select a Product --</option>';

                    // Populate the dropdown with product names
                    if (products.length > 0) {
                        products.forEach(product => {
                            const option = document.createElement('option');
                            option.value = product
                                .product_id; // Adjust key as per API response
                            option.textContent = product
                                .product_name; // Adjust key as per API response
                            productList.appendChild(option);
                        });
                    } else {
                        const option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'No products available';
                        productList.appendChild(option);
                    }
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'Error fetching products';
                    productList.appendChild(option);
                });
        } else {
            productListContainer.style.display = 'none';
            selectedAttributeValuesContainer.style.display = 'none';
        }
    });

    // Event listener for product selection
    productList.addEventListener('change', function() {
        const selectedProductId = this.value;
        const selectedProductName = this.options[this.selectedIndex].text;

        // Update selected products array and the display
        if (selectedProductId) {
            if (!selectedProducts.includes(selectedProductId)) {
                selectedProducts.push(selectedProductId); // Add the selected product ID to the array
                selectedAttributeValues.innerHTML = selectedProducts.map(id => {
                    const selectedOption = Array.from(productList.options).find(option => option
                        .value == id);
                    return selectedOption ? selectedOption.text : '';
                }).join(', '); // Display comma-separated product names

                // Store the comma-separated product IDs in the hidden input
                hiddenAttributeValuesInput.value = selectedProducts.join(', ');
            }
        } else {
            // Reset if no product is selected
            selectedProducts = [];
            selectedAttributeValues.innerHTML = '';
            hiddenAttributeValuesInput.value = '';
        }
    });
});
</script>

<script>
    //script for category list
document.addEventListener("DOMContentLoaded", function() {
    const discountOnDropdown = document.getElementById('discount-on');
    const categoryListContainer = document.getElementById('category-list-container');
    const categoryList = document.getElementById('category-list');
    const selectedCategoryValuesContainer = document.getElementById('selected-category-value-container');
    const selectedCategoryValues = document.getElementById('selected-category-value');
    const hiddenCategoryValuesInput = document.getElementById('hidden-category-value');

    let selectedCategories = []; // Array to hold the selected category IDs

    discountOnDropdown.addEventListener('change', function() {
        if (this.value === 'category') {
            categoryListContainer.style.display = 'block';

            // Fetch categories using AJAX
            fetch('{{ route('get-product-category') }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(categories => {
                    // Clear previous options
                    categoryList.innerHTML =
                        '<option value="" disabled selected>-- Select a Category --</option>';

                    // Populate the dropdown with category names
                    if (categories.length > 0) {
                        categories.forEach(category => {
                            const option = document.createElement('option');
                            option.value = category.id; // Adjust key as per API response
                            option.textContent = category.name; // Adjust key as per API response
                            categoryList.appendChild(option);
                        });
                    } else {
                        const option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'No categories available';
                        categoryList.appendChild(option);
                    }
                })
                .catch(error => {
                    console.error('Error fetching categories:', error);
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'Error fetching categories';
                    categoryList.appendChild(option);
                });
        } else {
            categoryListContainer.style.display = 'none';
            selectedCategoryValuesContainer.style.display = 'none';
        }
    });

    // Event listener for category selection
    categoryList.addEventListener('change', function() {
        const selectedCategoryId = this.value;
        const selectedCategoryName = this.options[this.selectedIndex].text;

        // Update selected categories array and the display
        if (selectedCategoryId) {
            if (!selectedCategories.includes(selectedCategoryId)) {
                selectedCategories.push(selectedCategoryId); // Add the selected category ID to the array
                selectedCategoryValues.innerHTML = selectedCategories.map(id => {
                    const selectedOption = Array.from(categoryList.options).find(option => option
                        .value == id);
                    return selectedOption ? selectedOption.text : '';
                }).join(', '); // Display comma-separated category names

                // Store the comma-separated category IDs in the hidden input
                hiddenCategoryValuesInput.value = selectedCategories.join(', ');
            }
        } else {
            // Reset if no category is selected
            selectedCategories = [];
            selectedCategoryValues.innerHTML = '';
            hiddenCategoryValuesInput.value = '';
        }
    });
});
</script>


@endsection