$(document).ready(function(){

$(".main_form").submit(function(){
$data=$(this).serialize();
var root_url=$("#root_url").val();
var url=$(this).attr('action');
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
	      $("#msg_box").append("<div class='alert alert-success'>Customer Updated.</div>");
	      $('.main_form')[0].reset();
	      var hdn_val=$(".hidden_val2").val();
	      loadProducts(hdn_val);
	    }else if(data.reply=="20"){
	      $("#msg_box").html('');  
	      $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
	      $('.main_form')[0].reset();
	    }	
	    }
	});
return false;
});

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

loadProducts("1");
// var root_url=$("#root_url").val();
// var url=root_url+"Customers_edit/load_pages"
// $.ajax({
//     type:'post',
//     url:url,
//     dataType:'html',
//     beforeSend:function(){      
//     },
//     success:function(data){
//      $(".pagination").append(data);
//     }
// });

function loadProducts(page)
{

var root_url=$("#root_url").val();
var url=root_url+"Substore_edit/load_pages";
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
var url=root_url+"Substore_edit/edit_load";
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
	      $(".ed_val_7").val(data.val_7);
	      $(".ed_val_8").val(data.val_8);
	      $(".ed_val_9").val(data.val_9);
	      $(".ed_val_10").val(data.val_10);
	      $(".ed_val_11").val(data.val_11);
	      $(".ed_val_12").val(data.val_12);
	      $(".ed_val_13").val(data.val_13);
	      $(".hidden_val1").val(data.val_14);
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
var url=root_url+"Substore_edit/delete";
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

});
