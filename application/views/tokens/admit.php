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
                    <h1 class="page-header">Admit to ward</h1>
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
                            <i class="fa fa-clock-o fa-fw"></i> Set a bed
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
                                            <label>Ward  </label>
                                             <select  name="ward_id" id="ward_id" class="form-control" >
                                                <option value="">Select</option>
                                                <?php foreach($ward_list as $wards): ?>
                                                    <option value="<?=$wards->id ;?>" <?php echo set_select('ward_id'); ?>><?=$wards->war_name ;?></option>
                                                <?php endforeach;?> 
            
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Bed  </label>
                                             <select  name="bed_id" id="bed_id" class="form-control" >
                                                <option value="">Select</option> 
                                            </select>
                                        </div>
                                        
                                         <div class="form-group">
                                         <button type="submit" class="btn btn-primary">Set</button>
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
<script> 
	$(document).ready(function(){
    $('#ward_id').change(function(){
        var base_url = "<?=base_url();?>"+"tokens/get_beds";
            $.ajax({
                type: "POST",
                url: base_url, 
                data:{"ward_id": $('#ward_id').val(),
                "<?=$this->security->get_csrf_token_name(); ?>" : "<?=$this->security->get_csrf_hash(); ?>"
                 },
                dataType: "html",  
                cache:false,
                success: 
                     function(data){ 
                       $("#bed_id").html(data); 
                     },
                error: function (xhr, ajaxOptions, thrownError) {
                   alert(xhr.status);
                   alert(thrownError);
                 }
            });
        });
    });
</script>
</body>
</html>