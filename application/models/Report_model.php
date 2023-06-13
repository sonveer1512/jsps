<?php
if (!defined('BASEPATH')) exit('Hacking Attempt : Get Out of the system ..!');

class Report_model extends CI_Model

{

	public function __construct()

	{

		parent::__construct();
	}
	public function list_common_where($table, $short_name, $limit = null, $offset = null)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('updated_by_user_module', $short_name);
		$this->db->where('flag', '0');
		if (!empty($limit)) {
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function filterdate_listpage1($short_name,$start_date,$end_date,$sel_for_filter,$company_name,$tl_name1, $limit = null, $offset = null)
	{
		$this->db->select('form.*,MAX(form_disposition_remark.id) as form_disp_id,form_disposition_remark.user_id as user_id,form.id as form_id,form_disposition_remark.created_at as enforced_date');
		$this->db->from('form');
		$this->db->join('form_disposition_remark', 'form.id = form_disposition_remark.form_id', 'left');
		$this->db->where('form_disposition_remark.done_by_module', $short_name);
		$this->db->where('form.updated_by_user_module', $short_name);
		if(!empty($start_date && $end_date)){
			$this->db->where('form.date_of_closure BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		}
		if(!empty($sel_for_filter)){
		$this->db->where('form.disposition', $sel_for_filter);
		
		}
		if(!empty($company_name)){
			$this->db->where('form.company_name', $company_name);
		}
		if(!empty($tl_name1)){
			$this->db->where('form.tl', $tl_name1);
		}
		$this->db->where('form.flag', '0');
		if (!empty($limit)) {
			$this->db->limit($limit, $offset);
		}
		$this->db->where('form_disposition_remark.flag', '0');
		$this->db->group_by('form.policy_no');
		$this->db->group_by('form_disposition_remark.form_id');
		$this->db->order_by('form.date_of_closure','DESC');
		
		// $this->db->select('form.*,form.id as form_id,form_disposition_remark.created_at as enforced_date,form_disposition_remark.remark as remark');
		// $this->db->from('form');	
		// $this->db->join('form_disposition_remark', 'form.id = form_disposition_remark.form_id', 'left');
		// $this->db->where('form_disposition_remark.id IN (SELECT MAX(id) FROM `form_disposition_remark`  GROUP BY user_id,form_id)');
		// $this->db->where('form.flag', '0');
		// $this->db->where('form_disposition_remark.flag', '0');
		// if (!empty($limit)) {
		// 	$this->db->limit($limit, $offset);
		// }
		
    	// $this->db->order_by('form.id','desc');
		
		
		$query = $this->db->get();
		$result = $query->result_array();
		

		return $result;
	}

	public function filterdate_listpage($short_name,$limit=null,$offset=null)
	{
		$this->db->select('form.*,MAX(form_disposition_remark.id) as form_disp_id,form_disposition_remark.user_id as user_id,form.id as form_id,form_disposition_remark.created_at as enforced_date');
		$this->db->from('form');
		$this->db->join('form_disposition_remark', 'form.id = form_disposition_remark.form_id', 'left');
		$this->db->where('form_disposition_remark.done_by_module', $short_name);
		$this->db->where('form.updated_by_user_module', $short_name);
		
		$this->db->where('form.flag', '0');
		if (!empty($limit)) {
			$this->db->limit($limit, $offset);
		}
		$this->db->where('form_disposition_remark.flag', '0');
		$this->db->group_by('form.policy_no');
		$this->db->group_by('form_disposition_remark.form_id');
		$this->db->order_by('form.date_of_closure','DESC');
		
		// $this->db->select('form.*,form.id as form_id,form_disposition_remark.created_at as enforced_date,form_disposition_remark.remark as remark');
		// $this->db->from('form');	
		// $this->db->join('form_disposition_remark', 'form.id = form_disposition_remark.form_id', 'left');
		// $this->db->where('form_disposition_remark.id IN (SELECT MAX(id) FROM `form_disposition_remark`  GROUP BY user_id,form_id)');
		// $this->db->where('form.flag', '0');
		// $this->db->where('form_disposition_remark.flag', '0');
		// if (!empty($limit)) {
		// 	$this->db->limit($limit, $offset);
		// }
		
    	// $this->db->order_by('form.id','desc');

		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function list_common($table, $limit = null, $offset = null)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('flag', '0');
		if (!empty($limit)) {
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function report_data($short_name)
	{
		$this->db->select('form.*,MAX(form_disposition_remark.id) as form_disp_id,,form.id as form_id,form_disposition_remark.created_at as enforced_date');
		$this->db->from('form');
		$this->db->join('form_disposition_remark', 'form.id = form_disposition_remark.form_id', 'left');
		$this->db->where('form_disposition_remark.done_by_module', $short_name);
		$this->db->where('form.flag', '0');
		$this->db->where('form_disposition_remark.flag', '0');
		$this->db->group_by('form_disposition_remark.user_id');
		$this->db->group_by('form_disposition_remark.form_id');
		
		$query = $this->db->get();
		$result = $query->num_rows();
		return $result;
	}
	public function report_data_operations1($short_name,$start_date,$end_date,$sel_for_filter,$tl_name1)
	{
		$this->db->select('form.*,MAX(form_disposition_remark.id) as form_disp_id,,form.id as form_id,form_disposition_remark.created_at as enforced_date');
		$this->db->from('form');
		$this->db->join('form_disposition_remark', 'form.id = form_disposition_remark.form_id', 'left');
		$this->db->where('form_disposition_remark.done_by_module', $short_name);
		$this->db->where('form.flag', '0');
		$this->db->where('form.date_of_closure BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		if(!empty($sel_for_filter)){
			$this->db->where('form.disposition', $sel_for_filter);	
		}
		// if(!empty($company_name)){
		// 		$this->db->where('form.company_name', $company_name);
		// }
		if(!empty($tl_name1)){
				$this->db->where('form.tl', $tl_name1);
			}
		$this->db->where('form_disposition_remark.flag', '0');
		$this->db->group_by('form_disposition_remark.user_id');
		$this->db->group_by('form_disposition_remark.form_id');
		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function report_data_operations($short_name)
	{
		$this->db->select('form.*,MAX(form_disposition_remark.id) as form_disp_id,,form.id as form_id,form_disposition_remark.created_at as enforced_date');
		$this->db->from('form');
		$this->db->join('form_disposition_remark', 'form.id = form_disposition_remark.form_id', 'left');
		$this->db->where('form_disposition_remark.done_by_module', $short_name);
		$this->db->where('form.flag', '0');
		//$this->db->where('form.date_of_closure BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$this->db->where('form_disposition_remark.flag', '0');
		$this->db->group_by('form_disposition_remark.user_id');
		$this->db->group_by('form_disposition_remark.form_id');
		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function renewal_report()
	{
		$this->db->select('sub_desposition.form_id,sub_desposition.policy_no,sub_desposition.desposition_id,sub_desposition.sub_desposition_name,sub_desposition.remark as sub_remark,sub_desposition.action,sub_desposition.action,sub_desposition.condition,sub_desposition.module,form.*');
		$this->db->from('sub_desposition');
		$this->db->join('form', 'sub_desposition.form_id = form.id', 'inner');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function claim_data($table, $where, $id, $limit = null, $offset = null)
	{
		$this->db->select('id');
		$this->db->from($table);
		$this->db->where($where, $id);

		if (!empty($limit)) {
			$this->db->limit($limit, $offset);
		}

		$query = $this->db->get();
		$result = $query->num_rows();
		return $result;
	}
	public function renewal_data($limit = null, $offset = null)
	{
		$this->db->select('sub_desposition.form_id,sub_desposition.policy_no,sub_desposition.desposition_id,sub_desposition.sub_desposition_name,sub_desposition.remark as sub_remark,sub_desposition.action,sub_desposition.action,sub_desposition.condition,sub_desposition.module,form.*');
		$this->db->from('sub_desposition');
		$this->db->join('form', 'sub_desposition.form_id = form.id', 'inner');
		if (!empty($limit)) {
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get();
		$result = $query->num_rows();
		return $result;
	}

	public function serach1(){

		$this->db->select('form.*,form_disposition_remark.*');
			$this->db->from('form');
			$this->db->join('form_disposition_remark', 'form.id = form_disposition_remark.form_id', 'left');
			if (!empty($startdate) && !empty($enddate)) {
				$this->db->where('(LEFT(form.date_of_closure,10) BETWEEN "' . $startdate . '" and "' . $enddate . '")');
			}
			if (!empty($sel_dis)) {
				$this->db->where('form_disposition_remark.disposition', $sel_dis);
			}
			if (!empty($model_short_name)) {
				$this->db->where('form_disposition_remark.done_by_module', 'services');
			}
			if (!empty($current_date)) {
				$this->db->where('form.date_of_closure', $current_date);
			}
			if (!empty($current_month)) {
				$this->db->where('LEFT(form.date_of_closure,7)', $current_month);
			}
			$this->db->where('form.flag', '0');
			$query = $this->db->get();
			$result = $query->result_array();

			return $result;
	}
}
