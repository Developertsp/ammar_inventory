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
                        <div
                          class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
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
                        <div
                          class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
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
                    <div
                      class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
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
                      <div
                        class="bg-separator w-100 h-100 rounded-xl d-flex justify-content-center align-items-center mb-2">
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
          <a href="order-manage.php" class="btn btn-icon btn-icon-end btn-xs btn-background-alternate p-0 text-small"
            type="button">
            <span class="align-bottom">View All</span>
            <i data-acorn-icon="chevron-right" class="align-middle" data-acorn-size="12"></i>
          </a>
        </div>
        <div class="scroll-out mb-5">
          <div class="scroll-by-count mb-n2" data-count="5">

            <?php
            $index = 1;
            if ($orders) {
              foreach ($orders as $key => $val):
                ?>
                <div class="card mb-2">
                  <div class="row g-0 sh-14 sh-md-10">
                    <div class="col-auto h-100">
                      <a>
                        <img src="<?= ($val['user_Image']) ? $val['user_Image'] : 'uploads/defualt_profile.png' ?>"
                          alt="alternate text" class="card-img card-img-horizontal sw-13 sw-md-12" />
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
                          <div
                            class="col-12 col-md-3 d-flex align-items-center justify-content-md-end text-muted text-medium">
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
              <div class="card mb-2 " data-title="Product Card" data-intro="Here is a product card with buttons!"
                data-step="2">
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
              if($AllCategories){
                foreach ($AllCategories as $key => $val): ?>
                  <a href="products.php" class="body-link d-flex  font-weight-bold mb-2"><?=  $index.'. '. $val['name'] ?></a>
                <?php $index++;
               endforeach;
               }else{ ?> 
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

    <!-- Banners Start -->
    <!-- <h2 class="small-title">Extend Your Knowledge</h2> -->
    <!-- <div class="row g-2 mb-5">
            <div class="col-12 col-sm-6 col-xl-3">
              <div class="card w-100 sh-23 hover-img-scale-up">
                <img src="img/banner/cta-vertical-1.webp" class="card-img h-100 scale" alt="card image" />
                <div class="card-img-overlay d-flex flex-column justify-content-between bg-transparent">
                  <div class="d-flex flex-column h-100 justify-content-between align-items-start">
                    <div class="cta-2 text-black w-75">Introduction to Bread Making</div>
                    <a href="Pages.Blog.List.html" class="btn btn-icon btn-icon-start btn-primary mt-3 stretched-link">
                      <i data-acorn-icon="chevron-right" class="text-white"></i>
                      <span>View</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
              <div class="card w-100 sh-23 hover-img-scale-up">
                <img src="img/banner/cta-vertical-2.webp" class="card-img h-100 scale" alt="card image" />
                <div class="card-img-overlay d-flex flex-column justify-content-between bg-transparent">
                  <div class="d-flex flex-column h-100 justify-content-between align-items-start">
                    <div class="cta-2 text-black w-75">Basic Principles of Cooking</div>
                    <a href="Pages.Blog.List.html" class="btn btn-icon btn-icon-start btn-primary mt-3 stretched-link">
                      <i data-acorn-icon="chevron-right" class="text-white"></i>
                      <span>View</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
              <div class="card w-100 sh-23 hover-img-scale-up">
                <img src="img/banner/cta-vertical-3.webp" class="card-img h-100 scale" alt="card image" />
                <div class="card-img-overlay d-flex flex-column justify-content-between bg-transparent">
                  <div class="d-flex flex-column h-100 justify-content-between align-items-start">
                    <div class="cta-2 text-black w-75">Easy & Practical Recipes</div>
                    <a href="Pages.Blog.List.html" class="btn btn-icon btn-icon-start btn-primary mt-3 stretched-link">
                      <i data-acorn-icon="chevron-right" class="text-white"></i>
                      <span>View</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
              <div class="card w-100 sh-23 hover-img-scale-up">
                <img src="img/banner/cta-vertical-4.webp" class="card-img h-100 scale" alt="card image" />
                <div class="card-img-overlay d-flex flex-column justify-content-between bg-transparent">
                  <div class="d-flex flex-column h-100 justify-content-between align-items-start">
                    <div class="cta-2 text-black w-75">Introduction to Bread Making</div>
                    <a href="Pages.Blog.List.html" class="btn btn-icon btn-icon-start btn-primary mt-3 stretched-link">
                      <i data-acorn-icon="chevron-right" class="text-white"></i>
                      <span>View</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
    <!-- Banners End -->

    <!-- Latest Registrations Start -->
    <!-- <div class="row"> -->
    <!-- <div class="col-12 col-xl-6 mb-5">
              <h2 class="small-title">Latest Registrations</h2>
              <div class="card h-100-card">
                <div class="card-body">
                  <div class="scroll-out">
                    <div class="scroll-by-count mb-n2" data-childSelector=".scroll-item" data-count="5">
                      <div class="mb-2 scroll-item">
                        <div class="row g-0 sh-10 sh-sm-7">
                          <div class="col-auto">
                            <img src="img/profile/profile-6.webp" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-column flex-sm-row pt-0 pb-0 ps-3 pe-0 h-100 align-items-sm-center justify-content-sm-between">
                              <div class="d-flex flex-column mb-2 mb-sm-0">
                                <div>Joisse Kaycee</div>
                                <div class="text-small text-muted">UX Designer</div>
                              </div>
                              <div class="d-flex">
                                <button class="btn btn-outline-secondary btn-sm" type="button">Edit</button>
                                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary ms-1" type="button">
                                  <i data-acorn-icon="more-vertical"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mb-2 scroll-item">
                        <div class="row g-0 sh-10 sh-sm-7">
                          <div class="col-auto">
                            <img src="img/profile/profile-7.webp" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-column flex-sm-row pt-0 pb-0 ps-3 pe-0 h-100 align-items-sm-center justify-content-sm-between">
                              <div class="d-flex flex-column mb-2 mb-sm-0">
                                <div>Zayn Hartley</div>
                                <div class="text-small text-muted">Frontend Developer</div>
                              </div>
                              <div class="d-flex">
                                <button class="btn btn-outline-secondary btn-sm" type="button">Edit</button>
                                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary ms-1" type="button">
                                  <i data-acorn-icon="more-vertical"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mb-2 scroll-item">
                        <div class="row g-0 sh-10 sh-sm-7">
                          <div class="col-auto">
                            <img src="img/profile/profile-8.webp" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-column flex-sm-row pt-0 pb-0 ps-3 pe-0 h-100 align-items-sm-center justify-content-sm-between">
                              <div class="d-flex flex-column mb-2 mb-sm-0">
                                <div>Esperanza Lodge</div>
                                <div class="text-small text-muted">Project Manager</div>
                              </div>
                              <div class="d-flex">
                                <button class="btn btn-outline-secondary btn-sm" type="button">Edit</button>
                                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary ms-1" type="button">
                                  <i data-acorn-icon="more-vertical"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mb-2 scroll-item">
                        <div class="row g-0 sh-10 sh-sm-7">
                          <div class="col-auto">
                            <img src="img/profile/profile-2.webp" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-column flex-sm-row pt-0 pb-0 ps-3 pe-0 h-100 align-items-sm-center justify-content-sm-between">
                              <div class="d-flex flex-column mb-2 mb-sm-0">
                                <div>Kathryn Mengel</div>
                                <div class="text-small text-muted">Executive Team Leader</div>
                              </div>
                              <div class="d-flex">
                                <button class="btn btn-outline-secondary btn-sm" type="button">Edit</button>
                                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary ms-1" type="button">
                                  <i data-acorn-icon="more-vertical"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mb-2 scroll-item">
                        <div class="row g-0 sh-10 sh-sm-7">
                          <div class="col-auto">
                            <img src="img/profile/profile-5.webp" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-column flex-sm-row pt-0 pb-0 ps-3 pe-0 h-100 align-items-sm-center justify-content-sm-between">
                              <div class="d-flex flex-column mb-2 mb-sm-0">
                                <div>Blaine Cottrell</div>
                                <div class="text-small text-muted">Accounting</div>
                              </div>
                              <div class="d-flex">
                                <button class="btn btn-outline-secondary btn-sm" type="button">Edit</button>
                                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary ms-1" type="button">
                                  <i data-acorn-icon="more-vertical"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mb-2 scroll-item">
                        <div class="row g-0 sh-10 sh-sm-7">
                          <div class="col-auto">
                            <img src="img/profile/profile-8.webp" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-column flex-sm-row pt-0 pb-0 ps-3 pe-0 h-100 align-items-sm-center justify-content-sm-between">
                              <div class="d-flex flex-column mb-2 mb-sm-0">
                                <div>Cherish Kerr</div>
                                <div class="text-small text-muted">Development Lead</div>
                              </div>
                              <div class="d-flex">
                                <button class="btn btn-outline-secondary btn-sm" type="button">Edit</button>
                                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary ms-1" type="button">
                                  <i data-acorn-icon="more-vertical"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mb-2 scroll-item">
                        <div class="row g-0 sh-10 sh-sm-7">
                          <div class="col-auto">
                            <img src="img/profile/profile-3.webp" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                          </div>
                          <div class="col">
                            <div class="card-body d-flex flex-column flex-sm-row pt-0 pb-0 ps-3 pe-0 h-100 align-items-sm-center justify-content-sm-between">
                              <div class="d-flex flex-column mb-2 mb-sm-0">
                                <div>Olli Hawkins</div>
                                <div class="text-small text-muted">Client Relations Lead</div>
                              </div>
                              <div class="d-flex">
                                <button class="btn btn-outline-secondary btn-sm" type="button">Edit</button>
                                <button class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary ms-1" type="button">
                                  <i data-acorn-icon="more-vertical"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
    <!-- Latest Registrations End -->

    <!-- Tasks Start -->
    <!-- <div class="col-12 col-xl-6 mb-5">
              <h2 class="small-title">Tasks</h2>
              <div class="card h-100-card">
                <div class="card-body scroll-out">
                  <div class="scroll-by-count" data-childSelector=".scroll-item" data-count="7">
                    <div class="mb-2 scroll-item">
                      <label class="form-check w-100 checked-line-through checked-opacity-75">
                        <input type="checkbox" class="form-check-input" checked />
                        <span class="form-check-label d-block">
                          <span>Create Wireframes</span>
                          <span class="text-muted d-block text-small mt-0">Today 09:00</span>
                        </span>
                      </label>
                    </div>
                    <div class="mb-2 scroll-item">
                      <label class="form-check w-100 checked-line-through checked-opacity-75">
                        <input type="checkbox" class="form-check-input" />
                        <span class="form-check-label d-block">
                          <span>Meeting with the team</span>
                          <span class="text-muted d-block text-small mt-0">Today 13:00</span>
                        </span>
                      </label>
                    </div>
                    <div class="mb-2 scroll-item">
                      <label class="form-check w-100 checked-line-through checked-opacity-75">
                        <input type="checkbox" class="form-check-input" checked />
                        <span class="form-check-label d-block">
                          <span>Business lunch with clients</span>
                          <span class="text-muted d-block text-small mt-0">Today 14:00</span>
                        </span>
                      </label>
                    </div>
                    <div class="mb-2 scroll-item">
                      <label class="form-check w-100 checked-line-through checked-opacity-75">
                        <input type="checkbox" class="form-check-input" checked />
                        <span class="form-check-label d-block">
                          <span>Training with the team</span>
                          <span class="text-muted d-block text-small mt-0">Today 15:00</span>
                        </span>
                      </label>
                    </div>
                    <div class="mb-2 scroll-item">
                      <label class="form-check w-100 checked-line-through checked-opacity-75">
                        <input type="checkbox" class="form-check-input" />
                        <span class="form-check-label d-block">
                          <span>Account meeting</span>
                          <span class="text-muted d-block text-small mt-0">Today 17:00</span>
                        </span>
                      </label>
                    </div>
                    <div class="mb-2 scroll-item">
                      <label class="form-check w-100 checked-line-through checked-opacity-75">
                        <input type="checkbox" class="form-check-input" />
                        <span class="form-check-label d-block">
                          <span>Gym</span>
                          <span class="text-muted d-block text-small mt-0">Today 17:30</span>
                        </span>
                      </label>
                    </div>
                    <div class="mb-2 scroll-item">
                      <label class="form-check w-100 checked-line-through checked-opacity-75">
                        <input type="checkbox" class="form-check-input" />
                        <span class="form-check-label d-block">
                          <span>Dinner with the family</span>
                          <span class="text-muted d-block text-small mt-0">Today 19:30</span>
                        </span>
                      </label>
                    </div>
                    <div class="mb-2 scroll-item">
                      <label class="form-check w-100 checked-line-through checked-opacity-75">
                        <input type="checkbox" class="form-check-input" />
                        <span class="form-check-label d-block">
                          <span>Gym</span>
                          <span class="text-muted d-block text-small mt-0">Today 17:30</span>
                        </span>
                      </label>
                    </div>
                    <div class="mb-2 scroll-item">
                      <label class="form-check w-100 checked-line-through checked-opacity-75">
                        <input type="checkbox" class="form-check-input" />
                        <span class="form-check-label d-block">
                          <span>Dinner with the family</span>
                          <span class="text-muted d-block text-small mt-0">Today 19:30</span>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
    <!-- </div> -->
    <!-- Tasks End -->

    <!-- Recent Ratings Start -->
    <!-- <div class="row gy-5"> -->
    <!-- <div class="col-lg-8">
              <h2 class="small-title">Recent Ratings</h2>
              <div class="scroll-out mb-n2">
                <div class="scroll-by-count" data-count="4">
                  <div class="card mb-2">
                    <div class="row g-0 sh-17 sh-lg-10">
                      <div class="col-auto">
                        <img src="img/product/small/product-3.webp" alt="alternate text" class="card-img card-img-horizontal h-100 sw-lg-11 sw-14" />
                      </div>
                      <div class="col">
                        <div class="card-body px-4 py-0 h-100">
                          <div class="row g-0 h-100 align-content-center">
                            <a href="#" class="col-12 col-lg-5 d-flex flex-column mb-lg-0 mb-2 mb-lg-0 pe-3 d-flex">
                              <div>Spelt Bread</div>
                              <div class="text-small text-muted text-truncate">Liquorice fruitcake tiramisu caramels.</div>
                            </a>
                            <div class="col-12 col-lg-4 d-flex pe-1 mb-2 mb-lg-0 align-items-lg-center">
                              <div class="lh-1 text-alternate">
                                <div class="br-wrapper br-theme-cs-icon">
                                  <select class="recentRating" name="rating" autocomplete="off" data-readonly="true" data-initial-rating="5">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-12 col-lg-3 d-flex flex-column pe-1 align-items-lg-end">
                              <div class="text-alternate">1.552</div>
                              <div class="text-muted text-small">Sales</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card mb-2">
                    <div class="row g-0 sh-17 sh-lg-10">
                      <div class="col-auto">
                        <img src="img/product/small/product-8.webp" alt="alternate text" class="card-img card-img-horizontal h-100 sw-lg-11 sw-14" />
                      </div>
                      <div class="col">
                        <div class="card-body px-4 py-0 h-100">
                          <div class="row g-0 h-100 align-content-center">
                            <a href="#" class="col-12 col-lg-5 d-flex flex-column mb-lg-0 mb-2 mb-lg-0 pe-3 d-flex">
                              <div>Cheesymite Scroll</div>
                              <div class="text-small text-muted text-truncate">Chocolate tiramisu sweet dragée.</div>
                            </a>
                            <div class="col-12 col-lg-4 d-flex pe-1 mb-2 mb-lg-0 align-items-lg-center">
                              <div class="lh-1 text-alternate">
                                <div class="br-wrapper br-theme-cs-icon">
                                  <select class="recentRating" name="rating" autocomplete="off" data-readonly="true" data-initial-rating="5">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-12 col-lg-3 d-flex flex-column pe-1 align-items-lg-end">
                              <div class="text-alternate">1.192</div>
                              <div class="text-muted text-small">Sales</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card mb-2">
                    <div class="row g-0 sh-17 sh-lg-10">
                      <div class="col-auto">
                        <img src="img/product/small/product-6.webp" alt="alternate text" class="card-img card-img-horizontal h-100 sw-lg-11 sw-14" />
                      </div>
                      <div class="col">
                        <div class="card-body px-4 py-0 h-100">
                          <div class="row g-0 h-100 align-content-center">
                            <a href="#" class="col-12 col-lg-5 d-flex flex-column mb-lg-0 mb-2 mb-lg-0 pe-3 d-flex">
                              <div>Cholermüs</div>
                              <div class="text-small text-muted text-truncate">Candy brownie sesame snaps pastry.</div>
                            </a>
                            <div class="col-12 col-lg-4 d-flex pe-1 mb-2 mb-lg-0 align-items-lg-center">
                              <div class="lh-1 text-alternate">
                                <div class="br-wrapper br-theme-cs-icon">
                                  <select class="recentRating" name="rating" autocomplete="off" data-readonly="true" data-initial-rating="4">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-12 col-lg-3 d-flex flex-column pe-1 align-items-lg-end">
                              <div class="text-alternate">2.853</div>
                              <div class="text-muted text-small">Sales</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card mb-2">
                    <div class="row g-0 sh-17 sh-lg-10">
                      <div class="col-auto">
                        <img src="img/product/small/product-10.webp" alt="alternate text" class="card-img card-img-horizontal h-100 sw-lg-11 sw-14" />
                      </div>
                      <div class="col">
                        <div class="card-body px-4 py-0 h-100">
                          <div class="row g-0 h-100 align-content-center">
                            <a href="#" class="col-12 col-lg-5 d-flex flex-column mb-lg-0 mb-2 mb-lg-0 pe-3 d-flex">
                              <div>Ruisreikäleipä</div>
                              <div class="text-small text-muted text-truncate">Candy cookie jujubes gummi bears.</div>
                            </a>
                            <div class="col-12 col-lg-4 d-flex pe-1 mb-2 mb-lg-0 align-items-lg-center">
                              <div class="lh-1 text-alternate">
                                <div class="br-wrapper br-theme-cs-icon">
                                  <select class="recentRating" name="rating" autocomplete="off" data-readonly="true" data-initial-rating="5">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-12 col-lg-3 d-flex flex-column pe-1 align-items-lg-end">
                              <div class="text-alternate">1.290</div>
                              <div class="text-muted text-small">Sales</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card mb-2">
                    <div class="row g-0 sh-17 sh-lg-10">
                      <div class="col-auto">
                        <img src="img/product/small/product-5.webp" alt="alternate text" class="card-img card-img-horizontal h-100 sw-lg-11 sw-14" />
                      </div>
                      <div class="col">
                        <div class="card-body px-4 py-0 h-100">
                          <div class="row g-0 h-100 align-content-center">
                            <a href="#" class="col-12 col-lg-5 d-flex flex-column mb-lg-0 mb-2 mb-lg-0 pe-3 d-flex">
                              <div>Zopf</div>
                              <div class="text-small text-muted text-truncate">Danish cookie marzipan chocolate bar.</div>
                            </a>
                            <div class="col-12 col-lg-4 d-flex pe-1 mb-2 mb-lg-0 align-items-lg-center">
                              <div class="lh-1 text-alternate">
                                <div class="br-wrapper br-theme-cs-icon">
                                  <select class="recentRating" name="rating" autocomplete="off" data-readonly="true" data-initial-rating="5">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-12 col-lg-3 d-flex flex-column pe-1 align-items-lg-end">
                              <div class="text-alternate">1.744</div>
                              <div class="text-muted text-small">Sales</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
    <!-- Recent Ratings End -->

    <!-- Spendings Start -->
    <!-- <div class="col-lg-4">
              <h2 class="small-title">Spendings</h2>
              <div class="card h-100-card">
                <div class="card-body">
                  <div class="row g-0 align-items-center mb-4 sh-5">
                    <div class="col-auto">
                      <div class="d-flex flex-column justify-content-center align-items-center sh-5 sw-5 rounded-xl bg-gradient-light">
                        <i data-acorn-icon="loaf" class="text-white"></i>
                      </div>
                    </div>
                    <div class="col ps-3">
                      <div class="row g-0">
                        <div class="col">
                          <div class="sh-5 d-flex align-items-center">Ingredients</div>
                        </div>
                        <div class="col-auto">
                          <div class="cta-3 text-primary sh-5 d-flex align-items-center">30%</div>
                        </div>
                      </div>
                      <div class="row g-0">
                        <div class="col">
                          <div class="progress progress-xs">
                            <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row g-0 align-items-center mb-4 sh-5">
                    <div class="col-auto">
                      <div class="d-flex flex-column justify-content-center align-items-center sh-5 sw-5 rounded-xl bg-gradient-light">
                        <i data-acorn-icon="building" class="text-white"></i>
                      </div>
                    </div>
                    <div class="col ps-3">
                      <div class="row g-0">
                        <div class="col">
                          <div class="sh-5 d-flex align-items-center">Rent</div>
                        </div>
                        <div class="col-auto">
                          <div class="cta-3 text-primary sh-5 d-flex align-items-center">15%</div>
                        </div>
                      </div>
                      <div class="row g-0">
                        <div class="col sh-1">
                          <div class="progress progress-xs">
                            <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row g-0 align-items-center mb-4 sh-5">
                    <div class="col-auto">
                      <div class="d-flex flex-column justify-content-center align-items-center sh-5 sw-5 rounded-xl bg-gradient-light">
                        <i data-acorn-icon="electricity" class="text-white"></i>
                      </div>
                    </div>
                    <div class="col ps-3">
                      <div class="row g-0">
                        <div class="col">
                          <div class="sh-5 d-flex align-items-center">Utilities</div>
                        </div>
                        <div class="col-auto">
                          <div class="cta-3 text-primary sh-5 d-flex align-items-center">10%</div>
                        </div>
                      </div>
                      <div class="row g-0">
                        <div class="col sh-1">
                          <div class="progress progress-xs">
                            <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row g-0">
                    <div class="col pe-4 d-flex flex-column justify-content-between align-items-end">
                      <div class="text-small text-muted sh-3 d-flex align-items-center">BUDGET</div>
                      <div class="text-small text-muted sh-3 d-flex align-items-center">SPEND</div>
                      <div class="text-small text-muted sh-5 d-flex align-items-end">BALANCE</div>
                    </div>
                    <div class="col-auto d-flex flex-column justify-content-between align-items-end">
                      <div class="text-muted sh-3 d-flex align-items-center">$12.000</div>
                      <div class="text-muted sh-3 d-flex align-items-center">- $8.750</div>
                      <div class="cta-4 text-primary sh-5 d-flex align-items-end">$3.250</div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
    <!-- Spendings End -->
    <!-- </div> -->
  </div>
</main>

<!-- Layout Footer Start -->
<!-- <footer>
        <div class="footer-content">
          <div class="container">
            <div class="row">
              <div class="col-12 col-sm-6">
                <p class="mb-0 text-muted text-medium">Colored Strategies 2021</p>
              </div>
              <div class="col-sm-6 d-none d-sm-block">
                <ul class="breadcrumb pt-0 pe-0 mb-0 float-end">
                  <li class="breadcrumb-item mb-0 text-medium">
                    <a href="https://1.envato.market/BX5oGy" target="_blank" class="btn-link">Review</a>
                  </li>
                  <li class="breadcrumb-item mb-0 text-medium">
                    <a href="https://1.envato.market/BX5oGy" target="_blank" class="btn-link">Purchase</a>
                  </li>
                  <li class="breadcrumb-item mb-0 text-medium">
                    <a href="https://acorn-html-docs.coloredstrategies.com/" target="_blank" class="btn-link">Docs</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </footer> -->
<!-- Layout Footer End -->
</div>

<!-- Theme Settings Modal Start -->
<!-- <div
      class="modal fade modal-right scroll-out-negative"
      id="settings"
      data-bs-backdrop="true"
      tabindex="-1"
      role="dialog"
      aria-labelledby="settings"
      aria-hidden="true"
    > -->
<!-- <div class="modal-dialog modal-dialog-scrollable full" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Theme Settings</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="scroll-track-visible">
              <div class="mb-5" id="color">
                <label class="mb-3 d-inline-block form-label">Color</label>
                <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="light-blue" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="blue-light"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">LIGHT BLUE</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-blue" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="blue-dark"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">DARK BLUE</span>
                    </div>
                  </a>
                </div>
                <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="light-teal" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="teal-light"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">LIGHT TEAL</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-teal" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="teal-dark"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">DARK TEAL</span>
                    </div>
                  </a>
                </div>
                <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="light-sky" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="sky-light"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">LIGHT SKY</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-sky" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="sky-dark"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">DARK SKY</span>
                    </div>
                  </a>
                </div>
                <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="light-red" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="red-light"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">LIGHT RED</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-red" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="red-dark"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">DARK RED</span>
                    </div>
                  </a>
                </div>
                <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="light-green" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="green-light"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">LIGHT GREEN</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-green" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="green-dark"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">DARK GREEN</span>
                    </div>
                  </a>
                </div>
                <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="light-lime" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="lime-light"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">LIGHT LIME</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-lime" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="lime-dark"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">DARK LIME</span>
                    </div>
                  </a>
                </div>
                <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="light-pink" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="pink-light"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">LIGHT PINK</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-pink" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="pink-dark"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">DARK PINK</span>
                    </div>
                  </a>
                </div>
                <div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="light-purple" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="purple-light"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">LIGHT PURPLE</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="dark-purple" data-parent="color">
                    <div class="card rounded-md p-3 mb-1 no-shadow color">
                      <div class="purple-dark"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">DARK PURPLE</span>
                    </div>
                  </a>
                </div>
              </div>
              <div class="mb-5" id="navcolor">
                <label class="mb-3 d-inline-block form-label">Override Nav Palette</label>
                <div class="row d-flex g-3 justify-content-between flex-wrap">
                  <a href="#" class="flex-grow-1 w-33 option col" data-value="default" data-parent="navcolor">
                    <div class="card rounded-md p-3 mb-1 no-shadow">
                      <div class="figure figure-primary top"></div>
                      <div class="figure figure-secondary bottom"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">DEFAULT</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-33 option col" data-value="light" data-parent="navcolor">
                    <div class="card rounded-md p-3 mb-1 no-shadow">
                      <div class="figure figure-secondary figure-light top"></div>
                      <div class="figure figure-secondary bottom"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">LIGHT</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-33 option col" data-value="dark" data-parent="navcolor">
                    <div class="card rounded-md p-3 mb-1 no-shadow">
                      <div class="figure figure-muted figure-dark top"></div>
                      <div class="figure figure-secondary bottom"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">DARK</span>
                    </div>
                  </a>
                </div>
              </div>

              <div class="mb-5" id="placement">
                <label class="mb-3 d-inline-block form-label">Menu Placement</label>
                <div class="row d-flex g-3 justify-content-between flex-wrap">
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="horizontal" data-parent="placement">
                    <div class="card rounded-md p-3 mb-1 no-shadow">
                      <div class="figure figure-primary top"></div>
                      <div class="figure figure-secondary bottom"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">HORIZONTAL</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="vertical" data-parent="placement">
                    <div class="card rounded-md p-3 mb-1 no-shadow">
                      <div class="figure figure-primary left"></div>
                      <div class="figure figure-secondary right"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">VERTICAL</span>
                    </div>
                  </a>
                </div>
              </div>

              <div class="mb-5" id="behaviour">
                <label class="mb-3 d-inline-block form-label">Menu Behaviour</label>
                <div class="row d-flex g-3 justify-content-between flex-wrap">
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="pinned" data-parent="behaviour">
                    <div class="card rounded-md p-3 mb-1 no-shadow">
                      <div class="figure figure-primary left large"></div>
                      <div class="figure figure-secondary right small"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">PINNED</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="unpinned" data-parent="behaviour">
                    <div class="card rounded-md p-3 mb-1 no-shadow">
                      <div class="figure figure-primary left"></div>
                      <div class="figure figure-secondary right"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">UNPINNED</span>
                    </div>
                  </a>
                </div>
              </div>

              <div class="mb-5" id="layout">
                <label class="mb-3 d-inline-block form-label">Layout</label>
                <div class="row d-flex g-3 justify-content-between flex-wrap">
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="fluid" data-parent="layout">
                    <div class="card rounded-md p-3 mb-1 no-shadow">
                      <div class="figure figure-primary top"></div>
                      <div class="figure figure-secondary bottom"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">FLUID</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-50 option col" data-value="boxed" data-parent="layout">
                    <div class="card rounded-md p-3 mb-1 no-shadow">
                      <div class="figure figure-primary top"></div>
                      <div class="figure figure-secondary bottom small"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">BOXED</span>
                    </div>
                  </a>
                </div>
              </div>

              <div class="mb-5" id="radius">
                <label class="mb-3 d-inline-block form-label">Radius</label>
                <div class="row d-flex g-3 justify-content-between flex-wrap">
                  <a href="#" class="flex-grow-1 w-33 option col" data-value="rounded" data-parent="radius">
                    <div class="card rounded-md radius-rounded p-3 mb-1 no-shadow">
                      <div class="figure figure-primary top"></div>
                      <div class="figure figure-secondary bottom"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">ROUNDED</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-33 option col" data-value="standard" data-parent="radius">
                    <div class="card rounded-md radius-regular p-3 mb-1 no-shadow">
                      <div class="figure figure-primary top"></div>
                      <div class="figure figure-secondary bottom"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">STANDARD</span>
                    </div>
                  </a>
                  <a href="#" class="flex-grow-1 w-33 option col" data-value="flat" data-parent="radius">
                    <div class="card rounded-md radius-flat p-3 mb-1 no-shadow">
                      <div class="figure figure-primary top"></div>
                      <div class="figure figure-secondary bottom"></div>
                    </div>
                    <div class="text-muted text-part">
                      <span class="text-extra-small align-middle">FLAT</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
</div>
<!-- Theme Settings Modal End -->

<!-- Niches Modal Start -->
<!-- <div
      class="modal fade modal-right scroll-out-negative"
      id="niches"
      data-bs-backdrop="true"
      tabindex="-1"
      role="dialog"
      aria-labelledby="niches"
      aria-hidden="true"
    > -->
<!-- <div class="modal-dialog modal-dialog-scrollable full" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Niches</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="scroll-track-visible">
              <div class="mb-5">
                <label class="mb-2 d-inline-block form-label">Classic Dashboard</label>
                <div class="hover-reveal-buttons position-relative hover-reveal cursor-default">
                  <div class="position-relative mb-3 mb-lg-5 rounded-sm">
                    <img
                      src="https://acorn.coloredstrategies.com/img/page/classic-dashboard.webp"
                      class="img-fluid rounded-sm lower-opacity border border-separator-light"
                      alt="card image"
                    />
                    <div class="position-absolute reveal-content rounded-sm absolute-center-vertical text-center w-100">
                      <a
                        target="_blank"
                        href="https://acorn-html-classic-dashboard.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        Html
                      </a>
                      <a
                        target="_blank"
                        href="https://acorn-laravel-classic-dashboard.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        Laravel
                      </a>
                      <a
                        target="_blank"
                        href="https://acorn-dotnet-classic-dashboard.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        .Net5
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mb-5">
                <label class="mb-2 d-inline-block form-label">Medical Assistant</label>
                <div class="hover-reveal-buttons position-relative hover-reveal cursor-default">
                  <div class="position-relative mb-3 mb-lg-5 rounded-sm">
                    <img
                      src="https://acorn.coloredstrategies.com/img/page/medical-assistant.webp"
                      class="img-fluid rounded-sm lower-opacity border border-separator-light"
                      alt="card image"
                    />
                    <div class="position-absolute reveal-content rounded-sm absolute-center-vertical text-center w-100">
                      <a
                        target="_blank"
                        href="https://acorn-html-medical-assistant.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        Html
                      </a>
                      <a
                        target="_blank"
                        href="https://acorn-laravel-medical-assistant.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        Laravel
                      </a>
                      <a
                        target="_blank"
                        href="https://acorn-dotnet-medical-assistant.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        .Net5
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mb-5">
                <label class="mb-2 d-inline-block form-label">Service Provider</label>
                <div class="hover-reveal-buttons position-relative hover-reveal cursor-default">
                  <div class="position-relative mb-3 mb-lg-5 rounded-sm">
                    <img
                      src="https://acorn.coloredstrategies.com/img/page/service-provider.webp"
                      class="img-fluid rounded-sm lower-opacity border border-separator-light"
                      alt="card image"
                    />
                    <div class="position-absolute reveal-content rounded-sm absolute-center-vertical text-center w-100">
                      <a
                        target="_blank"
                        href="https://acorn-html-service-provider.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        Html
                      </a>
                      <a
                        target="_blank"
                        href="https://acorn-laravel-service-provider.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        Laravel
                      </a>
                      <a
                        target="_blank"
                        href="https://acorn-dotnet-service-provider.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        .Net5
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mb-5">
                <label class="mb-2 d-inline-block form-label">Elearning Portal</label>
                <div class="hover-reveal-buttons position-relative hover-reveal cursor-default">
                  <div class="position-relative mb-3 mb-lg-5 rounded-sm">
                    <img
                      src="https://acorn.coloredstrategies.com/img/page/elearning-portal.webp"
                      class="img-fluid rounded-sm lower-opacity border border-separator-light"
                      alt="card image"
                    />
                    <div class="position-absolute reveal-content rounded-sm absolute-center-vertical text-center w-100">
                      <a
                        target="_blank"
                        href="https://acorn-html-elearning-portal.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        Html
                      </a>
                      <a
                        target="_blank"
                        href="https://acorn-laravel-elearning-portal.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        Laravel
                      </a>
                      <a
                        target="_blank"
                        href="https://acorn-dotnet-elearning-portal.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        .Net5
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mb-5">
                <label class="mb-2 d-inline-block form-label">Ecommerce Platform</label>
                <div class="hover-reveal-buttons position-relative hover-reveal cursor-default">
                  <div class="position-relative mb-3 mb-lg-5 rounded-sm">
                    <img
                      src="https://acorn.coloredstrategies.com/img/page/ecommerce-platform.webp"
                      class="img-fluid rounded-sm lower-opacity border border-separator-light"
                      alt="card image"
                    />
                    <div class="position-absolute reveal-content rounded-sm absolute-center-vertical text-center w-100">
                      <a
                        target="_blank"
                        href="https://acorn-html-ecommerce-platform.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        Html
                      </a>
                      <a
                        target="_blank"
                        href="https://acorn-laravel-ecommerce-platform.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        Laravel
                      </a>
                      <a
                        target="_blank"
                        href="https://acorn-dotnet-ecommerce-platform.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        .Net5
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mb-5">
                <label class="mb-2 d-inline-block form-label">Starter Project</label>
                <div class="hover-reveal-buttons position-relative hover-reveal cursor-default">
                  <div class="position-relative mb-3 mb-lg-5 rounded-sm">
                    <img
                      src="https://acorn.coloredstrategies.com/img/page/starter-project.webp"
                      class="img-fluid rounded-sm lower-opacity border border-separator-light"
                      alt="card image"
                    />
                    <div class="position-absolute reveal-content rounded-sm absolute-center-vertical text-center w-100">
                      <a
                        target="_blank"
                        href="https://acorn-html-starter-project.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        Html
                      </a>
                      <a
                        target="_blank"
                        href="https://acorn-laravel-starter-project.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        Laravel
                      </a>
                      <a
                        target="_blank"
                        href="https://acorn-dotnet-starter-project.coloredstrategies.com/"
                        class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1"
                      >
                        .Net5
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
<!-- Niches Modal End -->

<!-- Theme Settings & Niches Buttons Start -->
<!-- <div class="settings-buttons-container">
      <button type="button" class="btn settings-button btn-primary p-0" data-bs-toggle="modal" data-bs-target="#settings" id="settingsButton">
        <span class="d-inline-block no-delay" data-bs-delay="0" data-bs-offset="0,3" data-bs-toggle="tooltip" data-bs-placement="left" title="Settings">
          <i data-acorn-icon="paint-roller" class="position-relative"></i>
        </span>
      </button>
      <button type="button" class="btn settings-button btn-primary p-0" data-bs-toggle="modal" data-bs-target="#niches" id="nichesButton">
        <span class="d-inline-block no-delay" data-bs-delay="0" data-bs-offset="0,3" data-bs-toggle="tooltip" data-bs-placement="left" title="Niches">
          <i data-acorn-icon="toy" class="position-relative"></i>
        </span>
      </button>
    </div> -->
<!-- Theme Settings & Niches Buttons End -->

<!-- Search Modal Start -->
<!-- <div class="modal fade modal-under-nav modal-search modal-close-out" id="searchPagesModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header border-0 p-0">
            <button type="button" class="btn-close btn btn-icon btn-icon-only btn-foreground" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body ps-5 pe-5 pb-0 border-0">
            <input id="searchPagesInput" class="form-control form-control-xl borderless ps-0 pe-0 mb-1 auto-complete" type="text" autocomplete="off" />
          </div>
          <div class="modal-footer border-top justify-content-start ps-5 pe-5 pb-3 pt-3 border-0">
            <span class="text-alternate d-inline-block m-0 me-3">
              <i data-acorn-icon="arrow-bottom" data-acorn-size="15" class="text-alternate align-middle me-1"></i>
              <span class="align-middle text-medium">Navigate</span>
            </span>
            <span class="text-alternate d-inline-block m-0 me-3">
              <i data-acorn-icon="arrow-bottom-left" data-acorn-size="15" class="text-alternate align-middle me-1"></i>
              <span class="align-middle text-medium">Select</span>
            </span>
          </div>
        </div>
      </div>
    </div> -->
<!-- Search Modal End -->

<!-- Vendor Scripts Start -->
<!-- <script src="js/vendor/jquery-3.5.1.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <script src="js/vendor/OverlayScrollbars.min.js"></script>
    <script src="js/vendor/autoComplete.min.js"></script>
    <script src="js/vendor/clamp.min.js"></script>

    <script src="icon/acorn-icons.js"></script>
    <script src="icon/acorn-icons-interface.js"></script>

    <script src="js/vendor/jquery.barrating.min.js"></script> -->

<!-- Vendor Scripts End -->

<!-- Template Base Scripts Start -->
<!-- <script src="js/base/helpers.js"></script> -->
<!-- <script src="js/base/globals.js"></script>
    <script src="js/base/nav.js"></script>
    <script src="js/base/search.js"></script>
    <script src="js/base/settings.js"></script> -->
<!-- Template Base Scripts End -->
<!-- Page Specific Scripts Start -->

<!-- <script src="js/pages/dashboard.visual.js"></script>

    <script src="js/common.js"></script>
    <script src="js/scripts.js"></script> -->
<!-- Page Specific Scripts End -->
<!-- </body>
</html> -->
<?php include('footer.php') ?>