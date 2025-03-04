<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Book Details</h2>
        </div>
    </header>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="container-fluid">
                <?php if ($this->session->flashdata('message') != null) { echo "<br><div class='alert alert-success alert-dismissible fade show' role='alert'>" . $this->session->flashdata('message') . "<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button> </div>"; } ?>
                <br>
                <a href="#add" data-toggle="modal" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add New Book</a>
                <br><br>
                <input type="text" id="searchInput" class="form-control" placeholder="Search by Book Title, Category, or Author">
                <br>
                <table class="table table-hover table-bordered" id="example" ui-options=ui-options="{ &quot;paging&quot;: { &quot;enabled&quot;: true }, &quot;filtering&quot;: { &quot;enabled&quot;: true }, &quot;sorting&quot;: { &quot;enabled&quot;: true }}">
                    <thead style="background-color: #464b58; color:white;">
                        <tr>
                            <td>#</td>
                            <td>Book Title</td>
                            <td>Year</td>
                            <td>Price</td>
                            <td>Category</td>
                            <td>Publisher</td>
                            <td>Author</td>
                            <td>Stock</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody style="background-color: white;">
                        <?php $no = 0; foreach ($display_books as $book) : $no++; ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><?=$book->book_title?></td>
                            <td><?=$book->year?></td>
                            <td>₦ <?=number_format($book->price)?></td>
                            <td><?=$book->category_name?></td>
                            <td><?=$book->publisher?></td>
                            <td><?=$book->author?></td>
                            <td><?=$book->stock?></td>
                            <td>
                                <a href="#edit" onclick="edit('<?=$book->book_code?>')" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa fa-pencil"></i></a>
                                <a href="<?=base_url('index.php/books/delete/'.$book->book_code)?>" onclick="return confirm('Confirm to delete this book?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div id="noResults" class="alert alert-warning" style="display: none;">No results found</div>
                <br/>
            </div>
        </div>
    </div>

    <!-- Add Book Modal -->
    <div class="modal" id="add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Add New Book
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>
                </div>
                <form action="<?=base_url('index.php/books/add')?>" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Book Title</label></div>
                            <div class="col-sm-7">
                                <input type="text" name="book_title" required="form-control" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Year</label></div>
                            <div class="col-sm-7">
                                <input type="number" name="year" required="form-control" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Price</label></div>
                            <div class="col-sm-7">
                                <input type="number" name="price" required="form-control" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Category</label></div>
                            <div class="col-sm-7">
                                <select name="category_code" required="form-control" class="form-control">
                                    <?php foreach ($categories as $category): ?>
                                    <option value="<?=$category->category_code?>"> <?=$category->category_name ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Publisher</label></div>
                            <div class="col-sm-7">
                                <input type="text" name="publisher" required="form-control" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Author</label></div>
                            <div class="col-sm-7">
                                <input type="text" name="author" required="form-control" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Stock</label></div>
                            <div class="col-sm-7">
                                <input type="number" name="stock" required="form-control" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" name="save" value="Save" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Book Modal -->
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Update Book
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>
                </div>
                <form action="<?=base_url('index.php/books/update')?>" method="post">
                    <input type="hidden" name="book_code" id="book_code">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Book Title</label></div>
                            <div class="col-sm-7">
                                <input type="text" name="book_title" id="book_title" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Year</label></div>
                            <div class="col-sm-7">
                                <input type="number" name="year" id="year" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Price</label></div>
                            <div class="col-sm-7">
                                <input type="number" name="price" id="price" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Category</label></div>
                            <div class="col-sm-7">
                                <select name="category_code" id="category" class="form-control">
                                    <?php foreach ($categories as $category): ?>
                                    <option value="<?=$category->category_code?>"> <?=$category->category_name ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Publisher</label></div>
                            <div class="col-sm-7">
                                <input type="text" name="publisher" id="publisher" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Author</label></div>
                            <div class="col-sm-7">
                                <input type="text" name="author" id="author" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Stock</label></div>
                            <div class="col-sm-7">
                                <input type="number" name="stock" id="stock" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" name="save" value="Save" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });

        function edit(a) {
            $.ajax({
                type: "post",
                url: "<?=base_url()?>index.php/books/edit/" + a,
                dataType: "json",
                success: function(data) {
                    $("#book_code").val(data.book_code);
                    $("#book_title").val(data.book_title);
                    $("#year").val(data.year);
                    $("#price").val(data.price);
                    $("#category").val(data.category_code);
                    $("#publisher").val(data.publisher);
                    $("#author").val(data.author);
                    $("#stock").val(data.stock);
                }
            });
        }

        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();
            var table = document.getElementById('example');
            var tr = table.getElementsByTagName('tr');
            var noResults = document.getElementById('noResults');
            var found = false;

            for (var i = 1; i < tr.length; i++) {
                var tdTitle = tr[i].getElementsByTagName('td')[1];
                var tdCategory = tr[i].getElementsByTagName('td')[4];
                var tdAuthor = tr[i].getElementsByTagName('td')[6];
                if (tdTitle || tdCategory || tdAuthor) {
                    var titleText = tdTitle.textContent || tdTitle.innerText;
                    var categoryText = tdCategory.textContent || tdCategory.innerText;
                    var authorText = tdAuthor.textContent || tdAuthor.innerText;
                    if (titleText.toLowerCase().indexOf(filter) > -1 || categoryText.toLowerCase().indexOf(filter) > -1 || authorText.toLowerCase().indexOf(filter) > -1) {
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