<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class JobCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
public function rules(): array
{
    return [
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('job_categories', 'name')->ignore($this->category),
        ],

        //another way:  unique (category) is the parameter sent to the route , we get it  from php artisan route:list , it give us the id of the current post ,
        // 'name'=>'required|string|max:255|unique:job_categories,name'.$this->route("category"),
    ];
}

    public function messages(){
        return [
            'name.required'=>'Category name required!',
            'name.max'=>'Category name must less than 255 letter!',
            'name.unique'=>'Category name duplicated',
        ];
    }
}
