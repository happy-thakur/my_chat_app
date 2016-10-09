<?php
  if(isset($_COOKIE['email'])){
    setcookie('email', "", time() - 3600, '/');
    echo('<script>alert("removed email");</script>');

  }
  else{
    echo('<script>alert("not removed email");</script>');
  }
  // if(isset($_COOKIE['group_name'])){
  //   setcookie('group_name', "", time() - 3600);
  // }
  // else {
  //   echo('<script>alert("not removed group");</script>');
  // }
  header('Location: default.php');
 ?>
