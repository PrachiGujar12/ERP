@extends('layouts.dashboard')

@section('title', 'Edit Category')

@section('content')
<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header"
        style="position: sticky; top: 0; z-index: 100;">
        <a href="{{ url('/product-categories') }}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
        <div class="mb-2 mb-md-0">
            <h6 class="h2 mb-0 text-gray-800">EDIT PRODUCT CATEGORY</h6>
        </div>
        <div class="mb-2 mb-md-0">
            
        </div>
    </div>
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header JewelleryPrimaryButton">
            <h5 class="mb-0">Edit Category</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('update-product-category', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name', $category->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="parent" class="form-label">Parent Category</label>
                    <select id="parent" name="parent_id" class="form-control">
                        <option value="">None</option>
                        @foreach ($categories as $parent)
                            <option value="{{ $parent->id }}" {{ $parent->id == $category->parent_id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                            @if ($parent->children->isNotEmpty())
                                @include('online.category.dropdown', ['categories' => $parent->children, 'prefix' => '--'])
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Category Image</label>
                    <input type="file" class="form-control" name="category_image">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="published" {{ $category->status == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ $category->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="pending" {{ $category->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <button type="submit" class="JewelleryPrimaryButton">Update Category</button>
            </form>
        </div>
    </div>
</div>
@endsection
