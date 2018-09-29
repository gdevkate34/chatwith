
<?php  
session_start();
if(isset($_SESSION['username'])) 
{
    header("Location:home.php");
}


 $db=mysqli_connect("localhost","root","","chatwith");
 if($db){
    //echo"connection successful";

 }
 else "no connection";

 
 if(isset($_POST['login_btn']))
    {
        $user= $_POST['email'];
        $pass= $_POST['password'];

        $query="select * from user where email='$user' && password='$pass' ";
        $result = mysqli_query($db, $query);
        
        $num = mysqli_num_rows($result);
        if($num==1)
        {
           while ($data=mysqli_fetch_array($result)) {
               $_SESSION['uid']=$data['id'];
               $_SESSION['username']=$data['email'];
               $_SESSION['fname']=$data['fname'];
               $_SESSION['lname']=$data['lname'];
               $_SESSION['profile']=$data['profile'];
               header("Location:home.php");
           }
           
        }
        else{
        echo "<script>alert('wrong credintials !');</script>";
       
            
        }
           
    }

?>


<!DOCTYPE HTML>
<!DOCTYPE html>
<html>

<head>

<title>Authenticate</title>
<link rel="stylesheet" href="login.css">
 <meta name="viewport" content="width=device-width, initial-scale=1">   

</head>


<style>
input[type=text], select {
    width: 30%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=email], select {
    width: 30%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=Password], select {
    width: 30%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] {
    width: 10%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #5A8CEE;
}
button:hover{
cursor: pointer;	
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>

<body >

<center>
 
         <b style="top:0;background:blue;font-size: 65px;font-family: cursive;color: white  ;position: fixed;overflow: hidden;width: 100%;float: left;left: 0">ChatWith</b>

<br><br><br><br>
<div class="container">
    
  <form name="myform"  method="post" action="login.php">
  	<b>Login with Email ID</b><br><br>
    <b style=" width: 50px;background-color: gray;color: white;padding: 14px 20px;margin: 8px 0;border: none;border-radius: 4px;">Email ID</b>
    <input type="email"  name="email" required ><br>

    <b style=" width: 10%;background-color: gray;color: white;padding: 14px 20px;margin: 8px 0;border: none;border-radius: 4px;">Password</b>
    <input type="Password"  name="password" required><br>
    
    
    <input type="submit" onclick="return validate()" name="login_btn" value="Login"><br>
   
        <a href="fergotpassword.html"  style="width: 50px">Fergot password ? Click Here !</a>

  </form>
  <a href="Register.php"><button style=" width: auto;background-color: gray;color: white;padding: 14px 20px;margin: 8px 0;border: none;border-radius: 4px">New User ? Register Here</button>  </a>
</div>
 </center>
 
</body>
</html>
