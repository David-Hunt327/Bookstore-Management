<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Sales Transaction</h2>
    </div>
</header>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7">
            <table class="table table-hover table-bordered" id="example" style="background-color: #eef9f0;">
                <thead style="background-color: #464b58; color:white;">
                    <tr>
                        <th>#</th>
                        <th>Book Title</th>
                        <td>Category</td>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Act.</th>
                    </tr>
                </thead>
                <tbody style="background-color: white;">
                    <?php $no = 0; foreach ($display_books as $book): $no++; ?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?=$book->book_title?></td>
                        <td><?=$book->category_name?></td>
                        <td>₦ <?=$book->price?></td>
                        <td><?=$book->stock?></td>
                        <td><a href="<?=base_url('index.php/transactions/addcart/'.$book->book_code)?>"><button class="btn btn-success btn-sm"><span class="fa fa-shopping-cart" aria-hidden="true"></span></button></a></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <form action="<?=base_url('index.php/transactions/save')?>" method="post">
                Cashier : 
                <select name="user_code" class="form-control">
                    <option value="">Please Select . . .</option>
                    <?php foreach ($transactions as $transaction): ?>
                    <option value="<?=$transaction->user_code?>"><?=$transaction->user_name?></option>
                    <?php endforeach ?>
                </select>
                Customer's Name : 
                <input type="text" name="buyer_name" class="form-control"><br>
                <table class="table table-hover" id="example" style="background-color: white;">
                    <thead style="background-color:#636363; color:white;">
                        <tr>
                            <td>#</td>
                            <td>Title</td>
                            <td>Qty</td>
                            <td>Price</td>
                            <td>Subtotal</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <?php $no = 0; foreach ($this->cart->contents() as $items): $no++; ?>
                    <input type="hidden" name="book_code[]" value="<?=$items['id']?>">
                    <input type="hidden" name="rowid[]" value="<?=$items['rowid']?>">
                    <tr>
                        <td><?=$no?></td>
                        <td><?=$items['name']?></td>
                        <td width="1"><input type="text" name="qty[]" value="<?=$items['qty']?>" class="form-control" style="padding:4px;"></td>
                        <td>₦ <?=number_format($items['price'])?></td>
                        <td>₦ <?=number_format($items['subtotal'])?></td>
                        <td><a href="<?=base_url('index.php/transactions/delete_cart/'.$items['rowid'])?>" class="btn btn-danger btn-sm"><span class="fa fa-trash" aria-hidden="true"></span></a></td>
                    </tr>
                    <input type="hidden" name="bookname[]" value="<?=$items['name']?>">
                    <input type="hidden" name="book_qty[]" value="<?=$items['qty']?>">
                    <?php endforeach ?>
                    <input type="hidden" name="total" value="<?=$this->cart->total()?>">
                    <th colspan="4">Total Amount</th>
                    <th>₦<?=number_format($this->cart->total())?></th>
                    <th></th>
                </table>
                <div class="text-center">
                    <input type="submit" name="update" value="Update Quantity" class="btn btn-info">
                    <input type="submit" name="pay" class="btn btn-success" value="Pay">
                    <a class="btn btn-danger" href="<?=base_url('index.php/transactions/clearcart')?>">Clear Cart</a>
                </div>
            </form>
            <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert"><?= $this->session->flashdata('message');?><button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button> </div>
            <?php endif ?>
        </div>
    </div>
</div>

<!-- Modal for Receipt -->
<div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Transaction Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="receiptContent">
                <!-- Receipt content will be loaded here via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="printReceipt()">Print</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function showReceipt(receipt_id) {
        $.ajax({
            url: "<?=base_url('index.php/transactions/receipt/')?>" + receipt_id,
            method: "GET",
            dataType: "json",
            success: function(data) {
                var receiptContent = `
                    <h2>Transaction Note</h2>
                    Transaction No. : ${data.transactions.transaction_code}<br>
                    Cashier : ${data.transactions.user_name}<br>
                    Customer : ${data.transactions.buyer_name}<br>
                    Date : ${data.transactions.date}
                    <table border="1" style="border-collapse: collapse;">
                        <tr>
                            <th>No</th>
                            <th>Book Title</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Subtotal</th>
                        </tr>`;
                var no = 0;
                data.transaction_details.forEach(function(book) {
                    no++;
                    receiptContent += `
                        <tr>
                            <th>${no}</th>
                            <th>${book.book_title}</th>
                            <th>${number_format(book.price)}</th>
                            <th>${book.quantity}</th>
                            <th>${number_format(book.price * book.quantity)}</th>
                        </tr>`;
                });
                receiptContent += `
                        <tr>
                            <th colspan="4">Total</th>
                            <th>${number_format(data.transactions.total)}</th>
                        </tr>
                    </table>`;
                $('#receiptContent').html(receiptContent);
                $('#receiptModal').modal('show');
            }
        });
    }

    function printReceipt() {
        var printContent = document.getElementById('receiptContent').innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        location.href = "<?=base_url('index.php/transactions/clearcart')?>";
    }

    function number_format(number, decimals = 2, dec_point = '.', thousands_sep = ',') {
        number = parseFloat(number).toFixed(decimals);
        var nstr = number.toString();
        var x = nstr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? dec_point + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');
        }
        return x1 + x2;
    }
</script>