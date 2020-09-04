$(document).ready(function(){

$('.pagin').on('click','.active',function(){
        var page = $(this).attr('p');
        loaddata(page);      
});           
$('.pagin').on('click','#go_btn',function(){
        var page = parseInt($('.goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if(page != 0 && page <= no_of_pages){
            loaddata(page);
        }else{
            alert('Enter a PAGE between 1 and '+no_of_pages);
            $('.goto').val("").focus();
            return false;
        }
});

$('.search_key').on('keyup',function(){
	var page='1';
	var root_url=$("#root_url").val();
	var url=root_url+"Reports_stockitems/search_key";
	var val = $( ".search_key" ).val();
	$.ajax({
	  type:'post',
	  url:url,
	  cache:'false',
	  data:{keys:val,page:page},
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
});

$('.show_all').on('click',function(){
  var page='1';
  var root_url=$("#root_url").val();
  var url=root_url+"Reports_stockitems/search_all";
  $.ajax({
    type:'post',
    url:url,
    cache:'false',
    data:{page:page},
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
});



$('.print_all').on('click',function(){
PrintElem('#grncontent');
});

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }




loaddata("1");

function loaddata(page)
{
var root_url=$("#root_url").val();
var url=root_url+"Reports_stockitems/load";
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

});