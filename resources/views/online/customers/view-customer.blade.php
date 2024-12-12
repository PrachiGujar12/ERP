@extends('layouts.dashboard')
@section('title', 'View Online Customer')
@section('meta_description', 'System Dashboard.')
@section('content')

<div id="content">

    <!-- Page Heading -->
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
        <a href="{{url('online-customers-list')}}" class="btn JewelleryPrimaryAction">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
        <h4 class="h3"><i class="bi bi-person"></i> {{$onlineCustomers->first_name}} {{$onlineCustomers->last_name}}</h4>
        <div>

        </div>
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid mt-4">

        <!-- Customer Details Table -->
        <div class="container-fluid customer__page">
            <div class="">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-header border bg-info text-light">
                            ONLINE CUSTOMER DETAILS
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable44" width="100%" cellspacing="0">
                                <tbody>
                                @if($onlineCustomers->first_name)
                                    <tr>
                                        <th>Name</th>
                                        <td colspan="2">{{$onlineCustomers->first_name}}</td>
                                    </tr>
                                    @endif

                                    @if($onlineCustomers->mobile_no)
                                    <tr>
                                        <th>Phone Number</th>
                                        <td colspan="2">{{$onlineCustomers->mobile_no}}</td>
                                    </tr>
                                    @endif


                                    @if($onlineCustomers->email)
                                    <tr>
                                        <th>Email</th>
                                        <td colspan="2">{{$onlineCustomers->email}}</td>
                                    </tr>
                                    @endif

                                    @if($onlineCustomers->offline_customer_id)
                                    <tr>
                                        <th>Offline Customer Id</th>
                                        <td colspan="2">{{$onlineCustomers->offline_customer_id}}</td>
                                    </tr>
                                    @endif



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @endsection