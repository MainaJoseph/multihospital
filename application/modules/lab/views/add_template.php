<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel col-md-7">
            <header class="panel-heading no-print">
                <?php
                if (!empty($template->id))
                    echo lang('edit_lab_report') . ' ' . lang('template');
                else
                    echo lang('add_lab_report') . ' ' . lang('template');
                ?>
            </header>
            <div class="no-print row">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <style> 
                            .lab{
                                padding-top: 10px;
                                padding-bottom: 20px;
                                border: none;

                            }
                            .pad_bot{
                                padding-bottom: 5px;
                            }  

                            form{
                                background: #ffffff;
                                padding: 18px 14px;
                            }

                            .modal-body form{
                                background: #fff;
                                padding: 21px;
                            }

                            .remove{
                                float: right;
                                margin-top: -45px;
                                margin-right: 42%;
                                margin-bottom: 41px;
                                width: 94px;
                                height: 29px;
                            }

                            .remove1 span{
                                width: 33%;
                                height: 50px !important;
                                padding: 10px

                            }

                            .qfloww {
                                padding: 10px 0px;
                                height: 370px;
                                background: #f1f2f9;
                                overflow: auto;
                            }

                            .remove1 {
                                background: #5A9599;
                                color: #fff;
                                padding: 5px;
                            }


                            .span2{
                                padding: 6px 12px;
                                font-size: 14px;
                                font-weight: 400;
                                line-height: 1;
                                color: #555;
                                text-align: center;
                                background-color: #eee;
                                border: 1px solid #ccc
                            }

                        </style>

                        <form role="form" id="editLabForm" class="clearfix" action="lab/addTemplate" method="post" enctype="multipart/form-data">
                            <div class="col-md-12 lab pad_bot row">
                                <div class="col-md-3 lab_label"> 
                                    <label for="exampleInputEmail1"> <?php echo lang('template'); ?> <?php echo lang('name'); ?></label>
                                </div>
                                <div class="col-md-9"> 
                                    <input type="text" class="form-control pay_in" name="name" value='<?php
                                    if (!empty($template->name)) {
                                        echo $template->name;
                                    }
                                    ?>' placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12 lab pad_bot row">
                                <div class="col-md-3"> 
                                    <label for="exampleInputEmail1"> <?php echo lang('template'); ?> </label>
                                </div>
                                <div class="col-md-9"> 
                                    <textarea class="ckeditor form-control" name="template" value="" rows="10"><?php
                                        if (!empty($setval)) {
                                            echo set_value('template');
                                        }
                                        if (!empty($template->template)) {
                                            echo $template->template;
                                        }
                                        ?>
                                    </textarea>
                                </div>
                            </div>

                            <input type="hidden" name="id" value='<?php
                            if (!empty($template->id)) {
                                echo $template->id;
                            }
                            ?>'>


                            <div class="col-md-12"> 
                                <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>


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
                        border: 2px solid #802f00;
                    }

                    .panel{
                        border: 0px solid #5c5c47;
                        background: #fff !important;
                        padding: 0px 0px;
                        height: 100%;
                        margin: 5px 5px 5px 5px;
                        border-radius: 0px !important;
                        min-height: 1010px;

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
                }

            </style>
        </section>
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>

