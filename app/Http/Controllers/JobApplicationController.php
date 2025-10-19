<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationUpdateRequest;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        
        //Active
        $query = JobApplication::latest();

        //Archived
        if($request->hasAny('archived') && $request->input('archived')=="true"){
            $query->onlyTrashed();
        }

        $applications = $query->paginate(10)->onEachSide(1);
        return view("job-application.index",compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $application)
    {
        return view("job-application.show",['application'=>$application ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $application)
    {
        $statuses = ['pending','accepted','rejected'];
        return view('job-application.edit',compact('application','statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobApplicationUpdateRequest $request, JobApplication $application)
    {
        $validated=$request->validated();

        $application->update([
            
              "status" => $validated['status']
]);
         if($request->query("redirectToList")=="true"){
            return redirect('/application')->with('success', 'Job application created successfully!');
         }else{
            return redirect()->route('application.show',$application->id)->with('success', 'Job application updated successfully!');
         }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $application)
    {
        $application->delete();
        return redirect()->route("application.index",["archived"=>"true"])->with("success","Application archived successfully!");
    }


        public function restore(string $id)
    {
        $application=JobApplication::withTrashed()->findOrFail($id);
        $application->restore();
        return redirect()->route("application.index")->with("success","Application archived successfully!");
    }
}
