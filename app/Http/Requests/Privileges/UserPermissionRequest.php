<?php

namespace App\Http\Requests\Privileges;

use App\Models\Privileges\{Navigation, User};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPermissionRequest extends FormRequest
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
        $users = User::whereNotIn('name', ['developer'])->orderBy('name', 'asc')->get()->pluck('id');
        $navigations = Navigation::with(['parent' => function($query) {
                                $query->orderBy('name', 'asc');
                        }])->whereNotNull('url')->orderByRaw('ISNULL(parent_id), name ASC')->get()->pluck('id');
        return [
            'user'          => ['required', Rule::in($users)],
            'navigations'   => ['nullable', 'array', Rule::in($navigations)],
        ];
    }
}
