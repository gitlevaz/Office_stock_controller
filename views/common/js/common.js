$(document).ready(function(){
var items = document.getElementsByClassName('getdata_options');
var index = document.getElementsByClassName('index');
$(items).load('sompage.html', function(){
	getdata_options($(this).attr('class'));
});
$(index).load('sompage.html', function(){
	getdata_index($(this).attr('class'));
});
// common date datepicker

$(function() {
$( ".datepicker" ).datepicker({
  dateFormat: "yy-mm-dd",
});
});

});


function getdata_index(aa) {
	var cls=aa;
	var scls=cls.split(" ");
	var cc=scls[2];
    if(cc=='' || cc==null){

    }else{
		var root_url=$("#root_url").val();
		var url=root_url+"common_functions/get_index";
			// var startnumber = $("#startnumber").html();
			// var limitnumber = $("#limitnumber").html();
			$.ajax({
				type:'post',
				cache:'false',
				url: url,
				data : {data:cc},
				dataType:'html',
				success:function(data){
								if(data){
						$("."+cc).val(data);
					}
				}
			});
    }
}

function getdata_options(aa){
	var cls=aa;
	var scls=cls.split(" ");
	var cc=scls[0];
	var vx=$('.'+cc).data('options');
	var res = vx.split(" ");
	var check=0;
	if(res[0]){
	check+=1;
	}
	if(res[1]){
	check+=1;
	}
	if(res[2]){
	check+=1;
	}
	if(res[3]){
	check+=1;
	}
	if(res[4]){
	check+=1;
	}
	if(res[5]){
	check+=1;
	}
	if(check>0){
		var root_url=$("#root_url").val();
		var url=root_url+"common_functions/get_options";
			var startnumber = $("#startnumber").html();
			var limitnumber = $("#limitnumber").html();
			$.ajax({
				type:'post',
				cache:'false',
				url: url,
				data : {ch:check,da:vx},
				dataType:'html',
				success:function(data){
								if(data){
						$("."+res[0]).html(data);
					}
				}
			});
	}
}

// 