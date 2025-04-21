<?php

// ----------------------------------------------------------------------------------------------
// GENERAL FUNCTIONS

function updateClientPaymentStatus($is_paymentReady, $clientId)
{
    global $database;
    $database->update("clients", ["is_paymentReady" => $is_paymentReady], ["id" => $clientId]);
    exit;
}

function updateallClientPaymentStatus($clientIds)
{
    global $database;
    foreach ($clientIds as $clientId) {
        $database->update("clients", ["is_paymentReady" => $is_paymentReady], ["id" => $clientId]);
    }
    exit;
}

function updateallClientInvoicememo($clientIds)
{
    global $database;
    for ($i = 0; $i < count($clientIds); $i++) {
        $database->update("clients", ["invoice_collection_note" => ''], ["id" => $clientIds[$i]]);
    }
    exit;
}

function randomString($chars = 10)
{ //generate random string
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $chars; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

function currentFileName()
{ //return current file name
    return basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
}

function baseURL($sub = 0)
{ //return base url for cron jobs
    $requesturi = explode("?", $_SERVER["REQUEST_URI"]);
    $subdir = $requesturi[0];
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"])) {
        if ($_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $subdir;
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $subdir;
    }
    return $pageURL;
}

function getGravatar($email, $size)
{ //get gravatar image for the given email address
    $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=mm" . "&s=" . $size;
    return $grav_url;
}

function curlReturn($url)
{ //get url with curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function rand_color()
{ //generate random color
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

function ttruncat($text, $numb = 30)
{
    if (strlen($text) > $numb) {
        $text = substr($text, 0, $numb);
        $text = substr($text, 0, strrpos($text, " "));
        $etc = " ...";
        $text = $text . $etc;
    }
    return $text;
}

// ----------------------------------------------------------------------------------------------
// GENERAL DATABASE FUNCTIONS

function getRowById($table, $id)
{ //return associative array from one row by id
    global $database;
    $row = $database->get($table, "*", ["id" => $id]);
    return $row;
}

function getRowByBasicformId($table, $id)
{ //return associative array from one row by id
    global $database;
    $row = $database->get($table, "*", ["contractid" => $id]);
    return $row;
}


function getRowbycoulmn($table, $coulmn, $id)
{ //return associative array from one row by id
    global $database;
    $row = $database->get($table, "*", [$coulmn => $id]);
    return $row;
}

function getSingleBasicformValue($table, $column, $id)
{ //returns single value from table row by id
    global $database;
    $value = $database->get($table, $column, ["contractid" => $id]);
    return $value;
}

function getSingleValue($table, $column, $id)
{ //returns single value from table row by id
    global $database;
    $value = $database->get($table, $column, ["id" => $id]);
    return $value;
}

function getTableasc($table, $columns = "*", $sortby = "name", $sortway = "ASC")
{ //get entire table
    global $database;
    $table = $database->select($table, $columns, ["ORDER" => $sortby . " " . $sortway]);
    return $table;
}

function getTable($table, $columns = "*", $sortby = "id", $sortway = "DESC")
{ //get entire table
    global $database;
    $table = $database->select($table, $columns, ["ORDER" => $sortby . " " . $sortway]);
    return $table;
}


function getTable12($table, $columns = "*", $sortby = "id", $sortway = "DESC")
{ //get entire table
    global $database;
    $table = $database->select($table, $columns);
    return $table;
}
function getTable13($table, $columns = "*", $sortby = "groupnm", $sortway = "DESC")
{ //get entire table
    global $database;
    $table = $database->select($table, $columns);
    return $table;
}

function getticketTable($table, $columns = "*", $sortby = "id", $sortway = "DESC")
{ //get entire table
    global $database;
    $table = $database->select($table, $columns, ["ORDER" => "status DESC"]);
    return $table;
}

function getTableFiltered($table, $filterColumn1, $filterValue1, $filterColumn2 = "", $filterValue2 = "", $columns = "*", $sortby = "id", $sortway = "ASC")
{ //get entire table filtered
    global $database;
    if ($filterColumn2 == "") {
        $table = $database->select($table, $columns, [$filterColumn1 => $filterValue1, "ORDER" => $sortby . " " . $sortway]);
    } else {
        $table = $database->select($table, $columns, ["AND" => [$filterColumn1 => $filterValue1, $filterColumn2 => $filterValue2], "ORDER" => $sortby . " " . $sortway]);
    }

    return $table;
}

function getinvoiceFiltered($table, $id, $columns = "*")
{
    global $database;

    if ($id) {
        $sql = "SELECT * FROM $table WHERE id IN ($id)";
        $query = $database->query($sql);
        $table = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    return $table;
}

function getTableFiltered_collection($table, $filterColumn1, $filterValue1, $columns = "*", $sortby = "id", $sortway = "ASC")
{
    global $database;
    $sql = "SELECT email, id, clientid"
        . " FROM people "
        . " WHERE $filterColumn1 = " . $filterValue1 . " AND collection_change = 1"
        . " ORDER BY id DESC";


    $query = $database->query($sql);
    $collection_user = $query->fetchAll(PDO::FETCH_ASSOC);

    return $collection_user;
}


function getTableFiltereddc($table, $filterColumn1, $filterValue1, $filterColumn2 = "", $filterValue2 = "", $columns = "*", $sortby = "id", $sortway = "ASC")
{ //get entire table filtered
    global $database;
    if ($filterColumn2 == "") {
        $table1 = $database->select($table, $columns, [$filterColumn1 => $filterValue1, "ORDER" => $sortby . " " . $sortway]);
    } else {
        $table1 = $database->select($table, $columns, ["AND" => [$filterColumn1 => $filterValue1, $filterColumn2 => $filterValue2], "ORDER" => $sortby . " " . $sortway]);
    }
    return $table1;
}
function getTableFiltereddc2($table, $filterColumn1, $filterValue1, $filterColumn2 = "", $filterValue2 = "", $filterColumn3 = "", $filterValue3 = "", $columns = "*", $sortby = "id", $sortway = "DESC")
{ //get entire table filtered
    global $database;
    if ($filterColumn2 == "") {
        $table1 = $database->select($table, $columns, [$filterColumn1 => $filterValue1, "ORDER" => $sortby . " " . $sortway]);
    } else {
        $table1 = $database->select($table, $columns, ["AND" => [$filterColumn1 => $filterValue1, $filterColumn2 => $filterValue2, $filterColumn3 => $filterValue3], "ORDER" => $sortby . " " . $sortway]);
    }
    return $table1;
}
function getTableFilteredsorbynm($table, $filterColumn1, $filterValue1, $filterColumn2 = "", $filterValue2 = "", $columns = "*", $sortby = "name", $sortway = "ASC")
{ //get entire table filtered
    global $database;
    if ($filterColumn2 == "") {
        $table = $database->select($table, $columns, [$filterColumn1 => $filterValue1, "ORDER" => $sortby . " " . $sortway]);
    } else {
        $table = $database->select($table, $columns, ["AND" => [$filterColumn1 => $filterValue1, $filterColumn2 => $filterValue2]], ["ORDER" => $sortby . " " . $sortway]);
    }
    return $table;
}

function countTable($table)
{ //count table rows
    global $database;
    $count = $database->count($table);
    return $count;
}

function countTableFiltered($table, $filterColumn1, $filterValue1, $filterColumn2 = "", $filterValue2 = "")
{ //count table rows with filter
    global $database;
    if ($filterColumn2 == "") {
        $count = $database->count($table, [$filterColumn1 => $filterValue1]);
    } else {
        $count = $database->count($table, ["AND" => [$filterColumn1 => $filterValue1, $filterColumn2 => $filterValue2]]);
    }
    return $count;
}
function countTableFiltered2($table, $filterColumn1, $filterValue1, $filterColumn2 = "", $filterValue2 = "", $filterColumn3 = "", $filterValue3 = "")
{ //count table rows with filter
    global $database;
    if ($filterColumn2 == "") {
        $count = $database->count($table, [$filterColumn1 => $filterValue1]);
    } else {
        $count = $database->count($table, ["AND" => [$filterColumn1 => $filterValue1, $filterColumn2 => $filterValue2, $filterColumn3 => $filterValue3]]);
    }
    return $count;
}

function getConfigValue($name)
{ //return config value from database
    global $database;
    return $database->get("config", "value", ["name" => $name]);
}

function deleteRowById($table, $id)
{ //detete row(s) by id
    global $database;
    $database->delete($table, ["id" => $id]);
    return "delOK";
}


function getTotalAmountofcontract($table, $column, $filterColumn1, $filterValue1)
{
    global $database;
    $sum1 = $database->sum($table, "tcolora3", [$filterColumn1 => $filterValue1]);
    $sum2 = $database->sum($table, "tcolora4", [$filterColumn1 => $filterValue1]);
    $sum3 = $database->sum($table, "tblacka3", [$filterColumn1 => $filterValue1]);
    $sum4 = $database->sum($table, "tblacka4", [$filterColumn1 => $filterValue1]);
    $sum = $sum1 + $sum2 + $sum3 + $sum4;

    return $sum;
}


function getTotalAmount($table, $column, $filterColumn1, $filterValue1, $filterColumn2 = "", $filterValue2 = "")
{
    global $database;
    $sum = $database->sum($table, $column, [$filterColumn1 => $filterValue1]);
    if ($filterColumn2 == "") {
        $sum = $database->sum($table, $column, [$filterColumn1 => $filterValue1]);
    } else {
        $sum = $database->sum($table, $column, ["AND" => [$filterColumn1 => $filterValue1, $filterColumn2 => $filterValue2]]);
    }
    //cs_debug($sum);
    return $sum;
}

function getTotalAmountAll($table, $column)
{
    global $database;

    $sum = $database->sum($table, $column);

    return $sum;
}

function getTotalBalance($table, $column)
{
    global $database;
    // $total_balance = $database->sum($table, $column);
    // return $total_balance;
    $sql = "select sum(balance) as total_balance from invoice
    left join clients on clients.id = invoice.clintid
    where clients.is_active = 1";
    $query = $database->query($sql);
    $contracts = $query->fetch();

    return isset($contracts['total_balance']) ? $contracts['total_balance'] : 0;
}




function getCRDate($table, $column, $filterColumn1, $filterValue1)
{
    global $database;
    $result = $database->min($table, $column, [$filterColumn1 => $filterValue1]);
    //    cs_debug($result);
    return $result;
}

function getTableFiltered2($table, $where = [], $columns = "*", $sortby = "id", $sortway = "ASC", $limit = "")
{ //get entire table filtered
    global $database;
    $where['ORDER'] = $sortby . " " . $sortway;
    if ($limit != "") {
        $where['LIMIT'] = $limit;
    }
    $table = $database->select($table, $columns, $where);
    return $table;
}


function getTableFiltered3($table, $columns = "*", $sortby = "id", $sortway = "ASC", $limit = "")
{ //get entire table filtered
    global $database;
    $where['ORDER'] = $sortby . " " . $sortway;
    if ($limit != "") {
        $where['LIMIT'] = $limit;
    }
    $table = $database->select($table, $columns, $where);
    return $table;
}

function getlastdata($table, $column, $where = [])
{

    $where['LIMIT'] = 1;
    $where['ORDER'] = "id DESC";
    global $database;
    $value = $database->select($table, $column, $where);
    // print_r($value);
    return $value;
}



function getSingleValue2($table, $column, $filtercolumn, $filtervalue)
{ //returns single value from table row by id
    global $database;
    $value = $database->get($table, $column, [$filtercolumn => $filtervalue]);
    return $value;
}

function getMaxValue($table, $column, $where = [])
{
    global $database;
    $value = $database->max($table, $column, $where);
    return $value;
}



// ----------------------------------------------------------------------------------------------
// LOADERS

function classAutoload($classname)
{
    global $scriptpath;
    $file = $scriptpath . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . strtolower($classname) . DIRECTORY_SEPARATOR . strtolower($classname) . '.php';
    if (file_exists($file))
        require($file);
}

// ----------------------------------------------------------------------------------------------
// AUTH FUNCTIONS

function login($email, $password)
{ //login and set session
    global $database;
    $email = strtolower($email);
    $people = $database->count("people", ["AND" => ["email" => $email, "password" => sha1($password)]]);

    if ($people == "1") {
        session_start();
        $sessionid = session_id();
        $database->update("people", ["sessionid" => $sessionid], ["email" => $email]);
        // header("Location:?route=tickets/pending_ticket");
        if (isset($_SESSION['redirect_url_qr']) && $_SESSION['redirect_url_qr'] != '') {
            header("Location: " . $_SESSION['redirect_url_qr']);
        } else {
            header("Location:?route=dashboard");
        }
        exit;
    } else {
        header("Location:?route=login&status=1200");
        exit;
    }
}

function resetConfirmation($email)
{ //set password resetkey and send confirmation email for password reset
    global $database;
    $email = strtolower($email);
    $count = $database->count("people", ["email" => $email]);

    if ($count == "1") {
        $people = $database->get("people", "*", ["email" => $email]);
        $resetkey = randomString(32);
        $database->update("people", ["resetkey" => $resetkey], ["email" => $email]);
        $resetlink = baseURL() . "/?route=forgot&resetkey=" . $resetkey;
        passwordResetNotification($people['id'], $resetlink);
        header("Location:?route=forgot&status=1300&mail=1");
        exit;
    } else {
        header("Location:?route=forgot&status=1400");
        exit;
    }
}




function resetPassword($resetkey, $password)
{ //reset password
    global $database;
    $count = $database->count("people", ["resetkey" => $resetkey]);

    if ($count == "1") {
        $database->update("people", ["password" => sha1($password), "resetkey" => ""], ["resetkey" => $resetkey]);
        header("Location:?route=login&status=1600");
        exit;
    } else {
        header("Location:?route=forgot&status=1500");
        exit;
    }
}

function logOut($id)
{ //unset user/admin session
    global $database;
    $database->update("people", ["sessionid" => ""], ["id" => $id]);
    header("Location:?route=login");
    exit;
}

function isLoggedIn()
{ //check if someone is logged in, if not redirect to login page
    global $database;
    session_start();
    $sessionid = session_id();
    $people = $database->count("people", ["sessionid" => $sessionid]);

    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    $full_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $parsed_url = parse_url($full_url);
    if (isset($parsed_url['query'])) {
        parse_str($parsed_url['query'], $query_params);  // Parse the query string into an associative array
        if (isset($query_params['qr']) && $query_params['qr'] == '1') {
            $_SESSION['redirect_url_qr'] = $full_url;
        }
    }

    if ($people != 1) {
        header("Location:?route=login");
        exit;
    }
}

// ----------------------------------------------------------------------------------------------
// ADMINS

function addAdmin($data)
{
    global $database;
    $email = strtolower($data['email']);
    $count = $database->count("people", ["email" => $email]);
    if ($count == "1") {
        return "11";
        break;
    }

    $password = sha1($data['password']);
    $lastid = $database->insert("people", [
        "type" => "admin",
        "clientid" => "0",
        "name" => $data['name'],
        "email" => $email,
        "title" => $data['title'],
        "mobile" => $data['mobile'],
        "password" => $password,
        "theme" => "skin-blue",
        "sidebar" => "opened",
        "layout" => "",
        "notes" => "",
        "signature" => "",
        "sessionid" => "",
        "role" => $data['role'],
        "resetkey" => ""
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        if (isset($data['notification'])) {
            if ($data['notification'] == true)
                newUserNotification($lastid, $data['password']);
        }
        return "10";
    }
}

function editAdmin($data)
{
    global $database;
    // echo"<pre>";
    // print_r($data);

    $email = strtolower($data['email']);
    if ($data['password'] == "" && $data['role'] == "") {
        $database->update("people", [
            "name" => $data['name'],
            "email" => $email,
            "title" => $data['title'],
            "mobile" => $data['mobile'],
            "theme" => $data['theme'],
            "sidebar" => $data['sidebar'],
            "layout" => $data['layout'],
            "notes" => $data['notes'],
            "signature" => $data['signature']
        ], ["id" => $data['id']]);
        return "20";
    } elseif ($data['password'] == "" && $data['role'] != "") {

        $database->update("people", [
            "name" => $data['name'],
            "email" => $email,
            "title" => $data['title'],
            "mobile" => $data['mobile'],
            "theme" => $data['theme'],
            "sidebar" => $data['sidebar'],
            "layout" => $data['layout'],
            "notes" => $data['notes'],
            "role" => $data['role'],
            "signature" => $data['signature']
        ], ["id" => $data['id']]);
        return "20";
    } elseif ($data['role'] == "") {

        $database->update("people", [
            "name" => $data['name'],
            "email" => $email,
            "title" => $data['title'],
            "mobile" => $data['mobile'],
            "password" => $password,
            "theme" => $data['theme'],
            "sidebar" => $data['sidebar'],
            "layout" => $data['layout'],
            "notes" => $data['notes'],

            "signature" => $data['signature']
        ], ["id" => $data['id']]);
        return "20";
    } else {
        $password = sha1($data['password']);
        $database->update("people", [
            "name" => $data['name'],
            "email" => $email,
            "title" => $data['title'],
            "mobile" => $data['mobile'],
            "password" => $password,
            "theme" => $data['theme'],
            "sidebar" => $data['sidebar'],
            "layout" => $data['layout'],
            "notes" => $data['notes'],
            "role" => $data['role'],
            "signature" => $data['signature']
        ], ["id" => $data['id']]);
        return "20";
    }
}

function deleteAdmin($id)
{
    global $database;
    $database->delete("people", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------
// CLIENTS

function addClient($data)
{
    global $database;
    $lastid = $database->insert("clients", ["name" => $data['name'], "tax_identification_number" => $data['tax_identification_number'], "contact_person" => $data['contact_person'], "it_manager_email" => $data['it_manager_email'], "purc_manager_email" => $data['purc_manager_email'], "contact_no" => $data['contact_no'], "client_memo" => $data['client_memo']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editClient($data)
{
    global $database;

    $is_active = isset($data['is_active']) ? 1 : 0;

    $database->update("clients", [
        "name" => $data['name'],
        "tax_identification_number" => $data['tax_identification_number'],
        "contact_person" => $data['contact_person'],
        "contact_no" => $data['contact_no'],
        "client_memo" => $data['client_memo'],
        "tech_incharge" => $data['technician_name'],
        "is_active" => $is_active,
        "it_manager_email" => $data['it_manager_email'],
        "purc_manager_email" => $data['purc_manager_email'],
        "clienttypes" => $data['clienttypes'],
        "default_payment_mode" => $data['default_payment_mode']
    ], ["id" => $data['id']]);
    return "20";
}

function editClientPendingInvoice($data)
{
    global $database;

    $is_active = isset($data['is_active']) ? 1 : 0;

    $database->update("clients", [
        "name" => $data['name'],
        "contact_person" => $data['contact_person'],
        "contact_no" => $data['contact_no'],
        "invoice_collection_note" => $data['invoice_collection_note'],
        "tech_incharge" => $data['technician_name'],
        "is_active" => $is_active,
        "it_manager_email" => $data['it_manager_email'],
        "purc_manager_email" => $data['purc_manager_email'],
        "clienttypes" => $data['clienttypes']
    ], ["id" => $data['id']]);
    return "20";
}

function update_technician_details($data)
{

    global $database;

    $database->update("contract", ["technician_name" => $data['technician_value'], "technician_mobile_no" => $data['tech_mobile_data'], "technician_mail_id" => $data['tech_mailid_data']], ["id" => $data['contractid']]);

    return "20";
}







function deleteClient($id)
{
    global $database;
    $database->delete("clients", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------
// GRAPHS


function workHoursByMonth($month, $clientid = 0)
{ //calculate how many hours were worked in a month
    global $database;
    $minutes = 0;
    $startDate = $month . "-01 00:00:00";
    $endDate = $month . "-31 00:00:00";;

    if ($clientid == 0) {
        $items = $database->select("issues", "*", [
            "dateadded[<>]" => [$startDate, $endDate]
        ]);
    } else {
        $items = $database->select("issues", "*", ["AND" => [
            "dateadded[<>]" => [$startDate, $endDate],
            "clientid" => $clientid
        ]]);
    }

    foreach ($items as $item) {
        $minutes = $minutes + $item['timespent'];
    }

    $hours = round($minutes / 60, 2);
    return $hours;
}

function countAssetsByCategory($categoryid, $clientid = 0)
{
    global $database;
    $items = 0;
    if ($clientid == 0) {
        $items = $database->count("assets", "*", [
            "categoryid" => $categoryid
        ]);
    } else {
        $items = $database->count("assets", "*", ["AND" => [
            "categoryid" => $categoryid,
            "clientid" => $clientid
        ]]);
    }

    return $items;
}

// ----------------------------------------------------------------------------------------------
// MONITORING

function addHost($data)
{
    global $database;
    $lastid = $database->insert("hosts", ["clientid" => $data['clientid'], "name" => $data['name'], "address" => $data['address'], "status" => ""]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editHost($data)
{
    global $database;
    $database->update("hosts", ["clientid" => $data['clientid'], "name" => $data['name'], "address" => $data['address'], "status" => ""], ["id" => $data['id']]);
    return "20";
}

function deleteHost($id)
{
    global $database;
    $database->delete("hosts", ["id" => $id]);
    $database->delete("hosts_checks", ["hostid" => $id]);
    $database->delete("hosts_admins", ["hostid" => $id]);
    return "30";
}

function addCheck($data)
{
    global $database;
    $lastid = $database->insert("hosts_checks", ["hostid" => $data['hostid'], "name" => $data['name'], "type" => $data['type'], "port" => $data['port'], "monitoring" => $data['monitoring'], "email" => $data['email'], "sms" => $data['sms'], "status" => ""]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editCheck($data)
{
    global $database;
    $database->update("hosts_checks", ["hostid" => $data['hostid'], "name" => $data['name'], "type" => $data['type'], "port" => $data['port'], "monitoring" => $data['monitoring'], "email" => $data['email'], "sms" => $data['sms'], "status" => ""], ["id" => $data['id']]);
    return "20";
}

function deleteCheck($id)
{
    global $database;
    $database->delete("hosts_checks", ["id" => $id]);
    return "30";
}

function addHostPeople($data)
{ //assign people to host
    global $database;
    $lastid = $database->insert("hosts_people", [
        "hostid" => $data['hostid'],
        "peopleid" => $data['peopleid']
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function deleteHostpeople($id)
{ //unassign people from host
    global $database;
    $database->delete("hosts_people", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------
// USERS

function addUser($data)
{

    global $database;
    $email = strtolower($data['email']);
    $count = $database->count("people", ["email" => $email]);
    if ($count == "1") {
        return "11";
        break;
    }
    $password = sha1($data['password']);
    if (isset($data['invoice'])) {
        $invoice = 1;
    } else {
        $invoice = 0;
    }

    $lastid = $database->insert("people", [
        "name" => $data['name'],
        "type" => "user",
        "clientid" => $data['clientid'],
        "email" => $email,
        "title" => $data['title'],
        "mobile" => $data['mobile'],
        "password" => $password,
        "theme" => "skin-blue",
        "sidebar" => "opened",
        "layout" => "",
        "notes" => "",
        "signature" => "",
        "sessionid" => "",
        "resetkey" => "",
        "user_page_count_check" => 1,
        "invoice" => $invoice
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        if (isset($data['notification'])) {
            if ($data['notification'] == true)
                newUserNotification($lastid, $data['password']);
        }
        return "10";
    }
}

function editUser($data)
{

    global $database;
    $email = strtolower($data['email']);
    if (isset($data['user_page_count_check'])) {
        $user_page_count_check = 1;
    } else {
        $user_page_count_check = 0;
    }

    if (isset($data['invoice'])) {
        $invoice = 1;
    } else {
        $invoice = 0;
    }
    if ($data['password'] == "") {
        $database->update("people", [
            "clientid" => $data['clientid'],
            "collection_change" => $data['collection_change'],
            "name" => $data['name'],
            "email" => $email,
            "title" => $data['title'],
            "mobile" => $data['mobile'],
            "theme" => $data['theme'],
            "sidebar" => $data['sidebar'],
            "layout" => $data['layout'],
            "notes" => $data['notes'],
            "user_page_count_check" => $user_page_count_check,
            "invoice" => $invoice
        ], ["id" => $data['id']]);
        return "20";
    } else {
        $password = sha1($data['password']);
        $database->update("people", [
            "clientid" => $data['clientid'],
            "collection_change" => $data['collection_change'],
            "name" => $data['name'],
            "email" => $email,
            "title" => $data['title'],
            "mobile" => $data['mobile'],
            "password" => $password,
            "theme" => $data['theme'],
            "sidebar" => $data['sidebar'],
            "layout" => $data['layout'],
            "notes" => $data['notes'],
            "user_page_count_check" => $user_page_count_check,
            "invoice" => $invoice
        ], ["id" => $data['id']]);
        return "20";
    }
}

function deleteUser($id)
{
    global $database;
    $database->delete("people", ["id" => $id]);
    return "30";
}
function editdipartment($data)
{

    global $database;

    $database->update(
        "department",
        [
            "name" => $data['name'],
            "client_name" => $data['routeid'],
            "person_In_charge" => $data['Person_incharge'],
            "average_printing" => $data['average_printing'],
            "department_memo" => $data['department_memo']
        ],
        ["id" => $data['id']]
    );
    return "20";
}

function deletedepartment($id)
{
    global $database;


    $database->update(
        "contract",
        [
            "department" => '0',
        ],
        ["department" => $id]
    );

    $database->delete("department", ["id" => $id]);



    return "30";
}

function addepartment($data)
{

    global $database;
    $lastid = $database->insert(
        "department",
        [
            "name" => $data['name'],
            "client_name" => $data['routeid'],
            "person_In_charge" => $data['Person_incharge'],
            "average_printing" => $data['average_printing'],
            "department_memo" => $data['department_memo']
        ]
    );
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}


// ----------------------------------------------------------------------------------------------
// ISSUES

function addIssue($data)
{
    global $database;
    $lastid = $database->insert("issues", [
        "clientid" => $data['clientid'],
        "assetid" => $data['assetid'],
        "projectid" => $data['projectid'],
        "adminid" => $data['adminid'],
        "issuetype" => $data['issuetype'],
        "priority" => $data['priority'],
        "status" => $data['status'],
        "name" => $data['name'],
        "description" => $data['description'],
        "duedate" => $data['duedate'],
        "timespent" => $data['timespent'],
        "dateadded" => date("Y-m-d H:i:s")
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editIssue($data)
{
    global $database;
    $database->update("issues", [
        "clientid" => $data['clientid'],
        "assetid" => $data['assetid'],
        "projectid" => $data['projectid'],
        "adminid" => $data['adminid'],
        "issuetype" => $data['issuetype'],
        "priority" => $data['priority'],
        "status" => $data['status'],
        "name" => $data['name'],
        "description" => $data['description'],
        "duedate" => $data['duedate'],
        "timespent" => $data['timespent']
    ], ["id" => $data['id']]);
    return "20";
}

function deleteIssue($id)
{
    global $database;
    $database->delete("issues", ["id" => $id]);
    return "30";
}

// USAGES

function addUsage($data)
{

    global $database;
    $lastid = $database->insert("asset_usages", [
        "clientid" => $data['clientid'],
        "assetid" => $data['assetid'],
        "projectid" => $data['projectid'],
        "adminid" => $data['adminid'],
        "checkeddate" => $data['checkeddate'],
        "startdate" => $data['startdate'],
        "enddate" => $data['enddate'],

        "total_mileage" => $data['total_mileage'],
        "month_mileage" => $data['month_mileage'],
        "start_mileage" => $data['start_mileage'],
        "end_mileage" => $data['end_mileage'],
        "description" => $data['description']
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editUsage($data)
{
    global $database;
    $database->update("asset_usages", [
        "clientid" => $data['clientid'],
        "assetid" => $data['assetid'],
        "projectid" => $data['projectid'],
        "adminid" => $data['adminid'],
        "checkeddate" => $data['checkeddate'],
        "startdate" => $data['startdate'],
        "enddate" => $data['enddate'],
        "total_mileage" => $data['total_mileage'],
        "month_mileage" => $data['month_mileage'],
        "start_mileage" => $data['start_mileage'],
        "end_mileage" => $data['end_mileage'],
        "description" => $data['description']
    ], ["id" => $data['id']]);
    return "20";
}

function deleteUsage($id)
{
    global $database;
    $database->delete("asset_usages", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------
// USAGES

function addContractUsage($data)
{

    // echo'</pre>';
    // die('if');

    global $database, $scriptpath;
    if ($data['wwwiin'] == 1) {

        $tcolora3 = 0;
        $tcolora4 = 0;
        $tblacka3 = 0;
        $tblacka4 = 0;


        if ($data['ecolora3'] != "") {
            if ($data['scolora3'] > $data['ecolora3']) {
                return "55";
            } else {
                $tcolora3 = $data['ecolora3'] - $data['scolora3'];
            }
        } else {
            return "55";
        }


        if ($data['ecolora4'] != "") {
            if ($data['scolora4'] > $data['ecolora4']) {

                return "55";
            } else {
                $tcolora4 = $data['ecolora4'] - $data['scolora4'];
            }
        } else {
            return "55";
        }
        if ($data['eblacka3'] != "") {
            if ($data['sblacka3'] > $data['eblacka3']) {

                return "55";
            } else {
                $tblacka3 = $data['eblacka3'] - $data['sblacka3'];
            }
        } else {
            return "55";
        }

        if ($data['eblacka4'] != "") {
            // $tblacka4 = $data['eblacka4'] - $data['sblacka4'];
            if ($data['sblacka4'] > $data['eblacka4']) {

                return "55";
            } else {
                $tblacka4 = $data['eblacka4'] - $data['sblacka4'];
            }
        } else {
            return "55";
        }
        if ($data['enddate'] != "") {
            if ($data['startdate'] > $data['enddate']) {

                return "55";
            }
        } else {
            return "55";
        }

        // // Check if files were uploaded
        // $targetFolder = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "usage_file_attachment" . DIRECTORY_SEPARATOR;
        // $status = 9500;
        // $allowedExtensions = ['jpg', 'jpeg', 'xls', 'xlsx'];
        // $errors = [];



        // if (!file_exists($targetFolder)) {
        //     mkdir($targetFolder, 0777, true);
        // }

        // if (isset($_FILES['attachment'])) {

        //     foreach ($_FILES['attachment']['tmp_name'] as $key => $tempFilePath) {
        //         $originalFileName = $_FILES['attachment']['name'][$key];
        //         $fileInfo = pathinfo($originalFileName);
        //         $fileExtension = strtolower($fileInfo['extension']);

        //         if (in_array($fileExtension, $allowedExtensions)) {
        //             $filename = time() . '_' . uniqid() . '.' . $fileExtension;
        //             $targetPath = $targetFolder . $filename;
        //             move_uploaded_file($tempFilePath, $targetPath);
        //             $newfilename[] = $filename;
        //         } else {
        //             $status = 9502;
        //             $errors[] = $originalFileName;
        //         }
        //     }
        // }



        // $database->update("contract_usages", ["statusid" => "Milage Updated"], ["id" => $data['cuid']]);

        //$database->update("contract", ["statusid" => "7"], ["id" => $data['contractid']]);

        //$database->update("assets", ["statusid" => "0", "status" => "For Pullout"], ["id" => $data['asetid']]);

        $lastid = $database->insert("contract_usages", [
            "clientid" => $data['clientid'],
            "contractid" => $data['contractid'],
            "assetid" => $data['asetid'],
            "checkeddate" => $data['checkeddate'],
            "startdate" => $data['startdate'],
            "enddate" => $data['enddate'],
            "total_mileage" => $data['total_mileage'],
            "month_mileage" => $data['month_mileage'],
            "start_mileage" => $data['start_mileage'],
            "end_mileage" => $data['end_mileage'],
            "description" => $data['description'],
            "billofmonth" => $data['billofmonth'],
            "transtype" => $data['transtype'],
            "scolora3" => $data['scolora3'],
            "scolora4" => $data['scolora4'],
            "sblacka3" => $data['sblacka3'],
            "sblacka4" => $data['sblacka4'],
            "ecolora3" => $data['ecolora3'],
            "ecolora4" => $data['ecolora4'],
            "eblacka3" => $data['eblacka3'],
            "eblacka4" => $data['eblacka4'],
            "tcolora3" => $tcolora3,
            "tcolora4" => $tcolora4,
            "tblacka3" => $tblacka3,
            "tblacka4" => $tblacka4,
            "add_page_count_by_order_reference" => $data['add_page_count_by_order_reference']
            // "statusid" => "On Hold"
            // "attachment" => $newfilename
        ]);


        $database->update("assets", ["status" => "On Hold"], ["id" => $data['asetid']]);
        if ($lastid == "0") {
            return "11";
        } else {
            return "10";
        }
    } else {


        $tcolora3 = 0;
        $tcolora4 = 0;
        $tblacka3 = 0;
        $tblacka4 = 0;
        $statusid = "On Hold";

        if ($data['ecolora3'] != "") {
            if ($data['scolora3'] > $data['ecolora3']) {
                return "55";
            } else {
                $tcolora3 = $data['ecolora3'] - $data['scolora3'];
            }
        } else {
            return "55";
        }

        if ($data['ecolora4'] != "") {
            if ($data['scolora4'] > $data['ecolora4']) {

                return "55";
            } else {
                $tcolora4 = $data['ecolora4'] - $data['scolora4'];
            }
        } else {
            return "55";
        }

        if ($data['eblacka3'] != "") {
            if ($data['sblacka3'] > $data['eblacka3']) {

                return "55";
            } else {
                $tblacka3 = $data['eblacka3'] - $data['sblacka3'];
            }
        } else {
            return "55";
        }

        if ($data['eblacka4'] != "") {
            if ($data['sblacka4'] > $data['eblacka4']) {

                return "55";
            } else {
                $tblacka4 = $data['eblacka4'] - $data['sblacka4'];
            }
        } else {
            return "55";
        }
        if ($data['enddate'] != "") {
            if ($data['startdate'] > $data['enddate']) {

                return "55";
            }
        } else {
            return "55";
        }

        // Check if files were uploaded
        $targetFolder = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "usage_file_attachment" . DIRECTORY_SEPARATOR;
        $status = 9500;
        $allowedExtensions = ['jpg', 'jpeg', 'xls', 'xlsx', 'gif', 'png',];
        $errors = [];



        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0777, true);
        }

        foreach ($_FILES['attachment']['tmp_name'] as $key => $tempFilePath) {
            $originalFileName = $_FILES['attachment']['name'][$key];
            $fileInfo = pathinfo($originalFileName);
            $fileExtension = strtolower($fileInfo['extension']);

            if (in_array($fileExtension, $allowedExtensions)) {
                $filename = time() . '_' . uniqid() . '.' . $fileExtension;
                $targetPath = $targetFolder . $filename;
                move_uploaded_file($tempFilePath, $targetPath);
                $newfilename[] = $filename;
            } else {
                $status = 9502;
                $errors[] = $originalFileName;
            }
        }


        $database->update("contract_usages", [
            "checkeddate" => date('Y-m-d'),
            "startdate" => $data['startdate'],
            "enddate" => $data['enddate'],
            "total_mileage" => $data['total_mileage'],
            "month_mileage" => $data['month_mileage'],
            "start_mileage" => $data['start_mileage'],
            "end_mileage" => $data['end_mileage'],
            "description" => $data['description'],
            "billofmonth" => $data['billofmonth'],
            "transtype" => $data['transtype'],
            "scolora3" => $data['scolora3'],
            "scolora4" => $data['scolora4'],
            "sblacka3" => $data['sblacka3'],
            "sblacka4" => $data['sblacka4'],
            "ecolora3" => $data['ecolora3'],
            "ecolora4" => $data['ecolora4'],
            "eblacka3" => $data['eblacka3'],
            "eblacka4" => $data['eblacka4'],
            "tcolora3" => $tcolora3,
            "tcolora4" => $tcolora4,
            "tblacka3" => $tblacka3,
            "add_page_count_by_order_reference" => $data['add_page_count_by_order_reference'],
            "statusid" => "On Hold",
            "attachment" => $newfilename
        ], ["id" => $data['cuid']]);

        $lastcontractdata = getlastdata('contract_usages', '*', array("contractid" => $data['contractid']));
        $lastcontract = $lastcontractdata[0];
        // echo'<pre>';
        // print_r($lastcontract);
        // print_r($data);
        // echo'</pre>';


        if ($data['contractid'] == $lastcontract['contractid']) {

            $lastid = $database->insert("contract_usages", [
                "clientid" => $lastcontract['clientid'],
                "contractid" => $lastcontract['contractid'],
                "assetid" => $lastcontract['assetid'],
                "checkeddate" => date('Y-m-d'),
                "startdate" => $lastcontract['enddate'],
                "enddate" => '',
                "total_mileage" => '',
                "month_mileage" => '',
                "start_mileage" => $lastcontract['end_mileage'],
                "end_mileage" => '',
                "description" => "New Milage",
                "transtype" => $data['transtype'],
                "billofmonth" => $data['billofmonth'],
                "scolora3" => $lastcontract['ecolora3'],
                "scolora4" => $lastcontract['ecolora4'],
                "sblacka3" => $lastcontract['eblacka3'],
                "sblacka4" => $lastcontract['eblacka4'],
                "ecolora3" => '',
                "ecolora4" => '',
                "eblacka3" => '',
                "eblacka4" => '',
                "tcolora3" => '',
                "tcolora4" => '',
                "tblacka3" => '',
                "tblacka4" => '',
                "statusid" => "On Service"
            ]);

            $database->update("contract_usages", ["statusid" => "Milage updated"], ["id" => $lastcontract['id']]);

            $database->update("assets", ["status" => "In Service"], ["id" => $lastcontract['assetid']]);
        }

        // $database->update("assets", ["status" => "On Hold"], ["id" => $data['asetid']]);	

        //$database->update("assets", ["statusid" => "0", "status" => "For Pullout"], ["id" => $data['asetid']]);
        return "20";
    }
}
function editContractUsage($data)
{
    global $database, $scriptpath;
    $tcolora3 = 0;
    $tcolora4 = 0;
    $tblacka3 = 0;
    $tblacka4 = 0;
    $statusid = "On Service";

    if ($data['ecolora3'] != "") {
        if ($data['scolora3'] > $data['ecolora3']) {
            return "55";
        } else {
            $tcolora3 = $data['ecolora3'] - $data['scolora3'];
        }
    } else {
        return "55";
    }


    if ($data['ecolora4'] != "") {
        if ($data['scolora4'] > $data['ecolora4']) {

            return "55";
        } else {
            $tcolora4 = $data['ecolora4'] - $data['scolora4'];
        }
    } else {
        return "55";
    }
    if ($data['eblacka3'] != "") {
        if ($data['sblacka3'] > $data['eblacka3']) {

            return "55";
        } else {
            $tblacka3 = $data['eblacka3'] - $data['sblacka3'];
        }
    } else {
        return "55";
    }

    if ($data['eblacka4'] != "") {
        // $tblacka4 = $data['eblacka4'] - $data['sblacka4'];
        if ($data['sblacka4'] > $data['eblacka4']) {

            return "55";
        } else {
            $tblacka4 = $data['eblacka4'] - $data['sblacka4'];
        }
    } else {
        return "55";
    }
    if ($data['enddate'] != "") {
        if ($data['startdate'] > $data['enddate']) {

            return "55";
        }
    } else {
        return "55";
    }


    // $usage =  getRowById("contract_usages", $data['id']);
    // $newfilename = array();
    // $attachmentArray = unserialize($usage['attachment']);

    $statusid = "On Hold";

    // Check if files were uploaded
    $targetFolder = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "usage_file_attachment" . DIRECTORY_SEPARATOR;
    $status = 9500;
    $allowedExtensions = ['jpg', 'jpeg', 'xls', 'xlsx', 'gif', 'png'];
    $errors = [];



    if (!file_exists($targetFolder)) {
        mkdir($targetFolder, 0777, true);
    }

    $clients = getTableFiltered("clients", 'id', $data['clientid']);
    $company_name = substr($clients[0]['name'], 0, 3);
    $current_date = date('Y-m-d');
    $unique_identifier = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

    $filename = $company_name . "_" . $current_date . $unique_identifier;


    if (isset($_FILES['attachment'])) {

        foreach ($_FILES['attachment']['tmp_name'] as $key => $tempFilePath) {

            $originalFileName = $_FILES['attachment']['name'][$key];
            $fileInfo = pathinfo($originalFileName);
            $fileExtension = strtolower($fileInfo['extension']);

            if (in_array($fileExtension, $allowedExtensions)) {

                $clients = getTableFiltered("clients", 'id', $data['clientid']);
                $company_name = substr($clients[0]['name'], 0, 3);
                $current_date = date('Y_m_d');
                $unique_identifier = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

                $filename = $company_name . "_" . $current_date . "_invoice_" . $unique_identifier;
                $targetPath = $targetFolder . $filename;
                move_uploaded_file($tempFilePath, $targetPath);
                $newfilename[] = $filename;
            } else {
                $status = 9502;
                $errors[] = $originalFileName;
            }
        }
    }

    // if (is_array($attachmentArray)) {
    //     $newfilename = array_merge($newfilename, $attachmentArray);
    // }


    $database->update("contract_usages", [
        "checkeddate" => date('Y-m-d'),
        "startdate" => $data['startdate'],
        "enddate" => $data['enddate'],
        "total_mileage" => $data['total_mileage'],
        "month_mileage" => $data['month_mileage'],
        "start_mileage" => $data['start_mileage'],
        "end_mileage" => $data['end_mileage'],
        "description" => $data['description'],
        "billofmonth" => $data['billofmonth'],
        "transtype" => $data['transtype'],
        "scolora3" => $data['scolora3'],
        "scolora4" => $data['scolora4'],
        "sblacka3" => $data['sblacka3'],
        "sblacka4" => $data['sblacka4'],
        "ecolora3" => $data['ecolora3'],
        "ecolora4" => $data['ecolora4'],
        "eblacka3" => $data['eblacka3'],
        "eblacka4" => $data['eblacka4'],
        "tcolora3" => $tcolora3,
        "tcolora4" => $tcolora4,
        "tblacka3" => $tblacka3,
        "tblacka4" => $tblacka4,
        "attachment" => $newfilename,
        "add_page_count_by_order_reference" => $data['add_page_count_by_order_reference']
    ], ["id" => $data['id']]);

    // "statusid" => $statusid,


    $database->update("assets", ["status" => "On Hold"], ["id" => $data['assetid']]);
    return "20";
}


function edit_basic_print_form($data)
{


    global $database;
    $lastcontractdata = getlastdata('print_chargies', '*', array("contractid" => $data['routeid']));

    $lastcontract = $lastcontractdata[0];

    if ($data['routeid'] == $lastcontract['contractid']) {
        $database->update("print_chargies", [
            "basic_charges" => $data['basic_charges'],
            "basic_black_a3" => $data['basic_black_a3'],
            "basic_black_a4" => $data['basic_black_a4'],
            "basic_color_print_a3" => $data['basic_color_print_a3'],
            "basic_color_print_a4" => $data['basic_color_print_a4']
        ]);
    } else {

        $database->insert("print_chargies", [
            "contractid" => $data['routeid'],
            "basic_charges" => $data['basic_charges'],
            "basic_black_a3" => $data['basic_black_a3'],
            "basic_black_a4" => $data['basic_black_a4'],
            "basic_color_print_a3" => $data['basic_color_print_a3'],
            "basic_color_print_a4" => $data['basic_color_print_a4']
        ]);
    }
}

function extra_basic_chargies($data)
{

    global $database;
    $lastcontractdata = getlastdata('print_chargies', '*', array("contractid" => $data['routeid']));

    $lastcontract = $lastcontractdata[0];

    if ($data['routeid'] == $lastcontract['contractid']) {
        $database->update("print_chargies", [
            "extra_black_a3" => $data['extra_black_a3'],
            "extra_black_a4" => $data['extra_black_a4'],
            "extra_color_print_a3" => $data['extra_color_print_a3'],
            "extra_color_print_a4" => $data['extra_color_print_a4']
        ]);
    } else {

        $database->insert("print_chargies", [
            "contractid" => $data['routeid'],
            "extra_black_a3" => $data['extra_black_a3'],
            "extra_black_a4" => $data['extra_black_a4'],
            "extra_color_print_a3" => $data['extra_color_print_a3'],
            "extra_color_print_a4" => $data['extra_color_print_a4']
        ]);
    }
}


function extra_text_chargies($data)
{

    global $database;
    $lastcontractdata = getlastdata('print_chargies', '*', array("contractid" => $data['routeid']));

    $lastcontract = $lastcontractdata[0];



    if ($data['routeid'] == $lastcontract['contractid']) {

        $database->update("print_chargies", [
            "extrachargies" => $data['extrachargies'],
        ]);
    } else {
        $database->insert("print_chargies", [
            "contractid" => $data['routeid'],
            "extrachargies" => $data['extrachargies'],
        ]);
    }
}

function HoldContract($data)
{
    global $database;

    $lastcontractdata = getlastdata('contract_usages', '*', array("contractid" => $data['contractid']));

    $lastcontract = $lastcontractdata[0];

    if ($data['contractid'] == $lastcontract['contractid']) {
        $database->update("contract_usages", ["statusid" => "On Hold"], ["id" => $lastcontract['id']]);
        $database->update("assets", ["status" => "On Hold"], ["id" => $lastcontract['assetid']]);
    }
    return "50";
}


function ResumeContract($data)
{
    global $database;
    $lastcontractdata = getlastdata('contract_usages', '*', array("contractid" => $data['contractid']));
    $lastcontract = $lastcontractdata[0];
    // echo'<pre>';
    // print_r($lastcontract);
    // print_r($data);
    // echo'</pre>';


    if ($data['contractid'] == $lastcontract['contractid']) {

        // $lastid = $database->insert("contract_usages", [
        //     "clientid" => $lastcontract['clientid'],
        //     "contractid" => $lastcontract['contractid'],
        //     "assetid" => $lastcontract['assetid'],
        //     "checkeddate" => date('Y-m-d'),
        //     "startdate" => $lastcontract['enddate'],
        //     "enddate" => '',
        //     "total_mileage" => '',
        //     "month_mileage" => '',
        //     "start_mileage" => $lastcontract['end_mileage'],
        //     "end_mileage" => '',
        //     "description" => "New Milage",
        // 	"scolora3" => $lastcontract['ecolora3'],
        // 	"scolora4" => $lastcontract['ecolora4'],
        // 	"sblacka3" => $lastcontract['eblacka3'],
        // 	"sblacka4" => $lastcontract['eblacka4'],
        // 	"ecolora3" => '',
        // 	"ecolora4" => '',
        // 	"eblacka3" => '',
        // 	"eblacka4" => '',
        // 	"tcolora3" => '',
        // 	"tcolora4" => '',
        // 	"tblacka3" => '',
        // 	"tblacka4" => '',
        // 	"statusid" => "On Service"
        // ]);	

        // $database->update("contract_usages", ["statusid" => "Milage updated"], ["id" => $lastcontract['id']]);	

        $database->update("contract_usages", ["statusid" => "On Service"], ["id" => $lastcontract['id']]);

        $database->update("assets", ["status" => "In Service"], ["id" => $lastcontract['assetid']]);
    }
    return "50";
}

function editassetUsage($data)
{

    // echo'<pre>';
    // print_r($data);
    // echo'</pre>';
    // die('grgrgr');
    global $database;

    $database->update("assets", [
        "udate" => $data['startdate'],
        "A3blk" => $data['sblacka3'],
        "A3clr" => $data['scolora3'],
        "A4blk" => $data['sblacka4'],
        "A4clr" => $data['scolora4']
    ], ["id" => $data['id']]);
    return "20";
}

function endcontract($id)
{
    global $database;
    $assettdata =    getTableFiltered("contract", "id", $id);
    $assettid =    getTableFiltered("assets", "id", $assettdata[0]['assetid']);
    $endid = getlastdata('contract_usages', 'id', ['contractid' => $id]);

    // echo'<pre>';
    // print_r($endid[0]);
    // echo'</pre>';
    // die('bbg');
    $database->update(
        "contract",
        [
            "statusid" => "8",
            "is_end" => "1",
            "is_endservice" => "1",
            "endservice" => "End",
            "endasset" => "End",

            "memo" => "Contract End"
        ],
        ["id" => $id]
    );

    $database->update("contract_usages", ["statusid" => "Contract End", "enddate" => date('Y-m-d')], ["id" => $endid[0]]);
    $database->update("assets", ["statusid" => "8", "status" => "For Pullout"], ["id" => $assettdata[0]['assetid']]);
    return "20";
}

function deleteContractUsage($id)
{
    global $database;
    $database->delete("contract_usages", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------
// TICKETS

function addTicket($data, $files)
{
    global $database;
    if ($data['department'] != "") {
        $depart = $data['department'];
    } else {
        $depart = "Other Department";
    }
    // echo "<pre>";
    // print_r($files);

    $uploaded = uploadTicketFile($files);


    // echo "<pre>";
    // print_r($uploaded);
    // die("hee");
    // echo "<pre>";
    // print_R($uploaded);
    // die("here");

    $ticket = rand(100000, 999999);
    $ticketid = $database->insert("tickets", [
        "ticket" => $ticket,
        "clientid" => $data['clientid'],
        "contractid" => $data['contractid'],
        "userid" => $data['userid'],
        "adminid" => $data['adminid'],
        "assetid" => $data['assetid'],
        "email" => $data['email'],
        "subject" => $data['subject'],
        "status" => "Open",
        "priority" => $data['priority'],
        "timestamp" => date('Y-m-d H:i:s'),
        "notes" => ""
    ]);

    $lastid = $database->insert("tickets_replies", [
        "ticketid" => $ticketid,
        "adminid" => $data['adminid'],
        "userid" => $data['userid'],
        "message" => $data['message'],
        "timestamp" => date('Y-m-d H:i:s')
    ]);
    $n  = $database->insert("ticket_reply_files", [
        "ticket_reply_id" => $lastid,
        "name" => "Reply#" . $lastid,
        "file" => $uploaded['ticket_file']
    ]);
    // echo'<pre>';
    // print_r($n);
    //print_r($data);
    // echo'</pre>';
    // die('fbt');
    if ($lastid == "0") {
        return "11";
    } else {
        if (isset($data['notification'])) {
            if ($data['notification'] == true)

                ticketNotification($ticketid, $data['status'], $data['message'], 1, $depart, $data['contractid']);
        }
        return "10";
    }
}

function adcontractconsum($data)
{
    global $database;

    // echo'<pre>';
    // print_r($data);
    // echo'</pre>';
    // die('fbt');
    $lastid = $database->insert("consumable", [
        "client_id" => $data['clientid'],
        "contract" => $data['contractid'],
        "consumable_type" => $data['consumable'],
        "cyan" => $data['cyan'],
        "magenta" => $data['magenta'],
        "yellow" => $data['yellow'],
        "black" => $data['black'],
        "others" => $data['others'],
        "servced" => $data['adminid'],
        "date" => date('Y-m-d'),
        "assetid" => $data['assetid'],
        "msg" => $data['message']
    ]);

    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function edtcontractconsum($data)
{
    global $database;
    // echo'<pre>';
    // print_r($data);
    // echo'</pre>';
    // die('fbt');
    $database->update("consumable", [
        "client_id" => $data['clientid'],
        "contract" => $data['contractid'],
        "consumable_type" => $data['consumable'],
        "cyan" => $data['cyan'],
        "magenta" => $data['magenta'],
        "yellow" => $data['yellow'],
        "black" => $data['black'],
        "others" => $data['others'],
        "servced" => $data['adminid'],
        "date" => date('Y-m-d'),
        "assetid" => $data['assetid'],
        "msg" => $data['message']
    ], ["id" => $data['id']]);
    return "20";
}
function deletecontractConsumable($id)
{
    global $database;
    $database->delete("consumable", ["id" => $id]);
    return "30";
}

function addTicketReply($data, $files)
{
    global $database;
    $uploaded = uploadTicketFile($files);
    if ($data['notification'] == true) {
        //ticketNotification($data['ticketid'], $data['message'], 2, $depart, $data['contractid']);
        ticketNotification($data['ticketid'], $data['status'], $data['message'], 2, '2', $data['contractid']);
    }

    if ($uploaded['status'] == 9500) {
        $lastid = $database->insert("tickets_replies", [
            "ticketid" => $data['ticketid'],
            "adminid" => $data['adminid'],
            "reply_u_id" => $data['reply_u_id'],
            "userid" => $data['userid'],
            "message" => $data['message'],
            "timestamp" => date('Y-m-d H:i:s')
        ]);

        updateTicketStatus($data['ticketid'], $data['status']);
        //updateTicketStatus($data['ticketid'], $data['status']);
        $database->update("tickets", [

            "closed_by" => $data['reply_u_id'],

        ], ["id" => $data['ticketid']]);


        $database->insert("ticket_reply_files", [
            "ticket_reply_id" => $lastid,
            "name" => "Reply#" . $lastid,
            "file" => $uploaded['ticket_file']
        ]);
        return "10";
        //header("Location: https://www.ticket.peza.com.ph"); 

    } else {
        return "12";
    }


    if ($lastid == "0") {
        return "11";
    } else {
        if (isset($data['notification'])) {
            if ($data['notification'] == true)
                //ticketNotification($data['ticketid'], $data['message'], 2, $depart, $data['contractid']);
                ticketNotification($data['ticketid'], $data['status'], $data['message'], 2, '2', $data['contractid']);
        }
        return "10";
    }
}

function editTicket($data)
{
    if (isset($data['dashboard_edit']) && $data['dashboard_edit'] == 1 && isset($data['adminid']) && $data['adminid'] != '') {
        $data['status'] == 'Closed';
    }
    global $database;
    $database->update("tickets", [
        "clientid" => isset($data['clientid']) ? $data['clientid'] : '',
        "userid" => isset($data['userid']) ? $data['userid'] : '',
        "adminid" => $data['adminid'],
        // "contractid" => $data['contractid'],
        "assetid" => isset($data['assetid']) ? $data['assetid'] : '',
        "email" => $data['email'],
        "subject" => isset($data['subject']) ? $data['subject'] : '',
        "status" => $data['status'],
        "priority" => $data['priority']
    ], ["id" => $data['id']]);
    return "20";
}

function updateTicketStatus($id, $status)
{
    global $database;
    $database->update("tickets", [
        "status" => $status
    ], ["id" => $id]);
    return "20";
}

function ticketAssignTo($id, $adminid)
{
    global $database;
    $database->update("tickets", [
        "adminid" => $adminid
    ], ["id" => $id]);
    return "20";
}

function addupdateTechnicianTickets($data, $files)
{
    global $database;

    $uploaded = uploadTechnicianFile($files, $data);
    if (!empty($data['technicain_report_id'])) {
        if ($uploaded['technician_file'] && $uploaded['fixed_image']) {
            $lastid = $database->update("technician_report", [
                "technician_comment" => $data['technician_comment'],
                "technician_id" => $data['technician_id'],
                "ticketid" => $data['ticketid'],
                "technician_file" => $uploaded['technician_file'],
                "diagnose_comment" => $data['diagnose_comment'],
                "problem_category" => $data['problem_category'],
                "fixed_image" => $uploaded['fixed_image'],
                "modelid" => $data['modelid'],
                "date" => date('Y_m_d'),
            ], ["id" => $data['technicain_report_id']]);
        } elseif ($uploaded['technician_file']) {
            $lastid = $database->update("technician_report", [
                "technician_comment" => $data['technician_comment'],
                "technician_id" => $data['technician_id'],
                "ticketid" => $data['ticketid'],
                "diagnose_comment" => $data['diagnose_comment'],
                "problem_category" => $data['problem_category'],
                "technician_file" => $uploaded['technician_file'],
                "modelid" => $data['modelid'],
                "date" => date('Y_m_d'),
            ], ["id" => $data['technicain_report_id']]);
        } elseif ($uploaded['fixed_image']) {
            $lastid = $database->update("technician_report", [
                "technician_comment" => $data['technician_comment'],
                "technician_id" => $data['technician_id'],
                "diagnose_comment" => $data['diagnose_comment'],
                "problem_category" => $data['problem_category'],
                "ticketid" => $data['ticketid'],
                "fixed_image" => $uploaded['fixed_image'],
                "modelid" => $data['modelid'],
                "date" => date('Y_m_d'),
            ], ["id" => $data['technicain_report_id']]);
        } else {
            $lastid = $database->update("technician_report", [
                "technician_comment" => $data['technician_comment'],
                "technician_id" => $data['technician_id'],
                "diagnose_comment" => $data['diagnose_comment'],
                "problem_category" => $data['problem_category'],
                "ticketid" => $data['ticketid'],
                "modelid" => $data['modelid'],
                "date" => date('Y_m_d'),
            ], ["id" => $data['technicain_report_id']]);
        }
        if ($lastid == "0") {
            return "11";
        } else {
            return "10";
        }
    } else {
        $lastid = $database->insert("technician_report", [
            "technician_comment" => $data['technician_comment'],
            "technician_id" => $data['technician_id'],
            "diagnose_comment" => $data['diagnose_comment'],
            "problem_category" => $data['problem_category'],
            "ticketid" => $data['ticketid'],
            "modelid" => $data['modelid'],
            "technician_file" => $uploaded['technician_file'],
            "fixed_image" => $uploaded['fixed_image'],
            "date" => date('Y_m_d'),
        ]);
        if ($lastid == "0") {
            return "11";
        } else {
            return "10";
        }
    }
    return "20";
}

function updateTicketNotes($data)
{

    global $database;


    $result = $database->update("tickets", [
        "notes" => $data['notes'],
        "status" => 'Closed',
        "closed_by" => $data['closed_by'],
        "technical_improvement" => $data['technical_improvement'],
        "refill" => $data['refill'],
        "consumable_list_id" => $data['consumable_list_id'],
        "consumable_cost" => $data['consumable_cost'],
        "parsts_replacments" => $data['parsts_replacments'],
        "ticketothers" => $data['ticketothers'],
        "pmcon" => $data['pmcon'],
        "cog" => $data['cog'],
        "client_handle_mistake" => $data['client_handle_mistake']
    ], ["id" => $data['id']]);

    if ($result) {
        $ticket_type = array();
        if ($data['client_handle_mistake'] == 1) {
            $ticket_type[] = ' Client Handle Mistake';
        }
        if ($data['technical_improvement'] == 1) {
            $ticket_type[] = ' For Technical Improvement';
        }
        if ($data['refill'] == 1) {
            $ticket_type[] = 'Refill & Preventive Maintenance';
        }
        if ($data['parsts_replacments'] == 1) {
            $ticket_type[] = 'Parts Replacments';
        }

        if ($data['ticketothers'] == 1) {
            $ticket_type[] = 'Others';
        }
        //echo "hiiii";
        SendTicketNoteEmail($data['ticket_email'], $data['notes'], $data['pmcon'], $ticket_type, $data);
    }
    return "20";
}

function deleteTicket($id)
{
    global $database;
    $database->delete("tickets", ["id" => $id]);
    $database->delete("tickets_replies", ["ticketid" => $id]);
    return "30";
}

// function deleteinvoice($id)
// {
//     global $database;
//     $database->delete("invoice", ["id" => $id]);
//     return "30";
// }

function deleteUsagereport($id)
{
    global $database, $scriptpath;
    $UsageReport = getTableFiltered("usage_report", 'id', $id);

    if ($UsageReport) {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . 'usage_report' . DIRECTORY_SEPARATOR;
        if ($UsageReport[0]['image']) {
            $imagePath = $targetdir . $UsageReport[0]['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }
    $database->delete("usage_report", ["id" => $id]);
    return "30";
}

function deleteactuallstatus($id)
{
    global $database, $scriptpath;
    $actualstatus = getTableFiltered("actual_report", 'id', $id);


    if ($actualstatus) {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . 'actual_report' . DIRECTORY_SEPARATOR;
        if ($actualstatus[0]['image']) {
            $imagePath = $targetdir . $actualstatus[0]['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }
    $database->delete("actual_report", ["id" => $id]);
    return "30";
}


function deleteinvinvoice($id)
{
    global $database, $scriptpath;
    $invoice = getTableFiltered("invoice", 'id', $id);

    if ($invoice) {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        if ($invoice[0]['attachment']) {
            $imagePath = $targetdir . $_GET['filename'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }
    $database->update("invoice", ["attachment" => ''], ["id" => $id]);
    return "30";
}

function clientPaidDelete($id)
{
    global $database, $scriptpath;
    $invoice = getTableFiltered("invoice", 'id', $id);

    if ($invoice) {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        $targetdir_1 = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "payment_proof" . DIRECTORY_SEPARATOR;
        if ($invoice[0]['paid_file']) {
            $imagePath = $targetdir . $invoice[0]['paid_file'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $imagePath_1 = $targetdir_1 . $invoice[0]['paid_file'];
            if (file_exists($imagePath_1)) {
                unlink($imagePath_1);
            }
        }
    }
    $database->update("invoice", ["paid_file" => ''], ["id" => $id]);
    return "30";
}

function clientOrDelete($id)
{
    global $database, $scriptpath;
    $invoice = getTableFiltered("invoice", 'id', $id);

    if ($invoice) {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        $targetdir_1 = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "official_reciept" . DIRECTORY_SEPARATOR;

        if ($invoice[0]['or_file']) {
            $imagePath = $targetdir . $invoice[0]['or_file'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $imagePath_1 = $targetdir_1 . $invoice[0]['or_file'];
            if (file_exists($imagePath_1)) {
                unlink($imagePath_1);
            }
        }
    }
    $database->update("invoice", ["or_file" => ''], ["id" => $id]);
    return "30";
}

function clientTaxDelete($id)
{
    global $database, $scriptpath;
    $invoice = getTableFiltered("invoice", 'id', $id);

    if ($invoice) {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        $targetdir_1 = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "tax_payment" . DIRECTORY_SEPARATOR;

        if ($invoice[0]['tax_file_2307']) {
            $imagePath = $targetdir . $invoice[0]['tax_file_2307'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $imagePath_1 = $targetdir_1 . $invoice[0]['tax_file_2307'];
            if (file_exists($imagePath_1)) {
                unlink($imagePath_1);
            }
        }
    }
    $database->update("invoice", ["tax_file_2307" => ''], ["id" => $id]);
    return "30";
}

function deleteinvoice($id)
{
    global $database, $scriptpath;

    $invoice = getTableFiltered("invoice", 'id', $id);

    if ($invoice) {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;

        if ($invoice[0]['attachment']) {
            $imagePath = $targetdir . $_GET['filename'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($invoice[0]['paid_file']) {
            $imagePath = $targetdir . $invoice[0]['paid_file'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($invoice[0]['or_file']) {
            $imagePath = $targetdir . $invoice[0]['or_file'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($invoice[0]['tax_file_2307']) {
            $targettaxdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "tax_file" . DIRECTORY_SEPARATOR;
            $imagePathDir = $targettaxdir . $invoice[0]['tax_file_2307'];

            if (file_exists($imagePathDir)) {
                unlink($imagePathDir);
            }
        }
    }

    $database->delete("invoice", ["id" => $id]);

    return "30";
}

function extractEmail($string)
{ //extract first email address from string
    $pattern = '/([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])' . '(([a-z0-9-])*([a-z0-9]))+' . '(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)/i';
    preg_match($pattern, $string, $matches);
    return $matches[0];
}

function emailToTicket($from, $subject, $body)
{

    $data = array();
    global $database;
    $data['email'] = extractEmail($from);

    $data['userid'] = $database->get("people", "id", ["AND" => ["type" => "user", "email" => $data['email']]]);
    if ($data['userid'] == "")
        $data['userid'] = 0;
    $data['adminid'] = $database->get("people", "id", ["AND" => ["type" => "admin", "email" => $data['email']]]);
    if ($data['adminid'] == "")
        $data['adminid'] = 0;
    if ($data['userid'] == 0)
        $data['clientid'] = 0;
    else
        $data['clientid'] = $database->get("people", "clientid", ["AND" => ["type" => "user", "email" => $data['email']]]);

    $data['assetid'] = 0;
    $data['subject'] = $subject;
    $data['priority'] = "Normal";

    $data['message'] = $body;


    if ($data['adminid'] != 0)
        $data['status'] = "Answered";
    else
        $data['status'] = "Reopened";


    $tickets = $database->select("tickets", ["id", "ticket"]);

    foreach ($tickets as $ticket) {
        if (strpos($subject, $ticket['ticket']) !== false) {
            $data['ticketid'] = $ticket['id'];
            $data['notification'] = false;
            break;
        } else {
            $data['ticketid'] = 0;
            $data['notification'] = getConfigValue("tickets_notification");
        }
    }

    if (empty($tickets)) {
        $data['ticketid'] = 0;
        $data['notification'] = getConfigValue("tickets_notification");
    }

    if ($data['ticketid'] == 0)
        addTicket($data);
    else
        addTicketReply($data);
}

// ----------------------------------------------------------------------------------------------
// CREDENTIALS

function addCredential($data)
{
    global $database;
    $lastid = $database->insert("credentials", [
        "clientid" => $data['clientid'],
        "assetid" => $data['assetid'],
        "type" => $data['type'],
        "username" => $data['username'],
        "password" => $data['password']
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editCredential($data)
{
    global $database;
    $database->update("credentials", [
        "clientid" => $data['clientid'],
        "assetid" => $data['assetid'],
        "type" => $data['type'],
        "username" => $data['username'],
        "password" => $data['password']
    ], ["id" => $data['id']]);
    return "20";
}

function deleteCredential($id)
{
    global $database;
    $database->delete("credentials", ["id" => $id]);
    return "30";
}

//  -----------------------------------------------------------------------------------------------------------------------
// warranty_card

function addwarranty($data, $files)
{

    global $database;
    $uploaded = uploadAssetFile($files, $data);

    // echo "<pre>";
    // print_r($data);
    // echo "<pre>";
    // die('gregrg');
    if ($uploaded['status'] == 9500) {
        $lastid = $database->insert("warranty", [
            "assetsid" => $data['manufacturerid'],
            "modalid" => $data['modelid'],
            "issudate" => $data['purchase_date'],
            "expairy" => $data['warranty_expiry'],
            "supplier" => $data['supplierid'],
            "serial" => $data['serial'],
            "remark" => $data['notes'],
        ]);
        $database->insert("warrantycard", [
            "warrantyid" => $lastid,
            "name" => "Invoice",
            "file" => $uploaded['invoice']
        ]);
        //cs_debug($lastid);
        if ($lastid == "0") {
            return "11";
        } else {
            return "10";
        }
    } else {
        return "12";
    }
}

function editwarranty($data, $files)
{
    global $database;

    $uploaded = uploadAssetFile($files, $data);
    if ($uploaded['status'] == 9500) {
        $database->update("warranty", [
            "assetsid" => $data['manufacturerid'],
            "modalid" => $data['modelid'],
            "issudate" => $data['purchase_date'],
            "expairy" => $data['warranty_expiry'],
            "supplier" => $data['supplierid'],
            "serial" => $data['serial'],
            "remark" => $data['notes'],
        ], ["id" => $data['id']]);
        $database->insert("warrantycard", [
            "warrantyid" => $data['id'],
            "name" => "Invoice",
            "file" => $uploaded['invoice']
        ]);
        return "20";
    } else {
        return "12";
    }
}

function editwrntyhistory($data, $files)
{
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    // die('gregrg');
    global $database;
    $uploaded = uploadinvoice($data, $files);
    if ($uploaded['status'] == 9500) {
        $database->update("warrantyhistory", [
            "dateout" => $data['dateout'],
            "datein" => $data['datein'],
            "details" => $data['details'],
            "status" => $data['sttats'],
            "estimatedate" => $data['estimatedate'],
            "remark" => $data['remark'],
            "claimstub" => $uploaded['name'],
        ], ["id" => $data['histryid']]);
        return "20";
    } else {
        return "12";
    }
}

function updatewarranty($data, $id)
{
    global $database;
    $database->update("warranty", [
        "status" => $data,
    ], ["id" => $id]);
}



function deletewarranty($id)
{
    global $database;
    $database->delete("warranty", ["id" => $id]);
    return "30";
}

function deletewrntyhistry($id)
{
    global $database;
    $database->delete("warrantyhistory", ["id" => $id]);
    return "30";
}

function addwrntyhistory($data, $files)
{
    // echo "<pre>";
    // print_r($files);
    // echo "<pre>";
    // die('gregrg');
    global $database;
    $uploaded = uploadinvoice($data, $files);
    if ($uploaded['status'] == 9500) {
        $lastid = $database->insert("warrantyhistory", [
            "warrantyid" => $data['warrantyid'],
            "dateout" => $data['dateout'],
            "datein" => $data['datein'],
            "details" => $data['details'],
            "status" => $data['sttats'],
            "estimatedate" => $data['estimatedate'],
            "remark" => $data['remark'],
            "assetsid" => $data['menufacturerid'],
            "modalid" => $data['modalid'],
            "serial" => $data['serialid'],
            "claimstub" => $uploaded['name'],

        ]);
        //cs_debug($lastid);
        if ($lastid == "0") {
            return "11";
        } else {
            return "10";
        }
    } else {
        return "12";
    }
}

// update_mamustatus
function update_memo_status($data)
{
    global $database;
    $contrctid = $data['contractid'];
    $contract_val = getTableFiltered("contract", "id", $contrctid);
    foreach ($contract_val as $contra) {
        $asstid = $contra['assetid'];
    }
    if (!empty($asstid)) {
        $database->update("assets", [
            "statusid" => $data['statusid'],
            "notes" => $data['text_area']
        ], ["id" => $asstid]);
        return "10";
    } else {
        return "12";
    }
}
function update_memo_status2($data)
{
    global $database;
    $contrctid = $data['contractid'];
    $contract_val = getTableFiltered("contract", "id", $contrctid);
    foreach ($contract_val as $contra) {
        $asstid = $contra['assetid'];
    }
    if (!empty($asstid)) {
        $database->update("assets", [
            "statusid" => $data['statusid'],

        ], ["id" => $asstid]);
        return "10";
    } else {
        return "12";
    }
}
// ----------------------------------------------------------------------------------------------
// ASSETS

function addAsset($data, $files)
{



    $whar = $data['clientid'];
    $clintdata = (explode(",", $whar));
    global $database;
    $uploaded = uploadAssetFile($files, $data);

    if ($uploaded['status'] == 9500) {

        $serial = getTableFiltered("assets", "serial", $data['serial']);
        $old_serial = array();
        foreach ($serial as $ser) {

            $old_serial = $ser['serial'];
        }

        if (!empty($old_serial)) {
            return "99";
        } else {
            $lastid = $database->insert("assets", [
                "categoryid" => $data['categoryid'],
                "adminid" => $data['adminid'],
                "clientid" => $clintdata[0],
                "warehouseid" => $clintdata[1],
                "userid" => $data['userid'],
                "sku" => $data['sku'],
                "status" => 'Available',
                "modelid" => $data['modelid'],
                "manufacturerid" => $data['manufacturerid'],
                "contract_amount" => $data['contract_amount'],
                "contract_expiry" => $data['contract_expiry'],
                "supplierid" => $data['supplierid'],
                "statusid" => $data['statusid'],
                "purchase_date" => $data['purchase_date'],
                "warranty_months" => $data['warranty_months'],
                "warranty_expiry" => $data['warranty_expiry'],
                "tag" => $data['tag'],
                //"name" => $data['name'],
                "serial" => $data['serial'],
                //  "invoice" => $uploaded['invoice'],
                // "warranty_card" => $uploaded['warranty_card'],
                "notes" => $data['notes']
            ]);
        }
        //cs_debug($uploaded);
        $database->insert("files", [
            "clientid" => $data['clientid'],
            "projectid" => $data['projectid'],
            "assetid" => $lastid,
            "name" => "Invoice",
            "file" => $uploaded['invoice']
        ]);
        $database->insert("files", [
            "clientid" => $data['clientid'],
            "projectid" => $data['projectid'],
            "assetid" => $lastid,
            "name" => "Warranty Card",
            "file" => $uploaded['warranty_card']
        ]);
        //cs_debug($lastid);
        if ($lastid == "0") {
            return "11";
        } else {
            return "10";
        }
    } else {
        return "12";
    }
}


function editAsset($data, $files)
{
    // echo"<pre>";
    // print_r($data);
    // echo"</pre>";
    // die('bhrrh');
    global $database;
    $uploaded = uploadAssetFile($files, $data);
    if ($uploaded['status'] == 9500) {

        $serial = getTableFiltered("assets", "serial", $data['serial']);
        $old_serial = array();
        foreach ($serial as $ser) {

            $old_serial = $ser['serial'];
        }

        if (!empty($old_serial)) {
            return "99";
        } else {
            $database->update("assets", [
                "categoryid" => $data['categoryid'],
                "adminid" => $data['adminid'],
                "warehouseid" => $data['warehouseid'],
                "clientid" => $data['clientid'],
                "userid" => $data['userid'],
                "status" => $data['status'],
                "modelid" => $data['modelid'],
                "manufacturerid" => $data['manufacturerid'],
                "contract_amount" => $data['contract_amount'],
                "contract_expiry" => $data['contract_expiry'],
                "supplierid" => $data['supplierid'],
                "statusid" => $data['statusid'],
                "purchase_date" => $data['purchase_date'],
                "warranty_months" => $data['warranty_months'],
                "warranty_expiry" => $data['warranty_expiry'],
                "tag" => $data['tag'],
                "mc_type" => $data['mc_type'],
                "name" => $data['name'],
                "serial" => $data['serial'],
                "caseserial" => $data['caseserial'],
                "notes" => $data['notes']
            ], ["id" => $data['id']]);
        }
        $database->insert("files", [
            "clientid" => $data['clientid'],
            "projectid" => $data['projectid'],
            "assetid" => $data['id'],
            "name" => "Invoice",
            "file" => $uploaded['invoice']
        ]);
        $database->insert("files", [
            "clientid" => $data['clientid'],
            "projectid" => $data['projectid'],
            "assetid" => $data['id'],
            "name" => "Warranty Card",
            "file" => $uploaded['warranty_card']
        ]);
        return "20";
    } else {
        return "12";
    }
}

function deleteAsset($id)
{
    global $database;
    $database->delete("assets", ["id" => $id]);
    return "30";
}


function nextAssetTag()
{
    global $database;
    $max = $database->max("assets", "id");
    return $max + 1;
}



function addimageContract($data, $files)
{
    global $database, $scriptpath;

    if ($data['contract_hid']) {
        $usage = getRowById("contract_usages", $data['contract_hid']);
    } else {
        $usage = getRowById("contract_usages", $data['routeid']);
    }

    $newfilename = array();
    $attachmentArray = unserialize($usage['attachment']);

    $statusid = "On Hold";

    // Check if files were uploaded
    $targetFolder = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "usage_file_attachment" . DIRECTORY_SEPARATOR;
    $status = 9500;
    $allowedExtensions = ['jpg', 'jpeg', 'xls', 'xlsx'];
    $errors = [];

    if (!file_exists($targetFolder)) {
        mkdir($targetFolder, 0777, true);
    }

    foreach ($_FILES['attachment']['tmp_name'] as $key => $tempFilePath) {
        $originalFileName = $_FILES['attachment']['name'][$key];
        $fileInfo = pathinfo($originalFileName);
        $fileExtension = strtolower($fileInfo['extension']);

        if (in_array($fileExtension, $allowedExtensions)) {

            $comapany_name = substr(getConfigValue("company_name"), 0, 3);

            $unique_identifier = uniqid();

            $current_date = date('Y_m_d');

            $filename = $comapany_name . '_' . $current_date . '_' . $unique_identifier . '.' . $fileExtension;

            $targetPath = $targetFolder . $filename;
            move_uploaded_file($tempFilePath, $targetPath);
            $newfilename[] = $filename;
        } else {
            $status = 9502;
            $errors[] = $originalFileName;
        }
    }

    if (is_array($attachmentArray)) {
        $newfilename = array_merge($newfilename, $attachmentArray);
    }

    if ($data['contract_hid']) {
        $lastcontractdata = getlastdata('contract_usages', '*', array("contractid" => $data['contract_hid']));
        $contraid = $data['contract_hid']; // Missing semicolon here
    } else {
        $lastcontractdata = getlastdata('contract_usages', '*', array("contractid" => $data['routeid']));
        $contraid = $data['routeid']; // Missing semicolon here
    }

    $lastcontract = $lastcontractdata[0];

    if ($contraid == $lastcontract['contractid']) {

        $database->update("contract_usages", [
            "attachment" => $newfilename
        ], ["contractid" => $contraid]);
    } else {

        $database->insert("contract_usages", [
            "contractid" => $contraid,
            "attachment" => $newfilename,
        ]);
    }
}


// ----------------------------------------------------------------------------------------------
// CONTRACT

function addContract($data, $files)
{
    global $database;

    if ($data['contract_condition'] != 'page_plan') {
        $data['basic_charges'] = 0;
        $data['basic_black_a3'] = 0;
        $data['basic_black_a4'] = 0;
        $data['basic_color_print_a3'] = 0;
        $data['basic_color_print_a4'] = 0;
        $data['extra_black_a3'] = 0;
        $data['extra_black_a4'] = 0;
        $data['extra_color_print_a3'] = 0;
        $data['extra_color_print_a4'] = 0;
        $data['extrachargies'] = 0;
    }

    $contractno = nextContractTag(true);
    //$uploaded = uploadContractFile($files);
    $ast_sts = '1';
    $clientdata =    getTableFiltered("clients", "id", $data['clientid']);
    foreach ($clientdata as $dataaa) {
        $clientname = $dataaa['name'];
    }
    $result = substr($clientname, 0, 3);

    $asset_id = $data['assetid'];

    $contract_vale = getTableFiltered("contract", "is_end", "0");
    foreach ($contract_vale as $cont_asst) {
        $assetid = $cont_asst['assetid'];
    }
    if ($assetid == $asset_id) {
        return "11";
    } else {


        $lastid = $database->insert("contract", [
            "contractno" => $result . "-" . $contractno,
            "clientid" => $data['clientid'],
            "categoryid" => $data['categoryid'],
            "assetid" => $data['assetid'],
            "statusid" => $data['statusid'],
            "contract_amount" => $data['contract_amount'],
            "contract_expiry" => $data['contract_expiry'],
            "contracttype" => $data['contracttype'],
            "page_limit_per_month" => $data['page_limit_per_month'],
            "actual_pages_per_month" => $data['actual_pages_per_month'],
            "department" => $data['department'],
            "template" => $data['template'],
            "notes" => $data['notes'],
            "ast_sts" => $ast_sts,
            "technician_name" => $data['technician_name'],
            "technician_mail_id" => $data['mail_id'],
            "technician_mobile_no" => $data['mobile_no'],
            "deposit" => $data['deposit'],
            "created_date" => $data['created_date'],
            "contract_condition" => $data['contract_condition'],
            "monthly_usage_fees_advance" => isset($data['monthly_usage_fees_advance']) ? $data['monthly_usage_fees_advance'] : 0,
        ]);
    }
    $historyid = $database->insert("contract_history", [
        "contractid" => $lastid,
        "assetid" => $data['assetid'],
        "memo" => $data['memo'],
        "deployeddate" => date('Y-m-d'),
        "notes" => $data['notes'],
    ]);

    $database->insert("print_chargies", [
        "contractid" => $lastid,
        "basic_charges" => $data['basic_charges'],
        "basic_black_a3" => $data['basic_black_a3'],
        "basic_black_a4" => $data['basic_black_a4'],
        "basic_color_print_a3" => $data['basic_color_print_a3'],
        "basic_color_print_a4" => $data['basic_color_print_a4'],
        "extra_black_a3" => $data['extra_black_a3'],
        "extra_black_a4" => $data['extra_black_a4'],
        "extra_color_print_a3" => $data['extra_color_print_a3'],
        "extra_color_print_a4" => $data['extra_color_print_a4'],
        "extrachargies" => $data['extrachargies']
    ]);

    //Update asset to set it belong to client, no longer in Stock warehouse
    $database->update("assets", [
        "clientid" => $data['clientid'],
        "status" => "In Service"
    ], ["id" => $data['assetid']]);

    $usess = $database->insert("contract_usages", [
        "clientid" => $data['clientid'],
        "contractid" => $lastid,
        "assetid" => $data['assetid'],
        "description" => $data['description'],
        "startdate" => date('Y-m-d'),
        "enddate" => date('Y-m-d'),
        "scolora3" => $data['color1'],
        "scolora4" => $data['color2'],
        "sblacka3" => $data['blac1'],
        "sblacka4" => $data['blac2'],
        "ecolora3" => $data['color1'],
        "ecolora4" => $data['color2'],
        "eblacka3" => $data['blac1'],
        "eblacka4" => $data['blac2'],
        "flag" => "yes",
    ]);

    //cs_debug($database->last_query());
    //cs_debug($lastid);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editContract($data)
{
    global $database;


    if ($data['contract_condition'] != 'page_plan') {
        $data['basic_charges'] = 0;
        $data['basic_black_a3'] = 0;
        $data['basic_black_a4'] = 0;
        $data['basic_color_print_a3'] = 0;
        $data['basic_color_print_a4'] = 0;
        $data['extra_black_a3'] = 0;
        $data['extra_black_a4'] = 0;
        $data['extra_color_print_a3'] = 0;
        $data['extra_color_print_a4'] = 0;
        $data['extrachargies'] = 0;
    }

    $lastcontractdata = getlastdata('print_chargies', '*', array("contractid" => $data['id']));

    $lastcontract = $lastcontractdata[0];

    if ($data['id'] == $lastcontract['contractid']) {

        $database->update("print_chargies", [
            "basic_charges" => $data['basic_charges'],
            "basic_black_a3" => $data['basic_black_a3'],
            "basic_black_a4" => $data['basic_black_a4'],
            "basic_color_print_a3" => $data['basic_color_print_a3'],
            "basic_color_print_a4" => $data['basic_color_print_a4'],
            "extra_black_a3" => $data['extra_black_a3'],
            "extra_black_a4" => $data['extra_black_a4'],
            "extra_color_print_a3" => $data['extra_color_print_a3'],
            "extra_color_print_a4" => $data['extra_color_print_a4'],
            "extrachargies" => $data['extrachargies']
        ], ["contractid" => $data['id']]);
    } else {
        $database->insert("print_chargies", [
            "contractid" => $data['id'],
            "basic_charges" => $data['basic_charges'],
            "basic_black_a3" => $data['basic_black_a3'],
            "basic_black_a4" => $data['basic_black_a4'],
            "basic_color_print_a3" => $data['basic_color_print_a3'],
            "basic_color_print_a4" => $data['basic_color_print_a4'],
            "extra_black_a3" => $data['extra_black_a3'],
            "extra_black_a4" => $data['extra_black_a4'],
            "extra_color_print_a3" => $data['extra_color_print_a3'],
            "extra_color_print_a4" => $data['extra_color_print_a4'],
            "extrachargies" => $data['extrachargies']
        ]);
    }


    $old_assetid = getSingleValue("contract", "assetid", $data['id']);




    if ($data['editContract'] == 'end') {

        // echo "hello";
        // die("xcv");
        $database->update("assets", [
            "clientid" => '0'
        ], ["id" => $old_assetid]);
        $historyid = $database->insert("contract_history", [
            "contractid" => $data['id'],
            "assetid" => $old_assetid,
            "memo" => 'End of Contract',
            "pulledoutdate" => date('Y-m-d'),
            "maintenance" => $data['maintenance']
        ]);
        $database->update("contract", [
            'is_end' => 1,
            'is_endservice' => 1,
            "memo" => 'End of Contract',
            "contract_expiry" => $data['contract_expiry'],
            "template" => $data['template'],
            "notes" => $data['notes'],
            "deposit" => $data['deposit']
        ], ["id" => $data['id']]);
        return "20";
    } else {

        if ($old_assetid != $data['assetid'] && $_POST['coid'] == '') {

            // echo "hiii";
            // die("cvbxv");
            // echo "<pre>";
            // print_R($data);
            // die("dfgvbsdf");
            $historyid = $database->insert("contract_history", [
                "contractid" => $data['id'],
                "assetid" => $data['assetid'],
                "memo" => $data['memo'],
                "deployeddate" => date('Y-m-d'),
                "maintenance" => $data['maintenance']
            ]);
            $database->update("contract_history", [
                "pulledoutdate" => date('Y-m-d'),
                "maintenance" => $data['maintenance']
            ], ["AND" => ["contractid" => $data['id'], "assetid" => $old_assetid]]);
            $database->update("assets", [
                "clientid" => $data['routeid']
            ], ["id" => $data['assetid']]);
            $database->update("assets", [
                "clientid" => '0'
            ], ["id" => $old_assetid]);
        } elseif (!empty($data['maintenance'])) {

            $historyid = $database->insert("contract_history", [
                "contractid" => $data['id'],
                "assetid" => $data['assetid'],
                "memo" => $data['memo'],
                "deployeddate" => date('Y-m-d'),
                "maintenance" => $data['maintenance']
            ]);
        }
        //    $database->update("contract_history", [
        //            "memo" => $data['memo'],
        //            "notes" => $data['notes']
        //                ], ["AND" => ["contractid" => $data['id'], "assetid" => $old_assetid]]);


        $database->update("contract", [
            //        "contractno" => $contractno,
            //        "clientid" => $data['clientid'],
            "categoryid" => $data['categoryid'],
            "assetid" => $data['assetid'],
            "memo" => $data['memo'],
            "contract_amount" => $data['contract_amount'],
            "contract_expiry" => $data['contract_expiry'],
            "contracttype" => $data['contracttype'],
            "page_limit_per_month" => $data['page_limit_per_month'],
            "actual_pages_per_month" => $data['actual_pages_per_month'],
            "department" => $data['department'],
            "template" => $data['template'],
            "technician_name" => $data['technician_name'],
            "technician_mail_id" => $data['mail_id'],
            "technician_mobile_no" => $data['mobile_no'],
            "notes" => $data['notes'],
            "deposit" => $data['deposit'],
            "contract_condition" => $data['contract_condition'],
            "current_service_asset" => $data['current_service_asset'],
            "monthly_usage_fees_advance" => isset($data['monthly_usage_fees_advance']) ? $data['monthly_usage_fees_advance'] : 0,
        ], ["id" => $data['id']]);
        return "20";
    }
}
function documenttypeadd($data)
{
    global $database;
    $lastid = $database->insert(
        "document_type",
        ["document_name" => $data['document_type']]
    );
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editdocumenttype($data)
{

    global $database;

    $database->update(
        "document_type",
        [
            "document_name" => $data['document_tyname']
        ],
        ["id" => $data['id']]
    );
    return "20";
}

function departmentDelete($id)
{
    global $database;

    $database->delete("document_type", ["id" => $id]);
    return "30";
}


function departmentDelete1($id)
{
    global $database;

    $database->update("contract", ["department" => ''], ["department" => $id]);

    $database->delete("department", ["id" => $id]);
    return "30";
}


function deleteContract($id)
{
    global $database;
    $assetid = getSingleValue('contract', 'assetid', $id);
    $database->update("assets", [
        "clientid" => '0'
    ], ["id" => $assetid]);

    $database->delete("contract", ["id" => $id]);
    return "30";
}

function editContractHistory($data)
{
    global $database;
    $database->update("contract_history", [
        "assetid" => $data['assetid'],
        "memo" => $data['memo'],
        "maintenance" => $data['maintenance'],
        "pulledoutdate" => $data['pulledoutdate']
    ], ["id" => $data['id']]);
    return "20";
}

function deleteContractHistory($id)
{
    global $database;

    $database->delete("contract_history", ["id" => $id]);
    return "30";
}

function nextContractTag($insert = false)
{
    global $database;
    $qty = $database->get(
        "contract_qty_by_date",
        "quantity",
        [
            "contractdate" => date("Y-m-d")
        ]
    );
    //cs_debug($qty);
    if ($qty) {
        if ($insert) {
            $database->update("contract_qty_by_date", [
                "quantity[+]" => 1,
            ], [
                "contractdate" => date("Y-m-d")
            ]);
        }
        return date("Ymd") . "-" . ($qty + 1);
    } else {
        if ($insert) {
            $database->insert("contract_qty_by_date", [
                "quantity" => 1,
                "contractdate" => date("Y-m-d")
            ]);
        }
        return date("Ymd") . "-1";
    }
}

// ----------------------------------------------------------------------------------------------
// CONTRACT TYPE

function addContractType($data)
{
    global $database;
    $lastid = $database->insert("contracttype", ["name" => $data['name'], "template" => $data['template']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

// CLIENT TYPE
function addClientType($data)
{
    global $database;
    $lastid = $database->insert("clienttype", ["name" => $data['name'], "template" => $data['template']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editContractType($data)
{
    global $database;
    $database->update("contracttype", ["name" => $data['name'], "template" => $data['template']], ["id" => $data['id']]);
    return "20";
}

function editClientType($data)
{
    global $database;
    $database->update("clienttype", ["name" => $data['name'], "template" => $data['template']], ["id" => $data['id']]);
    return "20";
}



function deleteContractType($id)
{
    global $database;
    $database->delete("contracttype", ["id" => $id]);
    return "30";
}

function deleteClientType($id)
{
    global $database;
    $database->delete("clienttype", ["id" => $id]);
    return "30";
}

function update_limit_cycle($data)
{
    global $database;
    $database->update("contract", ["actual_pages_per_month" => $data['actual_pages_per_month'], "template" => $data['template']], ["id" => $data['contractid']]);
    return "20";
}

// ----------------------------------------------------------------------------------------------
// LICENSES

function addLicense($data)
{

    $contractno = nextContractTag(true);

    // echo'<pre>';
    // print_r($data);
    // print_r($contractno);
    // echo'</pre>';
    // die('eruj');

    global $database;
    $lastid = $database->insert("licenses", [
        "clientid" => $data['clientid'],
        "statusid" => "In service",
        "categoryid" => $data['categoryid'],
        "supplierid" => $data['supplierid'],
        "amount" => $data['amount'],
        "tag" => $data['tag'],
        "licno" => $data['licno'],
        "name" => $data['name'],
        "serial" => $data['serial'],
        "notes" => $data['notes']
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editLicense($data)
{
    global $database;
    $database->update("licenses", [
        "clientid" => $data['clientid'],
        "statusid" => $data['statusid'],
        "categoryid" => $data['categoryid'],
        "supplierid" => $data['supplierid'],
        "tag" => $data['tag'],
        "name" => $data['name'],
        "serial" => $data['serial'],
        "notes" => $data['notes'],
        "amount" => $data['amount']
    ], ["id" => $data['id']]);
    return "20";
}

function deleteLicense($id)
{
    global $database;
    $database->delete("licenses", ["id" => $id]);
    return "30";
}

function nextLicenseTag()
{
    global $database;
    $max = $database->max("licenses", "id");
    return $max + 1;
}

// ----------------------------------------------------------------------------------------------
// LICENSE ASSIGNMENTS

function addLicenseAssignment($data)
{ //assign license to asset
    global $database;
    $lastid = $database->insert("licenses_assets", [
        "licenseid" => $data['licenseid'],
        "assetid" => $data['assetid']
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function deleteLicenseAssignment($id)
{ //unassign license to asset
    global $database;
    $database->delete("licenses_assets", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------
// ADMIN ASSIGNMENTS

function addAdminAssignment($data)
{ //assign admin to client
    global $database;
    $lastid = $database->insert("clients_admins", [
        "adminid" => $data['adminid'],
        "clientid" => $data['clientid']
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function deleteAdminAssignment($id)
{ //unassign admin from client
    global $database;
    $database->delete("clients_admins", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------
// CATEGORIES

function addAssetCategory($data)
{
    global $database;
    $lastid = $database->insert("assetcategories", ["name" => $data['name'], "color" => $data['color']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editAssetCategory($data)
{
    global $database;
    $database->update("assetcategories", ["name" => $data['name'], "color" => $data['color']], ["id" => $data['id']]);
    return "20";
}

function deleteAssetCategory($id)
{
    global $database;
    $database->delete("assetcategories", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------
// LICENSE TYPES

function addLicenseCategory($data)
{
    global $database;
    $lastid = $database->insert("licensecategories", ["name" => $data['name'], "color" => $data['color']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editLicenseCategory($data)
{
    global $database;
    $database->update("licensecategories", ["name" => $data['name'], "color" => $data['color']], ["id" => $data['id']]);
    return "20";
}

function deleteLicenseCategory($id)
{
    global $database;
    $database->delete("licensecategories", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------
// ASSET STATES

function addLabel($data)
{
    global $database;
    $lastid = $database->insert("labels", ["name" => $data['name'], "color" => $data['color']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editLabel($data)
{
    global $database;
    $database->update("labels", ["name" => $data['name'], "color" => $data['color']], ["id" => $data['id']]);
    return "20";
}

function deleteLabel($id)
{
    global $database;
    $database->delete("labels", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------

function addticketsubject($data)
{

    global $database;
    $lastid = $database->insert("ticketsubject", ["subject" => $data['subject']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}
function editticketsubject($data)
{
    global $database;
    $database->update("ticketsubject", ["subject" => $data['subject']], ["id" => $data['id']]);
    return "20";
}
function deleteticketsubject($id)
{
    global $database;
    $database->delete("ticketsubject", ["id" => $id]);
    return "30";
}


function addticketaction($data)
{

    global $database;
    $lastid = $database->insert("ticket_action", ["action" => $data['action_name']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editticketaction($data)
{
    global $database;
    $database->update("ticket_action", ["action" => $data['action_name']], ["id" => $data['id']]);
    return "20";
}
function deleteticketaction($id)
{
    global $database;
    $database->delete("ticket_action", ["id" => $id]);
    return "30";
}
// WAREHOUSE

function addwarehouse($data)
{

    global $database;
    $lastid = $database->insert("warehouse", ["code" => $data['code'], "name" => $data['name']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editwarehouse($data)
{
    global $database;
    $database->update("warehouse", ["name" => $data['name'], "code" => $data['code']], ["id" => $data['id']]);
    return "20";
}

function deletewarehouse($id)
{
    global $database;
    $database->delete("warehouse", ["id" => $id]);
    return "30";
}

// Consumable

function addconsumable($data)
{

    global $database;
    $lastid = $database->insert("consumable_list", ["description" => $data['desc'], "name" => $data['name'], "cost" => $data['cost'], "cog" => $data['cog']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editconsumable($data)
{
    global $database;
    $database->update("consumable_list", ["name" => $data['name'], "description" => $data['desc'], "cost" => $data['cost'], "cog" => $data['cog']], ["id" => $data['id']]);
    return "20";
}

function deleteconsumable($id)
{
    global $database;
    $database->delete("consumable_list", ["id" => $id]);
    return "30";
}


// MANUFACTURERS

function addManufacturer($data)
{
    global $database;
    $lastid = $database->insert("manufacturers", ["name" => $data['name']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editManufacturer($data)
{
    global $database;
    $database->update("manufacturers", ["name" => $data['name']], ["id" => $data['id']]);
    return "20";
}

function deleteManufacturer($id)
{
    global $database;
    $database->delete("manufacturers", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------
// SUPPLIERS

function addSupplier($data)
{
    global $database;
    $lastid = $database->insert("suppliers", ["name" => $data['name'], "contact_person" => $data['contact_person'], "contact_no" => $data['contact_no'], "address" => $data['address']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editSupplier($data)
{
    global $database;
    $database->update("suppliers", ["name" => $data['name'], "contact_person" => $data['contact_person'], "contact_no" => $data['contact_no'], "address" => $data['address']], ["id" => $data['id']]);
    return "20";
}

function deleteSupplier($id)
{
    global $database;
    $database->delete("suppliers", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------
// ASSET MODELS

function addModel($data, $file)
{

    global $database;
    $uploadedimage = uploadmodlimage($file, $data);
    // print_r($uploadedimage);
    // echo $uploadedimage['file'];

    $lastid = $database->insert("models", ["manufacturerid" => $data['manufacturerid'], "name" => $data['name'], "image" => $uploadedimage['file']]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function updatedeparton($data)
{
    global $database;

    $database->update("contract", ["department" => $data['conntde']], ["id" => $data['contractid']]);
    return "20";
}


function adddatedeparton($data)
{


    print_r($data);

    die();
    global $database;
    $database->insert("department", [
        "client_name" => $client_id,
        "userid" => $userid,
        "clientid" => $clientid,
        "ipaddress" => $_SERVER['REMOTE_ADDR'],
        "description" => $description,
        "timestamp" => date('Y-m-d H:i:s')
    ]);
}
function delete_department($data)
{
    global $database;

    $database->update("contract", ["department" => ''], ["department" => $data['dipartment_anem']]);
    return "20";
}
function updatenotes1($data)
{
    global $database;
    $database->update("assets", ["notes" => $data['notes']], ["sku" => $data['sku']]);
    return "20";
}


function updateonlycasesrl($data)
{
    global $database;

    $database->update("assets", ["caseserial" => $data['caseserial']], ["id" => $data['assetid']]);
    return "20";
}



function editModel($data, $file = null)
{
    global $database;
    $uploadedimage = uploadmodlimage($file, $data);
    if ($file == null) {
        $database->update("models", ["manufacturerid" => $data['manufacturerid'], "name" => $data['name']], ["id" => $data['id']]);
    } else {
        $database->update("models", ["manufacturerid" => $data['manufacturerid'], "name" => $data['name'], "image" => $uploadedimage['file']], ["id" => $data['id']]);
    }
    return "20";
}

function editUsageModel($data, $file = null)
{
    global $database;
    $uploadedimage = uploadUsuageReportlimage($file, $data);

    $modalid = $data['modelid'];
    $assetname = getSingleValue("models", "name", $modalid);

    $year = (int) date('Y', strtotime($data['date']));
    if (isset($data['page_report_for_month'])) {
        if ($data['page_report_for_month'] < 10) {
            $data['page_report_for_month'] = '0' . $data['page_report_for_month'];
        }
    }
    $page_report_for_month = isset($data['page_report_for_month']) ? $data['page_report_for_month'] : 0;
    $ref_no = $data['routeid'] . '-' . $data['contract_id'] . '-' . $year . $page_report_for_month;
    // $sql = "SELECT * FROM `usage_report` WHERE `ref_no` = '" . $ref_no . "' AND contract_id = " . $data['contract_id'];
    // $query = $database->query($sql);
    // $result = $query->fetchAll();
    // if (!empty($result)) {
    //     $data['duplicate'] = 1;
    // } else {
    //     $data['duplicate'] = 0;
    // }

    if ($file == null) {
        $data = $database->insert("usage_report", [
            "clientid" => $data['routeid'],
            "asset_id" => $data['modelid'],
            "department" => $data['department'],
            "modal_name" => $assetname,
            "serial" => $data['serial'],
            "remark" => $data['remark'],
            "date" => $data['date'] . ' ' . date('H:i:s'),
            "A3clr" => $data['A3clr'],
            "A3blk" => $data['A3blk'],
            "A4clr" => $data['A4clr'],
            "A4blk" => $data['A4blk'],

            "page_report_for_month" => isset($data['page_report_for_month']) ? $data['page_report_for_month'] : 0,
            "ref_no" => $ref_no,
            "contract_id" => $data['contract_id'],
        ]);

        // $database->update("assets", ["date" => $data['date'], "A3clr" => $data['A3clr'], "A3blk" => $data['A3blk'], "A4clr" => $data['A4clr'], "A4blk" => $data['A4blk']], ["id" => $data['id']]);
    } else {
        $database->insert("usage_report", [
            "clientid" => $data['routeid'],
            "asset_id" => $data['modelid'],
            "modal_name" => $assetname,
            "department" => $data['department'],
            "serial" => $data['serial'],
            "remark" => $data['remark'],
            "date" => $data['date'] . ' ' . date('H:i:s'),
            "A3clr" => $data['A3clr'],
            "A3blk" => $data['A3blk'],
            "A4clr" => $data['A4clr'],
            "A4blk" => $data['A4blk'],
            "image" => $uploadedimage['file'],
            "page_report_for_month" => isset($data['page_report_for_month']) ? $data['page_report_for_month'] : 0,
            "ref_no" => $ref_no,
            "contract_id" => $data['contract_id'],
        ]);
        // $database->update("assets", ["date" => $data['date'], "A3clr" => $data['A3clr'], "A3blk" => $data['A3blk'], "A4clr" => $data['A4clr'], "A4blk" => $data['A4blk']], ["id" => $data['id']]);
        // $database->update("models", ["image" => $uploadedimage['file']], ["id" => $data['modelid']]);
    }
    return "20";
}

function editUsageReport($data, $file = null)
{
    global $database;

    if ($data['usage_confimed'] == 'on') {
        $usage_confimed = 1;
    } else {
        $usage_confimed = 0;
    }

    $modalid = $data['modelid'];
    $assetname = getSingleValue("models", "name", $modalid);

    if ($file == null) {
        $data = $database->update("usage_report", [
            "clientid" => $data['routeid'],
            "asset_id" => $data['modelid'],
            "department" => $data['department'],
            "modal_name" => $assetname,
            "serial" => $data['serial'],
            "remark" => $data['remark'],
            "usage_confimed" => $usage_confimed,
            "date" => $data['date'],
            "A3clr" => $data['A3clr'],
            "A3blk" => $data['A3blk'],
            "A4clr" => $data['A4clr'],
            "A4blk" => $data['A4blk'],
        ], ["id" => $data['id']]);
    } else {
        $uploadedimage = uploadUsuageReportlimage($file, $data);
        $database->update("usage_report", [
            "clientid" => $data['routeid'],
            "asset_id" => $data['modelid'],
            "modal_name" => $assetname,
            "serial" => $data['serial'],
            "remark" => $data['remark'],
            "usage_confimed" => $usage_confimed,
            "department" => $data['department'],
            "date" => $data['date'],
            "A3clr" => $data['A3clr'],
            "A3blk" => $data['A3blk'],
            "A4clr" => $data['A4clr'],
            "A4blk" => $data['A4blk'],
            "image" => $uploadedimage['file'],
        ], ["id" => $data['id']]);
    }
    return "20";
}

function editactualstatus($data, $file = null)
{
    global $database;

    if ($data['actual_confimed'] == 'on') {
        $actual_confimed = 1;
    } else {
        $actual_confimed = 0;
    }

    $modalid = $data['modelid'];
    $assetname = getSingleValue("models", "name", $modalid);

    if ($file == null) {
        $data = $database->update("actual_report", [
            "clientid" => $data['routeid'],
            "asset_id" => $data['modelid'],
            "department" => $data['department'],
            "modal_name" => $assetname,
            "serial" => $data['serial'],
            "remark" => $data['remark'],
            "actual_confimed" => $actual_confimed,
            "reported_by" => $data['reported_by'],
            "date" => $data['date'],
        ], ["id" => $data['id']]);
    } else {
        $uploadedimage = uploadactualreportlimage($file, $data);
        $database->update("actual_report", [
            "clientid" => $data['routeid'],
            "asset_id" => $data['modelid'],
            "modal_name" => $assetname,
            "serial" => $data['serial'],
            "remark" => $data['remark'],
            "actual_confimed" => $actual_confimed,
            "department" => $data['department'],
            "reported_by" => $data['reported_by'],
            "date" => $data['date'],
            "image" => $uploadedimage['file'],
        ], ["id" => $data['id']]);
    }
    return "20";
}

function editUsageactualstatusModel($data, $file = null)
{
    global $database;
    $uploadedimage = uploadactualreportlimage($file, $data);

    $modalid = $data['modelid'];
    $assetname = getSingleValue("models", "name", $modalid);

    if ($file == null) {
        $data = $database->insert("actual_report", [
            "clientid" => $data['routeid'],
            "asset_id" => $data['modelid'],
            "department" => $data['department'],
            "modal_name" => $assetname,
            "serial" => $data['serial'],
            "remark" => $data['remark'],
            "date" => $data['date'],
            "reported_by" => $data['reported_by'],
            "page_report_for_month" => $data['page_report_for_month'],
            // "ref_no" => 
        ]);
    } else {
        $database->insert("actual_report", [
            "clientid" => $data['routeid'],
            "asset_id" => $data['modelid'],
            "modal_name" => $assetname,
            "department" => $data['department'],
            "serial" => $data['serial'],
            "remark" => $data['remark'],
            "date" => $data['date'],
            "reported_by" => $data['reported_by'],
            "image" => $uploadedimage['file'],
            "page_report_for_month" => $data['page_report_for_month'],
        ]);
        // $database->update("assets", ["date" => $data['date'], "A3clr" => $data['A3clr'], "A3blk" => $data['A3blk'], "A4clr" => $data['A4clr'], "A4blk" => $data['A4blk']], ["id" => $data['id']]);
        // $database->update("models", ["image" => $uploadedimage['file']], ["id" => $data['modelid']]);
    }
    return "20";
}

function deleteModel($id)
{
    global $database;
    $database->delete("models", ["id" => $id]);
    return "30";
}

// ----------------------------------------------------------------------------------------------
// APP LOGGING FUNCTIONS

function logSystem($clientid, $userid, $adminid, $adminid, $description)
{ //add to system log
    global $database;
    $database->insert("systemlogs", [
        "adminid" => $adminid,
        "userid" => $userid,
        "clientid" => $clientid,
        "ipaddress" => $_SERVER['REMOTE_ADDR'],
        "description" => $description,
        "timestamp" => date('Y-m-d H:i:s')
    ]);
}

function logEmail($clientid, $peopleid, $to, $subject, $message)
{ //add to email log
    global $database;
    $database->insert("emaillog", [
        "peopleid" => $peopleid,
        "clientid" => $clientid,
        "to" => $to,
        "subject" => $subject,
        "message" => $message,
        "timestamp" => date('Y-m-d H:i:s')
    ]);
}

function logSMS($clientid, $peopleid, $mobile, $sms)
{ //add to sms log
    global $database;
    $database->insert("smslog", [
        "peopleid" => $peopleid,
        "clientid" => $clientid,
        "mobile" => $mobile,
        "sms" => $sms,
        "timestamp" => date('Y-m-d H:i:s')
    ]);
}

// ----------------------------------------------------------------------------------------------
// SETTINGS

function updateSetting($name, $value)
{ //update config value
    global $database;
    $database->update("config", ["value" => $value], ["name" => $name]);
}

function updateLogoSetting($files)
{ //update config value
    global $database, $scriptpath;
    $oldlogo = $database->get("config", "value", ["name" => "logo"]);
    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    $targetfile = $targetdir . $oldlogo;
    if (file_exists($targetfile)) {
        unlink($targetfile);
    }
    $uploaded = uploadAssetFile($files);
    if ($uploaded['status'] == 9500) {
        $database->update("config", ["value" => $uploaded['logo']], ["name" => 'logo']);
        return "40";
    } else {
        return "12";
    }
}

function editNotificationTemplate($data)
{ //update config value
    global $database;
    $database->update("notificationtemplates", ["subject" => $data['subject'], "message" => $data['message'], "sms" => $data['sms']], ["id" => $data['id']]);
    return 40;
}

function addemailTemplate($data)
{
    global $database;

    $database->insert("notificationtemplates", [
        "type" => "emailtemplete",
        "name" => $data['name'],
        "categoryid" => $data['categoryid'],
        "subject" =>  $data['subject'],
        "message" => $data['message'],
    ]);

    return 40;
}

function addemailTemplateCategory($data)
{
    global $database;

    $database->insert("emailtempletecategory", [
        "categoryname" =>  $data['categoryname'],
    ]);

    return 40;
}

function emailCategorytempleteEdit($data)
{
    global $database;

    $database->update("emailtempletecategory",  ["categoryname" => $data['categoryname']], ["id" => $data['id']]);

    return 40;
}

function emailCategorytempleteDelete($id)
{
    global $database;
    $database->delete("emailtempletecategory", ["id" => $id]);
    return "30";
}

function emailtempleteEdit($data)
{
    global $database;

    $database->update("notificationtemplates",  ["name" => $data['name'], "categoryid" => $data['categoryid'], "subject" => $data['subject'], "message" => $data['message']], ["id" => $data['id']]);

    return 40;
}
function emailtempleteDelete($id)
{
    global $database;
    $database->delete("notificationtemplates", ["id" => $id]);
    return "30";
}

function editInvoiceTemplate($data)
{ //update config value
    global $database;
    if ($data['id']) {
        $database->update("notificationtemplates", ["subject" => $data['subject'], "message" => $data['message'], "sms" => $data['sms']], ["id" => $data['id']]);
        return 40;
    } else {
        $database->insert("notificationtemplates", [
            "subject" =>  $data['subject'],
            "type" => "emailtemplete",
            "message" => $data['message'],
            "sms" => $data['sms'],
        ]);
    }
}

// ----------------------------------------------------------------------------------------------
// COMMUNICATIONS FUNCTIONS
function sendEmailNotification($to, $subject, $message, $clientid = "0", $peopleid = "0", $technician)
{ //send email



    $mail = new PHPMailer;
    $ccarray = explode(",", getConfigValue("notification_recipient"));

    $recipients = array();
    foreach ($ccarray as $ccdata) {

        $recipients[] = array('email' => $ccdata, 'name' => $ccdata);
    }


    if (getConfigValue("email_smtp_enable") == "true") {
        $mail->isSMTP();
        // $mail->Host = 'gator4089.hostgator.com';  // Specify main and backup SMTP servers
        $mail->Host = 'mail.egatesupport.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ticket@egatesupport.com';                 // SMTP username
        $mail->Password = 'HCqZWFgpAeT!';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;
    }
    $mail->From = getConfigValue("email_from_address");
    $mail->FromName = getConfigValue("email_from_name");
    $tech = $technician;

    $mail->addAddress($to);


    foreach ($recipients as $recipient) {


        $mail->addCC($recipient['email'], $recipient['name']);
    }

    $client_email = getRowById("clients", $clientid);
    $it_email = $client_email['it_manager_email'];
    $purcheas_email = $client_email['purc_manager_email'];

    $mail->AddCC($tech, 'Techniciean');
    $mail->AddCC($it_email, 'It Manager Email');
    $mail->AddCC($purcheas_email, 'Purchase Manager Email');
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->IsHTML(true);
    if (!$mail->send()) {

        logEmail($clientid, $peopleid, $to, $subject, $mail->ErrorInfo);
        return 0; //error
    } else {

        logEmail($clientid, $peopleid, $to, $subject, $message);
        return 1; //success
    }
}

function sendEmail($to, $subject, $message, $clientid = "0", $peopleid = "0", $file = "", $inv_file = "", $tax_file = "", $paid_file = "", $or_file = "", $invoice_attechment = "", $invoice_pdf_path)
{
    // return true;
    //send email
    // echo'<pre>';
    // print_r($subject);
    // echo'</pre>';
    // die('vfklbm');
    global $scriptpath;
    $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file;

    $mail = new PHPMailer;
    if (getConfigValue("email_smtp_enable") == "true") {
        $mail->isSMTP();
        // $mail->Host = 'gator4089.hostgator.com';  // Specify main and backup SMTP servers
        $mail->Host = 'mail.egatesupport.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ticket@egatesupport.com';                 // SMTP username
        $mail->Password = 'HCqZWFgpAeT!';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;
    }
    $mail->From = getConfigValue("email_from_address");
    $mail->FromName = getConfigValue("email_from_name");
    $client_email = getRowById("clients", $clientid);
    $it_email = $client_email['it_manager_email'];
    $purcheas_email = $client_email['purc_manager_email'];

    // $mail->AddCC($tech, 'Techniciean');
    $mail->AddCC($it_email, 'It Manager Email');
    $mail->AddCC($purcheas_email, 'Purchase Manager Email');
    $mail->addAddress($to);
    // $mail->addAddress('dp715953@gmail.com');
    $mail->Subject = $subject;

    $mail->Body = $message;

    if ($file) {
        $mail->addAttachment("uploads/" . $file);
    }

    if ($inv_file) {
        $filename = $inv_file . ".pdf";
        $mail->addAttachment("uploads/invoice/" . $filename);
    }

    if ($tax_file) {
        $filename = $tax_file;
        $mail->addAttachment("uploads/tax_file/" . $filename);
    }

    if ($paid_file) {
        $filename = $paid_file;
        $mail->addAttachment("uploads/" . $filename);
    }


    if ($or_file) {
        $filename = $or_file;
        $mail->addAttachment("uploads/" . $filename);
    }

    if ($invoice_attechment != '') {
        $mail->addAttachment($invoice_attechment);
    }

    if ($invoice_pdf_path != '') {
        $path = $scriptpath . DIRECTORY_SEPARATOR . $invoice_pdf_path;
        $mail->addAttachment($invoice_pdf_path);
    }

    $mail->IsHTML(true);

    if (!$mail->send()) {
        logEmail($clientid, $peopleid, $to, $subject, $mail->ErrorInfo);
        return 0; //error
    } else {
        logEmail($clientid, $peopleid, $to, $subject, $message);
        return 1; //success
    }
}

function senttestmail($to, $subject, $message)
{ //send email


    // echo'<pre>';
    // print_r($subject);
    // echo'</pre>';
    // die('vfklbm');
    global $scriptpath;

    $mail = new PHPMailer;
    if (getConfigValue("email_smtp_enable") == "true") {
        $mail->isSMTP();
        // $mail->Host = 'gator4089.hostgator.com';  // Specify main and backup SMTP servers
        $mail->Host = 'mail.egatesupport.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ticket@egatesupport.com';                 // SMTP username
        $mail->Password = 'HCqZWFgpAeT!';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;
    }
    $mail->From = getConfigValue("email_from_address");
    $mail->FromName = getConfigValue("email_from_name");
    // $client_email = getRowById("clients", $clientid);
    // $it_email = $client_email['it_manager_email'];
    // $purcheas_email = $client_email['purc_manager_email'];

    // $mail->AddCC($tech, 'Techniciean');
    // $mail->AddCC($it_email, 'It Manager Email');
    // $mail->AddCC($purcheas_email, 'Purchase Manager Email');
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $message;
    // $mail->addAttachment("uploads/" . $file);
    $mail->IsHTML(true);

    if (!$mail->send()) {
        // logEmail($clientid, $peopleid, $to, $subject, $mail->ErrorInfo);
        return 0; //error
    } else {
        // logEmail($clientid, $peopleid, $to, $subject, $message);
        return 1; //success
    }
}

function sendSMS($mobile, $sms, $clientid = "0", $peopleid = "0")
{ //send sms
    $provider = getConfigValue("sms_provider");
    $user = getConfigValue("sms_user");
    $password = getConfigValue("sms_password");
    $api_id = getConfigValue("sms_api_id");
    $from = getConfigValue("sms_from");

    if ($provider == "smsglobal") {
        $url = 'http://www.smsglobal.com/http-api.php' . '?action=sendsms' . '&user=' . $user . '&password=' . $password . '&from=' . $from . '&to=' . $mobile . '&text=' . substr(rawurlencode($sms), 0, 153);
        $returnedData = file_get_contents($url);
    }
    if ($provider == "clickatell") {
        $url = 'http://api.clickatell.com/http/sendmsg?user=' . $user . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $mobile . '&text=' . $sms;
        $returnedData = file_get_contents($url);
    }

    logSMS($clientid, $peopleid, $mobile, $sms);
}

function ticketNotification($ticketid, $status, $reply, $templateid, $depart, $contract_id)
{

    $template = getRowById("notificationtemplates", $templateid);
    $ticket = getRowById("tickets", $ticketid);
    if ($contract_id != "") {
        $contract = getRowById("contract", $contract_id);
    } else {
        $contract = getRowById("contract", $ticket['contractid']);
    }


    $contrctno   = $contract['contractno'];
    $department   = $contract['department'];
    $technician_mail_id   = $contract['technician_mail_id'];


    //print_r($technician_mail_id);

    if ($ticket['userid'] == 0) {
        $contact = $ticket['email'];
    } else {
        $contact = getSingleValue("people", "name", $ticket['userid']);
    }

    if ($ticket['clientid'] != 0) {
        $client = getSingleValue("clients", "name", $ticket['clientid']);
    }
    $contact_no = getSingleValue("people", "mobile", $ticket['userid']);
    $user_dept = getSingleValue("people", "title", $ticket['userid']);
    $dipartment_name = getSingleValue('department', 'name', $contract['department']);
    $subject = getSingleValue("ticketsubject", "subject", $ticket['subject']);
    $search1 = array('{ticketid}', '{company}', '{department}');
    $replace1 = array($ticket['ticket'], $client, $dipartment_name);
    // $search = array('{message}','{company}');
    // $replace = array($template['message'],$client);
    // echo "<pre>";
    // print_r($replace);
    $assetid = getSingleValue("contract", "assetid", $contract['id']);
    $modelid = getSingleValue("assets", "modelid", $assetid);
    $supplierid = getSingleValue("assets", "supplierid", $assetid);
    $assetmodel = getSingleValue("models", "name", $modelid);
    $serial_no = getSingleValue('suppliers', 'name', $supplierid);
    //echo $ticket['adminid'];
    if ($ticket['adminid'] == 0) {
        $assignedto = 'To be Scheduled';
    } else {
        $assignedto = getSingleValue('people', 'name', $ticket['adminid']);
    }
    //echo $assignedto;
    $search = array('{ticketid}', '{subject}', '{contact}', '{message}', '{company}', '{department}', '{contactnumber}', '{userdepartment}', '{unit}', '{status}', '{assignedto}');
    $replace = array($ticket['ticket'], $subject, $contact, $reply, $client, $dipartment_name, $contact_no, $user_dept, $assetmodel, $status, $assignedto);

    $subject = str_replace($search1, $replace1, $template['subject']);

    $message = str_replace($search, $replace, $template['message']);

    //die("here");

    //die("dfgsd");

    sendEmailNotification($ticket['email'], $subject, $message, $ticket['clientid'], $ticket['userid'], $technician_mail_id);
}



function ticketNotification1($ticketid, $reply, $templateid, $depart, $contract_id)
{

    $template = getRowById("notificationtemplates", $templateid);


    $ticket = getRowById("tickets", $ticketid);
    $contract = getRowById("contract", $ticket['contractid']);



    $contrctno   = $contract['contractno'];
    $department   = $contract['department'];
    $depart1 = getSingleValue("department", "name", $department);
    $technician_mail_id   = $contract['technician_mail_id'];
    if ($ticket['userid'] == 0) {
        $contact = $ticket['email'];
    } else {
        $contact = getSingleValue("people", "name", $ticket['userid']);
    }

    if ($ticket['clientid'] != 0) {
        $client = getSingleValue("clients", "name", $ticket['clientid']);
    }



    $dipartment_name = getSingleValue('department', 'name', $contract['department']);
    $search1 = array('{ticketid}', '{company}', '{department}');
    $replace1 = array($ticket['ticket'], $client, $dipartment_name);
    // $search = array('{message}','{company}');
    // $replace = array($template['message'],$client);
    // echo "<pre>";
    // print_r($replace);
    $search = array('{ticketid}', '{subject}', '{contact}', '{message}', '{company}');
    $replace = array($ticket['ticket'], $ticket['subject'], $contact, $reply, $client, $contract['department']);

    $subject = str_replace($search1, $replace1, $template['subject']);

    $message = str_replace($search, $replace, $template['message']);


    sendEmailNotification($ticket['email'], $subject, $message, $ticket['clientid'], $ticket['userid'], $technician_mail_id);
}



function newUserNotification($peopleid, $password)
{ //send new user/admin notification
    global $database;
    $template = getRowById("notificationtemplates", 3);
    $people = getRowById("people", $peopleid);

    $search = array('{contact}', '{email}', '{password}', '{company}');
    $replace = array($people['name'], $people['email'], $password, getConfigValue("company_name"));

    $subject = str_replace($search, $replace, $template['subject']);
    $message = str_replace($search, $replace, $template['message']);

    sendEmail($people['email'], $subject, $message, $people['clientid'], $people['id']);
}

function passwordResetNotification($peopleid, $resetlink)
{ //send password reset link
    global $database;
    $template = getRowById("notificationtemplates", 5);
    $people = getRowById("people", $peopleid);

    $search = array('{contact}', '{resetlink}', '{company}');
    $replace = array($people['name'], $resetlink, getConfigValue("company_name"));
    // echo $resetlink;
    $subject = str_replace($search, $replace, $template['subject']);
    $message = str_replace($search, $replace, $template['message']);
    //die("here");

    sendEmail($people['email'], $subject, $message, $people['clientid'], $people['id']);
}

function monitoringEmailNotification($peopleid, $hostid, $hostinfo, $status)
{ //send monitoting email alert
    global $database;
    $template = getRowById("notificationtemplates", 6);
    $people = getRowById("people", $peopleid);
    $host = getRowById("hosts", $hostid);

    $search = array('{hostinfo}', '{status}', '{contact}', '{company}');
    $replace = array($hostinfo, $status, $people['name'], getConfigValue("company_name"));

    $subject = str_replace($search, $replace, $template['subject']);
    $message = str_replace($search, $replace, $template['message']);

    sendEmail($people['email'], $subject, $message, $host['clientid'], $people['id']);
}

function monitoringSMSNotification($peopleid, $hostid, $hostinfo, $status)
{ //send monitoring SMS alert
    global $database;
    $template = getRowById("notificationtemplates", 6);
    $people = getRowById("people", $peopleid);
    $host = getRowById("hosts", $hostid);

    $search = array('{hostinfo}', '{status}', '{contact}', '{company}');
    $replace = array($hostinfo, $status, $people['name'], getConfigValue("company_name"));

    $sms = str_replace($search, $replace, $template['sms']);

    sendSMS($people['mobile'], $sms, $host['clientid'], $people['id']);
}

// ----------------------------------------------------------------------------------------------
// MONITORING

function serviceCheck($hostaddr, $port, $timeout)
{ //check if a service is up returns response time, 0 for down
    $errno = 0;

    $starttime = microtime(true);
    $conn = @fsockopen($hostaddr, $port, $errno, $errstr, $timeout);
    $latency = microtime(true) - $starttime;

    if (!$conn) {
        return 0;
    } else
        return $latency;

    if (is_resource($conn)) {
        fclose($conn);
    }
}

function addHistory($checkid, $status, $latency)
{ //add check results to history
    global $database;
    $database->insert("hosts_history", [
        "checkid" => $checkid,
        "status" => $status,
        "latency" => $latency,
        "timestamp" => date("Y-m-d H:i:s")
    ]);
}

function alertDown($checkid)
{ //send alert if state changes to down
    global $database;
    $check = getRowById("hosts_checks", $checkid);
    $host = getRowById("hosts", $check['hostid']);

    if ($check['status'] != "Down") {
        $database->update("hosts_checks", ["status" => "Down"], ["id" => $checkid]);

        $hostinfo = $host['name'] . " - " . $check['name'];
        $status = "DOWN";

        $asignedPeople = getTableFiltered("hosts_people", "hostid", $check['hostid']);
        foreach ($asignedPeople as $assigned) {
            if ($check['email'] == 1)
                monitoringEmailNotification($assigned['peopleid'], $check['hostid'], $hostinfo, $status);
            if ($check['sms'] == 1)
                monitoringSMSNotification($assigned['peopleid'], $check['hostid'], $hostinfo, $status);
        }
    }
}

function alertUp($checkid)
{ //send alert if state changes to up
    global $database;
    $check = getRowById("hosts_checks", $checkid);
    $host = getRowById("hosts", $check['hostid']);

    if ($check['status'] != "Up") {
        $database->update("hosts_checks", ["status" => "Up"], ["id" => $checkid]);

        $hostinfo = $host['name'] . " - " . $check['name'];
        $status = "UP";

        $asignedPeople = getTableFiltered("hosts_people", "hostid", $check['hostid']);
        foreach ($asignedPeople as $assigned) {
            if ($check['email'] == 1)
                monitoringEmailNotification($assigned['peopleid'], $check['hostid'], $hostinfo, $status);
            if ($check['sms'] == 1)
                monitoringSMSNotification($assigned['peopleid'], $check['hostid'], $hostinfo, $status);
        }
    }
}

function runAll()
{ //run all enabled checks
    $checks = getTable("hosts_checks");
    foreach ($checks as $check) {
        $hostaddr = getSingleValue("hosts", "address", $check['hostid']);
        if ($check['monitoring'] == 1 && $check['type'] == "Service") {
            $result = serviceCheck($hostaddr, $check['port'], 1);

            if ($result == 0) {
                $recheck = serviceCheck($hostaddr, $check['port'], 1);
                if ($recheck == 0) {
                    addHistory($check['id'], "Down", $recheck);
                    alertDown($check['id']);
                } else {
                    addHistory($check['id'], "Up", $recheck);
                    alertUp($check['id']);
                }
            } else {
                addHistory($check['id'], "Up", $result);
                alertUp($check['id']);
            }
        }
    }

    updateStatus();
}

function updateStatus()
{ //update status for all hosts
    global $database;
    $hosts = getTable("hosts");
    foreach ($hosts as $host) {
        $countAll = countTableFiltered("hosts_checks", "hostid", $host['id'], "", "");
        $countUp = countTableFiltered("hosts_checks", "hostid", $host['id'], "status", "Up");
        $countDown = countTableFiltered("hosts_checks", "hostid", $host['id'], "status", "Down");
        $generalStatus = "";
        if ($countAll != 0) {
            if ($countAll == $countUp)
                $generalStatus = "Up";
            elseif ($countAll == $countDown)
                $generalStatus = "Down";
            else
                $generalStatus = "Warning";
        }
        $database->update("hosts", ["status" => $generalStatus], ["id" => $host['id']]);
    }
}

// ISSUE INVOICE
function issueInvoice($data)
{
    global $database, $mpdf, $scriptpath;
    $y = date('Y');
    //    $history = getRowById("contract_history", $_GET['id']);
    $sql = "SELECT contract.id as contract_id, contract.contractno, contract.contract_amount, contract.department, "
        . " assets.tag, assets.name as assetname, assets.serial, models.name as model_name "
        . " FROM contract "
        . " LEFT JOIN assets ON assets.id = contract.assetid "
        . " LEFT JOIN models ON assets.modelid = models.id "
        . " WHERE MONTH(contract.created_date) = " . $data['month'] . " AND YEAR(contract.created_date) = " . $y . " AND is_end = 0 AND contract.clientid = " . $data['clientid']
        . " ORDER BY contract.id DESC";
    //cs_debug($sql); 
    $query = $database->query($sql);
    $contracts = $query->fetchAll();
    if ($contracts) {
        $doc_no = getDocNo();
        $client = getTableFiltered("clients", "id", $data['clientid']);
        $client->get("clients", "*", ["id" => $data['clientid']]);
        //    cs_debug($client); 
        //$client = $client[0];
        ob_start();
        include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'pdf/issue_invoice.php');
        $html = ob_get_contents();
        ob_end_clean();
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "issue_invoice_$doc_no.pdf";
        //generate the PDF from the given html
        $mpdf->WriteHTML($html);
        //download it.
        $mpdf->Output($pdfFilePath, "I");
        exit();
    }
}

function saveMonth($data)
{
    global $database;
    $m = $data['month'];
    //Update month of client
    $database->update('clients', ['for_the_month' => $m], ['id' => $data['clientid']]);
    return "20";
}

function updatedContractDate($contract)
{
    global $database;
    $contractno = $contract['contractno'];
    $arr = explode('-', $contractno);
    $date = date("Y-m-d H:i:s", strtotime($arr[0]));
    $database->update('contract', ['created_date' => $date], ['id' => $contract['id']]);
}

// ----------------------------------------------------------------------------------------------
// PROJECTS

function addProject($data)
{
    global $database;
    if (isset($data['issuesprogress']))
        $progress = -1;
    else
        $progress = $data['pslider'];
    $lastid = $database->insert("projects", [
        "clientid" => $data['clientid'],
        "tag" => $data['tag'],
        "name" => $data['name'],
        "notes" => "",
        "description" => $data['description'],
        "startdate" => $data['startdate'],
        "deadline" => $data['deadline'],
        "progress" => $progress
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editProject($data)
{
    global $database;
    if (isset($data['issuesprogress']))
        $progress = -1;
    else
        $progress = $data['pslider'];
    $database->update("projects", [
        "clientid" => $data['clientid'],
        "tag" => $data['tag'],
        "name" => $data['name'],
        "description" => $data['description'],
        "startdate" => $data['startdate'],
        "deadline" => $data['deadline'],
        "progress" => $progress
    ], ["id" => $data['id']]);
    return "20";
}

function deleteProject($id)
{
    global $database;
    $database->delete("projects", ["id" => $id]);
    return "30";
}

function saveProjectNotes($data)
{
    global $database;
    $database->update("projects", [
        "notes" => $data['notes']
    ], ["id" => $data['id']]);
    return "20";
}

function addProjectAdmin($data)
{ //assign admin to project
    global $database;
    $lastid = $database->insert("projects_admins", [
        "projectid" => $data['projectid'],
        "adminid" => $data['adminid']
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function deleteProjectAdmin($id)
{ //unassign admin from client
    global $database;
    $database->delete("projects_admins", ["id" => $id]);
    return "30";
}

function nextProjectTag()
{
    global $database;
    $max = $database->max("projects", "id");
    return $max + 1;
}

function updateIssueStatus($id, $status)
{
    global $database;
    $database->update("issues", [
        "status" => $status
    ], ["id" => $id]);
    return "20";
}

function projectProgress($id)
{
    global $database;
    $progress = 0;
    $project = getRowById("projects", $id);
    if ($project['progress'] != -1)
        $progress = $project['progress'];
    else {
        $allissues = $database->count("issues", ["projectid" => $id]);
        $doneissues = $database->count("issues", ["AND" => ["status" => "Done", "projectid" => $id]]);
        if ($allissues == 0)
            $progress = 0;
        else
            $progress = round(($doneissues / $allissues) * 100, 0);
    }
    return $progress;
}

// ----------------------------------------------------------------------------------------------
// FILES

function uploadContractFile($data, $files)
{
    $status = 9500;
    global $database;
    global $scriptpath;
    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    $filename = basename($files["file"]["name"]);
    $targetfile = $targetdir . $filename;
    if (file_exists($targetfile)) {
        $status = 9501;
    }
    if ($status == 9500) {
        if (move_uploaded_file($files["file"]["tmp_name"], $targetfile)) {
            $database->insert("contract_files", [
                "contractid" => $data['contractid'],
                "name" => $data['name'],
                "file" => $filename
            ]);
            $status == 9500;
        } else
            $status == 9502;
    }
    return $status;
}

function deleteContractFile($id)
{
    $status = 9503;
    global $database;
    global $scriptpath;
    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    $file = getRowById("contract_files", $id);
    $filename = $file['file'];
    $targetfile = $targetdir . $filename;
    if (!unlink($targetfile)) {
        deleteRowById("contract_files", $id);
        $status = 9504;
    } else {
        deleteRowById("contract_files", $id);
        $status = 9503;
    }
    return $status;
}

function uploadFile($data, $files)
{
    $status = 9500;
    global $database;
    global $scriptpath;
    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    $filename = basename($files["file"]["name"]);
    $targetfile = $targetdir . $filename;
    if (file_exists($targetfile)) {
        $status = 9501;
    }
    if ($status == 9500) {
        if (move_uploaded_file($files["file"]["tmp_name"], $targetfile)) {
            $database->insert("files", [
                "clientid" => $data['clientid'],
                "projectid" => $data['projectid'],
                "assetid" => $data['assetid'],
                "name" => $data['name'],
                "document_type" => $data['document_type'],
                "document_memo" => $data['document_memo'],
                "serial_number" => $data['seareal'],
                "file" => $filename
            ]);
            $status == 9500;
        } else
            $status == 9502;
    }
    return $status;
}
function fileEdit($data, $files)
{
    $status = 9500;
    global $database;
    global $scriptpath;
    if ($files["file"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        $filename = basename($files["file"]["name"]);
        $name = $files["file"]["name"];
        $targetfile = $targetdir . $filename;
        if (move_uploaded_file($files["file"]["tmp_name"], $targetfile)) {

            $database->update("files", [
                "name" => $data['name'],
                "document_type" => $data['document_name'],
                "document_memo" => $data['document_memo'],
                "file" => $filename
            ], ["id" => $data['id']]);
        }
    } else {
        $database->update("files", [
            "name" => $data['name'],
            "document_type" => $data['document_name'],
            "document_memo" => $data['document_memo'],
            "file" => $data['file_vlaues']
        ], ["id" => $data['id']]);
    }
    $status == 9500;
    return $status;
}

function deleteFile($id)
{
    $status = 9503;
    global $database;
    global $scriptpath;
    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    $file = getRowById("files", $id);
    $filename = $file['file'];
    $targetfile = $targetdir . $filename;
    if (!unlink($targetfile)) {
        deleteRowById("files", $id);
        $status = 9504;
    } else {
        deleteRowById("files", $id);
        $status = 9503;
    }
    return $status;
}

function fileIcon($file)
{
    global $scriptpath;
    $filepath = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file;
    $ext = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
    $icon = "file-o";
    $archive = array("zip", "rar", "7z", "gz", "iso", "tar", "bz2", "xz", "ace", "apk", "xar", "zz", "war", "wim", "tar.gz", "tgz", "tar.Z", "tar.bz2", "tbz2", "dmg", "s7z");
    $audio = array("mp3", "wav", "aac", "aa", "aax", "aiff", "au", "flac", "m4a", "m4b", "m4p", "ogg", "oga", "wma");
    $code = array("php", "html", "css", "js", "asp", "htm", "sql", "pl");
    $excel = array("xls", "xlsx", "xlsm", "xml", "xlam", "xla", "ods", "fods");
    $image = array("png", "jpg", "jpeg", "tiff", "tif", "gif", "bmp", "ai", "svg", "eps");
    $pdf = array("pdf", "xps");
    $powerpoint = array("ppt", "pot", "pps", "pptx", "pptm", "potx", "potm", "ppam", "ppsx", "ppsm", "sldx", "sldm", "odg", "fodg");
    $text = array("txt", "nfo", "rtf");
    $video = array("avi", "3gp", "wmv", "ogg", ",mpeg", "mpg", "mpe", "mov", "mkv", "flr", "fla", "flv");
    $word = array("doc", "dot", "docx", "docm", "dotx", "dotm", "docb", "odt", "fodt");
    if (in_array($ext, $archive))
        $icon = "file-archive-o";
    if (in_array($ext, $audio))
        $icon = "file-audio-o";
    if (in_array($ext, $code))
        $icon = "file-code-o";
    if (in_array($ext, $excel))
        $icon = "file-excel-o";
    if (in_array($ext, $image))
        $icon = "file-image-o";
    if (in_array($ext, $pdf))
        $icon = "file-pdf-o";
    if (in_array($ext, $powerpoint))
        $icon = "file-powerpoint-o";
    if (in_array($ext, $text))
        $icon = "file-text-o";
    if (in_array($ext, $video))
        $icon = "file-video-o";
    if (in_array($ext, $word))
        $icon = "file-word-o";

    return $icon;
}

function uploadmodlimage($files, $model)
{
    $result['status'] = 9500;
    global $scriptpath;
    // echo "<pre>";
    // print_r($files);
    // print_r($model);
    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    $filename = date('ymd') . $model['name'] . "-" . normalizeString($files['image']['name']);
    $targetfile = $targetdir . $filename;
    //cs_debug($targetfile);
    // if (file_exists($targetfile)) {
    // $result['status'] = 9501;
    // }
    if ($result['status'] == 9500) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetfile)) {
            $result['file'] = $filename;
            $result['status'] = 9500;
        } else {
            $result['status'] = 9502;
        }
    }
    return $result;
}

function uploadUsuageReportlimage($files, $model)
{
    $result['status'] = 9500;
    global $scriptpath;
    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "usage_report" . DIRECTORY_SEPARATOR;
    if (!file_exists($targetdir)) {
        mkdir($targetdir, 0777, true);
    }
    $comapany_name = substr(getConfigValue("company_name"), 0, 3);
    $current_date = date('Y_m_d');
    $filename = $comapany_name . "_" . $current_date . "_" . normalizeString($files['image']['name']);
    $targetfile = $targetdir . $filename;
    if ($result['status'] == 9500) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetfile)) {
            $result['file'] = $filename;
            $result['status'] = 9500;
        } else {
            $result['status'] = 9502;
        }
    }
    return $result;
}

function uploadactualreportlimage($files, $model)
{
    $result['status'] = 9500;
    global $scriptpath;
    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "actual_status" . DIRECTORY_SEPARATOR;
    if (!file_exists($targetdir)) {
        mkdir($targetdir, 0777, true);
    }
    // Define allowed file extensions
    $allowedExtensions = ['jpg', 'jpeg'];
    // Extract and sanitize filename
    $originalFileName = $files['image']['name'];
    $file_extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $normalized_filename = normalizeString($originalFileName);
    // Check if the uploaded file is a JPEG
    if (!in_array(strtolower($file_extension), $allowedExtensions)) {
        $result['status'] = 9501; // Error code for invalid file type
        return $result;
    }
    // Generate unique filename based on company name and current date
    $comapany_name = substr(getConfigValue("company_name"), 0, 3);
    $current_date = date('Y_m_d');
    $filename = $comapany_name . "_" . $current_date . "_" . $normalized_filename;
    // Construct target file path
    $targetfile = $targetdir . $filename;
    // Move uploaded file to target directory
    if ($result['status'] == 9500) {
        if (move_uploaded_file($files["image"]["tmp_name"], $targetfile)) {
            $result['file'] = $filename;
            $result['status'] = 9500;
        } else {
            $result['status'] = 9502; // Error code for file move failure
        }
    }
    return $result;
}

function uploadAssetFile($files, $asset = array())
{
    $result['status'] = 9500;
    //cs_debug($files);
    //    global $database;
    global $scriptpath;
    $model = getTableFiltered("models", "id", $asset['modelid']);
    $sup = getTableFiltered("suppliers", "id", $asset['supplierid']);
    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    foreach ($files as $key => $file) {
        $filename = $asset['sku'] . "-" . $sup[0]['name'] . "-" . $asset['purchase_date'] . "-" . $model[0]['name'] . "-" . normalizeString($file['name']);
        $targetfile = $targetdir . $filename;
        //cs_debug($targetfile);
        if (file_exists($targetfile)) {
            $result['status'] = 9501;
        }
        if ($result['status'] == 9500) {
            if (move_uploaded_file($file["tmp_name"], $targetfile)) {
                $result[$key] = $filename;
                $result['status'] == 9500;
            } else {
                $result['status'] == 9502;
            }
        }
    }
    return $result;
}

function uploadTicketFile($files, $asset = array())
{
    $result['status'] = 9500;
    //cs_debug($files);
    //    global $database;
    global $scriptpath;
    // echo "<pre>";
    // print_R($files);
    //$model = getTableFiltered("models", "id", $asset['modelid']);
    //$sup = getTableFiltered("suppliers", "id", $asset['supplierid']);
    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    foreach ($files as $key => $file) {
        $filename = normalizeString($file['name']);
        $targetfile = $targetdir . $filename;
        //cs_debug($targetfile);
        // if (file_exists($targetfile)) {
        // $result['status'] = 9501;
        // }
        if (move_uploaded_file($file["tmp_name"], $targetfile)) {
            $result[$key] = $filename;
            $result['status'] == 9500;
        } else {
            $result['status'] == 9502;
        }
    }
    return $result;
}
function uploadTechnicianFile($files)
{
    global $scriptpath;
    $result = ['status' => 9500];
    $baseDir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    $filenames = [];
    foreach ($files as $key => $file) {
        $subDir = ($key === 'technician_file') ? "technician_file" : "fixed_image";
        $targetdir = $baseDir . $subDir . DIRECTORY_SEPARATOR;
        if (!file_exists($targetdir)) {
            mkdir($targetdir, 0777, true);
        }
        $filename = normalizeString($file['name']);
        $targetfile = $targetdir . $filename;
        if (move_uploaded_file($file["tmp_name"], $targetfile)) {
            $filenames[$key] = $filename;
            $result[$key] = [
                'status' => 9500,
                'filename' => $filename,
                'message' => 'File uploaded successfully.',
                'directory' => $targetdir
            ];
        } else {
            $result[$key] = [
                'status' => 9502,
                'filename' => $file['name'],
                'message' => 'Failed to upload file.',
                'directory' => $targetdir
            ];
        }
    }

    $filename = $filenames;
    unset($result['filenames']);
    return $filename;
}

function cs_debug($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}


function genratebarcode($data, $id)
{
    require_once('barcode.inc.php');
    $name = "barcodesku" . $id;
    new barCodeGenrator($data, 0, $name, 190, 80, true);
}

function normalizeString($str = '')
{
    $str = strip_tags($str);
    $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
    $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
    $str = strtolower($str);
    $str = html_entity_decode($str, ENT_QUOTES, "utf-8");
    $str = htmlentities($str, ENT_QUOTES, "utf-8");
    $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
    $str = str_replace(' ', '-', $str);
    $str = rawurlencode($str);
    $str = str_replace('%', '-', $str);
    return $str;
}

function getDocNo($date = NULL)
{
    global $database;
    $d = ($date) ? $date : date('Y-m-d');
    $issue_invoice_log = $database->get("issue_invoice_log", "qty", ["created_date" => $d]);
    if ($issue_invoice_log) {
        $new = (int) $issue_invoice_log + 1;
        //cs_debug($new);
        $database->update("issue_invoice_log", ["qty" => $issue_invoice_log + 1], ["created_date" => $d]);
        return date('Ymd') . sprintf("%'.02d\n", $new);
    } else {
        $database->insert('issue_invoice_log', ['qty' => 1, 'created_date' => $d]);
        return date('Ymd') . sprintf("%'.02d\n", 1);
    }
}

function getMonthName($month = NULL)
{
    $m = NULL;
    if ($month) {
        switch ($month) {
            case 1:
                $m = 'Jan';
                break;
            case 2:
                $m = 'Feb';
                break;
            case 3:
                $m = 'Mar';
                break;
            case 4:
                $m = 'Apr';
                break;
            case 5:
                $m = 'May';
                break;
            case 6:
                $m = 'Jun';
                break;
            case 7:
                $m = 'Jul';
                break;
            case 8:
                $m = 'Aug';
                break;
            case 9:
                $m = 'Sep';
                break;
            case 10:
                $m = 'Oct';
                break;
            case 11:
                $m = 'Nov';
                break;
            case 12:
                $m = 'Dec';
                break;
        }
    }
    return $m;
}

//invoice
// function addinvoice($data, $files){
//     $data['balance'] = $data['amount'] - $data['paid'];
//     global $database;
//     $inv_file = uploadinvoice($data, $files);
//     $paid_file = uploadinvoice_paidfile($data, $files);
//     $or_file = uploadinvoice_orfile($data, $files);
//     if ($inv_file['status'] == 9500 && $paid_file['status'] == 9500 && $or_file['status'] == 9500) {
//         $lastid = $database->insert("invoice", [
//             "clintid" => $data['clintid'],
//             "date" => $data['date'],
//             "month" => $data['month'],
//             "invoiceno" => $data['invoiceno'],
//             "amount" => $data['amount'],
//             "ornumber" => $data['ornumber'],
//             "invoice_contract_id" => implode(",",$data["check"]),
//             "paid" => $data['paid'],
//             "balance" => $data['balance'],
//             "remark" => $data['remark'],
//             "attachment" => $inv_file['name'],
//             "paid_file" => $paid_file['name'],
//             "or_file" => $or_file['name'],
//             "notes" => $data['notes'],
//         ]);
//         //cs_debug($lastid);
//         if ($lastid == "0") {
//             return "11";
//         } else {
//             return "10";
//         }
//     } else {
//         return "12";
//     }
// }

function addinvoice($data, $files)
{
    $data['balance'] = $data['amount'] - $data['paid'];
    global $database;
    $inv_file = uploadinvoice($data, $files);
    $paid_file = uploadinvoice_paidfile($data, $files);
    $or_file = uploadinvoice_orfile($data, $files);
    $tax_file = uploadinvoice_taxfile($data, $files);
    $clintid = $data['clintid'];
    $check_contract_ids = $data['check'];
    $checked_lic_ids = isset($data['checked_lic_ids']) ? $data['checked_lic_ids'] : '';
    $invoice = 0;
    if ($inv_file['status'] == 9500 && $paid_file['status'] == 9500 && $or_file['status'] == 9500 && $tax_file['status'] == 9500) {
        $lastid = $database->insert("invoice", [
            "clintid" => $data['clintid'],
            "date" => $data['date'],
            "month" => $data['month_hid'],
            "invoiceno" => $data['invoiceno'],
            "amount" => $data['amount'],
            "ornumber" => $data['ornumber'],
            "invoice_contract_id" => isset($data["check"]) ?  implode(",", $data["check"]) : '',
            "paid" => $data['paid'],
            "balance" => $data['balance'],
            "payment_method" => isset($data['payment_method']) && $data['payment_method'] != '' ? $data['payment_method'] : '',
            "payment_ref_no" => $data['payment_ref_no'],
            "tax_amount" => $data['tax_amount'],
            "final_balance" => $data['final_balance'],
            "remark" => $data['remark'],
            "attachment" => $inv_file['name'],
            "paid_file" => $paid_file['name'],
            "or_file" => $or_file['name'],
            "tax_file_2307" => $tax_file['name'],
            "notes" => $data['notes'],
            "ref_no" => $data['ref_no_hid'],
            "checked_lic_ids" => $checked_lic_ids
        ]);
        foreach ($check_contract_ids as $check_contract_id) {
            $sql = "UPDATE invoice_contract 
            SET invoice = $lastid 
            WHERE invoice_id = $clintid 
            AND contract_id = $check_contract_id 
            AND invoice = $invoice";
            $database->query($sql);
        }
        //cs_debug($lastid);
        if ($lastid == "0") {
            return "11";
        } else {
            return "10";
        }
    } else {
        return "12";
    }
}
// function invoiceedit($data, $files)
// {
//     // echo "<pre>";
//     // print_r($data);
//     // print_r($files);
//     // echo "</pre>";
//     // die('gregrg');

//     $data['balance'] = $data['amount'] - $data['paid'];
//     global $database;
//     $inv_file = uploadinvoice($data, $files);
//     $paid_file = uploadinvoice_paidfile($data, $files);
//     $or_file = uploadinvoice_orfile($data, $files);
//     if ($inv_file['status'] == 9500 && $paid_file['status'] == 9500 && $or_file['status'] == 9500) {
//         $database->update("invoice", [
//             "clintid" => $data['clintid'],
//             "date" => $data['date'],
//             "month" => $data['month'],
//             "invoiceno" => $data['invoiceno'],
//             "amount" => $data['amount'],
//             "ornumber" => $data['ornumber'],
//             "invoice_contract_id" => implode(",",$data["check"]),
//             "paid" => $data['paid'],
//             "balance" => $data['balance'],
//             "remark" => $data['remark'],
//             "attachment" => $inv_file['name'],
//             "paid_file" => $paid_file['name'],
//             "or_file" => $or_file['name'],
//             "notes" => $data['notes'],
//         ], ["id" => $data['invoiceid']]);

//         return "20";
//     } else {
//         return "12";
//     }
// }

function invoiceedit($data, $files)
{
    $data['balance'] = $data['amount'] - $data['paid'];
    $data['balance'] = ($data['balance'] < 0) ? 0 : $data['balance'];
    if ($data['balance'] == $data['tax_amount']) {
        $data['balance'] = 0;
    }
    global $database;

    $inv_file = uploadinvoice($data, $files);
    $paid_file = uploadinvoice_paidfile_2($data, $files);
    $or_file = uploadinvoice_orfile_2($data, $files);
    $tax_file = uploadinvoice_taxfile_2($data, $files);

    $cleared = 0;
    if ($data['cleared'] == 'on') {
        $cleared = 1;
    }

    $invoice = getTableFiltered("invoice", "id", $data['invoiceid']);
    $date = date('d-m-Y', strtotime($data['date']));

    $checked_lic_ids = isset($data['checked_lic_ids']) ? $data['checked_lic_ids'] : '';
    $updated = $database->update("invoice", [
        "clintid" => $data['clintid'],
        "date" => $date,
        "month" => $data['month_hid'],
        "invoiceno" => $data['invoiceno'],
        "amount" => $data['amount'],
        "ornumber" => $data['ornumber'],
        "invoice_contract_id" => implode(",", $data["check"]),
        "paid" => $data['paid'],
        "cleared" => $cleared,
        "balance" => $data['balance'],
        "payment_method" => $data['payment_method'],
        "payment_ref_no" => $data['payment_ref_no'],
        "tax_amount" => $data['tax_amount'],
        "final_balance" => $data['final_balance'],
        "remark" => $data['remark'],
        "attachment" => !empty($inv_file['name']) ? $inv_file['name'] : $invoice[0]['attachment'],
        "paid_file" => !empty($paid_file['name']) ? $paid_file['name'] : $invoice[0]['paid_file'],
        "tax_file_2307" => !empty($tax_file['name']) ?  $tax_file['name'] : $invoice[0]['tax_file_2307'],
        "or_file" => !empty($or_file['name']) ?  $or_file['name'] : $invoice[0]['or_file'],
        "notes" => $data['notes'],
        "ref_no" => $data['ref_no_hid'],
        "checked_lic_ids" => $checked_lic_ids
    ], ["id" => $data['invoiceid']]);
    if ($updated) {
        return "20";
    } else {
        return "12";
    }
}

function uploadinvoice($data, $files)
{
    $status = 9500;
    $result['status'] = 9500;
    $result['name'] = "";
    global $database;
    global $scriptpath;
    if ($files["file"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        $clients = getTableFiltered("clients", 'id', $data['clintid']);
        $company_name = substr($clients[0]['name'], 0, 3);
        $current_date = date('m');
        $unique_identifier = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $original_filename = $files["file"]["name"];
        $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        // $filename = $company_name . "_" . $current_date . "_invoice_" . $unique_identifier;
        $filename = $company_name . "_" . $current_date . "_invoice_" . $unique_identifier . "." . $file_extension;
        // $filename = basename("invoice" . $files["file"]["name"]);
        $name = $files["file"]["name"];
        $targetfile = $targetdir . $filename;

        if ($status == 9500) {
            if (move_uploaded_file($files["file"]["tmp_name"], $targetfile)) {
                // $database->insert("invoicefile", [
                // "clintid" => $data['clintid'],
                // "name" => $name,
                // "file" => $filename,
                // ]);
                $result['name'] = $filename;
                $result['status'] = 9500;
            } else
                $result['status'] = 9502;
        }
    }
    return $result;
}

function uploadinvoice_orfile($data, $files)
{
    $status = 9500;
    $result['status'] = 9500;
    $result['name'] = "";
    global $scriptpath;
    if ($files["or_file"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        $clients = getTableFiltered("clients", 'id', $data['clintid']);
        $company_name = substr($clients[0]['name'], 0, 3);
        $current_date = date('m');
        $unique_identifier = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $original_filename = $files["or_file"]["name"];
        $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        $filename = $company_name . "_" . $current_date . "_or_" . $unique_identifier . "." . $file_extension;
        // $filename = basename("invoice" . $files["or_file"]["name"]);
        $name = $files["or_file"]["name"];
        $targetfile = $targetdir . $filename;

        if ($status == 9500) {
            if (move_uploaded_file($files["or_file"]["tmp_name"], $targetfile)) {
                $result['name'] = $filename;
                $result['status'] = 9500;
            } else
                $result['status'] = 9502;
        }
    }
    return $result;
}

function uploadArticlelimage($files, $data)
{
    $status = 9500;
    $result['status'] = 9500;
    $result['name'] = "";
    global $scriptpath;
    if ($files["file"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "Asset" . DIRECTORY_SEPARATOR;
        if (!file_exists($targetdir)) {
            mkdir($targetdir, 0777, true);
        }
        $current_date = date('m');
        $unique_identifier = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $original_filename = $files["file"]["name"];
        $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        $filename = "Asset" . "_" . $current_date . "_" . $unique_identifier . "." . $file_extension;
        $name = $files["file"]["name"];
        $targetfile = $targetdir . $filename;
        if ($status == 9500) {
            if (move_uploaded_file($files["file"]["tmp_name"], $targetfile)) {

                $result['name'] = $filename;
                $result['status'] = 9500;
            } else
                $result['status'] = 9502;
        }
    }
    return $result;
}

function uploadinvoice_taxfile($data, $files)
{
    $status = 9500;
    $result['status'] = 9500;
    $result['name'] = "";
    global $scriptpath;
    if ($files["tax_file_2307"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "tax_file" . DIRECTORY_SEPARATOR;
        if (!file_exists($targetdir)) {
            mkdir($targetdir, 0777, true);
        }
        $clients = getTableFiltered("clients", 'id', $data['clintid']);
        $company_name = substr($clients[0]['name'], 0, 3);
        $current_date = date('m');
        $unique_identifier = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $original_filename = $files["tax_file_2307"]["name"];
        $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        $filename = $company_name . "_" . $_GET['id'] . "_" . $unique_identifier . "." . $file_extension;
        // $filename = basename("invoice" . $files["tax_file_2307"]["name"]);
        $name = $files["tax_file_2307"]["name"];
        $targetfile = $targetdir . $filename;

        if ($status == 9500) {
            if (move_uploaded_file($files["tax_file_2307"]["tmp_name"], $targetfile)) {
                $result['name'] = $filename;
                $result['status'] = 9500;
            } else
                $result['status'] = 9502;
        }
    }
    return $result;
}

function uploadinvoice_paidfile($data, $files)
{
    $status = 9500;
    $result['status'] = 9500;
    $result['name'] = "";
    global $scriptpath;
    if ($files["paid_file"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        $clients = getTableFiltered("clients", 'id', $data['clintid']);
        $company_name = substr($clients[0]['name'], 0, 3);
        $current_date = date('m');
        $unique_identifier = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $original_filename = $files["paid_file"]["name"];
        $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        $filename = $company_name . "_" . $current_date . "_cpaid_" . $unique_identifier . "." . $file_extension;
        // $filename = basename("invoice" . $files["paid_file"]["name"]);
        $name = $files["paid_file"]["name"];
        $targetfile = $targetdir . $filename;

        if ($status == 9500) {
            if (move_uploaded_file($files["paid_file"]["tmp_name"], $targetfile)) {
                $result['name'] = $filename;
                $result['status'] = 9500;
            } else
                $result['status'] = 9502;
        }
    }
    return $result;
}

function uploademailfile($data, $files)
{
    $status = 9500;
    $result['status'] = 9500;
    $result['name'] = "";
    global $database;
    global $scriptpath;
    if ($files["file"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        $filename = basename("email_" . $files["file"]["name"]);
        $name = $files["file"]["name"];
        $targetfile = $targetdir . $filename;

        if ($status == 9500) {
            if (move_uploaded_file($files["file"]["tmp_name"], $targetfile)) {
                $result['name'] = $filename;
                $result['status'] = 9500;
            } else
                $result['status'] = 9502;
        }
    }
    return $result;
}

function sendmail($data, $files)
{
    global $database;
    $data['datetime'] = date("Y-m-d H:i:s");
    $sessionid = session_id();
    $crntusr = getTableFiltered("people", "sessionid", $sessionid);
    $frommsg = $crntusr[0]['email'];

    if (isset($data['chkall'])) {
        $clients = getTableFiltered("clients", 'is_active', 1);
    } elseif (isset($data['chkslt'])) {
        $clients = getTableFiltered("clients", 'id', $data['clientid']);
    } else {
        return "12";
    }

    foreach ($clients as $client) {
        if ($client['id'] != 0) {
            $users = getTableFiltered("people", "clientid", $client['id']);
            if ($users != "") {
                foreach ($users as $user) {
                    $uploaded = uploademailfile($data, $files);
                    if ($uploaded['status'] == 9500) {
                        $eemal = sendEmail($user['email'], $data['subject'], $data['message'], $user['clientid'], $user['id'], $uploaded['name']);
                        if ($eemal == 1) {
                            $status = 'sent';
                        } else {
                            $status = 'notsent';
                        }
                        $database->insert("newemail", [
                            "touserid" => $user['id'],
                            "clientid" => $user['clientid'],
                            "fromid" => $crntusr[0]['id'],
                            "address" => $user['email'],
                            "subject" => $data['subject'],
                            "masag" => $data['message'],
                            "filename" => $uploaded['name'],
                            "datetime" => $data['datetime'],
                            "status" => $status
                        ]);
                        if ($eemal == 1) {
                            return "14";
                        } else {
                            return "13";
                        }
                    } else {
                        return "11";
                    }
                }
            }
            return "15";
        } else {
            return "11";
        }
    }
    return "14";
}
function addslide($data, $files)
{
    $status = 9500;
    $result['name'] = "";
    global $database;
    global $scriptpath;
    if ($files["file"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads/slide" . DIRECTORY_SEPARATOR;
        $filename = basename("slide" . $files["file"]["name"]);
        $name = $files["file"]["name"];
        $targetfile = $targetdir . $filename;
        if (move_uploaded_file($files["file"]["tmp_name"], $targetfile)) {
            $result['name'] = $filename;
        } else {
            return "66";
        }
    }
    if (isset($data['active'])) {
        $active = 1;
    } else {
        $active = 0;
    }
    $lastid = $database->insert("slider", [
        "groupnm" => $data['group'],
        "slidenm" => $data['slide'],
        "lurl" => $data['lurl'],
        "youtube_url" => $data['youtube_url'],
        "active" => $active,
        "notes" => $data['notes'],
        "datte" => date('y-m-d'),
        "image" => $result['name']
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function addbanner($data, $files)
{
    $status = 9500;
    $result['name'] = "";
    global $database;
    global $scriptpath;
    if ($files["file"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads/banner" . DIRECTORY_SEPARATOR;
        $filename = basename("slide" . $files["file"]["name"]);
        $name = $files["file"]["name"];
        $targetfile = $targetdir . $filename;
        if (move_uploaded_file($files["file"]["tmp_name"], $targetfile)) {

            $result['name'] = $filename;
        } else {
            return "66";
        }
    }
    if (isset($data['active'])) {
        $active = 1;
    } else {
        $active = 0;
    }
    $lastid = $database->insert("banner", [
        "slidenm" => $data['banner'],
        "lurl" => $data['lurl'],
        "active" => $active,
        "youtube_url" => $data['youtube_url'],
        "date" => date('y-m-d'),
        "image" => $result['name']
    ]);
    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function editbanner($data, $files)
{
    $status = 9500;
    $result['name'] = $data['image'];
    global $database;
    global $scriptpath;
    if ($files["file"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads/banner" . DIRECTORY_SEPARATOR;
        $filename = basename("slide" . $files["file"]["name"]);
        $name = $files["file"]["name"];
        $targetfile = $targetdir . $filename;
        if (move_uploaded_file($files["file"]["tmp_name"], $targetfile)) {

            $result['name'] = $filename;
        } else {
            return "66";
        }
    }
    if (isset($data['active'])) {
        $active = 1;
    } else {
        $active = 0;
    }
    $database->update("banner", [

        "slidenm" => $data['banner'],
        "lurl" => $data['lurl'],
        "active" => $active,
        "youtube_url" =>  $data['youtube_url'],
        "date" => date('y-m-d'),
        "image" => $result['name']
    ], ["id" => $data['id']]);
    return "10";
}

function deletebanner($id)
{
    global $database;
    $database->delete("banner", ["id" => $id]);
    return "30";
}

function editslide($data, $files)
{
    $status = 9500;
    $result['name'] = $data['image'];
    global $database;
    global $scriptpath;
    if ($files["file"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads/slide" . DIRECTORY_SEPARATOR;
        $filename = basename("slide" . $files["file"]["name"]);
        $name = $files["file"]["name"];
        $targetfile = $targetdir . $filename;
        if (move_uploaded_file($files["file"]["tmp_name"], $targetfile)) {

            $result['name'] = $filename;
        } else {
            return "66";
        }
    }
    if (isset($data['active'])) {
        $active = 1;
    } else {
        $active = 0;
    }
    $database->update("slider", [
        "groupnum" => $data['group'],
        "slidenm" => $data['slide'],
        "lurl" => $data['lurl'],
        "youtube_url" => $data['youtube_url'],
        "active" => $active,
        "notes" => $data['notes'],
        "datte" => date('y-m-d'),
        "image" => $result['name']
    ], ["id" => $data['id']]);
    return "10";
}
function deleteslide($id)
{
    global $database;
    $database->delete("slider", ["id" => $id]);
    return "30";
}
function deleteslidegroup($id)
{
    global $database;
    $database->delete("slider_group", ["id" => $id]);
    return "30";
}

function addslidegroup($data)
{
    global $database;
    if (isset($data['active'])) {
        $active = 1;
    } else {
        $active = 0;
    }
    $all_gvalue = getTable("slider_group");
    $grop_valu = array();
    foreach ($all_gvalue as $all_gva) {
        $grop_valu[] = $all_gva['groupnum'];
    }
    $v = $grop_valu[0];
    if ($v == $data['number']) {
        return "11";
    } else {
        $lastid = $database->insert("slider_group", [
            "groupnm" => $data['name'],
            "groupnum" => $data['number'],
            "active" => $active,
            "datee" => date('y-m-d')
        ]);
        if ($lastid == "0") {
            return "11";
        } else {
            return "10";
        }
    }
}

function editslidegroup($data)
{
    $data_item = getTable("slider_group");
    global $database;
    if (isset($data['active'])) {
        $active = 1;
    } else {
        $active = 0;
    }
    $all_gvalue = getTable("slider_group");
    $grop_valu = array();
    foreach ($all_gvalue as $all_gva) {

        $grop_valu[] = $all_gva['groupnum'];
    }
    $v = $grop_valu[0];
    // if ($v == $data['number']) {
    //     return "11";
    // } else {
    $database->update("slider_group", [
        "groupnm" => $data['name'],
        "groupnum" => $data['number'],
        "active" => $active,
        "datee" => date('y-m-d')
    ], ["id" => $data['id']]);
    return "10";
    // }
}

function editslidtext($data)
{
    global $database;
    $database->update("slider_notice", ["title" => $data['title'], "discription" => $data['discription']], ["id" => 1]);
    return "20";
}
function  SendTicketNoteEmail($to, $notes, $shortcmnt, $tickettype, $ticket_data)
{
    $contract_id = $ticket_data['ticket_contract'];
    $ticketid = $ticket_data['id'];
    $template = getRowById("notificationtemplates", 4);
    $ticket = getRowById("tickets", $ticketid);
    $contract = getRowById("contract", $contract_id);
    $assetid = getSingleValue("contract", "assetid", $contract_id);
    $modelid = getSingleValue("assets", "modelid", $assetid);
    $supplierid = getSingleValue("assets", "supplierid", $assetid);
    $assetmodel = getSingleValue("models", "name", $modelid);
    $serial_no = getSingleValue('suppliers', 'name', $supplierid);

    $subject = getSingleValue("ticketsubject", "subject", $ticket['subject']);
    $contrctno   = $contract['contractno'];
    $department   = $contract['department'];
    $technician_mail_id   = $contract['technician_mail_id'];

    if ($ticket['userid'] == 0) {
        $contact = $ticket['email'];
    } else {
        $contact = getSingleValue("people", "name", $ticket['userid']);
    }
    if ($ticket['clientid'] != 0) {
        $client = getSingleValue("clients", "name", $ticket['clientid']);
    }
    if ($ticket['adminid'] == 0) {
        $assignedto = 'To be scheduled.';
    } else {
        $assignedto = getSingleValue('people', 'name', $ticket['adminid']);
    }
    $consumable_name = getSingleValue("consumable_list", "name", $ticket_data['consumable_list_id']);
    $dipartment_name = getSingleValue('department', 'name', $contract['department']);
    $search1 = array('{ticketid}', '{company}', '{department}');
    $replace1 = array($ticket['ticket'], $client, $dipartment_name);
    $t_type = implode(',', $tickettype);
    $search = array('{ticketid}', '{subject}', '{contact}', '{department}', '{unit}', '{ticketnotes}', '{company}', '{status}', '{tickettype}', '{partsmaterialconsumed}', '{shortcomment}', '{cost}', '{assignedto}');
    $replace = array($ticket['ticket'], $subject, $contact, $dipartment_name, $assetmodel, $notes, $client, 'closed', $t_type, $consumable_name, $ticket_data['pmcon'], $ticket_data['consumable_cost'], $assignedto);

    $subject = str_replace($search1, $replace1, $template['subject']);
    $message = str_replace($search, $replace, $template['message']);
    sendEmailNotification($ticket['email'], $subject, $message, $ticket['clientid'], $ticket['userid'], $technician_mail_id);
}
function send_email_new_rprt($post, $files)
{
    $subject = $post['subject'];
    $message  = $post['message'];
    $emails = explode(',', $post['u_email']);
    $email_new = array_filter($emails);
    if (!empty($files)) {
        $uploaded = uploadTicketFile($files);

        $file = $uploaded['attachfile'];
    } else {
        $file = '';
    }
    global $scriptpath;
    $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file;

    $mail = new PHPMailer;
    if (getConfigValue("email_smtp_enable") == "true") {
        $mail->isSMTP();
        // $mail->Host = 'gator4089.hostgator.com';  // Specify main and backup SMTP servers
        $mail->Host = 'mail.egatesupport.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ticket@egatesupport.com';                 // SMTP username
        $mail->Password = 'HCqZWFgpAeT!';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;
    }
    $mail->From = getConfigValue("email_from_address");
    $mail->FromName = getConfigValue("email_from_name");
    //$emails =explode(',',$post['u_email']);
    for ($i = 1; $i <= count($email_new); $i++) {
        $mail->AddCC($emails[$i], 'User');
    }
    // $mail->AddCC($tech,'Techniciean');
    // $mail->AddCC($it_email,'It Manager Email');
    //$mail->AddCC('purijyoti22@gmail.com','User');
    $mail->addAddress($emails[0]);
    // $mail->addAddress('samaresmaiti@gmail.com');
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->addAttachment("uploads/" . $file);
    $mail->IsHTML(true);

    if (!$mail->send()) {
        // logEmail($clientid, $peopleid, $to, $subject, $mail->ErrorInfo);
        return 0; //error
    } else {
        //logEmail($clientid, $peopleid, $to, $subject, $message);
        return 1; //success
    }
}
function report_client($post)
{
    echo "<pre>";
    print_R($post);
    die("here");
}
function collectionSendmail($clientid)
{ //send monitoting email alert
    global $database;
    $template = getRowById("notificationtemplates", 7);
    $search = array('{company}', '{clientname}');
    //$clients = getRowById(" clients", $clientid);
    $client_email = getRowById("clients", $clientid);
    $it_email = $client_email['it_manager_email'];
    $purcheas_email = $client_email['purc_manager_email'];
    $client_name = $client_email['name'];
    $replace = array(getConfigValue("company_name"), $client_name);
    $subject = str_replace($search, $replace, $template['subject']);
    $message = str_replace($search, $replace, $template['message']);
    $sql = "SELECT email"
        . " FROM people "
        . " WHERE clientid = " . $clientid . " AND collection_change = 1"
        . " ORDER BY id DESC";
    $query = $database->query($sql);
    $allpeople = $query->fetchAll();
    if (!empty($allpeople)) {
        foreach ($allpeople as $people) {
            $to = $people['email'];
            //$to = 'shailjamaiti@gmail.com';
            $mail = new PHPMailer;
            if (getConfigValue("email_smtp_enable") == "true") {
                $mail->isSMTP();
                // $mail->Host = 'gator4089.hostgator.com';  // Specify main and backup SMTP servers
                $mail->Host = 'mail.egatesupport.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'ticket@egatesupport.com';                 // SMTP username
                $mail->Password = 'HCqZWFgpAeT!';                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;
            }
            $mail->From = getConfigValue("collection_recipient");
            $mail->FromName = getConfigValue("email_from_name");
            //$mail->AddCC($tech,'Techniciean');
            // $mail->AddCC($it_email,'It Manager Email');
            // $mail->AddCC($purcheas_email,'Purchase Manager Email');
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;
            // $mail->addAttachment("uploads/".$file);
            $mail->IsHTML(true);

            if (!$mail->send()) {

                return 0; //error
            } else {

                return 1; //success
            }
        }
    } else {
        return 2;
    }
}

function missing_page_count_email($clientid, $contract_no)
{ //send monitoting email alert
    global $database;
    $template = getRowById("notificationtemplates", 18);
    $search = array('{client_name}', '{contract_no}');
    //$clients = getRowById(" clients", $clientid);
    $client_email = getRowById("clients", $clientid);
    $it_email = $client_email['it_manager_email'];
    $purcheas_email = $client_email['purc_manager_email'];
    $client_name = $client_email['name'];
    $replace = [$client_name, $contract_no];

    $subject = str_replace($search, $replace, $template['subject']);
    $message = str_replace($search, $replace, $template['message']);
    // $to = $people['email'];
    // $it_email = 'sunnypatel477@gmail.com';
    // $it_email = 'dp715953@gmail.com';
    // $purcheas_email = 'sunnypatel477@gmail.com';
    // $to = $purcheas_email;
    // $to = 'sunnypatel477@gmail.com';
    //$to = 'shailjamaiti@gmail.com';
    $sql = "SELECT email"
        . " FROM people "
        . " WHERE clientid = " . $clientid . " AND user_page_count_check = 1"
        . " ORDER BY id DESC";
    $query = $database->query($sql);
    $allpeople = $query->fetchAll();
    if (!empty($allpeople)) {
        foreach ($allpeople as $people) {
            // $to = 'dp715953@gmail.com';
            $to = $people['email'];
            $mail = new PHPMailer;
            if (getConfigValue("email_smtp_enable") == "true") {
                $mail->isSMTP();
                // $mail->Host = 'gator4089.hostgator.com';  // Specify main and backup SMTP servers
                $mail->Host = 'mail.egatesupport.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                // $mail->Username = 'support@egatesupport.com';                 // SMTP username
                // $mail->Password = '80388038';                           // SMTP password
                // $mail->Password = '=MHJ9{@~!K$[';   
                $mail->Username = 'ticket@egatesupport.com';                 // SMTP username
                $mail->Password = 'HCqZWFgpAeT!';                         // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;
            }

            $mail->From = getConfigValue("collection_recipient");
            $mail->FromName = getConfigValue("email_from_name");
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->IsHTML(true);

            if (!$mail->send()) {
                return 0; //error
            } else {
                return 1; //success
            }
        }
    } else {
        return 0;
    }
}

function addtaxfile($data, $files)
{
    global $database, $scriptpath;
    $old_tax_file = getSingleValue("invoice", "tax_file_2307", $data['invoiceid']);

    $invoiceid = $data['invoiceid'];
    $payment_history_data = get_payment_history($invoiceid);
    if (!empty($payment_history_data)) {
        $timestemp = $payment_history_data['timestemp'];
        $bilk_paid_invoice_history = get_payment_history_by_timestemp($timestemp);
        $tax_file = uploadinvoice_taxfile($data, $files);
        foreach ($bilk_paid_invoice_history as $key => $value) {
            $inv_id = $value['invoice_id'];
            $client_id = $value['client_id'];
            $old_tax_file = getSingleValue("invoice", "tax_file_2307", $inv_id);

            $upload_data['clintid'] = $client_id;
            $upload_data['userid'] = $data['userid'];
            $upload_data['invoiceid'] = $inv_id;
            $upload_data['addtaxfile'] = $data['addtaxfile'];

            if ($tax_file['status'] == 9500) {
                $success = $database->update("invoice", [
                    "tax_file_2307" => $tax_file['name'],
                ], ["id" => $inv_id]);

                if ($old_tax_file) {
                    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "tax_file" . DIRECTORY_SEPARATOR;

                    $imagePath = $targetdir . $old_tax_file;
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
        }
        return "20";
    } else {
        $tax_file = uploadinvoice_taxfile($data, $files);
        if ($tax_file['status'] == 9500) {
            $success = $database->update("invoice", [
                "tax_file_2307" => $tax_file['name'],
            ], ["id" => $data['invoiceid']]);
            if ($old_tax_file) {
                $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "tax_file" . DIRECTORY_SEPARATOR;

                $imagePath = $targetdir . $old_tax_file;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            return "20";
        }
    }
}
function countwithcondition($table, $field, $sign, $value, $field1, $sign1, $value1)
{
    global $database;

    $sql = "select count(id) as total_balance from {$table} where {$field} {$sign} {$value} and {$field1} {$sign1} {$value1}";
    $query = $database->query($sql);
    $contracts = $query->fetch();
    return $contracts['total_balance'];
}

function getRecordsWithConditionPending($table, $field1, $sign1, $value1, $field2, $sign2, $value2)
{
    global $database;

    $sql = "SELECT * FROM {$table} WHERE {$field1} {$sign1} {$value1} AND ({$field2} {$sign2} {$value2} OR {$field2} IS NULL OR {$field2} = '')";
    $query = $database->query($sql);
    $records = $query->fetchAll(PDO::FETCH_ASSOC);
    return $records;
}

function getRecordsWithCondition($table, $field, $sign, $value, $field1, $sign1, $value1)
{
    global $database;

    $sql = "SELECT * FROM {$table} WHERE {$field} {$sign} {$value} AND {$field1} {$sign1} {$value1}";
    $query = $database->query($sql);
    $records = $query->fetchAll(PDO::FETCH_ASSOC);
    return $records;
}

function countwithconditionAll($table, $field, $sign, $value)
{
    global $database;
    $sql = "SELECT COUNT(id) AS total_balance FROM {$table} WHERE {$field} {$sign} {$value}";
    $query = $database->query($sql);
    $result = $query->fetch();
    return $result['total_balance'];
}

function countwithconditiontextfile($table, $field, $sign, $value)
{
    global $database;
    $sql = "select count(id) as total_balance from {$table} where {$field} {$sign} {$value} and (tax_file_2307 = '' OR tax_file_2307 IS NULL)";
    $query = $database->query($sql);
    $contracts = $query->fetch();
    return $contracts['total_balance'];
}

function counttofollow($table, $field, $sign, $value)
{
    global $database;
    $sql = "SELECT COUNT(id) AS total_count FROM {$table} WHERE {$field} {$sign} {$value} AND (tax_file_2307 = '' OR tax_file_2307 IS NULL) AND balance != 0";
    $query = $database->query($sql, [$clientId]);
    $result = $query->fetch();
    return $result['total_count'];
}


function getToFollowRecords($table, $field, $sign, $value)
{
    global $database;
    $sql = "SELECT * FROM {$table} WHERE {$field} {$sign} {$value} AND (tax_file_2307 = '' OR tax_file_2307 IS NULL) AND balance != 0";
    $query = $database->query($sql);
    $records = $query->fetchAll(PDO::FETCH_ASSOC);
    return $records;
}


function countwithconditiontextfileAll($table)
{
    global $database;
    $sql = "SELECT COUNT(id) AS total_count FROM {$table} WHERE tax_file_2307 = '' OR tax_file_2307 IS NULL";
    $query = $database->query($sql);
    $result = $query->fetch();
    return $result['total_count'];
}

function UpdateInvoiceContract($data)
{
    global $database;
    $count = countTableFiltered2("invoice_contract", "invoice_id", $data['invoice_id'], "contract_id", $data['contract_id'], "invoice", '0');
    if ($count > 0) {
        $database->update("invoice_contract", [
            "amount" => $data['amount'],
            "notes" => $data['message']
        ], ["AND" => ["invoice_id" => $data['invoice_id'], "contract_id" => $data['contract_id'], "invoice" => 0]]);
    } else {
        $lastid = $database->insert("invoice_contract", [
            "invoice_id" => $data['invoice_id'],
            "contract_id" => $data['contract_id'],
            "amount" => $data['amount'],
            "notes" => $data['message']
        ]);
    }

    return "20";
}

function editInvoiceContract($data)
{
    global $database;
    $count = countTableFiltered2("invoice_contract", "invoice_id", $data['clientid'], "contract_id", $data['contract_id'], "invoice", $data['invoice_id']);
    if ($count > 0) {
        $database->update("invoice_contract", [
            "amount" => $data['amount'],
            "notes" => $data['message']
        ], ["AND" => ["invoice_id" => $data['clientid'], "contract_id" => $data['contract_id'], "invoice" => $data['invoice_id']]]);
    } else {
        $lastid = $database->insert("invoice_contract", [
            "invoice_id" => $data['clientid'],
            "contract_id" => $data['contract_id'],
            "amount" => $data['amount'],
            "notes" => $data['message'],
            "invoice" => $data['invoice_id']
        ]);
    }
    return "20";
}

function countwithAllInvoice($table)
{
    global $database;
    $sql = "SELECT COUNT(invoice.id) AS total_invoice
    FROM invoice
    LEFT JOIN clients ON invoice.clintid = clients.id
    WHERE clients.is_active = 1";
    $query = $database->query($sql);
    $result = $query->fetch();
    return $result['total_invoice'];
}

function countWithConditionAndJoin($table)
{
    global $database;
    $sql = "SELECT COUNT($table.id) AS total_invoice
        FROM invoice
        LEFT JOIN clients ON invoice.clintid = clients.id
        WHERE clients.is_active = 1 AND balance > 0";

    $query = $database->query($sql);
    $result = $query->fetch();
    return $result['total_invoice'];
}

function countwithconditiontextfileAllForInvoice($table)
{
    global $database;
    $sql = "SELECT COUNT(invoice.id) AS total_count 
            FROM {$table} AS invoice
            LEFT JOIN clients ON clients.id = invoice.clintid
            WHERE clients.is_active = 1 AND (invoice.tax_file_2307 IS NULL OR invoice.tax_file_2307 = '') AND invoice.balance > 0";
    $query = $database->query($sql);
    $result = $query->fetch();
    return $result['total_count'];
}


function get_contranct_id_by_contract_no($contact_no)
{
    global $database;
    $sql = "SELECT id FROM contract WHERE contractno LIKE '%" . $contact_no . "%'";
    $query = $database->query($sql);
    $result = $query->fetch();
    return $result;
}

function get_ref_no_by_contract_id($contact_id)
{
    global $database;
    $sql = "SELECT ref_no FROM usage_report WHERE contract_id = '" . $contact_id . "'";
    $query = $database->query($sql);
    $result = $query->fetch();
    return $result;
}

function get_usage_report_data($contract_id)
{
    global $database;
    $sql = "SELECT * FROM usage_report WHERE contract_id = '" . $contract_id . "' ORDER BY date DESC ";
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return $result;
}

function get_usage_report_data_by_id($id)
{
    global $database;
    $sql = "SELECT * FROM usage_report WHERE id = '" . $id . "' ORDER BY date DESC ";
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return $result;
}

function get_contract_no_contract_id($contract_id)
{
    global $database;
    $sql = "SELECT contractno FROM contract WHERE id = '" . $contract_id . "'";
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return $result;
}

function get_usage_report_data_letest($clientid)
{
    global $database;
    $sql = "SELECT * FROM usage_report WHERE contract_id != 0 ORDER BY date DESC ";
    // $sql = "SELECT * FROM usage_report WHERE clientid = '" . $clientid . "' AND ref_no != '' AND contract_id != 0 ORDER BY date DESC ";
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return $result;
}

function check_dup_usage_report($data, $ref_no, $contract_id, $date, $id)
{
    foreach ($data as $key => $value) {
        if ($value['id'] != $id) {
            if ($value['ref_no'] == $ref_no && $value['contract_id'] == $contract_id) {
                if ($date < $value['date']) {
                    return true;
                }
            }
        }
    }
    return false;
}

function get_active_client($select = "*")
{
    global $database;
    $sql = "SELECT id," . $select . " FROM clients WHERE clients.is_active = 1 ORDER BY name ASC";
    // $sql = "SELECT * FROM usage_report WHERE clientid = '" . $clientid . "' AND ref_no != '' AND contract_id != 0 ORDER BY date DESC ";
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return $result;
}

function usage_report_history($contract_no, $client_id)
{
    global $database;
    $sql = "SELECT * FROM usage_report WHERE usage_report.clientid = $client_id AND usage_report.serial LIKE '%$contract_no%'";
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return $result;
}

function get_client_name_by_id($cliendid)
{
    global $database;
    $sql = "SELECT * FROM clients WHERE id= $cliendid";
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return $result;
}


function check_dup_invoice($data, $ref_no, $clintid, $date, $id, $month)
{
    foreach ($data as $key => $value) {
        if ($value['id'] != $id) {
            if ($value['ref_no'] == $ref_no && $value['clintid'] == $clintid) {
                if ($month == $value['month'] && $ref_no == $value['ref_no']) {
                    return true;
                } else if ($date <= $value['date'] && $value['clintid'] == $clintid) {
                    return true;
                }
            }
        }
    }
    return false;
}

function get_people_by_client_id($clientid)
{
    global $database;
    $sql = "SELECT *"
        . " FROM people "
        . " WHERE clientid = " . $clientid . " AND collection_change = 1"
        . " ORDER BY id DESC";
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return $result;
}

function get_current_service_unit_modal_name($current_service_asset)
{
    if ($current_service_asset != '' && $current_service_asset > 0) {
        global $database;
        $sql = "SELECT
                    models.name
                FROM
                    `assets`
                JOIN models ON models.id = assets.modelid
                WHERE
                assets.id = $current_service_asset";
        $query = $database->query($sql);
        $result = $query->fetchAll();
        if (isset($result[0]) && !empty($result[0])) {
            $data = $result[0];
            $name = isset($data['name']) ? $data['name'] : 'Same as Contract';
            return $name;
        }
    } else {
        return false;
    }
}

function save_user_guide_video($data)
{
    $filter_data = [];
    if (isset($data['how_to_send_page_count']) && $data['how_to_send_page_count'] == 1) {
        $f_data['name'] = 'how_to_send_page_count';
        $f_data['page_url'] = isset($data['page_url_1']) ? $data['page_url_1'] : '';
        $f_data['video_url'] = isset($data['video_url_1']) ? $data['video_url_1'] : '';
        $f_data['status'] = 1;
        $filter_data[] = $f_data;
    }

    if (isset($data['how_to_upload_2307_files']) && $data['how_to_upload_2307_files'] == 2) {
        $f_data['name'] = 'how_to_upload_2307_files';
        $f_data['page_url'] = isset($data['page_url_2']) ? $data['page_url_2'] : '';
        $f_data['video_url'] = isset($data['video_url_2']) ? $data['video_url_2'] : '';
        $f_data['status'] = 1;
        $filter_data[] = $f_data;
    }

    global $database;

    foreach ($filter_data as $value) {
        $get_data_sql = "SELECT * FROM user_guide_video WHERE name = '" . $value['name'] . "'";
        $query = $database->query($get_data_sql);
        $get_data = $query->fetchAll();
        if (!empty($get_data)) {
            $datas = $database->update("user_guide_video", [
                "name" => isset($value['name']) ? $value['name'] : '',
                "page_url" => isset($value['page_url']) ? $value['page_url'] : '',
                "video_url" => isset($value['video_url']) ? $value['video_url'] : '',
                "status" => 1,
            ], ['name' => $value['name']]);
        } else {
            $datas = $database->insert("user_guide_video", [
                "name" => isset($value['name']) ? $value['name'] : '',
                "page_url" => isset($value['page_url']) ? $value['page_url'] : '',
                "video_url" => isset($value['video_url']) ? $value['video_url'] : '',
                "status" => 1,
            ]);
            if ($datas == 1) {
                return true;
            }
        }
    }
    return false;
}

function get_user_guide_video_data($name, $column)
{
    global $database;
    $get_data_sql = "SELECT " . $column . " FROM user_guide_video WHERE name ='" . $name . "'";
    $query = $database->query($get_data_sql);
    $get_data = $query->fetchAll();
    if (isset($get_data) && !empty($get_data)) {
        $value = $get_data[0][$column];
        return $value;
    }
}

function format_date_to_ymd($date)
{
    if (DateTime::createFromFormat('d-m-Y', $date)) {
        return DateTime::createFromFormat('d-m-Y', $date)->format('Y-m-d');
    } elseif (DateTime::createFromFormat('Y-m-d', $date)) {
        return DateTime::createFromFormat('Y-m-d', $date)->format('Y-m-d');
    } else {
        return "Invalid date format";
    }
}

function get_month_name($month)
{
    $month_name = "";
    if ($month == 1) {
        $month_name = "Jan";
    } elseif ($month == 2) {
        $month_name = "Feb";
    } elseif ($month == 3) {
        $month_name = "Mar";
    } elseif ($month == 4) {
        $month_name = "Apr";
    } elseif ($month == 5) {
        $month_name = "May";
    } elseif ($month == 6) {
        $month_name = "Jun";
    } elseif ($month == 7) {
        $month_name = "Jul";
    } elseif ($month == 8) {
        $month_name = "Aug";
    } elseif ($month == 9) {
        $month_name = "Sep";
    } elseif ($month == 10) {
        $month_name = "Oct";
    } elseif ($month == 11) {
        $month_name = "Nov";
    } elseif ($month == 12) {
        $month_name = "Dec";
    }
    return $month_name;
}

function get_not_cleared_invoice_count_by_client($cliendid)
{
    $invoices = getTableFiltered("invoice", "clintid", $cliendid);
    $countClearedInvoices = 0;

    foreach ($invoices as $invoice) {
        if ($invoice['cleared'] == 0) {
            $countClearedInvoices++;
        }
    }
    return $countClearedInvoices;
}

function get_client_list_for_sale_report($year = '', $month = '')
{
    global $database;
    $select_where = "";
    if ($month != '') {
        $select_where = "IFNULL(SUM(CASE WHEN invoice.month = " . $month . " THEN invoice.amount END), 'No Invoice') AS total_amount,
                         IFNULL(MAX(CASE WHEN invoice.month = " . $month . " THEN invoice.date END), 'No') AS invoice_date,
                         IFNULL(MAX(CASE WHEN invoice.month = " . $month . " THEN invoice.month END), 'No') AS invoice_month";
    }

    $get_data_sql = "SELECT
                        clients.id,
                        clients.name,
                        " . $select_where . "
                     FROM
                        clients
                     LEFT JOIN invoice ON invoice.clintid = clients.id
                     WHERE clients.is_active = 1 
                     GROUP BY
                        clients.id,
                        clients.name
                     ORDER BY
                        clients.name ASC;";

    $query = $database->query($get_data_sql);
    $get_data = $query->fetchAll();
    $filter_data = [];
    if (!empty($get_data)) {
        if ($year != '' && $month != '') {
            foreach ($get_data as $key => $value) {
                if ($value['invoice_date'] != 'No' && $value['invoice_month'] != 'No') {
                    $date = format_date_to_ymd($value['invoice_date']);
                    $data_year = date('Y', strtotime($date));
                    $data_month = $value['invoice_month'];
                    if ($year == $data_year && $month == $data_month) {
                        $filter_data[] = $value;
                    }
                } else if ($value['invoice_date'] == 'No' && $value['invoice_month'] == 'No') {
                    $value['total_amount'] = isset($value['total_amount']) && !is_numeric($value['total_amount']) ? 0 : $value['total_amount'];
                    $filter_data[] = $value;
                }
            }
            return $filter_data;
        }

        if ($year != '') {
            foreach ($get_data as $key => $value) {
                if ($value['invoice_date'] != 'No') {
                    $date = format_date_to_ymd($value['invoice_date']);
                    $data_year = date('Y', strtotime($date));
                    if ($year == $data_year) {
                        $filter_data[] = $value;
                    }
                } else if ($value['invoice_date'] == 'No' && $value['invoice_month'] == 'No') {
                    $value['total_amount'] = isset($value['total_amount']) && !is_numeric($value['total_amount']) ? 0 : $value['total_amount'];
                    $filter_data[] = $value;
                }
            }
            return $filter_data;
        }

        if ($month != '') {
            foreach ($get_data as $key => $value) {
                if ($value['invoice_date'] != 'No') {
                    $date = format_date_to_ymd($value['invoice_date']);
                    $data_month = date('m', strtotime($date));
                    if ($month == $data_month) {
                        $filter_data[] = $value;
                    }
                } else if ($value['invoice_date'] == 'No' && $value['invoice_month'] == 'No') {
                    $value['total_amount'] = isset($value['total_amount']) && !is_numeric($value['total_amount']) ? 0 : $value['total_amount'];
                    $filter_data[] = $value;
                }
            }
            return $filter_data;
        }

        return $get_data;
    }
    return [];
}

function get_invoice_data_by_client_id_with_month($cliendid, $month)
{
    global $database;
    $get_data_sql = "SELECT * FROM invoice WHERE clintid = $cliendid";
    $query = $database->query($get_data_sql);
    $get_data = $query->fetchAll();
    if (!empty($get_data)) {
        foreach ($get_data as $key => $value) {
            $date = isset($value['date']) ? $value['date']  : '';
            if ($date != '') {
                $date = format_date_to_ymd($date);
                $date_month = date('m', strtotime($date));
                if ($date_month == $month) {
                    $amount = isset($value['amount']) ? $value['amount']  : '';
                    return $amount;
                }
            }
        }
    }
    return 0;
}

function get_year_data()
{
    $current_year = date("Y");
    $years = [];
    for ($i = 5; $i >= 1; $i--) {
        $years[$current_year - $i] = $current_year - $i;
    }
    $years[$current_year] = $current_year;
    for ($i = 1; $i <= 5; $i++) {
        $years[$current_year + $i] = $current_year + $i;
    }
    return $years;
}

function get_client_list_for_sale_report_tab_2($year, $month)
{
    global $database;
    $select_where = "";
    if ($month != '') {
        $select_where = "IFNULL(SUM(CASE WHEN invoice.month = " . $month . " THEN invoice.amount END), 'No Invoice') AS total_amount,
                         IFNULL(MAX(CASE WHEN invoice.month = " . $month . " THEN invoice.date END), 'No') AS invoice_date,
                         IFNULL(MAX(CASE WHEN invoice.month = " . $month . " THEN invoice.month END), 'No') AS invoice_month";
    }
    $get_data_sql = "SELECT
                        clients.id,
                        clients.name,
                        " . $select_where . "
                     FROM
                        clients
                     LEFT JOIN invoice ON invoice.clintid = clients.id
                     WHERE clients.is_active = 1
                     GROUP BY
                        clients.id,
                        clients.name
                     ORDER BY
                        clients.name ASC;";
    $query = $database->query($get_data_sql);
    $get_data = $query->fetchAll();
    $filter_data = [];
    if (!empty($get_data)) {

        if ($year != '' && $month != '') {
            foreach ($get_data as $key => $value) {
                if ($value['invoice_date'] != 'No' && $value['invoice_month'] != 'No') {
                    $date = format_date_to_ymd($value['invoice_date']);
                    $data_year = date('Y', strtotime($date));
                    $data_month = $value['invoice_month'];
                    if ($year == $data_year && $month == $data_month) {
                        $filter_data[] = $value;
                    }
                } else if ($value['invoice_date'] == 'No' && $value['invoice_month'] == 'No') {
                    $value['total_amount'] = isset($value['total_amount']) && !is_numeric($value['total_amount']) ? 0 : $value['total_amount'];
                    $filter_data[] = $value;
                }
            }
            return $filter_data;
        }

        if ($month != '') {
            foreach ($get_data as $key => $value) {
                if ($value['invoice_date'] != 'No') {
                    $date = format_date_to_ymd($value['invoice_date']);
                    $data_month = date('m', strtotime($date));
                    if ($month == $data_month) {
                        $filter_data[] = $value;
                    }
                } else if ($value['invoice_date'] == 'No' && $value['invoice_month'] == 'No') {
                    $value['total_amount'] = isset($value['total_amount']) && !is_numeric($value['total_amount']) ? 0 : $value['total_amount'];
                    $filter_data[] = $value;
                }
            }
            return $filter_data;
        }

        return $get_data;
    }
    return [];
}

function get_contract_detail_by_contract_no($contact_no)
{
    global $database;
    $contract_id = get_contranct_id_by_contract_no($contact_no);
    $contract_id = $contract_id['id'];
    $get_data_sql = "SELECT * FROM contract WHERE contract.id = $contract_id";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return $data;
    // page_plan
}

function add_payment_method($data)
{
    if (!empty($data)) {
        global $database;
        $lastid = $database->insert("payment_method", [
            "name" => $data['name'],
            "code" => $data['code']
        ]);
        if ($lastid > 0) {
            return true;
        }
    }
    return false;
}

function get_payment_method_data()
{
    global $database;
    $get_data_sql = "SELECT * FROM payment_method ORDER BY name ASC";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return $data;
}

function get_payment_method($id)
{
    global $database;
    $get_data_sql = "SELECT * FROM payment_method WHERE id = $id";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    if (!empty($data)) {
        return $data;
    }else{
        return [];
    }
}

function update_payment_method($data, $id)
{
    if (!empty($data) && $id > 0) {
        global $database;
        $database->update("payment_method", $data, ["id" => $id]);
        return true;
    }
    return false;
}

function delete_payment_method($id)
{
    if ($id > 0) {
        global $database;
        $database->delete("payment_method", ["id" => $id]);
        return true;
    }
    return false;
}

function get_payment_method_name($payment_method_id)
{
    if ($payment_method_id != '') {
        $payment_method_data = get_payment_method($payment_method_id);
        if(!empty($payment_method_data)){
            return $payment_method_data[0]['name'];
        }    
    }
    return '';    
}

function get_invoice_by_clientid($client_id)
{
    global $database;
    $get_data_sql = "SELECT * FROM `invoice` WHERE  paid <= 0 AND clintid = $client_id";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return $data;
}
// update_bulk_invoice
function update_bulk_invoice($data, $id)
{
    if (!empty($data) && $id > 0) {
        global $database;
        $database->update("invoice", $data, ["id" => $id]);
        return true;
    }
    return false;
}

function add_payment_history($data)
{
    if (!empty($data)) {
        global $database;
        $payment_history_data = get_payment_history($data['invoice_id']);
        if (empty($payment_history_data)) {
            $lastid = $database->insert("payment_history", [
                "client_id" => $data['client_id'],
                "invoice_id" => $data['invoice_id'],
                "amount" => $data['amount'],
                "applied_amount" => $data['applied_amount'],
                "timestemp" => $data['timestemp'],
            ]);
            if ($lastid > 0) {
                return true;
            }
        }
    }
    return false;
}

function get_invoice_data($invoice_id)
{
    global $database;
    $get_data_sql = "SELECT * FROM `invoice` WHERE  id = $invoice_id";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return $data[0];
}

function get_payment_history($invoice_id)
{
    global $database;
    $get_data_sql = "SELECT * FROM `payment_history` WHERE invoice_id = $invoice_id";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return $data[0];
}

function get_payment_history_data($client = '')
{
    global $database;
    $where = '';
    if ($client != '') {
        $where = " AND payment_history.client_id = $client";
    }
    $get_data_sql = "SELECT * FROM `invoice`
                     JOIN payment_history ON payment_history.invoice_id = invoice.id
                     $where
                     GROUP BY payment_history.id";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return $data;
}

function get_sale_report_amount($all = true)
{
    global $database;
    $get_data_sql = "SELECT * FROM `clients` WHERE is_active = 1";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    $total1 = 0;
    $total2 = 0;
    $total12 = 0;
    foreach ($data as $key => $value) {
        $total1 += getTotalAmount("contract", "contract_amount", "clientid", $value['id'], "is_end", 0);
        if ($all) {
            $total2 += getTotalAmount("contract", "contract_amount", "clientid", $value['id']);
        }
        $total12 += getTotalAmount("licenses", "amount", "clientid", $value['id']);
    }
    if ($all) {
        $coto = $total1 + $total12 + $total2;
    } else {
        $coto = $total1 + $total12;
    }
    return $coto;
}

function get_payment_history_by_id($id)
{
    global $database;
    $get_data_sql = "SELECT * FROM `payment_history` WHERE id = $id";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return $data[0];
}

function delete_payment_history($id)
{
    if ($id > 0) {
        global $database;
        $database->delete("payment_history", ["id" => $id]);
        return true;
    }
    return false;
}

function get_invoice_by_clientid_paid($client_id)
{
    global $database;
    $get_data_sql = "SELECT * FROM `invoice` WHERE  clintid = $client_id AND paid != 0";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return $data;
}

function get_payment_history_by_timestemp($timestemp)
{
    global $database;
    $get_data_sql = "SELECT * FROM `payment_history` WHERE timestemp = $timestemp";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return $data;
}

function update_incoive_confirmation($data, $id)
{
    global $database;
    if (!empty($data) && $id > 0) {
        $database->update("invoice", $data, ["id" => $id]);
    }
    exit;
}

function get_templete_subject($templete_id)
{
    global $database;
    $notificationtemplates_sql = "SELECT * FROM `notificationtemplates` WHERE type = 'emailtemplete' AND id = $templete_id";
    $query = $database->query($notificationtemplates_sql);
    $notificationtemplates_data = $query->fetchAll();
    return $notificationtemplates_data;
}

function calculateDateDifference($startDate, $endDate)
{
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $diff = $start->getTimestamp() - $end->getTimestamp(); // Difference in seconds
    return floor($diff / (60 * 60 * 24));
}

function get_responsible_person($client_id)
{
    global $database;
    $get_data_sql = "SELECT * FROM `people` WHERE clientid = $client_id AND invoice = 1 AND type = 'user'";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    $data_count = count($data);
    return $data_count;
}

function insert_invoice_page_detail($data)
{
    global $database;
    foreach ($data as $key => $value) {
        $name = $key;
        $value = $value;
        $check_exist_invoice_page_detail_sel = "SELECT * FROM `invoice_page_detail` WHERE name = '$name'";
        $query = $database->query($check_exist_invoice_page_detail_sel);
        $data = $query->fetchAll();
        if (!empty($data)) {
            $database->update("invoice_page_detail", ["name" => $name, "value" => $value], ["name" => $name]);
        } else {
            $database->insert("invoice_page_detail", ["name" => $name, "value" => $value]);
        }
    }
}

function get_template_invoice_page_detail($name)
{
    global $database;
    $get_data_sql = "SELECT * FROM `invoice_page_detail` WHERE name = '$name' ";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return $data[0];
}

function get_licenses_by_client($client_id)
{
    global $database;
    $get_data_sql = "SELECT licenses.* , licensecategories.name AS licensecategories_name , licensecategories.color AS licensecategories_color FROM `licenses` JOIN licensecategories ON licensecategories.id = licenses.categoryid WHERE clientid = $client_id";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return $data;
}

function get_people_for_all_send_email_invoice()
{
    global $database;
    $sql = "SELECT *"
        . " FROM people "
        . " WHERE invoice = 1"
        . " ORDER BY id DESC";
    $query = $database->query($sql);
    $result = $query->fetchAll();
    return $result;
}

function get_expierd_contract($date1, $date2)
{
    $diff = abs(strtotime($date2) - strtotime($date1));
    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $x = strtotime($date1) - strtotime($date2);
    if ($x < 0) {
        return true;
    } else {
        return false;
    }
}

function get_expierd_contract_count_by_client($client_id)
{
    $contracts = getTableFiltered("contract", "clientid", $client_id, 'is_end', 0);
    $countExpierdContracts = 0;
    foreach ($contracts as $contract) {
        if (get_expierd_contract($contract['contract_expiry'], date('Y-m-d'))) {
            $countExpierdContracts++;
        }
    }
    return $countExpierdContracts;
}

function get_responsible_person_by_client($client_id, $column)
{
    global $database;
    $get_data_sql = "SELECT * FROM `people` WHERE clientid = $client_id AND $column = 1 AND type = 'user'";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return count($data);
}

function generate_invoice_pdf($invoice_id)
{
    global $database, $mpdf, $scriptpath;
    $invoice = getTableFiltered("invoice", "id", $invoice_id);
    $clientname = getSingleValue("clients", "name", $invoice[0]['clintid']);
    $contract_id = $invoice[0]['invoice_contract_id'];
    $invoice_datas = getinvoiceFiltered("contract", $contract_id);
    $logo = $database->get("config", "value", ["name" => "logo"]);
    ob_start();
    $lia = $database->get("people", "*", ["sessionid" => session_id()]);
    include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'invoiceTPdf.php');

    $html = ob_get_contents();
    ob_end_clean();
    // $mpdf->WriteHTML($html);
    $path = "uploads" . DIRECTORY_SEPARATOR . "invoice" . DIRECTORY_SEPARATOR . "invoice_" . $invoice_id . ".pdf";
    $pdfFilePath =  $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "invoice" . DIRECTORY_SEPARATOR . "invoice_" . $invoice_id . ".pdf";
    $mpdf->WriteHTML($html);
    $mpdf->Output($pdfFilePath, "F");

    return $path;
}

function insert_user_complain($data)
{
    global $database;
    $lastid = $database->insert("user_complain", [
        "name" => $data['name'],
        "issuetype" => $data['issuetype'],
        "clientid" => $data['clientid'],
        "description" => $data['description'],
        "date" => date('Y-m-d')
    ]);

    if ($lastid == "0") {
        return "11";
    } else {
        return "10";
    }
}

function get_complain_list()
{
    global $database;
    $get_data_sql = "SELECT user_complain.* ,clients.name AS client_name 
                     FROM `user_complain` 
                     JOIN clients ON clients.id = user_complain.clientid";
    $query = $database->query($get_data_sql);
    $data = $query->fetchAll();
    return $data;
}

function export_sale_report($year = '', $month = '')
{
    global $database;
    $select_where = "";
    if ($month != '') {
        $select_where = ",IFNULL(SUM(CASE WHEN invoice.month = " . $month . " THEN invoice.amount END), 'No Invoice') AS total_amount,
                         IFNULL(MAX(CASE WHEN invoice.month = " . $month . " THEN invoice.date END), 'No') AS invoice_date,
                         IFNULL(MAX(CASE WHEN invoice.month = " . $month . " THEN invoice.month END), 'No') AS invoice_month
                         ";
    }

    $get_data_sql = "SELECT
                        clients.id,
                        clients.name
                        " . $select_where . "
                     FROM
                        clients
                     LEFT JOIN invoice ON invoice.clintid = clients.id
                     WHERE clients.is_active = 1 
                     GROUP BY
                        clients.id,
                        clients.name
                     ORDER BY
                        clients.name ASC;";
    $query = $database->query($get_data_sql);
    $get_data = $query->fetchAll();
    $filter_data = [];
    if (!empty($get_data)) {
        if ($year != '' && $month != '') {
            foreach ($get_data as $key => $value) {
                if ($value['invoice_date'] != 'No' && $value['invoice_month'] != 'No') {
                    $date = format_date_to_ymd($value['invoice_date']);
                    $data_year = date('Y', strtotime($date));
                    $data_month = $value['invoice_month'];
                    if ($year == $data_year && $month == $data_month) {
                        $filter_data[] = $value;
                    }
                } else if ($value['invoice_date'] == 'No' && $value['invoice_month'] == 'No') {
                    $value['total_amount'] = isset($value['total_amount']) && !is_numeric($value['total_amount']) ? 0 : $value['total_amount'];
                    $filter_data[] = $value;
                }
            }
            return $filter_data;
        }

        if ($year != '') {
            foreach ($get_data as $key => $value) {
                if ($value['invoice_date'] != 'No') {
                    $date = format_date_to_ymd($value['invoice_date']);
                    $data_year = date('Y', strtotime($date));
                    if ($year == $data_year) {
                        $filter_data[] = $value;
                    }
                } else if ($value['invoice_date'] == 'No' && $value['invoice_month'] == 'No') {
                    $value['total_amount'] = isset($value['total_amount']) && !is_numeric($value['total_amount']) ? 0 : $value['total_amount'];
                    $filter_data[] = $value;
                }
            }
            return $filter_data;
        }

        if ($month != '') {
            foreach ($get_data as $key => $value) {
                if ($value['invoice_date'] != 'No') {
                    $date = format_date_to_ymd($value['invoice_date']);
                    $data_month = date('m', strtotime($date));
                    if ($month == $data_month) {
                        $filter_data[] = $value;
                    }
                } else if ($value['invoice_date'] == 'No' && $value['invoice_month'] == 'No') {
                    $value['total_amount'] = isset($value['total_amount']) && !is_numeric($value['total_amount']) ? 0 : $value['total_amount'];
                    $filter_data[] = $value;
                }
            }
            return $filter_data;
        }

        return $get_data;
    }
    return [];
}

function export_sale_report_tab_2($year, $month)
{
    global $database;
    $select_where = "";
    if ($month != '') {
        // $where = " WHERE invoice.month = $month ";
        $select_where = "IFNULL(SUM(CASE WHEN invoice.month = " . $month . " THEN invoice.amount END), 'No Invoice') AS total_amount,
                         IFNULL(MAX(CASE WHEN invoice.month = " . $month . " THEN invoice.date END), 'No') AS invoice_date,
                         IFNULL(MAX(CASE WHEN invoice.month = " . $month . " THEN invoice.month END), 'No') AS invoice_month
                         ";
    }
    $get_data_sql = "SELECT
                        clients.id,
                        clients.name,
                        " . $select_where . "
                     FROM
                        clients
                     LEFT JOIN invoice ON invoice.clintid = clients.id
                     WHERE clients.is_active = 1
                     GROUP BY
                        clients.id,
                        clients.name
                     ORDER BY
                        clients.name ASC;";
    $query = $database->query($get_data_sql);
    $get_data = $query->fetchAll();
    $filter_data = [];
    if (!empty($get_data)) {

        if ($year != '' && $month != '') {
            foreach ($get_data as $key => $value) {
                if ($value['invoice_date'] != 'No' && $value['invoice_month'] != 'No') {
                    $date = format_date_to_ymd($value['invoice_date']);
                    $data_year = date('Y', strtotime($date));
                    $data_month = $value['invoice_month'];
                    if ($year == $data_year && $month == $data_month) {
                        $filter_data[] = $value;
                    } else {
                        $value['total_amount'] = isset($value['total_amount']) && !is_numeric($value['total_amount']) ? 0 : $value['total_amount'];
                        $filter_data[] = $value;
                    }
                } else if ($value['invoice_date'] == 'No' && $value['invoice_month'] == 'No') {
                    $value['total_amount'] = isset($value['total_amount']) && !is_numeric($value['total_amount']) ? 0 : $value['total_amount'];
                    $filter_data[] = $value;
                }
            }
            return $filter_data;
        }

        if ($month != '') {
            foreach ($get_data as $key => $value) {
                if ($value['invoice_date'] != 'No') {
                    $date = format_date_to_ymd($value['invoice_date']);
                    $data_month = date('m', strtotime($date));
                    if ($month == $data_month) {
                        $filter_data[] = $value;
                    } else {
                        $value['total_amount'] = isset($value['total_amount']) && !is_numeric($value['total_amount']) ? 0 : $value['total_amount'];
                        $filter_data[] = $value;
                    }
                } else if ($value['invoice_date'] == 'No' && $value['invoice_month'] == 'No') {
                    $value['total_amount'] = isset($value['total_amount']) && !is_numeric($value['total_amount']) ? 0 : $value['total_amount'];
                    $filter_data[] = $value;
                }
            }
            return $filter_data;
        }

        return $get_data;
    }
    return [];
}

function insert_add_notice_expiration_before_days($data)
{
    global $database;
    $data_get = $database->get("config", "*", ["name" => $data['name']]);
    if (!empty($data_get)) {
        $database->update("config", $data, ["name" => $data['name']]);
    } else {
        $database->insert("config", $data);
    }
}

function get_add_notice_expiration_before_days()
{
    global $database;
    $data_get = $database->get("config", "value", ["name" => 'add_notice_expiration_before_days']);
    return (int)$data_get;
}

function get_ac_count_by_client($client_id)
{
    $contracts = getTableFiltered("contract", "clientid", $client_id, 'is_end', 0);
    $countExpierdContracts = 0;
    $defult_days = get_add_notice_expiration_before_days();
    foreach ($contracts as $contract) {
        $date1 = $contract['contract_expiry'];
        $date2 = date('Y-m-d');
        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $x = strtotime($date1) - strtotime($date2);
        if ($x > 0) {
            $day = $months * 30 + $days;
            if ($defult_days != '') {
                $day = (int)$day;
                if ($day < $defult_days) {
                    $countExpierdContracts++;
                }
            }
        }
    }
    return $countExpierdContracts;
}

function get_invoice_for_sale_report($y, $m, $client_id)
{
    global $database;
    $get_data_sql = "SELECT * FROM `invoice` WHERE invoice.clintid = $client_id AND invoice.month = $m";
    $query = $database->query($get_data_sql);
    $get_data = $query->fetchAll();
    return $get_data;
}

function editinvoice_payment($data, $files)
{
    if (isset($data['paid_amt_hid']) && $data['paid_amt_hid'] != 0 && isset($data['tax_amt_hid']) && $data['tax_amt_hid'] != '') {
        $data['final_balance'] = $data['invoice_amount_hid'] - $data['paid_amt_hid'] - $data['tax_amt_hid'];
    }
    global $database;
    // $inv_file = uploadinvoice($data, $files);
    $paid_file = uploadinvoice_paidfile_2($data, $files);
    $or_file = uploadinvoice_orfile_2($data, $files);
    $tax_file = uploadinvoice_taxfile_2($data, $files);
    $number = (int)str_replace(',', '', $data['amount']);
    if (is_numeric($data['invoiceid'])) {
        $invoice = getTableFiltered("invoice", "id", $data['invoiceid']);
        $updated = $database->update("invoice", [
            "invoiceno" => $data['invoiceno'],
            "amount" => $number,
            "ornumber" => $data['ornumber'],
            "paid" => $data['paid_amt_hid'],
            "balance" => $data['final_balance'],
            "payment_method" => $data['payment_method'],
            "payment_ref_no" => $data['payment_ref_no'],
            "tax_amount" => $data['tax_amt_hid'],
            "ref_no" => $data['ref_no_hid'],
            // "attachment" => !empty($inv_file['name']) ? $inv_file['name'] : $invoice[0]['attachment'],
            "paid_file" => !empty($paid_file['name']) ? $paid_file['name'] : $invoice[0]['paid_file'],
            "tax_file_2307" => !empty($tax_file['name']) ?  $tax_file['name'] : $invoice[0]['tax_file_2307'],
            "or_file" => !empty($or_file['name']) ?  $or_file['name'] : $invoice[0]['or_file'],
            "date_payment_receive" => $data['date_payment_receive']
        ], ["id" => $data['invoiceid']]);

        if ($updated) {
            return "20";
        } else {
            return "12";
        }
    } else {
        return "12";
    }
}

function uploadinvoice_paidfile_2($data, $files, $req = false)
{
    $status = 9500;
    $result['status'] = 9500;
    $result['name'] = "";
    global $scriptpath;
    if ($files["paid_file"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "payment_proof" . DIRECTORY_SEPARATOR;
        $req_path = "payment_file" . DIRECTORY_SEPARATOR . "payment_proof" . DIRECTORY_SEPARATOR;
        $invoice_detail = getTableFiltered("invoice", 'id', $data['invoiceid']);
        if (isset($invoice_detail[0]) && !empty($invoice_detail[0])) {
            $invoice_detail = $invoice_detail[0];
            $client_id = $invoice_detail['clintid'];
            $clients = getTableFiltered("clients", 'id', $client_id);
        }

        $company_name = substr($clients[0]['name'], 0, 3);
        $original_filename = $files["paid_file"]["name"];
        $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        $invoiceno = str_replace(' ', '', $invoice_detail['invoiceno']);
        $filename = $invoiceno . "_" . $data['ornumber'] . "_" . $company_name . "_PF." . $file_extension;
        $name = $files["paid_file"]["name"];
        $targetfile = $targetdir . $filename;
        if ($status == 9500) {
            if (move_uploaded_file($files["paid_file"]["tmp_name"], $targetfile)) {
                $result['name'] = $filename;
                $result['status'] = 9500;
                if (isset($req['path'])) {
                    $result['path'] = $req_path . $filename;
                }
            } else
                $result['status'] = 9502;
        }
    }
    return $result;
}

function uploadinvoice_taxfile_2($data, $files, $req = false)
{
    $status = 9500;
    $result['status'] = 9500;
    $result['name'] = "";
    global $scriptpath;
    if ($files["tax_file_2307"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "tax_payment" . DIRECTORY_SEPARATOR;
        $req_path = "payment_file" . DIRECTORY_SEPARATOR . "tax_payment" . DIRECTORY_SEPARATOR;
        if (!file_exists($targetdir)) {
            mkdir($targetdir, 0777, true);
        }

        $invoice_detail = getTableFiltered("invoice", 'id', $data['invoiceid']);
        if (isset($invoice_detail[0]) && !empty($invoice_detail[0])) {
            $invoice_detail = $invoice_detail[0];
            $client_id = $invoice_detail['clintid'];
            $clients = getTableFiltered("clients", 'id', $client_id);
        }

        $company_name = substr($clients[0]['name'], 0, 3);
        $original_filename = $files["tax_file_2307"]["name"];
        $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        $invoiceno = str_replace(' ', '', $invoice_detail['invoiceno']);
        $filename = $invoiceno . "_" . $data['ornumber'] . "_" . $company_name . "_TAX." . $file_extension;
        $name = $files["paid_file"]["name"];
        $targetfile = $targetdir . $filename;

        if ($status == 9500) {
            if (move_uploaded_file($files["tax_file_2307"]["tmp_name"], $targetfile)) {
                $result['name'] = $filename;
                $result['status'] = 9500;
                if (isset($req['path'])) {
                    $result['path'] = $req_path . $filename;
                }
            } else
                $result['status'] = 9502;
        }
    }
    return $result;
}

function uploadinvoice_orfile_2($data, $files, $req = false)
{
    $status = 9500;
    $result['status'] = 9500;
    $result['name'] = "";
    global $scriptpath;
    if ($files["or_file"]["name"] != "") {
        $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "official_reciept" . DIRECTORY_SEPARATOR;
        $req_path = "payment_file" . DIRECTORY_SEPARATOR . "official_reciept" . DIRECTORY_SEPARATOR;
        $invoice_detail = getTableFiltered("invoice", 'id', $data['invoiceid']);
        if (isset($invoice_detail[0]) && !empty($invoice_detail[0])) {
            $invoice_detail = $invoice_detail[0];
            $client_id = $invoice_detail['clintid'];
            $clients = getTableFiltered("clients", 'id', $client_id);
        }
        $company_name = substr($clients[0]['name'], 0, 3);
        $original_filename = $files["or_file"]["name"];
        $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        $invoiceno = str_replace(' ', '', $invoice_detail['invoiceno']);
        $filename = $invoiceno . "_" . $data['ornumber'] . "_" . $company_name . "_OR." . $file_extension;
        $name = $files["or_file"]["name"];
        $targetfile = $targetdir . $filename;

        if ($status == 9500) {
            if (move_uploaded_file($files["or_file"]["tmp_name"], $targetfile)) {
                $result['name'] = $filename;
                $result['status'] = 9500;
                if (isset($req['path'])) {
                    $result['path'] = $req_path . $filename;
                }
            } else
                $result['status'] = 9502;
        }
    }
    return $result;
}

function add_pending_frequency_filter_val($data)
{
    global $database;
    $key_1 = '';
    $value_1 = '';
    foreach ($data as $key => $value) {
        $key_1 = $key;
        $value_1 = $value;
    }
    $get_data_sql = "SELECT * FROM `config` WHERE name = '$key_1'";
    $query = $database->query($get_data_sql);
    $get_data = $query->fetchAll();
    if (isset($get_data) && !empty($get_data) && isset($get_data[0]) && !empty($get_data[0])) {
        $database->update("config", ["value" => $value_1], ["name" => $key_1]);
    } else {
        $database->insert("config", [
            "name" => $key_1,
            "value" => $value_1
        ]);
    }
}

function get_pending_frequency_filter_val($key)
{
    if ($key != '') {
        global $database;
        $get_data_sql = "SELECT * FROM `config` WHERE name = '$key'";
        $query = $database->query($get_data_sql);
        $get_data = $query->fetchAll();
        if (isset($get_data) && !empty($get_data) && isset($get_data[0]) && !empty($get_data[0])) {
            return $get_data[0]['value'];
        }
    } else {
        return '';
    }
}

function get_multiple_payment_receive_data($invoice_id)
{
    if ($invoice_id != '') {
        global $database;
        $get_data_sql = "SELECT * FROM `payment_history` WHERE `invoice_id` LIKE $invoice_id";
        $query = $database->query($get_data_sql);
        $get_data = $query->fetchAll();
        $timestemp = isset($get_data[0]["timestemp"]) ? $get_data[0]["timestemp"] : '';
        if ($timestemp != '') {
            $get_invoices_sql = "SELECT invoice.* , payment_history.timestemp 
                                 FROM `payment_history` 
                                 JOIN invoice ON invoice.id = payment_history.invoice_id
                                 WHERE `timestemp` LIKE '" . $timestemp . "'";
            $query = $database->query($get_invoices_sql);
            $invoices_data = $query->fetchAll();
            return $invoices_data;
        }
    } else {
        return [];
    }
}

function get_total_contract_amount($contract_id)
{
    global $database;
    $quick_filter = get_pending_frequency_filter_val('pending_frequency_set_days');
    $current_date = date('Y-m-d H:i:s');
    $past_date = date('Y-m-d H:i:s', strtotime("-$quick_filter days"));
    $tickets_sql = "SELECT * FROM `tickets` WHERE `timestamp` >= '$past_date'
                    AND contractid = " . $contract_id;
    $query = $database->query($tickets_sql);
    $tickets = $query->fetchAll();
    return count($tickets);
}

function get_problem_category_name($problem_category_id)
{
    if ($problem_category_id != '') {
        global $database;
        $sql = "SELECT * FROM `ticketsubject` WHERE id = $problem_category_id";
        $query = $database->query($sql);
        $problem_category = $query->fetchAll();
        if (!empty($problem_category)) {
            return isset($problem_category[0]['subject']) ? $problem_category[0]['subject'] : '';
        }
    }
}

function get_ticket_action_name($ticket_action_id)
{
    if ($ticket_action_id != '') {
        global $database;
        $sql = "SELECT * FROM `ticket_action` WHERE id = $ticket_action_id";
        $query = $database->query($sql);
        $ticket_action = $query->fetchAll();
        if (!empty($ticket_action)) {
            return isset($ticket_action[0]['action']) ? $ticket_action[0]['action'] : '';
        }
    }
}


function get_ticket_detail_for_contract_manage($ticketid)
{
    if ($ticketid != '') {
        global $database;
        $sql = "SELECT * FROM technician_report WHERE ticketid = $ticketid";
        $query = $database->query($sql);
        $ticket_detail = $query->fetchAll();
        if (!empty($ticket_detail) && isset($ticket_detail[0])) {
            return $ticket_detail[0];
        }
    }
}

function get_previous_action_taken_name($contractid)
{
    if ($contractid != '') {
        global $database;
        $sql = "SELECT * FROM tickets WHERE contractid = $contractid AND tickets.status = 'Closed'";
        $query = $database->query($sql);
        $ticket_detail = $query->fetchAll();
        $latestTicket = array_reduce($ticket_detail, function ($latest, $ticket) {
            return (strtotime($ticket['timestamp']) > strtotime($latest['timestamp'])) ? $ticket : $latest;
        }, $ticket_detail[0]);
        if (!empty($latestTicket)) {
            $technician_data =  get_ticket_detail_for_contract_manage($latestTicket['id']);
            if (!empty($technician_data)) {
                $previous_action_taken_name =  get_ticket_action_name($technician_data['problem_category']);
                return $previous_action_taken_name;
            }
        }
    }
}

function get_action_taken_filter_dropdown()
{
    global $database;
    $sql = "SELECT * FROM `ticket_action`";
    $query = $database->query($sql);
    $ticket_action = $query->fetchAll();
    return $ticket_action;
}

function get_closed_tickets_person($ticketid)
{
    global $database;
    $sql = "SELECT * FROM `tickets_replies` WHERE ticketid = $ticketid";
    $query = $database->query($sql);
    $ticket_replies_detail = $query->fetchAll();
    usort($ticket_replies_detail, function ($a, $b) {
        return strtotime($b['timestamp']) - strtotime($a['timestamp']);
    });
    if (!empty($ticket_replies_detail)) {
        $ticket_replies_detail = $ticket_replies_detail[0];
        $admin_id = $ticket_replies_detail['adminid'];
        $sql_1 = "SELECT name FROM `people` WHERE id = $admin_id";
        $query_1 = $database->query($sql_1);
        $people = $query_1->fetchAll();
        if (!empty($people) && isset($people[0])) {
            $people = $people[0];
            $people_name = isset($people['name']) ? $people['name'] : '';
            return $people_name;
        }
    }
    return '';
}

function get_user_name_by_id($user_id)
{
    if (is_numeric($user_id)) {
        global $database;
        $sql = "SELECT * FROM `people` WHERE id = $user_id";
        $query = $database->query($sql);
        $people = $query->fetchAll();
        if (!empty($people) && isset($people[0])) {
            $people = $people[0];
            $people_name = isset($people['name']) ? $people['name'] : '';
            return $people_name;
        }
    }
    return '';
}

function get_user_name_for_updateed_tickets_detail_from_technician($tickets_id)
{
    if (is_numeric($tickets_id)) {
        global $database;
        $sql = "SELECT people.name FROM `technician_report` JOIN people on people.id = technician_report.technician_id WHERE technician_report.ticketid = $tickets_id";
        $query = $database->query($sql);
        $people = $query->fetchAll();
        if (!empty($people) && isset($people[0])) {
            $people = $people[0];
            $people_name = isset($people['name']) ? $people['name'] : '';
            return $people_name;
        }
    }
    return '';
}
