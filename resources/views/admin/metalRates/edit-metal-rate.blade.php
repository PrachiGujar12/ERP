@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')


<div id="content">

    

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Metal Rates</h1>
          
        </div>
        <!-- Content Row -->

        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card shadow p-md-4">

                    <!-- Tab panes -->

                    <div>
                        

                        <form action="{{ route('update.rate', $rates->metal_id) }}" method="POST" id="updateRateForm">
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
                            <div class="row g-3">
                                <!-- Text input -->
                                <div class="col-md-6 form__fields">
                                    <label for="textInput" class="form-label">New Rate</label>
                                    <input type="text" class="form-control" name="rate" value="{{$rates->rate}}" />
                                </div>


                                <div class="col-12">
                                    <a href="{{url('metal-rates-list')}}" class="btn btn-sm btn-warning mt-3">Back</a>
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