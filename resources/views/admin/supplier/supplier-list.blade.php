@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	<a href="{{route('dashboard')}}" class="JewelleryPrimaryButton">
							<i class="fas fa-arrow-left mr-2"></i> Back to Menu
						</a>
            <div class=" mb-2 mb-md-0 p-0">
                <h6 class="h2 mb-0 text-gray-800">SUPPLIER LIST</h6>
            </div>
            <div class=" d-flex gap-2 justify-content-md-end p-0">
				<a href="{{route('add.view.supplier')}}" class="JewelleryPrimaryButton"><i class="bi bi-person-plus"></i> Add Supplier</a>
                
            </div>
        
	
	</div>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->

        <!-- Content Row -->
        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card my-4 p-md-4">
                    <div class="row">
                        <div class="col-md-6 d-none">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills py-3 nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-customer-tab" data-toggle="pill"
                                        href="#pills-customer" role="tab" aria-controls="pills-customer"
                                        aria-selected="false">Suppliers List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="add-new-customer-tab" data-toggle="pill"
                                        href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                        aria-selected="true">Add New Supplier</a>
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
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th>Supplier Code</th>
                                                    <th>Contact Name</th>
                                                    <th>Company Name</th>
                                                    <th>Note</th>
                                                    <th>Mobile Number</th>
                                                    <th>Email</th>
                                                  <!--  <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach($suppliers as $supplier)
                                                <tr data-href="{{ route('view.supplier', $supplier->supplier_id) }}">
                                                    <td>{{ $supplier->supplier_code }}</td>
                                                    <td>{{ $supplier->full_name }}</td>
                                                    <td>{{ $supplier->address }}</td>
                                                    <td class="note-column" >{{ $supplier->note }}</td>
													<td class="mobile-number">
                                            
                                               {{ ''.substr($supplier->mobile_no, 0, 4).' '.substr($supplier->mobile_no, 4, 3).' '.substr($supplier->mobile_no, 7, 3).' '.substr($supplier->mobile_no, 10) }}
                                            
                                            </td>
                                                    <td>{{ $supplier->email }}</td>
													
                                                    <!--<td>
                                                        <a class="btn btn-sm btn-primary m-1 d-none"
                                                            href="{{ route('edit.supplier', $supplier->supplier_id) }}">
                                                            Edit
                                                        </a>
														<a class="btn btn-sm btn-primary m-1"
                                                            href="{{ route('view.supplier', $supplier->supplier_id) }}">
                                                            View
                                                        </a>
														
                                                    </td>-->
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
                            <form action="{{ route('add.supplier') }}" method="POST" id="addCategoryForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Supplier Name</label>
                                        <input type="text" class="form-control" id="textInput" name="full_name"
                                            placeholder="Enter Supplier Name" />
                                    </div>
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="textInput"
                                            name="email" placeholder="Enter Email" />
                                    </div>
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="textInput"
                                            name="address" placeholder="Enter Address" />
                                    </div>
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control" id="textInput"
                                            name="mobile_no" placeholder="Enter Mobile Number" />
                                    </div>
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Contact Person Name</label>
                                        <input type="text" class="form-control" id="textInput"
                                            name="contact_person_name" placeholder="Enter Contact Person Name" />
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
