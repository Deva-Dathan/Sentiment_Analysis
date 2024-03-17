<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
include("db_connection.php");
$name = $_POST['u_name'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$verifypw = md5($_POST['verifypassword']);

if($password == $verifypw)
{
$sql = "INSERT INTO users (u_name, u_username, u_password, u_role) VALUES ('$name', '$username', '$password', 'Logined User')";

if ($conn->query($sql) === TRUE) {
  $_SESSION['reg_success'] = "REGISTERATION SUCCESSFULLY";
  header("Location:login_page.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
}
?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
    @media only screen and (max-device-width:540px) {
    	   .mobileLabel{
   text-align: left;
   }
   	 .mobilePad{
   margin-left: 4em;
   }
}
@media only screen and (max-device-width:750px) and
	(orientation:landscape) {
.mobileLabel{
   text-align: left;
   }
    .mobilePad{
   margin-left: 11%;
   }
	}
		.boxStyle{
margin-left: 20%;width: 60%;
}

</style>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 boxStyle" style="padding-right: 0px!important;padding-left: 0px!important;">
		   <div class="panel-body" style="padding-right: 4px!important;padding-left: 4px!important;">
                 <form method="post"  class="form-horizontal" role="form">
				<fieldset class="landscape_nomargin" style="min-width: 0;padding: .35em .625em .75em!important;margin:0 2px;border: 2px solid silver!important;margin-bottom: 10em;">
			<legend style="border-bottom: none;width: inherit;!important;padding:inherit; font-weight:bold;" class="legend">REGISTRATION FORM</legend>
		
			<div class="form-group">
						 <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="text-align: right!important;">
						 <span style="color: red">*</span> <span style="font-size: 8pt; font-weight:bold;">mandatory fields</span>
						 </div>
						</div>	
			 <div class="form-group" style="margin-bottom: 0px;">
                    <div class="col-sm-4 col-md-4 col-lg-5 col-xs-1"></div><div class="col-sm-8 col-md-8 col-lg-7 col-xs-10 mobilePad" id="message10" style=" font-size: 10pt;padding-left: 0px;"></div>                      

                    </div>				
		 <div class="form-group">
                     <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
                       <div class="col-sm-3 col-md-3 col-lg-4 col-xs-10 mobileLabel" style=" padding-top: 7px; text-align: right;">
                            Full Name<span style="color: red">*</span> :</div>
                        
						<div class="col-sm-7 col-md-7 col-lg-6 col-xs-9 input-group mobilePad" style="font-weight:600;">
						
						<input style="border-radius: 4px!important;" type="text"  class="form-control" name="u_name">                   
                                         
                        </div>
                       <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
                    </div>
         <div class="form-group">
                     <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
                       <div class="col-sm-3 col-md-3 col-lg-4 col-xs-10 mobileLabel" style=" padding-top: 7px; text-align: right;">
                            Your Email <span style="color: red">*</span> :</div>
                        
						<div class="col-sm-7 col-md-7 col-lg-6 col-xs-9 input-group mobilePad" style="font-weight:600;">
						
						<input style="border-radius: 4px!important;" type="email"  class="form-control" name="username">                   
                                         
                        </div>
                       <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
                    </div>  
        <div class="form-group " style="margin-bottom: 5px;">
                     <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
                       <div class="col-sm-3 col-md-3 col-lg-4 col-xs-10 mobileLabel" style=" padding-top: 7px;text-align: right;">
                          Your Password <span style="color: red">*</span> :</div>
                        
						<div class="col-sm-7 col-md-7 col-lg-6 col-xs-9 input-group mobilePad">
						
						<input type="password" name="password" id="password" class="form-control">                
                                      
                        </div>
                         <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
                        
                    </div>  
                 <div class="form-group" style="margin-bottom: 5px;">
                    <div class="col-sm-4 col-md-4 col-lg-5 col-xs-1"></div><div class="col-sm-8 col-md-8 col-lg-7 col-xs-10 mobilePad" id="message8" style=" font-size: 10pt;padding-left: 0px;"></div>                      

                    		<div class="col-sm-4 col-md-4 col-lg-5 col-xs-1"></div><div class="col-sm-8 col-md-8 col-lg-7 col-xs-10 mobilePad" id="message" style=" font-size: 10pt;"></div>
							<div class="col-sm-4 col-md-4 col-lg-5 col-xs-1"></div><div class="col-sm-8 col-md-8 col-lg-7 col-xs-10 mobilePad" id="message2" style=" font-size: 10pt;"></div>
							<div class="col-sm-4 col-md-4 col-lg-5 col-xs-1"></div><div class="col-sm-8 col-md-8 col-lg-7 col-xs-10 mobilePad" id="message3" style=" font-size: 10pt;"></div>
							<div class="col-sm-4 col-md-4 col-lg-5 col-xs-1"></div><div class="col-sm-8 col-md-8 col-lg-7 col-xs-10 mobilePad" id="message4" style=" font-size: 10pt;"></div>
							<div class="col-sm-4 col-md-4 col-lg-5 col-xs-1"></div><div class="col-sm-8 col-md-8 col-lg-7 col-xs-10 mobilePad" id="message5" style=" font-size: 10pt;"></div> 
							<div class="col-sm-4 col-md-4 col-lg-5 col-xs-1"></div><div class="col-sm-8 col-md-8 col-lg-7 col-xs-10 mobilePad" id="message6" style=" font-size: 10pt;padding-left: 0px;"></div>
							<div class="col-sm-4 col-md-4 col-lg-5 col-xs-1"></div><div class="col-sm-8 col-md-8 col-lg-7 col-xs-10 mobilePad" id="message7" style=" font-size: 10pt;padding-left: 0px;"></div>                      
       
                    </div>
                  <div class="form-group">
                     <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
                       <div class="col-sm-3 col-md-3 col-lg-4 col-xs-10 mobileLabel" style=" padding-top: 7px;text-align: right;">
                          Confirm Your Password <span style="color: red">*</span> :</div>
                        
						<div class="col-sm-7 col-md-7 col-lg-6 col-xs-9 input-group mobilePad">
						
						<input type="password" name="verifypassword" id="verifypassword" class="form-control">                   
                                         
                        </div>
                       <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
                    </div>	
         <div class="form-group">
                     <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" id="message1" style="font-weight: bold; text-align: center;font-size: 10pt;">
						</div>
						 </div>	            
        <div class="form-group">
									<div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
									<div class="col-sm-11 col-md-11 col-lg-11 col-xs-10" style="text-align:center;">
										<button id="valuser" type="submit" class="btn btn-success">Register</button>
									</div>

									<div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"></div>
								</div>   
			</fieldset>
		
				</form>
                </div>
		    </div>
		    
	</div>
</div>
