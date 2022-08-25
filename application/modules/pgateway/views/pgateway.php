<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7 row"> 
            <header class="panel-heading">
                <?php echo lang('payment_gateways'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class=" panel clearfix"> 
                        <button class="export" onclick="javascript:window.print();">Print</button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            $i = 0;
                            foreach ($pgateways as $pgateway) {
                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td><?php echo $i; ?></td>
                                    <td><?php
                                        if (!empty($pgateway->name)) {
                                            echo $pgateway->name;
                                        }
                                        ?></td>

                                    <td>
                                        <a class="btn btn-info btn-xs btn_width" href="pgateway/settings?id=<?php echo $pgateway->id; ?>">  <i class="fa fa-"> </i> <?php echo lang('manage'); ?></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


        <section class="col-md-5"> 
            <header class="panel-heading">
                <?php echo lang('select'); ?> <?php echo lang('payment_gateway'); ?> 
            </header>
            <div class="panel-body">
                <form role="form" id="editAppointmentForm" action="settings/selectPaymentGateway" class="clearfix" method="post" enctype="multipart/form-data">

                   
                        <?php foreach ($pgateways as $pgateway) { ?>
                             <div class="form-group">
                                <input type="radio" class=""  readonly="" name="payment_gateway" id="exampleInputEmail1" value='<?php echo $pgateway->name; ?>' placeholder="" <?php
                                if (!empty($pgateway->name)) {
                                    if ($settings->payment_gateway == $pgateway->name) {
                                        echo 'checked';
                                    }
                                }
                                ?>> <?php echo $pgateway->name; ?>
                             </div>
                        <?php } ?>
                  

                    <input type="hidden" name="id" value="<?php echo $settings->id; ?>">

                    <div class="col-md-12 panel">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </section>

        <!-- page end-->
    </section>
</section>
<!--main content end-->



<style>


    input[type=radio], input[type=checkbox]{
        height: auto !important;
    }

</style>

<script src="common/js/codearistos.min.js"></script>

<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
