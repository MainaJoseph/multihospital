
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-book"></i>  
            </header> 

            <div class="col-md-12">	

                <div class="col-md-8">
                    <h4 class="display-5">Product Information <span class="text-danger hidden-md-up" style="font-size: 15px;">* All fields are required</span></h4>

                    <form method="post" id="product_info" enctype="multipart/form-data" action="payu/check">                                                                  
                        <div class="form-group">                      
                            <input type="number"  name="payble_amount" id="payble_amount" class="form-control" placeholder="Enter Payble Amount" required />
                        </div>
                        <div class="form-group">
                            <input type="text" name="product_info" id="product_info" class="form-control"  Placeholder="Product info name" required />
                        </div>
                        <div class="form-group">                      
                            <input type="text"  name="customer_name" id="customer_name" class="form-control" placeholder="Full Name (Only alphabets)" required/>
                        </div>
                        <div class="form-group">                                   
                            <input type="number"  name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number(10 digits)" required/>
                        </div>
                        <div class="form-group">                                   
                            <input type="email"  name="customer_email" id="customer_email" class="form-control" placeholder="Email" required/>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="customer_address" id="customer_address" placeholder="Address" required></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                        </div>
                    </form>                 
                </div>

            </div>


        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->


