
<?php $company = $this->Form_model->list_common('company');
$team_leader = $this->Form_model->list_common('team_leader');
$i = 1;

if (!empty($fresh_operation)) {
    foreach ($fresh_operation as $row) { ?>
         
        <tr>
            <td class="count_2"><?php echo $i; ?></td>
            <td><?php if (!empty($row['policy_no'])) { ?><?php echo $row['policy_no'] ?> <?php } ?></td>
            <td><?php if (!empty($row['log_id'])) { ?><?php echo $row['log_id'] ?> <?php } ?></td>
            <td><?php if (!empty($row['id'])) { ?><?php echo $row['id'] ?> <?php } ?></td>
            <td><?php if (!empty($row['customer_name'])) { ?><?php echo $row['customer_name'] ?> <?php } else { echo $row['proposer_name']; } ?></td>
            <td><?php if (!empty($row['contact'])) { ?><?php echo $row['contact']; ?> <?php } ?></td>

            <td><?php if (!empty($row['alternate_no'])) { ?><?php echo $row['alternate_no'] ?> <?php } ?></td>
            <td><?php if (!empty($row['email'])) { ?><?php echo $row['email'] ?> <?php } ?></td>
            <td><?php if (!empty($row['customer_city'])) { ?><?php echo $row['customer_city'] ?> <?php } ?></td>
            <td><?php if (!empty($row['dob'])) { ?><?php echo $row['dob'] ?> <?php } ?></td>
            <td><?php if (!empty($row['company_name'])) { ?><?php if ($row['company_name'] == $company[0]['id']) { echo $company[0]['name'];  } ?> <?php } ?></td>

            <td><?php if (!empty($row['product_name'])) { ?><?php echo $row['product_name'] ?> <?php } ?></td>
            <td><?php if (!empty($row['cover_type'])) { ?><?php echo $row['cover_type'] ?> <?php } ?></td>
            <td><?php if (!empty($row['coverage_type'])) { ?><?php echo $row['coverage_type'] ?> <?php } ?></td>
            <td><?php if (!empty($row['sum_assured_1'])) { ?><?php echo $row['sum_assured_1'] ?> <?php } ?></td>
            <td><?php if (!empty($row['created_at'])) { ?><?php echo $row['created_at']; ?> <?php } ?></td>

            <td><?php if (!empty($row['gross_premium'])) { ?><?php echo $row['gross_premium'] ?> <?php } ?></td>
            <td><?php if (!empty($row['net_premium'])) { ?><?php echo $row['net_premium'] ?> <?php } ?></td>
            <td><?php if (!empty($row['net_premium'])) { ?><?php echo $row['net_premium'] ?> <?php } ?></td>
            <td><?php if (!empty($row['policy_type'])) { ?><?php echo $row['policy_type'] ?> <?php } ?></td>
            <td><?php if (!empty($row['payment_tenure'])) { ?><?php echo $row['payment_tenure']; ?> <?php } ?></td>

            <td><?php if (!empty($row['portability_duration'])) { ?><?php echo $row['portability_duration'] ?> <?php } ?></td>
            <td><?php if (!empty($row['zone'])) { ?><?php echo $row['zone'] ?> <?php } ?></td>
            <td><?php if (!empty($row['agent'])) { ?><?php echo $row['agent'] ?> <?php } ?></td>
            <td><?php if (!empty($row['tl'])) { ?><?php if ($row['tl'] == $team_leader[0]['id']) { echo $team_leader[0]['name']; } ?> <?php } ?></td>
            <td><?php if (!empty($row['manager'])) { ?><?php echo $row['manager']; ?> <?php } ?></td>
            <td><?php if (!empty($row['disposition'])) { ?><?php $id = $row['disposition'];
                                                                $this->db->select('*');
                                                                $this->db->from('disposition');
                                                                $this->db->where('id', $id);
                                                                $rows1 = $this->db->get()->row();
                                                                echo $rows1->disposition; ?> <?php } ?></td>
            <td><?php if (!empty($row['disposition_action'])) { ?><?php echo $row['disposition_action']; ?> <?php } ?></td>
            <td><?php if (!empty($row['updated_at'])) { ?><?php echo $row['updated_at']; ?> <?php } ?></td>
            <td><?php if (!empty($row['policy_end_date'])) { ?><?php echo $row['policy_end_date']; ?> <?php } ?></td>
            <td><?php if (!empty($row['remark'])) { ?><?php echo substr($row['remark'], 0, 8); ?> <?php } ?></td>
            <td><?php if (!empty($row['insured_1_ped'])) { ?><?php echo substr($row['insured_1_ped'], 0, 8); ?> <?php } ?></td>
            <td><?php if (!empty($row['insured_2_ped'])) { ?><?php echo substr($row['insured_2_ped'], 0, 8); ?> <?php } ?></td>
            <td><?php if (!empty($row['insured_3_ped'])) { ?><?php echo substr($row['insured_3_ped'], 0, 8); ?> <?php } ?></td>
            <td><?php if (!empty($row['insured_4_ped'])) { ?><?php echo substr($row['insured_4_ped'], 0, 8); ?> <?php } ?></td>

<td>
    <?php if (!empty($row['user_id'])) { ?><?php $id = $row['user_id'];
                                            $this->db->select('*');
                                            $this->db->from('admin');
                                            $this->db->where('id', $row['user_id']);
                                            $rows1 = $this->db->get()->row();
                                            echo $rows1->name; ?> <?php } ?>
</td>
        </tr>
<?php $i++;
    }
} ?>
<input type="hidden" value="<?= $total_premium;?>" class="a" id="totalpremium1">
<script>
  var to_pre = $('.a').val();
  sessionStorage.setItem("total_pre", to_pre);
// alert(to_pre);
</script> 