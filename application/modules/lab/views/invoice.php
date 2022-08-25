<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- invoice start-->
        <section class="col-md-6">






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
                    margin-bottom: 10px;
                }




                .panel{
                    border: 0px solid #5c5c47;
                    background: #fff !important;
                    height: 100%;
                    margin: 20px 5px 5px 5px;
                    border-radius: 0px !important;
                    color: #777;

                }



                .table.main{
                    margin-top: -50px;
                }



                .control-label{
                    margin-bottom: 0px;
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



                .btn{
                    margin: 10px 10px 10px 0px;
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
                        margin-bottom: 10px;
                    }

                    .wrapper{
                        margin-top: 0px;
                    }

                    .wrapper{
                        padding: 0px 0px !important;
                        background: #fff !important;

                    }



                    .wrapper{
                        border: 2px solid #777;
                    }

                    .panel{
                        border: 0px solid #777;
                        background: #fff !important;
                        padding: 0px 0px;
                        margin: 5px 5px 5px 5px;
                        border-radius: 0px !important;
                        color: #777;

                    }



                    .table.main{
                        margin-top: -50px;
                    }



                    .control-label{
                        margin-bottom: 0px;
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

                    .site-min-height {
                        min-height: 950px;
                    }




                }

            </style>








            <div class="panel panel-primary" id="lab">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel-body" style="font-size: 10px;">
                    <div class="row invoice-list">

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
                                <?php echo lang('lab_report') ?>
                                <hr style="width: 200px; border-bottom: 1px solid #000; margin-top: 5px; margin-bottom: 5px;">
                            </h4>
                        </div>





                        <div class="col-md-12">
                            <div class="col-md-6 pull-left row" style="text-align: left;">
                                <div class="col-md-12 row details" style="">
                                    <p>
                                        <?php $patient_info = $this->db->get_where('patient', array('id' => $lab->patient))->row(); ?>
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

                            <div class="col-md-6 pull-right" style="text-align: left;">

                                <div class="col-md-12 row details" style="">
                                    <p>
                                        <label class="control-label"> <?php echo lang('lab'); ?> <?php echo lang('report'); ?> <?php echo lang('id'); ?>  </label>
                                        <span style="text-transform: uppercase;"> : 
                                            <?php
                                            if (!empty($lab->id)) {
                                                echo $lab->id;
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
                                            if (!empty($lab->date)) {
                                                echo date('d-m-Y', $lab->date) . ' <br>';
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>

                                <div class="col-md-12 row details">
                                    <p>
                                        <label class="control-label"><?php echo lang('doctor'); ?>  </label>
                                        <span style="text-transform: uppercase;"> : 
                                            <?php
                                            if (!empty($lab->doctor)) {
                                                $doctor_details = $this->doctor_model->getDoctorById($lab->doctor);
                                                if (!empty($doctor_details)) {
                                                    echo $doctor_details->name. '<br>';
                                                }
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <br>

                    </div> 


                    <div class="col-md-12 panel-body">
                        <?php
                        if (!empty($lab->report)) {
                            echo $lab->report;
                        }
                        ?>
                    </div>


                </div>
            </div>



        </section>


        <section class="col-md-6">

            <div class="col-md-5 no-print" style="margin-top: 20px;">
                <div class="text-center col-md-12 row">
                    <a href="lab" class="btn btn-info btn-sm info pull-left"><i class="fa fa-arrow-circle-left"></i>  <?php echo lang('back_to_lab_module'); ?> </a>
                    <a class="btn btn-info btn-sm invoice_button pull-left" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>

                    <a class="btn btn-info btn-sm detailsbutton pull-left download" id="download"><i class="fa fa-download"></i> <?php echo lang('download'); ?> </a>

                    <?php if ($this->ion_auth->in_group(array('admin', 'Laboratorist'))) { ?>
                        <a href="lab?id=<?php echo $lab->id; ?>" class="btn btn-info btn-sm blue pull-left"><i class="fa fa-edit"></i> <?php echo lang('edit_report'); ?> </a>
                    <?php } ?>


                </div>

                <?php if ($this->ion_auth->in_group(array('admin', 'Laboratorist'))) { ?>
                    <div class="no-print">


                        <a href="lab" class="pull-left">
                            <div class="btn-group">
                                <button id="" class="btn green btn-sm">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_a_new_report'); ?>
                                </button>
                            </div>
                        </a>
                    </div>
                <?php } ?>

            </div>











        </section>
        <!-- invoice end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>

<script>
                        $(document).ready(function () {
                            $(".flashmessage").delay(3000).fadeOut(100);
                        });
</script>





<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>

<script>


                        $('#download').click(function () {
                            var pdf = new jsPDF('p', 'pt', 'letter');
                            pdf.addHTML($('#lab'), function () {
                                pdf.save('lab_id_<?php echo $lab->id; ?>.pdf');
                            });
                        });

                        // This code is collected but useful, click below to jsfiddle link.
</script>
