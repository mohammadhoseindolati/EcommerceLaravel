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
            "slug" => 'required|unique:categories,slug' ,
            "parent_id" => 'required' ,
            "attribute_ids" => 'required',
            "attribute_is_filter_ids" => 'required' ,
            "variation_id" => 'required' ,
        ];
    }
}
