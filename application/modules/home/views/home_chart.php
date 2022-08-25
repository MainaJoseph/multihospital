
        <div class="state-overview col-md-4" style="padding: 18px 19px 23px 19px;">




            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                <section class="panel col-md-12">
                    <header class="panel-heading">
                        <?php echo lang('this_month_sale_expense_pie_chart'); ?>                   
                    </header>
                    <div class="panel-body text-center">
                        <canvas id="pie" height="300" width="400"></canvas>
                        <span class="sale_color"> </span> Sales: <?php echo $settings->currency . ' ' . $this_month[0]; ?> 
                        <span class="expense_color"> </span>Expense: <?php echo $settings->currency . ' ' . $this_month[1]; ?></span>
                    </div>
                </section>

            <?php } ?>


        </div>



        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
            <div class="state-overview col-md-8" style="padding: 18px 0px 23px 19px;; margin-bottom: 20px;">
                <?php
                foreach ($appointments as $appointment) {
                    $date2 = $appointment->date;
                    $month2 = date('m', $date2);
                    $year2 = date('y', $date2);
                    if (date('y', time()) == date('y', $date2)) {
                        if ($month2 == '01') {
                            $jan2[] = '1';
                        }
                        if ($month2 == '02') {
                            $feb2[] = '1';
                        }
                        if ($month2 == '03') {
                            $mar2[] = '1';
                        }
                        if ($month2 == '04') {
                            $apr2[] = '1';
                        }
                        if ($month2 == '05') {
                            $may2[] = '1';
                        }
                        if ($month2 == '06') {
                            $jun2[] = '1';
                        }
                        if ($month2 == '07') {
                            $jul2[] = '1';
                        }
                        if ($month2 == '08') {
                            $aug2[] = '1';
                        }
                        if ($month2 == '09') {
                            $sep2[] = '1';
                        }
                        if ($month2 == '10') {
                            $oct2[] = '1';
                        }
                        if ($month2 == '11') {
                            $nov2[] = '1';
                        }
                        if ($month2 == '12') {
                            $dec2[] = '1';
                        }
                    }
                }
                ?>

                <?php
                if (!empty($jan2)) {
                    $jan_total2 = array_sum($jan2);
                } else {
                    $jan_total2 = 0;
                }
                if (!empty($feb2)) {
                    $feb_total2 = array_sum($feb2);
                } else {
                    $feb_total2 = 0;
                }
                if (!empty($mar2)) {
                    $mar_total2 = array_sum($mar2);
                } else {
                    $mar_total2 = 0;
                }
                if (!empty($apr2)) {
                    $apr_total2 = array_sum($apr2);
                } else {
                    $apr_total2 = 0;
                }
                if (!empty($may2)) {
                    $may_total2 = array_sum($may2);
                } else {
                    $may_total2 = 0;
                }
                if (!empty($jun2)) {
                    $jun_total2 = array_sum($jun2);
                } else {
                    $jun_total2 = 0;
                }
                if (!empty($jul2)) {
                    $jul_total2 = array_sum($jul2);
                } else {
                    $jul_total2 = 0;
                }
                if (!empty($aug2)) {
                    $aug_total2 = array_sum($aug2);
                } else {
                    $aug_total2 = 0;
                }
                if (!empty($sep2)) {
                    $sep_total2 = array_sum($sep2);
                } else {
                    $sep_total2 = 0;
                }
                if (!empty($oct2)) {
                    $oct_total2 = array_sum($oct2);
                } else {
                    $oct_total2 = 0;
                }
                if (!empty($nov2)) {
                    $nov_total2 = array_sum($nov2);
                } else {
                    $nov_total2 = 0;
                }
                if (!empty($dec2)) {
                    $dec_total2 = array_sum($dec2);
                } else {
                    $dec_total2 = 0;
                }
                $all_value2 = array($jan_total2, $feb_total2, $mar_total2, $apr_total2, $may_total2, $jun_total2, $jul_total2, $aug_total2, $sep_total2, $oct_total2, $nov_total2, $dec_total2);
                if (!empty($all_value2)) {
                    $max2 = max($all_value2);
                } else {
                    $max2 = 0;
                }
                $str_len2 = strlen(round($max2));
                $indicator2 = pow(10, $str_len2 - 1);
                if (!function_exists('ceiling')) {

                    function ceiling($number2, $significance2 = 1) {
                        return ( is_numeric($number2) && is_numeric($significance2) ) ? (ceil($number2 / $significance2) * $significance2) : false;
                    }

                }
                $round2 = ceiling($max2, $indicator2);
                ?>

                <div class="panel col-md-12">
                    <!--custom chart start-->
                    <div class="panel-heading"> <?php echo lang('patient_appointment_graph'); ?></div>
                    <div class="custom-bar-chart">
                        <ul class="y-axis">
                            <li><span><?php echo ceil($round2); ?></span></li>
                            <li><span><?php echo ceil($round2 * 4 / 5); ?></span></li>
                            <li><span><?php echo ceil($round2 * 3 / 5); ?></span></li>
                            <li><span><?php echo ceil($round2 * 2 / 5); ?></span></li>
                            <li><span><?php echo ceil($round2 * 1 / 5); ?></span></li>
                            <li><span><?php echo ceil($round2 * 0 / 5); ?></span></li>

                        </ul>
                        <div class="bar">
                            <div class="title">JAN</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($jan2)) {
                                echo array_sum($jan2);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($jan2)) {
                                     echo 'height:' . array_sum($jan2) * 100 / $round2;
                                 }
                                 ?>"></div>
                        </div>
                        <div class="bar ">
                            <div class="title">FEB</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($feb2)) {
                                echo array_sum($feb2);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($feb2)) {
                                     echo 'height:' . array_sum($feb2) * 100 / $round2;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">MAR</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($mar2)) {
                                echo array_sum($mar2);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($mar2)) {
                                     echo 'height:' . array_sum($mar2) * 100 / $round2;
                                 }
                                 ?>%"></div>
                        </div>
                        <div class="bar ">
                            <div class="title">APR</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($apr2)) {
                                echo array_sum($apr2);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($apr2)) {
                                     echo 'height:' . array_sum($apr2) * 100 / $round2;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar">
                            <div class="title">MAY</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($may2)) {
                                echo array_sum($may2);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($may2)) {
                                     echo 'height:' . array_sum($may2) * 100 / $round2;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">JUN</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($jun2)) {
                                echo array_sum($jun2);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($jun2)) {
                                     echo 'height:' . array_sum($jun2) * 100 / $round2;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar">
                            <div class="title">JUL</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($jul2)) {
                                echo array_sum($jul2);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($jul2)) {
                                     echo 'height:' . array_sum($jul2) * 100 / $round2;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">AUG</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($aug2)) {
                                echo array_sum($aug2);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($aug2)) {
                                     echo 'height:' . array_sum($aug2) * 100 / $round2;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">SEP</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($sep2)) {
                                echo array_sum($sep2);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($sep2)) {
                                     echo 'height:' . array_sum($sep2) * 100 / $round2;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">OCT</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($oct2)) {
                                echo array_sum($oct2);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($oct2)) {
                                     echo 'height:' . array_sum($oct2) * 100 / $round2;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">NOV</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($nov2)) {
                                echo array_sum($nov2);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($nov2)) {
                                     echo 'height:' . array_sum($nov2) * 100 / $round2;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">DEC</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($dec2)) {
                                echo array_sum($dec2);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($dec2)) {
                                     echo 'height:' . array_sum($dec2) * 100 / $round2;
                                 }
                                 ?>%""></div>
                        </div>
                    </div>
                    <!--custom chart end-->
                </div>
            </div>



            <div class="state-overview col-md-6" style="padding: 23px 19px; margin-bottom: 20px;">

                <?php
                foreach ($expenses as $expense) {
                    $date1 = $expense->date;
                    $month1 = date('m', $date1);
                    $year1 = date('y', $date1);
                    if (date('y', time()) == date('y', $date1)) {
                        if ($month1 == '01') {
                            $jan1[] = $expense->amount;
                        }
                        if ($month1 == '02') {
                            $feb1[] = $expense->amount;
                        }
                        if ($month1 == '03') {
                            $mar1[] = $expense->amount;
                        }
                        if ($month1 == '04') {
                            $apr1[] = $expense->amount;
                        }
                        if ($month1 == '05') {
                            $may1[] = $expense->amount;
                        }
                        if ($month1 == '06') {
                            $jun1[] = $expense->amount;
                        }
                        if ($month1 == '07') {
                            $jul1[] = $expense->amount;
                        }
                        if ($month1 == '08') {
                            $aug1[] = $expense->amount;
                        }
                        if ($month1 == '09') {
                            $sep1[] = $expense->amount;
                        }
                        if ($month1 == '10') {
                            $oct1[] = $expense->amount;
                        }
                        if ($month1 == '11') {
                            $nov1[] = $expense->amount;
                        }
                        if ($month1 == '12') {
                            $dec1[] = $expense->amount;
                        }
                    }
                }
                ?>

                <?php
                if (!empty($jan1)) {
                    $jan_total1 = array_sum($jan1);
                } else {
                    $jan_total1 = 0;
                }
                if (!empty($feb1)) {
                    $feb_total1 = array_sum($feb1);
                } else {
                    $feb_total1 = 0;
                }
                if (!empty($mar1)) {
                    $mar_total1 = array_sum($mar1);
                } else {
                    $mar_total1 = 0;
                }
                if (!empty($apr1)) {
                    $apr_total1 = array_sum($apr1);
                } else {
                    $apr_total1 = 0;
                }
                if (!empty($may1)) {
                    $may_total1 = array_sum($may1);
                } else {
                    $may_total1 = 0;
                }
                if (!empty($jun1)) {
                    $jun_total1 = array_sum($jun1);
                } else {
                    $jun_total1 = 0;
                }
                if (!empty($jul1)) {
                    $jul_total1 = array_sum($jul1);
                } else {
                    $jul_total1 = 0;
                }
                if (!empty($aug1)) {
                    $aug_total1 = array_sum($aug1);
                } else {
                    $aug_total1 = 0;
                }
                if (!empty($sep1)) {
                    $sep_total1 = array_sum($sep1);
                } else {
                    $sep_total1 = 0;
                }
                if (!empty($oct1)) {
                    $oct_total1 = array_sum($oct1);
                } else {
                    $oct_total1 = 0;
                }
                if (!empty($nov1)) {
                    $nov_total1 = array_sum($nov1);
                } else {
                    $nov_total1 = 0;
                }
                if (!empty($dec1)) {
                    $dec_total1 = array_sum($dec1);
                } else {
                    $dec_total1 = 0;
                }
                $all_value1 = array($jan_total1, $feb_total1, $mar_total1, $apr_total1, $may_total1, $jun_total1, $jul_total1, $aug_total1, $sep_total1, $oct_total1, $nov_total1, $dec_total1);
                if (!empty($all_value1)) {
                    $max1 = max($all_value1);
                } else {
                    $max1 = 0;
                }
                $str_len1 = strlen(round($max1));
                $indicator1 = pow(10, $str_len1 - 1);
                if (!function_exists('ceiling')) {

                    function ceiling($number1, $significance1 = 1) {
                        return ( is_numeric($number1) && is_numeric($significance1) ) ? (ceil($number1 / $significance1) * $significance1) : false;
                    }

                }
                $round1 = ceiling($max1, $indicator1);
                ?>

                <div class="panel col-md-12">
                    <!--custom chart start-->
                    <div class="panel-heading"> <?php echo lang('expense_graph'); ?></div>
                    <div class="custom-bar-chart">
                        <ul class="y-axis">
                            <li><span><?php echo $settings->currency; ?><?php echo $round1; ?></span></li>
                            <li><span><?php echo $settings->currency; ?><?php echo $round1 * 4 / 5; ?></span></li>
                            <li><span><?php echo $settings->currency; ?><?php echo $round1 * 3 / 5; ?></span></li>
                            <li><span><?php echo $settings->currency; ?><?php echo $round1 * 2 / 5; ?></span></li>
                            <li><span><?php echo $settings->currency; ?><?php echo $round1 * 1 / 5; ?></span></li>
                            <li><span><?php echo $settings->currency; ?><?php echo $round1 * 0 / 5; ?></span></li>

                        </ul>
                        <div class="bar">
                            <div class="title">JAN</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($jan1)) {
                                echo array_sum($jan1);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($jan1)) {
                                     echo 'height:' . array_sum($jan1) * 100 / $round1;
                                 }
                                 ?>"></div>
                        </div>
                        <div class="bar ">
                            <div class="title">FEB</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($feb1)) {
                                echo array_sum($feb1);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($feb1)) {
                                     echo 'height:' . array_sum($feb1) * 100 / $round1;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">MAR</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($mar1)) {
                                echo array_sum($mar1);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($mar1)) {
                                     echo 'height:' . array_sum($mar1) * 100 / $round1;
                                 }
                                 ?>%"></div>
                        </div>
                        <div class="bar ">
                            <div class="title">APR</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($apr1)) {
                                echo array_sum($apr1);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($apr1)) {
                                     echo 'height:' . array_sum($apr1) * 100 / $round1;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar">
                            <div class="title">MAY</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($may1)) {
                                echo array_sum($may1);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($may1)) {
                                     echo 'height:' . array_sum($may1) * 100 / $round1;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">JUN</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($jun1)) {
                                echo array_sum($jun1);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($jun1)) {
                                     echo 'height:' . array_sum($jun1) * 100 / $round1;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar">
                            <div class="title">JUL</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($jul1)) {
                                echo array_sum($jul1);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($jul1)) {
                                     echo 'height:' . array_sum($jul1) * 100 / $round1;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">AUG</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($aug1)) {
                                echo array_sum($aug1);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($aug1)) {
                                     echo 'height:' . array_sum($aug1) * 100 / $round1;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">SEP</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($sep1)) {
                                echo array_sum($sep1);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($sep1)) {
                                     echo 'height:' . array_sum($sep1) * 100 / $round1;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">OCT</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($oct1)) {
                                echo array_sum($oct1);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($oct1)) {
                                     echo 'height:' . array_sum($oct1) * 100 / $round1;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">NOV</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($nov1)) {
                                echo array_sum($nov1);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($nov1)) {
                                     echo 'height:' . array_sum($nov1) * 100 / $round1;
                                 }
                                 ?>%""></div>
                        </div>
                        <div class="bar ">
                            <div class="title">DEC</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($dec1)) {
                                echo array_sum($dec1);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($dec1)) {
                                     echo 'height:' . array_sum($dec1) * 100 / $round1;
                                 }
                                 ?>%""></div>
                        </div>
                    </div>
                    <!--custom chart end-->
                </div>
            </div>


            <div class="state-overview col-md-6" style="padding: 23px 19px;">

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

                <?php
                if (!empty($jan)) {
                    $jan_total = array_sum($jan);
                } else {
                    $jan_total = 0;
                }
                if (!empty($feb)) {
                    $feb_total = array_sum($feb);
                } else {
                    $feb_total = 0;
                }
                if (!empty($mar)) {
                    $mar_total = array_sum($mar);
                } else {
                    $mar_total = 0;
                }
                if (!empty($apr)) {
                    $apr_total = array_sum($apr);
                } else {
                    $apr_total = 0;
                }
                if (!empty($may)) {
                    $may_total = array_sum($may);
                } else {
                    $may_total = 0;
                }
                if (!empty($jun)) {
                    $jun_total = array_sum($jun);
                } else {
                    $jun_total = 0;
                }
                if (!empty($jul)) {
                    $jul_total = array_sum($jul);
                } else {
                    $jul_total = 0;
                }
                if (!empty($aug)) {
                    $aug_total = array_sum($aug);
                } else {
                    $aug_total = 0;
                }
                if (!empty($sep)) {
                    $sep_total = array_sum($sep);
                } else {
                    $sep_total = 0;
                }
                if (!empty($oct)) {
                    $oct_total = array_sum($oct);
                } else {
                    $oct_total = 0;
                }
                if (!empty($nov)) {
                    $nov_total = array_sum($nov);
                } else {
                    $nov_total = 0;
                }
                if (!empty($dec)) {
                    $dec_total = array_sum($dec);
                } else {
                    $dec_total = 0;
                }
                $all_value = array($jan_total, $feb_total, $mar_total, $apr_total, $may_total, $jun_total, $jul_total, $aug_total, $sep_total, $oct_total, $nov_total, $dec_total);
                if (!empty($all_value)) {
                    $max = max($all_value);
                } else {
                    $max = 0;
                }
                $str_len = strlen(round($max));
                $indicator = pow(10, $str_len - 1);
                if (!function_exists('ceiling')) {

                    function ceiling($number, $significance = 1) {
                        return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number / $significance) * $significance) : false;
                    }

                }
                $round = ceiling($max, $indicator);
                ?>

                <div class="panel col-md-12">
                    <!--custom chart start-->
                    <div class="panel-heading"> <?php echo lang('sales_graph'); ?></div>
                    <div class="custom-bar-chart">
                        <ul class="y-axis">
                            <li><span><?php echo $settings->currency; ?><?php echo $round; ?></span></li>
                            <li><span><?php echo $settings->currency; ?><?php echo $round * 4 / 5; ?></span></li>
                            <li><span><?php echo $settings->currency; ?><?php echo $round * 3 / 5; ?></span></li>
                            <li><span><?php echo $settings->currency; ?><?php echo $round * 2 / 5; ?></span></li>
                            <li><span><?php echo $settings->currency; ?><?php echo $round * 1 / 5; ?></span></li>
                            <li><span><?php echo $settings->currency; ?><?php echo $round * 0 / 5; ?></span></li>

                        </ul>
                        <div class="bar">
                            <div class="title">JAN</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($jan)) {
                                echo array_sum($jan);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($jan)) {
                                     echo 'height:' . array_sum($jan) * 100 / $round;
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
                                     echo 'height:' . array_sum($feb) * 100 / $round;
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
                                     echo 'height:' . array_sum($mar) * 100 / $round;
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
                                     echo 'height:' . array_sum($apr) * 100 / $round;
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
                                     echo 'height:' . array_sum($may) * 100 / $round;
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
                                     echo 'height:' . array_sum($jun) * 100 / $round;
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
                                     echo 'height:' . array_sum($jul) * 100 / $round;
                                 }
                                 ?>%"></div>
                        </div>
                        <div class="bar ">
                            <div class="title">AUG</div>
                            <div class="value tooltips" data-original-title="<?php echo $settings->currency; ?><?php
                            if (!empty($aug)) {
                                echo array_sum($aug);
                            }
                            ?>" data-toggle="tooltip" data-placement="top" style="<?php
                                 if (!empty($aug)) {
                                     echo 'height:' . array_sum($aug) * 100 / $round;
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
                                     echo 'height:' . array_sum($sep) * 100 / $round;
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
                                     echo 'height:' . array_sum($oct) * 100 / $round;
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
                                     echo 'height:' . array_sum($nov) * 100 / $round;
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
                                     echo 'height:' . array_sum($dec) * 100 / $round;
                                 }
                                 ?>%""></div>
                        </div>
                    </div>
                    <!--custom chart end-->
                </div>
            </div>

        <?php } ?>