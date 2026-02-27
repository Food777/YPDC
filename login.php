<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Absensi Siswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" 
          crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100">
        <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <div class="card shadow-lg p-5">
                <h2 class="card-title text-center mb-4">Login Data Siswa YPDC</h2>

                <form method="POST" action="login1.php">
                    <div class="mb-4">
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="Username..." required autofocus>
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Password..." required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" 
        crossorigin="anonymous"></script>
</body>
</html>