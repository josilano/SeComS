<div class="row">
  <div class="col s12 m7">
    <div class="card">
      <div class="card-image">
        <img src="<?php echo (isset($card_imgsrc) ? $card_imgsrc : null); ?>" alt="imagem">
        <span class="card-title"><?php echo (isset($card_title) ? $card_title : 'Card Title'); ?></span>
      </div>
      <div class="card-content">
        <p class="amber-text"><?php echo (isset($card_content_top) ? $card_content_top : 'I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.'); ?></p>
        <p><?php echo (isset($card_content_bottom) ? $card_content_bottom : 'I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.'); ?></p>
      </div>
      <div class="card-action">
        <a href="<?php echo (isset($card_action_href) ? $card_action_href : '#'); ?>"><?php echo (isset($card_action_txt_link) ? $card_action_txt_link : 'This is a link'); ?></a>
      </div>
    </div>
  </div>
</div>