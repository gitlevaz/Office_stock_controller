<?php 

class PayrollAttendance extends controller {
    function __construct() {
        parent::__construct();
        // if(!$this->auth->logged_in()){
        //     $this->auth->redirect_home();
        // }
        // $this->load->model('payrollAttendance_Model');
        // $this->load->model('add_location/add_location_model');
    }

    public function index(){
        if(parent::checkTokan()){
            $this->view->render('payrollAttendance/index');	
           }
        // $data["required_js"] = $this->config->item('payrollattendance_js') ;
        // $data["devisions"]   = $this->add_location_model->get();
        // $this->load->view("payrollAttendance",$data);
    }
    // public function page($page = 1,$devision=null,$date=null){    
    //  //check the request type
    //     if (!$this->input->is_ajax_request()) {
    //         exit('No direct script access allowed');
    //     }
    //     $devision=$devision; 
    //     $searchkey=$this->input->post("searchkey");

    //     $rowCount = $this->input->post("rowCount");
    //     $response = array();
    //     $this->load->library("dulpagination");
    //     $this->dulpagination->initialize($page, $this->payrollAttendance_Model->get_active_count($devision,$searchkey),"/payroll_reports/payrollAttendanceList/page/");
    //     if(empty($rowCount) || $rowCount=='undefined'){
    //      $pagination = $this->dulpagination->paginate();   
    //     }else{
    //       $pagination = $this->dulpagination->paginate($rowCount);  
    //     }
    //     //get results
    //     $results    = $this->payrollAttendance_Model->get_page($pagination["per_page"],$pagination["offset"],$devision,$searchkey,$date);
    //     // $attendence = $this->payrollAttendance_Model->get_attendance($pagination["per_page"],$pagination["offset"],$devision,$searchkey,$date);

    //     // get total days of selected month
    //     if($date=='' || $date==null){
    //         $sp_date=explode('-',date("Y-m-d"));
    //         $total_dates=cal_days_in_month(CAL_GREGORIAN,$sp_date[1],$sp_date[0]);
    //     }else{
    //         $sp_date=explode('-',$date);
    //         $total_dates=cal_days_in_month(CAL_GREGORIAN,$sp_date[1],$sp_date[0]);
    //     }

    //     if(count($results) > 0){
    //         $response["result"]     = $results;
    //         $response["pagination"] = $pagination;
    //         $response["year"] = $sp_date[0];
    //         $response["month"] = $sp_date[1];
    //         $response["total_days"] = $total_dates;
    //         // $response["attendence"] = $attendence;
    //         echo json_encode($response);
    //     }else{
    //         $this->output->set_status_header('400');
    //         $response["result"] = "No results found";
    //         echo json_encode($response);
    //     }  
        
    // }

    // public function get_attendance($page = 1,$date=null,$devision=null){
    //  //check the request type
    //     if (!$this->input->is_ajax_request()) {
    //         exit('No direct script access allowed');
    //     }
    //     $devision=$devision; 
    //     $searchkey=$this->input->post("searchkey");

    //     $rowCount = $this->input->post("rowCount");
    //     $response = array();
    //     $this->load->library("dulpagination");
    //     $this->dulpagination->initialize($page, $this->payrollAttendance_Model->get_active_count($devision,$searchkey),"/payroll_attendance/payrollAttendance/page/");
    //     if(empty($rowCount) || $rowCount=='undefined'){
    //      $pagination = $this->dulpagination->paginate();   
    //     }else{
    //       $pagination = $this->dulpagination->paginate($rowCount);  
    //     }

    //     $attendence = $this->payrollAttendance_Model->get_attendance($pagination["per_page"],$pagination["offset"],$devision,$searchkey,$date);

    //     if(count($attendence) > 0){
    //         $response["attendence"] = $attendence;
    //         echo json_encode($response);
    //     }else{
    //         $this->output->set_status_header('400');
    //         $response["result"] = "No results found";
    //         echo json_encode($response);
    //     }  
    // }


    
    // public function getall($key=''){
    //     //get results
    //     $results  = $this->payroll_employeelist_model->get_page(null,null,$key);
    //     if(count($results) > 0){
    //         $response["result"]     = $results;
    //         echo json_encode($response);
    //     }else{
    //         $this->output->set_status_header('400');
    //         $response["result"] = "No results found";
    //         echo json_encode($response);
    //     }   
    // }
    

    // public function update_status(){
    //          //check the request type
    //     if (!$this->input->is_ajax_request()) {
    //         exit('No direct script access allowed');
    //     }
    //     $status     =$this->input->post("status"); 
    //     $employee_id=$this->input->post("employee_id");
    //     $date       =$this->input->post("date"); 
    //     //get results
    //     $results  = $this->payrollAttendance_Model->update_status($employee_id,$date,$status);

    //     if(count($results) > 0){
    //         $response["result"]     = $results;
    //         echo json_encode($response);
    //     }else{
    //         $this->output->set_status_header('400');
    //         $response["result"] = "No results found";
    //         echo json_encode($response);
    //     } 
    // }
}


