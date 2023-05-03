<?php

namespace App\Http\Controllers;

use App\Team;
use App\Package;
use App\Category;
use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class DocumentController extends Controller
{   
    public function __construct() {
        

        $this->middleware(function ($request, $next) {   
            if(auth()->user()->category_id == null) {
                flash('Harap isi data jenis perlombaan tim anda terlebih dahulu')->error();
                return redirect()->route('setting.index');
            }

            if (auth()->user()->category_id) {
                $category = Category::where('id', auth()->user()->category_id)->first();

                if (Team::where('team_id', auth()->id())->count() >= $category->number_of_user) {
                    flash('Harap lengkapi jumlah team anda terlebih dahulu')->error();
                    return redirect()->route('teams.index');
                } 
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Document::where('team_id', auth()->user()->id)->get();
        return view('document.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');
        
        $rules = array(
            'document' => 'mimes:jpeg,png,jpg,pptx,ppt,doc,docx,csv,xls,xlsx,pdf,3gp,mp4,mkv',
        );

        $messages = array(
                'image.mimes' => 'Maaf, ekstensi file tidak valid.',
            );

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails())
        {
            return redirect()->back()->with(['errors' => $error->errors()->all()]);
        }

        $input = $request->except('file');
        $input['team_id'] = auth()->id();
        $input['size'] = request()->file->getSize();

        $ekstension = request()->file->getClientOriginalExtension();
        $video = ["3gp", "mp4", "mkv"];

        if (in_array($ekstension, $video)) {
            $input["type"] = "Video";
        }
        else{
            $input["type"] = "Presentation Dokumen";
        }
        
        if ($request->hasFile('file')) {
            $input['document'] = auth()->id().'-'.sha1(time()).'.'.request()->file->getClientOriginalExtension();
            request()->file->storeAs('public/uploads/document/', $input['document']);
            //request()->image->move(public_path('uploads/images/'), $user->image);
        }

        Document::create($input);

        flash('Berhasil menambahkan dokumen')->success();

        return redirect()->route('documents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = Document::find($id);

            return view('document.show', compact('data'));

        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Document::find($id);
        return view('document.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');
        
        $rules = array(
            'document' => 'mimes:jpeg,png,jpg,pptx,ppt,doc,docx,csv,xls,xlsx,pdf,3gp,mp4,mkv',
        );

        $messages = array(
                'image.mimes' => 'Maaf, ekstensi file tidak valid.',
            );

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails())
        {
            return redirect()->back()->with(['errors' => $error->errors()->all()]);
        }

        $input = $request->except('file');
        
        if ($request->hasFile('file')) {
            $input['size'] = request()->file->getSize();

            $ekstension = request()->file->getClientOriginalExtension();
            $video = ["3gp", "mp4", "mkv"];

            if (in_array($ekstension, $video)) {
                $input["type"] = "Video";
            }
            else{
                $input["type"] = "Presentation Dokumen";
            }

            $input['document'] = auth()->id().'-'.sha1(time()).'.'.request()->file->getClientOriginalExtension();
            request()->file->storeAs('public/uploads/document/', $input['document']);
            //request()->image->move(public_path('uploads/images/'), $user->image);
        }

        Document::find($id)->update($input);

        flash('Berhasil mengedit Dokumen')->success();

        return redirect()->route('documents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Document::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus Dokumen'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus Dokumen'
            ]);
        }
    }
}
