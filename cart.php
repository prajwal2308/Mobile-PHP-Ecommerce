<?php

// for output buffering.

ob_start();
require 'functions.php';

// Get cart items from database
$cart_items = array();
if (!empty($_SESSION['cart'])) {
    $item_ids = implode(',', array_keys($_SESSION['cart']));
    $cart_query = "SELECT p.* 
                   FROM product p 
                   WHERE p.item_id IN ($item_ids)";
    $result = $db->con->query($cart_query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $cart_items[] = array_merge($row, ['quantity' => $_SESSION['cart'][$row['item_id']]]);
        }
    }
}

// Handle cart actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete-cart-submit'])) {
        $deleted_record = $Cart->deleteCart($_POST['item_id']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Mobitech</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .cart-container {
            max-width: 1200px;
            margin: 80px auto 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .cart-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-table th, .cart-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .cart-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .quantity-input {
            width: 60px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .remove-btn {
            color: #e65100;
            text-decoration: none;
        }

        .remove-btn:hover {
            text-decoration: underline;
        }

        .cart-summary {
            margin-top: 20px;
            text-align: right;
        }

        .total-price {
            font-size: 20px;
            font-weight: bold;
            color: #e65100;
            margin-bottom: 20px;
        }

        .checkout-btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #e65100;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .checkout-btn:hover {
            background-color: #d84315;
        }

        .empty-cart {
            text-align: center;
            padding: 40px;
            color: #666;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="cart-container">
        <h1 class="cart-title">Shopping Cart</h1>

        <?php if (!empty($cart_items)): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($cart_items as $item):
                        $subtotal = $item['item_price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($item['item_image']); ?>" alt="<?php echo htmlspecialchars($item['item_name']); ?>" class="product-img">
                            </td>
                            <td>
                                <div><?php echo htmlspecialchars($item['item_name']); ?></div>
                                <div class="text-muted"><?php echo htmlspecialchars($item['item_brand']); ?></div>
                            </td>
                            <td>$<?php echo number_format($item['item_price'], 2); ?></td>
                            <td>
                                <input type="number" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input" disabled>
                            </td>
                            <td>$<?php echo number_format($subtotal, 2); ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                                    <button type="submit" name="delete-cart-submit" class="remove-btn">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-summary">
                <div class="total-price">Total: $<?php echo number_format($total, 2); ?></div>
                <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
            </div>
        <?php else: ?>
            <div class="empty-cart">
                <p>Your cart is empty.</p>
                <a href="index.php" class="checkout-btn">Continue Shopping</a>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>


