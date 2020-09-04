$(document).ready(function(){
var root_url=$("#root_url").val();
$(".user_form").submit(function(){
	var formData=$(this).serialize();
	var url=$(this).attr('action');
	var password=$("#password").val();
	var conf_pass=$("#conf_password").val();
	if(password.length<6){
		$("#msg_box").html('');
		$("#msg_box").append("<div class='alert alert-warning'>Password must be at least 6 characters long.</div>");
	return false;
	}

	if(password==conf_pass){
$.ajax({
            type:'post',
            url:url,
            data:formData,
            dataType:'json',
            beforeSend:function(){
             $("#msg_box").html("");
             $("#msg_box").html("<img src='public/images/loading.gif'>");        
            },
            success:function(data){
              if(data.reply=="10"){
               $("#msg_box").html('');  
               $("#msg_box").append("<div class='alert alert-success'>New User Created.</div>");
               $('.user_form')[0].reset();
              }else if(data.reply=="20"){
               $("#msg_box").html('');  
               $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
               $('.user_form')[0].reset();
              }
            }
});
return false;
	}else{
		$("#msg_box").html('');
		$("#msg_box").append("<div class='alert alert-warning'>Confirm password does not match.</div>");
		return false;
	}

});
});