<?php
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('memory_limit', '256M');




defined('BASEPATH') or exit('No direct script access allowed');

class UploadOldExcel extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('upload_excel_model');
        $this->load->helper('date_format_helper');
        
       
      
    }


    public function index()
    {

        if ($this->session->userdata('pmsadmin') == true) {
            $data['old_list'] = $this->upload_excel_model->list_common_where('form','old_new','1');
            return $this->load->view('admin/master/upload_old_excel', $data);
        } else {
            $this->session->set_flashdata('denied', 'Access Denied!');
            return $this->load->view('admin/login');
        }
    }
    // public function upload()
    // {
    //  error_reporting(0);
      
    //     require_once APPPATH . "./third_party/PHPExcel.php";
    //  	$path = 'uploads/';
    //     $config['upload_path'] = $path;
    //     $config['allowed_types'] = 'xlsx|xls';
    //     $config['remove_spaces'] = TRUE;
    //     $this->load->library('upload', $config);
    //     $this->upload->initialize($config);
    //     if ($this->upload->do_upload('uploadFile')) {
            
    //         $error = array('error' => $this->upload->display_errors());
            
    //     } else {
            
    //         $data = array('upload_data' => $this->upload->data());
           
            
           

    //     }
       
    //     if (!empty($data['upload_data']['file_name'])) {
           
    //         $import_xls_file = $data['upload_data']['file_name'];
            

            
    //     } else {
    //         $import_xls_file = 0;
    //     }

    //     $inputFileName = $path . $import_xls_file;
    
    //     try {
    //         $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    //         $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    //         $objPHPExcel = $objReader->load($inputFileName);
    //         $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

    //         $flag = true;
    //         $i=0;

    //         foreach ($allDataInSheet as $key => $value) {
              	
    //           	if($key > 1) {
    //               	if(!empty($value['A'])) {
                      	
    //                     $inserdata['policy_no'] = $policy_no =  $value['A'];
    //                     $inserdata['proposer_name'] = $value['B'];
    //                     $inserdata['contact'] = $value['C'];
    //                     $inserdata['alternate_no'] = $value['D'];
    //                     $inserdata['email'] = $value['E'];
    //                     $inserdata['customer_city'] = $value['F'];
    //                     $inserdata['dob'] = $value['G'];
    //                   	$get_com_name =  $this->upload_excel_model->list_common_where('company','name', $value['H']);
    //                     $inserdata['company_name'] = $get_com_name[0]['id'];
    //                     $inserdata['product_name'] = $value['I'];
    //                     $inserdata['cover_type'] = $value['J'];
    //                     $inserdata['coverage_type'] = $value['K'];
    //                     $inserdata['sum_assured_1'] = $value['L'];
    //                     $inserdata['date_of_closure'] = $value['M'];
    //                     $inserdata['gross_premium'] = $value['N'];
    //                     $inserdata['net_premium'] = $value['O'];
    //                     $inserdata['policy_type'] = $value['P'];
    //                     $inserdata['payment_tenure'] = $value['Q'];
    //                     $inserdata['portability'] = $value['R'];
    //                     $inserdata['zone'] = $value['S'];
    //                   	$inserdata['agent'] = $value['T'];
    //                     $inserdata['data_source'] = $value['U'];
    //                   	$get_tl_name =  $this->upload_excel_model->list_common_where('team_leader','name', $value['V']);
    //                   	if(!empty($get_tl_name[0]['id']))
    //                     {
    //                     $inserdata['tl'] = $get_tl_name[0]['id'];
    //                     }else{
    //                     $inserdata['tl'] = 0;
    //                     }
    //                     $inserdata['policy_start_date'] = $value['W'];
    //                     $inserdata['policy_end_date'] = $value['X'];
    //                   	$inserdata['old_new'] = '1';
    //                   //print_r($inserdata);exit;
    //                     $check_policy_no = $this->upload_excel_model->check_policy('form', 'policy_no', $policy_no);
    //                     if ($check_policy_no > 0) {
    //                         $update_data = $this->db->where('policy_no', $policy_no);
    //                         $update_data = $this->db->update('form', $inserdata);
    //                     } else {
    //                         $update_data = $this->db->insert('form', $inserdata);
    //                     }
    //                 }  
    //             }
              
    //             $i++;                
    //         }
          
    //      if ($update_data) {
    //             echo json_encode(['inserted' => 1]);
    //         }
    //     } catch (Exception $e) {
    //         die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
    //             . '": ' . $e->getMessage());
    //     }

	
  
  
  
    // }
    public function import_people_data()
  {
    //error_reporting(0);
  	    require_once APPPATH . "./third_party/PHPExcel.php";
     	 $path = 'uploads/';
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('uploadFile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        
        if (!empty($data['upload_data']['file_name'])) {
            $import_xls_file = $data['upload_data']['file_name'];
        } else {
            $import_xls_file = 0;
        }
        // echo $import_xls_file;exit;

        $inputFileName = $path . $import_xls_file;
    
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $flag = true;
            $i=0;

            

            foreach ($allDataInSheet as $key => $value) {
                //  print_r($value);
                
              	if($key > 1) {
                  	if(!empty($value['A'])) {
                        $inserdata['policy_no'] = $policy_no =  $value['A'];
                        $inserdata['proposer_name'] = $value['B'];
                        $inserdata['contact'] = $value['C'];
                        // $inserdata['alternate_no'] = $value['D'];
                       
                        $inserdata['email'] = $value['D'];
                        
                       if(!empty($value['E'])){
                            $inserdata['customer_city'] = $value['E'];
                       }else{
                            $inserdata['customer_city'] = '';
                       }

                       if(!empty($value['F'])){
                            
                            $inserdata['dob'] = $this->auth_jsps->date_format_change($value['F']);
                       }else{
                             $inserdata['dob'] = '';
                       }
                       
                      	$get_com_name =  $this->upload_excel_model->list_common_where('company','name', $value['G']);
                        // print_r($get_com_name);exit;
                        if(!empty($get_com_name)){
                            $inserdata['company_name'] = $get_com_name[0]['id'];
                        }else{
                            $inserdata['company_name'] = '';
                        }
                        
                        $inserdata['product_name'] = $value['H'];
                        $inserdata['cover_type'] = $value['I'];
                        $inserdata['coverage_type'] = $value['J'];
                        $inserdata['sum_assured_1'] = $value['K'];
                        $inserdata['date_of_closure'] = $this->auth_jsps->date_format_change($value['L']);
                        $inserdata['gross_premium'] = $value['M'];
                        $inserdata['net_premium'] = $value['N'];
                        $inserdata['policy_type'] = $value['O'];
                        $inserdata['payment_tenure'] = $value['P'];
                        $inserdata['portability_duration'] = $value['Q'];
                        $inserdata['zone'] = $value['R'];
                      	$inserdata['agent'] = $value['S'];
                        $inserdata['compgn_name'] = $value['T'];
                        // $inserdata['manager'] = 4;
                      	$get_tl_name =  $this->upload_excel_model->list_common_where('team_leader','name', $value['U']);
                      	if(!empty($get_tl_name)){
                            $inserdata['tl'] = $get_tl_name[0]['id'];
                            $inserdata['manager'] = $get_tl_name[0]['manager'];
                        }else{
                            // $inserdata['tl'] = 4;
                            $data = array(
                                'manager' => 4,
                                'name' => $value['U'],    
                            );
                            $this->db->insert('team_leader', $data);
                            $lastId = $this->db->insert_id();
                            $inserdata['tl'] =  $lastId;
                            $inserdata['manager'] =  4;
                           
                        }
                        
                        $inserdata['policy_start_date'] = $this->auth_jsps->date_format_change($value['V']);
                        
                        if(!empty($value['W'])){
                            $inserdata['policy_end_date']  = $this->auth_jsps->date_format_change($value['W']);
                        }else{
                            $inserdata['policy_end_date']  ='';
                        }
                        $inserdata['renewal'] = $value['X'];
                       
                      	$inserdata['old_new'] = '1';
                        //   print_r($inserdata);exit;
                          $check_policy_no = $this->upload_excel_model->check_policy('form', 'policy_no', $policy_no);
                          
                          if ($check_policy_no > 0) {
                              $update_data = $this->db->where('policy_no', $policy_no);
                            //   print_r($update_data);exit;
                              $update_data = $this->db->update('form', $inserdata);
                          } else {
                                // print_r($update_data);exit;
                              $update_data = $this->db->insert('form', $inserdata);
                          }
                        
                    }  
                }
              
                $i++;                
            }
          
          
         if ($update_data) {
                echo json_encode(['inserted' => 1]);
            }
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                . '": ' . $e->getMessage());
        }
    
  }
  



    public function openexcelmodel()
    {
        $id =  $this->input->post('id');
        $data['content'] = $this->upload_excel_model->list_common_where_edit('form', 'id', $id);
        $this->load->view('admin/master/old_uploaded_excel_edit', $data);
    }
    public function svgstore() {
       // $fileName = $this->input->post('name');
        $uploadPath = "./upload/csv/";
        
        // Config the upload
       // config['upload_path'] = $uploadPath; // some directory on the server with write permission
        
        // CHecking if present else create one
        if (!file_exists($config['upload_path'])) {
            if (!mkdir($concurrentDirectory = $config['upload_path'], 0777,
                    true) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '51200'; //50 MB
        $config['encrypt_name'] = false;
        $config['file_ext_tolower'] = true;
        
        // Set file name
        $config['file_name'] = $fileName;

        // Load the library with config
        $this->load->library('upload', $config);
        
        // Do the upload
        if ( ! $this->upload->do_upload('form')){
            // On error
            die($this->upload->display_errors());
        }else{
            // Upload was success, File is present in "./upload/csv/" 
            $csvFile = $uploadPath . $uploadData['file_name'];
            
            // Read the CSV file
            $row = 1;
            // Open the file and adjust the code as per your need
            if (($handle = fopen($csvFile, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    echo "<p> $num fields in line $row: <br /></p>\n";
                    $row++;
                    for ($c=0; $c < $num; $c++) {
                        echo $data[$c] . "<br />\n";
                    }
                }
                fclose($handle);
            }
        }
}
    // public function update()
    // {

    //     $id = $this->input->post('id');
    //     $data['policy_no'] = $policy_no = $this->input->post('policy_no');
    //     $data['customer_name'] = $customer_name = $this->input->post('customer_name');
    //     $data['contact'] = $contact = $this->input->post('contact');
    //     $data['alternate_no'] = $alternate_no = $this->input->post('alternate_no');
    //     $data['email'] = $email = $this->input->post('email');
    //     $data['customer_city'] = $customer_city = $this->input->post('customer_city');
    //     $data['dob'] = $dob = $this->input->post('dob');
    //     $data['company_name'] = $company_name = $this->input->post('company_name');
    //     $data['product_name'] = $product_name = $this->input->post('product_name');
    //     $data['sum_assured_1'] = $sum_assured_1 = $this->input->post('sum_assured_1');
    //     $data['booking_date'] = $booking_date = $this->input->post('date_of_closure');
    //     $data['gross_premium'] = $gross_premium = $this->input->post('gross_premium');
    //     $data['net_premium'] = $net_premium = $this->input->post('net_premium');
    //     $data['policy_type'] = $policy_type = $this->input->post('policy_type');
    //     $data['payment_tenure'] = $payment_tenure = $this->input->post('payment_tenure');
    //     $data['portability'] = $portability = $this->input->post('portability');
    //     $data['zone'] = $zone = $this->input->post('zone');
    //     $data['agent'] = $agent = $this->input->post('agent');
    //     $data['tl'] = $tl = $this->input->post('tl');
    //     $data['data'] = $data = $this->input->post('data');
    //     $data['policy_start_date'] = $policy_start_date = $this->input->post('policy_start_date');
    //     $data['policy_end_date'] = $policy_end_date = $this->input->post('policy_end_date');
    //    $check_policy_no = $this->upload_excel_model->check_policy('form', 'policy_no', $policy_no);

    //     if ($check_policy_no > 0) {
    //         $insertUser = $this->db->where('policy_no', $policy_no);
    //         $insertUser = $this->db->update('form', $data);
    //     }
    //     $insertUser = $this->db->where('id', $id);
    //     $insertUser = $this->db->update('form', $data);
    //     if ($insertUser) {
    //         echo json_encode(['inserted' => '1']);
    //     } else {
    //         echo json_encode(['inserted' => '0']);
    //     }
    // }

    public function csv_upload()
    {
        $file_location = str_replace("\\", "/", $_FILES['uploadFile']['tmp_name']);

        //$query_1 = '';
        $sql = $this->db->query('LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE INTO TABLE form FIELDS TERMINATED BY "," LINES TERMINATED BY "\r\n" IGNORE 1 LINES (@column1,@column2,@column3,@column4,@column5,@column6,@column7,@column8,@column9,@column10,@column11,@column12,@column13,@column14,@column15,@column16,@column17,@column18,@column19,@column20,@column21,@column22,@column23) SET policy_no = trim(@column1) , customer_name = trim(@column2) , contact = trim(@column3) , email = trim(@column4) , customer_city = trim(@column5) ,dob = trim(@column6), company_name =trim(@column7),product_name = trim(@column8), cover_type  = trim(@column9),coverage_type  = trim(@column9),sum_assured_1 = trim(@column10),date_of_closure  = trim(@column11), gross_premium  = trim(@column12),net_premium   = trim(@column13),policy_type  = trim(@column14), 	payment_tenure =trim(@column15) , portability_duration  = trim(@column16),zone = trim(@column17), agent  = trim(@column18),compgn_name  = trim(@column19),tl = trim(@column20),policy_start_date  = trim(@column21),policy_end_date  = trim(@column22), renewal = trim(@column23)');
       
        if ($sql) {
                    echo json_encode(['inserted' => '1']);
                } else {
                    echo json_encode(['inserted' => '0']);
                }
    }



    public function import_people_data_5may()
    {
      //error_reporting(0);
            require_once APPPATH . "./third_party/PHPExcel.php";
            $path = 'uploads/';
          $config['upload_path'] = $path;
          $config['allowed_types'] = 'xlsx|xls|csv';
          $config['remove_spaces'] = TRUE;
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
          
          if (!$this->upload->do_upload('uploadFile')) {
              $error = array('error' => $this->upload->display_errors());
          } else {
              $data = array('upload_data' => $this->upload->data());
          }
          
          if (!empty($data['upload_data']['file_name'])) {
              $import_xls_file = $data['upload_data']['file_name'];
          } else {
              $import_xls_file = 0;
          }
          // echo $import_xls_file;exit;
  
          $inputFileName = $path . $import_xls_file;
      
          try {
              $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
              $objReader = PHPExcel_IOFactory::createReader($inputFileType);
              $objPHPExcel = $objReader->load($inputFileName);
              $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
  
              $flag = true;
              $i=0;
  
              foreach ($allDataInSheet as $key => $value) {
                  //  print_r($value);
                  
                    if($key > 1) {
                        if(!empty($value['A'])) {
                          $inserdata['id'] =  $value['A'];
                          $inserdata['log_id'] = $value['B'];
                          $inserdata['cust_id'] = $value['C'];
                          $inserdata['agent'] = $value['D'];
                          $inserdata['proposer_name'] = $value['E'];
                          $inserdata['customer_name'] = $value['F'];
                          $inserdata['contact'] = $value['G'];
                          $inserdata['address'] = $value['H'];
                          $inserdata['policy_no'] = $value['I'];
                          $inserdata['new_policy_after_renewal'] = $value['J'];
                          $inserdata['renewal_premium '] = $value['K'];
                          $inserdata['renewal'] = $value['L'];
                          $inserdata['renewal_date'] = $value['M'];
                          $inserdata['renewal_year '] = $value['N'];
                          $inserdata['active_date'] = $value['O'];
                          $inserdata['portability'] = $value['P'];
                          $inserdata['medical'] = $value['Q'];
                          $inserdata['insured_1_ped'] = $value['R'];
                          $inserdata['discount'] = $value['S'];
                          $inserdata['company_name'] = $value['T'];
                          $inserdata['date_of_closure'] = $value['U'];
                          $inserdata['cover_type'] = $value['V'];

                          $inserdata['payment_tenure'] = $value['W'];

                          $inserdata['expiry_date'] = $value['X'];
                          $inserdata['policy_status'] = $value['Y'];
                          $inserdata['insured_2_ped'] = $value['Z'];
                          $inserdata['alternate_no'] = $value['AA'];
                          $inserdata['alt_no_2'] = $value['AB'];
                          $inserdata['product_name'] = $value['AC'];
                          $inserdata['sum_assured_1'] = $value['AD'];
                          $inserdata['coverage_type'] = $value['AE'];
                          $inserdata['data_source'] = $value['AF'];

                          $inserdata['insured_3_ped'] = $value['AG'];
                          $inserdata['manager'] = $value['AH'];

                          $inserdata['tl '] = $value['AI'];
                          $inserdata['gross_premium'] = $value['AJ'];

                          $inserdata['policy_type'] = $value['AK'];
                          $inserdata['dob'] = $value['AL'];
                          $inserdata['zone'] = $value['AM'];
                          $inserdata['insured_4_ped'] = $value['AN'];
                          $inserdata['insured_5_ped'] = $value['AO'];

                          $inserdata['net_premium '] = $value['AP'];
                          $inserdata['counted_premium'] = $value['AQ'];
                          $inserdata['portability_duration'] = $value['AR'];
                          $inserdata['customer_city'] = $value['AS'];
                          $inserdata['payment_mode'] = $value['AT'];
                          $inserdata['policy_start_date'] = $value['AU'];
                          $inserdata['policy_end_date'] = $value['AV'];
                          $inserdata['policy_issue_date'] = $value['AW'];
                          $inserdata['port_end_date '] = $value['AX'];
                          $inserdata['policy_source'] = $value['AY'];
                          $inserdata['email'] = $value['AZ'];

                          $inserdata['rider'] = $value['BA'];
                          $inserdata['compgn_name'] = $value['BB'];
                          $inserdata['login'] = $value['BC'];
                          $inserdata['disposition'] = $value['BD'];
                          $inserdata['disposition_action'] = $value['BE'];
                          $inserdata['updated_by_user_module'] = $value['BF'];
                          $inserdata['remark'] = $value['BG'];
                          $inserdata['remark_by_user_module'] = $value['BH'];

                          $inserdata['flag'] = $value['BI'];
                          $inserdata['old_new'] = $value['BJ'];
                          $inserdata['created_at'] = $value['BK'];
                          $inserdata['updated_at '] = $value['BL'];
                          

                          $update_data = $this->db->insert('form', $inserdata);
                          
                      }  
                  }
                
                  $i++;                
              }
            
            
           if ($update_data) {
                  echo json_encode(['inserted' => 1]);
              }
          } catch (Exception $e) {
              die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                  . '": ' . $e->getMessage());
          }
      
    }
}
