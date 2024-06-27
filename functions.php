<?php
session_start();
include('connection.php');
function dd($value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}

// ajax function calling ... 
// delete ... calling 
if (isset($_POST["action"]) && $_POST["action"] === "deleteUser") {
    $userId = $_POST["userId"];
    echo deleteUser($db, $userId);
}

if (isset($_POST["action"]) && $_POST["action"] === "deleteProduct") {
    $productId = $_POST["productId"];
    echo deleteProduct($db, $productId);
}

if (isset($_POST["action"]) && $_POST["action"] === "saveorder") {
    echo saveOrder($db, $_POST);
}

if (isset($_POST["action"]) && $_POST["action"] === "pagination_orders") {

    $result =  getAllOrdersByCategory($_POST);
    // Echo the generated HTML as the AJAX response
    echo $result;
}

// undo &&deleting ... calling 
if (isset($_POST["action"]) && $_POST["action"] === "undoDelProduct") {
    $productId = $_POST["productId"];
    echo undoDelProduct($db, $productId);
}

if (isset($_POST["action"]) && $_POST["action"] === "deleteCategory") {
    $categorytId = $_POST["categoryId"];
    echo deleteCategory($db, $categorytId);
}

if (isset($_POST["action"]) && $_POST["action"] === "OrderStatus") {
    echo orderStatuschange($db, $_POST);
}

if (isset($_POST["action"]) && $_POST["action"] === "QtyUpdate") {
    echo orderQtychange($db, $_POST);
}

// orders management .... 
function saveOrder($db, $postData)
{

    $user_id = $_POST["user_id"];
    $category_id = $_POST["categoryId"];
    $selectedProducts = $_POST["products"];

    $status = "New";
    $orderQuery = "INSERT INTO orders (user_id,category_id, status) VALUES ('$user_id','$category_id', '$status')";
    $db->query($orderQuery);
    $order_id = $db->insert_id;

    foreach ($selectedProducts as $product) {
        $product_id = $product["pro_id"];
        $quantity = $product["quantity"];
        $avialable = $product["avialable"];

        $orderDetailsQuery = "INSERT INTO order_details (order_id, product_id, quantity,avialable) VALUES ('$order_id', '$product_id', '$quantity','$avialable')";
        $db->query($orderDetailsQuery);
    }

    return  "Oder Submitted successfully";
}

function getAllOrders()
{
    global $db;
    if (isset($_SESSION['user']) && isset($_SESSION['user_role'])) {
        $user_Id = $_SESSION['user']['id'];
        if ($_SESSION['user_role'] == 'admin') {

            $query = "SELECT o.id, o.order_date, o.status, u.name as user_name, u.shop_name, u.userImage as user_Image,
                p.name as product_name, od.quantity, od.avialable
                FROM orders as o
                join users as u on o.user_id = u.id
                join order_details as od on o.id = od.order_id
                join products as p on od.product_id = p.id
                ORDER BY o.id DESC";
        } else {
            $query = "SELECT o.id, o.order_date, o.status, u.userImage as user_Image, u.name as user_name, u.shop_name,
                p.name as product_name, od.quantity, od.avialable
                FROM orders as o
                JOIN users as u ON o.user_id = u.id
                JOIN order_details as od ON o.id = od.order_id
                JOIN products as p ON od.product_id = p.id
                WHERE u.id = '$user_Id'
                ORDER BY o.id DESC";
        }
    }

    $result = mysqli_query($db, $query);
    $orders = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $orderIndex = $row['id']; // Use the order ID as the index

            if (!isset($orders[$orderIndex])) {
                $orders[$orderIndex] = array(
                    'order_id' => $row['id'],
                    'order_date' => $row['order_date'],
                    'status' => $row['status'],
                    'user_Image' => $row['user_Image'],
                    'user_name' => $row['user_name'],
                    'shop_name' => $row['shop_name'],
                    'product_details' => array()
                );
            }

            $productDetails = array(
                'product_name' => $row['product_name'],
                'quantity' => $row['quantity'],
                'available_quantities' => $row['avialable']
            );

            $orders[$orderIndex]['product_details'][] = $productDetails;
        }
    }

    return $orders;
}

