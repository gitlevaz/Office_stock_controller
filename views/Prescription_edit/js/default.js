$(document).ready(function(){

function getAge(dateString) {
  var now = new Date();
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());

  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();

  var dob = new Date(dateString.substring(6,10),
                     dateString.substring(0,2)-1,                   
                     dateString.substring(3,5)                  
                     );

  var yearDob = dob.getYear();
  var monthDob = dob.getMonth();
  var dateDob = dob.getDate();
  var age = {};
  var ageString = "";
  var yearString = "";
  var monthString = "";
  var dayString = "";


  yearAge = yearNow - yearDob;

  if (monthNow >= monthDob)
    var monthAge = monthNow - monthDob;
  else {
    yearAge--;
    var monthAge = 12 + monthNow -monthDob;
  }

  if (dateNow >= dateDob)
    var dateAge = dateNow - dateDob;
  else {
    monthAge--;
    var dateAge = 31 + dateNow - dateDob;

    if (monthAge < 0) {
      monthAge = 11;
      yearAge--;
    }
  }

  age = {
      years: yearAge,
      months: monthAge,
      days: dateAge
      };

  if ( age.years > 1 ) yearString = " years";
  else yearString = " year";
  if ( age.months> 1 ) monthString = " months";
  else monthString = " month";
  if ( age.days > 1 ) dayString = " days";
  else dayString = " day";

  $('.age_year_set').val(age.years);
  //alert(age.years);

  if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString;
  else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
    ageString = "Only " + age.days + dayString ;
  else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
    ageString = age.years + yearString + " old. Happy Birthday!!";
  else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.years + yearString + " and " + age.months + monthString;
  else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.months + monthString + " and " + age.days + dayString;
  else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
    ageString = age.years + yearString + " and " + age.days + dayString;
  else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.months + monthString ;
  else ageString = "Oops! Could not calculate age!";

  return ageString;
}

// $('.age_cal').html("<p>"+getAge('02/30/2016')+"</p>");
function calage(data){
if(data == null || data == '' || data == '0' || data == 'undefined'){

}else{
// alert();	
var array = data.split('-');
$('.patient_age').val(getAge(array[1]+"/"+array[2]+"/"+array[0]));
}
// var month=$('.age_month').val();
// var day=$('.age_day').val();
// var year=$('.age_year').val();
// $('.age_cal').html("<p>"+getAge(month+"/"+day+"/"+year)+"</p>");
}


//prescriptions loaging
load_data();
function load_data(){
$('.prescriptions').html('');
var root_url=$("#root_url").val();
$.ajax({
type:'post',
url:root_url+"Prescription_edit/load_prescriptions",
dataType:'html',
success:function(data){

$('.prescriptions').append(data);
}
});	
}
//end of prescriptions loaging


function checkedit(){
  
}

$('.prescriptions').on('click','.presedit',function(){
checkedit();
var pres_id=$(this).attr('data-value');
var patient_id=$(this).attr('data-patient');
var root_url=$("#root_url").val();
$.ajax({
type:'post',
url:root_url+"Prescription_edit/load_patient",
data:{id:patient_id,pr_id:pres_id},
dataType:'json',
success:function(data){
if(data.reply=='10'){
$('.pres_no').val(pres_id);
$('.patient_number').val(data.val_1);
// $('#customerselect').val(data.val_2);
$("#customerselect").val(data.val_1);
if(data.val_3=='' || data.val_3==null || data.val_3=='0'){
$('.patient_age').val('');
$('.patient_age').val(data.val_4+" Years");
}else{
$('.patient_age').val('');
calage(data.val_3);	
}
$('.patient_weight').val(data.val_5+' kg');
$('.pres_date').val(data.val_6);
$('.pres_note').html(data.val_7);
load_pres(pres_id);
}
if(data.reply=='30'){
 alert('Cannot Edit...!');
}
}
});	
return false;
});

function load_pres(pres_id){
$('#grncontent').append("<input type='hidden' value='"+pres_id+"' id='prescripton_number'>");
var root_url=$("#root_url").val();
$.ajax({
type:'post',
url:root_url+"Prescription_edit/load_pres",
data:{id:pres_id},
dataType:'html',
success:function(data){
$('.prescrip_rows').remove();
$("#maintabletop").after(data);
}
});	
return false;

}

$(".patient_number").on('keyup',function(){
var val=$(this).val();
var root_url=$("#root_url").val();
$.ajax({
type:'post',
url:root_url+"Prescription_home/search_patient",
data:"id="+val,
dataType:'json',
success:function(data){
$('#customerselect').val('');
$('.patient_age').val('');
$('.patient_weight').val('');
$("#customerselect option[value='"+val+"']").prop('selected', true);
$('.patient_age').val(data.val_3+" Years");
calage(data.val_4);
$('.patient_weight').val(data.val_2);
}
});
return false;

});

$("#customerselect").on('change',function(){
var val=$(this).val();
var root_url=$("#root_url").val();
$.ajax({
type:'post',
url:root_url+"Prescription_home/search_patient",
data:"id="+val,
dataType:'json',
success:function(data){
$('.patient_number').val('');
$('.patient_age').val('');
$('.patient_weight').val('');

$(".patient_number").val(val);
$('.patient_age').val(data.val_3);
$('.patient_weight').val(data.val_2);
}
});
return false;
});


    $("#itemName").on('input', function () {
        var val = $('#itemName').val()
        var value = $('#item_name_list option').filter(function() {
            return this.value == val;
        }).data('value');
        var val = value;
    var root_url=$("#root_url").val();
    var url=root_url+"Prescription_home/load_item";
  $.ajax({
    type:'post',
    url:url,
    data:{id:val},
    dataType:'json',
    beforesend:function(){

    },
    success:function(data){
      if(data.reply=="20"){
        $('.val1').val('');
        $('.val2').val('');
        $('.val3').val('');
        $('.val4').val('');
        $('.val5').val('');
        $('.val6').val('');
        $('.val7').val('');
        $('.val8').val('');
      }else if(data.reply=="10"){
          $('.val1').val('');
          $('.val2').val('');
          $('.val3').val('');
          $('.val4').val('');
          $('.val5').val('');
          $('.val6').val('');
          $('.val7').val('');
          $('.val8').val('');

        $('.val8').val(data.val_4);
        $('.val8').css('color','#09ad09');
        //$('.sub_btn').prop("disabled", false );
        if(data.val_4<=0){
          $('.val8').css('color','red');
          //$('.sub_btn').prop("disabled", true);
        }

        if(data.val_3=='0'){
          $('.val5').val('');

        }else{
          if(data.val_5==null || data.val_5=='' || data.val_5=='0'){
            $('.val5').val(data.val_3);
          }else{
            $('.check_sta').val(data.val_6);
            $('.val5').val(data.val_5);
          }
        }

        
      }
    }
  });
return false;
})


// not using
$("#stockitems").change(function(){
    var val=$(this).val();
    var root_url=$("#root_url").val();
    var url=root_url+"Prescription_home/load_item";
  $.ajax({
    type:'post',
    url:url,
    data:{id:val},
    dataType:'json',
    beforesend:function(){

    },
    success:function(data){
      if(data.reply=="20"){
        $('.val1').val('');
        $('.val2').val('');
        $('.val3').val('');
        $('.val4').val('');
        $('.val5').val('');
        $('.val6').val('');
        $('.val7').val('');
        $('.val8').val('');
      }else if(data.reply=="10"){
          $('.val1').val('');
          $('.val2').val('');
          $('.val3').val('');
          $('.val4').val('');
          $('.val5').val('');
          $('.val6').val('');
          $('.val7').val('');
          $('.val8').val('');

        $('.val8').val(data.val_4);
        $('.val8').css('color','#09ad09');
        //$('.sub_btn').prop("disabled", false );
        if(data.val_4<=0){
          $('.val8').css('color','red');
          //$('.sub_btn').prop("disabled", true);
        }

        if(data.val_3=='0'){
          $('.val5').val('');

        }else{
          if(data.val_5==null || data.val_5=='' || data.val_5=='0'){
            $('.val5').val(data.val_3);
          }else{
            $('.check_sta').val(data.val_6);
            $('.val5').val(data.val_5);
          }
        }

        
      }
    }
  });
return false;
});
// not using


// days week month selecters
var liveval;
var livetype;
$(".validates").on('keyup',function(){
validatetimes();
$(this).attr('readonly', false);
liveval=$(this).val();
livetype=$(this).attr('id');

if(liveval<='0' || liveval==''){
$(this).val('');
$('.validates').attr('readonly', false);
}
maincal();
});

$(".validates").on('change',function(){
validatetimes();
$(this).attr('readonly', false);
liveval=$(this).val();
livetype=$(this).attr('id');

if(liveval<='0' || liveval==''){
$(this).val('');
$('.validates').attr('readonly', false);
}
maincal();
});

function validatetimes(){
$('.validates').attr('readonly', true);
}
// end of days week month selecters

$('.val4').bind('keyup change',function(){
$('.val7').attr('readonly',true);
maincal();
});

$('.val6').on('change',function(){
$('.val7').val('');
$('.val7').attr('readonly',true);
var v=$(this).val();
if(v=='0' || v==''){
$('.val7').attr('readonly',false);
}else{
maincal();
}
});

// main calculation
function maincal(){
$('.val7').val('');
timprd=liveval;
timtype=livetype;
dose=$('.val4').val();
doseage=$('.val6').val();

var daypermonth=28;
var dayperweek=7;

if(timtype=="vald1"){
finel=timprd*dose*doseage;
var unt=$('.check_sta').val();
if(unt>'0'){
var x=finel/unt;
y=Math.ceil(x);
$('.val7').val(y);
$('.val7').attr('readonly',true);
}else{
$('.val7').val(finel);
$('.val7').attr('readonly',true);
}
}

if(timtype=="vald2"){
finel=timprd*dayperweek*dose*doseage;
var unt=$('.check_sta').val();
if(unt>'0'){
var x=finel/unt;
y=Math.ceil(x);
$('.val7').val(y);
$('.val7').attr('readonly',true);
}else{
$('.val7').val(finel);
$('.val7').attr('readonly',true);
}
}

if(timtype=="vald3"){
finel=timprd*daypermonth*dose*doseage;
var unt=$('.check_sta').val();
if(unt>'0'){
var x=finel/unt;
y=Math.ceil(x);
$('.val7').val(y);
$('.val7').attr('readonly',true);
}else{
$('.val7').val(finel);
$('.val7').attr('readonly',true);
}
}

}

// end main calculation

//remove prescription
$('.prescriptions').on('click','.presremove',function(){
var a=$(this).attr('id');
result =  a.split("_"); 
      var root_url=$("#root_url").val();
      var url=root_url+"Prescription_home/remove_pres";
  $.ajax({
  type:'post',
  url:url,
  data:{id:result[1]},
  dataType:'json',
  success:function(data){
    if(data.reply=='10'){
      load_data();
    }
    if(data.reply=='20'){
      alert('error...');
    }
    if(data.reply=='30'){
      alert('Cannot remove...!');
    }
  }
});
});
//end for remove prescription

$(".form_sub").submit(function(){

if($('.val_8').val()<=0){

}else{
var qty=$('.val8').val();
var tot=$('.val7').val();
x=Number(qty);
y=Number(tot);
if(x < y){
alert('Not enough stock!');
return false; 
}

var item_name=$('#itemName').val();

var itm_val = $('#itemName').val()
var itm_value = $('#item_name_list option').filter(function() {
    return this.value == itm_val;
}).data('value');
var itm_val = itm_value;


$("#maintabletop").after("<tr class='prescrip_rows'><input type='hidden' class='val_20' name='"+itm_val+"' value='"+itm_val+"_"+$('.val1').val()+"_"+$('.val2').val()+"_"+$('.val3').val()+"_"+$('.val4').val()+"_"+$('.val5').val()+"_"+$('.val6 option:selected').text()+"_"+$('.val7').val()+"'><td>"+item_name+"</td><td></td><td>"+$('.val4').val()+"</td><td class=''>"+$('.val5').val()+"</td><td class=''>"+$('.val6 option:selected').text()+"</td><td>"+$('.val1').val()+"</td><td>"+$('.val2').val()+"</td><td>"+$('.val3').val()+"</td><td class=''>"+$('.val7').val()+"</td><td><input type='hidden' class='hidden_sum' value="+$('.val7').val()+"><button type='button' class='btn btn-danger rm_btn'>Remove</button></td></tr>");
        $('#itemName').val('');
        $('.val1').val('');
        $('.val2').val('');
        $('.val3').val('');
        $('.val4').val('');
        $('.val5').val('');
        $('.val6').val('');
        $('.val7').val('');
        $('.check_sta').val('');
        $('.validates').prop("readonly",false);
        $(".val_3").prop("readonly", true);
        $(".val_4").prop("readonly", true); 
// cal_total();
}
return false;
});

$("#maintable").on('click','.rm_btn',function(){
$(this).closest('tr').remove();
// cal_total();
});


// save prescriptions

$("#save_btn").click(function () {
        var data_id=$('#prescripton_number').val();
        var root_url=$("#root_url").val();
        var url=root_url+"Prescription_edit/save_sub";
        var jsonObj = {};
           var items = document.getElementsByClassName('val_20');
            for (var i = 0; i < items.length; i++){
                  jsonObj[items[i].name] =data_id+"_"+items[i].value;
        }
        $.ajax({
          type:'post',
          url: url,
          data:jsonObj,
          dataType:'json',
          success:function(data){
             if(data.reply=="10"){
              load_data();
              $("#msg_box").html('');  
              $('#total_val').text('0.00');
              $("#msg_box").append("<div class='alert alert-success'>Prescription Saved Successfully.</div>");
              $('.form_main')[0].reset();
              $('.prescrip_rows').remove();
               getdata_index('a b invoicemaster');
            }else if(data.reply=="20"){
              $("#msg_box").html('');  
              $('#total_val').text('0.00');
              $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
              $('.form_main')[0].reset();
              $('.prescrip_rows').remove();
              if(invoice_id != null || invoice_id !=''){
                var urlsub=root_url+"Prescription_home/remove_prescription";
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
});
//end of save prescriptions

$('#maintable').on('click','.rm_btn_old',function(){
var sub_id=$(this).attr('data-value');
var root_url=$("#root_url").val();
var url=root_url+"Prescription_edit/remove_sub";
$.ajax({
  type:'post',
  url:url,
  data :{id:sub_id},
  cache:'false',
  dataType:'json',
  success:function(data){
  }
});
$(this).closest('tr').remove();
});


function deselect(e) {
  $('.pop').slideFadeToggle(function() {
    e.removeClass('selected');
  });    
}

$(function() {
  $('.pt_history').on('click', function() {
    $id=$('.patient_number').val();
    $nme=$("#customerselect option:selected").text();

    loaddata('1',$id);
    $(".patient_name").html($nme);

    if($(this).hasClass('selected')) {
      deselect($(this));               
    } else {
      $(this).addClass('selected');
      $('.pop').slideFadeToggle();
    }
    return false;
  });

  $('.close').on('click', function() {
    deselect($('#contact'));
    return false;
  });
});

$.fn.slideFadeToggle = function(easing, callback) {
  return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
};

function loaddata(page,id)
{
var root_url=$("#root_url").val();
var url=root_url+"Prescription_home/load";
$.ajax({
  type:'post',
  url:url,
  data :{page:page,pid:id},
  cache:'false',
  dataType:'html',
  beforeSend:function(){
     $("#msg_box").html("");
      $("#msg_box").html("<img src='public/images/loading.gif'>");  
  },
  success:function(data){
    $("#msg_box").html("");
    $('#report').html(data);
  }
});
}

var check_searchtype='0';
$('.pagin').on('click','.active',function(){
        var page = $(this).attr('p');
        if(check_searchtype==1){
        loaddata_search(page);
        }else{
          $id=$('.patient_number').val();
        loaddata(page,$id);  
        }    
});           
$('.pagin').on('click','#go_btn',function(){
        var page = parseInt($('.goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if(page != 0 && page <= no_of_pages){
          if(check_searchtype==1){
          loaddata_search(page);
          }else{
            $id=$('.patient_number').val();
          loaddata(page,$id);  
          }  
        }else{
            alert('Enter a PAGE between 1 and '+no_of_pages);
            $('.goto').val("").focus();
            return false;
        }
});

});