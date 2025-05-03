<?php
session_start();
include 'functions.php';

$product_id = isset($_GET['id']) ? $_GET['id'] : '';
$products = [
    '6t' => [
        'name' => 'OnePlus 6T',
        'price' => 599.99,
        'description' => 'The OnePlus 6T features a 6.41-inch Optic AMOLED display, Snapdragon 845, and in-display fingerprint sensor.',
        'specs' => [
            'Display' => '6.41-inch Optic AMOLED',
            'Processor' => 'Snapdragon 845',
            'RAM' => '6GB/8GB',
            'Storage' => '128GB/256GB',
            'Battery' => '3700mAh'
        ],
        'image' => '6t.jpg'
    ],
    '7pro' => [
        'name' => 'OnePlus 7 Pro',
        'price' => 699.99,
        'description' => 'The OnePlus 7 Pro features a 6.67-inch Fluid AMOLED display, Snapdragon 855, and triple camera system.',
        'specs' => [
            'Display' => '6.67-inch Fluid AMOLED',
            'Processor' => 'Snapdragon 855',
            'RAM' => '6GB/8GB/12GB',
            'Storage' => '128GB/256GB',
            'Battery' => '4000mAh'
        ],
        'image' => '7 pro.png'
    ],
    // Add more products here
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Mobitech</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .product-container {
            max-width: 1200px;
            margin: 80px auto 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .product-details {
            display: flex;
            gap: 40px;
            padding: 20px;
        }

        .product-image {
            flex: 0 0 400px;
        }

        .product-image img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .product-info {
            flex: 1;
        }

        .product-title {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 24px;
            color: #e65100;
            margin-bottom: 20px;
        }

        .product-description {
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .specs-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .specs-table th, .specs-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .specs-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .add-to-cart {
            display: inline-block;
            padding: 12px 24px;
            background-color: #e65100;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .add-to-cart:hover {
            background-color: #d84315;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="product-container">
        <?php if (isset($products[$product_id])): ?>
            <?php $product = $products[$product_id]; ?>
            <div class="product-details">
                <div class="product-image">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="product-info">
                    <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
                    <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                    <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                    
                    <h2>Specifications</h2>
                    <table class="specs-table">
                        <?php foreach ($product['specs'] as $spec => $value): ?>
                            <tr>
                                <th><?php echo htmlspecialchars($spec); ?></th>
                                <td><?php echo htmlspecialchars($value); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <a href="cart.php?action=add&id=<?php echo urlencode($product_id); ?>" class="add-to-cart">Add to Cart</a>
                </div>
            </div>
        <?php else: ?>
            <p>Product not found.</p>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html> 