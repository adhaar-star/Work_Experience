<?php include_once $this->getPart('/web/common/header.php'); ?> 
<section class="thanks_info">
    <div class="thanks_info_inner">
        <div class="thank_outter">
            <div class="thanks_frame">
                <div class="thanks_border">
                    <div class="quote_logo">
                        <a title="Thank You" href="<?= $app['base_url']; ?>" class="center_logo">
                            <!--<img src="<?= $app['base_assets_url']; ?>images/thank_you.png" class="img-responsive" alt="Thank You">--></a>
                    </div>
                    <div class="middle_section middle_section_thanks">
                        <p class="quote_txt">Congratulations! You have successfully verified your yourgist.com account.</p>
                        <div class="text-center"><a href="<?= $app['base_url']; ?>candidate/login">Login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once $this->getPart('/web/common/footer.php'); ?>