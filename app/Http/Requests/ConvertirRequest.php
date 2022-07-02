<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvertirRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
                'pays' => ['required','string'],
                'ville' => ['required','string'],
                'habitation' => ['required','string'],
                'phone' => ['required', 'string', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'motivation' => ['required','string'],
                'image' => ['required','image','mimes:jpg,png,jpeg,gif,svg','max:10240'], // 10MO 
                'user_id' => ['exists:users,id'],
        ];
    }
}
