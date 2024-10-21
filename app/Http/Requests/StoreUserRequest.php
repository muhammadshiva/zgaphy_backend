<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:100|min:3',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required',
            'role' => 'required|in:admin,staff,customer',
            'is_member' => 'boolean',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }
    // $request->validate(
    //     [
    //         'name' => 'required|max:100|min:3',
    //         'email' => 'required|email|unique:users,email',
    //         'phone_number' => 'required|numeric',
    //         'role' => 'required|in:admin,staff,customer',
    //         'is_member' => 'boolean',
    //         'password' => 'required|min:8',
    //         'password_confirmation' => 'required|same:password',
    //     ]
    // );
}
