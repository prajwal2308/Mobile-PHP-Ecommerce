<?php
include 'functions.php';

// Check if cart is empty
if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Here you would typically:
    // 1. Validate the form data
    // 2. Process the payment
    // 3. Save the order to database
    // 4. Clear the cart
    // 5. Send confirmation email
    
    // For demo purposes, we'll just clear the cart and show success
    $_SESSION['cart'] = [];
    header('Location: order-success.php');
    exit;
}

// Calculate total
$total = 0;
$cart_items = array();
foreach ($_SESSION['cart'] as $id => $quantity) {
    $result = $product->getProduct($id);
    if (!empty($result)) {
        $item = $result[0];
        $cart_items[$id] = $item;
        $total += $item['item_price'] * $quantity;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Mobitech</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .checkout-container {
            max-width: 1200px;
            margin: 80px auto 20px;
            padding: 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .checkout-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .order-summary {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            height: fit-content;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
            color: #e65100;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #eee;
        }

        .checkout-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #e65100;
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .checkout-btn:hover {
            background-color: #d84315;
        }

        @media screen and (max-width: 768px) {
            .checkout-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="checkout-container">
        <form class="checkout-form" method="post">
            <div class="form-section">
                <h2>Shipping Information</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="zipCode">ZIP Code</label>
                        <input type="text" id="zipCode" name="zipCode" required>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2>Payment Information</h2>
                <div class="form-group">
                    <label for="cardName">Name on Card</label>
                    <input type="text" id="cardName" name="cardName" required>
                </div>
                <div class="form-group">
                    <label for="cardNumber">Card Number</label>
                    <input type="text" id="cardNumber" name="cardNumber" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="expiry">Expiry Date</label>
                        <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="checkout-btn">Place Order</button>
        </form>

        <div class="order-summary">
            <h2>Order Summary</h2>
            <?php foreach ($_SESSION['cart'] as $id => $quantity):
                if (isset($cart_items[$id])):
                    $item = $cart_items[$id];
                    $subtotal = $item['item_price'] * $quantity;
            ?>
                <div class="summary-item">
                    <span><?php echo htmlspecialchars($item['item_name']); ?> × <?php echo $quantity; ?></span>
                    <span>$<?php echo number_format($subtotal, 2); ?></span>
                </div>
            <?php 
                endif;
            endforeach; ?>
            
            <div class="summary-item">
                <span>Shipping</span>
                <span>Free</span>
            </div>
            
            <div class="total">
                <span>Total</span>
                <span>$<?php echo number_format($total, 2); ?></span>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html> 