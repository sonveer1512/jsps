<?php $this->load->view('admin/link');
$short_name = $this->uri->segment(1);
$model_short_name = $this->uri->segment(2);
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$total_premium = $this->db->query("select sum(net_premium) as totalpremium from form where flag='0'")->result();
$policy_count = $this->db->query("select count(policy_no) as totalpolicy from form where flag='0'")->result();
?>
<!-- Begin page -->
<div id="layout-wrapper">

    <?php
    $this->load->view('admin/topar');
    $this->load->view('admin/imgheader');

    $this->load->view('admin/sidebar');
    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#Datatable1').DataTable();
    });
</script>
<style>
    .setpara {
        font-size: 9px;
    }

    .seth5 {
        font-size: 10px;
    }

    .nav-tabs-custom .nav-item .nav-link {
        color: white;
    }

    .nav-tabs-custom .nav-item .nav-link.active {
        color: white;
    }

    .nav-tabs-custom .navitem1 {
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
    }

    .nav-tabs-custom .navitem2 .nav-link {
        background: #ffbc00;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
    }

    .nav-tabs-custom .navitem3 .nav-link {
        background: #71d7df;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
    }

    .nav-tabs-custom .nav-item .nav-link::after {
        background: none !important;
    }

    .card-body .nav-link {
        padding: 0.2rem 1rem;
        font-size: 11px;
    }

    .setsmallbtnsize {
        font-size: 8px;
        font-weight: bold;
        margin-top: 0px;
        border-radius: 5px;
        background-color: rgb(207 235 228);
        border-color: rgb(207 235 228);
        color: rgb(67 171 143);
    }

    .setsmallbtnsize2 {
        font-size: 8px;
        font-weight: bold;
        margin-top: 0px;
        border-radius: 5px;
        background-color: rgb(244 230 230);
        border-color: rgb(244 230 230);
        color: rgb(229 88 88);
    }

    .setsmallbtnsize3 {
        font-size: 8px;
        font-weight: bold;
        margin-top: 0px;
        margin-top: 0px;
        padding: 1px 15px;
        border-radius: 5px;
        background-color: rgb(235 230 244);
        border-color: rgb(235 230 244);
        color: rgb(158 130 204);
    }

    .setmodulwid {
        /* width: 10.6% !important;
        padding: 9px; */
        width: 5% !important;

    }

    .setsmallbtnsize41 {
        font-size: 10px;

        height: 40%;
        padding: 4px;
    }

    #com_name {
        display: none;
    }

    .curse_poin {
        cursor: pointer;
    }
    .status{text-align: center;}
