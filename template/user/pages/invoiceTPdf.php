<link href="template/assets/pdfstyle.css" rel="stylesheet" type="text/css" />
<div class="pdf-wrapper">
    <div class="pdf-header">
        <?php
        $logo = $database->get("config", "value", ["name" => "logo"]);
        if ($logo == "") {
            $logo = "template/assets/dist/img/modory1.jpg";
        } else { {
                $logo = "uploads/" . $logo;
            }
        }

        ?>
        <div style="text-align: left;width: 80%;float: left;">
            <img width="80px" src='<?php echo $logo; ?>' alt='<?php echo getConfigValue("app_name") ?>' />
        </div>
        <div style="text-align: left;width: 20%;float: right;">
            <table width="100%" style="" cellpadding="3px">
                <tr>
                    <th style="background-color: #eeeeee;">Date</th>
                    <td><?php echo $invoice[0]['date']; ?></td>
                </tr>
                <tr>
                    <th style="background-color: #eeeeee;">No.</th>
                    <td><?php echo $invoice[0]['invoiceno']; ?></td>
                </tr>
            </table>
        </div>
        <div class="clearfix"></div>
        <div>
            <h2 class="title">Sale Invoice</h2>
        </div>
    </div>
    <div class="pdf-content">
        <div style="text-align: left;width: 40%;float: left;">
            <table width="100%" style="" cellpadding="3px">
                <tr>
                    <th style="background-color: #eeeeee;">Bill to</th>
                </tr>
                <tr>
                    <td style="text-align: center;"><?php echo $clientname ?></td>
                </tr>
            </table>
        </div>
        <div style="text-align: left;width: 10%;float: left;">&nbsp;</div>
        <div style="text-align: left;width: 20%;float: left;">
            <!-- <table width="100%" style="" cellpadding="3px">
                <tr>
                    <th style="background-color: #eeeeee;">Sale Invoice No.</th>
                </tr>
                <tr>
                    <td style="text-align: center;">&nbsp;</td>
                </tr>
            </table> -->
        </div>
        <div style="text-align: left;width: 10%;float: left;">&nbsp;</div>
        <div style="text-align: left;width: 20%;float: right;">
            <table width="100%" style="" cellpadding="3px">
                <tr>
                    <?php
                    $invoice_date = $invoice[0]['date'];
                    $date_components = explode('-', $invoice_date); // Split the date into components
                    $month_name = date("F", strtotime("{$date_components[1]}/1/2024"));
                    ?>

                    <th style="background-color: #eeeeee;">For the month of</th>
                </tr>
                <tr>
                    <td style="text-align: center;">&nbsp;&nbsp;<?php echo $month_name; ?></td>
                </tr>
            </table>
        </div>

        <div class="clearfix"></div>


        <div style="margin-top: 30px;">
            <table width="100%" style="" cellpadding="3px">
                <tr>

                    <th style="background-color: #eeeeee;width:18%;">Contract No.</th>
                    <th style="background-color: #eeeeee;width:44%;">Asset</th>
                    <th style="background-color: #eeeeee;width:10%;"> Amount</th>
                </tr>
                <?php $total = 0;
                $i = 1; ?>
                <?php foreach ($invoice_datas as $key => $invoice_data) {

                ?>
                   
                    <tr>

                        <td  style="text-align: center;"><?php echo $invoice_data['contractno']; ?><br><span><?php echo str_replace("_", " ", $invoice_data["contract_condition"]) ?></span></td>

                        <?php
                        $modelid = getSingleValue("assets", "modelid", $invoice_data['assetid']);
                        $modelname = getSingleValue("models", "name", $modelid);
                        $asset_serial = getSingleValue("assets", "serial", $invoice_data['assetid']);
                        ?>

                        <td style="text-align: center;"> <?php echo getSingleValue("assets", "tag", $invoice_data['assetid']) . " : " . $modelname . " : " . $asset_serial; ?>
                            <?php $invoice_contract_amount_note = getTableFiltereddc("invoice_contract", "invoice_id", $_GET["id"], "contract_id", $invoice_data['id'], "notes"); ?>
                            <?php echo !empty($invoice_contract_amount_note) ? $invoice_contract_amount_note[0] : "" ?></td>

                        <?php
                         $invoice_contract_amount = getTableFiltereddc("invoice_contract", "invoice", $_GET['invoice_id'], "contract_id", $invoice_data['id'], "amount");
                        if (!empty($invoice_contract_amount)) {
                            $contract_amount =  $invoice_contract_amount[0];
                        } else {
                            $contract_amount = $invoice_data['contract_amount'];
                        }
                        ?>
                         <?php $total += $contract_amount; ?>
                        <td style="text-align: right;"><?php echo number_format($contract_amount, 0, '.', ','); ?></td>
                        ?>
                    </tr>

                <?php
                    $i++;
                } ?>
                <tr>
                    <th colspan="2" style="text-align: right;">Total</th>
                    <td style="text-align: right;"><?= number_format($total) ?></td>
                </tr>
            </table>
        </div>

<?php if($invoice[0]['notes']) { ?>
        <div style="margin-top: 30px;text-align: left;width: 100%;float: left;">
            <table width="100%" cellpadding="3px">
                <tr>
                    <th style="background-color: #eeeeee;">Notes</th>
                </tr>
                <tr>
                    <td style="text-align: center;"><?php echo $invoice[0]['notes']; ?></td>
                </tr>
            </table>
        </div>
    <?php } ?>
    </div>
</div>