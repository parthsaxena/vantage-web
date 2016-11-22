<?php

	$conn =	mysqli_connect("scapter.org", "root", "rroot451", "pinder");
	if (!$conn) {
		 echo "Unable to establish connection to database. " . mysqli_connect_errno();
		 exit;
	}

	//echo "Connection Established.";

?>

<html>
    
    <head>
        <title></title>
        <script src="https://use.fontawesome.com/852b08afe2.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    </head>
    
    <body bgcolor="#F5F5F5">
        <!-- Header -->
        

            <center>
                <ul>
                    <center>
                    
                    <center>
                    <div style="margin-left: 50px;">
                    <li> 
                        <table style="">
                        <tr>
                            <td><a class="active" href="#home"><img src="../images/hlogo.png" height="35"></a>
                        </td>
                            <td><input type="text" style="border-radius: 5px; height: 40px; width: 200%; border-left: 1px solid #CCC; border-top: 1px solid #CCC; border-bottom: 1px solid #CCC; border-right: 1px solid #CCC; padding-left: 15px; font-family: Roboto; font-size: 15px; background-color: #F5F5F5; color: black;" placeholder="Search..."></td>
                        </tr>
                    </table>
                        </li>
                    </div>
                    <div style="position: relative; top: 15px; float: right; margin-right: 70px;">
                    <li><a href=""><i class="fa fa-home" aria-hidden="true" style="font-size: 1.5em;"></i> Feed</a></li>
                    <li><a href=""><i class="fa fa-bell" aria-hidden="true" style="font-size: 1.5em;"></i> Notifications</a></li>
                    <li><a id="chat"><i class="fa fa-weixin" aria-hidden="true" style="font-size: 1.5em;"></i> Chat</a></li>
                    <li><a href=""><i class="fa fa-user" aria-hidden="true" style="font-size: 1.5em;"></i> Your Profile</a></li>
                    <!--<li>
                        
<button id="hide">Hide</button>
<button id="show">Show</button>

                    </li>-->
                        </div>
                        </center>
                    </center>
                    
                </ul>
                <script>
            
            $(function() {
                $('#draggable').draggable({ iframeFix: true });
            });
        </script>