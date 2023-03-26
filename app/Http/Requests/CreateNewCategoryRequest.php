<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => 'required',
            "slug" => 'required',
            "attribute_ids" => array:3 [▶],
            "attribute_is_filter_ids" => array:2 [▶] ,
            "variation_id" => "1" ,
            "icon" => null ,
            "description" => null ,
        ];
    }
}
