<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <div class="container">
    <div class="row">
        <div class="col-lg-12">
         <h2>Загрузка</h2>
		 <form enctype="multipart/form-data" action="edit.php" method="POST" role="form" id="uploadForm">
		 	<div class="form-group">
  			  <label for="exampleInputFile">Загрузка файла</label>
   			 <input type="file" id="file" name="file">
			 <button type="button" id="upload_button" data-loading-text="Загрузка..." class="btn btn-primary">
		  Загрузить
		  </button>
  			</div>		
		 </form> 
        </div>
		<div class="col-lg-12">
         <h2>Редактирование</h2>
		 <div id="EditDiv">
		 </div>
		 <div id="infoEdit">
		 </div>
        </div>
		<div class="col-lg-12">
         <h2>Выгрузка</h2>
		 <div id="Load">
		 </div>
        </div>
	</div>
	</div>
	<script>
	var name_file="";
	$('#upload_button').click(function () {
    			var btn = $(this)
   				 btn.button('loading')
				var file = $('#file').val();
				var form = document.forms.uploadForm;

			var formData = new FormData(form);  

			var xhr = new XMLHttpRequest();
			xhr.open("POST", "edit.php");

			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if(xhr.status == 200) {
						data = xhr.responseText;
						$("#EditDiv").empty();
						$("#EditDiv").append(data);
						$("#Load").empty();
						$("#Load").append("<a href=\"load.php\" type=\"button\" id=\"upload_button\" class=\"btn btn-primary\"> Скачать </a> <a href=\"clear.php\" type=\"button\" id=\"upload_button\" class=\"btn btn-primary\"> Стереть </a>")
						btn.button('reset');
					}
				}
			};
			
			xhr.send(formData);
  			});
			
			function saveFile(){
				var form = document.forms.saveForm;

			var formData = new FormData(form);  

			var xhr = new XMLHttpRequest();
			xhr.open("POST", "save.php");

			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if(xhr.status == 200) {
						data = xhr.responseText;
						$("#infoEdit").empty();
						$("#infoEdit").append(data);
					}
				}
			};
			
			xhr.send(formData);
  			}
	</script>
  </body>
</html>
<?php

?>