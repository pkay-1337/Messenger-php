<html>
<body>
<form action="register.php" method="post">                       
        User Email : <input type="email" name="un"><br>
        Password   : <input type="password" name="pw"><br>
        <input type="submit" name="do" value="Create Account">
</form>
<?php
    $con = mysqli_connect("localhost","db","pk","cimage");
    if(isset($_POST['pw'])){
        $email = $_POST["un"];
        $password = $_POST["pw"];
        $query = "select * from users where email='$email';";
        $result = mysqli_query($con,$query);
        if ($result->num_rows > 0) 
        {
            echo "This User already Exists. Please Login.<br>";
        }else{
            $query2 = "insert into users(email,password,data) values('$email','$password',' ')";
            $rs = mysqli_query($con,$query2);
            if($rs){
                echo "User Added<br>";
            }else{
                echo "User not added<br>";
            }
        }
    }
    echo 'Already have an Account? <button><a href="/project/login.php">Login</a></button><br><hr>';
    $query2 = "select * from users;";
    $result = mysqli_query($con,$query2);
    if ($result->num_rows > 0) 
    {
        // OUTPUT DATA OF EACH ROW
        echo '<h3 align="center"> All Users : </h3>';
        /*
        while($row = $result->fetch_assoc())
        {
            echo "Email: " .
                $row["username"]. " - Password: " .
                $row["password"]. "<br>";
        }
        echo "<hr>";
         */
        $result = mysqli_query($con,$query2);
        
    } 
    else {
        echo "0 results";
    }
?>
<table border="1" width="400" align="center">
    <tr>
        <th>USERNAME</th><th>PASSWORD</th>
        <?php
            while($row=mysqli_fetch_array($result)){

                echo "<tr><td>".$row["email"]."</td><td>".$row["password"]."</td></tr>";
            }
        ?>
    </tr>
</table>

</body>
</html>
