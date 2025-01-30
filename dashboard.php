<?php
require "./api/check-cookie.api.php";
$page_title = $business_name;
$page_header = "";
require "./header.php";


?>

<body class="container-fluid">
    <nav>
        <h1><?php echo strtoupper($business_name);?></h1>
        <div id="menuBtn">
            <div id="line"></div>
            <div id="line"></div>
            <div id="line"></div>
        </div>
        <div class="dropdown">
            <div id="navAccountDrop">
                <a href="./">Login</a>
                <a href="./signup.php">Create Account</a>
                <button id="logout_button">Logout</button>
                <div id="logout_option">
                    <p>Are you sure?</p>
                    <form method="post" enctype="multipart/form-data" id="logoutBtn">
                        <button type="submit" id="logout_option_button">Yes</button>
                    </form>
                    <button id="logout_option_button">No</button>
                </div>
            </div>
        </div>
    </nav>
    <form id="add-productForm" autocomplete="off"  method="post" enctype="multipart/form-data" class="form-stacked">
        <div class="mb-3">
            <label for="Pn">Product name:</label>
            <input type="text" class="form-control" name="productName" id="Pn" required>
        </div><br>
        <div class="mb-3">
            <label for="QiS">Quantity in stock:</label>
            <input type="number" class="form-control" name="QuantityInStock" id="QiS" required>
        </div><br>
        <div class="mb-3">
            <label for="PpI">Price per item:</label>
            <input type="number" class="form-control" step="0.01" name="PricePerItem" id="PpI" required>
        </div><br>
        <input type="number" name="editRow" id="Er" value="" hidden>
        <div class="submit-Btn">
            <button class="btn btn-primary btn-lg" id="addProductBtn" type="submit">Add Product</button>
            <button class="btn btn-primary btn-lg" id="cancel-edit-btn">Cancel Edit</button>
        </div>
    </form>
    <div id="error-response" style="display: none; margin-top: 9px; padding: 6px; font-size: 15px; align-items:center;" class="alert alert-danger" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="18" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div></div>

    </div>
    <div id="success-response" style="display: none; margin-top: 9px; padding: 6px; font-size: 15px; align-items:center;" class="alert alert-success" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="18" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div></div>

    </div>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total value</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="table_body">
            
        
        </tbody>
    </table>
    <div id="total_estimation">
        <ul>
            <li>
                <p>Total Products</p>
                <p></p>
            </li>
            <li>
                <p>Total Products Quantity</p>
                <p></p>
            </li>
            <li>
                <p>Total Cost</p>
                <p></p>
            </li>
        </ul>
    </div>
    

</body>
<script src="./js/dashboard.js"></script>
<?php require "./footer.php";?>
</html>