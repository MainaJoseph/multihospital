<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('sent_messages'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix"> 
                        <button class="export" onclick="javascript:window.print();">Print</button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('message'); ?></th>
                                <th><?php echo lang('recipient'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($sents as $sent) {
                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td><?php echo $i; ?></td>
                                    <td style='width: 25%;'><?php echo date('h:i:s a m/d/y', $sent->date); ?></td>
                                    <td><?php
                                        if (!empty($sent->message)) {
                                            echo $sent->message;
                                        }
                                        ?></td>
                                    <td><?php
                                        if (!empty($sent->recipient)) {
                                            echo $sent->recipient;
                                        }
                                        ?></td>
                                    <td>
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="sms/delete?id=<?php echo $sent->id; ?>" <?php echo lang('delete'); ?> onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i></a>
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

<!-- Add Area Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Area</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="area/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="description" value="<?php
                            if (!empty($area->description)) {
                                echo $area->description;
                            }
                            ?>" rows="10"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Area Modal-->

<!-- Edit Area Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Area</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="areaEditForm" action="area/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#myModal2').modal('show');
                                                $.ajax({
                                                    url: 'area/editAreaByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#areaEditForm').find('[name="id"]').val(response.area.id).end()
                                                    $('#areaEditForm').find('[name="name"]').val(response.area.name).end()
                                                    CKEDITOR.instances['editor'].setData(response.area.description)
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
                        columns: [0,1,2,3],
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
