<div class="row"> 
<!-- menu buttons row  -->
    <div class="col-lg-2 page-menu-item"> 
    <i class='fas fa-print fa-2x estb-page-icon' onclick='printPage("printable-page")' title='මුද්‍රණය කරන්න'></i>
    </div>
</div>

<div class="row" id="printable-page">	
		<?php
		
		  echo form_open(base_url().'index.php/performance_appraisal/'.$form_action, array('method' => 'post', 'class' => 'form-horizontal'));
		    
		    echo '<input type="hidden" name="nic_no" value="'.$nic_no.'">';
		    echo '<input type="hidden" name="increment_date" value="'.$increment_date.'">';
		    echo '<input type="hidden" name="post" value="'.$post.'">';
		    echo '<input type="hidden" name="form_name" value="'.$form_name.'">';
		    if( isset($appraisee_id)) {
		        echo '<input type="hidden" name="appraisee_id" value="'.$appraisee_id.'">';
		    }
		
		    echo "following need to be filled by the appraisee ----------------------------------------------------------------------";
            echo "<div class='form-group'>";
            echo "<label  for='nic_no'>ජාතික හැදුනුම්‍පත් අංකය</label>";
            echo "<input  class='form-control' type='text'  name='nic_no'  value='".$nic_no."' disabled >";
            echo "</div>", "&nbsp";
            
            echo "<div class='form-group'>";
            echo "<label  for='increment_date'>වැටුප් වර්ධක  දිනය</label>";
            echo "<input  class='form-control' type='date'  name='increment_date' value='".$increment_date."' disabled >";
            echo "</div>", "&nbsp";
            
            echo "<div class='form-group'>";
            echo "<label for='appraisee_feedback'>ඇගයුම්ලාභියාගේ ඇගයීම</label>";
            echo "<select class='form-control' id='appraisee_feedback' name='appraisee_feedback' >";
            foreach ($feedback_options as $key=>$value) {
                echo "<option value=", "$key";
                echo (isset($appraisee_feedback) && $appraisee_feedback == $key) ?  ' selected' : ' ';
                echo ">", "$value", "</option>";
            }
            echo "</select>";
            echo form_error('appraisee_feedback');
            echo "</div>", "&nbsp";     
            
        if( isset($appraisee_completed_date)) {
            
            echo "<div class='form-group'>";
            echo "<label  for='appraisee_completed_date'>appraisee_completed_date</label>";
            echo "<input  class='form-control' type='date'  name='appraisee_completed_date' value='".$appraisee_completed_date."' >";
            echo "</div>", "&nbsp";
        }            
        
        echo "follwoing need to be filled by the appraiser ----------------------------------------------------------------------";
        
            echo "<div class='form-group'>";
            echo "<label for='appraiser_feedback'>අගැයුම්කරුගේ ඇගයීම</label>";
            echo "<select class='form-control' id='appraiser_feedback' name='appraiser_feedback' >";
            foreach ($feedback_options as $key=>$value) {
                echo "<option value=", "$key";
                echo (isset($appraiser_feedback) && $appraiser_feedback == $key) ?  ' selected' : ' ';
                echo ">", "$value", "</option>";
            }
            echo "</select>";
            echo form_error('appraiser_feedback');
            echo "</div>", "&nbsp";
            
            if( isset($appraiser_completed_date)) {
                
                echo "<div class='form-group'>";
                echo "<label  for='appraiser_completed_date'>appraiser_completed_date</label>";
                echo "<input  class='form-control' type='date'  name='appraiser_completed_date' value='".$appraiser_completed_date."' >";
                echo "</div>", "&nbsp";
            } 
            
echo "<p>Moderator to Complete  --------------------------------------------------------------------------------------------</p>";
            
            echo "<div class='form-group'>";
            echo "<label for='moderator_feedback'>ප්‍රමාණකරුගේ ඇගයීම</label>";
            echo "<select class='form-control' name='moderator_feedback' >";
            foreach ($feedback_options as $key=>$value) {
                echo "<option value=", "$key";
                echo (isset($moderator_feedback) && $moderator_feedback == $key) ?  ' selected' : ' ';
                echo ">", "$value", "</option>";
            }
            echo "</select>";
            echo form_error('moderator_feedback');
            echo "</div>", "&nbsp";
            
            if( isset($moderator_completed_date)) {
                
                echo "<div class='form-group'>";
                echo "<label  for='moderator_completed_date'>moderator_completed_date</label>";
                echo "<input  class='form-control' type='date'  name='moderator_completed_date' value='".$moderator_completed_date."' >";
                echo "</div>", "&nbsp";
            }

            if( isset($form_action) && $form_action != 'NA') {
            echo "<button type='submit' class='btn btn-default' >
                    <i class='fas fa-save fa-1x' ></i> ".$btn_text."      
		          </button>";
        }
		    echo "</from><br/>";
      
		if( isset($message) ) { echo $message; } 
		  ?>
</div>