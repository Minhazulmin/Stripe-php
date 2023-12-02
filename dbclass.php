<?php
/*
Author:Minhazul Min
Website: https://minhazulmin.github.io/
 */

// Start Database Class
$db_host  = 'localhost';
$db_name  = 'stripe';
$username = 'root';
$password = '';

$con = mysqli_connect( "$db_host", "$username", "$password" );
mysqli_select_db( $con, "$db_name" ) or die( "cannot select DB" );

class DB {

// Connect to server and select databse.

    private $dbh;
    private $error;
    private $stmt;

    public function query( $query ) {
        $this->stmt = $this->dbh->prepare( $query );
    }

    public function bind( $param, $value, $type = null ) {
        if ( is_null( $type ) ) {
            switch ( true ) {
            case is_int( $value );
                $type = PDO::PARAM_INT;
                break;
            case is_bool( $value );
                $type = PDO::PARAM_BOOL;
                break;
            case is_null( $value );
                $type = PDO::PARAM_NULL;
                break;
            default;
                $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue( $param, $value, $type );
    }

    public function execute( $array = null ) {
        return $this->stmt->execute( $array );
    }

    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }

    public function rowCount() {
        return $this->stmt->rowCount();
    }

    public function result( $array = null ) {
        $this->execute( $array );
        return $this->stmt->fetch();
    }

    public function resultSet( $array = null ) {
        $this->execute( $array );
        return $this->stmt->fetchAll( PDO::FETCH_ASSOC );
    }

    public function close() {
        return $this->dbh = null;
    }
}

?>