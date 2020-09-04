$(document).ready(function(){


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

function loadProducts(page)
{
var root_url=$("#root_url").val();
var url=root_url+'purchaseorders_confirmed/load/';
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

$(function($) {

          var allWrappers = $('#pagin div.data');
          var allWrapperItems = $('#pagin #viewmoreTable');
          $('.pagin').on('click','.btn_edit2',function() {
            sub_total2($(this).attr('id'));
            if($(this).hasClass('open'))
            {
              $(this).html('Show Order');
              $(this).removeClass('open');
              $(this).next().slideUp("slow");
            }
            else
            {
            $(this).html('Hide / Orders');
            allWrappers.slideUp("slow");
            allWrapperItems.removeClass('open');
            $(this).addClass('open');
            $(this).next().slideDown("slow");
            return false;
            }
          });
});

$(".pagin").on('change','.quantity',function(){
  id=$(this).attr('id');
  invoiceno=$(this).data("id-bb");
  cal_amount(id,invoiceno);
});

$(".pagin").on('change','.unitprice',function(){
  id=$(this).data("id-aa");
  invoiceno=$(this).data("id-bb");
  cal_amount(id,invoiceno);
});
$(".pagin").on('keyup','.quantity',function(){
  id=$(this).attr('id');
  invoiceno=$(this).data("id-bb");
  cal_amount(id,invoiceno);
});

$(".pagin").on('keyup','.unitprice',function(){
  id=$(this).data("id");
  invoiceno=$(this).data("id-bb");
  cal_amount(id,invoiceno);
});

//delete subitems
$('.pagin').on('click','.btn_subdelete',function(){
var invoiceno=$(this).data("id-bb");
var val1=$(this).attr('id');
var val=val1.split("_");
var root_url=$("#root_url").val();
var url=root_url+'purchaseorders_confirmed/delete_sub/';
$.ajax({
type:'post',
url:url,
data:{id:val[1]},
dataType:'json',
success:function(data){
  if(data){
        $('.datatr_'+val[1]).remove();
    sub_total(invoiceno);
  }
}
});
return false;
});
//end of delete subitems

//update subitmes
$('.pagin').on('click','.btn_subedit',function(){
var aa=$(this).attr('id');
var id=aa.split("_");

var idd=id[1];
var grnno=$(this).data("id-bb");
var item_code=$('.sdata_val1_'+id[1]).val();
var item_name=$('.sdata_val2_'+id[1]+' option:selected').text();
var unitprice=$('.sdata_val3_'+id[1]).val();
var quantity=$('.sdata_val4_'+id[1]).val();
var unit=$('.sdata_val5_'+id[1]).val();
var total=$('.sdata_val8_'+id[1]).val();

var root_url=$("#root_url").val();
var url=root_url+'purchaseorders_confirmed/edit_sub/';

var actqty=$('.sdata_val11_'+id[1]).val();

// check quantity increase or decrease
var qty_diff=0;
var qty_diffcat=0;
if(actqty>quantity){
qty_diff=actqty-quantity;
qty_diffcat=1;
}else if(actqty<quantity){
qty_diff=quantity-actqty;
qty_diffcat=2;
}else if(actqty==quantity){
qty_diff=quantity;
qty_diffcat=3;
}

// check item status
var actitem=$('.sdata_val12_'+id[1]).val();

$.ajax({
type:'post',
url:url,
data:{val_1:idd,val_2:grnno,val_3:item_code,val_4:item_name,val_5:unitprice,val_6:quantity,val_7:unit,val_10:total,val_11:qty_diff,val_12:qty_diffcat,val_13:actitem,val_14:actqty},
dataType:'json',
success:function(data){
  if(data.reply=='10'){
    var actqty=$('.sdata_val11_'+id[1]).val(quantity);
    alert('done');
  }else{
    alert('error');
  }
}
});
// return false; 
});
//end of update subitems

//load new item
$('.pagin').on('change','#stockitems',function(){
    // var aa=$(this).attr('class');
    // var bb=aa.split("_");
    var idd=$(this).data("id-aa");
    var grnno=$(this).data("id-bb");
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
        $('.sdata_val1_'+idd).val(data.val_1);
        $('.sdata_val3_'+idd).val(data.val_2);
        $('.sdata_val5_'+idd).val(data.val_3);
        //$('.sdata_val6_'+idd).val('');
        cal_amount(idd,grnno);
      }
    }
  });
return false;
});
//end of load new item