function getAllOrdersByCategory($post)
{
    global $db;
    $limit_per_page = 10;

    $page = "";
    $index = 0;
    if (isset($post["page_no"]) && !empty($post["page_no"])) {
        $page = $post["page_no"];
    } else {
        $page = 1;
    }
    $categoryId = $post["category_id"];
    $start_date = NULL;
    $end_date = NULL;
    if ($post["start_date"]) {
        $start_date = $post["start_date"];
    }

    if ($post["end_date"]) {
        $end_date = $post["end_date"];
    }

    $offset = ($page - 1) * $limit_per_page;

    if (isset($_SESSION['user']) && isset($_SESSION['user_role'])) {
        $user_Id = $_SESSION['user']['id'];
        if ($_SESSION['user_role'] == 'admin') {


            $sql = "SELECT o.id, o.order_date, o.status, u.userImage as user_Image, u.name as user_name, u.shop_name, c.name as category_name
                FROM orders as o
                JOIN users as u ON o.user_id = u.id
                JOIN categories as c on o.category_id = c.id
                WHERE o.category_id = '$categoryId'";
            if (!empty($start_date) && !empty($end_date)) {
                $sql .= " AND DATE(o.order_date) BETWEEN '" . (string)$start_date . "' AND '" . (string)$end_date . "'";
            }
            $sql .= " ORDER BY o.id DESC
                  LIMIT {$offset}, {$limit_per_page}";
        } else {

            $sql = "SELECT o.id, o.order_date, o.status, u.userImage as user_Image, u.name as user_name, u.shop_name, c.name as category_name
                FROM orders as o
                JOIN users as u ON o.user_id = u.id
                JOIN categories as c on o.category_id = c.id
                WHERE u.id = '$user_Id'
                AND o.category_id = '$categoryId'";
            if (!empty($start_date) && !empty($end_date)) {
                $sql .= " AND DATE(o.order_date) BETWEEN '" . (string)$start_date . "' AND '" . (string)$end_date . "'";
            }
            $sql .= " ORDER BY o.id DESC
                LIMIT {$offset}, {$limit_per_page}";
        }
    }


    $result = mysqli_query($db, $sql) or die("Query Unsuccessful.");
    $output = "";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $index = 0;
            $output .= '
                    <div id="order-card_' . $row['id'] . '" class="card mb-5 order-card">
                    <div class="row g-0 sh-lg-10 h-auto p-card pt-lg-0 pb-lg-0">
                        <div class="col-lg-2 d-flex align-items-center">
                        <p class="mb-0 pe-0 pr-lg-4"><b>Shop Name</b><br>
                            <span class="text-camelcase shop-name">' . ($row['shop_name'] ?? '') . '</span>
                        </p>
                        </div>
                        <div class="col-lg-2 d-flex align-items-center">
                        <p class="mb-0 text-alternate"><b>Shop Manager</b><br>
                            <span class="text-camelcase shop-manager">' . ($row['user_name'] ?? '') . '</span>
                        </p>
                        </div>
                        <div class="col-lg-2 d-flex align-items-center mb-1 mb-lg-0">
                        <p class="mb-0 text-alternate"><b>Order Date</b><br>
                            <span class="order-date">' . date("d F Y H:i:s", strtotime($row['order_date'])) . '</span>
                        </p>
                        </div>
                        <div class="col-lg-2 d-flex align-items-center">
                        <p class="mb-0 text-alternate"><b>Products Category</b><br>
                            <span class="text-camelcase product-category">' . ($row['category_name'] ?? '') . '</span>
                        </p>
                        </div>
                        <div class="col-lg-2 d-flex align-items-center mb-3 mb-lg-0">
                        <span id="order-text_' . $row['id'] . '" class="badge bg-tertiary text-uppercase order-status ' . ($row['status'] == 'Incomplete' ? 'bg-danger' : ($row['status'] == 'Pending' ? 'bg-warning' : ($row['status'] == 'Completed' ? 'bg-success' : ''))) . '">' . ($row['status'] ? $row['status'] : '') . '</span>
                        </div>
                        <div class="col-lg-2 d-flex align-items-center justify-content-left justify-content-lg-end">
                        <div id="order-status_' . $row['id'] . '">
                            <button id="order-completed_' . $row['id'] . '" data-order_id="' . $row['id'] . '" data-order_status="Completed"  
                            class="' . (in_array($row['status'], ['Pending', 'New', 'Incomplete']) ? '' : 'd-none') . ' btn-status_order btn btn-sm btn-icon btn-icon-only btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-check undefined">
                                <path d="M16 5L7.7051 14.2166C7.32183 14.6424 6.65982 14.6598 6.2547 14.2547L3 11"></path>
                            </svg>
                            </button>
                            <button id="order-cancel_' . $row['id'] . '" data-order_id="' . $row['id'] . '" data-order_status="Canceled"
                            class="' . (in_array($row['status'], ['Pending', 'New']) ? '' : 'd-none') . ' btn-status_order btn btn-sm btn-icon btn-icon-only btn-outline-secondary ms-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-close undefined">
                                <path d="M5 5 15 15M15 5 5 15"></path>
                            </svg>
                            </button>
                        </div>
                        <button id="order-undu_' . $row['id'] . '" data-order_id="' . $row['id'] . '" data-order_status="Pending" 
                            class="btn-status_order ' . (in_array($row['status'], ['Pending', 'New']) ? 'd-none' : '') . ' btn btn-sm btn-icon btn-icon-only btn-outline-secondary ms-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                        </button>
                        <button data-order_id="' . $row['id'] . '" class="btn btn_product-table btn-sm btn-icon btn-icon-only btn-outline-secondary ms-1" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                            </svg>
                        </button>
                        <button data-order_id="' . $row['id'] . '" class="download-pdf btn btn-sm btn-icon btn-icon-only btn-outline-secondary ms-1" type="button">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        </button>
                        </div>
                    </div>
                    <table id="oder_products_' . $row['id'] . '" class="table d-none ">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Available</th>
                            <th scope="col">Order</th>
                            <th scope="col">Missed</th>
                            <th scope="col">Receved</th>
                        </tr>
                        </thead>
                        <tbody>';

            $sql_2 = "SELECT od.*, p.name AS product_name
                    FROM order_details AS od
                    JOIN products AS p ON p.id = od.product_id
                    WHERE od.order_id = '" . $row['id'] . "'";

            $products = mysqli_query($db, $sql_2) or die("Query Unsuccessful.");
            if (mysqli_num_rows($products) > 0) {
                while ($detail = mysqli_fetch_assoc($products)) {
                    $output .= '
                    <tr>
                        <td scope="row">' . ++$index . '</td>
                        <td>' . ($detail['product_name'] ?? '') . '</td>
                        <td>' . ($detail['avialable'] ?? '') . '</td>
                        <td>' . ($detail['quantity'] ?? '') . '</td>
                        <td><input class="missed_qty_' . $row['id'] . '" name="missed_qty_' . $detail['id'] . '" id="missed_qty_' . $detail['id'] . '" type="number" value="' . ($detail['missed_qty'] ?? '0') . '" ' . ($_SESSION['user_role'] == 'admin' ? 'disabled' : '0') . ' ></td>
                        <td><input name="is_received_' . $detail['id'] . '" id="is_received_' . $detail['id'] . '" type="checkbox" class="product-checkboxes form-check-input" ' . (($detail['is_received'] == 'Yes') ? 'checked' : '') . ' style="padding: 12px;" ' . ($_SESSION['user_role'] == 'admin' ? 'disabled' : '0') . '></td>
                    </tr>';
                }
            }

            if ($_SESSION['user_role'] != 'admin') {
                $output .= '
                <tr>
                    <td scope="row"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button class="btn btn-primary rounded update-qty float-right " data-order_id="' . $row['id'] . '"  > Update Details </button></td>
                </tr>    ';
            }

            $output .= '
                        </tbody>

                    </table>
                </div>';
        }



        if (isset($_SESSION['user']) && isset($_SESSION['user_role'])) {
            $user_Id = $_SESSION['user']['id'];
            if ($_SESSION['user_role'] == 'admin') {
                $sql_3 = "SELECT o.id as total_records
                    FROM orders as o
                    JOIN users as u ON o.user_id = u.id
                    JOIN categories as c on o.category_id = c.id
                    WHERE o.category_id = '$categoryId'";
                if (!empty($start_date) && !empty($end_date)) {
                    $sql_3 .= " AND DATE(o.order_date) BETWEEN '" . (string)$start_date . "' AND '" . (string)$end_date . "'";
                }
            } else {

                $sql_3 = "SELECT o.id as total_records
                    FROM orders as o
                    JOIN users as u ON o.user_id = u.id
                    JOIN categories as c on o.category_id = c.id
                    WHERE u.id = '$user_Id'
                    AND o.category_id = '$categoryId'";
                if (!empty($start_date) && !empty($end_date)) {
                    $sql_3 .= " AND DATE(o.order_date) BETWEEN '" . (string)$start_date . "' AND '" . (string)$end_date . "'";
                }
            }
        }

        $result_count = mysqli_query($db, $sql_3) or die("Query Unsuccessful.");
        $total_record = $result_count->num_rows;
        $total_pages = ceil($total_record / $limit_per_page);


        $output .= '<div id="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $class_name = "active";
            } else {
                $class_name = "";
            }
            $output .= "<a class='{$class_name}' id='{$i}' href=''>{$i}</a>";
        }
        $output .= '</div>';
        return $output;
    } else {
        $output = '
            <div class="card mb-2" data-title="Product Card" data-intro="Here is a product card with buttons!" data-step="2">
            <div class="row g-0 sh-12">
                <div class="col">
                <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center">
                    <div class="col-12 col-md-12 d-flex align-items-center justify-content-center">
                        <span id="oder-available" class="fw-bold fs-6">No Order Available Yet!</span>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>';
        return $output;
    }
}

