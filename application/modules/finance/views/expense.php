<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                  <?php echo lang('expense'); ?> 
                <div class="col-md-4 no-print pull-right"> 
                    <a  href="finance/addExpenseView">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_expense'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('category'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('note'); ?></th>
                                <th><?php echo lang('amount'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
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

                        <?php foreach ($expenses as $expense) { ?>
                            <tr class="">
                                <td><?php echo $expense->category; ?></td>
                                <td> <?php echo date('d/m/y', $expense->date); ?></td>
                                <td> <?php echo $expense->note; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $expense->amount; ?></td>             

                                <td class="no-print">
                                    <a class="btn btn-info btn-xs invoicebutton" title="<?php echo lang('invoice'); ?>" href="finance/expenseInvoice?id=<?php echo $expense->id; ?>"><i class="fa fa-file-text"></i> </a>
                                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                                        <a class="btn btn-info btn-xs editbutton" title="<?php echo lang('edit'); ?>" href="finance/editExpense?id=<?php echo $expense->id; ?>"><i class="fa fa-edit"></i> </a>
                                        <a class="btn btn-info btn-xs delete_button" title="<?php echo lang('delete'); ?>" href="finance/deleteExpense?id=<?php echo $expense->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> </a>
                                    <?php } ?>
                                </td>

                            </tr>
                        <?php } ?>

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


<script src="common/js/codearistos.min.js"></script>
<script>
    $(document).ready(function () {
      var table = $('#editable-sample').DataTable({
            responsive: true,

            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3],
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
            "order": [[0, "desc"]],

           "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json" 
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
        
    });
</script>
