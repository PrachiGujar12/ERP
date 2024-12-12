@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')


<div id="content">
<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	<a href="{{ route('view.supplier', $supplier->supplier_id) }}" class="JewelleryPrimaryButton">
							<i class="fas fa-arrow-left mr-2"></i> Back
						</a>
            <div class=" mb-2 mb-md-0 p-0">
                <h6 class="h2 mb-0 text-gray-800">Edit Supplier</h6>
            </div>
            <div class=" d-flex gap-2 justify-content-md-end p-0">
				<a  class="px-5 mx-5"></a>
                
            </div>
        
	
	</div>
    

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->

        <div class="customer__page">
            <div class="row">
                <div class="col-12 card p-md-4 my-4">

                    <!-- Tab panes -->

                    <div>
                        <form class="form-sample" action="{{ route('update.supplier', $supplier->supplier_id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
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
                            <div class="row g-3">
                                <!-- Text input -->
								<div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Supplier Code</label>
                                        <input type="text" class="form-control" id="textInput" name="supplier_code"
                                            placeholder="Enter Supplier Code" value="{{$supplier->supplier_code}}"  />
                                    </div>
								
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Supplier Name</label>
                                    <input type="text" class="form-control" name="full_name"
                                        value="{{$supplier->full_name}}" />
                                </div>
								
								<div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Nick Name</label>
                                    <input type="text" class="form-control" id="textInput" name="contact_person_name"
                                        value="{{$supplier->contact_person_name}}" />
                                </div>
								
								<!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="company" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="company" name="company"
                                        value="{{$supplier->company}}" />
                                </div>
								
								
								<!--start-->
		<div class="col-md-6 form__fields">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address"  value="{{$supplier->address}}" placeholder="Enter Address" />
        </div>
									
		<div class="col-md-6 form__fields">
            <label for="town" class="form-label">Town</label>
            <input type="text" class="form-control" id="town" name="town"  value="{{$supplier->town}}" placeholder="Enter Town" />
        </div>
									
		<div class="col-md-6 form__fields">
            <label for="city" class="form-label">City/County</label>
            <input type="text" class="form-control" id="city" name="city" value="{{$supplier->city}}"  placeholder="Enter City/County" />
        </div>
									
		<div class="col-md-6 form__fields">
            <label for="post" class="form-label">Post Code</label>
            <input type="text" class="form-control" id="post" name="post" value="{{$supplier->post}}"  placeholder="Enter Post Code" />
        </div>
									
		<div class="col-md-6 form__fields">
            <label for="country" class="form-label">Country</label>
            <input type="text" class="form-control" id="country" value="{{$supplier->country}}"  name="country" placeholder="Enter Country" />
        </div>
									<!--end-->
								
								<!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" id="textInput" name="mobile_no"
                                        value="{{$supplier->mobile_no}}" />
                                </div>
                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="textInput" name="email"
                                        value="{{$supplier->email}}" />
                                </div>

								<div class="col-md-6 form__fields">
    <label for="note" class="form-label">Note</label>
    <textarea class="form-control" id="note" name="note" placeholder="Enter note here">{{$supplier->note}}</textarea>
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
    <!-- Content Row -->


    <!-- /.container-fluid -->
</div>
@endsection