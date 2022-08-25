<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <div class="">

                <style>
                    .panel-primary>.panel-heading {
                        padding: 10px;
                    }

                    .panel-body {
                        background: #fff;
                    }
                </style>

                <section class="content">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <header class="panel-heading">
                                <?php echo lang('subscription'); ?>  <?php echo lang('details'); ?>
                            </header>
                            <div class="col-md-12 panel">
                                <div class="" style="margin-top: 10px;"><?php echo lang('patient'); ?>  <?php echo lang('limit'); ?> : <?php echo $subscription->p_limit; ?></div>
                                <div class=""><?php echo lang('doctor'); ?>  <?php echo lang('limit'); ?> : <?php echo $subscription->d_limit; ?></div>
                                <div class="" style="text-transform: capitalize;"><?php echo lang('modules'); ?> : <br> <br>
                                    <?php
                                    $modules = explode(',', $subscription->module);
                                    foreach ($modules as $key => $value) {
                                        echo $value . '<br>';
                                    }
                                    ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



            </div>
        </section>
        <!-- page end-->
    </section>
</section>

