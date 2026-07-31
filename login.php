<?php
ob_start();
session_start();

include("connection.php");
include("functions.php");

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $user_name = trim($_POST['user_name']);
    $password = trim($_POST['password']);

    if (!empty($user_name) && !empty($password))
    {
        $query = "SELECT * FROM users WHERE user_name='$user_name' LIMIT 1";
        $result = mysqli_query($con,$query);

        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);

            if($user_data['password'] == $password)
            {
                $_SESSION['user_id'] = $user_data['user_id'];

                header("Location: index.php");
                exit();
            }
        }

        $message = "Wrong username or password!";
    }
    else
    {
        $message = "Please fill all fields!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login</title>

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
background:linear-gradient(135deg,#4facfe,#00f2fe);
overflow:hidden;
}

body::before{
content:'';
position:absolute;
width:300px;
height:300px;
background:rgba(255,255,255,.2);
border-radius:50%;
top:-80px;
left:-80px;
}

body::after{
content:'';
position:absolute;
width:250px;
height:250px;
background:rgba(255,255,255,.15);
border-radius:50%;
bottom:-70px;
right:-70px;
}

#box{
width:380px;
padding:40px;
background:rgba(255,255,255,.15);
backdrop-filter:blur(15px);
border-radius:20px;
box-shadow:0 15px 30px rgba(0,0,0,.3);
text-align:center;
color:#fff;
}

#box h2{
margin-bottom:10px;
font-size:30px;
}

#box p{
margin-bottom:25px;
color:#f5f5f5;
}

.input{
width:100%;
padding:14px;
margin:12px 0;
border:none;
border-radius:10px;
outline:none;
font-size:15px;
}

.input:focus{
box-shadow:0 0 10px white;
}

.btn{
width:100%;
padding:14px;
border:none;
border-radius:10px;
background:#fff;
color:#2196f3;
font-size:17px;
font-weight:bold;
cursor:pointer;
transition:.3s;
margin-top:10px;
}

.btn:hover{
background:#2196f3;
color:#fff;
transform:scale(1.03);
}

a{
color:#fff;
text-decoration:none;
font-weight:600;
}

a:hover{
text-decoration:underline;
}

.msg{
margin-bottom:15px;
background:#ff4d4d;
padding:10px;
border-radius:8px;
}

</style>

</head>

<body>

<div id="box">

<h2>🔐 Login</h2>

<p>Welcome Back</p>

<?php
if($message!="")
{
    echo "<div class='msg'>$message</div>";
}
?>

<form method="post" action="" autocomplete="off">

<input
class="input"
type="text"
name="user_name"
placeholder="Username"
autocomplete="off"
required>

<input
class="input"
type="password"
name="password"
placeholder="Password"
autocomplete="new-password"
required>

<input
class="btn"
type="submit"
value="Login">

<br><br>

<a href="signup.php">Create New Account</a>

</form>

</div>

</body>
</html>

<?php
ob_end_flush();
?>