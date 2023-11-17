<?php

namespace App\Controllers;

use App\Models\GeneralModel;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class Home extends BaseController
{
    public function index($plattform ="",$username ="",$additional="",$plattform_error="",$notDeleted = "",$password_account="")
    {

        if( $this->session->get('logged')) {

            $data['user'] = ($this->model->getUser($this->session->get('email')))[0]['Name'];
            $data['passwords'] = $this->model->getPasswords($this->session->get('email'));
            $data['plattform'] = $plattform;
            $data['error']['plattform'] = $plattform_error;
            $data['username'] = $username;
            $data['additional'] = $additional;
            if($notDeleted != "") {
                $data['notDeleted'] = $notDeleted;
                $data['password_account'] = $password_account;
            }
            return view('home', $data);
        }else
            return redirect()->to('login');
    }


    public function insertPassword()
    {
        $plattform = $this->request->getPost('plattform');
        $password = $this->request->getPost('passwortVerschlusselt');
        $username = $this->request->getPost('username');
        $additional = $this->request->getPost('additional');
        $email = $this->session->get('email');

        if(!$this->model->insertPassword($plattform, $password, $username, $additional, $email)){
            return $this->index($plattform,$username,$additional,"Password for plattform already inserted.");
        }
        return redirect()->to('home');
    }

    public function deletePassword()
    {
        $passwordID = $_GET['ID'];
        $email = $this->session->get('email');

        $this->model->deletePassword($passwordID, $email);
        return redirect()->to('home');
    }

    public function deleteUser()
    {
        $password_account = $this->request->getPost('password_account');
        $email = $this->session->get('email');
        $deleted = $this->model->deleteUser($email,$password_account);
        if($deleted) {
            return redirect()->to('login');
        }else{
            if($password_account =="")
                return $this->index("", "", "", "", "The password field is required.", $password_account);
            $attempts = $this->model->setAttempts($email, true);
            if ($attempts <= 0)
                $notDeleted = "You've reached the maximum of attempts.";
            else
                $notDeleted = "Wrong password, ".$attempts." attempts left.";
            return $this->index("", "", "", "", $notDeleted, $password_account);
        }
    }

}
