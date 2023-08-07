<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Пайдаланушыларды басқару</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="icon" type="image/png" href="icons/ic.png">
	<link rel="stylesheet" type="text/css" href="css/manageusers.css">

    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="js/bootbox.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
	<script src="js/manage_users.js"></script>
	<script>
	  	$(window).on("load resize ", function() {
		    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
		    $('.tbl-header').css({'padding-right':scrollWidth});
		}).resize();

	  $(document).ready(function(){
	  	  $.ajax({
	        url: "manage_users_up.php"
	        }).done(function(data) {
	        $('#manage_users').html(data);
	      });
	    setInterval(function(){
	      $.ajax({
	        url: "manage_users_up.php"
	        }).done(function(data) {
	        $('#manage_users').html(data);
	      });
	    },5000);
	  });
	</script>
</head>
<body>
<?php include'header.php';?>
<main>
	<h1 class="slideInDown animated">Жаңа пайдаланушыны қосу немесе олардың ақпаратын жаңарту <br> немесе өшіру</h1>
	<div class="form-style-5 slideInDown animated">
		<form enctype="multipart/form-data">
			<fieldset>
				<label for="Device"><b>Пайдаланушы бөлімі:</b></label>
                    <select name="dev_sel" id="dev_sel" style="color: #000;">
                      <option value="0">Барлық бөлімдер</option>
                      <?php
                        require'connectDB.php';
                        $sql = "SELECT * FROM devices ORDER BY device_name ASC";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo '<p class="error">SQL Error</p>';
                        }
                        else{
                            mysqli_stmt_execute($result);
                            $resultl = mysqli_stmt_get_result($result);
                            while ($row = mysqli_fetch_assoc($resultl)){
                      ?>
                              <option value="<?php echo $row['id'];?>"><?php echo $row['device_dep']; ?></option>
                      <?php
                            }
                        }
                      ?>
                    </select>
			<legend><span class="number">1</span> Пайдаланушының саусақ ізі ID нөмірі:</legend>
				<label>Саусақ ізінің ID нөмірін 1 мен 127 сан аралығында таңдаңыз:</label>
				<input type="number" name="fingerid" id="fingerid" placeholder="Пайдаланушының саусақ ізі ID...">
				<button type="button" name="fingerid_add" class="fingerid_add">Саусақ ізі ID нөмірін енгізу</button>
			</fieldset>
			<div class="alert">
				<label id="alert"></label>
			</div>
			<fieldset>
				<legend><span class="number">2</span> Пайдаланушы туралы ақпарат</legend>
				<input type="hidden" name="finger_id" id="finger_id">
				<input type="hidden" name="dev_id" id="dev_id">
				<input type="text" name="name" id="name" placeholder="Пайдаланушының аты...">
				<input type="text" name="number" id="number" placeholder="Сериялық нөмір...">

			</fieldset>
			<label>
				<input type="radio" name="gender" class="gender" value="Female">Әйел
	          	<input type="radio" name="gender" class="gender" value="Male" checked="checked">Ер
	      	</label >
			</fieldset>
				<div class="row">
					<div class="col-lg-4">
						<button type="button" name="user_add" class="user_add">Қосу</button>
					</div>
					<div class="col-lg-4">
						<button type="button" name="user_upd" class="user_upd">Жаңарту</button>
					</div>
					<div class="col-lg-4">
						<button type="button" name="user_rmo" class="user_rmo">Өшіру</button>
					</div>
				</div>
		</form>
	</div>

	<!--User table-->
	<div class="section">

		<div class="slideInRight animated">
			<div id="manage_users"></div>
		</div>
	</div>
</main>
</body>
</html>
