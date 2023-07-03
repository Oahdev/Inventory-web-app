<?php
$page_title = "Signup";
$page_header = "Inventory";
require "./header.php";
?>

<body>
    <div class="container-sm">
        <form id="signupForm" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Business name" required>
                <p id="business_name-error" style="color:red;font-size:x-small"></p>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                <p id="email-error" style="color:red;font-size:x-small"></p>
            </div>
            <div class="mb-3">    
                <select class="form-select form-select-sm" id="ucr" aria-label=".form-select-sm" name="user_currency" required>
                    <option selected>Select Preferred currency</option>
                    <option value="$">USD - $</option>
                    <option value="€">EUR - €</option>
                    <option value="£">GBP - £</option>
                    <option value="₦">NGN - ₦</option>
                    <option value="¥">JPY - ¥</option>
                </select>
                <p id="ucr-error" style="color:red;font-size:x-small"></p>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="pwd" id="Password" placeholder="Password" required>
                <p id="Password-error" style="color:red;font-size:x-small"></p>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="conpwd" id="conPassword" placeholder="Confirm Password" required>
                <p id="conPassword-error" style="color:red;font-size:x-small"></p>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary btn-lg" type="submit" id="loginBtn">Signup</button>
            </div>
            <div class="alter-option">
                <p>Already have an account?</p><a href="./">Login</a>
            </div>
            <div id="response"></div>
        </form>
    </div>
</body>

<?php require"./footer.php";?>
<script src="./js/signup.js"></script>
</html>