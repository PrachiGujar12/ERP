@extends('layouts.dashboard')
@section('title', 'Karigar List')
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

        <h1 class="h2 mb-0 text-gray-800">KARIGARS LIST</h1>

       <a class="JewelleryPrimaryButton" href="{{url('/add-karigar')}}"><i class="bi bi-plus-circle"></i> Add Karigar</a>
    </div>
    

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
  
        <div class="customer__page">
            <div class="row">
                <div class="col-12  my-4">
                    <div class="row">
                        <div class="col-md-6 d-none">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills py-3 nav-justified" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                    <a class="nav-link active" id="pills-customer-tab" data-toggle="pill"
                                        href="#pills-customer" role="tab" aria-controls="pills-customer"
                                        aria-selected="false">Karigar List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="add-new-customer-tab" data-toggle="pill"
                                        href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                        aria-selected="true">Add New Karigar</a>
                                </li>
                              
                            </ul>
                        </div>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="card mb-4">
                                
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
                                                    <!--<th> Id </th> -->
                                                    <th> karigar Name </th>
                                                    <th> Nick Name </th>
													
                                                    <th> Email </th>
                                                    <th class="mobile-column"> Mobile Number </th>
                                                    <th> Status </th>
                                                    <th> Order </th>
                                                    <th> Repair </th>
                                                    <th> Metal Account </th>
                                                    <th> Labour Due </th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($karagirs as $karagir)
                                                <tr>
                                                    <!--<td>{{ $karagir->karigar_id }}</td>-->
                                                    <td>{{ $karagir->karigar_name }}</td>
                                                    <td>{{ $karagir->karigar_nick_name }}</td>
													
                                                    <td>{{ $karagir->email }}</td>
                                                    <td>
													{{ ''.substr($karagir->contact_no, 0, 3).' '.substr($karagir->contact_no, 3, 4).' '.substr($karagir->contact_no, 6, 4).' '.substr($karagir->contact_no, 10) }}
													</td>
                                                    <td>
                                                        @if($karagir->status == 'active')
                                                        <span class="btn btn-sm btn-success">Active</span>
                                                        @else
                                                        <span
                                                            class="btn btn-sm btn-danger">{{ ucfirst($karagir->status) }}</span>
                                                        @endif
                                                    </td>
													<td>
														 @if( $karagir->count  == '0')
                                                        <span class="btn btn-sm btn-success">{{ $karagir->count }}</span>
                                                        @else
                                                        <span
                                                            class="btn btn-sm btn-danger">{{ $karagir->count }}</span>
                                                        @endif
														</td>
													<td>
														 @if( $karagir->repaircount  == '0')
                                                        <span class="btn btn-sm btn-success">{{ $karagir->repaircount }}</span>
                                                        @else
                                                        <span
                                                            class="btn btn-sm btn-danger">{{ $karagir->repaircount }}</span>
                                                        @endif
														</td>
													<td>
														 <span class="btn btn-sm btn-danger">10.6</span>
													</td>
														
													<td>
														<span class="btn btn-sm btn-danger">£3,678</span>
													</td>
														
                                                    <td>
                                                        <!-- Edit Button -->
                                                        <a class="btn btn-sm btn-info m-1"
                                                            href="{{ route('edit.karigar', $karagir->karigar_id) }}">
                                                            Edit
                                                        </a>

                                                          <!-- View Button -->
                                                          <a class="btn btn-sm btn-primary m-1"
                                                            href="{{ route('view.karigar', $karagir->karigar_id) }}">
                                                            View
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
                        <div class="tab-pane fade " id="add-new-customer" role="tabpanel"
                            aria-labelledby="add-new-customer-tab">
                            <form class="form-sample" action="{{ route('add.karigar') }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                              
                                <div class="row g-3">
                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Karigar Name</label>
                                        <input type="text" class="form-control" id="textInput" name="karigar_name"
                                            placeholder="Enter Karigar Name" />
                                    </div>
                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Karigar Email</label>
                                        <input type="email" class="form-control" id="textInput" name="email"
                                            placeholder="Enter Karigar Email" />
                                    </div>

                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control" id="textInput" name="contact_no"
                                            placeholder="Enter Mobile Number" />
                                    </div>
                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="textInput" name="address"
                                            placeholder="Enter Address" />
                                    </div>
                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Specialization</label>
                                        <input type="text" class="form-control" id="textInput" name="specialization"
                                            placeholder="Enter Specialization" />
                                    </div>
                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label"> Access</label>
                                        <select class="form-control @error('status') is-invalid @enderror"
                                            name="status">
                                            <option value="">--Select Status --</option>
                                            <option value="active">Active</option>
                                            <option value="in-active">In-active</option>
                                        </select>
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