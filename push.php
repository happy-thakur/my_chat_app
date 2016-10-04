<?php
echo('hello upload');
if(isset($_POST['name'])){
  include('data_connect.php');
  $date = date('Y-m-d H:i:s');
  $que = "insert into chat
          (s_no,
          chat_id,
          name,
          group_name,
          date,
          message,
          ip_address)
          values ('',
          '".$_POST['chat_id']."',
          '".$_POST['name']."',
          '".$_POST['group_name']."',
          '".$date."',
          '".$_POST['message']."',
          '111.112.1.2')";
          echo($que);

          mysqli_query($db, $que);

}
else {
  echo('not uploaded');
}

?>
