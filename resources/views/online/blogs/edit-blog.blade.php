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
            <form class="forms-sample" method="post" action="{{route('update.blog')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">                
                    <div class="col-lg-9 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Blog: {{$blog->id}}</h4>
                                @csrf
                                <input type="hidden" name="id" value="{{$blog->id}}">
                                <div class="form-group">
                                    <label for="name" class="form-label">Title:</label>
                                    <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" value="{{$blog->title}}">
                                    @error('title')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="permalink" class="form-label">Permalink:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">{{ url('blog/' . strtolower(str_replace(' ', '-', $blog->category_name))) }}/</span>
                                        <input type="text" class="form-control" id="slug" placeholder="Enter Slug" name="slug" value="{{ $blog->slug }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="slug" class="form-label">Description:</label>
                                    <textarea id="my-editor" class="form-control" placeholder="Enter Description" name="description">{{$blog->description}}</textarea>
                                    @error('description')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name" class="form-label">SEO Title:</label>
                                    <input type="text" class="form-control" id="seotitle" placeholder="Enter SEO Title" name="seotitle" value="{{$blog->seotitle}}">
                                    @error('seotitle')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="form-label">SEO Description:</label>
                                    <input type="text" class="form-control" id="seodescription" placeholder="Enter Social Description" name="seodescription" value="{{$blog->seodescription}}">
                                    @error('seodescription')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Allow Search Engine To Show Content In Search Results?</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="allow_search" value="Yes" @if ($blog->allow_search == "Yes") checked @endif >
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="allow_search" value="No" @if ($blog->allow_search == "No") checked @endif >
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
                                                <input type="radio" class="form-check-input" name="follow_links" id="follow_links1" value="Yes" @if ($blog->follow_links == "Yes") checked @endif>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="follow_links" id="follow_links2" value="No" @if ($blog->follow_links == "No") checked @endif>
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
                                                @if(isset($blog))
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <img class="thumbnail" style="width: 300px"
                                                                src="{{asset($blog->social_image)}}">
                                                        </div>
                                                    </div>
                                                @endif

                                                <label class="form-label"> Social Image</label>
                                                <input type="file" class="form-control mt-2" placeholder="Enter Image Name" name="social_image" value="@if(!empty($blog)){{ $blog->social_image }} @endif">
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="form-label">Social Title:</label>
                                                <input type="text" class="form-control" id="social_title" placeholder="Enter Social Title" name="social_title" value="{{$blog->social_title}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="slug" class="form-label">Social Description:</label>
                                                <input type="text" class="form-control" id="social_description" placeholder="Enter Social Description" name="social_description" value="{{$blog->social_description}}">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            <div class="form-group">
                                                @if(isset($blog))
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <img class="thumbnail" style="width: 300px"
                                                                src="{{asset($blog->x_image)}}">
                                                        </div>
                                                    </div>
                                                @endif

                                                <label class="form-label"> X Apparance Image</label>
                                                <input type="file" class="form-control mt-2" placeholder="Enter Image Name" name="x_image" value="@if(!empty($blog)){{ $blog->x_image }} @endif">
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="form-label">X Title:</label>
                                                <input type="text" class="form-control" id="x_title" placeholder="Enter X Title" name="x_title" value="{{$blog->x_title}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="slug" class="form-label">X Description:</label>
                                                <input type="text" class="form-control" id="x_description" placeholder="Enter Social Description" name="x_description" value="{{$blog->x_description}}">
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
                                            <option value="{{$category->id}}" @if ($blog->category == $category->id) selected @endif>@if ($category->parentcategory != '0')
                                            -- @endif{{$category->name}}</option>
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
                                                    <input type="checkbox" class="" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}" data-service-name="{{ $tag->name }}"  @if(in_array($tag->id, json_decode($blog->tags))) checked @endif>
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
                                        <option value="Published" @if ($blog->status == "Published") selected @endif >Published</option>
                                        <option value="UnPublished" @if ($blog->status == "UnPublished") selected @endif >UnPublished</option>
                                        <option value="Draft" @if ($blog->status == "Draft") selected @endif >Draft</option>
                                    </select>
                                    @error('status')
                                     <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    @if(isset($blog))
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <img class="thumbnail" style="width: 250px"
                                                    src="{{asset($blog->blog_image)}}">
                                            </div>
                                        </div>
                                    @endif

                                    <label class="form-label"> Featured Image</label>
                                    <input type="file" class="form-control mt-2" placeholder="Enter Image Name" name="blog_image" value="@if(!empty($blog)){{ $blog->blog_image }} @endif">
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
        
        <!-- partial -->
        <!-- main-panel ends -->
    </div>
    @endsection