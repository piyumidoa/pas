
<div class="container estb-content">
	<div class="row ">
		<div class="col-lg-11">
			<div class="row">
				<div>
					<h1 class="estb-page-header"><?php echo $page_title; ?></h1>
				</div>
			</div>

			<div class="row">
				<!-- approved_vacancies add form -->
				
        <?php 
        
        if(in_array("14", $authlevel) ) {
        
         echo form_open(''.base_url().'index.php/dashboard/'.$form_action,
         array('method' => 'post', 'class' => 'form-horizontal'));                
         
         echo "<div class='form-group'>";
         echo "<label for='moderator'>ප්‍රමාණකරු</label>";
         echo "<input  class='form-control' type='text' name='moderator' placeholder='ජාතික හැදුනුම්‍පත් අංකය' ";
         if( isset($moderator) && !empty($moderator)) {
             echo "value='".$moderator."'";
         }
         echo ">";
         echo form_error('moderator');
         echo "</div>", "&nbsp";         
         
        echo "<div class='form-group'>";
        echo "<label for='appraiser'>අගැයුම්කරු</label>";
        echo "<input  class='form-control' type='text' name='appraiser' placeholder='ජාතික හැදුනුම්‍පත් අංකය' ";
        if( isset($appraiser) && !empty($appraiser)) {
            echo "value='".$appraiser."'";
        }
        echo ">";
        echo form_error('appraiser');
        echo "</div>", "&nbsp";
        
        echo "<div class='form-group'>";
        echo "<label for='appraisee'>ඇගයුම්ලාභියා </label>
              <table id='appraisee_list'>                
                <tr>
                <td><input type='text' class='form-control' name='appraisee[]'  placeholder='ජාතික හැදුනුම්‍පත් අංකය'></td>
                <td><span class='fa-stack fa-1x' onClick='addAppraiseeInput()'>
                      <i class='fas fa-square fa-stack-2x estb-row-icon'></i>
					  <i class='fas fa-plus fa-stack-1x fa-inverse'></i>
					</span></td>
                </tr>
              </table></div>
              ";
        echo form_error('appraisee');
        
        ?>	
	         <button type='submit' class='btn btn-default'>
                <i class="fas fa-check fa-1x" ></i>
			</button>
            <?php                     
                    if( isset($message) ) { echo $message; }
                     
                    echo '</form>';
        }   
            ?>
				
			</div>
				<!-- appraiser_and_moderator_list table -->
			
			<div class="row">
				<table border="1" class="table table-bordered table-hover">
	         <?php
	 if( isset($appraiser_and_moderator_list) && !empty($appraiser_and_moderator_list) ) {
        echo "ප්‍රතිඵල ගණන : ", $num_rows;
        
        $i = 1;
        echo "<tr class = 'estb-sub-1-header' >";
        echo "<td colspan='2'>ප්‍රමාණකරු</td>";
        echo "<td colspan='2'>අගැයුම්කරු </td>";        
        echo "<td colspan='3'>ඇගයුම්ලාභියා</td>";
        echo "<td> </td>";  
        echo "<tr>";
        
        echo "<tr class = 'estb-sub-header' >";
        echo "<td>නිලධාරියාගේ නම </td>";
        echo "<td>තනතුර</td>";
        echo "<td>නිලධාරියාගේ නම</td>";
        echo "<td>තනතුර</td>";
        echo "<td>ජාතික හැදුනුම්‍පත් අංකය </td>";
        echo "<td>නිලධාරියාගේ නම</td>";
        echo "<td>තනතුර</td>";
        echo "<td> </td>";
        echo "<tr>";
        
        foreach ($appraiser_and_moderator_list as $r) {
            
            echo "<tr>";
            echo "<td>" . $r->moderator_officer_name ."<br/>". $r->moderator_nic_no  . "</td>";
            echo "<td>" . $r->moderator_post_name . "</td>";
            echo "<td>" . $r->appraiser_officer_name ."<br/>" . $r->appraiser_nic_no. "</td>";
            echo "<td>" . $r->appraiser_post_name . "</td>";
            echo "<td>" . $r->nic_no . "</td>";
            echo "<td>" . $r->officer_name . "</td>";
            echo "<td>" . $r->post_name . "</td>";
            
            echo "<td><a href = '".base_url()."index.php/dashboard/appraiser_and_moderator/delete/".$r->personal_file_id."' title='මකන්න'>
                    <i class='fa fa-trash fa-1x estb-row-icon' ></i></a></td>";
            echo "<tr>";        
        }
    }
        ?>
	      </table>
			</div>
		</div>
		<?php include __DIR__.'/../common/menu.php';?>
	</div>
</div>
<?php include __DIR__.'/../common/footer.php';?>