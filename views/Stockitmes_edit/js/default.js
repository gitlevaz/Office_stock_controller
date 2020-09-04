
$(document).ready(function(){
$(".form_main").submit(function(){
$data=$(this).serialize();
var root_url=$("#root_url").val();
var url=$(this).attr('action');
val=$('.itme_code').val();
ckeckcode(val);
	$.ajax({
		type:'post',
		url: url,
		data : $data,
		dataType:'json',
	    beforeSend:function(){
     	$("#msg_box").html("");
      	$("#msg_box").html("<img src='public/images/loading.gif'>");         
	    },
	    success:function(data){
	     if(data.reply=="10"){
	      $("#msg_box").html('');  
	      $("#msg_box").append("<div class='alert alert-success'>Item Updated.</div>");
	      $('.form_main')[0].reset();
	      var hdn_val=$(".hidden_val2").val();
	      loadProducts(hdn_val);
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

    $('.pagin').on('click','.active',function(){
		
		var page = $(this).attr('p');
			// console.log(page);
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
 
loadProducts("1");


function loadProducts(page)
{

var root_url=$("#root_url").val();
var url=root_url+"Stockitmes_edit/load_pages";
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

// edit function
$("#container").on('click','.btn_edit',function(){
var root_url=$("#root_url").val();
var url=root_url+"Stockitmes_edit/edit_load";
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
	      $(".ed_val_1").val(data.val_1);
	      $(".ed_val_2").val(data.val_2);
	      $(".ed_val_3").val(data.val_3);
	      $(".ed_val_4").val(data.val_4);
	      $(".ed_val_5").val(data.val_5);
	      $(".ed_val_6").val(data.val_6);
	      load_subcats(data.val_6,data.val_7);
          $(".ed_val_7").val(data.val_7);
	      $(".ed_val_8").val(data.val_8);
	      $(".ed_val_9").val(data.val_9);
	      $(".ed_val_10").val(data.val_10);
	      $(".ed_val_11").val(data.val_11);
	      $(".ed_val_12").val(data.val_13);
	      $(".ed_val_13").val(data.val_14);
	      $(".ed_val_14").val(data.val_15);
	      $(".hidden_val1").val(data.val_12);
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
$("#container").on('click','.btn_delete',function(){
var root_url=$("#root_url").val();
var url=root_url+"Stockitmes_edit/delete";
var id=$(this).attr('id');
confirm_function();
function confirm_function() {
 var r = confirm("Are you Sure !");
 if (r == true) {
$.ajax({
	type:'post',
	url:url,
	data:{did:id},
	dataType:'json',
	beforeSend:function(){
     $("#msg_box").html("");
      $("#msg_box").html("<img src='public/images/loading.gif'>");         
	},
	success:function(data){
		 if(data){
	     if(data.reply=="10"){
	      $("#msg_box").html('');  
	      $("#msg_box").append("<div class='alert alert-danger'>Deleted.</div>");  
	      var hdn_val=$(".hidden_val2").val();
	      loadProducts(hdn_val);
	     }
	     else if(data.reply=="20"){
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
}else{

}
}

});


$("#category").change(function(){
var val = $( "#category option:selected" ).val();
load_subcats(val);
});

function load_subcats(cat,vx){
var root_url=$("#root_url").val();
var url=root_url+"Stockitmes_edit/load_subcats";
var val = cat;
$.ajax({
  type:'post',
  url:url,
  cache:'false',
  data:{id:val,vv:vx},
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
}

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
var url=root_url+"Stockitmes_edit/check_itmcode";
val=vv;
val2=$('.hidden_val1').val();
$.ajax({
  type:'post',
  url:url,
  cache:'false',
  data:{code:val,id:val2},
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

$('.search_key').on('keyup',function(){
	var page='1';
	var root_url=$("#root_url").val();
	var url=root_url+"Stockitmes_edit/search_key";
	var val = $( ".search_key" ).val();
	$.ajax({
	  type:'post',
	  url:url,
	  cache:'false',
	  data:{keys:val,page:page},
	  dataType:'html',
	  beforeSend:function(){
	     $("#msg_box").html("");
	      $("#msg_box").html("<img src='public/images/loading.gif'>");  
	  },
	  success:function(data){
	    $("#msg_box").html("");
	    $('.pagin').html(data);
	  }
	});
});

});
