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

// Includes
include_once ("lib-utils.php");

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
    public function executeInsert($sql)
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
     * @return bool | mysqli_result
     */
    public function query($sql, $params)
    {
        // Initiate statement
        $stmt = $this->conn->prepare($sql);
        
        // Bind Params
        $types = "";
        foreach($params as $p){
            $types .= "s";
        }
        $bindsArray = array_merge(array($types), $params);
        call_user_func_array(array($stmt, 'bind_param'), makeValuesReferenced($bindsArray));

        try { // Execute SQL
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        } catch (Exception $err) {
            die("Query Failed: ".$err->getMessage());
        } // End SQL

        // Get Results
        while ($temp = $result->fetch_assoc()){
            $returnArray[] = $temp;
        }

        // Return results
        if (empty($returnArray)) {
            return false;
        } else {
            return $returnArray;
        }

    }

    /**
     * close mysql conn
     */
    public function close()
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
