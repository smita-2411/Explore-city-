<?php

ob_start();
session_start();

include("connection.php");
include("functions.php");


$message = "";


if($_SERVER['REQUEST_METHOD'] == "POST")
{

    $user_name = trim($_POST['user_name']);
    $password  = trim($_POST['password']);


    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {

        $user_id = random_num(20);


        $query = "INSERT INTO users 
                  (user_id,user_name,password) 
                  VALUES 
                  ('$user_id','$user_name','$password')";


        $result = mysqli_query($con,$query);


        if($result)
        {
            header("Location: login.php");
            exit();
        }
        else
        {
            $message = "Something went wrong!";
        }

    }
    else
    {
        $message = "Please enter valid information!";
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Create Account</title>


<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


<style>


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}


body{

    height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    background:linear-gradient(135deg,#667eea,#764ba2);

    overflow:hidden;

}


/* background shapes */

body::before{

    content:"";

    position:absolute;

    width:300px;

    height:300px;

    background:rgba(255, 255, 255, 0.15);

    border-radius:50%;

    top:-80px;

    left:-80px;

}


body::after{

    content:"";

    position:absolute;

    width:300px;

    height:300px;

    background:rgba(255,255,255,.15);

    border-radius:50%;

    bottom:-80px;

    right:-80px;

}



/* Signup Card */


#box{

    width:380px;

    padding:40px;

    background:rgba(255,255,255,.15);

    backdrop-filter:blur(15px);

    border-radius:20px;

    border:1px solid rgba(255,255,255,.3);

    box-shadow:0 20px 40px rgba(0,0,0,.3);

    text-align:center;

    color:white;

}


.logo{

    font-size:55px;

}


h2{

    margin-top:10px;

    font-size:30px;

}


p{

    margin:10px 0 30px;

    color:#eee;

    font-size:14px;

}



/* input */


.input-box{

    margin-bottom:20px;

}


.input-box input{


    width:100%;

    padding:14px;

    border:none;

    outline:none;

    border-radius:12px;

    background:rgba(255,255,255,.25);

    color:white;

    font-size:15px;

}


.input-box input::placeholder{

    color:#eee;

}



/* button */


button{


    width:100%;

    padding:14px;

    border:none;

    border-radius:12px;

    background:white;

    color:#667eea;

    font-size:17px;

    font-weight:600;

    cursor:pointer;

    transition:.3s;

}


button:hover{

    transform:translateY(-3px);

    box-shadow:0 10px 20px rgba(0,0,0,.3);

}



.login{

    margin-top:25px;

}


.login a{

    color:white;

    text-decoration:none;

    font-weight:600;

}


.login a:hover{

    text-decoration:underline;

}



/* message */


.msg{

    background:#e74c3c;

    padding:10px;

    border-radius:8px;

    margin-bottom:15px;

}



</style>


</head>


<body>


<div id="box">


<!--<div class="logo">
📝
</div>-->


<h2>Create Account</h2>


<p>Register to continue</p>



<?php

if($message!="")
{
    echo "<div class='msg'>$message</div>";
}

?>



<form action="" method="post" autocomplete="off">


<div class="input-box">

<input 

type="text"

name="user_name"

placeholder="Username"

autocomplete="off"

required>

</div>



<div class="input-box">


<input 

type="password"

name="password"

placeholder="Password"

autocomplete="new-password"

required>


</div>




<button type="submit">

Signup

</button>



<div class="login">

<br>

Already have an account?

<a href="login.php">

Login

</a>


</div>



</form>


</div>



</body>

</html>


<?php

ob_end_flush();

?>