<?php

namespace App\Controllers;

use App\Models\GeneralModel;
use Config\Services;

class Home extends BaseController
{
    public function index(): string
    {
        $session = Services::session();

        $model = new GeneralModel();
        $data['user'] = $model->getUserName($session->get('email'));
        $data['passwords'] = $model->getPasswords($session->get('email'));
        return view('home', $data);
    }


    public function insertPassword()
    {
        $session = Services::session();

        $plattform = $this->request->getPost('plattform');
        $password = $this->request->getPost('password');
        $username = $this->request->getPost('username');
        $additional = $this->request->getPost('additional');
        $email = $session->get('email');

        $model = new GeneralModel();
        echo $model->insertPassword($plattform, $password, $username, $additional, $email);
        $this->index();
    }
}
