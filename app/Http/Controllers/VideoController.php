<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function index()
    {
        $data = Video::all();

        return view('video.index', compact('data'));
    }

    public function create()
    {
        return view('video.create');
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');

        if ($request->hasFile('video')) {
            $input['video'] = time() . '.' . request()->video->getClientOriginalExtension();

            request()->video->storeAs('public/uploads', $input['video']);
        }

        Video::create($input);

        flash('Berhasil menambah Video')->success();
        return redirect()->route('video.index');
    }

    public function destroy($id)
    {
        try {
            $video = Video::find($id);
            $file = $video->file;
            // dd($slider);
            File::delete('uploads/video/'.$file);

            $video->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus video'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus video'
            ]);
        }
    }
}
