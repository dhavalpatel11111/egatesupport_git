<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$scriptpath = __DIR__;

# APP LOADER
require($scriptpath . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'loader.php');

# LOAD MODAL TEMPLATE

if (isset($_GET['modal'])) require_once($scriptpath . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $lia['type'] . DIRECTORY_SEPARATOR . 'modals' . DIRECTORY_SEPARATOR . $_GET['modal'] . '.html');



# QUICK ACTIONS
if (isset($_GET['quickAction'])) {
	switch ($_GET['quickAction']) {
		case "ticketClose":
			updateTicketStatus($_GET['id'], "Closed");
			header("Location:index.php?route=" . $_GET['reroute'] . "&id=" . $_GET['routeid']);
			break;
		case "ticketReopen":
			updateTicketStatus($_GET['id'], "Reopened");
			header("Location:index.php?route=" . $_GET['reroute'] . "&id=" . $_GET['routeid']);
			break;
		case "ticketAssignToMe":
			ticketAssignTo($_GET['id'], $lia['id']);
			header("Location:index.php?route=" . $_GET['reroute'] . "&id=" . $_GET['routeid']);
			break;
		case "getTicketReply":
			echo getSingleValue("tickets_replies", "message", $_GET['id']);
			if (isset($_GET['filename']) && $_GET['filename'] != "") {
?>
				<a href="uploads/<?php echo $_GET['filename']; ?>"><?php echo $_GET['filename']; ?></a>
<?php
			}
			// echo getSingleValue("tickets_replies_file","message",$_GET['id']);

			break;
		case "getUserEmail":
			echo getSingleValue("people", "email", $_GET['id']);
			break;
	}
}

if (isset($_POST['updateIssueStatus'])) {
	updateIssueStatus($_POST['issueid'], $_POST['status']);
}

if (isset($_GET['download'])) {
	if (isset($_GET['reply'])) {
		$file = getRowById("ticket_reply_files", $_GET['download']);
	} else {
		if (isset($_GET['contract_files']) && $_GET['contract_files'] == '1') {
			$file = getRowById("contract_files", $_GET['download']);
		} else {
			$file = getRowById("files", $_GET['download']);
		}
	}
	$targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file['file'];

	if (file_exists($targetfile)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $file['file'] . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($targetfile));
		readfile($targetfile);
		exit;
	} else echo "File does not exist.";
}


if (isset($_GET['downloadwrnty'])) {

	$file = getRowById("warrantycard", $_GET['downloadwrnty']);

	$targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file['file'];

	if (file_exists($targetfile)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $file['file'] . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($targetfile));
		readfile($targetfile);
		exit;
	} else echo "File does not exist.";
}

if (isset($_GET['invoicefile'])) {

	$targetfile = "uploads" . DIRECTORY_SEPARATOR . $_GET['invoicefile'];
	$targetfile_1 = "payment_file" . DIRECTORY_SEPARATOR . "payment_proof" . DIRECTORY_SEPARATOR . $_GET['invoicefile'];
	$targetfile_2 = "payment_file" . DIRECTORY_SEPARATOR . "official_reciept" . DIRECTORY_SEPARATOR . $_GET['invoicefile'];

	if (file_exists($targetfile)) {
		if (isset($_GET['show']) && $_GET['show'] = 'true') {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $targetfile);
			finfo_close($finfo);
			header('Content-Description: File Transfer');
			header('Content-Type: ' . $mimeType);
			header('Content-Disposition: inline; filename="' . $_GET['invoicefile'] . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($targetfile));
			readfile($targetfile);
		} else {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . $_GET['invoicefile'] . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($targetfile));
			readfile($targetfile);
			exit;
		}
	} elseif (file_exists($targetfile_1)) {
		if (isset($_GET['show']) && $_GET['show'] = 'true') {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $targetfile_1);
			finfo_close($finfo);
			header('Content-Description: File Transfer');
			header('Content-Type: ' . $mimeType);
			header('Content-Disposition: inline; filename="' . $_GET['invoicefile'] . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($targetfile_1));
			readfile($targetfile_1);
		} else {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . $_GET['invoicefile'] . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($targetfile));
			readfile($targetfile);
			exit;
		}
	} elseif ($targetfile_2) {
		if (isset($_GET['show']) && $_GET['show'] = 'true') {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $targetfile_2);
			finfo_close($finfo);
			header('Content-Description: File Transfer');
			header('Content-Type: ' . $mimeType);
			header('Content-Disposition: inline; filename="' . $_GET['invoicefile'] . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($targetfile_2));
			readfile($targetfile_2);
		} else {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . $_GET['invoicefile'] . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($targetfile));
			readfile($targetfile);
			exit;
		}
	} else {
		echo "File does not exist.";
	}
}

