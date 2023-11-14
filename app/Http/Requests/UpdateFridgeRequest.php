<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule ;

class UpdateFridgeRequest extends FormRequest
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
                'name'=>['required', Rule::unique('fridges')->ignore($this->id),],            
          //      'size'=>'required'
        ];
    }
    public function messages() : array
    {
        return [
                'name.required'=>'مطلوب اسم الثلاجة',
                'name.unique'=>' الاسم موجود مسبقا',
               // 'size.required'=>'مطلوب حجم الثلاجة'
        ];
    }
}
