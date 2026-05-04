<?php
header('Content-Type: application/json');

// Get POST data (either from JSON or form data)
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    $input = $_POST;
}

$name = $input['name'] ?? '';
$email = $input['email'] ?? '';
$message = $input['message'] ?? '';
$budget = $input['budget'] ?? 'Not specified';

$errors = [];

// 1. String Manipulation: Format Name (Capitalize First Letters)
$formattedName = ucwords(strtolower(trim($name)));

if (empty($formattedName)) {
    $errors[] = "Name is required.";
}

// 2. Regular Expression Validation: Strict Email Check
$emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
if (!preg_match($emailPattern, trim($email))) {
    $errors[] = "Invalid email format detected by Regex.";
}

// 3. String Manipulation: Extract Domain from Email
$emailDomain = '';
if (strpos($email, '@') !== false) {
    $emailDomain = substr(strrchr($email, "@"), 1);
}

// 4. Array Searching: Blocked Domains (Spam Filter)
$blockedDomains = ['spam.com', 'fake.org', 'test.com'];
if (in_array(strtolower($emailDomain), $blockedDomains)) {
    $errors[] = "Emails from '$emailDomain' are blocked.";
}

if (empty($message)) {
    $errors[] = "Message is required.";
}

// 5. Array Merging & Sorting: Assigning Department automatically based on budget
$defaultDepartments = ['General Support', 'Sales'];
$specializedDepartments = ['Enterprise AI', 'Cloud Migration'];

// Merging arrays
$allDepartments = array_merge($defaultDepartments, $specializedDepartments);

// Sorting array alphabetically
sort($allDepartments);

// Simple logic to assign department
$assignedDepartment = $allDepartments[0]; // defaults to first alphabetically
if (strpos($budget, '10k') !== false) {
    $assignedDepartment = 'Enterprise AI'; // Just an example
}

if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'errors' => $errors
    ]);
    exit;
}

// Success response demonstrating the processed data
echo json_encode([
    'success' => true,
    'message' => "Thank you, {$formattedName}! Your message was routed to {$assignedDepartment}.",
    'debug_info' => [
        'extracted_domain' => $emailDomain,
        'merged_and_sorted_departments' => $allDepartments
    ]
]);
