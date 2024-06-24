<?php
  $limit_per_page = 5;

  $page = "";
  $index = 0;
  if(isset($post["page_no"])){
    $page = $post["page_no"];
  }else{
    $page = 1;
  }
  $categoryId = $post["category_id"];

  $offset = ($page - 1) * $limit_per_page;


  if (isset($_SESSION['user']) && isset($_SESSION['user_role'])) {
    $user_Id = $_SESSION['user']['id'];
    if ($_SESSION['user_role'] == 'admin') {
      $sql = "SELECT o.id, o.order_date, o.status, u.name as user_name, u.shop_name, u.userImage as user_Image,
      p.name as product_name, c.name as category_name, od.quantity, od.avialable
      FROM orders as o
      join users as u on o.user_id = u.id
      join order_details as od on o.id = od.order_id
      join products as p on od.product_id = p.id
      join categories as c on p.category_id = c.id
      WHERE p.category_id = '$categoryId'
      ORDER BY o.id DESC LIMIT {$offset},{$limit_per_page}";

    }else{
        $sql = "SELECT o.id, o.order_date, o.status, u.userImage as user_Image, u.name as user_name, u.shop_name,
        p.name as product_name,c.name as category_name, od.quantity, od.avialable
        FROM orders as o
        JOIN users as u ON o.user_id = u.id
        JOIN order_details as od ON o.id = od.order_id
        JOIN products as p ON od.product_id = p.id
        join categories as c on p.category_id = c.id
        WHERE u.id = '$user_Id'
        AND p.category_id = '$categoryId'
        ORDER BY o.id DESC LIMIT {$offset},{$limit_per_page}";
    }
        
}

  $result = mysqli_query($db,$sql) or die("Query Unsuccessful.");
  $output= "";
  if(mysqli_num_rows($result) > 0){

      while($row = mysqli_fetch_assoc($result)) {
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
                  <span id="order-text_' . $row['id'] . '" class="badge bg-tertiary text-uppercase order-status">' . ($row['status'] ? $row['status'] : '') . '</span>
                </div>
                <div class="col-lg-2 d-flex align-items-center justify-content-left justify-content-lg-end">
                  <div id="order-status_' . $row['id'] . '">
                    <button id="order-completed_' . $row['id'] . '" data-order_id="' . $row['id'] . '" data-order_status="Completed"  
                      class="' . (in_array($row['status'], ['Pending', 'New']) ? '' : 'd-none') . ' btn-status_order btn btn-sm btn-icon btn-icon-only btn-outline-primary">
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
                  <button data-order_id="' . $row['id'] . '" class="btn bnt_product-table btn-sm btn-icon btn-icon-only btn-outline-secondary ms-1" type="button">
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
              <table id="oder_products_' . $row['id'] . '" class="table d-none">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Available</th>
                    <th scope="col">Order</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td scope="row">' . ++$index . '</td>
                    <td>' . ($row['product_name'] ?? '') . '</td>
                    <td>' . ($row['quantity'] ?? '') . '</td>
                    <td>' . ($row['available_quantities'] ?? '') . '</td>
                  </tr>';
          }
          
          $output .= '
                </tbody>
              </table>
            </div>';
        



      if ($_SESSION['user_role'] == 'admin') {
        $sql_total = "SELECT o.id, o.order_date, o.status, u.name as user_name, u.shop_name, u.userImage as user_Image,
        p.name as product_name, c.name as category_name, od.quantity, od.avialable
        FROM orders as o
        join users as u on o.user_id = u.id
        join order_details as od on o.id = od.order_id
        join products as p on od.product_id = p.id
        join categories as c on p.category_id = c.id
        WHERE p.category_id = '$categoryId'";
  
      }else{
          $sql_total = "SELECT o.id, o.order_date, o.status, u.userImage as user_Image, u.name as user_name, u.shop_name,
          p.name as product_name,c.name as category_name, od.quantity, od.avialable
          FROM orders as o
          JOIN users as u ON o.user_id = u.id
          JOIN order_details as od ON o.id = od.order_id
          JOIN products as p ON od.product_id = p.id
          join categories as c on p.category_id = c.id
          WHERE u.id = '$user_Id'
          AND p.category_id = '$categoryId'";
      }


    $records = mysqli_query($db,$sql_total) or die("Query Unsuccessful.");
    $total_record = mysqli_num_rows($records);
    $total_pages = ceil($total_record/$limit_per_page);

    $output .='<div id="pagination">';

    for($i=1; $i <= $total_pages; $i++){
      if($i == $page){
        $class_name = "active";
      }else{
        $class_name = "";
      }
      $output .= "<a class='{$class_name}' id='{$i}' href=''>{$i}</a>";
    }
    $output .='</div>';

    return $output;

  }else{
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
?>
