<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('settings'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix row">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="settings/update" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('system_name'); ?></label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                if (!empty($settings->system_vendor)) {
                                    echo $settings->system_vendor;
                                }
                                ?>' placeholder="system name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                                <input type="text" class="form-control" name="title" id="exampleInputEmail1" value='<?php
                                if (!empty($settings->title)) {
                                    echo $settings->title;
                                }
                                ?>' placeholder="title">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                                <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                if (!empty($settings->address)) {
                                    echo $settings->address;
                                }
                                ?>' placeholder="address">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                if (!empty($settings->phone)) {
                                    echo $settings->phone;
                                }
                                ?>' placeholder="phone">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('hospital_email'); ?></label>
                                <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                if (!empty($settings->email)) {
                                    echo $settings->email;
                                }
                                ?>' placeholder="email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('currency'); ?></label>
                                <input type="text" class="form-control" name="currency" id="exampleInputEmail1" value='<?php
                                if (!empty($settings->currency)) {
                                    echo $settings->currency;
                                }
                                ?>' placeholder="currency">
                            </div>

                            <!--
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('discount_type'); ?></label>
                                <select class="form-control m-bot15" name="discount" value=''>
                                    <option value="percentage" <?php
                            if (!empty($settings->discount)) {
                                if ($settings->discount == 'percentage') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('percentage'); ?> (%)</option>
                                    <option value="flat" <?php
                            if (!empty($settings->discount)) {
                                if ($settings->discount == 'flat') {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo lang('flat'); ?></option>
                                </select>
                            </div>
                            
                            -->
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo lang('invoice_logo'); ?></label>
                                <input type="file" class="form-control" name="img_url" id="exampleInputEmail1" value='<?php
                                if (!empty($settings->invoice_logo)) {
                                    echo $settings->invoice_logo;
                                }
                                ?>' placeholder="">
                                <span class="help-block"><?php echo lang('recommended_size'); ?> : 200x100</span>
                            </div>
                            <div class="form-group hidden col-md-3">
                                <label for="exampleInputEmail1">Buyer</label>
                                <input type="hidden" class="form-control" name="buyer" id="exampleInputEmail1" value='<?php
                                if (!empty($settings->codec_username)) {
                                    echo $settings->buyer;
                                }
                                ?>' placeholder="codec_username">
                            </div>
                            <div class="form-group hidden col-md-3">
                                <label for="exampleInputEmail1">Purchase Code</label>
                                <input type="hidden" class="form-control" name="p_code" id="exampleInputEmail1" value='<?php
                                if (!empty($settings->codec_purchase_code)) {
                                    echo $settings->phone;
                                }
                                ?>' placeholder="codec_purchase_code">
                            </div>
                            <input type="hidden" name="id" value='<?php
                            if (!empty($settings->id)) {
                                echo $settings->id;
                            }
                            ?>'>
                            <div class="form-group col-md-12">
                                <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
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