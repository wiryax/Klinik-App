<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Language extends BaseController
{
    public function index($lang = '')
    {
        if (session()->get('lang')) {
            session()->remove('lang');
        }
        if ($lang) {
            session()->set('lang', $lang);
        }
        $this->request->setLocale($lang);
        return redirect()->back();
    }
}
