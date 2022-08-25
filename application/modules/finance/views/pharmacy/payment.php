<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">
            <header class="panel-heading">
                <?php echo lang('pharmacy'); ?> <?php echo lang('all_sales'); ?> 
                <div class="col-md-4 no-print pull-right"> 
                    <a href="finance/pharmacy/addPaymentView">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_sale'); ?>
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
                }

            </style>


            <div class="panel-body">
                <div class="adv-table editable-table">
                    <div class="space15">
                        <?php if (!empty($key)) { ?>
                            <p>Search Result For <?php echo $key; ?></p>
                        <?php } ?>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('invoice_id'); ?> </th>
                                <th> <?php echo lang('date'); ?> </th>
                                <th> <?php echo lang('sub_total'); ?> </th>
                                <th> <?php echo lang('discount'); ?> </th>
                                <th> <?php echo lang('grand_total'); ?> </th>
                                <!--
                                <th> <?php echo lang('amount_received'); ?> </th>
                                <th> <?php echo lang('due_amount'); ?> </th>
                                -->
                                <th class="option_th"> <?php echo lang('options'); ?> </th>
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
                                <td><?php
                                    echo $payment->id;
                                    ?>
                                </td>
                                <td><?php echo date('d/m/y', $payment->date + 11 * 60 * 60); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo number_format($payment->amount, 2, '.', ','); ?></td>              
                                <td><?php echo $settings->currency; ?> <?php
                                    if (!empty($payment->flat_discount)) {
                                        echo number_format($payment->flat_discount, 2, '.', ',');
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $settings->currency; ?> <?php echo number_format($payment->gross_total, 2, '.', ','); ?></td>
                                <!--
                                <td>
                                <?php
                                echo number_format($payment->amount_received, 2, '.', ',');
                                ?>
                                </td>
                                <td>
                                <?php echo $settings->currency; ?> <?php
                                $due_amount = $payment->gross_total - $payment->amount_received;
                                echo number_format($due_amount, 2, '.', ',');
                                ?>
                                </td>
                                -->
                                <td> 
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
                                        <a class="btn btn-info btn-xs editbutton" href="finance/pharmacy/editPayment?id=<?php echo $payment->id; ?>"><i class="fa fa-edit"> </i> <?php echo lang('edit'); ?></a>
                                    <?php } ?>

                                    <a class="btn btn-xs invoicebutton" style="color: #fff;" href="finance/pharmacy/invoice?id=<?php echo $payment->id; ?>"><i class="fa fa-file-text"></i>  <?php echo lang('invoice'); ?></a>
                                    <?php if ($this->ion_auth->in_group('admin')) { ?> 
                                        <a class="btn btn-info btn-xs delete_button" href="finance/pharmacy/delete?id=<?php echo $payment->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i>  <?php echo lang('delete'); ?></a>
                                    <?php } ?>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>


                    <!--

                    <?php if (empty($key)) { ?>

                                        <div class="row">
                                            <div class="col-lg-6"><div class="dataTables_paginate paging_bootstrap pagination"><ul>
                                                        <li class="next disabled"><a href="finance/pharmacy/paymentByPageNumber?page_number=<?php
                        if (($pagee_number > 1)) {
                            echo $pagee_number - 1;
                        }
                        ?>"><-- Prev</a>
                                                        </li>

                        <?php
                        if ($pagee_number < 5) {
                            for ($pagee = 1; $pagee < 6; $pagee++) {
                                ?>
                                                                                                <li class="active"><a href="finance/pharmacy/paymentByPageNumber?page_number=<?php echo $pagee; ?>"><?php echo $pagee; ?></a></li>
                                <?php
                            }
                        }

                        if ($pagee_number >= 5) {
                            for ($x = 3; $x > 0; $x--) {
                                ?>
                                                                                                <li class="active"><a href="finance/pharmacy/paymentByPageNumber?page_number=<?php echo $pagee_number - $x; ?>"><?php echo $pagee_number - $x; ?></a></li>
                                <?php
                            }
                            for ($x = 0; $x < 4; $x++) {
                                ?>
                                                                                                <li class="active"><a href="finance/pharmacy/paymentByPageNumber?page_number=<?php echo $pagee_number + $x; ?>"><?php echo $pagee_number + $x; ?></a></li>
                                <?php
                            }
                        }
                        ?>
                                                        <li class="next disabled"><a href="finance/pharmacy/paymentByPageNumber?page_number=<?php
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
                                                        <li class="next disabled"><a href="finance/pharmacy/searchPayment?key=<?php echo $key; ?>&page_number=<?php
                        if (($pagee_number > 1)) {
                            echo $pagee_number - 1;
                        }
                        ?>"><-- Prev</a>
                                                        </li>

                        <?php
                        if ($pagee_number < 5) {
                            for ($pagee = 1; $pagee < 6; $pagee++) {
                                ?>
                                                                                                <li class="active"><a href="finance/pharmacy/searchPayment?key=<?php echo $key; ?>&page_number=<?php echo $pagee; ?>"><?php echo $pagee; ?></a></li>
                                <?php
                            }
                        }

                        if ($pagee_number >= 5) {
                            for ($x = 3; $x > 0; $x--) {
                                ?>
                                                                                                <li class="active"><a href="finance/pharmacy/searchPayment?key=<?php echo $key; ?>&page_number=<?php echo $pagee_number - $x; ?>"><?php echo $pagee_number - $x; ?></a></li>
                                <?php
                            }
                            for ($x = 0; $x < 4; $x++) {
                                ?>
                                                                                                <li class="active"><a href="finance/pharmacy/searchPayment?key=<?php echo $key; ?>&page_number=<?php echo $pagee_number + $x; ?>"><?php echo $pagee_number + $x; ?></a></li>
                                <?php
                            }
                        }
                        ?>
                                                        <li class="next disabled"><a href="finance/pharmacy/searchPayment?key=<?php echo $key; ?>&page_number=<?php
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
                                                        columns: [0, 1, 2, 3, 4],
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