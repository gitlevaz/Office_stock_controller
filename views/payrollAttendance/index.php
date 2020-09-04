
<style type="text/css">
tr {
width: 100%;
display: inline-table;
/*height:60px;*/
table-layout: fixed; 
}

table{
 height:300px; 
 display: -moz-groupbox;
}
tbody{
  overflow-y: scroll;
  height: 600px;
  width: 100%;
  position: absolute;
}
</style>

<div ng-controller="payrollattendanceCtr" >
<input type="hidden" id="today" value="<?php echo date("Y-m-d")?>">
<div class="container-fluid" style="margin-top: 25px;">
<div>
    <div class="row">
        <div class="col-sm-2 col-md-2">
            <a href="<?php echo base_url("payroll_home/payHome")?>" class="backButton">
                <i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right:2%"></i>Back</a>
        </div>

    </div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="panel panel-info">
<div class="panel-heading">Attendance</div>
<div class=" panel-body" style="background-color: #ffff;background-color: #FFF !important;">
    <div style="background-color: #ccc;margin-bottom: 10px;padding: 5px;">       
        <span>Month Date</span>
        <input type="text" class="datepicker" id="att-date" ng-model="employee.salarydate" datepicker>
        <!-- <a href="#" id="add_sheet">Add Date</a> -->
        <span>Select Devision</span>     
                 <select ng-model="filter.devision" class="employee">
                 <option value="0">-select-</option>
                    <?php foreach ($devisions as $dev): ?>
                    <option value="<?php print $dev['id']; ?>"><?php print $dev['location_name']; ?></option>
                    <?php endforeach; ?>
                 </select>                     
        <span><button ng-click="index(1)">Search</button><span/>
    </div>

    <div class="col-md-12 bg-border" id="table-responsive" style="padding-left: 0;padding-right: 0;">

        <table class="table table-bordered table-hover attendancesheet table-responsive" id="table-1">
        <thead>
        <tr class="header" id="headder_row">
        <th style='width:60px;''>Roll#</th>
        <th>Employee</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="attendance in attendancelist | orderBy:sortType:sortReverse | filter:searchGrn"  ng-cloak uid="{{attendance.id}}" class="userrow" id="user_{{attendance.id}}">
        <td class="rollno" style='width:60px;'>{{attendance.id}}</td>
        <td class="userinfo" style='width:200px;'>{{attendance.first_name}}</td>
        <td ng-repeat="attendancemark in attendance[0]" class="att-record" data-employeeid="{{attendance.id}}" data-datec="{{current_year}}-{{current_month}}-{{$index+1}}">
            <span ng-if="attendancemark == 'P'" class="present">{{attendancemark}}</span>
            <span ng-if="attendancemark == 'H'" class="halfday">{{attendancemark}}</span>
            <span ng-if="attendancemark == 'S'" class="shortleave">{{attendancemark}}</span>
             <span ng-if="attendancemark == 'A'" class="absent">{{attendancemark}}</span>
            <span ng-if="attendancemark == 'L'" class="leave">{{attendancemark}}</span>
            <span ng-if="attendancemark == null" class="leave">L</span>
        </td>
        </tr>
        </tbody>
        </table>

        <table class="table table-bordered table-hover attendancesheet" id="header-fixed">
<!--         <thead>
        <tr class="header" id="headder_row">
        <th>Roll#</th>
        <th>Employee</th>
        </tr>
        </thead> -->
        </table>
    </div>   
</div>
<div class="panel-footer">
    <div class="pagination">
        <ul class="pagination">
            <li class="page-number" ng-repeat="n in pages"  ng-cloak>
                <a href="javascript:void(0)" data-page="{{n}}" ng-click="pageNavigate($event)">{{n}}</a>
            </li>
        </ul>
    </div>
