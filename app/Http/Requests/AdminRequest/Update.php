<?php

namespace App\Http\Requests\AdminRequest;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nidn' => 'required|numeric|max_digits:12',
            'name' => 'required|max:255',
            'username' => 'required|min:3|unique:users,username,' . $this->route('admin'),
            'email' => 'required|email|unique:users,email,' . $this->route('admin'),
            'password' => 'nullable|min:8',
            'password_confirmation' => 'same:password',
            'avatar' => 'nullable|max:2048|mimes:jpg,jpeg,png,gif',
        ];
    }
}
