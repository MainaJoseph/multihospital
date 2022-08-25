<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">

            <header class="panel-heading">
                <i class="fa fa-user"></i>   <?php echo lang('patient'); ?> <?php echo lang('database'); ?>
            </header>
            <div class="panel-body">

                <div class="adv-table editable-table ">
                    <div class=" no-print">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export no-print" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('patient_id'); ?></th>                        
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                    <th><?php echo lang('due_balance'); ?></th>
                                <?php } ?>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <style>
                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }
                        </style>


                        <?php
                        if ($this->ion_auth->in_group(array('Doctor'))) {
                            $doctor_ion_id = $this->ion_auth->get_user_id();
                            $doctor_id = $this->doctor_model->getDoctorByIonUserId($doctor_ion_id)->id;
                          //  echo $doctor_id; die();
                        }
                        ?>




                        <?php     
                        foreach ($patients as $patient) {
                            $patient_doctors = explode(',', $patient->doctor);
                            if (in_array($doctor_id, $patient_doctors)) {
                                ?>
                                <tr class="">
                                    <td> <?php echo $patient->id; ?></td>
                                    <td> <?php echo $patient->name; ?></td>
                                    <td><?php echo $patient->phone; ?></td>


                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                        <td> <?php echo $settings->currency; ?>
                                            <?php
                                            $query = $this->db->get_where('payment', array('patient' => $patient->id))->result();
                                            $deposits = $this->db->get_where('patient_deposit', array('patient' => $patient->id))->result();
                                            $balance = array();
                                            $deposit_balance = array();
                                            foreach ($query as $gross) {
                                                $balance[] = $gross->gross_total;
                                            }
                                            $balance = array_sum($balance);


                                            foreach ($deposits as $deposit) {
                                                $deposit_balance[] = $deposit->deposited_amount;
                                            }
                                            $deposit_balance = array_sum($deposit_balance);



                                            $bill_balance = $balance;

                                            echo $due_balance = $bill_balance - $deposit_balance;

                                            $due_balance = NULL;
                                            ?>
                                        </td>
                                    <?php } ?>

                                    <td class="no-print">
                                        <a type="button" class="btn editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $patient->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></a>

                                        <a class="btn detailsbutton" title="<?php echo lang('info'); ?>" href="patient/patientDetails?id=<?php echo $patient->id; ?>"><i class="fa fa-info"> </i> <?php echo lang('info'); ?></a> 
                                        <a class="btn green" title="<?php echo lang('history'); ?>" href="patient/medicalHistory?id=<?php echo $patient->id; ?>"><i class="fa fa-stethoscope"></i> <?php echo lang('history'); ?></a>
                                        <a class="btn detailsbutton" title="<?php echo lang('payment'); ?>" href="finance/patientPaymentHistory?patient=<?php echo $patient->id; ?>"><i class="fa fa-money"></i> <?php echo lang('payment'); ?></a>
                                        <a class="btn delete_button" title="<?php echo lang('delete'); ?>" href="patient/delete?id=<?php echo $patient->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?></a>


                                    </td>
                                </tr>
                            <?php }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('register_new_patient'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-12">     
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-3 payment_label"> 
                                    <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                                </div>
                                <div class="col-md-9"> 
                                    <select class="form-control m-bot15 js-example-basic-multiple" multiple="" name="doctor[]" value=''> 
                                        <option value=""> </option>
                                        <?php foreach ($doctors as $doctor) { ?>                                        
                                            <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
<?php } ?> 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

                            <option value="Male" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > Male </option>
                            <option value="Female" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > Female </option>
                            <option value="Others" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Others') {
                                    echo 'selected';
                                }
                            }
                            ?> > Others </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="">      
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($patient->bloodgroup)) {
                                    if ($group->group == $patient->bloodgroup) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
<?php } ?> 
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value='<?php
                    if (!empty($patient->patient_id)) {
                        echo $patient->patient_id;
                    }
                    ?>'>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->







<!-- Edit Patient Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_patient'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPatientForm" action="patient/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-12">     
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-3 payment_label"> 
                                    <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                                </div>
                                <div class="col-md-9"> 
                                    <select class="form-control m-bot15 js-example-basic-multiple doctor" multiple="" name="doctor[]" value=''>  
                                        <option value=""> </option> 
                                        <?php foreach ($doctors as $doctor) { ?>
                                            <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
<?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

                            <option value="Male" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > Male </option>
                            <option value="Female" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > Female </option>
                            <option value="Others" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Others') {
                                    echo 'selected';
                                }
                            }
                            ?> > Others </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="<?php
                        if (!empty($patient->birthdate)) {
                            echo $patient->birthdate;
                        }
                        ?>" placeholder="">      
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($patient->bloodgroup)) {
                                    if ($group->group == $patient->bloodgroup) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
<?php } ?> 
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Patient Modal-->


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                            $(document).ready(function () {
                                                $(".editbutton").click(function (e) {
                                                    e.preventDefault(e);
                                                    // Get the record's ID via attribute  
                                                    var iid = $(this).attr('data-id');
                                                    $('#editPatientForm').trigger("reset");
                                                    $('#myModal2').modal('show');
                                                    $.ajax({
                                                        url: 'patient/editPatientByJason?id=' + iid,
                                                        method: 'GET',
                                                        data: '',
                                                        dataType: 'json',
                                                    }).success(function (response) {
                                                        // Populate the form fields with the data returned from server

                                                        $('#editPatientForm').find('[name="id"]').val(response.patient.id).end()
                                                        $('#editPatientForm').find('[name="name"]').val(response.patient.name).end()
                                                        $('#editPatientForm').find('[name="password"]').val(response.patient.password).end()
                                                        $('#editPatientForm').find('[name="email"]').val(response.patient.email).end()
                                                        $('#editPatientForm').find('[name="address"]').val(response.patient.address).end()
                                                        $('#editPatientForm').find('[name="phone"]').val(response.patient.phone).end()
                                                        $('#editPatientForm').find('[name="sex"]').val(response.patient.sex).end()
                                                        $('#editPatientForm').find('[name="birthdate"]').val(response.patient.birthdate).end()
                                                        $('#editPatientForm').find('[name="bloodgroup"]').val(response.patient.bloodgroup).end()
                                                        $('#editPatientForm').find('[name="p_id"]').val(response.patient.patient_id).end()

                                                        $('.js-example-basic-multiple.doctor').val(response.appointment.doctor).trigger('change');
                                                    });
                                                });
                                            });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

