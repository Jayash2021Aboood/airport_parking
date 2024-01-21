<?php
// لاستخدام الجلسات في الصفحة 
  session_start();
//    استدعاء الملف المحتوي الدوال لأستخدامها في الصفحة
  include('includes/lib.php');
  $pageTitle = "KsaEvent";

  ?>
<!-- استدعاء رأس الصفحة -->
<?php include('template/header.php'); ?>
<!-- استدعاء القائمة العلوية -->
<?php include('template/navbar.php'); ?>


<!-- محتوى الصفحة -->
<main class="page faq-page">
    <section class="clean-block clean-faq dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-danger">Not Found</h2>
                <p>
                    <!-- عرض الخطأ من متغر الجلسة -->
                    <?php echo $_SESSION['message']; ?>
                </p>
            </div>
        </div>
    </section>
</main>

<!-- اسندعاء الفوتر (القائمة السفلية)  -->
<?php include('template/footer.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    hello
</body>

</html>