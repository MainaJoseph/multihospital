<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- invoice start-->
        <section>
            <div class="panel panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel-body col-md-6"style="font-size: 10px;">
                    <div class="row invoice-list">
                        <div class="text-center corporate-id">
                            <h1>
                                <?php echo $settings->title ?>
                            </h1>
                            <h4>
                                <?php echo $settings->address ?>
                            </h4>
                            <h4>
                                Tel: <?php echo $settings->phone ?>
                            </h4>
                        </div>
                       
                        
                            <div class="col-lg-4 col-sm-4">
                            <h4><?php echo lang('payment_to'); ?>:</h4>
                            <p>
                                <?php echo $settings->title; ?> <br>
                                <?php echo $settings->address; ?><br>
                                Tel:  <?php echo $settings->phone; ?>
                            </p>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <h4>BILL TO:</h4>
                            <p>
                                <?php
                                $patient_id = $ot_payment->patient;
                                $patient_info = $this->db->get_where('patient', array('id' => $patient_id))->row();
                                echo $patient_info->name . ' <br>';
                                echo $patient_info->address . '  <br/>';
                                P: echo $patient_info->phone
                                ?>
                            </p>
                        </div>

                        <div class="col-lg-4 col-sm-4">
                            <h4><?php echo lang('invoice_info'); ?></h4>
                            <ul class="unstyled">
                                <li>Invoice Status		: <strong style="color: maroon"><?php
                                        if (!empty($ot_payments)) {
                                            echo 'Unpaid';
                                        } else {
                                            echo 'No Due';
                                        }
                                        ?></strong> </li>
                            </ul>
                        </div>
                        
                        
                        
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('category'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--       
                            <?php if (!empty($ot_payment->c_s_f)) { ?>              
                                         <tr>
                                              <td>1</td>
                                              <td>Surgeon fee </td>
                                              <td class=""><?php echo $settings->currency; ?><?php echo $ot_payment->c_s_f; ?> </td>
                                         </tr> 
                            <?php } ?>
                            <?php if (!empty($ot_payment->a_s_f_1)) { ?>  
                                         <tr>
                                              <td>2</td>
                                              <td>Assistant Surgeon fee (1) </td>
                                              <td class=""><?php echo $settings->currency; ?><?php echo $ot_payment->a_s_f_1; ?> </td>
                                         </tr> 
                            <?php } ?>
                            <?php if (!empty($ot_payment->a_s_f_2)) { ?>  
                                         <tr>
                                              <td>2</td>
                                              <td>Assistant Surgeon fee (2) </td>
                                              <td class=""><?php echo $settings->currency; ?><?php echo $ot_payment->a_s_f_2; ?> </td>
                                         </tr> 
                            <?php } ?>
                            <?php if (!empty($ot_payment->anaes_f)) { ?> 
                                         <tr>
                                              <td>3</td>
                                              <td>Anaesthesist fee </td>
                                              <td class=""><?php echo $settings->currency; ?> <?php echo $ot_payment->anaes_f; ?></td>
                                         </tr> 
                            <?php } ?>
                             
                            -->

                            <?php
                            if (empty($ot_payment->c_s_f)) {
                                $ot_payment->c_s_f = 0;
                            }
                            if (empty($ot_payment->a_s_f_1)) {
                                $ot_payment->a_s_f_1 = 0;
                            }
                            if (empty($ot_payment->a_s_f_2)) {
                                $ot_payment->a_s_f_2 = 0;
                            }
                            if (empty($ot_payment->anaes_f)) {
                                $ot_payment->anaes_f = 0;
                            }
                            ?>
                            <tr>
                                <td>1</td>
                                <td>Surgeon fee </td>
                                <td class=""><?php echo $settings->currency; ?><?php echo $ot_payment->c_s_f + $ot_payment->a_s_f_1 + $ot_payment->a_s_f_2 + $ot_payment->anaes_f; ?> </td>
                            </tr> 
                            <?php if (!empty($ot_payment->ot_charge)) { ?> 
                                <tr>
                                    <td>4</td>
                                    <td>OT Charge </td>
                                    <td class=""><?php echo $settings->currency; ?><?php echo $ot_payment->ot_charge; ?> </td>
                                </tr> 
                            <?php } ?>
                            <?php if (!empty($ot_payment->cab_rent)) { ?> 
                                <tr>
                                    <td>5</td>
                                    <td>Cabin Rent </td>
                                    <td class=""><?php echo $settings->currency; ?><?php echo $ot_payment->cab_rent; ?> </td>
                                </tr> 
                            <?php } ?>
                            <?php if (!empty($ot_payment->seat_rent)) { ?> 
                                <tr>
                                    <td>6</td>
                                    <td>Seat rent </td>
                                    <td class=""><?php echo $settings->currency; ?> <?php echo $ot_payment->seat_rent; ?></td>
                                </tr> 
                            <?php } ?>
                            <?php if (!empty($ot_payment->others)) { ?>
                                <tr>
                                    <td>7</td>
                                    <td>Others</td>
                                    <td class=""><?php echo $settings->currency; ?> <?php echo $ot_payment->others; ?></td>
                                </tr> 
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-5 invoice-block pull-right">
                            <ul class="unstyled amounts">
                                <li><strong>Sub - Total amount : </strong><?php echo $settings->currency; ?> <?php echo $ot_payment->amount ?></li>
                                <?php if (!empty($ot_payment->discount)) { ?>
                                    <li><strong>Discount</strong> <?php
                                        if ($discount_type == 'percentage') {
                                            echo '(%) : ';
                                        } else {
                                            echo ': ' . $settings->currency;
                                        }
                                        ?> <?php
                                        $discount = explode('*', $ot_payment->discount);
                                        if (!empty($discount[1])) {
                                            echo $discount[0] . ' %  =  ' . $settings->currency . ' ' . $discount[1];
                                        } else {
                                            echo $discount[0];
                                        }
                                        ?></li>
                                <?php } ?>
                                <?php if (!empty($ot_payment->vat)) { ?>
                                    <li><strong>VAT :</strong>   <?php
                                        if (!empty($ot_payment->vat)) {
                                            echo $ot_payment->vat;
                                        } else {
                                            echo '0';
                                        }
                                        ?> % = <?php echo $settings->currency . ' ' . $ot_payment->flat_vat; ?></li>
                                <?php } ?>
                                <li><strong>Grand Total : </strong><?php echo $settings->currency; ?> <?php echo $ot_payment->gross_total ?></li>
                                 <li><strong>Amount Received : </strong><?php echo $settings->currency; ?> <?php echo $ot_payment->amount_received; ?></li>
                                  <li><strong>Amount To Be Paid : </strong><?php echo $settings->currency; ?> <?php echo $ot_payment->gross_total - $ot_payment->amount_received; ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-center invoice-btn">
                            <a href="finance/editOtPayment?id=<?php echo $ot_payment->id; ?>" class="btn btn-info btn-lg"><i class="fa fa-edit"></i> Edit Invoice </a>
                        <a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>
                    </div>
                </div>
                
                  <div class="panel-body col-md-6" style="font-size: 10px; float: right;">

                    <div class="panel-body">


                        <a href="finance/addOtPaymentView">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_another_ot_payment'); ?>
                                </button>
                            </div>
                        </a>
                    </div>

                </div>

                </div>
            </div>
        </section>
        <!-- invoice end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
