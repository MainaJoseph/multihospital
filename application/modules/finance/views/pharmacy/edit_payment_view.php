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
                    echo lang('poss');
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
                                            padding-top: 20px;
                                            padding-bottom: 20px;
                                            border: none;

                                        }
                                        .pad_bot{
                                            padding-bottom: 10px;
                                        }  

                                        form{
                                            border: 1px solid #ccc;
                                            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
                                            background: transparent;
                                        }
                                        .pos{
                                            padding-left:0px;
                                        }
                                        .form-control{
                                            font-size: 14px;
                                            font-weight: 600;
                                            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
                                        }
                                    </style>

                                    <form role="form" class="clearfix pos form1"  id="editPaymentForm" action="finance/pharmacy/addPayment" method="post" enctype="multipart/form-data">
                                        <div class="col-md-6">     
                                            <?php if (!empty($payment->id)) { ?>
                                                <div class="col-md-8 payment pad_bot">
                                                    <div class="col-md-3 payment_label"> 
                                                        <label for="exampleInputEmail1">  <?php echo lang('invoice_id'); ?> :</label>
                                                    </div>
                                                    <div class="col-md-6">                                                   
                                                        <?php echo '00' . $payment->id; ?>                                                                                                       
                                                    </div>                                              
                                                </div>                                           
                                            <?php } ?>
                                            <div class="col-md-8 payment">
                                                <div class="form-group last">
                                                    <div class="col-md-3 payment_label"> 
                                                        <label for="exampleInputEmail1"> Select Item</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select name="category_name[]" id="" class="multi-select" multiple="" id="my_multi_select3" >
                                                            <?php foreach ($medicines as $medicine) { if($medicine->quantity > 0){ ?>
                                                                <option class="ooppttiioonn" data-id="<?php echo $medicine->id; ?>" data-s_price="<?php echo (float)$medicine->s_price; ?>" data-m_name = "<?php echo $medicine->name; ?>" data-c_name = "<?php echo $medicine->company; ?>" value="<?php echo $medicine->id; ?>"
                                                                <?php
                                                                if (!empty($payment->category_name)) {
                                                                    $category_name = $payment->category_name;
                                                                    $category_name1 = explode(',', $category_name);
                                                                    foreach ($category_name1 as $category_name2) {
                                                                        $category_name3 = explode('*', $category_name2);
                                                                        if ($category_name3[0] == $medicine->id) {

                                                                            echo 'data-qtity=' . $category_name3[2];
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
                                                                                if ($category_name3[0] == $medicine->id) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                        >

                                                                    <?php echo $medicine->name; ?>
                                                                </option>
                                                            <?php } }
                                                            ?>
                                                        </select>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 qfloww"><p><?php echo lang('selected_items'); ?></p></div>
                                        <div class="col-md-4 right-six">
                                            <div class="col-md-12 payment right-six">
                                                <div class="col-md-3 payment_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('sub_total'); ?></label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in" name="subtotal" id="subtotal" value='<?php
                                                    if (!empty($payment->amount)) {

                                                        echo $payment->amount;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div>
                                            <div class="col-md-12 payment right-six">
                                                <div class="col-md-3 payment_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('discount'); ?><?php
                                                        if ($discount_type == 'percentage') {
                                                            echo ' (%)';
                                                        }
                                                        ?> </label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in" name="discount" id="dis_id" value='<?php
                                                    if (!empty($payment->discount)) {
                                                        $discount = explode('*', $payment->discount);
                                                        echo $discount[0];
                                                    }
                                                    ?>' placeholder="Discount">
                                                </div>
                                            </div>

                                            <div class="col-md-12 payment right-six">
                                                <div class="col-md-3 payment_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('gross_total'); ?></label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in" name="grsss" id="gross" value='<?php
                                                    if (!empty($payment->gross_total)) {

                                                        echo $payment->gross_total;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div>
                                            <!--
                                            <div class="col-md-12 payment right-six">
                                                <div class="col-md-3 payment_label"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('amount_received'); ?></label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control pay_in" name="amount_received" id="amount_received" value='<?php
                                                    if (!empty($payment->amount_received)) {

                                                        echo $payment->amount_received;
                                                    }
                                                    ?>' placeholder=" ">
                                                </div>

                                            </div>
                                            -->

                                            <div class="col-md-12 payment right-six">
                                                <div class="col-md-12">
                                                    <div class="col-md-3"> 
                                                    </div>  
                                                    <div class="col-md-6"> 
                                                        <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                                                    </div>
                                                    <div class="col-md-3"> 
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

<!-- page end--><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<style>

    .remove{
        margin-bottom: 20px;
        width:40px
    }
</style>

<script>
    $(document).ready(function () {
        var tot = 0;
        $(".ms-selected").click(function () {
            var id = $(this).data('id');
            $('#id-div' + id).remove();
            $('#idinput-' + id).remove();
            $('#mediidinput-' + id).remove();

        });
        $.each($('select.multi-select option:selected'), function () {
            var unit_price = $(this).data('s_price');
            var id = $(this).data('id');
            var qtity = $(this).data('qtity');
            if ($('#idinput-' + id).length)
            {

            }
            else {
                if ($('#id-div' + id).length)
                {

                }
                else {

                    $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + id + '"> Name: ' + $(this).data("m_name") + '<br>price: ' + $(this).data('s_price') + '<br>quantity:</div>')
                }
                var input2 = $('<input>').attr({
                    type: 'text',
                    class: "remove",
                    id: 'idinput-' + id,
                    name: 'quantity[]',
                    value: qtity,
                }).appendTo('#editPaymentForm .qfloww');

                $('<input>').attr({
                    type: 'hidden',
                    class: "remove",
                    id: 'mediidinput-' + id,
                    name: 'medicine_id[]',
                    value: id,
                }).appendTo('#editPaymentForm .qfloww');
            }
            $(document).ready(function () {
                $('#idinput-' + id).keyup(function () {
                    var qty = 0;
                    var total = 0;
                    $.each($('select.multi-select option:selected'), function () {
                        var id1 = $(this).data('id');
                        qty = $('#idinput-' + id1).val();
                        var ekokk = $(this).data('s_price');
                        total = total + qty * ekokk;
                    });
                    tot = total;
                    var discount = $('#dis_id').val();
                    var gross = tot - discount;
                    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                    $('#editPaymentForm').find('[name="grsss"]').val(gross)
                });
            });
            var curr_val = $(this).data('s_price') * $('#idinput-' + id).val();
            tot = tot + curr_val;
        });
        var discount = $('#dis_id').val();
        var gross = tot - discount;
        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
        $('#editPaymentForm').find('[name="grsss"]').val(gross)
        //  });
    });
    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
            ggggg = amount - val_dis;
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
        });
    });

