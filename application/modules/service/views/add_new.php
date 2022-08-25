
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($service->id))
                    echo lang('edit_service');
                else
                    echo lang('add_service');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <?php echo validation_errors(); ?>
                                <?php echo $this->session->flashdata('feedback'); ?>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                        <form role="form" action="service/addNew" method="post" enctype="multipart/form-data">
                            <div class="form-group">    
                                <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                                <input type="text" class="form-control" name="title" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('title');
                                }
                                if (!empty($service->title)) {
                                    echo $service->title;
                                }
                                ?>' placeholder="">   
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                                <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('description');
                                }
                                if (!empty($service->description)) {
                                    echo $service->description;
                                }
                                ?>' placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" name="img_url">
                            </div>
                            <input type="hidden" name="id" value='<?php
                            if (!empty($service->id)) {
                                echo $service->id;
                            }
                            ?>'>
                            <button type="submit" name="submit" class="btn btn-info">Submit</button>
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
