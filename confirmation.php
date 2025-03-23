<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Sunset Beach Resort</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">Sunset Beach Resort</div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="rooms.html">Rooms</a></li>
                <li><a href="reservation.html">Reservation</a></li>
                <li><a href="index.html#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="page-title">
        <h1>Booking Confirmation</h1>
    </section>

    <section class="confirmation">
        <h2>Thank You for Your Reservation!</h2>
        <p>Your booking has been confirmed. Please check your email for details.</p>
        
        <div class="confirmation-details">
            <h3>Booking Details</h3>
            <p><strong>Booking Reference:</strong> <?php echo htmlspecialchars($bookingReference); ?></p>
            <p><strong>Room Type:</strong> <?php echo htmlspecialchars($roomTypeName); ?></p>
            <p><strong>Check-in Date:</strong> <?php echo htmlspecialchars($checkIn); ?></p>
            <p><strong>Check-out Date:</strong> <?php echo htmlspecialchars($checkOut); ?></p>
            <p><strong>Number of Nights:</strong> <?php echo htmlspecialchars($nights); ?></p>
            <p><strong>Number of Guests:</strong> <?php echo htmlspecialchars($guests); ?></p>
            <p><strong>Total Price:</strong> $<?php echo htmlspecialchars($totalPrice); ?></p>
            
            <h3>Guest Information</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
            
            <?php if (!empty($specialRequests)): ?>
            <h3>Special Requests</h3>
            <p><?php echo nl2br(htmlspecialchars($specialRequests)); ?></p>
            <?php endif; ?>
        </div>
        
        <p>If you have any questions about your reservation, please contact us.</p>
        <a href="index.html" class="btn">Return to Homepage</a>
    </section>

    <footer>
        <p>&copy; 2025 Sunset Beach Resort. All rights reserved.</p>
    </footer>
</body>
</html>

