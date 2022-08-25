<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">
            <header class="panel-heading">
                <?php
                if (!empty($payment->id))
                    echo lang('edit_payment');
                else
                    echo lang('add_new_payment');
                ?>
            </header>
            <div class="">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <!--  <div class="col-lg-12"> -->
                        <div class="">
                           <!--   <section class="panel"> -->
                            <section class="">
                                <!--   <div class="panel-body"> -->
                                <div class="">
                                    <style> 
                                        .payment{
                                            padding-top: 10px;
                                            padding-bottom: 0px;
                                            border: none;

                                        }
                                        .pad_bot{
                                            padding-bottom: 5px;
                                        }  

                                        form{
                                            background: #f1f1f1;
                                            padding: 15px 0px;
                                        }

                                        .modal-body form{
                                            background: #fff;
                                            padding: 21px;
                                        }

                                        .remove{
                                            width: 20%;
                                            float: right;
                                            margin-bottom: 10px;
                                            padding: 10px;
                                            height: 39px;
                                            text-align: center;
                                            border-bottom: 1px solid #f1f1f1;
                                        }

                                        .remove1{
                                            width: 80%;
                                            float: left;
                                            margin-bottom: 10px;
                                            border-bottom: 1px solid #f1f1f1;
                                        }

                                        form input {
                                            border: none;
                                        }

                                        .pos_box_title{
                                            border: none;
                                        }

                                    </style>

                                    <form role="form" id="editPaymentForm" class="clearfix" action="finance/addPayment" method="post" enctype="multipart/form-data">

                                        <div class="col-md-5 row">
                                            <!--
                                            <div class="pull-right">
                                                <a data-toggle="modal" href="#myModal">
                                                    <div class="btn-group">
                                                        <button id="" class="btn green">
                                                            <i class="fa fa-plus-circle"></i> <?php echo lang('register_new_patient'); ?>
                                                        </button>
                                                    </div>
                                                </a>
                                            </div>
                                            -->

                                            <!--
                                            <div class="col-md-8 payment pad_bot">
                                                <div class="col-md-3 payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('date'); ?> </label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control  default-date-picker" name="date" id="" value='<?php
                                            if (!empty($payment->date)) {
                                                echo date('d-m-Y');
                                            } else {
                                                echo date('d-m-Y');
                                            }
                                            ?>' placeholder=" ">
                                                </div>

                                            </div>
                                            -->

                                            <div class="col-md-12 payment pad_bot panel">
                                                <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                                <h4>  <?php echo $patient->name; ?></h4>
                                                 <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('id'); ?></label>
                                                <h4>  <?php echo $patient->id; ?></h4>
                                                <input type="hidden" name="patient" value="<?php echo $patient->id; ?>">
                                            </div> 


                                            <div class="pos_client">
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="p_name" value='<?php
                                                    if (!empty($payment->p_name)) {
                                                        echo $payment->p_name;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="p_email" value='<?php
                                                    if (!empty($payment->p_email)) {
                                                        echo $payment->p_email;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="p_phone" value='<?php
                                                    if (!empty($payment->p_phone)) {
                                                        echo $payment->p_phone;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="p_age" value='<?php
                                                    if (!empty($payment->p_age)) {
                                                        echo $payment->p_age;
                                                    }
                                                    ?>' placeholder="">
                                                </div> 
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                                                    <select class="form-control m-bot15" name="p_gender" value=''>

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
                                            </div>

                                            <div class="col-md-12 payment pad_bot">
                                                <label for="exampleInputEmail1"> <?php echo lang('refd_by_doctor'); ?></label>
                                                <select class="form-control m-bot15 js-example-basic-single add_doctor" id="add_doctor" name="doctor" value=''>  
                                                    <option value=""><?php echo lang('select'); ?></option>
                                                    <option value="add_new" style="color: #41cac0 !important;"><?php echo lang('add_new'); ?></option>
                                                    <?php foreach ($doctors as $doctor) { ?>
                                                        <option value="<?php echo $doctor->id; ?>"<?php
                                                        if (!empty($payment->doctor)) {
                                                            if ($payment->doctor == $doctor->id) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo $doctor->name; ?> </option>
                                                            <?php } ?>
                                                </select>
                                            </div>

                                            <div class="pos_doctor">
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('name'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="d_name" value='<?php
                                                    if (!empty($payment->p_name)) {
                                                        echo $payment->p_name;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('email'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="d_email" value='<?php
                                                    if (!empty($payment->p_email)) {
                                                        echo $payment->p_email;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="col-md-6 payment pad_bot"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('phone'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="d_phone" value='<?php
                                                    if (!empty($payment->p_phone)) {
                                                        echo $payment->p_phone;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                            </div>



                                            <div class="col-md-12 payment">
                                                <div class="form-group last"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('select'); ?></label>
                                                    <select name="category_name[]" id="" class="multi-select" multiple="" id="my_multi_select3" >
                                                        <?php foreach ($categories as $category) { ?>
                                                            <option class="ooppttiioonn" data-id="<?php echo $category->c_price; ?>" data-idd="<?php echo $category->id; ?>" data-cat_name="<?php echo $category->category; ?>" value="<?php echo $category->category; ?>" 

                                                                    <?php
                                                                    if (!empty($payment->category_name)) {
                                                                        $category_name = $payment->category_name;
                                                                        $category_name1 = explode(',', $category_name);
                                                                        foreach ($category_name1 as $category_name2) {
                                                                            $category_name3 = explode('*', $category_name2);
                                                                            if ($category_name3[0] == $category->id) {
                                                                                echo 'data-qtity=' . $category_name3[3];
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>


                                                                    <?php
                                                                    if (!empty($payment->category_name)) {
                                                                        $category_name = $payment->category_name;
                                                                        $category_name1 = explode(',', $category_name);
                                                                        foreach ($category_name1 as $category_name2) {
                                                                            $category_name3 = explode('*', $category_name2);
                                                                            if ($category_name3[0] == $category->id) {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>><?php echo $category->category; ?></option>
                                                                <?php } ?>
                                                    </select>
                                                </div>

                                            </div>



                                        </div>


                                        <div class="col-md-4">


                                            <div class="col-md-12 qfloww">

                                                <label class=" col-md-10 pull-left remove1"><?php echo lang('items') ?></label><label class="pull-right col-md-2 remove"><?php echo lang('qty') ?></label>


                                            </div>

                                        </div>



                                        <div class="col-md-3">
                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('sub_total'); ?> </label>
                                                </div>
                                                <div class=""> 
                                                    <input type="text" class="form-control pay_in" name="subtotal" id="subtotal" value='<?php
                                                    if (!empty($payment->amount)) {

                                                        echo $payment->amount;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div>


                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('discount'); ?>  <?php
                                                        if ($discount_type == 'percentage') {
                                                            echo ' (%)';
                                                        }
                                                        ?> </label>
                                                </div>
                                                <div class=""> 
                                                    <input type="text" class="form-control pay_in" name="discount" id="dis_id" value='<?php
                                                    if (!empty($payment->discount)) {
                                                        $discount = explode('*', $payment->discount);
                                                        echo $discount[0];
                                                    }
                                                    ?>' placeholder="">
                                                </div>

                                            </div>

                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('gross_total'); ?> </label>
                                                </div>
                                                <div class=""> 
                                                    <input type="text" class="form-control pay_in" name="grsss" id="gross" value='<?php
                                                    if (!empty($payment->gross_total)) {

                                                        echo $payment->gross_total;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div>


                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('note'); ?> </label>
                                                </div>
                                                <div class=""> 
                                                    <input type="text" class="form-control pay_in" name="remarks" id="" value='<?php
                                                    if (!empty($payment->remarks)) {

                                                        echo $payment->remarks;
                                                    }
                                                    ?>' placeholder=" ">
                                                </div>

                                            </div>  

                                            <div class="col-md-12 payment right-six">

                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php
                                                        if (empty($payment)) {
                                                            echo lang('deposited_amount');
                                                        } else {
                                                            echo lang('deposit') . ' 1 <br>';
                                                            echo date('d/m/Y', $payment->date);
                                                        };
                                                        ?> </label>
                                                </div>

                                                <div class=""> 
                                                    <input type="text" class="form-control pay_in" name="amount_received" id="amount_received" value='<?php
                                                    if (!empty($payment->amount_received)) {

                                                        echo $payment->amount_received;
                                                    }
                                                    ?>' placeholder=" " <?php
                                                           if (!empty($payment->deposit_type)) {
                                                               if ($payment->deposit_type == 'Card') {
                                                                   echo 'readonly';
                                                               }
                                                           }
                                                           ?>>
                                                </div>

                                            </div>





                                            <?php if (empty($payment->id)) { ?>
                                                <div class="col-md-12 payment right-six">
                                                    <div class="payment_label"> 
                                                        <label for="exampleInputEmail1"><?php echo lang('deposit_type'); ?></label>
                                                    </div>
                                                    <div class=""> 
                                                        <select class="form-control m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''> 
                                                            <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                                                <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                                                <option value="Card"> <?php echo lang('card'); ?> </option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>

                                                    <?php
                                                    $payment_gateway = $settings->payment_gateway;
                                                    ?>

                                                    <?php
                                                    if ($payment_gateway == 'PayPal') {
                                                        ?>

                                                        <div class = "card">

                                                            <hr>
                                                            <div class="col-md-12 payment pad_bot">
                                                                <label for="exampleInputEmail1"> <?php echo lang('accepted'); ?> <?php echo lang('cards'); ?></label>
                                                                <div class="payment pad_bot">
                                                                    <img src="uploads/card.png" width="100%">
                                                                </div> 
                                                            </div>


                                                            <div class="col-md-12 payment pad_bot">
                                                                <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('type'); ?></label>
                                                                <select class="form-control m-bot15" name="card_type" value=''>

                                                                    <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>   
                                                                    <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                                                    <option value="American Express" > <?php echo lang('american_express'); ?> </option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-12 payment pad_bot">
                                                                <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                                                <input type="text" class="form-control pay_in" name="card_number" value='<?php
                                                                if (!empty($payment->p_email)) {
                                                                    echo $payment->p_email;
                                                                }
                                                                ?>' placeholder="">
                                                            </div>



                                                            <div class="col-md-8 payment pad_bot">
                                                                <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                                                <input type="text" class="form-control pay_in" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='<?php
                                                                if (!empty($payment->p_phone)) {
                                                                    echo $payment->p_phone;
                                                                }
                                                                ?>' placeholder="">
                                                            </div>
                                                            <div class="col-md-4 payment pad_bot">
                                                                <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?> </label>
                                                                <input type="text" class="form-control pay_in" maxlength="3" name="cvv_number" value='<?php
                                                                if (!empty($payment->p_age)) {
                                                                    echo $payment->p_age;
                                                                }
                                                                ?>' placeholder="">
                                                            </div> 

                                                        </div>

                                                        <?php
                                                    }
                                                    ?>

                                                </div> 
                                            <?php } ?>

                                            <?php
                                            if (!empty($payment)) {
                                                $deposits = $this->finance_model->getDepositByPaymentId($payment->id);
                                                $i = 1;
                                                foreach ($deposits as $deposit) {

                                                    if (empty($deposit->amount_received_id)) {
                                                        $i = $i + 1;
                                                        ?>
                                                        <div class="col-md-12 payment right-six">
                                                            <div class="payment_label"> 
                                                                <label for="exampleInputEmail1"><?php echo lang('deposit'); ?> <?php
                                                                    echo $i . '<br>';
                                                                    echo date('d/m/Y', $deposit->date);
                                                                    ?> 
                                                                </label>
                                                            </div>
                                                            <div class=""> 
                                                                <input type="text" class="form-control pay_in" name="deposit_edit_amount[]" id="amount_received" value='<?php echo $deposit->deposited_amount; ?>' <?php
                                                                if ($deposit->deposit_type == 'Card') {
                                                                    echo 'readonly';
                                                                }
                                                                ?>>
                                                                <input type="hidden" class="form-control pay_in" name="deposit_edit_id[]" id="amount_received" value='<?php echo $deposit->id; ?>' placeholder=" ">
                                                            </div>

                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>



                                            <div class="col-md-12 payment right-six">
                                                <div class="col-md-12 form-group">
                                                    <button type="submit" name="submit" class="btn btn-info pull-right row"><?php echo lang('submit'); ?></button>
                                                </div>
                                            </div>

                                        </div>








                                        <!--
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label"> 
                                              <label for="exampleInputEmail1">Vat (%)</label>
                                            </div>
                                            <div class="col-md-9"> 
                                              <input type="text" class="form-control pay_in" name="vat" id="exampleInputEmail1" value='<?php
                                        if (!empty($payment->vat)) {
                                            echo $payment->vat;
                                        }
                                        ?>' placeholder="%">
                                            </div>
                                        </div>
                                        -->

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($payment->id)) {
                                            echo $payment->id;
                                        }
                                        ?>'>
                                        <div class="row">
                                        </div>
                                        <div class="form-group">
                                        </div>

                                </div>
                                </form>





                        </div>
                        </section>
                    </div>
                </div>
            </div>
            </div>
        </section>

    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>


<style>
    
    .patient{
        background: #fff;
        padding: 10px;
    }
    
    
</style>


<!--

<script>
    $(document).ready(function () {
        $('.multi-select').change(function () {
            $(".qfloww").html("");
            var tot = 0;
            $.each($('select.multi-select option:selected'), function () {
                var curr_val = $(this).data('id');
                var idd = $(this).data('idd');
                tot = tot + curr_val;
                var cat_name = $(this).data('cat_name');
                $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + idd + '">  ' + $(this).data("cat_name") + '- <?php echo $settings->currency; ?> ' + $(this).data('id') + '</div><br>')
            });
            var discount = $('#dis_id').val();
<?php
if ($discount_type == 'flat') {
    ?>
                                                                                                                                                var gross = tot - discount;
<?php } else { ?>
                                                                                                                                                var gross = tot - tot * discount / 100;
<?php } ?>
            $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
            $('#editPaymentForm').find('[name="grsss"]').val(gross)
        }

        );


    });

    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
<?php
if ($discount_type == 'flat') {
    ?>
                                                                                                                                                ggggg = amount - val_dis;
<?php } else { ?>
                                                                                                                                                ggggg = amount - amount * val_dis / 100;
<?php } ?>
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
        });
    });

</script> 

<script>
    $(document).ready(function () {

        $(".qfloww").html("");
        var tot = 0;
        $.each($('select.multi-select option:selected'), function () {
            var curr_val = $(this).data('id');
            var idd = $(this).data('idd');
            tot = tot + curr_val;
            var cat_name = $(this).data('cat_name');
            $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + idd + '">  ' + $(this).data("cat_name") + '- <?php echo $settings->currency; ?> ' + $(this).data('id') + '</div><br>')
        });
        var discount = $('#dis_id').val();
<?php
if ($discount_type == 'flat') {
    ?>
                                                                                                                                            var gross = tot - discount;
<?php } else { ?>
                                                                                                                                            var gross = tot - tot * discount / 100;
<?php } ?>
        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
        $('#editPaymentForm').find('[name="grsss"]').val(gross)

    });

    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
<?php
if ($discount_type == 'flat') {
    ?>
                                                                                                                                                ggggg = amount - val_dis;
<?php } else { ?>
                                                                                                                                                ggggg = amount - amount * val_dis / 100;
<?php } ?>
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
        });
    });

</script> 

-->






<script>
    $(document).ready(function () {

        var tot = 0;
        //  $(".qfloww").html("");
        $(".ms-selected").click(function () {
            var idd = $(this).data('idd');
            $('#id-div' + idd).remove();
            $('#idinput-' + idd).remove();
            $('#categoryinput-' + idd).remove();

        });
        $.each($('select.multi-select option:selected'), function () {
            var curr_val = $(this).data('id');
            var idd = $(this).data('idd');
            var qtity = $(this).data('qtity');
            //  tot = tot + curr_val;
            var cat_name = $(this).data('cat_name');
            if ($('#idinput-' + idd).length)
            {

            } else {
                if ($('#id-div' + idd).length)
                {

                } else {
                    $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + idd + '">  ' + $(this).data("cat_name") + '- <?php echo $settings->currency; ?> ' + $(this).data('id') + '</div>')
                }


                var input2 = $('<input>').attr({
                    type: 'text',
                    class: "remove",
                    id: 'idinput-' + idd,
                    name: 'quantity[]',
                    value: qtity,
                }).appendTo('#editPaymentForm .qfloww');

                $('<input>').attr({
                    type: 'hidden',
                    class: "remove",
                    id: 'categoryinput-' + idd,
                    name: 'category_id[]',
                    value: idd,
                }).appendTo('#editPaymentForm .qfloww');
            }


            $(document).ready(function () {
                $('#idinput-' + idd).keyup(function () {
                    var qty = 0;
                    var total = 0;
                    $.each($('select.multi-select option:selected'), function () {
                        var id1 = $(this).data('idd');
                        qty = $('#idinput-' + id1).val();
                        var ekokk = $(this).data('id');
                        total = total + qty * ekokk;
                    });

                    tot = total;

                    var discount = $('#dis_id').val();
                    var gross = tot - discount;
                    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                    $('#editPaymentForm').find('[name="grsss"]').val(gross)

                    var amount_received = $('#amount_received').val();
                    var change = amount_received - gross;
                    $('#editPaymentForm').find('[name="change"]').val(change).end()


                });
            });
            var sub_total = $(this).data('id') * $('#idinput-' + idd).val();
            tot = tot + sub_total;


        });

        var discount = $('#dis_id').val();

<?php
if ($discount_type == 'flat') {
    ?>

            var gross = tot - discount;

<?php } else { ?>

            var gross = tot - tot * discount / 100;

<?php } ?>

        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()

        $('#editPaymentForm').find('[name="grsss"]').val(gross)

        var amount_received = $('#amount_received').val();
        var change = amount_received - gross;
        $('#editPaymentForm').find('[name="change"]').val(change).end()

    }

    );




    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
<?php
if ($discount_type == 'flat') {
    ?>
                ggggg = amount - val_dis;
<?php } else { ?>
                ggggg = amount - amount * val_dis / 100;
<?php } ?>
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)


            var amount_received = $('#amount_received').val();
            var change = amount_received - ggggg;
            $('#editPaymentForm').find('[name="change"]').val(change).end()

        });
    });



</script> 

<script>
    $(document).ready(function () {

        $('.multi-select').change(function () {
            var tot = 0;
            //  $(".qfloww").html("");
            $(".ms-selected").click(function () {
                var idd = $(this).data('idd');
                $('#id-div' + idd).remove();
                $('#idinput-' + idd).remove();
                $('#categoryinput-' + idd).remove();

            });
            $.each($('select.multi-select option:selected'), function () {
                var curr_val = $(this).data('id');
                var idd = $(this).data('idd');
                //  tot = tot + curr_val;
                var cat_name = $(this).data('cat_name');
                if ($('#idinput-' + idd).length)
                {

                } else {
                    if ($('#id-div' + idd).length)
                    {

                    } else {
                        $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + idd + '">  ' + $(this).data("cat_name") + '- <?php echo $settings->currency; ?> ' + $(this).data('id') + '</div>')
                    }


                    var input2 = $('<input>').attr({
                        type: 'text',
                        class: "remove",
                        id: 'idinput-' + idd,
                        name: 'quantity[]',
                        value: '1',
                    }).appendTo('#editPaymentForm .qfloww');

                    $('<input>').attr({
                        type: 'hidden',
                        class: "remove",
                        id: 'categoryinput-' + idd,
                        name: 'category_id[]',
                        value: idd,
                    }).appendTo('#editPaymentForm .qfloww');
                }


                $(document).ready(function () {
                    $('#idinput-' + idd).keyup(function () {
                        var qty = 0;
                        var total = 0;
                        $.each($('select.multi-select option:selected'), function () {
                            var id1 = $(this).data('idd');
                            qty = $('#idinput-' + id1).val();
                            var ekokk = $(this).data('id');
                            total = total + qty * ekokk;
                        });

                        tot = total;

                        var discount = $('#dis_id').val();
                        var gross = tot - discount;
                        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                        $('#editPaymentForm').find('[name="grsss"]').val(gross)

                        var amount_received = $('#amount_received').val();
                        var change = amount_received - gross;
                        $('#editPaymentForm').find('[name="change"]').val(change).end()


                    });
                });
                var sub_total = $(this).data('id') * $('#idinput-' + idd).val();
                tot = tot + sub_total;


            });

            var discount = $('#dis_id').val();

<?php
if ($discount_type == 'flat') {
    ?>

                var gross = tot - discount;

<?php } else { ?>

                var gross = tot - tot * discount / 100;

<?php } ?>

            $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()

            $('#editPaymentForm').find('[name="grsss"]').val(gross)

            var amount_received = $('#amount_received').val();
            var change = amount_received - gross;
            $('#editPaymentForm').find('[name="change"]').val(change).end()


        }

        );
    });

    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
<?php
if ($discount_type == 'flat') {
    ?>
                ggggg = amount - val_dis;
<?php } else { ?>
                ggggg = amount - amount * val_dis / 100;
<?php } ?>
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)


            var amount_received = $('#amount_received').val();
            var change = amount_received - ggggg;
            $('#editPaymentForm').find('[name="change"]').val(change).end()





        });
    });

</script> 





<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Patient Registration</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addNew?redirect=payment" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->



<script>
    $(document).ready(function () {
        $('.pos_client').hide();
        $(document.body).on('change', '#pos_select', function () {

            var v = $("select.pos_select option:selected").val()
            if (v == 'add_new') {
                $('.pos_client').show();
            } else {
                $('.pos_client').hide();
            }
        });

    });


</script>

<script>
    $(document).ready(function () {
        $('.pos_doctor').hide();
        $(document.body).on('change', '#add_doctor', function () {

            var v = $("select.add_doctor option:selected").val()
            if (v == 'add_new') {
                $('.pos_doctor').show();
            } else {
                $('.pos_doctor').hide();
            }
        });

    });


</script>

<script>
    $(document).ready(function () {
        $('.card').hide();
        $(document.body).on('change', '#selecttype', function () {

            var v = $("select.selecttype option:selected").val()
            if (v == 'Card') {
                $('.card').show();
            } else {
                $('.card').hide();
            }
        });

    });


</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



