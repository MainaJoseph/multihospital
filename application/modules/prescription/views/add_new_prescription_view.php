<!--sidebar end-->
<!--main content start-->


<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>


<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-8">
            <header class="panel-heading">
                <?php
                if (!empty($prescription->id))
                    echo lang('edit_prescription');
                else
                    echo lang('add_prescription');
                ?>
            </header>
            <div class="panel col-md-12">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="prescription/addNewPrescription" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                                    <input type="text" class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='<?php
                                    if (!empty($setval)) {
                                        echo set_value('date');
                                    }
                                    if (!empty($prescription->date)) {
                                        echo date('d-m-Y', $prescription->date);
                                    }
                                    ?>' placeholder="" readonly="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                                    <select class="form-control m-bot15 js-example-basic-single" name="patient" value=''>
                                        <?php foreach ($patients as $patient) { ?>
                                            <option value="<?php echo $patient->id; ?>" <?php
                                            if (!empty($setval)) {
                                                if ($patient->id == set_value('patient')) {
                                                    echo 'selected';
                                                }
                                            }
                                            if (!empty($prescription->patient)) {
                                                if ($patient->id == $prescription->patient) {
                                                    echo 'selected';
                                                }
                                            }
                                            ?> > <?php echo $patient->name; ?> </option>
                                                <?php } ?> 
                                    </select>
                                </div>
                                <?php if (!$this->ion_auth->in_group('Doctor')) { ?>
                                    <div class="form-group col-md-4"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?></label>
                                        <select class="form-control m-bot15 js-example-basic-single" name="doctor" value=''>
                                            <?php foreach ($doctors as $doctor) { ?>
                                                <option value="<?php echo $doctor->id; ?>" <?php
                                                if (!empty($setval)) {
                                                    if ($doctor->id == set_value('doctor')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($prescription->doctor)) {
                                                    if ($doctor->id == $prescription->doctor) {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo $doctor->name; ?> </option>
                                                    <?php } ?> 
                                        </select>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group col-md-4"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?></label>
                                        <select class="form-control m-bot15 js-example-basic-single" name="doctor" value=''>
                                            <?php
                                            foreach ($doctors as $doctor) {
                                                if ($doctor->id == $doctor_id) {
                                                    ?>
                                                    <option value="<?php echo $doctor->id; ?>" <?php
                                                    if (!empty($setval)) {
                                                        if ($doctor->id == set_value('doctor')) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    if (!empty($prescription->doctor)) {
                                                        if ($doctor->id == $prescription->doctor) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> > <?php echo $doctor->name; ?> </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?> 
                                        </select>
                                    </div>
                                <?php } ?>

                                <div class="form-group col-md-6">
                                    <label class="control-label"><?php echo lang('history'); ?></label>
                                    <textarea class="form-control ckeditor" id="editor1" name="symptom" value="" rows="50" cols="20"><?php
                                        if (!empty($setval)) {
                                            echo set_value('symptom');
                                        }
                                        if (!empty($prescription->symptom)) {
                                            echo $prescription->symptom;
                                        }
                                        ?></textarea>
                                </div>



                                <div class="form-group col-md-6">
                                    <label class="control-label"><?php echo lang('note'); ?></label>
                                    <textarea class="form-control ckeditor" id="editor3" name="note" value="" rows="30" cols="20"><?php
                                        if (!empty($setval)) {
                                            echo set_value('note');
                                        }
                                        if (!empty($prescription->note)) {
                                            echo $prescription->note;
                                        }
                                        ?></textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-3"> <?php echo lang('medicine'); ?></label>
                                    <div class="col-md-9">
                                        <select class="form-control m-bot15 js-example-basic-multiple medicinee" multiple="" name="category" value=''>
                                            <?php foreach ($medicines as $medicine) { ?>
                                                <option value="<?php echo $medicine->id; ?>" id="medicine_id-<?php echo $medicine->id; ?>" data-id="<?php echo $medicine->id; ?>" data-med_name="<?php echo $medicine->name; ?>" <?php
                                                if (!empty($prescription->medicine)) {
                                                    $prescription_medicine = explode('###', $prescription->medicine);
                                                    foreach ($prescription_medicine as $key => $value) {
                                                        $prescription_medicine_extended = explode('***', $value);
                                                        if ($prescription_medicine_extended[0] == $medicine->id) {
                                                            echo 'data-dosage="' . $prescription_medicine_extended[1] . '"' . 'data-frequency="' . $prescription_medicine_extended[2] . '"data-days="' . $prescription_medicine_extended[3] . '"data-instruction="' . $prescription_medicine_extended[4] . '"' . 'selected';
                                                        }
                                                    }
                                                }
                                                ?> > <?php echo $medicine->name; ?> </option>
                                                    <?php } ?> 
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 panel-body">
                                    <label class="control-label col-md-3"><?php echo lang('medicine'); ?></label>
                                    <div class="col-md-9 medicine pull-right">

                                    </div>

                                </div>

                                <input type="hidden" name="admin" value='admin'>

                                <input type="hidden" name="id" value='<?php
                                if (!empty($prescription->id)) {
                                    echo $prescription->id;
                                }
                                ?>'>

                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                                </div>
                            </div>

                            <div class="col-md-5">

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



<style>

    form{
        border: 0px;
    }

    .med_selected{
        background: #fff;
        padding: 10px 0px;
        margin: 5px;
    }


    .select2-container--bgform .select2-selection--multiple .select2-selection__choice {
        clear: both !important;
    }

    label {
        display: inline-block;
        margin-bottom: 5px;
        font-weight: 500;
        font-weight: bold;
    }

</style>


<script src="common/js/codearistos.min.js"></script>







<script type="text/javascript">
    $(document).ready(function () {
        //   $(".medicine").html("");


        $("select").on("select2:unselect", function (e) {
            var value = e.params.data.id;
            $('#med_selected_section-' + value).remove();
        });



        var count = 0;
        $.each($('select.medicinee option:selected'), function () {
            var id = $(this).data('id');
            var med_id = $(this).data('id');
            var med_name = $(this).data('med_name');
            var dosage = $(this).data('dosage');
            var frequency = $(this).data('frequency');
            var days = $(this).data('days');
            var instruction = $(this).data('instruction');
            if ($('#med_id-' + id).length)
            {

            } else {

                $(".medicine").append('<section id="med_selected_section-' + med_id + '" class="med_selected row">\n\
         <div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label> <?php echo lang("medicine"); ?> </label>\n\
</div>\n\
\n\
<div class=col-md-12>\n\
<input class = "medi_div" name = "med_id[]" value = "' + med_name + '" placeholder="" required>\n\
 <input type="hidden" id="med_id-' + id + '" class = "medi_div" name = "medicine[]" value = "' + med_id + '" placeholder="" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2" ><div class=col-md-12>\n\
<label><?php echo lang("dosage"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "state medi_div" name = "dosage[]" value = "' + dosage + '" placeholder="100 mg" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label><?php echo lang("frequency"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div sale" id="salee' + count + '" name = "frequency[]" value = "' + frequency + '" placeholder="1 + 0 + 1" required>\n\
</div>\n\
</div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("days"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' + count + '" name = "days[]" value = "' + days + '" placeholder="7 days" required>\n\
</div>\n\
</div>\n\
\n\
\n\<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("instruction"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' + count + '" name = "instruction[]" value = "' + instruction + '" placeholder="After Food" required>\n\
</div>\n\
</div>\n\
\n\
\n\
 <div class="del col-md-1"></div>\n\
</section>');
            }
        });
    }
    );


</script> 





<script type="text/javascript">
    $(document).ready(function () {
        $('.medicinee').change(function () {
            //   $(".medicine").html("");
            var count = 0;


            $("select").on("select2:unselect", function (e) {
                var value = e.params.data.id;
                $('#med_selected_section-' + value).remove();
            });

            $.each($('select.medicinee option:selected'), function () {
                var id = $(this).data('id');
                var med_id = $(this).data('id');
                var med_name = $(this).data('med_name');


                if ($('#med_id-' + id).length)
                {

                } else {


                    $(".medicine").append('<section class="med_selected row" id="med_selected_section-' + med_id + '">\n\
         <div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label> <?php echo lang("medicine"); ?> </label>\n\
</div>\n\
\n\
<div class=col-md-12>\n\
<input class = "medi_div" name = "med_id[]" value = "' + med_name + '" placeholder="" required>\n\
 <input type="hidden" class = "medi_div" id="med_id-' + id + '" name = "medicine[]" value = "' + med_id + '" placeholder="" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2" ><div class=col-md-12>\n\
<label><?php echo lang("dosage"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "state medi_div" name = "dosage[]" value = "" placeholder="100 mg" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label><?php echo lang("frequency"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div sale" id="salee' + count + '" name = "frequency[]" value = "" placeholder="1 + 0 + 1" required>\n\
</div>\n\
</div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("days"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' + count + '" name = "days[]" value = "" placeholder="7 days" required>\n\
</div>\n\
</div>\n\
\n\
\n\<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("instruction"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' + count + '" name = "instruction[]" value = "" placeholder="After Food" required>\n\
</div>\n\
</div>\n\
\n\
\n\
 <div class="del col-md-1"></div>\n\
</section>');
                }
            });
        });
    });


</script> 
