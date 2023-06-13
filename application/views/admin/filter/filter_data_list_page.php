 <input type="hidden" value="<?= round($totalpremium); ?>" id="totalpremium">
 <?php if (!empty($module_short_name)) {
    $model_short_name = $module_short_name;
  } else {
    $model_short_name = '';
  }
  $i = 1;
  if (!empty($subadminData)) {
    foreach ($subadminData as $key => $row) {
      
    $policy_no1 = base64_encode($row['policy_no']);
      $policy_no = rtrim($policy_no1, '=');
      $form_remark = $this->Form_model->fetch_verify_data($row['form_id']);

      if (!empty($form_remark)) {
  ?>
       <ul class="nav nav-tabs-custom border-bottom-0 ms-4">

         <?php foreach ($form_remark as $val) {
            $dis_name_bages  = $this->Form_model->list_common_where3('disposition', 'id', $val['disposition']);
            $show_disp  = $this->Form_model->show_disp('form_disposition_remark', 'done_by_module', $val['done_by_module'], 'form_id', $val['form_id'],);
            $count_disp  = $this->Form_model->count_disp('form_disposition_remark', 'form_id', $val['form_id'], 'done_by_module', $val['done_by_module']);
            $underwriter = '';

            if ($val['done_by_module'] == 'underwriter_verifier') {
              $underwriter = 'UNDERWRITING';
            }
            if ($val['done_by_module'] == 'operations') {
              $underwriter = 'OPERATIONS';
            }
            if ($val['done_by_module'] == 'services') {
              $underwriter = 'SERVICES';
            }
            if ($val['disposition'] == '28') {
              $underwriter = 'ENFORCED';
            }
            if ($val['done_by_module'] == 'renewals') {
              $underwriter = 'RENEWALS';
              $count_disp  = $this->Form_model->count_disp('form_disposition_remark', 'form_id', $val['form_id'], 'done_by_module', $val['done_by_module']);
          }
            if ($val['disposition'] == '29') {
              $underwriter = 'REJECTED';
            } ?>
           <li class="nav-item navitem1" style="background:<?php if ($underwriter == 'UNDERWRITING') {
                                                              echo "#71d7df";
                                                            } else if ($underwriter == 'SERVICES') {
                                                              echo "#ff8100";
                                                            } else if ($underwriter == 'ENFORCED') {
                                                              echo "blue";
                                                            } else if ($underwriter == 'REJECTED') {
                                                              echo "#ff0000";
                                                            } else if ($underwriter == 'OPERATIONS' && $val['disposition'] == '28') {
                                                              echo "blue";
                                                            } else  if ($underwriter == 'OPERATIONS' && $val['disposition'] == '29' || $val['disposition'] == '31') {
                                                              echo "#ff0000";
                                                            } else if ($val['disposition'] == '54') {
                                                              echo "blue";
                                                            } else if ($underwriter == 'OPERATIONS') {
                                                              echo "#ffbc00";
                                                            }else if ($underwriter == 'RENEWALS') {
                                                              echo "green";
                                                          }
                                                            ?>">
             <a class="nav-link active">
               <?= $underwriter; ?>(<span class="curse_poin" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php $i = 0; if (!empty($show_disp)) { foreach ($show_disp as $val) { $show_disp_name = $this->Form_model->list_common_where3('disposition', 'id', $val['disp_id']); echo '&#10;' . $show_disp_name[0]['disposition']; } } else {echo "NA"; } ?>"><?= $count_disp ?></span>)
             </a>
           </li>&nbsp;&nbsp;
         <?php } ?>
       </ul>
     <?php } ?>

     <div class="card border ribbon-box shadow-none" style="border-color: #21252973!important; padding: 0px 4px;">
       <div class="card-body">
         <div class="ribbon ribbon-primary round-shape"><?= $key + 1; ?></div>
         <div class="row count_1" style="margin-bottom: -15px;">
           <div class="col-md-12 d-flex mb-1" style="display:flex;align-items: center;">

             <div class="col-md-2 flex-fill setmodulwid">
               <p class="setpara mb-1">PROPOSER NAME</p>
               <h5 class="seth5"><b>
                   <?php if (!empty($row['proposer_name'])) { ?>
                     <?php echo $row['proposer_name'] ?>
                   <?php } else {
                      echo "NA";
                    } ?>
                 </b></h5>
             </div>
             <div class="col-md-2 flex-fill setmodulwid">
               <p class="setpara mb-1">COMPANY NAME</p>
               <h5 class="seth5"><b>
                   <?php if (!empty($row['company_name'])) { ?>
                   <?php $id = $row['company_name'];
                      $this->db->select('name');
                      $this->db->from('company');
                      $this->db->where('id', $id);
                      $row1 = $this->db->get()->row();
                      echo $row1->name;
                    } else {
                      echo "NA";
                    } ?>
                 </b></h5>
             </div>
             <div class="col-md-2 flex-fill setmodulwid">
               <p class="setpara mb-1">PLAN NAME</p>
               <h5 class="seth5"><b>
                   <?php if (!empty($row['product_name'])) { ?>
                     <?php echo $row['product_name'] ?>
                   <?php } else {
                      echo "NA";
                    } ?>
                 </b></h5>
             </div>
             <div class="col-md-2 flex-fill setmodulwid">
               <p class="setpara mb-1">NET PREMIUM</p>
               <h5 class="seth5"><b>
                   <?php if (!empty($row['net_premium'])) { ?>
                     <?php echo $row['net_premium']; ?>
                   <?php } else {
                      echo "NA";
                    } ?>
                 </b></h5>
             </div>
             <div class="col-md-2 flex-fill setmodulwid">
               <p class="setpara mb-1">BOOK DATE</p>
               <h5 class="seth5"><b>
                   <?php if (!empty($row['date_of_closure'])) { ?>
                     <?php $bookdate = date("d-m-Y", strtotime($row['date_of_closure']));
                      echo $bookdate; ?>
                   <?php } else {
                      echo "NA";
                    } ?>
                 </b></h5>
             </div>
             <div class="col-md-2 flex-fill setmodulwid">
               <p class="setpara mb-1">POLICY NO</p>
               <h5 class="seth5"><b>
                   <?php if (!empty($row['policy_no'])) { ?>
                     <?php echo $row['policy_no'] ?>
                   <?php } else {
                      echo "NA";
                    } ?>
                 </b></h5>
             </div>
             <div class="col-md-2 flex-fill setmodulwid">
               <p class="setpara mb-1">EXPIRY DATE</p>
               <h5 class="seth5"><b>
                   <?php if (!empty($row['policy_end_date'])) { ?>
                     <?php $expirydate = date("d-m-Y", strtotime($row['policy_end_date']));
                      echo $expirydate; ?>
                   <?php } else {
                      echo "NA";
                    } ?>
                 </b></h5>
             </div>
             <div class="col-md-2 flex-fill setmodulwid" style="display:<?php if ($model_short_name == 'sale_closure') {
                                                                          echo 'none';
                                                                        } ?>">
               <p class="setpara mb-1">CALL DATE</p>
               <h5 class="seth5"><b>
                   <?php if (!empty($row['updated_at'])) { ?>
                     <?php echo $row['updated_at']; ?>
                   <?php } else {
                      echo "NA";
                    } ?>
                 </b></h5>
             </div>
             <div class="col-md-1 flex-fill" style="margin-left:-20px;margin-top:-5px;margin-bottom:5px;">
               <?php $claim_status = $this->Form_model->check_badges('claim', 'policy_no', $row['policy_no']); ?>
               <!-- <button type="button" class=" setsmallbtnsize mb-1">CLAIM INITIATE(<?= $claim_status ?>)</button> -->
               <?php $gr_status = $this->Form_model->check_badges('grievance', 'policy_no', $row['policy_no']); ?>
               <?php
                date_default_timezone_set('Asia/Kolkata');
                $current_date = date('Y-m-d');
                $start = strtotime($current_date);
                $end = strtotime($row['policy_end_date']);

                $days_between = (($end - $start) / 86400); ?>
               <a href="<?= base_url(); ?>claims/view_claims/<?php echo $policy_no; ?>" target="_blank" type="button" class="py-1 px-1 setsmallbtnsize mb-1">CLAIM INITIATE(<?= $claim_status ?>)</a>
               <a href="<?= base_url() ?>griveance_customer_services/griveance_customer_services" target="_blank" type="button" class="py-1 px-1 setsmallbtnsize3 mb-1">GRIEVANCE(<?= $gr_status ?>)</a>
               <?php
                if ($days_between < 30 && $days_between > 0) { ?>
                 <button type="button" class="setsmallbtnsize2 mb-1">EXPIRING IN(<?= $days_between ?> Day)</button>
               <?php }
                if ($days_between < 0) { ?>
                 <button type="button" class="setsmallbtnsize2 mb-1">EXPIRED(<?= $days_between ?> Ago)</button>
               <?php } ?>
             </div>
             <div class="col-md-1 flex-fill" style="margin-top: -10px;margin-left: -5%;">
               <div class="d-flex ">
                 <a class="btn  " class="flex-fill" data-toggle="tooltip" title="Edit" target="_blank" href="<?= base_url(); ?>form_listing/subadminedit/<?= $model_short_name ?>/<?php echo $row['form_id']; ?>"><i class="ri-edit-2-line" style=" font-size:18px;"></i></a>
                 <a class="btn  " class="flex-fill" data-id="4" data-toggle="tooltip" target="_blank" title="View" href="<?= base_url(); ?>view_sale/<?php echo $row['form_id']; ?>"><i class="ri-eye-line" style=" font-size:18px;"></i></a>

                 <?php if ($this->rbac->hasPrivilege($model_short_name, 'can_delete')) { ?>
                   <a class="btn " class="flex-fill" data-toggle="tooltip" title="Delete">
                     <i class="ri-delete-bin-6-line" name="archive" class="remove" type="submit" onclick="archiveFunction(<?php echo $row['form_id']; ?>)" data-toggle="tooltip" data-placement="bottom" style=" font-size:18px;"></i>
                   </a>
                 <?php } ?>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
 <?php $i++;
    }
  } ?>
 <script>
   var to_pre = $('#totalpremium').val();
   sessionStorage.setItem("total_pre", to_pre);
 </script>