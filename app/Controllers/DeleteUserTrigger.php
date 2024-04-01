<?php

namespace App\Controllers;
class DeleteUserTrigger extends BaseController
{
    public function index(): string
    {
        $users = $this->model->getUserAuto();
        $c = 0;
        foreach ($users as $user) {
            if ($user['Verified'] != 1){
                $this->model->deleteUserAuto($user['Email']);
                $c++;
            }
        }
        return $c." users deleted";
    }
}