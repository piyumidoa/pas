
<div class="container estb-content">
	<div class="row ">
		<div class="col-lg-11">
			<div class="row">
				<div>
					<h1 class="estb-page-header"><?php echo $page_title; ?></h1>
				</div>
			</div>
			
			<i class='fas fa-print fa-2x estb-page-icon' onclick='printPage("profile-print-page")' title='මුද්‍රණය කරන්න'></i>
			
				<?php	 if( isset($personal_file) && !empty($personal_file)) {	
				    
				    echo '<div class="row" id="profile-print-page">';

				    echo '<table border="1" class="table table-bordered table-hover">';
				    echo "<tr class = 'estb-sub-header' >";
				    echo "<td>ගොනු අංකය </td>";  
				    echo "<td>".$personal_file->file_no."</td><td></td>";  
				    echo "</tr>";
				    
				    echo "<tr><td>01</td>"; 
				    echo "<td>නිලධාරියාගේ නම</td>"."<td>".$personal_file->officer_name."</td></tr>";
				    
				    echo "<tr><td>02</td>";
				    echo "<td>තනතුර</td>"."<td>".$personal_file->post_name."</td></tr>";
				    
				    echo "<tr><td>03</td>";
				    echo "<td>ජා.හැ.අංකය</td>"."<td>".$personal_file->nic_no."</td></tr>";				    
				    
				    echo "<tr><td>04</td>";
				    echo "<td>සේවා ස්ථානය</td>"."<td>".$personal_file->sub_unit_name."</td></tr>";
				    
				    echo "<tr><td>05</td>";
				    echo "<td>ඉහත වැඩ බාරගත් දිනය</td>"."<td>".$personal_file->assignment_date."</td></tr>";
				    
				    echo "<tr><td>06</td>";
				    echo "<td>උපන්දිනය</td>"."<td>".$personal_file->birth_date."</td></tr>";
				    
				    echo "<tr><td>07</td>";
				    echo "<td>පත්වීම් දිනය</td>"."<td>".$personal_file->appointment_date."</td></tr>";				    
				    
				    echo "<tr><td>08</td>";
				    echo "<td>වැටුප් වර්ධක  දිනය</td>"."<td>".$personal_file->increment_date."</td></tr>";
				    
				    echo '</table></div>';				   
				}	
				// subject files assigned if the logged user is a subject officer or above post
				if( isset($branches) && !empty($branches)) {
				    echo '<div class="row" >';
			    $i = 0;
			    echo '<table border="1" class="table table-bordered table-hover">';
			    echo "<tr class = 'estb-sub-1-header' >";
			    echo "<td colspan = 3 >විෂය ගොනු </td>";
			    echo "</tr>";
				    
			    foreach ( $branches as $branch_no=>$branch_name ) {
				        
			        echo "<tr class = 'estb-sub-header' >";
			        echo "<td colspan = 2>පුද්ගලික ලිපි ගොනු ශාඛාව </td>";
			        echo "<td >".$branch_no."</td>";
			        echo "</tr>";
			        
			        if( isset($subject_files[$branch_no]) && !empty($subject_files[$branch_no])) {
    			            
			            foreach ( $subject_files[$branch_no] as $file_no) {
    				            
    				            $i = $i + 1;
    				            echo "<tr><td></td>";
    				            echo "<td>කෘ.දෙ./ආ./".$branch_no."/".$file_no."</td>".
        				            "<td><a href = '".base_url()."index.php/dashboard/subject_file/personal_files/".$branch_no."/".$file_no."' target='_blank' title='පුද්ගලික ලිපි ගොනු ලැයිස්තුව'>
                                       <i class='fas fa-th-list estb-row-icon'></i><br/></a></td></tr>";    				            
    				        }
    			        }
				    }	
				    echo '</table></div>';
				}?>
			
		</div>
		<?php include __DIR__.'/../common/menu.php';?>
	</div>
</div>
<?php include __DIR__.'/../common/footer.php';?>