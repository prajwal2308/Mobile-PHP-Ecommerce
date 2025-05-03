<?php

// php cart class
if (!class_exists('Cart')) {
    class Cart
    {
        public $db = null;

        public function __construct(DBController $db)
        {
            if (!isset($db->con)) return null;
            $this->db = $db;
            
            // Initialize session cart if not exists
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            // Sync cart with database on construction
            $this->syncCartWithDB();
        }

        // Sync cart items from database to session
        private function syncCartWithDB() {
            $query = "SELECT c.item_id, p.item_name, p.item_price, p.item_image 
                     FROM cart c 
                     JOIN product p ON c.item_id = p.item_id 
                     WHERE c.user_id = 1";
            $result = $this->db->con->query($query);

            if ($result) {
                $_SESSION['cart'] = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $_SESSION['cart'][$row['item_id']] = 1;
                }
            }
        }

        // insert into cart table
        public function insertIntoCart($params = null, $table = "cart"){
            if ($this->db->con != null){
                if ($params != null){
                    // Check if item already exists in cart
                    $item_id = $params['item_id'];
                    $check_query = "SELECT * FROM {$table} WHERE item_id = {$item_id} AND user_id = {$params['user_id']}";
                    $result = $this->db->con->query($check_query);
                    
                    if ($result->num_rows > 0) {
                        return true; // Item already in cart
                    }

                    // If not exists, insert new item
                    $columns = implode(',', array_keys($params));
                    $values = implode(',' , array_values($params));
                    $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);
                    return $this->db->con->query($query_string);
                }
            }
            return false;
        }

        // to get user_id and item_id and insert into cart table
        public function addToCart($userid, $itemid){
            if (isset($userid) && isset($itemid)){
                $params = array(
                    "user_id" => $userid,
                    "item_id" => $itemid
                );

                // insert data into cart
                $result = $this->insertIntoCart($params);
                if ($result){
                    // Update session cart
                    $_SESSION['cart'][$itemid] = 1;
                    
                    // Clean output buffer before redirect
                    ob_clean();
                    // Reload Page
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }
            }
        }

        // delete cart item using cart item id
        public function deleteCart($item_id = null, $table = 'cart'){
            if($item_id != null){
                $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
                if($result){
                    // Remove from session cart
                    if (isset($_SESSION['cart'][$item_id])) {
                        unset($_SESSION['cart'][$item_id]);
                    }
                    
                    ob_clean();
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }
                return $result;
            }
        }

        // get cart count
        public function getCartCount() {
            return count($_SESSION['cart']);
        }

        // check if item is in cart
        public function isInCart($item_id) {
            return isset($_SESSION['cart'][$item_id]);
        }

        // calculate sub total
        public function getSum($arr){
            if(isset($arr)){
                $sum = 0;
                foreach ($arr as $item){
                    $sum += floatval($item[0]);
                }
                return sprintf('%.2f' , $sum);
            }
        }

        // get item_id of shopping cart list
        public function getCartId($cartArray = null, $key = "item_id"){
            if ($cartArray != null){
                $cart_id = array_map(function ($value) use($key){
                    return $value[$key];
                }, $cartArray);
                return $cart_id;
            }
            return [];
        }

        // Save for later
        public function saveForLater($item_id = null, $saveTable = "wishlist", $fromTable = "cart"){
            if ($item_id != null){
                $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE item_id={$item_id};";
                $query .= "DELETE FROM {$fromTable} WHERE item_id={$item_id};";

                // execute multiple query
                $result = $this->db->con->multi_query($query);

                if($result){
                    header("Location :" . $_SERVER['PHP_SELF']);
                }
                return $result;
            }
        }
    }
}