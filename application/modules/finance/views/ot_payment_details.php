<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <!-- page start-->
            <div class="row">
                <aside class="profile-nav col-lg-3">
                    <section class="panel">
                        <div class="user-heading round">
                           <h1><strong><?php echo lang('patient'); ?></strong></h1>
                            
                            <h1><?php echo $patient->name . '<br/> ' . $patient->address . ' <br/>' . $patient->phone; ?></h1> 
                        </div>
                    </section> 
                </aside>
                <aside class="profile-info col-lg-9">
                    <section class="panel">
                        <div class="bio-graph-heading">
                           <?php echo lang('nature_of_operation'); ?> : <?php echo $ot_payment->n_o_o; ?><br/>
                            <?php echo lang('date'); ?>                : <?php echo date('d/m/20y', $ot_payment->date); ?>
                        </div>
                        <div class="panel-body bio-graph-info">
                            <h1><?php echo lang('operation_payment_history'); ?></h1>
                            <div class="row">
                                <div class="bio-row">
                                    <p><span>Consultant Surgeon </span>: <?php
                                        if (!empty($ot_payment->c_s_f)) {
                                            echo $this->db->get_where('doctor', array('id' => $ot_payment->doctor_c_s))->row()->name . '--> ' . $ot_payment->c_s_f . ' ' . $settings->currency;
                                        }
                                        ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Assistant Surgeon (1) </span>: <?php
                                        if (!empty($ot_payment->a_s_f_1)) {
                                            echo $this->db->get_where('doctor', array('id' => $ot_payment->doctor_a_s_1))->row()->name . '--> ' . $ot_payment->a_s_f_1 . ' ' . $settings->currency;
                                        }
                                        ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Assistant Surgeon (2)</span>: <?php
                                        if (!empty($ot_payment->a_s_f_2)) {
                                            echo $this->db->get_where('doctor', array('id' => $ot_payment->doctor_a_s_2))->row()->name . '--> ' . $ot_payment->a_s_f_2 . ' ' . $settings->currency;
                                        }
                                        ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Anaesthesist </span>: <?php
                                        if (!empty($ot_payment->anaes_f)) {
                                            echo $this->db->get_where('doctor', array('id' => $ot_payment->doctor_anaes))->row()->name . '--> ' . $ot_payment->anaes_f . ' ' . $settings->currency;
                                        }
                                        ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span>OT Charge </span>: <?php echo $ot_payment->ot_charge . ' ' . $settings->currency; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Cabin Rent </span>: <?php echo $ot_payment->cab_rent . ' ' . $settings->currency; ?> </p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Seat Rent </span>: <?php echo $ot_payment->seat_rent . ' ' . $settings->currency; ?> </p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Others </span>: <?php echo $ot_payment->others . ' ' . $settings->currency; ?> </p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Discount</span>: <?php echo $ot_payment->flat_discount . ' ' . $settings->currency; ?> </p>
                                </div>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
