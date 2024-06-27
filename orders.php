<?php
include('header.php');
$AllProducts = getAllProduct();
$AllCategories = getAllCategoris();
$categoryProducts = NULL;
$categoryId = -1;
if (isset($_POST['category_id'])) {
    $categoryId = $_POST['category_id'];
    $categoryProducts = getAllProductByCategory($categoryId);
}

?>
<main>
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                    <h1 class="mb-0 pb-0 display-4" id="title">Visual Orders</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="Dashboards.Default.html">Orders</a></li>
                            <li class="breadcrumb-item"><a href="Dashboards.html">Management</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Controls Start -->
        <div class="row mb-2">
            <!-- order listing -->
            <div class="col-sm-12 col-md-4 col-lg-4 col-xxl-4 mb-3 order-md-2">
                <div class="d-flex justify-content-end">
                    <a href="order-manage.php" class="btn btn-info  mb-3 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-plus undefined">
                            <path d="M10 17 10 3M3 10 17 10"></path>
                        </svg>
                        Order Listing
                    </a>
                </div>
            </div>
            <!-- Search Start -->
            <div class="col-sm-12 col-md-4 col-lg-4 col-xxl-4 mb-3">
                <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
                    <input id="productSearch" class="form-control" type="text" placeholder="Search by product title">
                    <span class="search-magnifier-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-search undefined">
                            <circle cx="9" cy="9" r="7"></circle>
                            <path d="M14 14L17.5 17.5"></path>
                        </svg>
                    </span>
                    <span class="search-delete-icon d-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-close undefined">
                            <path d="M5 5 15 15M15 5 5 15"></path>
                        </svg>
                    </span>
                </div>
            </div>
            <!-- Search End -->
            <!-- Dropdown Start -->
            <div class="col-sm-12 col-md-4 col-lg-4 col-xxl-4 mb-3">
                <form id="cat_id-form" action="orders.php" method="POST">
                    <select id="select-categoryid" style="border-color: black;" required="" class="form-control" name="category_id">
                        <option value=""> -- Select Category --</option>
                        <?php foreach ($AllCategories as $key => $val) : ?>
                            <option value="<?= $val['id'] ?>" <?php if ($categoryId == $val['id']) echo 'selected'; ?>>
                                <?= $val['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
            <!-- Dropdown End -->
            <!-- Controls End -->
        </div>
        <div id="order-statusplaced" class=" d-none col-8 mx-auto text-center alert alert-success rounded-pill">
            <span class="text-bold">Order Submited Successfully </span>
        </div>

        <div class="row g-0">
            <div class="col-12 mb-5">
                <!-- List Items Start -->
                <div id="checkboxTable">
                    <div class="mb-4 mb-lg-3 bg-transparent no-shadow d-none d-lg-block">
                        <div class="row g-0">
                            <div class="col-auto sw-11 d-none d-lg-flex"></div>
                            <div class="col">
                                <div class="ps-5 pe-4 h-100">
                                    <div class="row g-0 h-100 align-content-center custom-sort">
                                        <div class="col-lg-4 d-flex flex-column mb-lg-0 pe-3 d-flex">
                                            <div class="text-muted text-medium cursor-pointer sort" data-sort="name">
                                                PRODUCT Details</div>
                                        </div>
                                        <div class="col-lg-2 d-flex flex-column pe-1 justify-content-center">
                                            <div class="text-muted text-medium cursor-pointer sort" data-sort="email">
                                                NEW ORDERS </div>
                                        </div>
                                        <div class="col-lg-3 d-flex flex-column pe-1 justify-content-center">
                                            <div class="text-muted text-medium cursor-pointer sort" data-sort="phone">
                                                AVAILABLE STOCK</div>
                                        </div>
                                        <div class="col-lg-2 d-flex flex-column pe-1 px-3 justify-content-center">
                                            <div class="text-muted text-medium cursor-pointer sort" data-sort="group">
                                                STATUS</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Container Start -->



                    <?php
                    if ($categoryProducts) {
                        foreach ($categoryProducts as $key => $val) :
                    ?>
                            <div class="card mb-2 product-card">
                                <div class="row g-0 h-100 sh-lg-9 position-relative">
                                    <div class="col-auto h-100">
                                        <a>
                                            <img src="<?= ($val['productImage']) ? $val['productImage'] : 'uploads/defualt_products.png' ?>" alt="alternate text" class="card-img card-img-horizontal sw-13 sw-md-12" />
                                        </a>
                                    </div>

                                    <div class="col py-4 py-lg-0">
                                        <div class="ps-5 pe-4 h-100">
                                            <div class="row g-0 h-100 align-content-center">
                                                <p class="col-11 col-lg-4 d-flex flex-column mb-lg-0 mb-3 pe-3 d-flex order-1 h-lg-100 justify-content-center">
                                                    <span class="product-title ">
                                                        Name: <?= $val['name'] ?? '' ?> <br>
                                                        Price: <?= $val['price'] ?? '' ?>
                                                    </span>
                                                </p>
                                                <div class="col-12 col-lg-2 d-flex flex-column pe-1 mb-2 mb-lg-0 align-items-start justify-content-center order-3">
                                                    <div class="lh-1 text-alternate">
                                                        <span class="d-lg-none mb-md-1 ">Quantity:</span>
                                                        <input id="quantatiy_<?php echo $val['id'] ?? '' ?>" type="number" value="1" min="1" class="form-control mt-1  mt-lg-0 w-100 w-lg-50 ">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-2 d-flex flex-column pe-1 mb-2 mb-lg-0 align-items-start justify-content-center order-4">
                                                    <div class="lh-1 text-alternate">
                                                        <span class="d-lg-none">Available:</span>
                                                        <input id="available_<?php echo $val['id'] ?? '' ?>" type="number" value="1" min="1" class="form-control mt-1  mt-lg-0 mt-xl-0  w-100 w-lg-50 ">
                                                    </div>
                                                </div>

                                                <div class="col-12 d-none d-lg-flex col-lg-3 d-flex flex-column pe-1  mb-2 mb-lg-0 align-items-center justify-content-center order-5">
                                                    <span class="badge bg-outline-quaternary group py-2 px-3 text-bold text-medium ">Active</span>
                                                </div>
                                                <div class="col-1 d-flex flex-column mb-2 mb-lg-0 align-items-center order-2 order-lg-last justify-content-lg-center">
                                                    <label class="form-check mt-2">
                                                        <input type="checkbox" class=" product-checkboxes   form-check-input pe-none" style="padding: 12px;" data-product='<?= json_encode($val); ?>'>
                                                        <input type="hidden" value="<?php echo $val['id'] ?? '' ?>">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach; ?>
                        <div class="w-100 d-flex mt-5 justify-content-center">
                            <button id="orderButton" class="btn btn-primary btn-lg mb-3" onclick="submitOrder()">
                                <span class="text-large"> Order Now</span>
                            </button>
                        </div>
                        <div id="product-select" class=" d-none col-8 mx-auto text-center alert alert-danger rounded-pill">
                            <span class="text-bold">* Please Select at least one product </span>
                        </div>
                    <?php } else { ?>
                        <div class="card mb-2 " data-title="Product Card" data-intro="Here is a product card with buttons!" data-step="2">
                            <div class="row g-0 sh-12">
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div class="col-12 col-md-12 d-flex align-items-center justify-content-center">
                                                No Procut Available Yet !
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- Items Container Start -->

                    <!-- List Items End -->
                </div>
            </div>
        </div>

    </div>

</main>
<script>
    const searchInput = document.getElementById('productSearch');
    const productCards = document.querySelectorAll('.product-card');

    searchInput.addEventListener('input', function() {
        const searchText = searchInput.value.trim().toLowerCase();

        productCards.forEach(card => {
            const title = card.querySelector('.product-title').textContent.toLowerCase();

            if (title.includes(searchText)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });



    function submitOrder() {

        const selectedProducts = [];
        let user_id = "<?= $_SESSION['user']['id'] ?? '' ?>";
        let category_id = "<?= $categoryId ?? '' ?>";
        const checkboxes = document.querySelectorAll('.product-checkboxes');

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                let productData = JSON.parse(checkbox.getAttribute("data-product"));

                const pro_id = productData.id;
                const productName = productData.name;
                const quantity_req = $('#quantatiy_' + pro_id).val();
                const avialable_Stock = $('#available_' + pro_id).val();
                const quantity_mis = $('#available_' + pro_id).val();
                const quantity_rec = $('#available_' + pro_id).val();

                selectedProducts.push({
                    pro_id: pro_id,
                    name: productName,
                    quantity: quantity_req,
                    avialable: avialable_Stock
                });
            }
        });

        if (selectedProducts.length === 0) {
            $('#product-select').removeClass('d-none');
            setTimeout(() => {
                $('#product-select').fadeIn().delay(1500).fadeOut();
            }, 2000);
            return;
        } else {
            $('#orderButton').text('saving');
            $('#orderButton').attr('disabled', true);
            $.ajax({
                url: "functions.php",
                method: 'POST',
                data: {
                    user_id: user_id,
                    categoryId: category_id,
                    products: selectedProducts,
                    action: "saveorder",
                },
                success: function(response) {
                    $('#orderButton').text('Order Now');
                    $('#orderButton').attr('disabled', false);

                    $('#order-statusplaced').removeClass('d-none');
                    setTimeout(() => {
                        $('#order-statusChange').fadeIn().delay(1500).fadeOut();
                    }, 2000);

                    setTimeout(function() {
                        window.location.href = "order-manage.php?category_id=" + category_id;;
                    }, 1500);
                },
                error: function(xhr, status, error) {
                    alert('please contact to the developer');
                    $('#orderButton').text('Order Now');
                    $('#orderButton').attr('disabled', false);
                }
            });
        }

    }

    $(document).ready(function() {

        $('#select-categoryid').change(function() {
            $('#cat_id-form').submit();
        });

    });
</script>

</body>

</html>







<?php include('footer.php') ?>