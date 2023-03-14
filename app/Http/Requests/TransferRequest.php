<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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
            'gt' => 'required|min:6',
            'bt' => 'required|min:6',
            'items' => 'required', 
            'user_id' => 'required',
            'supplier_id' => 'required',
            'branch_id' => 'required',
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'gt.required' => ' Gt is required!',
            'gt.min ' => ' Gt must be at least 6 number!',
            'bt.required' => ' Bt is required!',
            'bt.min ' => ' Bt must be at least 6 number!',
            'items.required' => 'Give at least 1 item!',
            'user_id.required' => 'Please specify the user!',
            'supplier_id.required' => 'Please specify the supplier!',
            'branch_id.required' => 'Please specify the branch!',
        ];
    }
}
