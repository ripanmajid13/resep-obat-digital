<?php

namespace App\Http\Requests\Privileges;

use App\Models\Privileges\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserListRequest extends FormRequest
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
        $roles = Role::get()->pluck('id');
        if (!auth()->user()->hasRole('Developer')) {
            $roles = $roles->whereNotIn('name', ['Developer']);
        }

        if ($this->method() == 'POST') {
            return [
                'name'      => ['required'],
                'username'  => ['nullable', 'string', 'unique:users,username'],
                'email'     => ['required', 'email:rfc,dns', 'unique:users,email'],
                'password'  => ['required', 'string', 'min:6'],
                'roles'     => ['required', 'array', Rule::in($roles)],
            ];
        } else {
            if ($this->get('password') == 'kosong') {
                return [
                    'name'      => ['required'],
                    'username'  => ['nullable', 'string', 'unique:users,username,'.$this->id],
                    'email'     => ['required', 'email:rfc,dns', 'unique:users,email,'.$this->id],
                    'password'  => ['nullable', 'string', 'min:6'],
                    'roles'     => ['required', 'array', Rule::in($roles)],
                ];
            } else {
                return [
                    'name'      => ['required'],
                    'username'  => ['nullable', 'string', 'unique:users,username,'.$this->id],
                    'email'     => ['required', 'email:rfc,dns', 'unique:users,email,'.$this->id],
                    'password'  => ['required', 'string', 'min:6'],
                    'roles'     => ['required', 'array', Rule::in($roles)],
                ];
            }
        }
    }
}