if (isset($_GET['invoicefile_show'])) {

	if (isset($_GET['invoicefile_show'])) {
		$targetfile = "uploads" . DIRECTORY_SEPARATOR . $_GET['invoicefile_show'];

		if (file_exists($targetfile)) {
			$fileExtension = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));

			// Check if it's an image
			$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
			if (in_array($fileExtension, $allowedExtensions)) {
				header('Content-Type: image/' . $fileExtension);
				header('Content-Length: ' . filesize($targetfile));
				readfile($targetfile);
				exit;
			} else {
				echo "File is not an image.";
			}
		} else {
			echo "File does not exist.";
		}
	}
}


if (isset($_GET['assetfile'])) {


	$targetfile = "uploads" . DIRECTORY_SEPARATOR . "Asset" . DIRECTORY_SEPARATOR . $_GET['assetfile'];

	if (file_exists($targetfile)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $_GET['assetfile'] . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($targetfile));
		readfile($targetfile);
		exit;
	} else echo "File does not exist.";
}

if (isset($_GET['invoicetaxfile'])) {


	$targetfile = "uploads" . DIRECTORY_SEPARATOR . "tax_file" . DIRECTORY_SEPARATOR . $_GET['invoicetaxfile'];
	$targetfile_1 = "payment_file" . DIRECTORY_SEPARATOR . "tax_payment" . DIRECTORY_SEPARATOR . $_GET['invoicetaxfile'];

	if (file_exists($targetfile)) {

		if (isset($_GET['show']) && $_GET['show'] = 'true') {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $targetfile);
			finfo_close($finfo);
			header('Content-Description: File Transfer');
			header('Content-Type: ' . $mimeType);
			header('Content-Disposition: inline; filename="' . $_GET['invoicetaxfile'] . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($targetfile));
			readfile($targetfile);
		} else {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . $_GET['invoicetaxfile'] . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($targetfile));
			readfile($targetfile);
		}

		exit;
	} elseif (file_exists($targetfile_1)) {
		if (isset($_GET['show']) && $_GET['show'] = 'true') {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $targetfile_1);
			finfo_close($finfo);
			header('Content-Description: File Transfer');
			header('Content-Type: ' . $mimeType);
			header('Content-Disposition: inline; filename="' . $_GET['invoicetaxfile'] . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($targetfile_1));
			readfile($targetfile_1);
		} else {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . $_GET['invoicetaxfile'] . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($targetfile_1));
			readfile($targetfile_1);
		}
	} else {
		echo "File does not exist.";
	}
}

if (isset($_GET['usage_report_detail'])) {
	// $_GET['usage_report_detail']  is usage report id 
	$data = get_usage_report_data_by_id($_GET['usage_report_detail']);
	$data = $data[0];
	$requied_data = [];
	foreach ($data as $key => $value) {
		if ($key == 'A3clr' || $key == 'A3blk' || $key == 'A4clr' || $key == 'A4blk' || $key == 'remark') {
			$requied_data[$key] = $value;
		}
	}

	echo json_encode(['requied_data' => $requied_data]);
}

if (isset($_GET['get_issues_data'])) {
	$issue_data = getSingleValue('issues', '*', $_GET['get_issues_data']);

	if (isset($issue_data['clientid'])) {
		$issue_data['client_name'] = getSingleValue('clients', 'name', $issue_data['clientid']);
	}

	if (isset($issue_data['assetid'])) {
		$issue_data['asset_name'] = '';
		$assets = getSingleValue('assets', '*', $issue_data['assetid']);
		$manufacturerid = getSingleValue("models", "manufacturerid", $assets['modelid']);
		$issue_data['asset_name'] = $assets['tag'] . " " . getSingleValue("manufacturers", "name", $manufacturerid) . " " . getSingleValue("models", "name", $assets['modelid']);
	}

	if (isset($issue_data['projectid'])) {
		$issue_data['project_name'] = getSingleValue('projects', 'name', $issue_data['projectid']);
	}

	if (isset($issue_data['adminid'])) {
		$issue_data['admin_name'] = getSingleValue('people', 'name', $issue_data['adminid']);
	}

	$data = [];
	if (!empty($issue_data)) {
		$data = $issue_data;
	}
	echo json_encode(['issue_data' => $data]);
}

if (isset($_GET['payment_method'])) {
	$res['status'] = 0;
	$res['msg'] = "Somthing gone Wrong!";
	if (!empty($_POST)) {
		$data['name'] = isset($_POST['name']) ? $_POST['name'] : '';
		$data['code'] = isset($_POST['code']) ? $_POST['code'] : '';
		$hid = isset($_POST['hid']) ? $_POST['hid'] : 0;
		if ($hid > 0 && $hid != 0) {
			$save = update_payment_method($data, $hid);
			if ($save) {
				$res['status'] = 1;
				$res['msg'] = "Payment Method Updated";
			}
		} else {
			$save = add_payment_method($data);
			if ($save) {
				$res['status'] = 1;
				$res['msg'] = "Payment Method Saved";
			}
		}
	}
	echo json_encode(['res' => $res]);
}

