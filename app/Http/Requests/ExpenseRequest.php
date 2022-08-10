<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'name'=> "required|max:255",
            'amunt'=> "required",
            'entry_date' => 'required',
            'receipt' => 'file',
            'status' => "required|string|in:PENDING,APPROVE,DENIED'",
            'user_id'=> "required|exists:users,id",
        ];
    }
}
