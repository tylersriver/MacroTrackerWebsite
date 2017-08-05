<?php

/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/11/2017
 * Time: 12:58 AM
 *
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
     * Build and setup connection
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
    private function setupConnection()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);
        if($this->conn->connect_error){
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    /**
     * Execute an insert statement
     * @param $sql string
     */
    public function executeInsert($sql, $params)
    {
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
    public function executeSelect($sql)
    {
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
    public function executeUpdate($sql)
    {
        try { // Execute insert
            mysqli_query($this->conn, $sql);
        } catch (Exception $err) {
            die("Update Failed: ".$err->getMessage());
        } // End SQL
    }

    /**
     * MySQLi bound query function
     *
     * @param $sql string
     * @param $params array
     * @return mysqli_result
     */
    public function query($sql, $params)
    {
        // Initiate statement
        $stmt = $conn->prepare($sql);
        
        // Bind Params
        foreach($params as $p){
            $stmt->bind_param($p);
        }

        try { // Execute SQL
            $stmt->execute();
        } catch (Exception $err) {
            die("Query Failed: ".$err->getMessage());
        } // End SQL

        // Get Results
        $stmt->bind_result($result);
        $stmt->fetch();

        if (empty($result)) {
            return false;
        } else {
            $this->setPass(true);
            return $result;
        }

    }

    /**
     * close mysql conn
     */
    public function closeConn()
    {
        $this->conn->close();
    }

    // Remaining Check Functions
    // ---------------------------------------------------

    /**
     * Get remaining protein balance for
     * the day
     * @param $macro string
     * @return int
     */
    public function getRemainingMacro($macro)
    {
        $sqlSelect = "SELECT ".$macro." FROM dailyMacros";
        $sqlSelectSum = "SELECT SUM(m.".$macro.") FROM mealEntries m WHERE DATE(entryTime) = DATE(NOW())";

        $result = $this->executeSelect($sqlSelect);
        $macro = $result->fetch_row();
        $dailyMacro = $macro[0];

        $macro_result = mysqli_fetch_row($this->executeSelect($sqlSelectSum));
        $macro_day_sum = $macro_result[0];

        return $dailyMacro - $macro_day_sum;
    }

    /**
     * Get the sum of macro nutrient
     * @param $macro string
     * @return int
     */
    public function dailySum($macro)
    {
        $sqlSelectSum = "SELECT SUM(m.".$macro.") FROM mealEntries m WHERE DATE(entryTime) = DATE(NOW())";
        $macro_result = $this->executeSelect($sqlSelectSum);
        $row = $macro_result->fetch_row();
        return (int) $row[0];
    }
}
