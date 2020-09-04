$(document).ready(function(){
var localtime;
var check_searchtype='0';
var dateObj = new Date();
            h = dateObj.getHours();
            m = dateObj.getMinutes();
            s = dateObj.getSeconds();
localtime=h+"-"+m+"-"+s;

window.setInterval(function(){
load_auto();
}, 3000);
function load_auto(){

$('.prescriptions').html('');
var root_url=$("#root_url").val();
var max = $('.maxprescrip').val();
$.ajax({
type:'post',
url:root_url+"Prescription_Changestatus/load_auto",
data:{mx:max},
dataType:'json',
success:function(data){
if(data.reply=='10'){
var mm=data.max;
var crmm=$('.maxprescrip').val();
if(mm>crmm){
load_dataauto(mm);
}
$('.maxprescrip').val(mm);
}
}
});	
return false;

}

function load_dataauto(max){
$('.prescriptions').html('');
var root_url=$("#root_url").val();
$.ajax({
type:'post',
url:root_url+"Prescription_Changestatus/load_dataauto",
data:{id:max},
dataType:'html',
success:function(data){
$(".recent_prescription").prepend(data);
}
});	
return false;
}

$('.pagin').on('click','.active',function(){
	 	alert('test');
        var page = $(this).attr('p');
        if(check_searchtype==1){
        loaddata_search(page);
        }else{
        load_data(page);  
        }    
});           
$('.pagin').on('click','#go_btn',function(){
        var page = parseInt($('.goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if(page != 0 && page <= no_of_pages){
          if(check_searchtype==1){
          loaddata_search(page);
          }else{
          load_data(page);  
          }  
        }else{
            alert('Enter a PAGE between 1 and '+no_of_pages);
            $('.goto').val("").focus();
            return false;
        }
});


load_data("1");
function load_data(page){
$('.prescriptions').html('');
var root_url=$("#root_url").val();
$.ajax({
type:'post',
url:root_url+"Prescription_Changestatus/load_prescriptions",
data : "page="+page,
dataType:'html',
success:function(data){
$(".recent_prescription").append(data);
}
});	
return false;
}

$('.recent_prescription').on('click','.proceed_btn',function(){
$('#msg_box').html('');
var aa=$(this).attr('name');
rr =  aa.split("_");
var re=$('.pdata_'+rr[1]).val(); 

var root_url=$("#root_url").val();
$.ajax({
type:'post',
url:root_url+"Prescription_Changestatus/update_status",
data:{id:rr[1],val:re,time:localtime},
dataType:'json',
success:function(data){
if(data.reply=='10'){
$('#msg_box').append("<div class='alert alert-success'> Successfully saved</div>");
// $('.prval_'+rr[1]).prop('disabled', true);
$('.prval_'+rr[1]).attr('class', 'btn btn-success cancel_btn prval_'+rr[1]);
$('.prval_'+rr[1]).html('Cancel');
}
if(data.reply=='30'){
$('#msg_box').append("<div class='alert alert-danger'>error.. Not enough Stock !</div>");
}
}
});	
return false;
});

$('.recent_prescription').on('click','.cancel_btn',function(){
$('#msg_box').html('');
var aa=$(this).attr('name');
rr =  aa.split("_");
var re=$('.pdata_'+rr[1]).val(); 

var root_url=$("#root_url").val();
$.ajax({
type:'post',
url:root_url+"Prescription_Changestatus/cancel_status",
data:{id:rr[1],val:re,time:localtime},
dataType:'json',
success:function(data){
if(data.reply=='10'){
$('#msg_box').append("<div class='alert alert-success'> Successfully saved</div>");
// $('.prval_'+rr[1]).prop('disabled', true);
$('.prval_'+rr[1]).attr('class', 'btn btn-success proceed_btn prval_'+rr[1]);
$('.prval_'+rr[1]).html('Proceed');
}
if(data.reply=='30'){
$('#msg_box').append("<div class='alert alert-danger'>error.. Not enough Stock !</div>");
}
}
});	
return false;
});

});