<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
    public function inserUser($name,$password,$verified,$email)
    {
        if($this->getUser($email,"") != 0)
            return "Email is already in use";

        $password = password_hash($password, PASSWORD_DEFAULT);
        $user = [
            'Name' => $name,
            'Password' => $password,
            'Verified' => $verified,
            'Email' => $email,
        ];

        $this->db->table('users')->insert($user);
        return "Inserted";
    }

    public function getUser($email,$password){
        $user = $this->db->table('users');
        $user->where('Email',$email);
        $user->select();
        $result = $user->get();
        $result = $result->getResultArray();
        if(sizeof($result) == 0)
            return 0;
        if (password_verify($password,$result[0]['Password']))
            return 1;
        return -1;
    }

    public function getUserName($email){
        $user = $this->db->table('users');
        $user->where('Email',$email);
        $user->select();
        $result = $user->get();
        $result = $result->getResultArray();
        return $result[0]['Name'];
    }

    private function debugger($array)
    {
        echo '<pre>';
        var_dump($array);
        echo '</pre>';
        die();
    }
}