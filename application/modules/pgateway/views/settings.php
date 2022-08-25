<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="col-md-8 row">
            <section class="col-md-10 row">
                <header class="panel-heading">
                    <?php
                    if (!empty($settings->name)) {
                        echo $settings->name;
                    }
                    ?> <?php echo lang('settings'); ?>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="pgateway/addNewSettings" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('payment_gateway'); ?> <?php echo lang('name'); ?></label>
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                    if (!empty($settings->name)) {
                                        echo $settings->name;
                                    }
                                    ?>' placeholder="" readonly>   
                                </div>
                                <?php if ($settings->name == "Pay U Money") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('merchant_key'); ?> </label>
                                        <input type="text" class="form-control" name="merchant_key" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->merchant_key)) {
                                            echo $settings->merchant_key;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('salt'); ?> </label>
                                        <input type="text" class="form-control" name="salt" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->salt)) {
                                            echo $settings->salt;
                                        }
                                        ?>'>
                                    </div
                                <?php } ?>

                                <?php if ($settings->name == "PayPal") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('api_username'); ?> </label>
                                        <input type="text" class="form-control" name="APIUsername" id="exampleInputEmail1" value="<?php
                                        if (!empty($settings->APIUsername)) {
                                            echo $settings->APIUsername;
                                        }
                                        ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('api_password'); ?> </label>
                                        <input type="text" class="form-control" name="APIPassword" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->APIPassword)) {
                                            echo $settings->APIPassword;
                                        }
                                        ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('api_signature'); ?> </label>
                                        <input type="text" class="form-control" name="APISignature" id="exampleInputEmail1" value='<?php
                                        if (!empty($settings->APISignature)) {
                                            echo $settings->APISignature;
                                        }
                                        ?>'>
                                    </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                                    <select class="form-control m-bot15" name="status" value=''>
                                        <option value="live" <?php
                                        if (!empty($settings->status)) {
                                            if ($settings->status == 'live') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo lang('live'); ?> </option>
                                        <option value="test" <?php
                                        if (!empty($settings->status)) {
                                            if ($settings->status == 'test') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo lang('test'); ?></option>
                                    </select>
                                </div>
                                <input type="hidden" name="id" value='<?php
                                if (!empty($settings->id)) {
                                    echo $settings->id;
                                }
                                ?>'>
                                <div class="form-group clearfix">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>