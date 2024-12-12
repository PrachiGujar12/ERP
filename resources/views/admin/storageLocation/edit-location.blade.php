@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')


<div id="content">

    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	
	 <a href="{{ url('locations-list') }}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
            <h1 class="h2 mb-0 text-gray-800">EDIT LOCATION </h1>
	 <button type="button" class="px-5 mx-5" id="printBtn"></button>
       
	</div>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->

        <div class="container-fluid staff__page">
            <div class="row">
                <div class="col-12 card p-md-4 my-5">

                    <!-- Tab panes -->

                    <div>
                        <form action="{{ route('update.storage.location', $location->location_id) }}" method="POST" id="updateLocationForm"
                            enctype="multipart/form-data">
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
                                    <label for="textInput" class="form-label">Loaction Name</label>
                                    <input type="text" class="form-control" name="location_name"
                                        value="{{$location->location_name}}" />
                                </div>
                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="textInput" name="description"
                                        value="{{$location->description}}" />
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
    <!-- Content Row -->


    <!-- /.container-fluid -->
</div>
@endsection