if (isset($_GET['get_payment_method'])) {
	$res['status'] = 0;
	$res['data'] = [];
	if (!empty($_POST)) {
		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$data = get_payment_method($id);
		if (!empty($data)) {
			$res['status'] = 1;
			$res['data'] = isset($data[0]) ? $data[0] : [];
		}
	}
	echo json_encode(['res' => $res]);
}


// delete_payment_method
if (isset($_GET['delete_payment_method'])) {
	$res['status'] = 0;
	$res['msg'] = "Somthing gone Wrong!";
	if (!empty($_POST)) {
		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$data = delete_payment_method($id);
		if (!empty($data)) {
			$res['status'] = 1;
			$res['msg'] = "Payment Method Deleted";
		}
	}
	echo json_encode(['res' => $res]);
}

if (isset($_GET['get_invoice_by_clientid'])) {
	$res['status'] = 0;
	$res['data'] = [];
	if (!empty($_POST)) {
		$client_id = isset($_POST['client_id']) ? $_POST['client_id'] : '';
		$data = get_invoice_by_clientid($client_id);
		if (!empty($data)) {
			$res['status'] = 1;
			$html = '';
			$totle_balance = 0;
			$totle_amount = 0;
			foreach ($data as $value) {
				$totle_balance += $value['balance'];
				$totle_amount += $value['amount'];
				$is_duplicate = check_dup_invoice($data, $value['ref_no'], $value['clintid'], $value['month'], $value['id'], $value['date']);
				if ($is_duplicate) {
					$dup_html = "<span style='background-color: red; display: flex;width: 16px;height: 16px;'>
							<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='white' class='bi bi-check' viewBox='0 0 16 16'>
								<path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z'/>
							  </svg>
						</span>";
				} else {
					$dup_html = "<span style='background-color: lightgray; display: flex;width: 16px; height: 16px;'>&nbsp;</span>";
				}

				$client = getSingleValue("clients", "name", $value['clintid']);
				if (strlen($client) > 10) {
					$client_formated = substr($client, 0, 10) . '...';
				} else {
					$client_formated = $client;
				}

				if ($value['attachment'] != "") {
					$file = "<a href='javascript:void(0);' onClick=\"window.open('?route=invoiceTPdf&id={$value['clintid']}&invoice_id={$value['id']}', '_blank')\"><i class='fa fa-picture-o' aria-hidden='true'></i></a>&nbsp;&nbsp;<a class='onhoverfile' href='ajax.php?invoicefile=" . $value['attachment'] . "'><i class='fa fa-picture-o' aria-hidden='true'></i><span class='hovertextfile'>" . $value['attachment'] . "</span></a><br>";
				} else {
					$file = "<a href='javascript:void(0);' onClick=\"window.open('?route=invoiceTPdf&id={$value['id']}&invoice_id={$value['id']}', '_blank')\"><i class='fa fa-picture-o' aria-hidden='true'></i></a>&nbsp;";
				}
				$html .= '<tr>
				<td><input type="checkbox" data-invoice_id="' . $value['id'] . '" class="inv_check" style="zoom: 0 !important;"></td>
				<td>' . $value['date'] . '</td>
				<td>' . $dup_html . '</td>
				<td>' . get_month_name($value['month']) . '</td>
				<td>' . $value['ref_no'] . '</td>
				<td>' . $client_formated . '</td>
				<td>' . $value['invoiceno'] . '</td>
				<td class="amt">' . $value['amount'] . '</td>
				<td>' . $file . '</td>
				<td class="defult_hide "><input name="paid_' . $value['id'] . '" class="paid_amt_input" data-id="' . $value['id'] . '" type="number" value="' . $value['paid'] . '"></td>
				<td class="defult_hide"><input name="tax_' . $value['id'] . '" class="tax_amt_input" data-id="' . $value['id'] . '" type="number" value="' . $value['tax_amount'] . '"></td>
				<td class="defult_hide ' . $value['id'] . '_balance"><input name="balance_' . $value['id'] . '" class="balance_amt_input" data-balance_amt="' . $value['balance'] . '" data-id="' . $value['id'] . '" type="number" value="' . $value['balance'] . '" readonly></td>
				</tr>';
			}
			$res['tbody'] = $html;
			$res['totle_balance'] = $totle_balance;
			$res['totle_amount'] = $totle_amount;
		}
	}
	echo json_encode(['res' => $res]);
}


