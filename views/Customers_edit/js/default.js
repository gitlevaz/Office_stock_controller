$(document).ready(function(){
  var now = new Date();
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());
  var yearNow = now.getYear();
  $('.now_year').val(1900+yearNow);


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
    ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
    ageString = "Only " + age.days + dayString + " old!";
  else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
    ageString = age.years + yearString + " old. Happy Birthday!!";
  else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.years + yearString + " and " + age.months + monthString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.months + monthString + " and " + age.days + dayString + " old.";
  else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
    ageString = age.years + yearString + " and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.months + monthString + " old.";
  else ageString = "Oops! Could not calculate age!";

  return ageString;
}

// $('.age_cal').html("<p>"+getAge('02/30/2016')+"</p>");

$('.agecal').on('change',function(){
var month=$('.age_month').val();
var day=$('.age_day').val();
var year=$('.age_year').val();
$('.age_cal').html("<p>"+getAge(month+"/"+day+"/"+year)+"</p>");
});

$('.search_key').on('keyup',function(){
	var page='1';
	var root_url=$("#root_url").val();
	var url=root_url+"Customers_edit/search_key";
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
	    $('.pagin').html(data);
	  }
	});
});


$(".customer_form").submit(function(){
$data=$(this).serialize();
var root_url=$("#root_url").val();
var url=$(this).attr('action');
	$.ajax({
		type:'post',
		url: url,
		data : $data,
		dataType:'json',
	    beforeSend:function(){
     	$("#msg_box").html("");
      	$("#msg_box").html("<img src='public/images/loading.gif'>");         
	    },
	    success:function(data){
	     if(data.reply=="10"){
	      $("#msg_box").html('');  
	      $("#msg_box").append("<div class='alert alert-success'>Customer Updated.</div>");
	      $('.customer_form')[0].reset();
	      var hdn_val=$(".hidden_val2").val();
	      loadProducts(hdn_val);
	    }else if(data.reply=="20"){
	      $("#msg_box").html('');  
	      $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
	      $('.customer_form')[0].reset();
	    }	
	    }
	});
return false;
});

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
// var root_url=$("#root_url").val();
// var url=root_url+"Customers_edit/load_pages"
// $.ajax({
//     type:'post',
//     url:url,
//     dataType:'html',
//     beforeSend:function(){      
//     },
//     success:function(data){
//      $(".pagination").append(data);
//     }
// });

function loadProducts(page)
{

var root_url=$("#root_url").val();
var url=root_url+"Customers_edit/load_pages";
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

// edit function
$("#container").on('click','.btn_edit',function(){
var root_url=$("#root_url").val();
var url=root_url+"Customers_edit/edit_load";
var id=$(this).attr('id');
	$.ajax({
		type:'post',
		url: url,
		data : "eid="+id,
		dataType:'json',
	    beforeSend:function(){
     $("#msg_box").html("");
      $("#msg_box").html("<img src='public/images/loading.gif'>");         
	    },
		success:function(data){
		 if(data){
	     if(data.reply=="10"){
	      $("#msg_box").html('');  
	      $(".ed_val_1").val(data.val_1);
	      $(".ed_val_2").val(data.val_2);
	      $(".ed_val_3").val(data.val_3);
	      $(".ed_val_4").val(data.val_4);
	      $(".ed_val_5").val(data.val_5);
	      $(".ed_val_6").val(data.val_6);
	      $(".ed_val_8").val(data.val_8);
	      $(".ed_val_9").val(data.val_9);
	       $(".ed_val_10").val(data.val_11);
	      $(".hidden_val1").val(data.val_10);
	      $(".ed_val_14").val(data.val_13);
$(".male").prop('checked', false);
$(".female").prop('checked', false);
if(data.val_12=="" || data.val_12==null){

}else{

if(data.val_12=="m"){
$(".male").prop('checked', true);
}else{
$(".female").prop('checked', true);
}

}

if(data.val_7=="" || data.val_7==0){

}else{
var partsOfStr = data.val_7.split('-');	
$(".ed_val_11").val(partsOfStr[1]);
$(".ed_val_12").val(partsOfStr[2]);
$(".ed_val_13").val(partsOfStr[0]);
}

	    }else if(data.reply=="20"){
	      $("#msg_box").html('');  
	      $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
	    }
		}else{
	      $("#msg_box").html('');  
	      $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
		}
	    }
	});
return false;
});
//end of edit function
$("#container").on('click','.btn_delete',function(){
var root_url=$("#root_url").val();
var url=root_url+"Customers_edit/delete";
var id=$(this).attr('id');
confirm_function();
function confirm_function() {
 var r = confirm("Are you Sure !");
 if (r == true) {
$.ajax({
	type:'post',
	url:url,
	data:{did:id},
	dataType:'json',
	beforeSend:function(){
     $("#msg_box").html("");
      $("#msg_box").html("<img src='public/images/loading.gif'>");         
	},
	success:function(data){
		 if(data){
	     if(data.reply=="10"){
	      $("#msg_box").html('');  
	      $("#msg_box").append("<div class='alert alert-danger'>Deleted.</div>");  
	      var hdn_val=$(".hidden_val2").val();
	      loadProducts(hdn_val);
	     }
	     else if(data.reply=="20"){
	      $("#msg_box").html('');  
	      $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
	    }
	}else{
	      $("#msg_box").html('');  
	      $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
		}
	}	
});
return false;
}else{

}
}

});


//////////new///////////////////
// $("#container").on('click','.btn_delete',function(){
// 	if(confirm('Are you sure you want to delete this seller?')){
// 		// var seller_id = $(this).data('id')
// 		var id=$(this).attr('id');
// 		$.ajax({
// 		  url: 'http://localhost/medical_center/Customers_edit/delete/'+id,
// 		  type: 'POST'
// 		})
// 		.done(function(data){
// 			$("#msg_box").html('');  
// 			$("#msg_box").append("<div class='alert alert-danger'>Deleted.</div>"); 
// 			location.reload();  
// 		//   if(data.msg){
// 		// 	$("#msg_box").html('');  
// 		// 	 $("#msg_box").append("<div class='alert alert-danger'>Deleted.</div>");  
// 		//     swal({
// 		//       text: data.msg,
// 		//       icon: 'success'
// 		//     })
		
// 		//   }
// 		  if(data.errors){
// 			swal({
// 			 text: data.errors[0],
// 			 icon: 'warning'
// 			})
// 		  }
// 		})
// 	  }
	
		
// 		});
	///////////////////////////

});