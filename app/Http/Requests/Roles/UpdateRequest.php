<?php

namespace App\Http\Requests\Roles;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('role_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required',Rule::unique('roles','name')->ignore($this->role)],
            'permissions.*' => 'integer',
            'permissions' => 'required|array',
            'status' => 'required|in:1,0',
        ];
    }
}
