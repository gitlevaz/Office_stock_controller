$(document).ready(function(){
var check_searchtype='0';

$('.pagin').on('click','.active',function(){
        var page = $(this).attr('p');
        if(check_searchtype==1){
        loaddata_search(page);
        }else{
        loaddata(page);  
        }    
});           
$('.pagin').on('click','#go_btn',function(){
        var page = parseInt($('.goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if(page != 0 && page <= no_of_pages){
          if(check_searchtype==1){
          loaddata_search(page);
          }else{
          loaddata(page);  
          }  
        }else{
            alert('Enter a PAGE between 1 and '+no_of_pages);
            $('.goto').val("").focus();
            return false;
        }
});

loaddata("1");

function loaddata(page)
{
var root_url=$("#root_url").val();
var url=root_url+"Reports_pressummery/load";
$.ajax({
  type:'post',
  url:url,
  data : "page="+page,
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

function loaddata_search(page){
var ptern=null;
var date_from=$('.date_from').val();
var date_to=$('.date_to').val();
var pres_no=$('.prescrip_no').val();

if(date_from){
 if(date_to){
 }else{
 $("#msg_box").html("<p>Select Date Range..</p>"); 
 return false;
 }
}

if(date_to){
 if(date_from){
 }else{
 $("#msg_box").html("<p>Select Date Range..</p>"); 
 return false;
 }
}

var root_url=$("#root_url").val();
var url=root_url+"Reports_pressummery/search";
$.ajax({
  type:'post',
  url:url,
  data : {page:page,val1:date_from,val2:date_to,val3:ptern,val4:pres_no},
  cache:'false',
  dataType:'html',
  beforeSend:function(){
     $("#msg_box").html("");
      $("#msg_box").html("<img src='public/images/loading.gif'>");  
  },
  success:function(data){
    $('.date_from').val('');
    $('.date_to').val('');
    $('.prescrip_no').val('');

    if(! date_from==''){
    $('.date_from').attr('placeholder',date_from);
    }else{
    $('.date_from').attr('placeholder','form');  
    }

    if(! date_to==''){
    $('.date_to').attr('placeholder',date_to);
    }else{
    $('.date_to').attr('placeholder','to'); 
    }

    if(! pres_no==''){
    $('.prescrip_no').attr('placeholder',pres_no);
    }else{
    $('.prescrip_no').attr('placeholder','Prescription Number');
    }
    $("#msg_box").html("");
    $('#report').html('');
    $('#report').html(data);
    check_searchtype=1;
  }
});

}



$('.search_btn').on('click',function(){
var page='1';
loaddata_search(page);
});


});
