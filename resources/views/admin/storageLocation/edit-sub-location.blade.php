@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')


<div id="content">

<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	
	 <a href="{{ url('sub-locations-list') }}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
            <h1 class="h2 mb-0 text-gray-800">EDIT SUB LOCATION </h1>
	 <button type="button" class="px-5 mx-5"></button>
       
	</div>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        
        <!-- Content Row -->

        <div class="container-fluid staff__page">
            <div class="row">
                <div class="col-12 card p-md-4 my-5">

                    <!-- Tab panes -->

                    <div>
                        <form action="{{ route('update.sub.location', $sub_location->sub_location_id) }}" method="POST"
                            id="updateLocationForm" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
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
                                    <label for="textInput" class="form-label">Sub Loaction Name</label>
                                    <input type="text" class="form-control" name="sub_location_name"
                                        value="{{$sub_location->sub_location_name}}" />
                                </div>

                                <div class="col-md-6 form__fields">
                                    <label for="location" class="form-label">Location</label>
                                    <select class="form-control" id="location" name="location" required>
                                        <option value="">--Select Location--</option>
                                        @foreach($locations as $location)

                                        <option value="{{ $location->location_id }}"
                                            {{ old('location', $sub_location->location ?? '') == $location->location_id ? 'selected' : '' }}>
                                            {{ $location->location_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>



                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Capacity</label>
                                    <input type="number" class="form-control" min="1" id="textInput" name="capacity"
                                        value="{{$sub_location->capacity}}" />
                                </div>

                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Weight(in grams)</label>
                                    <input type="number" class="form-control"   min="0.1"  step="0.1"  id="textInput" name="weight"
                                        value="{{$sub_location->weight}}" />
                                </div>


                                <div class="col-12">
                                    <a href="{{url('sub-locations-list')}}" class="btn btn-sm btn-warning mt-3">Back</a>
                                    <button type="submit" class="btn btn-sm btn-primary mt-3">Submit</button>
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