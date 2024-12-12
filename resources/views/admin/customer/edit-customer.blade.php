@extends('layouts.dashboard')
@section('title', 'Edit Customer')
@section('meta_description', 'System Dashboard.')
@section('content')

<div id="content">
	
        <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
			<a href="{{route('customers.list')}}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back 
        		</a>
            <h1 class="m-0 h3  text-dark">EDIT CUSTOMER</h1>
			
			
            
				
				<button type="submit" form="edit-customer-form"  class="JewelleryPrimaryButton ml-3">Submit</button>
			
        </div>
    <!-- Begin Page Content -->
    <div class="container-fluid mb-5">
		 
        <!-- Page Heading -->
        
        <!-- Content Row -->
<form id="edit-customer-form" class="form-sample" action="{{route('update.customer', $customer->customer_id)}}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card mt-4">


                    <div class="row">
                       
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
                                <div class="col-12">
                                    <!-- First Name -->
                                    <div class="col-md-12 form__fields">
                                        <label for="firstName" class="form-label">First Name</label>
                                    
                                        <input type="text" class="form-control" id="firstName" name="first_name" value="{{ old('first_name', $customer->first_name) }}" />
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-md-12 form__fields">
                                        <label for="lastName" class="form-label">Last Name</label>

                                        <input type="text" class="form-control" id="lastName" name="last_name" value="{{ old('last_name', $customer->last_name) }}" />
                                    </div>
									
									<!-- Mobile Number -->
                                    <div class="col-md-12 form__fields">
                                        <label for="mobileNumber" class="form-label">Mobile Number</label>
                                    
                                        <input type="text" class="form-control" id="mobileNumber" name="mobile_no" value="{{ old('mobile_no', $customer->mobile_no) }}" />
                                    </div>
									
									<!-- Address -->
                                    <div class="col-md-12 form__fields">
                                        <label for="address" class="form-label">Address</label>
                                    
                                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $customer->address) }}" />
                                    </div>

									<!-- town -->
                                     <div class="col-md-12 form__fields">
                                        <label for="town" class="form-label">Town</label>
                                    
                                        <input type="text" class="form-control @error('town') is-invalid @enderror" id="town" name="town" placeholder="Enter town" value="{{ old('town', $customer->town) }}"  />
                                       
                                    </div>
									
									<!-- county -->
                                     <div class="col-md-12 form__fields">
                                        <label for="county" class="form-label">County</label>
                                    
                                        <input type="text" class="form-control @error('county') is-invalid @enderror" id="county" name="county" placeholder="Enter County" value="{{ old('county', $customer->county) }}"  />
                                       
                                    </div>
									
									
									<!-- Post Code -->
                                     <div class="col-md-12 form__fields">
                                        <label for="post-code" class="form-label">Post Code</label>
                                    
                                        <input type="text" class="form-control @error('post-code') is-invalid @enderror" id="post-code" name="post_code" placeholder="Enter Post Code" value="{{ old('post_code', $customer->post_code) }}" />
                                       
                                    </div>
									
									
						

                                    <!-- Email -->
                                    <div class="col-md-12 form__fields">
                                        <label for="email" class="form-label">Email</label>
                                    
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}" />
                                    </div>

                                  

                                    

                                    <!-- Date of Birth -->
                                    <div class="col-md-12 form__fields">
                                        <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                   
                                        <input type="date" class="form-control" id="dateOfBirth" name="date_of_birth" value="{{ old('date_of_birth', $customer->date_of_birth) }}" />
                                    </div>

                                    <!-- WhatsApp (Optional) -->
                                    <div class="col-md-12 form__fields">
                                        <label for="whatsapp" class="form-label">WhatsApp (Optional)</label>

                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp_no" value="{{ old('whatsapp_no', $customer->whatsapp_no) }}" />
                                    </div>

                                    

									
                                    <!-- Instagram  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="instagram" class="form-label">Instagram</label>
                                    
                                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" placeholder="Enter Instagram" value="{{ old('instagram', $customer->instagram) }}" />
                                        
                                    </div>
									
									<!-- Facebook  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="facebook" class="form-label">Facebook</label>
                                    
                                        <input type="text" value="{{ old('facebook', $customer->facebook) }}" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" placeholder="Enter Facebook"  />
                                        
                                    </div>
									
									<!-- Tiktok  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="tiktok" class="form-label">Tiktok</label>
                                    
                                        <input type="text" class="form-control @error('tiktok') is-invalid @enderror" id="tiktok" name="tiktok" placeholder="Enter Tiktok" value="{{ old('tiktok', $customer->tiktok) }}"  />
                                        
                                    </div>
									
									<!-- Religion  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="religion" class="form-label">Religion</label>
                                    
                                        <input type="text" class="form-control @error('religion') is-invalid @enderror" id="religion" name="religion" placeholder="Enter Religion" value="{{ old('religion', $customer->religion) }}"  />
                                        
                                    </div>
									
									<!-- note -->
                                     <div class="col-md-12 form__fields">
                                        <label for="note" class="form-label">Note</label>
                                    
										 <textarea class="form-control @error('note') is-invalid @enderror" id="note" row="6" name="note" placeholder="Enter Note" >{{ old('note', $customer->note) }}</textarea>
                                        
                                       
                                    </div>
									
                                    <div class="col-12">
                                        
                                    </div>
                                </div>

                       
                    </div>

                </div>

            </div>
        </div>
			  </form>
    </div>
    <!-- Content Row -->


    <!-- /.container-fluid -->
</div>

<script>
    document.getElementById('mobileNumber').addEventListener('input', function (e) {
        let input = e.target.value;

        // Allow + at the beginning and exactly 2 digits after +, remove all other non-numeric characters
        input = input.replace(/(?!^\+)\D/g, ''); // Allow only numbers and + at the start

        // Format the number as +01 1234 1234 123
        if (input.startsWith('+')) {
            if (input.length > 3 && input.length <= 7) {
                input = input.replace(/(\+\d{2})(\d+)/, '$1 $2'); // Add space after country code
            } else if (input.length > 7 && input.length <= 11) {
                input = input.replace(/(\+\d{2})(\d{4})(\d+)/, '$1 $2 $3'); // Add space after first group of 4 digits
            } else if (input.length > 11) {
                input = input.replace(/(\+\d{2})(\d{4})(\d{4})(\d+)/, '$1 $2 $3 $4'); // Add space after second group of 4 digits
            }
        } else {
            if (input.length > 4 && input.length <= 8) {
                input = input.replace(/(\d{4})(\d+)/, '$1 $2'); // Handle case without +
            } else if (input.length > 8) {
                input = input.replace(/(\d{4})(\d{4})(\d+)/, '$1 $2 $3');
            }
        }

        // Set the formatted value back to the input field
        e.target.value = input;

        // Automatically copy mobile number to WhatsApp field
        document.getElementById('whatsapp').value = input;
    });
</script>

<script>

@endsection