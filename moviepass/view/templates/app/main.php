<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title><?php echo PAGE_TITLE; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>bootstrap 5.0.2/bootstrap.min.css">

    <!-- Custom styles for this page -->
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>app.css">
</head>

<body>
    <!-- Loader -->
    <div class="loading-screen" id="loading-screen">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div id="cookie_warning_container">
      <div id="toast-wrapper" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="cookies-toast" class="toast" role="alert" data-autohide="false" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body">
                        <h4>Cookie Warning</h4>
                        <p>This website stores data such as cookies to enable site functionality including analytics and personalization. By using this website, you automatically accept that we use cookies.</p>
                        <div class="ml-auto">
                            <button id="cookiesAccept" type="button" class="btn btn-light">Accept</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <header>
        <!-- Navbar -->
        <nav id="navbar" class="navbar navbar-expand-md navbar-dark bg-dark"></nav>
    </header>

    <br>

    <!-- Begin page content -->
    <main id="main" class="container">
        <h2>Default content</h2>
    </main>

    <br>

    <footer class="footer">
        <div class="container">
            <span class="text-muted">
                <p>Designed by GroupThree</p>
            </span>
        </div>
    </footer>

    <!-- Placed at the end of the document so the pages load faster -->
    <script type="module" src="<?php echo JS_PATH; ?>app/main.mjs"></script>
</body>

</html>
