
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                 <?php echo lang('diagnostic'); ?> <?php echo lang('report'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('invoice_id'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('patient_id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('diagnostic_test'); ?></th>
                                <th class="option_th no-print"><?php echo lang('options'); ?></th>
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
                            .option_th{
                                width:18%;
                            }

                        </style>


                        <?php foreach ($payments as $payment) { ?>
                            <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>

                            <tr class="">


                                <td>
                                    <?php
                                    echo $payment->id;
                                    ?>
                                </td>

                                <td><?php echo date('d/m/y', $payment->date); ?></td>

                                <td>
                                    <?php
                                    if (!empty($patient_info)) {
                                        echo $patient_info->id;
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    if (!empty($patient_info)) {
                                        echo $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone;
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    if (!empty($payment->category_name)) {
                                        $category_name = $payment->category_name;
                                        $category_name1 = explode(',', $category_name);
                                        foreach ($category_name1 as $category_name2) {
                                            $category_name3 = explode('*', $category_name2);
                                            if ($category_name3[1] > 0) {
                                                if ($category_name3[2] == 'diagnostic') {
                                                    ?>                

                                                    <div><?php echo $category_name3[0]; ?> </div><br>

                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>

                                </td>


                                <td class="no-print"> 
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist', 'Nurse', 'Patient'))) { ?>
                                        <a class="btn btn-info btn-xs editbutton" title="<?php echo lang('edit'); ?>" href="patient/report?id=<?php echo $payment->id; ?>"><i class="fa fa-eye"> <?php echo lang('details'); ?> </i></a>
                                    <?php } ?>
                                    </button>
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



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="common/js/codearistos.min.js"></script>
<script>
    $(document).ready(function () {
        $('#editable-sample').DataTable({
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
                        columns: [0,1,2,3,4],
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
                "lengthMenu": "_MENU_ records per page",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json" 
            }


        });
    });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