</style>
<div class="vertical-overlay"></div>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0" style=" text-transform: capitalize;"><?= $model_short_name; ?> Listing</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php base_url() ?>Dashboard">Dashboards</a></li>
                                <li class="breadcrumb-item active" style=" text-transform:capitalize;"><?= $model_short_name; ?> Listing</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1" style=" text-transform:capitalize;"><?= $short_name; ?> Listing</h4>

                            <div class="flex-shrink-0">
                                <p id="total_premium">Total Premium - <?= round($total_premium[0]->totalpremium); ?></p>
                                <span>Total No. Of Policy - <span id="policy_count">
                                        <?= $policy_count[0]->totalpolicy; ?>
                                    </span></span>

                                <?php $sess = $this->session->userdata('pmsadmin');
                                $id = $sess['id'];
                                $role = $sess['role'];
                                $name = $sess['name'];

                                if ($role == 'Master') { ?>
                                    <a href="<?= base_url(); ?>add_form/<?= $model_short_name ?>" type="button" title="Add New Regional Head" class="btn btn-primary waves-effect waves-light"><i class="ri-user-add-line"></i></a>
                                <?php } ?>

                            </div>

                        </div><!-- end card header -->
                        <style>
                            .shift_left {
                                margin-left: -70px;
                            }
                        </style>

                        <div class="card-body border border-dashed border-end-0 border-start-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card-body">
                                        <?php date_default_timezone_set('Asia/Kolkata');
                                        $current_date = date('Y-m-d'); ?>

                                        <input type="radio" class="btn-check" name="options-outlined" value="<?= $current_date; ?>" data-date="<?= $current_date; ?>" id="current_date" onClick="searchdata();">
                                        <label class="btn btn-outline-success" for="current_date">Current Date</label>


                                        <?php date_default_timezone_set('Asia/Kolkata');

                                        $current_month = date('Y-m'); ?>
                                        <input type="radio" class="btn-check" name="options-outlined" value="<?= $current_month; ?>" id="current_month" onClick="searchdata();">
                                        <label class="btn btn-outline-success" for="current_month">Current Month</label>


                                    </div>
                                </div>

                                <?php if ($model_short_name != 'renewals') { ?>
                                    <div class="col-md-2 col-sm-2">
                                        <p style="color:green ;">Book Start Date</p>
                                        <div>
                                            <input type="date" class="form-control" name="start_date" id="start_date" onchange="searchdata();" placeholder="Select Start date">
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-2">
                                        <p style="color:green ;"> Book End Date
                                        <div>
                                            <input type="date" class="form-control" name="end_date" id="end_date" onchange="searchdata();" placeholder="Select End date">
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if ($model_short_name == 'services' || $model_short_name == 'renewals') { ?>
                                    <div class="col-md-2 col-sm-2">
                                        <p style="color:blue ;"> Expiry Start Date
                                        <div>
                                            <input type="date" class="form-control" name="exp_start_date" id="exp_start_date" onchange="searchdata();" placeholder="Select Start date">
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-2">
                                        <p style="color:blue ;">Expiry End Date
                                        <div>
                                            <input type="date" class="form-control" name="exp_end_date" id="exp_end_date" onchange="searchdata();" placeholder="Select End date">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body border border-dashed border-end-0 border-start-0">

                            <div class="row">

                                <!--end col-->
                                <!-- <div class="col-md-2 col-sm-2">
                                    <div>
                                        <input type="date" class="form-control" name="start_date" id="start_date" onchange="datefilter();" placeholder="Select Start date">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <div>
                                        <input type="date" class="form-control" name="end_date" id="end_date" onchange="datefilter();" placeholder="Select End date">
                                    </div>
                                </div> -->
                                <div class="col-md-3 col-sm-1 ">
                                    <?php if ($model_short_name == 'underwriter_verifier') { ?>
                                        <select class="form-select form-select" aria-expanded="false" id="search_by_disp" name="search_by_disp" onchange="searchdata(); ">
                                            <option value="" selected>Select</option>
                                            <?php if (!empty($disposition_name)) {
                                                foreach ($disposition_name as $val) { ?>
                                                    <option value="<?= $val['id'] ?>"><?= $val['disposition']; ?></option>

                                            <?php }
                                            } ?>
                                        </select>
                                    <?php  } ?>

                                    <?php if ($model_short_name == 'operations') { ?>
                                        <!--<select class="form-select form-select" aria-expanded="false" id="search_by_disp" name="search_by_disp" onchange="searchdata(); showdisp(this.value);">-->
                                        <select class="form-select form-select" aria-expanded="false" id="search_by_disp" name="search_by_disp" onchange="searchdata();">
                                            <option value="" selected>Select</option>
                                            <?php if (!empty($disposition_name)) {
                                                foreach ($disposition_name as $val) { ?>
                                                    <option value="<?= $val['id'] ?>"><?= $val['disposition']; ?></option>

                                            <?php }
                                            } ?>
                                        </select>
                                    <?php  } ?>

                                    <?php if ($model_short_name == 'services') { ?>
                                        <!-- <select class="form-select form-select" aria-expanded="false" id="search_by_disp" name="search_by_disp" onchange="searchdata(); showdisp(this.value);">-->
                                        <select class="form-select form-select" aria-expanded="false" id="search_by_disp" name="search_by_disp" onchange="searchdata(); ">
                                            <option value="" selected>Select</option>
                                            <?php if (!empty($disposition_name)) {
                                                foreach ($disposition_name as $val) { ?>
                                                    <option value="<?= $val['id'] ?>"><?= $val['disposition']; ?></option>

                                            <?php }
                                            } ?>
                                        </select>
                                    <?php  } ?>

                                    <?php if ($model_short_name == 'renewals') { ?>
                                        <select class="form-select form-select" aria-expanded="false" id="search_by_disp" name="search_by_disp" onchange="searchdata(); showdisp(this.value);">
                                            <option value="" selected>Select</option>
                                            <?php if (!empty($disposition_name)) {
                                                foreach ($disposition_name as $val) { ?>
                                                    <option value="<?= $val['id'] ?>"><?= $val['disposition']; ?></option>

                                            <?php }
                                            } ?>
                                        </select>
                                    <?php  } ?>


                                </div>
                                <style>
                                    #pending_sub_disp {
                                        display: none;
                                    }

                                    #cancelled_sub_disp {
                                        display: none;
                                    }
                                </style>
                                <div class="col-md-3 col-sm-2" id="pending_sub_disp">
                                    <?php if ($model_short_name == 'operations') { ?>
                                        <select class="form-select form-select" aria-expanded="false" id="search_by_subdisp" onchange=showdatasubdisp(this.value);>
                                            <option value="all" selected>Select</option>
                                            <option value="Policy Documents">Policy Documents</option>
                                            <option value="Medical Report">Medical Report</option>
                                            <option value="MER">MER</option>
                                            <option value="Yet To Login">Yet To Login</option>
                                        </select>
                                    <?php  } ?>
                                </div>

                                <div class="col-md-3 col-sm-2" id="cancelled_sub_disp">
                                    <?php if ($model_short_name == 'operations') { ?>
                                        <select class="form-select form-select" aria-expanded="false" id="search_by_subdisp" onchange=showdatasubdisp(this.value);>
                                            <option value="all" selected>Select</option>
                                            <option value="Freelook">Freelook</option>
                                            <option value="Pre Disclosure">Pre Disclosure</option>
                                            <option value="Customer Request">Customer Request</option>
                                        </select>
                                    <?php  } ?>
                                </div>
                                <input type="hidden" name="module_short_name" id="module_short_name" value="<?= $model_short_name; ?>">
                                <!-- Buttons with dropdowns -->
                                <?php if ($model_short_name == 'underwriter_verifier') { ?>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="input-group">
                                            <select class="form-select form-select-sm" aria-expanded="false" id="select_attribute" name="select_attribute" onchange="show_input(this.value);">
                                                <option value="" selected>Select Attributes</option>
                                                <option value="by_company">By Company</option>
                                                <option value="by_customer_name">By Customer Name</option>
                                                <option value="by_log_id">By Log ID</option>
                                                <option value="by_cust_id">By Customer ID</option>

                                            </select>
                                            <div id="com_name">
                                                <select class="form-select form-control" id="company_name" onchange="searchdata();">
                                                    <option value="" selected>Select Company</option>
                                                    <?php if (!empty($company)) {
                                                        foreach ($company as $com) { ?>
                                                            <option value="<?= $com['id'] ?>"><?= $com['name'] ?></option>
                                                    <?php  }
                                                    } ?>
                                                </select>
                                            </div>
                                            <input type="text" id="search" name="search" class="form-control search" onkeyup="searchdata();" onkeydown="searchdata();" placeholder="Enter Keyword for Search" readonly>

                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($model_short_name == 'operations') { ?>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="input-group">
                                            <select class="form-select form-select-sm" aria-expanded="false" id="select_attribute" name="select_attribute" onchange="show_input(this.value);">
                                                <option value="" selected>Select Attributes</option>
                                                <option value="by_company">By Company</option>
                                                <option value="by_customer_name">By Customer Name</option>
                                                <option value="by_policy_no">By Policy No.</option>
                                                <option value="by_log_id">By Log ID</option>
                                                <option value="by_cust_id">By Customer ID</option>
                                            </select>
                                            <div id="com_name">
                                                <select class="form-select form-control" id="company_name" onchange="searchdata();">
                                                    <option value="" selected>Select Company</option>
                                                    <?php if (!empty($company)) {
                                                        foreach ($company as $com) { ?>
                                                            <option value="<?= $com['id'] ?>"><?= $com['name'] ?></option>
                                                    <?php  }
                                                    } ?>
                                                </select>
                                            </div>
                                            <input type="text" id="search" name="search" class="form-control search" onkeyup="searchdata();" onkeydown="searchdata();" placeholder="Enter Keyword for Search" readonly>

                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($model_short_name == 'services') { ?>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="input-group">
                                            <select class="form-select form-select-sm" aria-expanded="false" id="select_attribute" name="select_attribute" onchange="show_input(this.value);">
                                                <option value="all" selected>Select Attributes</option>
                                                <option value="by_company">By Company</option>
                                                <option value="by_customer_name">By Customer Name</option>
                                                <option value="by_policy_no">By Policy No.</option>
                                                <option value="by_log_id">By Log ID</option>
                                                <option value="by_cust_id">By Customer ID</option>
                                            </select>
                                            <div id="com_name">
                                                <select class="form-select form-control" id="company_name" onchange="searchdata();">
                                                    <option value="" selected>Select Company</option>
                                                    <?php if (!empty($company)) {
                                                        foreach ($company as $com) { ?>
                                                            <option value="<?= $com['id'] ?>"><?= $com['name'] ?></option>
                                                    <?php  }
                                                    } ?>
                                                </select>
                                            </div>
                                            <input type="text" id="search" name="search" class="form-control search" onkeyup="searchdata();" onkeydown="searchdata();" placeholder="Enter Keyword for Search" readonly>

                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($model_short_name == 'renewals') { ?>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="input-group">
                                            <select class="form-select form-select-sm" aria-expanded="false" id="select_attribute" name="select_attribute" onchange="show_input(this.value);">
                                                <option value="all" selected>Select Attributes</option>
                                                <option value="by_company">By Company</option>
                                                <option value="by_customer_name">By Customer Name</option>
                                                <option value="by_policy_no">By Policy No.</option>
                                                <option value="by_log_id">By Log ID</option>
                                                <option value="by_cust_id">By Customer ID</option>
                                                <option value="by_email">By Email ID</option>
                                                <option value="by_contact">By Contact No.</option>
                                            </select>
                                            <div id="com_name">
                                                <select class="form-select form-control" id="company_name" onchange="searchdata();">
                                                    <option value="" selected>Select Company</option>
                                                    <?php if (!empty($company)) {
                                                        foreach ($company as $com) { ?>
                                                            <option value="<?= $com['id'] ?>"><?= $com['name'] ?></option>
                                                    <?php  }
                                                    } ?>
                                                </select>
                                            </div>
                                            <input type="text" id="search" name="search" class="form-control search" onkeyup="searchdata();" onkeydown="searchdata();" placeholder="Enter Keyword for Search" readonly>

                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-md-2">
                                    <input type="radio" class="btn-check" name="options-outlined"  id="fresh_operation" onClick="freshpolicy();">
                                    <label class="btn btn-outline-success" for="fresh_operation">Fresh Policy</label>
                                </div>
                                <!--<div class="col-md-2 col-sm-6" style="float:right;">
                                    <div class="search-box">
                                        <input type="text" id="search" name="search" class="form-control search" onkeyup="searchdata(this.value)" onkeydown="searchdata(this.value)" placeholder="Enter Keyword for Search">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>-->

                                <!--end col-->

                                <!--end col-->

                                <!--end col-->
                            </div>
                            <!--end row-->

                        </div>
                        <div class="row">
                            <!-- <div class="col-md-8">
                                <div class="card-body">
                                   
                                    <?php date_default_timezone_set('Asia/Kolkata');
                                    $current_date = date('Y-m-d');
                                    $current_month = date('Y-m'); ?>

                                    <input type="radio" class="btn-check" name="options-outlined" value="<?= $current_date; ?>" data-date = "<?= $current_date; ?>" id="current_date" onClick="filetr_wise_all();">
                                                <label class="btn btn-outline-success" for="current_date" >Current Date</label>
                                               
                                                <input type="radio" class="btn-check" name="options-outlined" value="<?= $current_month; ?>" id="current_month" onClick="filetr_wise_all_month();">
                                                <label class="btn btn-outline-success" for="current_month">Current Month</label>

                                </div>
                            </div> -->
                            <!-- <div class="col-md-4 mt-1">


                                <p>Total Renewal Premium - </p>
                                <p class="policy_count">Total No. Of Policy - <?= $policy_count = '0'; ?> </p>


                            </div> -->
                        </div>


                        <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h5 class="modal-title" id="exampleModalgridLabel">Add New Form </h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                    </div>

                                    <div class="modal-body">
                                        <div id="success">
                                            <div id="error">
                                            </div>

                                        </div>
                                        <form method="POST" id="addSubadmin">
                                            <div class="row g-3">
                                                <div class="col-xxl-6">
                                                    <div>
                                                        <label for="firstName" class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="sub_name" id="sub_name" placeholder="Enter Name">
                                                    </div>
                                                    <div class="error" id="subnameError"></div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-xxl-6">
                                                    <div>
                                                        <label for="lastName" class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="sub_email" id="sub_email" placeholder="Enter Email">
                                                    </div>
                                                    <div class="error" id="subemailError"></div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-xxl-6">
                                                    <div>
                                                        <label for="lastName" class="form-label">Password</label>
                                                        <input type="password" class="form-control" name="sub_password" id="sub_password" placeholder="Enter Password">
                                                    </div>
                                                    <div class="error" id="subpassError"></div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-xxl-6">
                                                    <div>
                                                        <label for="emailInput" class="form-label">Contact</label>
                                                        <input type="number" class="form-control" name="sub_contact" id="sub_contact" placeholder="Enter your Contact">
                                                    </div>
                                                    <div class="error" id="subcontactError"></div>
                                                </div>

                                                <div class="col-xxl-6">
                                                    <div>
                                                        <label for="emailInput" class="form-label">Employee id</label>
                                                        <input type="text" class="form-control" name="sub_employee" id="sub_employee" placeholder="Enter your Employee id">
                                                    </div>
                                                    <div class="error" id="subcontactError"></div>
                                                </div>
                                                <div class="col-xxl-6">
                                                    <div>
                                                        <label for="emailInput" class="form-label">Department</label>
                                                        <input type="text" class="form-control" name="sub_department" id="sub_department" placeholder="Enter your Department">
                                                    </div>
                                                    <div class="error" id="subcontactError"></div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-xxl-6">
                                                    <div>
                                                        <label for="emailInput" class="form-label">Admin Role</label>
                                                        <select class="form-control" name="sub_adminrole">
                                                            <option value="Master Admin">Master Admin</option>
                                                            <option value="Underwriter/Verifier">Underwriter/Verifier
                                                            </option>
                                                            <option value="Operations">Operations</option>
                                                            <option value="Services">Services</option>
                                                            <option value="Claims">Claims</option>
                                                            <option value="Renewals">Renewals</option>
                                                            <option value="Griveance/Customer Services">
                                                                Griveance/Customer Services</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-primary" value="Submit">
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-body" style="background: #c9ccd029;">
                                    <div id="fixed-header_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="row">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="filterdata status ">

                                            <?php
                                            $i = 1;
                                            if (!empty($subadminData->result())) {
                                                foreach ($subadminData->result()  as $key => $row) {
                                                    $policy_no1 = base64_encode($row->policy_no);
                                                    $policy_no = rtrim($policy_no1, '=');
                                                    $form_remark = $this->Form_model->fetch_verify_data($row->id );
                                                    if (!empty($form_remark)) {
                                            ?>
                                                        <ul class="nav nav-tabs-custom border-bottom-0 ms-4 ">

                                                            <?php foreach ($form_remark as $val) {
                                                                $dis_name_bages  = $this->Form_model->list_common_where3('disposition', 'id', $val['disposition']);
                                                                $show_disp  = $this->Form_model->show_disp('form_disposition_remark', 'done_by_module', $val['done_by_module'], 'form_id', $val['form_id'],);
                                                                $count_disp  = $this->Form_model->count_disp('form_disposition_remark', 'form_id', $val['form_id'], 'done_by_module', $val['done_by_module']);
                                                                $underwriter = '';

                                                                if ($val['done_by_module'] == 'underwriter_verifier') {
                                                                    $underwriter = 'UNDERWRITING';
                                                                    $count_disp  = $this->Form_model->count_disp('form_disposition_remark', 'form_id', $val['form_id'], 'done_by_module', $val['done_by_module']);
                                                                }
                                                                if ($val['done_by_module'] == 'operations') {
                                                                    $underwriter = 'OPERATIONS';
                                                                    $count_disp  = $this->Form_model->count_disp('form_disposition_remark', 'form_id', $val['form_id'], 'done_by_module', $val['done_by_module']);
                                                                }
                                                                if ($val['done_by_module'] == 'services') {
                                                                    $underwriter = 'SERVICES';
                                                                    $count_disp  = $this->Form_model->count_disp('form_disposition_remark', 'form_id', $val['form_id'], 'done_by_module', $val['done_by_module']);
                                                                }
                                                                if ($val['done_by_module'] == 'renewals') {
                                                                    $underwriter = 'RENEWALS';
                                                                    $count_disp  = $this->Form_model->count_disp('form_disposition_remark', 'form_id', $val['form_id'], 'done_by_module', $val['done_by_module']);
                                                                }
                                                                if ($val['disposition'] == '28') {
                                                                    $underwriter = 'ENFORCED';
                                                                }
                                                                if ($val['disposition'] == '29') {
                                                                    $underwriter = 'REJECTED';
                                                                }

                                                            ?>
                                                                <li class="nav-item navitem1" style="background: <?php if ($underwriter == 'UNDERWRITING') {
                                                                                                                        echo "#71d7df";
                                                                                                                    }else if ($underwriter == 'SERVICES') {
                                                                                                                        echo "#ff8100";
                                                                                                                    }else if ($underwriter == 'ENFORCED') {
                                                                                                                        echo "blue";
                                                                                                                    }else if ($underwriter == 'REJECTED') {
                                                                                                                        echo "#ff0000";
                                                                                                                    }else if ($underwriter == 'OPERATIONS' && $val['disposition'] == '28'  ) {
                                                                                                                        echo "blue";
                                                                                                                    }else  if ($underwriter == 'OPERATIONS' && $val['disposition'] == '29' || $val['disposition'] == '31') {
                                                                                                                        echo "#ff0000";
                                                                                                                    }else if ($val['disposition'] == '54') {
                                                                                                                        echo "blue";
                                                                                                                    }else if ($underwriter == 'OPERATIONS') {
                                                                                                                        echo "#ffbc00";
                                                                                                                    }else if ($underwriter == 'RENEWALS') {
                                                                                                                        echo "green";
                                                                                                                    }
                                                                                                                    ?>">
                                                                    <a class="nav-link active">
                                                                        <?= $underwriter; ?> (<span class="curse_poin" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php $i = 0;
                                                                                                                                                                                    foreach ($show_disp as $val) {
                                                                                                                                                                                        $show_disp_name = $this->Form_model->list_common_where3('disposition', 'id', $val['disp_id']);
                                                                                                                                                                                        echo '&#10;' . $show_disp_name[0]['disposition'];
                                                                                                                                                                                    } ?>"><?= $count_disp ?></span>)

                                                                    </a>
                                                                </li>&nbsp;&nbsp;
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } ?>

                                                    <div class="card border ribbon-box shadow-none" style="border-color: #21252973!important; padding: 0px 4px;">
                                                        <div class="card-body">
                                                            <div class="ribbon ribbon-primary round-shape"><?= $offset + $key; ?></div>
                                                            <div class="row count_1" style="margin-bottom: -15px;">
                                                                <div class="col-md-12 mb-1 d-flex" style="align-items: center;">

                                                                    <div class="col-md-1 flex-fill setmodulwid">
                                                                        <p class="setpara mb-1">PROPOSER NAME</p>
                                                                        <h5 class="seth5"><b>
                                                                                <?php if (!empty($row->proposer_name)) { ?>
                                                                                    <?php echo $row->proposer_name; ?>
                                                                                <?php } else {
                                                                                    echo "NA";
                                                                                } ?>
                                                                            </b></h5>
                                                                    </div>
                                                                    <div class="col-md-1 flex-fill setmodulwid">
                                                                        <p class="setpara mb-1">COMPANY NAME</p>
                                                                        <h5 class="seth5"><b>
                                                                                <?php if (!empty($row->company_name)) { ?>
                                                                                    <?php $id = $row->company_name;
                                                                                    $this->db->select('name');
                                                                                    $this->db->from('company');
                                                                                    $this->db->where('id', $id);
                                                                                    $row1 = $this->db->get()->row();
                                                                                    echo $row1->name;
                                                                                    ?>

                                                                                <?php } else {
                                                                                    echo "NA";
                                                                                } ?>
                                                                            </b></h5>
                                                                    </div>
                                                                    <div class="col-md-1 flex-fill setmodulwid">
                                                                        <p class="setpara mb-1">PLAN NAME</p>
                                                                        <h5 class="seth5"><b>
                                                                                <?php if (!empty($row->product_name)) { ?>
                                                                                    <?php echo $row->product_name; ?>
                                                                                <?php } else {
                                                                                    echo "NA";
                                                                                } ?>
                                                                            </b></h5>
                                                                    </div>
                                                                    <div class="col-md-1 flex-fill setmodulwid">
                                                                        <p class="setpara mb-1">GROSS PREMIUM</p>
                                                                        <h5 class="seth5"><b>
                                                                                <?php if (!empty($row->gross_premium)) { ?>
                                                                                    <?php echo $row->gross_premium; ?>
                                                                                <?php } else {
                                                                                    echo "NA";
                                                                                } ?>
                                                                            </b></h5>
                                                                    </div>
                                                                    <div class="col-md-1 flex-fill setmodulwid">
                                                                        <p class="setpara mb-1">BOOK DATE</p>
                                                                        <h5 class="seth5"><b>
                                                                                <?php
                                                                                if (!empty($row->date_of_closure)) { ?>
                                                                                    <?php
                                                                                    $date_of_clo = date("d-m-Y", strtotime($row->date_of_closure));
                                                                                    echo $date_of_clo ?>
                                                                                <?php } else {
                                                                                    echo "NA";
                                                                                } ?>
                                                                            </b></h5>
                                                                    </div>
                                                                    <div class="col-md-1 flex-fill setmodulwid">
                                                                        <p class="setpara mb-1">POLICY NO</p>
                                                                        <h5 class="seth5"><b>
                                                                                <?php if (!empty($row->policy_no)) { ?>
                                                                                    <?php echo $row->policy_no; ?>
                                                                                <?php } else {
                                                                                    echo "NA";
                                                                                } ?>
                                                                            </b></h5>
                                                                    </div>
                                                                    <div class="col-md-1 flex-fill setmodulwid">
                                                                        <p class="setpara mb-1">EXPIRY DATE</p>
                                                                        <h5 class="seth5"><b>
                                                                                <?php

                                                                                if (!empty($row->policy_end_date)) { ?>
                                                                                    <?php
                                                                                    $date_of_expiry = date("d-m-Y", strtotime($row->policy_end_date));
                                                                                    echo $date_of_expiry; ?>
                                                                                <?php } else {
                                                                                    echo "NA";
                                                                                } ?>
                                                                            </b></h5>
                                                                    </div>
                                                                    <div class="col-md-1 flex-fill setmodulwid">
                                                                        <p class="setpara mb-1">CALL DATE</p>
                                                                        <h5 class="seth5"><b>
                                                                                <?php if (!empty($row->updated_at)) { ?>
                                                                                    <?php
                                                                                    echo $row->updated_at; ?>
                                                                                <?php } else {
                                                                                    echo "NA";
                                                                                } ?>
                                                                            </b></h5>
                                                                    </div>
                                                                    <div class="col-md-1 flex-fill" style="margin-left:-4%;margin-top:-5px;margin-bottom:5px;">
                                                                        <?php $claim_status = $this->Form_model->check_badges('claim', 'policy_no', $row->policy_no); ?>
                                                                        <!-- <button type="button" class=" setsmallbtnsize mb-1">CLAIM INITIATE(<?= $claim_status ?>)</button> -->
                                                                        <?php $gr_status = $this->Form_model->check_badges('grievance', 'policy_no', $row->policy_no); ?>
                                                                        <?php
                                                                        date_default_timezone_set('Asia/Kolkata');
                                                                        $current_date = date('Y-m-d');
                                                                        $start = strtotime($current_date);
                                                                        $end = strtotime($row->policy_end_date);

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
                                                                    <div class="col-md-1 flex-fill" style="margin-top: -10px;margin-left:-5%;">

                                                                        <div class="d-flex">
                                                                        <?php if ($this->rbac->hasPrivilege($model_short_name, 'can_edit')) { ?>
                                                                            <a class="btn  " class="flex-fill" data-toggle="tooltip" title="Edit" target="_blank" href="<?= base_url(); ?>form_listing/subadminedit/<?= $model_short_name ?>/<?php echo $row->id; ?>"><i class="ri-edit-2-line" style=" font-size:18px;padding:1px"></i></a>
                                                                            <?php } ?>
                                                                            <a class="btn  " class="flex-fill" data-id="4" data-toggle="tooltip" target="_blank" title="View" href="<?= base_url(); ?>view_sale/<?php echo $row->id; ?>"><i class="ri-eye-line" style=" font-size:18px;"></i></a>
                                                                            <?php if ($this->rbac->hasPrivilege($model_short_name, 'can_delete')) { ?>
                                                                                <a class="btn " class="flex-fill" data-toggle="tooltip" title="Delete">
                                                                                    <i class="ri-delete-bin-6-line" name="archive" class="remove" type="submit" onclick="archiveFunction(<?php echo $row->id; ?>)" data-toggle="tooltip" data-placement="bottom" style=" font-size:18px;"></i>
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
                                        </div>
                                        <!-- pagination start -->
                                        <?php ?>
                                        <div class="align-items-center mt-2 row g-3 text-center text-sm-start pagenation_data" >
                                            <div class="col-sm">
                                                <div class="text-muted">Showing<span class="fw-semibold"> <?= count($subadminData->result()) ?> -
                                                        <?= isset($count) ? $count : ''; ?></span> Results
                                                </div>
                                            </div>
                                            <div class="col-sm-auto">
                                                <ul class="pagination pagination-separated pagination-sm justify-content-center justify-content-sm-start mb-0">
                                                    <?php $uri = $this->uri->segment(3); ?>

                                                    <?php for ($i = 0; $i < ($count / 100); $i++) { ?>
                                                        <li class="page-item <?php if (($uri == '') && ($i + 1 == 1)) {echo 'active'; } else if ($uri == ($i + 1)) {echo 'active'; } ?>">
                                                            <a href="<?= base_url() ?><?= $short_name; ?>/<?= $model_short_name; ?>/<?= $i + 1 ?>" class="page-link" style="<?php if ($uri == '') { if ($i + 1 == 1) { echo 'pointer-events: none;'; } } else if ($uri == $i + 1) { echo 'pointer-events: none;';} ?>"><?= $i + 1 ?></a>
                                                        </li>
                                                    <?php } ?>

                                                    <?php if ($i > $uri) { ?>
                                                        <li class="page-item">
                                                            <a href="<?= base_url() ?><?= $short_name; ?>/<?= $model_short_name; ?>/<?= $uri + 1 ?>" class="page-link">→</a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- paginaton end -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>





                    <div class="card-body">
                        <div class="live-preview">

                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->


            </div>
            <!-- container-fluid -->
        </div>
        <div class="modal fade" id="changepassword" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changepassword">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>
        <!-- End Page-content -->
        <div class="modal fade" id="editsubadmin" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalgridLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" onClick="window.location.reload();" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="successs">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- pass -->
        <div class="modal" id="changepassword">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Change password</h6>
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>

                        <!-- <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> -->
                    </div>
                    <form id="changepass" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body" id="showclient_details">

                        </div>
                        <div class="modal-footer">
                            <!-- <button class="btn btn-indigo" id="editdetailsbtn" type="submit" name="submit">Save changes</button>  -->
                            <button type="submit" name="submit" class="btn w-sm btn-success " id="editpass">Update</button>

                        </div>
                        <div class="modal-body">
                            <span id='showerror'></span>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/footer'); ?>
</div>


<!-- JAVASCRIPT -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="../assets/js/pages/datatables.init.js"></script>

<!-- App js -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="<?= base_url() ?>assets/js/app.js"></script>
<script type="text/javascript">
    function archiveFunction(id) {
        event.preventDefault(); // prevent form submit

        var form = event.target.form; // storing the form
        swal({
                title: "Are you sure?",
                text: "Delete User Record ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete Please",
                cancelButtonText: "No, cancel Please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "<?= base_url() ?>Form_listing/deletesubadmin/id",
                        type: "post",
                        data: {
                            id: id
                        },
                        success: function() {
                            swal('Record Deleted 🙂', ' ', 'success');
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);

                        },
                        error: function() {
                            swal('Record Not Deleted ☹️', 'error');
                        }
                    });
                } else {
                    swal("Cancelled", "User Account is safe 🙂", "error");
                }

            });
    }
</script>


<script type="text/javascript">
    function holdModal(exampleModalgrid) {
        $('#' + exampleModalgrid).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
</script>
<script>
    //  add modal
    $(document).on('submit', '#addSubadmin', function(ev) {
        $('.error').html('');

        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;
        var subname = $('#sub_name').val();
        var subemail = $('#sub_email').val();
        var subpassword = $('#sub_password').val();
        var subcontact = $('#sub_contact').val();
        var country = $('#sub_employee').val();
        var state = $('#sub_department').val();
        var state = $('#sub_adminrole').val();



        // if (subname == '') {
        //     $('#subnameError').html('Enter Your Name');
        //     $('.error').css('color', 'red');
        //     error = true;
        //     // alert("hi");

        // }
        // if (subemail == '') {
        //     $('#subemailError').html('Enter Your Email');
        //     $('.error').css('color', 'red');
        //     error = true;

        //     // alert("hi");

        // }
        // if (subpassword == '') {
        //     $('#subpassError').html('Enter Your Password');
        //     $('.error').css('color', 'red');
        //     error = true;

        //     // alert("hi");

        // }
        // if (subcontact == '') {
        //     $('#subcontactError').html('Enter Your Mobile Number');
        //     $('.error').css('color', 'red');
        //     error = true;

        //     // alert("hi");

        // }
        // if (Subemployee == '') {
        //     $('#subemployeeError').html('Select Your Employee id');
        //     $('.error').css('color', 'red');
        //     error = true;

        //     // alert("hi");

        // }

        // if (subdepartment == '') {
        //     $('#subdepartmentError').html('Select Your Department');
        //     $('.error').css('color', 'red');
        //     error = true;

        //     // alert("hi");

        // }

        if (error == false) {
            $.ajax({
                url: "<?= base_url('user/addsubadmin'); ?>",
                type: 'post',
                data: formData,
                success: function(result) {
                    // json data
                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);
                    var dataResult = JSON.parse(result);
                    if (dataResult.done == '1') {
                        swal('Regional Head Added 🙂', ' ', 'success');
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }

                    if (dataResult.done == '0') {
                        swal('Regional Head Not Added ☹️', ' ', 'success');

                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);

                    }

                    if (dataResult.email == '0') {
                        swal('Email Already Exist ☹️', ' ', 'error');



                    }


                },
                cache: false,
                contentType: false,
                processData: false,
            })

        }

    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.editmodel').click(function() {

            var userid = $(this).data('id');

            $.ajax({
                url: "<?= base_url('User/subadminedit'); ?>",
                type: "post",
                data: {
                    id: userid
                },
                success: function(response) {

                    $('.modal-body').html(response);
                    $('.bannerData').modal('show');

                }
            })


        });
    });
</script>
<script type="text/javascript">
    // update modal
    $(document).on('submit', '#bannerModelSubmits', function(ev) {
        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        $.ajax({
            url: "<?= base_url() ?>user/updatesubadmi/",
            type: 'post',
            data: formData,
            success: function(result) {
                //json data

                var dataResult = JSON.parse(result);
                if (dataResult.inserted == '1') {
                    swal('Record Updated 🙂', ' ', 'success');

                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);

                } else {

                }
                // if (dataResult.inserted == '1') {
                //     $('#success').html("Category Added Succefully!");
                //     $('#success').css('color', 'green');

                // }


            },
            cache: false,
            contentType: false,
            processData: false,
        })
    })
</script>

<script type="text/javascript">
    function enableaccount(id) {
        event.preventDefault(); // prevent form submit

        var form = event.target.form; // storing the form
        swal({
                title: "Are you sure?",
                text: "Enable User Account ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Enable Please",
                cancelButtonText: "No, cancel Please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "<?= base_url() ?>user/update/id",
                        type: "post",
                        data: {
                            id: id
                        },
                        success: function() {
                            swal('Account Enable 🙂', ' ', 'success');
                            $("#delete" + id).fadeTo("slow", 0.7, function() {
                                $(this).remove();
                            })
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);

                        },
                        error: function() {
                            swal('Account Still Disable ☹️', 'error');
                        }
                    });
                } else {
                    swal("Cancelled", "User Account is safe 🙂", "error");
                }

            });
    }
