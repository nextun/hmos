<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hospital Management System</title>
    
    <?php $this->load->view('header');?>
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
                    <h1 class="page-header">Asign nurse to ward</h1>
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
                            <i class="fa fa-clock-o fa-fw"></i> Asign nurse
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
                                            <label>Nurse </label>
                                            <select  name="nurse_id" class="form-control" >
                                                <option value="">Select</option>
                                                <?php foreach($nurse_list as $nurse): ?>
                                                    <option value="<?=$nurse->id ;?>" <?php echo set_select('nurse_id', $nurse->id, FALSE); ?>><?=$nurse->nur_name ;?></option>
                                                <?php endforeach;?> 
            
                                            </select> 
                                        </div>
                                        <div class="form-group">
                                            <label>Ward</label>
                                             <select  name="ward_id" class="form-control" >
                                                <option value="">Select</option>
                                                <?php foreach($ward_list as $wards): ?>
                                                    <option value="<?=$wards->id ;?>" <?php echo set_select('ward_id', $wards->id, !empty($ward_id) && $ward_id==$wards->id ? TRUE : FALSE); ?>><?=$wards->war_name ;?></option>
                                                <?php endforeach;?> 
            
                                            </select>
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
