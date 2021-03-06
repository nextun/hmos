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

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('dashboard');?>">Hospital Management System</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                  
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                     <!-- Side bar-->
                    <?php $this->load->view('sidemenu'); ?>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Drugs stock edit</h1>
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
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Drug stock edit
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
                                            <label>Ward</label>
                                             <select  name="ward_id" class="form-control" >
                                                <option value="">Select</option>
                                                <?php foreach($ward_list as $wards): ?>
                                                    <option value="<?=$wards->id ;?>" <?php echo set_select('ward_id', $wards->id, $stock_list->ward_id==$wards->id ? TRUE : FALSE); ?>><?=$wards->war_name ;?></option>
                                                <?php endforeach;?> 
            
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            
                                            <label>Drugs</label>
                                            <select  name="drug_id" class="form-control" >
                                                <option value="">Select</option>
                                                <?php foreach($drugs_list as $drug): ?> 
                                                    <option value="<?=$drug->id;?>" <?php echo set_select('drug_id', $drug->id, $stock_list->drug_id==$drug->id ? TRUE : FALSE); ?>><?=$drug->dru_name;?></option>
                                                <?php endforeach;?>
                                            </select> 
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="drup_type" class="form-control" >
                                                <?php
                                                    $drug_type = array(
                                                        'tablet' => 'Tablet',
                                                        'capsule' => 'Capsule',
                                                        'milliliter' => 'Milliliter',
                                                        'milligrams' => 'Milligrams',
                                                    )
                                                ?>
                                                <?php foreach($drug_type as $type): ?> 
                                                    <option value="<?=$type[0];?>" <?php echo set_select('drug_id', $type[0], $stock_list->drug_id==$drug->id ? TRUE : FALSE); ?>><?=$drug->dru_name;?></option>
                                                <?php endforeach;?> 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input class="form-control" type="text" name="quantity" placeholder="Please enter drug quantity" value="<?php echo set_value('quantity',$stock_list->quantity); ?>">
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Min level</label>
                                            <input class="form-control" type="text" name="min_level" placeholder="Please enter drug min level" value="<?php echo set_value('min_level',$stock_list->min_level); ?>">
                                            <p class="help-block"></p>
                                        </div>
                                         <div class="form-group">
                                         <button type="submit" class="btn btn-primary">Update</button>
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
