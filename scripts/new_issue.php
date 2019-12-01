<?php

  session_start();

  if($_SESSION['loggedIn']){
    $dbname = 'BugMeDB';
    $host = 'localhost';
    $username = '';
    $password = '';

    if(isset($_POST['submit'])){
      $title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
      $desc = filter_var($_POST['desc'],FILTER_SANITIZE_STRING);
      $assigned = intval(filter_var($_POST['assigned_to'],FILTER_SANITIZE_STRING));
      $type = filter_var($_POST['type'],FILTER_SANITIZE_STRING);
      $priority = filter_var($_POST['priority'],FILTER_SANITIZE_STRING);
      $date = date('Y/m/d');
    }
    else{
      echo "error";
    }



    try{
      $conn = new PDO("mysql:host = $host; dbname = $dbname", $username, $password);

      $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected";
    }
    catch(PDOException $e){
      echo "Not Connected ".$e->getMessage();
    }

      $sql = "INSERT INTO BugMeDB.Issues(title,description,assigned_to,type,priority,created,updated,status) VALUES('$title','$desc','$assigned','$type','$priority','$date','$date','open')";

      try{
        $sth = $conn->query($sql);
        echo "Database updated!";
      }
      catch(PDOException $e){
        echo "Could not update database : " . $e;
      }

}
else {
  echo "Not logged in";
}
?>
