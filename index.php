<?php
include 'koneksi.php'; // Menghubungkan ke database
?>

<!DOCTYPE html>
<html lang="en">

<!-- Include Header -->
<?php include 'layout-header.php'; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Include Sidebar -->
        <?php include 'layout-sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Include Topbar -->
                <?php include 'layout-topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="customer.php" class="text-decoration-none">
                                <div class="card shadow p-4 text-center border-0 bg-light hover-effect card-fixed">
                                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                    <h6 class="text-dark">Data Customer</h6>
                                    <p class="text-muted">Lihat dan kelola data kasus terbaru.</p>
                                    <button class="btn btn-primary mt-2">Lihat Detail</button>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="item.php" class="text-decoration-none">
                                <div class="card shadow p-4 text-center border-0 bg-light hover-effect card-fixed">
                                    <i class="fas fa-box fa-3x text-success mb-3"></i>
                                    <h6 class="text-dark">Data Item</h6>
                                    <p class="text-muted">Kelola informasi item</p>
                                    <button class="btn btn-success mt-2">Lihat Detail</button>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="sales.php" class="text-decoration-none">
                                <div class="card shadow p-4 text-center border-0 bg-light hover-effect card-fixed">
                                    <i class="fas fa-book fa-3x text-danger mb-3"></i>
                                    <h6 class="text-dark">Data Sales</h6>
                                    <p class="text-muted">Manajemen sales lebih efisien.</p>
                                    <button class="btn btn-danger mt-2">Lihat Detail</button>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="user.php" class="text-decoration-none">
                                <div class="card shadow p-4 text-center border-0 bg-light hover-effect card-fixed">
                                    <i class="fas fa-user fa-3x text-primary mb-3"></i>
                                    <h6 class="text-dark">Data User</h6>
                                    <p class="text-muted">Lihat dan kelola data kasus terbaru.</p>
                                    <button class="btn btn-primary mt-2">Lihat Detail</button>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="transaction.php" class="text-decoration-none">
                                <div class="card shadow p-4 text-center border-0 bg-light hover-effect card-fixed">
                                    <i class="fas fa-pen fa-3x text-success mb-3"></i>
                                    <h6 class="text-dark">Data Item</h6>
                                    <p class="text-muted">Kelola informasi item</p>
                                    <button class="btn btn-success mt-2">Lihat Detail</button>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Include Footer -->
            <?php include 'layout-footer.php'; ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</div>

<!-- Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>