<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title'=>'required|min:3|max:50',
            'description'=>'required|min:3|max:255',
            'raw_content'=>'required',
            'category_id'=>'required',
            'user_id'=>'required',
            'is_original'=>'required'
        ];
    }
}
