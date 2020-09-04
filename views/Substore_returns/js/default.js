$(document).ready(function(){
$(".form_sub").submit(function(){

if($('.val_8').val()<=0){

}else{
$("#maintabletop").after("<tr class='grn_rows'><input type='hidden' class='val_20' name='"+$('.val_2 option:selected').val()+"' value='"+$('.val_2 option:selected').text()+"_"+$('.val_3').val()+"_"+$('.val_4').val()+"_"+$('.val_5').val()+"_"+$('.val_8').val()+"'><td>"+$('.val_1').val()+"</td><td>"+$('.val_2 option:selected').text()+"</td><td>"+$('.val_3').val()+"</td><td>"+$('.val_4').val()+"</td><td>"+$('.val_5').val()+"</td><td class='totalsub number_format'>"+$('.val_8').val()+"</td><td><input type='hidden' class='hidden_sum' value="+$('.val_8').val()+"><button type='button' class='btn btn-danger rm_btn'>Remove</button></td></tr>");
				$('.val_1').val('');
				$('.val_2').val('');
				$('.val_3').val('');
				$('.val_4').val('');
				$('.val_5').val('');
				$('.val_6').val('');
				$('.val_7').val('');
				$('.val_8').val('');
				$(".val_3").prop("readonly", true);
				$(".val_4").prop("readonly", true);	
cal_total();
}
return false;
});


// save issuenote
var $selector = $('.form_main'),
form = $selector.parsley();

form.subscribe('parsley:form:success', function (e) {
	var data=$('.form_main').serialize();
			var root_url=$("#root_url").val();
			var url=root_url+"Substore_returns/save_main";
	$.ajax({
	type:'post',
	url:url,
	data:data,
	dataType:'json',
	beforeSend:function(data){
	     	$("#msg_box").html("");
	      	$("#msg_box").html("<img src='public/images/loading.gif'>");  
	},
	success:function(data){
		    if(data.reply=="10"){
		    	invoice_id=data.id;
				var root_url=$("#root_url").val();
				var url=root_url+"Substore_returns/save_sub";
				var jsonObj = {};
				   var items = document.getElementsByClassName('val_20');
				    for (var i = 0; i < items.length; i++){
				        	jsonObj[items[i].name] =data.id+"_"+items[i].value;
				}
				$.ajax({
				  type:'post',
				  url: url,
				  data:jsonObj,
				  dataType:'json',
				  success:function(data){
				     if(data.reply=="10"){
				      $("#msg_box").html('');  
				      $('#total_val').text('0.00');
				      $("#msg_box").append("<div class='alert alert-success'>Return note Saved Successfully.</div>");
				      $('.form_main')[0].reset();
				      $('.grn_rows').remove();
				      getdata_index('a b substorreturnmaster');
				    }else if(data.reply=="20"){
				      $("#msg_box").html('');  
				      $('#total_val').text('0.00');
				      $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
				      $('.form_main')[0].reset();
				      $('.grn_rows').remove();
				      if(invoice_id != null || invoice_id !=''){
				      	var urlsub=root_url+"Substore_returns/remove_returnnote";
				      	$.ajax({
				      		type:'post',
				      		url:urlsub,
				      		data:{id:invoice_id},
				      		dataType:'json',
				      	});
				      }
				    }
				  }
				});  
		    }else if(data.reply=="20"){

		    }
	}
	});
		return false;
});

$("#save_btn").click(function () {
    form.validate();
});



$("#maintable").on('click','.rm_btn',function(){
$(this).closest('tr').remove();
cal_total();
});



$("#stockitems").change(function(){
		var val=$(this).val();
		var root_url=$("#root_url").val();
		var url=root_url+"Substore_returns/load_item";
	$.ajax({
		type:'post',
		url:url,
		data:{id:val},
		dataType:'json',
		beforesend:function(){

		},
		success:function(data){
			if(data.reply=="20"){
				$('.val_1').val('');
				$('.val_2').val('');
				$('.val_3').val('');
				$('.val_4').val('');
				$('.val_5').val('');
				$('.val_6').val('');
				$('.val_7').val('');
				$('.val_8').val('');
				$(".val_3").prop("readonly", true);
				$(".val_4").prop("readonly", true);	
			}else if(data.reply=="10"){
				$(".val_3").prop("readonly", false);
				$(".val_4").prop("readonly", false);
				$('.val_1').val(data.val_1);
				$('.val_3').val(data.val_2);
				$('.val_5').val(data.val_3);
				$('.val_6').val('');
				$('.val_7').val('');
			}
		}
	});
return false;
});

$(".val_4").on('change',function(){
cal_amount();
});
$(".val_4").on('keyup',function(){
cal_amount();
});

$(".val_3").on('change',function(){
cal_amount();
});
$(".val_3").on('keyup',function(){
cal_amount();
});

$("#substores_data").on('change',function(){
$('#issuenotemasters_data').html('');
		var root_url=$("#root_url").val();
		var url=root_url+"Substore_returns/load_rtns";
var val=$('#substores_data option:selected').val();
$.ajax({
	type:'post',
	url:url,
	data:{id:val},
	dataType:'html',
	success:function(data){
		$("#issuenotemasters_data").append(data);
	}
});
return false;
});

$("#issuenotemasters_data").on('change',function(){
$('#stockitems').html('');
		var root_url=$("#root_url").val();
		var url=root_url+"Substore_returns/load_subs";
var val=$('#issuenotemasters_data option:selected').val();
$.ajax({
	type:'post',
	url:url,
	data:{id:val},
	dataType:'html',
	success:function(data){
		$("#stockitems").append(data);
	}
});
return false;
});




function cal_total(){
	// var page = $('#maintabletop').find('.totalsub');

    var sum = 0;
    var items = document.getElementsByClassName('hidden_sum');
		for (var i = 0; i < items.length; i++){
			sum+=parseInt(items[i].value);
			//jsonObj[items[i].name] =data.id+"_"+items[i].value;
		}
		if(sum<=0){
		$('#total_val').text('0.00');
		}else{
		$('#total_val').text(sum);
		$('.number_format').number( true, 2 );
		}	
}

function cal_amount(){
	var price=$('.val_3').val();
	var qty=$('.val_4').val();
	var amount=price*qty;
	$(".val_8").val(amount);
}

});
