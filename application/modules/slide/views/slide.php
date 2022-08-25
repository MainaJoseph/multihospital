
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('slide'); ?>
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_slide'); ?>
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
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('title'); ?></th>
                                <th><?php echo lang('text1'); ?></th>
                                <th><?php echo lang('text2'); ?></th>
                                <th><?php echo lang('text3'); ?></th>
                                <th><?php echo lang('position'); ?></th>
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

                        <?php foreach ($slides as $slide) { ?>
                            <tr class="">
                                <td style="width:10%;"><img style="width:95%;" src="<?php echo $slide->img_url; ?>"></td>
                                <td> <?php echo $slide->title; ?></td>
                                <td><?php echo $slide->text1; ?></td>
                                <td><?php echo $slide->text2; ?></td>
                                <td><?php echo $slide->text3; ?></td>
                                <td><?php echo $slide->position; ?></td>
                                <td>
                                    <?php
                                    if ($slide->status == 'Active') {
                                        echo lang('active');
                                    } else {
                                        echo lang('in_active');
                                    }
                                    ?>
                                </td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $slide->id; ?>"><i class="fa fa-edit"> </i></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="slide/delete?id=<?php echo $slide->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i></a>
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




<!-- Add Slide Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_slide'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="slide/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" value=''>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('text1'); ?></label>
                        <input type="text" class="form-control" name="text1" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('text2'); ?></label>
                        <input type="text" class="form-control" name="text2" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('text3'); ?></label>
                        <input type="text" class="form-control" name="text3" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('position'); ?></label>
                        <input type="text" class="form-control" name="position" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                        <select class="form-control m-bot15" name="status" value=''>
                            <option value="Active" <?php
                            if (!empty($setval)) {
                                if ($slide->status == set_value('status')) {
                                    echo 'selected';
                                }
                            }
                            if (!empty($slide->status)) {
                                if ($slide->status == 'Active') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('active'); ?> 
                            </option>
                            <option value="Inactive" <?php
                            if (!empty($setval)) {
                                if ($slide->status == set_value('status')) {
                                    echo 'selected';
                                }
                            }
                            if (!empty($slide->status)) {
                                if ($slide->status == 'Inactive') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('in_active'); ?> 
                            </option>
                        </select>
                    </div>
                    <div class="form-group last">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="id" value=''>


                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Slide Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_slide'); ?></h4>
            </div>

            <div class="modal-body">
                <form role="form" id="editSlideForm" class="clearfix" action="slide/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" value=''>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('text1'); ?></label>
                        <input type="text" class="form-control" name="text1" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('text2'); ?></label>
                        <input type="text" class="form-control" name="text2" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('text3'); ?></label>
                        <input type="text" class="form-control" name="text3" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('position'); ?></label>
                        <input type="text" class="form-control" name="position" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                        <select class="form-control m-bot15" name="status" value=''>
                            <option value="Active" <?php
                            if (!empty($setval)) {
                                if ($slide->status == set_value('status')) {
                                    echo 'selected';
                                }
                            }
                            if (!empty($slide->status)) {
                                if ($slide->status == 'Active') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('active'); ?> 
                            </option>
                            <option value="Inactive" <?php
                            if (!empty($setval)) {
                                if ($slide->status == set_value('status')) {
                                    echo 'selected';
                                }
                            }
                            if (!empty($slide->status)) {
                                if ($slide->status == 'Inactive') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('in_active'); ?> 
                            </option>
                        </select>
                    </div>
                    <div class="form-group last">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="form-group">
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
                                    $('#editSlideForm').trigger("reset");
                                    $("#img").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
                                    $.ajax({
                                    url: 'slide/editSlideByJason?id=' + iid,
                                            method: 'GET',
                                            data: '',
                                            dataType: 'json',
                                    }).success(function (response) {
                                    // Populate the form fields with the data returned from server
                                    $('#editSlideForm').find('[name="id"]').val(response.slide.id).end()
                                            $('#editSlideForm').find('[name="title"]').val(response.slide.title).end()
                                            $('#editSlideForm').find('[name="text1"]').val(response.slide.text1).end()
                                            $('#editSlideForm').find('[name="text2"]').val(response.slide.text2).end()
                                            $('#editSlideForm').find('[name="text3"]').val(response.slide.text3).end()
                                            $('#editSlideForm').find('[name="position"]').val(response.slide.position).end()
                                            $('#editSlideForm').find('[name="status"]').val(response.slide.status).end()

                                            if (typeof response.slide.img_url !== 'undefined' && response.slide.img_url != '') {
                                    $("#img").attr("src", response.slide.img_url);
                                    }

                                    $('#myModal2').modal('show');
                                    });
                                    });
                                    });</script>




<script>
    $(document).ready(function () {
    var = $('#editable-sample').DataTable({
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
                    columns: [1, 2, 3, 4],
                    }
            },
            ],
            aLengthMenu: [
            [10, 25, 50, 100, - 1],
            [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: - 1,
            "order": [[0, "desc"]],
            "language": {
            "lengthMenu": "_MENU_",
                    search: "_INPUT_",
                    "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json" 
            },
    });
    table.buttons().container()
            .appendTo('.custom_buttons');
    });</script>






<script>
    $(document).ready(function () {
    $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
