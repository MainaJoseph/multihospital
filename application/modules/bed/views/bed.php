<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('bed'); ?>  
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('bed_id'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('status'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
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

                        <?php foreach ($beds as $bed) { ?>

                            <?php
                            $last_a_time = explode('-', $bed->last_a_time);
                            $last_d_time = explode('-', $bed->last_d_time);
                            if (!empty($last_d_time[1])) {
                                $last_d_h_am_pm = explode(' ', $last_d_time[1]);
                                $last_d_h = explode(':', $last_d_h_am_pm[1]);
                                if ($last_d_h_am_pm[2] == 'AM') {
                                    $last_d_m = ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                                } else {
                                    $last_d_m = (12 * 60 * 60) + ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                                }
                                $last_d_time = strtotime($last_d_time[0]) + $last_d_m;
                            }
                            ?>
                            <tr class="">
                                <td><?php echo $bed->bed_id; ?></td>
                                <td><?php echo $bed->description; ?></td> 
                                <td><?php
                                    if (!empty($bed->last_a_time)) {
                                        if (empty($bed->last_d_time)) {
                                            echo '<button type="button" class="btn btn-primary">' . lang('alloted') . '</button>';
                                        } elseif ((time() > $last_d_time)) {
                                            echo '<button type="button" class="btn btn-success">' . lang('available') . '</button>';
                                        } elseif ((time() < $last_d_time)) {
                                            echo '<button type="button" class="btn btn-primary">' . lang('alloted') . '</button>';
                                        }
                                    } else {
                                        echo '<button type="button" class="btn btn-success">' . lang('available') . '</button>';
                                    }
                                    ?>
                                </td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $bed->id; ?>"><i class="fa fa-edit"> </i></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="bed/delete?id=<?php echo $bed->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i></a>
                                </td>
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







<!-- Add Bed Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_new_bed'); ?> </h4>
            </div>
            <div class="modal-body">
                <form role="form" action="bed/addBed" class="clearfix row" method="post" enctype="multipart/form-data">
                   <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('bed_category'); ?></label>
                        <select class="form-control" name="category" value=''>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->category; ?>" <?php
                                if (!empty($bed->category)) {
                                    if ($category->category == $bed->category) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $category->category; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('bed_number'); ?></label>
                        <input type="text" class="form-control" name="number" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                   <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                        <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="">
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
                <h4 class="modal-title"> <?php echo lang('edit_bed'); ?> </h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editBedForm" class="clearfix row" action="bed/addBed" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('bed_category'); ?></label>
                        <select class="form-control" name="category" value=''>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->category; ?>" <?php
                                if (!empty($bed->category)) {
                                    if ($category->category == $bed->category) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $category->category; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('bed_number'); ?></label>
                        <input type="text" class="form-control" name="number" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                   <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                        <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="">
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
                                            $('#editBedForm').trigger("reset");
                                            $('#myModal2').modal('show');
                                            $.ajax({
                                                url: 'bed/editBedByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editBedForm').find('[name="id"]').val(response.bed.id).end()
                                                $('#editBedForm').find('[name="category"]').val(response.bed.category).end()
                                                $('#editBedForm').find('[name="number"]').val(response.bed.number).end()
                                                $('#editBedForm').find('[name="description"]').val(response.bed.description).end()
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
                        columns: [0, 1, 2],
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

