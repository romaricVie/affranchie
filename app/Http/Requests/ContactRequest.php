<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
           'name' => ['required','string'],
           'firstname' =>['required','string'],
           'email' => ['required', 'string', 'email','max:255'],
           'phone' => ['required', 'string', 'max:50'],
           'objet' => ['required','string','min:2'],
           'message' => ['required','string','min:5'],
           'image' => ['sometimes','image','mimes:jpg,png,jpeg,gif,svg','max:10240'],
        ];
    }
}
