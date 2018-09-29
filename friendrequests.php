<?php 
session_start();
$db=mysqli_connect("localhost","root","","chatwith");


 if(!isset($_SESSION['username']))
 {
 	?>
 	<script type="text/javascript">alert("login Fiest !");</script><?php
 	header("Location:index.php");
 }

 else{
 	?>
 	<style type="text/css">
 		
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
 	</style>
 	<center>
	 	<div style="width: 100%;height: 100%;top: 0;left: 0">

	 		<!--<div style="top: 0">
	 			<a href="home.php"><button style="float: left;margin-top: 10px;border: none" >Back</button></a>
	 			<b style="font-size: 60px;font-family: cursive;color: blue;padding-top:100px">ChatWith</b>
	 			
	 		
	 			<p style="font-size: 15px;font-family: cursive;color: green;margin-top: 50px;margin-bottom: 20px; float: right"><?php echo $_SESSION['username']; ?></p>


	   		</div>
	   	-->

	   		<div style="background: #AA9BC6;top: 0">
	   				   					<b style="top:0;background:blue ;font-size: 60px;font-family: cursive;color: white;position: fixed;overflow: hidden;width: 100%;float: left;left: 0">ChatWith</b>
   					

   			
   			</div>
	   		

	   		<div style="margin-top: 80px;;">
	   			<b style="font-size: 20px;font-family: cursive;color: #581846;margin-top: 20px;">Friend Requests</b>
	   		</div>
	   		
	   			
	   			<div>
	   				<p>
	   					<?php 
	   					$user1=$_SESSION['username'];
	   					$sql=mysqli_query($db,"SELECT * FROM friendrequests1 WHERE user='$user1'");
	   					if(mysqli_num_rows($sql)>0)
	   					{
	   						
	   					
	   					
	   					$data=mysqli_fetch_array($sql);
	   					$emailID=$data['fruser'];
	   					$frfname=$data['frfname'];
	   					$frlname=$data['frlname'];
	   					$frprofile=$data['frprofile'];
	   					$id=$data['id'];
	   					if (isset($_POST['accept'])) {
	   						$a=$_SESSION['fname'];
	   						$b=$_SESSION['lname'];
	   						$c=$_SESSION['profile'];
	   						
	   						$query=mysqli_query($db,"INSERT INTO `friendss` ( `user`, `fuser`, `ffname`, `flname`, `fprofile`) VALUES ('$user1', '$emailID', '$frfname', '$frlname', '$frprofile');");
	   						$query1=mysqli_query($db,"INSERT INTO `friendss` ( `user`, `fuser`, `ffname`, `flname`, `fprofile`) VALUES ('$emailID', '$user1', '$a', '$b', '$c');");
	   						
	   						$query2=mysqli_query($db,"DELETE FROM friendrequests1 WHERE id=$id");
	   						
	   						
	   					}
	   					?>
	   					<div style="background: #DAF7A6;padding: 15px;font-family: monospace;font-size: 20px;width: 100%;left: 0">
	   						


			   					<?php

									echo '<img height="100" width="100" style="float:left;border-radius:50px;margin-top:25px;margin-left:100px;" src="data:image;base64,'.$frprofile.'" />'; 
								

			   					 ?>

	   						<br>
	   						<p style="font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;margin-right: 180px"><?php echo $frfname." ".$frlname;?></p>
	   						<p style="font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;margin-right: 180px"><?php
	   					echo $emailID;?></p>

	   					<?php
	   					?>
	   				</p>
	   				<form method="post" action="friendrequests.php">
                          <input type="submit" name="accept" value="Accept">
                        <input type="submit" name="delete" value="Delete">
                      </form>

                     	<?php 
                     	}
                     	else{echo "No more requests!";}
                     	?> 
	   			</div>
	   		</div>

	 	
 	</center>
 	<?php
 }
?>