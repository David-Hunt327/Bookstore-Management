<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Transaction History</h2>
    </div>
</header>
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-12">
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
                        <td><?=$history->bookname?></td> <!-- Ensure this line is correct -->
                        <td><?=$history->book_qty?></td> <!-- Ensure this line is correct -->
                        <td>₦ <?=number_format($history->total)?></td>
                        <td><?=$history->user_name?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>