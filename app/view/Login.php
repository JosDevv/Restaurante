<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.:Restaurante:.</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>
<body class="bg-dark">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Login</h3>
                    </div>   
                    <div class="card-body">
                        <form id="loginform" action="">

                        <div class="input-group flex-nowrap mb-4">
                            <input type="text" name="nombre" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                        </div>
                        <div class="input-group flex-nowrap mb-4">
                            <input type="password" name="pass" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping">
                        </div>
                        <div class="alert alert-danger d-none" role="alert" id="mensaje"> 
                        </div>
                        <div class="d-grid gap-2 mb-4">
                        <button class="btn btn-primary btn btn-primary btn-lg btn-block" type="submit">Login</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</body>
<script src="<?php echo URL; ?>public_html/js/login.js"></script>
<script src="<?php echo URL; ?>public_html/js/api.js"></script>
</html>