if (isset($_GET['bulk_invoice_payment'])) {
	$res['status'] = 0;
	$res['msg'] = "Somthing gone Wrong!";
	if ($_POST) {
		$files = [];
		if ($_FILES && !empty($_FILES)) {
			foreach ($_FILES as $key => $value) {
				$new_key = str_replace("#", "", $key);
				$files[$new_key] = $value;
			}
		}

		$invoice_ids = isset($_POST['invoice_ids']) && !empty($_POST['invoice_ids']) ? $_POST['invoice_ids'] : [];
		$invoice_ids = json_decode($_POST['invoice_ids'], true);
		if (empty($invoice_ids)) {
			$res['status'] = 2;
			$res['msg'] = "Select the Invoice to Allocate the Received Amount.!";
			echo json_encode(['res' => $res]);
		} else {
			$inv_ids = implode(',', $invoice_ids);
			$data['payment_method'] = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
			$data['payment_ref_no'] = isset($_POST['payment_ref_no']) ? $_POST['payment_ref_no'] : '';
			$data['ornumber'] = isset($_POST['ornumber']) ? $_POST['ornumber'] : '';
			// calculation amounts for tax and paid 

			// $amount_without_comma = str_replace(",", "", $_POST['paid']);
			// $paid = (int)$amount_without_comma; // Convert to an integer
			// $data['paid'] = $paid;
			// $data['tax_amount'] = isset($_POST['tax']) ? $_POST['tax'] : '';

			// calculation amounts for tax and paid 
			$total_amount_paid = isset($_POST['total_amount_to_pay']) ? $_POST['total_amount_to_pay'] : '';

			if (count($invoice_ids) > 1) {
				$multiple_payment = 1;
			} else {
				$multiple_payment = 0;
			}
			$timestemp = time();
			$req['path'] = true;
			$or_file = uploadinvoice_orfile_2($data, $files, $req);
			$paid_file = uploadinvoice_paidfile_2($data, $files, $req);
			$tax_file = uploadinvoice_taxfile_2($data, $files, $req);
			$files_to_copy = [
				'or_file' => $or_file,
				'paid_file' => $paid_file,
				'tax_file' => $tax_file,
			];
			foreach ($invoice_ids as $invoice_id) {

				// multyple_file_upload_system
				$invoice_data = get_invoice_data($invoice_id);
				$client_id = $invoice_data['clintid'];
				$files_arr = [];
				foreach ($files_to_copy as $file_key => $file_data) {
					if (isset($file_data['path'])) {
						$source_path = $file_data['path'];
						$file_name = basename($source_path);
						// Extract the extension
						$extension = pathinfo($file_name, PATHINFO_EXTENSION);

						if ($file_key == 'or_file') {
							$targetdir = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "official_reciept" . DIRECTORY_SEPARATOR;
							$clients = getTableFiltered("clients", 'id', $client_id);
							$company_name = substr($clients[0]['name'], 0, 3);
							$invoiceno = str_replace(' ', '', $invoice_data['invoiceno']); // Remove all spaces
							$filename = $invoiceno . "_" . $data['ornumber'] . "_" . $company_name . "_OR." . $extension;
							$targetfile = $targetdir . $filename;
							if (file_exists($source_path)) {
								copy($source_path, $targetfile);
								$files_arr['or_file'] = $filename;
							}
						}

						if ($file_key == 'paid_file') {
							$targetdir = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "payment_proof" . DIRECTORY_SEPARATOR;
							$clients = getTableFiltered("clients", 'id', $client_id);
							$company_name = substr($clients[0]['name'], 0, 3);
							$invoiceno = str_replace(' ', '', $invoice_data['invoiceno']); // Remove all spaces
							$filename = $invoiceno . "_" . $data['ornumber'] . "_" . $company_name . "_PF." . $extension;
							$targetfile = $targetdir . $filename;
							if (file_exists($source_path)) {
								copy($source_path, $targetfile);
								$files_arr['paid_file'] = $filename;
							}
						}

						if ($file_key == 'tax_file') {
							$targetdir = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "tax_payment" . DIRECTORY_SEPARATOR;
							$clients = getTableFiltered("clients", 'id', $client_id);
							$company_name = substr($clients[0]['name'], 0, 3);
							$invoiceno = str_replace(' ', '', $invoice_data['invoiceno']); // Remove all spaces
							$filename = $invoiceno . "_" . $data['ornumber'] . "_" . $company_name . "_TAX." . $extension;
							$targetfile = $targetdir . $filename;
							if (file_exists($source_path)) {
								copy($source_path, $targetfile);
								$files_arr['tax_file'] = $filename;
							}
						}
					}
				}

				// multyple_file_upload_system


				// $data['balance'] = 0;
				$data['multiple_payment'] = $multiple_payment;
				// file upload
				$data['clintid'] = $client_id;
				$data['paid_file'] = !empty($files_arr['paid_file']) ? $files_arr['paid_file'] : $invoice_data['paid_file'];
				$data['tax_file_2307'] = !empty($files_arr['tax_file']) ?  $files_arr['tax_file'] : $invoice_data['tax_file_2307'];
				$data['or_file'] = !empty($files_arr['or_file']) ?  $files_arr['or_file'] : $invoice_data['or_file'];
				// file upload
				// calculation amounts for tax and paid 
				$data['paid'] = $_POST['paid_' . $invoice_id];
				$data['tax_amount'] = $_POST['tax_' . $invoice_id];
				$data['balance'] = $_POST['balance_' . $invoice_id];
				// calculation amounts for tax and paid 
				$data['date_payment_receive'] = $_POST['date_payment_receive'];
				update_bulk_invoice($data, $invoice_id);
				$payment_history['client_id'] = $client_id;
				$payment_history['invoice_id'] = $invoice_id;
				$payment_history['amount'] = $invoice_data['amount'];
				$payment_history['applied_amount'] = $data['paid'];
				$payment_history['timestemp'] = $timestemp;
				add_payment_history($payment_history);
			}

			$res['status'] = 1;
			$res['msg'] = "Bulk Invoice are paid";
			echo json_encode(['res' => $res]);
		}
	}
}


