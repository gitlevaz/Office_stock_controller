$(document).ready(function(){
	var root_url=$("#root_url").val();
	var dat=$("#hidden_val1").val();
	$.ajax({
	type:'post',
	url:root_url+'Admin_privileges_change/load',
	data:{ids:dat},
	dataType:'html',
	success:function(redata){
		$("#cont").append(redata);
	}
	});

$("#cont").on('change','.privileges_check1',function(){
    	var root_url=$("#root_url").val();
        var view_cat = $(this).attr('data_cat');
		if($(this).prop('checked') == true){
		var cat = $(this).attr('data_cat');
		var val = $(this).attr('data-value');
		$.ajax({
		type:'post',
		url:root_url+'Admin_privileges_change/edit',
		data:{cat:cat,val:val,che:1},
		dataType:'json',
		success:function(data){
			if(data.reply=='10'){
				$("."+view_cat).prop("checked", true);
			}
			if(data.reply=='20'){

			}
		}
		});
	   }else{
		var cat = $(this).attr('data_cat');
		var val = $(this).attr('data-value');
		$.ajax({
		type:'post',
		url:root_url+'Admin_privileges_change/edit',
		data:{cat:cat,val:val,che:0},
		dataType:'json',
		success:function(data){
			if(data.reply=='10'){
				$("."+view_cat).prop("checked", false);
			}
			if(data.reply=='20'){
				
			}
		}
		});	
	   }	
    });

$("#cont").on('change','.privileges_check2',function(){
var root_url=$("#root_url").val();
		if($(this).prop('checked') == true){
		var cat = $(this).attr('data_cat');
		var val = $(this).attr('data-value');
		$.ajax({
		type:'post',
		url:root_url+'Admin_privileges_change/edit_sub',
		data:{cat:cat,val:val,che:1},
		dataType:'json',
		success:function(redata){
			$("#cont").append(redata);
		}
		});
	   }else{
		var cat = $(this).attr('data_cat');
		var val = $(this).attr('data-value');
		$.ajax({
		type:'post',
		url:root_url+'Admin_privileges_change/edit_sub',
		data:{cat:cat,val:val,che:0},
		dataType:'json',
		success:function(redata){
			$("#cont").append(redata);
		}
		});	
	   }	
});

});	
