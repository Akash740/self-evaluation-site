<?php

session_start();

if(isset($_SESSION['username'])){
  header("location.index.php");
  exit;
}
require_once "config.php";
$username = $password= "";
$err = "";

if($_SERVER['REQUEST_METHOD']=="POST"){
  if(empty(trim($_POST['username']))  ||  empty(trim($_POST['password']))){
    $err=" please Enter username or password";
  }
  else{
    $username=trim($_POST['username']);
    $password=trim($_POST['password']);
  }


  if(empty($err)){
    $sql= "SELECT id,username, password FROM users WHERE username=?";
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$param_username);
    $param_username=$username;
  

    if(mysqli_stmt_execute($stmt)){
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt)==1){
        mysqli_stmt_bind_result($stmt,$id,$username,$hashed_password);
        if(mysqli_stmt_fetch($stmt)){
          if(password_verify($password,$hashed_password)){
            session_start();
            $_SESSION["username"]=$username;
            $_SESSION["id"]=$id;
            $_SESSION["loggedin"]=true;


            header("location:index.php");
          }
        }
      }
    }



  }
}


?>







<?php include "basic.php"?>












<div class="container mt-4">
<form action="" method='post' >
  <div class="row mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" name="username" class="form-control" id="inputEmail3">
    </div>
  </div>
  <div class="row mt-4">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="inputPassword3">
    </div>
  </div>
  
  <div class="row mb-3">
    <div class="col-sm-10 offset-sm-2">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck1">
        <label class="form-check-label" for="gridCheck1">
          Example checkbox
        </label>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
</div>