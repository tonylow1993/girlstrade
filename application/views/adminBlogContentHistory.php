

             
             <div class="table-responsive">
             <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                <?php if($result<>null && count($result)>0)
            	{
            	?>	
            	
                    <tr>
                     <th> <?php echo $this->lang->line("Action");?>  </th>
                   <th data-sort-ignore="true"> <?php echo $this->lang->line("Preview");?>  </th>
                   </tr>
                <?php }?>
                </thead>
                <tbody>
                <?php 
                $Num=0;
                
                if($result<>null && count($result)>0)
            	{
            		foreach($result as $id=>$row)
                  	{
                  		$Num=$Num+1;
                  		$title=$row->title;
                  		$description=$row->description;
                  		$clickLink="deleteBlog".$Num;
                		echo "<tr>";
                		echo "<td style=\"width:20%;height:150px;padding:0px; margin: 0px; border: none;\"  class=\"add-image\">";
                		echo "<div class=\"user-ads-action\"><a class=\"btn btn-danger btn-xs btn-120\" href=\"#deleteBlogPopup\" data-toggle=\"modal\" id='$clickLink' data-id=\"$row->ID\" data-title=\"$title\" data-description=\"$description\"> <i class=\" fa fa-trash\"></i> ".$this->lang->line('Delete')." </a></p>";
                		 
                		echo "</div>";
                		echo "</td>";
                    	echo "<td style=\"width:60%\" class=\"ads-details-td\">";
                    	echo "<div class=\"ads-details\">";
                       echo "<h5>".$title."<br/>Description: ". $description."</h5>";
                      	 	echo "</div></td>";
                      	 
                      	 	echo "</tr>";
				}
               
            	}else{
              	echo "<div align='center'><h2>".$this->lang->line("NoRecordsFound")."</h2></div>";
              }
				echo "<br/><input type='hidden' name='NumRec' value='".$Num."' ></input>";
              ?>  
               
                </tbody>
              </table>
              
             	
           
            </div>
            
   