</script>

<script type="text/javascript">
    function disableaccount(id) {
        event.preventDefault(); // prevent form submit

        var form = event.target.form; // storing the form
        swal({
                title: "Are you sure?",
                text: "Disable User Account",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Disable Please",
                cancelButtonText: "No, cancel Please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "<?= base_url() ?>user/updatedisable/id",
                        type: "post",
                        data: {
                            id: id
                        },
                        success: function() {
                            swal('Account Disable 🙂', ' ', 'success');
                            $("#delete" + id).fadeTo("slow", 0.7, function() {
                                $(this).remove();
                            })
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);

                        },
                        error: function() {
                            swal('Account Still Enable ☹️', 'error');
                        }
                    });
                } else {
                    swal("Cancelled", "User Account is safe 🙂", "error");
                }

            });
    }
</script>

<script type="text/javascript">
    // update modal
    $(document).on('submit', '#changepasswordsubadmin', function(ev) {
        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        $.ajax({
            url: "<?= base_url() ?>user/changesubpass",
            type: 'post',
            data: formData,
            success: function(result) {
                //json data

                var dataResult = JSON.parse(result);
                if (dataResult.inserted == '1') {
                    swal('Password Changed 🙂', ' ', 'success');

                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);

                }

                if (dataResult.inserted == '0') {
                    swal('Password Not Changed ☹️', ' ', 'success');

                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);

                }

                if (dataResult.password == '0') {
                    swal('Current Password Mismatch ☹️', ' ', 'error');
                }


                // if (dataResult.inserted == '1') {
                //     $('#success').html("Category Added Succefully!");
                //     $('#success').css('color', 'green');

                // }


            },
            cache: false,
            contentType: false,
            processData: false,
        })
    })

    function showstates(id) {
        if (id != '') {

            $.ajax({
                url: '<?= base_url() ?>user/showstates/' + id,
                success: function(res) {

                    $(".state").html(res.output);

                },
                error: function() {
                    alert("Fail")
                }
            });
        }
    }

    function showcity(id) {

        if (id != '') {
            $.ajax({
                url: '<?= base_url() ?>Subadmin/showcity/' + id,
                success: function(res) {
                    $(".city").html(res.output);
                },
                error: function() {
                    alert("Fail")
                }
            });
        }
    }