function totalStats($db, $tableName)
{
    $productCount = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as totalCount FROM $tableName"))['totalCount'];
    return $productCount;
}

function ordersManage($db, $tableName, $status)
{
    $productCount = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as totalCount FROM $tableName Where status = '$status'"))['totalCount'];
    return $productCount;
}

function orderStatuschange($db, $post)
{
    $orderID = $post["id"];
    $newStatus = $post["status"];
    $query = "UPDATE orders SET status = '$newStatus' WHERE id = '$orderID'";
    $result = mysqli_query($db, $query);
    if ($result) {
        $return = 'yes';
    } else {
        $return = 'no';
    }

    return $return;
}

function orderQtychange($db, $post)
{
    $result  = '';
    $orderId = $post['order_id'];
    $products = $post['products'];
    $totalMissedQty = 0.0;
    $isAnyProductNotReceived = false;

    foreach ($products as $product) {
        $id = $product['id'];
        $missedQty = floatval($product['missed_qty']);
        $isReceived = $product['is_received'];

        $sql = "UPDATE order_details 
                SET missed_qty = '$missedQty', is_received = '$isReceived' 
                WHERE id = '$id'";
        mysqli_query($db, $sql);

        $totalMissedQty += $missedQty;

        if ($isReceived == 'No') {
            $isAnyProductNotReceived = true;
        }
    }

    if ($totalMissedQty > 0 || $isAnyProductNotReceived) {
        $result = 'Incomplete';
        $sql = "UPDATE orders 
                SET status = 'Incomplete' 
                WHERE id = '$orderId'";
    } else {
        $result = 'Completed';
        $sql = "UPDATE orders 
                SET status = 'Completed' 
                WHERE id = '$orderId'";
    }
    mysqli_query($db, $sql);



    return $result;
}