//add new
$('.pagin').on('click','.add_new',function(){
  var id=$(this).attr('id');
  var val=$('#new_count').val();
    var root_url=$("#root_url").val();
    var url=root_url+"purchaseorders_confirmed/create_new";
  $.ajax({
    type:'post',
    cache:'false',
    data:{count:val,invoiceno:id},
    url: url,
    dataType:'html',
    success:function(data){
      $('.body_'+id).prepend(data);
      var val=$('#new_count').val();
      val++;
      $('#new_count').val(val);
    }
  });
  return false;
});

$('.pagin').on('click','.new_remove',function(){
  $(this).closest( "tr" ).remove();
});

$(".pagin").on('change','.val3',function(){
  val1=$(this).val();
  aa=$(this).attr('id');
  ids=aa.split("_");
  val2=$('#val4_'+ids[1]).val();
  cal_amount2(val1,val2,ids[1]);
});

$(".pagin").on('change','.val4',function(){
  val1=$(this).val();
  aa=$(this).attr('id');
  ids=aa.split("_");
  val2=$('#val3_'+ids[1]).val();
  cal_amount2(val1,val2,ids[1]);
});

$(".pagin").on('keyup','.val3',function(){
  val1=$(this).val();
  val2=$('.val4').val();
  cal_amount2(val1,val2);
});

$(".pagin").on('keyup','.val4',function(){
  val1=$(this).val();
  val2=$('.val3').val();
  cal_amount2(val1,val2);
});

$('.pagin').on('change','.addnew_stockitems',function(){
    var aa=$(this).attr('id');
    var bb=aa.split("_");
    var idd=bb[1];

    var val=$(this).val();
    var root_url=$("#root_url").val();
    var url=root_url+"purchaseorders_confirmed/load_item";
  $.ajax({
    type:'post',
    url:url,
    data:{id:val},
    dataType:'json',
    beforeSend:function(){

    },
    success:function(data){
      if(data.reply=="20"){
        $('#val1_'+idd).val('');
        $('#val2_'+idd).val('');
        $('#val3_'+idd).val('');
        $('#val4_'+idd).val('');
        $('#val5_'+idd).val('');
        $('#val6_'+idd).val('');
        $('#val7_'+idd).val('');
        $('#val8_'+idd).val('');
        $("#val3_"+idd).prop("readonly", true);
        $("#val4_"+idd).prop("readonly", true); 
      }else if(data.reply=="10"){
        $("#val3_"+idd).prop("readonly", false);
        $("#val4_"+idd).prop("readonly", false);
        $('#val1_'+idd).val(data.val_1);
        $('#val3_'+idd).val(data.val_2);
        $('#val5_'+idd).val(data.val_3);
        $('#val6_'+idd).val('');
        $('#val7_'+idd).val('');
      }
    }
  });
return false;
});


