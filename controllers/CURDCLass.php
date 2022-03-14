<?php
require 'DB.php';
require 'CURDinterface.php';


class CRUD implements CRUDInterface
{
    private $conn;
    function __construct()
    {
        $conn = new DB();
        $this->conn = $conn->getConn();
    }
    function selectAll($tabel): PDOStatement
    {
        try {
            return $this->conn->prepare("SELECT * 
        FROM " . $tabel . " ");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    function selectOne($tabel, $conArr, $columns): PDOStatement
    {
        try {
            $where = '';
            foreach ($conArr as $key => $value) {
                $where .= ' ' . $key . '=' . $value . ' ';
            }
            return $this->conn->prepare("SELECT " . $columns . " 
                        FROM " . $tabel . " WHERE " . $where . "");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    function update($query): PDOStatement
    {
        try {

            return $this->conn->prepare($query);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    function delete($query): PDOStatement
    {
        try {

            return $this->conn->prepare($query);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    function insert($query): PDOStatement
    {
        try {

            return $this->conn->prepare($query);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}