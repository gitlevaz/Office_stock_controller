$(document).ready(function(){
var root_url=$("#root_url").val();
	$("#form_login").submit(function(){
    var formData=$(this).serialize();
		$.ajax({
            type:'post',
            url:root_url+'home/logIn',
            data:formData,
            dataType:'json',
            beforeSend:function(){
             $("#msg_box").html("");
             $("#msg_box").html("<img src='public/images/loading.gif'>");        
            },
            success:function(data){
              if(data.reply=="10"){
                 window.location.replace(root_url+'Home_dashboard');
              }else if(data.reply=="20"){
               $("#msg_box").html('');  
               $("#msg_box").append("<div class='alert alert-danger'>The user name or password is incorrect.Try again.</div>");  
              }
            }
		});
		return false;
	});
});