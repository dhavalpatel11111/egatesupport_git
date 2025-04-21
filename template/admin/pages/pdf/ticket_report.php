<link href="template/assets/pdfstyle.css" rel="stylesheet" type="text/css" />
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div style="text-align: left;width: 80%;float: left;">
            <img width="80px" src='template/assets/dist/img/modory1.jpg' alt='<?php echo getConfigValue("app_name")?>' />            
        </div>
        <div style="text-align: left;width: 20%;float: right;">
            Date: <?php echo date("M d, Y");?>
        </div>
        <div class="clearfix"></div>
        <div><h2 class="title">SERVICE FORM</h2></div>
    </div>
    <div class="pdf-content">
        <div style="padding-bottom: 5px;border-bottom: solid 1px #333333;font-weight: bold;">CLIENT: <?php echo $ticket['client']?></div>
        <div style="margin-top: 20px;padding-bottom: 5px;border-bottom: solid 1px #333333;font-weight: bold;">
            <div style="float: left;width: 60%;">TICKET: #<?php echo $ticket['ticket']?> <?php echo $ticket['subject']?></div>
            <div style="float: right;width: 40%;text-align: right;">Created Date: <?php echo date('Y-m-d', strtotime($ticket['timestamp']))?></div>
        </div>
        <table width="100%" style="margin-top: 50px;" cellpadding="3px">
            <tr>
                <th style="background-color: #eeeeee;">Time Arrival(Site)</th>
                <th style="background-color: #eeeeee;">Time Finished(Site)</th>
            </tr>
            <tr>
                <td style="height: 30px;">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table width="100%" style="margin-top: 20px;" cellpadding="3px">
            <tr>
                <th style="background-color: #eeeeee;">Action taken</th>
            </tr>
            <tr>
                <td style="height: 200px;">&nbsp;</td>
            </tr>
        </table>
        <table width="100%" style="margin-top: 20px;" cellpadding="3px">
            <tr>
                <th style="background-color: #eeeeee;">Parts Used</th>
            </tr>
            <tr>
                <td style="height: 80px;">&nbsp;</td>
            </tr>
        </table>
        <table width="100%" style="margin-top: 20px;" cellpadding="3px">
            <tr>
                <th style="background-color: #eeeeee;">Remarks</th>
            </tr>
            <tr>
                <td style="height: 80px;">&nbsp;</td>
            </tr>
        </table>
        <table width="100%" style="margin-top: 20px;" cellpadding="3px">
            <tr>
                <th style="background-color: #eeeeee;">Performed By</th>
                <th style="background-color: #eeeeee;">Acknowledge By</th>
            </tr>
            <tr>
                <td style="height: 100px;">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <div style="margin-top: 20px;padding-bottom: 5px;color: #c1c1c1;">Note: This will be used to track our client support, to improve our services.</div>
    </div>
</div>
