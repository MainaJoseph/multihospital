<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
               <i class="fa fa-money"></i>  <?php echo lang('ot_payments'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix no-print">
                        <a href="finance/addOtPaymentView">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                   <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export no-print" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>     
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('nature_of_operation'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('sub_total'); ?></th>
                                <th><?php echo lang('discount'); ?></th>
                                <th><?php echo lang('total'); ?></th>
                                <th><?php echo lang('hospital_fees'); ?></th>
                                <th><?php echo lang('doctor_fees'); ?></th>
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
                            .option_th{
                                width:18%;
                            }

                        </style>

                        <?php foreach ($ot_payments as $ot_payment) { ?>
                            <?php
                            if (!empty($ot_payment->patient)) {
                                $patient_info = $this->db->get_where('patient', array('id' => $ot_payment->patient))->row();
                            }
                            ?>
                            <tr class="">
                                <td><?php
                                    if ($ot_payment->patient !== 'None') {
                                        echo 'Name: ' . $patient_info->name . '</br>' . 'Patient ID: ' . $patient_info->patient_id . '</br>' . 'Address: ' . $patient_info->address . '</br>' . 'Phone: ' . $patient_info->phone;
                                    }
                                    ?></td>
                                <td><?php echo $ot_payment->n_o_o; ?></td>
                                <td><?php echo date('d/m/y', $ot_payment->date); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $ot_payment->amount; ?></td>              
                                <td><?php echo $settings->currency; ?> <?php
                                    if (!empty($ot_payment->flat_discount)) {
                                        echo $ot_payment->flat_discount;
                                    } else {
                                        echo '0';
                                    }
                                    ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $ot_payment->gross_total; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $ot_payment->hospital_fees; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $ot_payment->doctor_fees; ?></td>
                                <td class="no-print"> 
                                    <?php  if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                        
                                            <a class="btn btn-xs width_auto editbutton" href="finance/editOtPayment?id=<?php echo $ot_payment->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></a> <br>
                                        
                                        
                                    <?php } ?>
                                      <a class="btn btn-xs width_auto detailsbutton" href="finance/otPaymentDetails?id=<?php echo $ot_payment->id; ?>&patient=<?php echo $ot_payment->patient; ?>"><i class="fa fa-info-circle"></i> <?php echo lang('info'); ?> </a> <br>
                                        <a class="btn btn-xs width_auto invoicebutton" href="finance/otInvoice?id=<?php echo $ot_payment->id; ?>"><i class="fa fa-file-text"></i> Invoice</a> <br>
                                      
                                    <?php  if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                        
                                            <a class="btn btn-xs width_auto delete_button" href="finance/otPaymentDelete?id=<?php echo $ot_payment->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> <?php echo lang('delete'); ?></i></a> <br>
                                        
                                    <?php } ?>
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