// get_invoice_by_invoice_id
if (isset($_GET['get_invoice_by_invoice_id'])) {
	$res['status'] = 0;
	$res['data'] = [];

	if (!empty($_POST)) {
		$invoice_id = isset($_POST['invoice_id']) ? $_POST['invoice_id'] : 0;
		$invoice_data = get_invoice_data($invoice_id);
		if (!empty($invoice_data)) {
			$res['status'] = 1;
			$payment_method_info = get_payment_method_name($invoice_data['payment_method']);
			$invoice_data['payment_method_info'] = $payment_method_info;
			$res['data'] = $invoice_data;
			$data = get_invoice_by_clientid_paid($invoice_data['clintid']);
			if (!empty($data)) {
				$res['status'] = 1;
				$html = '';
				$totle_balance = 0;
				$totle_amount = 0;
				foreach ($data as $value) {
					$totle_balance += $value['balance'];
					$totle_amount += $value['amount'];
					$is_duplicate = check_dup_invoice($data, $value['ref_no'], $value['clintid'], $value['month'], $value['id'], $value['date']);
					if ($is_duplicate) {
						$dup_html = "<span style='background-color: red; display: flex;width: 16px;height: 16px;'>
							<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='white' class='bi bi-check' viewBox='0 0 16 16'>
								<path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z'/>
							  </svg>
						</span>";
					} else {
						$dup_html = "<span style='background-color: lightgray; display: flex;width: 16px; height: 16px;'>&nbsp;</span>";
					}

					$client = getSingleValue("clients", "name", $value['clintid']);
					if (strlen($client) > 10) {
						$client_formated = substr($client, 0, 10) . '...';
					} else {
						$client_formated = $client;
					}

					if ($value['attachment'] != "") {
						$file = "<a href='javascript:void(0);' onClick=\"window.open('?route=invoiceTPdf&id={$value['clintid']}&invoice_id={$value['id']}', '_blank')\"><i class='fa fa-picture-o' aria-hidden='true'></i></a>&nbsp;&nbsp;<a class='onhoverfile' href='ajax.php?invoicefile=" . $value['attachment'] . "'><i class='fa fa-picture-o' aria-hidden='true'></i><span class='hovertextfile'>" . $value['attachment'] . "</span></a><br>";
					} else {
						$file = "<a href='javascript:void(0);' onClick=\"window.open('?route=invoiceTPdf&id={$value['id']}&invoice_id={$value['id']}', '_blank')\"><i class='fa fa-picture-o' aria-hidden='true'></i></a>&nbsp;";
					}
					$html .= '<tr>
				<td><input type="checkbox" data-invoice_id="' . $value['id'] . '" class="inv_check" checked disabled style="zoom: 0 !important;"></td>
				<td>' . $value['date'] . '</td>
				<td>' . $dup_html . '</td>
				<td>' . get_month_name($value['month']) . '</td>
				<td>' . $value['ref_no'] . '</td>
				<td>' . $client_formated . '</td>
				<td>' . $value['invoiceno'] . '</td>
				<td class="amt">' . $value['amount'] . '</td>
				<td>' . $file . '</td>
				</tr>';
				}
				$res['tbody'] = $html;
				$res['totle_balance'] = $totle_balance;
				$res['totle_amount'] = $totle_amount;
			}
		}
	}
	echo json_encode(['res' => $res]);
}

