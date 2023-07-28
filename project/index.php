<html>
<head>
</head>
<body>
<br>
<form action="index.php" method="post">                       
        Add something to your list : <input type="text-area" name="data">
        <input type="submit" name="submit" value="submit">
</form>


<?php
    // Add Your User, Password, and Database name here  
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

            if(isset($row['data'])){
                $d = $row['data'];
                $d = str_replace("{","<tr><td>",$d);
                $d = str_replace("}","</td></tr>",$d);
                echo "<h3>Your List : </h3>"; echo "<table border='1'>";
                echo $d;
                echo "</table>";
            }
        }
        if(isset($_POST['logout'])){
            $update = "update users SET cookie='NULL' where email='$un';";
            mysqli_query($con,$update);
            echo '<script>window.location.href = "/project/login.php"; </script>';
        }
        if(isset($_POST['submit'])){
            $data = $_POST['data'];
            $data = '{'.$data.'}';
            $update = "update users SET data=concat(data,'$data') where email='$un';";
            mysqli_query($con,$update);
            echo '<script>window.location.href = "/project/index.php"; </script>';
        }
    }else{
        setcookie("Auth", "", time() - 3600);
        echo '<script>window.location.href = "/project/login.php"; </script>';
    } 
?>
<h2> Chat with Your Friends : <button><a href="chat.php">Chat</a></button></h2>
<form action="index.php" method="post">                       
        <input type="submit" name="logout" value="logout">
</form>
</body>
</html>
