<?php
include('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = storeCategory($db, $_POST);
}

$AllCategories = getAllCategoris();
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                    <h1 class="mb-0 pb-0 display-4" id="title">Categories listing</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="Dashboards.Default.html">Category</a></li>
                            <li class="breadcrumb-item"><a href="Dashboards.html">Management</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Category Start -->
        <div class="row py-5">
            <div class="col-12 col-xl-12 mb-5 ">
                <div class="d-flex justify-content-end">
                    <!-- <h2 class="small-title">Products</h2> -->
                    <button class="btn btn-info  mb-3 " type="button" data-bs-toggle="modal"
                        data-bs-target="#closeButtonOutExample">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="acorn-icons acorn-icons-plus undefined">
                            <path d="M10 17 10 3M3 10 17 10"></path>
                        </svg>
                        Add Category
                    </button>

                </div>

                <div class="scroll-div">
                    <div>
                        <?php
                        if ($AllCategories) {
                            foreach ($AllCategories as $key => $val):
                                ?>
                                <div class="card mb-2" data-title="Product Card"
                                    data-intro="Here is a product card with buttons!" data-step="2">
                                    <div class="row g-0 sh-12">
                                        <div class="col">
                                            <div class="card-body pt-0 pb-0 h-100">
                                                <div class="row g-0 h-100 align-content-center">
                                                    <div
                                                        class="col-12 col-md-7 d-flex flex-column mb-2 ml-5 mb-md-0 position-static">
                                                        <span class="font-weight-bold"> Category Title: </span>
                                                        <a class="">
                                                            <?php echo $val['name'] ?? '' ?>
                                                        </a>
                                                    </div>
                                                    <div
                                                        class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                        <button data-product='<?= json_encode($val); ?>'
                                                            class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1 edit-category"
                                                            type="button" data-bs-toggle="modal"
                                                            data-bs-target="#closeButtonOutExample">
                                                            <i data-acorn-icon="edit-square" data-acorn-size="15"></i>
                                                            <span class="d-none d-xxl-inline-block">Edit</span>
                                                        </button>
                                                        <button data-id="<?php echo $val['id'] ?? '' ?>"
                                                            class="btn btn-sm btn-icon btn-icon-start btn-outline-primary delete-Category ms-1"
                                                            type="button">
                                                            <i data-acorn-icon="bin" data-acorn-size="15"></i>
                                                            <span class="d-none d-xxl-inline-block">Delete</span>
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
                            <div class="card mb-2 " data-title="category  Card"
                                data-intro="Here is a Category card with buttons!" data-step="2">
                                <div class="row g-0 sh-12">
                                    <div class="col">
                                        <div class="card-body pt-0 pb-0 h-100">
                                            <div class="row g-0 h-100 align-content-center">
                                                <div
                                                    class="col-12 col-md-12 d-flex align-items-center justify-content-center">
                                                    No Category Available Yet !
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div id="last_categoryCard" class="card mb-2 d-none " data-title="Category Card"
                            data-intro="Here is a product card with buttons!" data-step="2">
                            <div class="row g-0 sh-12">
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div
                                                class="col-12 col-md-12 d-flex align-items-center justify-content-center">
                                                No Category Available Yet !
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
        <!-- Category End -->
    </div>


    <!-- model box -->
    <div class="modal fade modal-close-out" id="closeButtonOutExample" tabindex="-1"
        aria-labelledby="exampleModalLabelCloseOut" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelCloseOut">Add Categories</h5>
                    <button type="button" class="btn-close product-close-form" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="sw-lg-50 px-5">
                        <form id="category-details" action="category.php" method="POST" class="tooltip-end-bottom"
                            enctype="multipart/form-data">
                            <div>
                                <input id="category-id" type="hidden" name="id">

                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="acorn-icons acorn-icons-lock-off undefined">
                                        <path
                                            d="M5 12.6667C5 12.0467 5 11.7367 5.06815 11.4824C5.25308 10.7922 5.79218 10.2531 6.48236 10.0681C6.73669 10 7.04669 10 7.66667 10H12.3333C12.9533 10 13.2633 10 13.5176 10.0681C14.2078 10.2531 14.7469 10.7922 14.9319 11.4824C15 11.7367 15 12.0467 15 12.6667V13C15 13.9293 15 14.394 14.9231 14.7804C14.6075 16.3671 13.3671 17.6075 11.7804 17.9231C11.394 18 10.9293 18 10 18V18C9.07069 18 8.60603 18 8.21964 17.9231C6.63288 17.6075 5.39249 16.3671 5.07686 14.7804C5 14.394 5 13.9293 5 13V12.6667Z">
                                        </path>
                                        <path
                                            d="M11 15H10 9M13 6V5C13 3.34315 11.6569 2 10 2V2C8.34315 2 7 3.34315 7 5V10">
                                        </path>
                                    </svg>
                                    <input id="category-name" required="" class="form-control" placeholder="Name"
                                        name="name">
                                </div>
                            </div>
                            <!-- Add User button with type="submit" -->
                            <div class="modal-footer">
                                <button type="button" class="btn product-close-form btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="btn-saveCategory" class="btn btn-primary">Add
                                    Category</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<script>
//    function previewImage(input) {
//         var imagePreview = document.getElementById("product-image-preview");

//         if (input.files && input.files[0]) {
//             var reader = new FileReader();

//             reader.onload = function (e) {
//                 imagePreview.src = e.target.result;
//             };

//             reader.readAsDataURL(input.files[0]);
//         } else {
//             imagePreview.src = ""; // Clear the preview if no file selected
//         }
//     }


</script>
<?php include('footer.php') ?>