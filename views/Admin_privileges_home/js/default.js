$(document).ready(function(){
	var root_url=$("#root_url").val();
	function load(){
	$.ajax({
	type:'post',
	url:root_url+'Admin_privileges_home/load',
	dataType:'html',
	success:function(redata){
	$('#profile_list').html("");
	$('#profile_list').append(redata);
	}
	});	
}

$("#form_privileges").submit(function(){
  var formData=$(this).serialize();
  var url=$(this).attr('action');
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
               $("#msg_box").append("<div class='alert alert-success'>New Profile Created.</div>");
               load()
              }else if(data.reply=="20"){
               $("#msg_box").html('');  
               $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
              }
            }
	});
	return false;
    });

 $("#profile_list").on('click','.profile_remove',function(){
    var root_url=$("#root_url").val();
    var url=root_url+'Admin_privileges_home/remove';
 	var ids=$(this).attr('id');
	$.ajax({
            type:'post',
            url:url,
            data:{id:ids},
            dataType:'json',
            beforeSend:function(){
             $("#msg_box").html("");
             $("#msg_box").html("<img src='public/images/loading.gif'>");        
            },
            success:function(data){
              if(data.reply=="10"){
               $("#msg_box").html('');
               $("#"+data.id).remove();
               load();
              }else if(data.reply=="20"){
               $("#msg_box").html('');  
               $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
              }
            }
	});
 });

load();
});