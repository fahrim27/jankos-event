<?php

namespace App\Http\Controllers;

use App\Business;
use App\Setting;
use App\Category;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class SettingController extends Controller
{
    public function index() {
        $user = auth()->user();
        $business = $user->business;
        $category = Category::all();
        $selectedcategory = Category::where('id', $user->category_id)->first();
        $setting = null;
        if($user->hasRole('Super Admin')) {
            $setting = Setting::first();
        }
        return view('setting.index', compact('user', 'business', 'setting', 'category', 'selectedcategory'));
    }

    public function updateUser(Request $request)
    {   
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');

        $rules = array(
            'image' => 'mimes:jpeg,png,jpg',
        );

        $messages = array(
                'image.mimes' => 'Maaf, ekstensi file tidak valid.',
            );

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails())
        {
            return redirect()->back()->with(['errors' => $error->errors()->all()]);
        }
        
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            $user->image = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->storeAs('public/uploads/', $user->image);
            //request()->image->move(public_path('uploads/images/'), $user->image);
        }

        $user->save();

        flash('Berhasil menyimpan pengaturan')->success();

        return redirect()->route('setting.index');
    }

    public function updateCategory(Request $request)
    {   
        if (auth()->user()->category_id != null) {
            $category = Category::where('id', auth()->user()->category_id)->first();
            if (Team::where('team_id', auth()->user()->id)->count() == $category->number_of_user) {
                flash('Team anda telah lengkap. Tidak diperbolehkan mengubah kategori')->warning();
                return redirect()->route('teams.index');
            }
        } 

        $rules = array(
            'category_id' => 'required',
        );

        $messages = array(
                'category_id.required' => 'Maaf, Kategori Tidak boleh dikosongi.',
            );

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails())
        {
            return redirect()->back()->with(['errors' => $error->errors()->all()]);
        }
        
        $user = auth()->user();
        $user->category_id = $request->category_id;

        $user->save();

        flash('Berhasil menyimpan kategori lomba')->success();

        return redirect()->route('setting.index');
    }

    public function updatePassword(Request $request)
    {
        if($request->password != $request->con_password) {
            flash('Konfirmasi password tidak sama')->error();
            return redirect()->route('setting.index');
        }

        $credentials = [
            'email' => auth()->user()->email,
            'password' => $request->old_password
        ];

        if(!\Auth::attempt($credentials)) {
            flash('Password lama anda salah')->error();
            return redirect()->route('setting.index');
        }

        $user = auth()->user();
        $user->password = \Hash::make($request->password);
        $user->save();
        
        flash('Berhasil merubah password')->success();
        return redirect()->route('setting.index');
    }

    public function updateBusiness(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'logo' => 'mimes:jpeg,png,jpg',
        ]);
        
        $data = $request->except('_token');
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['name'], '-');

        if ($request->hasFile('logo')) {
            $data['logo'] = time().'.'.request()->logo->getClientOriginalExtension();
           request()->logo->storeAs('public/uploads-1/uploads-2/uploads/profile/', $data['logo']);
            //request()->logo->move(public_path('uploads/images/'), $data['logo']);
        }

        $business = auth()->user()->business;

        if(!$business) {
            $business = Business::create($data);
        } else {
            $business->update($data);
        }
        
        flash('Berhasil merubah perusahaan')->success();
        return redirect()->route('setting.index');
    }

    public function updateMailer(Request $request) {
        $setting = Setting::first();
        $setting->update(['data' => $request->all()]);
        
        flash('Berhasil merubah pengaturan super admin')->success();
        return redirect()->route('setting.index');
    }
}
