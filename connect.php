<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}


function clean($s) {
    return trim($s);
}


$form_type = isset($_POST['form_type']) ? $_POST['form_type'] : '';

$mysqli = get_db_connection();

if ($form_type === 'donor') {
    
    $firstname  = isset($_POST['firstname']) ? clean($_POST['firstname']) : '';
    $email      = isset($_POST['email']) ? clean($_POST['email']) : '';
    $phone      = isset($_POST['phone']) ? clean($_POST['phone']) : '';
    $state      = isset($_POST['state']) ? clean($_POST['state']) : '';
    $bloodgroup = isset($_POST['bloodgroup']) ? clean($_POST['bloodgroup']) : '';
    $organname  = isset($_POST['organname']) ? clean($_POST['organname']) : '';
    $notes      = isset($_POST['notes']) ? clean($_POST['notes']) : '';
    $consent    = isset($_POST['consent']) ? clean($_POST['consent']) : '';

    // Basic validation
    if (!$firstname || !$email || !$phone || !$state || !$bloodgroup || !$organname || !$consent) {
        header('Location: index.html?status=error&msg=missing');
        exit;
    }

 $stmt = $mysqli->prepare("INSERT INTO donors (firstname, email, phone, state, bloodgroup, organname, notes, consent)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        error_log("Prepare failed: " . $mysqli->error);
        header('Location: index.html?status=error&msg=server');
        exit;
    }
    $stmt->bind_param('ssssssss', $firstname, $email, $phone, $state, $bloodgroup, $organname, $notes, $consent);
    $ok = $stmt->execute();
    $stmt->close();

    if ($ok) {
        header('Location: index.html?status=success&form=donor');
        exit;
    } else {
        error_log("Execute failed: " . $mysqli->error);
        header('Location: index.html?status=error&msg=insert');
        exit;
    }

} elseif ($form_type === 'recipient') {
    $fullname   = isset($_POST['fullname']) ? clean($_POST['fullname']) : '';
    $email      = isset($_POST['email']) ? clean($_POST['email']) : '';
    $phone      = isset($_POST['phone']) ? clean($_POST['phone']) : '';
    $state      = isset($_POST['state']) ? clean($_POST['state']) : '';
    $bloodgroup = isset($_POST['bloodgroup']) ? clean($_POST['bloodgroup']) : '';
    $organname  = isset($_POST['organname']) ? clean($_POST['organname']) : '';
    $urgency    = isset($_POST['urgency']) ? clean($_POST['urgency']) : '';
    $notes      = isset($_POST['notes']) ? clean($_POST['notes']) : '';

    if (!$fullname || !$email || !$phone || !$state || !$bloodgroup || !$organname || !$urgency) {
        header('Location: index.html?status=error&msg=missing');
        exit;
    }

$stmt = $mysqli->prepare("INSERT INTO recipients (fullname, email, phone, state, bloodgroup, organname, urgency, notes)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)");




    if (!$stmt) {
        error_log("Prepare failed: " . $mysqli->error);
        header('Location: index.html?status=error&msg=server');
        exit;
    }
    $stmt->bind_param('ssssssss', $fullname, $email, $phone, $state, $bloodgroup, $organname, $urgency, $notes);
    $ok = $stmt->execute();
    $stmt->close();

    if ($ok) {
        header('Location: index.html?status=success&form=recipient');
        exit;
    } else {
        error_log("Execute failed: " . $mysqli->error);
        header('Location: index.html?status=error&msg=insert');
        exit;
    }

} // add this into connect.php (between the recipient and final else blocks)
elseif ($form_type === 'contact') {
    $name    = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email   = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone   = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $purpose = isset($_POST['purpose']) ? trim($_POST['purpose']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // basic validation
    if (!$name || !$email || !$purpose || !$message) {
        header('Location: contact.html?status=error&form=contact&msg=missing');
        exit;
    }

    $stmt = $mysqli->prepare("INSERT INTO contacts (name, email, phone, purpose, message, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    if (!$stmt) {
        error_log("Prepare failed (contacts): " . $mysqli->error);
        header('Location: contact.html?status=error&form=contact&msg=server');
        exit;
    }
    $stmt->bind_param('sssss', $name, $email, $phone, $purpose, $message);
    $ok = $stmt->execute();
    $stmt->close();

    if ($ok) {
        header('Location: contact.html?status=success&form=contact');
        exit;
    } else {
        error_log("Execute failed (contacts): " . $mysqli->error);
        header('Location: contact.html?status=error&form=contact&msg=insert');
        exit;
    }
}
else {
    header('Location: index.html?status=error&msg=invalid');
    exit;
}
