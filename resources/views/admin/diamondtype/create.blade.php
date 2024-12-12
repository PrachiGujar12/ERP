@extends('layouts.dashboard')
@section('title', 'Diamond Type')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">

    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
        <a href="{{route('diamond.type.list')}}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
            
            <h1 class="h2 mb-0 text-gray-800">ADD DIAMOND TYPES</h1>

            <h1 class="mx-5 px-5"></h1>

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
                                        aria-selected="false">Diamond Type List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="add-new-customer-tab" data-toggle="pill"
                                        href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                        aria-selected="true">Add Diamond Type</a>
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
                        <div class="tab-pane fade " id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-warning">
                                        Diamond Type List
                                    </h6>
                                </div>
                               
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Id</th>
                                                    
                                                    <th>Diamond Type</th>
                                                   
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach($diamondtypes as $diamondtype)
                                                <tr>
                                                    <td>{{ $diamondtype->id }}</td>
                                                    
                                                    <td>{{ $diamondtype->type }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('edit.diamond.type', $diamondtype->id) }}">
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

                        <div class="tab-pane fade show active" id="add-new-customer" role="tabpanel"
                            aria-labelledby="add-new-customer-tab">
                            <form action="{{ route('add.diamond.type') }}" method="POST" id="addCategoryForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">

                                    <div class="col-md-6 form__fields">
                                        <label for="diamond_type" class="form-label">Diamond Type</label>
                                        <input type="text" class="form-control" id="diamond_type" name="diamond_type"
                                            placeholder="Enter Diamond Type" required>
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
