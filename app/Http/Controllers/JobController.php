<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobApplicant;
use App\Subscription;
use App\Setting;
use Illuminate\Support\Str;
use Validator;

use App\Mail\ApplicantMail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {   
            if(auth()->user()->hasRole('HRD') && !auth()->user()->business) {
                flash('Harap isi data perusahaan di pengaturan terlebih dahulu')->error();
                return redirect()->route('dashboard');
            }
    
            if(auth()->user()->hasRole('Jobseeker') && !auth()->user()->profile) {
                flash('Harap isi data CV di pengaturan terlebih dahulu')->error();
                return redirect()->route('dashboard');
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
        if(auth()->user()->hasRole('HRD')) {
            $data = Job::where('business_id', auth()->user()->business->id)->get();
        } elseif(auth()->user()->hasRole('Jobseeker')) {
            $data = Job::where('due_at', '>=', date("Y-m-d"))->get();
        }
        else{
            $data = Job::all();
        }
        return view('job.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //return $request->all();
        if($request->has('business_id'))
        {
            $input = $request->all();
        }
        else{
            $input = $request->all();
            $input['business_id'] = auth()->user()->business->id;
        }
        $input['slug'] = Str::slug($request->title);
        
        $jobs = Job::create($input);
        $jobs->category()->sync($request->category);
        $jobs->city()->sync($request->city);
        
        flash('Berhasil menambahkan lowongan')->success();

        return redirect()->route('jobs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Job::find($id);
        
        if($data->business_id == 14)
        {
            return view('job.request.aia', compact('data'));
        }
        else{
            return view('job.show', compact('data'));
        }
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show2($slug)
    {
        $data = Job::where('slug', $slug)->first();

        return view('job.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Job::find($id);
        return view('job.edit', compact('data'));
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
        if($request->has('business_id'))
        {
            $input = $request->all();
        }
        else{
            $input = $request->all();
            $input['business_id'] = auth()->user()->business->id;   
        }
        $input['slug'] = Str::slug($request->title);
        
        $jobs = Job::find($id);
        $jobs->update($input);
        $jobs->category()->sync($request->category);
        $jobs->city()->sync($request->city);
        
        flash('Berhasil mengedit lowongan')->success();

        return redirect()->route('jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(JobApplicant::where('job_id', $id)->count() < 1) {
            $job = Job::find($id);
            $job->category()->detach();
            $job->city()->detach();
            
            $job->delete();
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus lowongan'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus lowongan'
            ]);
        }
    }
    
    public function getApply($id)
    {
        $data = Job::find($id);
        return view('job.apply', compact('data'));
    }
    
    public function apply($id, Request $request)
    {   
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');
        
        $rules = array(
            'lampiran' => 'mimes:jpeg,png,pdf,jpg',
        );

        $messages = array(
                'lampiran.mimes' => 'Maaf,ekstensi file tidak valid.',
            );

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails())
        {
            return redirect()->back()->with(['errors' => $error->errors()->all()]);
        }
        
        $input = request()->all();

        $job = Job::find($id);

        if(auth()->user()->hasRole('HRD') && ($job->business_id == auth()->user()->business->id)) {
            flash('Tidak dapat melamar di lowongan perusahaan anda sendiri')->error();
            return redirect()->route('jobs.index');
        }

        if(date('Y-m-d') > date('Y-m-d', strtotime($job->due_at))) {
            flash('Mohon maaf, Lowongan sudah ditutup')->error();
            return redirect()->route('jobs.index');
        }

        $isApplied = JobApplicant::where([
                                    'job_id' => $job->id,
                                    'user_id' => auth()->user()->id
                                ])->where(function($q) {
                                    $q->where('status', 'waiting')
                                        ->orWhere('status', 'approved');
                                })->first();

        if($isApplied) {
            if($isApplied->status == 'approved') {
                flash('Anda sudah di approve oleh pihak perusahaan. Harap cek email anda untuk tindak lanjut')->success();
            } else {
                flash('Anda sudah melamar di pekerjaan ini, harap tunggu konfirmasi dari perusahaan di email anda')->error();
            }
            return redirect()->route('jobs.index');
        }

        $input['business_id'] = $job->business_id;
        $input['job_id'] = $job->id;
        $input['user_id'] = auth()->user()->id;
        
        if ($request->hasFile('lampiran')) {
            $input['lampiran'] = Str::slug(auth()->user()->name). '_lampiran_' . sha1(time()) . '.' . request()->lampiran->getClientOriginalExtension();
            
            request()->lampiran->storeAs('public/uploads-1/uploads-2/uploads/lampiran/', $input['lampiran']);
            
        }
        
        $apply = JobApplicant::create($input);

        $setting = Setting::first();

        $data = (object)[
            'to' => $apply->business->email,
            'title' => 'Lamaran - ' . $apply->job->title,
            'note' => $apply->note,
            'from' => $setting->data['mail_from_address']
        ];

        Mail::send([], [], function($message) use ($data) {
            $message->from($data->from);
            $message->to($data->to);
            $message->subject($data->title);
            $message->setBody($data->note, 'text/html');
        });

        flash('Berhasil melamar pekerjaan')->success();

        return redirect()->route('jobs.index');
    }

    public function getApproval($id, $approval) {
        $data = JobApplicant::find($id);
        return view('job.approval', compact('data', 'approval'));
    }

    public function action($id, Request $request)
    {
        try {
            $job = JobApplicant::find($id);
            $job->update(['status' => $request->status]);

            $setting = Setting::first();

            $data = (object)[
                'to' => $job->user->email,
                'title' => $request->title,
                'note' => $request->note,
                'from' => $setting->data['mail_from_address']
            ];

            Mail::send([], [], function($message) use ($data) {
                $message->from($data->from);
                $message->to($data->to);
                $message->subject($data->title);
                $message->setBody($data->note, 'text/html');
            });

            flash('Berhasil '.$request->status.' lamaran')->success();
            return redirect()->route('applicants.index');
        } catch(\Exception $e) {
            flash('Berhasil '.$request->status.' lamaran')->success();
            return redirect()->route('applicants.index');
        }
    }
}