function deleteUser($db, $userId)
{
    $query = "UPDATE users SET status = 2 WHERE id = $userId";
    $result = mysqli_query($db, $query);

    if ($result) {
        $userCount = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as userCount FROM users WHERE status = 1 AND role = 'user'"))['userCount'];
        if ($userCount > 0) {
            return "success";
        } else {
            return "no-user";
        }
    } else {
        return "failure";
    }
}

function storeUser($db, $postData, $imagePath = NULL)
{
    $name = mysqli_real_escape_string($db, $postData["name"]);
    $shopName = mysqli_real_escape_string($db, $postData["shop-name"]);
    $email = mysqli_real_escape_string($db, $postData["email"]);
    $password = mysqli_real_escape_string($db, $postData["password"]);
    $id = mysqli_real_escape_string($db, $postData["id"]);
    $hashedPassword = "";

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    $result = false;
    if (!empty($id)) {
        if (!empty($imagePath)) {
            $query = "UPDATE users SET name = '$name', shop_name = '$shopName', email = '$email', password = '$hashedPassword', userImage = '$imagePath' WHERE id = $id";
        } else {
            $query = "UPDATE users SET name = '$name', shop_name = '$shopName', email = '$email', password = '$hashedPassword' WHERE id = $id";
        }
    } else {
        if (!empty($imagePath)) {
            $query = "INSERT INTO users (name, shop_name, email, password, userImage) VALUES ('$name','$shopName', '$email', '$hashedPassword', '$imagePath')";
        } else {
            $query = "INSERT INTO users (name, shop_name, email, password) VALUES ('$name', '$email', '$shopName', '$hashedPassword')";
        }
    }

    $result = mysqli_query($db, $query);

    if (!$result) {
        echo "Query failed: " . mysqli_error($db);
    }

    return $result;
}

