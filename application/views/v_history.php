<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Transaction History</h2>
        </div>
    </header>
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-md-12">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by Date or Customer Name">
                <br>
                <table class="table table-hover table-bordered" id="example" ui-options=ui-options="{ &quot;paging&quot;: { &quot;enabled&quot;: true }, &quot;filtering&quot;: { &quot;enabled&quot;: true }, &quot;sorting&quot;: { &quot;enabled&quot;: true }}">
                    <thead style="background-color: #464b58; color:white;">
                        <tr>
                            <td>#</td>
                            <td>Customer's Name</td>
                            <td>Date</td>
                            <td>Book</td>
                            <td>Qty</td>
                            <td>Amount</td>
                            <td>Cashier</td>
                        </tr>
                    </thead>
                    <tbody style="background-color: white;">
                        <?php $no = 0; foreach ($display_history as $history) : $no++; ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><?=$history->buyer_name?></td>
                            <td><?=$history->date?></td>
                            <td><?=$history->bookname?></td>
                            <td><?=$history->book_qty?></td>
                            <td>₦ <?=number_format($history->total)?></td>
                            <td><?=$history->user_name?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div id="noResults" class="alert alert-warning" style="display: none;">No results found</div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();
            var table = document.getElementById('example');
            var tr = table.getElementsByTagName('tr');
            var noResults = document.getElementById('noResults');
            var found = false;

            for (var i = 1; i < tr.length; i++) {
                var tdDate = tr[i].getElementsByTagName('td')[2];
                var tdCustomer = tr[i].getElementsByTagName('td')[1];
                if (tdDate || tdCustomer) {
                    var dateText = tdDate.textContent || tdDate.innerText;
                    var customerText = tdCustomer.textContent || tdCustomer.innerText;
                    if (dateText.toLowerCase().indexOf(filter) > -1 || customerText.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        found = true;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }

            if (!found) {
                noResults.style.display = "block";
            } else {
                noResults.style.display = "none";
            }
        });
    </script>
</body>
</html>