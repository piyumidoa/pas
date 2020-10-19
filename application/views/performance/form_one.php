<div class="row">				
				<?php
            echo form_open(''.base_url().'index.php/performance_appraisal/add_recipient_details', array('method' => 'post', 'class' => 'form-horizontal'));
            
            echo "<div class='form-group'>";
            echo "<label  for='nic_no'>nic_no</label>";
            echo "<input  class='form-control' type='text' id='nic_no' name='nic_no' placeholder='ජාතික හැදුනුම්‍පත් අංකය ' value='".$nic_no."' disabled >";
            echo "</div>", "&nbsp";
            
            echo "<div class='form-group'>";
            echo "<label  for='increment_date'>increment_date</label>";
            echo "<input  class='form-control' type='date' id='increment_date' name='increment_date' value='".$increment_date."' disabled >";
            echo "</div>", "&nbsp";
            
            echo "</from>"
        ?>	
</div>