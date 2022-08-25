
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('my_appointments'); ?>
                <div class="col-md-4 pull-right">
                    <div class="pull-right custom_buttons"></div>
                </div>
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
                                <th> <?php echo lang('id'); ?></th>
                                <th> <?php echo lang('doctor'); ?></th>
                                <th> <?php echo lang('date-time'); ?></th>
                                <th> <?php echo lang('remarks'); ?></th>
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
                        foreach ($appointments as $appointment) {
                            if ($user_id == $appointment->patient) {
                                ?>

                                <tr class="">
                                    <td><?php echo $appointment->id; ?></td>
                                    <td> <?php echo $this->db->get_where('doctor', array('id' => $appointment->doctor))->row()->name; ?></td>
                                    <td> <?php echo date('d-m-Y', $appointment->date); ?> => <?php echo $appointment->time_slot; ?></td>
                                    <td><?php echo $appointment->remarks; ?></td>

                                </tr>
                                <?php
                            }
                        }
                        ?>


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



<script src="common/js/codearistos.min.js"></script>




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
                                        'print'
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
