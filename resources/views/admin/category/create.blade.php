@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	
	<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	
	 <a href="{{ route('categories.list') }}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
            <h1 class="h2 mb-0 text-gray-800">ITEM CATEGORIES </h1>
	 <a href="button" class="mx-5 px-5"></a>
       
	</div>
	
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->


        <!-- Content Row -->
        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card p-md-4 my-4">
                    <div class="row">
                        <div class="col-md-6 d-none">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills py-3 nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-customer-tab" data-toggle="pill"
                                        href="#pills-customer" role="tab" aria-controls="pills-customer"
                                        aria-selected="false">Categories List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="add-new-customer-tab" data-toggle="pill"
                                        href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                        aria-selected="true">Add New Category</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
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
										@endforeach </ul> 
								</div> 
								@endif 
                        <div class="tab-pane fade" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="mb-4">
                               
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Category Name</th>
                                                    <th>Category Description</th>
                                                    <th>Category Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach($categories as $category)
                                                <tr>
                                                    <td>{{ $category->category_id }}</td>
                                                    <td>{{ $category->category_name }}</td>
                                                  
                                                    <td>{{ $category->category_description }}</td>
                                                    <td><img src="{{ asset('asset/categories_images/' . $category->category_image) }}"
                                                            alt="Category Image" width="100" /></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('edit.category', $category->category_id) }}">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade  show active" id="add-new-customer" role="tabpanel"
                            aria-labelledby="add-new-customer-tab">
                            <form action="{{ route('add.category') }}" method="POST" id="addCategoryForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" id="textInput" name="category_name"
                                            placeholder="Enter Category Name" required>
                                    </div>
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Category Description</label>
                                        <input type="text" class="form-control" id="textInput"
                                            name="category_description" placeholder="Enter Category Description" required>
                                    </div>
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Category Image</label>
                                        <input type="file" class="form-control form-control-file" id="photoUpload"
                                            accept="image/*" name="category_image" required>
                                    </div>
                                    <div class="col-12">
                                        
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
</div>

@endsection
