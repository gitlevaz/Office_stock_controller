<!DOCTYPE html>
<?php
$check=0;
$ex=$_GET['url'];
if($ex=='visitorProfile' || $ex=='messages' || $ex=='apply' || $ex=='accountSetting' || $ex=='updateProfile' || $ex=='supportDocument' || $ex=='accountCancel' || $ex=='dashBoard' || $ex=='manageApplicant' || $ex=='product' || $ex=='exchangeRate' || $ex=='newsUpdate'){
 $check='1'; 
}
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Medical center</title>

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Sanchez' rel='stylesheet' type='text/css'>
<!-- css -->
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="<?php echo ROOT;?>public/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo ROOT;?>public/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo ROOT;?>public/css/layout.css">
<link rel="stylesheet" type="text/css" href="<?php echo ROOT;?>public/css/icons.css">
<link rel="stylesheet" type="text/css" href="<?php echo ROOT;?>public/css/parsley.css">
<link rel="stylesheet" href="<?php echo ROOT;?>public/js/jquery_ui/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<!-- scripts -->
<script type="text/javascript" src="<?php echo ROOT;?>public/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo ROOT;?>public/js/custom.js"></script>
<script type="text/javascript" src="<?php echo ROOT;?>public/js/jquery.hoverIntent.js"></script>
<script type="text/javascript" src="<?php echo ROOT;?>public/js/jquery_ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo ROOT;?>public/js/parsley.js"></script>
<script type="text/javascript" src="<?php echo ROOT;?>public/js/jquery.number.js"></script>
<script src="<?php echo ROOT;?>public/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ROOT;?>views/common/js/common.js"></script>
<script src="<?php echo ROOT;?>views/common/js/jquery.barcode.0.3.js"></script>
<?php
          if(isset($this->js)){
            foreach ($this->js as $js) {
             echo '<script type="text/javascript" src="'.ROOT.'views/'.$js.'"></script>';
          }
        }
        ?>
<script type="text/javascript">
          $(function($) {

          var allWrappers = $('#reg_form div.data');
          var allWrapperItems = $('#reg_form #register');
          $('#reg_form > #register').click(function() {
            if($(this).hasClass('open'))
            {
              $(this).removeClass('open');
              $(this).next().slideUp("slow");
            }
            else
            {
            allWrappers.slideUp("slow");
            allWrapperItems.removeClass('open');
            $(this).addClass('open');
            $(this).next().slideDown("slow");
            return false;
            }
          });
        });
</script>
 
<!-- Scroll To Top -->
<script>
$(document).ready(function(){
        $("#log_out").on('click',function(){
          var url=$("#root_url").val();
          $.ajax({
            type:'post',
            url:url+'log_out/log_out',
            dataType:'json',
            success:function(data){
              window.location.replace(url+'home');
            }
          });
        });

$("#log_in_link").on('click',function(){
var ch=$('#login_cage').css('display');
if(ch=='none'){
//$("#login_cage").css('display','block');
$( "#login_cage" ).show(500);
$("#sign_up_cage").hide(500);
return false;
}else{
$("#login_cage").hide(500);  
}
});

$("#sign_up_link").on('click',function(){
var che=$('#sign_up_cage').css('display'); 
if(che=='none'){
$("#sign_up_cage").show(500);
$("#login_cage").hide(500);
return false;
}else{
$("#sign_up_cage").hide(500);  
}
});

});

</script>
 
</head>
<body>
<input type="hidden" value='<?php echo ROOT;?>' id='root_url'>
<!-- Header Section --> 

<!-- Logo -->
<div class="container-fluid">
    <header>
    <?php
// $serverIP = $_SERVER["SERVER_ADDR"];
// echo "Server IP is: <b>{$serverIP}</b>";
    ?>
    <img style="border-radius: 50%;" src="https://lh3.googleusercontent.com/-d0bJpXggrJg/AAAAAAAAAAI/AAAAAAAAAAA/kdvIE-C4Qrs/s39-p-k-no-ns-nd/photo.jpg" width="50"  height="45"><h2 style="color:white;">Wasantha Auto A/C</h2> </header>
