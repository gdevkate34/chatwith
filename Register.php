
<?php 

$db=mysqli_connect("localhost","root","","chatwith");

if(isset($_POST['registerbtn']))
{

  $firstname=$_POST['fname'];
  
  $lastname=$_POST['lname'];
 
  $email=$_POST['email'];
  $password=$_POST['password'];
  

  $check=mysqli_query($db,"SELECT * FROM `user` WHERE `email`='$email'");
  if(mysqli_num_rows($check)>0)
  {
    ?> <script type="text/javascript">alert("Email already Exists!");</script> <?php
  }
  else
  {

  $sql="INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `password`, `profile`) VALUES (NULL, '$firstname', '$lastname', '$email', '$password', '')";
  $insert=mysqli_query($db,$sql);
  if($insert){?> <script type="text/javascript">alert("Successfully Registered !");</script> <?php }
  else
    {?> <script type="text/javascript">alert("Failed");</script> <?php }



      }
  

  
}
?>
<script  type="text/javascript" language="javascript">
 function validate()  
{  
    var format=/^[a-zA-Z]+$/;
   var x = document.forms["myform"]["fname"].value;
    if (x == "") {
        alert("First Name must be filled out");
        return false;
    }
    if(!x.match(format))
    {
        alert(" Invalid Firstname");
        return false;
    }
    var y = document.forms["myform"]["lname"].value;
    if (y == "") {
        alert(" Last Name must be filled out");
        return false;
    }
    if(!y.match(format))
    {
        alert("Invalid Lastname ");
        return false;
    }

  var w=document.forms["myform"]["password"].value;   
 if (w==""||w.length<8) {
    alert("Please enter valid password with minimum 8 characters");
    return false;
 }
 
   
}  
</script>

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
    
<div >
     
         <b style="top:0;background:blue;font-size: 65px;font-family: cursive;color: white  ;position: fixed;overflow: hidden;width: 100%;float: left;left: 0">ChatWith</b><br><br><br><br>
  <form name="myform"  method="post" action="Register.php">
  	<b>SignUp with Email ID</b><br><br>

    
    <input type="text"  name="fname" required placeholder="First Name" ><br>

    
    <input type="text"  name="lname" required placeholder="Last Name" ><br>

    
    <input type="email"  name="email" required placeholder="Email ID"><br>

    
    <input type="Password"  name="password" required placeholder="Password"><br>
    
    
    <input type="submit" onclick="return validate();" name="registerbtn" value="SignUp">
   
        

  </form>
  <a href="index.php"><button style=" width: auto;background-color: gray;color: white;padding: 14px 20px;margin: 8px 0;border: none;border-radius: 4px">Already user ? Click here!</button>  </a>
</div>
 </center>
 
</body>
</html>
