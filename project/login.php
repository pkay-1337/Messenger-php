<html>
<body>
<form action="login.php" method="post">                       
        User Email : <input type="email" name="un"><br>
        Password   : <input type="password" name="pw"><br>
        <input type="submit" name="do" value="Login">
</form>
<?php
    $con = mysqli_connect("localhost","db","pk","cimage");
    if(isset($_POST['pw'])){
        $username = $_POST["un"];
        $password = $_POST["pw"];
        $query = "select * from users where email='$username';";
        $result = mysqli_query($con,$query);
        if ($result->num_rows > 0) 
        {
            // OUTPUT DATA OF EACH ROW
            while($row = $result->fetch_assoc())
            {
                if($password == $row["password"]){
                    $cookie = $username;
                    for($i=strlen($cookie); $i<32; $i++){
                        $cookie= $cookie.'a';
                    }
                    $update = "update users SET cookie='$cookie' where email='$username';";
                    mysqli_query($con,$update);
                    setcookie("Auth", "$cookie", time() + 2 * 24 * 60 * 60);
                    echo '<script>window.location.href = "/project/index.php"; </script>';
                }else{
                    echo "Wrong Username or Password";
                }
            }
        } 
        else {
            echo "Wrong Username or Password";
        }
    }
    if(isset($_COOKIE['Auth'])){
        echo '<script>window.location.href = "/project/index.php"; </script>';
    }
?>
No Account? <button><a href="/project/register.php">Register</a></button>
</body>
</html>
