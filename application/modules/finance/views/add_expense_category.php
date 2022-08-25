<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height row">
        <!-- page start-->
        <section class="col-md-6">
            <header class="panel-heading">
                <?php
                if (!empty($category->id))
                    echo lang('edit_expense_category');
                else
                    echo lang('add_expense_category');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table "> 
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="finance/addExpenseCategory" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="form-group"> 
                                <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
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
                            <input type="hidden" name="id" value='<?php
                            if (!empty($category->id)) {
                                echo $category->id;
                            }
                            ?>'>
                            <div class="form-group cl-md-12">
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
