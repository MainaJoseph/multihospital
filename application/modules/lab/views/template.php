
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                 <?php echo lang('lab_report'); ?> <?php echo lang('template'); ?>
                <div class="col-md-8 no-print pull-right"> 
                    <a href="lab/addTemplateView">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_template'); ?>
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
                                <th><?php echo lang('name'); ?></th>
                                <th class="option_th no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($templates as $template) { ?>
                                <tr class="">
                                    <td> <?php echo $template->name; ?></td>
                                    <td class="no-print">
                                        <a href="lab/editTemplate?id=<?php echo $template->id;?>" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $template->id; ?>"><i class="fa fa-edit"> </i></a>   
                                        <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="lab/deleteTemplate?id=<?php echo $template->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i></a>
                                    </td>
                                </tr>
                            <?php } ?>

                        <style>

                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }
                            .option_th{
                                width:18%;
                            }

                        </style>

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



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
                                        $(document).ready(function () {
                                            $(".flashmessage").delay(3000).fadeOut(100);
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
                        columns: [0, 1, 2, 3],
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
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
