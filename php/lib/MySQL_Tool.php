<?php

/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/11/2017
 * Time: 12:58 AM
 */

/**
 * Class MySQL_Tool
 *
 * This is used to build and maintain
 * a sql connection and different associated
 * functions
 */
class MySQL_Tool
{
    // -- Fields
    // ---------------------------------------------------
    /** @string */
    private $servername;
    /** @string */
    private $username;
    /** @string */
    private $password;
    /** @string */
    private $db;
    /** @mysqli */
    private $conn;

    // -- Methods
    // ---------------------------------------------------
    /**
     * MySQL_Tool constructor.
     */
    public function __construct()
    {
        require "lib-config.php";
        $this->servername = $global_servername;
        $this->username = $global_username;
        $this->password = $global_password;
        $this->db = $global_db;
        $this->setupConnection();
    }

    /**
     * Setup Connection to database
     */
    private function setupConnection(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);
        if($this->conn->connect_error){
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    /**
     * Execute an insert statement
     * @param $sql string
     */
    public function executeInsert($sql){
        try { // Execute insert
            mysqli_query($this->conn, $sql);
        } catch (Exception $err) {
            die("Insert Failed: ".$err->getMessage());
        }
    }

    /**
     * Execute select statement
     * @param $sql
     * @return bool|mysqli_result
     */
    public function executeSelect($sql){
        try { // Execute insert
            $result = mysqli_query($this->conn, $sql);
        } catch (Exception $err) {
            die("Insert Failed: ".$err->getMessage());
        }
        return $result;
    }

    /**
     * Execute Update statement
     * @param $sql string
     */
    public function executeUpdate($sql){
        try { // Execute insert
            mysqli_query($this->conn, $sql);
        } catch (Exception $err) {
            die("Update Failed: ".$err->getMessage());
        } // End SQL
    }

    /**
     * close mysql conn
     */
    public function closeConn(){
        $this->conn->close();
    }


}