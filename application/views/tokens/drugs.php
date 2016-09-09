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
<!-- DataTables CSS -->
    <link href="<?php echo base_url('dist/css/dataTables.bootstrap.css');?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url('dist/css/dataTables.responsive.css');?>" rel="stylesheet">

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
                    <h1 class="page-header">Add Drugs to Token</h1>
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
                    <div class="panel panel-primary  ">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Drugs to patient
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
                                            <label>Drug </label>
                                             <select  name="drug_id" class="form-control" >
                                                <option value="">Select</option>
                                                <?php foreach($drugs_list as $drugs): ?>
                                                    <option value="<?=$drugs->id ;?>" <?php echo set_select('drug_id' ); ?>><?=$drugs->dru_name ;?></option>
                                                <?php endforeach;?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Dose</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="timerate" id="daily" value="daily"  checked="">Daily dose
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="timerate" id="hourly" value="hourly">Hourly dose
                                            </label>
                                            <label class="radio-inline">
                                            <input class="form-control col-sm-3 col-md-3" type="text" name="drug_rate"   value="<?php echo set_value('drug_rate'); ?>">
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label>Drug Type </label>
                                             <select  name="drug_types" class="form-control" >
                                                <option value="">Select</option>
                                                <?php foreach($drugs_types as $drug_type): ?>
                                                    <option value="<?=$drug_type->id ;?>" <?php echo set_select('drug_types' ); ?>><?=$drug_type->type ;?></option>
                                                <?php endforeach;?>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input class="form-control" type="text" name="quantity" placeholder="Please enter quantity" value="<?=set_value('quantity'); ?>">
                                            <p class="help-block"></p>
                                        </div>

                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea name="note" class="form-control"><?=set_value('note');?></textarea>
                                            <p class="help-block"></p>
                                        </div>
                                         <div class="form-group">
                                         <button type="submit" class="btn btn-primary">Add</button>
                                         </div>
                            </form>

                        </div>

                        <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                        <!-- /.panel -->
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <i class="fa fa-clock-o fa-fw"></i> Drug List
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php if($this->session->flashdata('success_msg')){ ?>
                                   <div class="alert alert-success">
                                        <?=$this->session->flashdata('success_msg');?>
                                   </div>
                               <?php } ?>
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Drug</th>
                                <th>Time rate</th>
                                <th>Drug rate</th>
                                <th>Drug Type</th>
                                <th>Added Time</th>

                                <th>Note</th>
                            </tr>
                            </thead>
                            <tbody>

                              <?php
                                foreach ($token_drugs_list as $rows) {
                                    echo	"<tr>
                                            <td>".$rows->dru_name."</td>
                                            <td>".$rows->timerate."</td>
                                            <td>".$rows->per_time."</td>
                                            <td>".$rows->type."</td>
                                            <td>".$rows->added_date."</td>
                                            <td>".$rows->note."</td>
                                            <!--<td><a href='token/edit/".$rows->id."' class='btn btn-primary'>Edit</a> <a class='btn btn-info'>History</a> </td>-->
                                            </tr>";

                                }
                                ?>
                            </tbody>
                            </table>

                                <a href="<?=base_url('tokens/finish');?>" class="btn btn-default">Finished</a>

                                <a href="<?=base_url('tokens/admit');?>" class="btn btn-primary">Admit</a>

                            </div>


                            <!-- /.table-responsive -->

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