</script>
<!-- filter Data -->

<script>
    //change password
    $(document).ready(function() {
        $("#changepasswordsubadmin").on('submit', (function(e) {
            e.preventDefault();
            err = 0;
            var formData = new FormData(this);
            formData.append('action', "enqdet");

            var new_pass = $("#new_pass").val();
            var confirm_pass = $("#confirm_pass").val();


            if (err == 0) {
                $.ajax({
                    url: "<?= base_url() ?>user/changesubpass",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#editpass").attr('disabled', true);
                    },
                    success: function(result) {
                        var response = JSON.parse(result);
                        $("#showerror").html(response.msg);
                        if (response.status == true) {
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        }
                    }
                });
            }
        }));
    });


    function changepass(id, ipdid) {
        //console.log(id);
        $.ajax({
            url: '<?= base_url() ?>user/changepass/' + id,
            success: function(res) {

                $("#showclient_details").html(res);
            },
            error: function() {
                alert("Fail")

            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.changepass').click(function() {

            var userid = $(this).data('id');

            $.ajax({
                url: "<?= base_url('User/changepass'); ?>",
                type: "post",
                data: {
                    userid: userid
                },
                success: function(response) {

                    $('.modal-body').html(response);
                    $('.changepassword').modal('show');

                }
            })
        });
    });