function getAllUsers()
{
    global $db; // Assuming you have your database connection in $db

    $query = "SELECT * FROM users WHERE status = 1 AND role ='user' ORDER By id DESC";
    $result = mysqli_query($db, $query);

    $users = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }

    return $users;
}

function getOneUsers()
{
    global $db; // Assuming you have your database connection in $db

    $query = "SELECT * FROM users WHERE status = 1 AND role ='user' ORDER By id DESC";
    $result = mysqli_query($db, $query);

    $users = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }

    return $users;
}

// products management .....
function storeProduct($db, $postData, $imagePath = NULL)
{
    $name = mysqli_real_escape_string($db, $postData["name"]);
    $price = mysqli_real_escape_string($db, $postData["price"]);
    $category_id = mysqli_real_escape_string($db, $postData["category_id"]);
    $id = mysqli_real_escape_string($db, $postData["id"]);

    $result = false;
    if (!empty($id)) {
        if (!empty($imagePath)) {
            $query = "UPDATE products SET name = '$name', price = '$price', category_id = '$category_id', productImage = '$imagePath' WHERE id = '$id'";
        } else {
            $query = "UPDATE products SET name = '$name', price = '$price', category_id = '$category_id' WHERE id = '$id'";
        }
    } else {
        if (!empty($imagePath)) {
            $query = "INSERT INTO products (name,price, productImage,category_id) VALUES ('$name','$price','$imagePath','$category_id')";
        } else {
            $query = "INSERT INTO products (name,price,category_id) VALUES ('$name','$price','$category_id')";
        }
    }

    $result = mysqli_query($db, $query);

    if (!$result) {
        echo "Query failed: " . mysqli_error($db);
    }

    return $result;
}

