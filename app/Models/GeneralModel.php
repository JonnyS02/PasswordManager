<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
    public function insertUser($name, $password, $verified, $email, $attempts): string
    {
        if (sizeof($this->getUser($email)) != 0)
            return false;

        $password = password_hash($password, PASSWORD_DEFAULT);
        $user = [
            'Name' => $name,
            'Password' => $password,
            'Verified' => $verified,
            'Email' => $email,
            'Attempts' => $attempts,
        ];

        $this->db->table('users')->insert($user);
        return true;
    }

    function getUser($email): array
    {
        $user = $this->db->table('users');
        $user->where('Email', $email);
        $user->select();
        $result = $user->get();
        return $result->getResultArray();
    }

    public function checkPassword($email, $password): int
    {
        $result = $this->getUser($email);

        if (sizeof($result) == 0)
            return 0;
        if ($result[0]['Attempts'] <= 0)
            return -1;
        if (password_verify($password, $result[0]['Password']))
            return 1;
        return -1;
    }

    public function setAttempts($email, $decrease)
    {
        $attempts = $this->getUser($email)[0]['Attempts'];
        if ($attempts <= 0)
            return 0;
        if ($decrease)
            $attempts = $attempts - 1;
        else
            $attempts = 3;

        $change = $this->db->table('users');
        $change->set('Attempts', $attempts);
        $change->where('Email', $email);
        $change->update();
        return $attempts;
    }

    public function getPasswords($email, $id = ""): array
    {
        $passwords = $this->db->table('passwords');
        $passwords->where('Email', $email);
        if ($id != "")
            $passwords->where('ID', $id);
        $passwords->select();
        $result = $passwords->get();
        return $result->getResultArray();
    }

    public function insertPassword($plattform, $password, $username, $additional, $email): bool
    {
        if ($this->getPlattform($plattform, $email)) {
            $password = [
                'Plattform' => $plattform,
                'Password' => $password,
                'Username' => $username,
                'Additional' => $additional,
                'Email' => $email,
            ];
            $this->db->table('passwords')->insert($password);
            return true;
        }
        return false;
    }

    public function updatePassword($plattform, $password, $username, $additional, $email, $id)
    {

        $passwordEntry = $this->db->table('passwords');
        if ($plattform != "") {
            $passwordEntry->set('Plattform', $plattform);
            $this->submitUpdate($passwordEntry, $email, $id);
        }
        /*  if ($password != "") {
              $passwordEntry->set('Password', $password);
              $this->submitUpdate($passwordEntry,$email,$id);
          }*/
        $passwordEntry->set('Username', $username);
        $this->submitUpdate($passwordEntry, $email, $id);

        $passwordEntry->set('Additional', $additional);
        $this->submitUpdate($passwordEntry, $email, $id);
    }

    public function submitUpdate($database, $email, $id)
    {
        $database->where('Email', $email);
        $database->where('ID', $id);
        $database->update();
    }


    public function deletePassword($passwordID, $email)
    {
        $passwords = $this->db->table('passwords');
        $passwords->where('ID', $passwordID);
        $passwords->where('Email', $email);
        $passwords->delete();
    }

    public function getPlattform($plattform, $email): bool
    {
        $passwords = $this->db->table('passwords');
        $passwords->where('Plattform', $plattform);
        $passwords->where('Email', $email);
        $passwords->select();
        $result = $passwords->get();
        $result = $result->getResultArray();
        return sizeof($result) == 0;
    }

    public function deleteUser($email, $password)
    {
        if ($this->checkPassword($email, $password) == -1)
            return false;

        $passwords = $this->db->table('passwords');
        $passwords->where('Email', $email);
        $passwords->delete();

        $user = $this->db->table('users');
        $user->where('Email', $email);
        $user->delete();

        return true;
    }

    public function insertChangesProfile($name, $email, $oldEmail, $password = "")
    {
        $oldUser = $this->getUser($oldEmail);
        if ($oldUser[0]['Name'] == $name && $oldUser[0]['Email'] == $email && (password_verify($password, $oldUser[0]['Password']) || $password == ""))
            return false;

        if ($password == "") {
            $updated_user = [
                'Name' => $name,
                'Email' => $email,
            ];
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $updated_user = [
                'Name' => $name,
                'Password' => $password,
                'Email' => $email,
            ];
        }

        $change = $this->db->table('users');
        $change->where('Email', $oldEmail);
        $change->update($updated_user);

        if ($oldEmail != $email) {
            $change_email = $this->db->table('passwords');
            $change_email->set('Email', $email);
            $change_email->where('Email', $oldEmail);
            $change_email->update();
        }
        return true;
    }
}