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
	<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script> 
	    
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
        <div class="col-lg-6">
          <h2>Статистика</h2>
          <table class="table tablesorter" id="table">
		  <thead id="thead">
		   <tr><th onclick="changeSorting(0)">Дата отправки</th><th onclick="changeSorting(1)">From</th><th onclick="changeSorting(2)">To</th><th onclick="changeSorting(3)">Subject</th><th onclick="changeSorting(4)">Количество открытий</th><th onclick="changeSorting(5)">Количество кликов</th></tr>
		  </thead>
		  <tbody id="sended">
			<?php include("search.php"); ?>
			</tbody>
		  </table>
        </div>
        <div class="col-lg-6"> <h2>Отправить</h2>
          <form action="send.php" method="POST" role="form">
		  <div class="form-group">
		  <label for="from_email">From:</label> <input class="form-control" type="text" name="from_email" id="from_email">
		  </div>
		  <div class="form-group">
		  <label for="to">TO:</label> <input class="form-control" type="text" name="to" id="to">
		   </div>
		   <div class="form-group">
		  <label for="subject">subject</label> <input  class="form-control" type="text" name="subject" id="subject">
		   </div>
		   <div class="form-group">
		  <label for="body">Body</label> <textarea class="form-control" name="body" id="body"></textarea>
		   </div>
		  
		  <button type="button" id="loading-example-btn" data-loading-text="Sending..." class="btn btn-primary">
		  Send
		  </button>
		  <p class="text-danger" id="error"></p>
		    <script>
	 		var sorting = []; 
			var tempSorting;
			//Для сохранения сортировки при ajax запросе
			function changeSorting(id){
				if(tempSorting==0)
				{
					tempSorting=1;
				}
				else
					tempSorting=0;
				sorting = [[id,tempSorting]];
			}
			$(document).ready(function() 
    		{ 
     		   	$("#table").tablesorter();		   
   			} 
			); 
			//Получение тела письма
			function GetBody(id){
				$.ajax({
                type: "POST",
                url: "body.php",
				data: "id="+id,
                success: function(html) {
                        $("#bodyMail").empty();
                        $("#bodyMail").append(html);
                }
        		});
			}
			//обновление сообщений
			function updateStat(){
				$.ajax({
                type: "POST",
                url: "search.php",
                success: function(html) {
                        $("#sended").empty();
                        $("#sended").append(html);
						$("table").trigger("update");
						$("table").trigger("sorton",[sorting]); 
                }
        		});
				 
			}

			var refresh = setInterval(updateStat,10000);
			//отправка сообщения
  			$('#loading-example-btn').click(function () {
    			var btn = $(this)
   				 btn.button('loading')
				var from_email = $('#from_email').val();
				var to = $('#to').val();
				var subject = $('#subject').val();
				var body= $('#body').val();
   				$.ajax({
               	 	type: "POST",
                	url: "send.php",
                	data: "from_email="+from_email+"&to="+to+"&subject="+subject+"&body="+body,
                	success: function(html) {
                        $("#error").empty();
                        $("#error").append(html);
						updateStat();
                	}
        		}).always(function () {
      			btn.button('reset')
    			});
  			});
  			</script>
		 	<p class="text-danger" id="error"></p>
		  </form>
		  <!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  			<div class="modal-dialog">
   			 	<div class="modal-content">
   			   	<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        			<h4 class="modal-title" id="myModalLabel">Info</h4>
      			</div>
      			<div class="modal-body" id="bodyMail">
       				LOADING....
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      			</div>
    		</div>
  		</div>
		</div>
       </div>
      </div>
	</div>

  </body>
</html>
<?php

?>