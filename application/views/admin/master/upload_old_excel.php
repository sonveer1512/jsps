<?php
// error_reporting(0);
$this->load->view('admin/link');
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


<div class="vertical-overlay"></div>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Old Data</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php base_url() ?>Dashboard">Dashboards</a></li>
                                <li class="breadcrumb-item active">Old Data</li>
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
                            <h4 class="card-title mb-0 flex-grow-1">Uploaded List</h4>
                            <div class="flex-shrink-0">
                                <?php if ($this->rbac->hasPrivilege('upload_old_excel', 'can_add')) { ?>
                                    <button type="button" data-toggle="tooltip" data-placement="bottom" title="Upload New Excel" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Upload Excel</button>
                                <?php } ?>

                            </div>
                        </div><!-- end card header -->

                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">
                                        <lord-icon src="https://cdn.lordicon.com/qduilmpq.json" trigger="loop" style="width:100px;height:100px">
                                        </lord-icon>
                                        <!-- <div class="container">
                                            <h2>Progressing</h2>
                                            <div class="progress"></div>
                                            </div> -->
                                        <div class="mt-4">
                                            <h4 class="mb-3">Upload Your Excel Here</h4>
                                            <a href="<?php echo base_url(); ?>Sample/sample.xlsx" download> <button type="button" data-toggle="tooltip" data-placement="bottom" title="Upload Sample Data" class="btn btn-primary waves-effect waves-light">Sample Excel</button></a><br><br>
                                            <form method="POST" id="upload_old_excel" enctype="multipart/form-data">
                                                <div class="col-md-12">
                                                    <input type="file" class="form-control" id="uploadFile" name="uploadFile" placeholder="Select Your File" required accept=".xls, .xlsx">
                                                    <div class="error" id="uploadError"></div>
                                                </div><br>
                                                <div class="hstack gap-2 justify-content-center">
                                                    <a href="#" class="btn btn-danger" data-bs-dismiss="modal"> Close</a>

                                                    <input type="submit" name="fileuploadsubmit" class="btn btn-primary" value="Upload">
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-body">
                                    <div id="fixed-header_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="fixed-header" class="table table-bordered dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline" aria-describedby="fixed-header_info">
                                                    <thead>
                                                        <tr>
 															<th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1"  aria-label="SR No.: activate to sort column ascending">S.no.</th>
                                                            <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1"  aria-label="ID: activate to sort column ascending">Policy No.</th>
                                                            <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1"  aria-label="Purchase ID: activate to sort column ascending">Customer Name</th>
                                                            <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1"  aria-label="Title: activate to sort column ascending">Book Date </th>
                                                            <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1"  aria-label="Title: activate to sort column ascending">Policy End Date </th>
                                                            <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1"  aria-label="Title: activate to sort column ascending">Policy Status</th>
                                                          
                                                          
                                                            <!-- <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1" style="width: 538.4px;" aria-label="Action: activate to sort column ascending">Action</th> -->
                                                        </tr>

                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $i = 1;
                                                        if (!empty($old_list)) {
                                                            foreach ($old_list as $row) {
                                                        ?>
                                                                <tr class="odd">

                                                                  	<td><?php echo $i; ?></td>
                                                                    <td><?php if (!empty($row['policy_no'])) { ?><?php echo $row['policy_no'] ?> <?php } ?></td>
                                                                    <td><?php if (!empty($row['customer_name'])) { ?><?php echo $row['customer_name'] ?> <?php } else {
                                                                                                                                                            echo $row['proposer_name'];
                                                                                                                                                        } ?></td>
                                                                    <td><?php if (!empty($row['policy_end_date'])) {
                                                                            $date_of_closure = date("d-m-Y", strtotime($row['date_of_closure'])); ?><?= $date_of_closure ?> <?php } ?></td>
                                                                    <td><?php if (!empty($row['policy_end_date'])) {
                                                                            $date_of_expiry = date("d-m-Y", strtotime($row['policy_end_date'])); ?><?= $date_of_expiry ?> <?php } ?></td>
                                                                    <td><?php if ($row['old_new'] == 0) { ?> <span class="badge badge-soft-success">Old Data</span> <?php } else { ?> <span class="badge badge-soft-danger">New Uploaded</span> <?php } ?></td>

                                                                    <!-- <td><?php $policy_check = $this->upload_excel_model->check_policy('form', 'policy_no', $row['policy_no']);
                                                                                if ($policy_check > 0) { ?>
                                                                    <span class="badge badge-soft-success">Yes</span>
                                                                    <?php } else { ?>
                                                                        <span class="badge badge-soft-danger">No</span>
                                                                        <?php } ?>   
                                                                    </td> -->
                                                                    <!-- <?php if ($this->rbac->hasPrivilege('upload_old_excel', 'can_edit')) { ?>
                                                                        <td>

                                                                            <i class="ri-edit-box-line edit_excel_model" style="color: blue;" class="" data-bs-toggle="modal" data-bs-target="#edit_model_data" data-id="<?php echo $row['id']; ?>"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            
                                                                        </td>
                                                                    <?php } ?> -->
                                                                </tr>
                                                        <?php $i++;
                                                            }
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
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
            <div class="modal fade" id="edit_model_data" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalgridLabel">Edit Uploaded Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" onClick="window.location.reload();" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="excel_data">

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- pass -->

        </div>
    </div>

    <?php $this->load->view('admin/footer');  ?>
</div>
<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/js/pages/datatables.init.js"></script>

<script src="<?= base_url() ?>assets/js/app.js"></script>

<script>
    $(document).on('submit', '#upload_old_excel', function(ev) {
        $('.error').html('');
        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;
        var uploadFile = $('#uploadFile').val();
        if (uploadFile == '') {
            $('#uploadError').html('Select Excel for upload');
            $('.error').css('color', 'red');
            error = true;


        }

        if (error == false) {
            $.ajax({
                url: "<?= base_url(); ?>UploadOldExcel/import_people_data",
                type: 'post',
                data: formData,
                // beforeSend: function() {
                //     $(".status").html('<lord-icon src="https://cdn.lordicon.com/pxruxqrv.json" trigger="loop" colors="primary" style="width:100px;height:100px;"></lord-icon>');
                    
                // },
                success: function(result) {

                    var dataResult = JSON.parse(result);
                    if (dataResult.inserted == 1) {
                       swal('Excel Uploaded 🙂', ' ', 'success');
                       setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }

                    if (dataResult.inserted == 0) {
                       alert(dataResult.not_exisiting);
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
        $('.edit_excel_model').click(function() {

            var id = $(this).data('id');
            $.ajax({
                url: "<?= base_url('UploadOldExcel/openexcelmodel'); ?>",
                type: "post",
                data: {
                    id: id
                },
                success: function(response) {

                    $('.excel_data').html(response);
                    $('.uploaded_old_data').modal('show');

                }
            })


        });
    });
</script>
<script type="text/javascript">
    // update modal
    $(document).on('submit', '#edit_upload_old_excel', function(ev) {
        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        $.ajax({
            url: "<?= base_url() ?>UploadOldExcel/update/",
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

</body>

</html>