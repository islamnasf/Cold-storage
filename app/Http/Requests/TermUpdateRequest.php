<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TermUpdateRequest extends FormRequest
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
    public function rules() : array
    {
        return [
                //'name'=>['required', Rule::unique('terms')->ignore($this->id),],    
                'name'=>['required'],                    
                'start'=>'required',
                'end'=>'required'

        ];
    }
    public function messages() : array
    {
        return [
                'name.required'=>'مطلوب اسم الفترة',
                // 'name.unique'=>' الاسم موجود مسبقا',
                'start.required'=>'مطلوب بداية الفترة',
                'end.required'=>'مطلوب نهاية الفترة',
        ];
    }
}