if (isset($_GET['delete_invoice_payment_history'])) {
	$res['status'] = 0;
	$res['msg'] = "Somthing gone Wrong!";
	if (!empty($_POST)) {
		$payment_history_id = isset($_POST['id']) ? $_POST['id'] : 0;
		$payment_history_data = get_payment_history_by_id($payment_history_id);
		$bulk_invoice_payment_history = get_payment_history_by_timestemp($payment_history_data['timestemp']);

		foreach ($bulk_invoice_payment_history as $key => $value) {
			$invoice_id = isset($value['invoice_id']) ? $value['invoice_id'] : 0;
			$invoice = get_invoice_data($invoice_id);
			$invoice_data['payment_ref_no'] = '';
			$invoice_data['ornumber'] = 0;
			$invoice_data['paid'] = 0;
			$invoice_data['tax_amount'] = 0;
			$invoice_data['balance'] = $invoice['amount'];
			$invoice_data['multiple_payment'] = 0;
			update_bulk_invoice($invoice_data, $invoice_id);
			delete_payment_history($value['id']);
		}
		$res['status'] = 1;
		$res['msg'] = "Payment History Deleted";
	}
	echo json_encode(['res' => $res]);
}

if (isset($_GET['update_invoice_confirm'])) {
	$invoice_id = isset($_POST['invoice_id']) ? $_POST['invoice_id'] : 0;
	if ($invoice_id > 0) {
		if ($_GET['update_invoice_confirm'] == 1) {
			$data['confirmed'] = 1;
			update_incoive_confirmation($data, $invoice_id);
		} else {
			$data['confirmed'] = 0;
			update_incoive_confirmation($data, $invoice_id);
		}
	}
}

if (isset($_GET['get_templete_subject'])) {
	$res['status'] = 0;
	$res['data'] = [];
	$templete_id = isset($_GET['templete_id']) ? $_GET['templete_id'] : 0;
	if ($templete_id > 0) {
		$emailtemplate_data = get_templete_subject($templete_id);
		if (!empty($emailtemplate_data)) {
			$res['status'] = 1;
			$res['data'] = $emailtemplate_data;
		}
	}
	echo json_encode(['res' => $res]);
}

// insert_invoice_page_detail
if (isset($_GET['insert_invoice_page_detail'])) {
	$defult_email_template = isset($_GET['defult_email_template']) ? $_GET['defult_email_template'] : 0;
	$data['defult_email_template'] = $defult_email_template;
	insert_invoice_page_detail($data);
}

// insert_client_page_detail
if (isset($_GET['insert_client_page_detail'])) {
	$client_email_template = isset($_GET['client_email_template']) ? $_GET['client_email_template'] : 0;
	$data['client_email_template'] = $client_email_template;
	insert_invoice_page_detail($data);
}

if (isset($_GET['add_notice_expiration_before_days'])) {
	if (isset($_GET['add_notice_expiration_before_days'])) {
		$add_notice_expiration_before_days = $_GET['add_notice_expiration_before_days'];
		$data['name'] = 'add_notice_expiration_before_days';
		$data['value'] = $add_notice_expiration_before_days;
		insert_add_notice_expiration_before_days($data);
	}
}

if (isset($_GET['or_file_del'])) {
	if (!empty($_POST)) {
		$id = isset($_POST['invoice_id']) ? $_POST['invoice_id'] : 0;
		global $database, $scriptpath;
		$invoice = getTableFiltered("invoice", 'id', $id);

		if ($invoice) {
			$targetdir = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "official_reciept" . DIRECTORY_SEPARATOR;

			if ($invoice[0]['or_file']) {
				$imagePath = $targetdir . $invoice[0]['or_file'];
				if (file_exists($imagePath)) {
					unlink($imagePath);
				}
			}
		}
		$database->update("invoice", ["or_file" => ''], ["id" => $id]);
		return true;
	}
}

if (isset($_GET['paid_file_del'])) {
	if (!empty($_POST)) {
		$id = isset($_POST['invoice_id']) ? $_POST['invoice_id'] : 0;
		global $database, $scriptpath;
		$invoice = getTableFiltered("invoice", 'id', $id);

		if ($invoice) {
			$targetdir = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "payment_proof" . DIRECTORY_SEPARATOR;
			if ($invoice[0]['paid_file']) {
				$imagePath = $targetdir . $invoice[0]['paid_file'];
				if (file_exists($imagePath)) {
					unlink($imagePath);
				}
			}
		}
		$database->update("invoice", ["paid_file" => ''], ["id" => $id]);
		return true;
	}
}



if (isset($_GET['tax_file_2307_del'])) {
	if (!empty($_POST)) {
		$id = isset($_POST['invoice_id']) ? $_POST['invoice_id'] : 0;
		global $database, $scriptpath;
		$invoice = getTableFiltered("invoice", 'id', $id);

		if ($invoice) {
			$targetdir = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "tax_payment" . DIRECTORY_SEPARATOR;

			if ($invoice[0]['tax_file_2307']) {
				$imagePath = $targetdir . $invoice[0]['tax_file_2307'];
				if (file_exists($imagePath)) {
					unlink($imagePath);
				}
			}
		}
		$database->update("invoice", ["tax_file_2307" => ''], ["id" => $id]);
		return true;
	}
}

