$(document).ready(function(){

    $('.pagin').on('click','.active',function(){
        var page = $(this).attr('p');
        loadProducts(page);      
    });           
    $('.pagin').on('click','#go_btn',function(){
        var page = parseInt($('.goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if(page != 0 && page <= no_of_pages){
            loadProducts(page);
        }else{
            alert('Enter a PAGE between 1 and '+no_of_pages);
            $('.goto').val("").focus();
            return false;
        }
    });

loadusers("1");

function loadusers(page)
{

var root_url=$("#root_url").val();
var url=root_url+"Admin_users_edit/loadusers";
  var startnumber = $("#startnumber").html();
  var limitnumber = $("#limitnumber").html();
  $.ajax({
    type:'post',
    cache:'false',
    url: url,
    data : "page="+page,
    dataType:'html',
    success:function(data){
            if(data){
        $('.pagin').html(data);
        // $("#startnumber").html(parseInt(startnumber)+parseInt(limitnumber));
      }
    }
  });
}


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
               $("#msg_box").append("<div class='alert alert-success'>User Updated.</div>");
               $('.user_form')[0].reset();
              }else if(data.reply=="20"){
               $("#msg_box").html('');  
               $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
               $('.user_form')[0].reset();
              }else if(data.reply=="30"){
               $("#msg_box").html('');  
               $("#msg_box").append("<div class='alert alert-danger'>Check old password.</div>");  
               $('#old_password').val(''); 
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

// edit function
$(".pagin").on('click','.btn_edit',function(){
var root_url=$("#root_url").val();
var url=root_url+"Admin_users_edit/edit_load";
var id=$(this).attr('id');
  $.ajax({
    type:'post',
    url: url,
    data : "eid="+id,
    dataType:'json',
      beforeSend:function(){
     $("#msg_box").html("");
      $("#msg_box").html("<img src='public/images/loading.gif'>");         
      },
    success:function(data){
     if(data){
       if(data.reply=="10"){
        $("#msg_box").html('');  
        $(".ed_val_1").val(data.val_2);
        $(".ed_val_2").val(data.val_6);
        $(".ed_val_3").val(data.val_7);
        $(".ed_val_4").val(data.val_3);
        $(".ed_val_x").val(data.val_1);
      }else if(data.reply=="20"){
        $("#msg_box").html('');  
        $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
      }
    }else{
        $("#msg_box").html('');  
        $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
    }
      }
  });
return false;
});
//end of edit function

});
