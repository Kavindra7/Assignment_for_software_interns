<?php


if (isset($_POST['delete'])) {
    require "../dbconnection.php";

    $id = $_POST['id'];
    $sql = "DELETE FROM item WHERE id=$id";
    $delete = $con->prepare($sql);
    if ($delete->execute()) {
        echo "<html><link href='../css/bootstrap.min.css' rel='stylesheet'>
             <link href='../css/style.css' rel='stylesheet'>
           <body><script src='../js/sweetalert2.all.js'></script><script>swal({
              type: 'success',
              title: 'Done...',
              text: 'Item Deleted Successful!'
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

}
$con = null;
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
<div class="container w-100 mb-lg-5">
    <div class="m-lg-4"><a href="../" class="crad-link text-secondary">Home</a> / All Items</div>
    <div class="row mt-5 mb-1">
        <div class="col-lg-6"><h3>Item Details</h3></div>
        <div class="col-lg-6"><a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New
                Item</a></div>

    </div>
    <div class="col-lg-4">
        <input type="text" class="form-control" id="searchKey" onkeyup="searchFunction(0,'item_table')"
               placeholder="Search By Item Code">
    </div>
    <div class="table-screen">
        <table class="table table-hover table-bordered mt-3" id="item_table">
            <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Item code</th>
                <th scope="col">Item name</th>
                <th scope="col">Item category</th>
                <th scope="col">Item sub category</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit price</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require "../dbconnection.php";

            $sql1 = "SELECT item.*,item_category.category,item_subcategory.sub_category FROM item 
LEFT JOIN item_category ON item.item_category = item_category.id
LEFT JOIN item_subcategory ON item.item_subcategory = item_subcategory.id";
            $select1 = $con->prepare($sql1);
            $select1->execute();
            while ($data = $select1->fetch()) {
                ?>
                <tr>
                    <th scope="row"> <?php echo $data['id']; ?></th>
                    <td><?php echo $data['item_code']; ?></td>
                    <td><?php echo $data['item_name']; ?></td>
                    <td><?php echo $data['category']; ?></td>
                    <td><?php echo $data['sub_category']; ?></td>
                    <td><?php echo $data['quantity']; ?></td>
                    <td><?php echo number_format($data['unit_price'], 2); ?></td>
                    <td>
                        <div class="row">
                            <div class="col-lg-2">
                                <a href="update.php?id=<?php echo $data['id']; ?>" title="Update Record"
                                   data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                            </div>
                            <div class="col-lg-2">
                                <form action="<?php $_PHP_SELF ?>" method="POST" onsubmit="return confirmAction()">
                                    <input type="hidden" class="form-control" name="id" id="id"
                                           value="<?php echo $data['id'] ?>">
                                    <button type="submit" name="delete" class="text-danger bg-transparent border-0"
                                            title="Delete Record"
                                            data-toggle="tooltip"><span class="fa fa-trash"></span></button>
                                </form>
                            </div>
                        </div>


                    </td>
                </tr>
            <?php }
            $con = null; ?>
            </tbody>
        </table>
    </div>
</div>
<br /><br />
<?php include('../footer.php') ?>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/sweetalert2.all.js"></script>
</body>
</html>