<?php

define("MYSQLHOST","localhost");
define("MYSQLUSER","dniwe5927");
define("MYSQLPASS",'a19981970a5927');
define("MYSQLDB","trans");
define("NAMES", "utf8");

class db {
    public $connection = "";
    public $db = "";

    function __construct() {
        $this->connection = @mysqli_connect(MYSQLHOST, MYSQLUSER, MYSQLPASS) or die ("". mysqli_errno($this->connection) . ": " . mysqli_error($this->connection) . "\n");
        $this->db = @mysqli_select_db($this->connection,MYSQLDB) or die ("". mysqli_errno($this->connection) . ": " . mysqli_error($this->connection) . "\n");
        @mysqli_set_charset($this->connection, NAMES) or die ("". mysqli_errno($this->connection) . ": " . mysqli_error($this->connection) . "\n");
    }

    function __destruct() {
        @mysqli_close($this->connection);
    }

    public function get_address($ip){
        $street_id = $this->cell('id', 'Streets', "ip_addr='$ip' OR ip_addr2='$ip' OR ip_addr3='$ip'");
        return $street_id;
    }

    public function qry($query) {
        $result = @mysqli_query($this->connection, $query) or die($this->error($query));
        return $result;
    }

    public function cell($cell,$table,$param) {
        $query = "SELECT $cell FROM $table WHERE $param LIMIT 1";
        $result = $this->qry($query) or die($this->error($query));
        $result = mysqli_fetch_array($result);
        return $result[0];
    }

    public function cells($fields,$table,$param) {
        $query = "SELECT $fields FROM $table WHERE $param LIMIT 1";
        $result = $this->qry($query) or die($this->error($query));
        $result = mysqli_fetch_assoc($result);
        return $result;
    }


    public function srow($table,$param) {
        $query = "SELECT * FROM $table WHERE $param LIMIT 1";
        $result = $this->qry($query) or die($this->error($query));
        $result = mysqli_fetch_assoc($result);
        return $result;
    }

    public function mrow($query) {
        $result = $this->qry($query) or die($this->error($query));
        $result = $this->mysqli_fetch_rowsarr($result);
        return $result;
    }

    public function mysqli_fetch_rowsarr($result, $numass=MYSQLI_ASSOC) {
        $got=array();
        while ($row = mysqli_fetch_array($result, $numass)) { array_push($got, $row); }
        return $got;
    }


    public function checkexs($query) {
        $result = $this->qry($query) or die($this->error($query));
        $result = $this->mysqli_fetch_rowsarr($result);
        if (count($result)>0) { return true; } else { return false; }
    }

    public function count($table,$param) {
        $query = "SELECT count(*) FROM $table WHERE $param";
        $totalrec = $this->qry($query) or die($this->error($query));
        $totalrec = mysqli_fetch_array($totalrec);
        return $totalrec[0];
    }

    public function num_rows($table,$param) {
        $query = "SELECT count(*) FROM $table WHERE $param";
        $totalrec = $this->qry($query) or die($this->error($query));
        $totalrec = mysqli_num_rows($totalrec);
        return $totalrec;
    }

    public function last_id($table,$idfield='id') {
        $lid = $this->qry("SELECT $idfield FROM $table ORDER BY $idfield DESC LIMIT 1");
        $lid = mysqli_fetch_array($lid);
        return $lid[0];
    }

    public function sum($field,$table,$param) {
        $query = "SELECT SUM($field) FROM $table WHERE $param";
        $sum = $this->qry($query) or die($this->error($query));
        $sum = mysqli_fetch_array($sum);
        return $sum[0];
    }

    public function error($query) {
        $return = "Ошибка в запросе: ".$query;
        $return .= "". mysqli_errno($this->connection) . ": " . mysqli_error($this->connection);
        return $return;
    }


}