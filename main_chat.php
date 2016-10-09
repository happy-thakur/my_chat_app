<?php
  if(!isset($_COOKIE['email'])){
    header('Location: default.php');
  }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>chat</title>
    <!-- <script type="text/javascript" src="jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.4.min.js"></script>
    <base href="http://officechat.16mb.com/" target="_self">
    <!-- <base href="http://localhost/" target="_self"> -->


    <style media="screen">
      div.chat_box{
        height: 400px;
        width: 40%;
        border: 1px rgba(200,200,200,0.7) solid;
        border-radius: 5px;
        margin-bottom: 1%;
        overflow: auto;
        padding: 10px;
        padding-bottom: 30px;
      }
      textarea.input{
        height: 70px;
        width: 40%;
        padding: 8px;
        /*margin: 5px;*/
        border-radius: 5px;
      }
      div.mess{
        padding: 3px;
        background: rgba(200,200,200,0.7);
        border-radius: 5px 0px;
        margin: 4px 0px;
        display: table;
      }
      div.mess{
        display: -webkit-inline-box;
        background: rgba(200,200,200,0.5);
        border-radius: 5px 0px;
        margin: 5px 7px;
        padding: 5px;
        font-weight: 500;
        font-size: 15px;
      }
      div.one_chat_box{
        width: 90%;
      }
      span.name{
        font-weight: 600;
        color: currentColor;
        text-decoration: underline;
      }
      pre{
        font-family: cursive;
        margin: 0px;

      }
      div.chat_box::-webkit-scrollbar {
          width: 8px;
      }
      label{
        display: block;
      }

      div.chat_box::-webkit-scrollbar-track{
          /*-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);*/
          -webkit-border-radius: 10px;
          border-radius: 5px;
          background: white;
          border: 1px rgba(200,200,200,0.7) solid;
      }
      div.chat_box::-webkit-scrollbar-thumb{
          -webkit-border-radius: 5px;
          border-radius: 5px;
          background: rgba(00,00,00,0.5);
          /*-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);*/
      }
      div.chat_box::-webkit-scrollbar-thumb:window-inactive{
          background: rgba(200,200,200,0.4);
      }
      div.chat_box::-webkit-scrollbar-thumb:active div.chat_box::-webkit-scrollbar-track{
          /*-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);*/

          background: rgba(200, 200, 200, 0.5);

      }
      @media only screen and (max-width: 992px) {
        div.chat_box{
          width: 100%;
          height: 300px;
        }
        textarea.input{
          height: 15%;
          width: 100%;

        }
      }
    </style>
  </head>
  <body>
    <?php
      if(isset($_COOKIE['email']) || isset($_COOKIE['group_name'])){
        ?>
        <form class="logout" action="logout.php" method="post">
          <input type="submit" name="logout" value="Logout">
        </form>

        <?php
      }
    ?>
    <div class="chat_box">

    </div>

    <form class="chat_submit" action="index.html" method="post">
      <textarea name="chat_input" class="input" rows="8" cols="40" placeholder="Enter you message here..."></textarea>
      <label>
        <input type="checkbox" name="name" id="enter" value="" checked>
        use enter to submit
      </label>
      <button type="button" name="submit" class="submit">Submit</button>
    </form>
  </body>

  <script type="text/javascript">
    $(function(){
      //on click..
      $("button.submit").click(fill_div);

      //handling the keyevent...
      $('textarea.input').keydown(function(eve){
        if(eve.which == 13){
          if($('#enter').prop('checked')){
            eve.preventDefault();
            fill_div();
          }
        }
      });
    });

    //to enter the detail into the chat box..
    function fill_div(){

      //to fill the div...
      // alert('hello');
      //to auto scroll the div..
      console.log($('div.chat_box').prop('scrollHeight'));
      $('div.chat_box').scrollTop($('div.chat_box').prop('scrollHeight'));
      var div_str = $('div.chat_box').html();
      // alert(div_str.length);
      if(div_str.length > 0)
      {
        if($('textarea.input').val() != "")
        {
          <?php
            include('data_connect.php');
            $que = "select * from login where email='".$_COOKIE['email']."'";
            $res = mysqli_query($db, $que);
            $row = mysqli_fetch_array($res);
           ?>
          //posting the data..
          $.post('push.php',
                {chat_id : '<?php echo($row['chat_id']) ?>',
                name : "<?php echo($row['name']) ?>",
                group_name : "<?php echo($row['group_name']) ?>",
                message : $('textarea.input').val()},
                function(){
                  $.get("http://officechat.16mb.com/chat.php", function(data){
                    $('div.chat_box').html(data);
                  //
                  //   // dat = data;
                  });
                  console.log('upload complete');
                }

                );

          var str = div_str + '<div class="mess"><pre>' + $('textarea.input').val() + "</pre></div>";
          $('div.chat_box').html(str);
          $('textarea.input').val("");
        }
      }
      }
      var prev_data;
      function get_data(){
        console.log('start');

        //getting the data..
        //data will contain the data from the chat.php file..
        $.get("http://officechat.16mb.com/chat.php", function(data){
          $('div.chat_box').html(data);
          if(prev_data != data){
          
            $('div.chat_box').scrollTop($('div.chat_box').prop('scrollHeight'));
          }
          prev_data = data;
          setTimeout(get_data, 2000);
        });
      }

get_data();

  </script>
  <script type="text/javascript" src="chat.js">
  </script>
</html>
