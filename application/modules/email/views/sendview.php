<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">
                    <?php echo lang('send_email'); ?>

                    <a href="email/sent" class='pull-right col-md-3'>
                        <button class="btn green pull-right">
                            <?php echo lang('list_of_sent_messages'); ?>
                        </button>
                    </a>

                </header>
                
                <div class="panel-body">  
                    <form role="form" class="clearfix" action="email/send" method="post">
                        <label class="control-label">         
                            <?php echo lang('send_email_to'); ?>
                        </label>    
                        <div class="radio">
                            <label>
                                <input type="radio" name="radio" id="optionsRadios1" value="allpatient">
                                <?php echo lang('all_patient'); ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="radio" id="optionsRadios2" value="alldoctor">
                                <?php echo lang('all_doctor'); ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="radio" id="optionsRadios2" value="bloodgroupwise">
                                <?php echo lang('donor'); ?> 
                            </label>
                        </div>


                        <div class="radio pos_client">
                            <label>
                                <?php echo lang('select_blood_group'); ?>
                                <select class="form-control m-bot15" name="bloodgroup" value=''>
                                    <?php foreach ($groups as $group) { ?>
                                        <option value="<?php echo $group->group; ?>"> <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                                </select>
                            </label>

                        </div>




                        <div class="radio">
                            <label>
                                <input type="radio" name="radio" id="optionsRadios2" value="single_patient">
                                <?php echo lang('single_patient'); ?>
                            </label>
                        </div>

                        <div class="radio single_patient">
                            <label>
                                <?php echo lang('select_patient'); ?>
                                <select class="form-control m-bot15 js-example-basic-single" name="patient" value=''>
                                    <?php foreach ($patients as $patient) { ?>
                                        <option value="<?php echo $patient->id; ?>"> <?php echo $patient->name; ?> </option>
                                    <?php } ?> 
                                </select>
                            </label>

                        </div>
                        
                        <div class="radio">
                            <label>
                                <input type="radio" name="radio" id="optionsRadios2" value="other">
                                <?php echo lang('others'); ?>
                            </label>
                        </div>
                        
                         <div class="radio other">
                            <label>
                                <?php echo lang('email'); ?> <?php echo lang('address'); ?>
                               <input type="email" name="other_email" value="" class="form-control">
                            </label>

                        </div>




                        <div class="form-group">
                            <label class="control-label"><?php echo lang('subject'); ?></label>
                            <input type="text" class="form-control" name="subject" rows="10">
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo lang('message'); ?></label>
                            <textarea class="ckeditor" name="message" value="" cols="70" rows="10"></textarea>
                        </div>
                        <input type="hidden" name="id" value=''>

                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info col-md-3 pull-right"><i class="fa fa-location-arrow"></i> <?php echo lang('send_email'); ?></button>
                        </div>

                    </form>
                </div>
            </section>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->








<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Send SMS To All Voter</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="email/sendVoter" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Message</label>
                        <textarea cols="50" rows="10" class="form-control" name="message" id="exampleInputEmail1" value=''> </textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Send SMS To Voters</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="email/sendVoterAreaWise" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Message</label>
                        <textarea cols="50" rows="10" class="form-control" name="message" id="exampleInputEmail1" value=''> </textarea>
                    </div>
                    <input type="hidden" id="area_id" value="" name="area_id">
                    <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Send SMS To All Volunteer</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="email/sendVolunteer" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Message</label>
                        <textarea cols="50" rows="10" class="form-control" name="message" id="exampleInputEmail1" value=''> </textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>







<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Send SMS To Volunteers</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="email/sendVolunteerAreaWise" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Message</label>
                        <textarea cols="50" rows="10" class="form-control" name="message" id="exampleInputEmail1" value=''> </textarea>
                    </div>
                    <input type="hidden" id="area_idd" value="" name="area_id">
                    <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">


    $(document).ready(function () {
        $(".voterAW").click(function () {
            $("#area_id").val($(this).attr('data-id'));
            $('#myModal2').modal('show');
        });
        $(".volunteerAW").click(function () {
            $("#area_idd").val($(this).attr('data-id'));
            $('#myModal4').modal('show');
        });
    });

</script>


<script>
    $(document).ready(function () {
        $('.pos_client').hide();
        $('input[type=radio][name=radio]').change(function () {
            if (this.value == 'bloodgroupwise') {
                $('.pos_client').show();
            } else {
                $('.pos_client').hide();
            }
        });

    });


</script> 

<script>
    $(document).ready(function () {
        $('.single_patient').hide();
        $('input[type=radio][name=radio]').change(function () {
            if (this.value == 'single_patient') {
                $('.single_patient').show();
            } else {
                $('.single_patient').hide();
            }
        });

    });


</script> 

<script>
    $(document).ready(function () {
        $('.other').hide();
        $('input[type=radio][name=radio]').change(function () {
            if (this.value == 'other') {
                $('.other').show();
            } else {
                $('.other').hide();
            }
        });

    });


</script> 


<script>
    $(document).ready(function () {
        $('.staff').hide();
        $('input[type=radio][name=radio]').change(function () {
            if (this.value == 'staff') {
                $('.staff').show();
            } else {
                $('.staff').hide();
            }
        });

    });


</script> 


<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>