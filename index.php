<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <title>Licitações Mais - Cursos</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/form-validation.css" rel="stylesheet">
	
	<style>
		.select_n{
			width: 144px;
		}
		
		.div-float-left{
			float: left;
		}
		
		.form-check{
			
		}
		
		.card{
			height: 60px;
			width: 65px;
			background: url('img/cred_bebito_card.png') no-repeat;
			border: none;
			margin-left: 0px;
		}
		
		.masterCard{
			background-position: 0px 20px;
		}
		
		.visa{
			background-position: -70px 20px;
		}
		
		.form-check-input{
			top: 20px;
		}
		
		label.error{
			display: block;
			color: #dc3545;
			position: absolute;
			width: 200px;
			margin-bottom: 5px;
		}
		
		.resposta{
			text-align: center;
		}
	</style>
  </head>

  <body class="bg-light">
	
	<div class="container">
		<br />
		<div class="row">
			<div class="col-md-6 col-sm-6" style="border:1px solid #ccc;">
				dfdfdf
			</div>
			
				<div class="col-md-6 col-sm-6">
				<form action="" method="post" name="formulario_curso" id="formulario_curso" class="valida-form">	
					<div class="form-group">
						<label for="disabledTextInput">Nome do titular</label>
						<input type="text" id="disabledTextInput" class="form-control" name="nome_titular" placeholder="Ex: Fulano A. Tal" required>
					</div>
					
					<div class="form-group">
						<label for="disabledTextInput">Número do cartão</label>
						<input type="text" id="disabledTextInput" class="form-control" name="numero_cartao" placeholder="Ex: 0000-0000-0000-0000" required>
					</div>
					
					<div style="width: 300px; height: 30px; background: #e9ecef; color: #343a40; text-align:center; line-height: 30px; border-radius: 6px;">Vencimento</div>
					<div class="form-group">
						<div class="div-float-left">
							<label for="disabledTextInput">Mês</label><br />
							<select name="mes_vencimento" class="custom-select mr-sm-2 select_n" id="inlineFormCustomSelect" required>
								<option value="">Selecione</option>
								<option value="01">01</option>
								<option value="02">02</option>
								<option value="03">03</option>
								<option value="04">04</option>
								<option value="05">05</option>
								<option value="06">06</option>
								<option value="07">07</option>
								<option value="08">08</option>
								<option value="09">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select>
						</div>
						
						<div class="div-float-left">
							<label for="disabledTextInput">Ano</label><br />
							<select name="ano_vencimento" class="custom-select mr-sm-2 select_n" id="inlineFormCustomSelect" required>
								<option value="">Selecione</option>
								<?php for($i = date('Y'); $i <= 2040; $i++): ?>
									<option value="<?= $i; ?>"><?= $i; ?></option>
								<?php endfor;?>
							</select>
						</div>
						<div class="div-float-left">
							<label for="disabledTextInput">CVV</label><br />
							<input type="text" id="disabledTextInput" class="form-control select_n" name="cvv_cart" placeholder="Ex: 123" required><br />
						</div>
					</div>
					<label for="disabledTextInput">Parcelas</label><br />
					<div class="input-group mb-3" style="width: 295px;">
						<div class="input-group-prepend">
							<label class="input-group-text" for="inputGroupSelect01">R$</label>
						</div>
						<?php 
							
							$valor_curso = 1399;
							
							//$valor = $valor / 3;
							//$valor = number_format($valor,2,",",".");
							
							
							$parcelas = 4;
						?>
					  <select class="custom-select" id="inputGroupSelect01" name="qtd_parcelas" required>
						<option value="">Selecione</option>
						<?php 
							for($i = 0; $i <= $parcelas; $i++): 
					
							if($i != 0):
							$valor = 1399;
							
							$valor = $valor / $i;
						?>
							
							<option value="<?= $i; ?>"><?php echo $i . "X " . number_format($valor,2,",","."); ?></option>
						<?php endif; endfor;?>
					  </select>
					</div>
				  <br />
				  <div style="width: 180px; height: 30px; background: #e9ecef; color: #343a40; text-align:center; line-height: 30px; border-radius: 6px;">Bandeira</div>
				  <div class="form-group">
						<div class="form-check div-float-left">
							<input class="form-check-input" type="radio" name="bandeira" id="exampleRadios1" value="visa" required>
							<label class="form-check-label card masterCard" for="exampleRadios1"></label>
						</div>
						
						<div class="form-check div-float-left" style="margin-left: 15px;">
							<input class="form-check-input" type="radio" name="bandeira" id="exampleRadios1" value="masterCard" required>
							<label class="form-check-label card visa" for="exampleRadios1"></label>
						</div>
					</div><br />
					
					<input type="hidden" value="<?= $valor_curso; ?>" name="valor_curso_completo" />
					
					<div class="form-group"><br /><br />
						<input type="submit" value="Pagar" class="btn btn-primary btn-lg btn-block btn_pagar" />
					</div>
				</form>	
				<div class="resposta"></div>
				</div>
				
		</div>
	</div>
	

 

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/holder.min.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script src="js/curso.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('valida-form');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
	  
	$(document).ready(function(){
	  $("#formulario_curso").validate({
		rules: {
			nome_titular: {
				required: true
			},
			
			numero_cartao: {
				required: true
			},
			
			mes_vencimento: {
				required: true
			},
			
			ano_vencimento: {
				required: true
			},
			
			cvv_cart: {
				required: true
			},
			
			qtd_parcelas: {
				required: true
			},
			
			bandeira: {
				required: true
			}
		},
		messages: {
			nome_titular: {
				required: ""
			},
			
			numero_cartao: {
				required: ""
			},
			
			mes_vencimento: {
				required: ""
			},
			
			ano_vencimento: {
				required: ""
			},
			
			cvv_cart: {
				required: ""
			},
			
			qtd_parcelas: {
				required: ""
			},
			
			bandeira: {
				required: "Selecione uma bandeira"
			}
		},
		
			submitHandler: function( form ){

			var url = 'efetuar-pagamento.php';
			var conteudo_form = $(form).serialize();
		
			$.ajax({
				url: url,
				type: 'post',
				data: conteudo_form,
				beforeSend: function(){
					//$('.btn_pagar').fadeOut();
					$('.resposta').empty().html('<img src="img/ajax-loader.gif" />');
				},
				success: function(resposta){
					$('.resposta').empty().html(resposta);
					
				}
			});
				

			return false;
		},

		});
	});
    </script>
  </body>
</html>
