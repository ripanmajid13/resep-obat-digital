<?php

namespace App\Http\Controllers;

use App\Models\Privileges\{Role, Permission};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function permission()
    {
        return Permission::where('name', request()->segment(1))->first();
    }

    public function link($name, array $params = null)
    {
        return $params ? route($this->permission()->name.'.'.$name, $params) : route($this->permission()->name.'.'.$name);
    }

    public function file($name)
    {
        return $this->permission()->navigation->folder.'.'.str_replace('-', '.', $this->permission()->name).'.'.$name;
    }

    public function can($data)
    {
        switch ($data) {
            case 'create':
                return $this->permission()->name.'-create';
                break;
            case 'edit':
                return $this->permission()->name.'-edit';
                break;
            case 'delete':
                return $this->permission()->name.'-delete';
                break;
            case 'roles':
                return $this->permission()->name.'-roles'; // only for guest
                break;

            default:
                return '';
                break;
        }
    }
}
