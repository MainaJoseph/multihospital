<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('medicine'); ?>  <?php echo lang('alert_stock_list'); ?>
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_medicine'); ?>
                            </button>
                        </div>
                    </a>
                </div>

            </header>

            <style>

                .editable-table .search_form{
                    border: 0px solid #ccc !important;
                    padding: 0px !important;
                    background: none !important;
                    float: right;
                    margin-right: 14px !important;
                }


                .editable-table .search_form input{
                    padding: 6px !important;
                    width: 250px !important;
                    background: #fff !important;
                    border-radius: none !important;
                }

                .editable-table .search_row{
                    margin-bottom: 20px !important;
                }

                .panel-body {
                    padding: 15px 0px 15px 0px;
                    background: transparent;
                }

            </style>
            <div class="panel-body"> 
                <div class="adv-table editable-table ">
                    <div class="space15">

                        <?php if (!empty($key)) { ?>
                            <p>Search Result For <?php echo $key; ?></p>
                        <?php } ?>


                    </div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('id'); ?></th>
                                <th> <?php echo lang('name'); ?></th>
                                <th> <?php echo lang('category'); ?></th>
                                <th> <?php echo lang('store_box'); ?></th>
                                <th> <?php echo lang('p_price'); ?></th>
                                <th> <?php echo lang('s_price'); ?></th>
                                <th> <?php echo lang('quantity'); ?></th>
                                <th> <?php echo lang('generic_name'); ?></th>
                                <th> <?php echo lang('company'); ?></th>
                                <th> <?php echo lang('effects'); ?></th>
                                <th> <?php echo lang('expiry_date'); ?></th>
                                <th> <?php echo lang('options'); ?></th>
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

                            .load{
                                float: right !important;
                            }

                        </style>

                        <?php
                        if (!empty($p_n)) {
                            $i = $p_n * 50;
                        } else {
                            $i = 0;
                        }
                        foreach ($medicines as $medicine) {
                            $i = $i + 1;
                            ?>
                            <tr class="">
                                <td class="medici_name"><?php echo $i; ?></td>
                                <td class="medici_name"><?php echo $medicine->name; ?></td>
                                <td> <?php echo $medicine->category; ?></td>
                                <td> <?php echo $medicine->box; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $medicine->price; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $medicine->s_price; ?></td>
                                <td> <?php
                                    if ($medicine->quantity <= 0) {
                                        echo '<p class="os">Stock Out</p>';
                                    } else {
                                        echo $medicine->quantity;
                                    }
                                    ?>
                                    <button type="button" class="btn btn-info btn-xs btn_width load" data-toggle="modal" data-id="<?php echo $medicine->id; ?>"> <?php echo lang('load'); ?></button> 
                                </td>
                                <td class="center"><?php echo $medicine->generic; ?></td>
                                <td><?php echo $medicine->company; ?></td>
                                <td><?php echo $medicine->effects; ?></td>
                                <td> <?php echo $medicine->e_date; ?></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $medicine->id; ?>"><i class="fa fa-edit"></i>  <?php echo lang('edit'); ?></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="medicine/delete?id=<?php echo $medicine->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i> <?php echo lang('delete'); ?></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>


                    <!--
                    <?php if (empty($key)) { ?>

                            <div class="row">
                                <div class="col-lg-6"><div class="dataTables_paginate paging_bootstrap pagination"><ul>
                                            <li class="next disabled"><a href="medicine/medicineStockAlertByPageNumber?page_number=<?php
                        if (($pagee_number > 1)) {
                            echo $pagee_number - 1;
                        }
                        ?>"><-- Prev</a>
                                            </li>

                        <?php
                        if ($pagee_number < 5) {
                            for ($pagee = 1; $pagee < 6; $pagee++) {
                                ?>
                                                            <li class="active"><a href="medicine/medicineStockAlertByPageNumber?page_number=<?php echo $pagee; ?>"><?php echo $pagee; ?></a></li>
                                <?php
                            }
                        }

                        if ($pagee_number >= 5) {
                            for ($x = 3; $x > 0; $x--) {
                                ?>
                                                            <li class="active"><a href="medicine/medicineStockAlertByPageNumber?page_number=<?php echo $pagee_number - $x; ?>"><?php echo $pagee_number - $x; ?></a></li>
                                <?php
                            }
                            for ($x = 0; $x < 4; $x++) {
                                ?>
                                                            <li class="active"><a href="medicine/medicineStockAlertByPageNumber?page_number=<?php echo $pagee_number + $x; ?>"><?php echo $pagee_number + $x; ?></a></li>
                                <?php
                            }
                        }
                        ?>
                                            <li class="next disabled"><a href="medicine/medicineStockAlertByPageNumber?page_number=<?php
                        if (!empty($pagee_number)) {
                            echo $pagee_number + 1;
                        } else {
                            echo '1';
                        }
                        ?>">Next → </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                    <?php } else { ?>
                            <div class="row">
                                <div class="col-lg-6"><div class="dataTables_paginate paging_bootstrap pagination"><ul>
                                            <li class="next disabled"><a href="medicine/searchMedicineInAlertStock?page_number=<?php
                        if (($pagee_number > 1)) {
                            echo $pagee_number - 1;
                        }
                        ?>"><-- Prev</a>
                                            </li>

                        <?php
                        if ($pagee_number < 5) {
                            for ($pagee = 1; $pagee < 6; $pagee++) {
                                ?>
                                                            <li class="active"><a href="medicine/searchMedicineInAlertStock?key=<?php echo $key; ?>&page_number=<?php echo $pagee; ?>"><?php echo $pagee; ?></a></li>
                                <?php
                            }
                        }

                        if ($pagee_number >= 5) {
                            for ($x = 3; $x > 0; $x--) {
                                ?>
                                                            <li class="active"><a href="medicine/searchMedicineInAlertStock?key=<?php echo $key; ?>&page_number=<?php echo $pagee_number - $x; ?>"><?php echo $pagee_number - $x; ?></a></li>
                                <?php
                            }
                            for ($x = 0; $x < 4; $x++) {
                                ?>
                                                            <li class="active"><a href="medicine/searchMedicineInAlertStock?key=<?php echo $key; ?>&page_number=<?php echo $pagee_number + $x; ?>"><?php echo $pagee_number + $x; ?></a></li>
                                <?php
                            }
                        }
                        ?>
                                            <li class="next disabled"><a href="medicine/searchMedicineInAlertStock?key=<?php echo $key; ?>&page_number=<?php
                        if (!empty($pagee_number)) {
                            echo $pagee_number + 1;
                        } else {
                            echo '1';
                        }
                        ?>">Next → </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    <?php } ?>

                    -->

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
                <h4 class="modal-title">  <?php echo lang('add_medicine'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="medicine/addNewMedicine" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('category'); ?></label>
                        <select class="form-control m-bot15" name="category" value=''>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->category; ?>" <?php
                                if (!empty($medicine->category)) {
                                    if ($category->category == $medicine->category) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $category->category; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('s_price'); ?></label>
                        <input type="text" class="form-control" name="s_price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('generic_name'); ?></label>
                        <input type="text" class="form-control" name="generic" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                        <input type="text" class="form-control" name="company" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('effects'); ?></label>
                        <input type="text" class="form-control" name="effects" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-4"> 
                        <label for="exampleInputEmail1"> <?php echo lang('store_box'); ?></label>
                        <input type="text" class="form-control" name="box" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('expiry_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="e_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
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
                <h4 class="modal-title">  <?php echo lang('edit_medicine'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editMedicineForm" class="clearfix" action="medicine/addNewMedicine" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('category'); ?></label>
                        <select class="form-control m-bot15" name="category" value=''>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->category; ?>" <?php
                                if (!empty($medicine->category)) {
                                    if ($category->category == $medicine->category) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $category->category; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('s_price'); ?></label>
                        <input type="text" class="form-control" name="s_price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('generic_name'); ?></label>
                        <input type="text" class="form-control" name="generic" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                        <input type="text" class="form-control" name="company" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('effects'); ?></label>
                        <input type="text" class="form-control" name="effects" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-4"> 
                        <label for="exampleInputEmail1"> <?php echo lang('store_box'); ?></label>
                        <input type="text" class="form-control" name="box" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('expiry_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="e_date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>



                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->









<!-- Load Medicine -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('load_medicine'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editMedicineForm" class="clearfix" action="medicine/load" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('add_quantity'); ?></label>
                        <input type="text" class="form-control" name="qty" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Load Medicine -->












<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                    $(document).ready(function () {
                                        $(".editbutton").click(function (e) {
                                            e.preventDefault(e);
                                            // Get the record's ID via attribute  
                                            var iid = $(this).attr('data-id');
                                            $('#editMedicineForm').trigger("reset");
                                            $('#myModal2').modal('show');
                                            $.ajax({
                                                url: 'medicine/editMedicineByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editMedicineForm').find('[name="id"]').val(response.medicine.id).end()
                                                $('#editMedicineForm').find('[name="name"]').val(response.medicine.name).end()
                                                $('#editMedicineForm').find('[name="box"]').val(response.medicine.box).end()
                                                $('#editMedicineForm').find('[name="price"]').val(response.medicine.price).end()
                                                $('#editMedicineForm').find('[name="s_price"]').val(response.medicine.s_price).end()
                                                $('#editMedicineForm').find('[name="quantity"]').val(response.medicine.quantity).end()
                                                $('#editMedicineForm').find('[name="generic"]').val(response.medicine.generic).end()
                                                $('#editMedicineForm').find('[name="company"]').val(response.medicine.company).end()
                                                $('#editMedicineForm').find('[name="effects"]').val(response.medicine.effects).end()
                                                $('#editMedicineForm').find('[name="e_date"]').val(response.medicine.e_date).end()
                                            });
                                        });
                                    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".load").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#editMedicineForm').trigger("reset");
            $('#myModal3').modal('show');

            //  var id = $(this).data('id');

            // Populate the form fields with the data returned from server
            $('#editMedicineForm').find('[name="id"]').val(iid).end()
        });
    });
</script>
<script>
    $(document).ready(function () {
      var table =  $('#editable-sample').DataTable({
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
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
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
            },

        });

        table.buttons().container()
                .appendTo('.custom_buttons');
    });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

