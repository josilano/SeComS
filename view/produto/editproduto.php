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
			<div class="divider"></div>
			<h5>Adicionar promoção</h5>
			<div class="row">
			    <div class="input-field col s12 m4 l4">
			      <input type="tel" class="datepicker" id="data-inicio" name="data-inicio">
			      <label for="data-inicio">Data Início</label>
			    </div>
			    <div class="input-field col s12 m4 l4">
			      <input type="tel" class="datepicker" id="data-fim" name="data-fim">
			      <label for="data-fim">Data Fim</label>
			    </div>
			    <div class="input-field col s12 m4 l4">
			      <input type="tel" name="preco-promocional" id="preco-promocional" onKeyUp="maskIt(this,event,'###.###.###,##',true)">
			      <label for="preco-promocional">Preço Promocional</label>
    			</div>
  			</div>

			<div class="row">
  				<button class="btn blue darken-4 amber-text" onclick="cadastraPromocao();">OK</button>
				<div id="spinner-load" class="preloader-wrapper small">
				    <div class="spinner-layer spinner-blue-only">
				     	<div class="circle-clipper left"><div class="circle"></div></div>
				      	<div class="gap-patch"><div class="circle"></div></div>
				      	<div class="circle-clipper right"><div class="circle"></div></div>
				    </div>
  				</div>
  			</div>
		</div>
	</div>

	<?php include ('../components/component_footer.php') ?>
	<?php include ('../partials/jscripts.php') ?>
	<script src="../../public/js/jquery.maskedinput.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#data-inicio").mask("99/99/9999");
			$("#data-fim").mask("99/99/9999");
		});

		function cadastraPromocao()
        {
        	if (validarDadosPromocao())
        	{
        		$('#spinner-load').prop('class', 'preloader-wrapper small active');
        		$.ajax({
	  				type: "POST",
				  	url: "../../src/controller/ProdutoController.php",
				  	data: {
				  		data_inicio: $("#data-inicio").val(),
				  		data_fim: $('#data-fim').val(),
				  		preco_promocional: $('#preco-promocional').val(),
				  		produto_id: $('#produto-id').val(),
				  		method: 'addpromocao'
				  	},
			  		success: function(response){
				  		$('#spinner-load').prop('class', 'preloader-wrapper small');
				  		Materialize.toast('Promoção cadastrada!', 4000);
				  		$("#data-inicio").val('');
				  		$("#data-fim").val('');
				  		$("#preco-promocional").val('');
	                    //debugger;
	                    console.log(response);
			  		}
				});
        	}
        	else 
        		Materialize.toast('Dados incorretos! Verifique os campos preenchidos e tente novamente!', 4000);
        }

        function validarDadosPromocao()
        {
        	if ($("#data-inicio").val() == null | $("#data-inicio").val() == '') return false;
        	if ($("#data-fim").val() == null | $("#data-fim").val() == '') return false;
        	if ($("#preco-promocional").val() == null | $("#preco-promocional").val() == '') return false;
			return true;
        }
	</script>

</body>
</html>