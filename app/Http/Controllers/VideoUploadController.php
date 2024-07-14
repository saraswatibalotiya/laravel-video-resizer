<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;

class VideoUploadController extends Controller
{
    public function showForm()
    {
        return view('upload');
    }

    public function uploadVideo(Request $request)
    {
        // Validate the uploaded video and the video name
        $request->validate([
            'videoName' => 'required|string|max:255',
            'video' => 'required|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-matroska|max:100000', // Limit file size to 100MB
        ]);

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $videoName = Str::slug($request->input('videoName'), '_');
            $extension = $file->getClientOriginalExtension();
            $filename = "{$videoName}.{$extension}";
            $filePath = public_path('uploads/' . $filename);

            // Move the uploaded file to the public/uploads directory
            $file->move(public_path('uploads'), $filename);

            // Initialize FFMpeg
            $ffmpeg = FFMpeg::create([
                'ffmpeg.binaries'  => env('FFMPEG_BINARIES', '/usr/bin/ffmpeg'),
                'ffprobe.binaries' => env('FFPROBE_BINARIES', '/usr/bin/ffprobe'),
                'timeout'          => 3600,
                'ffmpeg.threads'   => 12,
            ]);

            // Resolutions array
            $resolutions = [
                'low' => [426, 240],
                'mid' => [640, 360],
                'high' => [1280, 720],
            ];

            $savedFiles = [];

            // Convert video to different resolutions
            foreach ($resolutions as $key => $resolution) {
                $resPath = public_path("uploads/{$videoName}_{$key}.{$extension}");
                $video = $ffmpeg->open($filePath);
                $video->filters()->resize(new \FFMpeg\Coordinate\Dimension($resolution[0], $resolution[1]))->synchronize();
                $video->save(new X264('aac'), $resPath);

                $savedFiles[$key] = "uploads/{$videoName}_{$key}.{$extension}";
            }

            return view('video', [
                'file' => "uploads/{$filename}",
                'savedFiles' => $savedFiles
            ]);
        }

        return back()->withErrors(['video' => 'No file selected!']);
    }

    public function serveVideo($resolution, $filename)
    {
        $path = public_path("uploads/{$resolution}_{$filename}");

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
