@extends('layouts.dashboard')
@section('title', 'Add Customer')
@section('meta_description', 'System Dashboard.')
@section('content')

<div id="content">
	<form class="form-sample" action="{{ route('add.customer') }}" enctype="multipart/form-data" method="POST">
                                @csrf
	<div class="d-flex gap-2 d-flex justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
		
                                    <a href="{{route('customers.list')}}" class="JewelleryPrimaryButton gap-2 btn-primary" onclick="return confirmCancel()">Cancel</a>


								<h6 class="m-0 h3 text-dark">
                                    NEW CUSTOMER
								</h6>
								<div>
								<button type="submit" class="JewelleryPrimaryButton ml-2"><i class="bi bi-floppy-fill"></i> Save</button>
									
                                </div>
                                
	</div>
    <!-- Begin Page Content -->
    <div class="container-fluid">
		 

		                      <div class="card  tab-pane fade show active my-4 p-4" id="add-new-customer" role="tabpanel"
                            aria-labelledby="add-new-customer-tab">
								  
				<div class="MainForm">
                                <div class="row g-3" >
                                    <!-- First Name -->
                                    <div class="col-md-12 form__fields">
                                        <label for="firstName" class="form-label">First Name*</label>
                                    
                                   
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstName" name="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" required />
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-md-12 form__fields">
                                        <label for="lastName" class="form-label">Last Name*</label>
                                   
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="lastName" name="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" required/>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Mobile Number -->
                                     <div class="col-md-12 form__fields">
    <label for="mobileNo" class="form-label">Mobile Number*</label>
    
    <div class="input-group">
        <!-- Country Code Dropdown -->
        <select id="countryCode" class="form-select" aria-label="Country code" required>
            <option value="+1">+1 (USA)</option>
    <option value="+44">+44 (UK)</option>
    <option value="+91">+91 (India)</option>
    <option value="+61">+61 (Australia)</option>
    <option value="+81">+81 (Japan)</option>
    <option value="+86">+86 (China)</option>
    <option value="+33">+33 (France)</option>
    <option value="+49">+49 (Germany)</option>
    <option value="+39">+39 (Italy)</option>
    <option value="+34">+34 (Spain)</option>
    <option value="+55">+55 (Brazil)</option>
    <option value="+7">+7 (Russia)</option>
    <option value="+27">+27 (South Africa)</option>
    <option value="+82">+82 (South Korea)</option>
    <option value="+52">+52 (Mexico)</option>
    <option value="+31">+31 (Netherlands)</option>
    <option value="+47">+47 (Norway)</option>
    <option value="+46">+46 (Sweden)</option>
    <option value="+41">+41 (Switzerland)</option>
    <option value="+65">+65 (Singapore)</option>
    <option value="+60">+60 (Malaysia)</option>
    <option value="+62">+62 (Indonesia)</option>
    <option value="+63">+63 (Philippines)</option>
    <option value="+20">+20 (Egypt)</option>
    <option value="+98">+98 (Iran)</option>
    <option value="+90">+90 (Turkey)</option>
    <option value="+966">+966 (Saudi Arabia)</option>
    <option value="+971">+971 (United Arab Emirates)</option>
    <option value="+92">+92 (Pakistan)</option>
    <option value="+48">+48 (Poland)</option>
    <option value="+30">+30 (Greece)</option>
    <option value="+351">+351 (Portugal)</option>
    <option value="+32">+32 (Belgium)</option>
    <option value="+354">+354 (Iceland)</option>
    <option value="+353">+353 (Ireland)</option>
    <option value="+421">+421 (Slovakia)</option>
    <option value="+36">+36 (Hungary)</option>
    <option value="+48">+48 (Poland)</option>
    <option value="+43">+43 (Austria)</option>
    <option value="+64">+64 (New Zealand)</option>
    <option value="+420">+420 (Czech Republic)</option>
    <option value="+977">+977 (Nepal)</option>
    <option value="+94">+94 (Sri Lanka)</option>
    <option value="+95">+95 (Myanmar)</option>
    <option value="+975">+975 (Bhutan)</option>
    <option value="+380">+380 (Ukraine)</option>
    <option value="+94">+94 (Sri Lanka)</option>
        </select>
        
        <!-- Mobile Number Input -->
        <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobileNo" placeholder="Enter Mobile Number" required />
    </div>
    
    <!-- Hidden Field to Combine Country Code and Mobile Number -->
    <input type="hidden" id="combinedMobileNo" name="mobile_no" value="{{ old('mobile_no') }}" />
    
    @error('mobile_no')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
									
									<!-- Address -->
                                     <div class="col-md-12 form__fields">
                                        <label for="address" class="form-label">Address</label>
                                    
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter Address" value="{{ old('address') }}" />
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- town -->
                                     <div class="col-md-12 form__fields">
                                        <label for="town" class="form-label">Town</label>
                                    
                                        <input type="text" class="form-control @error('town') is-invalid @enderror" id="town" name="town" placeholder="Enter town" value="{{ old('town') }}" />
                                        @error('town')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- county  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="county" class="form-label">County</label>
                                    
                                        <input type="text" class="form-control @error('county') is-invalid @enderror" id="county" name="county" placeholder="Enter county" value="{{ old('county') }}" />
                                        @error('county')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									
									<!-- Post Code -->
                                     <div class="col-md-12 form__fields">
                                        <label for="post-code" class="form-label">Post Code</label>
                                    
                                        <input type="text" class="form-control @error('post-code') is-invalid @enderror" id="post-code" name="post_code" placeholder="Enter Post Code"  value="{{ old('post_code') }}" />
                                        @error('post-code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <!-- Email -->
                                    <div class="col-md-12 form__fields">
                                        <label for="email" class="form-label">Email</label>
                                    
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email"  value="{{ old('email') }}"/>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    


                                    
                                    <!-- Date of Birth -->
                                     <div class="col-md-12 form__fields">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                    
                                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="dob" name="date_of_birth" value="{{ old('date_of_birth') }}" />
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- WhatsApp Number -->
                                     <div class="col-md-12 form__fields">
                                        <label for="whatsappNo" class="form-label">WhatsApp</label>
                                    
                                        <input type="text" class="form-control" id="whatsappNo" name="whatsapp_no" placeholder="Enter WhatsApp Number" value="{{ old('whatsapp_no') }}" />
                                    </div>

                                    
									
                                    <!-- Instagram  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="instagram" class="form-label">Instagram</label>
                                    
                                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" placeholder="Enter Instagram" value="{{ old('instagram') }}"  />
                                        @error('instagram')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Facebook  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="facebook" class="form-label">Facebook</label>
                                    
                                        <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" placeholder="Enter Facebook" value="{{ old('facebook') }}" />
                                        @error('facebook')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Tiktok  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="tiktok" class="form-label">Tiktok</label>
                                    
                                        <input type="text" class="form-control @error('tiktok') is-invalid @enderror" id="tiktok" name="tiktok" placeholder="Enter Tiktok"  value="{{ old('tiktok') }}"/>
                                        @error('tiktok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Religion  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="religion" class="form-label">Religion</label>
                                    
                                        <input type="text" class="form-control @error('religion') is-invalid @enderror" id="religion" name="religion" placeholder="Enter Religion" value="{{ old('religion') }}" />
                                        @error('religion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
																		<div class="col-md-12 form__fields">
    <label for="note" class="form-label">Note</label>
    
    <textarea class="form-control @error('note') is-invalid @enderror" id="note" row="6" name="note" placeholder="Enter Note">{{ old('note') }}</textarea>
    
    @error('note')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
									
                                </div>
							</div>
                            </form>

                        </div>
    </div>
   <!-- /.container-fluid -->
</div>
<script>
    function confirmCancel() {
        // Select all input fields (modify the selector if necessary)
        const inputs = document.querySelectorAll('input[type="text"], input[type="number"], textarea');
        
        // Check if any input has a value
        let isAnyFieldFilled = false;
        inputs.forEach(input => {
            if (input.value.trim() !== "") {
                isAnyFieldFilled = true;
            }
        });

        // If any field is filled, show custom confirmation dialog
        if (isAnyFieldFilled) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You have unsaved changes. Do you want to discard them?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Discard',
                cancelButtonText: 'Keep Editing',
				customClass: {
                    confirmButton: 'btn btn-danger mx-2',   // Custom class for "Discard"
                    cancelButton: 'btn btn-primary mx-2'    // Custom class for "Keep Editing"
                },
                buttonsStyling: false 
            }).then((result) => {
                if (result.isConfirmed) {
                    // If "Discard" is clicked, navigate away
                    window.location.href = "{{route('customers.list')}}";
                }
                // If "Keep Editing" is clicked, just return and keep editing
            });
            return false;  // Prevent the default behavior for now
        }

        // No fields are filled, proceed without confirmation
        return true;
    }
</script>
<script>
    document.getElementById('mobileNo').addEventListener('input', function (e) {
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
        document.getElementById('whatsappNo').value = input;
    });
</script>

<script>
    const countryCodeElement = document.getElementById('countryCode');
    const mobileNoElement = document.getElementById('mobileNo');
    const combinedMobileNoElement = document.getElementById('combinedMobileNo');

    // Function to update combined mobile number
    function updateCombinedMobileNo() {
        combinedMobileNoElement.value = countryCodeElement.value + mobileNoElement.value;
    }

    // Attach event listeners to update combined field
    countryCodeElement.addEventListener('change', updateCombinedMobileNo);
    mobileNoElement.addEventListener('input', updateCombinedMobileNo);
</script>

@endsection