<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobCategoryRequest;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request){
        
        //Active
        $query = JobCategory::latest();

        //Archived
        if($request->hasAny('archived') && $request->input('archived')=="true"){
            $query->onlyTrashed();
        }

        $categories=$query->paginate(10)->onEachSide(1);
        return view("job-category.index",compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("job-category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobCategoryRequest $request)
    {
          
    $data = $request->all();
    JobCategory::create([
        'name'=>$data['name']
    ]);

    return redirect('/category')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobCategory $jobCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobCategory $category)
    {
   
        return view("job-category.update",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobCategoryRequest $request, JobCategory $category)
    {
        $category_record=JobCategory::findOrFail($category->id);
        $validated= $request->validated();
        $category->update($validated);
        return redirect('/category')->with('success', 'Category updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobCategory $category)
    {
        $category->delete();
        return redirect()->route("category.index",["archived"=>"true"])->with("success","Category archived successfully!");
    }


        public function restore(string $id)
    {
        $category=JobCategory::withTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route("category.index")->with("success","Category archived successfully!");
    }
}