</div>
</div>    
</div>
</div>
</div>
</div>
<script>
 function getDaysInMonth(month, year) {
         // Since no month has fewer than 28 days
         var date = new Date(year, month, 1);
         var days = [];
         console.log('month', month, 'date.getMonth()', date.getMonth())
         while (date.getMonth() === month) {
            days.push(new Date(date));
            date.setDate(date.getDate() + 1);
         }
         return days;
    }

    $scope.index = function(page){
        $('#headder_row').empty();
        $('#headder_row').append("<th style='width:60px;'>Roll#</th><th style='width:200px;'>Employee</th>")
        // $('.date-header').remove();
        //firing ajax request
        var promise = $http({
            method  : 'GET',
            url     : 'payrollAttendanceList/page/'+page+'/'+$scope.filter.devision+'/'+$('#att-date').val(),
        });
        //when the request is success
        promise.success(function (data) {
            currentPage            = data.pagination.current_page;
            $scope.pages           = setPageCount(1,data.pagination.pages);
            $scope.attendancelist  = data.result;
            // add attendence to table
            $scope.totaldaysofMonth = data.total_days;
            // add table hedder

            var current_year     = data.year;
            $scope.current_year  = data.year;
            var current_month    = data.month;
            $scope.current_month = data.month;
            var totaldays        = data.total_days;
            // $scope.attendanceDateListUniqu  = [];
            for (var i = 1; i <= totaldays; i++) {
                c_date=current_year+'-'+current_month+'-'+i;
                // alert(c_date);
                $scope.attendanceDateListUniqu.push(c_date);
                $('#headder_row').append("<th id='date_head_itmes'>"+i+"</th>");
            }
            // add_sheet();
        });
        //when error is occured
        promise.error( function( data ) {
        });
    }; 

/**
 * Function loads the records by given offset
 * @param {obj} $event :: get the current event
 * @returns {undefined}
 */
    $scope.pageNavigate = function($event){
        var elem    = $($event.target);
        var page    = elem.attr('data-page');
        /**
         * call the function
         */
        $('.date-header').remove();
        $scope.index(page);
        // add_sheet();
    };
    
    /**
     * Function sets an array upto given numbers
     * @param {int} lowEnd
     * @param {int} highEnd
     * @returns {Array}
     */
    var setPageCount    = function(lowEnd,highEnd){
        var arr = [];
        while(lowEnd <= highEnd){
           arr.push(lowEnd++);
        }
        return arr;
    }


// 

function getDateMonthFromDate(datestr)
{
    //split them
    var tokens = datestr.split('-');
    
    //join first two
    return tokens[0] + '-' + tokens[1];
}

function getDateBasedClassName(datestr)
{
    var tokens = datestr.split('-');
    return tokens[0] + tokens[1] + tokens[2];
}

$scope.update_status={};
// $scope.update_status=function(employee_id,status){
function update_status(employee_id,status,date){
    $scope.update_status.status=status;
    $scope.update_status.employee_id=employee_id;
    $scope.update_status.date=date;
        console.log(employee_id);
    //firing ajax request
    var promise = $http({
        method: 'POST',
        //setting url for store ( this route in routes.php )
        url: 'payrollAttendanceList/update_status',
        //setting object inside param function that will be sent 
        data: $.param($scope.update_status),
    });
    //when the request is success
    promise.success(function (data,status) {
        // notifier.notify(data.result,'success',status);
        // $scope.index(currentPage);
        // $scope.reset();
    });
    //when error is occured
    promise.error( function( data , status) {
        // notifier.notify(data.result,'danger',status);
    });
}

// $('.att-record').on('click',function(){
$('.attendancesheet').on('click','.att-record',function(){
    employee_id=$(this).attr('data-employeeid');
    date       =$(this).attr('data-datec');

    var pora = $(this).find('span').text();
    if(pora === 'L') {
        $(this).find('span').removeClass('leave').addClass('present').text('P');
        update_status(employee_id,'P',date);
    }
    else if(pora === 'P'){
        $(this).find('span').removeClass('present').addClass('halfday').text('H');   
        update_status(employee_id,'H',date);     
    }
    else if(pora === 'H'){
        $(this).find('span').removeClass('halfday').addClass('shortleave').text('S');
        update_status(employee_id,'S',date);        
    }
    else if(pora === 'S'){
        $(this).find('span').removeClass('shortleave').addClass('absent').text('A');   
        update_status(employee_id,'A',date); 
    }
    else if(pora === 'A'){
        $(this).find('span').removeClass('absent').addClass('leave').text('L');   
        update_status(employee_id,'L',date);     
    }

});


