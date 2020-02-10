<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class addUpdateUsersRequest extends FormRequest
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
        $user = $this->route('user');
//        dd($user);

        return [
            "first_name" => 'required|string',
            "last_name" => 'required|string',
            "email" => ['required', Rule::unique('users')->ignore($user->id)],
            "image" => 'image|mimes:jpg,png,jpeg,gif',
            "permissions" => 'array|required|min:1'
        ];
    }
}
