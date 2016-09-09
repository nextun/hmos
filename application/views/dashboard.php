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
                    <h1 class="page-header">Dashboard</h1>
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
                    <?php if($this->session->userdata('usertype') == 'admin' || $this->session->userdata('usertype') == 'doctor'){ ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Create Token
                        </div>
                        <div class="panel-body">
                            <label><i class="fa fa-user"></i> Enter Patient ID</label>
                            <div class="form-group col-md-5 col-sm-8 input-group">
                                <input type="text" class="form-control" name="patient_id" id="patient_id">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="checknow"><i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <div class="form-group" id="result">

                            </div>
                        </div>

                    </div>

                    <?php } ?>

                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Tokens List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php if($this->session->flashdata('success_msg')){ ?>
                               <div class="alert alert-success">
                                    <?=$this->session->flashdata('success_msg');?>
                               </div>
                           <?php } ?>
                           <?php if($this->session->flashdata('error_msg')){ ?>
                               <div class="alert alert-warning">
                                    <?=$this->session->flashdata('error_msg');?>
                               </div>
                           <?php } ?>
                        <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Token</th>
                            <th>Patient</th>
                            <th>Added Date</th>
                            <th>Added Ward</th>
                            <th>Added Bed</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                          <?php
                            foreach ($tokens_list as $rows) {

                                echo	"<tr>
                                        <td>".$rows->tok_number."</td>
                                        <td>".$rows->tok_patient_id."</td>
                                        <td>".$rows->tok_added_time."</td>
                                        <td>".$rows->war_name."</td>
                                        <td>".$rows->bed_number."</td>
                                        <td>".$rows->tok_status."</td>
                                        <td>";
                                          if($this->session->userdata('usertype') == 'admin' || $this->session->userdata('usertype') == 'doctor'){
                                            echo "<a href='tokens/check/".$rows->tok_number."' class='btn btn-primary'>Edit</a>";
                                          }else{
                                            echo "<a href='tokens/check/".$rows->tok_number."' class='btn btn-primary'>View</a>";
                                          }
                                            echo "<a href='tokens/note/".$rows->tok_number."' class='btn btn-warning'>Note</a> </td>
                                        </tr>";

                            }
                            ?>
                        </tbody>
                        </table>
                        </div>
                        <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Drug Stock Level
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <?php
                                foreach ($drug_level as $drug_rows) {
                                    ?>

                                <div class="alert alert-danger">
                                    <i class="fa fa-tasks fa-fw"></i> Ward: <?=$drug_rows->war_name;?> : <?=$drug_rows->dru_name;?>
                                    <span class="pull-right text-muted small"><em><?=$drug_rows->quantity;?></em>
                                </div>
                               <?php
                               }
                                ?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

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
