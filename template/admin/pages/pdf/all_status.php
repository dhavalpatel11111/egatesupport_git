<link href="template/assets/pdfstyle.css" rel="stylesheet" type="text/css" />
<?php  include("assets/qrcode/qr/qrlib.php"); ?>
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div style="text-align: left;width: 80%;float: left;">
            <img width="80px" src='template/assets/dist/img/modory1.jpg' alt='<?php echo getConfigValue("app_name")?>' />            
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
        <div><h2 class="title">PRINT RENTAL STATUS</h2></div>
    </div>
    <div class="pdf-content">
      <div class="clearfix"></div>
		
		
        <div style="margin-top: 30px;">
            <table width="100%" style="" cellpadding="3px">
                <tr>
				   <th style="background-color: #eeeeee;width:18%;">Client Name</th>
                    <th style="background-color: #eeeeee;width:18%;">Contract No.</th>
                    <th style="background-color: #eeeeee;width:44%;">Asset</th>
                    <th style="background-color: #eeeeee;width:18%;">Department</th>
                    
                    
                </tr>
                <?php $total = 0; 
				$i=1;?>
                <?php foreach ($contracts as $key => $contract) {

				?>
                    <?php $total += $contract['contract_amount']; ?>
                    <tr>
					    <td><?= $contract['client_name'] ?></td>
                        <td><?= $contract['contractno'] ?></td>
                        <td><?= $contract['tag'] ?> : <?= $contract['assetname'] ?> : <?= $contract['model_name'] ?> : <?= $contract['serial'] ?></td>
                        <td><?= $dipartment_name = getSingleValue('department', 'name',$contract['department']); ?></td>
                      
                        </tr>
					
                <?php
					$i++;
				} ?>
              
            </table>
        </div>
    </div>
</div>