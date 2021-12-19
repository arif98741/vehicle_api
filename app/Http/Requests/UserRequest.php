<?php

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
        // dd($this->id);

        if ($this->_method == 'post') { //for store

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
        } else if ($this->_method == 'put') { //for update

            return
                [
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
    }
}
