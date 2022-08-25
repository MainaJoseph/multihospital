



<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="container mt-5">
            <div class="row">
                <div class="col-md-2"></div>  
                <div class="col-md-8">
                    <div class="card">
                        <h2 class="card-header text-white panel-heading"><?php echo lang('payment_gateway'); ?> <i class='fa fa-arrow-right'></i> <?php echo lang('checkout_confirmation'); ?></h2>
                        <div class="card-body">
                            <form action="<?php echo $action; ?>/_payment" method="post" id="payuForm" name="payuForm">
                                <input type="hidden" name="key" value="<?php echo $mkey; ?>" />
                                <input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
                                <input type="hidden" name="txnid" value="<?php echo $tid; ?>" />
                                <div class="form-group">
                                    <label class="control-label"> <?php echo lang('total_payable_amount'); ?></label>
                                    <input class="form-control" name="amount" value="<?php echo $amount; ?>"  readonly/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> <?php echo lang('name'); ?></label>
                                    <input class="form-control" name="firstname" id="firstname" value="<?php echo $name; ?>" readonly/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> <?php echo lang('email'); ?></label>
                                    <input class="form-control" name="email" id="email" value="<?php echo $mailid; ?>" readonly/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> <?php echo lang('phone'); ?></label>
                                    <input class="form-control" name="phone" value="<?php echo $phoneno; ?>" readonly />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">  <?php echo lang('payment_id'); ?></label>
                                    <textarea class="form-control" name="productinfo" readonly><?php echo $productinfo; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> <?php echo lang('address'); ?></label>
                                    <input class="form-control" name="address1" value="<?php echo $address; ?>" readonly/>     
                                </div>
                                <div class="form-group">
                                    <input name="surl" value="<?php echo $sucess; ?>" size="64" type="hidden" />
                                    <input name="furl" value="<?php echo $failure; ?>" size="64" type="hidden" />  
                                    <!--for test environment comment  service provider   -->
                                    <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                                    <input name="curl" value="<?php echo $cancel; ?> " type="hidden" />
                                </div>
                                <div class="form-group float-right">
                                    <button type="submit" value="Pay Now" class="btn btn-success" > <?php echo lang('checkout'); ?> </button>
                                </div>
                            </form> 
                        </div>
                    </div>

                </div>
                <div class="col-md-2"></div>
            </div>
            <!-- Footer -->

        </div> 






        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->


<style>

    form {
        background: #fff!important;
        padding: 50px 20px;
    }

</style>


