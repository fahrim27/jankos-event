<?php

namespace App\Http\Controllers;

use App\Article;
use App\Business;
use App\Subscription;
use App\Job;
use App\JobApplicant;
use App\Slider;
use App\Sponsor;
use App\Video;
use App\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{   
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function home() {
        $sliders = Slider::all();
        $articles = Article::latest()->take(4)->get();
        $vacancy = Business::whereHas('jobs')->latest()->take(4)->get();
        $sponsors1 = Sponsor::where('status', 1)->where('category', 1)->get();
        $sponsors2 = Sponsor::where('status', 1)->where('category', 2)->get();
        $videos = Video::orderBy('id', 'ASC')->get();
        $video = Video::orderBy('created_at', 'DESC')->first();
        $guide = Guide::where('for', 'like', '%Jobseeker%')->first();
        // dd($vacancy);
        return view('home', compact('sliders', 'articles', 'vacancy', 'sponsors1', 'sponsors2', 'videos', 'video', 'guide'));
    }

    public function artikelIndex() {
        $data = Article::all();
        $guide = Guide::where('for', 'like', '%Jobseeker%')->first();
        // dd($data);

        return view('landing.articleindex', compact('data', 'guide'));
    }

    public function artikelShow(Article $article) {
        
        return view('landing.articleshow', compact('article'));
    }

    public function lowongan() {
        $guide = Guide::where('for', 'like', '%Jobseeker%')->first();
        $category = $this->request->category;
        if($this->request->has('bisnis')){
            $data = Job::where('due_at', '>=', date("Y-m-d"))->whereIn('business_id', $this->request->bisnis)->orderBy('created_at', 'DESC')->get();
        }
        elseif($this->request->has('category')){
            $data = Job::where('due_at', '>=', date("Y-m-d"))->whereHas('category', function($q) use($category) {
                $q->whereIn('category_id', $category);
            })->orderBy('created_at', 'DESC')->get();
        }
        elseif($this->request->has('bisnis') && $this->request->has('category')){
            $data = Job::where('due_at', '>=', date("Y-m-d"))->whereHas('category', function($q) use($category) {
                $q->whereIn('category_id', $category);
            })->whereIn('business_id', $this->request->bisnis)->orderBy('created_at', 'DESC')->get();
        }
        else{
            $data = Job::where('due_at', '>=', date("Y-m-d"))->orderBy('created_at', 'DESC')->paginate(10);
        }
        //return $data;
        return view('landing.lowongan', compact('data', 'guide'));
    }
    
    public function lowongan_by_kota($id)
    {   
        $guide = Guide::where('for', 'like', '%Jobseeker%')->first();
        $data = Job::whereHas('city', function($q) use($id) {
            $q->where('city_job.city_id', $id);
        })->orderBy('created_at', 'DESC')->paginate(10);
        
        return view('landing.lowongan', compact('data', 'guide'));
    }
    
    public function lowongan_by_category($id)
    {   
        $guide = Guide::where('for', 'like', '%Jobseeker%')->first();
        $data = Job::whereHas('category', function($q) use($id) {
            $q->where('category_id', $id);
        })->orderBy('created_at', 'DESC')->paginate(10);
        
        return view('landing.lowongan', compact('data', 'guide'));
    }

    public function showLowongan($id) {
        $guide = Guide::where('for', 'like', '%Jobseeker%')->first();
        $data = Job::find($id);
        
        if($data->due_at >= date("Y-m-d")) {
            return back();
        }
        
        if($data->business_id == 14)
        {
            return view('job.request.aia', compact('data'));
        }
        else{
            return view('job.show', compact('data', 'guide'));
        }
    }

    public function showBusiness($id) {
        $data = Business::find($id);

        return view('business.show', compact('data'));
    }

    public function showPengumuman() {
        $data = JobApplicant::where('status', 'approved')->latest()->get();
        $guide = Guide::where('for', 'like', '%Jobseeker%')->first();

        if(Auth::check()){
            $accepted = JobApplicant::where([
                                    ['user_id', '=', auth()->user()->id],
                                    ['status', '=', 'approved']
                                ])->latest()->get();
            $available = $accepted->count() > 0;
            
            return view('landing.pengumuman', compact('data', 'accepted', 'available', 'guide'));
        }

        return view('landing.pengumuman', compact('data', 'guide'));
    }
    
    public function download($file)
    {
        $url=public_path('/uploads/file/1606106212.pdf');

        return response()->download($url);
    }
    
    public function displayImage($filename)
    {
        $path = storage_public('images/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
