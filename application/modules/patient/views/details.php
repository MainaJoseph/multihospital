<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="">
            <!-- page start-->
            <div class="row">
                <aside class="profile-nav col-lg-3">
                    <section class="panel">
                        <div class="user-heading round">
                            <a>
                                <img src="<?php echo $patient->img_url ?>" alt="">
                            </a>
                            <h1><?php echo $patient->name ?></h1>
                         <!--   <p><?php echo $patient->email ?></p> -->
                        </div>
                    </section>
                </aside>

                <style>

                    .bio-row {
                        width: 50%;
                        float: none;
                        margin-bottom: 10px;
                        padding: 15px;
                        border: 2px solid #f1f1f1;
                    }

                    .bio-graph-info {
                        color: #89817e;
                        padding: 23px;
                    }

                </style>

                <aside class="profile-info col-lg-9">
                    <section class="panel">
                        <div class="bio-graph-heading">
                            <?php echo lang('doctor'); ?> : <?php echo $this->doctor_model->getDoctorById($patient->doctor)->name; ?>
                        </div>
                        <div class="bio-graph-info">
                            <h1>Bio Graph</h1>
                            <div class="row">
                                <div class="bio-row">
                                    <p><span><?php echo lang('name'); ?> </span>: <?php echo $patient->name; ?></p>
                                </div>

                                <div class="bio-row">
                                    <p><span><?php echo lang('email'); ?> </span>: <?php echo $patient->email; ?></p>
                                </div>

                                <div class="bio-row">
                                    <p><span><?php echo lang('address'); ?></span>: <?php echo $patient->address; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('phone'); ?> </span>: <?php echo $patient->phone; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('sex'); ?> </span>: <?php echo $patient->sex; ?></p>
                                </div>

                                <div class="bio-row">
                                    <p><span><?php echo lang('birth_date'); ?> </span>: <?php echo $patient->birthdate; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('blood_group'); ?> </span>: <?php echo $patient->bloodgroup; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('age'); ?></span>: 
                                        <?php
                                        $birthDate = strtotime($patient->birthdate);
                                        $birthDate = date('m/d/Y', $birthDate);
                                        $birthDate = explode("/", $birthDate);
                                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                                        echo $age . ' Year(s)';
                                        ?>
                                    </p>
                                </div>

                                <div class="bio-row">
                                    <p>
                                        <span><?php echo lang('doctor'); ?> </span>:
                                        <?php
                                        echo $this->doctor_model->getDoctorById($patient->doctor)->name;
                                        ?>
                                    </p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('patient_id'); ?> </span>: <?php echo $patient->id; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
