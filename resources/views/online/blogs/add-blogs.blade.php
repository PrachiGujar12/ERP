@extends('online.layouts.app')
@section('content')
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form class="forms-sample" enctype="multipart/form-data" action="{{route('store.blog')}}" method="post">
                <div class="row">                
                    <div class="col-lg-9 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add New Blogs</h4>
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-label">Title:</label>
                                    <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title">
                                    @error('title')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="form-label">Description:</label>
                                    <textarea id="my-editor" class="form-control" placeholder="Enter Description" name="description"></textarea>
                                    @error('description')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name" class="form-label">SEO Title:</label>
                                    <input type="text" class="form-control" id="seotitle" placeholder="Enter SEO Title" name="seotitle">
                                    @error('seotitle')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="form-label">SEO Description:</label>
                                    <input type="text" class="form-control" id="seodescription" placeholder="Enter SEO Description" name="seodescription">
                                    @error('seodescription')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Allow Search Engine To Show Content In Search Results?</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="allow_search" id="allow_search1" value="Yes" checked>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="allow_search" id="allow_search2" value="No">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Should Search Engine Follow The Links On This Given Content?</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="follow_links" id="follow_links1" value="Yes" checked>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="follow_links" id="follow_links2" value="No">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">SOCIAL</button>
                                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">X APPEARANCE</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <div class="form-group">
                                                <label class="form-label"> Social Image</label>
                                                <input type="file" class="form-control mt-2" placeholder="Enter Image Name" name="social_image">
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="form-label">Social Title:</label>
                                                <input type="text" class="form-control" id="social_title" placeholder="Enter Social Title" name="social_title">
                                            </div>
                                            <div class="form-group">
                                                <label for="slug" class="form-label">Social Description:</label>
                                                <input type="text" class="form-control" id="social_description" placeholder="Enter Social Description" name="social_description">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            <div class="form-group">
                                                <label class="form-label"> X Apparance Image</label>
                                                <input type="file" class="form-control mt-2" placeholder="Enter Image Name" name="x_image">
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="form-label">X Title:</label>
                                                <input type="text" class="form-control" id="x_title" placeholder="Enter X Title" name="x_title">
                                            </div>
                                            <div class="form-group">
                                                <label for="slug" class="form-label">X Description:</label>
                                                <input type="text" class="form-control" id="x_description" placeholder="Enter X Description" name="x_description">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <div class="col-lg-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category" class="form-label">Parent Category:</label>
                                    <select class="form-select" id="category" name="category">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">@if ($category->parentcategory != '0')
                                                     -- 
                                                    @endif{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="new-tag" class="form-label">Add a Tag:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="new-tag" class="form-control" placeholder="Enter new tag" aria-label="New tag">
                                        <button type="button" class="btn btn-primary" id="add-tag-btn">Add</button>
                                    </div>
                                    
                                    <label for="tags" class="form-label">Tags :</label>
                                    <div class="tags-list">
                                        @foreach ($tags as $tag)
                                            <div class="">
                                                <label class="">
                                                    <input type="checkbox" class="" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}" data-service-name="{{ $tag->name }}">
                                                    {{ $tag->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('tags')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category" class="form-label">Status:</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="">Select Status</option>
                                        <option value="Published">Published</option>
                                        <option value="UnPublished">UnPublished</option>
                                        <option value="Draft">Draft</option>
                                    </select>
                                    @error('status')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label"> Featured Image</label>
                                    <input type="file" class="form-control mt-2" placeholder="Enter Image Name" name="blog_image">
                                    @error('blog_image')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>                         
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                            </div>
                        </div>
                    </div>                
                </div>
            </form>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#add-tag-btn').click(function() {
                        const newTag = $('#new-tag').val();
                        if (!newTag) {
                            alert('Please enter a tag');
                            return;
                        }

                        $.ajax({
                            url: "{{ route('store.tags') }}",  // Update with your actual route to store a tag
                            type: 'POST',
                            data: {
                                tag: newTag,
                                _token: '{{ csrf_token() }}' // Include CSRF token for security
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Create the new tag checkbox HTML
                                    const tagHtml = `
                                        <div class="">
                                            <label class="">
                                                <input type="checkbox" class="" name="tags[]" value="${response.tag.id}" id="tag-${response.tag.id}" checked>
                                                ${response.tag.name}
                                            </label>
                                        </div>
                                    `;
                                    $('#new-tag').val(''); // Clear the input field
                                    $('.tags-list').append(tagHtml); // Append the new tag to the tags list
                                } else {
                                    alert('Error adding tag');
                                }
                            },
                            error: function() {
                                alert('Error processing request');
                            }
                        });
                    });
                });
            </script>

        </div>
        
        <!-- main-panel ends -->
    </div>
    @endsection