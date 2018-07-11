<?php
require_once('../../src/controller/ProdutoController.php');

//config page
$title = 'Produto';
$dircss = '../../';
$dirjs = '../../';

//acesso controller
$id_produto = $_GET['id'];
$produtoc = new ProdutoController();
//$produto = $produtoc->busca($id_produto);
$produto = $produtoc->anuncio($id_produto);
//print_r($produto);
//config component card
$card_imgsrc = '../../pictures/'. $produto['url_img'];
$card_title = $produto['nome'];
$card_content_bottom = $produto['descricao'];
$card_action_href = $_GET['id'];
$card_action_txt_link = $_GET['id'];
if (isset($produto['preco_promocional']))
	$card_content_top = '<s class="grey-text">R$ '. number_format($produto['preco'], 2, ',', '.') .'</s><br><i class="material-icons amber-text">monetization_on</i>R$ '. number_format($produto['preco_promocional'], 2, ',', '.');
else
	$card_content_top = '<i class="material-icons amber-text">monetization_on</i>R$ '. number_format($produto['preco'], 2, ',', '.');

//config component navbar
$navbar_href_logo = '../../index.php';
$navbar_href_link1 = 'create.php';
$navbar_txt_link1 = 'cadastrar produto';
$navbar_href_link2 = 'admin.php';
$navbar_txt_link2 = 'Admin';

//config component modal
$modal_content_header = 'Favor informe seus dados';
$modal_content_txt = '<div class="row">
		<div class="input-field col s12 m7 l7">
    	<input id="nomecliente" name="nomecliente" type="text" required>
    	<label for="nomecliente">Nome</label>
  	</div>
		<div class="input-field col s12 m5 l5">
  		<input type="email" name="emailcliente" id="emailcliente" class="validate">
  		<label for="emailcliente" data-error="forma incorreta">Email</label>
		</div>
	</div>';
$modal_footer_href = '#';
$modal_footer_txt = 'Confirmar';

?>
<!doctype html>
<html lang="en">
<?php include ('../partials/head.php'); ?>
<body>
	<?php include ('../components/component_navbar.php') ?>
	<div class="row">
		<div class="col s12 m12 l6 offset-l2">
			<?php include ('../components/component_card.php') ?>
		</div>
		<input type="hidden" id="produto-id" name="produto-id" value="<?php echo $_GET['id'] ?>">
		<div class="col s12 m12 l4 grey lighten-4">
			<div class="row">
				<div class="input-field col s12 m7 l7">
    				<input id="cepcliente" name="cepcliente" type="tel" required maxlength="9" class="validate">
    				<label for="cepcliente">CEP</label>
  				</div>
  				<button class="btn blue darken-4 amber-text" onclick="consultarFrete();">Ver prazo</button>
			</div>
			<div id="spinner-load" class="preloader-wrapper small">
			    <div class="spinner-layer spinner-blue-only">
			      <div class="circle-clipper left">
			        <div class="circle"></div>
			      </div><div class="gap-patch">
			        <div class="circle"></div>
			      </div><div class="circle-clipper right">
			        <div class="circle"></div>
			      </div>
			    </div>
  			</div><br>
			<span class="amber-text" id="prazocep"></span><br>
			<span class="amber-text" id="valorcep"></span><br>
		
			<button data-target="modal1" class="btn modal-trigger blue darken-4 amber-text" id="btn-comprar" disabled>Comprar</button>
			<?php include ('../components/component_modal.php') ?>
		</div>
	</div>

	<?php include ('../components/component_footer.php') ?>
	<?php include ('../partials/jscripts.php') ?>
	<script src="../../public/js/jquery.maskedinput.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#cepcliente").mask("99.999-999");
			$('#modal-link').on('click', function () {
                finalizaCompra();
            });
		});

		function consultarFrete()
        {
        	if ($("#cepcliente").val() != null && $("#cepcliente").val() != '')
        	{
        		$('#spinner-load').prop('class', 'preloader-wrapper small active');
        		$.ajax({
  					type: "POST",
			  		url: "../../src/controller/ConsultaAPIController.php",
			  		data: {
			  			cepcliente: $('#cepcliente').val(), 
			  			method: 'frete'
			  		},
			  		success: function(response){
			  			$('#spinner-load').prop('class', 'preloader-wrapper small');
			  			var obj = jQuery.parseJSON(response);
			  			$('#prazocep').html('Prazo para entrega ' + obj.prazo);
			  			$('#valorcep').html('valor do frete R$ '+ obj.valor);
			  			$('#btn-comprar').prop('disabled', false);
                    	//debugger;
                    	console.log(obj);
			  		}
				});
        	}
        	else Materialize.toast('Informe um CEP!', 4000);
        	
        }

        function finalizaCompra()
        {
        	if (validarDadosCompra())
        	{
        		Materialize.toast('Estamos processando seu pedido!', 4000);
        		$.ajax({
	  				type: "POST",
				  	url: "../../src/controller/CompraController.php",
				  	data: {
				  		nomecliente: $('#nomecliente').val(),
				  		emailcliente: $('#emailcliente').val(),
				  		produto_id: $('#produto-id').val(),
				  		cepcliente: $('#cepcliente').val(),
				  		method: 'finalizacompra'
				  	},
			  		success: function(response){
	                    console.log(response);
			  		}
				});
        	}
        	else 
        	{		
  				Materialize.toast('Dados incorretos! Verifique os campos preenchidos e tente novamente!', 4000);
  				$('#modal1').modal('open');
    		}
        }

        function validarDadosCompra()
        {
        	var filtertxt = /^([a-zA-Z])/;
        	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        	if (!filtertxt.test($('#nomecliente').val())) return false;
        	if (!filter.test($('#emailcliente').val()))	return false;
			return true;
        }
	</script>

</body>
</html>