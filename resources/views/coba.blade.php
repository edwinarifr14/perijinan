<!DOCTYPE html>
<head>
	<title>
		How to get selected value in
		dropdown list using JavaScript?
	</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="{{ url('/assets/css/linearicons.css') }}">
<link rel="stylesheet" href="{{ url('/assets/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ url('/assets/plugins/owlcarousel/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ url('/assets/plugins/niceselect/nice-select.css') }}">
<link rel="stylesheet" href="{{ url('/assets/plugins/nouislider/nouislider.min.css') }}">
<link rel="stylesheet" href="{{ url('/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ url('/assets/css/agency.min.css') }}">
<body>
	<h1 style="color: green">
		GeeksForGeeks
	</h1>

	<b>
		How to get selected value in
		dropdown list using JavaScript?
	</b>
	<div>
	<p>
		Select one from the given options:

		<select id="2" name="2">
			<option>1</option>

		</select>
	</p>
</div>

<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 p-1">
		<div class="card">


				<div class="card-body">

					<select id="1" name="1">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
					</select>


						<div class="my-1">
								<div class="text-secondary">Nama Produk</div>
								<div class="text-dark">
										<i class="fas fa-tags"></i>
										<span>asd</span>
								</div>
						</div>
						<div class="my-1">
							<select id="5" name="5">
								<option>sad1</option>
							</select>
								</div>
						</div>

		</div>
</div>


	<p>
		The value of the option selected is:
		<span id="output" class="output" value="7">7</span>
	</p>

  <br>
  <br>
  <br>
	<form class="" action="tes" method="post">
		@csrf

  <table class="table" name="tabel" id="tabel">
  <thead>
    <tr>
      <th scope="col" name="a" id="a">First</th>
      <th scope="col" name="b" id="b">Last</th>
      <th scope="col" name="c" id="c">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><select class="form-control col-md-6" onchange="enab()" name="select1" id="select1">
          <option value="1">1</option>
          <option value="2">2</option>
      </select></td>
      <td><select class="form-control col-md-6" onchange="enab()" name="select2" id="select2">
        <option value="1">1</option>
          <option value="2">2</option>
      </select></td>
      <td name="asd" id="asd"><span id="output1" name="output1" class="output1" value="1">1</span></td>
    </tr>
  </tbody>
	<tfoot align="right">
		<tr><th></th><th></th></tr>
	</tfoot>
</table>
<button id="button1" name="button1" class="button" type="submit">
	babi
</button>
</form>
	<button id="button" class="button" onclick="getOption()">
		Check option
	</button>
  <script src=”https://code.jquery.com/jquery-3.4.1.min.js” integrity=”sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=” crossorigin=”anonymous”></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet"  href="vendor/DataTables/datatables.min.css">
	<link rel="stylesheet"  href="style.css">
    <script src="vendor/DataTables/datatables.min.js" type="text/javascript"></script>

	<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('change','#1',function(){
			// console.log("hmm its change");

			var p_id=$(this).val();
			// console.log(cat_id);
			var div=$(this).parent();

			var op=" ";

			$.ajax({
				type:'get',
				url:'{!!URL::to('city')!!}',
				data:{'id':p_id},
				success:function(data){
					//console.log('success');

					//console.log(data);

					//console.log(data.length);
					op+='<option value="0" selected disabled>--Kota Asal--</option>';
					for(var i=0;i<data.length;i++){
					op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
				   }

				   div.find('#5').html(" ");
				   div.find('#5').append(op);
				},
				error:function(){

				}
			});
		});
	});


  function enab()
{
  var button = document.getElementById("button");
	getOption();
  button.disabled = false;
}

function getOption() {
	<?php
	for ($i=1; $i < 3 ; $i++) {	?>
		selectElement<?php echo $i; ?> = document.querySelector('#select<?php echo $i; ?>');
	<?php } ?>





  var a = <?php echo $a;?>;


	<?php $temp="";?>
	<?php
	for ($i=1; $i < 3 ; $i++) {

				 $asd = $temp."+parseInt(selectElement".$i.".options[selectElement".$i.".selectedIndex].value)";
				 $temp = $asd;
				 } ?>

				 output = parseInt(a)<?php echo $asd; ?>;



          var button = document.getElementById("button");
          button.disabled = true;

        document.querySelector('.output1').textContent = output;

		}
		window.onload = getOption;
	</script>
</body>

</html>
