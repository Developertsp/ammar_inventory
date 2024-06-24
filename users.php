<?php
require_once('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imagePath = '';
    if (isset($_FILES["userImage"])) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["userImage"]["name"]);
        if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
        }
    }
    $response = storeUser($db, $_POST, $imagePath);
}

$AllUsers = getAllUsers();


?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-container">
                    <h1 class="mb-0 pb-0 display-4" id="title">Users listing</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="Dashboards.Default.html">Users</a></li>
                            <li class="breadcrumb-item"><a href="Dashboards.html">Management</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Products Start -->
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
                        Add Users
                    </button>

                </div>

                <div class="scroll-div">
                    <div>
                        <?php
                        if ($AllUsers) {
                            foreach ($AllUsers as $key => $val): ?>
                                <div class="card mb-2" data-title="Product Card"
                                    data-intro="Here is a product card with buttons!" data-step="2">
                                    <div class="row g-0 sh-12">
                                        <div class="col-auto">
                                            <a>
                                                <img src="<?= ($val['userImage']) ? $val['userImage'] : 'uploads/defualt_profile.png' ?>"
                                                    alt="alternate text" class="card-img card-img-horizontal sw-13 sw-lg-15"
                                                    style="max-height: 96px; width: 100px" />
                                            </a>
                                        </div>
                                        <div class="col">
                                            <div class="card-body pt-0 pb-0 h-100">
                                                <div class="row g-0 h-100 align-content-center">
                                                    <div
                                                        class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0 position-static">
                                                        <a href="Pages.Portfolio.Detail.html">
                                                            <?php echo $val['name'] ?? '' ?>
                                                        </a>
                                                        <div class="text-small text-muted text-truncate">
                                                            <?php echo $val['email'] ?? '' ?>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                        <button data-user='<?php echo json_encode($val); ?>'
                                                            class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1 edit-button"
                                                            type="button" data-bs-toggle="modal"
                                                            data-bs-target="#closeButtonOutExample">
                                                            <i data-acorn-icon="edit-square" data-acorn-size="15"></i>
                                                            <span class="d-none d-xxl-inline-block">Edit</span>
                                                        </button>
                                                        <button data-id="<?php echo $val['id'] ?? '' ?>"
                                                            class="btn btn-sm btn-icon btn-icon-start btn-outline-primary delete-button ms-1"
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
                            <div class="card mb-2 " data-title="Product Card"
                                data-intro="Here is a product card with buttons!" data-step="2">
                                <div class="row g-0 sh-12">
                                    <div class="col">
                                        <div class="card-body pt-0 pb-0 h-100">
                                            <div class="row g-0 h-100 align-content-center">
                                                <div
                                                    class="col-12 col-md-12 d-flex align-items-center justify-content-center">
                                                    No User Available Yet !
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div id="last_card" class="card mb-2 d-none " data-title="Product Card"
                            data-intro="Here is a product card with buttons!" data-step="2">
                            <div class="row g-0 sh-12">
                                <div class="col">
                                    <div class="card-body pt-0 pb-0 h-100">
                                        <div class="row g-0 h-100 align-content-center">
                                            <div
                                                class="col-12 col-md-12 d-flex align-items-center justify-content-center">
                                                No User Available Yet !
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


    <!-- model box -->
    <div class="modal fade modal-close-out" id="closeButtonOutExample" tabindex="-1"
        aria-labelledby="exampleModalLabelCloseOut" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelCloseOut">User Management</h5>
                    <button type="button" class=" btn-close-form btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="sw-lg-50 px-5">
                        <form id="user-details" action="users.php" method="POST" class="tooltip-end-bottom"
                            enctype="multipart/form-data">
                            <div>
                                <div class="mb-3 tooltip-end-top">
                                    <div class="d-flex justify-content-center align-items-center mb-2 ">
                                        <img id="user-image-preview" src="uploads/defualt_profile.png" alt="User Image"
                                            class="rounded-circle" style="height: 100px; width:100px">
                                    </div>
                                    <input id="user-image" required="" class="form-control" type="file" name="userImage"
                                        onchange="previewImage(this)">
                                    <input id="user-id" type="hidden" name="id">
                                </div>

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
                                    <input id="user-name" required="" class="form-control" placeholder="Name"
                                        name="name">
                                </div>
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
                                    <input id="shop-name" required="" class="form-control" placeholder="Shop Name"
                                        name="shop-name">
                                </div>
                                <div class="mb-3 filled form-group tooltip-end-top">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="acorn-icons acorn-icons-email undefined">
                                        <path
                                            d="M18 7L11.5652 10.2174C10.9086 10.5457 10.5802 10.7099 10.2313 10.7505C10.0776 10.7684 9.92238 10.7684 9.76869 10.7505C9.41977 10.7099 9.09143 10.5457 8.43475 10.2174L2 7">
                                        </path>
                                        <path
                                            d="M14.5 4C15.9045 4 16.6067 4 17.1111 4.33706C17.3295 4.48298 17.517 4.67048 17.6629 4.88886C18 5.39331 18 6.09554 18 7.5L18 12.5C18 13.9045 18 14.6067 17.6629 15.1111C17.517 15.3295 17.3295 15.517 17.1111 15.6629C16.6067 16 15.9045 16 14.5 16L5.5 16C4.09554 16 3.39331 16 2.88886 15.6629C2.67048 15.517 2.48298 15.3295 2.33706 15.1111C2 14.6067 2 13.9045 2 12.5L2 7.5C2 6.09554 2 5.39331 2.33706 4.88886C2.48298 4.67048 2.67048 4.48298 2.88886 4.33706C3.39331 4 4.09554 4 5.5 4L14.5 4Z">
                                        </path>
                                    </svg>
                                    <input id="user-email" type="email" class="form-control" required=""
                                        placeholder="Email" name="email">
                                </div>
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
                                    <input id="user-password" class="form-control" required="" name="password"
                                        type="password" placeholder="Password" autocomplete="new-password">
                                </div>
                            </div>

                            <!-- Add User button with type="submit" -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-close-form btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="btn-saveUser" class="btn btn-primary">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<script>
    function previewImage(input) {
        var imagePreview = document.getElementById("user-image-preview");

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            imagePreview.src = ""; // Clear the preview if no file selected
        }
    }


</script>
<?php include('footer.php') ?>