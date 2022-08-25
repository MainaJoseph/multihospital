<!--sidebar end-->
<!--main content start-->
<section id="main-content"> 
    
    
    <section class="wrapper site-min-height">
        
        
        <style>
            
            .panel-heading{
                margin-bottom: 20px;
            }
            
            
            
            
            
        </style>
        
        
        
        <!--state overview start-->
        <div class="col-md-12">
            <header class="panel-heading">
                 <i class="fa fa-home"></i>  <?php echo lang('pharmacy'); ?> <?php echo lang('dashboard'); ?>
            </header>
            <div class="row state-overview">
                <div class="col-lg-3 col-sm-6">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a href="finance/pharmacy/todaySales">
                        <?php } ?>
                        <section class="panel panel-moree">
                            <div class="symbol terques">
                                <i class="fa fa-plus"></i>
                            </div>
                            <div class="value">
                                <p> <?php echo lang('today_sales'); ?> </p>
                                <h1 class="">
                                    <?php echo $settings->currency; ?> <?php echo number_format($today_sales_amount, 2, '.', ','); ?>
                                </h1>
                            </div>
                        </section>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                        </a>
                    <?php } ?>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a href="finance/pharmacy/todayExpense">
                        <?php } ?>
                        <section class="panel panel-moree">
                            <div class="symbol blue">
                                <i class="fa fa-minus"></i>
                            </div>
                            <div class="value">
                                <p> <?php echo lang('today_expense'); ?> </p>
                                <h1 class="">
                                    <?php echo $settings->currency; ?> <?php echo number_format($today_expenses_amount, 2, '.', ','); ?>
                                </h1>

                            </div>
                        </section>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                        </a>
                    <?php } ?>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a href="medicine">
                        <?php } ?>
                        <section class="panel panel-moree">
                            <div class="symbol blue">
                                <i class="fa fa-medkit"></i>
                            </div>
                            <div class="value">
                                <p> <?php echo lang('medicine'); ?> </p>
                                <h1 class="">
                                    <?php echo $this->db->count_all('medicine'); ?>
                                </h1>

                            </div>
                        </section>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                        </a>
                    <?php } ?>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a href="accountant">
                        <?php } ?>
                        <section class="panel panel-moree">
                            <div class="symbol blue">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="value">
                                <p> <?php echo lang('staff'); ?> </p>
                                <h1 class="">
                                    <?php echo $this->db->count_all('accountant'); ?>
                                </h1>
                            </div>
                        </section>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                        </a>
                    <?php } ?>
                </div>

                <!--
                <?php if ($this->ion_auth->in_group('admin')) { ?>

                    <div class="col-lg-6 col-sm-12">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <a href="finance/todayNetCash">
                            <?php } ?>
                            <section class="panel panel-moree">
                                <div class="symbol blue">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="value">
                                    <p> <?php echo lang('today_net_cash'); ?> </p>
                                    <h1 class="">
                                        <?php echo $settings->currency; ?> <?php
                                        $net_cash = $today_sales_amount - $today_expenses_amount;
                                        echo number_format($net_cash, 2, '.', ',');
                                        ?>
                                    </h1>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            </a>
                        <?php } ?>
                    </div>

                <?php } ?>

                <?php if ($this->ion_auth->in_group('admin')) { ?>

                    <div class="col-lg-6 col-sm-12">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            
                            <?php } ?>
                            <section class="panel panel-moree">
                                <div class="symbol blue">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="value">
                                    <p> <?php echo lang('current_total_inventory_value'); ?> </p>
                                    <h1 class="">
                                        <?php echo $settings->currency; ?> <?php echo number_format($total_stock_price, 2, '.', ','); ?>
                                    </h1>
                                </div>
                            </section>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                            
                        <?php } ?>
                    </div>

                <?php } ?>
                
                -->

                <?php
                foreach ($payments as $payment) {
                    $date = $payment->date;
                    $month = date('m', $date);
                    $year = date('y', $date);
                    if (date('y', time()) == date('y', $date)) {
                        if ($month == '01') {
                            $jan[] = $payment->gross_total;
                        }
                        if ($month == '02') {
                            $feb[] = $payment->gross_total;
                        }
                        if ($month == '03') {
                            $mar[] = $payment->gross_total;
                        }
                        if ($month == '04') {
                            $apr[] = $payment->gross_total;
                        }
                        if ($month == '05') {
                            $may[] = $payment->gross_total;
                        }
                        if ($month == '06') {
                            $jun[] = $payment->gross_total;
                        }
                        if ($month == '07') {
                            $jul[] = $payment->gross_total;
                        }
                        if ($month == '08') {
                            $aug[] = $payment->gross_total;
                        }
                        if ($month == '09') {
                            $sep[] = $payment->gross_total;
                        }
                        if ($month == '10') {
                            $oct[] = $payment->gross_total;
                        }
                        if ($month == '11') {
                            $nov[] = $payment->gross_total;
                        }
                        if ($month == '12') {
                            $dec[] = $payment->gross_total;
                        }
                    }
                }
                ?>

                <div class="col-lg-6">
                    <!--custom chart start-->
                    <div class="panel-heading"> <?php echo lang('sales_graph'); ?></div>
                    <div class="custom-bar-chart" style="padding: 0px 10px;">
                        <ul class="y-axis">
                            <li><span><?php echo $settings->currency; ?>1000000</span></li>
                            <li><span><?php echo $settings->currency; ?>800000</span></li>
                            <li><span><?php echo $settings->currency; ?>600000</span></li>
                            <li><span><?php echo $settings->currency; ?>400000</span></li>
                            <li><span><?php echo $settings->currency; ?>200000</span></li>
                            <li><span><?php echo $settings->currency; ?>0</span></li>
                        </ul>
                        <div class="bar">
                            <div class="title">JAN</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($jan)) {
                                echo array_sum($jan);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($jan)) {
                                     echo 'Style="height:"' . array_sum($jan);
                                 }
                                 ?>"></div>
                        </div>
                        <div class="bar ">
                            <div class="title">FEB</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($feb)) {
                                echo array_sum($feb);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($feb)) {
                                     echo 'height:' . array_sum($feb) * 100 / 1000000;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">MAR</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($mar)) {
                                echo array_sum($mar);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($mar)) {
                                     echo 'height:' . array_sum($mar) * 100 / 1000000;
                                 }
                                 ?>%"></div>
                        </div>
                        <div class="bar ">
                            <div class="title">APR</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($apr)) {
                                echo array_sum($apr);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($apr)) {
                                     echo 'height:' . array_sum($apr) * 100 / 10000;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar">
                            <div class="title">MAY</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($may)) {
                                echo array_sum($may);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($may)) {
                                     echo 'height:' . array_sum($may) * 100 / 1000000;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">JUN</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($jun)) {
                                echo array_sum($jun);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($jun)) {
                                     echo 'height:' . array_sum($jun) * 100 / 1000000;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar">
                            <div class="title">JUL</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($jul)) {
                                echo array_sum($jul);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($jul)) {
                                     echo 'height:' . array_sum($jul) * 100 / 1000000;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">AUG</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($aug)) {
                                echo array_sum($aug);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($aug)) {
                                     echo 'height:' . array_sum($aug) * 100 / 1000000;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">SEP</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($sep)) {
                                echo array_sum($sep);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($sep)) {
                                     echo 'height:' . array_sum($sep) * 100 / 1000000;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">OCT</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($oct)) {
                                echo array_sum($oct);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($oct)) {
                                     echo 'height:' . array_sum($oct) * 100 / 1000000;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">NOV</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($nov)) {
                                echo array_sum($nov);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($nov)) {
                                     echo 'height:' . array_sum($nov) * 100 / 1000000;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">DEC</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($dec)) {
                                echo array_sum($dec);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($dec)) {
                                     echo 'height:' . array_sum($dec) * 100 / 1000000;
                                 }
                                 ?>%""></div>
                        </div>
                    </div>
                    <!--custom chart end-->
                </div>

                <div class="col-md-6">
                    <!--work progress start-->
                    <section class="panel">
                        <div class="panel-body progress-panel">
                            <div class="task-progress" style="padding: 10px 0px;">
                                <h1><?php echo lang('statistics'); ?></h1>
                                <p><?php echo lang('this_month');?></p>
                            </div>
                        </div>
                        <table class="table table-hover personal-task">
                            <tbody>  
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <?php echo lang('number_of_sales'); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-important">
                                            <?php
                                            $query_n_o_s = $this->db->get('pharmacy_payment')->result();
                                            $i = 0;
                                            foreach ($query_n_o_s as $q_n_o_s) {
                                                if (date('m/y', time()) == date('m/y', $q_n_o_s->date)) {
                                                    $i = $i + 1;
                                                }
                                            }
                                            echo $i;
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress1"><canvas width="47" height="20" style="display: inline-block; width: 47px; height: 20px; vertical-align: top;"></canvas></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>
                                        <?php echo lang('total_sales'); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-important">
                                            <?php echo $settings->currency; ?>
                                            <?php
                                            $query = $this->db->get('pharmacy_payment')->result();
                                            $sales_total = array();
                                            foreach ($query as $q) {
                                                if (date('m', time()) == date('m', $q->date)) {
                                                    $sales_total[] = $q->gross_total;
                                                }
                                            }
                                            if (!empty($sales_total)) {
                                                echo number_format(array_sum($sales_total), 2, '.', ',');
                                            }
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress1"><canvas width="47" height="20" style="display: inline-block; width: 47px; height: 20px; vertical-align: top;"></canvas></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>
                                        <?php echo lang('number_of_expenses'); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            <?php
                                            $query_n_o_e = $this->db->get('pharmacy_expense')->result();
                                            $i = 0;
                                            foreach ($query_n_o_e as $q_n_o_e) {
                                                if (date('m', time()) == date('m', $q_n_o_e->date)) {
                                                    $i = $i + 1;
                                                }
                                            }
                                            echo $i;
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress2"><canvas width="47" height="22" style="display: inline-block; width: 47px; height: 22px; vertical-align: top;"></canvas></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>
                                        <?php echo lang('total_expense'); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            <?php echo $settings->currency; ?>
                                            <?php
                                            $query_expense = $this->db->get('pharmacy_expense')->result();
                                            $sales_total = array();
                                            foreach ($query_expense as $q_expense) {
                                                if (date('m', time()) == date('m', $q_expense->date)) {
                                                    $expense_total[] = $q_expense->amount;
                                                }
                                            }
                                            if (!empty($expense_total)) {
                                                echo array_sum($expense_total);
                                            }
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress2"><canvas width="47" height="22" style="display: inline-block; width: 47px; height: 22px; vertical-align: top;"></canvas></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td>
                                        <?php echo lang('medicine_number'); ?> 
                                    </td>
                                    <td>
                                        <span class="badge bg-info"> 
                                            <?php
                                            $query_medicine_number = $this->db->get('medicine')->result();
                                            $i = 0;
                                            foreach ($query_medicine_number as $q_medicine_number) {
                                                $i = $i + 1;
                                            }
                                            echo $i;
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress3"><canvas width="47" height="22" style="display: inline-block; width: 47px; height: 22px; vertical-align: top;"></canvas></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td>
                                        <?php echo lang('medicine_quantity'); ?> 
                                    </td>
                                    <td>
                                        <span class="badge bg-info"> 
                                            <?php
                                            $query_medicine = $this->db->get('medicine')->result();
                                            $i = 0;
                                            foreach ($query_medicine as $q_medicine) {
                                                if ($q_medicine->quantity > 0) {
                                                    $i = $i + $q_medicine->quantity;
                                                }
                                            }

                                            echo $i;
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress3"><canvas width="47" height="22" style="display: inline-block; width: 47px; height: 22px; vertical-align: top;"></canvas></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>
                                        <?php echo lang('medicine_o_s'); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">
                                            <?php
                                            $query_medicine = $this->db->get('medicine')->result();
                                            $i = 0;
                                            foreach ($query_medicine as $q_medicine) {
                                                if ($q_medicine->quantity == 0) {
                                                    $i = $i + 1;
                                                }
                                            }
                                            echo $i;
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress4"><canvas width="47" height="22" style="display: inline-block; width: 47px; height: 22px; vertical-align: top;"></canvas></div>
                                    </td>
                                </tr>
                                <!--
                                <tr>
                                    <td>8</td>
                                    <td>
                                <?php echo lang('discount'); ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">



                                <?php echo $settings->currency; ?>

                                <?php
                                $query_discount = $this->db->get('payment')->result();
                                $discount_total = array();
                                foreach ($query_discount as $q_discount) {
                                    if (date('m', time()) == date('m', $q_discount->date)) {
                                        $discount_total[] = $q_discount->discount;
                                    }
                                }

                                if (!empty($discount_total)) {
                                    echo array_sum($discount_total);
                                }
                                ?>

                                        </span>
                                    </td>
                                    <td>
                                        <div id="work-progress5"><canvas width="47" height="22" style="display: inline-block; width: 47px; height: 22px; vertical-align: top;"></canvas></div>
                                    </td>
                                </tr>
                                -->
                            </tbody>
                        </table>
                    </section>
                    <!--work progress end-->
                </div>


                <div class="col-md-6">         
                    <div class="panel-heading"> <?php echo lang('latest_sales'); ?></div>
                    <table class="table table-striped table-hover table-bordered" id="">
                        <thead>
                            <tr>
                                <th> <?php echo lang('date'); ?> </th>
                                <th> <?php echo lang('grand_total'); ?> </th>
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
                        <?php
                        $i = 0;
                        foreach ($payments as $payment) {
                            $i = $i + 1;
                            ?>
                            <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>
                            <tr class="">
                                <td><?php echo date('d/m/y', $payment->date); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></td>
                            </tr>
                            <?php
                            if ($i == 10)
                                break;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>


                <div class="col-md-6">         
                    <div class="panel-heading"> <?php echo lang('latest_expense'); ?></div>
                    <table class="table table-striped table-hover table-bordered" id="">
                        <thead>
                            <tr>
                                <th> <?php echo lang('category'); ?> </th>
                                <th> <?php echo lang('date'); ?> </th>
                                <th> <?php echo lang('amount'); ?> </th>
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
                        $i = 0;
                        foreach ($expenses as $expense) {
                            $i = $i + 1;
                            ?>
                            <tr class="">
                                <td><?php echo $expense->category; ?></td>
                                <td> <?php echo date('d/m/y', $expense->date); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $expense->amount; ?></td>             
                            </tr>
                            <?php
                            if ($i == 10)
                                break;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">  
                    <div class="panel-heading"> <?php echo lang('latest_medicines'); ?></div>
                    <table class="table table-striped table-hover table-bordered" id="">
                        <thead>
                            <tr>
                                <th> <?php echo lang('name'); ?></th>
                                <th> <?php echo lang('category'); ?></th>
                                <th> <?php echo lang('price'); ?></th>
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

                            .load{
                                float: right !important;
                            }

                        </style>
                        <?php
                        $i = 0;
                        foreach ($latest_medicines as $latest_medicine) {
                            $i = $i + 1;
                            ?>
                            <tr class="">
                                <td><?php echo $latest_medicine->name; ?></td>
                                <td> <?php echo $latest_medicine->category; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $latest_medicine->s_price; ?></td>
                            </tr>
                            <?php
                            if ($i == 10)
                                break;
                        }
                        ?>
                        </tbody>
                    </table>

                </div>

               
            </div>


        </div>
        <!--state overview end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->

</body>
</html>
