<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Add this line
use Illuminate\Support\Facades\Storage;


class FileUploadController extends Controller
{
    public function showUploadForm()
    {
        return view('upload-gp-files');
    }

    public function uploadGPFiles(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'macAddress' => 'required|string',
            'file' => 'required|file|mimes:jpg,png,pdf,docx', // Modify this based on your file requirements
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Store the file
        $path = $request->file('file')->store('uploadss');
        if (!Storage::exists($path)) {
            return response()->json(['error' => 'File upload failed.'], 500);
        }
        $url = Storage::url($path);
        return response()->json(['success' => 'File uploaded successfully!', 'path' => $path,'url'=>$url], 200);
    }
}
