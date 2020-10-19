
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
                <td><button type='button' onClick='addAppraiseeInput()'>Add new row</button></td>
                </tr>
              </table></div>
              ";
        echo form_error('appraisee[]');
        
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
				<!-- approved vacancies for each sub unit table -->
			
			<div class="row">
				<table border="1" class="table table-bordered table-hover">
	         <?php
    if( isset($vacancies_list) && !empty($vacancies_list) ) {
        echo "ප්‍රතිඵල ගණන : ", $num_rows;
        
        $i = 1;
        echo "<tr class = 'estb-sub-header' >";
        echo "<td>අනු අංශය</td>";
        echo "<td>තනතුර </td>";        
        echo "<td>අනුමත පුරප්පාඩු ගණන</td>";
        echo "<td>අවසන් යාවත්කාලීන කළ දිනය</td>";
        echo "<td> </td>";    
        echo "<tr>";
        
        foreach ($vacancies_list as $r) {
            $i ++ ;
            echo "<tr>";
            echo "<td>" . $r->sub_unit_name . "</td>";
            echo "<td>" . $r->post_name . "</td>";
            echo "<td>" . $r->approved_vacancies . "</td>";     
            echo "<td>" . $r->last_updated_date . "</td>";   
            echo "<td><a href = '".base_url()."index.php/dashboard/approved_vacancies/edit_page/".$r->sub_unit_post_id."' title='සංස්කරණ පිටුව'>
                    <i class='fas fa-pencil-alt fa-1x estb-row-icon' ></i></a></td>";
            echo "<td><a href = '".base_url()."index.php/dashboard/approved_vacancies/delete/".$r->sub_unit_post_id."' title='මකන්න'>
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