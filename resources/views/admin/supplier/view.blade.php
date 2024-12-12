@extends('layouts.dashboard')
@section('title', 'Supplier')
@section('meta_description', 'System user list.')
@section('content')


<div id="content">
<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	<a href="{{url('/supplier-list')}}" class="JewelleryPrimaryButton">
							<i class="fas fa-arrow-left mr-2"></i> Back
						</a>
            <div class=" mb-2 mb-md-0 p-0">
                <h6 class="h2 mb-0 text-gray-800">View Supplier</h6>
            </div>
            <div class=" d-flex gap-2 justify-content-md-end p-0">
				<a  class="JewelleryPrimaryAction btn" href="{{ route('edit.supplier', $supplier->supplier_id) }}"><i class="bi bi-pencil-square"></i> Edit</a>
				@if($supplier->mobile_no)
            <a href="https://wa.me/{{$supplier->mobile_no}}" target="_blank" type="button"
                class="JewelleryPrimaryAction btn" title="WhatsApp"><i class="bi bi-whatsapp"></i> WhatsApp
            </a>
            @endif
				
                @if($supplier->mobile_no)
            <a href="mailto:{{$supplier->email}}" target="_blank" type="button"
                class="JewelleryPrimaryAction btn" title="WhatsApp"><i class="bi bi-envelope"></i> Email
            </a>
            @endif
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
                         <table class="table table-bordered mt-4">
        <tbody>
            <tr>
                <td class="col-4 p-3"><strong>Supplier Code:</strong></td>
                <td class="col-8 p-3">{{ $supplier->supplier_code }}</td>
            </tr>
            <tr>
                <td class="col-4 p-3"><strong>Supplier Name:</strong></td>
                <td class="col-8 p-3">{{ $supplier->full_name }}</td>
            </tr>
            <tr>
                <td class="col-4 p-3"><strong>Nick Name:</strong></td>
                <td class="col-8 p-3">{{ $supplier->contact_person_name }}</td>
            </tr>
            <tr>
                <td class="col-4 p-3"><strong>Company Name:</strong></td>
                <td class="col-8 p-3">{{ $supplier->company }}</td>
            </tr>
            <tr>
                <td class="col-4 p-3"><strong>Address:</strong></td>
                <td class="col-8 p-3">{{ $supplier->address }}</td>
            </tr>
            <tr>
                <td class="col-4 p-3"><strong>Town:</strong></td>
                <td class="col-8 p-3">{{ $supplier->town }}</td>
            </tr>
            <tr>
                <td class="col-4 p-3"><strong>City/County:</strong></td>
                <td class="col-8 p-3">{{ $supplier->city }}</td>
            </tr>
            <tr>
                <td class="col-4 p-3"><strong>Post Code:</strong></td>
                <td class="col-8 p-3">{{ $supplier->post }}</td>
            </tr>
            <tr>
                <td class="col-4 p-3"><strong>Country:</strong></td>
                <td class="col-8 p-3">{{ $supplier->country }}</td>
            </tr>
            <tr>
                <td class="col-4 p-3"><strong>Mobile Number:</strong></td>
                <td class="col-8 p-3">{{ $supplier->mobile_no }}</td>
            </tr>
            <tr>
                <td class="col-4 p-3"><strong>Email:</strong></td>
                <td class="col-8 p-3">{{ $supplier->email }}</td>
            </tr>
            <tr>
                <td class="col-4 p-3"><strong>Note:</strong></td>
                <td class="col-8 p-3">{{ $supplier->note }}</td>
            </tr>
        </tbody>
    </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- Content Row -->


    <!-- /.container-fluid -->
</div>
@endsection