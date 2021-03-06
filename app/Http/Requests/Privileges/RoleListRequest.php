<?php

namespace App\Http\Requests\Privileges;

use Illuminate\Foundation\Http\FormRequest;

class RoleListRequest extends FormRequest
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
        if ($this->method() == 'POST') {
            return [
                'name' => ['required', 'string', 'unique:roles,name'],
            ];
        } else {
            return [
                'name' => ['required', 'string', 'unique:roles,name,'.$this->id],
            ];
        }
    }
}
