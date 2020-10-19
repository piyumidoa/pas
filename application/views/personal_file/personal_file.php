
<div class="container estb-content">
	<div class="row ">
		<div class="col-lg-11">
			<div class="row">				
				<h1 class="estb-page-header"><?php echo $page_title; ?></h1>				
			</div>
            <div class="row"> 
            <!-- menu buttons row for the personal file -->
                <div class="col-lg-2 page-menu-item"> 
                <?php 
                // route to enable the disabled form inputs
                if( isset($form_action) && $form_action == 'NA') {
                    
                    echo "<a href = '".base_url()."index.php/personal_file/edit_page/".$id."'>
                    <i class='fas fa-pencil-alt fa-2x estb-page-icon' title='සංස්කරණ පිටුව'></i></a>";
                }
                ?>
                <i class='fas fa-print fa-2x estb-page-icon' onclick='printPage("printable-page")' title='මුද්‍රණය කරන්න'></i>
                </div>
            </div>
			<div class="row" id="printable-page">
				<!-- personal file add form -->
            <?php
            echo form_open(''.base_url().'index.php/personal_file/'.$form_action.'', array('method' => 'post', 'class' => 'form-horizontal')); 				
        
        if( isset($subject_file)) {
            echo '<input type="hidden" id="subject_file" name="subject_file" value="'.$subject_file.'">';
        }
        
        echo "<div class='form-group'>";
        echo "<label class='sr-only' for='nic_no'>nic_no</label>";
        echo "<input  class='form-control' type='text' id='nic_no' name='nic_no' placeholder='ජාතික හැදුනුම්‍පත් අංකය '";
        if( isset($nic_no) && !empty($nic_no)) {
            echo "value='".$nic_no."'";
            echo $disabled;
        }
        echo ">";
        echo form_error('nic_no');
        echo "</div>", "&nbsp";

        echo "<div class='form-group'>";
        echo "<label  for='assignment_date'>වැඩ බාරගත් දිනය </label>";
        echo "<input  class='form-control' type='date' id='assignment_date' name='assignment_date' onchange='changeAppointmentDate(this.value)'";
        if( isset($assignment_date) && !empty($assignment_date)) {
            echo "value='".$assignment_date."' ";
            echo $disabled;
        }
        echo ">";
        echo form_error('assignment_date');
        echo "</div>", "&nbsp";
        
        echo "<div class='form-group'>";
        echo "<label class='sr-only' for='sub_unit'>Working Place</label>";
        echo "<select class='form-control' id='sub_unit' name='sub_unit' ";
        echo $disabled;
        echo ">", "<option value=''>අනු අංශය</option>";
        foreach ($sub_unit_list as $sub_unit) {
            echo "<option value=", "$sub_unit->id";
            echo (isset($sub_unit_id) && !empty($sub_unit_id) && $sub_unit_id == $sub_unit->id) ?  ' selected' : ' ';
            echo ">", "$sub_unit->name_si", "</option>";
        }
        echo "</select>";
        echo form_error('sub_unit');
        echo "</div>", "&nbsp";

        echo "<div class='form-group'>";
        echo "<label class='sr-only' for='post'>තනතුර</label>";
        echo "<select class='form-control' id='post' name='post' ";
        echo $disabled;
        echo ">", "<option value=''>තනතුර</option>";
        foreach ($post_list as $post) {
            echo "<option value=", "$post->id";
            echo (isset($post_id) && !empty($post_id) && $post_id == $post->id) ?  ' selected' : ' ';
            echo ">", "$post->name_si", "</option>";
        }
        echo "</select>";
        echo form_error('post');
        echo "</div>", "&nbsp";

        echo "<div class='form-group'>";
        echo "<label for='class'>පන්තිය</label>";
        echo "<select class='form-control' id='class' name='class'>", "<option value=''> පන්තිය</option>";
        echo "<option value='1'>1</option>"; 
        echo "<option value='2'>2</option>"; 
        echo "<option value='3'>3</option>";            
        echo "</select>";
        echo form_error('class');
        echo "</div>", "&nbsp";

        echo "<div class='form-group'>";
        echo "<label for='grade'>ශ්‍රේණිය </label>";
        echo "<select class='form-control' id='grade' name='grade'>", "<option value=''>ශ්‍රේණිය </option>";
        echo "<option value='1'>I</option>"; 
        echo "<option value='2'>II</option>"; 
        echo "<option value='3'>III</option>";            
        echo "</select>";
        echo form_error('grade');
        echo "</div>", "&nbsp";

        if( isset($promotion_date) && !empty($promotion_date)) {
            echo "<div class='form-group'>";
            echo "<label  for='promotion_date'>උසස් වීම ලැබූ දිනය</label>";
            echo "<input  class='form-control' type='date' id='promotion_date' name='promotion_date' ";
            
                echo "value='".$promotion_date."' disabled";
            
            echo ">";
            echo form_error('promotion_date');
            echo "</div>", "&nbsp";
        }        
        
        echo "<div class='form-group'>";
        echo "<label  for='birth_date'>උපන්දිනය </label>";
        echo "<input  class='form-control' type='date' id='birth_date' name='birth_date' ";
        if( isset($birth_date) && !empty($birth_date)) {
            echo "value='".$birth_date."'";
            echo $disabled;
        }
        echo ">";
        echo form_error('birth_date');
        echo "</div>", "&nbsp";

        echo "<div class='form-group'>";
        echo "<label class='sr-only' for='officer_name'>නිලධාරියාගේ නම </label>";
        echo "<input  class='form-control' type='text' id='officer_name' name='officer_name' placeholder='නිලධාරියාගේ නම  '";
        if( isset($officer_name) && !empty($officer_name)) {
            echo "value='".$officer_name."'";
            echo $disabled;
        }
        echo ">";
        echo form_error('officer_name');
        echo "</div>", "&nbsp";

        echo "<div class='form-group'>";
        echo "<label  for='appointment_date'>පත්වීම් දිනය  </label>";
        echo "<input  class='form-control' type='date' id='appointment_date' name='appointment_date' onchange='changeIncrementDate(this.value)' ";
        if( isset($appointment_date) && !empty($appointment_date)) {
            echo "value='".$appointment_date."'";
            echo $disabled;
        }
        echo ">";
        echo form_error('appointment_date');
        echo "</div>", "&nbsp";

        echo "<div class='form-group'>";
        echo "<label  for='increment_date'>වැටුප් වර්ධක  දිනය  </label>";
        echo "<input  class='form-control' type='text' id='increment_date' name='increment_date' placeholder='MM-DD' ";
        if( isset($increment_date) && !empty($increment_date)) {
            echo "value='".$increment_date."'";
            echo $disabled;
        }
        echo ">";
        echo form_error('increment_date');
        echo "</div>", "&nbsp";

        if( isset($pension_date_55) && !empty($pension_date_55)) {
            echo "<div class='form-group'>";
            echo "<label  for='pension_date_55'>අවු 55 විශ්‍රාම ගැනීම් දිනය</label>";
            echo "<input  class='form-control' type='date' id='pension_date_55' name='pension_date_55' ";            
            echo "value='".$pension_date_55."' disabled";
            echo ">";
            echo "</div>", "&nbsp";
        }
        if( isset($pension_date_60) && !empty($pension_date_60)) {
            echo "<div class='form-group'>";
            echo "<label  for='pension_date_60'>අවු 60 විශ්‍රාම ගැනීම් දිනය</label>";
            echo "<input  class='form-control' type='date' id='pension_date_60' name='pension_date_60' ";            
            echo "value='".$pension_date_60."' disabled";
            echo ">";
            echo "</div>", "&nbsp";
        }        
        if( isset($service_end_reason) && !empty($service_end_reason)) {
            
            echo "<div class='form-group'>";
            echo "<label for='service_end_reason'>සේවය අවසන් කිරීමට හේතුව </label>";
            echo "<input  class='form-control' type='text' id='service_end_reason' name='service_end_reason' ";
            echo "value='".$service_end_reasons[$service_end_reason]."' disabled >";
            echo "</div>", "&nbsp";
            //date
            echo "<div class='form-group'>";
            echo "<label  for='service_end_date'>",$service_end_reasons[$service_end_reason]," දිනය </label>";
            echo "<input  class='form-control' type='date' id='service_end_date' name='service_end_date' ";
            
            echo "value='".$service_end_date."' disabled";
            
            echo ">";
            echo "</div>", "&nbsp";
        }
        if( $form_action != 'NA') {
        ?>	
	         <button type='submit' class='btn btn-default'>
                <i class="fas fa-check fa-1x" ></i>
			</button>
        <?php }
        if( isset($message) ) { echo $message; }?>
				</form>
			</div>
            <!-- promotion history table -->		
            <?php
             if( isset($promotion_list) && !empty($promotion_list) ) { ?>
            <i class='fas fa-print fa-2x estb-page-icon' onclick='printPage("promotion-list-page")' title='මුද්‍රණය කරන්න'></i>	
            <?php } ?>
            
			<div class="row" id="promotion-list-page">
				
	         <?php
             if( isset($promotion_list) && !empty($promotion_list) ) {

        echo '<table border="1" class="table table-bordered table-hover">';
        echo "<br/>උසස්වීම් ඉතිහාසය ";
        
        $i = 1;
        echo "<tr class = 'estb-sub-header' >";
        echo "<td>තනතුර </td>";  
        echo "<td>පන්තිය </td>"; 
        echo "<td>ශ්‍රේණිය </td>";  
        echo "<td>ආරම්බක දිනය </td>";  
        echo "<td>අවසන් දිනය</td>"; 
        echo "<tr>";
        
    
        foreach ($promotion_list as $r) {
            $i ++ ;
            echo "<tr>";
            echo "<td>" . $r->name_si . "</td>"; 
            echo "<td>" . $r->class . "</td>";                
            echo "<td>" . $r->grade . "</td>";   
            echo "<td>" . $r->start_date . "</td>";   
            echo "<td>" . $r->end_date . "</td>";                   
            echo "<tr>";
        }
    }
    echo '</table>';
        ?>
	      
			</div>
		<?php
                if( isset($transfer_list) && !empty($transfer_list) ) { ?>
			<i class='fas fa-print fa-2x estb-page-icon' onclick='printPage("transfer-history-page")' title='මුද්‍රණය කරන්න'></i>
				
		<?php }   ?>
            <!-- transfer history table -->			
			<div class="row" id="transfer-history-page">
				
                <?php
                if( isset($transfer_list) && !empty($transfer_list) ) {
   
           echo '<table border="1" class="table table-bordered table-hover">';
           echo "<br/>මාරු වීම්  ඉතිහාසය ";

           echo "<tr class = 'estb-sub-header' >";
           echo "<td>අනු අංශය</td>";  
            echo "<td>වැඩ බාරගත් දිනය</td>";  
            echo "<td>නිදහස් කල දිනය </td>"; 
           echo "<tr>";
           
       
           foreach ($transfer_list as $record) {
               
               echo "<tr>";
               echo "<td>" . $record->name_si . "</td>"; 
                echo "<td>" . $record->assignment_date . "</td>"; 
                echo "<td>" . $record->release_date . "</td>";                    
               echo "<tr>";
           }
       }
       echo '</table>';
           ?>
             
               </div>
              
				<!-- personal file table : working in sub units -->
			
			<div class="row">
				
	         <?php
	         if( isset($personal_file_list) && !empty($personal_file_list) ) {
	             
	             echo '<table border="1" class="table table-bordered table-hover">
               			<tr>
               				<td>සේවයේ නියුතු </td>
               			</tr>
               			<tr class = "table-danger">
               				<td>විශ්‍රාමික</td>
               			</tr>
               			<tr class = "table-warning">
               				<td>ඉල්ලා අස්වීම්</td>
               			</tr>
                        <tr class = "table-primary">
               				<td>තනතුර අත්හැර යාම</td>
               			</tr> 
                        <tr class = "table-secondary">
               				<td>මිය යෑම් </td>
               			</tr> 
                        <tr class = "table-success">
               				<td>දෙපාර්තමේන්තුවෙන් පිටතට ස්ථාන මාරු ලද  </td>
               			</tr>
               		</table>';
                
                echo '<table border="1" class="table table-bordered table-hover">';
        echo "ප්‍රතිඵල ගණන : ", $num_rows;
        
        echo "<tr class = 'estb-sub-header' >";
        echo "<td>ජාතික හැදුනුම්‍පත් අංකය</td>";
        echo "<td>තනතුර </td>";           
        echo "<td>අනු අංශය</td>";   
        echo "<td>වැඩ බාරගත් දිනය</td>";  
        echo "<td>අවසන් යාවත්කාලීන කළ දිනය</td>"; 
        echo "<td></td>";
        echo "<tr>";
        
    
        foreach ($personal_file_list as $r) {
            
            echo "<tr ";
            // bootstrap class based on personal file 
            if( isset($r->service_end_reason) && $r->service_end_reason == 4 ) {
                echo " class='table-danger' ";
            }
            if( isset($r->sub_unit) && !empty($r->sub_unit) && $r->sub_unit >= 1000 ) {
                echo " class='table-success' ";
            }
            if(  isset($r->service_end_reason) && $r->service_end_reason == 1 ) {
                echo " class='table-warning' ";
            }
            if(  isset($r->service_end_reason) && $r->service_end_reason == 2 ) {
                echo " class='table-primary' ";
            }
            if(  isset($r->service_end_reason) && $r->service_end_reason == 3 ) {
                echo " class='table-secondary' ";
            }
            echo "><td>" . $r->nic_no . "</td>"; 
            echo "<td>" . $r->post_name . "</td>";                
            echo "<td>" . $r->sub_unit_name . "</td>";   
            echo "<td>" . $r->assignment_date . "</td>";   
            echo "<td>" . $r->last_updated_date . "</td>"; 
            echo "<td><a href = '".base_url()."index.php/personal_file/more_info/".$r->personal_file_id."/".$r->sub_unit."' target='_blank' title='වැඩි විස්තර'>
            <i class='fas fa-info-circle estb-row-icon'></i><br/></a></td>";                  
            echo "<tr>";
        }
    }
    echo '</table>';
        ?>
	      
			</div></div>
		<?php include __DIR__.'/../common/menu.php';?>
	</div>
</div>
<?php include __DIR__.'/../common/footer.php';?>