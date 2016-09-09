<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hospital Management System</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('dist/css/bootstrap.min.css');?>" rel="stylesheet">
    
     <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('dist/css/bootstrap-datetimepicker.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('dist/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url('dist/css/timeline.css');?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('dist/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url('dist/css/morris.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('dist/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

         
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Patient New</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">

                </div> 
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Add a patient
                        </div> 
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <?php if($this->session->flashdata('success_msg')){ ?>
                                <div class="alert alert-success">
                                     <?=$this->session->flashdata('success_msg');?>
                                </div>
                            <?php } ?>
                            <?=validation_errors();?>
                            <form role="form" action="" method="post">
                                        <div class="form-group">
                                            <label>Patient Name</label>
                                            <input class="form-control" type="text" name="pat_name" placeholder="Please enter name of the patient" value="<?php echo set_value('pat_name'); ?>">
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group ">
                                            <label>Date of birth</label> 
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control"  name="pat_date_of_birth"  value="<?php echo set_value('pat_date_of_birth'); ?>"/>
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar-o"></span>
                                                </span>
                                            </div>   
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input class="form-control" type="text" name="pat_mobile" placeholder="Please enter mobile" value="<?php echo set_value('pat_mobile'); ?>">
                                            <p class="help-block"></p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="pat_address" class="form-control"><?=set_value('pat_address');?></textarea>
                                            <p class="help-block"></p>
                                        </div>
                                         <div class="form-group">
                                         <button type="submit" class="btn btn-primary">Save</button>
                                         </div>
                            </form>
                        </div>
                         
                        <!-- /.panel-body --> 
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 --> 
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php $this->load->view('footer.php');?>  