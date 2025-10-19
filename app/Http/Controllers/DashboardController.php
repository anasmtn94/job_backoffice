<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use App\Models\User;
class DashboardController extends Controller
{
    public function index(){
        // {{ -- receiv active users for the last 30 days -- }}
        $activeUser = User::where('last_login_at', '>=', now()->subDays(30))->count();
        
        $activeJobPosting=JobVacancy::whereNull('deleted_at')->count();

        $totalApplication=JobApplication::whereNull("deleted_at")->count();

        $cards=[
            "activeUser"=> $activeUser,
            "activeJobPosting"=> $activeJobPosting,
            "totalApplication"=> $totalApplication,
        ];


        // {{ -- most applied jobs --}} 
        $mostAppliedJobs=JobVacancy::withCount("jobApplications as totalCount")
        ->whereHas('totalCount','>',0)
        ->whereNull("deleted_at")
        ->orderBy("totalCount","desc")
        ->limit(5)
        ->get();
        
        

        //Top Converting Job Posts
        $topConvertingJobs=JobVacancy::withCount("jobApplications as totalCount")
        ->whereHas('totalCount','>',0)
        ->whereNull("deleted_at")
        ->orderBy("totalCount","desc")
        ->limit(5)
        ->get()
        ->map(function($job){
            
            if($job->viewCount>0){
            $job->ConvertingRate = $job->totalCount/$job->viewCount*100;
            }else{
                $job->ConvertingRate=0;
            }
            return $job;
        });



        return view("dashboard.index",compact("cards","mostAppliedJobs","topConvertingJobs"));


    }
}
