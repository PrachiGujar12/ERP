@extends('layouts.dashboard')
@section('title', 'Product Category')
@section('meta_description', 'System user list.')
@section('content')

<style>
.category-tree {
    max-height: 500px;
    overflow-y: auto;
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.category-tree ul {
    list-style: none;
    padding-left: 15px;
}

.category-tree li {
    margin-bottom: 10px;
    position: relative;
}

.category-tree li::before {
    content: '';
    position: absolute;
    width: 10px;
    height: 1px;
    background-color: #ddd;
    left: -10px;
    top: 12px;
}

.category-tree li strong {
    font-weight: 600;
    color: #333;
}

.category-tree li span {
    margin-left: 10px;
    font-size: 12px;
}

.category-tree ul ul {
    margin-top: 10px;
    padding-left: 15px;
    border-left: 1px dashed #ddd;
}

.category-tree ul ul li::before {
    background-color: transparent;
}
</style>

<div>
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header"
        style="position: sticky; top: 0; z-index: 100;">
        <a href="{{ route('online-dashboard') }}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back to Menu
        </a>
        <div class="mb-2 mb-md-0">
            <h6 class="h2 mb-0 text-gray-800">PRODUCT CATEGORY</h6>
        </div>
        <div class="mb-2 mb-md-0">

        </div>
    </div>

    <div class="container-fluid mt-4">
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

        <div class="row g-4">
            <!-- Category Tree Section -->
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header JewelleryPrimaryButton">
                        <h5 class="mb-0">Category Tree</h5>
                    </div>
                    <div class="card-body" id="categoryTree">
                        <ul class="list-unstyled">
                            @foreach ($categories as $category)
                            <li>
                                <h2 data-id="{{ $category->id }}">
                                    <a
                                        href="{{ route('edit-product-category', $category->id) }}">{{ $category->name }}</a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('delete-product-category', $category->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this category?')"> <i class="fas fa-trash-alt"></i> </button>
                                    </form>
                                </h2>


                                @if ($category->children->isNotEmpty())
                                <ul class="list-unstyled ms-3">
                                    @foreach ($category->children as $child)
                                    <li>
                                        <h2 data-id="{{ $child->id }}"><a
                                                href="{{ route('edit-product-category', $child->id) }}">-
                                                {{ $child->name }}</a>

                                            <!-- Delete Button for child categories -->
                                            <form action="{{ route('delete-product-category', $child->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this category?')"> <i class="fas fa-trash-alt"></i>
                                                </button>

                                            </form>
                                        </h2>

                                        @if ($child->children->isNotEmpty())
                                        <ul class="list-unstyled ms-3">
                                            @foreach ($child->children as $grandChild)
                                            <li>
                                                <h2 data-id="{{ $grandChild->id }}"><a
                                                        href="{{ route('edit-product-category', $grandChild->id) }}">--
                                                        {{ $grandChild->name }}</a>
                                                    <!-- Delete Button for grandchild categories -->
                                                    <form
                                                        action="{{ route('delete-product-category', $grandChild->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this category?')">  <i class="fas fa-trash-alt"></i> </button>
                                                    </form>
                                                </h2>


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

            <!-- Form Section -->
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header JewelleryPrimaryButton">
                        <h5 class="mb-0">{{ isset($editCategory) ? 'Edit Category' : 'Add Category' }}</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($editCategory) ? route('update-product-category', $editCategory->id) : route('store-product-category') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($editCategory))
                            @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Enter category name" value="{{ $editCategory->name ?? '' }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="parent" class="form-label">Parent Category</label>
                                <select id="parent" name="parent_id" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ isset($editCategory) && $editCategory->parent_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @if ($category->children->isNotEmpty())
                                    @include('online.category.dropdown', ['categories' => $category->children, 'prefix'
                                    => '-', 'selectedParentId' => $editCategory->parent_id ?? ''])
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="3"
                                    placeholder="Enter category description">{{ $editCategory->description ?? '' }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Category Image</label>
                                <input type="file" class="form-control" name="category_image">
                                @if(isset($editCategory) && $editCategory->image)
                                <small>Current Image: <img
                                        src="{{ asset('uploads/category_images/' . $editCategory->image) }}"
                                        alt="Category Image" width="50"></small>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="published"
                                        {{ isset($editCategory) && $editCategory->status == 'published' ? 'selected' : '' }}>
                                        Published</option>
                                    <option value="draft"
                                        {{ isset($editCategory) && $editCategory->status == 'draft' ? 'selected' : '' }}>
                                        Draft</option>
                                    <option value="pending"
                                        {{ isset($editCategory) && $editCategory->status == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                </select>
                            </div>

                            <button type="submit"
                                class="JewelleryPrimaryButton">{{ isset($editCategory) ? 'Update' : 'Submit' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection