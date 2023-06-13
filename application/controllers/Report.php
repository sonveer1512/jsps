<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{


    public function __construct()

    {

        parent::__construct();

        $this->load->model('report_model');
        $this->load->model('underwriter_model');
        $this->load->model('filter_model');
        $this->load->model('Form_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('email');
    }
    public function fresh_operation($offset = null)
    {

        if ($this->session->userdata('pmsadmin') == true) {
            $short_name = $this->uri->segment(2);
            if ($short_name == 'fresh_operation') {
                $short_name = 'operations';
            }
            $limit = 50;
            $offset = ($offset == null || $offset == 1) ? '0' : ($offset - 1) * ($limit);
            $data['fresh_operation'] = $this->report_model->filterdate_listpage($short_name, $limit, $offset);
            $data['company'] = $this->Form_model->list_common('company');
            $data['team_leader'] = $this->Form_model->list_common('team_leader');
            $data['manager'] = $this->Form_model->list_common('manager');
            $total = $this->report_model->report_data($short_name);
            $data['total_premium_sum'] = $this->report_model->report_data_operations($short_name);
            $data['count'] = $total;
            $data['total_premium'] = (array_sum(array_column($data['total_premium_sum'], 'net_premium')));
            $data['offset'] = (empty($offset) || $offset == 1) ? '1' : $offset + 1;
            $data1 = $this->underwriter_model->fetch_sidebar_group_id('sidebar_group', 'group_short_name', $short_name);
            foreach ($data1 as $val) {
                $data['disposition_name'] = $this->underwriter_model->fetch_sidebar_group_id('disposition', 'module', $val['sidebar_id']);
            }

            return $this->load->view('admin/report/fresh_operation', $data);
        } else {
            $this->session->set_flashdata('denied', 'Access Denied!');
            return $this->load->view('admin/login');
        }
    }

    public function service_report($offset = null)
    {
        if ($this->session->userdata('pmsadmin') == true) {
            $short_name = $this->uri->segment(2);
            if ($short_name == 'service_report') {
                $short_name = 'services';
            }
            $limit = 50;
            $offset = ($offset == null || $offset == 1) ? '0' : ($offset - 1) * ($limit);
            $data['fresh_operation'] = $this->report_model->filterdate_listpage($short_name, $limit, $offset);
            $data['company'] = $this->Form_model->list_common('company');
            $data['team_leader'] = $this->Form_model->list_common('team_leader');
            $total = $this->report_model->report_data($short_name, $limit, $offset);
            $data['count'] = $total;
            $data['offset'] = (empty($offset) || $offset == 1) ? '1' : $offset + 1;
            $data['total_premium'] = (array_sum(array_column($data['fresh_operation'], 'net_premium')));
            $data1 = $this->underwriter_model->fetch_sidebar_group_id('sidebar_group', 'group_short_name', $short_name);
            foreach ($data1 as $val) {
                $data['disposition_name'] = $this->underwriter_model->fetch_sidebar_group_id('disposition', 'module', $val['sidebar_id']);
            }

            return $this->load->view('admin/report/service_report', $data);
        } else {
            $this->session->set_flashdata('denied', 'Access Denied!');
            return $this->load->view('admin/login');
        }
    }

    public function claim_dump_report($offset = null)
    {
        if ($this->session->userdata('pmsadmin') == true) {

            $limit = 50;
            $offset = ($offset == null || $offset == 1) ? '0' : ($offset - 1) * ($limit);
            $data['claim'] = $this->report_model->list_common('claim', $limit, $offset);
            $data['company'] = $this->Form_model->list_common('company');
            $total = $this->report_model->claim_data('claim', 'flag', '0');
            $data['count'] = $total;
            $data['total_premium'] = (array_sum(array_column($data['claim'], 'total_approve_amt')));
            $data['offset'] = (empty($offset) || $offset == 1) ? '1' : $offset + 1;
            return $this->load->view('admin/report/claim_report', $data);
        } else {
            $this->session->set_flashdata('denied', 'Access Denied!');
            return $this->load->view('admin/login');
        }
    }

    public function renewal_booked_report($offset = null)
    {
        if ($this->session->userdata('pmsadmin') == true) {

            $limit = 50;
            $offset = ($offset == null || $offset == 1) ? '0' : ($offset - 1) * ($limit);
            $data['renewal'] = $this->report_model->renewal_report($limit, $offset);
            $data['company'] = $this->Form_model->list_common('company');
            $data['team_leader'] = $this->Form_model->list_common('team_leader');
            $data['disposition_name'] = $this->db->query("select * from disposition where module = '6' and flag='0';")->result_array();
            $total = $this->report_model->renewal_data($limit, $offset);
            $data['count'] = $total;
            $data['total_premium'] = (array_sum(array_column($data['renewal'], 'net_premium')));
            $data['offset'] = (empty($offset) || $offset == 1) ? '1' : $offset + 1;
            return $this->load->view('admin/report/renewal_report', $data);
        } else {
            $this->session->set_flashdata('denied', 'Access Denied!');
            return $this->load->view('admin/login');
        }
    }

    public function exportexcel($claim_intimation_no = 'claim')
    {


        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=" . $claim_intimation_no . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo '<table border="1">';


        echo '<tr>
            <th>S.No</th>
            <th>Policy No.</th>
            <th>Patient Name</th>
            <th>Company</th>
            <th>Claim Intimation No</th>
            <th>Reason For Admit</th>

            <th>Health Card</th>
            <th>Admission Date</th>
            <th>Network/Non Network</th>
            <th>Claim Type</th>
            <th>Claim For</th>
            <th>Pre Auth Status</th>

            <th>Pre Auth Amount</th>
            <th>Claim Status</th>
            <th>Total Bill Amount</th>
            <th>Total Approve Amount </th>
            <th>Hospital Discount</th>
            <th>Deduction Amount</th>

            <th>Deduction Amount Detail</th>
            <th>Paid on</th>
            <th>Remark</th>
            <th>Final Status</th>
            </tr>';

        $booth_details = $this->report_model->list_common('claim');

        if (!empty($booth_details)) {
            foreach ($booth_details as $key => $row) {
                echo "<tr>
                        <td>" . ($key + 1) . "</td>
                        <td>" . $row['policy_no'] . "</td>
                        <td>" . $row['patient_name'] . "</td>
                        <td>" . $row['company_name'] . "</td>
                        <td>" . $row['claim_intimation_no'] . "</td>
                        <td>" . $row['reason_admit'] . "</td>

                        
                        <td>" . $row['health_card'] . "</td>
                        <td>" . $row['admission_date'] . "</td>
                        <td>" . $row['is_network'] . "</td>
                        <td>" . $row['claim_type'] . "</td>

                        <td>" . $row['claim_for'] . "</td>
                        <td>" . $row['pre_auth_status'] . "</td>
                        <td>" . $row['pre_auth_amt'] . "</td>
                        <td>" . $row['claim_status'] . "</td>

                        <td>" . $row['total_bill_amt'] . "</td>
                        <td>" . $row['total_approve_amt'] . "</td>
                        <td>" . $row['hospital_discount'] . "</td>
                        <td>" . $row['deduction_amt'] . "</td>

                        <td>" . $row['deduction_amt_details'] . "</td>
                        <td>" . $row['paid_on'] . "</td>
                        <td>" . $row['remarks'] . "</td>
                        <td>" . $row['final_status'] . "</td>
                    </tr>";
            }
        }


        echo '</table>';

        exit();
    }

    public function exportexcel_service($claim_intimation_no = 'services')
    {
        $start_date = $this->input->post('start_date');
      
        $end_date  = $this->input->post('end_date');
        
        $sel_for_filter = $this->input->post('sel_for_filter');
        
       
        $select_attribute = $this->input->post('select_attribute');
		
        $date_or_date = $this->input->post('current_date');
        $date_or_month = $this->input->post('current_month');
        $content =  $this->input->post('search');
        $company_name = $this->input->post('company_name');
       
        $tl_name1 = $this->input->post('tl_name1');
        $module_short_name = $this->input->post('module_short_name');
        // $current_date = $this->input->post('current_date');
        $module_short_name = 'services';

        

        $current_date = '';
		$current_month = '';
        if ($date_or_date == 'current_date') {
			date_default_timezone_set('Asia/Kolkata');
			$current_date = date('Y-m-d');
		}  
        if($date_or_month == 'current_month'){
			date_default_timezone_set('Asia/Kolkata');
			$current_month = date('Y-m');
		}

        if(!empty($start_date && (!empty($end_date))) || (!empty($module_short_name)) || (!empty($sel_for_filter)) || (!empty($current_date)) || (!empty($current_month))){
            $fresh_operation  = $this->filter_model->list_common_where_services($start_date, $end_date,$module_short_name, $sel_for_filter,$current_date, $current_month);
        }

       
        if ($select_attribute == 'by_company') {
			$searchstring = $this->input->post('company_name');
            $fresh_operation  = $this->filter_model->company_searchdata_service_list_page1($searchstring, $start_date, $end_date,$module_short_name,$sel_for_filter,$current_date, $current_month);   
		}
        
       
		if ($select_attribute == 'by_policy_no') {
			$fresh_operation  = $this->filter_model->policy_searchdata_list_page($content,$start_date, $end_date, $sel_for_filter,$current_date, $current_month);
                                                                                
		}
       
		if ($select_attribute == 'by_customer_name') {
            $searchstring = $this->input->post('company_name');
			$fresh_operation  = $this->filter_model->cust_filterdate_list($searchstring,$start_date, $end_date, $sel_for_filter,$module_short_name,$current_date, $current_month);
                                                                        
		}
       
		if ($select_attribute == 'by_tl') {
			 $searchstring = $this->input->post('tl_name1');
			$fresh_operation  = $this->filter_model->tl_searchdata_list_page($searchstring,$current_date, $current_month);
                                                                                
		}
        
		if ($select_attribute == 'by_log_id') {
           // $searchstring = $this->input->post('by_log_id');
			$fresh_operation  = $this->filter_model->log_searchdata_list_page($content,$start_date, $end_date, $sel_for_filter,$module_short_name,$current_date, $current_month);
                                                                            
		}
		if ($select_attribute == 'by_cust_id') {
			$fresh_operation  = $this->filter_model->cust_searchdata_list_page($content,$start_date, $end_date, $sel_for_filter, $module_short_name,$current_date, $current_month);
                                                                             
		}
        
       
       
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=" . $claim_intimation_no . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo '<table border="1">';


        echo '<tr>

                <th>S.No</th>
                <th>Policy No.</th>
                <th>Log ID</th>
                <th>Cust ID </th>
                <th>Cust Name</th>
                <th>Phone No.</th>

                <th>Alternate No.</th>
                <th>Email Id</th>
                <th>City</th>
                <th>D.O.B</th>
                <th>Company Name</th>
                <th>Product Name</th>

                <th>Cover Type</th>
                <th>Family Type</th>
                <th>Sum Assured</th>
                <th>Date </th>
                <th>Premium</th>
                <th>Net Premium</th>

                <th>Counted Premium</th>
                <th>Type</th>
                <th>Term</th>
                <th>Port Term</th>
                <th>Zone</th>
                <th>Agent</th>
                <th>TL</th>
                <th>Login</th>
                <th>Disposition</th>
                <th>Call Date</th>
            </tr>';
            

		
        $short_name = "services";
        $team_leader = $this->Form_model->list_common('team_leader');
        // $fresh_operation = $this->report_model->filterdate_listpage1($short_name,$start_date,$end_date,$sel_for_filter,$company_name,$tl_name1,$limit=null, $offset=null);
       
        $company = $this->Form_model->list_common('company');

        if (!empty($fresh_operation)) {
            foreach ($fresh_operation as $key => $row) {
                $id = $row['disposition'];
                $disp = $this->Form_model->list_common_where3('disposition', 'id', $id);

                echo "<tr>
                        <td>" . ($key + 1) . "</td>
                        <td>" . (!empty($row['policy_no']) ? $row['policy_no'] : "NA") . "</td>
                        <td>" . (!empty($row['log_id']) ? $row['log_id'] : "NA") . "</td>
                        <td>" . (!empty($row['id']) ? $row['id'] : "NA") . "</td>
                        <td>" . (!empty($row['customer_name']) ? $row['customer_name'] : $row['proposer_name']) . "</td>
                        <td>" . (!empty($row['contact']) ? $row['contact'] : "NA") . "</td>
                        
                        <td>" . (!empty($row['alternate_no']) ? $row['alternate_no'] : "NA") . "</td>
                        <td>" . (!empty($row['email']) ? $row['email'] : "NA") . "</td>
                        <td>" . (!empty($row['customer_city']) ? $row['customer_city'] : "NA") . "</td>
                        <td>" . (!empty($row['dob']) ? $row['dob'] : "NA") . "</td>
                        
                        <td>" . ($row['company_name'] == $company[0]['id'] ? $company[0]['name'] : 'NA') . "</td>
                        <td>" . (!empty($row['product_name']) ? $row['product_name'] : "NA") . "</td>
                        <td>" . (!empty($row['cover_type']) ? $row['cover_type'] : "NA") . "</td>
                        <td>" . (!empty($row['coverage_type']) ? $row['coverage_type'] : "NA") . "</td>
                        <td>" . (!empty($row['sum_assured_1']) ? $row['sum_assured_1'] : "NA") . "</td>
                       
                        <td>" . (!empty($row['created_at']) ? $row['created_at'] : "NA") . "</td>
                        <td>" . (!empty($row['gross_premium']) ? $row['gross_premium'] : "NA") . "</td>
                        <td>" . (!empty($row['net_premium']) ? $row['net_premium'] : "NA") . "</td>
                        <td>" . (!empty($row['counted_premium']) ? $row['counted_premium'] : "NA") . "</td>
                        <td>" . (!empty($row['policy_type']) ? $row['policy_type'] : "NA") . "</td>
                        <td>" . (!empty($row['payment_tenure']) ? $row['payment_tenure'] : "NA") . "</td>
                        <td>" . (!empty($row['portability_duration']) ? $row['portability_duration'] : "NA") . "</td>
                        
                        <td>" . (!empty($row['zone']) ? $row['zone'] : "NA") . "</td>
                        <td>" . (!empty($row['agent']) ? $row['agent'] : "NA") . "</td>
                        <td>" . ($row['tl'] == $team_leader[0]['id'] ? $team_leader[0]['name'] : "NA") . "</td>
                        <td>" . (!empty($row['login']) ? $row['login'] : "NA") . "</td>
                        
                        <td>" . (!empty($disp[0]['disposition']) ? $disp[0]['disposition'] : "NA") . "</td>
                        <td>" . (!empty($row['created_at']) ? $row['created_at'] : "NA") . "</td>
                    </tr>";
            }
        }


        echo '</table>';

        exit();
    }
    // public function exportexcel_report_opration($claim_intimation_no = 'operations')
    // {


    //     header("Content-Type: application/xls");
    //     header("Content-Disposition: attachment; filename=" . $claim_intimation_no . ".xls");
    //     header("Pragma: no-cache");
    //     header("Expires: 0");

    //     echo '<table border="1">';


    //     echo '<tr>

    //     <th>S.No</th>
    //     <th>Policy No.</th>
    //     <th>Log ID</th>
    //     <th>Cust Name</th>
    //     <th>Phone No.</th>

    //     <th>Alternate No.</th>
    //     <th>Email Id</th>
    //     <th>City</th>
    //     <th>D.O.B</th>
    //     <th>Company Name</th>
    //     <th>Product Name</th>

    //     <th>Cover Type</th>
    //     <th>Family Type</th>
    //     <th>Sum Assured</th>
    //     <th>Date </th>
    //     <th>Premium</th>
    //     <th>Net Premium</th>

    //     <th>Counted Premium</th>
    //     <th>Type</th>
    //     <th>Term</th>
    //     <th>Port Term</th>
    //     <th>Medical</th>
    //     <th>Zone</th>

    //     <th>Agent</th>
    //     <th>TL</th>
    //     <th>Manager</th>
    //     <th>Data Source</th>
    //     <th>Login</th>
    //     <th>Issued Status</th>

    //     <th>Policy Enforced Date</th>
    //     <th>PED</th>
    //     <th>Discount</th>
    //     <th>Rider</th>
    //     <th>U/W Remark</th>

    //     <th>Policy Start Date</th>
    //     <th>Policy End Date</th>
    //     <th>Policy Source</th>
    //     <th>Operation Remark</th>
    //         </tr>';

    //     $short_name = "operations";
    //     $team_leader = $this->Form_model->list_common('team_leader');
    //     $manager = $this->Form_model->list_common('manager');
    //     $add_member = $this->Form_model->list_common('add_member');
    //     $disposition = $this->Form_model->list_common('disposition');

    //     $operation = $this->report_model->filterdate_listpage($short_name);
    //     $company = $this->Form_model->list_common('company');

    //     if (!empty($operation)) {
    //         foreach ($operation as $key => $row) {
    //             $insured_ped = $this->Form_model->list_common_data('insured_pd_details',$row['id']);
    //             $underwriter_ped = $this->Form_model->list_common_data('insured_pd_details',$row['id']);
    //             echo "<tr>
    //                     <td>" . ($key + 1) . "</td>
    //                     <td>" . (!empty($row['policy_no']) ? $row['policy_no'] : "NA") . "</td>
    //                     <td>" . (!empty($row['log_id']) ? $row['log_id'] : "NA") . "</td>
    //                     <td>" . (!empty($row['customer_name']) ? $row['customer_name'] : $row['proposer_name']) . "</td>
    //                     <td>" . (!empty($row['contact']) ? $row['contact'] : "NA") . "</td>

    //                     <td>" . (!empty($row['alternate_no']) ? $row['alternate_no'] : "NA") . "</td>
    //                     <td>" . (!empty($row['email']) ? $row['email'] : "NA") . "</td>
    //                     <td>" . (!empty($row['customer_city']) ? $row['customer_city'] : "NA") . "</td>
    //                     <td>" . (!empty($row['dob']) ? $row['dob'] : "NA") . "</td>
    //                     <td>" . ($row['company_name'] == $company[0]['id'] ? $company[0]['name'] : 'NA') . "</td>

    //                     <td>" . (!empty($row['product_name']) ? $row['product_name'] : "NA") . "</td>
    //                     <td>" . (!empty($row['cover_type']) ? $row['cover_type'] : "NA") . "</td>
    //                     <td>" . (!empty($row['coverage_type']) ? $row['coverage_type'] : "NA") . "</td>
    //                     <td>" . (!empty($row['sum_assured_1']) ? $row['sum_assured_1'] : "NA") . "</td>
    //                     <td>" . (!empty($row['created_at']) ? $row['created_at'] : "NA") . "</td>

    //                     <td>" . (!empty($row['gross_premium']) ? $row['gross_premium'] : "NA") . "</td>
    //                     <td>" . (!empty($row['net_premium']) ? $row['net_premium'] : "NA") . "</td>
    //                     <td>" . (!empty($row['counted_premium']) ? $row['counted_premium'] : "NA") . "</td>
    //                     <td>" . (!empty($row['policy_type']) ? $row['policy_type'] : "NA") . "</td>
    //                     <td>" . (!empty($row['payment_tenure']) ? $row['payment_tenure'] : "NA") . "</td>

    //                     <td>" . (!empty($row['portability_duration']) ? $row['portability_duration'] : "NA") . "</td>
    //                     <td>" . (!empty($row['medical']) ? $row['medical'] : "NA") . "</td>
    //                     <td>" . (!empty($row['zone']) ? $row['zone'] : "NA") . "</td>
    //                     <td>" . (!empty($row['agent']) ? $row['agent'] : "NA") . "</td>

    //                     <td>" . ($row['tl'] == $team_leader[0]['id'] ? $team_leader[0]['name'] : "NA") . "</td>
    //                     <td>" . ($row['manager'] == $manager[0]['id'] ? $manager[0]['name'] : "NA") . "</td>
    //                     <td>" . (!empty($row['data_source']) ? $row['data_source'] : "NA") . "</td>
    //                     <td>" . (!empty($row['login']) ? $row['login'] : "NA") . "</td>
    //                     <td>" . ($row['disposition'] == $disposition[0]['id'] ? $disposition[0]['disposition'] : "NA") . "</td>

    //                     <td>" . ($row["disposition"] == '28' ? $row['enforced_date'] : "NA") . "</td>
    //                     <td>" . $id = $row['form_id']. "</td>
    //                     <td>" . (!empty($row['discount']) ? $row['discount'] : "NA") . "</td>
    //                     <td>" . (!empty($row['rider']) ? $row['rider'] : "NA") . "</td>
    //                     <td>" . ($row['id'] == $add_member[0]['form_id'] ? $add_member[0]['underwriter_ped'] : "NA") . "</td>

    //                     <td>" . (!empty($row['policy_start_date']) ? $row['policy_start_date'] : "NA") . "</td>
    //                     <td>" . (!empty($row['policy_end_date']) ? $row['policy_end_date'] : "NA") . "</td>
    //                     <td>" . (!empty($row['policy_source']) ? $row['policy_source'] : "NA") . "</td>

    //                 </tr>";
    //         }
    //     }


    //     echo '</table>';

    //     exit();
    // }

    public function exportexcel_report_opration($claim_intimation_no = 'operations')
    {
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=" . $claim_intimation_no . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

       // $start_date = $this->input->post('start_date');
        //$end_date = $this->input->post('end_date');

        //$sel_for_filter = $this->input->post('sel_for_filter');
        // $select_attribute = $this->input->post('select_attribute');
       // $company_name = $this->input->post('company_name');
        //$tl_name1 = $this->input->post('tl_name1');

       // $data['company'] = $this->Form_model->list_common('company');
        //$data['team_leader'] = $this->Form_model->list_common('team_leader');
        //$data['manager'] = $this->Form_model->list_common('manager');
        //$data['fresh_operation'] = $this->report_model->report_data_operations1($claim_intimation_no,$start_date,$end_date,$sel_for_filter,$company_name,$tl_name1);

        $start_date = $this->input->post('start_date');
      
        $end_date  = $this->input->post('end_date');
        
        $sel_for_filter = $this->input->post('sel_for_filter');
       
       
        $select_attribute = $this->input->post('select_attribute');
		
        $date_or_date = $this->input->post('current_date');
        $date_or_month = $this->input->post('current_month');
        $content =  $this->input->post('search');
        $company_name = $this->input->post('company_name');
       
       
        $tl_name1 = $this->input->post('tl_name1');
        $module_short_name = $this->input->post('module_short_name');
        // $current_date = $this->input->post('current_date');
        //$module_short_name = 'services';

        print_r($_POST);

        $current_date = '';
		$current_month = '';
        if ($date_or_date == 'current_date') {
			date_default_timezone_set('Asia/Kolkata');
			$current_date = date('Y-m-d');
		}  
        if($date_or_month == 'current_month'){
			date_default_timezone_set('Asia/Kolkata');
			$current_month = date('Y-m');
		}

        if(!empty($start_date && (!empty($end_date))) || (!empty($module_short_name)) || (!empty($sel_for_filter)) || (!empty($current_date)) || (!empty($current_month))){
            $data['fresh_operation']  = $this->filter_model->list_common_where_services($start_date, $end_date,$module_short_name, $sel_for_filter,$current_date, $current_month);
        }
        
       
        if (!empty($company_name == 'by_company' ) ) {
            $company_name = $this->input->post('company_name');
			$data['fresh_operation']  = $this->filter_model->company_filterdate_list($company_name, $start_date, $end_date, $module_short_name, $sel_for_filter, $current_date, $current_month); 
		}
        
       
		if (!empty($start_date && (!empty($end_date))) || (!empty($select_attribute == 'by_policy_no')) || (!empty($sel_for_filter)) || (!empty($current_date)) || (!empty($current_month))) {
			$data['fresh_operation']  = $this->filter_model->policy_searchdata_list_page($content,$start_date, $end_date, $sel_for_filter,$current_date, $current_month);
                                                                                
		}
       
		if (!empty($start_date && (!empty($end_date))) || (!empty($select_attribute == 'by_customer_name')) || (!empty($module_short_name)) || (!empty($sel_for_filter)) || (!empty($current_date)) || (!empty($current_month)) ){
            // $searchstring = $this->input->post('company_name');
			$data['fresh_operation']  = $this->filter_model->cust_filterdate_list($content,$start_date, $end_date, $sel_for_filter,$module_short_name,$current_date, $current_month);
                                                                        
		}
       
		if ((!empty($select_attribute == 'by_tl')) || (!empty($current_date)) || (!empty($current_month))  ) {
            $searchstring = $this->input->post('tl_name1');
			$data['fresh_operation']  = $this->filter_model->teamleader_filterdate_list($searchstring, $start_date, $end_date, $sel_for_filter, $module_short_name, $current_date, $current_month);
                                                                                
		}
        
		if ($select_attribute == 'by_log_id') {
           // $searchstring = $this->input->post('by_log_id');
           $data['fresh_operation'] = $this->filter_model->log_searchdata_list_page($content,$start_date, $end_date, $sel_for_filter,$module_short_name,$current_date, $current_month);
                                                                            
		}
		if ($select_attribute == 'by_cust_id') {
			$data['fresh_operation']  = $this->filter_model->cust_searchdata_list_page($content,$start_date, $end_date, $sel_for_filter, $module_short_name,$current_date, $current_month);                                                                     
		}
        // if(!empty($start_date && (!empty($end_date))) || (!empty($module_short_name)) || (!empty($sel_for_filter)) ||  (!empty($tl_name1))){
        //     $data['fresh_operation'] = $this->report_model->report_data_operations1($module_short_name,$start_date,$end_date,$sel_for_filter,$tl_name1);
        // }                                                                           
        
         //$data['company'] = $this->Form_model->list_common('company');

       // print_r($data);

        $this->load->view('admin/excel',$data);
    }

    public function exportexcel_renawal_report($claim_intimation_no = 'renewals')
    {
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=" . $claim_intimation_no . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo '<table border="1">';


        echo '<tr>
          
                <th>S.No</th>
                <th>Customer Name</th>
                <th>Policy</th>
                <th>New Policy</th>
                <th>Phone No.</th>
                <th>Alternate No.</th>
                <th>Alternate No.2</th>
                <th>Email</th>
                <th>City</th>
                <th>Date Of Birth</th>
                <th>Company Name</th>
                <th>Product Name</th>

                <th>Policy End Date</th>
                <th>Payment Due On</th>
                <th>Family Type</th>
                <th>Sum Assured</th>
                <th>Payment Date</th>
                <th>Due Renewal</th>

                <th>Paid Renewal</th>
                <th>Upsell</th>
                <th>Tenure</th>
                <th>Agent Name</th>
                <th>Payment Mode</th>
                <th>Discount</th>
                <th>Upselling</th>
            </tr>';


        $renewal = $this->report_model->renewal_report();
        $company = $this->Form_model->list_common('company');
        if (!empty($renewal)) {
            foreach ($renewal as $key => $row) {
                $json = json_decode($row['sub_remark'], true);

                echo "<tr>
                        <td>" . ($key + 1) . "</td>
                        <td>" . (!empty($row['customer_name']) ? $row['customer_name'] : $row['proposer_name']) . "</td>
                        <td>" . (!empty($row['policy_no']) ? $row['policy_no'] : 'NA') . "</td>
                        <td>" . (!empty($json['New Policy']) ? $json['New Policy'] : 'NA') . "</td>
                        <td>" . (!empty($row['contact']) ? $row['contact'] : 'NA') . "</td>
                        <td>" . (!empty($json['Alternate Number']) ? $json['Alternate Number'] : 'NA') . "</td>
                        <td>" . (!empty($row['alternate_no']) ? $row['alternate_no'] : 'NA') . "</td>
                        
                        <td>" . (!empty($row['email']) ? $row['email'] : 'NA') . "</td>
                        <td>" . (!empty($row['customer_city']) ? $row['customer_city'] : 'NA') . "</td>
                        <td>" . (!empty($json['Proposer Date Of Birth']) ? $json['Proposer Date Of Birth'] : 'NA') . "</td>
                        <td>" . ($row['company_name'] == $company[0]['id'] ? $company[0]['name'] : 'NA') . "</td>
                        <td>" . (!empty($row['product_name']) ? $row['product_name'] : 'NA') . "</td>
                        <td>" . (!empty($row['policy_end_date']) ? $row['policy_end_date'] : 'NA') . "</td>
                        <td>" . (!empty($row['coverage_type']) ? $row['coverage_type'] : 'NA') . "</td>
                        <td>" . (!empty($json['New Sum Assured']) ? $json['New Sum Assured'] : 'NA') . "</td>
                        
                        
                        <td>" . (!empty($json['New Payment Tenure']) ? $json['New Payment Tenure'] : 'NA') . "</td>
                        <td>" . (!empty($row['agent']) ? $row['agent'] : 'NA') . "</td>
                        <td>" . (!empty($json['New Payment Mode']) ? $json['New Payment Mode'] : 'NA') . "</td>
                        <td>" . (!empty($json['New Discount']) ? $json['New Discount'] : 'NA') . "</td>
                        <td>" . (!empty($json['Upselling']) ? $json['Upselling'] : 'NA') . "</td>
                       
                    </tr>";
            }
        }


        echo '</table>';

        exit();
    }
}
