<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('bed_categories'); ?>  
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
                                <th><?php echo lang('category'); ?></th>
                                <th><?php echo lang('description'); ?></th>
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

                        <?php foreach ($categories as $category) { ?>
                            <tr class="">
                                <td><?php echo $category->category; ?></td>
                                <td> <?php echo $category->description; ?></td>
                                <td class="no-print">
                                    <button type="button" title="<?php echo lang('edit'); ?>" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $category->id; ?>"><i class="fa fa-edit"></i> </button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="bed/deleteBedCategory/delete?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> </a>
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







<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_bed_category'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="bed/addCategory" class="clearfix row" method="post" enctype="multipart/form-data">
                   <div class="form-group col-md-12"> 
                        <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
                        <input type="text" class="form-control" name="category" id="exampleInputEmail1" value='' placeholder="">    
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
                <h4 class="modal-title"> <?php echo lang('edit_bed_category'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editBedCategoryForm" class="clearfix row" action="bed/addCategory" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12"> 
                        <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
                        <input type="text" class="form-control" name="category" id="exampleInputEmail1" value='' placeholder="">    
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
                                            $('#editBedCategoryForm').trigger("reset");
                                            $('#myModal2').modal('show');
                                            $.ajax({
                                                url: 'bed/editBedCategoryByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editBedCategoryForm').find('[name="id"]').val(response.bedcategory.id).end()
                                                $('#editBedCategoryForm').find('[name="category"]').val(response.bedcategory.category).end()
                                                $('#editBedCategoryForm').find('[name="description"]').val(response.bedcategory.description).end()
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
                        columns: [0, 1],
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
