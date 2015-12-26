<?php $title = "Girls' Trading Platform"; 
  include("header.php"); ?>
<div id="wrapper">
  <!-- /.header -->
  
  <div class="main-container">
    <div class="container">
      <div class="row">
       <div class="inner-box">
           <div class="pull-right backtolist"><a href=<?php echo $previousCurrent_url;?>> <i class="fa fa-angle-double-left"></i> Back to Previous Page</a></div>
 
             <h2 class="title-2"><i class="icon-hourglass"></i> <?php echo $this->lang->line("MessageHistoryByUserID");?> </h2>
            <div class="table-responsive">
               <label  ><?php echo $this->lang->line("Title");?></label>
                        :  <label  ><?php echo $titlepost;?></label>
              <br/>
               <label  ><?php echo $this->lang->line("Description");?></label>
                        :  <label  ><?php echo $description;?></label>
              <br/>
               <label><?php echo $this->lang->line("SellerName");?></label>
                        :  <label ><?php echo $sellerName;?></label>
              <br/>
              <label><?php echo $this->lang->line("BuyerName");?></label>
                        :  <label ><?php echo $buyerName;?></label>
              <br/>
              <table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr>
                    <th> <?php echo $this->lang->line("Datetime");?> </th>
                    <th data-sort-ignore="true"> <?php echo $this->lang->line("Preview");?> </th>
                    <!--  <th> <?php echo $this->lang->line("Option");?> </th>-->
                   </tr>
                </thead>
                <tbody>
                <?php 
                if($result<>null)
            	{
            		$rowCount=0;
                  	foreach($result as $id=>$row)
                  	{
                  		// str_replace("<br />","\n", $row->content)
                  		echo "<tr>";
                  		                    	echo "<td style=\"width:30%\"><font size=\"3\">$row->createDate <br/> $row->messageIOType</font></td>";
                  		                    	echo "<td style=\"width:70%\" class=\"ads-details-td\">";
                  		                    	echo "<div class=\"ads-details\">";
                  		                       echo "<h5> $row->content</h5>";
                  		                    		echo "</div></td>";
                  		                      	//echo "<td style=\"width:20%\" class=\"action-td\"><div>";
                  		                      	
                  			                      	//echo "</div></td>";
                  			                  		echo "</tr>";
//                 		$from=$row['from'];
//                   		$reply=$row['reply'];
//                   		$viewItemPath=$row['viewItemPath']."?prevURL=".urlencode(current_url());
//                   		$imagePath=$row['imagePath'];
//                   		$previewTitle=$row['previewTitle'];
//                   		$previewDesc=$row["previewDesc"];
//                   		$preview=$row["preview"];
                  		
//                   		$createDate=$row['createDate'];
//                   		$itemStatus=$row['itemStatus'];
//                   		$messageID=$id;
//                   		$NoOfDaysPending=$row['NoOfDaysPending'];
// 						$NoOfDaysb4ExpiryContact=$row['NoOfDaysb4ExpiryContact'];
// 						$price=$row['price'];
// 						$postID=$row['postID'];
//                 		echo "<tr>";
//                     	echo "<td style=\"width:5%\" class=\"add-img-selector\"><div class=\"checkbox\">";
//                         echo "<label>";
//                         echo "  <input type=\"checkbox\">";
//                         echo "</label>";
//                       	echo "</div></td>";
//                     	echo "<td style=\"width:20%\">$reply</td>";
//                     	echo "<td style=\"width:60%\" class=\"ads-details-td\">";
//                     	echo "<div class=\"ads-details\">";
//                        echo "<h5><div class=\"add-title-girlstrade\">".$this->lang->line("lblTitle").$previewTitle."</div>".$previewDesc;
//                           echo "<br/>".$preview."<br/>Posted On: ". $createDate."</h5>";
//                     		echo "</div></td>";
//                       	echo "<td style=\"width:10%\" class=\"action-td\"><div>";
//                       	if($row["visibleBuyerComment"] && $row["soldToUserID"]==$row["fuserID"])
//                       	echo "<p><div class=\"user-ads-action\"><a class=\"btn btn-info btn-xs\"  data-toggle=\"modal\"   href=\"#markSoldAds\"  data-id=\"$postID\"   > <i class=\"fa fa-mail-forward\"></i>".$this->lang->line('MarkSold')." </a></div></p>";
//                       	echo "</div></td>";
//                   		echo "</tr>";
                  	}
            	}
                  ?>
                   
                </tbody>
              </table>
            </div>
            <!--/.row-box End--> 
            
          </div>
        </div>
        <!--/.page-content--> 
    </div>
    <!--/.container--> 
  </div>
  <!-- /.main-container -->

  <?php include "footer1.php"; ?>
  </div>
 
  <!--/.footer--> 
<!-- /.wrapper --> 

<?php include "footer2.php"; ?>

