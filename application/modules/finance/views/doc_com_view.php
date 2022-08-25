
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                  <?php echo lang('payments'); ?> || <?php echo lang('doctor'); ?> : <?php echo $this->doctor_model->getDoctorById($doctor)->name; ?>
            </header>
            <div class="col-md-12">
                <div class=" panel-body col-md-7">
                    <section>
                        <form role="form" class="panel-body" action="finance/docComDetails" method="post" enctype="multipart/form-data">
                            <div class="form-group">

                                <!--     <label class="control-label col-md-3">Date Range</label> -->
                                <div class="col-md-6">
                                    <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                        if (!empty($from)) {
                                            echo $from;
                                        }
                                        ?>" placeholder="<?php echo lang('date_from'); ?>">
                                        <span class="input-group-addon">To</span>
                                        <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                        if (!empty($to)) {
                                            echo $to;
                                        }
                                        ?>" placeholder="<?php echo lang('date_to'); ?>">
                                        <input type="hidden" class="form-control dpd2" name="doctor" value="<?php
                                        if (!empty($doctor)) {
                                            echo $doctor;
                                        }
                                        ?>">
                                    </div>
                                    <div class="row"></div>
                                    <span class="help-block"></span> 
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <div class="col-md-5 panel-body">
                    <button class="btn btn-info green no-print pull-right" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>
                </div>
            </div>
            
            
            <style>
                
                
                #editable-sample_length{
                    display: none;
                }
                
                #editable-sample_info{
                    display: none;
                }
                
                .pagination{
                    display: none;
                }
                
                
            </style>
            
            
            <div class="panel-body col-md-7">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('invoice_id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>   
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('total'); ?></th>
                                <th><?php echo lang('doctors_commission'); ?></th>
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

                                <td>
                                    <?php
                                    if (!empty($patient_info)) {
                                        echo $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone;
                                    }
                                    ?>
                                </td>


                                <td><?php echo date('d/m/y', $payment->date); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></td>
                                <td><?php echo $settings->currency; ?> <?php
                                    if (!empty($payment->doctor)) {
                                        $doc_com[] = $payment->doctor_amount;
                                        echo $payment->doctor_amount;
                                    }
                                    ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <section class="panel-body col-md-4 pull-right">
                <div class="weather-bg">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-money"></i>
                                <?php echo lang('total_doctors_commission'); ?>
                            </div>
                            <div class="col-xs-8">
                                <div class="degree">
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($doc_com)) {
                                        $total_doc_com = array_sum($doc_com);
                                    } else {
                                        $total_doc_com = 0;
                                    }

                                    echo $total_doc_com;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
