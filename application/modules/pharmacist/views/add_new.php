<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($pharmacist->id))
                    echo lang('edit_pharmacist');
                else
                    echo lang('add_new_pharmacist');
                ?>
            </header>
            <div class="panel-body col-md-7">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                            <?php echo $this->session->flashdata('feedback'); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="pharmacist/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('name');
                                            }
                                            if (!empty($pharmacist->name)) {
                                                echo $pharmacist->name;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                            <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('email');
                                            }
                                            if (!empty($pharmacist->email)) {
                                                echo $pharmacist->email;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                                            <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('address');
                                            }
                                            if (!empty($pharmacist->address)) {
                                                echo $pharmacist->address;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                            <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('phone');
                                            }
                                            if (!empty($pharmacist->phone)) {
                                                echo $pharmacist->phone;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                                            <input type="file" name="img_url">
                                        </div>

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($pharmacist->id)) {
                                            echo $pharmacist->id;
                                        }
                                        ?>'>
                                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                    </form>
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
