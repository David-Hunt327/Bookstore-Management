<h2>Transaction Note</h2>
Transaction No. : <?=$transactions->transaction_code?><br>
Cashier : <?=$transactions->user_name?><br>
Customer : <?=$transactions->buyer_name?><br>
Date : <?=$transactions->date?>
<table border="1" style="border-collapse: collapse;">
    <tr>
        <th>No</th>
        <th>Book Title</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Subtotal</th>
    </tr>
    <?php $no = 0; foreach ($transaction_details as $book): $no++; ?>
    <tr>
        <th><?=$no?></th>
        <th><?=$book->book_title?></th>
        <th><?= number_format($book->price)?></th>
        <th><?=$book->quantity?></th>
        <th><?= number_format(($book->price * $book->quantity))?></th>
    </tr>
    <?php endforeach ?>
    <tr>
        <th colspan="4">Total</th>
        <th><?= number_format($transactions->total)?></th>
    </tr>
</table>
<script type="text/javascript">
    window.print();
    // location.href="<?=base_url('index.php/transactions/clearcart')?>";
</script>