@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">

    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
        <a href="{{route('dashboard')}}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back to Menu
        </a>
            
            <h1 class="h2 mb-0 text-gray-800">CATEGORIES SIZES</h1>

            <a href="{{route('create.category.size')}}" class="JewelleryPrimaryButton"><i class="bi bi-plus-circle"></i> Add Size</a>

    </div>	

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
         
        </div>

        <!-- Content Row -->
        <div class="customer__page">
            <div class="">
                <div class="col-12 card  p-md-4">
                    <div class="row">
                        <div class="col-md-6 d-none">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills py-3 nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-customer-tab" data-toggle="pill"
                                        href="#pills-customer" role="tab" aria-controls="pills-customer"
                                        aria-selected="false">Categories Size List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="add-new-customer-tab" data-toggle="pill"
                                        href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                        aria-selected="true">Add Category Size</a>
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
                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class=" mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Category Name</th>
                                                    <th>Category Size</th>
                                                   
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach($sizes as $size)
                                                <tr>
                                                    <td>{{ $size->id }}</td>
                                                    <td>{{ $size->category->category_name }}</td>
                                                    <td>{{ $size->size }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('edit.category.size', $size->id) }}">
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

                        <div class="tab-pane fade" id="add-new-customer" role="tabpanel"
                            aria-labelledby="add-new-customer-tab">
                            <form action="{{ route('add.category.size') }}" method="POST" id="addCategoryForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">

                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Category Name</label>
                                        <select class="form-control" name="category" id="category" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    

                                    <div class="col-md-6 form__fields">
                                        <label for="category_size" class="form-label">Category Size</label>
                                        <input type="text" class="form-control" id="category_size" name="category_size"
                                            placeholder="Enter Category Size" />
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
    </div>

    <!-- /.container-fluid -->
</div>

@endsection
