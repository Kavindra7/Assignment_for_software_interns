<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assignment || Item Reports</title>

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
<div class="m-lg-4"><a href="../" class="crad-link text-secondary">All Reports</a> / Item Reports</div>

<div class="container w-100">
    <div class="row">
        <div class="col-lg-4">
            <input type="text" class="form-control" id="searchKey" onkeyup="searchFunction(0,'report_table')"
                   placeholder="Search By Item Name">
        </div>
        <div class="col-lg-8">
            <button onclick="ExportToExcel('Items','xlsx')" class="btn btn-secondary pull-right"><i
                        class="fa fa-download"></i></button>
        </div>
    </div>

    <div class="table-screen">
        <table class="table table-hover table-bordered mt-3" id="report_table">
            <thead class="table-dark">
            <tr>
                <th scope="col">Item name</th>
                <th scope="col">Item category</th>
                <th scope="col">Item sub category</th>
                <th scope="col">Quantity</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require "../../dbconnection.php";

            $sql1 = "SELECT item.*,item_category.category,item_subcategory.sub_category FROM item 
                    LEFT JOIN item_category ON item.item_category = item_category.id
                    LEFT JOIN item_subcategory ON item.item_subcategory = item_subcategory.id";
            $select1 = $con->prepare($sql1);
            $select1->execute();
            $itemName = [];
            while ($data = $select1->fetch()) {
                if (!in_array($data['item_name'], $itemName)) {
                    $itemName[] = $data['item_name'];
                    ?>
                    <tr>
                        <td><?php echo $data['item_name']; ?></td>
                        <td><?php echo $data['category']; ?></td>
                        <td><?php echo $data['sub_category']; ?></td>
                        <td><?php echo $data['quantity']; ?></td>
                    </tr>
                <?php }
            }
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