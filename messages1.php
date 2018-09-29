<?php
	session_start();
	if(!isset($_SESSION['username']))
	{
		header("Location:login.php");

	}
	else{

		?>	
			
			<style type="text/css">
				button:hover{
					cursor: pointer;
				}
				form{
					  
					 position: fixed;
					  bottom: -15;
					  width: 100%;
					}
			</style>	
			<center>
			<div style="background: #DAF7A6  ; width:100%;height: 100px;">
				<div style="position: fixed;top: 0;overflow: hidden;background:#DAF7A6;width: 100% ">
				<div style="display: inline-block;float: left;">
					<a href="search.php"><button style="font-size: 45px;border:none;background:#DAF7A6;  " >&#9754;</button></a>
				</div>
				
				<?php

					echo '<img style="width:80px; height:80px;  border-radius:40px;margin-left: 10px;margin-top: 10px" src="data:image;base64,'.$_SESSION['fprofile'].'" />'; 
				 ?>

				
				<div style="display: inline-block;margin-bottom: 50px">
						<p  style="margin-left: 50px;font-size: 20px;font-family: verdana;color: #581845;margin-top: 20px;"><?php echo $_SESSION['ffname']." ".$_SESSION['flname']; ?></p>
						<i  style="margin-left: 50px;font-size: 15px;font-family: Georgia;color: #581845;margin-top: 20px;"><?php echo $_SESSION['femail']; ?></i>
				</div>	
				</div>	
					<br><br><br><br><br><br><br><br>
			<?php
			
			$own=$_SESSION['username'];
			$other=$_SESSION['femail'];
			$otherfname=$_SESSION['ffname'];
			$otherlname=$_SESSION['flname'];
			$db=mysqli_connect("localhost","root","","chatwith");
			$fetch=mysqli_query($db,"SELECT * FROM messages WHERE `sender`='$own' AND `recipent`='$other' OR `sender`='$other' AND `recipent`='$own' ORDER BY `id` ASC");
			
			if(mysqli_num_rows($fetch)>0)
			{
				while($m=mysqli_fetch_assoc($fetch))
				{
					if($m['sender']==$own)
					{
			
			?>
				<div style="background: #CACBCB;float: right ;border-radius: 3px;padding: 10px">
							<b style="color: blue;margin-left: 10px;">You</b>
							<br>
							<i style="margin-left: 10px"><?php echo $m['message']; ?></i><br>
							<p style="bottom: 0;float: right;"><?php echo $m['time']; ?></p>
				</div>
				<br><br><br><br><br><br><br>

			<?php
			}elseif($m['recipent']==$own)
			{
				?>


				<div style="background: #CACBCB;float: left ;border-radius: 3px;margin-left: 10px;padding-left: 10px;padding-right: 10px">
							<b style="color: blue;margin-left: 10px;"><?php echo $otherfname." ".$otherlname;?></b>
							<br>
							<i style="margin-left: 10px"><?php echo $m['message']; ?></i><br>

							<p style="bottom: 0;float: right;"><?php echo $m['time']; ?></p>
				</div>
				<br><br><br><br><br><br><br>

				<?php
			}

		}
		}

			
			
			}

			?>
			<div style="">
			<form method="post" action="messages1.php">
				<input style="width: 70%;height: 50px;float: left;font-size: 20px;padding: 10px" type="text" name="messagebox" placeholder="Enter your message....">
				<input style="width: 30%;height: 50px;float: left;" type="submit" name="sendbtn" value="SEND">
			</form>
			</div>
			
			<?php 

				if(isset($_POST['sendbtn']))
				{
					echo "<meta http-equiv='refresh' content='0'>";
					$db=mysqli_connect("localhost","root","","chatwith");
					$messagetosend=$_POST['messagebox'];
					$time=time();
					$own1=$_SESSION['username'];
					$other1=$_SESSION['femail'];
					if(!$messagetosend=="")
					{
					$send=mysqli_query($db,"INSERT INTO `messages` (`recipent`,`sender`,`message`,`time`) VALUES ('$other1','$own1','$messagetosend',NOW())");

					}

					else
					{
										}
					
				}

			?>

			</div>
		</center>
			
			
		
