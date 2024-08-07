<header class="page-header">
    <div class="container-fluid">
        <h2 class="panel-title">Dashboard</h2>
    </div>
</header>
<div class="main-content">
    <?php if ($this->session->userdata('level') == 'admin') { ?>
    <section class="dashboard-counts no-padding-bottom">
        <div class="container-fluid">
            <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-4 col-sm-4">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-violet"><i class="fa fa-book"></i></div>
                        <a href="<?php echo base_url('index.php/books') ?>" class="text-secondary">
                            <div class="title"><span>Total Book</span></div>
                        </a>
                        <span class="number"><?php echo isset($total_books->total_books) ? $total_books->total_books : 0; ?></span>
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-4 col-sm-4">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-green"><i class="fa fa-dollar"></i></div>
                        <a href="<?php echo base_url('index.php/history') ?>" class="text-secondary">
                            <div class="title"><span>Earnings</span></div>
                        </a>
                        <span class="number">₦ <?php echo isset($total_transactions->total_transactions) ? ''.$total_transactions->total_transactions : '0'; ?></span>
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-3">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-info"><i class="fa fa-th-large" style="color: white;"></i></div>
                        <a href="<?php echo base_url('index.php/books') ?>" class="text-secondary">
                            <div class="title"><span>Stocks</span></div>
                        </a>
                        <span class="number"><?php echo isset($book_stock->book_stock) ? $book_stock->book_stock : 0; ?></span>
                    </div>
                </div>
            </div>
            <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-4 col-sm-4">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-warning"><i class="fa fa-bookmark" style="color: white;"></i></div>
                        <a href="<?php echo base_url('index.php/categories') ?>" class="text-secondary">
                            <div class="title"><span>Categories</span></div>
                        </a>
                        <span class="number"><?php echo isset($book_categories->book_categories) ? $book_categories->book_categories : 0; ?></span>
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-4 col-sm-4">
                    <div class="d-flex align-items-center">
                        <div class="icon bg-green"><i class="fa fa-hourglass"></i></div>
                        <a href="<?php echo base_url('index.php/history') ?>" class="text-secondary">
                            <div class="title"><span>Sales (24hrs)</span></div>
                        </a>
                        <span class="number">₦ <?php echo isset($sales_percentage->sales_percentage) ? ''.$sales_percentage->sales_percentage : '0'; ?></span>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-4">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-gray"><i class="fa fa-user-secret"></i></div>
                        <a href="<?php echo base_url('index.php/users') ?>" class="text-secondary">
                            <div class="title"><span>System Users</span></div>
                        </a>
                        <span class="number"><?php echo isset($system_users->system_users) ? $system_users->system_users : 0; ?></span>
                    </div>
                </div>
            </div
        </div>
    </section>
    <?php } elseif (($this->session->userdata('level') == 'cashier')) { ?>
        <section class="dashboard-counts no-padding-bottom">
        <div class="container-fluid">
            <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-4 col-sm-4">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-violet"><i class="fa fa-book"></i></div>
                        <a href="<?php echo base_url('index.php/books') ?>" class="text-secondary">
                            <div class="title"><span>Total Book</span></div>
                        </a>
                        <span class="number"><?php echo isset($total_books->total_books) ? $total_books->total_books : 0; ?></span>
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-4 col-sm-4">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-green"><i class="fa fa-dollar"></i></div>
                        <a href="<?php echo base_url('index.php/history') ?>" class="text-secondary">
                            <div class="title"><span>Earnings</span></div>
                        </a>
                        <span class="number">₦ <?php echo isset($total_transactions->total_transactions) ? ''.$total_transactions->total_transactions : '0'; ?></span>
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-3">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-info"><i class="fa fa-th-large" style="color: white;"></i></div>
                        <a href="<?php echo base_url('index.php/books') ?>" class="text-secondary">
                            <div class="title"><span>Stocks</span></div>
                        </a>
                        <span class="number"><?php echo isset($book_stock->book_stock) ? $book_stock->book_stock : 0; ?></span>
                    </div>
                </div>
            </div>
            <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-4 col-sm-4">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-warning"><i class="fa fa-bookmark" style="color: white;"></i></div>
                        <a href="<?php echo base_url('index.php/categories') ?>" class="text-secondary">
                            <div class="title"><span>Categories</span></div>
                        </a>
                        <span class="number"><?php echo isset($book_categories->book_categories) ? $book_categories->book_categories : 0; ?></span>
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-4 col-sm-4">
                    <div class="d-flex align-items-center">
                        <div class="icon bg-green"><i class="fa fa-hourglass"></i></div>
                        <a href="<?php echo base_url('index.php/history') ?>" class="text-secondary">
                            <div class="title"><span>Sales (24hrs)</span></div>
                        </a>
                        <span class="number">₦ <?php echo isset($sales_percentage->sales_percentage) ? ''.$sales_percentage->sales_percentage : '0'; ?></span>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-4">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-gray"><i class="fa fa-user-secret"></i></div>
                        <a href="<?php echo base_url('index.php/users') ?>" class="text-secondary">
                            <div class="title"><span>System Users</span></div>
                        </a>
                        <span class="number"><?php echo isset($system_users->system_users) ? $system_users->system_users : 0; ?></span>
                    </div>
                </div>
            </div
        </div>
    </section>
    <?php }?>
</div>