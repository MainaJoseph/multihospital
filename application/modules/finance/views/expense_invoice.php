<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- invoice start-->
        <section>
            <div class="panel panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel-body col-md-5" id="invoice" style="font-size: 10px;">
                    <div class="row invoice-list">

                        <div class="text-center corporate-id">
                            <h1>
                                <?php echo $settings->title ?>
                            </h1>
                            <h4>
                                <?php echo $settings->address ?>
                            </h4>
                            <h4>
                                Tel: <?php echo $settings->phone ?>
                            </h4>
                        </div>

                        <div class="col-lg-4 col-sm-4">
                            <h4><?php echo lang('bill_to'); ?>:</h4>
                            <p>
                                <?php echo $settings->title; ?> <br>
                                <?php echo $settings->address; ?><br>
                                Tel:  <?php echo $settings->phone; ?>
                            </p>
                        </div>



                        <div class="col-lg-4 col-sm-4">
                            <h4><?php echo lang('invoice_info'); ?></h4>
                            <ul class="unstyled">
                                <li>Invoice Number		: <strong>000<?php echo $expense->id; ?></strong></li>
                                <li>Date		: <?php echo date('m/d/Y', $expense->date); ?></li>
                            </ul>
                        </div>
                        <br>
                        <?php if (!empty($payment->doctor)) { ?>
                            <span><strong>Referred By Doctor:</strong></span> <span><?php echo $this->db->get_where('doctor', array('id' => $payment->doctor))->row()->name ?></span>
                        <?php } ?>
                    </div>




                    <table class="table table-striped table-hover">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('note'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                            </tr>
                        </thead>

                        <tbody>


                            <tr>
                                <td><?php echo '1'; ?></td>
                                <td><?php echo $expense->category; ?> </td>
                                <td><?php echo $expense->note; ?> </td>
                                <td class=""><?php echo $settings->currency; ?> <?php echo $expense->amount; ?> </td>
                            </tr> 



                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-4 invoice-block pull-right">
                            <ul class="unstyled amounts">
                                <li><strong><?php echo lang('sub_total'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $expense->amount; ?></li>
                                <li><strong><?php echo lang('grand_total'); ?> : </strong><?php echo $settings->currency; ?> <?php echo $expense->amount; ?></li>
                            </ul>
                        </div>
                    </div>





                </div>

                <div class="col-md-6" class="" style="font-size: 10px; float: right;">


                    <div class="text-center invoice-btn clearfix">
                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                            <a href="finance/editExpense?id=<?php echo $expense->id; ?>" class="btn btn-info btn-sm invoice_button pull-left"><i class="fa fa-edit"></i> Edit Invoice </a>
                        <?php } ?>
                    </div>

                    <div class="text-center invoice-btn clearfix">
                        <a class="btn btn-info btn-sm invoice_button pull-left" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>                        
                    </div>

                    <div class="text-center invoice-btn clearfix">           
                        <a class="btn btn-info btn-sm invoice_button pull-left download pull-left" id="download"><i class="fa fa-download"></i> <?php echo lang('download'); ?> </a>
                    </div>

                    <div class="no-prin clearfix">


                        <a href="finance/addexpenseView">
                            <div class="btn-group pull-left">
                                <button id="" class="btn green btn-sm">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('add_expense'); ?>
                                </button>
                            </div>
                        </a>
                    </div>

                </div>








            </div>
        </section>
        <!-- invoice end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>

<script>


                            $('#download').click(function () {
                                var pdf = new jsPDF('p', 'pt', 'letter');
                                pdf.addHTML($('#invoice'), function () {
                                    pdf.save('invoice_id_<?php echo $expense->id; ?>.pdf');
                                });
                            });

                            // This code is collected but useful, click below to jsfiddle link.
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
