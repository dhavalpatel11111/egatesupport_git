<link href="template/assets/pdfstyle.css" rel="stylesheet" type="text/css" />
<?php  include("assets/qrcode/qr/qrlib.php"); ?>
<div class="pdf-wrapper">
    <div class="pdf-header">
    <?php
                        $logo = $database->get("config", "value", ["name" => "logo"]);
                        if($logo == ""){
                            $logo = "template/assets/dist/img/modory1.jpg";
                        }else{{
                            $logo = "uploads/".$logo;
                        }}
                        
                        ?>
        <div style="text-align: left;width: 80%;float: left;">
            <img width="80px" src='<?php echo $logo; ?>' alt='<?php echo getConfigValue("app_name")?>' />            
        </div>
        <div style="text-align: left;width: 20%;float: right;">
            <table width="100%" style="" cellpadding="3px">
                <tr>
                    <th style="background-color: #eeeeee;">Date</th>
                    <td ><?php echo date("M d, Y"); ?></td>
                </tr>
                <tr>
                    <th style="background-color: #eeeeee;">No.</th>
                    <td ><?php echo $doc_no ?></td>
                </tr>
            </table>
        </div>
        <div class="clearfix"></div>
        <div><h2 class="title">Service Report</h2>
		<h2 style="color:red;text-align:center;" class ="title">If you are satisfied with our service , Pls sign at "Remarks"</h2></div>
    </div>
    <div class="pdf-content">
        <div style="text-align: left;width: 40%;float: left;">
            <table width="100%" style="" cellpadding="3px">
                <tr>
                    <th style="background-color: #eeeeee;">Client</th>
                </tr>
                <tr>
                    <td  style="text-align: center;"><?php echo $clientname ?></td>
                </tr>
            </table>
        </div>
        <div style="text-align: left;width: 10%;float: left;">&nbsp;</div>
        <div style="text-align: left;width: 20%;float: left;">
            <table width="100%" style="" cellpadding="3px">
                <tr>
                    <th style="background-color: #eeeeee;">Serviced by</th>
                </tr>
                <tr>
                    <td  style="text-align: center;">&nbsp;</td>
                </tr>
            </table>
        </div>
        <div style="text-align: left;width: 10%;float: left;">&nbsp;</div>
        <div style="text-align: left;width: 20%;float: right;">
            <table width="100%" style="" cellpadding="3px">
                <tr>
                    <th style="background-color: #eeeeee;">Confirmed by Client</th>
                </tr>
                <tr>
                    <td style="text-align: center;"> &nbsp;<?php //echo $month ?></td>
                </tr>
            </table>
        </div>
		
	

   

<div class="clearfix"></div>
		
		
        <div style="margin-top: 30px;">
            <table width="100%" style="" cellpadding="3px">
                <tr>
				 <th style="background-color: #eeeeee;width:18%;">Contract No.</th>
                    <th style="background-color: #eeeeee;width:18%;">Model No.</th>
                    <th style="background-color: #eeeeee;width:44%;">Serial No.</th>
					<th style="background-color: #eeeeee;width:18%;">Department</th>
                    <th style="background-color: #eeeeee;width:18%;">Remarks</th>
                  
                    
                </tr>
                <?php $total = 0; 
				$i=1;?>
                <?php foreach ($contracts as $key => $contract) {

				?>
                    <?php $total += $contract['contract_amount']; ?>
                    <tr>
			   <td><?= $contract['contractno'] ?></td>
                        <td><?= $contract['model_name']  ?></td>
                        <td> <?= $contract['serial'] ?></td>
						<td> <?php   $department = getRowById("department",$contract['department']); ?>

                            <?= $department['name'];?>
                            </td>
                        

           
                                     
                        <td style="text-align: right;"></td>                
                    </tr>
					
                <?php
					$i++;
				} ?>
             
            </table>
        </div>
		 <div style="margin-top: 30px;">
		 <h3>Service Details by Technician</h3>
		 </div>
		 <div style="margin-top: 50px;">
		  <h3>Client Comments</h3>
		 </div>
    </div>
</div>