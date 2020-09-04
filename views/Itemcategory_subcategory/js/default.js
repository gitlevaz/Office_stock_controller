$(document).ready(function(){

var root_url=$("#root_url").val();
$(".category_form").submit(function(){
var url=$(this).attr('action');
var formData=$(this).serialize();
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
      $("#msg_box").append("<div class='alert alert-success'>New Category Created.</div>");
      $('.category_form')[0].reset();
    }else if(data.reply=="20"){
      $("#msg_box").html('');  
      $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
      $('.category_form')[0].reset();
    }
    }
});
return false;
});
});

