<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Business;
use Auth;
use DB;


class CompanyController extends Controller
{   
    public function __construct(User $users)
    {
        $this->user = $users;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = DB::table('users')
                ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                ->where(['role_id' => 3, 'status' => NULL])
                ->orderBy('users.created_at', 'desc')
                ->get();
        //return $data;
        return view('company.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Business::where('id', $id)->first();

        return view('company.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $user->status = 1;
        $user->email_verified_at = date("Y-m-d h:i:s");

        $user->save();

        flash('Berhasil Melakukan Validasi Untuk permintaan, '.$user->name.'.')->success();

        return redirect()->route('access-request.index');
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
        $data = Business::find($id);

        $data->status = $request->status;

        $user->save();

        flash('Berhasil Mnegedit status permintaan, '.$data->name.'.')->success();

        return redirect()->route('access-request.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Business::whereId($id)->first()->jobs->count() < 1)
        {
            Business::find($id)->delete();
                
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus permintaan'
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus permintaan'
            ]);
        }
            
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail_perusahaan()
    {   
        $data = Business::orderBy('name', 'ASC')->get();
        //return $data;
        return view('company.detail', compact('data'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_status($id)
    {
        $data = Business::find($id);
        return view('business.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_status(Request $request, $id)
    {
        $input = $request->except('_token');
        
        $data = Business::findOrFail($id);
        $data->update($input);
        
        if($request->status == 1)
        {
            User::where('id', $data->user_id)->update(["status" => 1, "email_verified_at" => date('Y-m-d h:i:s')]);   
        }
        else{
            User::where('id', $data->user_id)->update(["status" => 0, "email_verified_at" => NULL]);
        }

        flash('Berhasil mengupdate status permintaan')->success();

        return redirect()->back();
    }
}
