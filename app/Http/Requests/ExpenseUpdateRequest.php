<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseUpdateRequest extends FormRequest
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
                'amount'=>'required',
                'description'=>'required',
        ];
    }
    public function messages() : array
    {
        return [
                'amount.required'=>'يجب كتابة المبلغ',
                'description.required'=>'مطلوب تفاصيل المبلغ',

        ];
    }
}
