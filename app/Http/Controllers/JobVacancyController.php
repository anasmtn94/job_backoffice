<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobVacancyCreateRequest;
use App\Http\Requests\JobVacancyUpdateRequest;
use App\Models\Company;
use App\Models\JobCategory;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        
        //Active
        $query = JobVacancy::latest();

        //Archived
        if($request->hasAny('archived') && $request->input('archived')=="true"){
            $query->onlyTrashed();
        }

        $job_vacancies=$query->paginate(10)->onEachSide(1);
        return view("job-vacancy.index",compact('job_vacancies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $companies=Company::all();
    $categories=JobCategory::all();
    return view('job-vacancy.create', compact('companies','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobVacancyCreateRequest $request)
    {
        
          
     $dataValidated = $request->validated();

     JobVacancy::create($dataValidated);
     return redirect('/job-vacancy')->with('success', 'Job Vacancy created successfully!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(JobVacancy $job_vacancy)
    {
        return view("job-vacancy.show",['job_vacancy'=>$job_vacancy ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobVacancy $job_vacancy)
    {

              $companies=Company::all();
    $categories=JobCategory::all();
    return view('job-vacancy.edit', compact('job_vacancy','companies','categories'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobVacancyUpdateRequest $request, JobVacancy $job_vacancy)
    {        
       
     $dataValidated = $request->validated();

     $job_vacancy->update($dataValidated);
     
        
         if($request->query("redirectToList")=="true"){
            return redirect('/job-vacancy')->with('success', 'Job Vacancy created successfully!');
         }else{
            return redirect()->route('job-vacancy.show',$job_vacancy->id)->with('success', 'Job Vacancy updated successfully!');
         }
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobVacancy $job_vacancy)
    {
        $job_vacancy->delete();
        return redirect()->route("job-vacancy.index",["archived"=>"true"])->with("success","JobVacancy archived successfully!");
    }


        public function restore(string $id)
    {
        $job_vacancy=JobVacancy::withTrashed()->findOrFail($id);
        $job_vacancy->restore();
        return redirect()->route("job-vacancy.index")->with("success","JobVacancy archived successfully!");
    }
}
