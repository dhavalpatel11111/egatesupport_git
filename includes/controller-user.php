<?php
error_reporting(0);
##### DATA PROCESSING #####
// LOGOUT
if ($route == "logout")
    logOut($lia['id']);
// FILES
if (isset($_POST['uploadContractFile'])) {
    $status = uploadContractFile($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deleteContractFile'])) {
    $status = deleteContractFile($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

// TICKETS
if (isset($_POST['addTicket'])) {
    //    cs_debug($_FILES);

    $status = addTicket($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

if (isset($_POST['editUsageModel'])) {
    if ($_FILES['image']['name'] != '') {
        $status = editUsageModel($_POST, $_FILES);
    } else {
        $status = editUsageModel($_POST);
    }
    header("Location:?route=create_tickett");
}

if (isset($_POST['deleteUsagereport'])) {
    $status = deleteUsagereport($_POST['id']);
    header("Location:?route=usage_report");
}

if (isset($_POST['addTicketReply'])) {
    $status = addTicketReply($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['add_department_ne'])) {
    $status = adddatedeparton($_POST);
    header("Location:?route=create_tickett");
}


// USER PROFILE
if (isset($_POST['editUser'])) {
    $status = editUser($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['delete_department'])) {
    $status = delete_department($_POST);
    header("Location:?route=create_tickett");
}
if (isset($_POST['updateonlydepart'])) {
    $status = updatedeparton($_POST);
    header("Location:?route=create_tickett");
}
##### GET DATA FOR MODALS #####
if (isset($_GET['modal'])) {
    switch ($_GET['modal']) {
        case "viewProject":
            $project = getRowById("projects", $_GET['id']);
            break;
        case "ticketAdd":
            $assets = getTableFiltered("assets", "clientid", $lia['clientid']);
            $cliendid = $lia['clientid'];
            $where = " WHERE contract.clientid=" . $cliendid . " AND contract.is_end=0";
            $where .= (!empty($_GET['contractid'])) ? " AND contract.id=" . $_GET['contractid'] : "";
            //            $contracts = $database->select("contract", [
            //                // Here is the table relativity argument that tells the relativity between the table you want to join.
            //                // The row author_id from table post is equal the row user_id from table account
            //                "[>]assets" => ["contract.assetid" => "assets.id"],
            //                "[><]models" => ["assets.modelid", "models.id"],
            //                    ], [
            //                "contract.id",
            //                "contract.contractno",
            //                "assets.tag",
            //                "assets.serial",
            //                "models.name",
            //                    ], [
            //                "contract.clientid" => $lia['clientid'],
            //                "ORDER" => "contract.id DESC",
            //                //"LIMIT" => 50
            //            ]);
            $sql = "SELECT contract.id,contract.contractno,assets.tag,assets.serial,models.name as model_name,assets.sku,contract.department "
                . "FROM contract "
                . "LEFT JOIN assets ON assets.id = contract.assetid "
                . "LEFT JOIN models ON assets.modelid = models.id "
                . $where;
            //    cs_debug($sql);
            $query = $database->query($sql);
            $contracts = $query->fetchAll();
            $ticketsubject = getTable("ticketsubject");
            break;
        case "contractTicketAdd":
            //$contracts = getTableFiltered("contract", "clientid", $lia['clientid']);
            //$clients = getTable("clients");
            $cliendid = $lia['clientid'];
            $where = " WHERE contract.clientid=" . $cliendid . " AND contract.is_end=0";
            $where .= (!empty($_GET['contractid'])) ? " AND contract.id=" . $_GET['contractid'] : "";
            //            $contracts = $database->select("contract", [
            //                // Here is the table relativity argument that tells the relativity between the table you want to join.
            //                // The row author_id from table post is equal the row user_id from table account
            //                "[>]assets" => ["contract.assetid" => "assets.id"],
            //                "[><]models" => ["assets.modelid", "models.id"],
            //                    ], [
            //                "contract.id",
            //                "contract.contractno",
            //                "assets.tag",
            //                "assets.serial",
            //                "models.name",
            //                    ], [
            //                "contract.clientid" => $lia['clientid'],
            //                "ORDER" => "contract.id DESC",
            //                //"LIMIT" => 50
            //            ]);
            $sql = "SELECT contract.id,contract.contractno,assets.tag,assets.serial,models.name as model_name,assets.sku,contract.department "
                . "FROM contract "
                . "LEFT JOIN assets ON assets.id = contract.assetid "
                . "LEFT JOIN models ON assets.modelid = models.id "
                . $where;
            //    cs_debug($sql);
            $query = $database->query($sql);
            $contracts = $query->fetchAll();
            $ticketsubject = getTable("ticketsubject");
            //            cs_debug($database->error());
            break;


        case "kb/viewArticle":
            $kbarticle = getRowById("kb_articles", $_GET['id']);
            break;


        case "modelUsageEdit":
            $modelid = getSingleValue("assets", "modelid", $_GET['id']);
            $modelname = getSingleValue("models", "name", $modelid);
            $sku = getSingleValue("assets", "sku", $_GET['id']);
            $modelimage = getSingleValue("models", "image", $modelid);
            $labeldata = getTableFiltered("assets", "id", $_GET['id']);
            if (isset($_GET['contractno'])) {
                $contractno = $_GET['contractno'];
                $contract_id = get_contranct_id_by_contract_no($contractno);
                $client_id = $labeldata[0]['clientid'];
                $usage_report_history_data = usage_report_history($contractno, $client_id);
            }

            $contractNo = $_GET['contractno'];
            $department_name = "";
            $department_tag = $_GET['department'];

            if ($department_tag) {
                $department = $_GET['department'];
            } else {
                $department = "Department is not assigned";
            }

            break;

        case "editUsagereport":
            $usageReport = getRowById("usage_report", $_GET['id']);
            $modelimage = getSingleValue("models", "image", $usageReport['asset_id']);
            break;

        case "contractTicketEdit":
            $ticket = getRowById("tickets", $_GET['id']);
            $query = $database->query(
                "SELECT contract.id,contract.contractno,assets.tag,assets.serial,models.name as model_name "
                    . "FROM contract "
                    . "JOIN assets ON assets.id = contract.assetid "
                    . "JOIN models ON assets.modelid = models.id "
                //. "WHERE contract.id = ".$contractid
            );
            $contracts = $query->fetchAll();
            break;
        case "contractTicketDelete":
            $ticket = getRowById("tickets", $_GET['id']);
            break;
    }
}

##### GET THE DATA #####
// GENERAL
$openTicketsCount = $database->count("tickets", ["AND" => ["status" => ["Open", "Reopened"], "clientid" => $lia['clientid']]]);

// DASHBOARD
if ($route == "dashboard") {
    global $database;

    $sumContract = countTableFiltered("contract", "clientid", $lia['clientid']);
    $sumAssets = countTableFiltered("assets", "clientid", $lia['clientid']);
    $sumLicenses = countTableFiltered("licenses", "clientid", $lia['clientid']);
    $sumProjects = countTableFiltered("projects", "clientid", $lia['clientid']);
    $sumIssues = $database->count("issues", ["AND" => ["status[!]" => "Done", "clientid" => $lia['clientid']]]);
    $sumTickets = $database->count("tickets", ["AND" => ["status" => ["Open", "Reopened"], "clientid" => $lia['clientid']]]);

    $categories = getTable("assetcategories");
    $openIssues = $database->select("issues", "*", ["AND" => ["status[!]" => "Done", "clientid" => $lia['clientid']]]);
    //    $openTickets = $database->select("tickets", "*", [ "AND" => [ "status" => ["Open", "Reopened"], "clientid" => $lia['clientid']]]);
    $recentAssets = $database->select("assets", "*", ["clientid" => $lia['clientid'], "ORDER" => "id DESC", "LIMIT" => 5]);
    $recentLicenses = $database->select("licenses", "*", ["clientid" => $lia['clientid'], "ORDER" => "id DESC", "LIMIT" => 5]);
    $select = "SELECT contract.id contractid,contract.contractno,assetcategories.name as servicetype,assetcategories.color as servicecolor, clients.name clientname, assets.tag,assets.serial, models.name as modelname "
        . "FROM contract "
        . "JOIN assets ON assets.id = contract.assetid "
        . "JOIN models ON assets.modelid = models.id "
        . "JOIN assetcategories ON assetcategories.id = contract.categoryid "
        . "JOIN clients ON clients.id = contract.clientid "
        . "WHERE contract.id is not null AND contract.clientid=" . $lia['clientid']
        . " ORDER BY contract.id DESC ";
    //    die($select);
    $query = $database->query($select);
    $recentContracts = $query->fetchAll();
    $select = "SELECT tickets.*, clients.name clientname, assets.tag,assets.serial, models.name as modelname "
        . "FROM tickets "
        . "JOIN contract ON contract.id = tickets.contractid "
        . "JOIN assets ON assets.id = contract.assetid "
        . "JOIN models ON assets.modelid = models.id "
        . "JOIN clients ON clients.id = tickets.clientid "
        . "WHERE tickets.clientid=" . $lia['clientid'] . " AND (tickets.status='Open' OR tickets.status='Reopened') ORDER BY tickets.id DESC ";
    //die($select);
    $query = $database->query($select);
    $openTickets = $query->fetchAll();

    $unpaidinvoice = getRecordsWithCondition('invoice', 'balance', '>', '0', 'clintid', '=', $lia['clientid']);
    $unpaidinvoice_count = count($unpaidinvoice);
    $file_to_upload = countwithconditiontextfile('invoice', 'clintid', '=', $lia['clientid']);
    $balace_to_pay = getTotalAmount('invoice', 'balance', 'clintid', $lia['clientid']);
}

// ASSETS
if ($route == "contract") {
    // $contracts = getTableFiltered("contract", "clientid", $lia['clientid']);
    if (isset($_GET['status']) && $_GET['status'] != '') {
        $cliendid = $lia['clientid'];
        $is_end = $_GET['status'];
        if ($is_end == 3) {
            $contracts = getTableFiltered2("contract", ["clientid" => $lia['clientid']], "*", "id", "ASC");
        } else {
            $query = $database->query("SELECT * from contract WHERE clientid = $cliendid AND  is_end = $is_end  ORDER BY id ASC");
            $contracts = $query->fetchAll();
        }
    } else {
        $cliendid = $lia['clientid'];
        $is_end = 0;
        $query = $database->query("SELECT * from contract WHERE clientid = $cliendid AND  is_end = $is_end  ORDER BY id ASC");
        $contracts = $query->fetchAll();
    }
}

if ($route == "invoice_payment") {
    $invoices = getTableFiltered("invoice", "clintid", $lia['clientid']);
    $unpaidinvoice = getRecordsWithCondition('invoice', 'balance', '>', '0', 'clintid', '=', $lia['clientid']);
    $pendinginvoice = getRecordsWithConditionPending('invoice', 'clintid', '=', $lia['clientid'], 'tax_file_2307', 'IS', 'NULL');
    $getToFollowRecords = getToFollowRecords('invoice', 'clintid', '=', $lia['clientid']);
    if (isset($_GET['paid']) && $_GET['paid'] == 1) {
        $invoices = $unpaidinvoice;
    }
}

if ($route == "receive_invoice") {
    $invoices = getTableFiltered("invoice", "clintid", $lia['clientid']);
    $unpaidinvoice = getRecordsWithCondition('invoice', 'balance', '>', '0', 'clintid', '=', $lia['clientid']);
    $pendinginvoice = getRecordsWithConditionPending('invoice', 'clintid', '=', $lia['clientid'], 'tax_file_2307', 'IS', 'NULL');
    $getToFollowRecords = getToFollowRecords('invoice', 'clintid', '=', $lia['clientid']);
    if (isset($_GET['paid']) && $_GET['paid'] == 1) {
        $invoices = $unpaidinvoice;
    }
    $filtered_invoices = [];
    foreach ($invoices as $key => $value) {
        if ($value['confirmed'] == 0 && $value['balance'] > 0) {
            $filtered_invoices[] = $value;
        }
    }
    $invoices = $filtered_invoices;
}

if ($route == "payment") {
    $invoices = getTableFiltered("invoice", "clintid", $lia['clientid']);
    $unpaidinvoice = getRecordsWithCondition('invoice', 'balance', '>', '0', 'clintid', '=', $lia['clientid']);
    $pendinginvoice = getRecordsWithConditionPending('invoice', 'clintid', '=', $lia['clientid'], 'tax_file_2307', 'IS', 'NULL');
    $getToFollowRecords = getToFollowRecords('invoice', 'clintid', '=', $lia['clientid']);
    $filtered_invoices = [];
    foreach ($invoices as $key => $value) {
        if ($value['paid'] <= 0) {
            $filtered_invoices[] = $value;
        }
    }
    if (isset($_GET['paid']) || isset($_GET['all'])) {
        if (isset($_GET['paid']) && $_GET['paid'] == 1) {
            $invoices = $unpaidinvoice;
        }
    
        if (isset($_GET['all']) && $_GET['all'] == 1) {
            $invoices = $invoices;
            $is_admin_title = true;
        }        
    }else{
        $invoices = $filtered_invoices;
    }


}

if ($route == "2307_wht") {
    $invoices = getTableFiltered("invoice", "clintid", $lia['clientid']);
    $unpaidinvoice = getRecordsWithCondition('invoice', 'balance', '>', '0', 'clintid', '=', $lia['clientid']);
    $pendinginvoice = getRecordsWithConditionPending('invoice', 'clintid', '=', $lia['clientid'], 'tax_file_2307', 'IS', 'NULL');
    $getToFollowRecords = getToFollowRecords('invoice', 'clintid', '=', $lia['clientid']);
    if (isset($_GET['paid']) && $_GET['paid'] == 1) {
        $invoices = $unpaidinvoice;
    }
    $filtered_invoices = [];
    if (!isset($_GET['all']) && $_GET['all'] != 1) {
        foreach ($invoices as $key => $value) {
            if ($value['tax_file_2307'] == "") {
                $filtered_invoices[] = $value;
            }
        }
        $invoices = $filtered_invoices;
    }
}



if ($route == "knowledge_base") {
    $categories = getTable("kb_categories");

    if (!isset($_GET['id'])) $id = 0;
    else $id = $_GET['id'];
    $articles = getTableFiltered("kb_articles", "categoryid", $id);
    foreach ($categories as $key => $category) {
        if ($category['clients'] == "") unset($categories[$key]);
        else {
            $clients = unserialize($category['clients']);
            if (in_array(0, $clients)) continue;
            else if (!in_array($liu['clientid'], $clients)) unset($categories[$key]);
        }
    }
    if (!isset($_GET['id'])) $id = 0;
    else $id = $_GET['id'];
    $articles = getTableFiltered("kb_articles", "categoryid", $id);
    foreach ($articles as $key => $article) {
        if ($article['clients'] == "") unset($articles[$key]);
        else {
            $clients = unserialize($article['clients']);
            if (in_array(0, $clients)) continue;
            else if (!in_array($liu['clientid'], $clients)) unset($articles[$key]);
        }
    }
}

if ($route == "invoicetaxfile") {
    $targetfile = "uploads" . DIRECTORY_SEPARATOR . "tax_file" . DIRECTORY_SEPARATOR . $_GET['invoicetaxfile'];

    if (file_exists($targetfile)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $_GET['filename'] . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($targetfile));
        readfile($targetfile);
        exit;
    } else echo "File does not exist.";
}

if ($route == "usage_report") {
    $usage_report = getTableFiltered("usage_report", "clientid", $lia['clientid']);
}

if ($route == "create_tickett") {
    $cont = getTableFiltered("contract", "clientid", $lia['clientid']);


    $client = getRowById("clients", $lia['clientid']);

    $contractsdepart = getTableFiltered2("contract", ["clientid" => $lia['clientid']], "department", "department", "ASC");
    $contractsdepart_n = getTableFiltered2("department", ["client_name" => $lia['clientid']], "id", "id", "ASC");

    $contract_usages = getTableFiltered("contract_usages", "contractid", $lia['clientid']);
    $assets = getTableFiltered("assets", "clientid", $lia['clientid']);
    $licenses = getTableFiltered("licenses", "clientid", $lia['clientid']);
    $credentials = getTableFiltered("credentials", "clientid", $lia['clientid']);
    $issues = getTableFiltered("issues", "clientid", $lia['clientid']);
    $tickets = getTableFiltered("tickets", "clientid", $lia['clientid']);
    $users = getTableFiltered("people", "clientid", $lia['clientid']);
    $admins = getTableFiltered("people", "type", "admin");
    $assignedadmins = getTableFiltered("clients_admins", "clientid", $lia['clientid']);
    $sumAssets = countTableFiltered("assets", "clientid", $lia['clientid']);
    $sumLicenses = countTableFiltered("licenses", "clientid", $lia['clientid']);
    $sumCredentials = countTableFiltered("credentials", "clientid", $lia['clientid']);
    $sumUsers = countTableFiltered("people", "clientid", $lia['clientid']);
    $sumContract = countTableFiltered("contract", "clientid", $lia['clientid']);
    $categories = getTable("assetcategories");
    $files = getTableFiltered("files", "clientid", $lia['clientid'], "file[!]", NULL);
    $projects = getTableFiltered("projects", "clientid", $lia['clientid']);
    $invoice = getTableFiltered("invoice", "clintid", $lia['clientid']);
    $recentcontracts = getTableFiltered2("contract", ["clientid" => $lia['clientid']], "*", "id", "DESC", "5");
    $labels = getTable("labels");
    $contracts = getTableFiltered2("contract", ["clientid" => $lia['clientid']], "*", "id", "ASC");
    $active_contracts = getTableFiltered("contract", "clientid", $lia['clientid'], "is_end", 0);
    $end_contracts = getTableFiltered("contract", "clientid", $lia['clientid'], "is_end", 1);
    $openTickets = $database->select("tickets", "*", ["AND" => ["status" => ["Open", "Reopened"], "clientid" => $lia['clientid']]]);
    $openTicketsall = $database->select("tickets", "*", ["AND" => ["status[!]" => ["Closed"], "clientid" => $lia['clientid']]]);
    $closeTicketsall = $database->select("tickets", "*", ["AND" => ["status" => ["Closed"], "clientid" => $lia['clientid']]]);



    $unpaidinvoice = getRecordsWithCondition('invoice', 'balance', '>', '0', 'clintid', '=', $lia['clientid']);

    $unpaidinvoice_count = count($unpaidinvoice);
    $file_to_upload = countwithconditiontextfile('invoice', 'clintid', '=', $lia['clientid']);
    $balace_to_pay = getTotalAmount('invoice', 'balance', 'clintid', $lia['clientid']);
}

if ($route == "complain_to_manger") {
    $clients = getTable("clients");
    $user_complain_list = get_complain_list();
    if ($_POST) {
        $status = insert_user_complain($_POST);
        header("Location:?route=complain_to_manger");
    }
}

// ASSETS
if ($route == "assets") {
    $assets = getTableFiltered("assets", "clientid", $lia['clientid']);
}

// LICENSES
if ($route == "licenses") {
    $licenses = getTableFiltered("licenses", "clientid", $lia['clientid']);
}




// CONTRACT 
if ($route == "contract/manage") {
    $contract = getRowById("contract", $_GET['id']);
    $clients = getTable("clients");
    //    $admins = getTableFiltered("people", "type", "admin");
    //    $users = getTableFiltered("people", "type", "user");
    $models = getTable("models");
    //    $manufacturers = getTable("manufacturers");
    $contracttypes = getTable("contracttype");
    $categories = getTable("assetcategories");
    $tickets = getTableFiltered("tickets", "contractid", $_GET['id']);
    $files = getTableFiltered("contract_files", "contractid", $_GET['id']);
    $contract_usages = getTableFiltered("contract_usages", "contractid", $_GET['id']);
    $query = $database->query("SELECT assets.*, models.name as model_name FROM assets JOIN models ON assets.modelid = models.id WHERE assets.clientid = 0 OR assets.id = " . $contract['assetid']);
    $assets = $query->fetchAll();
    $query = $database->query(
        "SELECT contract_history.id as history_id,contract_history.deployeddate, contract_history.pulledoutdate,contract_history.memo,contract_history.maintenance, assets.*, models.name as model_name "
            . "FROM contract_history "
            . "JOIN assets ON assets.id = contract_history.assetid "
            . "JOIN models ON assets.modelid = models.id "
            . "WHERE contract_history.contractid = " . $_GET['id']
            . " ORDER BY contract_history.id DESC"
    );
    //$histories = getTableFiltered("contract_history", "contractid", $_GET['id']);

    $histories = $query->fetchAll();


    $usage_report_data = get_usage_report_data($_GET['id']);
    $filter_usage_data = [];
    foreach ($usage_report_data as $usage_report) {
        $filter_data = [];
        foreach ($usage_report as $key => $value) {
            if (!is_int($key)) {
                $filter_data[$key] =  $value;
                if ($key == 'contract_id') {
                    $contract_data = get_contract_no_contract_id($value);
                    if ($contract_data[0]['contractno'] != '') {
                        $filter_data['contract_no'] = $contract_data[0]['contractno'];
                    }
                }
            }
        }
        $filter_usage_data[] = $filter_data;
    }
    $page_count_report = $filter_usage_data;


    //    cs_debug($assets);
    //$section = 'history';
}
// TICKETS
if ($route == "tickets"){
    // $tickets = getTableFiltered("tickets", "clientid", $lia['clientid']);
    global $database;
    $select1 = "SELECT tickets.* , department.name AS department_name FROM `tickets` JOIN contract on contract.id = tickets.contractid JOIN department on department.id = contract.department WHERE tickets.clientid =". $lia['clientid'];
    $query1 = $database->query($select1);
    $tickets = $query1->fetchAll();

}
    
if ($route == "tickets/manage") {
    global $database;
    $uid =  $lia['id'];
    $select1 = "SELECT * "
        . "FROM people "

        . "WHERE id =" . $uid;
    $query1 = $database->query($select1);
    $userdetail = $query1->fetchAll();
    $ticket = getRowById("tickets", $_GET['id']);

    $replies = getTableFiltered("tickets_replies", "ticketid", $_GET['id'], "", "", "*", "id", "DESC");
    $query = $database->query(
        "SELECT tickets_replies.*,ticket_reply_files.id as fileid, ticket_reply_files.name as filename,ticket_reply_files.file "
            . "FROM tickets_replies "
            . "JOIN ticket_reply_files ON tickets_replies.id = ticket_reply_files.ticket_reply_id "
            . "WHERE tickets_replies.ticketid = " . $_GET['id']
            . " ORDER BY tickets_replies.id DESC"
    );
    $replies = $query->fetchAll();
}

// TASKS
if ($route == "issues")
    $issues = getTableFiltered("issues", "clientid", $lia['clientid']);

// PROJECTS
if ($route == "projects")
    $projects = getTableFiltered("projects", "clientid", $lia['clientid']);


// REPORTS
if ($route == "reports") {
    $clients = getTable("clients");
    $admins = getTableFiltered("people", "type", "admin");
}
if ($route == "reports/view") {
    if ($_GET['report'] == "timesheet") {
        $startdate = $_GET['startDate'] . " 00:00:00";
        $enddate = $_GET['endDate'] . " 00:00:00";
        $issues = $database->select("issues", "*", ["AND" => [
            "dateadded[<>]" => [$startdate, $enddate],
            "clientid" => $lia['clientid']
        ]]);
    } elseif ($_GET['report'] == "timesheetSummary1" && $_GET['forticket'] == "ticket") {


        // echo "hiiii";
        // die("here");
        $startdate = $_GET['startDate'] . " 00:00:00";
        $enddate = $_GET['endDate'] . " 00:00:00";
        if ($_GET['clientid'] == "0") {
            // $assets = getTable("tickets");
            $consumable = getTable("consumable_list");
            $assets = $database->select("tickets", "*", [
                "timestamp[<>]" => [$startdate, $enddate]
            ]);

            $licenses = getTable("licenses");
            $issues = $database->select("issues", "*", [
                "dateadded[<>]" => [$startdate, $enddate]
            ]);
        } else {
            //$assets = getTableFiltered("tickets", "clientid", $_GET['clientid']);
            $consumable = getTable("consumable_list");
            $assets = $database->select("tickets", "*", ["AND" => [
                "timestamp[<>]" => [$startdate, $enddate],
                "clientid" => $_GET['clientid']
            ]]);
            $licenses = getTableFiltered("licenses", "clientid", $_GET['clientid']);
            $issues = $database->select("issues", "*", ["AND" => [
                "dateadded[<>]" => [$startdate, $enddate],
                "clientid" => $_GET['clientid']
            ]]);
        }
    } elseif ($_GET['report'] == "timesheetSummary") {
        $startdate = $_GET['startDate'] . " 00:00:00";
        $enddate = $_GET['endDate'] . " 00:00:00";
        $assets = getTableFiltered("assets", "clientid", $lia['clientid']);
        $licenses = getTableFiltered("licenses", "clientid", $lia['clientid']);
        $issues = $database->select("issues", "*", ["AND" => [
            "dateadded[<>]" => [$startdate, $enddate],
            "clientid" => $lia['clientid']
        ]]);
    } elseif ($_GET['report'] == "summary") {
        $assets = getTableFiltered("assets", "clientid", $lia['clientid']);
        $licenses = getTableFiltered("licenses", "clientid", $lia['clientid']);
    }
}

// LOGS
if ($route == "system/logs") {
    $systemLog = getTable("systemLog");
    $emailLog = getTable("emailLog");
}

// SYSTEM SETTINGS
if ($route == "system/logs") {
    $emailtemplates = getTable("emailTemplates");
}


if ($route == "reports/calendarview") {
    $ticket = array();
    $assets = getTableFiltered("tickets", "clientid", $lia['clientid']);
    $i = 0;
    // echo "<pre>";
    // print_r($assets);
    foreach ($assets as $asset) {
        $subject =    getRowById("ticketsubject", $asset['subject']);
        // echo "<pre>";
        // print_r($subject);
        $dipartment_id = getSingleValue('contract', 'department', $asset['contractid']);
        $dipartment_name = getSingleValue('department', 'name', $dipartment_id);
        // echo "<pre>";
        // print_r($subject);
        $ticket[$i]['id'] = $asset['id'];
        if ($asset['consumable_cost'] > 0) {
            $cost = $asset['consumable_cost'];
            $ticket[$i]['title'] = $cost . '-' . $subject['subject'] . '-' . $asset['id'] . '-' . $dipartment_name;
        } else {
            $ticket[$i]['title'] = $asset['id'] . '##' . $subject['subject'] . '##' . $dipartment_name;
        }
        $ticket[$i]['start'] = $asset['timestamp'];
        $i++;
    }

    echo json_encode($ticket);
    exit;
}

if ($route == "invoiceTPdf") {

    global $database, $mpdf, $scriptpath;

    $invoice = getTableFiltered("invoice", "id", $_GET['invoice_id']);

    $clientname = getSingleValue("clients", "name", $invoice[0]['clintid']);

    $contract_id = $invoice[0]['invoice_contract_id'];

    $invoice_datas = getinvoiceFiltered("contract", $contract_id);

    $logo = $database->get("config", "value", ["name" => "logo"]);

    ob_start();

    include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.php');

    $html = ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML($html);

    $pdfFilePath = "invoice.pdf";
    $mpdf->Output($pdfFilePath, "I");

    exit;
}

if (isset($_POST['addtaxfile'])) {
    $status = addtaxfile($_POST, $_FILES);
    header("Location:?route=invoice_payment");
}

if (isset($_POST['editUsageReport'])) {
    if ($_FILES['image']['name'] != '') {
        $status = editUsageReport($_POST, $_FILES);
    } else {
        $status = editUsageReport($_POST);
    }
    header("Location:?route=usage_report");
}
