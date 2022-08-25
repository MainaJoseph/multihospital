<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('add_department'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">           
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="department/addNew" method="post">
                                        <div class="form-group col-md-12">
                                            <label class="control-label col-md-3"><?php echo lang('name'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                                if (!empty($setval)) {
                                                    echo set_value('name');
                                                }
                                                if (!empty($department->name)) {
                                                    echo $department->name;
                                                }
                                                ?>' placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label col-md-3"></label>
                                            <div class="col-md-9">

                                            </div>

                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="control-label col-md-3"><?php echo lang('description'); ?></label>
                                            <div class="col-md-9">
                                                <textarea class="ckeditor form-control" name="description" value="" rows="10"><?php
                                                    if (!empty($setval)) {
                                                        echo set_value('description');
                                                    }
                                                    if (!empty($department->description)) {
                                                        echo $department->description;
                                                    }
                                                    ?></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($department->id)) {
                                            echo $department->id;
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
