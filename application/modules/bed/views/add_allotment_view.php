<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7 row">
            <header class="panel-heading">
                <?php
                if (!empty($allotment->id))
                    echo lang('edit_bed_allotment');
                else
                    echo lang('add_bed_allotment');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="bed/addAllotment" class="clearfix row" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('bed_id'); ?></label>
                                <select class="form-control m-bot15" name="bed_id" value=''>
                                    <?php foreach ($beds as $bed) { ?>
                                        <option value="<?php echo $bed->bed_id; ?>" <?php
                                        if (!empty($allotment->bed_id)) {
                                            if ($allotment->bed_id == $bed->bed_id) {
                                                echo 'selected';
                                            }
                                        }
                                        ?> > <?php echo $bed->bed_id; ?> </option>
                                            <?php } ?> 
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                                <select class="form-control m-bot15" name="patient" value=''> 
                                    <?php foreach ($patients as $patient) { ?>
                                        <option value="<?php echo $patient->id; ?>" <?php
                                        if (!empty($allotment->patient)) {
                                            if ($allotment->patient == $patient->id) {
                                                echo 'selected';
                                            }
                                        }
                                        ?> ><?php echo $patient->name; ?> </option>
                                            <?php } ?>
                                </select>
                            </div>

                           <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('alloted_time'); ?></label>
                                <div data-date="" class="input-group date form_datetime-meridian">
                                    <div class="input-group-btn"> 
                                        <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                                        <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                                    </div>
                                    <input type="text" class="form-control" readonly="" name="a_time" id="exampleInputEmail1" value='<?php
                                    if (!empty($allotment->a_time)) {
                                        echo $allotment->a_time;
                                    }
                                    ?>' placeholder="">
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('discharge_time'); ?></label>
                                <div data-date="" class="input-group date form_datetime-meridian">
                                    <div class="input-group-btn"> 
                                        <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                                        <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                                    </div>
                                    <input type="text" class="form-control" name="d_time" id="exampleInputEmail1" value='<?php
                                    if (!empty($allotment->d_time)) {
                                        echo $allotment->d_time;
                                    }
                                    ?>' placeholder="">
                                </div>
                            </div>

                            <input type="hidden" name="id" value='<?php
                            if (!empty($allotment->id)) {
                                echo $allotment->id;
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
