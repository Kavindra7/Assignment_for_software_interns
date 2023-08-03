(function () {
    'use strict'

    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})();

function searchFunction(colID,tableID) {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchKey");
    filter = input.value.toUpperCase();
    table = document.getElementById(tableID);
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[colID];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }

}


function confirmAction(){
    let text = "Are you sure?\nIt will permanently deleted !";
    

    if (confirm(text) == true) {
        return true;
    }else {
        return false;
    }
}

$(function () {
    $('input[name="daterange"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });
});

$('input[name="daterange"]').on('apply.daterangepicker', function (ev, picker) {
    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' : ' + picker.endDate.format('YYYY-MM-DD'));
    document.getElementById('date-filter').submit();
});

$('input[name="daterange"]').on('cancel.daterangepicker', function (ev, picker) {
    $(this).val('');
    window.location.href = 'index.php';
});


function ExportToExcel(report,type, fn, dl) {
    var elt = document.getElementById('report_table');
    var wb = XLSX.utils.table_to_book(elt, {sheet: "sheet1"});
    const d = new Date();
    let time = d.getTime();
    return dl ?
        XLSX.write(wb, {bookType: type, bookSST: true, type: 'base64'}) :
        XLSX.writeFile(wb, fn || (report+'_Report_'+time+'.' + (type || '')));
}