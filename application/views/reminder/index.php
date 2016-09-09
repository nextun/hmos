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
                    <h1 class="page-header">Reminders</h1>
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
                    <div class="panel panel-default">
                      <div class="panel-heading">
                          <i class="fa fa-clock-o fa-fw"></i> Reminder List
                      </div>
                      <!-- /.panel-heading -->
                      <div class="panel-body">
                          <ul class="timeline">

                            <?php
                             foreach ($next_drugs as $key =>   $drugs){

                                foreach ($drugs as $key =>   $drug){

                                 ?>
                                    <li>
                                        <div class="timeline-badge"><i class="fa fa-check"></i>
                                        </div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title"> <i class="fa fa-clock-o"></i> <?=$drug['next_time'];?></h4>
                                                <p><small class="text-muted"><?=$drug['dru_name'];?></small>
                                                </p>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Token ID : <?=$drug['token_id'];?></br>
                                                Time rate : <?=$drug['timerate'];?></br>
                                                Drugs <?=$drug['timerate'];?> : <?=$drug['per_time'];?></br>
                                                 <?=$drug['quantity'];?> <?=$drug['type'];?></br>

                                                Added time  : <?=$drug['added_date'];?></br>
                                              time_range : <?=$drug['time_range'];?></br>
                                              Now  : <?=$drug['now'];?></br>
                                              Next : <?=$drug['next'];?>
                                            </p>
                                            <div class="btn-group open">
                                                      <a href="reminder/update/<?=$drug['token_drug_id'];?>" class="btn btn-primary btn-sm  " >
                                                          <i class="fa fa-gear"></i> Update</span>
                                                      </a>
                                                  </div>
                                            </div>
                                        </div>
                                    </li>
                                  <?php
                                } 

                         } ?>
                          </ul>
                      </div>
                      <!-- /.panel-body -->
                  </div>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">

                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php $this->load->view('footer.php');?>

<script>
	$(document).ready(function(){
		$("#checknow").on('click', function(){

			var base_url = "<?=base_url();?>"+"tokens/checkpatient";
            $("#result").html('<img src="<?=base_url();?>/dist/imgs/magnify.gif" width="24">')

			$.ajax({
	         type: "POST",
	         url: base_url,
	         data: {
                "patient_id": $('#patient_id').val(),
                "<?=$this->security->get_csrf_token_name(); ?>" : "<?=$this->security->get_csrf_hash(); ?>"
                 },
	         dataType: "html",
	         cache:false,
	         success:
	              function(data){
	                $("#result").html(data);
	              },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
              }
	          });
	     return false;
		})
	});
</script>


</body>
</html>
