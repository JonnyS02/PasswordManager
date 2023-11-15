<?php

namespace App\Controllers;

use App\Models\GeneralModel;
use Config\Services;

class Home extends BaseController
{
    public function index($plattform ="",$username ="",$additional="",$plattform_error="")
    {
        $session = Services::session();

        if( $this->session->get('logged')) {

            $model = new GeneralModel();
            $data['user'] = ($model->getUser($session->get('email')))[0]['Name'];
            $data['passwords'] = $model->getPasswords($session->get('email'));

            $data['plattform'] = $plattform;
            $data['error']['plattform'] = $plattform_error;
            $data['username'] = $username;
            $data['additional'] = $additional;

            return view('home', $data);
        }else
            return redirect()->to('login');
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
        if(!$model->insertPassword($plattform, $password, $username, $additional, $email)){
            return $this->index($plattform,$username,$additional,"Password for plattform already inserted.");
        }
        return $this->index();
    }

    public function deletePassword()
    {
        $session = Services::session();

        $passwordID = $_GET['ID'];
        $email = $session->get('email');

        $model = new GeneralModel();
        $model->deletePassword($passwordID, $email);
        return $this->index();
    }

    public function deleteUser(): \CodeIgniter\HTTP\RedirectResponse
    {
        $session = Services::session();
        $email = $session->get('email');
        $model = new GeneralModel();
        $model->deleteUser($email);
        return redirect()->to('login');
    }

}
