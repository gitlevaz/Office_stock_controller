$(document).ready(function(){

	// var JSONObj = { "name" : "tutorialspoint.com", "year"  : 2005 };

$("#print_btn").on('click',function(){
var root_url=$("#root_url").val();
var jsonObj = {};
	var items = document.getElementsByClassName('val_20');
	for (var i = 0; i < items.length; i++){
	jsonObj[items[i].name] =items[i].value;
	// alert(items[i].value);
	console.log(jsonObj);
}
var url=root_url+"Invoice_print/Invoice_print";
$.ajax({
type:'post',	
url: url,
data:jsonObj,
dataType:'html',
success:function(data){
	console.log(data);
// window.open(root_url+"Invoice_print/index");

	// document.write("<h3>Website Name = "+JSONObj.name+"</h3>")
window.open(root_url+"Invoice_print?stat="+data, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=1000,height=500");
}
});
return false;


	$scope.invoicenumber=data.invoiceno; 
	$scope.location_invoice_number=data.location_index;
	notifier.notify(data.result,'success',status); 
	$scope.getallcustomers();
	 
	$scope.reset();


});

// $("#save_btn").on('click',function(){
// 	// alert('f');
// });

// function editodal(data){
// 	// $('#ids').val(data.id)
//   }
  

$('.val_4').on('keyup',function(){
checkmax();
});



$(".form_sub").submit(function(){

if($('.val_8').val()<=0){

}else{
$("#maintabletop").after("<tr class='grn_rows'><input type='hidden' class='val_20' name='"+$('.val_2 option:selected').val()+"' value='"+$('.val_2 option:selected').val()+"_"+$('.val_3').val()+"_"+$('.val_4').val()+"_"+$('.val_5').val()+"_"+$('.val_8').val()+"'><td>"+$('.val_1').val()+"</td><td>"+$('.val_2 option:selected').text()+"</td><td>"+$('.val_3').val()+"</td><td>"+$('.val_4').val()+"</td><td>"+$('.val_5').val()+"</td><td class='totalsub number_format'>"+$('.val_8').val()+"</td><td><input type='hidden' class='hidden_sum' value="+$('.val_8').val()+"><button type='button' class='btn btn-danger rm_btn'>Remove</button></td></tr>");
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


// save grn
var grn_id;
var $selector = $('.form_main'),
form = $selector.parsley();

form.subscribe('parsley:form:success', function (e) {
	var data=$('.form_main').serialize();
			var root_url=$("#root_url").val();
			var url=root_url+"Invoice_home/save_main";
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
				var url=root_url+"Invoice_home/save_sub";
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
					  console.log(data);
				     if(data.reply=="10"){
				      $("#msg_box").html('');  
				      $('#total_val').text('0.00');
				      $("#msg_box").append("<div class='alert alert-success'>Invoice Saved Successfully.</div>");
				      $('.form_main')[0].reset();
				      $('.grn_rows').remove();
				       getdata_index('a b invoicemaster');
				    }else if(data.reply=="20"){
				      $("#msg_box").html('');  
				      $('#total_val').text('0.00');
				      $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
				      $('.form_main')[0].reset();
				      $('.grn_rows').remove();
				      if(invoice_id != null || invoice_id !=''){
				      	var urlsub=root_url+"Invoice_home/remove_invoice";
				      	$.ajax({
				      		type:'post',
				      		url:urlsub,
				      		data:{id:invoice_id},
				      		dataType:'json',
				      	});
				      }
					}
					
					editodal(data)

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
		var url=root_url+"Grn_home/load_item";
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
				$(".val_4").attr('placeholder',data.val_4);
				$(".val_4").attr('max',data.val_4);
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

function  checkmax() {
var pl=$('.val_4').attr('placeholder');
var val=$('.val_4').val();
if(val>pl){
$('.val_4').val('');	
}
}

});
