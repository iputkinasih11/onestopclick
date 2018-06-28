<?php 

use yii\helpers\Html;
use yii\helpers\Url;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  	<title>Request Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="{site_url}/templates/css/font/lato/stylesheet.css" media="screen" />	
    <style type="text/css">
    body {margin: 0; padding: 0; min-width: 100%!important; font-family:'latoregular','sans-serif'; font-size:14px;background-color:#fff; color:#333; line-height:120%;; }
	#center-header {width: 826px; max-width: 826px;border-collapse: collapse;}  
	.table-body{padding:0px 0px 20px 0px;margin:0px;}
	.header{padding:20px 0px 20px 0px; text-align:center;}
	.content{padding:20px;}
	#center-cont {width:640px; max-width:640px;border-collapse: collapse;}
	.header-content{height:100%; width:auto;}
	
	@media only screen and (min-device-width: 601px) {
		.content {width: 600px !important;}/*A Fix for Apple Mail*/
	}
	
	@media only screen and (max-device-width: 640px) {
		#center-cont {width:80%; max-width:80%;}/*A Fix for Apple Mail*/
		#center-header {width:80%; max-width:80%;}/*A Fix for Apple Mail*/
		
		body{background-size:320px;}
	}
    </style>
</head>
<body yahoo bgcolor="#fff" style="background:  #fff; margin:0px; padding:0px; " >
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin:0px; padding:0px;"bgcolor="#E7F1FA">
             <tr style="padding: 0px; margin:0px;" >
                    <td style="padding: 0px; margin:0px;">
                    	<table id="center-header" align="center" cellpadding="0" cellspacing="0" border="0" width="826" style="width: 826px; max-width: 826px;border-collapse: collapse;margin-top:0px; padding:0px; ">
                        </table>
                    </td>
            </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding:20px 0px 20px 0px;margin:0 0 20px 0px;" class="table-body" bgcolor="#E7F1FA">
        <tr style="padding: 0px; margin:0px;" >
            <td style="padding: 0px; margin:0px;">
                <table id="center-cont" align="center" cellpadding="0" cellspacing="0" border="0" width="640" style="width: 640px; max-width: 640px;border-collapse: collapse;margin-top:0px; padding:0px; ">
                    <!-- <tr>
                        <td class="header" style="padding:20px 0px 20px 0px; text-align:center;" align="center" bgcolor="#E7F1FA">
                        	<a href="http://onestopclick.com/" style="display: block;background-color: #330a5d;width: 185px;margin: 0 auto;">
                        		<img src=<?php //echo Url::to("http://onestopclick.com/images/home/mitrais-logo.png"); ?> alt="" style="width: 100%;height: auto;padding: 20px;" />
                        	</a>
                        </td>
                    </tr> -->
                    <tr>
                    	<td class="content"  bgcolor="#fff" style="padding:10px 20px 20px 20px;font-size: 16px;line-height: 160%; background:#fff; color:#333;">
                        	<p>Dear <?php echo $name;?>,</p>
                        	<h2>Forgot your password?</h2>
                        	<p>Let's get you a new one.We got a request to change the password for the account with the email <?php echo $email;?></p>
                        	<p>If you don't want to reset your password, you can ignore this email.</p>
                        	<p><a href="<?php echo $link ;?>">Link Reset Password</a></p>
                        </td>
                    </tr>
                    <tr class="footer"  bgcolor="#fff" style="border-top: solid 5px #E7F1FA; color:#545454;">
                    	<td bgcolor="#eee" style="background:#fff;">
                        	<table id="conten-footer" align="center" style="background:#fff;">
                            	<tr><td style="padding: 20px 0 10px 0;text-align: center;font-size:16px; font-weight:bold;">Connect with us</td></tr>
                                <tr>
                                	<td style="padding:0 0 0 0;" align="center">
                                    	<table id="icon-medsos" cellpadding="0" cellspacing="0" border="0">
                                        	<tr>
                                            	<td style="padding: 5px;">
                                                    <a href="http://facebook.com">
                                                    	<i class=" fa fa-facebook"></i>
                                                    </a>   
                                                </td>
                                                <td style="padding: 5px;">
                                                    <a href="http://twitter.com">
                                                    	<i class=" fa fa-twitter"></i>
                                                    </a>   
                                                </td>
                                                <td style="padding: 5px;">
                                                    <a href="http://instagram.com">
                                                    	<i class=" fa fa-instagram"></i>
                                                    </a>   
                                                </td>
                                                <td style="padding: 5px;">
                                                    <a href="http://instagram.com">
                                                    	<i class=" fa fa-linkedin"></i>
                                                    </a>   
                                                </td>
                                                <td style="padding: 5px;">
                                                    <a href="http://plus.google.com/">
                                                    	<i class=" fa fa-google-plus"></i>
                                                    </a>   
                                                </td>
                                            </tr>
                                        </table>
                                	</td>
                                </tr>
                                <tr>
                                	<td style="padding:20px 0 20px 0; text-align:center; font-size:14px;">
                                    	<table cellpadding="0" cellspacing="0" border="0">
                                        	<tr>
                                            	<td style="padding:0px 5px 0px 5px;border-right:solid 1px #000;">+62 361 8497952</td>
                                                <td style="padding:0px 5px 0px 5px;border-right:solid 1px #000;"><a style="color:#000; text-decoration:none;" href="mailto:info@mitrais.com">info@mitrais.com</a> </td>
                                                <td style="padding:0px 5px 0px 5px;"><a style="color:#000; text-decoration:none;" href="http://onestopclick.com/">onestopclick.com</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                         
                        </td>
                    </tr>                    
                </table>                
            </td>
        </tr>
    </table>
</body>
</html>