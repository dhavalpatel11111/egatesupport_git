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
            <!-- <img width="80px" src='template/assets/dist/img/modory1.jpg' alt='<?php echo getConfigValue("app_name")?>' />             -->
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
        <div><h2 class="title">PRINT RENTAL</h2></div>
    </div>
    <div class="pdf-content">
        <div style="text-align: left;width: 40%;float: left;">
            <table width="100%" style="" cellpadding="3px">
                <tr>
                    <th style="background-color: #eeeeee;">Bill to</th>
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
                    <th style="background-color: #eeeeee;">Sale Invoice No.</th>
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
                    <th style="background-color: #eeeeee;">For the month of</th>
                </tr>
                <tr>
                    <!-- <td style="text-align: center;"><?php echo $month ?></td> -->
                </tr>
            </table>
        </div>
		
	

   

<div class="clearfix"></div>
		
		
        <div style="margin-top: 30px;">
            <table width="100%" style="" cellpadding="3px">
                <tr>
				   <th style="background-color: #eeeeee;width:18%;">Barcode</th>
                    <th style="background-color: #eeeeee;width:18%;">Contract No.</th>
                    <th style="background-color: #eeeeee;width:44%;">Asset</th>
                    <th style="background-color: #eeeeee;width:18%;">Department</th>
                    <th style="background-color: #eeeeee;width:20%;">Case Serial No</th>
                </tr>
                <?php $total = 0; 
				$i=1;?>
                <?php foreach ($contracts as $key => $contract) {

				?>
                    <?php $total += $contract['contract_amount']; ?>
                    <tr>
			 <td style="text-align: center;"><div class="col-sm-8">
	
			 
			 
									 
                                         <?php 
										 $imgqr='111'.$i.'png';
										 
				 QRcode::png($contract['serial'],$imgqr);?>									
                                        <img src="<?php echo $imgqr;?>" name="QRcode" id="QRcode">
										<?php echo $contract['serial'];?>
                                    </div></td>
                        <td><?= $contract['contractno'] ?></td>
                        <td><?= $contract['tag'] ?> : <?= $contract['assetname'] ?> : <?= $contract['model_name'] ?> : <?= $contract['serial'] ?></td>
                        <td>
                    <?php  $contract['department'];

                              echo $department = getSingleValue("department","name",$contract['department']);  ?>
                            
                        </td>
                        <td style="text-align: center;"><div class="col-sm-8">
	
			 
			 
									 
                                         <?php 
										 $imgqr='111'.$i.'png';
										 
				 QRcode::png($contract['serial'],$imgqr);?>									
                                        <img src="<?php echo $imgqr;?>" name="QRcode" id="QRcode">
										<?php echo $contract['serial'];?>
                                    </div></td>                
                    </tr>
					
                <?php
					$i++;
				} ?>
              <!--  <tr>
                    <th colspan="3" style="text-align: right;">Total</th>
                    <td style="text-align: right;"><?= number_format($total) ?></td> -->
                </tr>
            </table>
        </div>
    </div>
</div>