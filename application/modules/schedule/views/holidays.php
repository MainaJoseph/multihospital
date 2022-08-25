<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('holiday'); ?> (<?php echo $this->db->get_where('doctor', array('id' => $doctorr))->row()->name; ?>)
                <div class="col-md-4 clearfix pull-right">
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i>  <?php echo lang('add_new'); ?> 
                            </button>
                        </div>
                    </a>  
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> <?php echo lang('date'); ?></th>
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

                        </style>
                        <?php
                        $i = 0;
                        foreach ($holidays as $holiday) {
                            $i = $i + 1;
                            ?> 
                            <tr class="">
                                <td> <?php echo $i; ?></td>
                                <td> <?php echo date('d-m-Y', $holiday->date); ?></td> 
                                <td>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $holiday->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteHoliday?id=<?php echo $holiday->id; ?>&doctor=<?php echo $doctorr; ?>&redirect=schedule/holidays?doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i> <?php echo lang('delete'); ?></a>
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




<!-- Add Holiday Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('add'); ?> <?php echo lang('holiday'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="schedule/addHoliday" class='clearfix' method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='' readonly="">
                        </div>

                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                    <input type="hidden" name="redirect" value='schedule/holidays'>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Holiday Modal-->





<!-- Edit Holiday Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit'); ?>  <?php echo lang('holiday'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editHolidayForm" action="schedule/addHoliday" class='clearfix' method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='' readonly="">
                        </div>

                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                    <input type="hidden" name="redirect" value='schedule/holidays'>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Holiday Modal-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#editHolidayForm').trigger("reset");
                                                $('#myModal2').modal('show');
                                                $.ajax({
                                                    url: 'schedule/editHolidayByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    var date = new Date(response.holiday.date * 1000);
                                                    $('#editHolidayForm').find('[name="id"]').val(response.holiday.id).end()
                                                    $('#editHolidayForm').find('[name="date"]').val(date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear()).end()
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
