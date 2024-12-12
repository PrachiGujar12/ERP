@extends('online-frontend.layouts.app')
@section('title', 'Product Details')
@section('content')

<style>
#uploadedImageContainer {
    position: relative;
    /* Ensures that the ring image is positioned relative to this container */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 300px;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
}

#ringImage {
    position: absolute;
    top: 45%;
    /* Adjust to position the ring on the middle finger */
    left: 48%;
    /* Adjust to position the ring */
    width: 15%;
    /* Adjust the size of the ring */
    /* Prevent interaction with the ring image */
    cursor: grab;
    /* Indicate the element is draggable */
    z-index: 10;
    /* Ensure it appears above other elements */
}

.hand-image {
    max-width: 100%;
    max-height: 300px;
    object-fit: cover;
}
</style>

<div class="single-product py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 ">
                <div class="">
                    <div class="">
                        <div class="tab-content mt-4">
                            <div class="tab-pane fade show active" id="metal-tab1" role="tabpanel">
                                <div class="row">
                                    <div class="col-6 position-relative">
                                        <!-- Main Product Image -->
                                        <img id="mainProductImage"
                                            src="{{ asset('assets/product_images/' . $product->product_image) }}"
                                            class="img-fluid shadow-sm" alt="{{ $product->product_name }}"
                                            style="cursor: pointer;">

                                        <!-- Try Me Button -->
                                        <button id="tryMeButton"
                                            style="position: absolute; bottom: 10px; right: 25px; background-color: #007bff; color: white; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer;"
                                            data-bs-toggle="modal" data-bs-target="#imagePreviewModal">
                                            Try On Me
                                        </button>

                                    </div>


                                    <div class="col-6">
                                        <img id="mainProductImage"
                                            src="{{ asset('assets/product_images/' . $product->product_image) }}"
                                            class="img-fluid" alt="{{ $product->product_name }}">
                                    </div>

                                    <div class="tab-pane fade show active" id="metal-tab1" role="tabpanel">
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <img id="mainProductImage"
                                                    src="{{ asset('assets/product_images/' . $product->product_image) }}"
                                                    class="img-fluid" alt="{{ $product->product_name }}">
                                            </div>

                                            <div class="col-6">
                                                <img id="mainProductImage"
                                                    src="{{ asset('assets/product_images/' . $product->product_image) }}"
                                                    class="img-fluid" alt="{{ $product->product_name }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <form method="POST" action="{{ route('store.online.orders') }}">
                    @csrf

                    <input type="hidden" name="customer_id" value="{{ Auth::guard('online-customer')->id() }}">
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <input type="hidden" id="MainPriceDiv" name="product_price" value="">
                    <input type="hidden" id="selectedShape" name="shape" value="">
                    <input type="hidden" id="selectedMetalType" name="metalType" value="">

                    <h1>{{$product->product_name}}</h1>
                    <p>{{$product->description}}</p>

                    <p>SKU# {{$product->sku}}</p>



                    <div class="shape">
                        <div class="carousel-container mt-5">
                            <h6>Shape</h6>
                            <div class="owl-carousel owl-theme d-block" id="SingleProductThree">
                                @if($shapesWithImages)
                                @foreach($shapesWithImages as $shapeValue)
                                <div class="item">
                                    <div class="form-check p-0">
                                        <label class="radio-button-label emerald">
                                            <input type="radio" name="shape" value="{{ $shapeValue['title'] }}"
                                                data-id="{{ $shapeValue['attribute_value_id'] }}"
                                                onchange="updateMainProductImage(this)"
                                                {{ $loop->first ? 'checked' : '' }} />
                                            <img src="{{ asset($shapeValue['attribute_image']) }}"
                                                alt="{{ $shapeValue['title'] }}">
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <p>-</p>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="MetalType">
                        <div class="carousel-container mt-3">
                            <h6>Metal Type</h6>
                            <div class="owl-carousel owl-theme" id="SingleProductOne">
                                @foreach($metalTypeWithImages as $metalTypesValue)
                                <div class="item" style="width:unset !important" data-bs-target="#metal-tab1">
                                    <div class="form-check p-0">
                                        <label class="radio-button-label">
                                            <input type="radio" name="metalType" value="{{ $metalTypesValue['title'] }}"
                                                data-id="{{ $metalTypesValue['attribute_value_id'] }}"
                                                onchange="updateMainProductImage(this)" />
                                            <img src="{{ asset($metalTypesValue['attribute_image']) }}"
                                                alt="{{ $metalTypesValue['title'] }}">
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="shape">
                        <div class="carousel-container mt-5">
                            <h6>Total Carat Weight</h6>
                            <div class="owl-carousel owl-theme d-block" id="TotalCaratWeight">
                                @foreach($caratWithImages as $shapeValue)
                                <div class="item">
                                    <div class="form-check p-0">
                                        <label class="radio-button-label emerald">
                                            <input type="radio" name="carat_weight" value="{{ $shapeValue['title'] }}"
                                                data-id="{{ $shapeValue['attribute_value_id'] }}"
                                                onchange="updateMainProductImage(this)"
                                                {{ $loop->first ? 'checked' : '' }} />
                                            <img src="{{ asset($shapeValue['attribute_image']) }}"
                                                alt="{{ $shapeValue['title'] }}">
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="DiamondOrigin">
                        <div class="carousel-container mt-3">
                            <h6>Diamond Origin</h6>
                            <div class="d-flex gap-2">
                                <div class="form-check-box m-0">
                                    <input class="form-check-input" type="radio" name="diamondType" id="labDiamond"
                                        value="Lab Diamond">
                                    <label class="form-check-label" for="labDiamond">Lab Grown</label>
                                </div>
                                <div class="form-check-box m-0">
                                    <input class="form-check-input" type="radio" name="diamondType" id="naturalDiamond"
                                        value="Natural Diamond">
                                    <label class="form-check-label" for="naturalDiamond">Natural</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="priceDiv mt-3">
                        <div class="product-actions-schema card p-3">

                            <div class="product-actions-price-wrapper mt-3">
                                <div class="product-price d-flex align-items-center">
                                    <!-- <del class="text-muted me-2" aria-label="Old product price">$2,047</del> -->
                                    <ins class="product-price-price fw-bold" aria-label="Product price">
                                        <span class="MainPriceDiv">${{ $product->price }}</span>
                                    </ins>
                                </div>
                            </div>
                            <div class="product-actions-discount-price mt-2">
                                <span class=" badge bg-success">(15% off)</span>
                            </div>
                        </div>
                    </div>

                    <div class="RingSize mt-4">
                        <div class="">
                            <div class="">
                                <label for="ringSize" class="form-label fw-bold">Select Ring Size</label>
                                <select id="ringSize" name="ring_size" class="form-select">
                                    <option value="" selected disabled>Select a size</option>
                                    <option value="4">4</option>
                                    <option value="4.5">4.5</option>
                                    <option value="5">5</option>
                                    <option value="5.5">5.5</option>
                                    <option value="6">6</option>
                                    <option value="6.5">6.5</option>
                                    <option value="7">7</option>
                                    <option value="7.5">7.5</option>
                                    <option value="8">8</option>
                                    <option value="8.5">8.5</option>
                                    <option value="9">9</option>
                                    <option value="9.5">9.5</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    Add To Cart
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal-->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagePreviewModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="modalTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tryOnMe-tab" data-bs-toggle="tab" data-bs-target="#tryOnMe"
                            type="button" role="tab" aria-controls="tryOnMe" aria-selected="true">Try On Me</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tryOnModal-tab" data-bs-toggle="tab" data-bs-target="#tryOnModal"
                            type="button" role="tab" aria-controls="tryOnModal" aria-selected="false">Try On
                            Modal</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="modalTabsContent">
                    <!-- Try On Me Tab -->
                    <div class="tab-pane fade show active" id="tryOnMe" role="tabpanel" aria-labelledby="tryOnMe-tab">
                        <div id="modalImageContainer"
                            style="position: relative; display: flex; justify-content: center; align-items: center; width: 100%; height: auto;">
                            <!-- Hand Image and Ring Image will be inserted here -->
                        </div>
                        <label>Upload Hand Image</label>
                        <input type="file" id="imageUpload" class="form-control mt-3" accept="image/*">
                    </div>

                    <!-- Try On Modal Tab -->
                    <div class="tab-pane fade" id="tryOnModal" role="tabpanel" aria-labelledby="tryOnModal-tab">
                        <div
                            style="position: relative; display: flex; justify-content: center; align-items: center; width: 100%; height: auto;">
                            <!-- Static Hand Image -->
                            <img src="{{asset('assets/static_modal_images/hand.jpg') }}" alt="Hand"
                                style="width: 300px;">

                            <!-- Overlayed Top-View Image -->
                            <img class="topViewImage"
                                src="{{ asset('assets/product_images/' . $product->top_view_image) }}" alt="Ring"
                                style="position: absolute; top: 32%; left: 51%; transform: translate(-50%, -50%); width: 50px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    $("#SingleProductOne").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 7
            }
        }
    });

    $("#SingleProductThree").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 7
            }
        }
    });

    $("#TotalCaratWeight").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 7
            }
        }
    });
});

