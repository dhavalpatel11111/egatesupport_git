<link href="template/assets/pdfstyle.css" rel="stylesheet" type="text/css" />
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div style="text-align: left;width: 80%;float: left;">
            <img width="80px" src='template/assets/dist/img/modory1.jpg' alt='<?php echo getConfigValue("app_name")?>' />            
        </div>
        <div style="text-align: left;width: 20%;float: right;">
        </div>
        <div class="clearfix"></div>
        <div>
		<h2 class="title">TICKETS</h2>
		<?php if($_GET['companyname']){ echo "<h4 class='title' style='margin-bottom:0px;'>".getSingleValue("clients","name",$_GET['companyname'])."</h4>"; } ?>
		</div>
    </div>
    <div class="pdf-content">
	<?php if($_GET['sfdate'] && $_GET['efdate']){ ?>
	
        <div class="title" style="margin-top:0px; border-bottom: solid 1px #333333;font-weight: bold; display:inline-flex;">
		<span >
		<h4>From : <?php echo $_GET['sfdate']; ?> &nbsp;&nbsp;To:  <?php echo $_GET['efdate']; ?> </h4>
		</span>
	
		
	
		</div>
	<?php	
	}?>
        <div style="margin-top: 20px;padding-bottom: 5px;border-bottom: solid 1px #333333;font-weight: bold;">
            <div style="float: left;width: 60%;"></div>
            <div style="float: right;width: 40%;text-align: right;"></div>
        </div>
       <table id="dataTablesFullTickets" style="width:100%;" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ticket #</th>
                                        <th>Date</th>
                                        <th>Subject</th>
                                     <?php if($_GET['companyname']){ } else{ ?>   <th>Related Entities</th> <?php } ?>
                                        <th>CHM</th>
										<th>Parts & Material</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tickets as $ticket) { ?>
                                    <tr>
                                        <td><a href='?route=tickets/manage&id=<?php echo $ticket['id']; ?>'><?php echo $ticket['id']; ?></a></td>
                                        <td><a href='?route=tickets/manage&id=<?php echo $ticket['id']; ?>'><?php echo $ticket['ticket']; ?></a></td>
                                        <td><?php echo $ticket['timestamp']?></td>
                                        <td><a href='?route=tickets/manage&id=<?php echo $ticket['id']; ?>'><?php echo $ticket['subject']; ?></a></td>
                                        
                                     <?php if($_GET['companyname']){ } else{ ?>     <td><?php
                                            if($ticket['clientid'] != 0) echo "<a href='?route=clients/manage&id=".$ticket['clientid']."'><span class='label' style=\"background-color:#FFF;color:#0073b7;border:1px solid #0073b7;\">" . getSingleValue("clients","name",$ticket['clientid']) . "</span></a> ";
                                            $assetid = getSingleValue("contract","assetid",$ticket['contractid']);
                                            $assettag = getSingleValue("assets","tag",$assetid);
                                            $modelid = getSingleValue("assets","modelid",$assetid);
                                            $assetmodel = getSingleValue("models","name",$modelid);
                                            if($ticket['contractid'] != 0) echo "<a href='?route=contract/manage&id=".$ticket['contractid']."'><span class='label' style=\"background-color:#FFF;color:#001F3F;border:1px solid #001F3F;\"> " . getSingleValue("contract","contractno",$ticket['contractid']) . " | " .$assettag .":" . $assetmodel . "</span></a> ";
									 ?></td> <?php } ?>
										<td class="chm">
										<?php if($ticket['client_handle_mistake']==1){echo "o";}?>
										</td>
										<td>
										<?php echo $ticket['pmcon'];?>
										</td>
										
                                        
										
                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
        <div style="margin-top: 20px;padding-bottom: 5px;color: #c1c1c1;">Note: </div>
    </div>
</div>
