
<div class="container estb-content">
	<div class="row ">
		<div class="col-lg-11">
			<div class="row">
				<div>
					<h1 class="estb-page-header"><?php echo $page_title; ?></h1>
				</div>
			</div>

			<div class="row">				
				<?php if( isset($note) ) { echo $note; }?>	
			</div>
			
			<?php 
			// appraisee's form
			if( isset($form_name) ) {
			    include __DIR__.'/../performance/'.$form_name.'.php';
			}?>
			
			<div class="row" id="appraisees-page">
				
	         <?php
	         if( isset($appraisees) && !empty($appraisees) ) {

        echo '<table border="1" class="table table-bordered table-hover">';
        echo "<br/>අගයුම්ලාභී ලැයිස්තුව ";
        
        $i = 1;
        echo "<tr class = 'estb-sub-header' >";
        echo "<td>NIC</td>";    
        echo "<td>වැටුප් වර්ධක  දිනය</td>";  
        echo "<td>ඇගයුම්ලාභියා  කාර්ය සාධන ඇගයීම සම්පුර්ණ කළ දිනය </td>"; 
        echo "<tr>";
        
    
        foreach ($appraisees as $r) {
            $i ++ ;
            echo "<tr>";
            echo "<td>" . $r->nic_no. "</td>"; 
            echo "<td>" . $r->increment_date . "</td>";                
            echo "<td>" . $r->appraisee_completed_date . "</td>";   
            echo "<td><a href = '".base_url()."index.php/performance_appraisal/appraiser_details/".$r->personal_file_id."/".$r->increment_date."' target='_blank' title='වැඩි විස්තර'>
            <i class='fas fa-info-circle estb-row-icon'></i><br/></a></td>";
            echo "<tr>";
        }
    }
    echo '</table>';
        ?>
	      
			</div>
		</div>
		<?php include __DIR__.'/../common/menu.php';?>
	</div>
</div>
<?php include __DIR__.'/../common/footer.php';?>