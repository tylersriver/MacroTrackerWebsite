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
     * MySQLi bound query function
     *
     * @param $sql string
     * @param $params array
     * @return bool | mysqli_result
     */
    public function query($sql, $params = array())
    {
        $sql = trim($sql); // Trim extra whitespace
        $params = (array)$params;
        $result = false;

        // Initiate statement
        $stmt = $this->conn->prepare($sql);
        if(!$stmt) {
            return $result;
        }
        
        // Build types array
        $types = buildTypeStringFromArray($params);

        // Bind params
        if (!empty($params)) {
            $binds = array($types);
            $binds = array_merge($binds, $params);
            $binds = makeValuesReferenced($binds);
            call_user_func_array(array($stmt, 'bind_param'), $binds);
        }

        // Execute SQL
        if($stmt->execute()) {
            if($stmt->affected_rows >= 0 ) {
                $result = true;
            } else {
                $result = $stmt->get_result();
            }
        }

        return $result;
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

        $result = $this->query($sqlSelect);
        $macro = $result->fetch_row();
        $dailyMacro = $macro[0];

        $macro_result = mysqli_fetch_row($this->query($sqlSelectSum));
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
        $macro_result = $this->query($sqlSelectSum);
        $row = $macro_result->fetch_row();
        return (int) $row[0];
    }
}
