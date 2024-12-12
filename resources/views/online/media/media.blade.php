@extends('layouts.dashboard')

@section('title', 'Media')
@section('meta_description', 'System user list.')
@section('content')

<style>
.card.active-card {
    border: 2px solid #007bff;
    /* Adjust the color and thickness as needed */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
</style>
<div class="media-container">
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header sticky-top"
        style="z-index: 100;">
        <a href="{{ route('online-dashboard') }}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back to Menu
        </a>
        <div class="mb-2 mb-md-0 p-0">
            <h6 class="h2 mb-0 text-gray-800">MEDIA</h6>
        </div>
        <div class="d-flex gap-2 justify-content-md-end p-0">
            <a class="JewelleryPrimaryButton" data-bs-toggle="modal" data-bs-target="#createFolderModal">Create
                Folder</a>
        </div>
    </div>

    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="mt-4">
            <!-- Display Folders -->
            <div class="row">
                @foreach ($directories as $directory)
                <div class="col-md-3 mb-3">
                    <div class="card" data-folder="{{ basename($directory) }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ basename($directory) }}</h5>
                            <a href="{{ route('media-folder', ['folder' => basename($directory)]) }}"
                                class="btn btn-primary">Open Folder</a>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Custom Context Menu -->
                <div id="contextMenu" class="dropdown-menu" style="display:none; position: absolute; z-index: 1000;">
                    <a class="dropdown-item" href="#" id="renameFolder">Rename</a>
                    <a class="dropdown-item" href="#" id="deleteFolder">Delete</a>
                </div>

            </div>
        </div>

    </div>

    <!-- Create Folder Modal -->
    <div class="modal fade" id="createFolderModal" tabindex="-1" aria-labelledby="createFolderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFolderModalLabel">Create Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to create folder -->
                    <form action="{{ route('media-create-folder') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="folderName" class="form-label">Folder name</label>
                            <input type="text" class="form-control" id="folderName" name="folder_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Rename Folder Modal -->
    <div class="modal fade" id="renameFolderModal" tabindex="-1" aria-labelledby="renameFolderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="renameFolderModalLabel">Rename Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="renameFolderForm" action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="newFolderName" class="form-label">New Folder Name</label>
                            <input type="text" class="form-control" id="newFolderName" name="new_folder_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Rename</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Delete Folder Modal -->
    <div class="modal fade" id="deleteFolderModal" tabindex="-1" aria-labelledby="deleteFolderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFolderModalLabel">Delete Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="deleteFolderMessage"></p>
                    <form id="deleteFolderForm" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete Folder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>


<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Handle context menu on right click
    $(document).on('contextmenu', '.card', function(e) {
        e.preventDefault();

        var folderName = $(this).data('folder');

        // Remove 'active-card' class from all cards
        $('.card').removeClass('active-card');

        // Add 'active-card' class to the right-clicked card
        $(this).addClass('active-card');

        // Position and show the context menu
        $('#contextMenu')
            .data('folder', folderName)
            .css({
                top: e.pageY + 'px',
                left: e.pageX + 'px'
            })
            .show();
    });

    // Hide the context menu and remove the active class when clicking elsewhere
    $(document).on('click', function() {
        $('#contextMenu').hide();
        $('.card').removeClass('active-card'); // Remove active class
    });

    // Handle clicking on Rename
    $(document).on('click', '#renameFolder', function() {
        var folderName = $('#contextMenu').data('folder');

        $('#renameFolderModal').modal('show');

        $('#newFolderName').val('');

        $('#renameFolderForm').attr('action', 'media/rename-folder/' + folderName);

        $('#contextMenu').hide();
    });

    // Handle clicking on Delete
    $(document).on('click', '#deleteFolder', function() {
        var folderName = $('#contextMenu').data('folder');

        $('#deleteFolderModal').modal('show');

        $('#deleteFolderMessage').text('Are you sure you want to delete the folder "' + folderName +
            '"?');

        $('#deleteFolderForm').attr('action', 'delete-folder/' + folderName);

        $('#contextMenu').hide();
    });
});
</script>
@endsection