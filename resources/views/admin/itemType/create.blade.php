@extends('layouts.dashboard')
@section('title', 'METAL TYPE')
@section('meta_description', 'System user list.')
@section('content')


<div id="content">
<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
	<a href="{{ url('/item-type-list') }}" class="JewelleryPrimaryButton" onclick="checkFormAndNavigate(event)">
    <i class="fas fa-arrow-left mr-2"></i> Back
</a>
            <div class=" mb-2 mb-md-0 p-0">
                <h1 class="h3 mb-0 text-gray-800">ADD METAL TYPE & PURITY</h1>
            </div>
            <div class="">
               <a class="px-5 mx-5" ></a>
            </div>
        
	
	</div>
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Content Row -->
        <div class="customer__page">
            <div class="">
                <div class="col-12 card my-4">
                    <div class="row">
                        <div class="col-md-6 d-none">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills py-3 nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " id="pills-customer-tab" data-toggle="pill"
                                        href="#pills-customer" role="tab" aria-controls="pills-customer"
                                        aria-selected="false">Item Type List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="add-new-customer-tab" data-toggle="pill"
                                        href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                        aria-selected="true">Add New Type</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade " id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="card mb-4">
                               
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
                                                    <th>Metal Type & Purity</th>
                                                    <th>Item Type Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach($itemTypes as $itemType)
                                                <tr>
                                                    <td>{{ $itemType->item_type_id }}</td>
                                                    <td>{{ $itemType->item_type_name }}</td>
                                                    <td>{{ $itemType->item_type_description }}</td>
                                                   
                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('edit.item.type', $itemType->item_type_id) }}">
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

                        <div class="tab-pane fade show active" id="add-new-customer" role="tabpanel"
                            aria-labelledby="add-new-customer-tab">
                            <form action="{{ route('add.item.type') }}" method="POST" id="addCategoryForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6 form__fields">
                                        <label for="itemTypeName" class="form-label">Metal Type & Purity</label>
                                        <input type="text" class="form-control" id="itemTypeName" name="item_type_name"
                                            placeholder="Enter Item Type Name" required>
                                    </div>
                                    <div class="col-md-6 form__fields">
                                        <label for="itemTypeDescription" class="form-label">Item Type
                                            Description</label>
                                        <input type="text" class="form-control" id="itemTypeDescription"
                                            name="item_type_description" placeholder="Enter Item Type Description" required>
                                    </div>

                                    <div class="mb-3 d-none">
                                        <label class="form-label">Purity:</label>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="purity18"
                                                name="purity[]" value="18" >
                                            <label class="form-check-label" for="purity18">18 Karat</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="purity22"
                                                name="purity[]" value="22">
                                            <label class="form-check-label" for="purity22">22 Karat</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="purity24"
                                                name="purity[]" value="24">
                                            <label class="form-check-label" for="purity24">24 Karat</label>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <button type="submit" class="btn  btn-primary mt-3">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
</div>


<script>
function checkFormAndNavigate(event) {
    event.preventDefault();
    const fields = ['itemTypeDescription', 'itemTypeName'];
    let allEmpty = true;

    for (const field of fields) {
        const input = document.getElementById(field);
        if (input && input.value.trim() !== '') {
            allEmpty = false;
            break;
        }
    }

    if (allEmpty) {
        window.location.href = "{{ url('/item-type-list') }}";
    } else {
        // Show confirm dialog and navigate back if the user clicks "OK"
        const confirmNavigation = confirm("You have entered data. Are you sure you want to go back?");
        if (confirmNavigation) {
            window.location.href = "{{ url('/item-type-list') }}";
        }
    }
}
</script>

@endsection