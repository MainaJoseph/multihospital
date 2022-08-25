



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
                            <form action="paypal/Do_direct_payment" method="post" id="payuForm" name="payuForm">
                                <div class="form-group">
                                    <label class="control-label"> <?php echo lang('total_payable_amount'); ?></label>
                                    <input class="form-control" name="amount" value="<?php echo $all_details['deposited_amount']; ?>"  readonly/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> <?php echo lang('name'); ?></label>
                                    <input class="form-control" name="firstname" id="firstname" value="<?php echo $all_details['patient_name']; ?>" readonly/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> <?php echo lang('email'); ?></label>
                                    <input class="form-control" name="email" id="email" value="<?php echo $all_details['patient']; ?>" readonly/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> <?php echo lang('phone'); ?></label>
                                    <input class="form-control" name="phone" value="<?php echo $all_details['patient_phone']; ?>" readonly />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">  <?php echo lang('payment_id'); ?></label>
                                    <textarea class="form-control" name="productinfo" readonly><?php echo $all_details['payment_id']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> <?php echo lang('address'); ?></label>
                                    <input class="form-control" name="address1" value="<?php echo $all_details['patient_address']; ?>" readonly/>     
                                </div>
                                <div class="form-group">
                                    <?php foreach($all_details as $value){?>
                                    <input type="hidden" name="all_details[]" value="<?php echo $value; ?>" size="64" type="hidden" />
                                    <?php } ?>
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


