@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
	<a href="{{url('/item-type-list')}}" class="JewelleryPrimaryButton">
							<i class="fas fa-arrow-left mr-2"></i> Back
						</a>
            <div class=" mb-2 mb-md-0 p-0">
                <h1 class="h3 mb-0 text-gray-800">EDIT METAL TYPE & PURITY</h1>
            </div>
            <div class="">
               <a class="px-5 mx-5" ></a>
            </div>
        
	
	</div>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        
        <!-- Content Row -->

        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12 card my-5 p-md-4">
                    <div>
                        <form class="form-sample" action="{{ route('update.item.type', $itemType->item_type_id) }}"
                              enctype="multipart/form-data" method="POST">
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
                                <!-- Item Type Name -->
                                <div class="col-md-6 form__fields">
                                    <label for="itemTypeName" class="form-label">Item Type Name</label>
                                    <input type="text" class="form-control" id="itemTypeName" name="item_type_name"
                                           value="{{ $itemType->item_type_name }}" />
                                </div>
                                <!-- Item Type Description -->
                                <div class="col-md-6 form__fields">
                                    <label for="itemTypeDescription" class="form-label">Item Type Description</label>
                                    <input type="text" class="form-control" id="itemTypeDescription" 
                                           name="item_type_description" value="{{ $itemType->item_type_description }}" />
                                </div>

                                <div class="mb-3 d-none">
                                    <label class="form-label">Purity:</label>
                                    @php
                                        $purities = array_map('trim', explode(',', $itemType->purity));
                                    @endphp

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="purity18" name="purity[]"
                                               value="18" {{ in_array('18', $purities) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="purity18">18 Karat</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="purity22" name="purity[]"
                                               value="22" {{ in_array('22', $purities) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="purity22">22 Karat</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="purity24" name="purity[]"
                                               value="24" {{ in_array('24', $purities) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="purity24">24 Karat</label>
                                    </div>
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
    <!-- /.container-fluid -->
</div>
@endsection
