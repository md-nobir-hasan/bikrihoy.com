<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLandingPageSectionRequest extends FormRequest
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
    public function rules(): array
    {
        // dd($this->all());
        return [
            'id' => ['nullable', 'numeric', 'exists:landing_page_sections,id'],
            'sections' => ['nullable', 'array', 'min:1'],
            'sections.*.is_with_previous' => ['nullable', 'boolean'],
            'sections.*.image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp,svg', 'max:500'],
            'sections.*.video_link' => ['nullable', 'string'],
            'sections.*.title' => ['nullable', 'string'],
            'sections.*.sub_title' => ['nullable', 'string'],
            'sections.*.description' => ['nullable', 'string'],
            'sections.*.button' => ['nullable', 'string', 'max:50', 'max:255'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'sections.required' => 'At least one section is required.',
            'sections.*.image.image' => 'The file must be an image.',
            'sections.*.image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif,svg,webp.',
            'sections.*.image.max' => 'The image must not be greater than 500 KB.',
            'sections.*.video_link.required' => 'The video embed code is required.',
            'sections.*.title.required' => 'The title field is required.',
            'sections.*.title.max' => 'The title may not be greater than 255 characters.',
            'sections.*.sub_title.required' => 'The sub title field is required.',
            'sections.*.sub_title.max' => 'The sub title may not be greater than 255 characters.',
            'sections.*.description.required' => 'The description field is required.',
            'sections.*.button.required' => 'The button text field is required.',
            'sections.*.button.max' => 'The button text may not be greater than 50 characters.',
        ];
    }
}