</script>
<script>
    function datefilter() {
        var total_premium = $('#totalpremium').val();
        var startdate = $('#start_date').val();
        var enddate = $('#end_date').val();
  
        var sel_disposition = $('#search_by_disp').val();
        var module_short_name = $('#module_short_name').val();
        if ($('#current_date').is(':checked')) {
            var current_date = $('#current_date').val();
        }

        if ($('#current_month').is(':checked')) {
            var current_month = $('#current_month').val();
        }

        $.ajax({
            url: "<?= base_url(); ?>filter/datefilter_list_page",
            type: "post",
            data: {
                startdate: startdate,
                enddate: enddate,
                sel_disposition: sel_disposition,
                module_short_name: module_short_name,
                current_date: current_date,
                current_month: current_month
            },
            success: function(response) {
                $('.filterdata').html(response);
                $('.pagenation_data').css('display', 'none');
                var rowCount = $('.filterdata').html(response).find('.count_1').length;
                $('#policy_count').text(rowCount);
                $('#current_date').attr('checked', true);
                let total = sessionStorage.getItem("total_pre");
                $("#total_premium").text("Total Premium -" + total);
               
               
            }
        })
    }

    function searchdata() {
        var total_premium = $('#totalpremium').val();
        var select_attribute = $('#select_attribute').val();
        var content = $('#search').val();
        var company_name = $('#company_name').val();
        var search_by_disp = $('#search_by_disp').val();
        var startdate = $('#start_date').val();
        var enddate = $('#end_date').val();
        var module_short_name = $('#module_short_name').val();
        var expstartdate = $('#exp_start_date').val();
        var expenddate = $('#exp_end_date').val();
        // var fresh_operation = $('#fresh_operation').val();
        
        
        if ($("#current_date").is(':checked')) {
            var current_date = $('#current_date').val();
        } else if ($("#current_month").is(':checked')) {
            var current_month = $('#current_month').val();
        }
        $.ajax({
            url: "<?= base_url('filter/searchdata_list_page'); ?>",
            type: "post",
            data: {
                content: content,
                expstartdate: expstartdate,
                expenddate: expenddate,
                select_attribute: select_attribute,
                company_name: company_name,
                startdate: startdate,
                enddate: enddate,
                search_by_disp: search_by_disp,
                module_short_name: module_short_name,
                current_date: current_date,
                current_month: current_month
               

            },
            beforeSend: function() {
            $(".status").html('<lord-icon src="https://cdn.lordicon.com/pxruxqrv.json" trigger="loop" colors="primary" style="width:100px;height:100px;"></lord-icon>');
        	
            },
            success: function(response) {
                
                var rowCount = $('.filterdata').html(response).find('.count_1').length;
                $('.filterdata').html(response);
                $('.pagenation_data').css('display', 'none');
                $('#policy_count').text(rowCount);
                let total = sessionStorage.getItem("total_pre");
                $("#total_premium").text("Total Premium -" + total);
                
            }
        })
    }

    function freshpolicy() {
        var total_premium = $('#totalpremium').val();
        var select_attribute = $('#select_attribute').val();
        var content = $('#search').val();
        var company_name = $('#company_name').val();
        var search_by_disp = $('#search_by_disp').val();
        var startdate = $('#start_date').val();
        var enddate = $('#end_date').val();
        var module_short_name = $('#module_short_name').val();

        //alert(module_short_name);
        var expstartdate = $('#exp_start_date').val();
        var expenddate = $('#exp_end_date').val();
        // var fresh_operation = $('#fresh_operation').val();

        if ($("#current_date").is(':checked')) {
            var current_date = $('#current_date').val();
        } else if ($("#current_month").is(':checked')) {
            var current_month = $('#current_month').val();
        }
        $.ajax({
            url: "<?= base_url('filter/freshpolicy_list_page'); ?>",
            type: "post",
            data: {
                content: content,
                expstartdate: expstartdate,
                expenddate: expenddate,
                select_attribute: select_attribute,
                company_name: company_name,
                startdate: startdate,
                enddate: enddate,
                search_by_disp: search_by_disp,
                module_short_name: module_short_name,
                current_date: current_date,
                current_month: current_month
               

            },
            beforeSend: function() {
            $(".status").html('<lord-icon src="https://cdn.lordicon.com/pxruxqrv.json" trigger="loop" colors="primary" style="width:100px;height:100px;"></lord-icon>');
        	
            },
            success: function(response) {
                var rowCount = $('.filterdata').html(response).find('.count_1').length;
                $('.filterdata').html(response);
                $('.pagenation_data').css('display', 'none');
                $('#policy_count').text(rowCount);
                let total = sessionStorage.getItem("total_pre");
                $("#total_premium").text("Total Premium -" + total);


            }
        })
    }

    function current_date_data() {
        $.ajax({
            url: "<?= base_url('filter/current_date_filter_list_page'); ?>",
           
            success: function(response) {
                $('.filterdata').html(response);
            }
        })
    }

    function current_month_data() {
        $.ajax({
            url: "<?= base_url('filter/current_month_filter_list'); ?>",
           
            success: function(response) {
                $('.filterdata').html(response);
            }
        })
    }

    function next_month_data() {
        $.ajax({
            url: "<?= base_url('filter/next_month_filter_list'); ?>",
           
            success: function(response) {
                $('.filterdata').html(response);
            }
        })
    }

    function show_input(val) {
        $("#search").val('');


        if (val == 'by_company') {
            $("#com_name").css("display", 'block');
            $("#search").css("display", 'none');
        } else {
            $("#com_name").css("display", 'none');
            $("#search").css("display", 'block');
        }
        if ($("select[name='select_attribute']").selectedIndex == 0 || val == '') {
            $("#search").prop("readonly", true);
        } else {
            $("#search").prop("readonly", false);
        }


    }

    function filetr_wise_all() {
        var total_premium = $('#totalpremium').val();
        var module_short_name = $('#module_short_name').val();
        var sel_disp = $('#search_by_disp').val();
        if ($('#current_date').is(':checked')) {

            var current_date = $('#current_date').val();

            $.ajax({
                method: 'post',
                url: "<?= base_url('filter/current_date_filter_list_page'); ?>",
                data: {
                    sel_disp: sel_disp,
                    module_short_name: module_short_name,
                    current_date: current_date
                },
                
                success: function(response) {
                    var rowCount = $('.filterdata').html(response).find('.count_1').length;
                    $('#policy_count').text(rowCount);
                    $('.filterdata').html(response);
                    $('#current_date').attr('checked', true);
                    let total = sessionStorage.getItem("total_pre");
                    $("#total_premium").text("Total Premium -" + total);

                }
            })
        } else {

            var current_month = $('#current_month').val();
            $.ajax({
                method: 'post',
                url: "<?= base_url('filter/current_date_filter_list_page'); ?>",
                data: {
                    sel_disp: sel_disp,
                    module_short_name: module_short_name,
                    current_month: current_month
                },
               
                success: function(response) {
                    var rowCount = $('.filterdata').html(response).find('.count_1').length;
                    $('#policy_count').text(rowCount);
                    $('.filterdata').html(response);
                    $('#current_month').attr('checked', true);
                    let total = sessionStorage.getItem("total_pre");
                    $("#total_premium").text("Total Premium -" + total);
                }
            })

        }



    }

    function filetr_wise_all_month() {
        var total_premium = $('#totalpremium').val();
        var module_short_name = $('#module_short_name').val();
        var sel_disp = $('#search_by_disp').val();
        if ($('#current_month').is(':checked')) {
            var current_month = $('#current_month').val();
            $.ajax({
                method: 'post',
                url: "<?= base_url('filter/current_date_filter_list_page'); ?>",
                data: {
                    sel_disp: sel_disp,
                    module_short_name: module_short_name,
                    current_month: current_month
                },
                success: function(response) {
                    var rowCount = $('.filterdata').html(response).find('.count_1').length;
                    $('#policy_count').text(rowCount);
                    $('.filterdata').html(response);
                    $('#current_month').attr('checked', true);
                    let total = sessionStorage.getItem("total_pre");
                    $("#total_premium").text("Total Premium -" + total);

                }
            })
        } else {
            var current_date = $('#current_date').val();
            $.ajax({
                method: 'post',
                url: "<?= base_url('filter/current_date_filter_list_page'); ?>",
                data: {
                    sel_disp: sel_disp,
                    module_short_name: module_short_name,
                    current_date: current_date
                },
                success: function(response) {
                    var rowCount = $('.filterdata').html(response).find('.count_1').length;
                    $('#policy_count').text(rowCount);
                    $('.filterdata').html(response);
                    $('#current_date').attr('checked', true);
                    let total = sessionStorage.getItem("total_pre");
                    $("#total_premium").text("Total Premium -" + total);

                }
            })
        }

    }

    function showdisp(val) {
        if (val == 30) {

            $('#pending_sub_disp').css('display', 'block');
            $('#cancelled_sub_disp').css('display', 'none');
        }

        if (val == 31) {

            $('#cancelled_sub_disp').css('display', 'block');
            $('#pending_sub_disp').css('display', 'none');
        }
    }

    function showdatasubdisp(val) {
        var total_premium = $('#totalpremium').val();
        var sel_disp = $('#search_by_disp').val();
        var module_short_name = $('#module_short_name').val();
        $.ajax({
            method: 'post',
            url: "<?= base_url('filter/subdisp_filter_list_page'); ?>",
            data: {
                sel_disp: sel_disp,
                module_short_name: module_short_name,
                val: val
            },
            success: function(response) {
                var rowCount = $('.filterdata').html(response).find('.count_1').length;
                $('#policy_count').text(rowCount);
                $('.filterdata').html(response);
                $('#current_date').attr('checked', true);
                let total = sessionStorage.getItem("total_pre");
                $("#total_premium").text("Total Premium -" + total);
            }
        })
    }

    function expiry_datefilter() {
        var total_premium = $('#totalpremium').val();
        var expstartdate = $('#exp_start_date').val();
        var expenddate = $('#exp_end_date').val();
        var sel_disposition = $('#search_by_disp').val();
        var module_short_name = $('#module_short_name').val();
        if ($('#current_date').is(':checked')) {
            var current_date = $('#current_date').val();
        }

        if ($('#current_month').is(':checked')) {
            var current_month = $('#current_month').val();
        }

        $.ajax({
            url: "<?= base_url(); ?>filter/expiry_datefilter_service_page",
            type: "post",
            data: {
                expstartdate: expstartdate,
                expenddate: expenddate,
                sel_disposition: sel_disposition,
                module_short_name: module_short_name,
                current_date: current_date,
                current_month: current_month
            },
        
            success: function(response) {
                var rowCount = $('.filterdata').html(response).find('.count_1').length;
                $('#policy_count').text(rowCount);
                $('.filterdata').html(response);
                $('#current_date').attr('checked', true);
                let total = sessionStorage.getItem("total_pre");
                $("#total_premium").text("Total Premium -" + total);
            }
        })
    }
</script>


</body>

</html>