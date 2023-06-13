<?php

$sess = $this->session->userdata('pmsadmin');
$name = $sess['name'];
$role = $sess['role'];
$id = $sess['id'];
$model_short_name = $this->uri->segment(2);
if($model_short_name == 'subadminedit'){
 $model_short_name = $this->uri->segment(3);
}
$new_count = $this->db->query("select count(*) as notificationcount from notification where read_status = 0 AND flag = 0")->result();
$all_count = $this->db->query("select count(*) as notificationcount from notification where flag = 0")->result();
?>

<style type="text/css">
    .navbar-header {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        -webkit-box-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin: 0 auto;
        height: 54px;
        padding: 0 1.5rem 0 calc(1.5rem / 2);
    }

    .header-item {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .app-search .form-control {
        border: none;
        height: 38px;
        padding-left: 40px !important;
        padding-right: 30px !mportant;
        background-color: var(--vz-topbar-search-bg);
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .avatar-xs {
        height: 2rem;
        width: 33px;
        margin-left: -14px;
    }
</style>
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="<?= base_url() ?>Dashboard" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?= base_url() ?>/assets/images/jsps.jpg" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url() ?>/assets/images/jsps.jpg" alt="" height="17">
                        </span>
                    </a>

                    <a href="<?= base_url() ?>Dashboard" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?= base_url() ?>/assets/images/jsps.jpg" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url() ?>/assets/images/jsps.jpg" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-md-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off" id="search-options" value="">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                        <div data-simplebar style="max-height: 320px;">
                            <!-- item-->
                            <div class="dropdown-header">
                                <h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
                            </div>

                            <div class="dropdown-item bg-transparent text-wrap">
                                <a href="index.html" class="btn btn-soft-secondary btn-sm btn-rounded">how to setup <i class="mdi mdi-magnify ms-1"></i></a>
                                <a href="index.html" class="btn btn-soft-secondary btn-sm btn-rounded">buttons <i class="mdi mdi-magnify ms-1"></i></a>
                            </div>
                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                <span>Analytics Dashboard</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                <span>Help Center</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                <span>My account settings</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
                            </div>


                        </div>

                        <div class="text-center pt-3 pb-1">
                            <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i class="ri-arrow-right-line ms-1"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>






                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell fs-22' onclick="readall(<?php echo $id; ?>)"></i>

                       <span class="position-absolute topbar-badge fs-10  translate-middle badge rounded-pill bg-danger notificationname"><?php
                                                                                                                                           
                                                                                                                                            date_default_timezone_set('Asia/Kolkata');
                                                                                                                                            $time = date('d-m-Y H:i A');
                                                                                                                                            if ($role == 'Master') {
                                                                                                                                                $sql = $this->db->query("select * from notification where created_at >  ?  and flag = 0 order by created_at desc ", [$time]);
                                                                                                                                                $read_count = $this->db->query("select count(*) as notificationcount from notification  where read_status = 1 and flag = 0")->result();
                                                                                                                                                echo $new_count[0]->notificationcount;

                                                                                                                                                $new_count = $this->db->query("select count(*) as notificationcount from notification where read_status = 0 and flag = 0")->result();

                                                                                                                                                $notdata = $sql->result_array();
                                                                                                                                            } else {
                                                                                                                                                if ($model_short_name != 'sale_closure' ) {
                                                                                                                                                    $sql = $this->db->query("select * from notification where`created_by_module` = '$model_short_name' and flag = 0 order by created_at desc ", [$time]);
                                                                                                                                                    $count = $this->db->query("select count(*) as notificationcount from notification  where read_status = 0 and flag = 0 and `created_by_module` = '$model_short_name'")->result();
                                                                                                                                                    $new_count = $this->db->query("select count(*) as notificationcount from notification where read_status = 0 and flag = 0 and `created_by_module` = '$model_short_name'")->result();
                                                                                                                                                }
                                                                                                                                                if ($model_short_name == '' || $model_short_name == 'sale_closure' ) {
                                                                                                                                                    $sql = $this->db->query("select * from notification order by created_at desc ", [$time]);
                                                                                                                                                    $count = $this->db->query("select count(*) as notificationcount from notification  where read_status = 0  and flag = 0")->result();
                                                                                                                                                    $new_count = $this->db->query("select count(*) as notificationcount from notification where read_status = 0 and flag = 0 ")->result();
                                                                                                                                                }
                                                                                                                                                echo $new_count[0]->notificationcount;
                                                                                                                                                $notdata = $sql->result_array();
                                                                                                                                            }

                                                                                                                                            ?>
                            <span class="visually-hidden">unread messages</span></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge badge-soft-light fs-13"><?php echo $new_count[0]->notificationcount; ?> New</span>
                                    </div>

                                </div>


                            </div>

                            <!-- <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                               
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true" style="color: #405189;">
                                            All (<span><?php echo $all_count[0]->notificationcount; ?></span>)
                                        </a>
                                    </li>

                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true" style="color: #405189;">
                                            All (<span><?php echo $all_count[0]->notificationcount; ?></span>)
                                        </a>
                                    </li>

                                </ul>
                            </div> -->

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true" style="color: #405189;">
                                            All (<span><?php echo $all_count[0]->notificationcount; ?></span>)
                                        </a>
                                    </li>


                                </ul>
                            </div>


                        </div>


                        <div class="tab-content" id="notificationItemsTabContent">
                            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2" id="get_not">

                                   <input type="hidden" name="module_short_name" id="module_short_name" value="<?= $model_short_name ?>">
                                    <script>
                                        get_notification();
                                        
                                        function get_notification() {
                                            var module_short_name =  $("#module_short_name").val();
                                         
                                            $.ajax({
                                                url: "<?= base_url('Dashboard/getnotification'); ?>",
                                                type: "post",
                                                data:{
                                                    module_short_name:module_short_name
                                                },
                                                success: function(response) {
                                                    $("#get_not").html(response);
                                                }
                                            })
                                        }
                                    </script>
                                    
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="dropdown ms-sm-3 topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user" src="<?= base_url() ?>assets/images/users/user-dummy-img.jpg" alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $name; ?></span>
                                    <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"><?php echo $role; ?></span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <h6 class="dropdown-header">Welcome Axepert - <?php echo $name; ?></h6>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="<?= base_url() ?>Dashboard/logout"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</header>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


<script>
   

    function read_all_btn() {
        $.ajax({
            url: "<?= base_url('Dashboard/notification'); ?>",
            type: "post",
            success: function(response) {
                var dataResult = JSON.parse(response);
                    if (dataResult.done == '1') {
                        location.reload();
                    }
            }
        })
    }
</script>