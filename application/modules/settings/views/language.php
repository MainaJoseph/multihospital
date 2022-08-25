<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <div class="panel-body">

                <style>
                    .panel-primary>.panel-heading {
                        padding: 10px;
                    }

                    .panel-body {
                        background: #f1f2f7;
                    }
                </style>

                <section class="content">
                    <div class="">
                        <div class="panel panel-primary">
                            <header class="panel-heading">
                                <?php echo lang('language'); ?>
                            </header>

                            <form role="form" class="clearfix pos form1"  id="editSaleForm" action="settings/changeLanguage" method="post" enctype="multipart/form-data">
                                <div class="col-md-12 pos_top pos_body" style="margin-top: 33px;">
                                    <div class="col-md-12">  

                                        <div class="form-group col-md-4"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label> 
                                            <select class="form-control m-bot15" name="language" value=''>
                                                <option value="arabic" <?php
                                                if (!empty($settings->language)) {
                                                    if ($settings->language == 'arabic') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo lang('arabic'); ?> 
                                                </option>
                                                <option value="english" <?php
                                                if (!empty($settings->language)) {
                                                    if ($settings->language == 'english') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo lang('english'); ?> 
                                                </option>
                                                <option value="spanish" <?php
                                                if (!empty($settings->language)) {
                                                    if ($settings->language == 'spanish') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo lang('spanish'); ?>
                                                </option>
                                                <option value="french" <?php
                                                if (!empty($settings->language)) {
                                                    if ($settings->language == 'french') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo lang('french'); ?>
                                                </option>
                                                <option value="italian" <?php
                                                if (!empty($settings->language)) {
                                                    if ($settings->language == 'italian') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo lang('italian'); ?>
                                                </option>
                                                <option value="portuguese" <?php
                                                if (!empty($settings->language)) {
                                                    if ($settings->language == 'portuguese') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo lang('portuguese'); ?>
                                                </option>
                                                <option value="indonesian" <?php
                                                if (!empty($settings->language)) {
                                                    if ($settings->language == 'indonesian') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo lang('indonesian'); ?>
                                                </option>
                                            </select>
                                        </div>

                                        <input type="hidden" name="language_settings" value='language_settings'>

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($settings->id)) {
                                            echo $settings->id;
                                        }
                                        ?>'>

                                        <div class="form-group col-md-12"> 
                                            <button type="submit" name="submit" class="btn green"> <?php echo lang('submit'); ?></button>
                                        </div>





                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>



            </div>
        </section>
        <!-- page end-->
    </section>
</section>

