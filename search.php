<?php 
session_start();

?>

<style>
input[type=text], select {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=Password], select {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] {
    width: 30%;
    background-color: #6C2356;
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
</style>

<center>

        <div style="border-radius: 5px;background-color: #f2f2f2;width: 100%;height: 100%;">
         
        <div style="background: #AA9BC6;top: 0">
                        <b style="top:0;background:#AA9BC6 ;font-size: 65px;font-family: verdana;color: #C70039  ;position: fixed;overflow: hidden;width: 100%;float: left;left: 0">ChatWith</b>

          </div>
        <p style="font-size: 15px;font-family: cursive;color: green;margin-top: 20px; float: right"><?php echo $_SESSION['username']; ?></p>


        <br><br>
        <hr><br>
       <form method="post" action="search.php">

          <label style="font-size: 20px;font-family: cursive;color: green;margin-top: 20px;">Search your friends by their Email ID</label><br><br>
          <input name="searchfriend" type="text" placeholder="Friend's Email " /><br>
          <input type="submit" name="search" value="Search Friend">

        </form>
        <a href="home.php"><input type="submit" style="margin-top: 10px;border: none"  value="cancel"></a>

        <br>
            

            <?php 
            
              if(isset($_POST['search']))
              {
                 $db=mysqli_connect("localhost","root","","chatwith");
                $friend=$_POST['searchfriend'];
                $query="select * from user where email='$friend'";

                $run=mysqli_query($db,$query);
                 $num = mysqli_num_rows($run);
                  if($num>=1)
                  {
                      while ($data=mysqli_fetch_array($run))
                       {
                        $ffname=$data['fname'];
                        $_SESSION['ffname']=$ffname;
                        $flname=$data['lname'];
                        $_SESSION['flname']=$flname;
                        $femail=$data['email'];
                        $_SESSION['femail']=$femail;
                        $fprofile=$data['profile'];
                        $_SESSION['fprofile']=$fprofile;
                        $user2=$_SESSION['username'];
                        $w=mysqli_query($db,"SELECT * FROM friendss where user='$user2' AND fuser='$femail'");
                        $num=mysqli_num_rows($w);

                        $d=mysqli_query($db,"SELECT * FROM friendrequests1 where user='$femail' AND fruser='$user2' ");
                        $num1=mysqli_num_rows($d);
                        if($femail==$user2)
                        {
                          ?>
                            <div style="background: #DAF7A6;padding: 15px;font-family: monospace;font-size: 20px">
                           <?php
                          echo '<img style="float:left;margin-top:20px;margin-left:50px;width:150px;height:150px;border-radius:75px" src="data:image;base64,'.$_SESSION['profile'].'" />'; 
                

                        ?>

                          <p style="margin-right: 100px;font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;"><?php 
                        echo $_SESSION['fname']." ".$_SESSION['lname'];?></p>
                        <p  style="margin-right: 100px;font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;"><?php
                        echo $_SESSION['username']; ?></p><br><br><br></div>
                        <?php
                        }
                        else
                        {

                         if($num==0 AND $num1>=1)
                     {

                          ?><div style="background: #DAF7A6;padding: 15px;font-family: monospace;font-size: 20px"><br>

                         
                                       <?php
              $db=mysqli_connect("localhost","root","","chatwith");
                $display=mysqli_query($db,"SELECT `profile` FROM `user` where email='$femail'");
                while($data=mysqli_fetch_assoc($display))
                {
                echo '<img style="float:left;margin-top:20px;margin-left:50px;width:150px;height:150px;border-radius:75px" src="data:image;base64,'.$data['profile'].'" />'; 
                }

             ?>

                          <p style="margin-right: 100px;font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;"><?php 
                        echo $ffname." ".$flname;?></p>
                        <p  style="margin-right: 100px;font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;"><?php
                        echo $femail;?></p><br>
                        <form style="margin-left: 10px" method="post" action="search.php">
                          <input type="submit" name="friendrequestsent" value="Friend Request Sent " >
                          <input type="submit" name="cancel" value="Cancel" >
                        </form>
                        
                      </div>

                        <?php


                       }


                        if($num>=1 )
                        {
                        ?><div style="background: #DAF7A6;padding: 15px;font-family: monospace;font-size: 20px"><br>

                                     <?php
              $db=mysqli_connect("localhost","root","","chatwith");
              $ademail=$_SESSION['femail'];
                $display=mysqli_query($db,"SELECT `profile` FROM `user` where email='$ademail'");
                while($data=mysqli_fetch_assoc($display))
                {
                 echo '<img style="float:left;margin-top:20px;margin-left:50px;width:150px;height:150px;border-radius:75px" src="data:image;base64,'.$data['profile'].'" />'; 
                }

                

             ?>


                          <p style="margin-right: 150px;font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;"><?php 
                        echo $ffname." ".$flname;?></p>
                        <p  style="margin-right: 150px;font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;"><?php
                        echo $femail;?></p><br>
                        <form style="margin-right: 150px" method="post" action="search.php"><input type="submit" name="message" value="Message"></form>
                        
                      </div>

                        <?php

                       }
                       elseif($num<1 AND $num1<1)
                       {
                          ?><div style="background: #DAF7A6;padding: 15px;font-family: monospace;font-size: 20px"><br>


                          <?php
                                                    
                                  $db=mysqli_connect("localhost","root","","chatwith");

                                $display2=mysqli_query($db,"SELECT `profile` FROM `user` WHERE email='$femail' ");
                                while($data2=mysqli_fetch_assoc($display2))
                                {
                                  
                                  echo '<img style="float:left;margin-top:20px;margin-left:50px;width:150px;height:150px;border-radius:75px"  src="data:image;base64,'.$data2['profile'].'" />'; 
                                
                                }
                           ?>

                          <p style="margin-right: 130px;font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;"><?php 
                        echo $ffname." ".$flname;?></p>
                        <p  style="margin-right: 130px;font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;"><?php
                        echo $femail;?></p><br>
                        <form style="margin-right: 130px;" method="post" action="search.php"><input type="submit" name="add" value="Add Friend"></form>
                        
                      </div>

                        <?php

                       }
                       header("Location:search.php");
                     }
                       
                    
              }


            }
            else{ echo "No Matches Found !";}
          }
            
         ?>
         <?php
         if(isset($_POST['add']))
         {
          
          $db=mysqli_connect("localhost","root","","chatwith");
          $addfname=$_SESSION['fname'];
          $addlname=$_SESSION['lname'];
          $addemail=$_SESSION['username'];
          $recipent=$_SESSION['femail'];
          $prof=mysqli_query($db,"SELECT profile FROM user WHERE email='$addemail'");
          if(mysqli_num_rows($prof)>0)
          {
            while($pro=mysqli_fetch_assoc($prof))
            {
              $addprofile=$pro['profile'];
            }
          }
          
          $q=mysqli_query($db,"INSERT INTO `friendrequests1` (`user`, `fruser`, `frfname`, `frlname`, `frprofile` ) VALUES ('$recipent', '$addemail', '$addfname', '$addlname', '$addprofile')");
         
          if($q)
          {

            ?><script type="text/javascript">alert("Friend Request Sent!");</script><?php
          }
          else
          {
            ?><script type="text/javascript">alert("Couldn't add!");</script><?php
          }
         
         }
         
         if(isset($_POST['cancel']))
         {
          ?>
          <script type="text/javascript">
            alert("Are you sure ?");
          </script>
          <?php
          $adprofile=$_SESSION['fprofile'];
          $adfemail=$_SESSION['femail'];
          $aduser=$_SESSION['username'];
          $db=mysqli_connect("localhost","root","","chatwith");
            $cancel=mysqli_query($db,"DELETE FROM `friendrequests1` WHERE `user`='$adfemail' AND `fruser`='$aduser'");
            if($cancel){?><script type="text/javascript">alert("cancelled !");</script><?php }
          ?>
          <div style="background: #DAF7A6;padding: 15px;font-family: monospace;font-size: 20px"><br>

                          <?php
              $db=mysqli_connect("localhost","root","","chatwith");
              $bc=$_SESSION['femail'];
                $display=mysqli_query($db,"SELECT `profile` FROM `user` where email='$bc'");
                while($data=mysqli_fetch_assoc($display))
                {
                echo '<img style="float:left;margin-top:20px;margin-left:50px;width:150px;height:150px;border-radius:75px" src="data:image;base64,'.$data['profile'].'" />'; 
                }

             ?>

                          <p style="margin-right: 100px;font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;"><?php 
                        echo $_SESSION['ffname']." ".$_SESSION['flname'];?></p>
                        <p  style="margin-right: 100px;font-size: 20px;font-family: cursive;color: #581845;margin-top: 20px;"><?php
                        echo $_SESSION['femail'];?></p><br>
                        <form style="margin-left: 10px" method="post" action="search.php"><input type="submit" name="add" value="Add Friend"></form>
                        
                      </div>

          <?php

        }
         ?>

         <?php

            if(isset($_POST['message']))
            {
              $mprofile=$_SESSION['fprofile'];
              $msgfname=$_SESSION['ffname'];
              $msglname=$_SESSION['flname'];
              $msguser=$_SESSION['femail'];

             header("Location:messages1.php");
              
            }

         ?>

        </div>
</center>
     
   			