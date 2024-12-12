@extends('layouts.dashboard')
@section('title', 'Diamond Edit')
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
            
            <h1 class="h2 mb-0 text-gray-800">DIAMOND TYPE  EDIT</h1>

            <a href="{{route('diamond.shape.list')}}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Diamond Shape list
            </a>

    </div>	
    

    <!-- Begin Page Content -->
    <div class="container-fluid my-4">
        <!-- Page Heading -->
       
        <!-- Content Row -->

        <div class=" customer__page">
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
            <div class="row">
                <div class="col-12 card  p-md-4">

                    <!-- Tab panes -->

                    <div>
                        <form class="form-sample" action="{{route('update.diamond.shape', $diamondshape->id)}}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                         
                            <div class="row g-3">
                                <!-- Text input -->
                                
                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="diamond_shape" class="form-label">Diamond Shape</label>
                                    <input type="text" class="form-control" id="diamond_shape" name="diamond_shape"
                                        value="{{$diamondshape->shape}}" required>
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