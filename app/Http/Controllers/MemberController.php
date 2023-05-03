<?php

namespace App\Http\Controllers;

use App\Team;
use App\Member;
use App\Package;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class MemberController extends Controller
{   
    public function __construct() {
        $this->middleware(function ($request, $next) {   
            if(auth()->user()->hasRole('Teacher') && auth()->user()->category_id != 3) {
                flash('Kategori Lomba Anda Tidak Dapat Mengisi Menu Member')->error();
                return redirect()->route('dashboard');
            }

            if(auth()->user()->hasRole('Teacher') && Document::where('team_id', auth()->user()->id)->count() <= 0) {
                flash('Harap isi Dokumen Tim Terlebih Dahulu')->error();
                return redirect()->route('documents.index');
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
        if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin')) {
            $data = Member::all();
        }
        else{
            $data = Member::where('team_id', auth()->user()->id)->get();
        }

        return view('member.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $input = $request->all();
        $input['team_id'] = auth()->id();
        $input['unique_id'] = $request->phone;

        Member::create($input);

        flash('Berhasil menambahkan Member')->success();

        return redirect()->route('members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Member::find($id);
        return view('member.edit', compact('data'));
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
        $input = $request->all();
        $input['unique_id'] = $request->phone;

        Member::find($id)->update($input);

        flash('Berhasil mengedit Member')->success();

        return redirect()->route('members.index');
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
            Member::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus member'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus member'
            ]);
        }
    }
}
