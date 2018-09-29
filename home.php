<?php 
session_start();
$username=$_SESSION['username'];

           
if(isset($_POST['searchbtn'])){
     $_SESSION['user']=$username;
      }


if(!isset($_SESSION['username']))
{
header("Location:index.php");
}
else{
	?>
   <!DOCTYPE html>
   <html>
   <head>
   	<title>Home</title>
   </head>
   <style>
   input[type=file], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
   button {
    width: 20%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #5A8CEE;
}
</style>
   <body>
   		<center>

   			<div style="border-radius: 5px;background-color: #f2f2f2;width: 100%;height: 700px;top: 0">

   				<div style="background: #AA9BC6;top: 0">
	   				   					<b style="top:0;background:#AA9BC6 ;font-size: 65px;font-family: cursive;color: #C70039  ;position: fixed;overflow: hidden;width: 100%;float: left;left: 0">ChatWith</b>

	   			</div>
 <!-- Menu list. --> 


   			    <div style="background: #DAF7A6;padding-right: 50px;height: 100%;width: 15%;border:none;margin-top: 83px;float: left;position: fixed;overflow: hidden;left: 0;display: inline-block;">
   			    	<ul><a href="friendrequests.php"><button style="border: none;background: gray;width:100%">Friend Requests 

   			    	<?php
   			    		$db=mysqli_connect("localhost","root","","chatwith");
   			    		$user1=$_SESSION['username'];
   			    		$requests=mysqli_query($db,"SELECT * FROM friendrequests1 WHERE user='$user1'");
   			    		$requestno=mysqli_num_rows($requests);
   			    		?><b style="color: green"> ( <?php echo $requestno; ?> )</b><?php
   			    	 ?>
   			    	 	
   			    	 </button></a></ul>
   			    	<ul><a href="friends.php"><button style="border: none;background: gray;width:100%;left: 2">Friends</button></a></ul>
   			    	<ul><form method="post" action="search.php">
            			<button name="searchbtn" style="border: none;background: gray;width:100%">Search Friends</button>
            		</form></ul>
            		<ul><a href=""><button style="border: none;background: gray;width:100%">Messages</button></a></ul>

   			    </div>
 <!-- Menu list. -->

  <!-- User Info -->
  			
   			    <div style="height: 100%;width: 30%;margin-top: 80px;display: inline-block;margin-right: 200px;">
   			    	<br><br>

   			    	<?php

   				if(isset($_POST['upload']))
					{
						if($_FILES['image']['tmp_name']==NULL)
						{
							?>
							<script type="text/javascript">
								alert("Please Select image First !");
							</script>
							<?php
						}
						else
						{
							$image=addslashes($_FILES['image']['tmp_name']);
							
							$image=file_get_contents($image);
							$image=base64_encode($image);
							
							$db=mysqli_connect("localhost","root","","chatwith");
							$save=mysqli_query($db,"UPDATE user SET `profile`='$image' WHERE `email`='$username' ");
							if($save)
							{
								?>
									<script type="text/javascript">alert("uploaded!");</script>
								<?php

							}
							else
							{
								 ?>
									<script type="text/javascript">alert("failed !");</script>
								<?php
							}
						

						}
					}
					

   			?>
   					<?php
							$db=mysqli_connect("localhost","root","","chatwith");
								$display=mysqli_query($db,"SELECT `profile` FROM `user` where email='$username'");
								while($data=mysqli_fetch_assoc($display))
								{
								echo '<img height="100" width="100" style="border-radius:50px" src="data:image;base64,'.$data['profile'].'" /><br>'; 
								}

   					 ?>

   			    	
   			    	
   			    	<b style="font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;">Username: <?php echo $_SESSION['username']; ?> </b><br>
   			<b style="font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;">Name: <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?> </b><br>
   			<a href="logout.php"><button style="border: none;margin-top: 20px">Logout</button></a>

 <!-- User Info -->

  <!-- profile picture upload -->

   		<div style="border-radius: 3px;background: #DAF7A6;margin-right: 40px">

   			

   			<br><i>Upload your profile picture, to make people know you !</i><br>
   			<form method="POST" action="home.php" enctype="multipart/form-data">
					
					<input style="border-radius: 4px;border:none;left: 20" type="file" name="image"><br>
					<input style="border-radius: 4px;border:none" type="submit" name="upload" value="Upload">
					
			</form>
   		</div>
 <!-- profile picture upload -->	

   			 
   			 
   			    </div>
   			
   			    <br>

   			  
   			   


    	</center>
   		</body>
   </html>
	<?php
}
?>