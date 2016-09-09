<?php
if($patient){ ?>
<form action="<?=base_url('tokens/generate_token');?>" method="post" >
<div class="alert alert-success">
                               <p><b>Patient Name :</b> <?php echo $patient->pat_name;?>
    </p>
    <p><b>Patient Date of Birth :</b> <?php echo $patient->pat_date_of_birth;?>
   
    </p>
                            </div>
<input type="hidden" id="pat_id" name="pat_id" value="<?=$patient->id;?>">
     <button type="submit" class="btn btn-outline btn-success" id="create" >Create</button>
</form>
<?php }else{ ?>

<div class="alert alert-warning">
    <p><?php echo $error;?></p>
</div>
    
<?php
}
?>
<!--
<script>
	$(document).ready(function(){
		$("#createsxx").on('click', function(){
            
			var base_url = "<?=base_url();?>"+"tokens/generate_token";
            $("#result").html('<img src="<?=base_url();?>/dist/imgs/magnify.gif" width="24">')
			 
			$.ajax({
	         type: "POST",
	         url: base_url, 
	         data: { "<?=$this->security->get_csrf_token_name(); ?>" : "<?=$this->security->get_csrf_hash(); ?>"
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
</script>-->