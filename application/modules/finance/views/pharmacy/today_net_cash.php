<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php  echo lang('pharmacy'); ?>  <?php echo lang('today_net_cash'); ?>  
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">

                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="">
                        <thead>
                            <tr>
                                <th> <?php echo lang('category'); ?> </th>
                                <th> <?php echo lang('amount'); ?> </th>

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


                        <tr class="">
                            <td> <?php echo lang('today_sales'); ?> </td>
                            <td>  <?php echo $settings->currency; ?>  <?php
                                if (!empty($today_sales_amount)) {
                                    echo number_format($today_sales_amount, 2, '.', ',');
                                } else {
                                    echo $today_sales_amount = 0;
                                }
                                ?> 
                            </td>

                        </tr>

                        <tr class="">
                            <td> <?php echo lang('today_expense'); ?> </td>
                            <td>  <?php echo $settings->currency; ?>  <?php
                                if (!empty($today_expenses_amount)) {
                                    echo number_format($today_expenses_amount, 2, '.', ',');
                                } else {
                                    echo $today_expenses_amount = 0;
                                }
                                ?> 
                            </td>


                        </tr>

                        <tr class="total">
                            <td> <?php echo lang('today_net_cash'); ?> </td>
                            <td>  <?php echo $settings->currency; ?> <?php echo number_format($today_sales_amount - $today_expenses_amount, 2, '.', ','); ?> </td>

                        </tr>



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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
