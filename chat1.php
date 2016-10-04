<?php
  include('data_connect.php');
  $que = "select * from chat where group_name = '".$_COOKIE['group_name']."'";
  $res = mysqli_query($que);

  while($row = mysqli_fetch_array($res)){
    echo("<span class='name'>".$row['name']."<span>");
    echo("<div class='mess'>".$row['message']."</div>");
  }
 ?>
