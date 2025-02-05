<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderReqeust extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:255',
            'invoice_id' => [
                'required',
                'string',
                Rule::unique('orders')->ignore($this->route('id')),
            ],

            'order_status' => 'nullable|in:new,process,shipped,delivered,cancel',
        ];
    }
}
