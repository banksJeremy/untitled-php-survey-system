<?php
class NicerSQLite3 extends SQLite3 {
  function query($query) {
    // executes a query including additional arguments using a
    // prepared statement, if they are provided.
    $argc = func_num_args();
    
    if ($argc <= 1) {
      return super::query($query);
    } else {
      $statement = $this->prepare($query);
      
      for ($i = 1; $i < $argc; $i += 1) {
        $statement->bindValue($i, func_get_arg($i));
      }
      
      return $statement->execute();
    }
  }
}

$db = new NicerSQLite3("database.sqlite3");
