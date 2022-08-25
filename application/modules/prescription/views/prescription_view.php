<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- invoice start-->






        <style>

            th{
                text-align: center;
            }

            td{
                text-align: center;
            }

            tr.total{
                color: green;
            }



            .control-label{
                width: 100px;
            }



            h1{
                margin-top: 5px;
            }


            .print_width{
                width: 50%;
                float: left;
            } 

            ul.amounts li {
                padding: 0px !important;
            }

            .invoice-list {
                margin-bottom: 90px;
            }




            .panel{
                background: #fff !important;
                padding: 50px;
                height: 100%;
                margin: 0px;
                border-radius: 0px !important;
                min-height: 1000px;

            }



            .table.main{
                margin-top: -50px;
            }


            .panel{
                border: 0px solid #802f00;
            }



            .control-label{
                margin-bottom: 0px;
                font-size: 10px;
            }


            tr.total td{
                color: green !important;
            }

            .theadd th{
                background: #edfafa !important;
            }

            td{
                font-size: 12px;
                padding: 5px;
                font-weight: bold;
            }

            .details{
                font-weight: bold;
                font-size: 8px;
            }

            hr{
                border-bottom: 2px solid green !important;
            }

            .corporate-id {
                margin-bottom: 5px;
            }

            .adv-table table tr td {
                padding: 5px 10px;
            }

            .control-label {
                width: 90px;
            }










            @media print {

                h1{
                    margin-top: 5px;
                }

                #main-content{
                    padding-top: 0px;
                }

                .print_width{
                    width: 50%;
                    float: left;
                } 

                ul.amounts li {
                    padding: 0px !important;
                }

                .invoice-list {
                    margin-bottom: 90px;
                }

                .wrapper{
                    margin-top: 0px;
                }

                .wrapper{
                    padding: 0px 0px !important;

                }



                .wrapper{
                    border: 2px solid #802f00;
                }

                .panel{
                    border: 0px solid #802f00;
                    background: #fff !important;
                    padding: 0px 0px;
                    height: 100%;
                    margin: 5px 5px -10px 5px;
                    border-radius: 0px !important;
                    min-height: 1000px;

                }



                .table.main{
                    margin-top: -50px;
                    width: 70%;
                }





                .control-label{
                    margin-bottom: 0px;
                    font-size: 10px;
                }

                tr.total td{
                    color: green !important;
                }

                .theadd th{
                    background: #edfafa !important;
                }

                td{
                    font-size: 12px;
                    padding: 5px;
                    font-weight: bold;
                }

                .details{
                    font-weight: bold;
                    font-size: 10px;
                }

                hr{
                    border-bottom: 2px solid green !important;
                }

                .corporate-id {
                    margin-bottom: 5px;
                }

                .adv-table table tr td {
                    padding: 5px 10px;
                }




            }

        </style>














        <section class="">
            <header class="panel-heading no-print">
                 <?php echo lang('prescription'); ?>
            </header>
            <div class="panel-body col-md-8 panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel">
                    <div class="invoice-list">

                        <div class="text-center corporate-id">


                            <h3>
                                <?php echo $settings->title ?>
                            </h3>
                            <h4>
                                <?php echo $settings->address ?>
                            </h4>
                            <h4>
                                Tel: <?php echo $settings->phone ?>
                            </h4>
                            <img alt="" src="<?php echo $this->settings_model->getSettings()->logo; ?>" width="200" height="100">
                            <h4 style="font-weight: bold; margin-top: 20px; text-transform: uppercase;">
                                <?php echo lang('prescription') ?>
                                <hr style="width: 200px; border-bottom: 1px solid #000; margin-top: 5px; margin-bottom: 5px;">
                            </h4>
                        </div>

                        <style>

                            .panel-body {
                                padding: 15px;
                                background: #f1f1f1;
                            }

                            table{
                                box-shadow: none;
                            }

                            .table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td {
                                padding: 10px;
                                height: 100px;
                            }

                        </style>

                        <?php $patient = $this->patient_model->getPatientById($prescription->patient); ?>



                        <div class="col-md-12">
                            <div class="col-md-4 pull-left row" style="text-align: left;">
                                <div class="col-md-12 row details" style="">
                                    <p>
                                        <?php $patient_info = $this->db->get_where('patient', array('id' => $prescription->patient))->row(); ?>
                                        <label class="control-label"><?php echo lang('patient'); ?> <?php echo lang('name'); ?> </label>
                                        <span style="text-transform: uppercase;"> : 
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->name . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details" style="">
                                    <p>
                                        <label class="control-label"><?php echo lang('patient_id'); ?>  </label>
                                        <span style="text-transform: uppercase;"> : 
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->id . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details" style="">
                                    <p>
                                        <label class="control-label"><?php echo lang('patient'); ?> <?php echo lang('age'); ?>  </label>
                                        <span style="text-transform: uppercase;"> : 
                                            <?php
                                            $birthDate = strtotime($patient_info->birthdate);
                                            $birthDate = date('m/d/Y', $birthDate);
                                            $birthDate = explode("/", $birthDate);
                                            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                                            echo $age . ' Year(s)';
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details" style="">
                                    <p>
                                        <label class="control-label"> <?php echo lang('address'); ?> </label>
                                        <span style="text-transform: uppercase;"> : 
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->address . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details" style="">
                                    <p>
                                        <label class="control-label"><?php echo lang('phone'); ?>  </label>
                                        <span style="text-transform: uppercase;"> : 
                                            <?php
                                            if (!empty($patient_info)) {
                                                echo $patient_info->phone . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>


                            </div>

                            <div class="col-md-4 pull-left" style="text-align: left;">
                                <div class="col-md-12 row details" style="">
                                    <p>
                                        <label class="control-label"><?php echo lang('doctor'); ?> <?php echo lang('name'); ?> </label>
                                        <span style="text-transform: uppercase;"> : 
                                            <?php
                                            if (!empty($prescription->doctor)) {
                                                $doctor = $this->doctor_model->getDoctorById($prescription->doctor);
                                                echo $doctor->name;
                                            }
                                            ?>
                                        </span> 
                                    </p>
                                </div>
                                <div class="col-md-12 row details" style="">
                                    <p>
                                        <label class="control-label"><?php echo lang('profile'); ?>  </label>
                                        <span style="text-transform: uppercase;"> : 
                                            <?php
                                            if (!empty($doctor->profile)) {
                                                echo $doctor->profile . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-12 row details" style="">
                                    <p>
                                        <label class="control-label"><?php echo lang('phone'); ?>  </label>
                                        <span style="text-transform: uppercase;"> : 
                                            <?php
                                            if (!empty($doctor->phone)) {
                                                echo $doctor->phone . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-4 pull-right" style="text-align: left;">

                                <div class="col-md-12 row details" style="">
                                    <p>
                                        <label class="control-label"> <?php echo lang('prescription'); ?> <?php echo lang('id'); ?>  </label>
                                        <span style="text-transform: uppercase;"> : 
                                            <?php
                                            if (!empty($prescription->id)) {
                                                echo $prescription->id;
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>


                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('date'); ?>  </label>
                                        <span style="text-transform: uppercase;"> : 
                                            <?php
                                            if (!empty($prescription->date)) {
                                                echo date('d-m-Y', $prescription->date) . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>





                            </div>

                        </div>

                    </div>

                    <br>
                    <br>

                    <br>
                    <br>

                    <br>

                    <div class="col-md-12 panel-body clearfix">

                        <div class="col-md-12">
                            <div class="col-md-12">
                                <label class="control-label col-md-12"><?php echo lang('symptom'); ?></label>
                                <?php echo $prescription->symptom ?>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label col-md-12"><?php echo lang('note'); ?></label>
                                <?php echo $prescription->note ?>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <table class="table table-striped table-hover">                      
                                <thead>       
                                <th><?php echo lang('medicine'); ?></th>
                                <th><?php echo lang('instruction'); ?></th>
                                <th><?php echo lang('frequency'); ?></th>    
                                </thead>
                                <tbody>
                                    <?php
                                    $medicine = $prescription->medicine;
                                    $medicine = explode('###', $medicine);
                                    foreach ($medicine as $key => $value) {
                                        ?>
                                        <tr>
                                            <?php $single_medicine = explode('***', $value); ?>

                                            <td class=""><?php echo $this->medicine_model->getMedicineById($single_medicine[0])->name . ' - ' . $single_medicine[1]; ?> </td>
                                            <td class=""><?php echo $single_medicine[3] . ' - ' . $single_medicine[4]; ?> </td>
                                            <td class=""><?php echo $single_medicine[2] ?> </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>



                    <div class="text-center invoice-btn no-print">
                        <a class="btn btn-info btn-lg invoice_button" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- invoice end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

