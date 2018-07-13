<?php
//config page
$title = 'cadastrar produto';
$dircss = '../../';
$dirjs = '../../';

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
		<div class="col s12 m12 l6">
			<?php include ('../components/component_form_addproduto.php') ?>
		</div>
	</div>

	<?php include ('../components/component_footer.php') ?>
	<?php include ('../partials/jscripts.php') ?>
	<!--<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script> -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="../../public/js/canvas-to-blob.min.js"></script>
    <script src="../../public/js/resize.js"></script>
    <script src="../../public/js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
			$('#btn-imagem').prop('class', 'btn disabled');
		});
        // Iniciando biblioteca
        var resize = new window.resize();
        resize.init();

        // Declarando variáveis
        var imagens;
        var imagem_atual;

        // Quando carregado a página
        $(function ($) {
            // Quando selecionado as imagens
            $('#imagem').on('change', function () {		
                enviar();
            });

        });

        /*
         Envia os arquivos selecionados
         */
        function enviar()
        {
            // Verificando se o navegador tem suporte aos recursos para redimensionamento
            if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
                alert('O navegador não suporta os recursos utilizados pelo aplicativo');
                return;
            }

            // Alocando imagens selecionadas
            imagens = $('#imagem')[0].files;

            // Se selecionado pelo menos uma imagem
            if (imagens.length > 0)
            {
                // Definindo progresso de carregamento
                $('#progresso').attr('aria-valuenow', 0).css('width', '0%');

                // Escondendo campo de imagem
                $('#imagem').hide();

                // Iniciando redimensionamento
                imagem_atual = 0;
                redimensionar();
            }
        }

        /*
         Redimensiona uma imagem e passa para a próxima recursivamente
         */
        function redimensionar()
        {
            // Se redimensionado todas as imagens
            if (imagem_atual > imagens.length)
            {
                // Definindo progresso de finalizado
                $('#progresso').html('Imagen(s) enviada(s) com sucesso');

                // Limpando imagens
                limpar();

                // Exibindo campo de imagem
                $('#imagem').show();

                // Finalizando
                return;
            }

            // Se não for um arquivo válido
            if ((typeof imagens[imagem_atual] !== 'object') || (imagens[imagem_atual] == null))
            {
                // Passa para a próxima imagem
                imagem_atual++;
                redimensionar();
                return;
            }

            // Redimensionando
            resize.photo(imagens[imagem_atual], 800, 'dataURL', function (imagem) {

                // Salvando imagem no servidor
                $.post('../../src/controller/ProdutoController.php', 
                	{
                		imagem: imagem, 
                		method: 'upload', 
                		fotoold: $('#url-img').val()
                	}, 
                	function(data) {

                    // Definindo porcentagem
                    var porcentagem = (imagem_atual + 1) / imagens.length * 100;

                    // Atualizando barra de progresso
                    $('#progresso').text(Math.round(porcentagem) + '%').attr('aria-valuenow', porcentagem).css('width', porcentagem + '%');

                    // Aplica delay de 1 segundo
                    // Apenas para evitar sobrecarga de requisições
                    // e ficar visualmente melhor o progresso
                    setTimeout(function () {
                        // Passa para a próxima imagem
                        imagem_atual++;
                        redimensionar();
                    }, 1000);
                    d = new Date();
                    $('#fotoproduto').attr('src', '../../pictures/'+data+'?'+d.getTime());
                    $('#url-img').val(data);
                });
            });
        }

        /*
         Limpa os arquivos selecionados
         */
        function limpar()
        {
            var input = $("#imagem");
            input.replaceWith(input.val('').clone(true));
        }

		$(function ($) {
            $('#nome').on('keyup', function () {
                if (validarDadosProduto()) $('#btn-imagem').prop('class', 'btn blue darken-4');
        		else $('#btn-imagem').prop('class', 'btn disabled');
            });
            $('#preco').on('change', function () {
                if (validarDadosProduto()) $('#btn-imagem').prop('class', 'btn blue darken-4');
        		else $('#btn-imagem').prop('class', 'btn disabled');
            });
            $('#descricao').on('keyup', function () {
                if (validarDadosProduto()) $('#btn-imagem').prop('class', 'btn blue darken-4');
        		else $('#btn-imagem').prop('class', 'btn disabled');
            });
            $('#btncad').on('click', function () {
                if (validarDadosProduto()) cadastraproduto();
        		else Materialize.toast('Dados incorretos! Preencha todos os campos corretamente!', 4000);
            });
        });

        function cadastraproduto()
        {
        	$.ajax({
  				type: "POST",
			  	url: "../../src/controller/ProdutoController.php",
			  	data: {
			  		nome: $('#nome').val(), 
			  		preco: $('#preco').val(), 
			  		descricao: $('#descricao').val(), 
			  		url_img: $('#url-img').val(),
			  		method: 'cadastra'
			  	},
			  	success: function(response){
			  		Materialize.toast('produto cadastrado!', 4000);
			  		$('#nome').val('');
			  		$('#preco').val('');
			  		$('#descricao').val('');
			  		d = new Date();
                    $('#fotoproduto').attr('src', '../../pictures/port1.jpg?'+d.getTime());
			  		limpar();
                    //debugger;
                    console.log(response);
			  	}
			});
        }

        function validarDadosProduto()
        {
        	var filtertxt = /^([a-zA-Z])/;
        	var filternumber = /^([0-9\.\,])/;
        	if (!filtertxt.test($('#nome').val())) return false;
        	if (!filtertxt.test($('#descricao').val())) return false;
        	if (!filternumber.test($('#preco').val())) return false;
			return true;
        }

        $(document).on("change", "#Upload", function(e) {
    		showThumbnail(this.files);
		});

		function showThumbnail(files) {
		    if (files && files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#thumbnail').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(files[0]);
		    }
		}
    </script>
</body>
</html>