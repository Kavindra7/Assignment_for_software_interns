<?php


if (isset($_POST['delete'])) {
    require "../dbconnection.php";

    $id = $_POST['id'];
    $sql = "DELETE FROM customer WHERE id=$id";
    $delete = $con->prepare($sql);
    if ($delete->execute()) {
        echo "<html><link href='../css/bootstrap.min.css' rel='stylesheet'>
             <link href='../css/style.css' rel='stylesheet'>
           <body><script src='../js/sweetalert2.all.js'></script><script>swal({
              type: 'success',
              title: 'Done...',
              text: 'Customer Deleted Successful!'
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
    <div class="m-lg-4"><a href="../" class="crad-link text-secondary">Home</a> / All Customer</div>
    <div class="row mt-5 mb-1">
        <div class="col-lg-6"><h3>Customers Details</h3></div>
        <div class="col-lg-6"><a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New
                Customer</a></div>

    </div>
    <div class="col-lg-4">
        <input type="text" class="form-control" id="searchKey" onkeyup="searchFunction(1,'customer_table')"
               placeholder="Search By First Name">
    </div>
    <div class="table-screen">
        <table class="table table-hover table-bordered mt-3" id="customer_table">
            <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Contact No</th>
                <th scope="col">District</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require "../dbconnection.php";

            $sql1 = "SELECT customer.*,district.district FROM customer LEFT JOIN district ON customer.district = district.id";
            $select1 = $con->prepare($sql1);
            $select1->execute();
            while ($data = $select1->fetch()) {
                ?>
                <tr>
                    <th scope="row"> <?php echo $data['id']; ?></th>
                    <td><?php echo $data['title']; ?></td>
                    <td><?php echo $data['first_name']; ?></td>
                    <td><?php echo $data['last_name']; ?></td>
                    <td><?php echo $data['contact_no']; ?></td>
                    <td><?php echo $data['district']; ?></td>
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