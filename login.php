<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['email'])){
      $email = $_POST['email'];

      include('data_connect.php');
      $que = "select * from login where email='".$email."'";
      $res = mysqli_query($db, $que);
      // echo('<script>alert("'.$res.'");</script>');
      $row = mysqli_fetch_array($res);
      // echo(sizeof($row));
      if(sizeof($row) <= 0){
        echo('<script>alert("wronng user or pass");</script>');
      }
      else{

        if($row['password'] == $_POST['password']){

          setcookie('email', $_POST['email'], time() + 360000, '/');
          // setcookie('group_name', $_POST['group_name'], time() + 360000, '/');

          // echo('<script>alert("logeed in111");</script>');
          header('Location: main_chat.php');
          // header('Location: home.php');

        } else {
          echo('<script>alert("wronng user or pass'.$row.'");</script>');
        }
      }
      mysqli_close($db);
    }
  } else {

  if(isset($_COOKIE['email'])){
    // echo('<script>alert("logeed in2222");</script>');
    header('Location: main_chat.php');
  } else {
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title>login</title>
      </head>
      <body>
      <div class="login">
        <h1>Login : </h1>
        <div class="login_div">
          <form class="login" action="login.php" method="post">
            <input type="text" name="email" value="">
            <input type="password" name="password" value="">
            <input type="submit" name="submit" value="Submit">
          </form>
      </div>
        </div>

        <div class="signup">
          <h1>Signup : </h1>
          <form class="signup" action="signup.php" method="post">
            <input type="text" name="email" value="" placeholder="Email">
            <input type="password" name="password" value="" placeholder="Password">
            <input type="text" name="name" value="" placeholder="Name">
            <input type="text" name="group_name" value="" placeholder="Group Name">
            <input type="submit" name="submit" value="signup">
          </form>
        </div>
      </body>
    </html>

    <?php
  }
}
 ?>
