<?php
header('Content-Type: application/json');

// Sample responses for the chatbot
$responses = [
    // Greetings
    "hello" => "Hi there! Welcome to our thrift shop. How can I assist you today?",
    "hi" => "Hello! How can I help you?",
    "how are you" => "I'm just a bot, but I'm here to assist you with anything you need!",

    // Product Availability
    "do you have vintage clothing" => "Yes, we have a wide range of vintage clothing. You can check our 'Vintage' section!",
    "what's new" => "We regularly update our collections. Check out the 'New Arrivals' section for the latest items!",
    "do you sell refurbished electronics" => "Yes, we offer a selection of refurbished electronics. Browse our 'Electronics' category for more details.",

    // Shopping Assistance
    "how do i search for items" => "You can use the search bar at the top of our website to find specific items.",
    "how to filter products" => "You can filter products by size, color, price, and more using the filter options on the category pages.",

    // Pricing and Discounts
    "do you offer discounts" => "Yes, we often run promotions. Be sure to check our 'Deals' section or subscribe to our newsletter for updates!",
    "how do i apply a promo code" => "You can enter your promo code at checkout in the designated box.",

    // Shipping and Delivery
    "what are your shipping options" => "We offer standard and express shipping. You can choose your preferred option at checkout.",
    "do you ship internationally" => "Yes, we ship to many countries worldwide. Shipping costs and times vary depending on the destination.",

    // Returns and Refunds
    "what is your return policy" => "We accept returns within 30 days of purchase as long as the items are in their original condition.",
    "how do i request a refund" => "To request a refund, please visit our 'Returns' page and follow the instructions provided.",

    // Payment
    "what payment methods do you accept" => "We accept credit cards, PayPal, and other popular payment methods.",
    "is it safe to use my credit card" => "Yes, our website uses secure encryption to protect your payment information.",

    // Account Management
    "how do i create an account" => "You can create an account by clicking on 'Sign Up' at the top of the page.",
    "i forgot my password" => "You can reset your password by clicking on 'Forgot Password' on the login page.",

    // Store Information
    "where are you located" => "We are an online store, but our warehouse is located in [City/Region].",
    "do you have a physical store" => "No, we operate exclusively online.",

    // Sustainability and Policies
    "where do you source your items" => "Our items come from various trusted suppliers and donations.",
    "are your products eco-friendly" => "We strive to ensure sustainability by offering pre-loved and upcycled products.",

    // Miscellaneous
    "how can i contact customer support" => "You can contact our support team via email at support@example.com or through our 'Contact Us' page.",
    "can i donate items" => "Yes, we accept donations. Please visit our 'Donate' page for more details.",
    "what should i do if i encounter an issue with the website" => "If you encounter an issue, please report it through our 'Help' section or email us directly.",
];

// Get the user's message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = strtolower(trim($_POST['message']));

    // Search for a predefined response
    $response = "Sorry, I don't understand that. Can you please rephrase?";
    foreach ($responses as $key => $value) {
        if (strpos($message, $key) !== false) {
            $response = $value;
            break;
        }
    }

    // Return the response
    echo json_encode(["response" => $response]);
}
?>
