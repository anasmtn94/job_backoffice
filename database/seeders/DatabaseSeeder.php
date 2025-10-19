<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobVacancy;
use App\Models\Resume;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'admin@a.com',
        ],            
            [
            'name' => 'admin',            
            'password'=>'123456789',
            'role'=>'admin',
            'email_verified_at'=>now(),
            'last_login_at'=>now()
        ]);

        User::firstOrCreate([
            'email' => 'company@a.com',
        ],            
            [
            'name' => 'company-owner',            
            'password'=>'123456789',
            'role'=>'company-owner',
            'email_verified_at'=>now(),
            'last_login_at'=>now()
        ]);
        //last true in the following line is to make the array associative (key=>value) array
        $jobData = json_decode(file_get_contents(database_path("data/job_data.json")),true);
        $jobApplication = json_decode(file_get_contents(database_path("data/job_applications.json")),true);

        foreach ($jobData['jobCategories'] as $cat) {
            JobCategory::createOrFirst([
                'name'=>$cat
            ]);
        }

        foreach ($jobData['companies'] as $company) {
            $ownerId=User::firstOrCreate([
            'email' =>fake()->email(),
        ],            
            [
            'name' => fake()->firstName(),            
            'password'=>'123456789',
            'role'=>'company-owner',
            'email_verified_at'=>now(),
            'last_login_at'=>now()
        ]);
            Company::createOrFirst([
                'name'=>$company['name']
            ],
        [

            'address'=>$company['address'],
            'industry'=>$company['industry'],
            'website'=>$company['website'],
            'ownerId'=>$ownerId->id
        ]
        );
        }




           foreach ($jobData['jobVacancies'] as $jobVac) {
            $company= Company::where('name',$jobVac['company'])->first();
            $category= JobCategory::where('name',$jobVac['category'])->first();

            JobVacancy::createOrFirst([
                'title'=>$jobVac['title']
            ],
        [
            
            'description'=>$jobVac['description'],
            'location'=>$jobVac['location'],
            'type'=>$jobVac['type'],
            'salary'=>$jobVac['salary'],
            'categoryId'=> $category->id,
            'companyId'=> $company->id,
        ]
        
        );
        }



        foreach ($jobApplication['jobApplications'] as $application) {
            
            $seeker=User::firstOrCreate([
            'email' =>fake()->email(),
        ],            
            [
            'name' => fake()->firstName(),            
            'password'=>'123456789',
            'role'=>'seeker',
            'email_verified_at'=>now(),
            'last_login_at'=>now()
        ]);

        $jobVacanc= JobVacancy::inRandomOrder()->first();

        $resume=Resume::create([
            
             'filename'=>$application['resume']['filename']
            ,'fileUri'=>$application['resume']['fileUri']
            ,'contactDetails'=>$application['resume']['contactDetails']
            ,'summary'=>$application['resume']['summary']
            ,'skills'=>$application['resume']['skills']
            ,'experience'=>$application['resume']['experience']
            ,'education'=>$application['resume']['education']
            ,'userId'=>$seeker->id
             
        ]);


        JobApplication::create([
            'status'=> $application['status']
            ,'aiGeneratedScore'=>$application['aiGeneratedScore']
            ,'aiGeneratedFeedback'=>$application['aiGeneratedFeedback']
            ,'jobVacancyId'=> $jobVacanc->id
            ,'resumeId'=> $resume->id
            ,'userId'=>$seeker->id
        ]);

        }

    }
}
