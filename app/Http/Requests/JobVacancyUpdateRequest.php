<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobVacancyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
           
            'title.required' => 'Company name required!',
            'title.unique'   => 'Company name duplicated!',
            'salary.required' => 'Salary is required!',           
        ];
    }
}
