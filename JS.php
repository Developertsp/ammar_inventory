<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        $('.btn-close-form').click(function() {
            $('#user-details')[0].reset();
            $('#user-image-preview').attr('src', 'uploads/defualt_profile.png');
            $('#user-password').attr('required', '');
            $('#user-image').attr('required', '');
            $('#user-id').val('');
            $('#shop-name').val('');
            $('#btn-saveUser').text('Add User').addClass('btn-primary').removeClass('btn-warning');

        });

        $('.product-close-form').click(function() {
            $('#product-details')[0].reset();
            $('#product-image-preview').attr('src', 'uploads/defualt_products.png');
            $('#product-image').attr('required', '');
            $('#product-id').val('');
            $('#btn-savePoduct').text('Add Product').addClass('btn-primary').removeClass('btn-warning');

        });

        $(".edit-button").on("click", function() {
            var userData = JSON.parse($(this).attr("data-user"));
            var editButton = $(this);
            $('#user-name').val(userData.name);
            $('#user-email').val(userData.email);
            $('#shop-name').val(userData.shop_name);
            $('#user-id').val(userData.id);
            $('#user-password').removeAttr('required');
            $('#user-image').removeAttr('required');
            if (userData.userImage) {
                $('#user-image-preview').attr('src', userData.userImage);
            } else {
                $('#user-image-preview').attr('src', 'uploads/defualt_profile.png');
            }
            $('#btn-saveUser').text('Update User').addClass('btn-warning').removeClass('btn-primary');

        });

        $(".edit-product").on("click", function() {
            var productData = JSON.parse($(this).attr("data-product"));
            console.log(productData);
            var editButton = $(this);
            $('#product-name').val(productData.name);
            $('#product-price').val(productData.price);
            $('#product-id').val(productData.id);
            $('#select-category').val(productData.category_id);
            $('#product-image').removeAttr('required');
            if (productData.productImage) {
                $('#product-image-preview').attr('src', productData.productImage);
            } else {
                $('#product-image-preview').attr('src', 'uploads/defualt_products.png');
            }
            $('#btn-savePoduct').text('Update Product').addClass('btn-warning').removeClass('btn-primary');

        });

        $(".delete-button").on("click", function() {
            var userId = $(this).attr("data-id");
            var deleteButton = $(this);
            $.ajax({
                type: "POST",
                url: "functions.php",
                data: {
                    action: "deleteUser",
                    userId: userId
                },
                success: function(response) {
                    if (response.trim() === "success") {
                        var card = deleteButton.closest(".card");
                        card.slideUp("slow", function() {
                            card.remove();
                        });
                    } else if (response.trim() === "no-user") {
                        var card = deleteButton.closest(".card");
                        card.slideUp("slow", function() {
                            card.remove();
                        });
                        $('#last_card').removeClass('d-none');
                    } else {
                        alert("Failed to delete user.");
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert("An error occurred. Please try again later.");
                }
            });
        });

        $(".delete-product").on("click", function() {
            var productId = $(this).attr("data-id");
            var deleteButton = $(this);
            $.ajax({
                type: "POST",
                url: "functions.php",
                data: {
                    action: "deleteProduct",
                    productId: productId
                },
                success: function(response) {
                    if (response.trim() === "success") {
                        var card = deleteButton.closest(".card");
                        card.slideUp("slow", function() {
                            card.remove();
                        });
                    } else if (response.trim() === "no-procut") {
                        var card = deleteButton.closest(".card");
                        card.slideUp("slow", function() {
                            card.remove();
                        });
                        $('#last_productCard').removeClass('d-none');
                    } else {
                        alert("Failed to delete product.");
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert("An error occurred. Please try again later.");
                }
            });
        });

        $(".undo-del-product").on("click", function() {
            var productId = $(this).attr("data-id");
            var deleteButton = $(this);
            $.ajax({
                type: "POST",
                url: "functions.php",
                data: {
                    action: "undoDelProduct",
                    productId: productId
                },
                success: function(response) {
                    if (response.trim() === "success") {
                        var card = deleteButton.closest(".card");
                        card.slideUp("slow", function() {
                            card.remove();
                        });
                    } else if (response.trim() === "no-procut") {
                        var card = deleteButton.closest(".card");
                        card.slideUp("slow", function() {
                            card.remove();
                        });
                        $('#last_productCard').removeClass('d-none');
                    } else {
                        alert("Failed to delete product.");
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert("An error occurred. Please try again later.");
                }
            });
        });

        // categories functionalities edit ... delete...
        $(".edit-category").on("click", function() {
            var productData = JSON.parse($(this).attr("data-product"));
            var editButton = $(this);
            $('#category-name').val(productData.name);
            $('#category-id').val(productData.id);
            $('#btn-saveCategory').text('Update Catgory').addClass('btn-warning').removeClass('btn-primary');
        });

        $(".delete-Category").on("click", function() {
            var categoryId = $(this).attr("data-id");
            var deleteButton = $(this);
            $.ajax({
                type: "POST",
                url: "functions.php",
                data: {
                    action: "deleteCategory",
                    categoryId: categoryId
                },
                success: function(response) {
                    if (response.trim() === "success") {
                        var card = deleteButton.closest(".card");
                        card.slideUp("slow", function() {
                            card.remove();
                        });
                    } else if (response.trim() === "no-category") {
                        var card = deleteButton.closest(".card");
                        card.slideUp("slow", function() {
                            card.remove();
                        });
                        $('#last_categoryCard').removeClass('d-none');
                    } else {
                        alert("Failed to delete Category.");
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert("An error occurred. Please try again later.");
                }
            });
        });

    });
</script>