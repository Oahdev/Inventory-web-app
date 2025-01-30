<?php
$page_title = "Login";
$page_header = "Inventory";

require "./header.php";
?>

<body>
    <div class="container-sm">
        <form id="loginForm" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="email" class="form-control" name="login_email" id="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="login_password" id="pwd" placeholder="Password" required>
            </div>
            <div id="error-response" style="display: none; margin-top: 9px; padding: 6px; font-size: 15px; align-items:center;" class="alert alert-danger" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="18" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div></div>
            </div>
            <div id="success-response" style="display: none; margin-top: 9px; padding: 6px; font-size: 15px; align-items:center;" class="alert alert-success" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="18" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div></div>
            </div>
            <button class="btn btn-primary btn-lg" type="submit" id="loginBtn">Login</button>
            <div class="alter-option">
                <p>Don't have an account</p><a href="./signup.php">Signup</a>
            </div>
        </form>
    </div>
</body>
<?php require "./footer.php";?>
<script src="./js/login.js"></script>
</html>