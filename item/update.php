<?php


if (isset($_POST['update'])) {
    require "../dbconnection.php";

    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_sub_category = $_POST['item_sub_category'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];
    $id = $_POST['id'];


    $sql = "UPDATE `item` SET `item_code`='$item_code', `item_category`='$item_category',`item_subcategory`='$item_sub_category',`item_name`='$item_name',`quantity`='$quantity', `unit_price`='$unit_price' WHERE id='$id' ";
    $update = $con->prepare($sql);
    if ($update->execute()) {
        echo "<html><link href='../css/bootstrap.min.css' rel='stylesheet'>
             <link href='../css/style.css' rel='stylesheet'>
           <body><script src='../js/sweetalert2.all.js'></script><script>swal({
              type: 'success',
              title: 'Done...',
              text: 'Item Updated Successful!'
              }).then(function() {
             
              window.location.href = 'index.php';
              });</script>
              </body>
              </html>";
    } else {

        echo "<html><link href='../css/bootstrap.min.css' rel='stylesheet'>
             <link href='../css/style.css' rel='stylesheet'>
           <body><script src='../js/sweetalert2.all.js'></script><script>swal({
              type: 'error',
              title: 'Warning....',
              text: 'Please  try  again, something wrong!'
              }).then(function() {
             
              return false;
              });</script>
              </body>
              </html>";
    }
    $con = null;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assignment</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
<body>
<?php
require "../dbconnection.php";


if (isset($_GET["id"])) {
    $getID = $_GET["id"];
    $sql1 = "SELECT * FROM item WHERE id = $getID";
    $select1 = $con->prepare($sql1);
    $select1->execute();
    $data = $select1->fetch();


    if (!empty($data)) {
        ?>
        <div class="m-lg-4"><a href="./" class="crad-link text-secondary">All Item</a> / Edit
            - <?php echo $data['item_name'] . " (" . $data['item_code'] . ")" ?></div>

        <div class="container d-flex align-items-center justify-content-center">
            <div class="card w-75">
                <div class="card-body">
                    Item Details Form
                    <form class="mt-5 needs-validation" action="<?php $_PHP_SELF ?>" method="POST" novalidate>
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $data['id'] ?>">
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <label for="item_code" class="form-label">Item Code *</label>
                                <input type="text" class="form-control" name="item_code" id="item_code"
                                       placeholder="JT3443"
                                       value="<?php echo $data['item_code'] ?>"
                                       required>
                                <div id="item_codeFeedback" class="invalid-feedback">
                                    Enter Valid Item Code!
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="item_name" class="form-label">Item Name *</label>
                                <input type="text" class="form-control" name="item_name" id="item_name"
                                       placeholder="Laptop"
                                       value="<?php echo $data['item_name'] ?>"
                                       required>
                                <div id="item_nameFeedback" class="invalid-feedback">
                                    Enter Valid Item Name!
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <label for="item_category" class="form-label">Select Item Category *</label>
                                <select class="form-select" id="item_category" name="item_category" required>
                                    <option value="">Select Item Category</option>
                                    <?php
                                    require "../dbconnection.php";

                                    $sql1 = "SELECT * FROM item_category";
                                    $select1 = $con->prepare($sql1);
                                    $select1->execute();
                                    while ($data1 = $select1->fetch()) {
                                        ?>
                                        ?>
                                        <option <?php echo $data['item_category'] == $data1['id'] ? "selected" : "" ?>
                                                value="<?php echo $data1['id']; ?>"><?php echo $data1['category']; ?></option>
                                    <?php }
                                    $con = null; ?>
                                </select>
                                <div id="item_categoryFeedback" class="invalid-feedback">
                                    Please Select a Item Category!
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="item_sub_category" class="form-label">Select Item sub category *</label>
                                <select class="form-select" id="item_sub_category" name="item_sub_category" required>
                                    <option value="">Select Item sub category</option>
                                    <?php
                                    require "../dbconnection.php";

                                    $sql2 = "SELECT * FROM item_subcategory";
                                    $select2 = $con->prepare($sql2);
                                    $select2->execute();
                                    while ($data2 = $select2->fetch()) {
                                        ?>
                                        ?>
                                        <option <?php echo $data['item_subcategory'] == $data2['id'] ? "selected" : "" ?>
                                                value="<?php echo $data2['id']; ?>"><?php echo $data2['sub_category']; ?></option>
                                    <?php }
                                    $con = null; ?>
                                </select>
                                <div id="item_sub_categoryFeedback" class="invalid-feedback">
                                    Please Select a Item sub category!
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 mb-5">
                            <div class="col-lg-6">
                                <label for="quantity" class="form-label">Quantity *</label>
                                <input type="number" class="form-control" min="1" max="1000" name="quantity"
                                       id="quantity" placeholder="2"
                                       value="<?php echo $data['quantity'] ?>"
                                       required>
                                <div id="quantityFeedback" class="invalid-feedback">
                                    Enter Valid Item Code!
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="unit_price" class="form-label">Unit Price *</label>
                                <input type="number" min="1" max="9999999999999999999999999" class="form-control"
                                       name="unit_price" id="unit_price" placeholder="100"
                                       value="<?php echo $data['unit_price'] ?>"
                                       required>
                                <div id="unit_priceFeedback" class="invalid-feedback">
                                    Enter Valid Unit Price!
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary pull-right">Update Item</button>
                    </form>
                </div>
            </div>
        </div>
        <?php include('../footer.php') ?>
        <?php
    } else {
        echo "<html><link href='../css/bootstrap.min.css' rel='stylesheet'>
             <link href='../css/style.css' rel='stylesheet'>
           <body><script src='../js/sweetalert2.all.js'></script><script>swal({
              type: 'error',
              title: 'Warning....',
              text: 'Invalid parameter ID!'
              }).then(function() {
             
              window.location.href = 'index.php';
              });</script>
              </body>
              </html>";
    }
} else {
    echo "<html><link href='../css/bootstrap.min.css' rel='stylesheet'>
             <link href='../css/style.css' rel='stylesheet'>
           <body><script src='../js/sweetalert2.all.js'></script><script>swal({
              type: 'error',
              title: 'Warning....',
              text: 'Invalid URL parameters!'
              }).then(function() {
             
              window.location.href = 'index.php';
              });</script>
              </body>
              </html>";
}
$con = null;
?>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/main.js"></script>
</body>
</html>