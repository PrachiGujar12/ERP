@extends('layouts.dashboard')
@section('title', 'Customer')
@section('meta_description', 'System Dashboard.')
@section('content')

<style>
    @media (max-width: 576px) { 
        .nav {
            display: block; /* or display: flex; */
        } 
    }
</style>

<div id="content">

   <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
        <a href="{{route('dashboard')}}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back to Menu
        </a>
            
            <h1 class="h2 mb-0 text-gray-800">DUE CUSTOMERS</h1>

            <a href="{{route('customers.add')}}" class="JewelleryPrimaryButton">
            <i class="bi bi-person-fill-add"></i> ADD CUSTOMER
        </a>
    </div>	

    <!-- Begin Page Content -->
    <div class="">
        <!-- Page Heading -->
       
		
        <!-- Content Row -->
			
        <div class="container-fluid customer__page 	">
            <div class="row">
                <div class="col-12 card  p-md-4 my-4">
                    <div class="">
                        <div class="">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills py-3 nav-justified d-none" id="pills-tab" role="tablist">
                            
                                <li class="nav-item">
                                <a class="tab-div" id="pills-customer-tab" data-toggle="pill" href="#pills-customer" role="tab" aria-controls="pills-customer" aria-selected="false">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body align-content-center">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="TabText text-sm font-weight-bold text-warning  mb-1">
                                                        Add Customer
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <img src="https://demo.webwideit.solutions/raman-jeweller-erp/public/asset/images/icon/Customers.png" alt="Customer Icon" class="img-fluid" width="40px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                </li>
                                <li class="nav-item">
                                <a class="tab-div" id="pills-due-account-tab" data-toggle="pill" href="#pills-due-account" role="tab" aria-controls="pills-due-account" aria-selected="false">
                                    <div class="card border-left-warning shadow h-100 ">
                                        <div class="card-body align-content-center">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="TabText text-sm font-weight-bold text-warning  mb-1">
                                                        Existing Account
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                <img src="https://demo.webwideit.solutions/raman-jeweller-erp/public/asset/images/icon/Customers.png" alt="Customer Icon" class="img-fluid" width="40px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                </li>
					<!--   <li class="nav-item ">
                            <a class="tab-div" id="add-new-customer-tab" href="{{route('customers.add')}}" >
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body align-content-center">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="TabText text-sm font-weight-bold text-warning  mb-1">
                                                Add New Customer
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <img src="https://demo.webwideit.solutions/raman-jeweller-erp/public/asset/images/icon/Customers.png" alt="" class="img-fluid" width="40px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                                        
                                </li> -->
                            </ul>
                        </div>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                           							<form class="form-sample p-2" action="{{ route('add.customer') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                            <div class="d-sm-flex gap-2 justify-content-between">
                                    <h6 class="m-0 h3 pb-2 font-weight-bold text-warning">
                                    Add New Customer
								</h6>
								<div>
									<!--<a href="{{route('customers.list')}}"<button class="JewelleryPrimaryButton gap-2 btn-primary"> <i class="bi bi-arrow-left"></i> Back</button></a> -->
								<button type="submit" class="JewelleryPrimaryButton ml-2"><i class="bi bi-floppy-fill"></i> Save</button>
									
                                </div>
                                </div>
                           
				<div class="MainForm">
                                <div class="row g-3" >
                                    <!-- First Name -->
                                    <div class="col-md-12 form__fields">
                                        <label for="firstName" class="form-label">First Name*</label>
                                    
                                   
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstName" name="first_name" placeholder="Enter First Name" required />
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-md-12 form__fields">
                                        <label for="lastName" class="form-label">Last Name*</label>
                                   
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="lastName" name="last_name" placeholder="Enter Last Name" required/>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Mobile Number -->
                                     <div class="col-md-12 form__fields">
                                        <label for="mobileNo" class="form-label">Mobile Number*</label>
                                    
                                        <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobileNo" name="mobile_no" placeholder="Enter Mobile Number" required />
                                        @error('mobile_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Address -->
                                     <div class="col-md-12 form__fields">
                                        <label for="address" class="form-label">Address</label>
                                    
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter Address" />
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- town -->
                                     <div class="col-md-12 form__fields">
                                        <label for="town" class="form-label">Town</label>
                                    
                                        <input type="text" class="form-control @error('town') is-invalid @enderror" id="town" name="town" placeholder="Enter town" />
                                        @error('town')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									
									<!-- Post Code -->
                                     <div class="col-md-12 form__fields">
                                        <label for="post-code" class="form-label">Post Code</label>
                                    
                                        <input type="text" class="form-control @error('post-code') is-invalid @enderror" id="post-code" name="post_code" placeholder="Enter Post Code"  />
                                        @error('post-code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <!-- Email -->
                                    <div class="col-md-12 form__fields">
                                        <label for="email" class="form-label">Email</label>
                                    
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email"/>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Gender -->
                                     <div class="col-md-12 form__fields">
                                        <label for="gender" class="form-label">Gender</label>
                                    
                                        <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" >
                                            <option value="" selected>--Select Gender--</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    
                                    <!-- Date of Birth -->
                                     <div class="col-md-12 form__fields">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                    
                                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="dob" name="date_of_birth" />
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- WhatsApp Number -->
                                     <div class="col-md-12 form__fields">
                                        <label for="whatsappNo" class="form-label">WhatsApp</label>
                                    
                                        <input type="text" class="form-control" id="whatsappNo" name="whatsapp_no" placeholder="Enter WhatsApp Number" />
                                    </div>

                                    
									
                                    <!-- Instagram  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="instagram" class="form-label">Instagram</label>
                                    
                                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" placeholder="Enter Instagram"  />
                                        @error('instagram')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Facebook  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="facebook" class="form-label">Facebook</label>
                                    
                                        <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" placeholder="Enter Facebook"  />
                                        @error('facebook')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Tiktok  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="tiktok" class="form-label">Tiktok</label>
                                    
                                        <input type="text" class="form-control @error('tiktok') is-invalid @enderror" id="tiktok" name="tiktok" placeholder="Enter Tiktok"  />
                                        @error('tiktok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Religion  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="religion" class="form-label">Religion</label>
                                    
                                        <input type="text" class="form-control @error('religion') is-invalid @enderror" id="religion" name="religion" placeholder="Enter Religion"  />
                                        @error('religion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
							</div>
                            </form>
                        </div>
                        

                        <div class="tab-pane fade show active" id="pills-due-account" role="tabpanel" aria-labelledby="pills-due-account-tab"
							>
 
							<div class="mb-4">
								 <div class="">
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
                                <div class="card-header py-3 border d-none">
                                    <h6 class="m-0 font-weight-bold text-warning">
                                        Customers List
                                    </h6>
                                </div>
                             
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                                        <thead style="background-color:#df9700; color:#fff">
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th class="mobile-column">Mobile Number</th>
                                            <th>Note</th>
                                            <!--<th>NC</th>-->
                                            <!--<th>Order</th>-->
                                            <th>Due</th>
                                            <th>Due Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($customers as $customer)
                                        <tr data-href="{{ route('due.customers.view', $customer->customer_id) }}">
                                            <td>
                                                {{ $customer->first_name }}
                                            </td>
                                            <td>
                                           
                                                {{ $customer->last_name }}
                                            
                                            </td>
                                            <td>
                                            
                                               {{ ''.substr($customer->mobile_no, 0, 4).' '.substr($customer->mobile_no, 4, 4).' '.substr($customer->mobile_no, 8, 4).' '.substr($customer->mobile_no, 10) }}
                                            
                                            </td>
                                            <td>
                                            
                                                {{ $customer->note }}
                                            
                                            </td>
                                            <!--<td>
                                                        @if($customer->countncsale == '0')
                                                        <a class="btn btn-secondary" title="View"
                                                           >{{ $customer->countncsale }}</a>
                                                        @else
                                                        <a class="btn btn-warning" title="View">{{ $customer->countncsale }}</a>
                                                        @endif

                                                    </td>-->
                                                    <!--<td>
                                                        @if($customer->countrepairorder == '0')
                                                        <a class="btn btn-secondary" title="View">{{ $customer->countrepairorder }}</a>
                                                        @else
                                                        <a class="btn btn-success" title="View">{{ $customer->countrepairorder }}</a>
                                                        @endif
                                                    </td>-->
                                                    <td>@if($customer->countsale == '0')
                                                        <a class="btn btn-secondary" title="View">{{ $customer->duecountsale }}</a>
                                                        @else
                                                        <a class="btn btn-danger" title="View">{{ $customer->duecountsale }}</a>
                                                        @endif
                                                    </td>
                                                    <td>@if($customer->dueamount == '0')
                                                        <a class="btn btn-secondary" title="View">£{{ number_format($customer->dueamount) }}</a>
                                                        @else
                                                        <a class="btn btn-danger" title="View">£{{ number_format($customer->dueamount) }}</a>

                                                        @endif
                                                    </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </div>

                              
                            </div>
						
						<!--
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-warning">
                                    Due Account List
                                    </h6>
                                </div>


							
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
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable123" width="100%" cellspacing="0">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Customer Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile Number</th>
                                                    <th>Date Of Birth</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($customers as $customer)
                                                <tr>
                                                    <td>{{ $customer->customer_id }}</td>

                                                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                                    <td>{{ $customer->email }}</td>
                                                    <td>{{ $customer->mobile_no }}</td>
                                                    <td>{{ $customer->date_of_birth }}</td>
                                                    <td>
                                                       
                                                        <a class="btn JewelleryPrimaryAction" title="Edit"
                                                            href="{{ route('edit.customer', $customer->customer_id) }}">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </a>
														
														  
                                                           <a class="btn JewelleryPrimaryAction" title="View"
                                                            href="{{ route('view.customer', $customer->customer_id) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </a>


                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div> -->
                            </div>
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