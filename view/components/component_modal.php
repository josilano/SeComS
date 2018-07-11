<div id="modal1" class="modal">
    <div class="modal-content">
     	<h4><?php echo (isset($modal_content_header) ? $modal_content_header : 'Modal Header'); ?></h4>
      	<p><?php echo (isset($modal_content_txt) ? $modal_content_txt : 'A bunch of text'); ?></p>
    </div>
    <div class="modal-footer">
      	<a id="modal-link" href="<?php echo (isset($modal_footer_href) ? $modal_footer_href : '#!'); ?>" class="modal-action modal-close waves-effect waves-green btn-flat"><?php echo (isset($modal_footer_txt) ? $modal_footer_txt : 'Agree'); ?></a>
    </div>
</div>