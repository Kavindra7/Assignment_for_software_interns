<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assignment || Invoice Reports</title>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/moment.min.js"></script>
    <script src="../../js/daterangepicker.js"></script>
    <script src="../../js/xlsx.full.min.js"></script>
    <link href="../../css/daterangepicker.css" rel="stylesheet">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
<body>
<div class="m-lg-4"><a href="../" class="crad-link text-secondary">All Reports</a> / Invoice Reports</div>

<div class="container w-100">
    <div class="row">
        <div class="col-lg-4">
            <form action="<?php $_PHP_SELF ?>" method="GET" id="date-filter">
                <input type="text" class="form-control" name="daterange" id="daterange"
                       value="<?php echo isset($_GET['daterange']) ? $_GET['daterange'] : '' ?>"
                       placeholder="Search Dates">
            </form>
        </div>
        <div class="col-lg-8">
            <button onclick="ExportToExcel('Invoice','xlsx')" class="btn btn-secondary pull-right"><i
                        class="fa fa-download"></i></button>
        </div>
    </div>

    <div class="table-screen">
        <table class="table table-hover table-bordered mt-3" id="report_table">
            <thead class="table-dark">
            <tr>
                <th scope="col">Invoice number</th>
                <th scope="col">Date</th>
                <th scope="col">Customer name</th>
                <th scope="col">Customer district</th>
                <th scope="col">Item count</th>
                <th scope="col">Invoice amount</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require "../../dbconnection.php";


            if (isset($_GET['daterange'])) {
                $date = explode(":", str_replace(' ', '', $_GET['daterange']));
                $fromDate = $date[0];
                $toDate = $date[1];

                $sql1 = "SELECT invoice.*,customer.*, district.district FROM invoice 
                        LEFT JOIN customer ON invoice.customer = customer.id
                        LEFT JOIN district ON customer.district = district.id  
                        WHERE invoice.date  BETWEEN '$fromDate' AND '$toDate'
                        ";
            } else {
                $sql1 = "SELECT invoice.*,customer.*, district.district FROM invoice 
                        LEFT JOIN customer ON invoice.customer = customer.id
                        LEFT JOIN district ON customer.district = district.id";
            }

            $select1 = $con->prepare($sql1);
            $select1->execute();
            while ($data = $select1->fetch()) {
                ?>
                <tr>
                    <th scope="row"> <?php echo $data['invoice_no']; ?></th>
                    <td><?php echo $data['date']; ?></td>
                    <td><?php echo $data['title'] . "." . $data['first_name'] . " " . $data['last_name']; ?></td>
                    <td><?php echo $data['district']; ?></td>
                    <td><?php echo $data['item_count']; ?></td>
                    <td><?php echo number_format($data['amount'], 2); ?></td>
                </tr>
            <?php }
            $con = null; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('../../footer.php') ?>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/main.js"></script>
</body>
</html>