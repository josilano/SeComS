
	<div class="row">
		<div class="input-field col s12 m9 l9">
    	<input placeholder="Placeholder" id="nome" name="nome" type="text" class="validate" required>
    	<label for="nome">Nome</label>
  	</div>
		<div class="input-field col s12 m3 l3">
  		<input type="tel" name="preco" id="preco" onKeyUp="maskIt(this,event,'###.###.###,##',true)">
  		<label for="preco">Preço</label>
		</div>
	</div>

	<div class="row">
  	<div class="row">
    	<div class="input-field col s12">
    		<textarea id="descricao" name="descricao" class="materialize-textarea" data-length="255" maxlength="255"></textarea>
    		<label for="descricao">Descrição</label>
    	</div>
  	</div>
	</div>
	
	<div class="row">
		<div class="col s12 m6 l5">
			<img id="fotoproduto" src="../../pictures/port1.jpg" alt="sem imagem" width="200">
      <input type="hidden" id="url-img" name="url-img" value="port1.jpg">
    	<div class="progress">
        <div id="progresso" class="determinate" style="width: 0%;"></div>
      </div>
    </div>
		<div class="col s12 m6 l7">
			<div class="red-text" id="msg-envio"></div>
	      <h4 class="amber-text">Adicionar Foto</h4>
    		<div class="file-field input-field col m12 l12">
        	<div class="btn blue darken-4" id="btn-imagem">
            <i class="large material-icons amber-text">add_a_photo</i>
            <input id="imagem" type="file" name="imagem" data-token="token" data-user-id="id">
            	<div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Clique para selecionar uma foto" name="fotos">
              </div>
          </div>
        </div>
    </div>
  </div>
	<br><br>

  <button class="btn waves-effect waves-amber blue darken-4 amber-text" type="submit" id="btncad" name="method" value="cadastra">cadastrar
    <i class="material-icons right amber-text">send</i>
  </button>
