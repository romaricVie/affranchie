<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonRequest extends FormRequest
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
                'email' => ['required', 'string', 'email', 'max:255'],
                'phone' => ['required', 'string', 'max:50'],
                'nom_produit' => ['required','string','min:2'],
                'description' => ['required','string','min:2'],
                'type' => ['required','string','min:2'],
                'etat_don' => ['sometimes','required','string','min:2'],
                'point_relais' => ['required','string','min:5'],
                'status' => ['string'],
                'images' => ['required','image','mimes:jpg,png,jpeg,gif,svg','max:1024000'],
        ];
    }
}
