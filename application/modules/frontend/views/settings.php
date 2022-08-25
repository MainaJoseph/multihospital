<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-gear"></i> <?php echo lang('website'); ?> <?php echo lang('settings'); ?>
            </header>


            <style>

                form {
                    border: 0px solid #ccc; 
                    padding: 0px;
                }

                .panel-default > .panel-heading {
                    background-color: #f1f1f1 !important;
                }

                .panel-default>.panel-heading+.panel-collapse .panel-body {
                    border-top-color: #ddd;
                    background: #f9f9f9;
                }

            </style>


            <div class="panel-body">
                <div class="clearfix">
                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">
                                <?php echo validation_errors(); ?>
                                <form role="form" action="frontend/update" method="post" enctype="multipart/form-data">


                                    <div class="panel-group m-bot20" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading clearfix">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                                                        <div class="form-group col-md-6">
                                                            <h4><?php echo lang('general_settings'); ?></h4>
                                                        </div>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                                                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->title)) {
                                                            echo $settings->title;
                                                        }
                                                        ?>' placeholder="system name">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('logo'); ?></label>
                                                        <input type="file" class="form-control" name="img_url" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->invoice_logo)) {
                                                            echo $settings->invoice_logo;
                                                        }
                                                        ?>' placeholder="">
                                                        <span class="help-block"><?php echo lang('recommended_size'); ?>: 200x100</span>
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
                                                        <label for="exampleInputEmail1"><?php echo lang('emergency'); ?></label>
                                                        <input type="text" class="form-control" name="emergency" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->emergency)) {
                                                            echo $settings->emergency;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('support_number'); ?></label>
                                                        <input type="text" class="form-control" name="support" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->support)) {
                                                            echo $settings->support;
                                                        }
                                                        ?>' placeholder="">
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
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading clearfix">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false">
                                                        <div class="form-group col-md-6">
                                                            <h4><?php echo lang('block_text_settings'); ?></h4>
                                                        </div> 
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('block_1_text_under_title'); ?></label>
                                                        <input type="text" class="form-control" name="block_1_text_under_title" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->block_1_text_under_title)) {
                                                            echo $settings->block_1_text_under_title;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('service_block__text_under_title'); ?></label>
                                                        <input type="text" class="form-control" name="service_block__text_under_title" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->service_block__text_under_title)) {
                                                            echo $settings->service_block__text_under_title;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('package_block__text_under_title'); ?></label>
                                                        <input type="text" class="form-control" name="doctor_block__text_under_title" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->doctor_block__text_under_title)) {
                                                            echo $settings->doctor_block__text_under_title;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading clearfix">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false">
                                                        <div class="form-group col-md-6">
                                                            <h4><?php echo lang('social_settings'); ?></h4>
                                                        </div> 
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                                                <div class="panel-body">


                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('facebook_id'); ?></label>
                                                        <input type="text" class="form-control" name="facebook_id" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->facebook_id)) {
                                                            echo $settings->facebook_id;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('twitter_id'); ?></label>
                                                        <input type="text" class="form-control" name="twitter_id" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->twitter_id)) {
                                                            echo $settings->twitter_id;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>
                                                     <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('twitter_username'); ?></label>
                                                        <input type="text" class="form-control" name="twitter_username" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->twitter_username)) {
                                                            echo $settings->twitter_username;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('google_id'); ?></label>
                                                        <input type="text" class="form-control" name="google_id" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->google_id)) {
                                                            echo $settings->google_id;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('youtube_id'); ?></label>
                                                        <input type="text" class="form-control" name="youtube_id" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->youtube_id)) {
                                                            echo $settings->youtube_id;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('skype_id'); ?></label>
                                                        <input type="text" class="form-control" name="skype_id" id="exampleInputEmail1" value='<?php
                                                        if (!empty($settings->skype_id)) {
                                                            echo $settings->skype_id;
                                                        }
                                                        ?>' placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
























                                    <input type="hidden" name="id" value='<?php
                                    if (!empty($settings->id)) {
                                        echo $settings->id;
                                    }
                                    ?>'>
                                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                </form>
                            </div>
                        </section>
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