<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriereRequest extends FormRequest
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
                'phone' => ['required', 'string', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'subject' => ['required','string','min:2'],
                'image' => ['sometimes','image','mimes:jpg,png,jpeg,gif,svg','max:102400'], // 100MO
                'user_id' => ['exists:users,id'],
        ];
    }
}
