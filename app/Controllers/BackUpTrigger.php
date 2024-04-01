<?php

namespace App\Controllers;

use Config\Services;
use mysqli;
use Config\Database;

class BackUpTrigger extends BaseController
{
    public function index()
    {
        $backup_file = $this->createBackUp();
        echo "File saved: $backup_file <br>";
        echo $this->sendBackup($this->backUpDestination(), $backup_file);
    }

    public function createBackUp()
    {
        $db = new Database();
        $dbAccess = $db->default;
        $conn = new mysqli($dbAccess['hostname'], $dbAccess['username'], $dbAccess['password'], $dbAccess['database']);
        if ($conn->connect_error) {
            die("Verbindung fehlgeschlagen: " . $conn->connect_error);
        }
        $backup_directory = __DIR__ . "/BackUps/";
        if (!file_exists($backup_directory)) {
            mkdir($backup_directory, 0777, true);
        }
        $tables = array();
        $result = $conn->query("SHOW TABLES");
        while ($row = $result->fetch_row()) {
            $tables[] = $row[0];
        }
        $backup_file = $backup_directory . 'backup_PassSafePro_' . date("Y-m-d-H-i") . '.sql';

        $handle = fopen($backup_file, 'w');
        foreach ($tables as $table) {
            $result = $conn->query("SELECT * FROM $table");
            $num_fields = $result->field_count;
            $table_structure = $conn->query("SHOW CREATE TABLE $table");
            $table_structure_row = $table_structure->fetch_row();
            fwrite($handle, "\n\n" . $table_structure_row[1] . ";\n\n");
            for ($i = 0; $i < $num_fields; $i++) {
                while ($row = $result->fetch_row()) {
                    fwrite($handle, 'INSERT INTO ' . $table . ' VALUES(');
                    for ($j = 0; $j < $num_fields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n", "\\n", $row[$j]);
                        if (isset($row[$j])) {
                            fwrite($handle, '"' . $row[$j] . '"');
                        } else {
                            fwrite($handle, '""');
                        }
                        if ($j < ($num_fields - 1)) {
                            fwrite($handle, ',');
                        }
                    }
                    fwrite($handle, ");\n");
                }
            }
        }
        fclose($handle);
        $conn->close();
        return $backup_file;
    }

    public function sendBackup($to, $backup_file): string
    {
        $email = Services::email();
        $email->setFrom($this->emailServerAddress(), 'DayTrackMax official');
        $email->setTo($to);
        $email->setSubject("Monatliches DB-Backup 🖥️");
        $email->attach($backup_file);
        $email->send();
        return "Email sent to $to!";
    }
}