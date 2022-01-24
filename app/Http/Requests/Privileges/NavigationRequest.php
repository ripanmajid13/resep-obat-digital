<?php

namespace App\Http\Requests\Privileges;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class NavigationRequest extends FormRequest
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
        if (Request::input('id') == 'form-act-p') {
            return [
                'name'      => ['required'],
                'position'  => ['required', 'numeric'],
                'icon'      => ['required'],
                'is_link'   => ['required'],
                'folder'    => ['required'],
            ];
        } elseif (Request::input('id') == 'form-act-c1') {
            return [
                'parent'    => ['required'],
                'name'      => ['required'],
                'is_link'   => ['required'],
                'position'  => ['required', 'numeric'],
                'folder'    => ['required'],
            ];
        } else {
            return [
                'parent'    => ['required'],
                'child'     => ['required'],
                'name'      => ['required'],
                'position'  => ['required', 'numeric'],
                'folder'    => ['required'],
            ];
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'child.required'     => 'Required.',
            'name.required'     => 'Required.',
            'position.required' => 'Required.',
            'parent.required'   => 'Required.',
            'icon.required'     => 'Required.',
            'is_link.required'  => 'Required.',
            'folder.required'   => 'Required.',

            'position.numeric'  => 'Number.',
        ];
    }
}
