<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobVacancyCreateRequest extends FormRequest
{
   public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description'  => 'required|string',
            'location' => 'required|string|max:255',
            'type'  => 'required|string|max:255',
            'salary'  => 'required|string|max:255',
            'companyId'  => 'required|string|max:255',
            'categoryId'  => 'required|string|max:255',

        ];
    }

    public function messages(): array
    {
        return [
           
            'name.required' => 'Company name required!',
            'name.unique'   => 'Company name duplicated!',
            'industry.required' => 'Industry is required!',           
        ];
    }
}
