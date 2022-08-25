
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- invoice start-->
        <section>
            <div class="panel panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel-body col-md-6">
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
                            <h4>PAYMENT TO:</h4>
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
                                $patient_info = $this->db->get_where('patient', array('id' => $patient_id))->row();
                                echo $patient_info->name . ' <br>';
                                echo $patient_info->address . '  <br/>';
                                P: echo $patient_info->phone
                                ?>
                            </p>
                        </div>

                        <div class="col-lg-4 col-sm-4">
                            <h4>INVOICE INFO</h4>
                            <ul class="unstyled">
                                <li>Invoice Status		: <strong style="color: maroon"><?php
                                        if (!empty($payments)) {
                                            echo 'Unpaid';
                                        } else {
                                            echo 'No Due';
                                        }
                                        ?></strong> </li>
                            </ul>
                        </div>

                    </div>
                    
                    
                    
                    
                    <?php 
                    
                    $gross_total = array();
                    
                    
                    if(!empty($payments)){?>
                    
                    <header class="h4">General Invoice</header>
                    <table class="table table-striped table-hover">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            foreach ($payments as $payment) {
                                $gross_total[] = $payment->gross_total;
                                $amount[] = $payment->amount;
                                $flat_vat[] = $payment->flat_vat;
                                $discount[] = $payment->flat_discount;
                            }
                            ?>

                            


                            <?php
                            foreach ($payments as $payment) {
                                if (!empty($payment->category_name)) {
                                    $category_name = $payment->category_name;
                                    $category_name1 = explode(',', $category_name);
                                    $i = 0;
                                    foreach ($category_name1 as $category_name2) {
                                        $category_name3 = explode('*', $category_name2);
                                        if ($category_name3[1] > 0) {
                                            ?>                
                                            <tr>
                                                <td><?php echo $i = $i + 1; ?></td>
                                                <td><?php echo $category_name3[0]; ?> </td>
                                                <td><?php echo date('m/d/y', $payment->date); ?> </td>
                                                <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1]; ?> </td>
                                            </tr> 
                                            <?php
                                        }
                                    }
                                }
                            }
                            ?>

                        </tbody>

                    </table>


                    <div class="row">
                        <div class="col-lg-4 invoice-block pull-right">
                            <ul class="unstyled amounts">
                                <li><strong>Sub - Total amount : </strong><?php echo $settings->currency; ?> <?php
                                    if (!empty($amount)) {
                                        echo array_sum($amount);
                                    }
                                    ?></li>
                                <?php if (!empty($discount)) { ?>
                                    <li><strong>Discount</strong> <?php ?> <?php echo array_sum($discount); ?> </li>
                                <?php } ?>
                                <?php if (!empty($flat_vat)) { ?>
                                    <li><strong>VAT :</strong>   <?php ?> % = <?php echo $settings->currency . ' ' . array_sum($flat_vat); ?></li>
                                <?php } ?>
                                <li style="background: greenyellow"><strong>Total : </strong><?php echo $settings->currency; ?> <?php
                                    if (!empty($gross_total)) {
                                        echo array_sum($gross_total);
                                    }
                                    ?></li>
                            </ul>
                        </div>
                    </div>
                    
                    
                    
                    
                    <?php } ?>
                    
                    
                    
                    <?php
                    
                    $ot_gross_total = array();
                    
                    if(!empty($ot_payments)){?>
                    
                     
                    <header class="h4">OT Invoice</header>
                    
                    
                    <?php
                    
                            foreach ($ot_payments as $ot_payment) {
                                $ot_gross_total[] = $ot_payment->gross_total;
                                $ot_amount[] = $ot_payment->amount;
                             //   $ot_flat_vat[] = $ot_payment->flat_vat;
                                $ot_discount[] = $ot_payment->flat_discount;
                            }
                            ?>
                    
                    
                    
                    
                       <table class="table table-striped table-hover">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $i = 0;
                            foreach ($ot_payments as $ot_payment) {
                                if ($ot_payment->patient == $patient_id) {
                                    ?>
                                    }
                                    <tr>
                                        <td><?php echo $i = $i + 1; ?></td>
                                        <td><?php echo date('m/d/y', $ot_payment->date); ?> </td>
                                        <td class=""><?php echo $settings->currency; ?> <?php echo $ot_payment->gross_total; ?> </td>
                                    </tr> 
                                    <?php
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                    
                     <div class="row">
                        <div class="col-lg-4 invoice-block pull-right">
                            <ul class="unstyled amounts">
                                <li><strong>Sub - Total amount : </strong><?php echo $settings->currency; ?> <?php
                                    if (!empty($ot_amount)) {
                                        echo array_sum($ot_amount);
                                    }
                                    ?></li>
                                <?php if (!empty($ot_discount)) { ?>
                                    <li><strong>Discount</strong> <?php ?> <?php echo array_sum($ot_discount); ?> </li>
                                <?php } ?>
                                <?php if (!empty($ot_flat_vat)) { ?>
                                    <li><strong>VAT :</strong>   <?php ?> % = <?php echo $settings->currency . ' ' . array_sum($ot_flat_vat); ?></li>
                                <?php } ?>
                                <li style="background: greenyellow"><strong>Total : </strong><?php echo $settings->currency; ?> <?php
                                    if (!empty($ot_gross_total)) {
                                        echo array_sum($ot_gross_total);
                                    }
                                    ?></li>
                            </ul>
                        </div>
                    </div>
                    
                    <?php } ?>
                    
                      <div class="row">
                        <div class="col-lg-4 invoice-block pull-right">
                            <ul class="unstyled amounts">         
                                <li style="background: yellow;"><strong>Total Amount To Be Paid : </strong><?php echo $settings->currency; ?> <?php
                                    if (!empty($ot_gross_total) || !empty($gross_total) ) {
                                        echo array_sum($ot_gross_total) + array_sum($gross_total);
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    

                    <div class="text-center invoice-btn">
                        <?php if (!empty($payments) || !empty($ot_payments)) { ?>
                            <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                <a href="finance/makePaidByPatientIdByStatus?id=<?php echo $patient_id; ?>" class="btn btn-info btn-lg invoice_button">Make Paid</a>
                                <?php
                            }
                        }
                        ?>
                        <a class="btn btn-info btn-lg invoice_button" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>
                    </div>
                    <h1>
                        <a href="finance/lastPaidInvoice?id=<?php echo $patient_id; ?>" class="btn btn-info btn-lg invoice_button">Last Paid Invoice</a>
                    </h1>

                </div>
                
                  <div class="panel-body col-md-6" style="font-size: 10px; float: right;">

                    <form role="form" action="finance/amountReceived" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label for="exampleInputEmail1"></label>
                            Amount To Be Paid: <?php echo $settings->currency; ?>  <?php echo $payment->gross_total - $payment->amount_received + $ot_payment->gross_total - $ot_payment->amount_received; ?> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Amount Received</label>
                            <input type="text" class="form-control" name="amount_received" id="exampleInputEmail1" value='<?php
                            if (!empty($category->description)) {
                                echo $category->description;
                            }
                            ?>' placeholder="<?php echo $settings->currency; ?> ">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $payment->id; ?>">

                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                    </form>

                </div>
            </div>
        </section>
        <!-- invoice end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
