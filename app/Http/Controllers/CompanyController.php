<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request){
        
        //Active
        $query = Company::latest();

        //Archived
        if($request->hasAny('archived') && $request->input('archived')=="true"){
            $query->onlyTrashed();
        }

        $companies=$query->paginate(10)->onEachSide(1);
        return view("company.index",compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $industries = [
        'Technology','Finance','Healthcare','Education','Retail','Hospitality','Construction','Logistics'
    ]; // ثابتة يدويًا
    return view('company.create', compact('industries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        
          
    $dataValidated = $request->validated();

    $companyData = $dataValidated['company'];
    $ownerData   = $dataValidated['owner'] ?? null;
    $owner = User::create([
           'name'=>$ownerData['name'], 
           'email'=>$ownerData['email'],
           'password'=>$ownerData['password'],
           'role'=>'company-owner'

        ]);

        if(!$owner){
            return redirect('/company/create')->with('fail',"Company owner did not created!");
        }

    Company::create([
        'name'=>$companyData['name'],
        'address'=>$companyData['address'],
        'industry'=>$companyData['industry'],
        'website'=>$companyData['website'],
        'ownerId'=>$owner->id
    ]);
  
    return redirect('/company')->with('success', 'Company created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view("company.show",['company'=>$company ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {

               $industries = [
        'Technology','Finance','Healthcare','Education','Retail','Hospitality','Construction','Logistics'
    ]; // ثابتة يدويًا
    return view('company.edit', compact('industries','company'));
   
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {        
        $validated= $request->validated();
        $vlidatedCompany=$validated['company'];
        $vlidatedOwner=$validated['owner'];
        $owner=[];
        $company->update($vlidatedCompany);

        if($vlidatedOwner['password'] && $vlidatedOwner['password'] != null){
            $owner['password']=$vlidatedOwner['password'];
        }

        $owner['name']=$vlidatedOwner['name'];

        $company->owner->update($owner);

        
         if($request->query("redirectToList")=="true"){
            return redirect()->route('company.index')->with('success', 'Company updated successfully!');
         }else{
            return redirect()->route('company.show',$company->id)->with('success', 'Company updated successfully!');
         }
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route("company.index",["archived"=>"true"])->with("success","Company archived successfully!");
    }


        public function restore(string $id)
    {
        $company=Company::withTrashed()->findOrFail($id);
        $company->restore();
        return redirect()->route("company.index")->with("success","Company archived successfully!");
    }
}
