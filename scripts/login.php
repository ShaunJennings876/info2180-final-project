<?php

  session_start();

  $_SESSION['loggedIn'] = false;

  $dbname = 'BugMeDB';
  $host = 'localhost';
  $username = '';
  $password = '';

  if(isset($_POST['submit'])){
    $pass = filter_var($_POST['pass'],FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
  }
  else{
    echo "error";
  }
//Validate Password
  function validatePassword($pass){
    return preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pass);
  }

//Validate Email
  function validateEmail($email){
    if($email != '' and preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',$email)){
      return 1;
    }
    return 0;
  }

//Validate Data
  function validateData($pass,$email){
    if (validateEmail($email) and validatePassword($pass)){
      return 1;
    }
    return 0;
  }

//Connect to database
  try{
    $conn = new PDO("mysql:host = $host; dbname = $dbname", $username, $password);

    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
    echo "Not Connected ".$e->getMessage();
  }

//If data is valid perform query
  if (validateData($pass,$email)){
    $hashpass = MD5($pass);
    $sql = "SELECT email,password FROM BugMeDB.Users WHERE email = '$email' and password = '$hashpass'";

    try{
      $sth = $conn->query($sql);
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);

      if(empty(!$rows)){
        $_SESSION['loggedIn'] = true;
        header('Location: ../home.php');
      }
      else{
        $_SESSION['loggedIn'] = false;
        //$_SESSION['username'] = $rows[0]['email'];
        //$_SESSION['pass'] = $rows[]['']
        echo "Could not log in";
      }

    }
    catch(PDOException $e){
      echo "Could not update database : " . $e;
    }
  }
  else{
    echo "invalid data received";
  }
?>
