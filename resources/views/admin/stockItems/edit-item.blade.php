@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Item</h1>
        </div>

        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card shadow p-md-4">
                    <form class="form-sample" action="{{ route('update.item', $item->item_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="row g-3">
                            <!-- Category -->
                            <div class="col-md-6 form__fields">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">--Select Category--</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_name }}"
                                            {{ old('category', $item->category) == $category->category_name ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Location -->
                            <div class="col-md-6 form__fields">
                                <label for="itemLocation" class="form-label">Location</label>
                                <select class="form-control" id="itemLocation" name="location" required>
                                    <option value="">--Select Location--</option>
                                    @foreach($storageLocations as $storageLocation)
                                        <option value="{{ $storageLocation->location_id }}"
                                            {{ old('location', $item->location) == $storageLocation->location_id ? 'selected' : '' }}>
                                            {{ $storageLocation->location_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sub Location -->
                            <div class="col-md-6 form__fields">
                                <label for="subLocation" class="form-label">Sub Location</label>
                                <select class="form-control" id="subLocation" name="sub_location" required>
                                    <option value="">--Select Sub Location--</option>
                                    @foreach($subLocations as $subLocation)
                                        <option value="{{ $subLocation->sub_location_id }}"
                                            {{ old('sub_location', $item->sub_location) == $subLocation->sub_location_id ? 'selected' : '' }}>
                                            {{ $subLocation->sub_location_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Metal Type -->
                            <div class="col-md-6 form__fields">
                                <label for="itemType" class="form-label">Metal Type</label>
                                <select class="form-control" id="itemType" name="metal_type" required>
                                    <option value="">--Select Metal Type--</option>
                                    @foreach($itemTypes as $itemType)
                                        <option value="{{ $itemType->item_type_id }}"
                                            {{ old('metal_type', $item->metal_type) == $itemType->item_type_id ? 'selected' : '' }}>
                                            {{ $itemType->item_type_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Purity -->
                            <div class="col-md-6 form__fields">
                                <label for="purity" class="form-label">Purity</label>
                                <select class="form-control" name="purity" id="purity" required>
                                    <option value="">--Select Purity Type--</option>
                                    <option value="18" {{ old('purity', $item->purity) == '18' ? 'selected' : '' }}>18 Karat</option>
                                    <option value="22" {{ old('purity', $item->purity) == '22' ? 'selected' : '' }}>22 Karat</option>
                                    <option value="24" {{ old('purity', $item->purity) == '24' ? 'selected' : '' }}>24 Karat</option>
                                </select>
                            </div>

                            <!-- Item Weight -->
                            <div class="col-md-6 form__fields">
                                <label for="itemWeight" class="form-label">Item Weight</label>
                                <input type="text" class="form-control" id="itemWeight" name="item_weight"
                                    value="{{ old('item_weight', $item->item_weight) }}" />
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-sm btn-primary mt-3">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('itemLocation').addEventListener('change', function() {
    const locationId = this.value;
    const subLocationSelect = document.getElementById('subLocation');
    subLocationSelect.innerHTML = '<option value="">--Select Sub Location--</option>';

    if (locationId) {
        fetch(`/fetch-sublocations/${encodeURIComponent(locationId)}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(subLocation => {
                    const option = document.createElement('option');
                    option.value = subLocation.sub_location_id; // Correctly set ID as value
                    option.textContent = subLocation.sub_location_name;
                    if ({{ $item->sub_location }} == subLocation.sub_location_id) { // Preselect edited value
                        option.selected = true;
                    }
                    subLocationSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching sub locations:', error));
    }
});

document.getElementById('itemType').addEventListener('change', function() {
    const metalType = this.value;
    const purityDropdown = document.getElementById('purity');
    purityDropdown.innerHTML = '<option value="">--Select Purity Type--</option>';

    if (metalType) {
        fetch(`/get-purity/${metalType}`)
            .then(response => response.json())
            .then(data => {
                const purities = data.purity ? data.purity.split(',') : [];
                purities.forEach(purity => {
                    const option = document.createElement('option');
                    option.value = purity.trim();
                    option.textContent = purity.trim() + ' Karat';
                    purityDropdown.appendChild(option);
                });
                purityDropdown.disabled = purities.length === 0;
            })
            .catch(error => console.error('Error fetching purities:', error));
    } else {
        purityDropdown.disabled = true;
    }
});
</script>

@endsection
