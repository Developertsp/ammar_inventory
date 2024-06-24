<?php
include('header.php');

$AllDellProducts = getAllDletedProduct();


?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                    <h1 class="mb-0 pb-0 display-4" id="title">Products listing</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="Dashboards.Default.html">Products</a></li>
                            <li class="breadcrumb-item"><a href="Dashboards.html">Management</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Products Start -->
        <div class="row py-5">
            <div class="col-12 col-xl-12 mb-5 ">

                <!-- Search Start -->
                <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
                    <div
                        class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
                        <input id="productSearch" class="form-control" type="text"
                            placeholder="Search by product title">
                        <span class="search-magnifier-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="acorn-icons acorn-icons-search undefined">
                                <circle cx="9" cy="9" r="7"></circle>
                                <path d="M14 14L17.5 17.5"></path>
                            </svg>
                        </span>
                        <span class="search-delete-icon d-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="acorn-icons acorn-icons-close undefined">
                                <path d="M5 5 15 15M15 5 5 15"></path>
                            </svg>
                        </span>
                    </div>
                </div>
                <!-- Search End -->
                <div class="d-flex justify-content-end">
                    <a href="products.php" class="btn btn-info mb-3 me-3" >
                        Active Products
                    </a>
                </div>


                <div class="scroll-div">
                    <div>
                        <?php
                        if ($AllDellProducts) {
                            foreach ($AllDellProducts as $key => $val):
                                ?>
                                <div class="card product-card mb-2" data-title="Product Card"
                                    data-intro="Here is a product card with buttons!" data-step="2">
                                    <div class="row g-0 sh-12">
                                        <div class="col-auto">
                                            <a>
                                                <img src="<?= ($val['productImage']) ? $val['productImage'] : 'uploads/defualt_products.png' ?>"
                                                    alt="product image " class="card-img card-img-horizontal sw-13 sw-lg-15"
                                                    style="max-height: 96px; width: 100px" />
                                            </a>
                                        </div>
                                        <div class="col">
                                            <div class="card-body pt-0 pb-0 h-100">
                                                <div class="row g-0 h-100 align-content-center">
                                                    <div
                                                        class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0 position-static">
                                                        <a>
                                                            <span class="product-title" ><?php echo $val['name'] ?? '' ?></span>
                                                        </a>
                                                    </div>
                                                    <div
                                                        class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                        <button data-id="<?php echo $val['id'] ?? '' ?>"
                                                            class="btn btn-sm btn-icon btn-icon-start btn-outline-primary undo-del-product ms-1"
                                                            type="button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-arrow-left">
                                                            <line x1="19" y1="12" x2="5" y2="12"></line>
                                                            <polyline points="12 19 5 12 12 5"></polyline>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        } else {
                            ?>
                            <div class="card mb-2 " data-title="Product Card"
                                data-intro="Here is a product card with buttons!" data-step="2">
                                <div class="row g-0 sh-12">
                                    <div class="col">
                                        <div class="card-body pt-0 pb-0 h-100">
                                            <div class="row g-0 h-100 align-content-center">
                                                <div
                                                    class="col-12 col-md-12 d-flex align-items-center justify-content-center">
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
                        <div id="last_productCard" class="card mb-2 d-none " data-title="Product Card"
                            data-intro="Here is a product card with buttons!" data-step="2">
                            <div class="row g-0 sh-12">
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div
                                                class="col-12 col-md-12 d-flex align-items-center justify-content-center">
                                                No Product Available Yet !
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Products End -->
    </div>


<script>

const searchInput = document.getElementById('productSearch');
    const productCards = document.querySelectorAll('.product-card');

    searchInput.addEventListener('input', function () {

        const searchText = searchInput.value.trim().toLowerCase();

        productCards.forEach(card => {
            const title = card.querySelector('.product-title').textContent.toLowerCase();

            if (title.includes(searchText)) {
                card.style.display = 'block'; // Show matching cards
            } else {
                card.style.display = 'none'; // Hide non-matching cards
            }
        });
    });



</script>
<?php include('footer.php') ?>