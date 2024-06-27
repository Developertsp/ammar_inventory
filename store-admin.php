<?php
include('header.php');
$AllCategories = getAllCategoris();
$orders = getAllOrders();
?>
<main>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="page-title-container">
          <h1 class="mb-0 pb-0 display-4" id="title">Super Admin Dashboard</h1>
          <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
            <ul class="breadcrumb pt-0">
              <li class="breadcrumb-item"><a href="Dashboards.Default.html">Home</a></li>
              <li class="breadcrumb-item"><a href="Dashboards.html">Dashboards</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-lg-8">
        <!-- Inventory Start -->
        <h2 class="small-title font-weight-bold">Inventory</h2>
        <div class="mb-5">
          <div class="row g-2">
            <?php
            if (isset($_SESSION['user']) && isset($_SESSION['user_role'])) {
              if ($_SESSION['user_role'] == 'admin') {
            ?>
                <div class="col-12 col-sm-6 col-lg-3">
                  <a href="products.php">
                    <div class="card hover-scale-up cursor-pointer sh-19">
                      <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                        <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                          <i data-acorn-icon="radish" class="text-white"></i>
                        </div>
                        <div class="heading text-center mb-0 d-flex align-items-center lh-1">Total Products</div>
                        <div class="text-small text-primary">
                          <?= totalStats($db, 'products') ?? 0 ?> Products
                        </div>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                  <a href="users.php">
                    <div class="card hover-scale-up cursor-pointer sh-19">
                      <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                        <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                          <i data-acorn-icon="pepper" class="text-white"></i>
                        </div>
                        <div class="heading text-center mb-0 d-flex align-items-center lh-1">Total Users</div>
                        <div class="text-small text-primary">
                          <?= totalStats($db, 'users') ?? 0 ?> USERS
                        </div>
                      </div>
                    </div>
                  </a>
                </div>

            <?php }
            } ?>

            <div class="col-12 col-sm-6 col-lg-3">
              <a href="order-manage.php">
                <div class="card hover-scale-up cursor-pointer sh-19">
                  <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                    <div class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                      <i data-acorn-icon="loaf" class="text-white"></i>
                    </div>
                    <div class="heading text-center mb-0 d-flex align-items-center lh-1">Total Orders</div>
                    <div class="text-small text-primary">
                      <?= totalStats($db, 'orders') ?? 0 ?> ORDERS
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <?php
            if (isset($_SESSION['user']) && isset($_SESSION['user_role'])) {
              if ($_SESSION['user_role'] == 'admin') {
            ?>
                <div class="col-12 col-sm-6 col-lg-3">
                  <a href="products.php">
                    <div class="card hover-scale-up cursor-pointer sh-19">
                      <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                        <div class="sh-5 sw-5 border border-dashed rounded-xl mx-auto">
                          <div class="bg-separator w-100 h-100 rounded-xl d-flex justify-content-center align-items-center mb-2">
                            <i data-acorn-icon="plus" class="text-white"></i>
                          </div>
                        </div>
                        <div class="heading text-center text-muted mb-0 d-flex align-items-center lh-1">Add New Product
                        </div>
                        <div class="text-small text-primary">&nbsp;</div>
                      </div>
                    </div>
                  </a>
                </div>
            <?php }
            } ?>
          </div>
        </div>
        <!-- Inventory End -->

        <!-- Products Start -->
        <div class="d-flex justify-content-between">
          <h2 class="small-title font-weight-bold">Top Orders</h2>
          <a href="order-manage.php" class="btn btn-icon btn-icon-end btn-xs btn-background-alternate p-0 text-small" type="button">
            <span class="align-bottom">View All</span>
            <i data-acorn-icon="chevron-right" class="align-middle" data-acorn-size="12"></i>
          </a>
        </div>
        <div class="scroll-out mb-5">
          <div class="scroll-by-count mb-n2" data-count="5">

            <?php
            $index = 1;
            if ($orders) {
              foreach ($orders as $key => $val) :
            ?>
                <div class="card mb-2">
                  <div class="row g-0 sh-14 sh-md-10">
                    <div class="col-auto h-100">
                      <a>
                        <img src="<?= ($val['user_Image']) ? $val['user_Image'] : 'uploads/defualt_profile.png' ?>" alt="alternate text" class="card-img card-img-horizontal sw-13 sw-md-12" />
                      </a>
                    </div>
                    <div class="col">
                      <div class="card-body pt-0 pb-0 h-100">
                        <div class="row g-0 h-100 align-content-center">
                          <div class="col-12 col-md-6 d-flex align-items-center mb-2 mb-md-0">
                            <a>
                              <?= $val['shop_name'] ?? '' ?>
                            </a>
                          </div>
                          <div class="col-12 col-md-3 d-flex align-items-center text-muted text-medium">
                            <?= $val['user_name'] ?? '' ?>
                          </div>
                          <div class="col-12 col-md-3 d-flex align-items-center justify-content-md-end text-muted text-medium">
                            <?= date("d F Y  H:i:s", strtotime($val['order_date'])); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
                $index++;
                if ($index == 5) {
                  break;
                }
              endforeach;
            } else { ?>
              <div class="card mb-2 " data-title="Product Card" data-intro="Here is a product card with buttons!" data-step="2">
                <div class="row g-0 sh-12">
                  <div class="col">
                    <div class="card-body pt-0 pb-0 h-100">
                      <div class="row g-0 h-100 align-content-center">
                        <div class="col-12 col-md-12 d-flex align-items-center justify-content-center">
                          No Order Available Yet !
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
        <!-- Products End -->
      </div>
      <div class="col-12 col-lg-4">
        <!-- Today's Orders Start -->
        <h2 class="small-title font-weight-bold">Orders Stat's</h2>
        <div class="card w-100 sh-50 mb-5">
          <img src="img/banner/cta-square-4.jpg" class="card-img h-100" alt="card image" />
          <div class="card-img-overlay d-flex flex-column justify-content-between bg-transparent">
            <div class="d-flex flex-column h-100 justify-content-between align-items-start">
              <div>
                <div class="cta-1 text-primary mb-1">
                  <?= ordersManage($db, 'orders', 'Pending') ?? 0 ?>
                </div>
                <div class="lh-1-25 mb-0 font-weight-bold">Pending Orders</div>
              </div>
              <div>
                <div class="cta-1 text-primary mb-1">
                  <?= ordersManage($db, 'orders', 'Completed') ?? 0 ?>
                </div>
                <div class="lh-1-25 mb-0 font-weight-bold">Completed Orders</div>
              </div>
              <div>
                <div class="cta-1 text-primary mb-1">
                  <?= ordersManage($db, 'orders', 'Canceled') ?? 0 ?>
                </div>
                <div class="lh-1-25 mb-0 font-weight-bold">Canceled Orders</div>
              </div>
              <div>
                <div class="cta-1 text-primary mb-1">
                  <?= ordersManage($db, 'orders', 'Incomplete') ?? 0 ?>
                </div>
                <div class="lh-1-25 mb-0 font-weight-bold">Incomplete Orders</div>
              </div>
              <div>
                <!-- <div class="cta-1 text-primary mb-1"><?= ordersManage($db, 'orders', 'Shipped') ?? 0 ?> </div> -->
                <!-- <div class="lh-1-25 mb-0">Shipped Orders</div> -->
              </div>
            </div>
          </div>
        </div>
        <!-- Today's Orders End -->

        <!-- Categories Start -->
        <h2 class="small-title font-weight-bold">Categories</h2>
        <div class="card mb-5 h-auto sh-lg-23">
          <div class="card-body h-100">
            <div class="row g-0 h-100">
              <div class="col-12 col-sm-6 h-100 d-flex justify-content-center flex-column">
                <?php
                $index = 1;
                if ($AllCategories) {
                  foreach ($AllCategories as $key => $val) : ?>
                    <a href="products.php" class="body-link d-flex  font-weight-bold mb-2"><?= $index . '. ' . $val['name'] ?></a>
                  <?php $index++;
                  endforeach;
                } else { ?>
                  <div class="row g-0 h-100 align-content-center">
                    <div class="col-12 col-md-12 d-flex align-items-center justify-content-center">
                      No Categories Avaible Yet !
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <!-- Categories End -->
      </div>
    </div>

  </div>
</main>
</div>

</div>

<?php include('footer.php') ?>