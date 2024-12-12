@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	
		
<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	
	 <a href="{{ route('dashboard') }}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Back to Menu
            </a>
            <h1 class="h2 mb-0 text-gray-800">LOCATION LIST</h1>
	 <a href="{{url('/add-locations')}}" class="JewelleryPrimaryButton" > <i class="bi bi-plus-circle"></i> Add Location</a>
       
	</div>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
       
        <!-- Content Row -->

        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card my-5">
                    <div class="row">
                        <div class="col-md-6 d-none">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills py-3 nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-customer-tab" data-toggle="pill"
                                        href="#pills-customer" role="tab" aria-controls="pills-customer"
                                        aria-selected="false">Location List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="add-new-customer-tab" data-toggle="pill"
                                        href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                        aria-selected="true">Add New Location</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="">
                               
                                @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @endif
								 @if ($errors->any())
								<div class="alert alert-danger"> 
									<ul>
										@foreach ($errors->all() as $error) 
										<li>{{ $error }}</li>
										@endforeach </ul> 
								</div> 
								@endif 
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Location Name</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($locations as $location)
                                                <tr>
                                                    <td>{{ $location->location_id }}</td>
                                                    <td>{{ $location->location_name }}</td>
                                                    <td>{{ $location->description }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('edit.location', $location->location_id) }}">
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
                        <div class="tab-pane fade p-4" id="add-new-customer" role="tabpanel"
                            aria-labelledby="add-new-customer-tab">
                            <form action="{{ route('add.storage.location') }}" method="POST" id="addCategoryForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Location Name</label>
                                        <input type="text" class="form-control" id="textInput" name="location_name"
                                            placeholder="Enter Location Name" />
                                    </div>
                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Location Description</label>
                                        <input type="text" class="form-control" id="textInput" name="description"
                                            placeholder="Enter Location Decsription" />
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
    <!-- Content Row -->


    <!-- /.container-fluid -->
</div>



@endsection