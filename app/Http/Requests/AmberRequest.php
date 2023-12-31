<?php

namespace App\Http\Requests;

use App\Models\Fridge;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AmberRequest extends FormRequest
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
                       

            'name'=>'required'
        ];
    }
    public function messages() : array
    {
        return [
                'name.required'=>'مطلوب اسم العنبر',
                //'name.unique'=>' الاسم موجود مسبقا',
        ];
    }
}
