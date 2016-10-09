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
        <title>login</title>\
<style type="text/css">
input{
    margin: 10px;
    padding: 5px;
    /* border-radius: 1px; */
    border: 1px rgba(100,100,100,0.5) solid;
    border-radius: 5px;
}
div.login, div.signup{
        width: 20%;
    border: 1px rgba(200,200,200,1) solid;
    padding: 10px;
    border-radius: 12px;
    background: cornflowerblue;
    padding-left: 25px;
    display: inline;
    float: left;
}
div.signup{
float: right;
}
}
</style>
      </head>
      <body>
      <div class="login">
        <h1>Login : </h1>
        <div class="login_div">
          <form class="login" action="default.php" method="post">
            <input type="text" name="email" value="" placeholder="Email Id" required>
            <input type="password" name="password" value="" placeholder="Password" required>
            <input type="submit" name="submit" value="Submit">
          </form>
      </div>
        </div>

        <div class="signup">
          <h1>Signup : </h1>
          <form class="signup" action="signup.php" method="post">
            <input type="text" name="email" value="" placeholder="Email" required>
            <input type="password" name="password" value="" placeholder="Password" required>
            <input type="text" name="name" value="" placeholder="Name" required>
            <input type="text" name="group_name" value="" placeholder="Group Name" required>
            <input type="submit" name="submit" value="signup">
          </form>
        </div>
      </body>
    </html>

    <?php
  }
}
 ?>
	