<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaseViewComposer
{


    public function compose(View $view)
    {
        $data = $view->getData();

        $data['base_isAdmin'] = false;
        if (Auth::check()) {
            if (Auth::user()->is_admin) {
                $data['base_isAdmin'] = true;
            }
        }

        $data['base_isEmployee'] = false;
        if (Auth::check()) {
            if (Auth::user()->is_employee) {
                $data['base_isEmployee'] = true;
            }
        }

        $data['base_isUser'] = false;
        if (Auth::check()) {
            if (Auth::user()->is_user) {
                $data['base_isUser'] = true;
            }
        }

        $view->with($data);
    }
}
