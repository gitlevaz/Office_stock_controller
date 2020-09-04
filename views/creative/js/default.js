$(document).ready(function(){
$('#create_root').submit(function(){
	var url=$(this).attr('action');
	var data=$(this).serialize();
		$.ajax({
	type:'post',
	cache:'false',
	url:url,
	data:data,
	dataType:'json',
	beforeSend: function(formData) 
	{                      
	},
	success:function(data){
		if(data.reply=='0'){
		}
	}

});
});

$("#genarate_model").on('click',function(){
	var url=$("#url_2").val();
	var table=$("#base_table").val();
	var type=$("#type").val();
	var model=$("#model").val();
		$.ajax({
	type:'post',
	cache:'false',
	url:url,
	data:{base_table:table,sql_type:type,base_model:model},
	dataType:'json',
	beforeSend: function(formData) 
	{                      
	},
	success:function(data){
		if(data.reply=='0'){
		}
	}

});
});
});