if (isset($_GET['add_pending_frequency_filter_val'])) {
	if (!empty($_POST)) {
		$post = $_POST;
		foreach ($post as $key => $value) {
			$data[$key] = $value;
			add_pending_frequency_filter_val($data);
		}
	}
}

if (isset($_GET['get_multiple_payment_receive_data'])) {
	$res['status'] = 0;
	$res['data'] = [];
	if (!empty($_POST)) {
		$post = $_POST;
		$invoice_id = isset($_POST['invoice_id']) ? $_POST['invoice_id'] : '';
		if ($invoice_id != '') {
			$multiple_payment_receive_data = get_multiple_payment_receive_data($invoice_id);
			$invoice_form_data = [];
			if (!empty($multiple_payment_receive_data)) {
				$res['status'] = 1;
				$html = '';
				$totle_balance = 0;
				$totle_amount = 0;
				$total_paid = 0;
				foreach ($multiple_payment_receive_data as $value) {
					$invoice_form_data['date_payment_receive_m'] = $value['date_payment_receive'];
					$invoice_form_data['payment_method_m'] = $value['payment_method'];
					$invoice_form_data['payment_ref_no_m'] = $value['payment_ref_no'];
					$invoice_form_data['ornumber_m'] = $value['ornumber'];
					$total_paid += $value['paid'];
					
					$totle_balance += $value['balance'];
					$totle_amount += $value['amount'];
					$is_duplicate = check_dup_invoice($multiple_payment_receive_data, $value['ref_no'], $value['clintid'], $value['month'], $value['id'], $value['date']);
					if ($is_duplicate) {
						$dup_html = "<span style='background-color: red; display: flex;width: 16px;height: 16px;'>
								<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='white' class='bi bi-check' viewBox='0 0 16 16'>
									<path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z'/>
								  </svg>
							</span>";
					} else {
						$dup_html = "<span style='background-color: lightgray; display: flex;width: 16px; height: 16px;'>&nbsp;</span>";
					}
	
					$client = getSingleValue("clients", "name", $value['clintid']);
					if (strlen($client) > 10) {
						$client_formated = substr($client, 0, 10) . '...';
					} else {
						$client_formated = $client;
					}
	
					if ($value['attachment'] != "") {
						$file = "<a href='javascript:void(0);' onClick=\"window.open('?route=invoiceTPdf&id={$value['clintid']}&invoice_id={$value['id']}', '_blank')\"><i class='fa fa-picture-o' aria-hidden='true'></i></a>&nbsp;&nbsp;<a class='onhoverfile' href='ajax.php?invoicefile=" . $value['attachment'] . "'><i class='fa fa-picture-o' aria-hidden='true'></i><span class='hovertextfile'>" . $value['attachment'] . "</span></a><br>";
					} else {
						$file = "<a href='javascript:void(0);' onClick=\"window.open('?route=invoiceTPdf&id={$value['id']}&invoice_id={$value['id']}', '_blank')\"><i class='fa fa-picture-o' aria-hidden='true'></i></a>&nbsp;";
					}
					$html .= '<tr>
					<td><input type="checkbox" data-invoice_id="' . $value['id'] . '" class="inv_check" style="zoom: 0 !important;"checked disabled></td>
					<td>' . $value['date'] . '</td>
					<td>' . $dup_html . '</td>
					<td>' . get_month_name($value['month']) . '</td>
					<td>' . $value['ref_no'] . '</td>
					<td>' . $client_formated . '</td>
					<td>' . $value['invoiceno'] . '</td>
					<td class="amt">' . $value['amount'] . '</td>
					<td>' . $file . '</td>
					<td class="defult_hide "><input name="paid_' . $value['id'] . '" class="paid_amt_input" data-id="' . $value['id'] . '" type="number" value="' . $value['paid'] . '"></td>
					<td class="defult_hide"><input name="tax_' . $value['id'] . '" class="tax_amt_input" data-id="' . $value['id'] . '" type="number" value="' . $value['tax_amount'] . '"></td>
					<td class="defult_hide ' . $value['id'] . '_balance"><input name="balance_' . $value['id'] . '" class="balance_amt_input" data-balance_amt="' . $value['balance'] . '" data-id="' . $value['id'] . '" type="number" value="' . $value['balance'] . '" readonly></td>
					</tr>';
				}

				$res['tbody'] = $html;
				$res['totle_balance'] = $totle_balance;
				$res['totle_amount'] = $totle_amount;
				$res['invoice_form_data'] = $invoice_form_data;
				$res['total_paid'] = $total_paid;
			}
		}
	}
	echo json_encode(['res' => $res]);
}

