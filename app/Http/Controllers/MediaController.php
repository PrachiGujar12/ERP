<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function showMedia()
    {
        // Get all directories under the 'public/media' directory
        $directories = File::directories(public_path('assets'));
        // dd($directories);

        // Pass the directories to the view
        return view('online.media.media', compact('directories'));
    }

    public function showFolder($folder)
    {
        // Build the full path for the folder
        $folderPath = public_path('assets/' . $folder); // Assuming the folder is inside the 'media' folder
    
        // Check if the folder exists
        if (File::exists($folderPath) && File::isDirectory($folderPath)) {
    
            // Get all files inside the folder
            $files = File::allFiles($folderPath);

            // Get all subdirectories inside the folder
            $directories = File::directories($folderPath);
    
            // Combine files and directories into one array
            $allItems = [
                'files' => $files,
                'directories' => $directories
            ];
    
            // Pass the files and directories to the view
            return view('online.media.folder', compact('allItems', 'folder'));
        } else {
            // Return an error if the folder does not exist
            return redirect('/media')->with('error', 'Folder not found.');
        }
    }

    public function uploadFiles(Request $request)
    {
        // Validate the request
        $request->validate([
            'files.*' => 'required|file',
            'folder' => 'required|string',
        ]);
    
        // Get the folder from the request
        $folder = $request->input('folder');
    
        // Check if the folder exists; create it if it doesn't
        $destinationPath = public_path('assets/' . $folder);
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
    
        // Move each uploaded file to the destination folder
        foreach ($request->file('files') as $file) {
            $file->move($destinationPath, $file->getClientOriginalName());
        }
    
        return redirect()->back()->with('message', 'Files uploaded successfully!');
    }

    public function createFolder(Request $request)
    {
        // Validate the folder name
        $request->validate([
            'folder_name' => 'required|string|max:255',
        ]);

        // Define the path where folders will be created
        $basePath = public_path('assets'); // This is the 'public/assets' directory

        // Create the full path for the new folder
        $newFolderPath = $basePath . '/' . $request->input('folder_name');
        // dd($newFolderPath);
        // Check if the folder already exists
        if (File::exists($newFolderPath)) {
            return redirect()->back()->with('error', 'Folder already exists!');
        }

        // Try to create the folder
        try {
            File::makeDirectory($newFolderPath, 0777, true);
            return redirect()->back()->with('success', 'Folder created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create folder: ' . $e->getMessage());
        }
    }

    //Rename Folder
    public function renameFolder($folderName, Request $request)
    {
        $request->validate([
            'new_folder_name' => 'required|string|max:255',
        ]);
    
        $oldFolderPath = public_path('assets/' . $folderName);
        $newFolderPath = public_path('assets/' . $request->new_folder_name);
    
        if (File::exists($oldFolderPath) && !File::exists($newFolderPath)) {
            File::move($oldFolderPath, $newFolderPath);
            return redirect('/media')->with('success', 'Folder renamed successfully!');
        }
    
        return redirect('/media')->with('error', 'Rename failed! Folder may already exist or doesn’t exist.');
    }
    
  
      // Delete a folder
      public function deleteFolder($folderName)
      {
          $folderPath = public_path('assets/' . $folderName);
  
          // Check if the folder exists
          if (File::exists($folderPath)) {
              File::deleteDirectory($folderPath);
              return redirect('/media')->with('success', 'Folder deleted successfully!');
          }
  
          return redirect('/media')->with('error', 'Folder does not exist.');
      }
  
    
    
    

}