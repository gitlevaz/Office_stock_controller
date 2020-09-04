// $(document).ready(function(){
//   var now = new Date();
//   var today = new Date(now.getYear(),now.getMonth(),now.getDate());
//   var yearNow = now.getYear();
//   $('.now_year').val(1900+yearNow);


// function getAge(dateString) {
//   var now = new Date();
//   var today = new Date(now.getYear(),now.getMonth(),now.getDate());

//   var yearNow = now.getYear();
//   var monthNow = now.getMonth();
//   var dateNow = now.getDate();

//   var dob = new Date(dateString.substring(6,10),
//                      dateString.substring(0,2)-1,                   
//                      dateString.substring(3,5)                  
//                      );

//   var yearDob = dob.getYear();
//   var monthDob = dob.getMonth();
//   var dateDob = dob.getDate();
//   var age = {};
//   var ageString = "";
//   var yearString = "";
//   var monthString = "";
//   var dayString = "";


//   yearAge = yearNow - yearDob;

//   if (monthNow >= monthDob)
//     var monthAge = monthNow - monthDob;
//   else {
//     yearAge--;
//     var monthAge = 12 + monthNow -monthDob;
//   }

//   if (dateNow >= dateDob)
//     var dateAge = dateNow - dateDob;
//   else {
//     monthAge--;
//     var dateAge = 31 + dateNow - dateDob;

//     if (monthAge < 0) {
//       monthAge = 11;
//       yearAge--;
//     }
//   }

//   age = {
//       years: yearAge,
//       months: monthAge,
//       days: dateAge
//       };

//   if ( age.years > 1 ) yearString = " years";
//   else yearString = " year";
//   if ( age.months> 1 ) monthString = " months";
//   else monthString = " month";
//   if ( age.days > 1 ) dayString = " days";
//   else dayString = " day";

//   $('.age_year_set').val(age.years);
//   //alert(age.years);

//   if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
//     ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
//   else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
//     ageString = "Only " + age.days + dayString + " old!";
//   else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
//     ageString = age.years + yearString + " old. Happy Birthday!!";
//   else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
//     ageString = age.years + yearString + " and " + age.months + monthString + " old.";
//   else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
//     ageString = age.months + monthString + " and " + age.days + dayString + " old.";
//   else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
//     ageString = age.years + yearString + " and " + age.days + dayString + " old.";
//   else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
//     ageString = age.months + monthString + " old.";
//   else ageString = "Oops! Could not calculate age!";

//   return ageString;
// }

// // $('.age_cal').html("<p>"+getAge('02/30/2016')+"</p>");

// $('.agecal').on('change',function(){
// var month=$('.age_month').val();
// var day=$('.age_day').val();
// var year=$('.age_year').val();
// $('.age_cal').html("<p>"+getAge(month+"/"+day+"/"+year)+"</p>");
// });

// var root_url=$("#root_url").val();
// $(".customer_form").submit(function(){
// var url=$(this).attr('action');
// var formData=$(this).serialize();
// $.ajax({
//     type:'post',
//     url:url,
//     data:formData,
//     dataType:'json',
//     beforeSend:function(){
//      $("#msg_box").html("");
//       $("#msg_box").html("<img src='public/images/loading.gif'>");        
//     },
//     success:function(data){
//      if(data.reply=="10"){
//       $("#msg_box").html('');  
//       $("#msg_box").append("<div class='alert alert-success'>New Customer Created.</div>");
//       $('.customer_form')[0].reset();
//       getdata_index('a b customers');
//     }else if(data.reply=="20"){
//       $("#msg_box").html('');  
//       $("#msg_box").append("<div class='alert alert-danger'>Error.Try again.</div>");  
//       $('.customer_form')[0].reset();
//       getdata_index('a b customers');
//     }
//     }
// });
// return false;
// });

// });

$( document ).ready(function() {
  loaditem('d');
//  alert( "ready!" );
var root_url=$("#root_url").val();
// var url=root_url+"Employee_edit/load_new";
 $.ajax({
  // url: '{{url('get-client-id')}}',
  url:url,
  type: 'GET'
})
.done(function(data){ 
  // console.log(data);
  $('#id').val(id)  
  console.log(id);
  // editodal(data)
})
   
});

function loaditem(page)
{
    var rooturl= $("#root_url").val();  
    var url=rooturl+"Employee_edit/load_new";
    $.ajax({
      type:'post',
      cache:'false',
      url: url,
      data : "page="+page,
      dataType:'html',
      success:function(data){
        console.log(data);
              if(data){
          $('.pagin').html(data);
        }
      } 
    });

}

$('#container').on('click','.btn-edit',function () {  
  var rooturl= $("#root_url").val();  
  var url=rooturl+"Employee_edit/load_new";
  var id=$(this).attr('id');

  $.ajax({
    type:'post',
    cache:'false',
    url: url,
    data : "page="+page,
    dataType:'html',
    success:function(data){
      console.log(data);
            if(data){
        $('.pagin').html(data);
      }
    } 
  });

});