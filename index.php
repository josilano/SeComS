<?php
/**
 * User: LaNo
 */
require_once('src/controller/ProdutoController.php');

//config page
$title = 'e-comm';

$produtoc = new ProdutoController();
//$produtos = $produtoc->lista();
$produtos = $produtoc->listaPromocao();
//var_dump(sizeof($produtos));

//config component navbar
$navbar_href_logo = 'index.php';
$navbar_href_link1 = 'view/produto/create.php';
$navbar_txt_link1 = 'cadastrar produto';
$navbar_href_link2 = 'view/produto/admin.php';
$navbar_txt_link2 = 'Admin';
?>
<!doctype html>
<html lang="en">
	<?php include ('view/partials/head.php'); ?>
<body>
	<?php include ('view/components/component_navbar.php'); ?>
	<h1 class="amber-text center-align">Sistema e-commerce Simples - SECOMS</h1>
	
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
			$card_imgsrc = 'pictures/'.$produto['url_img'];
			$card_title = $produto['nome'];
			
			$card_content_bottom = '<span class="truncate">'. $produto['descricao'] .'</span>';
			$card_action_href = 'view/produto/produto.php?id='.$produto['id'];
			$card_action_txt_link = 'DETALHES';
			
			if (isset($produto['preco_promocional']))
				$card_content_top = '<s class="grey-text">R$ '. number_format($produto['preco'], 2, ',', '.') .'</s><br><i class="material-icons amber-text">monetization_on</i>R$ '. number_format($produto['preco_promocional'], 2, ',', '.');
			else
				$card_content_top = '<i class="material-icons amber-text">monetization_on</i>R$ '. number_format($produto['preco'], 2, ',', '.');
			include ('view/components/component_card.php');
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

	<?php include ('view/components/component_footer.php'); ?>
	<?php include ('view/partials/jscripts.php'); ?>
</body>
</html>