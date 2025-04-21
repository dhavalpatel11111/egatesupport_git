<?php
##### DATA PROCESSING #####
// LOGOUT
if ($route == "logout")
    logOut($lia['id']);

// ASSETS
if (isset($_POST['addAsset'])) {
    $status = addAsset($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['editAsset'])) {
    $status = editAsset($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['deleteAsset'])) {
    $status = deleteAsset($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}


// warranty
if (isset($_POST['addwarranty'])) {
    $status = addwarranty($_POST, $_FILES);
    header("Location:?route=warranty&status=" . $status);
}
if (isset($_POST['editwarranty'])) {
    $status = editwarranty($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deletewarranty'])) {
    $status = deletewarranty($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}

if (isset($_POST['update_memo_status'])) {

    $status = update_memo_status($_POST);
    header("Location:?route=clients/manage&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['update_memo_status2'])) {

    $status = update_memo_status2($_POST);
    header("Location:?route=clients/manage&id=" . $_POST['routeid'] . "&status=" . $status . "&tab=department");
}


if (isset($_POST['update_limit_cycle'])) {

    $status = update_limit_cycle($_POST);
    header("Location:?route=clients/manage&id=" . $_POST['routeid'] . "&status=" . $status . "&tab=department");
}

if (isset($_POST['addwrntyhistory'])) {
    $status = addwrntyhistory($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

if (isset($_POST['editwrntyhistory'])) {
    $status = editwrntyhistory($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

if (isset($_POST['deletewrntyhistry'])) {
    $status = deletewrntyhistry($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
//** document_type //
if (isset($_POST['documenttypeadd'])) {
    $status = documenttypeadd($_POST);
    header("Location:?route=" . $_POST['route']);
}

if (isset($_POST['editdocumenttype'])) {
    $status = editdocumenttype($_POST);
    header("Location:?route=" . $_POST['route']);
}

if (isset($_POST['departmentDelete'])) {
    $status = departmentDelete($_POST);
    header("Location:?route=" . $_POST['route']);
}

if (isset($_POST['addimageContract'])) {
    $status = addimageContract($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

if (isset($_POST['departmentDelete1'])) {
    $status = departmentDelete1($_POST);
    header("Location:?route=clients/manage&id=" . $_POST['routeid'] . "&tab=department");
}

// CONTRACT
if (isset($_POST['addContract'])) {
    $status = addContract($_POST, $_FILES);
    header("Location:?route=clients/manage&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editContract'])) {
    $status = editContract($_POST);
    if (isset($_POST['redirect'])) {
        header("Location:?route=clients/manage&id=" . $_POST['routeid'] . "&tab=department");
    } else {
        header("Location:?route=clients/manage&id=" . $_POST['routeid'] . "&status=" . $status);
    }
}
if (isset($_POST['deleteContract'])) {
    $status = deleteContract($_POST['id']);
    $section = "";
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=''");
}

if (isset($_POST['editContractHistory'])) {
    $status = editContractHistory($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deleteContractHistory'])) {
    $status = deleteContractHistory($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

// PROJECTS
if (isset($_POST['addProject'])) {
    $status = addProject($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['editProject'])) {
    $status = editProject($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deleteProject'])) {
    $status = deleteProject($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

if (isset($_POST['addProjectAdmin'])) {
    $status = addProjectAdmin($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteProjectAdmin'])) {
    $status = deleteProjectAdmin($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['saveProjectNotes'])) {
    $status = saveProjectNotes($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

// FILES
if (isset($_POST['uploadContractFile'])) {
    $status = uploadContractFile($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deleteContractFile'])) {
    $status = deleteContractFile($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['uploadFile'])) {
    $status = uploadFile($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deleteFile'])) {
    $status = deleteFile($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

// ISSUES
if (isset($_POST['addIssue'])) {
    $status = addIssue($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['editIssue'])) {
    $status = editIssue($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deleteIssue'])) {
    $status = deleteIssue($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
///kb

// if (isset($_POST['action'])) {

// echo'<pre>';
// print_r($_POST);
// echo'</pre>';
// die('rhttt');
// $status = action($_POST);
// header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
// }

// USAGES
if (isset($_POST['addUsage'])) {
    $status = addUsage($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['editUsage'])) {
    $status = editUsage($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deleteUsage'])) {
    $status = deleteUsage($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}



// TICKETS
if (isset($_POST['addTicket'])) {
    $status = addTicket($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['editTicket'])) {
    $status = editTicket($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deleteTicket'])) {
    $status = deleteTicket($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['updateTicketNotes'])) {
    $status = updateTicketNotes($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['addupdateTechnicianTickets'])) {
    $status = addupdateTechnicianTickets($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['addTicketReply'])) {
    $status = addTicketReply($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
// contractconsume
if (isset($_POST['adcontractconsum'])) {
    $status = adcontractconsum($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['edtcontractconsum'])) {
    $status = edtcontractconsum($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deletecontractConsumable'])) {
    $status = deletecontractConsumable($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
// CREDENTIALS
if (isset($_POST['addCredential'])) {
    $status = addCredential($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['editCredential'])) {
    $status = editCredential($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deleteCredential'])) {
    $status = deleteCredential($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

// LICENSES
if (isset($_POST['addLicense'])) {
    $status = addLicense($_POST);
    $section = "licenses";
    header("Location:" . $_POST['refral'] . "&status=" . $status);
}
if (isset($_POST['editLicense'])) {
    $status = editLicense($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deleteLicense'])) {
    $status = deleteLicense($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

if (isset($_POST['addLicenseAssignment'])) {
    $status = addLicenseAssignment($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteLicenseAssignment'])) {
    $status = deleteLicenseAssignment($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

// CLIENTS
if (isset($_POST['addClient'])) {
    $status = addClient($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editClient'])) {
    $status = editClient($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editClientPendingInvoice'])) {
    $status = editClientPendingInvoice($_POST);
    header("Location:?route=invoice/pendinginvoice");
}
if (isset($_POST['deleteClient'])) {
    $status = deleteClient($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['addinvoice'])) {
    $status = addinvoice($_POST, $_FILES);
    header("Location:?route=clients/manage&id=" . $_POST['clintid'] . "&section=invoice&status=" . $status);
}

if (isset($_POST['invoiceedit'])) {
    $status = invoiceedit($_POST, $_FILES);
    if (isset($_POST['view_con_redirect'])) {
        $view_con_redirect = $_POST['view_con_redirect'];
        header("Location:?route=" . $view_con_redirect);
    } elseif (isset($_GET['reroute']) && $_GET['reroute'] == 'invoice') {
        header("Location:?route=invoice");
    } else {
        header("Location:?route=clients/manage&id=" . $_POST['clintid'] . "&section=invoice&status=" . $status);
    }
}

if (isset($_POST['editinvoice_payment'])) {
    $status = editinvoice_payment($_POST, $_FILES);
    $redirect_url = isset($_POST['redirect_url']) ? $_POST['redirect_url'] : '';
    $redirect_url = str_replace('__', '=', $redirect_url);
    $redirect_url = str_replace('*', '&', $redirect_url);
    header("Location:?route=invoice&" . $redirect_url);
}

if (isset($_POST['deleteinvoice'])) {
    $status = deleteinvoice($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

if (isset($_POST['deleteinvinvoice'])) {
    $status = deleteinvinvoice($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['id']);
}

if (isset($_POST['clientPaidDelete'])) {
    $status = clientPaidDelete($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['id']);
}

if (isset($_POST['clientOrDelete'])) {
    $status = clientOrDelete($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['id']);
}

if (isset($_POST['clientTaxDelete'])) {
    $status = clientTaxDelete($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['id']);
}


if (isset($_POST['deleteUsagereport'])) {
    $status = deleteUsagereport($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&tab=department");
}

if (isset($_POST['deleteactuallstatus'])) {
    $status = deleteactuallstatus($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&tab=department");
}


// MONITORING
if (isset($_POST['addHost'])) {
    $status = addHost($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editHost'])) {
    $status = editHost($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteHost'])) {
    $status = deleteHost($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['addCheck'])) {
    $status = addCheck($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editCheck'])) {
    $status = editCheck($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteCheck'])) {
    $status = deleteCheck($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['addHostPeople'])) {
    $status = addHostPeople($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteHostPeople'])) {
    $status = deleteHostPeople($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

// USERS
if (isset($_POST['addUser'])) {
    $status = addUser($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['editUser'])) {
    $status = editUser($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteUser'])) {
    $status = deleteUser($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['deletedepartment'])) {
    $status = deletedepartment($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['editdipartment'])) {
    $status = editdipartment($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['addepartment'])) {
    $status = addepartment($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
// ADMINS
if (isset($_POST['addAdmin'])) {
    $status = addAdmin($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editAdmin'])) {
    $status = editAdmin($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteAdmin'])) {
    $status = deleteAdmin($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['addAdminAssignment'])) {
    $status = addAdminAssignment($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteAdminAssignment'])) {
    $status = deleteAdminAssignment($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

// ASSET CATEGORIES
if (isset($_POST['addAssetCategory'])) {
    $status = addAssetCategory($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editAssetCategory'])) {
    $status = editAssetCategory($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteAssetCategory'])) {
    $status = deleteAssetCategory($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

// CONTRACT TYPE
if (isset($_POST['addContractType'])) {
    $status = addContractType($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

// CLIENT TYPE
if (isset($_POST['addClientType'])) {
    $status = addClientType($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['editContractType'])) {
    $status = editContractType($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['editClientType'])) {
    $status = editClientType($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteContractType'])) {
    $status = deleteContractType($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['deleteClientType'])) {
    $status = deleteClientType($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

// CONTRACT USAGES
if (isset($_POST['addContractUsage'])) {
    $status = addContractUsage($_POST);
    // echo '<pre>';
    // print_r($_POST);
    // echo "Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section'];
    // die;
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['editContractUsage'])) {
    $status = editContractUsage($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

if (isset($_POST['edit_basic_print_form'])) {
    $status = edit_basic_print_form($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

if (isset($_POST['extra_basic_chargies'])) {
    $status = extra_basic_chargies($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

if (isset($_POST['extra_text_chargies'])) {
    $status = extra_text_chargies($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

if (isset($_POST['editassetUsage'])) {
    $status = editassetUsage($_POST);
    header("Location:?route=" . $_POST['route'] . "&cid=" . $_POST['cid'] . "&oaid=" . $_POST['oaid'] . "&coid=" . $_POST['coid'] . "&status=" . $status);
}
if (isset($_POST['deleteContractUsage'])) {
    $status = deleteContractUsage($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

// LICENSE TYPES
if (isset($_POST['addLicenseCategory'])) {
    $status = addLicenseCategory($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editLicenseCategory'])) {
    $status = editLicenseCategory($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteLicenseCategory'])) {
    $status = deleteLicenseCategory($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

// STATUS LABELS
if (isset($_POST['addLabel'])) {
    $status = addLabel($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editLabel'])) {
    $status = editLabel($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteLabel'])) {
    $status = deleteLabel($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

// ticketsubjectAdd
if (isset($_POST['addticketsubject'])) {
    $status = addticketsubject($_POST);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}

if (isset($_POST['editticketsubject'])) {
    $status = editticketsubject($_POST);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}
if (isset($_POST['deleteticketsubject'])) {
    $status = deleteticketsubject($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}

// ticketactionAdd
if (isset($_POST['addticketaction'])) {
    $status = addticketaction($_POST);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}

if (isset($_POST['editticketaction'])) {
    $status = editticketaction($_POST);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}
if (isset($_POST['deleteticketaction'])) {
    $status = deleteticketaction($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}


// WAREHOUSEaddwarehouse
if (isset($_POST['addwarehouse'])) {
    $status = addwarehouse($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editwarehouse'])) {
    $status = editwarehouse($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deletewarehouse'])) {
    $status = deletewarehouse($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
// Consumable
if (isset($_POST['addconsumable'])) {
    $status = addconsumable($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editconsumable'])) {
    $status = editconsumable($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteconsumable'])) {
    $status = deleteconsumable($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}


// MANUFACTURERS
if (isset($_POST['addManufacturer'])) {
    $status = addManufacturer($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editManufacturer'])) {
    $status = editManufacturer($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteManufacturer'])) {
    $status = deleteManufacturer($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['pullout'])) {
    //echo'<pre>';
    // print_r($_POST);
    // echo'</pre>';
    // die('rhttt');

    $serstats = $_POST['assetmemo'];
    $cid = $_POST['cid'];
    $coid = $_POST['coid'];
    $oaid = $_POST['oaid'];
    $assetid = $_POST['assetid'];
    $isend = 1;
    $is_endservice = 1;
    global $database;
    $dat = date('Y-m-d');
    $tmemo = $_POST['tmemo'];
    $asset = getTableFiltered("asstes", "id", $oaid);
    $modelid = getSingleValue("assets", "modelid", $oaid);
    $modelname = getSingleValue("models", "name", $modelid);
    $asset_serial = getSingleValue("assets", "serial", $oaid);
    $fullname = getSingleValue("assets", "tag", $oaid) . " : " . $modelname . " : " . $asset_serial;

    $ast_sts = null;
    $database->update("contract_history", [
        "memo" => $tmemo,
        "pulledoutdate" => date('Y-m-d'),
        "maintenance" => '',
        "isend" => '1',
    ], ["contractid" => $coid, "assetid" => $oaid]);

    $database->update("contract", ["is_end" => $isend, "ast_sts" => $ast_sts, "is_endservice" => $is_endservice, "clientid" => $cid, "contract_expiry" => $dat, "endasset" => $fullname, "endservice" => $fullname, "endsku" => $asset['sku'], "statusid" => 2], ["id" => $coid]);

    if ($assetid == "repair") {

        $database->update("assets", ["clientid" => '0', "statusid" => $serstats, "status" => "Under Repair"], ["id" => $oaid]);
    } elseif ($assetid == "disposal") {

        $database->update("assets", ["clientid" => '0', "statusid" => $serstats, "status" => "For Disposal"], ["id" => $oaid]);
    } else {

        $database->update("assets", ["warehouseid" => $_POST['assetid'], "clientid" => '0', "statusid" => $serstats, "status" => "Available"], ["id" => $oaid]);
    }

    header("Location: ?route=clients/manage&id=" . $cid);
}

if (isset($_POST['assetstatuschange'])) {
    $oaid = $_POST['oaid'];
    $labelid = $_POST['labelid'];
    global $database;

    $database->update("assets", ["statusid" => $labelid], ["id" => $oaid]);



    header("Location: ?route=assets/warehouse");
}

// if (isset($_POST['assetlocationchange'])) {

// $allasets =	getTable("assets");

// foreach($allasets as $asset){

// genratebarcode($asset['sku'],$asset['id']);

// }


// }

if (isset($_POST['assetlocationchange'])) {
    $oaid = $_POST['oaid'];
    $warehouseid = $_POST['warehouseid'];
    global $database;
    $allasets =    getTable("assets");

    foreach ($allasets as $asset) {

        $barcode = genratebarcode($asset['sku'], $asset['id']);
    }
    //genratebarcode('345365','0');

    $database->update("assets", ["warehouseid" => $warehouseid, "qrcode" => $barcode], ["id" => $oaid]);

    header("Location: ?route=assets/warehouse");
}

///addkb
if (isset($_POST['action'])) {



    $name = $_POST['name'];
    $clients = $_POST['clients'];

    global $database;



    $kbcata    = $database->insert("kb_categories", [
        "clients" => $clients,
        "name" => $name
    ]);

    header("Location: ?route=kb&clients=" . $clients . "&reroute=kb&name=" . $name);
}

//edit kb
if (isset($_POST['kbedit'])) {



    $name = $_POST['name'];
    $id = $_POST['routeid'];
    $clients = $_POST['clients'];

    global $database;



    $kbcata    = $database->update("kb_categories", [
        "clients" => $clients,
        "name" => $name
    ], ["id" => $id]);

    header("Location: ?route=kb&clients=" . $clients . "&reroute=kb&name=" . $name);
}

//Delete Kb
if (isset($_POST['deleteKBCategory'])) {

    $id = $_POST['id'];
    global $database;
    $kbcata    = $database->delete("kb_categories", ["id" => $id]);
    header("Location: ?route=kb&clients=" . $clients . "&reroute=kb&name=" . $name);
}

//Add article

if (isset($_POST['addArticle'])) {



    $name = $_POST['name'];
    $categoryid = $_POST['categoryid'];
    $clients = $_POST['clients'];
    $content = $_POST['content'];
    $modelid = $_POST['modelid'];
    $errormessage = $_POST['errormessage'];
    $subject = $_POST['subject'];
    $youtube_url = isset($_POST['youtube_url']) ? $_POST['youtube_url'] : '';
    $uploadedFile = uploadArticlelimage($_FILES, $data);

    global $database;



    $kbcata    = $database->insert("kb_articles", [
        "categoryid" => $categoryid,
        "clients" => $clients,
        "name" => $name,
        "content" => $content,
        "modelid" => $modelid,
        "errormessage" => $errormessage,
        "subject" => $subject,
        "file" => $uploadedFile['name'],
        "youtube_url" => $youtube_url
    ]);

    header("Location: ?route=kb&clients=" . $clients . "&reroute=kb&name=" . $name);
}

//Edit Article

if (isset($_POST['editArticle'])) {

    // echo'<pre>';
    // print_r($_POST);
    // echo'</pre>';die('kljhbcfvb');
    $id = $_POST['id'];
    $name = $_POST['name'];
    $categoryid = $_POST['categoryid'];
    $clients = $_POST['clients'];
    $content = $_POST['content'];
    $modelid = $_POST['modelid'];
    $errormessage = $_POST['errormessage'];
    $subject = $_POST['subject'];
    $youtube_url = isset($_POST['youtube_url']) ? $_POST['youtube_url'] : '';
    $uploadedFile = uploadArticlelimage($_FILES, $data);

    global $database;



    $kbcata    = $database->update("kb_articles", [
        "categoryid" => $categoryid,
        "clients" => $clients,
        "name" => $name,
        "content" => $content,
        "modelid" => $modelid,
        "errormessage" => $errormessage,
        "subject" => $subject,
        "file" => $uploadedFile['name'],
        "youtube_url" => $youtube_url
    ], ["id" => $id]);

    header("Location: ?route=kb&clients=" . $clients . "&reroute=kb&name=" . $name);
}

//Delete Article

if (isset($_POST['deleteKBarticle'])) {

    $id = $_POST['id'];
    global $database;
    $kbcata    = $database->delete("kb_articles", ["id" => $id]);
    header("Location: ?route=kb&clients=" . $clients . "&reroute=kb&name=" . $name);
}




// $historyid = $database->insert("contract_history", [
// "contractid" => $coid,
// "assetid" => $assetid,
// "memo" => "Newly Deployed",
// "deployeddate" => date('Y-m-d'),
// "notes" => "Newly Deployed"
// ]);


if (isset($_POST['replaceasset'])) {
    $oaid = $_POST['oaid'];            // oldasset id
    $cid = $_POST['cid'];            // client id
    $coid = $_POST['coid'];            // contract id
    $assetid = $_POST['assetid'];    // new asset id

    $contr = getRowById("contract", $_GET['coid']);
    $contrug = getTableFiltereddc("contract_usages", "contractid", $coid, "assetid", $oaid);
    $contrugg = $contrug[0];

    // echo'<pre>';
    // print_r($_POST);
    // echo'</pre>';
    // die('ffdfg');

    global $database;

    $database->update("assets", ["clientid" => $cid, "statusid" => $_POST['resson'], "status" => "For Pullout"], ["id" => $oaid]);

    $hiryid = $database->insert("contract", [
        "contractno" => $contr['contractno'],
        "assetid" => $contr['assetid'],
        "clientid" => $contr['clientid'],
        "department" => $contr['department'],
        "statusid" => 8,
        "memo" => $contr['memo'],
        "is_end" => "1",
        "ast_sts" => "1",
        "is_endservice" => "1",
        "endservice" => "Replace",
        "endservice_status" => "Inactive",
        "endasset" => "Replace",
        "created_date" => $contr['created_date']
    ]);
    $newww = $database->insert("contract_usages", [
        "clientid" => $contrugg['clientid'],
        "contractid" => $hiryid,
        "assetid" => $contrugg['assetid'],
        "startdate" => $contrugg['startdate'],
        "enddate" => $contrugg['enddate'],
        "checkeddate" => $contrugg['checkeddate'],
        "scolora3" => $contrugg['scolora3'],
        "scolora4" => $contrugg['scolora4'],
        "sblacka3" => $contrugg['sblacka3'],
        "sblacka4" => $contrugg['sblacka4'],
        "ecolora3" => $contrugg['ecolora3'],
        "ecolora4" => $contrugg['ecolora4'],
        "eblacka3" => $contrugg['eblacka3'],
        "eblacka4" => $contrugg['eblacka4'],
        "tcolora3" => $contrugg['tcolora3'],
        "tcolora4" => $contrugg['tcolora4'],
        "tblacka3" => $contrugg['tblacka3'],
        "tblacka4" => $contrugg['tblacka4'],
        "statusid" => "Replaced Contract",
        "description" => "Replaced Contract"
    ]);

    $historyid = $database->update("contract_history", [
        "memo" => "For Pull Out",
        "pulledoutdate" => date('Y-m-d'),
        "memo" => "Newly Replaced",
        "notes" => "Newly Replaced"
    ], ["contractid" => $coid, "assetid" => $oaid]);

    $historyid = $database->insert("contract_history", [
        "contractid" => $coid,
        "assetid" => $assetid,
        "memo" => "Newly Deployed",
        "deployeddate" => date('Y-m-d'),
        "notes" => "Newly Deployed"
    ]);

    $database->update("assets", ["clientid" => $cid, "statusid" => "7", "status" => "In Service"], ["id" => $assetid]);

    $database->update("contract", ["statusid" => "7",  "assetid" => $assetid, "is_end" => "0"], ["id" => $coid]);
    //  $database->update("contract_usages", ["description" =>"Asset Replaced","statusid" =>"Replaced"], ["id" => $contrugg['id']]);

    $database->insert("contract_usages", [
        "clientid" => $cid,
        "contractid" => $coid,
        "assetid" => $oaid,
        "startdate" => date('Y-m-d'),
        "enddate" => $contrugg['enddate'],
        "transtype" => "old_unit",
        "ecolora3" => 0,
        "eblacka3" => 0,
        "ecolora4" => 0,
        "eblacka4" => 0,
        "scolora3" => $contrugg['ecolora3'],
        "scolora4" => $contrugg['ecolora4'],
        "sblacka3" => $contrugg['eblacka3'],
        "sblacka4" => $contrugg['eblacka4'],
        "statusid" => "Replaced",
        "description" => "Old Unit-Closed"
    ]);

    $new = $database->insert("contract_usages", [
        "clientid" => $cid,
        "contractid" => $coid,
        "assetid" => $assetid,
        "startdate" => date('Y-m-d'),
        "scolora3" => $_POST['A3clrr'],
        "scolora4" => $_POST['A4clrr'],
        "sblacka3" => $_POST['A3blkk'],
        "sblacka4" => $_POST['A4blkk'],
        "transtype" => "start_milege",
        "description" => "New Unit-Replaced"
    ]);
    header("Location: ?route=contract/manage&id=" . $coid . "&reroute=clients/manage&routeid=" . $cid . "&contractid=" . $coid . "&section=contract");
}

// ASSET MODELS

if (isset($_POST['updateonlydepart'])) {
    $status = updatedeparton($_POST);
    header("Location:?route=clients/manage&id=" . $_POST['reffer'] . "&tab=department");
}



if (isset($_POST['update_technician_details'])) {
    $status = update_technician_details($_POST);
    header("Location:?route=clients/manage&id=" . $_POST['routeid'] . "&tab=department");
}
if (isset($_POST['delete_department'])) {
    $status = delete_department($_POST);
    header("Location:?route=clients/manage&id=" . $_POST['routeid']  . "&tab=department");
}


if (isset($_POST['updatenotes'])) {
    $status = updatenotes1($_POST);

    header("Location:?route=clients/manage&id=" . $_POST['reffer'] . "&tab=department");
}


if (isset($_POST['updateonlycasesrl'])) {

    $status = updateonlycasesrl($_POST);
    header("Location:?route=clients/manage&id=" . $_POST['reffer'] . "&tab=department&status=" . $status);
}

if (isset($_POST['addModel'])) {
    $status = addModel($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editModel'])) {
    if ($_FILES['image']['name'] != '') {


        $status = editModel($_POST, $_FILES);
    } else {

        $status = editModel($_POST);
    }
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

if (isset($_POST['editUsageModel'])) {
    if ($_FILES['image']['name'] != '') {
        $status = editUsageModel($_POST, $_FILES);
    } else {
        $status = editUsageModel($_POST);
    }
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&tab=department");
}

if (isset($_POST['editUsageactualstatusModel'])) {
    if ($_FILES['image']['name'] != '') {
        $status = editUsageactualstatusModel($_POST, $_FILES);
    } else {
        $status = editUsageactualstatusModel($_POST);
    }
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&tab=department");
}

if (isset($_POST['editUsageReport'])) {
    if ($_FILES['image']['name'] != '') {
        $status = editUsageReport($_POST, $_FILES);
    } else {
        $status = editUsageReport($_POST);
    }
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&tab=department");
}

if (isset($_POST['editactualstatus'])) {
    if ($_FILES['image']['name'] != '') {
        $status = editactualstatus($_POST, $_FILES);
    } else {
        $status = editactualstatus($_POST);
    }
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&tab=department");
}


if (isset($_POST['deleteModel'])) {
    $status = deleteModel($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

// SUPPLIERS
if (isset($_POST['addSupplier'])) {
    $status = addSupplier($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['editSupplier'])) {
    $status = editSupplier($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}
if (isset($_POST['deleteSupplier'])) {
    $status = deleteSupplier($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status);
}

// ISSUE INVOICE
if (isset($_POST['issueInvoice'])) {
    $status = issueInvoice($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

if (isset($_POST['saveMonth'])) {
    $status = saveMonth($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}

// SETTINGS
if (isset($_POST['generalSettings'])) {
    updateSetting("app_name", $_POST['app_name']);
    updateSetting("company_name", $_POST['company_name']);
    updateSetting("company_details", $_POST['company_details']);
    updateSetting("log_retention", $_POST['log_retention']);
    updateSetting("week_start", $_POST['week_start']);
    updateSetting("table_records", $_POST['table_records']);
    updateSetting("license_tag_prefix", $_POST['license_tag_prefix']);
    updateSetting("asset_tag_prefix", $_POST['asset_tag_prefix']);
    updateSetting("inquiry_email", $_POST['inquiry_email']);
    header("Location:?route=system/settings&status=40");
}
if (isset($_POST['ticketpages'])) {


    updateSetting("client_handle_mistake", $_POST['client_handle_mistake']);
    updateSetting("technical_improvement", $_POST['technical_improvement']);
    updateSetting("refill", $_POST['refill']);
    updateSetting("parsts_replacments", $_POST['parsts_replacments']);

    header("Location:?route=system/tickettype&status=40");
}
if (isset($_POST['logoSettings'])) {
    $status = updateLogoSetting($_FILES);
    header("Location:?route=system/settings&section=logo&status=$status");
}

if (isset($_POST['emailSettings'])) {
    updateSetting("email_from_address", $_POST['email_from_address']);
    updateSetting("email_from_name", $_POST['email_from_name']);
    //updateSetting("email_smtp_host", $_POST['email_smtp_host']);
    //updateSetting("email_smtp_port", $_POST['email_smtp_port']);
    //updateSetting("email_smtp_username", $_POST['email_smtp_username']);
    //updateSetting("email_smtp_password", $_POST['email_smtp_password']);
    //updateSetting("email_smtp_security", $_POST['email_smtp_security']);
    updateSetting("notification_recipient", $_POST['notification_recipient']);
    updateSetting("collection_recipient", $_POST['collection_recipient']);
    updateSetting("inquiry_form_url", $_POST['inquiry_form_url']);
    if (isset($_POST['email_smtp_auth']))
        $email_smtp_auth = "true";
    else
        $email_smtp_auth = "false";
    updateSetting("email_smtp_auth", $email_smtp_auth);
    if (isset($_POST['email_smtp_enable']))
        $email_smtp_enable = "true";
    else
        $email_smtp_enable = "false";
    updateSetting("email_smtp_enable", $email_smtp_enable);
    header("Location:?route=system/settings&section=email&status=40");
}
if (isset($_POST['smsSettings'])) {
    updateSetting("sms_provider", $_POST['sms_provider']);
    updateSetting("sms_user", $_POST['sms_user']);
    updateSetting("sms_password", $_POST['sms_password']);
    updateSetting("sms_api_id", $_POST['sms_api_id']);
    updateSetting("sms_from", $_POST['sms_from']);

    header("Location:?route=system/settings&section=sms&status=40");
}
if (isset($_POST['ticketsSettings'])) {
    updateSetting("tickets_server", $_POST['tickets_server']);
    updateSetting("tickets_username", $_POST['tickets_username']);
    updateSetting("tickets_password", $_POST['tickets_password']);
    updateSetting("tickets_encrypton", $_POST['tickets_encrypton']);
    if (isset($_POST['tickets_notification']))
        $tickets_notification = "true";
    else
        $tickets_notification = "false";
    updateSetting("tickets_notification", $tickets_notification);

    header("Location:?route=system/settings&section=tickets&status=40");
}

if (isset($_POST['addemailTemplate'])) {
    $status = addemailTemplate($_POST);
    header("Location:?route=" . $_POST['route']);
}



if (isset($_POST['emailtempleteEdit'])) {
    $status = emailtempleteEdit($_POST);
    header("Location:?route=" . $_POST['route']);
}

if (isset($_POST['addemailTemplateCategory'])) {
    $status = addemailTemplateCategory($_POST);
    header("Location:?route=" . $_POST['route']);
}

if (isset($_POST['emailCategorytempleteEdit'])) {
    $status = emailCategorytempleteEdit($_POST);
    header("Location:?route=" . $_POST['route']);
}


// if(isset($_POST['editClientNotificationTemplate'])) {
//      global $database, $mpdf, $scriptpath;

//     $userEmail = [];

//      foreach($_POST['check'] as $userId) {

//           if(!empty($userId)) {

//              $users = getTableFiltered("people", "id", $userId);



//               foreach($users as $user) {
//                 $clientid = $user['clientid'];

//                 $company = getSingleValue("clients", "name", $clientid);

//                 $invoices = getTableFiltered("invoice", "clintid", $clientid);

//                 $userEmail[] = $user['email'];

//                 $search = array('{clientname}','{viewinvoice}');

//                 $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
//                 $host = $_SERVER['HTTP_HOST'];
//                 $host_upper = strtoupper($host);
//                 $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
//                 $baseurl = $protocol . "://" . $host . $path;

//                 $doc_url = "{$baseurl}?route=invoiceTPdf&id={$clientid}&invoice_id={$_POST['invoice_id']}";

//                 $viewInvoice = "<br><a href='$doc_url' return false' style='display: inline-block; padding: 10px 0px; background-color: blue; color: white; text-decoration: none; border-radius: 5px;'>View Invoice</a><br>";

//                 $replace = array($company,$viewInvoice);

//                 $subject = str_replace($search, $replace, $_POST['subject']);
//                 $message = str_replace($search, $replace, $_POST['message']);

//                 $sendMail = sendEmail($user['email'], $subject, $message, $user['clientid'], $user['id'], "", "");

//               }
//           }
//      }

//      if ($sendMail) {
//         $usermail = implode(",", $userEmail);
//         $database->insert("invoicesentmailhistory", [
//             "type" => "all",
//             "invoiceid" => $_POST['invoice_id'],
//             "clintid" => $clientid,
//             "email" => $usermail,
//             "date" => date('Y-m-d H:i:s'),
//         ]);
//     }
//     header("Location: ?route=clients/manage&id=$clientid&tab=invoice");
// }

if (isset($_POST['editClientNotificationTemplate'])) {
    global $database, $mpdf, $scriptpath;

    $userEmail = [];

    if ($_POST['check'] != '') {

        foreach ($_POST['check'] as $userId) {

            if (!empty($userId)) {

                $users = getTableFiltered("people", "id", $userId);

                foreach ($users as $user) {
                    $clientid = $user['clientid'];

                    $company = getSingleValue("clients", "name", $clientid);

                    $invoices = getTableFiltered("invoice", "clintid", $clientid);

                    $userEmail[] = $user['email'];

                    $search = array('{clientname}', '{viewinvoice}');

                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

                    $host = $_SERVER['HTTP_HOST'];

                    $host_upper = strtoupper($host);

                    $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

                    $baseurl = $protocol . "://" . $host . $path;

                    $doc_url = "{$baseurl}?route=invoiceTPdf&id={$clientid}&invoice_id={$_POST['invoice_id']}";

                    $pdfUrl = "{$baseurl}?route=invoiceTemplateEmail&id={$clientid}&invoice_id={$_POST['invoice_id']}";

                    $invoice = getTableFiltered("invoice", "id", $_POST['invoice_id']);

                    $clientname = getSingleValue("clients", "name", $invoice[0]['clintid']);

                    $contract_id = $invoice[0]['invoice_contract_id'];

                    $invoice_datas = getinvoiceFiltered("contract", $contract_id);

                    $logo = $database->get("config", "value", ["name" => "logo"]);

                    $unique_identifier = uniqid();

                    $current_date = date('Y_m_d');

                    $filename = $company . '_' . $current_date . '_' . $unique_identifier;

                    $pdfFilePath = $scriptpath . "/uploads/invoice/" . $filename . ".pdf";
                    ob_start();

                    include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'invoiceTemplateEmail' . '.php');

                    $html = ob_get_contents();

                    ob_end_clean();

                    $mpdf->WriteHTML($html);

                    $mpdf->Output($pdfFilePath, "F");

                    ini_set('memory_limit', '64M');

                    $viewInvoice = "<br><a href='$doc_url' return false' style='display: inline-block; padding: 10px 0px; background-color: blue; color: white; text-decoration: none; border-radius: 5px;'>View Invoice</a><br>";

                    $replace = array($company, $viewInvoice);

                    $subject = str_replace($search, $replace, $_POST['subject']);
                    $message = str_replace($search, $replace, $_POST['message']);

                    $sendMail = sendEmail($user['email'], $subject, $message, $user['clientid'], $user['id'], "", $filename);
                }
            }
        }
    }

    if ($sendMail) {
        $usermail = implode(",", $userEmail);
        $database->insert("invoicesentmailhistory", [
            "type" => "all",
            "invoiceid" => $_POST['invoice_id'],
            "clintid" => $clientid,
            "email" => $usermail,
            "date" => date('Y-m-d H:i:s'),
        ]);
    }
    header("Location: ?route=clients/manage&id=$clientid&tab=invoice");
}

if (isset($_POST['editClientTaxFileTemplate'])) {
    global $database, $mpdf, $scriptpath;

    $userEmail = [];


    foreach ($_POST['check'] as $userId) {

        if (!empty($userId)) {

            $users = getTableFiltered("people", "id", $userId);

            foreach ($users as $user) {
                $clientid = $user['clientid'];

                $company = getSingleValue("clients", "name", $clientid);

                $userEmail[] = $user['email'];

                $invoice = getTableFiltered("invoice", "id", $_POST['invoice_id']);

                $search = array('{clientname}');

                $replace = array($company);

                $subject = str_replace($search, $replace, $_POST['subject']);
                $message = str_replace($search, $replace, $_POST['message']);

                $tax_file = $invoice[0]['tax_file_2307'];

                $sendMail = [];

                if ($tax_file != '') {
                    $sendMail = sendEmail($user['email'], $subject, $message, $user['clientid'], $user['id'], "", "", $tax_file);
                } else {
                    $sendMail = sendEmail($user['email'], $subject, $message, $user['clientid'], $user['id']);
                }
            }
        }
    }

    if ($sendMail) {
        $usermail = implode(",", $userEmail);
        $database->insert("invoicesentmailhistory", [
            "type" => "taxfile",
            "invoiceid" => $_POST['invoice_id'],
            "clintid" => $clientid,
            "email" => $usermail,
            "date" => date('Y-m-d H:i:s'),
        ]);
    }

    header("Location: ?route=clients/manage&id=$clientid&tab=invoice");
}

if (isset($_POST['editClientOrFileTemplate'])) {
    global $database, $mpdf, $scriptpath;

    $userEmail = [];


    foreach ($_POST['check'] as $userId) {

        if (!empty($userId)) {

            $users = getTableFiltered("people", "id", $userId);

            foreach ($users as $user) {
                $clientid = $user['clientid'];

                $company = getSingleValue("clients", "name", $clientid);

                $userEmail[] = $user['email'];


                $invoice = getTableFiltered("invoice", "id", $_POST['invoice_id']);

                $search = array('{clientname}');

                $replace = array($company);

                $subject = str_replace($search, $replace, $_POST['subject']);
                $message = str_replace($search, $replace, $_POST['message']);

                $or_file = $invoice[0]['or_file'];

                $sendMail = [];

                if ($or_file != '') {
                    $sendMail = sendEmail($user['email'], $subject, $message, $user['clientid'], $user['id'], "", "", "", "", $or_file);
                } else {
                    $sendMail = sendEmail($user['email'], $subject, $message, $user['clientid'], $user['id'], "", "", "");
                }
            }
        }
    }

    if ($sendMail) {
        $usermail = implode(",", $userEmail);
        $database->insert("invoicesentmailhistory", [
            "type" => "orfile",
            "invoiceid" => $_POST['invoice_id'],
            "clintid" => $clientid,
            "email" => $usermail,
            "date" => date('Y-m-d H:i:s'),
        ]);
    }
    header("Location: ?route=clients/manage&id=$clientid&tab=invoice");
}

if (isset($_POST['editClientPaidFileTemplate'])) {
    global $database, $mpdf, $scriptpath;

    $userEmail = [];

    foreach ($_POST['check'] as $userId) {

        if (!empty($userId)) {

            $users = getTableFiltered("people", "id", $userId);

            foreach ($users as $user) {
                $clientid = $user['clientid'];

                $company = getSingleValue("clients", "name", $clientid);

                $userEmail[] = $user['email'];

                $invoice = getTableFiltered("invoice", "id", $_POST['invoice_id']);

                $search = array('{clientname}');

                $replace = array($company);

                $subject = str_replace($search, $replace, $_POST['subject']);
                $message = str_replace($search, $replace, $_POST['message']);

                $paid_file = $invoice[0]['paid_file'];

                $sendMail = [];

                if ($paid_file != '') {
                    $sendMail = sendEmail($user['email'], $subject, $message, $user['clientid'], $user['id'], "", "", "", $paid_file);
                } else {
                    $sendMail = sendEmail($user['email'], $subject, $message, $user['clientid'], $user['id'], "", "", "", "");
                }
            }
        }
    }


    if ($sendMail) {
        $usermail = implode(",", $userEmail);
        $database->insert("invoicesentmailhistory", [
            "type" => "paid",
            "invoiceid" => $_POST['invoice_id'],
            "clintid" => $clientid,
            "email" => $usermail,
            "date" => date('Y-m-d H:i:s'),
        ]);
    }
    header("Location: ?route=clients/manage&id=$clientid&tab=invoice");
}

if (isset($_POST['pending/emailtemplete'])) {
    global $database, $mpdf, $scriptpath;
    $userEmail = [];

    foreach ($_POST['check'] as $userId) {
        if (!empty($userId)) {
            $users = getTableFiltered("people", "id", $userId);

            foreach ($users as $user) {

                $clientid = $user['clientid'];

                $company = getSingleValue("clients", "name", $clientid);
                $contact_person = getSingleValue("clients", "contact_person", $clientid);

                $userEmail[] = $user['email'];

                $client_name = $company;
                $contact_no = getSingleValue("people", "mobile", $userId);

                $invoices = getTableFiltered("invoice", "clintid", $clientid);

                $invoiceno = [];

                foreach ($invoices as $invoice) {

                    if ($_POST['type'] == 'tax') {
                        if ($invoice['tax_file_2307'] == '' || $invoice['tax_file_2307'] == NULL) {
                            $invoiceno[] = $invoice['invoiceno'];
                        }
                    } elseif ($_POST['type'] == 'inv') {
                        if ($invoice['paid'] == 0) {
                            $invoiceno[] = $invoice['invoiceno'];
                        }
                    }
                }

                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
                $host = $_SERVER['HTTP_HOST'];
                $host_upper = strtoupper($host);
                $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $baseurl = $protocol . "://" . $host . $path;


                $doc_url = "{$baseurl}?route=invoiceTPdf&id={$clientid}&invoice_id={$invoiceno[0]}";

                $search = array('{invoiceno}', '{company}', '{contactnumber}', '{payment_method}', '{amount}', '{paid}', '{payment_ref_no}', '{remark}', '{viewinvoice}', '{clientname}', '{contact}', '{subject}');

                $viewInvoice = "<br><a href='$doc_url' return false' style='display: inline-block; padding: 10px 0px; background-color: blue; color: white; text-decoration: none; border-radius: 5px;'>View Invoice</a><br>";

                $template = getRowById("notificationtemplates", $_POST['templateSelect']);
                $name = $template['name'];
                $replace = array($invoice['invoiceno'], $company, $contact_no, $invoice['payment_method'], $invoice['amount'], $invoice['paid'], $invoice['payment_ref_no'], $invoice['remark'], $viewInvoice, $client_name, $contact_person, $name);

                $subject = str_replace($search, $replace, $template['subject']);
                // $message = str_replace($search, $replace, $template['message']);
                $post_message = isset($_POST['email_template_message']) ? $_POST['email_template_message'] : $template['message'];
                $message = str_replace($search, $replace, $post_message);
                $invoice_attechment = '';
                if ($_POST['invoice_attechment'] && $_POST['invoice_attechment'] != '') {
                    $invoice_attechment = $_POST['invoice_attechment'];
                }
                $generate_invoice_pdf_path = '';
                if (isset($_POST['hid_invoice_id']) && $_POST['hid_invoice_id'] != '') {
                    $generate_invoice_pdf_path = generate_invoice_pdf($_POST['hid_invoice_id']);
                }
                if (isset($_POST['receive_invoice_id']) && $_POST['receive_invoice_id'] != '') {
                    $generate_invoice_pdf_path = generate_invoice_pdf($_POST['receive_invoice_id']);
                }
                if (isset($_POST['with_holding_2307_invoice_id']) && $_POST['with_holding_2307_invoice_id'] != '') {
                    $generate_invoice_pdf_path = generate_invoice_pdf($_POST['with_holding_2307_invoice_id']);
                }

                $sendMail = sendEmail($user['email'], $subject, $message, $user['clientid'], $user['id'], "", "", "", "", "", $invoice_attechment, $generate_invoice_pdf_path);
                unlink($scriptpath . DIRECTORY_SEPARATOR . $generate_invoice_pdf_path);

                $invoice_send_mail_count = getSingleValue("invoice", "send_mail", $_POST['hid_invoice_id']);
                if (isset($_POST['hid_invoice_id']) && $_POST['hid_invoice_id'] != '') {
                    $database->update("invoice", [
                        "send_mail" => $invoice_send_mail_count + 1,
                        "send_mail_date" => date('Y-m-d')
                    ], ["id" => $_POST['hid_invoice_id']]);
                } elseif (isset($_POST['receive_invoice_id']) && $_POST['receive_invoice_id'] != '') {
                    $invoice_send_mail_1_count = getSingleValue("invoice", "send_mail_1", $_POST['receive_invoice_id']);
                    if ($invoice_send_mail_1_count == null) {
                        $invoice_send_mail_1_count = 0;
                    }
                    $database->update("invoice", [
                        "send_mail_1" => $invoice_send_mail_1_count + 1,
                        "send_mail_1_date" => date('Y-m-d')
                    ], ["id" => $_POST['receive_invoice_id']]);
                } elseif (isset($_POST['with_holding_2307_invoice_id']) && $_POST['with_holding_2307_invoice_id'] != '') {
                    $invoice_send_mail_2_count = getSingleValue("invoice", "send_mail_2", $_POST['with_holding_2307_invoice_id']);
                    if ($invoice_send_mail_2_count == null) {
                        $invoice_send_mail_2_count = 0;
                    }
                    $database->update("invoice", [
                        "send_mail_2" => $invoice_send_mail_2_count + 1,
                        "send_mail_2_date" => date('Y-m-d')
                    ], ["id" => $_POST['with_holding_2307_invoice_id']]);
                }
            }
        }
    }

    if ($sendMail) {
        $usermail = implode(",", $userEmail);
        $database->insert("invoicesentmailhistory", [
            "type" => "pending",
            "invoiceid" => $_POST['invoice_id'],
            "clintid" => $clientid,
            "email" => $usermail,
            "date" => date('Y-m-d H:i:s'),
        ]);

        if (isset($_POST['client_email_send_1']) && $_POST['client_email_send_1'] != '') {
            $client_email_client_id = $_POST['client_email_client_id'];
            $client_email_send_1_count = getSingleValue("clients", "client_email_send_1", $client_email_client_id);
            $database->update("clients", [
                "client_email_send_1" => $client_email_send_1_count + 1,
                "send_date_time" => date('Y-m-d')
            ], ["id" => $client_email_client_id]);
        }
    }
    if (isset($_POST['hid_invoice_id']) && $_POST['hid_invoice_id'] != '' && $_POST['hid_invoice_id'] > 0) {
        header("Location:?route=invoice/search_invoice&year_month=" . $_GET['year_month']);
    } else if (isset($_POST['receive_invoice_id']) && $_POST['receive_invoice_id'] != '' && $_POST['receive_invoice_id'] > 0) {
        header("Location:?route=invoice/receive_invoice&year_month=" . $_GET['year_month']);
    } else if (isset($_POST['client_email_send_1']) && $_POST['client_email_send_1'] != '' && $_POST['client_email_send_1'] > 0) {
        header("Location:?route=clients/active");
    } else if (isset($_POST['with_holding_2307_invoice_id']) && $_POST['with_holding_2307_invoice_id'] != '' && $_POST['with_holding_2307_invoice_id'] > 0) {
        header("Location:?route=invoice/with_holding_2307_wht");
    } else {
        header("Location:?route=invoice/pendinginvoice");
    }
    // receive_invoice_id



    // 

    // if (!empty($users) && !empty($invoices)) {
    //     $templateId = 11;

    //     foreach ($users as $user) {
    //         $invoiceNos = [];

    //         foreach ($invoices as $invoice) {
    //             if ($invoice['tax_file_2307'] == '' || $invoice['tax_file_2307'] == NULL) {
    //                 $invoiceNos[] = $invoice['invoiceno'];
    //             }
    //         }

    //         $search = array('{invoiceno}');
    //         $template = getRowById("notificationtemplates", $templateId);
    //         $subject = str_replace($search, implode(",",$invoiceNos), $template['subject']);
    //         $message = str_replace($search, implode(",",$invoiceNos), $template['message']);

    //         $sendMail = sendEmail($user['email'], $subject, $message, $user['clientid'], $user['id'], "", "");

    //         if (!$sendMail) {
    //             header("Location:?route=" . $_POST['route']);
    //         }
    //         header("Location:?route=" . $_POST['route']);
    //     }
    // }

    // $status = emailtemplete($_POST);

}


if (isset($_POST['emailtempleteDelete'])) {
    $status = emailtempleteDelete($_POST['id']);
    header("Location:?route=" . $_POST['route']);
}

if (isset($_POST['emailCategorytempleteDelete'])) {
    $status = emailCategorytempleteDelete($_POST['id']);
    header("Location:?route=" . $_POST['route']);
}

if (isset($_POST['editNotificationTemplate'])) {
    // echo "<pre>";
    // print_R($_POST);
    // die("sdag");
    $status = editNotificationTemplate($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&section=" . $_POST['section'] . "&status=" . $status);
}

if (isset($_POST['editInvoiceTemplate'])) {
    $status = editInvoiceTemplate($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&section=" . $_POST['section'] . "&status=" . $status);
}

if (isset($_POST['uploadexl'])) {
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if ($ext == "csv") {
        $file = $_FILES['file']['tmp_name'];
        $handle = fopen($file, "r");
        while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {

            if (is_numeric($filesop[0])) {
                global $database;
                $database->update("assets", ["remark" => $filesop[3]], ["sku" => $filesop[0]]);
            }
        }
        header("Location:?route=assets/allaset&status=20");
    } else {
        header("Location:?route=assets/allaset&status=55");
    }
}

if (isset($_POST['sendmail'])) {
    $status = sendmail($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}

if (isset($_POST['addslide'])) {
    $status = addslide($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}
if (isset($_POST['addbanner'])) {
    $status = addbanner($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}
if (isset($_POST['editbanner'])) {
    $status = editbanner($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}
if (isset($_POST['deletebanner'])) {
    $status = deletebanner($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}
if (isset($_POST['editslide'])) {
    $status = editslide($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}
if (isset($_POST['deleteslide'])) {
    $status = deleteslide($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}
if (isset($_POST['deleteslidegroup'])) {
    $status = deleteslidegroup($_POST['id']);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}
if (isset($_POST['addslidegroup'])) {
    $status = addslidegroup($_POST);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}
if (isset($_POST['editslidegroup'])) {
    $status = editslidegroup($_POST);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}

##### GET DATA FOR MODALS #####
if (isset($_GET['modal'])) {
    switch ($_GET['modal']) {
        case "assetCategoryEdit":
            $category = getRowById("assetcategories", $_GET['id']);
            break;
        case "contractTypeEdit":
            $contracttype = getRowById("contracttype", $_GET['id']);
            break;
        case "clientTypeEdit":
            $clienttype = getRowById("clienttype", $_GET['id']);
            break;
        case "licenseCategoryEdit":
            $category = getRowById("licensecategories", $_GET['id']);
            break;
        case "licenseCategoryDelete":
            $category = getRowById("licensecategories", $_GET['id']);
            break;
        case "labelEdit":
            $label = getRowById("labels", $_GET['id']);
            break;
        case "labelDelete":
            $label = getRowById("labels", $_GET['id']);
            break;
        case "manufacturerEdit":
            $manufacturer = getRowById("manufacturers", $_GET['id']);
            break;
        case "manufacturerDelete":
            $manufacturer = getRowById("manufacturers", $_GET['id']);
            break;
        case "warehouseEdit":
            $warehouse = getRowById("warehouse", $_GET['id']);
            break;
        case "consumableEdit":
            $consumable = getRowById("consumable_list", $_GET['id']);
            break;
        case "ticketsubjectEdit":
            $subject = getRowById("ticketsubject", $_GET['id']);
            break;
        case "ticketactionEdit":
            $action = getRowById("ticket_action", $_GET['id']);
            break;
        case "warehouseDelete":
            $warehouse = getRowById("warehouse", $_GET['id']);
            break;
        case "consumableDelete":
            $consumable = getRowById("consumable_list", $_GET['id']);
            break;
        case "modelAdd":
            $manufacturers = getTable("manufacturers");
            break;
        case "modelEdit":
            $manufacturers = getTable("manufacturers");
            $model = getRowById("models", $_GET['id']);
            break;
        case "emailtempleteEdit":
            $emailtemplete = getRowById("notificationtemplates", $_GET['id']);
            $categorytemplete = getTable("emailtempletecategory");

        case "emailtemplete":
            if (isset($_GET['id'])) {
                $people = getTableFiltered("people", "clientid", $_GET['id']);
            } else {
                $people = get_people_for_all_send_email_invoice();
            }

            $templetes = getTable("notificationtemplates");
            $status = '';

            if (isset($_GET['tax'])) {
                $status = 'tax';
            } else {
                $status = 'inv';
            }

            break;
        case "emailtempleteView":
            $emailtemplete = getRowById("notificationtemplates", $_GET['id']);
            $categorytemplete = getTable("emailtempletecategory");
            break;
        case "modelUsageEdit":
            $modelid = getSingleValue("assets", "modelid", $_GET['id']);
            $modelname = getSingleValue("models", "name", $modelid);
            $sku = getSingleValue("assets", "sku", $_GET['id']);
            $modelimage = getSingleValue("models", "image", $modelid);
            $labeldata = getTableFiltered("assets", "id", $_GET['id']);
            $contractNo = $_GET['contractno'];
            $contract_detail = get_contranct_id_by_contract_no($contractNo);
            $labeldata['contract_id'] = $_GET['contract_id'];
            $department_name = "";
            $department_tag = $_GET['department'];

            if ($department_tag) {
                $department = $_GET['department'];
            } else {
                $department = "Department is not assigned";
            }

            break;

        case "modelUsageEditactualstatus":
            $modelid = getSingleValue("assets", "modelid", $_GET['id']);
            $modelname = getSingleValue("models", "name", $modelid);
            $sku = getSingleValue("assets", "sku", $_GET['id']);
            $modelimage = getSingleValue("models", "image", $modelid);
            $labeldata = getTableFiltered("assets", "id", $_GET['id']);
            $clientid = $labeldata[0]['clientid'];
            $contractNo = $_GET['contractno'];
            $contract_detail = get_contranct_id_by_contract_no($contractNo);
            $labeldata['contract_id'] = $_GET['contract_id'];
            $department_name = "";
            $department_tag = $_GET['department'];

            session_start();
            $sessionid = session_id();

            $user = getTableFiltered("people", "sessionid", $sessionid);
            if ($department_tag) {
                $department = $_GET['department'];
            } else {
                $department = "Department is not assigned";
            }

            break;

        case "EditmodelUsageEditactualstatus";
            $actualstatus = getRowById("actual_report", $_GET['id']);
            $modelimage = getSingleValue("models", "image", $actualstatus['asset_id']);
            break;

        case "EditUsagereport";
            $usageReport = getRowById("usage_report", $_GET['id']);
            $modelimage = getSingleValue("models", "image", $usageReport['asset_id']);
            break;

        case "modelDelete":
            $manufacturers = getTable("manufacturers");
            $model = getRowById("models", $_GET['id']);
            break;
        case "supplierEdit":
            $supplier = getRowById("suppliers", $_GET['id']);
            break;
        case "supplierDelete":
            $supplier = getRowById("suppliers", $_GET['id']);
            break;
        case "userAdd":
            $clients = getTable("clients");
            break;
        case "userDelete":
            $user = getRowById("people", $_GET['id']);
            break;
        case "adminDelete":
            $admin = getRowById("people", $_GET['id']);
            break;
        case "hostAdd":
            $clients = getTable("clients");
            break;
        case "hostEdit":
            $clients = getTable("clients");
            $host = getRowById("hosts", $_GET['id']);
            break;
        case "hostDelete":
            $host = getRowById("hosts", $_GET['id']);
            break;
        case "checkEdit":
            $check = getRowById("hosts_checks", $_GET['id']);
            break;
        case "checkDelete":
            $check = getRowById("hosts_checks", $_GET['id']);
            break;
        case "hostAssignPeople":
            $people = getTable("people");
            break;
        case "clientEdit":
            $client = getRowById("clients", $_GET['id']);
            $clienttypes = getTable("clienttype");
            $payment_methods = getTable("payment_method" , "*", "name" , 'ASC');
            break;
        case "PendingclientEdit":
            $people = getTableFiltered("people", "clientid", $_GET['id']);
            $client = getRowById("clients", $_GET['id']);
            $clienttypes = getTable("clienttype");
            break;
        case "clientDelete":
            $client = getRowById("clients", $_GET['id']);
            break;
        case "clientInvDelete":
            $client = getRowById("invoice", $_GET['id']);
            break;
        case "clientPaidDelete":
            $client = getRowById("invoice", $_GET['id']);
            break;
        case "clientOrDelete":
            $client = getRowById("invoice", $_GET['id']);
            break;
        case "clientTaxDelete":
            $client = getRowById("invoice", $_GET['id']);
            break;
        case "credentialAdd":
            $assets = getTable("assets");
            $clients = getTable("clients");
            break;
        case "credentialEdit":
            $credential = getRowById("credentials", $_GET['id']);
            $assets = getTable("assets");
            $clients = getTable("clients");
            break;
        case "credentialDelete":
            $credential = getRowById("credentials", $_GET['id']);
            break;
        case "issueAdd":
            $assets = getTable("assets");
            $clients = getTable("clients");
            $projects = getTable("projects");
            $admins = getTableFiltered("people", "type", "admin");
            break;
        case "addKBCategory":
            isAuthorized("addKB");
            $status = Kb::addCategory($_POST);
            break;
        case "kb":
            $assets = getTable("kb_categories");
            $clients = getTable("clients");
            $projects = getTable("projects");
            $admins = getTableFiltered("people", "type", "admin");
            break;

        case "issueEdit":
            $issue = getRowById("issues", $_GET['id']);
            $assets = getTable("assets");
            $clients = getTable("clients");
            $projects = getTable("projects");
            $admins = getTableFiltered("people", "type", "admin");
            break;
        case "issueDelete":
            $issue = getRowById("issues", $_GET['id']);
            break;

        case "usageAdd":
            $cliendid = $_GET['clientid'];
            $assetid = $_GET['assetid'];
            $assets = getTable("assets");
            $clients = getTable("clients");
            $projects = getTable("projects");
            $admins = getTableFiltered("people", "type", "admin");
            break;

        case "replaceasset":
            $assets = getTableFiltered("assets", "clientid", "0");
            $assettotalCount = $database->count("assets", "clientid", "0");
            break;

        case "assetstatuschange":
            $lables = getTable("labels");
            break;

        case "assetlocationchange":
            $warehouses = getTable("warehouse");
            break;

        case "pullout";
            $labels = getTableasc("labels");
            $warehouses = getTable("warehouse");
            $warehousetotalCount = $database->count("warehouse");
            break;

        case "usageEdit":
            $usage = getRowById("asset_usages", $_GET['id']);
            $assets = getTable("assets");
            $clients = getTable("clients");
            $projects = getTable("projects");
            $admins = getTableFiltered("people", "type", "admin");
            break;

        case "usageDelete":
            $issue = getRowById("issues", $_GET['id']);
            break;
        case "contractUsageAdd":
            // $usages = getTableFiltereddc("contract_usages", "contractid", $_GET['contractid']);
            $usages = getTableFiltereddc("contract_usages", "contractid", $_GET['contractid'], "", "", "*", "id", "DESC");
            $usage = getRowById("contract_usages", $_GET['contractid']);
            $usage_page_report_dropdown_data = get_usage_report_data($_GET['contractid']);

            $filter_usage_data = [];
            foreach ($usage_page_report_dropdown_data as $usage_report) {
                $filter_data = [];
                foreach ($usage_report as $key => $value) {
                    if (!is_int($key)) {
                        $filter_data[$key] =  $value;
                    }
                }
                $filter_usage_data[] = $filter_data;
            }
            $usage_page_report_dropdown = $filter_usage_data;

            $contractid = $_GET['contractid'];
            $contractno = getSingleValue('contract', 'contractno', $contractid);
            $clientid = getSingleValue('contract', 'clientid', $contractid);
            $clients = getTable("clients");
            break;
        case "contractUsageEdit":
            $usage = getRowById("contract_usages", $_GET['id']);
            $contractid = $usage['contractid'];
            $usage_page_report_dropdown_data = get_usage_report_data($contractid);

            $filter_usage_data = [];
            foreach ($usage_page_report_dropdown_data as $usage_report) {
                $filter_data = [];
                foreach ($usage_report as $key => $value) {
                    if (!is_int($key)) {
                        $filter_data[$key] =  $value;
                    }
                }
                $filter_usage_data[] = $filter_data;
            }
            $usage_page_report_dropdown = $filter_usage_data;
            $clients = getTable("clients");
            //            $projects = getTable("projects");
            //            $admins = getTableFiltered("people", "type", "admin");
            break;

        case "basic_chargies":
            $usage = getRowByBasicformId("print_chargies", $_GET['contractid']);
            break;

        case "extra_basic_chargies":
            $usage = getRowByBasicformId("print_chargies", $_GET['contractid']);
            break;

        case "extra_text_chargies":
            $usage = getRowByBasicformId("print_chargies", $_GET['contractid']);
            break;
        case "contractUsageDelete":
            $issue = getRowById("contract_usages", $_GET['id']);
            break;
        case "ticketAdd":
            $assets = getTable("assets");
            $clients = getTable("clients");
            $admins = getTableFiltered("people", "type", "admin");
            $users = getTableFiltered("people", "type", "user");
            $contracts = getTableFiltered("contract", "clientid", $_GET['routeid']);
            $subject = getTable("ticketsubject");
            break;

        case "ticketEdit":
            $ticket = getRowById("tickets", $_GET['id']);
            $assets = getTable("assets");
            // $clients = getTable("clients");
            $admins = getTableFiltered("people", "type", "admin");
            $users = getTableFiltered("people", "type", "user");
            //	$subject = getTable("ticketsubject");
            $query = $database->query("SELECT * from ticketsubject ORDER BY subject ASC");
            $subject = $query->fetchAll();
            $query1 = $database->query("SELECT * from clients ORDER BY name ASC");
            $clients = $query1->fetchAll();
            $query2 = $database->query("SELECT * from people where type = 'admin' ORDER BY name ASC");
            $admins = $query2->fetchAll();
            $query3 = $database->query("SELECT * from people where type = 'user' ORDER BY name ASC");
            $users = $query3->fetchAll();
            break;
        case "ticketReport":
            $ticket = getRowById("tickets", $_GET['id']);
            $assets = getTable("assets");
            $clients = getTable("clients");
            $admins = getTableFiltered("people", "type", "admin");
            $users = getTableFiltered("people", "type", "user");
            break;
        case "ticketDelete":
            $ticket = getRowById("tickets", $_GET['id']);
            break;
        case "contractTicketAdd":
            //$contracts = getTableFiltered("contract", 'clientid', $_GET['clientid']);
            $query = $database->query(
                "SELECT contract.id,contract.contractno,contract.department, assets.tag as asset_tag, assets.serial, models.name as asset_model "
                    . "FROM contract "
                    . "LEFT JOIN assets ON assets.id = contract.assetid "
                    . "LEFT JOIN models ON assets.modelid = models.id "
                    . "WHERE contract.clientid=" . $_GET["clientid"] . " AND contract.is_end=0"
                    . " ORDER BY contract.id DESC"
            );
            $subject = getTable("ticketsubject");

            //$query = $database->query("SELECT id , contractno FROM contract WHERE clientid=" . $_GET["clientid"]);
            $contracts = $query->fetchAll();
            $clients = getTable("clients");
            $admins = getTableFiltered("people", "type", "admin");
            $users = getTableFiltered("people", "type", "user");
            break;
        case "contractconsumableAdd":
            $query = $database->query(
                "SELECT contract.id,contract.contractno,contract.department, assets.tag as asset_tag, assets.serial, models.name as asset_model "
                    . "FROM contract "
                    . "LEFT JOIN assets ON assets.id = contract.assetid "
                    . "LEFT JOIN models ON assets.modelid = models.id "
                    . "WHERE contract.clientid=" . $_GET["clientid"] . " AND contract.is_end=0"
                    . " ORDER BY contract.id DESC"
            );
            $consumable = getTable("consumable_list");
            $contracts = $query->fetchAll();
            $admins = getTableFiltered("people", "type", "admin");
            break;
        case "contractconsumabletEdit":
            $consumabledata = getRowById("consumable", $_GET['id']);
            $consumable = getTable("consumable_list");
            $contracts = getTableFiltered("contract", 'clientid', $consumabledata['client_id']);
            $admins = getTableFiltered("people", "type", "admin");
            break;
        case "contractTicketEdit":
            $ticket = getRowById("tickets", $_GET['id']);
            //$contractid = $ticket['contractid'];
            $contracts = getTableFiltered("contract", 'clientid', $ticket['clientid']);
            $clients = getTable("clients");
            $admins = getTableFiltered("people", "type", "admin");
            $users = getTableFiltered("people", "type", "user");
            $subject = getTable("ticketsubject");
            break;
        case "contractTicketDelete":
            $ticket = getRowById("tickets", $_GET['id']);
            break;
        case "clientAssignAdmin":
            $admins = getTableFiltered("people", "type", "admin");
            break;
        case "clientUnassignAdmin":
            $clientsadmins = getRowById("clients_admins", $_GET['id']);
            break;
        case "slidegroupedit":
            $categoryGroup = getRowById("slider_group", $_GET['id']);
            break;
        case "assetAssignLicense":
            $licenses = getTable("licenses");
            break;
        case "assetUnassignLicense":
            $licensesassets = getRowById("licenses_assets", $_GET['id']);
            break;
        case "licenseAssignAsset":
            $assets = getTable("assets");
            break;
        case "licenseUnassignAsset":
            $licensesassets = getRowById("licenses_assets", $_GET['id']);
            break;
        case "assetDelete":
            $asset = getRowById("assets", $_GET['id']);
            break;
        case "warantyDelete":
            $asset = getRowById("warranty", $_GET['id']);
            break;
        case "contractDelete":
            $contract = getRowById("contract", $_GET['contractid']);
            break;
        case "licenseDelete":
            $license = getRowById("licenses", $_GET['id']);
            break;
        case "notificationTemplate":
            if (isset($_GET['clientid'])) {
                $clientid = $_GET['clientid'];
            }
            $template = getRowById("notificationtemplates", $_GET['id']);
            break;
        case "invoiceTemplate":
            // $template = getRowById("invoicetemplate", $_GET['id']);
            $template = getRowById("notificationtemplates", $_GET['id']);
            break;
        case "clientinvoiceTemplate":
            $people = getTableFiltered("people", "clientid", $_GET['client_id']);
            $template = getRowById("notificationtemplates", $_GET['id']);
            $invoice_id = $_GET['invoice_id'];
            break;
        case "clientinvoiceCollectionFollowupTemplate":
            $people = getTableFiltered("people", "clientid", $_GET['client_id']);
            $template = getRowById("notificationtemplates", $_GET['id']);
            $invoice_id = $_GET['invoice_id'];
            break;
        case "clienttaxFileTemplate":
            $people = getTableFiltered("people", "clientid", $_GET['client_id']);
            $template = getRowById("notificationtemplates", $_GET['id']);
            $invoice_id = $_GET['invoice_id'];
            break;
        case "clientOrFileTemplate":
            $people = getTableFiltered("people", "clientid", $_GET['client_id']);
            $template = getRowById("notificationtemplates", $_GET['id']);
            $invoice_id = $_GET['invoice_id'];
            break;
        case "clienttaxpaidFileTemplate":
            $people = getTableFiltered("people", "clientid", $_GET['client_id']);
            $template = getRowById("notificationtemplates", $_GET['id']);
            $invoice_id = $_GET['invoice_id'];
            break;
        case "projectAdd":
            $clients = getTable("clients");
            break;
        case "projectEdit":
            $project = getRowById("projects", $_GET['id']);
            $clients = getTable("clients");
            break;
        case "projectDelete":
            $project = getRowById("projects", $_GET['id']);
            break;
        case "projectAssignAdmin":
            $admins = getTableFiltered("people", "type", "admin");
            break;
        case "projectUnassignAdmin":
            $projectadmins = getRowById("projects_admins", $_GET['id']);
            break;
        case "contractHistoryEdit":
            $assets = getTable('assets');
            $history = getRowById("contract_history", $_GET['historyid']);
            break;
        case "contractHistoryDelete":
            $history = getRowById("contract_history", $_GET['historyid']);
            break;
        case "assetUsageEdit":
            $assets = getRowById("assets", $_GET['id']);
            break;
        case "slidenotice":
            $contracttype = getTable("slider_notice");
            break;
        case "kb/editCategory":
            $kbcategory = getRowById("kb_categories", $_GET['id']);
            $selectedClients = array();
            if ($kbcategory['clients'] != "") $selectedClients = unserialize($kbcategory['clients']);
            $clients = getTable("clients");
            break;
        case "kb/addCategory":
            $kbcategory = getRowById("clients", $_GET['id']);
            $selectedClients = array();
            if ($kbcategory['clients'] != "") $selectedClients = unserialize($kbcategory['clients']);
            $clients = getTable("clients");
            break;
        case "kb/addArticle":
            $kbcategories = getTable("kb_categories");
            $clients = getTable("clients");
            $models = getTable("models");

            break;
        case "kb/viewArticle":
            $kbarticle = getRowById("kb_articles", $_GET['id']);
            break;
        case "kb/editArticle":
            $kbarticle = getRowById("kb_articles", $_GET['id']);
            $selectedClients = array();
            if ($kbarticle['clients'] != "") $selectedClients = unserialize($kbarticle['clients']);
            $kbcategories = getTable("kb_categories");
            $clients = getTable("clients");
            $models = getTable("models");
            break;
        case "getTicketAllReply":
            $tid = $_GET['id'];
            $query3 = $database->query("SELECT * from tickets_replies where ticketid = '$tid' ORDER BY id DESC");
            $reply = $query3->fetchAll();
            break;

        case "emailtempletecategoryView":
            $templete = getRowById("emailtempletecategory", $_GET['id']);
            break;
        case "emailtempletecategoryEdit":
            $templete = getRowById("emailtempletecategory", $_GET['id']);
            break;
        case "editinvoice_payment":
            $invoice = getTableFiltered("invoice", "id", $_GET['id']);
            $active_contracts = getTableFiltered("contract", "clientid", $invoice[0]['clintid'], "is_end", 0);
            $client = getRowById("clients", $invoice[0]['clintid']);
            break;
    }
}

##### GET THE DATA #####
// SEARCH
if ($route == "search") {
    $assets = $database->select("assets", "*", ["OR" => [
        "purchase_date[~]" => $_GET['q'],
        "tag[~]" => $_GET['q'],
        "name[~]" => $_GET['q'],
        "serial[~]" => $_GET['q'],
        "notes[~]" => $_GET['q']
    ]]);
    $licenses = $database->select("licenses", "*", ["OR" => [
        "tag[~]" => $_GET['q'],
        "name[~]" => $_GET['q'],
        "serial[~]" => $_GET['q'],
        "notes[~]" => $_GET['q']
    ]]);
    $clients = $database->select("clients", "*", ["OR" => [
        "name[~]" => $_GET['q']
    ]]);
    $tickets = $database->select("tickets", "*", ["OR" => [
        "ticket[~]" => $_GET['q'],
        "subject[~]" => $_GET['q']
    ]]);
    $issues = $database->select("issues", "*", ["OR" => [
        "name[~]" => $_GET['q'],
        "description[~]" => $_GET['q']
    ]]);
    $projects = $database->select("projects", "*", ["OR" => [
        "tag[~]" => $_GET['q'],
        "name[~]" => $_GET['q'],
        "notes[~]" => $_GET['q'],
        "description[~]" => $_GET['q']
    ]]);
}

if ($route == "invoice/checkinvoiceid") {
    global $database;
    $id = $_POST['id'];
    $countInvoiceNo = countTableFiltered("invoice", "invoiceno", $id);
    echo $countInvoiceNo;
    exit;
}

if ($route == "invoice/checkEditinvoiceid") {
    global $database;
    $id = $_POST['id'];

    $invId = getSingleValue("invoice", "invoiceno", $_POST['invoiceid']);

    if ($invId == $id) {
        $countInvoiceNo = 0;
    } else {
        $countInvoiceNo = countTableFiltered("invoice", "invoiceno", $id);
    }

    echo $countInvoiceNo;
    exit;
}

if ($route == "pdf/allinvoice") {
    global $database, $mpdf, $scriptpath;

    $invoiceIds = explode(",", $_GET['invoice_id']);
    $totalInvoices = count($invoiceIds);

    foreach ($invoiceIds as $index => $invoiceId) {
        ob_start(); // Start output buffering for each iteration

        $invoice = getTableFiltered("invoice", "id", $invoiceId);
        $clientname = getSingleValue("clients", "name", $invoice[0]['clintid']);
        $contract_id = $invoice[0]['invoice_contract_id'];
        $invoice_datas = getinvoiceFiltered("contract", $contract_id);
        $logo = $database->get("config", "value", ["name" => "logo"]);
        $html = '';
        include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.php');
        $html = ob_get_clean(); // Get and clean the current buffer content
        $mpdf->WriteHTML($html);

        if ($index < $totalInvoices - 1) {
            $mpdf->AddPage();
        }
    }

    $pdfFilePath = "invoice_all.pdf";
    $mpdf->Output($pdfFilePath, "I");
    ini_set('memory_limit', '64M');
    exit;
}



if ($route == "contract/show_contarct_image") {

    $usage =  getRowById("contract_usages", $_GET['id']);


    $usage = getRowById("contract_usages", $_GET['id']);
    $html = "";

    if (!empty($usage['attachment'])) {
        $attachmentArray = unserialize($usage['attachment']);
        global $scriptpath;

        $host = $_SERVER['HTTP_HOST'];
        $host_upper = strtoupper($host);
        $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $baseurl = "http://" . $host . $path . "/";
        $targetdir = $baseurl . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'usage_file_attachment' . DIRECTORY_SEPARATOR;

        foreach ($attachmentArray as $filename) {
            $imagePath = $targetdir . $filename;
            $from = preg_replace('/\.[^.]+$/', '', $filename);
            $class_file = pathinfo($filename, PATHINFO_FILENAME);

            if ($imagePath && $filename) {
                $html .= '<div class="usuageimageList_' . $class_file . '"><br>';
                $html .= '<a href="' . $imagePath . '" target="_blank">' . $filename . ' </a> ';
                $html .= '<a class="btn btn-default btn-sm" href="#" data-id="' . $contract['id'] . '" onClick="DeleteImageContarct(`' . $filename . '`, ' . $usage['id'] . '); return false;">X</a>';
                $html .= '</div>';
            }
        }
    } else {
        // No attachments found
        $html .= '<div class="usuageimageList_' . $class_file . '"><p>No File Attached</p><div>';
    }

    echo $html;
    exit;
}




// GENERAL
$openTicketsCount = $database->count("tickets", ["status" => ["Open"]]);
$pendingTicketsCount = $database->count("tickets", ["status[!]" => ["Closed"]]);
$followTicketsCount = $database->count("tickets", ["status" => ["Followed Up"]]);
$inprogressTicketsCount = $database->count("tickets", ["status" => ["In Progress"]]);
$reopenedCount = $database->count("tickets", ["status" => ["Reopened"]]);
//die("here");

$overdueIssues = $database->count("issues", ["AND" => ["status[!]" => "Done", "duedate[<]" => date("Y-m-d"), "duedate[!]" => ""]]);

// DASHBOARD
if ($route == "dashboard") {

    global $database;
    $uid =  $lia['id'];
    $select1 = "SELECT role "
        . "FROM people "

        . "WHERE id =" . $uid;
    $query1 = $database->query($select1);
    $userrole = $query1->fetchAll();
    if ($userrole[0]['role'] == 'technician') {
        $sumAssets = countTable("assets");
        $sumLicenses = countTable("licenses");
        $sumProjects = countTable("projects");
        // $sumClients = countTable("clients");
        $sumClients = countTableFiltered("clients", "is_active", 1);
        

        $sumUsers = countTableFiltered("people", "type", "user");
        $sumContract = countTableFiltered("contract", "is_end", 0);


        $categories = getTable("assetcategories");
        $myIssues = $database->select("issues", "*", ["AND" => ["status[!]" => "Done", "adminid" => $lia['id']]]);
        //    $openTickets = $database->select("tickets", "*", ["status" => ["Open", "Reopened"]]);
        $recentAssets = $database->select("assets", "*", ["ORDER" => "id DESC", "LIMIT" => 5]);
        //$recentContracts = $database->select("contract", "*", ["ORDER" => "id DESC", "LIMIT" => 5]);
        $recentLicenses = $database->select("licenses", "*", ["ORDER" => "id DESC", "LIMIT" => 5]);
        $select = "SELECT contract.id contractid,contract.contractno,assetcategories.name as servicetype,assetcategories.color as servicecolor, clients.name clientname, assets.tag,assets.serial, models.name as modelname "
            . "FROM contract "
            . "JOIN assets ON assets.id = contract.assetid "
            . "JOIN models ON assets.modelid = models.id "
            . "JOIN assetcategories ON assetcategories.id = contract.categoryid "
            . "JOIN clients ON clients.id = contract.clientid "
            . "WHERE contract.id is not null ORDER BY contract.id DESC 
            LIMIT 30
            ";
        //    die($select);
        $query = $database->query($select);
        $recentContracts = $query->fetchAll();

        $select = "SELECT tickets.* "
            . "FROM tickets "
            // . "JOIN contract ON contract.id = tickets.contractid "
            // . "JOIN assets ON assets.id = contract.assetid "
            // . "JOIN models ON assets.modelid = models.id "
            // . "JOIN clients ON clients.id = tickets.clientid "

            . "WHERE (tickets.adminid= " . $uid . " AND (tickets.status='Open' OR tickets.status='Reopened'  OR tickets.status='Followed Up' OR tickets.status='In Progress') )ORDER BY tickets.id DESC ";
        //  die($select);
        $query = $database->query($select);
        $openTickets = $query->fetchAll();
        $role = $userrole[0]['role'];
    } else {

        $sumAssets = countTable("assets");
        $sumLicenses = countTable("licenses");
        $sumProjects = countTable("projects");
        // $sumClients = countTable("clients");
        $sumClients = countTableFiltered("clients", "is_active", 1);
        $sumUsers = countTableFiltered("people", "type", "user");
        $sumContract = countTableFiltered("contract", "is_end", 0);
        $sumpulloutasst = countTableFiltered("assets", "status", "For Pullout");
        $sumonhold = countTableFiltered("assets", "status", "On Hold");
        $categories = getTable("assetcategories");
        $user_complains = get_complain_list();
        $myIssues = $database->select("issues", "*", ["AND" => ["status[!]" => "Done", "adminid" => $lia['id']]]);
        //    $openTickets = $database->select("tickets", "*", ["status" => ["Open", "Reopened"]]);
        $recentAssets = $database->select("assets", "*", ["ORDER" => "id DESC", "LIMIT" => 5]);
        //$recentContracts = $database->select("contract", "*", ["ORDER" => "id DESC", "LIMIT" => 5]);
        $recentLicenses = $database->select("licenses", "*", ["ORDER" => "id DESC", "LIMIT" => 5]);
        $select = "SELECT contract.id contractid,contract.contractno,assetcategories.name as servicetype,assetcategories.color as servicecolor, clients.name clientname, assets.tag,assets.serial, models.name as modelname "
            . "FROM contract "
            . "JOIN assets ON assets.id = contract.assetid "
            . "JOIN models ON assets.modelid = models.id "
            . "JOIN assetcategories ON assetcategories.id = contract.categoryid "
            . "JOIN clients ON clients.id = contract.clientid "
            . "WHERE contract.id is not null ORDER BY contract.id DESC 
            LIMIT 30
            ";
        //    die($select);
        $query = $database->query($select);
        $recentContracts = $query->fetchAll();

        $select = "SELECT tickets.*, clients.name clientname, assets.tag,assets.serial, models.name as modelname "
            . "FROM tickets "
            . "JOIN contract ON contract.id = tickets.contractid "
            . "JOIN assets ON assets.id = contract.assetid "
            . "JOIN models ON assets.modelid = models.id "
            . "JOIN clients ON clients.id = tickets.clientid "
            . "WHERE (tickets.status='Open' OR tickets.status='Reopened'  OR tickets.status='Followed Up' OR tickets.status='In Progress') ORDER BY tickets.id DESC ";
        //die($select);
        $query = $database->query($select);
        $openTickets = $query->fetchAll();
    }

    $query = $database->query("SELECT *
        FROM tickets
        ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC");
    $tickets = $query->fetchAll();



    $query4 = $database->query("
        SELECT * 
        FROM tickets
        WHERE adminid = " . $lia['id'] . "
        ORDER BY  
            CASE 
                WHEN status = 'open' THEN UNIX_TIMESTAMP(timestamp)
            END,
            CASE 
                WHEN status <> 'open' THEN UNIX_TIMESTAMP(timestamp)
            END DESC
    ");
    $assigntickets = $query4->fetchAll();

    $query5 = $database->query("
        SELECT technician_report.*, 
            people.name AS technician_name, 
            tickets.contractid, 
            clients.name AS company, 
            models.name AS model_name
        FROM technician_report
        JOIN people ON technician_report.technician_id = people.id
        JOIN tickets ON technician_report.ticketid = tickets.id
        JOIN clients ON tickets.clientid = clients.id
        LEFT JOIN models ON technician_report.modelid = models.id
        ORDER BY technician_report.id DESC
        LIMIT 30
    ");

    $technicain_report = $query5->fetchAll();


    //cs_debug($openTickets);
}

if ($route == "page_count_report") {
    global $database;
    $client_sql = "SELECT
            clients.id AS clients_id,
            clients.name AS client_name,
            contract.contractno AS contractno,
            contract.id AS contractid,
            usage_report.*
            FROM
                `clients`
            JOIN contract ON contract.clientid = clients.id
            JOIN usage_report ON usage_report.clientid = clients.id
            WHERE";
    // JOIN usage_report ON usage_report.clientid = clients.id AND usage_report.contract_id = contract.id

    if (isset($_GET['client_id']) && $_GET['client_id'] != '' && isset($_GET['year_month']) && $_GET['year_month'] != '') {
        $client_sql .= " clients.is_active = 1  AND clients.id =" . $_GET['client_id'] . " AND usage_report.ref_no LIKE '%" . $_GET['year_month'] . "%'";
    } else if (isset($_GET['client_id']) && $_GET['client_id'] != '') {
        $client_sql .= " clients.is_active = 1  AND clients.id =" . $_GET['client_id'];
    } else if (isset($_GET['year_month']) && $_GET['year_month'] != '') {
        $client_sql .= " clients.is_active = 1  AND usage_report.ref_no LIKE '%" . $_GET['year_month'] . "%'";
    } else {
        $client_sql .= " clients.is_active = 1 ";
    }

    $client_sql .= " GROUP BY usage_report.id";

    $query = $database->query($client_sql);
    $page_count_report_data = $query->fetchAll();
    $client_dropdown_list = get_active_client('name');
}

if ($route == "invoice/search_invoice") {

    $checked = isset($_GET['checked']) && $_GET['checked'] == 1 ? $_GET['checked'] : 0;
    global $database;
    if (isset($_GET['year_month'])) {
        $year_month = $_GET['year_month'];
        $where = " WHERE invoice.ref_no LIKE '%" . $year_month . "%'";
    } else {
        $where = '';
    }
    if ($where == '') {
        $where .= ' WHERE invoice.confirmed != 1 OR invoice.confirmed IS NULL';
    }
    if ($checked == 1) {
        $where = ' WHERE invoice.confirmed = 1';
    }
    $invoice_query = "SELECT invoice.* , clients.name AS clintName 
    FROM invoice 
    JOIN clients ON clients.id = invoice.clintid 
    " . $where . " 
    ORDER BY clintName ASC";
    $query = $database->query($invoice_query);
    $invoice_data = $query->fetchAll();
    $client_ids = [];
    $total_amount = 0;
    foreach ($invoice_data as $key => $value) {
        $client_ids[] = $value['clintid'];
        $total_amount += $value['amount'];
    }
    $client_counts = count(array_unique($client_ids));
    // 1
    $clients = getTableFilteredsorbynm("clients", 'is_active', 1);

    $licenses_amount_total = 0;
    $total1 = 0;
    foreach ($clients as $each_client) {
        $get_license_data = get_licenses_by_client($each_client['id']);
        $total1 += getTotalAmount("contract", "contract_amount", "clientid", $each_client['id'], "is_end", 0);
        if (!empty($get_license_data)) {
            foreach ($get_license_data as $each_license) {
                $licenses_amount_total += $each_license['amount'];
            }
        }
    }
    $total_amount_text = $total1 + $licenses_amount_total;
    // 1
    $client_counts_1 = count($clients);
    $coto = get_sale_report_amount(false);
    $coto_1 = get_sale_report_amount(true);
    $notificationtemplates = getTableFiltered("notificationtemplates", "type", "emailtemplete");
}


if ($route == "invoice/receive_invoice") {
    // echo '<pre>';
    // print_r($_GET);
    // die;
    $paid = isset($_GET['paid']) && $_GET['paid'] == 1 ? $_GET['paid'] : 0;
    $not_paid = isset($_GET['not_paid']) && $_GET['not_paid'] == 1 ? $_GET['not_paid'] : 0;
    $all = isset($_GET['all']) && $_GET['all'] == 1 ? $_GET['all'] : 0;
    global $database;
    if (isset($_GET['year_month'])) {
        $year_month = $_GET['year_month'];
        $where = " WHERE invoice.ref_no LIKE '%" . $year_month . "%'";
    } else {
        $where = '';
    }
    if ($paid == 1) {
        $where = ' WHERE invoice.paid > 0';
    }

    if ($not_paid == 1) {
        $where = ' WHERE invoice.paid = 0 OR invoice.paid IS NULL';
    }

    if ($all == 1) {
        $where = '';
    }

    if ($where == '' && $all == 0) {
        $where = ' WHERE invoice.paid = 0 OR invoice.paid IS NULL';
    }
   
    $invoice_query = "SELECT invoice.* , clients.name AS clintName 
    FROM invoice 
    JOIN clients ON clients.id = invoice.clintid 
    " . $where . " 
    ORDER BY clintName ASC";
    $query = $database->query($invoice_query);
    $invoice_data = $query->fetchAll();
    $client_ids = [];
    $total_amount = 0;
    $total_balance = 0;
    foreach ($invoice_data as $key => $value) {
        $client_ids[] = $value['clintid'];
        $total_amount += $value['amount'];
        $total_balance += $value['balance'];
    }
    $client_counts = count(array_unique($client_ids));
    $coto = get_sale_report_amount();
    $notificationtemplates = getTableFiltered("notificationtemplates", "type", "emailtemplete");
}

if ($route == "invoice/with_holding_2307_wht") {
    $paid = isset($_GET['paid']) && $_GET['paid'] == 1 ? $_GET['paid'] : 0;
    global $database;
    if (isset($_GET['year_month'])) {
        $year_month = $_GET['year_month'];
        $where = " WHERE invoice.ref_no LIKE '%" . $year_month . "%'";
    } else {
        $where = '';
    }
    if ($paid == 1) {
        $where = ' WHERE invoice.paid > 0';
    }
    $invoice_query = "SELECT invoice.* , clients.name AS clintName 
    FROM invoice 
    JOIN clients ON clients.id = invoice.clintid 
    " . $where . " 
    ORDER BY clintName ASC";
    $query = $database->query($invoice_query);
    $invoice_data = $query->fetchAll();
    $client_ids = [];
    $total_amount = 0;
    foreach ($invoice_data as $key => $value) {
        $client_ids[] = $value['clintid'];
        $total_amount += $value['amount'];
    }
    $client_counts = count(array_unique($client_ids));
    $coto = get_sale_report_amount();
    $notificationtemplates = getTableFiltered("notificationtemplates", "type", "emailtemplete");
}

if ($route == "invoice/2307_wht") {
    $wht_checked = isset($_GET['2307_wht_checked']) && $_GET['2307_wht_checked'] == 1 ? $_GET['2307_wht_checked'] : 0;
    global $database;
    if (isset($_GET['year_month'])) {
        $year_month = $_GET['year_month'];
        $where = " WHERE invoice.ref_no LIKE '%" . $year_month . "%'";
    } else {
        $where = '';
    }
    if ($where == '') {
        $where .= ' WHERE invoice.cleared = 0';
    }
    if ($wht_checked == 1) {
        $where = ' WHERE invoice.cleared = 1';
    }
    $invoice_query = "SELECT invoice.* , clients.name AS clintName 
    FROM invoice 
    JOIN clients ON clients.id = invoice.clintid 
    " . $where . " 
    ORDER BY clintName ASC";
    $query = $database->query($invoice_query);
    $invoice_data = $query->fetchAll();
    $client_ids = [];
    $total_amount = 0;
    foreach ($invoice_data as $key => $value) {
        $client_ids[] = $value['clintid'];
        $total_amount += $value['amount'];
    }
    $client_counts = count(array_unique($client_ids));
    $coto = get_sale_report_amount();
}

if ($route == "invoice/invoicing_2") {
    global $database;
    if (isset($_GET['year_month'])) {
        $year_month = $_GET['year_month'];
        $invoice_query = "SELECT * FROM invoice WHERE ref_no LIKE '%" . $year_month . "%'";
        $query = $database->query($invoice_query);
        $invoice_data = $query->fetchAll();
        $client_ids = [];
        $total_amount = 0;
        foreach ($invoice_data as $key => $value) {
            $client_ids[] = $value['clintid'];
            $total_amount += $value['amount'];
        }
        $client_counts = count(array_unique($client_ids));
    }
    $coto = get_sale_report_amount();
}

if ($route == 'invoice_export') {
    // if (isset($_GET['year_month'])) {
    //     $year_month = $_GET['year_month'];
    //     $client_sql =  "SELECT * FROM invoice WHERE ref_no LIKE '%" . $year_month . "%'";
    //     $query = $database->query($client_sql);
    //     $invoice_data = $query->fetchAll();
    // }

    if (isset($_GET['over_due_date'])) {
        $over_due_date = $_GET['over_due_date'];
    }

    if (isset($_GET['year_month'])) {
        $year_month = $_GET['year_month'];
        $where = " WHERE invoice.ref_no LIKE '%" . $year_month . "%'";
    } else {
        $where = '';
    }
    // if ($where == '') {
    //     $where .= ' WHERE invoice.confirmed != 1 OR invoice.confirmed IS NULL';
    // }

    $paid = isset($_GET['paid']) && $_GET['paid'] == 1 ? $_GET['paid'] : 0;
    $not_paid = isset($_GET['not_paid']) && $_GET['not_paid'] == 1 ? $_GET['not_paid'] : 0;
    $all = isset($_GET['all']) && $_GET['all'] == 1 ? $_GET['all'] : 0;

    if ($paid == 1) {
        $where = ' WHERE invoice.paid > 0';
    }

    if ($not_paid == 1) {
        $where = ' WHERE invoice.paid = 0 OR invoice.paid IS NULL';
    }

    if ($all == 1) {
        $where = '';
    }

    $invoice_query = "SELECT invoice.* , clients.name AS clintName
    FROM invoice 
    JOIN clients ON clients.id = invoice.clintid 
    " . $where . " 
    ORDER BY clintName ASC";

    $query = $database->query($invoice_query);
    $invoice_data = $query->fetchAll();

    $records = array();
    if (isset($invoice_data) && !empty($invoice_data)) {
        $n = 1;
        foreach ($invoice_data as $invoice) {
            $invoice_date = format_date_to_ymd($invoice['date']);
            $o_d = calculateDateDifference($over_due_date, $invoice_date);
            $is_duplicate = check_dup_invoice($invoice_data, $invoice['ref_no'], $invoice['clintid'], $invoice['month'], $invoice['id'], $invoice['date']);
            if ($is_duplicate) {
                $dup_html = "Duplicate";
            } else {
                $dup_html = "";
            }

            $month_name = "";
            if ($invoice['month'] == 1) {
                $month_name = "Jan";
            } elseif ($invoice['month'] == 2) {
                $month_name = "Feb";
            } elseif ($invoice['month'] == 3) {
                $month_name = "Mar";
            } elseif ($invoice['month'] == 4) {
                $month_name = "Apr";
            } elseif ($invoice['month'] == 5) {
                $month_name = "May";
            } elseif ($invoice['month'] == 6) {
                $month_name = "Jun";
            } elseif ($invoice['month'] == 7) {
                $month_name = "Jul";
            } elseif ($invoice['month'] == 8) {
                $month_name = "Aug";
            } elseif ($invoice['month'] == 9) {
                $month_name = "Sep";
            } elseif ($invoice['month'] == 10) {
                $month_name = "Oct";
            } elseif ($invoice['month'] == 11) {
                $month_name = "Nov";
            } elseif ($invoice['month'] == 12) {
                $month_name = "Dec";
            }
            $client = getSingleValue("clients", "name", $invoice['clintid']);
            $client_formated = $client;
            $client_tax_identification_number = getSingleValue("clients", "tax_identification_number", $invoice['clintid']);
            $data['#'] = $n;
            $data['Date'] = date('Y - m - d', strtotime($invoice['date']));;
            $data['Month'] = $month_name;
            $data['Dup'] = $dup_html;
            $data['Reference'] = $invoice['ref_no'];
            $data['Client'] = $client_formated;
            $data['Tax Identification Number'] = $client_tax_identification_number;
            $data['Invoice No'] = $invoice['invoiceno'];
            $data['INV Amount'] = number_format($invoice['amount'], 0, '.', ',');;
            $data['Payment Method'] = $invoice['payment_method'];
            $data['Payment Ref No'] = $invoice['payment_ref_no'];
            $data['Tax Amount'] = $invoice['tax_amount'];
            $data['OR Nnumber'] = $invoice['ornumber'];
            $data['Paid Amount'] = number_format($invoice['paid'], 0, '.', ',');
            $data['Balance'] = number_format($invoice['balance'], 0, '.', ',');
            $data['Over Due'] = $o_d;
            $data['Remark'] = $invoice['remark'];

            $records[] = $data;
            $n++;
        }

        if(isset($_GET['receivable']) && $_GET['receivable'] == 1){
            $filename = "Receivable.xls";
        }else{
            $filename = "Invoice.xls";
        }

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $heading = false;
        if (!empty($records))
            foreach ($records as $row) {
                if (!$heading) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }

        exit;
    }
}

if ($route == 'invoice_sales_report') {
    $defult_year = 0;
    $defult_month = 0;
    if (isset($_GET['tab2_month']) && $_GET['tab2_month'] != '') {
        $defult_month = $_GET['tab2_month'];
    }
    if (isset($_GET['tab1_year']) && $_GET['tab1_year'] != '') {
        $defult_year = $_GET['tab1_year'];
    }

    $export_sale_report_2 = export_sale_report_tab_2($defult_year, $defult_month);
    $defult_month = date("m", strtotime("first day of last month"));
    $export_sale_report = export_sale_report('', $defult_month);

    $records = array();
    if (isset($export_sale_report) && !empty($export_sale_report)) {
        $n = 1;
        foreach ($export_sale_report as $invoice) {
            // if (in_array($invoice['id'] , $export_sale_report_2)) {
            //     $invoiced_client = $latestInvoice['name'];
            //     $invoiced_amount = 0;
            $invoiced_client = '';
            $invoiced_amount = '';
            foreach ($export_sale_report_2 as $key => $value) {
                if (in_array($invoice['id'], $value)) {
                    $invoiced_client = $value['name'];
                    $invoiced_amount = $value['total_amount'];
                } else {
                    $invoiced_client = $invoice['name'];
                }
            }

            $data['#'] = $n;
            $data['Client'] = $invoice['name'];
            $data['Invoiced Client'] = $invoiced_client;
            $data['Invoiced Amount'] = $invoiced_amount > 0 ? $invoiced_amount : '';
            $records[] = $data;
            $n++;
        }
        $filename = "Invoice.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $heading = false;
        if (!empty($records))
            foreach ($records as $row) {
                if (!$heading) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }

        exit;
    }
}

if ($route == "missing_page_count") {
    global $database;
    // $client_sql = "SELECT
    //                 clients.id AS clients_id,
    //                 clients.name AS clients_name,
    //                 contract.contractno AS contractno

    //                     FROM
    //                 `clients`
    //                     JOIN contract ON contract.clientid = clients.id
    //                     (
    //                     SELECT * FROM usage_report WHERE usage_report.clientid = clients.id
    //                     )
    //                     WHERE
    //                 contract.is_end = 0 AND clients.is_active = 1
    //                     GROUP BY
    //                 contract.id";

    if (isset($_GET['year_month'])) {
        $year_month = $_GET['year_month'];
        $where = "AND contract.contract_condition = 'page_plan'";
        $client_sql =  "SELECT
     clients.id AS clients_id,
     clients.name AS clients_name,
     contract.contractno AS contractno,
     usage_report.ref_no,
     usage_report.date,
     usage_report.A3clr,
     usage_report.A3blk,
     usage_report.A4clr,
     usage_report.A4blk,
     usage_report.image,
     usage_report.modal_name,
     usage_report.department,
     usage_report.remark,
     usage_report.id AS usage_report_id,
     IFNULL(usage_report.id, 'No Usage Report') AS usage_report_status
        FROM
            clients
        JOIN
            contract ON contract.clientid = clients.id
        LEFT JOIN
            usage_report ON usage_report.contract_id = contract.id
        WHERE
            contract.is_end = 0
            AND clients.is_active = 1
            AND (usage_report.ref_no LIKE '%" . $_GET['year_month'] . "%' OR usage_report.ref_no IS NULL)
            " . $where . "
        GROUP BY
            contract.id
        ORDER BY
            clients.name ASC;";


        $query = $database->query($client_sql);
        $page_count_report_data = $query->fetchAll();
        $client_dropdown_list = get_active_client('name');
    }
}

if ($route == "technical") {
    $technician_id = isset($_GET['technician_id']) ? $_GET['technician_id'] : '';
    $from = isset($_GET['from']) ? $_GET['from'] : '';
    $to = isset($_GET['to']) ? $_GET['to'] : '';
    $where = '';
    if ($technician_id != '' && $from != '' && $to != '') {
        $where = "WHERE technician_report.technician_id = " . intval($technician_id) . 
             " AND technician_report.date BETWEEN '" . addslashes($from) . "' AND '" . addslashes($to) . "'";
    }elseif ($from != '' && $to != '') {
        $where = "WHERE technician_report.date BETWEEN '" . addslashes($from) . "' AND '" . addslashes($to) . "'";
    }elseif ($technician_id != '') {
        $where = "WHERE technician_report.technician_id = " . intval($technician_id);
    }
    global $database;

    $query1 = $database->query("
        SELECT technician_report.*, 
            people.name AS technician_name, 
            tickets.contractid, 
            clients.name AS company,
            models.name AS model_name
        FROM technician_report
        JOIN people ON technician_report.technician_id = people.id
        JOIN tickets ON technician_report.ticketid = tickets.id
        JOIN clients ON tickets.clientid = clients.id
        LEFT JOIN models ON technician_report.modelid = models.id ". $where ."
        ORDER BY technician_report.date DESC
        ");
    $technicain_report = $query1->fetchAll();

    $query2 = $database->query("SELECT * from people where role = 'technician' ORDER BY name ASC");
    $technician = $query2->fetchAll();
}

// technical_export

if ($route == "technical_export") {
    $technician_id = isset($_GET['technician_id']) ? $_GET['technician_id'] : '';
    $from = isset($_GET['from']) ? $_GET['from'] : '';
    $to = isset($_GET['to']) ? $_GET['to'] : '';
    $where = '';
    if ($technician_id != '' && $from != '' && $to != '') {
        $where = "WHERE technician_report.technician_id = " . intval($technician_id) . 
             " AND technician_report.date BETWEEN '" . addslashes($from) . "' AND '" . addslashes($to) . "'";
    }elseif ($from != '' && $to != '') {
        $where = "WHERE technician_report.date BETWEEN '" . addslashes($from) . "' AND '" . addslashes($to) . "'";
    }elseif ($technician_id != '') {
        $where = "WHERE technician_report.technician_id = " . intval($technician_id);
    }
    global $database;

    $query1 = $database->query("
        SELECT technician_report.*, 
            people.name AS technician_name, 
            tickets.contractid, 
            clients.name AS company,
            models.name AS model_name
        FROM technician_report
        JOIN people ON technician_report.technician_id = people.id
        JOIN tickets ON technician_report.ticketid = tickets.id
        JOIN clients ON tickets.clientid = clients.id
        LEFT JOIN models ON technician_report.modelid = models.id ". $where ."
        ORDER BY technician_report.date DESC
        ");
    $technicain_report = $query1->fetchAll();

    $records = array();
    if (isset($technicain_report) && !empty($technicain_report)) {
        $n = 1;
        foreach ($technicain_report as $report) {
            $data['#'] = $n;
            $data['Date & Time'] = date('Y-m-d', strtotime($report['date']));
            $data['Company'] = $report['company'];
            $data['Model'] = $report['model_name'];
            $data['Diagnose Comment'] = $report['diagnose_comment'];
            $data['Technician Comments'] = $report['technician_comment'];
            $data['Technician In Charge'] = $report['technician_name'];
            $records[] = $data;
            $n++;
        }
        $filename = "Technician's Field Report.xls";

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $heading = false;
        if (!empty($records))
            foreach ($records as $row) {
                if (!$heading) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }

        exit;
    }
}

// ASSETS

if ($route == "assets" && $_GET['cli']) {
    //$assets = getTableFiltered("assets", "clientid[<>]", [1,999998]);//getTable("assets");
    $assets = getTableFiltered2("assets", ["clientid" => [$_GET['cli']]], "*");
    $assettotalCount = $database->count("assets", ["clientid" => [$_GET['cli']]]);
} elseif ($route == "assets") {

    $assets = getTableFiltered2("assets", ["status" => ["In Service"]], "*");
    $assettotalCount = $database->count("assets", ["status" => ["In Service"]]);
}
if ($route == "assets/uwarranty" && $_GET['cli']) {
    $assets = getTableFiltered2("assets", ["clientid" => [$_GET['cli']]], "*");
    //$assets = getTableFiltered2("assets", ["status" => ["In Service"]], "*");

} elseif ($route == "assets/uwarranty") {
    $assets = getTableFiltered2("assets", ["status" => ["In Service"]], "*");
}

if ($route == "assets/warehouse" && $_GET['wh']) {
    $assets = getTableFiltered("assets", "status", "Available", "warehouseid", $_GET['wh']); //getTable("assets");
    // $assets_count = countTable("assets", "clientid", "0"); //getTable("assets");
    $assetstockwarehouseCount = $database->count("assets", ["status" => ["Available"]]);
} elseif ($route == "assets/warehouse") {

    $assets = getTableFiltered("assets", "status", "Available"); //getTable("assets");
    // $assets_count = countTable("assets", "clientid", "0"); //getTable("assets");
    $assetstockwarehouseCount = $database->count("assets", ["status" => ["Available"]]);
}

// if ($route == "invoice") {
//     $select1 = "SELECT * ". "FROM invoice ORDER BY id ASC";
//     $query1 = $database->query($select1);
//     $invoice = $query1->fetchAll();
// }

if ($route == "invoice") {


    if (isset($_GET['client_status'])) {
        $client_status = $_GET['client_status'];
        if ($client_status == 'active') {
            $where_sql = " WHERE clients.is_active = 1 ";
        }

        if ($client_status == 'inactive') {
            $where_sql = " WHERE clients.is_active = 0 ";
        }

        if ($client_status == 'all') {
            $where_sql = "";
        }
    }

    if (isset($_GET['client_type'])) {
        $client_type = $_GET['client_type'];
        if ($client_type != '' && $client_type != 'all') {
            $where_sql = " WHERE clients.clienttypes = $client_type ";
        } else {
            $where_sql = '';
        }
    }

    $unpaid = false;
    $paid = false;
    if (isset($_GET['payment_status'])) {
        $payment_status = $_GET['payment_status'];
        if ($payment_status == 'paid') {
            $where_sql = " WHERE invoice.paid > 0 ";
        }

        if ($payment_status == 'unpaid') {
            $where_sql = " WHERE invoice.paid = 0 ";
        }
        if ($payment_status == 'all') {
            $where_sql = "";
        }
        if ($payment_status == 'pending_tax_file') {
            $where_sql = " WHERE invoice.tax_file_2307 = '' OR invoice.tax_file_2307 IS NULL";
        }
    }

    if (isset($_GET['client'])) {
        $client = $_GET['client'];
        if ($client != '') {
            $where_sql = " WHERE invoice.clintid = $client";
        }
    }

    if (isset($_GET['clear_status'])) {
        $clear_status = $_GET['clear_status'];
        if ($clear_status != '' && $clear_status != 'all') {
            $where_sql = " WHERE invoice.cleared = $clear_status";
        }
    }



    if (isset($_GET['file_status'])) {
        $file_status = $_GET['file_status'];
        if ($file_status != '' && $file_status != 'all') {
            if ($file_status == 'attached') {
                $where_sql = " WHERE invoice.tax_file_2307 != '' ";
            }

            if ($file_status == 'not_attached') {
                $where_sql = " WHERE invoice.tax_file_2307 = '' OR invoice.tax_file_2307 IS NULL";
            }
        }
    }

    if (isset($_GET['ref_no'])) {
        $ref_no = $_GET['ref_no'];
        if ($ref_no != '') {
            $where_sql = " WHERE invoice.ref_no LIKE '%" . $ref_no . "%'";
        }
    }

    if (isset($_GET['client']) && isset($_GET['payment_status'])) {
        $client = $_GET['client'];
        $payment_status = $_GET['payment_status'];
        if ($client != '' && $payment_status != '') {
            $where_sql_1 = " WHERE invoice.clintid = $client";
            if ($payment_status == 'paid') {
                $where_sql_1 .= " AND invoice.paid > 0 ";
            }

            if ($payment_status == 'unpaid') {
                $where_sql_1 .= " AND invoice.paid = 0 ";
            }
            if ($payment_status == 'all') {
                $where_sql_1 .= "";
            }
            $where_sql = $where_sql_1;
        }
    }

    if (isset($_GET['date_received_from']) && isset($_GET['date_received_to']) && $_GET['date_received_from'] != '' && $_GET['date_received_to'] != '') {
        $where_sql = " WHERE invoice.date_payment_receive BETWEEN '" . $_GET['date_received_from'] . "' AND '" . $_GET['date_received_to'] . "'";
    } elseif (isset($_GET['date_received_from']) && $_GET['date_received_from'] != '') {
        $where_sql = " WHERE invoice.date_payment_receive >= '" . $_GET['date_received_from'] . "'";
    } elseif (isset($_GET['date_received_to']) && $_GET['date_received_to'] != '') {
        $where_sql = " WHERE invoice.date_payment_receive <= '" . $_GET['date_received_to'] . "'";
    }
    // echo '<pre>';
    // print_r($where_sql);
    // die;
    // $select1 = "SELECT invoice.*, clients.id AS client_id
    //             FROM invoice
    //             LEFT JOIN clients ON invoice.clintid = clients.id
    //             WHERE clients.is_active = 1
    //             $where_sql
    //             ORDER BY invoice.id ASC";
    if ($where_sql == '') {

        if (isset($_GET['payment_status'])) {
            $payment_status = $_GET['payment_status'];
            if ($payment_status == 'all') {
                $where_sql_1 .= "";
            } else {
                $where_sql_1 .= " AND invoice.paid = 0 ";
            }
        } else {
            $where_sql_1 .= " AND invoice.paid = 0 ";
        }
        $where_sql = $where_sql_1;
    }


    $select1 = "SELECT invoice.*, clients.id AS client_id 
    FROM invoice
    JOIN clients ON invoice.clintid = clients.id
    $where_sql
    ORDER BY invoice.id ASC";

    $totle_balance_sql = "SELECT SUM(invoice.balance) AS total_balance 
    FROM invoice
    JOIN clients ON invoice.clintid = clients.id
    $where_sql
    ORDER BY invoice.id ASC";


    $totle_balance_query = $database->query($totle_balance_sql);
    $totle_balance = $totle_balance_query->fetchAll();
    $totle_balance = isset($totle_balance[0]['total_balance']) ? $totle_balance[0]['total_balance'] : 0;

    $query1 = $database->query($select1);
    $invoices = $query1->fetchAll();
    $total_amount = 0;
    $total_paid = 0;
    $total_tax = 0;

    foreach ($invoices as $key => $value) {
        $total_amount += $value['amount'];
        $total_paid += $value['paid'];
        $total_tax += $value['tax_amount'];
    }
    $total_rec = $total_amount - $total_paid - $total_tax;

    $type_sql = "SELECT * FROM clienttype";
    $type_sql_query = $database->query($type_sql);
    $filter_type_data = $type_sql_query->fetchAll();

    $client_sql = "SELECT * FROM clients ORDER BY name ASC";
    $client_sql_query = $database->query($client_sql);
    $filter_client_data = $client_sql_query->fetchAll();
}

if ($route == "invoice/pendinginvoice") {
    $clients = getTableFilteredsorbynm("clients", 'is_active', 1);
    $clients_inact = getTableFilteredsorbynm("clients", 'is_active', 0);
    $tickets = getTable("tickets");

    $months = array(
        '1' => ['Jan', '#337ab7'],
        '2' => ['Feb', '#5cb85c'],
        '3' => ['Mar', '#5bc0de'],
        '4' => ['Apr', '#f0ad4e'],
        '5' => ['May', '#d9534f'],
        '6' => ['Jun', '#F2F271'],
        '7' => ['Jul', '#B26B07'],
        '8' => ['Aug', '#FC0000'],
        '9' => ['Sep', '#1FF21F'],
        '10' => ['Oct', '#42A6F7'],
        '11' => ['Nov', '#025191'],
        '12' => ['Dec', '#EA77F4'],
    );
}


if ($route == "assets/repair") {
    $assets = getTableFiltered("assets", "status", "Under Repair"); //
    $assetsdisposeCount = $database->count("assets", ["status" => ["Under Repair"]]);
}
if ($route == "assets/disposal") {
    $assets = getTableFiltered("assets", "status", "For Disposal"); //
    $assetsdisposeCount = $database->count("assets", ["status" => ["For Disposal"]]);
}
if ($route == "assets/pullout") {
    $assets = getTableFiltered("assets", "status", "For Pullout"); //
    $assetsdisposeCount = $database->count("assets", ["status" => ["For Pullout"]]);
}
if ($route == "assets/allaset") {
    $assets = getTable("assets");
    $assetCount = $database->count("assets");
}
if ($route == "assets/create" && $_GET['assettyp']) {


    $clients = getTable("clients");
    $warehouse = getTable("warehouse");
    $admins = getTableFiltered("people", "type", "admin");
    $users = getTableFiltered("people", "type", "user");
    $models = getTableFiltered("models", "manufacturerid", $_GET['assettyp']);
    $manufacturers = getTableasc("manufacturers");
    $categories = getTableasc("assetcategories");
    $labels = getTable("labels");
    $suppliers = getTable("suppliers");
} elseif ($route == "assets/create") {


    $clients = getTable("clients");
    $warehouse = getTable("warehouse");
    $admins = getTableFiltered("people", "type", "admin");
    $users = getTableFiltered("people", "type", "user");
    $models = '';
    $manufacturers = getTableasc("manufacturers");
    $categories = getTableasc("assetcategories");
    $labels = getTable("labels");
    $suppliers = getTable("suppliers");
}

if ($route == "assets/manage") {
    $asset = getRowById("assets", $_GET['id']);
    $warehouse = getTable("warehouse");
    $issues = getTableFiltered("issues", "assetid", $_GET['id']);
    $kb = getTableFiltered("kb", "assetid", $_GET['id']);
    $tickets = getTableFiltered("tickets", "assetid", $_GET['id']);
    $credentials = getTableFiltered("credentials", "assetid", $_GET['id']);
    $assignedlicenses = getTableFiltered("licenses_assets", "assetid", $_GET['id']);
    $clients = getTable("clients");
    $admins = getTableFiltered("people", "type", "admin");
    $users = getTableFiltered("people", "type", "user");
    $models = getTable("models");
    $manufacturers = getTable("manufacturers");
    $categories = getTable("assetcategories");
    $labels = getTable("labels");
    $licenses = getTable("licenses");
    $suppliers = getTable("suppliers");
    $files = getTableFiltered("files", "assetid", $_GET['id'], "file[!]", NULL);
    $asset_usages = getTableFiltered("asset_usages", "assetid", $_GET['id']);
}

if ($route == "allassetexport") {
    $asset = getTable("assets");
    $i = 0;
    $records = array();
    foreach ($asset as $assett) {
        if ($assett['clientid'] != 0) {
            $client = getSingleValue("clients", "name", $assett['clientid']);
        } else {
            $client = 'NONE';
        }
        $manufacturerid = getSingleValue("models", "manufacturerid", $assett['modelid']);

        $records[] = array("category" => getSingleValue("assetcategories", "name", $assett['categoryid']), "sku" => $assett['sku'], "client" => $client, "warehouse" => getSingleValue("warehouse", "name", $assett['warehouseid']), "manufacturer" => getSingleValue("manufacturers", "name", $manufacturerid), "model" => getSingleValue("models", "name", $assett['modelid']), "supplier" => getSingleValue("suppliers", "name", $assett['supplierid']), "service_status" => getSingleValue("labels", "name", $assett['statusid']), "purchase_date" => $assett['purchase_date'], "warranty_months" => $assett['warranty_months'], "warranty_expiry" => $assett['warranty_expiry'], "tag" => $assett['tag'], "name" => $assett['name'], "serial" => $assett['serial'], "caseserial" => $assett['caseserial'], "notes" => $assett['notes'], "invoice" => $assett['invoice'], "warranty_card" => $assett['warranty_card'], "asset_status" => $assett['status'], "remark" => $assett['remark']);
    }
    // echo'<pre>';
    // print_r($records);
    // echo'<pre>';
    // die('newwww');
    $filename = "Allasset.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $heading = false;
    if (!empty($records))
        foreach ($records as $row) {
            if (!$heading) {
                echo implode("\t", array_keys($row)) . "\n";
                $heading = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }

    exit;
}

if ($route == "allremarkexport") {
    $asset = getTable("assets");
    $i = 0;
    $records = array();
    foreach ($asset as $assett) {

        $records[] = array("sku" => $assett['sku'], "warehouse" => getSingleValue("warehouse", "name", $assett['warehouseid']), "model" => getSingleValue("models", "name", $assett['modelid']), "remark" => $assett['remark']);
    }
    $header[] = array("sku" => "Sku", "warehouse" => "Warehouse", "model" => "Model", "remark" => "Remark");
    $filename = "Remark.csv";
    $fp = fopen('php://output', 'w');
    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename=' . $filename);
    foreach ($header as $header) {
        fputcsv($fp, $header);
    }
    foreach ($records as $row) {
        fputcsv($fp, $row);
    }
    exit;
}

if ($route == "resetremark") {
    $empty = "";
    $database->update("assets", ["remark" => $empty]);
    header("Location:?route=assets/allaset&status=20");
}

// warranty
if ($route == "warranty"  && $_GET['stts']) {
    if ($_GET['stts'] != 0) {
        $assets = getTableFiltered("warranty", "status", $_GET['stts']);
    } else {
        $assets = getTableFiltered3("warranty", "*");
    }
    $wrtytotalCount = $database->count("warranty");
} elseif ($route == "warranty") {
    $assets = getTableFiltered3("warranty", "*");
    $wrtytotalCount = $database->count("warranty");
}



if ($route == "warranty/create" && $_GET['assettyp']) {

    $clients = getTable("clients");
    $warehouse = getTable("warehouse");
    $admins = getTableFiltered("people", "type", "admin");
    $users = getTableFiltered("people", "type", "user");
    $models = getTableFiltered("models", "manufacturerid", $_GET['assettyp']);
    $manufacturers = getTable("manufacturers");
    $categories = getTable("assetcategories");
    $labels = getTable("labels");
    $suppliers = getTable("suppliers");
} elseif ($route == "warranty/create") {
    $warehouse = getTable("warehouse");
    $admins = getTableFiltered("people", "type", "admin");
    $users = getTableFiltered("people", "type", "user");
    $models = '';
    $manufacturers = getTable("manufacturers");
    $categories = getTable("assetcategories");
    $labels = getTable("labels");
    $suppliers = getTable("suppliers");
}

if ($route == "warranty/manage") {
    $asset = getRowById("warranty", $_GET['id']);
    $assettts = getTableFiltered("warrantyhistory", "warrantyid", $_GET['id']);
    $models = getTable("models");
    $manufacturers = getTable("manufacturers");
    $suppliers = getTable("suppliers");
    $files = getTableFiltered("files", "assetid", $_GET['id'], "file[!]", NULL);
}

if ($route == "warranty/hiscreate" && $_GET['id']) {
    $asset = getRowById("warranty", $_GET['id']);
    $models = getTable("models");
    $manufacturers = getTable("manufacturers");
    $suppliers = getTable("suppliers");
}

if ($route == "warranty/hisedit" && $_GET['id']) {
    $usage = getRowById("warrantyhistory", $_GET['id']);
    $asset = getRowById("warranty", $usage['warrantyid']);
    $models = getTable("models");
    $manufacturers = getTable("manufacturers");
}
if ($route == "warrantyupdate") {
    $wrnty = getTableFiltered3("warranty", "serial");
    foreach ($wrnty as $wrnt) {
        $assi = getSingleValue2("assets", "clientid", "caseserial", $wrnt);
        if ($assi != "" && $assi != 0) {
            $astid = getSingleValue2("assets", "id", "caseserial", $wrnt);
            $deprt = getSingleValue2("contract", "department", "assetid", $astid);
            $database->update("warranty", ["location" => $assi, "department" => $deprt], ["serial" => $wrnt]);
        } else {
            $database->update("warranty", ["location" => "None", "department" => ""], ["serial" => $wrnt]);
        }
        // echo'<pre>';
        // print_r($wrnt);
        // print_r("-----".$assi);
        // echo'</pre>';
        // die('fejifv');
    }

    header("Location:?route=warranty");
}

// LICENSES
if ($route == "licenses") {
    $licenses = getTable("licenses");
}
if ($route == "licenses/manage") {
    $license = getRowById("licenses", $_GET['id']);
    $categories = getTable("licensecategories");
    $labels = getTable("labels");
    $clients = getTable("clients");
    $assignedassets = getTableFiltered("licenses_assets", "licenseid", $_GET['id']);
    $assets = getTable("assets");
    $suppliers = getTable("suppliers");
}
if ($route == "licenses/create") {
    $suppliers = getTable("suppliers");
    $categories = getTable("licensecategories");
    $labels = getTable("labels");
    $clients = getTable("clients");
}

// PROJECTS
if ($route == "projects")
    $projects = getTable("projects");
if ($route == "projects/manage") {
    $project = getRowById("projects", $_GET['id']);
    $assignedadmins = getTableFiltered("projects_admins", "projectid", $_GET['id']);
    $files = getTableFiltered("files", "projectid", $_GET['id']);

    $todo = $database->select("issues", "*", ["AND" => ["status" => "To Do", "projectid" => $_GET['id']]]);
    $inprogress = $database->select("issues", "*", ["AND" => ["status" => "In Progress", "projectid" => $_GET['id']]]);
    $done = $database->select("issues", "*", ["AND" => ["status" => "Done", "projectid" => $_GET['id']]]);

    $countTodo = count($todo);
    $countInprogress = count($inprogress);
    $countDone = count($done);
    $countAll = $countTodo + $countInprogress + $countDone;
}

if ($route == "tickets/pending_ticket") {

    global $database;
    $consumable = getTable("consumable_list");
    //  $tickets = getticketTable("tickets");
    $query = $database->query("SELECT *
  FROM tickets
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC");
    $tickets = $query->fetchAll();
    $clients = getTableasc('clients');
} elseif ($route == "tickets/open_ticket") {

    //echo "hiii";
    global $database;
    $consumable = getTable("consumable_list");
    //  $tickets = getticketTable("tickets");
    $query = $database->query("SELECT *
  FROM tickets
  where status ='open'
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC");
    $tickets = $query->fetchAll();
    $clients = getTableasc('clients');
} elseif ($route == "tickets/follow_ticket") {

    global $database;
    $consumable = getTable("consumable_list");
    //  $tickets = getticketTable("tickets");
    $query = $database->query("SELECT *
  FROM tickets
  where status ='Followed Up'
 ORDER BY  
          CASE 
            WHEN status = 'Followed Up' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'Followed Up' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC");
    $tickets = $query->fetchAll();
    $clients = getTableasc('clients');
} elseif ($route == "tickets/inprogress_ticket") {

    global $database;
    $consumable = getTable("consumable_list");
    //  $tickets = getticketTable("tickets");
    $query = $database->query("SELECT *
  FROM tickets
   where status ='In Progress'
 ORDER BY  
 
          CASE 
            WHEN status = 'In Progress' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'In Progress' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC");
    $tickets = $query->fetchAll();
    $clients = getTableasc('clients');
} elseif ($route == "tickets/reopened_ticket") {

    global $database;
    $consumable = getTable("consumable_list");
    //  $tickets = getticketTable("tickets");
    $query = $database->query("SELECT *
  FROM tickets
  where status= 'Reopened'
 ORDER BY  
 
          CASE 
            WHEN status = 'Reopened' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'Reopened' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC");
    $tickets = $query->fetchAll();
    $clients = getTableasc('clients');
} elseif ($route == "tickets/pending_ticket") {
    if ($_GET['companyname']) {


        global $database;
        $query = $database->query(
            "SELECT *
  FROM tickets
   WHERE clientid = " . $_GET['companyname'] . "
   
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC
			  "
        );

        $tickets = $query->fetchAll();
        $clients = getTableasc('clients');
    } else {

        global $database;
        $consumable = getTable("consumable_list");
        //  $tickets = getticketTable("tickets");
        $query = $database->query("SELECT *
  FROM tickets
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC");
        $tickets = $query->fetchAll();
        $clients = getTableasc('clients');
        // echo "<pre>";
        // print_r($tickets);
    }
}





if ($route == "tickets/pending_ticket" && $_GET['tickettype']) {


    $colmnh = $_GET['tickettype'];
    global $database;

    $query = $database->query(
        "SELECT *
  FROM tickets
   WHERE $colmnh = '1'
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC
			  "
    );
    $tickets = $query->fetchAll();
    $clients = getTableasc('clients');
}






if ($route == "tickets/company_ticket") {
    if ($_GET['companyname']) {
        global $database;
        $query = $database->query(
            "SELECT *
            FROM tickets
                WHERE clientid = " . $_GET['companyname'] . "
                ORDER BY  
                CASE 
                    WHEN status = 'open' 
                    THEN UNIX_TIMESTAMP(timestamp) END,
                CASE 
                    WHEN status <> 'open' 
                    THEN UNIX_TIMESTAMP(timestamp) END DESC
                    "
        );

        $tickets = $query->fetchAll();
        $clients = getTableasc('clients');
    } else {

        global $database;
        $consumable = getTable("consumable_list");
        //  $tickets = getticketTable("tickets");
        $query = $database->query("SELECT *
                    FROM tickets
                    ORDER BY  
                    CASE 
                        WHEN status = 'open' 
                        THEN UNIX_TIMESTAMP(timestamp) END,
                    CASE 
                        WHEN status <> 'open' 
                        THEN UNIX_TIMESTAMP(timestamp) END DESC");
        $tickets = $query->fetchAll();
        $clients = getTableasc('clients');
    }
}


// if ($route == "tickets" && $_GET['tickettype']) {


//     $colmnh = $_GET['tickettype'];
//     global $database;

//     $query = $database->query(
//         "SELECT *
//   FROM tickets
//    WHERE $colmnh = '1'
//  ORDER BY  
//           CASE 
//             WHEN status = 'open' 
//               THEN UNIX_TIMESTAMP(timestamp) END,
//           CASE 
//             WHEN status <> 'open' 
//               THEN UNIX_TIMESTAMP(timestamp) END DESC
// 			  "
//     );
//     $tickets = $query->fetchAll();
//     $clients = getTableasc('clients');
// } elseif ($route == "tickets" && $_GET['sfdate'] && $_GET['efdate'] && $_GET['companyname']) {


//     $startdate = $_GET['sfdate'] . " 00:00:00";
//     $enddate = $_GET['efdate'] . " 00:00:00";

//     $tickets = $database->select(
//         "tickets",
//         "*",
//         [
//             "AND" => [
//                 "clientid" => $_GET['companyname'],
//                 "timestamp[<>]" => [$startdate, $enddate]
//             ]
//         ]
//     );

//     $clients = getTableasc('clients');
// } elseif ($route == "tickets" && $_GET['sfdate'] && $_GET['efdate']) {


//     $startdate = $_GET['sfdate'] . " 00:00:00";
//     $enddate = $_GET['efdate'] . " 00:00:00";

//     $tickets = $database->select("tickets", "*", [
//         "timestamp[<>]" => [$startdate, $enddate]
//     ]);

//     $clients = getTableasc('clients');
// } elseif ($route == "tickets") {
//     if ($_GET['companyname']) {


//         global $database;
//         $query = $database->query(
//             "SELECT *
//                 FROM tickets
//                 WHERE clientid = " . $_GET['companyname'] . "
//                 ORDER BY  
//                 CASE 
//                     WHEN status = 'open' 
//                     THEN UNIX_TIMESTAMP(timestamp) END,
//                 CASE 
//                     WHEN status <> 'open' 
//                     THEN UNIX_TIMESTAMP(timestamp) END DESC
// 			  "
//         );

//         $tickets = $query->fetchAll();
//         $clients = getTableasc('clients');
//     } else {
//         if ($_GET['action_taken'] && $_GET['action_taken'] != '') {
//             $action_taken = $_GET['action_taken'];
//             global $database;
//             $consumable = getTable("consumable_list");
//             //  $tickets = getticketTable("tickets");
//             $query = $database->query("SELECT *
//                         FROM tickets
//                         ORDER BY  
//                         CASE 
//                             WHEN status = 'open' 
//                             THEN UNIX_TIMESTAMP(timestamp) END,
//                         CASE 
//                             WHEN status <> 'open' 
//                             THEN UNIX_TIMESTAMP(timestamp) END DESC");
//             $tickets = $query->fetchAll();
//             $tickets_filtered = [];
//             foreach ($tickets as $key => $value) {
//                 $technicain_report_data = get_ticket_detail_for_contract_manage($value['id']);
//                 if (!empty($technicain_report_data) && $technicain_report_data['problem_category'] == $action_taken) {
//                     $tickets_filtered[] = $value;
//                 }
//             }
//             $tickets = $tickets_filtered;
//             $clients = getTableasc('clients');
//         }else{
//             global $database;
//             $consumable = getTable("consumable_list");
//             //  $tickets = getticketTable("tickets");
//             $query = $database->query("SELECT *
//                         FROM tickets
//                         ORDER BY  
//                         CASE 
//                             WHEN status = 'open' 
//                             THEN UNIX_TIMESTAMP(timestamp) END,
//                         CASE 
//                             WHEN status <> 'open' 
//                             THEN UNIX_TIMESTAMP(timestamp) END DESC");
//             $tickets = $query->fetchAll();
//             $clients = getTableasc('clients');
            
//         }
//     }
// }


// new tickets route
if ($route == "tickets") {
    global $database;
    $consumable = getTable("consumable_list");

    $where = '';
    $tickettype = isset($_GET['tickettype']) ? $_GET['tickettype'] : '';
    $companyname = isset($_GET['companyname']) ? $_GET['companyname'] : '';
    $quick_filter = isset($_GET['quick_filter']) ? $_GET['quick_filter'] : '180';

    if ($quick_filter == 0) {
        $past_date = '';
    }else{
        $current_date = date('Y-m-d H:i:s');
        $past_date = date('Y-m-d H:i:s', strtotime("-$quick_filter days"));
    }

    if ($tickettype != '' && $companyname != '') {
        $where .= "WHERE $tickettype = '1' AND clientid =" . $companyname;
    }elseif ($tickettype != '') {
        $where .= "WHERE $tickettype = '1'";
    }elseif ($companyname != '') {
        $where .= "WHERE clientid =" . $companyname;
    }elseif ($quick_filter != '') {
        if ($quick_filter == 0) {
            $past_date = '';
        }else{
            $current_date = date('Y-m-d H:i:s');
            $past_date = date('Y-m-d H:i:s', strtotime("-$quick_filter days"));
        }
        if ($past_date != '') {
            $where .= "WHERE `timestamp` >= '$past_date'";    
        }
    }

    if ($where == '') {
        if ($past_date != '') {
            $where .= "WHERE `timestamp` >= '$past_date'";    
        }
    }

    if (isset($_GET['quick_filter']) &&  $_GET['quick_filter'] == '0') {
        $where = '';
    }

    $query = $database->query("SELECT *
                FROM tickets
                $where
                ORDER BY  
                 CASE 
                WHEN status = 'open' THEN UNIX_TIMESTAMP(timestamp) 
                ELSE NULL 
            END ASC, 
            CASE 
                WHEN status <> 'open' THEN UNIX_TIMESTAMP(timestamp) 
                ELSE NULL 
            END DESC");

    $tickets = $query->fetchAll();
    $clients = getTableasc('clients');
    if ($_GET['action_taken'] && $_GET['action_taken'] != '') {
        $action_taken = $_GET['action_taken'];
        $tickets_filtered = [];
        foreach ($tickets as $key => $value) {
            $technicain_report_data = get_ticket_detail_for_contract_manage($value['id']);
            if (!empty($technicain_report_data) && $technicain_report_data['problem_category'] == $action_taken) {
                $tickets_filtered[] = $value;
            }
        }
        $tickets = $tickets_filtered;
    }
}


if ($route == "tickets_export") {
    $pera = isset($_GET['pera']) ? $_GET['pera'] : '';
    if ($pera != '') {
        $diff = explode('___' , $pera);
        foreach ($diff as $value) {
            if ($value != '') {
                $d = explode('__' , $value);
                $_GET[$d[0]]   = $d[1];
            }
        }
    }
    global $database;
    $consumable = getTable("consumable_list");

    $where = '';
    $tickettype = isset($_GET['tickettype']) ? $_GET['tickettype'] : '';
    $companyname = isset($_GET['companyname']) ? $_GET['companyname'] : '';
    $quick_filter = isset($_GET['quick_filter']) ? $_GET['quick_filter'] : '180';

    if ($quick_filter == 0) {
        $past_date = '';
    }else{
        $current_date = date('Y-m-d H:i:s');
        $past_date = date('Y-m-d H:i:s', strtotime("-$quick_filter days"));
    }

    if ($tickettype != '' && $companyname != '' && $quick_filter != '') {
        $where .= "WHERE $tickettype = '1' AND clientid =" . $companyname;
        if ($quick_filter == 0) {
            $past_date = '';
        }else{
            $current_date = date('Y-m-d H:i:s');
            $past_date = date('Y-m-d H:i:s', strtotime("-$quick_filter days"));
        }
        if ($past_date != '') {
            $where .= " AND `timestamp` >= '$past_date'";    
        }
    }elseif ($tickettype != '' && $companyname != '') {
        $where .= "WHERE $tickettype = '1' AND clientid =" . $companyname;
    }elseif ($tickettype != '') {
        $where .= "WHERE $tickettype = '1'";
    }elseif ($companyname != '') {
        $where .= "WHERE clientid =" . $companyname;
    }elseif ($quick_filter != '') {
        if ($quick_filter == 0) {
            $past_date = '';
        }else{
            $current_date = date('Y-m-d H:i:s');
            $past_date = date('Y-m-d H:i:s', strtotime("-$quick_filter days"));
        }
        if ($past_date != '') {
            $where .= "WHERE `timestamp` >= '$past_date'";    
        }
    }

    if ($where == '') {
        if ($past_date != '') {
            $where .= "WHERE `timestamp` >= '$past_date'";    
        }
    }

    $query = $database->query("SELECT *
                FROM tickets
                $where
                ORDER BY  
                 CASE 
                WHEN status = 'open' THEN UNIX_TIMESTAMP(timestamp) 
                ELSE NULL 
            END ASC, 
            CASE 
                WHEN status <> 'open' THEN UNIX_TIMESTAMP(timestamp) 
                ELSE NULL 
            END DESC");

    $tickets = $query->fetchAll();
    $clients = getTableasc('clients');
    if ($_GET['action_taken'] && $_GET['action_taken'] != '') {
        $action_taken = $_GET['action_taken'];
        $tickets_filtered = [];
        foreach ($tickets as $key => $value) {
            $technicain_report_data = get_ticket_detail_for_contract_manage($value['id']);
            if (!empty($technicain_report_data) && $technicain_report_data['problem_category'] == $action_taken) {
                $tickets_filtered[] = $value;
            }
        }
        $tickets = $tickets_filtered;
    }

    $records = array();
    if (isset($tickets) && !empty($tickets)) {
        $n = 1;
        foreach ($tickets as $ticket) {
            $data['#'] = $n;
            $data['Ticket #'] = $ticket['ticket'];;
            $data['Date'] = $ticket['timestamp'];;
            $data['Subject'] = getSingleValue("ticketsubject","subject",$ticket['subject']);;

            $assigned_to = $ticket['adminid'] != 0 ? getSingleValue("people","name",$ticket['adminid']) : "Nobody";
            $data['Assigned To'] = $assigned_to;

            $assetid = getSingleValue("contract","assetid",$ticket['contractid']);
            $assettag = getSingleValue("assets","tag",$assetid);
            $modelid = getSingleValue("assets","modelid",$assetid);
            $assetmodel = getSingleValue("models","name",$modelid);
            $related_entities = getSingleValue("clients","name",$ticket['clientid']) . '  ' . getSingleValue("contract","contractno",$ticket['contractid']) . " | " .$assettag .":" . $assetmodel;
            $data['Related Entities'] = $related_entities;

            $dipartment_id = getSingleValue('contract', 'department', $ticket['contractid']);  
            $dipartment_name = getSingleValue('department', 'name', $dipartment_id); 
            if($ticket['clientid'] == 0){
                $Department = 'None';
            }else{
                $Department = $dipartment_name;
            } 
            $data['Department'] = $Department;
            $data['Client Handle Mistake'] = $ticket['client_handle_mistake'] == 1 ? 0 : '';

            $parts_material = '';
            foreach($consumable as $consum){
                if($consum['id'] == $ticket['consumable_list_id']){
                    $parts_material = $consum['name'];
                }
            }
            $data['Parts & Material'] = $parts_material;

            $Cost = '';
            foreach($consumable as $consume){
                if($consume['id'] == $ticket['consumable_list_id']){
                    $Cost .= $consume['cog'];
                }
            }
            $data['Cost of Parts & Material'] = $Cost;

            $data['Sale Price'] = $ticket['consumable_cost'] > 0 && $ticket['consumable_cost'] != 0 ? $ticket['consumable_cost'] : '';

            $detail =  get_ticket_detail_for_contract_manage($ticket['id']);
            $action_taken = get_ticket_action_name($detail['problem_category']);
            $data['Action Taken'] = $action_taken;

            $closed_by_name = getSingleValue("people", "name", $ticket['closed_by']);
            $closed_email = getSingleValue("people", "email", $ticket['closed_by']);
            $updated_by = '';
            if($closed_by_name !="" && $closed_email!=""){
                $updated_by = $closed_by_name;
            }
            $data['Updated By'] = $updated_by;

            $status = '';
            if($ticket['status'] == "Open")  $status = "Open";
            if($ticket['status'] == "In Progress") $status = "In Progress";
            if($ticket['status'] == "Followed Up") $status = "Followed Up";
            if($ticket['status'] == "Reopened") $status = "Reopened";
            if($ticket['status'] == "Closed") $status = "Closed";
            $data['Status'] = $status;
            $records[] = $data;
            $n++;
        }

        $filename = "Tickets.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $heading = false;
        if (!empty($records))
            foreach ($records as $row) {
                if (!$heading) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }
        exit;
    }


}



if ($route == "tickets/pending_frequency" && $_GET['tickettype']) {


    $colmnh = $_GET['tickettype'];
    global $database;

    $query = $database->query(
        "SELECT *
  FROM tickets
   WHERE $colmnh = '1'
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC
			  "
    );
    $tickets = $query->fetchAll();
    $clients = getTableasc('clients');
} elseif ($route == "tickets/pending_frequency" && $_GET['sfdate'] && $_GET['efdate'] && $_GET['companyname']) {


    $startdate = $_GET['sfdate'] . " 00:00:00";
    $enddate = $_GET['efdate'] . " 00:00:00";

    $tickets = $database->select(
        "tickets",
        "*",
        [
            "AND" => [
                "clientid" => $_GET['companyname'],
                "timestamp[<>]" => [$startdate, $enddate]
            ]
        ]
    );

    $clients = getTableasc('clients');
} elseif ($route == "tickets/pending_frequency" && $_GET['sfdate'] && $_GET['efdate']) {


    $startdate = $_GET['sfdate'] . " 00:00:00";
    $enddate = $_GET['efdate'] . " 00:00:00";

    $tickets = $database->select("tickets", "*", [
        "timestamp[<>]" => [$startdate, $enddate]
    ]);

    if ($_GET['con_number'] && isset($_GET['con_number'])) {
        $con_number = $_GET['con_number'];
        $contactCounts = [];
        foreach ($tickets as $key => $value) {
            $contractno = getSingleValue("contract", "contractno", $value['contractid']);
            if (!isset($contactCounts[$contractno])) {
                $contactCounts[$contractno] = 0;
            }
            $contactCounts[$contractno]++;
        }

        $filter_tickets_data = [];
        foreach ($tickets as $key => $value) {
            $contractno = getSingleValue("contract", "contractno", $value['contractid']);
            $contract_count = $contactCounts[$contractno];
            if ($contract_count >= (int)$con_number) {
                $filter_tickets_data[] = $value;
            }
        }

        if (!empty($filter_tickets_data)) {
            $tickets = $filter_tickets_data;
        }
    }


    $clients = getTableasc('clients');
} elseif ($route == "tickets/pending_frequency") {
    if ($_GET['companyname']) {


        global $database;
        $query = $database->query(
            "SELECT *
                FROM tickets
                WHERE clientid = " . $_GET['companyname'] . "
                ORDER BY  
                CASE 
                WHEN status = 'open' 
                THEN UNIX_TIMESTAMP(timestamp) END,
                CASE 
                WHEN status <> 'open' 
                THEN UNIX_TIMESTAMP(timestamp) END DESC
			  "
        );

        $tickets = $query->fetchAll();
        $clients = getTableasc('clients');
    } elseif ($_GET['con_number'] && isset($_GET['con_number'])) {
        $con_number = $_GET['con_number'];
        global $database;
        $first_day_previous_month = date('Y-m-01', strtotime('first day of last month'));
        $current_date = date('Y-m-d');
        $startdate = $first_day_previous_month . " 00:00:00";
        $enddate = $current_date . " 00:00:00";
        $tickets = $database->select("tickets", "*", [
            "timestamp[<>]" => [$startdate, $enddate]
        ]);

        $contactCounts = [];
        foreach ($tickets as $key => $value) {
            $contractno = getSingleValue("contract", "contractno", $value['contractid']);
            if (!isset($contactCounts[$contractno])) {
                $contactCounts[$contractno] = 0;
            }
            $contactCounts[$contractno]++;
        }

        $filter_tickets_data = [];
        foreach ($tickets as $key => $value) {
            $contractno = getSingleValue("contract", "contractno", $value['contractid']);
            $contract_count = $contactCounts[$contractno];
            if ($contract_count >= $con_number) {
                $filter_tickets_data[] = $value;
            }
        }

        if (!empty($filter_tickets_data)) {
            $tickets = $filter_tickets_data;
        }

        $clients = getTableasc('clients');
    } else {
        global $database;
        $first_day_previous_month = date('Y-m-01', strtotime('first day of last month'));
        $current_date = date('Y-m-d');
        $startdate = $first_day_previous_month . " 00:00:00";
        $enddate = $current_date . " 00:00:00";
        $tickets = $database->select("tickets", "*", [
            "timestamp[<>]" => [$startdate, $enddate]
        ]);
        $clients = getTableasc('clients');
    }
}

// tickets/export_pending_frequency
if ($route == "tickets/export_pending_frequency") {
    if (isset($_GET['sfdate']) && isset($_GET['efdate'])) {
        $startdate = $_GET['sfdate'] . " 00:00:00";
        $enddate = $_GET['efdate'] . " 00:00:00";

        $tickets = $database->select("tickets", "*", [
            "timestamp[<>]" => [$startdate, $enddate]
        ]);

        if ($_GET['con_number'] && isset($_GET['con_number'])) {
            $con_number = $_GET['con_number'];
            $contactCounts = [];
            foreach ($tickets as $key => $value) {
                $contractno = getSingleValue("contract", "contractno", $value['contractid']);
                if (!isset($contactCounts[$contractno])) {
                    $contactCounts[$contractno] = 0;
                }
                $contactCounts[$contractno]++;
            }

            $filter_tickets_data = [];
            foreach ($tickets as $key => $value) {
                $contractno = getSingleValue("contract", "contractno", $value['contractid']);
                $contract_count = $contactCounts[$contractno];
                if ($contract_count >= (int)$con_number) {
                    $filter_tickets_data[] = $value;
                }
            }

            if (!empty($filter_tickets_data)) {
                $tickets = $filter_tickets_data;
            }
        }

        $records = array();
        if (isset($tickets) && !empty($tickets)) {
            $n = 1;
            if ($_GET['export_summary']) {
                $con_number = $_GET['con_number'];

                $filtered_contactCounts = [];
                foreach ($contactCounts as $key => $value) {
                    if ($value >= (int)$con_number) {
                        $filtered_contactCounts[$key] = $value;
                    }
                }

                foreach ($filtered_contactCounts as $key => $value) {
                    $contract_info = getTableFiltered("contract", "contractno", $key);
                    if (!empty($contract_info) && !empty($contract_info[0])) {
                        $clientid = $contract_info[0]['clientid'];
                        $data['Client'] = getSingleValue("clients", "name", $clientid);
                        $assetid = getSingleValue("contract", "assetid", $contract_info[0]['id']);
                        $assettag = getSingleValue("assets", "tag", $assetid);
                        $modelid = getSingleValue("assets", "modelid", $assetid);
                        $assetmodel = getSingleValue("models", "name", $modelid);
                        $data['Contract No'] = $key;
                        $data['Asset Name'] = $assettag . ':' . $assetmodel;

                        $dipartment_id = getSingleValue('contract', 'department', $contract_info[0]['id']);
                        $dipartment_name = getSingleValue('department', 'name', $dipartment_id);
                        $data['Department'] = $dipartment_name;

                        $data['Total Tickets'] = $value;
                    }

                    $records[] = $data;
                    $n++;
                }
                usort($records, function ($a, $b) {
                    return strcmp($a['Client'], $b['Client']);
                });
            } else {
                foreach ($tickets as $ticket) {
                    $data['ID'] = $ticket['id'];
                    $data['Client'] = getSingleValue("clients", "name", $ticket['clientid']);
                    $data['Ticket'] = $ticket['ticket'];
                    $data['Date'] = $ticket['timestamp'];
                    $data['Subject'] = getSingleValue("ticketsubject", "subject", $ticket['subject']);
                    $data['Assigned To'] = $ticket['adminid'] != 0 ?  getSingleValue("people", "name", $ticket['adminid']) : "Nobody";
                    $data['Contract No'] = getSingleValue("contract", "contractno", $ticket['contractid']);
                    $assetid = getSingleValue("contract", "assetid", $ticket['contractid']);
                    $assettag = getSingleValue("assets", "tag", $assetid);
                    $modelid = getSingleValue("assets", "modelid", $assetid);
                    $assetmodel = getSingleValue("models", "name", $modelid);
                    $data['Asset'] = $assettag . ' | ' . $assetmodel;
                    $dipartment_id = getSingleValue('contract', 'department', $ticket['contractid']);
                    $dipartment_name = getSingleValue('department', 'name', $dipartment_id);
                    $data['Department'] = $dipartment_name;
                    $closed_by_name = getSingleValue("people", "name", $ticket['closed_by']);
                    $closed_email = getSingleValue("people", "email", $ticket['closed_by']);

                    $data['Updated By'] = $closed_by_name != "" && $closed_email != "" ? $closed_by_name : '';
                    $ticket_status = '';
                    if ($ticket['status'] == "Open") {
                        $ticket_status = "Open";
                    } elseif ($ticket['status'] == "In Progress") {
                        $ticket_status = "In Progress";
                    } elseif ($ticket['status'] == "Followed Up") {
                        $ticket_status = "Followed Up";
                    } elseif ($ticket['status'] == "Reopened") {
                        $ticket_status = "Reopened";
                    } elseif ($ticket['status'] == "Closed") {
                        $ticket_status = "Closed";
                    }
                    $data['Status'] = $ticket_status;

                    $records[] = $data;
                    $n++;
                }
                usort($records, function ($a, $b) {
                    return strcmp($a['Client'], $b['Client']);
                });
            }

            $filename = "Pending Frequency.xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            $heading = false;
            if (!empty($records))
                foreach ($records as $row) {
                    if (!$heading) {
                        echo implode("\t", array_keys($row)) . "\n";
                        $heading = true;
                    }
                    echo implode("\t", array_values($row)) . "\n";
                }

            exit;
        }
    }
}

// TICKETS

if ($route == "tickets/client_handle_mistake") {
    global $database;
    //  $tickets = getticketTable("tickets");
    $query = $database->query(
        "SELECT *
  FROM tickets
   WHERE client_handle_mistake = '1'
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC
			  "
    );
    $tickets = $query->fetchAll();
    // echo "<pre>";
    // print_r($tickets);
}
if ($route == "tickets/technical_improvement") {
    global $database;
    //  $tickets = getticketTable("tickets");
    $query = $database->query(
        "SELECT *
  FROM tickets
  WHERE technical_improvement = '1'
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC
			  "
    );
    $tickets = $query->fetchAll();
    // echo "<pre>";
    // print_r($tickets);
}
if ($route == "tickets/refill") {
    global $database;
    //  $tickets = getticketTable("tickets");
    $query = $database->query(
        "SELECT *
  FROM tickets
  WHERE refill = '1'
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC
			  "
    );
    $tickets = $query->fetchAll();
    // echo "<pre>";
    // print_r($tickets);
}
if ($route == "tickets/parsts_replacments") {
    global $database;
    //  $tickets = getticketTable("tickets");
    $query = $database->query(
        "SELECT *
  FROM tickets
  WHERE parsts_replacments = '1'
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC
			  
			  "
    );
    $tickets = $query->fetchAll();
    // echo "<pre>";
    // print_r($tickets);
}
if ($route == "tickets/ticketsothers") {
    global $database;
    //  $tickets = getticketTable("tickets");
    $query = $database->query(
        "SELECT *
  FROM tickets
  WHERE ticketothers = '1'
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC
			  
			  "
    );
    $tickets = $query->fetchAll();
    //echo "<pre>";
    //print_r($tickets);
}
if ($route == "tickets/manage") {
    global $database;
    $ticket = getRowById("tickets", $_GET['id']);
    $consumable = getTable("consumable_list");
    //print_r($ticket);die;
    $replies = getTableFiltered("tickets_replies", "ticketid", $_GET['id'], "", "", "*", "id", "DESC");
    //echo "SELECT tickets_replies.*,ticket_reply_files.id as fileid, ticket_reply_files.name as filename,ticket_reply_files.file " . "FROM tickets_replies " . "LEFT JOIN ticket_reply_files ON tickets_replies.id = ticket_reply_files.ticket_reply_id " . "WHERE tickets_replies.ticketid = " . $_GET['id'] . " ORDER BY tickets_replies.id DESC";

    $query = $database->query(
        "SELECT tickets_replies.*,ticket_reply_files.id as fileid, ticket_reply_files.name as filename,ticket_reply_files.file "
            . "FROM tickets_replies "
            . "LEFT JOIN ticket_reply_files ON tickets_replies.id = ticket_reply_files.ticket_reply_id "
            . "WHERE tickets_replies.ticketid = " . $_GET['id']
            . " ORDER BY tickets_replies.id DESC"
    );
    $replies = $query->fetchAll();

    $query2 = $database->query(
        "SELECT technician_report.*, ticket_action.action AS problem_subject FROM technician_report LEFT JOIN ticket_action ON technician_report.problem_category = ticket_action.id WHERE technician_report.ticketid = " . (int)$_GET["id"]
    );

    $technicain_report = $query2->fetch();

    $problem_category = getTable("ticket_action" , "*" , "action" , "ASC");

    if ($technicain_report) {
        $query3 = $database->query("SELECT name FROM people WHERE id=" . $technicain_report["technician_id"]);

        $technician_name = $query3->fetch();
    }

    //echo '<pre>';
    //print_r($replies);
}

// ISSUS
if ($route == "issues")
    $issues = getTable("issues");
// echo '<pre>';
// print_r($issues);
// die;

// MONITORING
if ($route == "monitoring") {
    $clients = getTable("clients");
    $hostsUp = getTableFiltered("hosts", "status", "Up");
    $hostsDown = getTableFiltered("hosts", "status", "Down");
    $hostsWarning = getTableFiltered("hosts", "status", "Warning");
    $hosts = getTableFiltered("hosts", "status", "");
    $sumHosts = countTable("hosts");
    $sumHostsUp = countTableFiltered("hosts", "status", "Up");
    $sumHostsDown = countTableFiltered("hosts", "status", "Down");
    $sumHostsWarning = countTableFiltered("hosts", "status", "Warning");
    if ($sumHosts > 0) {
        $percUp = round($sumHostsUp / $sumHosts * 100, 0);
        $percWarning = round($sumHostsWarning / $sumHosts * 100, 0);
        $percDown = round($sumHostsDown / $sumHosts * 100, 0);
    } else {
        $percUp = 0;
        $percWarning = 0;
        $percDown = 0;
    }
}
if ($route == "monitoring/manage") {
    $host = getRowById("hosts", $_GET['id']);
    $admins = getTableFiltered("people", "type", "admin");
    $checksUp = getTableFiltered("hosts_checks", "hostid", $_GET['id'], "status", "Up");
    $checksDown = getTableFiltered("hosts_checks", "hostid", $_GET['id'], "status", "Down");
    $checks = getTableFiltered("hosts_checks", "hostid", $_GET['id'], "status", "");
    $assignedpeople = getTableFiltered("hosts_people", "hostid", $_GET['id']);
}

// cusotmer export reports
if ($route == 'exp_reports') {
    // echo "<pre>";
    // print_R($_GET);
    $startdate = $_GET['sdate'] . " 00:00:00";
    $enddate = $_GET['edate'] . " 00:00:00";
    if ($_GET['custom_id'] == "0") {
        //echo "hiii";
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
        //echo "hello";
        //$assets = getTableFiltered("tickets", "clientid", $_GET['clientid']);
        $consumable = getTable("consumable_list");
        $assets = $database->select("tickets", "*", ["AND" => [
            "timestamp[<>]" => [$startdate, $enddate],
            "clientid" => $_GET['custom_id']
        ]]);
        $licenses = getTableFiltered("licenses", "clientid", $_GET['custom_id']);
        $issues = $database->select("issues", "*", ["AND" => [
            "dateadded[<>]" => [$startdate, $enddate],
            "clientid" => $_GET['custom_id']
        ]]);
    }
    $records = array();
    // echo "<pre>";
    // print_r($records);
    foreach ($assets as $asset) {
        if ($asset['clientid'] != 0) {
            $client = getSingleValue("clients", "name", $asset['clientid']);
        } else {
            $client = 'NONE';
        }
        $manufacturerid = getSingleValue("models", "manufacturerid", $asset['modelid']);
        if ($asset['subject'] > 0) {
            $subject =    getRowById("ticketsubject", $asset['subject']);
        } else {
            $subject = array('subject' => $asset['subject']);
        }
        $dipartment_id = getSingleValue('contract', 'department', $asset['contractid']);
        $dipartment_name = getSingleValue('department', 'name', $dipartment_id);
        foreach ($consumable as $consu) {
            if ($consu['id'] == $asset['consumable_list_id']) {
                $consuname = $consu['name'];
            }
        }
        $records[] = array("ticket" => $asset['ticket'], 'date' => $asset['timestamp'], 'subject' => $subject['subject'], 'Department' => $dipartment_name, 'email' => $asset['email'], 'username' => getSingleValue('people', 'name', $asset['userid']), 'userdepartment' => getSingleValue('people', 'title', $asset['userid']), 'Parts & Material' => $consuname, 'Cost' => $asset['consumable_cost']);
    }
    // echo "<pre>";
    // print_R($records);
    // die("here");


    $filename = "CustomerReport.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $heading = false;
    if (!empty($records))
        foreach ($records as $row) {
            if (!$heading) {
                echo implode("\t", array_keys($row)) . "\n";
                $heading = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }

    exit;
}


// missing page count report exl
if ($route == 'exp_page_count_reports') {

    if (isset($_GET['month_filter'])) {
        $month_filter = $_GET['month_filter'];

        $client_sql =  "SELECT
     clients.id AS clients_id,
     clients.name AS clients_name,
     contract.contractno AS contractno,
     usage_report.ref_no,
     usage_report.date,
     usage_report.A3clr,
     usage_report.A3blk,
     usage_report.A4clr,
     usage_report.A4blk,
     usage_report.image,
     usage_report.modal_name,
     usage_report.department,
     usage_report.remark,
     usage_report.id AS usage_report_id,
     IFNULL(usage_report.id, 'No Usage Report') AS usage_report_status
        FROM
            clients
        JOIN 
            contract ON contract.clientid = clients.id
        LEFT JOIN 
            usage_report ON usage_report.contract_id = contract.id
        WHERE
            contract.is_end = 0 
            AND clients.is_active = 1
            AND (usage_report.ref_no LIKE '%" . $_GET['year_month'] . "%' OR usage_report.ref_no IS NULL)
        GROUP BY
            contract.id
        ORDER BY
            clients.name ASC;";


        $query = $database->query($client_sql);
        $page_count_report_data = $query->fetchAll();
    }

    $records = array();
    if (isset($page_count_report_data) && !empty($page_count_report_data)) {
        $n = 1;
        foreach ($page_count_report_data as $page_count_report) {
            $data['#'] = $n;
            $data['Clients Name'] = $page_count_report['clients_name'];
            $data['Contract No'] = $page_count_report['contractno'];
            $data['Reference No'] = $page_count_report['ref_no'];
            $data['Date'] = $page_count_report['date'];
            $data['Department'] = $page_count_report['department'];
            $data['Modal Name'] = $page_count_report['modal_name'];
            $data['A3 Color'] = $page_count_report['A3clr'];
            $data['A3 Black'] = $page_count_report['A3blk'];
            $data['A4 Color'] = $page_count_report['A4clr'];
            $data['A4 Black'] = $page_count_report['A4blk'];
            $data['Remark'] = $page_count_report['remark'];
            $records[] = $data;
            $n++;
        }

        $filename = "PageCount.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $heading = false;
        if (!empty($records))
            foreach ($records as $row) {
                if (!$heading) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }

        exit;
    }
}


// REPORTS


if ($route == "reports") {
    // global $database;
    // $sql = "SELECT clients.id , clients.name"
    // . " FROM clients " 
    // . " ORDER BY clients.name DESC";
    // $query = $database->query($sql);
    // $clients = $query->fetchAll();




    $clients = getTableasc("clients");
    $admins = getTableFiltered("people", "type", "admin");
}
if ($route == "reports/view") {
    if ($_GET['report'] == "timesheet") {
        $startdate = $_GET['startDate'] . " 00:00:00";
        $enddate = $_GET['endDate'] . " 00:00:00";
        if ($_GET['clientid'] == "0") {
            $issues = $database->select("issues", "*", [
                "dateadded[<>]" => [$startdate, $enddate]
            ]);
        } else {
            $issues = $database->select("issues", "*", ["AND" => [
                "dateadded[<>]" => [$startdate, $enddate],
                "clientid" => $_GET['clientid']
            ]]);
        }
    } elseif ($_GET['report'] == "timesheetSummary" && $_GET['forticket'] == "ticket") {


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
        if ($_GET['clientid'] == "0") {
            $assets = getTable("assets");
            $consumable = getTable("consumable_list");
            $licenses = getTable("licenses");
            $issues = $database->select("issues", "*", [
                "dateadded[<>]" => [$startdate, $enddate]
            ]);
        } else {
            $assets = getTableFiltered("assets", "clientid", $_GET['clientid']);
            $consumable = getTable("consumable_list");
            $licenses = getTableFiltered("licenses", "clientid", $_GET['clientid']);
            $issues = $database->select("issues", "*", ["AND" => [
                "dateadded[<>]" => [$startdate, $enddate],
                "clientid" => $_GET['clientid']
            ]]);
        }
    } elseif ($_GET['report'] == "timesheetSummary1") {
        $startdate = $_GET['startDate'] . " 00:00:00";
        $enddate = $_GET['endDate'] . " 00:00:00";
        if ($_GET['clientid'] == "0") {
            $assets = getTable("assets");
            $consumable = getTable("consumable_list");
            $licenses = getTable("licenses");
            $issues = $database->select("issues", "*", [
                "dateadded[<>]" => [$startdate, $enddate]
            ]);
        } else {
            $assets = getTableFiltered("assets", "clientid", $_GET['clientid']);
            $consumable = getTable("consumable_list");
            $licenses = getTableFiltered("licenses", "clientid", $_GET['clientid']);
            $issues = $database->select("issues", "*", ["AND" => [
                "dateadded[<>]" => [$startdate, $enddate],
                "clientid" => $_GET['clientid']
            ]]);
        }
    } elseif ($_GET['report'] == "summary") {
        if ($_GET['clientid'] == "0") {
            $assets = getTable("assets");
            $consumable = getTable("consumable_list");
            $licenses = getTable("licenses");
        } else {
            $assets = getTableFiltered("assets", "clientid", $_GET['clientid']);
            $consumable = getTable("consumable_list");
            $licenses = getTableFiltered("licenses", "clientid", $_GET['clientid']);
        }
    } elseif ($_GET['report'] == "page_count_report") {


        if ($_GET['clientid'] == "0") {
            $assets = getTable("assets");
            $usage_report = getTable("usage_report");
            $licenses = getTable("licenses");
        } else {
            $assets = getTableFiltered("assets", "clientid", $_GET['clientid']);
            $usage_report = get_usage_report_data_letest($_GET['clientid']);
            $licenses = getTableFiltered("licenses", "clientid", $_GET['clientid']);
        }
    }
}

// CLIENTS
// if ($route == "clients") {
//     echo '<pre>';
//     print_r('cscs');
//     die;
//     $clients = getTableFiltered("clients", 'is_active', 1);

//     $months = array(
//         '1' => ['Jan', '#337ab7'],
//         '2' => ['Feb', '#5cb85c'],
//         '3' => ['Mar', '#5bc0de'],
//         '4' => ['Apr', '#f0ad4e'],
//         '5' => ['May', '#d9534f'],
//         '6' => ['Jun', '#F2F271'],
//         '7' => ['Jul', '#B26B07'],
//         '8' => ['Aug', '#FC0000'],
//         '9' => ['Sep', '#1FF21F'],
//         '10' => ['Oct', '#42A6F7'],
//         '11' => ['Nov', '#025191'],
//         '12' => ['Dec', '#EA77F4'],
//     );

//     header("Location:?route=clients/active");

//     //    cs_debug($months);
// }


if ($route == "clients/all") {

    $clients_inact = getTableFilteredsorbynm("clients", 'is_active', 0);
    $clients = getTable("clients");
    $acclients = getTableFilteredsorbynm("clients", 'is_active', 1);
    $months = array(
        '1' => ['Jan', '#337ab7'],
        '2' => ['Feb', '#5cb85c'],
        '3' => ['Mar', '#5bc0de'],
        '4' => ['Apr', '#f0ad4e'],
        '5' => ['May', '#d9534f'],
        '6' => ['Jun', '#F2F271'],
        '7' => ['Jul', '#B26B07'],
        '8' => ['Aug', '#FC0000'],
        '9' => ['Sep', '#1FF21F'],
        '10' => ['Oct', '#42A6F7'],
        '11' => ['Nov', '#025191'],
        '12' => ['Dec', '#EA77F4'],
    );
    //    cs_debug($months);
}

if ($route == "clients/active") {
    $clients = getTableFilteredsorbynm("clients", 'is_active', 1);
    $clients_inact = getTableFilteredsorbynm("clients", 'is_active', 0);
    $tickets = getTable("tickets");

    $months = array(
        '1' => ['Jan', '#337ab7'],
        '2' => ['Feb', '#5cb85c'],
        '3' => ['Mar', '#5bc0de'],
        '4' => ['Apr', '#f0ad4e'],
        '5' => ['May', '#d9534f'],
        '6' => ['Jun', '#F2F271'],
        '7' => ['Jul', '#B26B07'],
        '8' => ['Aug', '#FC0000'],
        '9' => ['Sep', '#1FF21F'],
        '10' => ['Oct', '#42A6F7'],
        '11' => ['Nov', '#025191'],
        '12' => ['Dec', '#EA77F4'],
    );
    //    cs_debug($months);
    $notificationtemplates = getTableFiltered("notificationtemplates", "type", "emailtemplete");
}

if ($route == "clients/complain") {
    $user_complain_list = get_complain_list();
}

// if ($route == "clients/client_status") {
//     $clients = getTableFilteredsorbynm("clients", 'is_active', 1);
//     $clients_inact = getTableFilteredsorbynm("clients", 'is_active', 0);
//     $tickets = getTable("tickets");

//     $months = array(
//         '1' => ['Jan', '#337ab7'],
//         '2' => ['Feb', '#5cb85c'],
//         '3' => ['Mar', '#5bc0de'],
//         '4' => ['Apr', '#f0ad4e'],
//         '5' => ['May', '#d9534f'],
//         '6' => ['Jun', '#F2F271'],
//         '7' => ['Jul', '#B26B07'],
//         '8' => ['Aug', '#FC0000'],
//         '9' => ['Sep', '#1FF21F'],
//         '10' => ['Oct', '#42A6F7'],
//         '11' => ['Nov', '#025191'],
//         '12' => ['Dec', '#EA77F4'],
//     );
//     //    cs_debug($months);
// }


if ($route == "clients/client_memo") {
    $clients = getTableFilteredsorbynm("clients", 'is_active', 1);
    $clients_inact = getTableFilteredsorbynm("clients", 'is_active', 0);
    $tickets = getTable("tickets");

    $months = array(
        '1' => ['Jan', '#337ab7'],
        '2' => ['Feb', '#5cb85c'],
        '3' => ['Mar', '#5bc0de'],
        '4' => ['Apr', '#f0ad4e'],
        '5' => ['May', '#d9534f'],
        '6' => ['Jun', '#F2F271'],
        '7' => ['Jul', '#B26B07'],
        '8' => ['Aug', '#FC0000'],
        '9' => ['Sep', '#1FF21F'],
        '10' => ['Oct', '#42A6F7'],
        '11' => ['Nov', '#025191'],
        '12' => ['Dec', '#EA77F4'],
    );
    //    cs_debug($months);
}

if ($route == "clients/inactive") {
    $clients = getTableFilteredsorbynm("clients", 'is_active', 0);
    $acclients = getTableFilteredsorbynm("clients", 'is_active', 1);

    $months = array(
        '1' => ['Jan', '#337ab7'],
        '2' => ['Feb', '#5cb85c'],
        '3' => ['Mar', '#5bc0de'],
        '4' => ['Apr', '#f0ad4e'],
        '5' => ['May', '#d9534f'],
        '6' => ['Jun', '#F2F271'],
        '7' => ['Jul', '#B26B07'],
        '8' => ['Aug', '#FC0000'],
        '9' => ['Sep', '#1FF21F'],
        '10' => ['Oct', '#42A6F7'],
        '11' => ['Nov', '#025191'],
        '12' => ['Dec', '#EA77F4'],
    );
    //    cs_debug($months);
}

if ($route == "clients/editinvoice") {
    $invoice = getTableFiltered("invoice", "id", $_GET['id']);
    $active_contracts = getTableFiltered("contract", "clientid", $invoice[0]['clintid'], "is_end", 0);
    $client = getRowById("clients", $invoice[0]['clintid']);
}


if ($route == "clients/manage") {
    $client = getRowById("clients", $_GET['id']);

    $contractsdepart = getTableFiltered2("contract", ["clientid" => $_GET['id']], "department", "department", "ASC");

    $contractsdepart_n = getTableFiltered2("department", ["client_name" => $_GET['id']], "id", "id", "ASC");
    $contract_usages = getTableFiltered("contract_usages", "contractid", $_GET['id']);
    $assets = getTableFiltered("assets", "clientid", $_GET['id']);
    $licenses = getTableFiltered("licenses", "clientid", $_GET['id']);
    $credentials = getTableFiltered("credentials", "clientid", $_GET['id']);
    $issues = getTableFiltered("issues", "clientid", $_GET['id']);
    $tickets = getTableFiltered("tickets", "clientid", $_GET['id']);

    $users = getTableFiltered("people", "clientid", $_GET['id']);

    $department_a = getTableFiltered("department", "client_name", $_GET['id']);
    $admins = getTableFiltered("people", "type", "admin");
    $assignedadmins = getTableFiltered("clients_admins", "clientid", $_GET['id']);
    $sumAssets = countTableFiltered("assets", "clientid", $_GET['id']);
    $sumLicenses = countTableFiltered("licenses", "clientid", $_GET['id']);
    $sumCredentials = countTableFiltered("credentials", "clientid", $_GET['id']);
    $sumUsers = countTableFiltered("people", "clientid", $_GET['id']);
    $sumContract = countTableFiltered("contract", "clientid", $_GET['id']);
    $categories = getTable("assetcategories");
    $files = getTableFiltered("files", "clientid", $_GET['id'], "file[!]", NULL);
    $projects = getTableFiltered("projects", "clientid", $_GET['id']);
    $invoice = getTableFiltered("invoice", "clintid", $_GET['id']);
    $unpaidinvoice = getRecordsWithCondition('invoice', 'balance', '>', '0', 'clintid', '=', $_GET['id']);
    $pendinginvoice = getRecordsWithConditionPending('invoice', 'clintid', '=', $_GET['id'], 'tax_file_2307', 'IS', 'NULL');
    $recentcontracts = getTableFiltered2("contract", ["clientid" => $_GET['id']], "*", "id", "DESC", "5");
    $getToFollowRecords = getToFollowRecords('invoice', 'clintid', '=', $_GET['id']);
    $labels = getTable("labels");
    if (isset($_GET['status']) && $_GET['status'] != '') {
        $cliendid = $_GET['id'];
        $is_end = $_GET['status'];
        if ($is_end == 3) {
            $contracts = getTableFiltered2("contract", ["clientid" => $_GET['id']], "*", "id", "ASC");
        } else {
            $query = $database->query("SELECT * from contract WHERE clientid = $cliendid AND  is_end = $is_end  ORDER BY id ASC");
            $contracts = $query->fetchAll();
        }
    } else if (isset($_GET['status_expiered']) && $_GET['status_expiered'] != '') {
        // $date1 = $contract['contract_expiry'];
        // $date2 = date('Y-m-d');
        $cliendid = $_GET['id'];
        $is_end = 0;
        $query = $database->query("SELECT * from contract WHERE clientid = $cliendid AND  is_end = $is_end  ORDER BY id ASC");
        $contracts = $query->fetchAll();
        $filtered_contracts = [];
        foreach ($contracts as $key => $value) {
            $date1 = $value['contract_expiry'];
            $date2 = date('Y-m-d');
            $is_expired = get_expierd_contract($date1, $date2);
            if ($is_expired) {
                $filtered_contracts[] = $value;
            }
        }
        $contracts = $filtered_contracts;
    } else {
        $cliendid = $_GET['id'];
        // $contracts = getTableFiltered2("contract", ["clientid" => $_GET['id']], "*", "id", "ASC");
        $is_end = 0;
        $query = $database->query("SELECT * from contract WHERE clientid = $cliendid AND  is_end = $is_end  ORDER BY id ASC");
        $contracts = $query->fetchAll();
    }
    $active_contracts = getTableFiltered("contract", "clientid", $_GET['id'], "is_end", 0);
    $end_contracts = getTableFiltered("contract", "clientid", $_GET['id'], "is_end", 1);
    $openTickets = $database->select("tickets", "*", ["AND" => ["status" => ["Open", "Reopened"], "clientid" => $_GET['id']]]);
    $openTicketsall = $database->select("tickets", "*", ["AND" => ["status[!]" => ["Closed"], "clientid" => $_GET['id']]]);
    $closeTicketsall = $database->select("tickets", "*", ["AND" => ["status" => ["Closed"], "clientid" => $_GET['id']]]);
}

// ADMINS
if ($route == "people/admins")
    $admins = getTableFiltered("people", "type", "admin");
if ($route == "people/admins/profile")
    $admin = getRowById("people", $_GET['id']);

// USERS
if ($route == "people/users") {
    $users = getTableFiltered("people", "type", "user");
}
if ($route == "people/users/profile") {
    $user = getRowById("people", $_GET['id']);
    $clients = getTable("clients");
}

// LABELS
if ($route == "system/labels")
    $labels = getTable("labels");

// ASSET CATEGORIES
if ($route == "system/assetcategories")
    $categories = getTable("assetcategories");
// CONTRACT TYPE
if ($route == "system/contracttype")
    $contracttypes = getTable("contracttype");

// CLIENT TYPE
if ($route == "system/clienttype")
    $clienttypes = getTable("clienttype");


// LICENSE CATEGORIES
if ($route == "system/licensecategories")
    $categories = getTable("licensecategories");
//
if ($route == "system/contract_categories")
    $contract_categories = getTable("assetcategories");

// MANUFACTURERS
if ($route == "system/manufacturers")
    $manufacturers = getTable("manufacturers");

// Warehouse
if ($route == "system/warehouselist")
    $warehouse = getTable("warehouse");

// Consumable
if ($route == "system/consumable")
    $consumable = getTable("consumable_list");

//ticketstype
if ($route == "system/tickettype") {
    $configtable = getTable12("config");
}
//ticket subject list
if ($route == "system/ticketsubject")
    $subject = getTable("ticketsubject");

if ($route == "system/ticket_action_list"){
    $subject = getTable("ticket_action");
}
    

if ($route == "system/emailtemplete")
    $subject = getTableFiltered("notificationtemplates", "type", "emailtemplete");
$category = getTable("emailtempletecategory");

if ($route == "system/emailtempletecategory")
    $subject = getTable("emailtempletecategory");

// SUPPLIERS
if ($route == "system/suppliers")
    $suppliers = getTable("suppliers");

// MODELS
if ($route == "system/models") {
    $models = getTable("models");
}

// LOGS
if ($route == "system/logs") {
    $systemLog = getTable("systemlog");
    $emailLog = getTable("emaillog");
    $SMSLog = getTable("smslog");
}

// SYSTEM SETTINGS
if ($route == "system/logs") {
    $emailtemplates = getTable("emailTemplates");
}




// KNOWLEDGE BASE

if ($route == "kb") {

    //isAuthorized("viewKB");
    $isAdmin = false;
    if ($lia['role'] == 'admin') {
        $isAdmin = true;
    }

    if ($isAdmin) {

        $categories = getTable("kb_categories");



        if (!isset($_GET['id'])) $id = 0;
        else $id = $_GET['id'];
        if ($id > 0) {
            $articles = getTableFiltered("kb_articles", "categoryid", $id);
        } else {
            $articles = getTable("kb_articles");
        }
    } else {

        // get categories

        $categories = getTable("kb_categories");

        foreach ($categories as $key => $category) {



            if ($category['clients'] == "") unset($categories[$key]);

            else {

                $clients = unserialize($category['clients']);

                if (in_array(0, $clients)) continue;

                else if (!in_array($liu['clientid'], $clients)) unset($categories[$key]);
            }
        }



        // get articles

        if (!isset($_GET['id'])) $id = 0;
        else $id = $_GET['id'];

        if ($id > 0) {
            $articles = getTableFiltered("kb_articles", "categoryid", $id);
        } else {
            $articles = getTable("kb_articles");
        }
        // $articles = getTableFiltered("kb_articles", "categoryid", $id);

        foreach ($articles as $key => $article) {



            if ($article['clients'] == "") unset($articles[$key]);

            else {

                $clients = unserialize($article['clients']);

                if (in_array(0, $clients)) continue;

                else if (!in_array($liu['clientid'], $clients)) unset($articles[$key]);
            }
        }
    }



    //$pageTitle = __("Knowledge Base");



}


/// kb







/* if ($route == "kb") {
	$id=$_GET['routeid'];
    $kb_articles = getTable("kb_articles");
	 $kb_categories = getTable("kb_categories");
	 $kbcategories = getTable("kb_categories", ['id'=>$id]);
	
	 $clients = getTable("clients");
} */


if ($route == "kbedit") {
    $clients = getTable("clients");
}
// CONTRACT
if ($route == "contract") {
    //$contract = getTableFiltered("contract", "clientid[<>]", [1,999998]);//getTable("contract");
    $contracts = getTable("contract");
    //    cs_debug($contracts);
}
if ($route == "contract/active") {
    $contracts = getTableFiltered("contract", "is_end", 0); //getTable("contract");
    //    cs_debug($contracts);
}
if ($route == "contract/end") {
    $contracts = getTableFiltered("contract", "is_end", 1); //
}
if ($route == "contract/Resume" && $_GET['contractid']) {
    $status = ResumeContract($_GET);
    header("Location:?route=contract/manage&id=" . $_GET['contractid'] . "&status=" . $status);
}

if ($route == "contract/OnHold" && $_GET['contractid']) {
    $status = HoldContract($_GET);
    header("Location:?route=contract/manage&id=" . $_GET['contractid'] . "&status=" . $status);
}

if ($route == "contract/create" && $_GET['warehouseid']) {
    global $database;
    $clientid = isset($_GET['clientid']) ? $_GET['clientid'] : '';
    $clients = getTable("clients");
    //    $admins = getTableFiltered("people", "type", "admin");
    //    $users = getTableFiltered("people", "type", "user");
    $models = getTable("models");
    $people = getTable("people");
    //    $manufacturers = getTable("manufacturers");
    $contracttypes = getTable("contracttype");
    $categories = getTable("assetcategories");
    $dpname = getTable("department");
    $warehouses = getTable("warehouse");
    //    $labels = getTable("labels");
    //    $suppliers = getTable("suppliers");
    $assets = getTableFiltered("assets", "status", "Available", "warehouseid", $_GET['warehouseid']);
    $query = $database->query("SELECT assets.id, assets.tag, assets.serial, models.name FROM assets JOIN models ON assets.modelid = models.id WHERE assets.clientid = 0");
    // $assets = $query->fetchAll(); //$database->select("assets",["[>]models" => ['assets.modelid' => 'id'],], ['id','tag','models.name' ], 'assets.clientid = 0');
    //    var_dump($assets);die();

} elseif ($route == "contract/create") {
    global $database;
    $clientid = isset($_GET['clientid']) ? $_GET['clientid'] : '';
    $clients = getTable("clients");
    //    $admins = getTableFiltered("people", "type", "admin");
    //    $users = getTableFiltered("people", "type", "user");
    $models = getTable("models");
    //    $manufacturers = getTable("manufacturers");
    $contracttypes = getTable("contracttype");
    $categories = getTable("assetcategories");
    $warehouses = getTable("warehouse");
    $dpname = getTable("department");
    $people = getTable("people");
    //    $suppliers = getTable("suppliers");
    $assets = $assets = getTableFiltered("assets", "status", "Available");
    $query = $database->query("SELECT assets.id, assets.tag, assets.serial, models.name FROM assets JOIN models ON assets.modelid = models.id WHERE assets.clientid = 0");
    // $assets = $query->fetchAll(); //$database->select("assets",["[>]models" => ['assets.modelid' => 'id'],], ['id','tag','models.name' ], 'assets.clientid = 0');
    //    var_dump($assets);die();
}


if ($route == "contract/manage") {
    $contract = getRowById("contract", $_GET['id']);
    $is_page_plan = isset($contract['contract_condition']) && $contract['contract_condition'] == 'page_plan' ? 'yes' : 'no';
    $clientname = getSingleValue('clients', 'name', $contract['clientid']);
    $clients = getTable("clients");
    $people = getTable("people");
    $dpname = getTable("department");
    //    $admins = getTableFiltered("people", "type", "admin");
    //    $users = getTableFiltered("people", "type", "user");
    $models = getTable("models");
    $clients = getTable("clients");
    //    $manufacturers = getTable("manufacturers");
    $contracttypes = getTable("contracttype");
    $categories = getTable("assetcategories");

    if (isset($_GET['sfdate']) && isset($_GET['efdate'])) {
        $startdate = $_GET['sfdate'] . " 00:00:00";
        $enddate = $_GET['efdate'] . " 00:00:00";
        $tickets = $database->select(
            "tickets",
            "*",
            [
                "AND" => [
                    "contractid" => $_GET['id'],
                    "timestamp[<>]" => [$startdate, $enddate]
                ]
            ]
        );
        $is_section = 'tickets';
    } elseif (isset($_GET['quick_filter'])) {
        $quick_filter = $_GET['quick_filter'];

        $current_date = date('Y-m-d H:i:s');
        $past_date = date('Y-m-d H:i:s', strtotime("-$quick_filter days"));

        $tickets_sql = "SELECT * FROM `tickets` WHERE `timestamp` >= '$past_date' 
                AND contractid = " . $_GET['id'];
        $query = $database->query($tickets_sql);
        $tickets = $query->fetchAll();

        $is_section = 'tickets';
    } else {
        $tickets = getTableFiltered("tickets", "contractid", $_GET['id']);
    }
    $tickets_count = count($tickets);
    $consumable = getTableFiltered("consumable", "contract", $_GET['id']);

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
    $files = getTableFiltered("contract_files", "contractid", $_GET['id'], "file[!]", NULL);
    $lastcontract = getlastdata('contract_usages', '*', array("contractid" => $_GET['id']));


    if ($_GET['sfdate'] && $_GET['efdate']) {
        $sfdate = $_GET['sfdate'];
        $efdate = $_GET['efdate'];

        $contract_usages = $database->select("contract_usages", "*", ["AND" => ["enddate[<>]" => [$sfdate, $efdate], "contractid" => $_GET['id']]], "*", "id", "DESC");
    } else {
        $contract_usages = getTableFiltered2("contract_usages", ["contractid" => $_GET['id']], "*", "id", "DESC");

        // $get_ref_no = get_ref_no_by_contract_id($_GET['id']);
        // $contract_usages_1 = [];
        // foreach ($contract_usages as $contract_usage) {
        //     $contract_usage['get_ref_no'] = $get_ref_no['ref_no'];
        //     $contract_usages_1[] = $contract_usage;
        // }
        // $contract_usages = $contract_usages_1;
        $filter_data = [];
        foreach ($contract_usages as $value) {
            if ($value['add_page_count_by_order_reference'] != '') {
                $data = get_usage_report_data_by_id($value['add_page_count_by_order_reference']);
                if (!empty($data) && !empty($data[0])) {
                    $value['ref_no'] = $data[0]['ref_no'];
                } else {
                    $value['ref_no'] = '';
                }
            } else {
                $value['ref_no'] = '';
            }
            $filter_data[] = $value;
        }
        $contract_usages = $filter_data;
    }
    $query = $database->query("SELECT assets.*, models.name as model_name FROM assets JOIN models ON assets.modelid = models.id WHERE assets.clientid = 0 OR assets.id = " . $contract['assetid']);
    $assets = $query->fetchAll();

    //echo $contract['contractno'];


    $allsame = getTableFiltered("contract", "contractno", $contract['contractno']);
    $histories = array();
    $histo = array();


    foreach ($allsame as $same) {
        $his = array();

        $query = $database->query(
            "SELECT contract_history.id as history_id,contract_history.deployeddate, contract_history.pulledoutdate,contract_history.memo,contract_history.maintenance, assets.*, models.name as model_name "
                . "FROM contract_history "
                . "LEFT JOIN assets ON assets.id = contract_history.assetid "
                . "LEFT JOIN models ON assets.modelid = models.id "
                . "WHERE contract_history.contractid = " . $same['id']
                . " ORDER BY contract_history.id DESC"
        );

        $his = $query->fetchAll();

        array_push($histo, $his);
    }

    foreach ($histo as $history) {

        foreach ($history as $hist) {

            array_push($histories, $hist);
        }
    }
}

if ($route == "contract/get_asset") {
    global $database;

    $sql = "SELECT assets.*, models.name as model_name,manufacturers.name as asset_type "
        . "FROM assets "
        . "LEFT JOIN models ON assets.modelid = models.id "
        . "LEFT JOIN manufacturers ON manufacturers.id = assets.manufacturerid WHERE assets.id = " . $_GET['id'];

    $query = $database->query($sql);
    //die($database->last_query());
    $asset = $query->fetch();
    die(json_encode($asset));
}

if ($route == "consumable/get_consumable") {
    global $database;
    $sql = getRowById("consumable_list", $_GET['id']);
    die(json_encode($sql));
}
if ($route == "contract/get_technician") {

    $sql = getRowById("people", $_GET['id']);
    die(json_encode($sql));
}


if ($route == "contract/imagedelete") {
    global $database, $scriptpath;

    $sql = getRowById("contract_usages", $_GET['dataId']);

    $attachmentArray = unserialize($sql['attachment']);

    $filenameToRemove = isset($_GET['filename']) ? $_GET['filename'] : '';

    $keyToRemove = array_search($filenameToRemove, $attachmentArray);

    if ($keyToRemove !== false) {
        unset($attachmentArray[$keyToRemove]);
    }

    $sql['attachment'] = serialize($attachmentArray);

    $deleted = $database->update("contract_usages", ["attachment" => $sql['attachment']], ["id" => $_GET['dataId']]);

    $host  = $_SERVER['HTTP_HOST'];
    $host_upper = strtoupper($host);
    $path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $baseurl = "http://" . $host . $path . "/";

    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "usage_file_attachment" . DIRECTORY_SEPARATOR;


    $imagePath = $targetdir . $_GET['filename'];

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    die(json_encode($sql));
}


if ($route == "contract/contractimagedelete") {
    global $database, $scriptpath;

    $sql = getRowById("contract_usages", $_GET['dataId']);

    $attachmentArray = unserialize($sql['attachment']);

    $filenameToRemove = isset($_GET['filename']) ? $_GET['filename'] : '';

    $keyToRemove = array_search($filenameToRemove, $attachmentArray);

    if ($keyToRemove !== false) {
        unset($attachmentArray[$keyToRemove]);
    }

    $sql['attachment'] = serialize($attachmentArray);

    $deleted = $database->update("contract_usages", ["attachment" => $sql['attachment']], ["id" => $_GET['dataId']]);

    $host  = $_SERVER['HTTP_HOST'];
    $host_upper = strtoupper($host);
    $path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $baseurl = "http://" . $host . $path . "/";

    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "usage_file_attachment" . DIRECTORY_SEPARATOR;

    $imagePath = $targetdir . $_GET['filename'];

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    die(json_encode($sql));
}

if ($route == "contract/DeleteContarctRecord") {
    global $database, $scriptpath;

    $id_to_delete = $_GET['id'];

    $contract_usage = getRowById("contract_usages",  $id_to_delete);

    $attachment_info = unserialize($contract_usage['attachment']);

    $targetdir = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "usage_file_attachment" . DIRECTORY_SEPARATOR;

    $deleted = $database->delete("contract_usages", ["id" => $id_to_delete]);


    if ($deleted) {
        foreach ($attachment_info as $filename) {

            $image_path = $targetdir  . $filename;

            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
    }

    die(json_encode($id_to_delete));
}



if ($route == "contract/replaceassets" && $_GET['wh']) {
    global $database;
    $assets = getTableFiltered("assets", "status", "Available", "warehouseid", $_GET['wh']);
    $assettotalCount = $database->count("assets", "status", "Available", "warehouseid", $_GET['wh']);
} elseif ($route == "contract/replaceassets") {
    global $database;
    $assets = getTableFiltered("assets", "status", "Available");
    $assettotalCount = $database->count("assets", "status", "Available");
}
if ($route == "contract/endcontract") {
    $status = endcontract($_GET['coid']);

    header("Location:?route=" . $_GET['reroute'] . "&id=" . $_GET['id']);
}
if ($route == "contract/get_contracttype") {
    global $database;

    $contracttype = getRowById("contracttype", $_GET['id']);
    die(json_encode($contracttype));
}

if ($route == "tickets/get_contract") {
    global $database;

    $query = $database->query(
        "SELECT contract.id,contract.contractno,contract.department, assets.tag as asset_tag, assets.serial, models.name as asset_model "
            . "FROM contract "
            . "LEFT JOIN assets ON assets.id = contract.assetid "
            . "LEFT JOIN models ON assets.modelid = models.id "
            . "WHERE contract.clientid=" . $_GET["clientid"] . " AND contract.is_end=0"
            . " ORDER BY contract.id DESC"
    );

    //$query = $database->query("SELECT id , contractno FROM contract WHERE clientid=" . $_GET["clientid"]);
    $contracts = $query->fetchAll();
    $query2 = $database->query("SELECT id , name, email FROM people WHERE clientid=" . $_GET["clientid"]);
    $users = $query2->fetchAll();
    $response = array('contracts' => [], 'users' => []);
    foreach ($contracts as $contract) {
        $response['contracts'][] = array('id' => $contract['id'], 'text' => $contract['contractno'] . " " . $contract['asset_tag'] . ":" . $contract['asset_model'] . " " . $contract['department']);
    }
    foreach ($users as $user) {
        $response['users'][] = $user;
    }
    //getTableFiltered2("contract",["clientid" => $_GET["clientid"] ], ["id", "contractno as text"]);
    die(json_encode($response));
}

if ($route == "pdf/contract_history") {
    global $database, $mpdf;
    //    $history = getRowById("contract_history", $_GET['id']);
    $sql = "SELECT contract_history.id as history_id,contract_history.deployeddate, "
        . " contract_history.pulledoutdate,contract_history.memo,contract_history.maintenance, "
        . " contract.contractno, contract.contract_amount, contract.template, contract.contract_expiry, "
        . " assets.tag, assets.name as assetname, assets.serial, "
        . " models.name as model_name, contracttype.name as contracttype "
        . " FROM contract_history "
        . " JOIN assets ON assets.id = contract_history.assetid "
        . " JOIN models ON assets.modelid = models.id "
        . " JOIN contract ON contract_history.contractid = contract.id "
        . " JOIN contracttype ON contract.contracttype = contracttype.id "
        . " WHERE contract_history.id = " . $_GET['id']
        . " ORDER BY contract_history.id DESC";
    //    cs_debug($sql); 
    $query = $database->query($sql);
    //$histories = getTableFiltered("contract_history", "contractid", $_GET['id']);

    $histories = $query->fetchAll();
    $history = $histories[0];
    //echo $route;
    //    cs_debug($history); 
    ob_start();
    include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.html');
    $html = ob_get_contents();
    ob_end_clean();

    ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">
    //this the the PDF filename that user will get to download
    $pdfFilePath = "_contract.pdf";

    //generate the PDF from the given html
    $mpdf->WriteHTML($html);

    //download it.
    $mpdf->Output($pdfFilePath, "I");
    exit;
}
if ($route == "pdf/ticketsfil") {
    global $database, $mpdf, $scriptpath;
    //    $history = getRowById("contract_history", $_GET['id']);

    if ($_GET['sfdate'] && $_GET['efdate'] && $_GET['companyname']) {


        $startdate = $_GET['sfdate'] . " 00:00:00";
        $enddate = $_GET['efdate'] . " 00:00:00";

        $tickets = $database->select(
            "tickets",
            "*",
            [
                "AND" => [
                    "clientid" => $_GET['companyname'],
                    "timestamp[<>]" => [$startdate, $enddate]
                ]
            ]
        );
    } elseif ($_GET['sfdate'] && $_GET['efdate']) {


        $startdate = $_GET['sfdate'] . " 00:00:00";
        $enddate = $_GET['efdate'] . " 00:00:00";

        $tickets = $database->select("tickets", "*", [
            "timestamp[<>]" => [$startdate, $enddate]
        ]);
    } elseif ($_GET['companyname']) {


        global $database;
        $query = $database->query(
            "SELECT *
  FROM tickets
   WHERE clientid = " . $_GET['companyname'] . "
   
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC
			  "
        );

        $tickets = $query->fetchAll();
    } else {
        global $database;
        //  $tickets = getticketTable("tickets");
        $query = $database->query("SELECT *
  FROM tickets
 ORDER BY  
          CASE 
            WHEN status = 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END,
          CASE 
            WHEN status <> 'open' 
              THEN UNIX_TIMESTAMP(timestamp) END DESC");
        $tickets = $query->fetchAll();
    }


    ob_start();
    include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.php');
    $html = ob_get_contents();
    ob_end_clean();
    //exit();

    ini_set('memory_limit', '64M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">
    //this the the PDF filename that user will get to download
    $pdfFilePath = "tiketsfil_report.pdf";

    //generate the PDF from the given html
    $mpdf->WriteHTML($html);

    //download it.
    $mpdf->Output($pdfFilePath, "I");
    exit;
}




if ($route == "pdf/ticket_report") {
    global $database, $mpdf, $scriptpath;
    //    $history = getRowById("contract_history", $_GET['id']);
    $sql = "SELECT tickets.ticket, tickets.subject, tickets.timestamp, clients.name as client "
        . " FROM tickets "
        . " LEFT JOIN clients ON clients.id = tickets.clientid "
        . " WHERE tickets.id = " . $_GET['id'];
    //    cs_debug($sql); 
    $query = $database->query($sql);
    //$histories = getTableFiltered("contract_history", "contractid", $_GET['id']);

    $ticket = $query->fetch();
    //    cs_debug($ticket); 
    ob_start();
    include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.php');
    $html = ob_get_contents();
    ob_end_clean();
    //exit();

    ini_set('memory_limit', '64M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">
    //this the the PDF filename that user will get to download
    $pdfFilePath = "tiket_report_" . $ticket['ticket'] . ".pdf";

    //generate the PDF from the given html
    $mpdf->WriteHTML($html);

    //download it.
    $mpdf->Output($pdfFilePath, "I");
    exit;
}

if ($route == "pdf/issue_invoice") {
    global $database, $mpdf, $scriptpath;
    $doc_no = getDocNo();
    $clientname = getSingleValue('clients', 'name', $_GET['clientid']);
    $m = $_GET['month'];
    $month = getMonthName($m);
    $y = date('Y');
    $sql = "SELECT contract.id as contract_id, contract.contractno, contract.contract_amount, contract.department, contract.created_date, "
        . " assets.tag, assets.name as assetname, assets.serial, models.name as model_name, assets.caseserial "
        . " FROM contract "
        . " LEFT JOIN assets ON assets.id = contract.assetid "
        . " LEFT JOIN models ON assets.modelid = models.id "
        . " WHERE contract.is_end = 0 AND contract.clientid = " . $_GET['clientid']
        . " ORDER BY contract.id DESC";

    $query = $database->query($sql);
    $contracts = $query->fetchAll();
    if ($contracts) {
        ob_start();
        include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.php');
        $html = ob_get_contents();
        ob_end_clean();

        ini_set('memory_limit', '64M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "invoice.pdf";

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it.
        $mpdf->Output($pdfFilePath, "I");
        exit;
    } else {
        die('No contract to print invoice!');
    }
}
//all_invoice
if ($route == "pdf/all_invoice") {
    global $database, $mpdf, $scriptpath;
    $doc_no = getDocNo();
    $month = getMonthName($m);
    $y = date('Y');
    $sql = "SELECT contract.id as contract_id, contract.contractno, contract.contract_amount, contract.department, contract.created_date, "
        . " assets.tag, assets.name as assetname, assets.serial, models.name as model_name, assets.caseserial,clients.name as client_name"
        . " FROM contract "
        . " LEFT JOIN assets ON assets.id = contract.assetid "
        . " LEFT JOIN models ON assets.modelid = models.id "
        . " LEFT JOIN clients ON contract.clientid = clients.id "
        . " WHERE contract.is_end = 0 "
        . " ORDER BY clients.name ASC";

    $query = $database->query($sql);
    $contracts = $query->fetchAll();
    if ($contracts) {
        ob_start();
        include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.php');
        $html = ob_get_contents();
        ob_end_clean();

        ini_set('memory_limit', '64M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "invoice.pdf";

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it.
        $mpdf->Output($pdfFilePath, "I");
        exit;
    } else {
        die('No contract to print invoice!');
    }
}
//all status 

if ($route == "pdf/all_status") {
    global $database, $mpdf, $scriptpath;
    $doc_no = getDocNo();
    $month = getMonthName($m);
    $y = date('Y');
    $sql = "SELECT contract.id as contract_id, contract.contractno, contract.contract_amount, contract.department, contract.created_date, "
        . " assets.tag, assets.name as assetname, assets.serial, models.name as model_name, assets.caseserial,clients.name as client_name"
        . " FROM contract "
        . " LEFT JOIN assets ON assets.id = contract.assetid "
        . " LEFT JOIN models ON assets.modelid = models.id "
        . " LEFT JOIN clients ON contract.clientid = clients.id "
        . " WHERE contract.is_end = 0 "
        . " ORDER BY clients.name ASC";

    $query = $database->query($sql);
    $contracts = $query->fetchAll();
    if ($contracts) {
        ob_start();
        include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.php');
        $html = ob_get_contents();
        ob_end_clean();

        ini_set('memory_limit', '64M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "invoice.pdf";

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it.
        $mpdf->Output($pdfFilePath, "I");
        exit;
    } else {
        die('No contract to print invoice!');
    }
}


// SUPPLIERS
if ($route == "email") {
    $clients = getTableFiltered("clients", 'is_active', 1);
}

if ($route == "printlable") {




    global $database, $mpdf, $scriptpath;
    if (isset($_POST['check'])) {
        $conno = $_POST['check'];
        foreach ($conno as $conn) {
            // $clientname = getSingleValue('clients', 'name', $_GET['id']);
            $sql = "SELECT contract.id as contract_id, contract.contractno,"
                . " assets.tag, assets.name as assetname, assets.serial, models.name as model_name, assets.caseserial, assets.sku, "
                . " clients.name as cname "
                . " FROM contract "
                . " LEFT JOIN clients ON clients.id = contract.clientid "
                . " LEFT JOIN assets ON assets.id = contract.assetid "
                . " LEFT JOIN models ON assets.modelid = models.id "
                . " WHERE contract.is_end = 0 AND contract.id = " . $conn
                . " ORDER BY contract.id DESC";
            $query = $database->query($sql);
            $contr = $query->fetchAll();
            $contracts[] = $contr[0];
        }

        if ($contracts) {
            ob_start();
            include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.php');
            $html = ob_get_contents();
            ob_end_clean();

            ini_set('memory_limit', '64M');
            $pdfFilePath = "invoice.pdf";


            $mpdf->WriteHTML($html);            //generate the PDF from the given html

            $mpdf->Output($pdfFilePath, "I");         //download it.
            exit;
        } else {
            die('No contract to print invoice!');
        }
    }

    header("Location:?route=clients/manage&id=" . $_GET['id'] . "&status=88");
}

if ($route == "system/slide") {
    $clients = getTableasc("slider", "*", "groupnm");
}

if ($route == "system/banner") {
    $clients = getTable("banner");
}



if ($route == "banner/edit") {
    $clients = getTableFiltered("banner", "id", $_GET['id']);
}

if ($route == "slide/edit") {
    $clients = getTableFiltered("slider", "id", $_GET['id']);
}

if ($route == "slide/allgroup") {
    $clients = getTableasc("slider_group", "*", "groupnm");
}

//* department  add /

if ($route == "system/department") {
    $document_type = getTable("document_type");
}

if ($route == "department/edit") {
    $document_type = getTableFiltered("document_type", "id", $_GET['id']);
}



if (isset($_POST['editslidtext'])) {
    $status = editslidtext($_POST);
    header("Location:?route=" . $_POST['route'] . "&status=" . $status);
}

if (isset($_POST['fileEdit'])) {
    $status = fileEdit($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
}
if (isset($_POST['send_email_new_rprt'])) {

    //echo "hiiii";
    // echo "<pre>";
    // print_r($_POST);
    $status = send_email_new_rprt($_POST, $_FILES);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
    // die("here");
}
if (isset($_POST['report_client'])) {

    //echo "hiiii";
    // echo "<pre>";
    // print_r($_POST);
    $status = report_client($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['routeid'] . "&status=" . $status . "&section=" . $_POST['section']);
    // die("here");
}




if ($route == "pdf/invoice") {
    global $database, $mpdf, $scriptpath;
    $doc_no = getDocNo();
    $clientname = getSingleValue('clients', 'name', $_GET['clientid']);
    $m = $_GET['month'];
    $month = getMonthName($m);
    $y = date('Y');
    $sql = "SELECT contract.id as contract_id, contract.contractno, contract.contract_amount, contract.department, contract.created_date, "
        . " assets.tag, assets.name as assetname, assets.serial, models.name as model_name, assets.caseserial "
        . " FROM contract "
        . " LEFT JOIN assets ON assets.id = contract.assetid "
        . " LEFT JOIN models ON assets.modelid = models.id "
        . " WHERE contract.is_end = 0 AND contract.clientid = " . $_GET['clientid']
        . " ORDER BY models.name DESC";
    $query = $database->query($sql);
    $contracts = $query->fetchAll();
    if ($contracts) {
        ob_start();
        include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.php');
        $html = ob_get_contents();
        ob_end_clean();

        ini_set('memory_limit', '64M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "invoice.pdf";

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it.
        $mpdf->Output($pdfFilePath, "I");
        exit;
    } else {
        die('No contract to print invoice!');
    }
}
if ($route == "pdf/inv") {
    global $database, $mpdf, $scriptpath;
    $doc_no = getDocNo();
    $clientname = getSingleValue('clients', 'name', $_GET['clientid']);
    $m = $_GET['month'];
    $month = getMonthName($m);
    $y = date('Y');
    $sql = "SELECT contract.id as contract_id, contract.contractno, contract.contract_amount, contract.department, contract.created_date, "
        . " assets.tag, assets.name as assetname, assets.serial, models.name as model_name, assets.caseserial "
        . " FROM contract "
        . " LEFT JOIN assets ON assets.id = contract.assetid "
        . " LEFT JOIN models ON assets.modelid = models.id "
        . " WHERE contract.is_end = 0 AND contract.clientid = " . $_GET['clientid']
        . " ORDER BY models.name DESC";
    $query = $database->query($sql);
    $contracts = $query->fetchAll();
    if ($contracts) {
        ob_start();
        include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.php');
        $html = ob_get_contents();
        ob_end_clean();

        ini_set('memory_limit', '64M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">

        $pdfFilePath = "invoice.pdf";

        //generate the PDF from the given html
        $mpdf->WriteHTML($html);

        //download it.
        $mpdf->Output($pdfFilePath, "I");
        exit;
    } else {
        die('No contract to print invoice!');
    }
}



if ($route == "reports/calendar_view") {
    $clients = getTableFiltered3("clients", "*");
}
//collection email 
if ($route == "client/collection_email") {
    $collection_client = $_GET['clientid'];
    $response = collectionSendmail($collection_client);
    header("Location: ?route=clients/active&status=" . $response);
}

// missing_page_count_email 
if ($route == "missing_page_count/email") {
    $email_client_id = $_GET['client_id'];
    $email_contract_no = $_GET['contract_no'];
    $year_month = $_GET['year_month'];
    $response = missing_page_count_email($email_client_id, $email_contract_no);
    header("Location: ?route=missing_page_count&year_month=" . $year_month . "&email=" . $response);
}

//collection email code ends here
if ($route == "reports/admincalendarview") {

    $ticket = array();
    if (isset($_GET['client']) && $_GET['client'] != "") {
        $assets = getTableFiltered("tickets", "clientid", $_GET['client']);
    } else {
        $assets = getTableFiltered3("tickets", "*");
    }
    //$assets = getTableFiltered("tickets", "clientid", $lia['clientid']);

    $i = 0;
    // echo "<pre>";
    // print_r($assets);
    foreach ($assets as $asset) {
        $subject =    getRowById("ticketsubject", $asset['subject']);
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



if ($route == "exportclientdata") {
    $clients = getTableFilteredsorbynm("clients", 'is_active', 1);
    // $clients_inact = getTableFilteredsorbynm("clients", 'is_active', 0);
    // $tickets = getTable("tickets");
    $records = array();
    foreach ($clients as $k => $client) {
        // $total = getTotalAmount("contract", "contract_amount", "clientid", $client['id'], "is_end", 0);
        // $total1 = getTotalAmount("licenses", "amount", "clientid", $client['id']);
        // $to = $total + $total1;

        // $email_history = getTableFiltered("invoicesentmailhistory", "clintid", $client['id'], "type", "all", "*", "id", "DESC");
        // $letest_email_history = $email_history[0] ? date('Y-m-d', strtotime($email_history[0]['date'])) : '';

        // $check = '-';
        // if ($client['is_paymentReady'] == 1) {
        //     $check = 'checked';
        // }

        // $records[$k]['client'] =  $client['name'];
        // $records[$k]['letest follow up date'] =  $letest_email_history;
        // $records[$k]['check'] =  $check;
        // $records[$k]['invoice memo'] =  $client['invoice_collection_note'];
        // $records[$k]['Amount'] = number_format($to);
        $d = [];

        $d['ctypes'] = getSingleValue("clienttype", "name", $client['clienttypes']);
        $d['cname'] = $client['name'];
        $d['tax_identification_number'] = $client['tax_identification_number'];

        $total = getTotalAmount("contract", "contract_amount", "clientid", $client['id'], "is_end", 0);
        $d['rental'] = $total;

        $get_license_data = get_licenses_by_client($client['id']);
        $licenses_amount = 0;
        if (!empty($get_license_data)) {
            foreach ($get_license_data as $each_license) {
                $licenses_amount += $each_license['amount'];
            }
        }
        if ($licenses_amount > 0) {
            $formated_licenses_amount = number_format($licenses_amount);
        } else {
            $formated_licenses_amount = '';
        }
        $d['licenses_amount'] = $formated_licenses_amount;

        $d['total'] = $total + $licenses_amount;

        $invoices = getTableFiltered("invoice", "clintid", $client['id']);
        $countPaidInvoices = 0;

        foreach ($invoices as $invoice) {
            if ($invoice['paid'] == 0) {
                $countPaidInvoices++;
            }
        }
        $d['np'] = $countPaidInvoices;

        $not_cleared_count = get_not_cleared_invoice_count_by_client($client['id']);
        $d['nc'] = $not_cleared_count;

        $total_balance = getTotalAmount('invoice', 'balance', 'clintid', $client['id']);
        $d['balance'] = $total_balance;

        $expired_contract_count =  get_expierd_contract_count_by_client($client['id']);
        $d['ec'] = $expired_contract_count;

        $ac_count = get_ac_count_by_client($client['id']);
        $d['ac'] = $ac_count;

        $hcontracts = getTableFiltered2("contract", ["clientid" => $client['id']], "*", "id", "DESC");
        $deposit_count = 0;
        foreach ($hcontracts as $hcontract) {
            $deposit_count += $hcontract['deposit'];
        }
        $d['deposit'] = $deposit_count;

        // add to main array 
        $records[$k]['Types'] = $d['ctypes'];
        $records[$k]['Name'] = $d['cname'];
        $records[$k]['TIN Number'] = $d['tax_identification_number'];
        $records[$k]['Rental'] = $d['rental'];
        $records[$k]['Licenses'] = $d['licenses_amount'];
        $records[$k]['Total'] = $d['total'];
        $records[$k]['NP'] = $d['np'];
        $records[$k]['NC'] = $d['nc'];
        $records[$k]['Balance'] = $d['balance'];
        $records[$k]['EC'] = $d['ec'];
        $records[$k]['AC'] = $d['ac'];
        $records[$k]['Deposit'] = $d['deposit'];
    }
    // echo "<pre>";
    // print_R($record);
    // die("here");
    $filename = "Exportclient.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $heading = false;
    if (!empty($records))
        foreach ($records as $row) {
            if (!$heading) {
                echo implode("\t", array_keys($row)) . "\n";
                $heading = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    exit;
}

// if ($route == "pendinginvoice/invsendmail") {
//     global $database, $mpdf, $scriptpath;

//     $users = getTableFiltered_collection("people", "clientid", $_GET['id']);

//     $invoices = getTableFiltered("invoice", "clintid", $_GET['id']);

//     if (!empty($users) && !empty($invoices)) {
//         $templateId = 10;

//         foreach ($users as $user) {
//             $invoiceNos = [];

//             foreach ($invoices as $invoice) {
//                 if ($invoice['paid'] == 0) {
//                     $invoiceNos[] = $invoice['invoiceno'];
//                 }
//             }

//             $search = array('{invoiceno}');
//             $template = getRowById("notificationtemplates", $templateId);
//             $subject = str_replace($search, implode(",",$invoiceNos), $template['subject']);
//             $message = str_replace($search, implode(",",$invoiceNos), $template['message']);

//             $sendMail = sendEmail($user['email'], $subject, $message, $user['clientid'], $user['id'], "", "");

//             if (!$sendMail) {
//                 header("Location:?route=invoice/pendinginvoice");
//             }
//             header("Location:?route=invoice/pendinginvoice");
//         }
//     }
// }

// if ($route == "pendinginvoice/taxfilesendmail") {
//     global $database, $mpdf, $scriptpath;

//     $users = getTableFiltered_collection("people", "clientid", $_GET['id']);

//     $invoices = getTableFiltered("invoice", "clintid", $_GET['id']);

//     if (!empty($users) && !empty($invoices)) {
//         $templateId = 11;

//         foreach ($users as $user) {
//             $invoiceNos = [];

//             foreach ($invoices as $invoice) {
//                 if ($invoice['tax_file_2307'] == '' || $invoice['tax_file_2307'] == NULL) {
//                     $invoiceNos[] = $invoice['invoiceno'];
//                 }
//             }

//             $search = array('{invoiceno}');
//             $template = getRowById("notificationtemplates", $templateId);
//             $subject = str_replace($search, implode(",",$invoiceNos), $template['subject']);
//             $message = str_replace($search, implode(",",$invoiceNos), $template['message']);

//             $sendMail = sendEmail($user['email'], $subject, $message, $user['clientid'], $user['id'], "", "");

//             if (!$sendMail) {
//                 header("Location:?route=invoice/pendinginvoice");
//             }
//             header("Location:?route=invoice/pendinginvoice");
//         }
//     }
// }



if ($route == "invoiceTemplateEmail") {
    global $database, $mpdf, $scriptpath;

    $users = getTableFiltered_collection("people", "clientid", $_GET['id']);

    $invoice = getTableFiltered("invoice", "id", $_GET['invoice_id']);

    $clientname = getSingleValue("clients", "name", $invoice[0]['clintid']);

    $contract_id = $invoice[0]['invoice_contract_id'];

    $invoice_datas = getinvoiceFiltered("contract", $contract_id);

    $logo = $database->get("config", "value", ["name" => "logo"]);

    $comapany_name = substr(getConfigValue("company_name"), 0, 3);

    $unique_identifier = uniqid();

    $current_date = date('Y_m_d');

    $filename = $comapany_name . '_' . $current_date . '_' . $unique_identifier;

    $pdfFilePath = $scriptpath . "/uploads/invoice/" . $filename . ".pdf";

    ob_start();

    include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.php');

    $html = ob_get_contents();
    ob_end_clean();

    $mpdf->WriteHTML($html);

    $mpdf->Output($pdfFilePath, "F");

    ini_set('memory_limit', '64M');


    $collection_user = getTableFiltered_collection("people", "clientid", $_GET['id']);

    if (!empty($collection_user)) {
        $templeteid = 8;

        $template = getRowById("notificationtemplates", $templeteid);

        $invoice = getTableFiltered("invoice", "id", $_GET['invoice_id']);

        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $host_upper = strtoupper($host);
        $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $baseurl = $protocol . "://" . $host . $path;

        $doc_url = "{$baseurl}?route=invoiceTPdf&id={$_GET['id']}&invoice_id={$_GET['invoice_id']}";

        $inv_file = $invoice[0]['attachment'];

        $paid_file = $invoice[0]['paid_file'];

        $or_file = $invoice[0]['or_file'];

        $emailtemplete = $template[0];
        $people = $collection_user[0];
        $subject = $emailtemplete['subject'];
        $message = $emailtemplete['message'];
        $clientdata =    getTableFiltered("clients", "id", $people['clientid']);
        $search = array('{clientname}');
        $searchinvoice = array('{viewinvoice}');
        // $replaceinvoice = "<br><a href='$doc_url'>View Invoice</a><br>";
        $replaceinvoice = "<br><a href='$doc_url' return false' style='display: inline-block; padding: 10px 0px; background-color: blue; color: white; text-decoration: none; border-radius: 5px;'>View Invoice</a><br>";

        $replace = array($clientdata[0]['name']);

        $contract_id = $invoice[0]['invoice_contract_id'];

        $invoice_datas = getinvoiceFiltered("contract", $contract_id);

        $logo = $database->get("config", "value", ["name" => "logo"]);

        if (!file_exists($invoicePath)) {
            mkdir($invoicePath, 0777, true);
        }

        $subject = str_replace($search, $replace, $template['subject']);

        $message = str_replace($searchinvoice, $replaceinvoice, $template['message']);

        $sendMail = sendEmail($people['email'], $subject, $message, $people['clientid'], $people['id'], "", $filename);


        if ($sendMail) {

            // $invoice_send_mail_count = getSingleValue("invoice", "send_mail_1", $_GET['invoice_id']);
            // $database->update("invoice", [
            //     "send_mail_1" => 1
            // ], ["id" => $_GET['invoice_id']]);
            $database->insert("invoicesentmailhistory", [
                "invoiceid" => $_GET['invoice_id'],
                "clintid" => $_GET['id'],
                "date" => date('Y-m-d H:i:s'),
            ]);
        }
    }

    if ($_GET['view'] == 1) {
        header("Location:?route=invoice");
    } else {
        header("Location:?route=clients/manage&id=" . $_GET['id'] . "&section=invoice");
    }
}

// if ($route == "invoiceMailTPdf") {

//     global $database, $mpdf, $scriptpath;

//     $invoice = getTableFiltered("invoice", "id", $_GET['invoice_id']);

//     $contract_id = $invoice[0]['invoice_contract_id'];

//     $invoice_datas = getinvoiceFiltered("contract", $contract_id); 

//     $logo = $database->get("config", "value", ["name" => "logo"]);

//     include($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $route . '.php');

//     ini_set('memory_limit', '64M');

//     $mpdf->WriteHTML($html);

//     $pdfFilePath = "invoice.pdf";

//     $mpdf->Output($pdfFilePath, "F");
//     exit;
// }

if ($route == 'clients/invoice' && isset($_POST['addContractInvoice'])) {
    UpdateInvoiceContract($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['invoice_id']);
}

if ($route == 'clients/editinvoice' && isset($_POST['editContractInvoice'])) {

    editInvoiceContract($_POST);
    header("Location:?route=" . $_POST['route'] . "&id=" . $_POST['invoice_id']);
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

if ($route == "invoice/clientpaymentchange") {
    global $database;
    $clientId = $_POST['clientId'];
    $is_paymentReady = $_POST['is_paymentReady'];
    $invId = updateClientPaymentStatus($is_paymentReady, $clientId);
    exit;
}

if ($route == "invoice/clientpaymentchangeall") {
    global $database;
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    $clientIds = $data['clientIds'];
    $invId = updateallClientPaymentStatus($clientIds);
    exit;
}

if ($route == "invoice/clientmemoChangeAll") {
    global $database;
    $jsonData = file_get_contents('php://input');
    $cleaned_string = str_replace("client_ids_string=", "", $jsonData);
    $data = explode("%2C", $cleaned_string);
    $clientIds = $data;
    $invId = updateallClientInvoicememo($clientIds);
    exit;
}

if ($route == "inquiry/submit_form") {
    global $database;
    $formData = $_POST;

    $toemail = getConfigValue("inquiry_email");
    $subject = "new Inquiry for " . $formData['model_name'];
    $message = "<p></p>
    <p></p>
    <p style='font-size: 14px;'>Hello,</p>
    <p style='font-size: 14px;'>Below there are the information of your new Inquiry</p>
    <p>
    <p style='font-size: 14px;'><b style='font-weight: 700;'>Name :</b> " . $formData['name'] . "</p>
    <p style='font-size: 14px;'><b style='font-weight: 700;'>Email :</b> " . $formData['email'] . "</p>
    <p style='font-size: 14px;'><b style='font-weight: 700;'>Contact No :</b> " . $formData['contact_no'] . "</p>
    <p style='font-size: 14px;'><b style='font-weight: 700;'>Model :</b> " . $formData['model_name'] . "</p>
    <p style='font-size: 14px;'><b style='font-weight: 700;'>Subject :</b> " . $formData['subject'] . "</p>
    <p style='font-size: 14px;'><b style='font-weight: 700;'>Details :</b> " . $formData['details'] . "</p>
    <p style='font-size: 14px;'>Best Regards</p>";

    $sendMail = sendEmail($toemail, $subject, $message, "", "", "", "");
    exit;
}

if (isset($_POST['save_user_guide_video'])) {
    $status = save_user_guide_video($_POST);
    header("Location:?route=" . $_POST['route']);
}

if ($route == 'invoice/payment_status_report') {

    if (isset($_GET['client_status'])) {
        $client_status = $_GET['client_status'];
        if ($client_status == 'active') {
            $where_sql = " WHERE clients.is_active = 1 ";
        }

        if ($client_status == 'inactive') {
            $where_sql = " WHERE clients.is_active = 0 ";
        }

        if ($client_status == 'all') {
            $where_sql = "all";
        }
    }

    if (isset($_GET['client_type'])) {
        $client_type = $_GET['client_type'];
        if ($client_type != '' && $client_type != 'all') {
            $where_sql = " WHERE clients.clienttypes = $client_type ";
        } else {
            $where_sql = '';
        }
    }


    if (isset($_GET['payment_status'])) {
        $payment_status = $_GET['payment_status'];
        if ($payment_status == 'paid') {
            $where_sql = " WHERE invoice.balance <= 0 ";
        }
        if ($payment_status == 'all') {
            $where_sql = "";
        }
    }

    if (isset($_GET['client'])) {
        $client = $_GET['client'];
        if ($client != '') {
            $where_sql = " WHERE invoice.clintid = $client";
        }
    }


    if ($where_sql == '') {
        $where_sql = " WHERE invoice.balance > 0 AND clients.is_active = 1";
    } else if ($where_sql == 'all') {
        $where_sql = " WHERE invoice.balance > 0";
    }

    global $database;
    $sql = "SELECT invoice.* , clients.name , clients.contact_no , clients.clienttypes FROM `invoice` 
            JOIN clients ON clients.id = invoice.clintid $where_sql AND invoice.balance > 0";
    $query = $database->query($sql);
    $payment_status_reports = $query->fetchAll();

    $type_sql = "SELECT * FROM clienttype";
    $type_sql_query = $database->query($type_sql);
    $filter_type_data = $type_sql_query->fetchAll();

    $client_sql = "SELECT * FROM clients ORDER BY name ASC";
    $client_sql_query = $database->query($client_sql);
    $filter_client_data = $client_sql_query->fetchAll();
}

if ($route == 'invoice/sales_report') {
    if (isset($_GET['tab1_year']) && $_GET['tab1_year'] != '' && isset($_GET['tab2_month']) && $_GET['tab2_month'] != '') {
        $client_list_2 = get_client_list_for_sale_report_tab_2($_GET['tab1_year'], $_GET['tab2_month']);
    } else if (isset($_GET['tab2_month']) && $_GET['tab2_month'] != '') {
        $client_list_2 = get_client_list_for_sale_report_tab_2('', $_GET['tab2_month']);
    } else {
        $defult_year = date("Y");
        $defult_month = date("m");
        $client_list_2 = get_client_list_for_sale_report($defult_year, $defult_month);
    }
    $client_list_count_2 = count($client_list_2);
    $total_sum_2 = 0;

    foreach ($client_list_2 as $client) {
        if ($client['total_amount'] !== 'No Invoice') {
            $total_sum_2 += $client['total_amount'];
        }
    }

    if (isset($_GET['tab1_year']) && $_GET['tab1_year'] != '' && isset($_GET['tab1_month']) && $_GET['tab1_month'] != '') {
        $client_list = get_client_list_for_sale_report($_GET['tab1_year'], $_GET['tab1_month']);
    } else if (isset($_GET['tab1_year']) && $_GET['tab1_year'] != '') {
        $client_list = get_client_list_for_sale_report($_GET['tab1_year']);
    } else if (isset($_GET['tab1_month']) && $_GET['tab1_month'] != '') {
        $client_list = get_client_list_for_sale_report('', $_GET['tab1_month']);
    } else {
        $defult_year = date("Y");
        $defult_month = date("m", strtotime("first day of last month"));
        $client_list = get_client_list_for_sale_report($defult_year, $defult_month);
    }
    $client_list_count = count($client_list);
    $total_sum = 0;

    foreach ($client_list as $client) {
        if ($client['total_amount'] !== 'No Invoice') {
            $total_sum += $client['total_amount'];
        }
        $total1 += getTotalAmount("contract", "contract_amount", "clientid", $client['id'], "is_end", 0);
        $total12 += getTotalAmount("licenses", "amount", "clientid", $client['id']);
    }
    $coto = get_sale_report_amount();

    // $client_list_2;
    // $client_list;
    $difrence_filtered_client_list_2 = [];
    $difrence_filtered_client_list = [];
    foreach ($client_list_2 as $key1 => $value1) {
        $value1_id = $value1['id'];
        $value1_total_amount = $value1['total_amount'];
        $diff = false;

        foreach ($client_list as $key2 => $value2) {
            $value2_id = $value2['id'];
            $value2_total_amount = $value2['total_amount'];
            if ($value2_id == $value1_id && $value2_total_amount != $value1_total_amount) {
                $diff = true;
            }
        }

        if ($diff) {
            $value1['is_difference'] = true;
        } else {
            $value1['is_difference'] = false;
        }
        $difrence_filtered_client_list_2[] = $value1;
    }

    foreach ($client_list as $key1 => $value1) {
        $value1_id = $value1['id'];
        $value1_total_amount = $value1['total_amount'];
        $diff = false;

        foreach ($client_list_2 as $key2 => $value2) {
            $value2_id = $value2['id'];
            $value2_total_amount = $value2['total_amount'];
            if ($value2_id == $value1_id && $value2_total_amount != $value1_total_amount) {
                $diff = true;
            }
        }

        if ($diff) {
            $value1['is_difference'] = true;
        } else {
            $value1['is_difference'] = false;
        }
        $difrence_filtered_client_list[] = $value1;
    }

    $client_list_diff = $difrence_filtered_client_list;
    $client_list_2_diff = $difrence_filtered_client_list_2;
    $active_client = getTableFilteredsorbynm("clients", 'is_active', 1);
    $licenses_amount_total = 0;
    $total1 = 0;
    foreach ($active_client as $key => $value) {
        $get_license_data = get_licenses_by_client($value['id']);
        if (!empty($get_license_data)) {
            foreach ($get_license_data as $each_license) {
                $licenses_amount_total += $each_license['amount'];
            }
        }
        $total1 += getTotalAmount("contract", "contract_amount", "clientid", $value['id'], "is_end", 0);
    }
    $total_amount_text = $total1 + $licenses_amount_total;
    $active_client_count = count($active_client);
}


if ($route == 'invoice/payment_method_list') {
    $payment_method_data = get_payment_method_data();
}


// invoice exl
if ($route == 'exp_invoice') {
    if (isset($_GET['client_status'])) {
        $client_status = $_GET['client_status'];
        if ($client_status == 'active') {
            $where_sql = " WHERE clients.is_active = 1 ";
        }

        if ($client_status == 'inactive') {
            $where_sql = " WHERE clients.is_active = 0 ";
        }

        if ($client_status == 'all') {
            $where_sql = "";
        }
    }

    if (isset($_GET['client_type'])) {
        $client_type = $_GET['client_type'];
        if ($client_type != '' && $client_type != 'all') {
            $where_sql = " WHERE clients.clienttypes = $client_type ";
        } else {
            $where_sql = '';
        }
    }


    if (isset($_GET['payment_status'])) {
        $payment_status = $_GET['payment_status'];
        if ($payment_status == 'paid') {
            $where_sql = " WHERE invoice.balance <= 0 ";
        }

        if ($payment_status == 'unpaid') {
            $where_sql = " WHERE invoice.balance > 0 ";
        }
        if ($payment_status == 'all') {
            $where_sql = "";
        }
    }

    if (isset($_GET['client'])) {
        $client = $_GET['client'];
        if ($client != '') {
            $where_sql = " WHERE invoice.clintid = $client";
        }
    }

    if (isset($_GET['clear_status'])) {
        $clear_status = $_GET['clear_status'];
        if ($clear_status != '' && $clear_status != 'all') {
            $where_sql = " WHERE invoice.cleared = $clear_status";
        }
    }

    if (isset($_GET['file_status'])) {
        $file_status = $_GET['file_status'];
        if ($file_status != '' && $file_status != 'all') {
            if ($file_status == 'attached') {
                $where_sql = " WHERE invoice.tax_file_2307 != '' ";
            }

            if ($file_status == 'not_attached') {
                $where_sql = " WHERE invoice.tax_file_2307 = '' OR invoice.tax_file_2307 IS NULL";
            }
        }
    }

    if (isset($_GET['ref_no'])) {
        $ref_no = $_GET['ref_no'];
        if ($ref_no != '') {
            $where_sql = " WHERE invoice.ref_no LIKE '%" . $ref_no . "%'";
        }
    }

    $select1 = "SELECT invoice.*, clients.id AS client_id
    FROM invoice
    LEFT JOIN clients ON invoice.clintid = clients.id
    $where_sql
    ORDER BY invoice.id ASC";

    $query1 = $database->query($select1);
    $invoices = $query1->fetchAll();
    $records = array();
    if (isset($invoices) && !empty($invoices)) {
        $n = 1;
        foreach ($invoices as $invoice) {
            $is_duplicate = check_dup_invoice($invoices, $invoice['ref_no'], $invoice['clintid'], $invoice['month'], $invoice['id'], $invoice['date']);
            if ($is_duplicate) {
                $dup_html = "Duplicate";
            } else {
                $dup_html = "Not Duplicate";
            }

            $client = get_client_name_by_id($invoice['clintid']);
            if (isset($client[0]['name'])) {
                $client_name = $client[0]['name'];
            }

            if ($invoice['balance'] > 0) {
                $paid_html = 'No';
            } else {
                $paid_html = 'Yes';
            }

            if ($invoice['cleared'] == 0) {
                $clear_html = 'No';
            } else {
                $clear_html = 'Yes';
            }
            $data['#'] = $n;
            $data['Date'] = $invoice['date'];
            $data['Month'] = get_month_name($invoice['month']);
            $data['Duplicate'] = $dup_html;
            $data['Reference No'] = $invoice['ref_no'];
            $data['Client'] = isset($client_name) ? $client_name  : '';
            $data['INV'] = $invoice['invoiceno'];
            $data['Amount'] = $invoice['amount'];
            $data['Payment Method'] = $invoice['payment_method'];
            $data['Payment Ref No'] = $invoice['payment_ref_no'];
            $data['OR No'] = $invoice['ornumber'];
            $data['Paid Amount'] = $invoice['paid'];
            $data['Balance'] = $invoice['balance'];
            $data['Remark'] = $invoice['remark'];
            $data['Paid'] = $paid_html;
            $data['Cleared'] = $clear_html;
            $records[] = $data;
            $n++;
        }

        $filename = "Invoice.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $heading = false;
        if (!empty($records))
            foreach ($records as $row) {
                if (!$heading) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }
        exit;
    }
}

if ($route == 'date_received_export_invoice') {
    if (isset($_GET['date_received_from']) && isset($_GET['date_received_to']) && $_GET['date_received_from'] != '' && $_GET['date_received_to'] != '') {
        $where_sql = " WHERE invoice.date_payment_receive BETWEEN '" . $_GET['date_received_from'] . "' AND '" . $_GET['date_received_to'] . "' AND invoice.paid > 0";
    } elseif (isset($_GET['date_received_from']) && $_GET['date_received_from'] != '') {
        $where_sql = " WHERE invoice.date_payment_receive >= '" . $_GET['date_received_from'] . "' AND invoice.paid > 0";
    } elseif (isset($_GET['date_received_to']) && $_GET['date_received_to'] != '') {
        $where_sql = " WHERE invoice.date_payment_receive <= '" . $_GET['date_received_to'] . "' AND invoice.paid > 0";
    }

    $select1 = "SELECT invoice.*, clients.id AS client_id
    FROM invoice
    LEFT JOIN clients ON invoice.clintid = clients.id
    $where_sql
    ORDER BY invoice.id ASC";

    $query1 = $database->query($select1);
    $invoices = $query1->fetchAll();
    $records = array();
    if (isset($invoices) && !empty($invoices)) {
        $n = 1;
        foreach ($invoices as $invoice) {
            $is_duplicate = check_dup_invoice($invoices, $invoice['ref_no'], $invoice['clintid'], $invoice['month'], $invoice['id'], $invoice['date']);
            if ($is_duplicate) {
                $dup_html = "Duplicate";
            } else {
                $dup_html = "Not Duplicate";
            }

            $client = get_client_name_by_id($invoice['clintid']);
            if (isset($client[0]['name'])) {
                $client_name = $client[0]['name'];
            }

            if ($invoice['paid'] > 0) {
                $paid_html = 'No';
            } else {
                $paid_html = 'Yes';
            }

            if ($invoice['cleared'] == 0) {
                $clear_html = 'No';
            } else {
                $clear_html = 'Yes';
            }
            $data['#'] = $n;
            $data['Date'] = $invoice['date'];
            $data['Month'] = get_month_name($invoice['month']);
            $data['Duplicate'] = $dup_html;
            $data['Reference No'] = $invoice['ref_no'];
            $data['Client'] = isset($client_name) ? $client_name  : '';
            $data['INV'] = $invoice['invoiceno'];
            $data['Amount'] = $invoice['amount'];
            if (is_numeric($invoice['payment_method'])) {
                $payment_method = get_payment_method_name($invoice['payment_method']);
            }else{
                $payment_method = $invoice['payment_method'];
            }
            $data['Payment Method'] = $payment_method;
            $data['Payment Ref No'] = $invoice['payment_ref_no'];
            $data['OR No'] = $invoice['ornumber'];
            $data['Paid Amount'] = $invoice['paid'];
            $data['Tax Amount'] = $invoice['tax_amount'];
            $data['Balance'] = $invoice['balance'];
            $data['Remark'] = $invoice['remark'];
            $data['Paid'] = $paid_html;
            $data['Cleared'] = $clear_html;
            $data['Date Payment Receive'] = $invoice['date_payment_receive'];
            $records[] = $data;
            $n++;
        }

        $filename = "Invoice.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $heading = false;
        if (!empty($records))
            foreach ($records as $row) {
                if (!$heading) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }
        exit;
    }
}

if ($route == 'invoice/payment_history') {

    $client_sql = "SELECT * FROM clients ORDER BY name ASC";
    $client_sql_query = $database->query($client_sql);
    $filter_client_data = $client_sql_query->fetchAll();

    // client
    if (isset($_GET['client'])) {
        $client = $_GET['client'];
        if ($client != '') {
            $payment_history_data = get_payment_history_data($client);
        }
    } else {
        $payment_history_data = get_payment_history_data();
    }
}
