<?php
/**
 * User: LaNo
 */
require_once('../../src/controller/ProdutoController.php');

//config page
$title = 'Admin';
$dircss = '../../';
$dirjs = '../../';

$produtoc = new ProdutoController();
//$produtos = $produtoc->lista();
$produtos = $produtoc->listaPromocao();


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
	<?php include ('../components/component_navbar.php'); ?>
	<h1 class="amber-text center-align">Listagem dos produtos</h1>
	
	<div class="row">	
	<?php
		$i = 0;
		foreach ($produtos as $produto) {
			if ($i == 1) {
	?>
		<div class="row">
		<?php }
		?>
			<div class="col s12 m4 l4">
			<?php
			//config component card
			$card_imgsrc = '../../pictures/'.$produto['url_img'];
			$card_title = $produto['nome'];
			
			$card_content_bottom = '<span class="truncate">'. $produto['descricao'] .'</span>';
			$card_action_href = 'editproduto.php?id='.$produto['id'];
			$card_action_txt_link = 'EDITAR';
			
			if (isset($produto['preco_promocional']))
				$card_content_top = '<s class="grey-text">R$ '. number_format($produto['preco'], 2, ',', '.') .'</s><br><i class="material-icons amber-text">monetization_on</i>R$ '. number_format($produto['preco_promocional'], 2, ',', '.');
			else
				$card_content_top = '<i class="material-icons amber-text">monetization_on</i>R$ '. number_format($produto['preco'], 2, ',', '.');
			include ('../components/component_card.php');
			?>
			</div>
			<?php
				$i++;
				if ($i == 3) {
			?>
		</div>
		<?php $i = 0;
				}
		}
		?>
	</div>

	<?php include ('../components/component_footer.php'); ?>
	<?php include ('../partials/jscripts.php'); ?>
</body>
</html>