<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($ot_payment->id)) {
                    echo '<i class="fa fa-edit"></i>'. lang('edit_ot_paayment');
                } else
                    echo '<i class="fa fa-plus-circle"></i>'. lang('add_new_ot_payment');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <form role="form" action="finance/addOtPayment" method="post" enctype="multipart/form-data">
                                        <div class="col-md-6">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                                            </div>
                                           <div class="col-md-9"> 
                                               <h4><?php echo $patient->name; ?></h4>
                                               <input type="hidden" name="patient" value="<?php echo $patient->id;?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1"><?php echo lang('consultant_surgeon'); ?></label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <select class="form-control m-bot15" name="doctor_c_s" value=''>  
                                                    <option value="None">Select</option>
                                                    <?php foreach ($doctors as $doctor) { ?>
                                                        <option value="<?php echo $doctor->id; ?>"<?php
                                                        if (!empty($ot_payment->doctor_c_s)) {
                                                            if ($ot_payment->doctor_c_s == $doctor->id) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo $doctor->name; ?> </option>
                                                            <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1"><?php echo lang('assistant_surgeon'); ?> (1) </label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <select class="form-control m-bot15" name="doctor_a_s_1" value=''>  
                                                    <option value="None">Select</option>
                                                    <?php foreach ($doctors as $doctor) { ?>
                                                        <option value="<?php echo $doctor->id; ?>"<?php
                                                        if (!empty($ot_payment->doctor_a_s_1)) {
                                                            if ($ot_payment->doctor_a_s_1 == $doctor->id) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo $doctor->name; ?> </option>
                                                            <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1"><?php echo lang('assistant_surgeon'); ?> (2) </label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <select class="form-control m-bot15" name="doctor_a_s_2" value=''>  
                                                    <option value="None">Select</option>
                                                    <?php foreach ($doctors as $doctor) { ?>
                                                        <option value="<?php echo $doctor->id; ?>"<?php
                                                        if (!empty($ot_payment->doctor_a_s_2)) {
                                                            if ($ot_payment->doctor_a_s_2 == $doctor->id) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo $doctor->name; ?> </option>
                                                            <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1"><?php echo lang('anaestheasist'); ?></label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <select class="form-control m-bot15" name="doctor_anaes" value=''>  
                                                    <option value="None">Select</option>
                                                    <?php foreach ($doctors as $doctor) { ?>
                                                        <option value="<?php echo $doctor->id; ?>"<?php
                                                        if (!empty($ot_payment->doctor_anaes)) {
                                                            if ($ot_payment->doctor_anaes == $doctor->id) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo $doctor->name; ?> </option>
                                                            <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1"><?php echo lang('nature_of_operation'); ?></label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" value="<?php
                                                if (!empty($ot_payment->n_o_o)) {
                                                    echo $ot_payment->n_o_o;
                                                }
                                                ?>" class="form-control pay_in" name="n_o_o" id="exampleInputEmail1"> 
                                            </div>  
                                        </div>


                                        <div class="row">
                                        </div>
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label">   
                                                <label class="payment_label"><strong><?php echo lang('payment_categories'); ?></strong></label>
                                            </div>
                                            <div class="col-md-3 payment_label">

                                                <label class="payment_label"><strong><?php echo lang('amount'); ?></strong></label>
                                            </div>        

                                        </div>
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label">   
                                                <label for="exampleInputEmail1"><?php echo lang('consultant_surgeon'); ?> <?php echo lang('fee'); ?></label> 
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="c_s_f" id="exampleInputEmail1" value="<?php
                                                if (!empty($ot_payment->c_s_f)) {
                                                    echo $ot_payment->c_s_f;
                                                }
                                                ?>" placeholder="<?php echo $settings->currency; ?>">                             
                                            </div>        
                                        </div>
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label">   
                                                <label for="exampleInputEmail1"><?php echo lang('assistant_surgeon'); ?> <?php echo lang('fee'); ?> (1)</label> 
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="a_s_f_1" id="exampleInputEmail1" value="<?php
                                                if (!empty($ot_payment->a_s_f_1)) {
                                                    echo $ot_payment->a_s_f_1;
                                                }
                                                ?>" placeholder="<?php echo $settings->currency; ?>">                                
                                            </div>        
                                        </div>
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label">   
                                                <label for="exampleInputEmail1"><?php echo lang('assistant_surgeon'); ?> <?php echo lang('fee'); ?> (2)</label> 
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="a_s_f_2" id="exampleInputEmail1" value="<?php
                                                if (!empty($ot_payment->a_s_f_2)) {
                                                    echo $ot_payment->a_s_f_2;
                                                }
                                                ?>" placeholder="<?php echo $settings->currency; ?>">                                
                                            </div>        
                                        </div>
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label">   
                                                <label for="exampleInputEmail1"><?php echo lang('anaestheasist'); ?> <?php echo lang('fee'); ?></label> 
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="anaes_f" id="exampleInputEmail1" value="<?php
                                                if (!empty($ot_payment->anaes_f)) {
                                                    echo $ot_payment->anaes_f;
                                                }
                                                ?>" placeholder="<?php echo $settings->currency; ?>">    
                                            </div>        
                                        </div>
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label">   
                                                <label for="exampleInputEmail1">OT Charge</label> 
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="ot_charge" id="exampleInputEmail1" value="<?php
                                                if (!empty($ot_payment->ot_charge)) {
                                                    echo $ot_payment->ot_charge;
                                                }
                                                ?>" placeholder="<?php echo $settings->currency; ?>">    
                                            </div>        
                                        </div>
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label">   
                                                <label for="exampleInputEmail1"><?php echo lang('cabin_rent'); ?></label> 
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="cab_rent" id="exampleInputEmail1" value="<?php
                                                if (!empty($ot_payment->cab_rent)) {
                                                    echo $ot_payment->cab_rent;
                                                }
                                                ?>" placeholder="<?php echo $settings->currency; ?>">      
                                            </div>        
                                        </div>
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label">   
                                                <label for="exampleInputEmail1">Seat Rent</label> 
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="seat_rent" id="exampleInputEmail1" value="<?php
                                                if (!empty($ot_payment->seat_rent)) {
                                                    echo $ot_payment->seat_rent;
                                                }
                                                ?>" placeholder="<?php echo $settings->currency; ?>"> 
                                            </div>        
                                        </div>
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label">   
                                                <label for="exampleInputEmail1"><?php echo lang('others'); ?></label> 
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="others" id="exampleInputEmail1" value="<?php
                                                if (!empty($ot_payment->others)) {
                                                    echo $ot_payment->others;
                                                }
                                                ?>" placeholder="<?php echo $settings->currency; ?>"> 
                                            </div>        
                                        </div>
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1">Discount  <?php
                                                    if ($discount_type == 'percentage') {
                                                        echo ' (%)';
                                                    }
                                                    ?> </label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="discount" id="exampleInputEmail1" value='<?php
                                                if (!empty($ot_payment->discount)) {
                                                    $discount = explode('*', $ot_payment->discount);
                                                    echo $discount[0];
                                                }
                                                ?>' placeholder="Discount">
                                            </div>
                                        </div>
                                        <!--
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label"> 
                                              <label for="exampleInputEmail1">Vat (%)</label>
                                            </div>
                                            <div class="col-md-9"> 
                                              <input type="text" class="form-control pay_in" name="vat" id="exampleInputEmail1" value='<?php
                                        if (!empty($payment->vat)) {
                                            echo $payment->vat;
                                        }
                                        ?>' placeholder="%">
                                            </div>
                                        </div>
                                        -->

                                        
                                        <div class="row">
                                        </div>

                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label">   
                                                <label for="exampleInputEmail1"><?php echo lang('amount_received'); ?></label> 
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="amount_received" id="exampleInputEmail1" value="<?php
                                                if (!empty($ot_payment->amount_received)) {
                                                    echo $ot_payment->amount_received;
                                                }
                                                ?>" placeholder="<?php echo $settings->currency; ?>"> 
                                            </div>        
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="col-md-3"> 
                                                </div>  
                                                <div class="col-md-6"> 
                                                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                                </div>
                                                <div class="col-md-3"> 
                                                </div> 
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($ot_payment->id)) {
                                            echo $ot_payment->id;
                                        }
                                        ?>'>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
