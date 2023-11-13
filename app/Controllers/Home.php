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

        $data['plattform'] = "TestPlat";
        $data['password'] = "TestP";
        $data['username'] = "user12";
        $data['additional'] = "otherStuff";

        return view('home', $data);
    }


    public function insertPassword()
    {
        $session = Services::session();

        $plattform = $this->request->getPost('plattform');
        $password = $this->request->getPost('passwortVerschlusselt');
        $username = $this->request->getPost('username');
        $additional = $this->request->getPost('additional');
        $email = $session->get('email');

        $model = new GeneralModel();
        echo $model->insertPassword($plattform, $password, $username, $additional, $email);
        return $this->index();
    }

    public function deletePassword()
    {
        $session = Services::session();

        $passwordID = $this->request->getPost('passwordID');
        $email = $session->get('email');

        $model = new GeneralModel();
        echo $model->deletePassword($passwordID, $email);
        return $this->index();
    }
}
