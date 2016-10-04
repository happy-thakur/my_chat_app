<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['name'])){
    include('data_connect.php');
    $que = "insert into login (s_no, chat_id, name, email, group_name, password)
            values ('',
            '".$_POST['email']."',
            '".$_POST['name']."',
            '".$_POST['email']."',
            '".$_POST['group_name']."',
            '".$_POST['password']."')";

    $res = mysqli_query($db, $que);
    if($res){
      setcookie('email', $_POST['email'], time() + 360000, '/');
      echo "<script>alert('upload done');</script>";
      header('Location: main_chat.php');
    } else {
      echo "<script>alert(' data not upload done');</script>";
    }
    mysqli_close($db);
  }
}

 ?>