if (isset($_GET['multiple_payment'])) {
	$res['status'] = 0;
	$res['msg'] = "Somthing gone Wrong!";
	if ($_POST) {
		$files = [];
		if ($_FILES && !empty($_FILES)) {
			foreach ($_FILES as $key => $value) {
				$new_key = str_replace("#", "", $key);
				$new_key = str_replace("_m", "", $new_key);
				$files[$new_key] = $value;
			}
		}

		$invoice_ids = isset($_POST['invoice_ids']) && !empty($_POST['invoice_ids']) ? $_POST['invoice_ids'] : [];
		$invoice_ids = json_decode($_POST['invoice_ids'], true);
		if (empty($invoice_ids)) {
			$res['status'] = 2;
			$res['msg'] = "Select the Invoice to Allocate the Received Amount.!";
			echo json_encode(['res' => $res]);
		} else {
			$inv_ids = implode(',', $invoice_ids);
			$data['payment_method'] = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
			$data['payment_ref_no'] = isset($_POST['payment_ref_no']) ? $_POST['payment_ref_no'] : '';
			$data['ornumber'] = isset($_POST['ornumber']) ? $_POST['ornumber'] : '';
			$req['path'] = true;
			$or_file = uploadinvoice_orfile_2($data, $files, $req);
			$paid_file = uploadinvoice_paidfile_2($data, $files, $req);
			$tax_file = uploadinvoice_taxfile_2($data, $files, $req);
			$files_to_copy = [
				'or_file' => $or_file,
				'paid_file' => $paid_file,
				'tax_file' => $tax_file,
			];
			foreach ($invoice_ids as $invoice_id) {

				// multyple_file_upload_system
				$invoice_data = get_invoice_data($invoice_id);
				$client_id = $invoice_data['clintid'];
				$files_arr = [];
				foreach ($files_to_copy as $file_key => $file_data) {
					if (isset($file_data['path'])) {
						$source_path = $file_data['path'];
						$file_name = basename($source_path);
						// Extract the extension
						$extension = pathinfo($file_name, PATHINFO_EXTENSION);

						if ($file_key == 'or_file') {
							$targetdir = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "official_reciept" . DIRECTORY_SEPARATOR;
							$clients = getTableFiltered("clients", 'id', $client_id);
							$company_name = substr($clients[0]['name'], 0, 3);
							$invoiceno = str_replace(' ', '', $invoice_data['invoiceno']); // Remove all spaces
							$filename = $invoiceno . "_" . $data['ornumber'] . "_" . $company_name . "_OR." . $extension;
							$targetfile = $targetdir . $filename;
							if (file_exists($source_path)) {
								copy($source_path, $targetfile);
								$files_arr['or_file'] = $filename;
							}
						}

						if ($file_key == 'paid_file') {
							$targetdir = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "payment_proof" . DIRECTORY_SEPARATOR;
							$clients = getTableFiltered("clients", 'id', $client_id);
							$company_name = substr($clients[0]['name'], 0, 3);
							$invoiceno = str_replace(' ', '', $invoice_data['invoiceno']); // Remove all spaces
							$filename = $invoiceno . "_" . $data['ornumber'] . "_" . $company_name . "_PF." . $extension;
							$targetfile = $targetdir . $filename;
							if (file_exists($source_path)) {
								copy($source_path, $targetfile);
								$files_arr['paid_file'] = $filename;
							}
						}

						if ($file_key == 'tax_file') {
							$targetdir = $scriptpath . DIRECTORY_SEPARATOR . "payment_file" . DIRECTORY_SEPARATOR . "tax_payment" . DIRECTORY_SEPARATOR;
							$clients = getTableFiltered("clients", 'id', $client_id);
							$company_name = substr($clients[0]['name'], 0, 3);
							$invoiceno = str_replace(' ', '', $invoice_data['invoiceno']); // Remove all spaces
							$filename = $invoiceno . "_" . $data['ornumber'] . "_" . $company_name . "_TAX." . $extension;
							$targetfile = $targetdir . $filename;
							if (file_exists($source_path)) {
								copy($source_path, $targetfile);
								$files_arr['tax_file'] = $filename;
							}
						}
					}
				}

				$data['clintid'] = $client_id;
				$data['paid_file'] = !empty($files_arr['paid_file']) ? $files_arr['paid_file'] : $invoice_data['paid_file'];
				$data['tax_file_2307'] = !empty($files_arr['tax_file']) ?  $files_arr['tax_file'] : $invoice_data['tax_file_2307'];
				$data['or_file'] = !empty($files_arr['or_file']) ?  $files_arr['or_file'] : $invoice_data['or_file'];
				$data['date_payment_receive'] = $_POST['date_payment_receive'];
				update_bulk_invoice($data, $invoice_id);
			}

			$res['status'] = 1;
			$res['msg'] = "Bulk Invoice are paid";
			echo json_encode(['res' => $res]);
		}
	}
}

?>