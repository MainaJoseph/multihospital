<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-6">
            <header class="panel-heading">
                <?php
                if (!empty($category->id))
                    echo lang('pharmacy') . ' ' . lang('edit_expense_category');
                else
                    echo lang('pharmacy') . ' ' . lang('add_expense_category');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="finance/pharmacy/addExpenseCategory" method="post" enctype="multipart/form-data">
                            <div class="form-group"> 
                                <label for="exampleInputEmail1"> <?php echo lang('category'); ?> </label>
                                <input type="text" class="form-control" name="category" id="exampleInputEmail1" value='<?php
                                if (!empty($category->category)) {
                                    echo $category->category;
                                }
                                ?>' placeholder="">    
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> <?php echo lang('description'); ?> </label>
                                <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='<?php
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
                            
                            
                                <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?> </button>
                            
                                
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
