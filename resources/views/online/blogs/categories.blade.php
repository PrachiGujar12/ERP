@extends('online.layouts.app')
@section('content')
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Add New Category</h4>

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{route('store.category')}}" method="post">
                                @csrf
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="slug" class="form-label">Slug:</label>
                                    <input type="text" class="form-control" id="slug" placeholder="Enter slug" name="slug">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="parentcategory" class="form-label">Parent Category:</label>
                                    <select class="form-select" id="parentcategory" name="parentcategory" required>
                                        <option value="0">None</option>
                                        @foreach ($parentcategories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Categories</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Parent Category</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $data)
                                            <tr>
                                                <td><input type="checkbox" name="ids" class="checkbox_ids" id="" value="{{$data->id}}" @if($data->parentcategory === '0') style="display:none" @endif></td>
                                                <td>@if ($data->parentcategory != '0')
                                                     -- 
                                                    @endif 
                                                    {{$data->name}}
                                                </td>
                                                <td>{{$data->slug}}</td>
                                                <td>{{$data->parentcategory_name}}</td>
                                                <td>
                                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}" data-action="#" role="button">Edit</a>
                                                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id }}" data-action="#" role="button">Delete</a>
                                                </td>
                                            </tr>
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Film</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="contact-form topmargin_50" method="post" action="{{route('update.blog.category')}}">
                                                                {!! csrf_field() !!}
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-12">
                                                                        <p class="form-group">
                                                                            <label for="name">ID :</label>
                                                                            <input name="id" class="form-control" placeholder="Category ID" value="{{ $data->id }}" type="text" required readonly>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-12 mt-3">
                                                                        <p class="form-group">
                                                                            <label for="name">Category Name :</label>
                                                                            <input name="name" class="form-control" value="{{ $data->name }}" type="text">
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-12 mt-3">
                                                                        <p class="form-group">
                                                                            <label for="name">Parent Category :</label>
                                                                            <select class="form-select" id="parentcategory" name="parentcategory" required>
                                                                                <option value="0">None</option>
                                                                                @foreach ($parentcategories as $category)                                                                            
                                                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                                                @endforeach
                                                                            </select>                                                                    
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 text-end mt-3">
                                                                        <div class="contact-form-submit topmargin_20">
                                                                            <button type="submit" class="btn btn-success"> Submit </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Delete Cars</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('admin.deleteCategory', $data->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
@endsection