<?php


if (isset($_POST['create'])) {
    require "../dbconnection.php";

    $customer_title = $_POST['customer_title'];
    $first_name = $_POST['first_name'];
    $middle_name = isset($_POST['middle_name']) ? $_POST['middle_name'] : null;
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $district = $_POST['district'];


    $sql1 = 'INSERT INTO `customer`( `title`, `first_name`, `middle_name`, `last_name`, `contact_no`, `district`) VALUES ( :title, :first_name, :middle_name, :last_name, :contact_no, :district)';
    $insert = $con->prepare($sql1);
    if ($insert->execute(['title' => $customer_title, 'first_name' => $first_name, 'middle_name' => $middle_name, 'last_name' => $last_name, 'contact_no' => $contact_no, 'district' => $district])) {
        echo "<html><link href='../css/bootstrap.min.css' rel='stylesheet'>
             <link href='../css/style.css' rel='stylesheet'>
           <body><script src='../js/sweetalert2.all.js'></script><script>swal({
              type: 'success',
              title: 'Done...',
              text: 'Customer Created successful!'
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
<div class="m-lg-4"><a href="./" class="crad-link text-secondary">All Customers</a> / Create Customer</div>

<div class="container d-flex align-items-center justify-content-center">
    <div class="card w-75">
        <div class="card-body">
            Customer Details Form
            <form class="mt-5 needs-validation" action="<?php $_PHP_SELF ?>" method="POST" novalidate>
                <label class="form-label">Title</label>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="customer_title" id="title1" value="Mr"
                                   required>
                            <label class="form-check-label" for="title1">Mr</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="customer_title" id="title2" value="Mrs"
                                   required>
                            <label class="form-check-label" for="title2">Mrs</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="customer_title" id="title3" value="Miss"
                                   required>
                            <label class="form-check-label" for="title3">Miss</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="customer_title" id="title4" value="Dr"
                                   required>
                            <label class="form-check-label" for="title4">Dr</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-4">
                        <label for="first_name" class="form-label">First Name *</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Virath"
                               required>
                        <div id="first_nameFeedback" class="invalid-feedback">
                            Enter Valid First Name!
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="middle_name" class="form-label">Middle Name </label>
                        <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Kohli">
                    </div>
                    <div class="col-lg-4">
                        <label for="last_name" class="form-label">Last Name *</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Singhe"
                               required>
                        <div id="last_nameFeedback" class="invalid-feedback">
                            Enter Valid Last Name!
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-5">
                    <div class="col-lg-6">
                        <label for="contact_no" class="form-label">Contact No *</label>
                        <input type="text" class="form-control" name="contact_no" id="contact_no" pattern="[0-9]{10,10}"
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

                            $sql1 = "SELECT * FROM district";
                            $select1 = $con->prepare($sql1);
                            $select1->execute();
                            while ($data = $select1->fetch()) {
                                ?>
                                ?>
                                <option value="<?php echo $data['id']; ?>"><?php echo $data['district']; ?></option>
                            <?php }
                            $con = null; ?>
                        </select>
                        <div id="districtFeedback" class="invalid-feedback">
                            Please Select a District!
                        </div>
                    </div>
                </div>
                <button type="submit" name="create" class="btn btn-success pull-right">Create Customer</button>
            </form>
        </div>
    </div>
</div>
<?php include('../footer.php') ?>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/main.js"></script>
</body>
</html>