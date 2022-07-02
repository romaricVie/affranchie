<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
             'title' => ['nullable ','string'],
             'lieu' => ['nullable ','string'],
             'date' => ['nullable ','date'],
             'image' => ['sometimes','image','mimes:jpg,png,jpeg,gif,svg,bmp','max:102400'], // 100 MO
             'video' => ['sometimes','mimes:mp4,ogx,oga,ogv,ogg,webm,avi,mpeg','max:3024000'], // 3.02 GO
             'user_id' => ['exists:users,id'],
        ];
    }
}
