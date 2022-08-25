<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height row">
        <!-- page start-->
        <section class="col-md-6">
            <header class="panel-heading">
                <?php
                if (!empty($expense->id))
                    echo lang('edit_expense');
                else
                    echo lang('add_expense');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix"> 
                        <?php echo validation_errors(); ?>
                        <form role="form" action="finance/addExpense" class="clearfix row" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
                                <select class="form-control m-bot15 js-example-basic-single" name="category" value=''>
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?php echo $category->category; ?>" <?php
                                        if (!empty($setval)) {
                                            if ($category->category == set_value('category')) {
                                                echo 'selected';
                                            }
                                        }
                                        if (!empty($expense->category)) {
                                            if ($category->category == $expense->category) {
                                                echo 'selected';
                                            }
                                        }
                                        ?> > <?php echo $category->category; ?> </option>
                                            <?php } ?> 
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('amount'); ?></label>
                                <input type="text" class="form-control" name="amount" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('amount');
                                }
                                if (!empty($expense->amount)) {
                                    echo $expense->amount;
                                }
                                ?>' placeholder="<?php echo $settings->currency; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('note'); ?></label>
                                <input type="text" class="form-control" name="note" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('note');
                                }
                                if (!empty($expense->note)) {
                                    echo $expense->note;
                                }
                                ?>' placeholder="">
                            </div>
                            <input type="hidden" name="id" value='<?php
                            if (!empty($expense->id)) {
                                echo $expense->id;
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
