<footer>
	<div class="footer-content limited">
		
		<div class="top">
			<div class="left">
				<div class="logo">
					<img class="logo-img" src="<?php echo $hostName; ?>/assets/globals/global_imgs/icons/logo.svg" alt="<?php echo $global_key ?>'s logo">
					<p><?php echo $TRANSALTION_TEXTS["footer"]['designed_and_developer'] ?></p>
				</div>
			</div>
			

			<div class="right">
				<div class="list">
					<p class="list-title"><?php echo $TRANSALTION_TEXTS["footer"]['resources'] ?></p>
					<ul class="links-list">
						<li><i class="ri-home-3-line"></i><a href="<?php echo $routing['home']['URL'] ?>"><?php echo $TRANSALTION_TEXTS["header"]['home'] ?></a></li>
						
						<li><i class="ri-hand-coin-line"></i><a href="#all-products-container"><?php echo $TRANSALTION_TEXTS["header"]['all_products'] ?></a></li>
						<li><i class="ri-bank-card-line"></i><a href="<?php echo $routing['checkout']['URL'] ?>"><?php echo $TRANSALTION_TEXTS["header"]['checkout'] ?></a></li>
					</ul>
				</div>

				<div class="list">
					<p class="list-title"><?php echo $TRANSALTION_TEXTS["footer"]['ligality'] ?></p>
					<ul class="links-list">
						<li><i class="ri-question-mark"></i><a href="<?php echo $routing['faqs']['URL'] ?>"><?php echo $TRANSALTION_TEXTS["header"]['faqs'] ?></a></li>
						<li><i class="ri-shield-star-line"></i><a href="<?php echo $routing['refund_policy']['URL'] ?>"><?php echo $TRANSALTION_TEXTS["header"]['refund_policy'] ?></a></li>
					</ul>
				</div>

				<div class="list">
					<p class="list-title"><?php echo $TRANSALTION_TEXTS["footer"]['get_in_touch'] ?></p>
					<ul class="links-list">
						<div class="list-group social-media">
							<li><a href="instagram.com"><i class="ri-instagram-line"></i></a></li>
							<li><a href="whatsapp.com"><i class="ri-whatsapp-line"></i></a></li>
							<li><a href="twitter.com"><i class="ri-twitter-line"></i></a></li>
						</div>
						<li><i class="ri-mail-open-line"></i><p><?php echo $GLOBAL_VARIABLES['company_email'] ?></p></li>
						<li><i class="ri-customer-service-line"></i><a href="<?php echo $routing['contact']['URL'] ?>"><?php echo $TRANSALTION_TEXTS["header"]['contact'] ?></a></li>

					</ul>
				</div>

			</div>
		</div>

		

		<div class="bottom">
			<p><i class="ri-copyright-line"></i><?php echo $TRANSALTION_TEXTS["footer"]['copyright'] ?></p>
		</div>

	</div>
</footer>