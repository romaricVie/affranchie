<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepondreRequest extends FormRequest
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
            //commentaire_id
            'reply' => ['required','string','min:2'],
             'commentaire_id' => ['exists:commentaires,id'],
            'user_id' => ['exists:users,id'],
        ];
    }
}
