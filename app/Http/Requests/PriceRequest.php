<?php

namespace App\Http\Requests;

use App\Models\PriceList;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PriceRequest extends FormRequest
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
    public function rules() 

    {
        $userId=Auth::user()->id;
        return [
            //'vegetable_name'=>'required',
                'vegetable_name' => [
                    'required',
                    Rule::unique('price_lists')->where(function ($query) use ($userId) {
                        return $query->where('user_id', $userId);
                    }),
                ],
                'ton'=>'required',
                'small_shakara'=>'required',
                'big_shakara'=>'required',                
        ];
    }
    public function messages() 
    {
        return [
                'vegetable_name.required'=>'مطلوب اسم الثلاجة',
                'vegetable_name.unique'=>'الاسم موجود مسبقا',
                'ton.required'=>'مطلوب سعر لهذه الشكارة ',
                'small_shakara.required'=>'مطلوب سعر لهذه الشكارة ',
                'big_shakara.required'=>'مطلوب سعر لهذه الشكارة '
        ];
    }
}
