<?php
/*
 * Copyright (c) 2021.
 * This file is originally created and maintained by Ariful Islam.
 * You are not allowed to modify any parts of this code or copy or even redistribute
 * full or small portion to anywhere. If you have any question
 * fee free to ask me at arif98741@gmail.com.
 * Ariful Islam
 * Software Engineer
 * https://github.com/arif98741
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

        if ($this->_method == 'put') { //for update

            return [
                'first_name' => 'required',
                'last_name' => 'sometimes',
                'email' => 'required|email|unique:users,email,' . $this->id,
                'phone' => 'required|unique:users,phone,' . $this->id,
                'role_id' => 'required',
                'documents_verified' => 'required',
                'otp_verified' => 'required',
                'status' => 'required',

            ];
        }

        return [
            'first_name' => 'required',
            'last_name' => 'sometimes',
            'email' => 'email|required|unique:users',
            'phone' => 'unique:users|min:6|max:15',
            'role_id' => 'required',
            'documents_verified' => 'required',
            'otp_verified' => 'required',
            'status' => 'required',

        ];

    }
}