function getAllProduct()
{
    global $db;

    $query = "SELECT * FROM products WHERE status = 1 ORDER By id DESC";
    $result = mysqli_query($db, $query);

    $products = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }

    return $products;
}

function getAllDletedProduct()
{
    global $db;

    $query = "SELECT * FROM products WHERE status = 2 ORDER By id DESC";
    $result = mysqli_query($db, $query);

    $products = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }

    return $products;
}

function getAllProductByCategory($categoryId)
{
    global $db;

    $query = "SELECT * FROM products WHERE status = 1 AND category_id = '$categoryId' ORDER By id DESC";
    $result = mysqli_query($db, $query);

    $categoryProducts = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categoryProducts[] = $row;
        }
    }

    return $categoryProducts;
}

function deleteProduct($db, $productId)
{
    $query = "UPDATE products SET status = 2 WHERE id = $productId";
    $result = mysqli_query($db, $query);

    if ($result) {
        $productCount = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as productCount FROM products WHERE status = 1"))['productCount'];
        if ($productCount > 0) {
            return "success";
        } else {
            return "no-procut";
        }
    } else {
        return "failure";
    }
}

function undoDelProduct($db, $productId)
{
    $query = "UPDATE products SET status = 1 WHERE id = $productId";
    $result = mysqli_query($db, $query);

    if ($result) {
        $productCount = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as productCount FROM products WHERE status = 1"))['productCount'];
        if ($productCount > 0) {
            return "success";
        } else {
            return "no-procut";
        }
    } else {
        return "failure";
    }
}

//categories functionalities ... here...
function getAllCategoris()
{
    global $db;

    $query = "SELECT * FROM categories WHERE status = 'Active' ORDER By id DESC";
    $result = mysqli_query($db, $query);

    $categories = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
    }

    return $categories;
}

function storeCategory($db, $postData, $imagePath = NULL)
{
    $name = mysqli_real_escape_string($db, $postData["name"]);
    $id = mysqli_real_escape_string($db, $postData["id"]);


    $result = false;
    if (!empty($id)) {
        $query = "UPDATE categories SET name = '$name' WHERE id = '$id'";
    } else {
        $query = "INSERT INTO categories (name) VALUES ('$name')";
    }

    $result = mysqli_query($db, $query);

    if (!$result) {
        echo "Query failed: " . mysqli_error($db);
    }

    return $result;
}

function deleteCategory($db, $catoryId)
{
    $query = "UPDATE categories SET status = 'Deleted' WHERE id = $catoryId";
    $result = mysqli_query($db, $query);

    if ($result) {
        $catoryCount = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) as categoryCount FROM categories WHERE status = 'Active'"))['categoryCount'];
        if ($catoryCount > 0) {
            return "success";
        } else {
            return "no-category";
        }
    } else {
        return "failure";
    }
}

// orders_bug_fix();

function orders_bug_fix()
{
    global $db;
    // 1. Retrieve a list of order_id values from the orders table
    $sql = "SELECT id FROM orders";
    $result = mysqli_query($db, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $orderID = $row['id'];

            // 2. For each order_id, execute a query to fetch the corresponding cat_id
            $catSql = "SELECT c.id AS cat_id
                        FROM order_details AS od
                        JOIN products AS p ON p.id = od.product_id
                        JOIN categories AS c ON c.id = p.category_id
                        WHERE od.order_id = $orderID";

            $catResult = mysqli_query($db, $catSql);
            if ($catResult) {
                while ($catRow = mysqli_fetch_assoc($catResult)) {
                    $catID = $catRow['cat_id'];

                    // 3. Update the orders table with the fetched cat_id
                    $updateSql = "UPDATE orders SET category_id = $catID WHERE id = $orderID";
                    mysqli_query($db, $updateSql);

                    // Now you have $orderID and $catID for further processing
                    // You've also updated the category_id for the current order
                }
            }
        }
    }
}
