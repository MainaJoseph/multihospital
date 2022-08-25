
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="row col-md-7">
            <header class="panel-heading">
                <?php
                if (!empty($package->id)) {
                    echo lang('edit_package');
                } else {
                    echo lang('add_new_package');
                }
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
                        <form role="form" action="hospital/package/addNew" method="post" enctype="multipart/form-data">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('package'); ?> <?php echo lang('name'); ?></label>
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                    if (!empty($package->name)) {
                                        echo $package->name;
                                    }
                                    ?>' placeholder="">

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('limit'); ?></label>
                                    <input type="text" class="form-control" name="p_limit" id="exampleInputEmail1" value='<?php
                                    if (!empty($package->p_limit)) {
                                        echo $package->p_limit;
                                    }
                                    ?>' placeholder="" required="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('doctor'); ?> <?php echo lang('limit'); ?></label>
                                    <input type="text" class="form-control" name="d_limit" id="exampleInputEmail1" value='<?php
                                    if (!empty($package->d_limit)) {
                                        echo $package->d_limit;
                                    }
                                    ?>' placeholder="" required="">
                                </div>



                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('price'); ?> </label>
                                    <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='<?php
                                    if (!empty($package->price)) {
                                        echo $package->price;
                                    }
                                    ?>' placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('show_in_frontend'); ?></label>
                                    <select class="form-control" name="show_in_frontend">
                                        <option value="Yes" <?php
                                        if (!empty($package->show_in_frontend)) {
                                            if ($package->show_in_frontend == 'Yes') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo lang('yes'); ?></option>
                                        <option value="No" <?php
                                        if (!empty($package->show_in_frontend)) {
                                            if ($package->show_in_frontend == 'No') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo lang('no'); ?></option>
                                    </select>
                                </div>

                                <div class="form-group">                                    
                                    <input type="checkbox" name="set_as_default" value="1" class="" <?php
                                    if (!empty($package->set_as_default)) {
                                        if ($package->set_as_default == 1) {
                                            echo 'checked=""';
                                        }
                                    }
                                    ?>> 
                                    <label for="exampleInputEmail1"><?php echo lang('set_as_default'); ?></label>
                                </div>


                            </div>

                            <div class="col-md-6">


                                <div class="form-group"> 
                                    <label for="exampleInputEmail1"> <?php echo lang('module_permission'); ?></label>
                                    <br>
                                    <input type='checkbox' value = "accountant" name="module[]"

                                           <?php
                                           if (!empty($package->id)) {
                                               $modules = $this->package_model->getPackageById($package->id)->module;
                                               $modules1 = explode(',', $modules);
                                               if (in_array('accountant', $modules1)) {
                                                   echo 'checked';
                                               }
                                           } else {
                                               echo 'checked';
                                           }
                                           ?>
                                           > <?php echo lang('accountant'); ?>

                                    <br>
                                    <input type='checkbox' value = "appointment" name="module[]"  <?php
                                    if (!empty($package->id)) {
                                        if (in_array('appointment', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('appointment'); ?>
                                    <br>
                                    <input type='checkbox' value = "lab" name="module[]"  <?php
                                    if (!empty($package->id)) {
                                        if (in_array('lab', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('lab_tests'); ?>
                                    <br>
                                    <input type='checkbox' value = "bed" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('bed', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('bed'); ?>

                                    <br>
                                    <input type='checkbox' value = "department" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('department', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('department'); ?>

                                    <br>
                                    <input type='checkbox' value = "doctor" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('doctor', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?> required=""> <?php echo lang('doctor'); ?>

                                    <br>
                                    <input type='checkbox' value = "donor" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('donor', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('donor'); ?>

                                    <br>
                                    <input type='checkbox' value = "finance" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('finance', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('financial_activities'); ?>

                                    <br>
                                    <input type='checkbox' value = "pharmacy" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('pharmacy', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('pharmacy'); ?>

                                    <br>
                                    <input type='checkbox' value = "laboratorist" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('laboratorist', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('laboratorist'); ?>

                                    <br>
                                    <input type='checkbox' value = "medicine" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('medicine', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('medicine'); ?>

                                    <br>
                                    <input type='checkbox' value = "nurse" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('nurse', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('nurse'); ?>

                                    <br>
                                    <input type='checkbox' value = "patient" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('patient', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?> required=""> <?php echo lang('patient'); ?>

                                    <br>
                                    <input type='checkbox' value = "pharmacist" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('pharmacist', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?> required=""> <?php echo lang('pharmacist'); ?>

                                    <br>
                                    <input type='checkbox' value = "prescription" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('prescription', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('prescription'); ?>

                                    <br>
                                    <input type='checkbox' value = "receptionist" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('receptionist', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('receptionist'); ?>

                                    <br>
                                    <input type='checkbox' value = "report" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('report', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('report'); ?>


                                    <br>
                                    <input type='checkbox' value = "notice" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('notice', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('notice'); ?>


                                    <br>
                                    <input type='checkbox' value = "email" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('email', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('email'); ?>


                                    <br>
                                    <input type='checkbox' value = "sms" name="module[]" <?php
                                    if (!empty($package->id)) {
                                        if (in_array('sms', $modules1)) {
                                            echo 'checked';
                                        }
                                    } else {
                                        echo 'checked';
                                    }
                                    ?>> <?php echo lang('sms'); ?>




                                </div>


                            </div>


                            <input type="hidden" name="id" value='<?php
                            if (!empty($package->id)) {
                                echo $package->id;
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
