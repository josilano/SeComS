<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper blue darken-4">
      <a href="<?php echo (isset($navbar_href_logo) ? $navbar_href_logo : '#'); ?>" class="brand-logo amber-text">Logo</a>
      <ul class="right hide-on-med-and-down">
        <li>
        	<a href="<?php echo (isset($navbar_href_link1) ? $navbar_href_link1 : '#'); ?>" class="amber-text">
        		<?php echo (isset($navbar_txt_link1) ? $navbar_txt_link1 : 'link1'); ?>
        	</a>
        </li>
        <li>
        	<a href="<?php echo (isset($navbar_href_link2) ? $navbar_href_link2 : '#'); ?>" class="amber-text">
        		<?php echo (isset($navbar_txt_link2) ? $navbar_txt_link2 : 'link2'); ?>
        	</a>
        </li>
      </ul>
    </div>
  </nav>
</div>