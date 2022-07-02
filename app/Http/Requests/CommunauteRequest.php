<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommunauteRequest extends FormRequest
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
            'name' => ['required','string','min:2'],
            'image' => ['required','image','mimes:jpg,png,jpeg,gif,svg','max:1024000'], // 1000 MO
            'description' => ['required','string','min:2'],
            'user_id' => ['exists:users,id'],
        ];
    }
}
