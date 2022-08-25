

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- invoice start-->
        <section>
            <div class="panel panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->

                <header class="panel-heading no-print">
                      <?php echo lang('diagnostic_test_result'); ?> 
                </header>

                <div class="panel-body col-md-6 no-print">

                    <table class="table table-striped table-hover">

                        <thead>
                            <tr>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('value'); ?></th>
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


                        <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>

                        <tr class="">

                            <td><?php echo lang('invoice_id'); ?></td>
                            <td>
                                <?php
                                echo $payment->id;
                                ?>
                            </td>

                        </tr>

                        <tr class="">
                            <td><?php echo lang('date'); ?></td>
                            <td><?php echo date('d/m/y', $payment->date); ?></td>

                        </tr>


                        <tr class="">
                            <td><?php echo lang('patient_id'); ?></td>
                            <td>
                                <?php
                                if (!empty($patient_info)) {
                                    echo $patient_info->id;
                                }
                                ?>
                            </td>

                        </tr>

                        <tr class="">
                            <td><?php echo lang('patient'); ?></td>
                            <td>
                                <?php
                                if (!empty($patient_info)) {
                                    echo $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone;
                                }
                                ?>
                            </td>

                        </tr>


                        <tr class="">
                            <td><h4> <?php echo lang('diagnostic_test'); ?></h4></td>
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

                        </tr>



                        </tr>

                        </tbody>
                    </table>





                    <?php if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) { ?>
                        <div class="panel-body col-md-12 no-print">

                            <div class="panel-heading"><?php echo lang('add_update'); ?> <?php echo lang('diagnostic_result'); ?></div>

                            <form class="clearfix" action="patient/addDiagnosticReport" method="post">

                                <?php
                                $report_id = $this->patient_model->getDiagnosticReportByInvoiceId($payment->id);
                                ?>

                                <input type="hidden" name="patient" value="<?php
                                if (!empty($patient_info)) {
                                    echo $patient_info->id;
                                }
                                ?>">
                                <input type="hidden" name="invoice" value="<?php echo $payment->id; ?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"></label>

                                    <textarea class="ckeditor form-control" name="report" rows="100" cols=50> <?php
                                        if (!empty($report_id)) {
                                            echo $report_id->report;
                                        }
                                        ?> 
                                    </textarea>

                                </div>

                                <input type="hidden" name="id" value="<?php
                                if (!empty($report_id)) {
                                    echo $report_id->id;
                                }
                                ?>">


                                <section class="">
                                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                </section>

                            </form>

                        </div>
                    <?php } else { ?>
                        <div class="panel-body col-md-12">
                            <div class="panel-heading"> <?php echo lang('diagnostic_result'); ?></div>
                            <?php
                            $report_id = $this->patient_model->getDiagnosticReportByInvoiceId($payment->id);
                            if (!empty($report_id)) {
                                ?>
                                <div class="panel bio-graph-info"> <?php echo $report_id->report; ?> </div>
                                <?php
                            } else {
                                ?>
                                <div class="text-center corporate-id">
                                    <h1>
                                        <?php echo 'Not Ready!'; ?>
                                    </h1>

                                </div>
                                <?php
                            }
                            ?> 

                        </div>
                    <?php } ?>


                </div>


                <div class="panel col-md-5">
                    <div class="row invoice-list">

                        <div class="text-center corporate-id">
                            <h1>
                                <?php echo lang('diagnostic_report'); ?>
                            </h1>
                            <h2>
                                <?php echo $settings->title ?>
                            </h2>
                            <h4>
                                <?php echo $settings->address ?>
                            </h4>
                            <h4>
                                Tel: <?php echo $settings->phone ?>
                            </h4>
                        </div>








                    </div>




                    <table class="table table-striped table-hover">

                        <thead>

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


                        <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>

                        <tr class="">

                            <td><?php echo lang('invoice_id'); ?></td>
                            <td>
                                <?php
                                echo $payment->id;
                                ?>
                            </td>

                        </tr>

                        <tr class="">
                            <td><?php echo lang('date'); ?></td>
                            <td><?php echo date('d/m/y', $payment->date); ?></td>

                        </tr>


                        <tr class="">
                            <td><?php echo lang('patient_id'); ?></td>
                            <td>
                                <?php
                                if (!empty($patient_info)) {
                                    echo $patient_info->id;
                                }
                                ?>
                            </td>

                        </tr>

                        <tr class="">
                            <td><?php echo lang('patient'); ?></td>
                            <td>
                                <?php
                                if (!empty($patient_info)) {
                                    echo $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone;
                                }
                                ?>
                            </td>

                        </tr>


                        <tr class="">
                            <td><?php echo lang('diagnostic_test_result'); ?></td>
                            <td>
                                <?php
                                if (!empty($report_id)) {
                                    echo $report_id->report;
                                }
                                ?>

                            </td>

                        </tr>



                        </tr>

                        </tbody>
                    </table>


                    <div class="text-center invoice-btn">
                        <a class="btn btn-info btn-lg invoice_button" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>
                    </div>


                </div>










            </div>
        </section>
        <!-- invoice end-->
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

