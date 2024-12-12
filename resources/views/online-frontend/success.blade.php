<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body and Font */
body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    color: #333;
    padding: 20px;
}

/* Success Container */
.success-container {
    background-color: #fff;
    border-radius: 10px;
    padding: 40px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 50%;
    margin: 0 auto;
    margin-top: 100px;
}

/* Success Message */
.success-message {
    font-size: 28px;
    font-weight: bold;
    color: #28a745;
}

/* Success Details */
.success-details {
    font-size: 18px;
    margin-top: 15px;
    color: #555;
}

/* Back to Home Button */
.back-to-home {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #df9700;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}

.back-to-home:hover {
    background-color: #000;
}

</style>
<body>

<div class="success-container">
    <h3 class="success-message">Order has been successfully processed!</h3>
    <p class="success-details">Thank you for your purchase. Your order is being processed and will be shipped shortly.</p>
    <a href="{{ url('home') }}" class="back-to-home">Back to Home</a>
</div>

</body>
</html>
