# Messenger-php
A messenger made with PHP and SQL Database

Features :
1. User Resistration
2. User Login
3. Using cookie to keep a user logged in
4. A user specific data table. ( just for POC )
5. Chat Beetween 2 users with Special row for each conversation in DB.
6. More to come :)

NOTE :
    $con = mysqli_connect("localhost","db","pk","cimage");
      In the code, Replace - user, password and database name with Yours

    Create an table to store user email and password like this :
      +----------+-------------+------+-----+---------+-------+
      | Field    | Type        | Null | Key | Default | Extra |
      +----------+-------------+------+-----+---------+-------+
      | email    | varchar(30) | YES  |     | NULL    |       |
      | password | varchar(50) | YES  |     | NULL    |       |
      | cookie   | varchar(32) | YES  |     | NULL    |       |
      | data     | text        | YES  |     | NULL    |       |
      +----------+-------------+------+-----+---------+-------+
      4 rows in set

    Create an table to store Chats between users :
      +-------+--------------+------+-----+---------+-------+
      | Field | Type         | Null | Key | Default | Extra |
      +-------+--------------+------+-----+---------+-------+
      | bw    | varchar(100) | YES  |     | NULL    |       |
      | chat  | text         | YES  |     | NULL    |       |
      | u1    | varchar(50)  | YES  |     | NULL    |       |
      | u2    | varchar(50)  | YES  |     | NULL    |       |
      +-------+--------------+------+-----+---------+-------+
      4 rows in set
Should Work Fine
    


    
