<?php
require_once "./conf.php";

class DB
{
    // DB接続情報
    private $_host;
    private $_dbname;
    private $_user;
    private $_pass;

    // DB接続用オブジェクト
    private $_DBObj;

    function __construct()
    {
        $conf = new Conf();
        $this->_host = $conf->getHostName();
        $this->_dbname = $conf->getDBName();
        $this->_user = $conf->getDBUser();
        $this->_pass = $conf->getDBPass();

        // DB接続
        $this->_DBObj = new mysqli($this->_host, $this->_user, $this->_pass, $this->_dbname);
        if ($this->_DBObj->connect_error) {
            error_log("Connect failed:" . $this->_DBObj->connect_error, 0);
            exit();
        }
        $this->_DBObj->set_charset("utf8");
    }

    function __destruct()
    {
        $this->_DBObj->close();
    }

    private function validationToPrepare($sql){
        $stmt = $this->_DBObj->prepare($sql);
        if (!$stmt) {
            error_log("Invalid SQL statement:" . $sql, 0);
            return false;
        }

        return $stmt;
    }

    /*
     * SELECT
     * @param String $sql
     * @param boolean $prepared
     * @param String $types
     * @param String $params
     * @return mysqli_stmt::get_result
     */
    public function select($sql = "", $prepare = false, $types = "", $params = "")
    {
        $stmt = $this->validationToPrepare($sql);

        if($prepare){
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            error_log("SQL execution error:" . $sql, 0);
            return false;
        }

        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    /*
     * INSERT,UPDATE,DELETE
     * @param String $sql
     * @param boolean $prepared
     * @param String $types
     * @param String $params
     * @return mysqli_stmt::affected_rows
     */
    public function other($sql = "", $prepare = false, $types = "", $params = ""){
        $stmt = $this->validationToPrepare($sql);

        if($prepare){
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            error_log("SQL execution error:" . $sql, 0);
            return false;
        }

        $result = $stmt->affected_rows;
        $stmt->close();

        return $result;
    }
}