document.querySelectorAll('input[name="metalType"]').forEach((radio) => {
    radio.addEventListener('change', (e) => {
        const target = e.target.closest('.item').getAttribute('data-bs-target');
        document.querySelectorAll('.tab-pane').forEach((tab) => {
            tab.classList.remove('show', 'active');
        });
        document.querySelector(target).classList.add('show', 'active');
    });
});

function updateMainProductImage(element) {
    const selectedValue = element.value.trim();
    const inputName = element.name;
    const priceElement = document.querySelector('.MainPriceDiv');
    const priceInput = document.getElementById('MainPriceDiv');

    let metalType = '';
    let shape = '';
    let metalTypeId = '';
    let shapeId = '';

    if (inputName === 'metalType') {
        metalType = selectedValue;
        metalTypeId = element.getAttribute('data-id');
        const selectedShapeElement = document.querySelector('input[name="shape"]:checked');
        shape = selectedShapeElement ? selectedShapeElement.value.trim() : '';
        shapeId = selectedShapeElement ? selectedShapeElement.getAttribute('data-id') : '';
    } else if (inputName === 'shape') {
        shape = selectedValue;
        shapeId = element.getAttribute('data-id');
        const selectedMetalTypeElement = document.querySelector('input[name="metalType"]:checked');
        metalType = selectedMetalTypeElement ? selectedMetalTypeElement.value.trim() : '';
        metalTypeId = selectedMetalTypeElement ? selectedMetalTypeElement.getAttribute('data-id') : '';
    }

    console.log(`Metal Type ID: ${metalTypeId}`);
    console.log(`Shape ID: ${shapeId}`);

    if (!metalTypeId || !shapeId) {
        console.error('Both metalType and shape must be selected.');
        return;
    }

    document.getElementById('selectedShape').value = shapeId;
    document.getElementById('selectedMetalType').value = metalTypeId;

    const fetchUrl = `/product-image?metal_type=${encodeURIComponent(metalType)}&shape=${encodeURIComponent(shape)}`;
    console.log(`Fetch URL: ${fetchUrl}`);

    fetch(fetchUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error fetching image: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            // Update the product image
            const mainProductImage = document.getElementById('mainProductImage');
            if (mainProductImage && data.combination_image) {
                mainProductImage.src = data.combination_image;
            } else {
                console.warn('No new image URL provided.');
            }

            // Update the product price

            if (priceElement && data.price) {
                // Update the visible price
                priceElement.innerHTML = `$${data.price}`;

                // Update the hidden input field with the new price
                priceInput.value = data.price;
            } else {
                console.warn('Price data is not provided.');
            }

            // Update the URL
            const currentUrl = window.location.pathname;
            const newUrl = `${currentUrl}?shape=${shapeId}&metal_type=${metalTypeId}`;
            window.history.replaceState(null, '', newUrl);


            // Fetch the new top view image based on the URL parameters
            const fetchTopViewImage = async () => {
                const shapeId = new URLSearchParams(window.location.search).get('shape');
                const metalTypeId = new URLSearchParams(window.location.search).get('metal_type');

                // Construct the URL to fetch the new image (assuming the parameters are part of the URL)
                const imageUrl = `http://127.0.0.1:8000/get-variations/${shapeId}/${metalTypeId}`;

                try {
                    const response = await fetch(imageUrl);
                    const data = await response.json();

                    // Assuming the response contains the 'top_view_image' path
                    const topViewImageUrl = data.top_view_image;

                    // Update the image source
                    const imageElement = document.querySelector('.topViewImage');
                    imageElement.src = topViewImageUrl;
                } catch (error) {
                    console.error('Error fetching the top view image:', error);
                }
            };

            // Call the function to update the image
            fetchTopViewImage();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
</script>
<script>
// Select elements
const tryOnButton = document.getElementById('imagePreviewModal');
const modalImageContainer = document.getElementById('modalImageContainer');
const imageUpload = document.getElementById('imageUpload');

// Handle "Try Me On" Button Click
tryOnButton.addEventListener('click', () => {
    modalImageContainer.innerHTML = ''; // Clear existing content
    imageUpload.value = ''; // Reset file input
});

// Handle Image Upload
imageUpload.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Create and add hand image
            const uploadedHandImage = document.createElement('img');
            uploadedHandImage.src = e.target.result;
            uploadedHandImage.className = 'img-fluid rounded';
            uploadedHandImage.id = 'handImage';
            modalImageContainer.innerHTML = '';
            modalImageContainer.appendChild(uploadedHandImage);

            // Add the ring image
            addRingImageToModal();
        };
        reader.readAsDataURL(file);
    }
});

