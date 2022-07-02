<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationRequest extends FormRequest
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

            'message' => ['required','string','min:2'],
            'image' => ['sometimes','image','mimes:jpg,png,jpeg,gif,svg','max:102400'], // 100 MO
            'video' => ['sometimes','mimes:mp4,ogx,oga,ogv,ogg,webm','max:3024000'], // 3.2 Go
            'communaute_id' => ['exists:communautes,id'],
            'user_id' => ['exists:users,id'],

        ];
    }
}
