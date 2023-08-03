<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assignment</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
<body>
<h2 class="m-lg-4">Hi, Welcome User</h2>

<div class="container d-flex align-items-center justify-content-center">

    <div class="row w-100">
        <div class="col-lg-4">
            <a href="customer/" class="crad-link">
                <div class="card">
                    <div class="card-body align-items-center text-center">
                        <div class="icon">
                            <i class="fa-solid fa-users "></i>
                        </div>
                        <h4><b>Customers</b></h4>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4">
            <a href="item/" class="crad-link">
                <div class="card">
                    <div class="card-body align-items-center text-center">
                        <div class="icon">
                            <i class="fa-solid fa-list "></i>
                        </div>
                        <h4><b>Items</b></h4>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4">
            <a href="reports/" class="crad-link">
                <div class="card">
                    <div class="card-body align-items-center text-center">
                        <div class="icon">
                            <i class="fa-solid fa-file-invoice"></i>
                        </div>
                        <h4><b>Reports</b></h4>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

<?php include('footer.php') ?>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>