</script> 



<script>
    $(document).ready(function () {
        $('.multi-select').change(function () {
            var tot = 0;
            $(".ms-selected").click(function () {
                var id = $(this).data('id');
                $('#id-div' + id).remove();
                $('#idinput-' + id).remove();
                $('#mediidinput-' + id).remove();

            });
            $.each($('select.multi-select option:selected'), function () {
                var unit_price = $(this).data('s_price');
                var id = $(this).data('id');
                if ($('#idinput-' + id).length)
                {

                }
                else {
                    if ($('#id-div' + id).length)
                    {

                    }
                    else {

                        $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + id + '"> Name: ' + $(this).data("m_name") + '<br>Company:' + $(this).data("c_name") + '<br>price: ' + $(this).data('s_price') + '<br>quantity:</div>')
                    }
                    var input2 = $('<input>').attr({
                        type: 'text',
                        class: "remove",
                        id: 'idinput-' + id,
                        name: 'quantity[]',
                        value: '1',
                    }).appendTo('#editPaymentForm .qfloww');

                    $('<input>').attr({
                        type: 'hidden',
                        class: "remove",
                        id: 'mediidinput-' + id,
                        name: 'medicine_id[]',
                        value: id,
                    }).appendTo('#editPaymentForm .qfloww');
                }

                $(document).ready(function () {
                    $('#idinput-' + id).keyup(function () {
                        var qty = 0;
                        var total = 0;
                        $.each($('select.multi-select option:selected'), function () {
                            var id1 = $(this).data('id');
                            qty = $('#idinput-' + id1).val();
                            var ekokk = $(this).data('s_price');
                            total = total + qty * ekokk;
                        });

                        tot = total;

                        var discount = $('#dis_id').val();
                        var gross = tot - discount;
                        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                        $('#editPaymentForm').find('[name="grsss"]').val(gross)
                    });
                });
                var curr_val = $(this).data('s_price') * $('#idinput-' + id).val();
                tot = tot + curr_val;
            });
            var discount = $('#dis_id').val();
            var gross = tot - discount;
            $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
            $('#editPaymentForm').find('[name="grsss"]').val(gross)
        });
    });
    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
<?php if ($discount_type == 'percentage') { ?>
                ggggg = amount - amount * val_dis / 100;
<?php } ?>
<?php if ($discount_type == 'flat') { ?>
                ggggg = amount - val_dis;
<?php } ?>
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
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


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>