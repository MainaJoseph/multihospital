<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-6 row">
            <header class="panel-heading">
                <?php
                if (!empty($bed->id))
                    echo lang('edit_bed');
                else
                    echo lang('add_bed');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="bed/addBed" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('bed_category'); ?></label>
                                <select class="form-control m-bot15" name="category" value=''>
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?php echo $category->category; ?>" <?php
                                        if (!empty($setval)) {
                                            if ($category->category == set_value('category')) {
                                                echo 'selected';
                                            }
                                        }
                                        if (!empty($bed->category)) {
                                            if ($category->category == $bed->category) {
                                                echo 'selected';
                                            }
                                        }
                                        ?> > <?php echo $category->category; ?> </option>
                                            <?php } ?> 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('bed_number'); ?></label>
                                <input type="text" class="form-control" name="number" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('number');
                                }
                                if (!empty($bed->number)) {
                                    echo $bed->number;
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
                            <div class="form-group">
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
