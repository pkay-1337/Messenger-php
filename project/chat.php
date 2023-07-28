<!DOCTYPE html>
<html>
<head>
  <title>Chat Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f0f0f0;
    }

    .container {
      max-width: 600px;
      padding: 20px;
      border: 1px solid #ccc;
      background-color: #fff;
    }

    .chat-form {
      display: flex;
      align-items: center;
      margin-top: 20px;
    }

    .chat-form input[type="email"],
    .chat-form input[type="text"] {
      padding: 8px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 5px;
      flex: 1;
    }

    .chat-form input[type="submit"] {
      padding: 8px 16px;
      font-size: 14px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      margin-left: 10px;
      cursor: pointer;
    }

    .chat-box {
      border: 1px solid #ccc;
      padding: 10px;
      max-height: 400px;
      overflow-y: auto;
    }

    .chat-box p {
      margin: 5px 0;
    }

    .chat-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="chat-title">Chat Page</h1>
    <form class="chat-form" action="chat.php" method="post">                       
      Who do you wanna chat with? <input type="email" name="data">
      <input type="submit" name="submit" value="Start Chat">
    </form>
<?php
    $con = mysqli_connect("localhost","db","pk","cimage");
    $cookie = $_COOKIE["Auth"];
    $query = "select * from users where cookie='$cookie';";
    $result = mysqli_query($con,$query);
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc())
        {
            $un = $row['email'];
            echo "<h3>Your Email : $un"."</h3>";
        }
        if(isset($_POST['logout'])){
            $update = "update users SET cookie='NULL' where email='$un';";
            mysqli_query($con,$update);
            echo '<script>window.location.href = "/project/login.php"; </script>';
        }
        if(isset($_POST['data'])){
            $friend = $_POST['data'];
            //$data = '{'.$data.'}';
            //echo $friend."<br>";

            $query = "select * from users where email='$friend';";
            $result = mysqli_query($con,$query);
            if ($result->num_rows > 0) 
            {
                $a= $un;
                $b= $friend;

            //echo $a."<br>";
            //echo $b."<br>";
                $a = str_split($a);
                $b = str_split($b);
                $id = 0;
                foreach($a as $x){
                    $id =  $id + ord($x);
                }
                foreach($b as $x){
                    $id =  $id + ord($x);
                }
                echo "Chat id : ".$id."<br>";
                $query = "select * from chats where bw='$id';";
                $result = mysqli_query($con,$query);
                if ($result->num_rows > 0) 
                {
                    echo '';
                }else{
                    $query2 = "insert into chats(bw,chat,u1,u2) values('$id',' ','$un','$friend')";
                    mysqli_query($con,$query2);

                }

                setcookie("CHAT", "$id", time() + 2 * 24 * 60 * 60);
                echo '<script>window.location.href = "/project/chat.php"; </script>';

            }else{
                echo "This User Doesn't Exist. Please Check email.<br>";
            }

        }
        //echo $cookie2;

    }else{
        setcookie("Auth", "", time() - 3600);
        echo '<script>window.location.href = "/project/login.php"; </script>';
    } 
?>
<?php
    if(isset($_COOKIE["CHAT"])){
        $cookie2 = $_COOKIE["CHAT"];
        $query = "select * from chats where bw='$cookie2';";
        $result = mysqli_query($con,$query);
        $row = $result->fetch_assoc();
        $f = $row['u2'];
        if($f == $un){
            $f = $row['u1'];
        }
        if(isset($_POST['send'])){
            $message = $_POST['message'];
            $message= $un." : ".$message.'<br>';
            $update = "update chats SET chat=concat(chat,'$message') where bw='$cookie2';";
            mysqli_query($con,$update);
            echo '<script>window.location.href = "/project/chat.php"; </script>';
        }
    }

    echo "<h3>Chatting With : $f"."</h3>";
    echo "<hr>";

?>
<iframe src="listChat.php" id="abcd" scrolling="no" width="500" height="600" ></iframe>
<form action="chat.php" method="post" id="message_form">                       
        Message : <input type="text" name="message">
        <input type="submit" name="send" value="Send">
</form>
<hr>

<form action="chat.php" method="post">                       
        <input type="submit" name="logout" value="logout">
</form>
    <script>
    function reloadIFrame() {
        document.getElementById("abcd").src="listChat.php";
    }
    setInterval("reloadIFrame();", 2000); 
    </script>
  </div>
</body>
</html>

