@extends('online.layouts.app')
@section('content')
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Blogs</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Category</th>
                                        <th>Tags</th>
                                        <th>Publish Date</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $blog)
                                            <tr>
                                                <td>{{$blog->id}}</td>
                                                <td>{{$blog->title}}</td>
                                                <td>By {{$blog->author}}</td>
                                                <td>{{$blog->category_name}}</td>
                                                <td>{{$blog->tags_name}}</td>
                                                <td>{{$blog->publish_date}}</td>
                                                <td>
                                                    <a class="btn btn-primary" href="{{url('/edit/blog/'. $blog->id)}}" role="button">Edit</a>
                                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $blog->id }}" data-action="#"
                                                        role="button">Delete</a>
                                                </td>
                                            </tr>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $blog->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('admin.deleteblog', $blog->id) }}"
                                                                method="POST">
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
        </>
        <!-- main-panel ends -->
    </div>
</div>
@endsection