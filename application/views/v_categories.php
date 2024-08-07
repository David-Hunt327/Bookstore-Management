<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Category</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Book Category</h2>
        </div>
    </header>
    <div class="container-fluid">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <?php if ($this->session->userdata('level') == "admin"): { } ?>
                <?php if ($this->session->flashdata('message') != null) { echo "<br><div class='alert alert-success alert-dismissible fade show' role='alert'>" . $this->session->flashdata('message') . "<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button> </div>"; } ?>
                <?php elseif ($this->session->userdata('level') == "cashier"): { } ?>
                <?php endif ?>
                <br>
                <a href="#add" data-toggle="modal" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add New Category</a>
                <br><br>
                <input type="text" id="searchInput" class="form-control" placeholder="Search by Category Code or Name">
                <br>
                <table class="table table-hover table-bordered" id="example" ui-options=ui-options="{ &quot;paging&quot;: { &quot;enabled&quot;: true }, &quot;filtering&quot;: { &quot;enabled&quot;: true }, &quot;sorting&quot;: { &quot;enabled&quot;: true }}">
                    <thead style="background-color: #464b58; color:white;">
                        <tr>
                            <td>#</td>
                            <td>Category Code</td>
                            <td>Category Name</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody style="background-color: white;">
                        <?php $no = 0; foreach ($display_categories as $category) : $no++; ?>
                        <tr>
                            <td><?=$no?></td>
                            <td>#CA<?=$category->category_code?></td>
                            <td><?=$category->category_name?></td>
                            <td>
                                <a href="#edit" onclick="edit('<?=$category->category_code?>')" class="btn btn-success btn-sm" data-toggle="modal">Edit</a>
                                <a href="<?=base_url('index.php/categories/delete/'.$category->category_code)?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div id="noResults" class="alert alert-warning" style="display: none;">No results found</div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal" id="add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Add New Category
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>
                </div>
                <form action="<?=base_url('index.php/categories/add')?>" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Category Code</label></div>
                            <div class="col-sm-7">
                                <input type="number" name="category_code" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Category Name</label></div>
                            <div class="col-sm-7">
                                <input type="text" name="category_name" required class="form-control">
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

    <!-- Edit Category Modal -->
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Edit Category
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>
                </div>
                <form action="<?=base_url('index.php/categories/update')?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="old_category_code" id="old_category_code">
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Category Code</label></div>
                            <div class="col-sm-7">
                                <input type="number" name="category_code" id="category_code" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 offset-1"><label>Category Name</label></div>
                            <div class="col-sm-7">
                                <input type="text" name="category_name" id="category_name" required class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" name="edit" value="Save" class="btn btn-success">
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
                url: "<?=base_url()?>index.php/categories/edit/" + a,
                dataType: "json",
                success: function(data) {
                    $("#category_code").val(data.category_code);
                    $("#category_name").val(data.category_name);
                    $("#old_category_code").val(data.category_code);
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
                var tdCode = tr[i].getElementsByTagName('td')[1];
                var tdName = tr[i].getElementsByTagName('td')[2];
                if (tdCode || tdName) {
                    var codeText = tdCode.textContent || tdCode.innerText;
                    var nameText = tdName.textContent || tdName.innerText;
                    if (codeText.toLowerCase().indexOf(filter) > -1 || nameText.toLowerCase().indexOf(filter) > -1) {
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