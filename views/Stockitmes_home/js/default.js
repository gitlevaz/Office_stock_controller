$(document).ready(function(){

var root_url=$("#root_url").val();
$(".form_main").submit(function(){
var url=$(this).attr('action');
var formData=$(this).serialize();
val=$('.itme_code').val();
ckeckcode(val);
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
      $("#msg_box").append("<div class='alert alert-success'>New Itme Created.</div>");
      $('.form_main')[0].reset();
    }else if(data.reply=="20"){
      $("#msg_box").html('');  
      $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
      $('.form_main')[0].reset();
    }
    }
});
return false;
});

$(".issueas").on('change',function(){
var x=$('.issueas').val();
if(x=='' || x==''){
$(".qty_in").prop('required',false);  
}else{
$(".qty_in").prop('required',true);
}

var xx=$('.unit_in').val();
var y=$('.issueas').val();
$('.qty_in').attr('placeholder', y+' in 1 '+xx);

});

$(".unit_in").on('change',function(){
var x=$(this).val();
var y=$('.issueas').val();
$('.qty_in').attr('placeholder', y+' in 1 '+x);
});

$("#category").change(function(){
var root_url=$("#root_url").val();
var url=root_url+"Stockitmes_home/load_subcats";
var val = $( "#category option:selected" ).val();
$.ajax({
  type:'post',
  url:url,
  cache:'false',
  data:{id:val},
  dataType:'html',
  beforeSend:function(){
     $("#msg_box").html("");
      $("#msg_box").html("<img src='public/images/loading.gif'>");  
  },
  success:function(data){
         $("#msg_box").html("");
    $('#subcategory').html(data);
  }
});
});

$('.itme_code').on('keyup',function(){
val=$(this).val();
ckeckcode(val);
});
$('.itme_code').on('change',function(){
val=$(this).val();
ckeckcode(val);
});

function ckeckcode(vv){
 var root_url=$("#root_url").val();
var url=root_url+"Stockitmes_home/check_itmcode";
val=vv;
$.ajax({
  type:'post',
  url:url,
  cache:'false',
  data:{code:val},
  dataType:'json',
  beforeSend:function(){
     // $("#msg_box").html("");
     //  $("#msg_box").html("<img src='public/images/loading.gif'>");  
  },
  success:function(data){
    //$("#msg_box").html("");
    if(data.reply==10){
      $('.itme_code').val('');
      return false;
    }else if(data.reply==" " || data.reply=="20"){
    //$("#msg_box").html("");
    }
  }
}); 
}

});

