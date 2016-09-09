
<!-- jQuery -->
    <script src="<?=base_url('dist/js/jquery.min.js');?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url('dist/js/bootstrap.min.js');?>"></script>
     
     <!-- moment JavaScript -->
    <script src="<?=base_url('dist/js/moment.js');?>"></script>
    
     <!-- bootstrap-datetimepicker  Core JavaScript -->
    <script src="<?=base_url('dist/js/bootstrap-datetimepicker.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url('dist/js/metisMenu.min.js');?>"></script>

    <!-- Morris Charts JavaScript  
    <script src="<?=base_url('dist/js/raphael-min.js');?>"></script>
    <script src="<?=base_url('dist/js/morris.min.js');?>"></script>
    <script src="<?=base_url('dist/js/orris-data.js');?>"></script>
                       
                                                                    -->
    <script src="<?=base_url('dist/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?=base_url('dist/js/dataTables.bootstrap.min.js');?>"></script>
     
    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url('dist/js/sb-admin-2.js');?>"></script>
    
    <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    format: 'YYYY-MM-DD',
                    maxDate: new Date()
                });
            });
        </script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