// Add the ring image
function addRingImageToModal() {
    const shapeId = new URLSearchParams(window.location.search).get('shape');
    const metalTypeId = new URLSearchParams(window.location.search).get('metal_type');

    // Fetch the ring image from the API
    fetch(`http://127.0.0.1:8000/get-variations/${shapeId}/${metalTypeId}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.top_view_image) {
                const ringImage = document.createElement('img');
                ringImage.src = data.top_view_image;
                ringImage.id = 'ringImage';
                ringImage.style.position = 'absolute';
                ringImage.style.display = 'none'; // Hide initially
                modalImageContainer.appendChild(ringImage);

                // Show the ring image only after hand image is uploaded
                ringImage.style.display = 'block';
                positionRingOnFinger();

                // Make the ring image draggable
                makeRingImageDraggable(ringImage);
            }
        })
        .catch((error) => console.error('Error fetching variations:', error));
}

// Position the ring
function positionRingOnFinger() {
    const handImage = document.getElementById('handImage');
    const ringImage = document.getElementById('ringImage');

    if (handImage && ringImage) {
        const handRect = handImage.getBoundingClientRect();
        const ringX = handRect.left + handRect.width * 0.5;
        const ringY = handRect.top + handRect.height * 0.4;

        ringImage.style.left = `${200}px`; // Adjust as needed
        ringImage.style.top = `${112}px`; // Adjust as needed
    }
}

function makeRingImageDraggable(ringImage) {
    ringImage.addEventListener('mousedown', function(e) {
        e.preventDefault(); // Prevent default behavior

        // Get initial mouse offset
        const offsetX = e.clientX - ringImage.getBoundingClientRect().left;
        const offsetY = e.clientY - ringImage.getBoundingClientRect().top;

        // Function to move the ring image
        function moveAt(event) {
            ringImage.style.left = `${event.clientX - offsetX}px`;
            ringImage.style.top = `${event.clientY - offsetY}px`;
        }

        // Add mousemove listener to the document
        function onMouseMove(event) {
            moveAt(event);
        }

        // Remove listeners on mouseup
        function onMouseUp(event) {
            event.stopPropagation(); // Prevent propagation to stop modal close
            document.removeEventListener('mousemove', onMouseMove);
            document.removeEventListener('mouseup', onMouseUp);
        }

        // Attach event listeners
        document.addEventListener('mousemove', onMouseMove);
        document.addEventListener('mouseup', onMouseUp);
    });

    // Prevent mouseup on the ring image from propagating to the modal
    ringImage.addEventListener('mouseup', function(e) {
        e.stopPropagation();
    });
}



// Call this function when the ring image is added to the DOM
function addRingImageToModal() {
    const shapeId = new URLSearchParams(window.location.search).get('shape');
    const metalTypeId = new URLSearchParams(window.location.search).get('metal_type');

    // Fetch the ring image from the API
    fetch(`http://127.0.0.1:8000/get-variations/${shapeId}/${metalTypeId}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.top_view_image) {
                const ringImage = document.createElement('img');
                ringImage.src = data.top_view_image;
                ringImage.id = 'ringImage';
                ringImage.style.position = 'absolute';
                ringImage.style.display = 'none'; // Hide initially
                modalImageContainer.appendChild(ringImage);

                // Make the ring image draggable
                makeRingImageDraggable(ringImage);

                // Show the ring image after the hand image is uploaded
                ringImage.style.display = 'block';
                positionRingOnFinger();
            }
        })
        .catch((error) => console.error('Error fetching variations:', error));
}
</script>




@endsection