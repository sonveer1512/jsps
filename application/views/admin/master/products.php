<?php
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
                        <h4 class="mb-sm-0">Products</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php base_url() ?>Dashboard">Dashboards</a></li>
                                <li class="breadcrumb-item active">Products</li>
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
                            <h4 class="card-title mb-0 flex-grow-1">Products</h4>

                            <div class="flex-shrink-0">
                                <?php if ($this->rbac->hasPrivilege('products', 'can_add')) { ?>
                                    <button type="button" data-toggle="tooltip" data-placement="bottom" title="Add New Products" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#products"><i class="ri-user-add-line"></i></button>
                                <?php } ?>

                            </div>

                        </div><!-- end card header -->


                        <div class="modal fade" id="products" tabindex="-1" aria-labelledby="products" aria-modal="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h5 class="modal-title" id="exampleModalgridLabel">Add New Products </h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                    </div>

                                    <div class="modal-body">
                                        <div id="success">
                                            <div id="error">
                                            </div>

                                        </div>
                                        <form method="POST" id="addproducts">
                                            <div class="row g-3">
                                                <div class="col-xxl-12">
                                                    <div>
                                                        <label for="firstName" class="form-label">Company Name</label>
                                                        <select class="form-select form-control" aria-label=".form-select-sm example" name="company_name" id="company_name">
                                                            <option value="" selected>Select</option>
                                                            <?php foreach ($company as $data) {
                                                            ?>
                                                                <option value="<?= $data['id']; ?>" <?php if (!empty($content[0]['company_name'])) {
                                                                                                        if ($content[0]['id'] == $data['id']) {
                                                                                                            echo "selected";
                                                                                                        }
                                                                                                    } ?>><?= $data['name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="error" id="companyError"></div>
                                                </div>
                                            </div>

                                            <div class="row g-3">
                                                <div class="col-xxl-12">
                                                    <div>
                                                        <label for="emailInput" class="form-label">Product Name</label>
                                                        <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter Product Name">
                                                    </div>
                                                    <div class="error" id="productError"></div>
                                                </div>


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
                                <div class="card-body">
                                    <div id="fixed-header_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="fixed-header" class="table table-bordered dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline" style="width: 100%;" aria-describedby="fixed-header_info">
                                                    <thead>
                                                        <tr>

                                                            <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1" style="width: 606.4px;" aria-label="SR No.: activate to sort column ascending">ID</th>
                                                            <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1" style="width: 538.4px;" aria-label="ID: activate to sort column ascending">Company Name</th>
                                                            <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1" style="width: 906.4px;" aria-label="Purchase ID: activate to sort column ascending">Product Name</th>
                                                            <!-- <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1" style="width: 538.4px;" aria-label="Title: activate to sort column ascending">Status </th> -->
                                                            <!-- <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1" style="width: 538.4px;" aria-label="User: activate to sort column ascending">Emp ID</th>
                                              <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1" style="width: 538.4px;" aria-label="Assigned To: activate to sort column ascending">Department</th>
                                            -->
                                                            <th class="sorting" tabindex="0" aria-controls="fixed-header" rowspan="1" colspan="1" style="width: 538.4px;" aria-label="Action: activate to sort column ascending">Action</th>
                                                        </tr>

                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $i = 1;
                                                        if (!empty($products_list)) {
                                                            foreach ($products_list as $row) {
                                                        ?>
                                                                <tr class="odd">

                                                                    <td><?php echo $i; ?></td>
                                                                    <td><?php if (!empty($row['company_id'])) { ?><?php $com_id=$row['company_id'];
                                                                     $this->db->select('*');
                                                                     $this->db->from('company');
                                                                     $this->db->where('id', $com_id);
                                                                     $rows1 = $this->db->get()->row();
                                                                     echo $rows1->name;?>
                                                                     <?php } ?></td>
                                                                    <td><?php if (!empty($row['product_name'])) { ?><?php echo $row['product_name'] ?> <?php } ?></td>
                                                                      <?php if ($this->rbac->hasPrivilege('products', 'can_edit')) { ?>
                                                                        <td>

                                                                            <i class="ri-edit-box-line editmodel" style="color: blue;" class="" data-bs-toggle="modal" data-bs-target="#editsubadmin" data-id="<?php echo $row['id']; ?>"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            <i class="ri-delete-bin-line" name="archive" class="remove" type="submit" onclick="archiveFunction(<?php echo $row['id']; ?>)" data-toggle="tooltip" data-placement="bottom" style="color: red;"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            <?php if ($row['flag'] == "0") {?>
                                                                                    <i class="ri-checkbox-circle-line" data-toggle="tooltip" data-placement="bottom" title="Disable Your Account" name="archive" class="remove" type="submit" onclick="disableaccount(<?php echo $row['id'] ?>)" data-toggle="tooltip" data-placement="bottom" style="color: green;"></i>
                                                                                <?php } else { ?>
                                                                                    <i class="ri-alert-line" data-toggle="tooltip" data-placement="bottom" title="Enable Your Account" name="archive" class="remove" type="submit" onclick="enableaccount('<?php echo $row['id'] ?>')" data-toggle="tooltip" data-placement="bottom" style="color: red;"></i>
                                                                                <?php } ?>
                                                                        </td>
                                                                    <?php } ?>



                                                                </tr>
                                                        <?php $i++;
                                                            }
                                                        } ?>
                                                    </tbody>
                                                </table>
                                                 <!-- pagination start -->
                                                 <div class="align-items-center mt-2 row g-3 text-center text-sm-start">
                                                    <div class="col-sm">
                                                        <div class="text-muted">Showing<span class="fw-semibold"> <?= count($products_list) ?> -
                                                                <?= isset($count) ? $count : ''; ?></span> Results
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <ul class="pagination pagination-separated pagination-sm justify-content-center justify-content-sm-start mb-0">
                                                            <?php $uri = $this->uri->segment(2); ?>

                                                            <?php for ($i = 0; $i < ($count / 10); $i++) { ?>
                                                                <li class="page-item <?php if (($uri == '') && ($i + 1 == 1)) {
                                                                                            echo 'active';
                                                                                        } else if ($uri == ($i + 1)) {
                                                                                            echo 'active';
                                                                                        } ?>">
                                                                    <a href="<?= base_url() ?>Products/<?= $i + 1 ?>" class="page-link" style="<?php if ($uri == '') {
                                                                                                                                                    if ($i + 1 == 1) {
                                                                                                                                                        echo 'pointer-events: none;';
                                                                                                                                                    }
                                                                                                                                                } else if ($uri == $i + 1) {
                                                                                                                                                    echo 'pointer-events: none;';
                                                                                                                                                } ?>"><?= $i + 1 ?></a>
                                                                </li>
                                                            <?php } ?>

                                                            <?php if ($i > $uri) { ?>
                                                                <li class="page-item">
                                                                    <a href="<?= base_url() ?>Products/<?= $uri + 1 ?>" class="page-link">→</a>
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

                        </div>




                        <div class="card-body">
                            <div class="live-preview">

                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row -->


                </div>
                <!-- container-fluid -->
            </div>
            <div class="modal fade" id="editsubadmin" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalgridLabel">Edit Product</h5>
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

        </div>
    </div>

    <?php $this->load->view('admin/footer');  ?>
</div>


<!-- JAVASCRIPT -->
<script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url() ?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?= base_url() ?>assets/libs/feather-icons/feather.min.js"></script>
<script src="<?= base_url() ?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="<?= base_url() ?>assets/js/plugins.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- apexcharts -->
<script src="<?= base_url() ?>assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Vector map-->
<script src="<?= base_url() ?>assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="<?= base_url() ?>assets/libs/jsvectormap/maps/world-merc.js"></script>

<!--Swiper slider js-->
<script src="<?= base_url() ?>assets/libs/swiper/swiper-bundle.min.js"></script>

<!-- Dashboard init -->
<script src="<?= base_url() ?>assets/js/pages/dashboard-ecommerce.init.js"></script>
<!--datatable js-->
<!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/js/pages/datatables.init.js"></script> -->

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
                text: "Delete Product ",
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
                        url: "<?= base_url() ?>products/delete/id",
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
                    swal("Cancelled", "User Product is safe 🙂", "error");
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
    $(document).on('submit', '#addproducts', function(ev) {
        $('.error').html('');

        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;
        var product_name = $('#product_name').val();
        var company_name = $('#company_name').val();

        if (product_name == '') {
            $('#productError').html('Enter Product Name');
            $('.error').css('color', 'red');
            error = true;


        }
        if (company_name == '') {
            $('#companyError').html('Select Company Name');
            $('.error').css('color', 'red');
            error = true;


        }

        if (error == false) {
            $.ajax({
                url: "<?= base_url('products/addproducts'); ?>",
                type: 'post',
                data: formData,
                success: function(result) {

                    var dataResult = JSON.parse(result);
                    if (dataResult.done == '1') {
                        swal('Product Added 🙂', ' ', 'success');
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }

                    if (dataResult.done == '0') {
                        swal('Product Not Added ☹️', ' ', 'success');

                    }

                    if (dataResult.email == '0') {
                        swal('Product already Exist ☹️', ' ', 'error');



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

            var id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('products/openeditmodel'); ?>",
                type: "post",
                data: {
                    id: id
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
    $(document).on('submit', '#editproducts', function(ev) {
        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        $.ajax({
            url: "<?= base_url() ?>products/updateproducts/",
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
    function disableaccount(id) {
        event.preventDefault(); // prevent form submit
        
        var form = event.target.form; // storing the form
        swal({
                title: "Are you sure?",
                text: "Disable Product",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Disable Please",
                cancelButtonText: "No, cancel Please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
           function(isConfirm){
             if (isConfirm) {
      $.ajax({
          url: "<?=base_url()?>DisableProducts/id",
          type: "post",
          data: {id:id},
          success:function(){
            swal('Product Disable 🙂', ' ', 'success');
            $("#delete"+id).fadeTo("slow", 0.7, function(){
              $(this).remove();
            })
            setTimeout(function() {
				location.reload(true);
			}, 1000);

          },
          error:function(){
            swal('Product Still Enable ☹️', 'error');
          }
      });
  }
  else {
               swal("Cancelled", "User Product is safe 🙂", "error");
            }
      
    });
    }
</script>
<script type="text/javascript">
    function enableaccount(id) {
        event.preventDefault(); // prevent form submit
        
        var form = event.target.form; // storing the form
        swal({
                title: "Are you sure?",
                text: "Enable Product ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Enable Please",
                cancelButtonText: "No, cancel Please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
           function(isConfirm){
             if (isConfirm) {
      $.ajax({
          url: "<?=base_url()?>EnableProducts/1",
          type: "post",
          data: {id:id},
          success:function(){
            swal('Product Enable 🙂', ' ', 'success');
            $("#delete"+id).fadeTo("slow", 0.7, function(){
              $(this).remove();
            })
            setTimeout(function() {
				location.reload(true);
			}, 1000);

          },
          error:function(){
            swal('Product Still Disable ☹️', 'error');
          }
      });
  }
  else {
               swal("Cancelled", "User Product is safe 🙂", "error");
            }
      
    });
    }
</script>

</body>

</html>