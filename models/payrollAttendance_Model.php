<?php 


class payrollAttendance_Model extends Model {

    // protected $status;
    // protected $table_employee = 'payroll_employee';
    // protected $table = 'payroll_attendance';

    public function __construct() {

        parent::__construct();
        // $this->load->database();
        // $this->status = $this->config->item('status');
    }
    //  public function get_active_count($devision,$key) {
    //         $this->db->select('A.*,B.category_name as jobcat_title,C.location_name');
    //         $this->db->from("payroll_employee AS A");
    //         $this->db->join('payroll_jobcategories as B','B.id=A.job_category','INNER');
    //         $this->db->join('locations as C','C.id=A.location','INNER');
    //         if($key=='' || $key==null){}else{
    //         $this->db->group_start();    
    //         $this->db->like('A.id', $key);
    //         $this->db->or_like('A.first_name', $key);
    //         $this->db->or_like('A.last_name', $key);
    //         $this->db->or_like('A.address', $key);
    //         $this->db->or_like('A.contact_number', $key);
    //         $this->db->or_like('A.email', $key);
    //         $this->db->or_like('A.basic_salary', $key);
    //         $this->db->or_like('C.location_name', $key);
    //         $this->db->group_end();
    //         }
    //         if($devision=='' || $devision==null || $devision=='undefined'){}else{
    //         $this->db->where('A.location',$devision);
    //         }
    //         $this->db->where('A.status',$this->status["active"]);
    //         $this->db->order_by("A.first_name", "asc");
    //         // if($limit==null || $limit==''){ }else{
    //         // $this->db->limit($limit, $offset);          
    //         // }
    //     $num_rows = $this->db->count_all_results();
    //     return $num_rows;
    // }

    // public function get_page($limit=null,$offset=null,$devision,$key,$postdate) {

    //     $total_dates=null;

    //     if($limit !=null || $limit!=''){
    //     if ($offset < 0 || empty($limit)) {
    //         return false;
    //     }
    //     }
    //         $this->db->select('A.*,B.category_name as jobcat_title,C.location_name');
    //         $this->db->from("payroll_employee AS A");
    //         $this->db->join('payroll_jobcategories as B','B.id=A.job_category','INNER');
    //         $this->db->join('locations as C','C.id=A.location','INNER');
    //         // $this->db->join('payroll_attendance D','D.employee_id=A.id','INNER');
    //         if($key=='' || $key==null){}else{
    //         $this->db->group_start();    
    //         $this->db->like('A.id', $key);
    //         $this->db->or_like('A.first_name', $key);
    //         $this->db->or_like('A.last_name', $key);
    //         $this->db->or_like('A.address', $key);
    //         $this->db->or_like('A.contact_number', $key);
    //         $this->db->or_like('A.email', $key);
    //         $this->db->or_like('A.basic_salary', $key);
    //         $this->db->or_like('C.location_name', $key);
    //         $this->db->group_end();
    //         }
    //         if($devision=='' || $devision==null || $devision=='undefined'){}else{
    //         $this->db->where('A.location',$devision);
    //         }

    //         $this->db->where('A.status',$this->status["active"]);
    //         $this->db->order_by("A.first_name", "asc");
    //         if($limit==null || $limit==''){ }else{
    //         $this->db->limit($limit, $offset);          
    //         }

    //         $query = $this->db->get();
    //         $results = array();
    //                $count=0;
    //     foreach ($query->result() as $row) {


    //         $orderdata = array(
    //             'id'            => $row->id,
    //             'first_name'    => $row->first_name,
    //             // 'last_name'     => $row->last_name,
    //             // 'address'       => $row->address,
    //             // 'contact_number'=> $row->contact_number,
    //             // 'email'         => $row->email,
    //             // 'jobcat_title'  => $row->jobcat_title,
    //             // 'basic_salary'  => $row->basic_salary,
    //             // 'created_at'    => $row->created_at,
    //             // 'location_name' => $row->location_name,
                
    //         );
    //         $results[] = $orderdata;

    //     if($postdate=='' || $postdate==null){
    //         $sp_date=explode('-',date("Y-m-d"));
    //         $total_dates=cal_days_in_month(CAL_GREGORIAN,$sp_date[1],$sp_date[0]);
    //     }else{
    //         $sp_date=explode('-',$postdate);
    //         $total_dates=cal_days_in_month(CAL_GREGORIAN,$sp_date[1],$sp_date[0]);
    //     }
    //     $currentday=null;
 
    //     for ($i=1; $i <= $total_dates; $i++) {
    //     $currentday=$sp_date[0].'-'.$sp_date[1].'-'.$i; 
    //     $attendance=$this->get_attendance($limit,$offset,$devision,$key,$currentday,$row->id);
            
    //         foreach ($attendance as $key => $value) {

    //             $new_element[$i]=$value['attendence_status'];
    //             // $results[$value['employee_id']]=$new_element;
    //         }

    //                         // print_r($results[$value['employee_id']]);
    //     }
    //     array_push($results[$count], $new_element);
    //             $count++;
    //     }
    //     // print_r($results);

    //     // die;

    //     return $results;
    // }

    // public function get_attendance($limit=null,$offset=null,$devision,$key,$postdate,$employee_id){

    //         $dd=explode('-',$postdate);
    //         $current_day=$dd[2];


    //         $attendence_status=null;

    //         $this->db->where('employee_id',$employee_id);
    //         if(empty($postdate)){
    //         $this->db->where('attendance_date',date("Y-m-d"));
    //         }else{
    //         $this->db->where('attendance_date',$postdate);    
    //         }
    //         $query2=$this->db->get('payroll_attendance');
    //         foreach ($query2->result() as $val) {
    //         $attendence_status=$val->attendance;
    //         $attendance_date  =$val->attendance_date;
    //         }

    //         $orderdata = array(
    //             'employee_id'      =>$employee_id,
    //             'attendence_status'=>$attendence_status,
    //             'attendence_day'   =>$current_day
    //         );
    //         $results[] = $orderdata;

    //     return $results;   
    // }

    // public function update_status($employee_id,$date,$status){
    //     $this->db->trans_start();

    //     $this->db->where('employee_id',$employee_id);
    //     $this->db->where('attendance_date',$date);
    //     $this->db->where('status',$this->status["active"]);
    //     $query=$this->db->get("payroll_attendance");
    //     if($query->num_rows()>0){
    //         // update attendence
    //         $udata = array(
    //             'attendance' => $status
    //         );
    //         $this->db->where('employee_id',$employee_id);
    //         $this->db->where('attendance_date',$date);
    //         $this->db->where('status',$this->status["active"]);
    //         $this->db->update('payroll_attendance',$udata);
    //     }else{
    //         // add attendence
    //            // attendance month
    //         $month=explode("-",$date);

    //         $idata = array(
    //          'employee_id'    => $employee_id,
    //          'attendance'     => $status,
    //          'attendance_month'=> $month[0]."-".$month[1],
    //          'attendance_date'=> $date,
    //          'created_at'     => date("Y-m-d H:i:s"),
    //          'updated_by'     => $this->session->userdata('user_id'),
    //          'status'         => $this->status["active"]
    //         );
    //         $this->db->insert('payroll_attendance',$idata);
    //     }

    //     $this->db->trans_complete();
    //     //echo $this->db->trans_status();
        
    //     return $this->db->trans_status(); 
    // }
}






