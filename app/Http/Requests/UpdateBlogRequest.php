<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:blogs,title,'.$this->blog->id,
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,Jpeg|max:2048',
            'author' => 'nullable|string|max:255',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,Jpeg|max:2048',
            'status' => 'required|boolean',
        ];
    }
}