$('.pagin').on('click','.new_save',function(){
  var invoiceno=$(this).data("id-invno");
  var aa=$(this).attr('id').split("_");
  var index=aa['1'];

  if($("#val1_"+index).val()=='' || $("#val1_"+index).val()==null){
    return false;
  }
  if($("#val2_"+index).val()=='' || $("#val2_"+index).val()==null){
    return false;
  }
  if($("#val3_"+index).val()=='' || $("#val3_"+index).val()==null){
    return false;
  }
  if($("#val4_"+index).val()=='' || $("#val4_"+index).val()==null){
    return false;
  }
  if($("#val5_"+index).val()=='' || $("#val5_"+index).val()==null){
    return false;
  }
  if($("#val8_"+index).val()=='' || $("#val8_"+index).val()==null){
    return false;
  }

  var val_1=$("#val1_"+index).val();
  var val_2=$("#val2_"+index).val();
  var val_2=$("#val2_"+index+' option:selected').text();
  var val_3=$("#val3_"+index).val();
  var val_4=$("#val4_"+index).val();
  var val_5=$("#val5_"+index).val();
  var val_8=$("#val8_"+index).val();

    var root_url=$("#root_url").val();
    var url=root_url+"purchaseorders_confirmed/save_new";
  $.ajax({
    type:'post',
    url:url,
    data:{invoiceid:invoiceno,val1:val_1,val2:val_2,val3:val_3,val4:val_4,val5:val_5,val8:val_8},
    dataType:'html',
    beforeSend:function(data){

    },
    success:function(data){
        $('.body_'+invoiceno).prepend(data);
        $('.'+index).remove();
        sub_total(invoiceno);
    }
  });
  return false;

});
//end of add new

//delete invoice
$('.pagin').on('click','.btn_delete',function(){
var aa=$(this).attr('id').split("_");
var invoiceno=aa[1];
    var root_url=$("#root_url").val();
    var url=root_url+"purchaseorders_confirmed/deleteorder";
  $.ajax({
    type:'post',
    url:url,
    data:{id:invoiceno},
    dataType:'json',
    beforeSend:function(){

    },
    success:function(data){
      if(data.reply=="20"){

      }
      if(data.reply=="10"){
        $('#e_'+invoiceno).remove();
      $('#ul_'+invoiceno).remove();
      }
    }
  });
});


$('.pagin').on('click','.btn_unconfirm',function(){
var aa=$(this).attr('id').split("_");
var invoiceno=aa[1];
    var root_url=$("#root_url").val();
    var url=root_url+"purchaseorders_confirmed/unconfirmorder";
  $.ajax({
    type:'post',
    url:url,
    data:{id:invoiceno},
    dataType:'json',
    beforeSend:function(){

    },
    success:function(data){
      if(data.reply=="20"){

      }
      if(data.reply=="10"){
        $('#e_'+invoiceno).remove();
        $('#ul_'+invoiceno).remove();
      }
    }
  });
});

$('.pagin').on('click','.btn_confirm',function(){
var aa=$(this).attr('id').split("_");
var invoiceno=aa[1];
    var root_url=$("#root_url").val();
    var url=root_url+"purchaseorders_confirmed/confirmorder";
  $.ajax({
    type:'post',
    url:url,
    data:{id:invoiceno},
    dataType:'json',
    beforeSend:function(){

    },
    success:function(data){
      if(data.reply=="20"){

      }
      if(data.reply=="10"){
        $('#e_'+invoiceno).remove();
        $('#ul_'+invoiceno).remove();
      }
    }
  });
});

function cal_amount2(val1,val2,val3){
  var amount=val1*val2;
  $("#val8_"+val3).val(amount.toFixed(2));
  
}

function cal_amount(id,grnno){
  var price=$('#'+id).val();
  var qty=$('.data_'+id).val();
  var amount=price*qty;
  $("#amount_"+id).val(amount.toFixed(2));
  sub_total(grnno);
}

function sub_total(id){
     var sum = 0;
    var items = document.getElementsByClassName('totamount_'+id);
    for (var i = 0; i < items.length; i++){
      sum+=parseInt(items[i].value);
      //jsonObj[items[i].name] =data.id+"_"+items[i].value;
    }
    if(sum<=0){
    $('#total_val').text('0.00');
    }else{
    $('.sub_total_'+id).text(sum.toFixed(2));
    }  
}

function sub_total2(id){
 var id=id.split("_");
 sub_total(id[1]);
}

});

