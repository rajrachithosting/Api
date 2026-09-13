<?php
// Response ko JSON format mein set karne ke liye
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

// Query parameter check karna (GET ya POST dono support karta hai)
$user_message = isset($_REQUEST['msg']) ? trim($_REQUEST['msg']) : '';

// Agar query empty hai
if (empty($user_message)) {
    echo json_encode([
        "status" => false,
        "message" => "Please provide a 'msg' parameter. Example: api.php?msg=i love you"
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// Data JSON file ka name
$json_file = 'data.json';

// File exist karti hai ya nahi check karna
if (!file_exists($json_file)) {
    echo json_encode([
        "status" => false,
        "message" => "data.json file not found!"
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// JSON file ko read aur decode karna
$json_data = file_get_contents($json_file);
$database = json_decode($json_data, true);

$found_answers = null;

// User ke input ko lowercase karna for accurate matching
$clean_user_message = strtolower($user_message);

// Array mein question search karna
foreach ($database as $entry) {
    if (strtolower($entry['question']) === $clean_user_message) {
        $found_answers = $entry['answers'];
        break;
    }
}

// Response handle karna
if ($found_answers !== null) {
    // Multiple answers mein se ek random answer pick karna
    $random_answer = $found_answers[array_rand($found_answers)];

    echo json_encode([
        "status" => true,
        "query" => $user_message,
        "reply" => $random_answer
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} else {
    // Agar question match nahi hota
    echo json_encode([
        "status" => false,
        "query" => $user_message,
        "reply" => "Mujhe samajh nahi aaya 😊"
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
?>
