<?php

namespace App\Controllers;

use App\Models\GeneralModel;

class Home extends BaseController
{
    public function index($email): string
    {
        $model = new GeneralModel();
        $data['user'] = $model->getUserName($email);
        return view('home',$data);
    }
}
