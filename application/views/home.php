<div class="container estb-content">
	<div class="row">		
		<div class="col-lg-11">
			<h1 class="estb-page-header">			
			<p>ආයතන අංශය</p>			
			</h1>
			<p id="demo"></p>
			<div class="row">


				<?php 
				$authlevel = $this->session->userdata('authlevel');
					if(isset($authlevel)) {
						if(in_array("6", $authlevel)) { ?>

				<div class="col-lg-3 estb-tile">
					<a class= "estb-icon1"   href = "<?php echo base_url(); ?>index.php/personal_file" >
					<i class="fas fa-folder-open fa-3x" ></i><br/><p class="estb-icon-text" >පුද්ගලික ලිපි ගොනු</p>
					</a>
				</div>	
				<?php } }?>
			

				
				<div class="col-lg-3 estb-tile">
					<a class= "estb-icon3" href = "<?php echo base_url(); ?>index.php/profile">
					<i class="fas fa-user fa-3x"></i><br/><p class="estb-icon-text">පුද්ගලික ගොනුව </p>
					</a>
				</div>
				
				<div class="col-lg-3 estb-tile">
					<a class= "estb-icon1" href = "<?php echo base_url(); ?>index.php/performance_appraisal">
					<i class="fas fa-award fa-3x"></i><br/><p class="estb-icon-text">කාර්ය සාධන ඇගයීම</p>
					</a>
				</div>			
				
				<div class="col-lg-3 estb-tile">
					<a class= "estb-icon8" href = "<?php echo base_url(); ?>index.php/dashboard">
					<i class="fas fa-cog fa-3x"></i><br/><p class="estb-icon-text">සැකසුම් </p>
					</a>
				</div>	
				
				<div class="col-lg-3 estb-tile">
					<a class= "estb-icon5" href = "<?php echo base_url(); ?>index.php/logout">
					<i class="fas fa-sign-out-alt fa-3x"></i><br/><p class="estb-icon-text">ඉවත් වන්න </p>
					</a>
				</div>		
						
			</div>
		</div>		
	</div>
	
</div>
<?php include __DIR__.'/common/footer.php';?>