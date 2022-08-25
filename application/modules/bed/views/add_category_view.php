<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($bed->id))
                    echo  lang('edit_bed_category');
                else
                    echo  lang('add_bed_category');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="bed/addCategory" method="post" enctype="multipart/form-data">
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
                                            <input type="text" class="form-control" name="category" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('category');
                                            }
                                            if (!empty($bed->category)) {
                                                echo $bed->category;
                                            }
                                            ?>' placeholder="">    
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                                            <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('description');
                                            }
                                            if (!empty($bed->description)) {
                                                echo $bed->description;
                                            }
                                            ?>' placeholder="">
                                        </div>

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($bed->id)) {
                                            echo $bed->id;
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
