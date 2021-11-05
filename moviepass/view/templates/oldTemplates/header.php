<!doctype html>
<html lang="en" class="h-100">

<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <title><?php echo PAGE_TITLE; ?></title>

     <!-- Bootstrap -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

     <!-- Bootstrap core CSS -->
     <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
          .bd-placeholder-img {
               font-size: 1.125rem;
               text-anchor: middle;
               -webkit-user-select: none;
               -moz-user-select: none;
               -ms-user-select: none;
               user-select: none;
          }

          @media (min-width: 768px) {
               .bd-placeholder-img-lg {
                    font-size: 3.5rem;
               }
          }
     </style>

     <!-- Custom styles for this template -->
     <link href="<?php echo CSS_PATH ?>sticky-footer-navbar.css" rel="stylesheet">

     <script>
          <?php if (!empty($alerts)) { ?>
               alert("<?php foreach ($alerts as $alert) echo $alert . '\n'; ?>");
          <?php } ?>
     </script>
</head>