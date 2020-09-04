$(document).ready(function(){
var localtime;
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
url:root_url+"Prescription_view/load_auto",
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
url:root_url+"Prescription_view/load_dataauto",
data:{id:max},
dataType:'html',
success:function(data){
$(".recent_prescription").prepend(data);
}
});	
return false;
}

load_data();
function load_data(){
$('.prescriptions').html('');
var root_url=$("#root_url").val();
$.ajax({
type:'post',
url:root_url+"Prescription_view/load_prescriptions",
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
url:root_url+"Prescription_view/update_status",
data:{id:rr[1],val:re,time:localtime},
dataType:'json',
success:function(data){
if(data.reply=='10'){
$('#msg_box').append("<div class='alert alert-success'> Successfully saved</div>");
$('.prval_'+rr[1]).prop('disabled', true);
$('.prval_'+rr[1]).attr('class','btn btn-warning proceed_btn');
}
if(data.reply=='30'){
$('#msg_box').append("<div class='alert alert-danger'>error.. Not enough Stock !</div>");
}
if(data.reply=='40'){
$('#msg_box').append("<div class='alert alert-danger'>error.. Cannot Proceed !</div>");
}
}
});	
return false;
});

});