<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
        // dd($this->all());
        return [
            'title' => 'required|string|max:255|unique:blogs,title',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp,Jpeg|max:2048',
            'author' => 'nullable|string|max:255',
            'author_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,Jpeg|max:2048',
            'status' => 'required|boolean',
        ];
    }
}
