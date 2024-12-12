@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')


<div id="content">



    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Metal Rate </h1>
         
        </div>
        <!-- Content Row -->

        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card shadow p-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills py-3 nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-customer-tab" data-toggle="pill"
                                        href="#pills-customer" role="tab" aria-controls="pills-customer"
                                        aria-selected="false">Rates List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="add-new-customer-tab" data-toggle="pill"
                                        href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                        aria-selected="true">Add New Metal Rate</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-warning">Rates List</h6>
                                </div>
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
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Metal Type</th>
                                                    <th>Purity</th>
                                                    <th>Rate (per gram)</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($rates as $rate)
                                                <tr>
                                                    <input type="hidden" name="rates[{{ $rate->metal_id }}][id]"
                                                        value="{{ $rate->metal_id }}">
                                                    <td>{{ $rate->metal_id }}</td>
                                                    <td>{{ $rate->metal_type }}</td>
                                                    <td>{{ $rate->purity }}</td>
                                                    <td>{{ $rate->rate }}</td>
                                                    <td>{{ $rate->date }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('edit.rate', $rate->metal_id) }}">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="add-new-customer" role="tabpanel"
                            aria-labelledby="add-new-customer-tab">
                            <form action="{{ route('add.rate') }}" method="POST" id="addRateForm"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row g-3">
                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Metal Type</label>
                                        <!-- <input type="text" class="form-control" id="textInput" name="metal_type"
                                            placeholder="Enter Metal Type" /> -->
                                        <select class="form-control" id="metal_type" name="metal_type">
                                        <option value="" selected> Select Metal Type</option>
                                            @foreach($itemTypes as $itemType)
                                            <option value="{{ $itemType->item_type_name }}">
                                                {{ $itemType->item_type_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Purity</label>
                                        <select class="form-control" id="purity" name="purity">
                                            <option value="" selected> Select Purity </option>
                                            <option value="18" {{ old('purity') == '18' ? 'selected' : '' }}>18 Carat
                                            </option>
                                            <option value="22" {{ old('purity') == '22' ? 'selected' : '' }}>22 Carat
                                            </option>
                                            <option value="24" {{ old('purity') == '24' ? 'selected' : '' }}>24 Carat
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="dateInput" name="date"
                                            value="{{ \Carbon\Carbon::today()->toDateString() }}" />
                                    </div>
                                    <!-- Text input -->
                                    <div class="col-md-6 form__fields">
                                        <label for="textInput" class="form-label">Rate</label>
                                        <input type="text" class="form-control" id="textInput" name="rate"
                                            placeholder="Enter Rate" />
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
    </div>
    <!-- Content Row -->


    <!-- /.container-fluid -->
</div>


<script>
// Set the default date to today
var today = new Date().toISOString().split('T')[0];
document.getElementById("dateInput").value = today;
</script>
@endsection