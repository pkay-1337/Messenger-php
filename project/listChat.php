<?php
    $con = mysqli_connect("localhost","db","pk","cimage");
    $cookie = $_COOKIE["Auth"];
    $query = "select * from users where cookie='$cookie';";
    $result = mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    $un = $row['email'];

    if(isset($_COOKIE["CHAT"])){
        $cookie2 = $_COOKIE["CHAT"];
        $query = "select * from chats where bw='$cookie2';";
        $result = mysqli_query($con,$query);
        $row = $result->fetch_assoc();
        $f = $row['u2'];
        if($f == $un){
            $f = $row['u1'];
        }
        echo $row["chat"];

        if(isset($_POST['send'])){
            $message = $_POST['message'];
            $message= $un." : ".$message.'<br>';
            $update = "update chats SET chat=concat(chat,'$message') where bw='$cookie2';";
            mysqli_query($con,$update);
            echo '<script>window.location.href = "/project/chat.php"; </script>';
        }
    }
?>
<div id="bottom"></div>
    <script>
    document.getElementById( 'bottom' ).scrollIntoView();
    </script>
