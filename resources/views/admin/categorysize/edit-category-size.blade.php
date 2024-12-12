@extends('layouts.dashboard')
@section('title', 'All Users')
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
            
            <h1 class="h2 mb-0 text-gray-800">CATEGORY SIZE EDIT</h1>

            <a href="{{route('categories.size.list')}}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Category size list
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
                        <form class="form-sample" action="{{route('update.category.size', $size->id)}}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                         
                            <div class="row g-3">
                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="category_name"
                                        value="{{$size->category->category_name}}"  disabled/>
                                </div>
                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Category Size</label>
                                    <input type="text" class="form-control" id="textInput" name="category_description"
                                        value="{{$size->size}}" />
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