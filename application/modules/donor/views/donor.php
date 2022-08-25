
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading"> 
                <?php echo lang('donor'); ?> 
                <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                    <div class="col-md-4 no-print pull-right"> 
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group pull-right">
                                <button id="" class="btn green btn-xs">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_donor'); ?>
                                </button>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('blood_group'); ?></th>
                                <th><?php echo lang('age'); ?></th>
                                <th><?php echo lang('sex'); ?></th>
                                <th><?php echo lang('last_donation_date'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <th><?php echo lang('email'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Laboratorist', 'Doctor'))) { ?>
                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>

                        <style>

                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }

                        </style>

                        <?php foreach ($donors as $donor) { ?>
                            <tr class="">
                                <td><?php echo $donor->name; ?></td>
                                <td> <?php echo $donor->group; ?></td>
                                <td><?php echo $donor->age; ?></td>
                                <td class="center"><?php echo $donor->sex; ?></td>
                                <td><?php echo $donor->ldd; ?></td>
                                <td><?php echo $donor->phone; ?></td>
                                <td><?php echo $donor->email; ?></td>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Laboratorist', 'Doctor'))) { ?>
                                    <td class="no-print">
                                        <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $donor->id; ?>"><i class="fa fa-edit"> </i></button>   
                                        <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="donor/delete?id=<?php echo $donor->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i></a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->







<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_donor'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="donor/addDonor" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="group" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($donor->group)) {
                                    if ($group->group == $donor->group) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                        <input type="text" class="form-control" name="age" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"><?php echo lang('last_donation_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="ldd" value="" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>
                            <option value="Male" <?php
                            if (!empty($donor->sex)) {
                                if ($donor->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > Male </option>
                            <option value="Female" <?php
                            if (!empty($donor->sex)) {
                                if ($donor->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > Female </option>
                            <option value="Others" <?php
                            if (!empty($donor->sex)) {
                                if ($donor->sex == 'Others') {
                                    echo 'selected';
                                }
                            }
                            ?> > Others </option>
                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_donor'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editDonorForm" class="clearfix" action="donor/addDonor" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="group" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($donor->group)) {
                                    if ($group->group == $donor->group) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                        <input type="text" class="form-control" name="age" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"><?php echo lang('last_donation_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="ldd" value="" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>
                            <option value="Male" <?php
                            if (!empty($donor->sex)) {
                                if ($donor->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > Male </option>
                            <option value="Female" <?php
                            if (!empty($donor->sex)) {
                                if ($donor->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > Female </option>
                            <option value="Others" <?php
                            if (!empty($donor->sex)) {
                                if ($donor->sex == 'Others') {
                                    echo 'selected';
                                }
                            }
                            ?> > Others </option>
                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>



                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                    $(document).ready(function () {
                                        $(".editbutton").click(function (e) {
                                            e.preventDefault(e);
                                            // Get the record's ID via attribute  
                                            var iid = $(this).attr('data-id');
                                            $('#editDonorForm').trigger("reset");
                                            $('#myModal2').modal('show');
                                            $.ajax({
                                                url: 'donor/editDonorByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editDonorForm').find('[name="id"]').val(response.donor.id).end()
                                                $('#editDonorForm').find('[name="name"]').val(response.donor.name).end()
                                                $('#editDonorForm').find('[name="group"]').val(response.donor.group).end()
                                                $('#editDonorForm').find('[name="age"]').val(response.donor.age).end()
                                                $('#editDonorForm').find('[name="sex"]').val(response.donor.sex).end()
                                                $('#editDonorForm').find('[name="ldd"]').val(response.donor.ldd).end()
                                                $('#editDonorForm').find('[name="phone"]').val(response.donor.phone).end()
                                                $('#editDonorForm').find('[name="email"]').val(response.donor.email).end()
                                            });
                                        });
                                    });
</script>
<script>
    $(document).ready(function () {
       var table = $('#editable-sample').DataTable({
            responsive: true,

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6],
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json" 
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
