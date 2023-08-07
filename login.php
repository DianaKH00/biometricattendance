<?php
session_start();
if (isset($_SESSION['Admin-name'])) {
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Кіру</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="icons/ic.png">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="js/jquery-2.2.3.min.js"></script>
    <script>
      $(window).on("load resize ", function() {
          var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
          $('.tbl-header').css({'padding-right':scrollWidth});
      }).resize();
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(document).on('click', '.message', function(){
          $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
          $('h1').animate({height: "toggle", opacity: "toggle"}, "slow");
        });
      });
    </script>
</head>
<body>
<?php include'header.php'; ?>
<main>
  <h1 class="slideInDown animated">Администратордың логин және e-mail-мен кіріңіз</h1>
  <h1 class="slideInDown animated" id="reset">Құпия сөзді қалпына келтіру сілтемесін жіберу үшін электрондық пошта мекенжайын енгізіңіз</h1>
<section>
  <div class="slideInDown animated">
    <div class="login-page">
      <div class="form">
        <?php
          if (isset($_GET['error'])) {
            if ($_GET['error'] == "invalidEmail") {
                echo '<div class="alert alert-danger">
                        E-mail қате!
                      </div>';
            }
            elseif ($_GET['error'] == "sqlerror") {
                echo '<div class="alert alert-danger">
                        ДҚ дұрыс емес!!
                      </div>';
            }
            elseif ($_GET['error'] == "wrongpassword") {
                echo '<div class="alert alert-danger">
                        Пароль дұрыс емес!!
                      </div>';
            }
            elseif ($_GET['error'] == "nouser") {
                echo '<div class="alert alert-danger">
                        Мұндай E-mail жоқ!!
                      </div>';
            }
          }
          if (isset($_GET['reset'])) {
            if ($_GET['reset'] == "success") {
                echo '<div class="alert alert-success">
                        E-mail дұрыс емес!
                      </div>';
            }
          }
          if (isset($_GET['account'])) {
            if ($_GET['account'] == "activated") {
                echo '<div class="alert alert-success">
                        Логин бос
                      </div>';
            }
          }
          if (isset($_GET['active'])) {
            if ($_GET['active'] == "success") {
                echo '<div class="alert alert-success">
                        Хабарлама жіберілді!
                      </div>';
            }
          }
        ?>
        <div class="alert1"></div>
        <form class="reset-form" action="reset_pass.php" method="post" enctype="multipart/form-data">
          <input type="email" name="email" placeholder="E-mail..." required/>
          <button type="submit" name="reset_pass">Reset</button>
          <p class="message"><a href="#">Кіру</a></p>
        </form>
        <form class="login-form" action="ac_login.php" method="post" enctype="multipart/form-data">
          <input type="email" name="email" id="email" placeholder="E-mail..." required/>
          <input type="password" name="pwd" id="pwd" placeholder="Пароль" required/>
          <button type="submit" name="login" id="login">Кіру</button>
          <!-- <p class="message">Парольді ұмыттыңыз ба? <a href="#">Парольді жою</a></p> -->
        </form>
      </div>
    </div>
  </div>
</section>
</main>
</body>
</html>