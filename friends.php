<?php
session_start();
$users=$_SESSION['username'];
$db=mysqli_connect("localhost","root","","chatwith");

if(!isset($_SESSION['username']))
{
	header("Location:index.php");
}
else{?>

	<center>
	 	<div style=";">

	 		<div style="">
	 			
	 			<b style="top:0;background:blue;font-size: 65px;font-family: cursive;color: white  ;position: fixed;overflow: hidden;width: 100%;float: left;left: 0">ChatWith</b><br><br><br><br>
	 			<p style="font-size: 15px;font-family: cursive;color: green;margin-top: 20px; float: right"><?php echo $_SESSION['username']; ?></p>

	   		</div>
	   		<hr>

	   		<div>
	   			<b style="font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;">FRIENDS</b>
	   			<hr>
	   			<?php
					$s="SELECT * FROM friendss WHERE user='$users'";

					$r=mysqli_query($db,$s);
					
					if(mysqli_num_rows($r)>0)
					{
						while ($row=mysqli_fetch_assoc($r)) {
							
							?>
							<div style="float: left;margin-left: 10px;background: #DAF7A6;border-radius: 3px;padding: 15px;width: auto;margin-bottom: 10px">
							<?php echo '<img height="100" width="100" src="data:image;base64,'.$row['fprofile'].'" />';  ?>

							<p style="font-size: 15px;font-family: cursive;color: green;"><?php echo $row['ffname']." ".$row['flname'];?></p>


							<p style="font-size: 15px;font-family: cursive;color: green;"><?php echo $row['fuser'];?></p>
							</div>
							

							<?php
							 
						}
					}
					else{
						echo "NO friends yet";
					}
				}

?>