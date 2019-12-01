<?php

  session_start();

  if($_SESSION['loggedIn']){
    $dbname = 'BugMeDB';
    $host = 'localhost';
    $username = '';
    $password = '';

    if(isset($_POST['submit'])){
      $fname = filter_var($_POST['fname'],FILTER_SANITIZE_STRING);
      $lname = filter_var($_POST['lname'],FILTER_SANITIZE_STRING);
      $pass = filter_var($_POST['pass'],FILTER_SANITIZE_STRING);
      $email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
      $date = date('Y/m/d');
    }
    else{
      echo "error";
    }

    function validatePassword($pass){
      return preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pass);
    }

    function validateEmail($email){
      if($email != '' and preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',$email)){
        return 1;
      }
      return 0;
    }

    function validateName($name){
      if($name != ''){
        return 1;
      }
      return 0;
    }

    function validateData($fname,$lname,$pass,$email){
      if (validateName($fname) and validateName($lname) and validateEmail($email) and validatePassword($pass)){
        return 1;
      }
      return 0;
    }

    try{
      $conn = new PDO("mysql:host = $host; dbname = $dbname", $username, $password);

      $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo "Not Connected ".$e->getMessage();
    }

    if (validateData($fname,$lname,$pass,$email)){
      $hashpass = MD5($pass);
      $sql = "INSERT INTO BugMeDB.Users(firstname,lastname,password,email,date_joined) VALUES('$fname','$lname','$hashpass','$email','$date')";

      try{
        $sth = $conn->query($sql);
        header('Location: ../newUserScreen.html');
      }
      catch(PDOException $e){
        echo "Could not update database : " . $e;
      }
    }
    else{
      echo "invalid data received";
    }
}
else {
  echo "Not logged in";
}
?>
