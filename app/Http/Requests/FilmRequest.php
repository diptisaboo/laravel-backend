<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FilmRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required',
            'description' => 'required',
            'realease_date' => 'required',
            'rating' => 'required',
            'ticket_price' => 'required',
            'country' => 'required',
            'genre' => 'required',
            'photo' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => trans('labels.filmnamerequired'),
            'description.required' => trans('labels.filmdescriptionrequired'),
            'realease_date.required' => trans('labels.filmrealeasedaterequired'),
            'rating.required' => trans('labels.filmratingrequired'),
            'ticket_price.required' => trans('labels.filmticketpricerequired'),
            'country.required' => trans('labels.filmcountryrequired'),
            'genre.required' => trans('labels.filmgenrerequired'),
            'photo.required' => trans('labels.filmphotorequired'),
        ];
    }

}
