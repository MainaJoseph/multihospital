<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo $patient->name; ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo $this->session->flashdata('feedback'); ?>
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <a href="finance/addPaymentByPatientView?id=<?php echo $patient->id;?>&type=gen">
                                            <div class="col-lg-3">
                                                <div class="flat-carousal">
                                                    <div id="owl-demo" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
                                                       <?php echo lang('add_general_payment'); ?> <i style="float: right; font-size: 18px;"class="fa fa-arrow-circle-o-right"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="finance/addPaymentByPatientView?id=<?php echo $patient->id;?>&type=ot">
                                            <div class="col-lg-3">
                                                <div class="flat-carousal">
                                                    <div id="owl-demo" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
                                                        <?php echo lang('add_ot_payment'); ?> <i style="float: right; font-size: 18px;"class="fa fa-arrow-circle-o-right"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="col-lg-3"></div>
                                    </div>





                                </div>
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
