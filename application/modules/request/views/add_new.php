
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7 row">
            <header class="panel-heading">
                <?php
                if (!empty($request->id)) {
                    echo lang('edit_request');
                } else {
                    echo lang('add_new_request');
                }
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="col-lg-12">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('feedback'); ?>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                    <form role="form" action="request/addNew" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                            if (!empty($request->name)) {
                                echo $request->name;
                            }
                            ?>' placeholder="">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                            <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                            if (!empty($request->email)) {
                                echo $request->email;
                            }
                            ?>' placeholder="">
                        </div>
                        

                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                            if (!empty($request->address)) {
                                echo $request->address;
                            }
                            ?>' placeholder="">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                            <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                            if (!empty($request->phone)) {
                                echo $request->phone;
                            }
                            ?>' placeholder="">
                        </div>

                        <?php
                        if (!empty($request->id)) {
                            $this->db->where('request_id', $request->id);
                            $settings = $this->db->get('settings')->row();
                        }
                        ?>

                        <div class="form-group"> 
                            <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>
                            <select class="form-control m-bot15" name="language" value=''>
                                <option value="arabic" <?php
                                if (!empty($settings->language)) {
                                    if ($settings->language == 'arabic') {
                                        echo 'selected';
                                    }
                                }
                                ?>><?php echo lang('arabic'); ?> 
                                </option>
                                <option value="english" <?php
                                if (!empty($settings->language)) {
                                    if ($settings->language == 'english') {
                                        echo 'selected';
                                    }
                                }
                                ?>><?php echo lang('english'); ?> 
                                </option>
                                <option value="spanish" <?php
                                if (!empty($settings->language)) {
                                    if ($settings->language == 'spanish') {
                                        echo 'selected';
                                    }
                                }
                                ?>><?php echo lang('spanish'); ?>
                                </option>
                                <option value="french" <?php
                                if (!empty($settings->language)) {
                                    if ($settings->language == 'french') {
                                        echo 'selected';
                                    }
                                }
                                ?>><?php echo lang('french'); ?>
                                </option>
                                <option value="italian" <?php
                                if (!empty($settings->language)) {
                                    if ($settings->language == 'italian') {
                                        echo 'selected';
                                    }
                                }
                                ?>><?php echo lang('italian'); ?>
                                </option>
                                <option value="portuguese" <?php
                                if (!empty($settings->language)) {
                                    if ($settings->language == 'portuguese') {
                                        echo 'selected';
                                    }
                                }
                                ?>><?php echo lang('portuguese'); ?>
                                </option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('package'); ?></label>
                            <select class="form-control m-bot15 pos_select" id="pos_select" name="package" value='' required="">
                                <option value=""> - - - </option>
                                <option value="" <?php
                                if (!empty($request->id)) {
                                    if (empty($request->package)) {
                                        echo 'selected';
                                    }
                                }
                                ?>><?php echo lang('select_manually'); ?></option>
                                        <?php foreach ($packages as $package) { ?>
                                    <option value="<?php echo $package->id; ?>" <?php
                                    if (!empty($setval)) {
                                        if ($package->name == set_value('package')) {
                                            echo 'selected';
                                        }
                                    }
                                    if (!empty($request->package)) {
                                        if ($package->id == $request->package) {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > <?php echo $package->name; ?> </option>
                                        <?php } ?> 
                            </select>
                        </div>

                        <div class="form-group pos_client">
                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('limit'); ?></label>
                            <input type="text" class="form-control" name="p_limit" id="exampleInputEmail1" value='<?php
                            if (!empty($request->p_limit)) {
                                echo $request->p_limit;
                            } else {
                                echo '1000';
                            }
                            ?>' placeholder="Example: 1000" required="">
                        </div>

                        <div class="form-group pos_client">
                            <label for="exampleInputEmail1"><?php echo lang('doctor'); ?> <?php echo lang('limit'); ?></label>
                            <input type="text" class="form-control" name="d_limit" id="exampleInputEmail1" value='<?php
                            if (!empty($request->d_limit)) {
                                echo $request->d_limit;
                            } else {
                                echo '500';
                            }
                            ?>' placeholder="Example: 1000" required="">
                        </div>


                        <input type="hidden" name="id" value='<?php
                        if (!empty($request->id)) {
                            echo $request->id;
                        }
                        ?>'>
                        <div class="panel col-md-12">
                            <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </form>


                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->




<script src="common/js/codearistos.min.js"></script>


<script>
    $(document).ready(function () {
<?php
if (!empty($request->id)) {
    if (empty($request->package)) {
        ?>
                $('.pos_client').show();
    <?php } else { ?>
                $('.pos_client').hide();
        <?php
    }
} else {
    ?>
            $('.pos_client').hide();
<?php } ?>
        $(document.body).on('change', '#pos_select', function () {

            var v = $("select.pos_select option:selected").val()
            if (v == '') {
                $('.pos_client').show();
            } else {
                $('.pos_client').hide();
            }
        });

    });
</script>