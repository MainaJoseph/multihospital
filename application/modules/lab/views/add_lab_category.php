<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($category->id))
                    echo lang('edit_lab_test');
                else
                    echo lang('add_lab_test');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="lab/addLabCategory" method="post" enctype="multipart/form-data">
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1"><?php echo lang('test_name'); ?></label>
                                            <input type="text" class="form-control" name="category" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('category');
                                            }
                                            if (!empty($category->category)) {
                                                echo $category->category;
                                            }
                                            ?>' placeholder="">    
                                        </div> 

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                                            <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('description');
                                            }
                                            if (!empty($category->description)) {
                                                echo $category->description;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('reference_value'); ?> </label>
                                            <input type="text" class="form-control" name="reference_value" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('reference_value');
                                            }
                                            if (!empty($category->reference_value)) {
                                                echo $category->reference_value;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                       

                                       

                                        <input type="hidden" name="id" value='<?php
                                                if (!empty($category->id)) {
                                                    echo $category->id;
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
