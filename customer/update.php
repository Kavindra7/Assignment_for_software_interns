<?php


if (isset($_POST['update'])) {
    require "../dbconnection.php";

    $customer_title = $_POST['customer_title'];
    $first_name = $_POST['first_name'];
    $middle_name = isset($_POST['middle_name']) ? $_POST['middle_name'] : null;
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $district = $_POST['district'];
    $id = $_POST['id'];


    $sql = "UPDATE `customer` SET `title`='$customer_title', `first_name`='$first_name',`middle_name`='$middle_name',`last_name`='$last_name',`contact_no`='$contact_no', `district`='$district' WHERE id='$id' ";
    $update = $con->prepare($sql);
    if ($update->execute()) {
        echo "<html><link href='../css/bootstrap.min.css' rel='stylesheet'>
             <link href='../css/style.css' rel='stylesheet'>
           <body><script src='../js/sweetalert2.all.js'></script><script>swal({
              type: 'success',
              title: 'Done...',
              text: 'Customer Updated Successful!'
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
    $sql1 = "SELECT * FROM customer WHERE id = $getID";
    $select1 = $con->prepare($sql1);
    $select1->execute();
    $data = $select1->fetch();


    if (!empty($data)) {
        ?>
        <div class="m-lg-4"><a href="./" class="crad-link text-secondary">All Customers</a> / Edit
            - <?php echo $data['first_name'] . " " . $data['last_name'] ?></div>

        <div class="container d-flex align-items-center justify-content-center">
            <div class="card w-75">
                <div class="card-body">
                    Customer Details Form
                    <form class="mt-5 needs-validation" action="<?php $_PHP_SELF ?>" method="POST" novalidate>
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $data['id'] ?>">
                        <label class="form-label">Title</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="customer_title" id="title1"
                                           value="Mr"

                                        <?php echo $data['title'] == "Mr" ? "checked" : "" ?>
                                           required>
                                    <label class="form-check-label" for="title1">Mr</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="customer_title" id="title2"
                                           value="Mrs"
                                        <?php echo $data['title'] == "Mrs" ? "checked" : "" ?>
                                           required>
                                    <label class="form-check-label" for="title2">Mrs</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="customer_title" id="title3"
                                           value="Miss"
                                        <?php echo $data['title'] == "Miss" ? "checked" : "" ?>
                                           required>
                                    <label class="form-check-label" for="title3">Miss</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="customer_title" id="title4"
                                           value="Dr"
                                        <?php echo $data['title'] == "Dr" ? "checked" : "" ?>
                                           required>
                                    <label class="form-check-label" for="title4">Dr</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <label for="first_name" class="form-label">First Name *</label>
                                <input type="text" class="form-control" name="first_name" id="first_name"
                                       placeholder="Virath"
                                       value="<?php echo $data['first_name'] ?>"
                                       required>
                                <div id="first_nameFeedback" class="invalid-feedback">
                                    Enter Valid First Name!
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label for="middle_name" class="form-label">Middle Name </label>
                                <input type="text" class="form-control" name="middle_name" id="middle_name"
                                       value="<?php echo $data['middle_name'] ?>"
                                       placeholder="Kohli">
                            </div>
                            <div class="col-lg-4">
                                <label for="last_name" class="form-label">Last Name *</label>
                                <input type="text" class="form-control" name="last_name" id="last_name"
                                       value="<?php echo $data['last_name'] ?>"
                                       placeholder="Singhe"
                                       required>
                                <div id="last_nameFeedback" class="invalid-feedback">
                                    Enter Valid Last Name!
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 mb-5">
                            <div class="col-lg-6">
                                <label for="contact_no" class="form-label">Contact No *</label>
                                <input type="text" class="form-control" name="contact_no" id="contact_no"
                                       pattern="[0-9]{10,10}"
                                       value="<?php echo $data['contact_no'] ?>"
                                    placeholder="0776421315" required>
                                <div id="contact_noFeedback" class="invalid-feedback">
                                    Enter Valid Contact Number!
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="district" class="form-label">Select District *</label>
                                <select class="form-select" id="district" name="district" required>
                                    <option value="">Select District</option>
                                    <?php
                                    require "../dbconnection.php";

                                    $sql2 = "SELECT * FROM district";
                                    $select2 = $con->prepare($sql2);
                                    $select2->execute();
                                    while ($data2 = $select2->fetch()) {
                                        ?>
                                        ?>
                                        <option <?php echo $data['district'] == $data2['id'] ? "selected" : "" ?>
                                                value="<?php echo $data2['id']; ?>"><?php echo $data2['district']; ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <div id="districtFeedback" class="invalid-feedback">
                                    Please Select a District!
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary pull-right">Update Customer</button>
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