$('#add_sheet').click(function(event){
        $scope.attendanceDateList.push($('#att-date').val());
        // var uniqueNames = [];
        $.each($scope.attendanceDateList, function(i, el){
            if($.inArray(el, $scope.attendanceDateListUniqu) === -1) $scope.attendanceDateListUniqu.push(el);
        });

        event.preventDefault();
        add_sheet();
});

$scope.add_sheet_date=null;

var ii=0;
var cmd;
// $scope.attendanceDateListUniqu.length

function add_sheet(){


    // $('.date-header').remove();
    $('.att-record').remove();

    console.log($scope.attendanceDateListUniqu);
    // angular.forEach($scope.attendanceDateListUniqu,function(value,key){
    if(ii >= $scope.attendanceDateListUniqu.length);//end if it's done

    // alert($scope.attendanceDateListUniqu[ii]);    

    var date = $scope.attendanceDateListUniqu[ii];
    // alert(date);

    if(date.length == 0) {
        alert('Please probvide date');
        return;
    }
    
    $scope.add_sheet_date=date;


    var tt=date.split("-");
    var title =tt[2];

    //create a header row
    $('<th></th>').addClass('date-header').attr({'cname':date}).append(title).appendTo('table.attendancesheet tr.header');
    
    do_ajax(date);

    // });
}

//firing ajax request
function do_ajax(date) {
var attendance;
var promise = $http({
    method  : 'GET',
    url     : 'payrollAttendanceList/get_attendance/'+currentPage+"/"+date+'/'+$scope.filter.devision,
});

//when the request is success
promise.success(function (data) {

append_attendance(data);

});

}

function append_attendance(data){
alert('x');
attendance=data.attendence;
var className = getDateBasedClassName($scope.add_sheet_date);

angular.forEach(attendance,function(value,key){
    if(value['attendence_status']==null){
        var span = $('<span></span>').addClass('absent').text('A');
    }                
    if(value['attendence_status']=='P'){
        var span = $('<span></span>').addClass('present').text('P');
    }
    if(value['attendence_status']=='A'){
        var span = $('<span></span>').addClass('absent').text('A');
    }
    if(value['attendence_status']=='S'){
        var span = $('<span></span>').addClass('shortleave').text('S');
    }
    if(value['attendence_status']=='H'){
        var span = $('<span></span>').addClass('halfday').text('H');
    }
    var td = $('<td></td>').addClass('att-record').addClass(className).attr({'data-datec':$scope.add_sheet_date}).attr({'data-employeeid':value['employee_id']});

    //console.log(span);
    // span.appendTo(td);
    // td.appendTo($("#user_"+value['employee_id'])); 
   // $("#headder_row").append("<span>"+value['attendence_day']+"</span>"); 

   var aa=$('<td></td>');
   span.appendTo(aa);
   aa.appendTo($("#user_"+value['employee_id']));
    
});
   ii++;
   add_sheet();
}

$('#dump_sheet').click(function(event){
    event.preventDefault();
    
    //get class names of interested
    $('table.attendancesheet tr.header th.date-header').each(function(){
        var dateOfAttendance = $(this).attr('cname');
        var present = [];
        //for this date find the users who are present
        $('table.attendancesheet tr.userrow').each(function(){
            var pora = $(this).find('.' + dateOfAttendance + ' span').text();
            if(pora === 'P')
                present.push(parseInt($(this).attr('uid')));
        });
        
        console.log(dateOfAttendance + " : " + present.join('-'));
    });
    
});
</script>
