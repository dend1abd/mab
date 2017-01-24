<?php
//File written by Ryan Campbell
//June 2005 - Particletree

//Class to handle database operations
class clsDataAccess {

  //class variables defined in constructor
  var $host;
  var $user;
  var $password;
  var $databaseName;
  
  //constructor - needed for connection string
  function clsDataAccess($hostName, $userName, $passwordName, $databaseName){
    $this->host = $hostName;
    $this->user = $userName;
    $this->password = $passwordName;
    $this->database = $databaseName;
  }

  //loop through paired arrays buildng an sql INSERT statement
  function sqlInsert($dataNames, $dataValues, $tableName){
	  $sqlNames = "INSERT INTO " . $tableName . "(";
	  for($x = 0; $x < count($dataNames); $x++) {
		  if($x != (count($dataNames) - 1)) {
			  $sqlNames = $sqlNames . $dataNames[$x] . ", ";
			  $sqlValues = $sqlValues . "'" . $dataValues[$x] . "', ";
		  }
		  else {
			  $sqlNames = $sqlNames . $dataNames[$x] . ") VALUES(";
			  $sqlValues = $sqlValues . "'" . $dataValues[$x] . "')";
		  }
	  }
	  echo $sqlNames . $sqlValues;
	  $this->ExecuteNonQuery($sqlNames . $sqlValues);
  }

  //loop through paired arrays buildng an sql UPDATE statement
  function sqlUpdate($dataNames, $dataValues, $tableName, $condition){
	  $sql = "UPDATE " . $tableName . " SET ";
	  for($x = 0; $x < count($dataNames); $x++) {
		  if($x != (count($dataNames) - 1)) {
			  $sql = $sql . $dataNames[$x] . "= '" . $dataValues[$x] . "', ";
		  }
		  else {
			  $sql = $sql . $dataNames[$x] . "= '" . $dataValues[$x] . "' ";
		  }
	  }
	  $sql = $sql . $condition;
	  echo $sql;
    $this->ExecuteNonQuery($sql);
  }

  //execute a query
  function ExecuteNonQuery($sql){
	  $conn = mysql_connect($this->host, $this->user, $this->password);
    mysql_select_db ($this->database);
	  $rs = mysql_query($sql,$conn);
	  
	  if (!$rs) {
        if ('DEBUGGING_MODE') {
            // Stuff to output while debugging, add the query to the error message - it can be very useful.
            die("There was a database error!<br>".mysql_error()."<br><br>The query was: ".HtmlEntities($sql));
        } else {
            // For production servers, it's better to not show the error message at all.
            $message = "There was a database error!\n".mysql_error()."\n\nThe query was: ".$sql;
            mail("webmaster@example.com","Database error",$message);
            die("Sorry, but there was a database error. Please try again later.");
        }
    }
	
    settype($rs, "null");	
	  mysql_close($conn);
  }
  
  //execute a query and return a recordset
  function ExecuteReader($query){
    $conn = mysql_connect($this->host, $this->user, $this->password);
    mysql_select_db ($this->database);
	  $rs = mysql_query($query,$conn);
	  
	   if (!$rs) {
        if ('DEBUGGING_MODE') {
            // Stuff to output while debugging, add the query to the error message - it can be very useful.
            die('There was a database error!<br'.mysql_error().'<br><br>The query was: '.HtmlEntities($sql));
        } else {
            // For production servers, it's better to not show the error message at all.
            $message = "There was a database error!\n".mysql_error()."\n\nThe query was: ".$sql;
            mail("webmaster@example.com","Database error",$message);
            die("Sorry, but there was a database error. Please try again later.");
        }
    }
	
	
    mysql_close($conn);
    return $rs;
  } 
  
     

}
?>