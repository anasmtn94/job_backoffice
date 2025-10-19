<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
             
        return [
            // مجموعة الشركة
            'company.name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies', 'name')->ignore($this->route('company')->id),
            ],
            'company.address'  => 'required|string|max:255',
            'company.industry' => 'required|string|max:255',
            'company.website'  => 'nullable|string|url|max:255',


            /**
             * | القاعدة       | التفسير                                          |
*| ------------- | ------------------------------------------------ |
*| **nullable**  | الحقل موجود، بس ممكن يكون فاضي                   |
*| **sometimes** | الحقل ممكن **ما يُرسل أساسًا**، ولو أُرسل بيتحقق |
            
*sometimes: "القواعد التالية تطبق فقط إذا الحقل أصلاً موجود بالـ request."

*/
            
            // مجموعة المالك (تكون اختيارية)
            'owner.name'                  => 'sometimes|required|string|max:255',
            'owner.email'                 => 'sometimes|required|email|unique:users,email',
            'owner.password'              => 'nullable|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            // رسائل الشركة
            'company.name.required' => 'Company name required!',
            'company.name.unique'   => 'Company name duplicated!',
            'company.industry.required' => 'Industry is required!',

            // رسائل المالك
            'owner.name.required'     => 'Owner name is required!',
            'owner.email.required'    => 'Owner email is required!',
            'owner.email.unique'      => 'This email already exists!',
            // 'owner.password.required' => 'Owner password is required!',
            'owner.password.confirmed'=> 'Passwords do not match!',
        ];
    }
}
