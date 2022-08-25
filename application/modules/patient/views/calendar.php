<!--sidebar end-->





<?php
if ($this->ion_auth->in_group(array('Patient'))) {
    $patient_ion_id = $this->ion_auth->get_user_id();
    $patient = $this->db->get_where('patient', array('ion_user_id' => $patient_ion_id))->row();
}
?>


<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('appointment'); ?> <?php echo lang('calendar'); ?>| <?php echo $patient->name; ?> | <?php echo $patient->phone; ?>
            </header> 
            <aside>
                <section class="">
                    <div class="panel-body">
                        <div id="calendar" class="has-toolbar calendar_view"></div>
                    </div>
                </section>
            </aside>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->




<!-- Add Patient Material Modal-->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php echo lang('add'); ?> <?php echo lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientMaterial" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('file'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>


                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->


<!-- Add Department Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_medical_history'); ?></h4>
            </div> 
            <div class="modal-body">
                <form role="form" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('description'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Department Modal-->

<!-- Edit Department Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_medical_history'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="medical_historyEditForm" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('description'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>

<!-- Add Prescription Modal-->
<div class="modal fade" id="myModa3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">  
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_prescription'); ?></h4>
            </div> 
            <div class="modal-body">
                <form role="form" action="prescription/addNewPrescription" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <input type="hidden" class="form-control form-control-inline input-medium default-date-picker" name="doctor" id="exampleInputEmail1" value='<?php
if (!empty($doctor_id)) {
    echo $doctor_id;
}
?>' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                        <select class="form-control m-bot15" name="patient" value=''> 
                            <option value="">Select .....</option>
<?php foreach ($patients as $patientss) { ?>
                                <option value="<?php echo $patientss->id; ?>" <?php
    if (!empty($prescription->patient)) {
        if ($prescription->patient == $patientss->id) {
            echo 'selected';
        }
    }
    ?> ><?php echo $patientss->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('history'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="symptom" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('medication'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="medicine" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('note'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="note" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Prescription Modal-->



<!-- Edit Prescription Modal-->
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">  
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_prescription'); ?></h4>
            </div> 
            <div class="modal-body">
                <form role="form" id="prescriptionEditForm" action="prescription/addNewPrescription" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <input type="hidden" class="form-control form-control-inline input-medium default-date-picker" name="doctor" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                        <select class="form-control m-bot15" name="patient" value=''> 
                            <option value="">Select .....</option>
<?php foreach ($patients as $patientss) { ?>
                                <option value="<?php echo $patientss->id; ?>" <?php
    if (!empty($prescription->patient)) {
        if ($prescription->patient == $patientss->id) {
            echo 'selected';
        }
    }
    ?> ><?php echo $patientss->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('history'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" id="editor1" name="symptom" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('medication'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" id="editor2" name="medicine" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('note'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" id="editor3" name="note" value="" rows="10"></textarea>
                        </div>
                    </div>


                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Prescription Modal-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".editbutton").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#myModal2').modal('show');
            $.ajax({
                url: 'patient/editMedicalHistoryByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                // Populate the form fields with the data returned from server
                $('#medical_historyEditForm').find('[name="id"]').val(response.medical_history.id).end()
                $('#medical_historyEditForm').find('[name="date"]').val(response.medical_history.date).end()
                CKEDITOR.instances['editor'].setData(response.medical_history.description)
            });
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".editPrescription").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#myModal5').modal('show');
            $.ajax({
                url: 'prescription/editPrescriptionByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                // Populate the form fields with the data returned from server
                $('#prescriptionEditForm').find('[name="id"]').val(response.prescription.id).end()
                $('#prescriptionEditForm').find('[name="patient"]').val(response.prescription.patient).end()
                $('#prescriptionEditForm').find('[name="doctor"]').val(response.prescription.doctor).end()

                CKEDITOR.instances['editor1'].setData(response.prescription.symptom)
                CKEDITOR.instances['editor2'].setData(response.prescription.medicine)
                CKEDITOR.instances['editor3'].setData(response.prescription.note)
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
