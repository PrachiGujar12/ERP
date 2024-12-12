@extends('layouts.dashboard')

@section('title', 'Folder - ' . $folder)
@section('meta_description', 'Files in folder: ' . $folder)

@section('content')
<div class="container-fluid">
    <!-- Header with Back and Folder Title -->
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header sticky-top"
        style="z-index: 100;">
        <a href="{{ url('media') }}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
        <div class="mb-2 mb-md-0">
            <h6 class="h2 mb-0 text-gray-800">{{ $folder }} Folder</h6>
        </div>
        <div></div>
    </div>

    <!-- Drag and Drop Section -->
    <div class="row">
        <div class="col-12 mt-4">
            <form action="{{ route('upload-files') }}" method="POST" enctype="multipart/form-data"
                class="d-flex flex-column align-items-center justify-content-center border border-dashed rounded py-5"
                id="file-upload-form">
                @csrf
                <i class="fas fa-cloud-upload-alt fa-5x text-muted"></i>
                <p class="mt-3 text-muted">Drop files and folders here</p>
                <p class="text-muted">Or use the upload button below</p>

                <input type="hidden" name="folder" value="{{ $folder }}">

                <input type="file" name="files[]" id="file-input" class="form-control mt-3" multiple>

                <button type="submit" class="btn btn-primary mt-3">Upload Files</button>
            </form>

        </div>
    </div>

    <!-- Folder Content Section -->
    <!-- Files and Directories Sections -->
    <div class="row mt-4">
        <!-- Files Section -->
        <div class="col-12">
            <h3><b>Files in {{ $folder }}</b></h3>
            <div class="row mt-2">
                @forelse ($allItems['files'] as $file)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/' . $folder . '/' . basename($file)) }}"
                                alt="{{ basename($file) }}" class="img-fluid mb-2"
                                style="max-height: 150px; object-fit: cover;">

                            <h5 class="card-title">{{ basename($file) }}</h5>
                        </div>
                    </div>

                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-muted">No files found in this folder.</div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Directories Section -->
        <div class="col-12 mt-4">
            <h3>Subdirectories in {{ $folder }}</h3>
            <div class="row">
                @forelse ($allItems['directories'] as $directory)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <!-- Folder Icon -->
                            <h5 class="card-title">{{ basename($directory) }}</h5>
                            <a href="{{ route('media-folder', ['folder' => basename($directory)]) }}"
                                class="btn btn-primary">Open Folder</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-muted">No subdirectories found in this folder.</div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection