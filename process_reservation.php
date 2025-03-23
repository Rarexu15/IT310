<?php
// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $roomType = $_POST["roomType"] ?? '';
    $checkIn = $_POST["checkIn"] ?? '';
    $checkOut = $_POST["checkOut"] ?? '';
    $guests = $_POST["guests"] ?? '';
    $firstName = $_POST["firstName"] ?? '';
    $lastName = $_POST["lastName"] ?? '';
    $email = $_POST["email"] ?? '';
    $phone = $_POST["phone"] ?? '';
    $specialRequests = $_POST["specialRequests"] ?? '';
    
    // Validate required fields
    $errors = [];
    
    if (empty($roomType)) {
        $errors[] = "Room type is required";
    }
    
    if (empty($checkIn)) {
        $errors[] = "Check-in date is required";
    }
    
    if (empty($checkOut)) {
        $errors[] = "Check-out date is required";
    }
    
    if (empty($guests)) {
        $errors[] = "Number of guests is required";
    }
    
    if (empty($firstName)) {
        $errors[] = "First name is required";
    }
    
    if (empty($lastName)) {
        $errors[] = "Last name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($phone)) {
        $errors[] = "Phone number is required";
    }
    
    // Check if check-out date is after check-in date
    if (!empty($checkIn) && !empty($checkOut)) {
        $checkInDate = new DateTime($checkIn);
        $checkOutDate = new DateTime($checkOut);
        
        if ($checkInDate >= $checkOutDate) {
            $errors[] = "Check-out date must be after check-in date";
        }
    }
    
    // If there are errors, redirect back to the form
    if (!empty($errors)) {
        $errorString = implode(", ", $errors);
        header("Location: reservation.html?error=" . urlencode($errorString));
        exit;
    }
    
    // Calculate number of nights and total price
    $checkInDate = new DateTime($checkIn);
    $checkOutDate = new DateTime($checkOut);
    $interval = $checkInDate->diff($checkOutDate);
    $nights = $interval->days;
    
    $pricePerNight = 0;
    $roomTypeName = "";
    
    switch ($roomType) {
        case "standard":
            $pricePerNight = 120;
            $roomTypeName = "Standard Room";
            break;
        case "deluxe":
            $pricePerNight = 180;
            $roomTypeName = "Deluxe Room";
            break;
        case "premium":
            $pricePerNight = 250;
            $roomTypeName = "Premium Suite";
            break;
    }
    
    $totalPrice = $pricePerNight * $nights;
    
    // In a real application, you would save the reservation to a database here
    // For this prototype, we'll just display a confirmation page
    
    // Generate a random booking reference
    $bookingReference = strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
    
    // Display confirmation page
    include 'confirmation.php';
} else {
    // If not submitted via POST, redirect to the reservation form
    header("Location: reservation.html");
    exit;
}
?>

