
<?php
  echo('<h2>'.$_COOKIE['email'].' : </h2>');
  include('data_connect.php');
  $que = "select group_name from login where email = '".$_COOKIE['email']."'";
  $res = mysqli_query($db, $que);
  $row = mysqli_fetch_array($res);
  $group_name = $row['group_name'];

  $que = "select * from chat where group_name = '".$group_name."'";
  $res = mysqli_query($db, $que);

  while($row = mysqli_fetch_array($res)){
    echo('<div class="one_chat_box">');
    echo("<span class='name'>".$row['name'].":<span>");
    echo("<div class='mess'>---".$row['message']."</div>");
    echo('</div>');
  }
  mysqli_close($db);
  // div.mess{
  //   display: table-caption;
  // }
  // div.one_chat_box{
  //   width: 100px;
  // }
 ?>
