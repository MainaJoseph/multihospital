<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                 <?php echo lang('time_slots'); ?> (<?php echo $this->db->get_where('doctor', array('id' => $doctorr))->row()->name; ?>)
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
                <div class="adv-table editable-table">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> <?php echo lang('start_time'); ?></th>
                                <th> <?php echo lang('end_time'); ?></th>
                                <th> <?php echo lang('weekday'); ?></th>
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
                        foreach ($slots as $slot) {

                            if ($slot->weekday == 'Monday') {

                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td style="background:#345678; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                                
                         <?php
                        foreach ($slots as $slot) {

                            if ($slot->weekday == 'Tuesday') {

                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td style="background:#876543; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                                
                                <?php
                        foreach ($slots as $slot) {

                            if ($slot->weekday == 'Wednesday') {

                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td style="background:#345678; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                                
                                <?php
                        foreach ($slots as $slot) {

                            if ($slot->weekday == 'Thursday') {

                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td style="background:#654321; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                                
                                <?php
                        foreach ($slots as $slot) {

                            if ($slot->weekday == 'Friday') {

                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td style="background:#345678; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                                
                                <?php
                        foreach ($slots as $slot) {

                            if ($slot->weekday == 'Saturday') {

                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td style="background:#876543; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                                
                                
                                <?php
                        foreach ($slots as $slot) {

                            if ($slot->weekday == 'Sunday') {

                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td style="background:#345678; color: #fff;"> <?php echo $i; ?></td> 
                                    <td> <?php echo $slot->s_time; ?></td> 
                                    <td><?php echo $slot->e_time; ?></td>
                                    <td><?php echo $slot->weekday; ?></td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i> <?php echo lang('delete'); ?></a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
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




<!-- Add Time Slot Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php echo lang('add'); ?> <?php echo lang('time_slots'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="scedule/addTimeSlot" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="s_time" id="exampleInputEmail1" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>

                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="e_time" id="exampleInputEmail1" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <select class="form-control m-bot15" id="weekday" name="weekday" value=''> 
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>

                        </div>
                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Time Slot Modal-->





<!-- Edit Time Slot Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php echo lang('edit'); ?>  <?php echo lang('time_slot'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editTimeSlotForm" action="scedule/addTimeSlot" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="s_time" id="exampleInputEmail1" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>

                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="e_time" id="exampleInputEmail1" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <select class="form-control m-bot15" id="weekday" name="weekday" value=''> 
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>

                        </div>
                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Time Slot Modal-->



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
                                    $(document).ready(function () {
                                        $(".editbutton").click(function (e) {
                                            e.preventDefault(e);
                                            // Get the record's ID via attribute  
                                            var iid = $(this).attr('data-id');
                                            $('#editTimeSlotForm').trigger("reset");
                                            $('#myModal2').modal('show');
                                            $.ajax({
                                                url: 'schedule/editTimeSlotByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editTimeSlotForm').find('[name="id"]').val(response.slot.id).end()
                                                $('#editTimeSlotForm').find('[name="s_time"]').val(response.slot.s_time).end()
                                                $('#editTimeSlotForm').find('[name="e_time"]').val(response.slot.e_time).end()
                                                $('#editTimeSlotForm').find('[name="weekday"]').val(response.slot.weekday).end()
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
                        columns: [0,1,2,3,4,5,6],
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
