<?php
$page_title = "Report Issue";
$page_header = "";
require "./header.php";

?>
<body>
    <div class="container-sm">
        <p id="exit">&times;</p>
        <form method="post" autocomplete="off" enctype="multipart/form-data" id="reportForm">
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="mb-3">
                <label for="issue">Issue:</label>
                <textarea name="issue" class="form-control" id="issue" cols="30" rows="10" maxlength="600000" required></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-lg" id="reportBtn">Submit</button>
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
    </div>
</body>

<?php
require "./footer.php";
?>
<script src="./js/report-issue.js"></script>