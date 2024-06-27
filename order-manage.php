<?php
include('header.php');
$orders = getAllOrders();

$AllCategories = getAllCategoris();

$categoryOrders = NULL;
$success = NULL;
$categoryId = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['category_id'])) {
    $categoryId = $_POST['category_id'];
    $categoryOrders = getAllOrdersByCategory($categoryId);
  }
}


?>
<main>
  <style>
    #pagination {
      text-align: center;
      padding: 10px;
    }

    #pagination a {
      background: #2980b9;
      color: #fff;
      text-decoration: none;
      display: inline-block;
      padding: 5px 10px;
      margin-right: 5px;
      border-radius: 3px;
    }

    #pagination a.active {
      background: #27ae60;
    }
  </style>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="page-title-container">
          <h1 class="mb-0 pb-0 display-4" id="title">Order Listing</h1>
          <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
            <ul class="breadcrumb pt-0">
              <li class="breadcrumb-item"><a href="Dashboards.Default.html">Orders</a></li>
              <li class="breadcrumb-item"><a href="Dashboards.html">Management</a></li>
            </ul>
          </nav>
        </div>
      </div>

      <!-- Controls Start -->
      <div class="row mb-2">
        <!-- order listing -->
        <div class="col-sm-12 col-md-3 col-lg-3 col-xxl-3 mb-3 order-md-2 justify-content-end">
          <?php
          if (isset($_SESSION['user']) && isset($_SESSION['user_role'])) {
            if ($_SESSION['user_role'] != 'admin') {
          ?>
              <div class="d-flex justify-content-end">
                <a href="orders.php" class="btn btn-info  mb-3 ">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-plus undefined">
                    <path d="M10 17 10 3M3 10 17 10"></path>
                  </svg>
                  New Order
                </a>
              </div>

          <?php
            }
          } ?>
        </div>
        <!-- Search Start -->
        <div class="col-sm-12 col-md-3 col-lg-3 col-xxl-3 mb-3">
          <div class="d-flex float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
            <input id="shopSearch" class="form-control" type="text" placeholder="Search by Shop name">
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
        <!-- Search Start -->
        <div class="col-sm-12 col-md-3 col-lg-3 col-xxl-3 mb-3">
          <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
            <input id="dateRangePicker" class="form-control" type="text" placeholder="Select date range">
          </div>
        </div>
        <!-- Dropdown Start -->
        <div class="col-sm-12 col-md-3 col-lg-3 col-xxl-3 mb-3">
          <select id="select-categoryid" style="border-color: black;" required="" class="form-control" name="category_id">
            <option value=""> -- Select Category --</option>
            <?php foreach ($AllCategories as $key => $val) : ?>
              <option value="<?= $val['id'] ?>" <?php if ($categoryId == $val['id']) echo 'selected'; ?>>
                <?= $val['name'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Dropdown End -->
        <!-- Controls End -->
      </div>
      <div id="order-statusChange" class=" d-none col-8 mx-auto text-center alert alert-success rounded-pill">
        <span class="text-bold">Order Status changed Successfully </span>
      </div>
      <div id="data-container">
        <div class="card mb-2" data-title="Product Card" data-intro="Here is a product card with buttons!" data-step="2">
          <div class="row g-0 sh-12">
            <div class="col">
              <div class="card-body pt-0 pb-0 h-100">
                <div class="row g-0 h-100 align-content-center">
                  <div class="col-12 col-md-12 d-flex align-items-center justify-content-center">
                    <span id="oder-available" class="fw-bold fs-6">Please Select Category </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>


  </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
<script>
  $(document).ready(function() {

    var cat_id = $('#select-categoryid').val();
    if (cat_id === '') {
      $('#oder-available').text('Please Select the Category From Dropdown List');
    } else {
      $('#oder-available').text('No Order Available Yet!');
    }

    $('#shopSearch').on('input', function() {

      var searchText = $(this).val().trim().toLowerCase();
      $('.order-card').each(function() {
        var shopName = $(this).find('.shop-name').text().toLowerCase();
        if (shopName.includes(searchText)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });

    $(document).on('click', '.btn_product-table', function() {
      const orderID = $(this).attr('data-order_id');
      const tableID = `#oder_products_${orderID}`;
      $(tableID).toggleClass('d-none');
    });

    $('#select-categoryid').change(function() {
      $('#cat_id-form').submit();
    });

    $(document).on('click', '.btn-status_order', function() {
      var $button = $(this);
      var order_id = $button.data('order_id');
      var order_status = $button.data('order_status').trim();
      var action = 'OrderStatus';

      var formData = {
        id: order_id,
        status: order_status,
        action: action
      };

      $.ajax({
        url: 'functions.php',
        method: 'POST',
        data: formData,
        success: function(response) {
          response = response.trim();
          console.log(response);
          console.log(order_status);
          if (response == 'yes') {

            if (order_status == 'Completed' || order_status == 'Canceled') {
              $('#order-statusChange').removeClass('d-none').text('Order ' + order_status + ' Successfully ');
              setTimeout(() => {
                $('#order-statusChange').fadeIn().delay(1500).fadeOut();
              }, 100);

              $('#order-completed_' + order_id).addClass('d-none');
              $('#order-cancel_' + order_id).addClass('d-none');
              $('#order-undu_' + order_id).removeClass('d-none');
              $('#order-text_' + order_id).text(order_status);

            } else if (order_status == 'Pending') {
              $('#order-statusChange').removeClass('d-none').text('Order reverted Successfully ');
              setTimeout(() => {
                $('#order-statusChange').fadeIn().delay(1500).fadeOut();
              }, 100);
              $('#order-completed_' + order_id).removeClass('d-none');
              $('#order-cancel_' + order_id).removeClass('d-none');
              $('#order-undu_' + order_id).addClass('d-none');
              $('#order-text_' + order_id).text(order_status);

            }

          }
        },
        error: function(xhr, status, error) {
          console.error('AJAX error:', error);
        }
      });
    });

  });
</script>

<script>
  $(document).on('click', '.download-pdf', function() {
    const ord_id = $(this).data('order_id');

    const docDefinition = {
      content: [{
          text: 'Order Invoice',
          style: 'mainHeader'
        },
        generateHeaderDetails(`#order-card_${ord_id}`),
        generateOrderInfo(`#order-card_${ord_id}`),
        {
          text: ' ',
          margin: [0, 10]
        },
        {
          table: generateTableData(`#oder_products_${ord_id}`)
        }
      ],
      styles: {
        header: {
          fontSize: 16,
          bold: true,
          margin: [0, 0, 0, 10]
        },
        mainHeader: {
          fontSize: 20,
          bold: true,
          alignment: 'center',
          margin: [0, 0, 0, 10],
          color: '#007BFF'
        },
        subHeader: {
          fontSize: 16,
          bold: true,
          alignment: 'center',
          margin: [0, 0, 0, 10]
        },
      }
    };

    const pdfDocGenerator = pdfMake.createPdf(docDefinition);
    pdfDocGenerator.download(`order_${ord_id}.pdf`);
  });

  function generateHeaderDetails(cardSelector) {
    const shopName = $(`${cardSelector} .shop-name`).text().trim();
    const shopManager = $(`${cardSelector} .shop-manager`).text().trim();

    return [{
        text: `Shop Name: ${shopName}`,
        style: 'header'
      },
      {
        text: `Shop Manager: ${shopManager}`,
        style: 'header'
      }
    ];
  }

  function generateOrderInfo(cardSelector) {
    const orderDate = $(`${cardSelector} .order-date`).text().trim();
    const productsCategory = $(`${cardSelector} .product-category`).text().trim();
    const orderStatus = $(`${cardSelector} .order-status`).text().trim();

    return [{
        text: `Order Date: ${orderDate}`,
        style: 'header'
      },
      {
        text: `Products Category: ${productsCategory}`,
        style: 'header'
      },
      {
        text: `Order Status: ${orderStatus}`,
        style: 'header'
      }
    ];
  }

  function generateTableData(tableSelector) {
    const headers = [];
    const rows = [];

    // Extract table headers
    $(`${tableSelector} thead th`).each(function() {
      headers.push({
        text: $(this).text(),
        style: 'tableHeader'
      });
    });

    // Extract table rows and input values
    $(`${tableSelector} tbody tr`).each(function() {
      const row = [];
      let isEmptyRow = true;

      $(this).find('td').each(function() {
        const input = $(this).find('input');
        if (input.length > 0) {
          if (input.attr('type') === 'number') {
            row.push(input.val());
          } else if (input.attr('type') === 'checkbox') {
            row.push(input.is(':checked') ? 'Yes' : 'No');
          }
          isEmptyRow = false; // Row has input elements, so it's not empty
        } else {
          const text = $(this).text().trim();
          row.push(text);
          if (text !== '') {
            isEmptyRow = false;
          }
        }
      });

      if (!isEmptyRow && row[row.length - 1] !== 'Update Details') {
        rows.push(row);
      }
    });


    const tableData = [headers];
    rows.forEach(row => {
      tableData.push(row);
    });

    return {
      widths: Array(headers.length).fill('*'),
      body: tableData,
      layout: 'lightHorizontalLines'
    };
  }
</script>


<script>
  $(document).ready(function() {
    $('#dateRangePicker').daterangepicker({
      opens: 'center',
      autoUpdateInput: true,
      locale: {
        cancelLabel: 'Clear',
        format: 'YYYY-MM-DD'
      },
    });

    $('#dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
      var selectedDateRange = picker.startDate.format('YYYY-MM-DD') + ' , ' + picker.endDate.format('YYYY-MM-DD');
      console.log("Selected date range:", selectedDateRange);
      loadRecords(null, selectedDateRange)
    });

    $('#dateRangePicker').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });

    // Retrieve the category_id value from the URL parameter
    var urlParams = new URLSearchParams(window.location.search);
    var category_id = urlParams.get('category_id');

    // Set the selected value in the dropdown
    if (category_id) {
      $('#select-categoryid').val(category_id);
      $('#select-categoryid').change();
      currentPage = 1;
      $('#dateRangePicker').val('');
      loadRecords(currentPage);

    }

    // Event listener for category dropdown change
    $('#select-categoryid').on('change', function() {
      currentPage = 1;
      $('#dateRangePicker').val('');
      loadRecords(currentPage);

    });

    //Pagination Code
    $(document).on("click", "#pagination a", function(e) {
      e.preventDefault();
      var page_id = $(this).attr("id");
      var selectedDate = $('#dateRangePicker').val().replace(' - ', ' , ');
      loadRecords(page_id, selectedDate)
    })

    // Function to load records using AJAX
    function loadRecords(page = null, rangedate = null) {
      var categoryId = $('#select-categoryid').val();

      $.ajax({
        url: 'functions.php',
        type: 'POST',
        data: {
          action: 'pagination_orders',
          category_id: categoryId,
          page_no: page,
          start_date: rangedate ? rangedate.split(' , ')[0] : null,
          end_date: rangedate ? rangedate.split(' , ')[1] : null,
        },
        success: function(response) {
          $('#data-container').html(response);
        },
        error: function(error) {
          // Handle any error that occurs during the AJAX request
        }
      });
    }

    $(document).on('click', '.update-qty', function() {
      var orderId = $(this).data('order_id');
      var products = [];

      $('.missed_qty_'+orderId).each(function() {
        var id = $(this).attr('name').replace('missed_qty_', '');
        var missedQty = $(this).val();
        var isReceived = $('#is_received_' + id).is(':checked') ? 'Yes' : 'No';
        products.push({
          id: id,
          missed_qty: missedQty,
          is_received: isReceived
        });
      });

      $.ajax({
        url: 'functions.php',
        type: 'POST',
        data: {
          action: 'QtyUpdate',
          order_id: orderId,
          products: products
        },
        success: function(response) {
          if (response == 'Incomplete') {
            $('#order-statusChange').removeClass('d-none').text('Order details and stauts updated Successfully ');
            setTimeout(() => {
              $('#order-statusChange').fadeIn().delay(1500).fadeOut();
            }, 100);
            $('#order-completed_' + orderId).removeClass('d-none');
            $('#order-cancel_' + orderId).removeClass('d-none');
            $('#order-undu_' + orderId).addClass('d-none');
            $('#order-text_' + orderId).text(response).addClass('bg-danger');
          } else if (response == 'Completed') {
            $('#order-statusChange').removeClass('d-none').text('Order details and stauts updated Successfully ');
            setTimeout(() => {
              $('#order-statusChange').fadeIn().delay(1500).fadeOut();
            }, 100);
            $('#order-completed_' + orderId).addClass('d-none');
            $('#order-cancel_' + orderId).addClass('d-none');
            $('#order-undu_' + orderId).removeClass('d-none');
            $('#order-text_' + orderId).text(response).removeClass('bg-danger');
          } else {
            alert('any technical error occurs');
          }
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });
  })
</script>


<!-- Include necessary CSS and JavaScript -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
<!-- Include Bootstrap Pagination plugin via CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>

<?php include('footer.php'); ?>