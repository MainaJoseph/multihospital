<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <header class="panel-heading"> 
            <?php echo lang('financial_report'); ?> 
            <div class="col-md-1 pull-right">
                <button class="btn btn-info green no-print pull-right" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>
            </div>
        </header>
        <div class="col-md-12">
            <div class="col-md-7 row">
                <section>
                    <form role="form" class="f_report" action="finance/financialReport" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <!--     <label class="control-label col-md-3">Date Range</label> -->
                            <div class="col-md-6">
                                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                    if (!empty($from)) {
                                        echo $from;
                                    }
                                    ?>" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                    <span class="input-group-addon"><?php echo lang('to'); ?></span>
                                    <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                    if (!empty($to)) {
                                        echo $to;
                                    }
                                    ?>" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                </div>
                                <div class="row"></div>
                                <span class="help-block"></span> 
                            </div>
                            <div class="col-md-6 no-print">
                                <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <?php
        if (!empty($payments)) {
            $paid_number = 0;
            foreach ($payments as $payment) {
                $paid_number = $paid_number + 1;
            }
        }
        ?>
        <div class="row">
            <div class="col-lg-7">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo lang('income'); ?> 
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th> <?php echo lang('category'); ?></th>
                                <th> <?php echo lang('quantity'); ?></th>
                                <th class="hidden-phone"> <?php echo lang('amount'); ?></th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $category_id_for_report = array();
                            foreach ($payment_categories as $cat_name) {
                                foreach ($payments as $payment) {
                                    $categories_in_payment = explode(',', $payment->category_name);
                                    foreach ($categories_in_payment as $key => $category_in_payment) {
                                        $category_id = explode('*', $category_in_payment);
                                        if ($category_id[0] == $cat_name->id) {
                                            $category_id_for_report[] = $category_id[0];
                                        }
                                    }
                                }
                            }
                            $category_id_for_reports = array_unique($category_id_for_report);
                            ?>

                            <?php
                            foreach ($payment_categories as $category) {
                                $category_quantity = 0;
                                if (in_array($category->id, $category_id_for_reports)) {
                                    ?>
                                    <tr class="">
                                        <td><?php echo $category->category ?></td>
                                        <td>


                                            <?php
                                            foreach ($payments as $paymentt) {
                                                $category_names_and_amountss = $paymentt->category_name;
                                                $category_names_and_amountss = explode(',', $category_names_and_amountss);
                                                foreach ($category_names_and_amountss as $category_name_and_amountt) {
                                                    $category_namee = explode('*', $category_name_and_amountt);
                                                    if (($category->id == $category_namee[0])) {
                                                        $category_quantity = $category_namee[3];
                                                    }
                                                }
                                            }
                                            echo $category_quantity;
                                            ?>




                                        </td>
                                        <td><?php echo $settings->currency; ?> <?php
                                            foreach ($payments as $payment) {
                                                $category_names_and_amounts = $payment->category_name;
                                                $category_names_and_amounts = explode(',', $category_names_and_amounts);
                                                foreach ($category_names_and_amounts as $category_name_and_amount) {
                                                    $category_name = explode('*', $category_name_and_amount);
                                                    if (($category->id == $category_name[0])) {
                                                        $amount_per_category[] = $category_name[1];
                                                    }
                                                }
                                            }
                                            if (!empty($amount_per_category)) {
                                                echo array_sum($amount_per_category);
                                                $total_payment_by_category[] = array_sum($amount_per_category);
                                            } else {
                                                echo '0';
                                            }

                                            $amount_per_category = NULL;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                        <tbody>
                            <tr>
                                <td><h3><?php echo lang('sub_total'); ?> </h3></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($total_payment_by_category)) {
                                        echo array_sum($total_payment_by_category);
                                    } else {
                                        echo '0';
                                    }
                                    ?> 
                                </td>
                            </tr>

                            <tr>
                                <td><h5><?php echo lang('total'); ?> <?php echo lang('discount'); ?></h5></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        foreach ($payments as $payment) {
                                            $discount[] = $payment->flat_discount;
                                        }
                                        if ($paid_number > 0) {
                                            echo array_sum($discount);
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <!--
                            <tr>
                                <td><h5><?php echo lang('total'); ?> <?php echo lang('vat'); ?></h5></td>
                                <td>
                            <?php echo $settings->currency; ?>
                            <?php
                            if (!empty($payments)) {
                                foreach ($payments as $payment) {
                                    $vat[] = $payment->flat_vat;
                                }
                                if ($paid_number > 0) {
                                    echo array_sum($vat);
                                } else {
                                    echo '0';
                                }
                            } else {
                                echo '0';
                            }
                            ?>
                                </td>
                            </tr>
                            -->
                            <tr>
                                <td><h5><i class="fa fa-money"></i> <?php echo lang('gross_income'); ?></h5></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        if ($paid_number > 0) {
                                            $gross = array_sum($total_payment_by_category) - array_sum($discount) + array_sum($vat);
                                            echo $gross;
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><h5><?php echo lang('total'); ?> <?php echo lang('hospital_amount'); ?></h5></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        foreach ($payments as $payment) {
                                            $hospital_amount[] = $payment->hospital_amount;
                                        }
                                        if ($paid_number > 0) {
                                            $hospital_amount = array_sum($hospital_amount);
                                            echo $hospital_amount;
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><h5><?php echo lang('total'); ?> <?php echo lang('doctors_amount'); ?></h5></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        foreach ($payments as $payment) {
                                            $doctor_amount[] = $payment->doctor_amount;
                                        }
                                        if ($paid_number > 0) {
                                            $gross_doctor_amount = array_sum($doctor_amount);
                                            echo $gross_doctor_amount;
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </section>




                <section></section>


                <section class="panel">
                    <header class="panel-heading">
                        <?php echo lang('expense'); ?> 
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th> <?php echo lang('category'); ?></th>
                                <th class="hidden-phone"> <?php echo lang('amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expense_categories as $category) { ?>
                                <tr class=""> 
                                    <td><?php echo $category->category ?></td>
                                    <td>
                                        <?php echo $settings->currency; ?>
                                        <?php 
                                        foreach ($expenses as $expense) {
                                            $category_name = $expense->category;


                                            if (($category->category == $category_name)) {
                                                $amount_per_category[] = $expense->amount;
                                            }
                                        }
                                        if (!empty($amount_per_category)) {
                                            $total_expense_by_category[] = array_sum($amount_per_category);
                                            echo array_sum($amount_per_category);
                                        } else {
                                            echo '0';
                                        }

                                        $amount_per_category = NULL;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </section>
            </div>


            <style>
                .billl{
                    background: #39B24F !important;
                }

                .due{
                    background: #39B1D1 !important;
                }
            </style>



            <div class="col-lg-5">
                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body billl">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                    <?php echo lang('gross_bill'); ?>
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        if (empty($gross)) {
                                            $gross = 0;
                                        }
                                        echo $gross_bill = $gross;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                    <?php echo lang('gross_hospital_amount'); ?>
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($payments)) {
                                            if ($paid_number > 0) {
                                                $gross = $hospital_amount;
                                                echo $gross;
                                            }
                                        } elseif (!empty($payments)) {
                                            if (($paid_number > 0)) {
                                                $gross = $hospital_amount;
                                                echo $gross;
                                            }
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>


                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                    <?php echo lang('gross_doctors_commission'); ?>
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        if (empty($gross_doctor_amount)) {
                                            $gross_doctor_amount = 0;
                                        }
                                        if (empty($gross_doctor_amount_ot)) {
                                            $gross_doctor_amount_ot = 0;
                                        }
                                        echo $doctor_gross = $gross_doctor_amount + $gross_doctor_amount_ot;
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>




                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body billl">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                    <?php echo lang('gross_deposit'); ?>
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">

                                        <?php echo $settings->currency; ?>
                                        <?php
                                        $deposited_amount = array();
                                        if (!empty($deposits)) {
                                            foreach ($deposits as $deposit) {
                                                $deposited_amount[] = $deposit->deposited_amount;
                                            }
                                            if ($paid_number > 0) {
                                                $deposited_amount = array_sum($deposited_amount);
                                                echo $deposited_amount;
                                            } else {
                                                echo '0';
                                            }
                                        } else {
                                            echo '0';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body billl">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                    <?php echo lang('gross_due'); ?>
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">

                                        <?php echo $settings->currency; ?>
                                        <?php
                                        $deposited_amount = array();
                                        if (!empty($deposits)) {
                                            foreach ($deposits as $deposit) {
                                                $deposited_amount[] = $deposit->deposited_amount;
                                            }
                                            if ($paid_number > 0) {
                                                $deposited_amount = array_sum($deposited_amount);
                                                echo $gross_bill - $deposited_amount;
                                            } else {
                                                echo '0';
                                            }
                                        } else {
                                            echo '0';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>







                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body due">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                    <?php echo lang('gross_expense'); ?>
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($total_expense_by_category)) {
                                            echo array_sum($total_expense_by_category);
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>




                <!--
                
                                <section class="panel">
                                    <div class="weather-bg">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <i class="fa fa-money"></i>
                                                    Profit
                                                </div>
                                                <div class="col-xs-8">
                                                    <div class="degree">
                <?php echo $settings->currency; ?>
                <?php
                if (empty($total_payment_by_category)) {
                    if (empty($total_expense_by_category)) {
                        echo '0';
                    } else {
                        $profit = 0 - array_sum($total_expense_by_category);
                        echo $profit;
                    }
                }
                if (empty($total_expense_by_category)) {
                    if (empty($total_payment_by_category)) {
                        echo '0';
                    } else {
                        $profit = $gross - 0;
                        echo $profit;
                    }
                } else {
                    if (!empty($gross)) {
                        $profit = $gross - array_sum($total_expense_by_category);
                        echo $profit;
                    }
                }
                ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                
                
                
                                </section>
                
                
                
                
                -->







            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
