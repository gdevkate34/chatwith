<?php
session_start();

if(!isset($_SESSION['username']))
{
	header("Location:login.php");
}
else
{
	?>
	<center>
		<div style="border-radius: 5px;background-color: #f2f2f2;width: 700px;height: 500px;border:none">

                    <iframe style="width: 600px;height: 1500px;" src="messages1.php">
                      	
                    	


                    </iframe>

       </div>
    </center>
	
	<?php

}
?>