@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')


<div id="content">

    	   <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
         <a href="{{route('karigar.list')}}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>

        <h1 class="h2 mb-0 text-gray-800">EDIT KARIGAR</h1>

       <div class="px-5"></div>
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        
        <!-- Content Row -->

        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card my-5 p-md-4">

                    <!-- Tab panes -->

                    <div>
                        <form class="form-sample" action="{{ route('update.karigar', $karagir->karigar_id) }}"
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
                            <div class="row g-3">
                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Karagir Name</label>
                                    <input type="text" class="form-control" name="karigar_name"
                                        value="{{$karagir->karigar_name}}" />
                                </div>
								 <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Karigar Nick Name</label>
                                        <input type="text" class="form-control" id="textInput" name="karigar_nick_name"
                                            placeholder="Enter Karigar Nick Name" value="{{$karagir->karigar_nick_name}}" />
                                    </div>
                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="textInput" name="email"
                                        value="{{$karagir->email}}" />
                                </div>
                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" id="textInput" name="contact_no"
                                        value="{{$karagir->contact_no}}" />
                                </div>
                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="textInput" name="address"
                                        value="{{$karagir->address}}" />
                                </div>
                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Specialization</label>
                                    <input type="text" class="form-control" id="textInput" name="specialization"
                                        value="{{$karagir->specialization}}" />
                                </div>
                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">--Select Status--</option>
                                        <option value="active" {{ $karagir->status == 'active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="in-active"
                                            {{ $karagir->status == 'in-active' ? 'selected' : '' }}>In-active
                                        </option>
                                    </select>
                                </div>


                                <div class="col-12">
                                    
                                    <button type="submit" class="JewelleryPrimaryButton">Submit</button>
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