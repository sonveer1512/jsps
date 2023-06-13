<?php
include 'link.php';
?>
<?php $total_revenue =  $this->Dashboard_model->total_revenue();

$max_value = max(array_column($total_revenue, 'total_revenue'));
$min_value = min(array_column($total_revenue, 'total_revenue'));

$min_val = min(array_column($total_policy, 'total_policy'));

$max_val = max(array_column($total_policy, 'total_policy'));
$sess = $this->session->userdata('pmsadmin');
		
		$role = $sess['role'];
?>

<body>
    <?php
    //Check what time zone the server is currently in
    $Timezone = date_default_timezone_get();
    // echo "The current server timezone is: " . $Timezone."\n\n";

    date_default_timezone_set('Asia/Kolkata'); //Asia: India


    ?>
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: auto;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }

        div.scroll {

            overflow-x: scroll;
            white-space: nowrap;
        }

        canvas#pieChart {
            display: block !important;
            height: 400px !important;
            width: 450px !important;
        }

        canvas#pieChart_claim {
            display: block !important;
            height: 400px !important;
            width: 450px !important;
        }
    </style>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include 'topar.php'; ?>
        <!-- ========== App Menu ========== -->
        <?php include 'imgheader.php'; ?>

        <?php
        include 'sidebar.php';
        ?>


    </div>
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col">

                        <div class="h-100">

                            <div class="row">
                                <div class="col-xl-4 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body" onclick="window.location.href='<?= base_url() ?>form_listing/sale_closure'">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate"> Total Fresh Business</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="fw-medium text-muted text-truncate fs-14 mb-0" style="text-align: end;">
                                                        <!-- <i class="ri-arrow-right-up-line fs-13 align-middle"></i> -->
                                                        Today
                                                    </h5>
                                                    <p class="fw-medium text-muted text-truncate mb-0"><?php echo date('F j, Y') . "\n"; ?></p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <!-- <a>Today's Fresh Business Amount-</a> -->
                                                    <h4 class="fs-22 fw-semibold ff-secondary">₹<span class="counter-value" data-target="<?= $today_fresh_bus->today_business ?>">

                                                            <?php if ($today_fresh_bus->today_business == '') {
                                                                echo "0";
                                                            } else {
                                                                echo round($today_fresh_bus->today_business);
                                                            } ?>
                                                        </span> </h4>
                                                    <a href="#" class="">Total - ₹ <?php if ($total_fresh_bus->total_business == '') { echo "0"; } else { echo round($total_fresh_bus->total_business); } ?></a>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <!-- <span class="avatar-title bg-soft-success rounded fs-3">
                                                            <i class="bx bx-dollar-circle text-success"></i>
                                                        </span> -->
                                                    <a href="#" class="">View Details →</a>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-4 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body"c onclick="window.location.href='<?= base_url() ?>renewals/renewals'">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate"> RENEWAL BOOKING</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="fw-medium text-muted text-truncate fs-14 mb-0" style="text-align: end;">
                                                        <!-- <i class="ri-arrow-right-up-line fs-13 align-middle"></i> -->
                                                        Today
                                                    </h5>
                                                    <p class="fw-medium text-muted text-truncate mb-0"><?php echo date('F j, Y') . "\n"; ?></p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary">₹<span class="counter-value" data-target="559.25">0</span>k </h4>
                                                    <a href="#" class="">₹1,52,013</a>

                                                </div>
                                                <div class="flex-shrink-0">
                                                    <!-- <span class="avatar-title bg-soft-success rounded fs-3">
                                                            <i class="bx bx-dollar-circle text-success"></i>
                                                        </span> -->
                                                    <a href="#" class="">View Details→</a>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-4 col-md-6">

                                    <!-- card -->
                                    <?php if ($role == 'Master'){?>
                                        <div class="card card-animate" >

<div class="card-body" >

    <div class="d-flex align-items-center">
        <div class="flex-grow-1 overflow-hidden">
            <p class="text-uppercase fw-medium text-muted text-truncate">Claims</p>
        </div>
        <div class="flex-shrink-0">
            <h5 class="fw-medium text-muted text-truncate fs-14 mb-0" style="text-align: end;">
                <!-- <i class="ri-arrow-right-up-line fs-13 align-middle"></i> -->
                <a>Today</a>
            </h5>
            <p class="fw-medium text-muted text-truncate mb-0"><?php echo date('F j, Y') . "\n"; ?></p>
        </div>
    </div>
    <div class="d-flex align-items-end justify-content-between mt-4">
        <div>

            <h4 class="fs-22 fw-semibold ff-secondary"><span class="counter-value" data-target="<?= $today_claim->today_claims ?>">

                    <?php if ($today_claim->today_claims == '') {
                        echo "0";
                    } else {
                        echo $today_claim->today_claims;
                    } ?>
                </span> </h4>
            <a href="#" class="">Total -<?php if ($total_claim->total_no_claims == '') {
                                            echo "0";
                                        } else {
                                            echo $total_claim->total_no_claims;
                                        } ?></a>

        </div>
        <div class="flex-shrink-0">
            <!-- <span class="avatar-title bg-soft-success rounded fs-3">
                    <i class="bx bx-dollar-circle text-success"></i>
                </span> -->
            <a href="#" class="">View Details→</a>
        </div>
    </div>
    </a>
</div><!-- end card body -->
</div><!-- end card -->
                                        <?php }else{?>
                                            <div class="card card-animate" >

<div class="card-body" onclick="window.location.href='<?= base_url() ?>claims/claims'">

    <div class="d-flex align-items-center">
        <div class="flex-grow-1 overflow-hidden">
            <p class="text-uppercase fw-medium text-muted text-truncate">Claims</p>
        </div>
        <div class="flex-shrink-0">
            <h5 class="fw-medium text-muted text-truncate fs-14 mb-0" style="text-align: end;">
                <!-- <i class="ri-arrow-right-up-line fs-13 align-middle"></i> -->
                <a>Today</a>
            </h5>
            <p class="fw-medium text-muted text-truncate mb-0"><?php echo date('F j, Y') . "\n"; ?></p>
        </div>
    </div>
    <div class="d-flex align-items-end justify-content-between mt-4">
        <div>

            <h4 class="fs-22 fw-semibold ff-secondary"><span class="counter-value" data-target="<?= $today_claim->today_claims ?>">

                    <?php if ($today_claim->today_claims == '') {
                        echo "0";
                    } else {
                        echo $today_claim->today_claims;
                    } ?>
                </span> </h4>
            <a href="#" class="">Total -<?php if ($total_claim->total_no_claims == '') {
                                            echo "0";
                                        } else {
                                            echo $total_claim->total_no_claims;
                                        } ?></a>

        </div>
        <div class="flex-shrink-0">
            <!-- <span class="avatar-title bg-soft-success rounded fs-3">
                    <i class="bx bx-dollar-circle text-success"></i>
                </span> -->
            <a href="#" class="">View Details→</a>
        </div>
    </div>
    </a>
</div><!-- end card body -->
</div><!-- end card -->
                                            <?php }?>
                                    
                                </div><!-- end col -->


                            </div> <!-- end row-->




                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="card">

                                        <div class="card-header border-0 align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                                        </div><!-- end card header -->

                                        <div class="card-header p-0 border-0 bg-soft-light">
                                            <div class="d-flex p-3">
                                                <?php foreach ($company as $val) { ?>
                                                    <div class="p-3 border flex-fill border-dashed border-start-0">
                                                        <p class="text-muted  mb-0"><?= $val['name'] ?></p>
                                                        <h5 class="mb-1"><span class="counter-value" data-target="7585"><?php
                                                                                                                        $id = $val['id'];
                                                                                                                        $this->db->select('count(company_name) as count');
                                                                                                                        $this->db->from('form');
                                                                                                                        $this->db->join('company', 'form.company_name = company.id', 'left');
                                                                                                                        // $this->db->where('form.updated_by_user_module', 'renewals');
                                                                                                                        $this->db->where('company.id', $id);
                                                                                                                        $query = $this->db->get();
                                                                                                                        $result = $query->row();
                                                                                                                        echo $result->count;
                                                                                                                        ?></span></h5>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <!--end col-->

                                            <!-- </div> -->

                                        </div><!-- end card header -->

                                        <div class="card-body">

                                            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                                        </div>
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-4">
                                    <!-- card -->
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Renewal </h4>
                                            <div class="d-flex">
                                                <input type="button" class="form-control btn btn-soft-secondary btn-sm" name="all_renewal" id="all_renewal" onclick="datefilter('all');" value="ALL">
                                                <input type="button" class="form-control btn btn-soft-secondary btn-sm" name="one_month_renewal" id="one_month_renewal" onclick="datefilter('1M');" value="1M">
                                                <input type="button" class="form-control btn btn-soft-secondary btn-sm" name="six_month_renewal" id="six_month_renewal" onclick="datefilter('6M');" value="6M">
                                                <input type="button" class="form-control btn btn-soft-primary btn-sm" name="year_renewal" id="year_renewal" onclick="datefilter('1Y');" value="1Y">
                                            </div>
                                        </div><!-- end card header -->

                                        <div class="card-header scroll p-0 border-0 bg-soft-light">
                                            <!-- <div class="row scroll g-0 text-center"> -->
                                            <div class="d-flex p-3">
                                                <?php foreach ($company as $val) { ?>
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <p class="text-muted  mb-0"><?= $val['name'] ?></p>
                                                        <h5 class="mb-1 "><span class="counter-value" data-target="7585"><?php
                                                                                                                            $id = $val['id'];
                                                                                                                            $this->db->select('count(company_name) as count');
                                                                                                                            $this->db->from('form');
                                                                                                                            $this->db->join('company', 'form.company_name = company.id', 'left');
                                                                                                                            $this->db->where('form.updated_by_user_module', 'renewals');
                                                                                                                            $this->db->where('company.id', $id);
                                                                                                                            $query = $this->db->get();
                                                                                                                            $result = $query->row();
                                                                                                                            echo $result->count;
                                                                                                                            ?></span></h5>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!-- card body -->

                                        <div class="card-body">
                                            <div class="filterdata">
                                                <div class="live-preview">
                                                    <div class="table-responsive ">
                                                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                                            <table class="table align-middle table-nowrap mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Proposer Name</th>
                                                                        <th scope="col">Company Name</th>
                                                                        <th scope="col">Policy No.</th>
                                                                        <th scope="col">Expiry Date</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($subadminData as $row) { ?>
                                                                        <tr>
                                                                            <td><?php if (!empty($row['proposer_name'])) { ?><?php echo $row['proposer_name']; ?> <?php } ?></td>
                                                                            <td><?php if ($row['company_name'] == $company[0]['id']) { ?><?php echo $company[0]['name']; ?> <?php } ?></td>
                                                                            <td><?php if (!empty($row['policy_no'])) { ?><?php echo $row['policy_no']; ?> <?php } ?></td>
                                                                            <td><?php if (!empty($row['expiry_date'])) { ?><?php echo $row['expiry_date']; ?> <?php } ?></td>
                                                                            <!-- <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td> -->
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" mt-3 text-center">
                                                    <a href="<?= base_url() ?>renewals/renewals" class="btn btn-primary">View All</a>
                                                </div>

                                                <div class="d-none code-view">
                                                    <pre class="language-markup" style="height: 275px;" tabindex="0"><code class="language-markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>table</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>table table-nowrap<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                                            <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>thead</span><span class="token punctuation">&gt;</span></span>
                                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>tr</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>col<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>ID<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>col<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Customer<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>col<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Date<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>col<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Invoice<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>col<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Action<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>tr</span><span class="token punctuation">&gt;</span></span>
                                            <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>thead</span><span class="token punctuation">&gt;</span></span>
                                            <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>tbody</span><span class="token punctuation">&gt;</span></span>
                                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>tr</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>#<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>fw-semibold<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>#VZ2110<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>Bobby Davis<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>October 15, 2021<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>₹2,300<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>javascript:void(0);<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>link-success<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>View More <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>i</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>ri-arrow-right-line align-middle<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>i</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>tr</span><span class="token punctuation">&gt;</span></span>
                                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>tr</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>#<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>fw-semibold<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>#VZ2109<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>Christopher Neal<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>October 7, 2021<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>₹5,500<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>javascript:void(0);<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>link-success<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>View More <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>i</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>ri-arrow-right-line align-middle<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>i</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>tr</span><span class="token punctuation">&gt;</span></span>
                                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>tr</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>#<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>fw-semibold<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>#VZ2108<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>Monkey Karry<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>October 5, 2021<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>₹2,420<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>javascript:void(0);<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>link-success<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>View More <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>i</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>ri-arrow-right-line align-middle<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>i</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>tr</span><span class="token punctuation">&gt;</span></span>
                                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>tr</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>#<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>fw-semibold<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>#VZ2107<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>James White<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>October 2, 2021<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>₹7,452<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>a</span> <span class="token attr-name">href</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>javascript:void(0);<span class="token punctuation">"</span></span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>link-success<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>View More <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>i</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>ri-arrow-right-line align-middle<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>i</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>a</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>tr</span><span class="token punctuation">&gt;</span></span>
                                            <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>tbody</span><span class="token punctuation">&gt;</span></span>
                                        <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>table</span><span class="token punctuation">&gt;</span></span></code></pre>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Claim Registered</h4>
                                            <div class="d-flex">
                                                <input type="button" class="form-control btn btn-soft-secondary btn-sm" name="all_renewal" id="all_renewal" onclick="claimregister('all');" value="ALL">
                                                <input type="button" class="form-control btn btn-soft-secondary btn-sm" name="one_month_renewal" id="one_month_renewal" onclick="claimregister('1M');" value="1M">
                                                <input type="button" class="form-control btn btn-soft-secondary btn-sm" name="six_month_renewal" id="six_month_renewal" onclick="claimregister('6M');" value="6M">
                                                <input type="button" class="form-control btn btn-soft-primary btn-sm" name="year_renewal" id="year_renewal" onclick="claimregister('1Y');" value="1Y">
                                            </div>
                                        </div><!-- end card header -->

                                        <div class="card-body ">
                                            <div class="claimregister">
                                                <!-- <div id="maincontainer" style="height: 268px;"></div> -->
                                                <canvas id="pieChart"></canvas>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->
                                </div>

                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Claim Paid</h4>
                                            <div class="d-flex">
                                                <input type="button" class="form-control btn btn-soft-secondary btn-sm" name="all_renewal" id="all_renewal" onclick="claimpaid('all');" value="ALL">
                                                <input type="button" class="form-control btn btn-soft-secondary btn-sm" name="one_month_renewal" id="one_month_renewal" onclick="claimpaid('1M');" value="1M">
                                                <input type="button" class="form-control btn btn-soft-secondary btn-sm" name="six_month_renewal" id="six_month_renewal" onclick="claimpaid('6M');" value="6M">
                                                <input type="button" class="form-control btn btn-soft-primary btn-sm" name="year_renewal" id="year_renewal" onclick="claimpaid('1Y');" value="1Y">
                                            </div>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="claimchange">
                                                <canvas id="pieChart_claim"></canvas>
                                            </div>

                                        </div><!-- end card-body -->
                                    </div><!-- end card -->
                                </div>

                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header border-0 align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Renewal NOP</h4>

                                        </div><!-- end card header -->
                                        <div class="card-body">
                                            <canvas id="myhorizontalChart" style="width:100%;max-width:600px"></canvas>
                                        </div>
                                    </div><!-- end card -->
                                </div>
                                <div class="col-xl-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Policy Type Details</h4>

                                        </div><!-- end card header -->
                                        <div class="card-body p-0">

                                            <div data-simplebar style="height: 332px;">
                                                <?php foreach ($company as $val) { ?>
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 ms-3">

                                                                <h6 class="fs-14 mb-1"><?= $val['name']; ?></h6>
                                                                <p class="text-muted fs-12 mb-0">
                                                                    <i class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>Fresh
                                                                </p>
                                                                <p class="text-muted fs-12 mb-0">
                                                                    <i class="mdi mdi-circle-medium text-success fs-15 align-middle"></i>Port
                                                                </p>
                                                            </div>
                                                            <div class="flex-shrink-0 text-center mx-3">
                                                                <h6 class="">Total- ₹ 
                                                                    <?php
                                                                    $id = $val['id'];
                                                                    $policy_sum = $this->Dashboard_model->policy_sum($id);
                                                                    if (!empty($policy_sum->count)) {
                                                                        echo round($policy_sum->count);
                                                                    } else {
                                                                        echo "0";
                                                                    }
                                                                    ?>
                                                                </h6>
                                                                <p class="text-muted fs-13 mb-0"> ₹ <?php
                                                                                                    $id = $val['id'];
                                                                                                    $policy_1 = $this->Dashboard_model->sum_policy_type($id, 'Fresh');
                                                                                                    if (!empty($policy_1->count)) {
                                                                                                        echo round($policy_1->count);
                                                                                                    } else {
                                                                                                        echo "0";
                                                                                                    }
                                                                                                    ?></p>
                                                                <p class="text-muted fs-13 mb-0"> ₹ <?php
                                                                                                    $id = $val['id'];
                                                                                                    $policy_2 = $this->Dashboard_model->sum_policy_type($id, 'Port');
                                                                                                    if (!empty($policy_2->count)) {
                                                                                                        echo round($policy_2->count);
                                                                                                    } else {
                                                                                                        echo "0";
                                                                                                    } ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div><!-- end -->
                                                    <hr style="margin:0px">
                                                <?php } ?>

                                            </div>
                                        </div><!-- end cardbody -->
                                    </div><!-- end card -->
                                </div>
                            </div>





                        </div> <!-- end .h-100-->

                    </div> <!-- end col -->

                    <div class="col-auto layout-rightside-col">
                        <div class="overlay"></div>

                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include "footer.php"; ?>
            <script>
                function datefilter(id) {
                    $.ajax({
                        url: "<?= base_url(); ?>dashboard/renewal_filter",
                        type: "post",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $('.filterdata').html(response);
                        }
                    })
                }
            </script>
            <script>
                function claimregister(id) {
                    $.ajax({
                        url: "<?= base_url(); ?>dashboard/claim_register_filter",
                        type: "post",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $('.claimregister').html(response);
                        }
                    })

                }
            </script>
            <script>
                function claimpaid(id) {
                    // alert(id);
                    $.ajax({
                        url: "<?= base_url(); ?>dashboard/claim_paid_filter",
                        type: "post",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $('.claimchange').html(response);
                        }
                    })
                }
            </script>

            <script>
                var xValues = [<?php foreach ($etc as $val) {
                                    echo $val['year'] . ',';
                                } ?>];
                var yValues = [<?php foreach ($total_revenue as $val) {
                                    echo $val['total_revenue'] . ',';
                                } ?>];
                var barColors = ["rgb(240, 101, 72)", " rgb(10, 179, 156)", "rgb(64, 81, 137)", "rgb(247, 184, 75)", "rgb(41, 156, 219)"];

                new Chart("myChart", {
                    type: "horizontalBar",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {

                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: "Revenue"
                        },
                        scales: {
                            xAxes: [{

                                ticks: {
                                    min: <?= $min_value - '50000'; ?>,
                                    max: <?= $max_value + '100000'; ?>
                                }
                            }]
                        }
                    }
                });
            </script>
            <script>
                var xValues = [<?php foreach ($company as $val) {
                                    echo "'" . $val['name'] . "',";
                                } ?>];
                var yValues = [<?php foreach ($company as $val) {
                                    $id =  $val['name'];
                                    $this->db->select('sum(total_bill_amt) as total_claim_registered');
                                    $this->db->where('flag', '0');
                                    $this->db->where('company_name', $id);
                                    $this->db->from('claim');
                                    $row1 = $this->db->get()->result_array();
                                    echo $row1[0]['total_claim_registered'] . ',';
                                } ?>];

                var barColors = ["rgb(240, 101, 72)", " rgb(10, 179, 156)", "rgb(64, 81, 137)", "rgb(247, 184, 75)", "rgb(41, 156, 219)"];
                new Chart("pieChart", {
                    type: "doughnut",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        cutoutPercentage: 60,
                        responsive: true,
                        title: {
                            display: true,
                            // text: "World Wide Wine Production 2018"
                        }
                    }
                });
            </script>
            <script>
                var xValues = [<?php foreach ($company as $val) {
                                    echo "'" . $val['name'] . "',";
                                } ?>];
                var yValues = [<?php foreach ($company as $val) {
                                    $id =  $val['name'];
                                    $this->db->select('sum(total_approve_amt) as total_claim_registered');
                                    $this->db->where('flag', '0');
                                    $this->db->where('company_name', $id);
                                    $this->db->from('claim');
                                    $row1 = $this->db->get()->result_array();
                                    echo $row1[0]['total_claim_registered'] . ',';
                                } ?>];

                var barColors = ["rgb(240, 101, 72)", " rgb(10, 179, 156)", "rgb(64, 81, 137)", "rgb(247, 184, 75)", "rgb(41, 156, 219)"];
                new Chart("pieChart_claim", {
                    type: "doughnut",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        cutoutPercentage: 60,
                        responsive: true,
                        title: {
                            display: true,
                            // text: "World Wide Wine Production 2018"
                        }
                    }
                });
            </script>
            <script>
                var xValues = [<?php foreach ($etc as $val) {
                                    echo $val['year'] . ',';
                                } ?>];
                var yValues = [<?php foreach ($total_policy as $val) {
                                    echo $val['total_policy'] . ',';
                                } ?>];
                var barColors = ["rgb(240, 101, 72)", " rgb(10, 179, 156)", "rgb(64, 81, 137)", "rgb(247, 184, 75)", "rgb(41, 156, 219)"];

                new Chart("myhorizontalChart", {
                    type: "horizontalBar",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {

                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: "Renewal"
                        },
                        scales: {
                            xAxes: [{
                                ticks: {
                                    min: 0,
                                    max: <?= $max_val + '10'; ?>
                                }
                            }]
                        }
                    }
                });
            </script>