<nav id="mainnav-container">
    <div id="mainnav">
        <!--Menu-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content" style="overflow-x:auto;">
                    <ul id="mainnav-menu" class="list-group">
                        <!--Category name-->
                        <li class="list-header"></li>
                        <!--Menu list item-->
                        <li <?php if($page_name=="dashboard"){?> class="active-link" <?php } ?> 
                        	style="border-top:1px solid rgba(69, 74, 84, 0.7);">
                            <a href="<?php echo base_url(); ?>index.php/admin/">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
									<?php echo translate('dashboard');?>
                                </span>
                            </a>
                        </li>
                        
            			<?php
                        	if($this->crud_model->admin_permission('category') ||
								$this->crud_model->admin_permission('sub_category') || 
									$this->crud_model->admin_permission('product') || 
										$this->crud_model->admin_permission('stock') ){
						?>
                        <!--Menu list item-->
                        <li <?php if($page_name=="category" || 
                                        $page_name=="sub_category" || 
                                            $page_name=="product" || 
                                                $page_name=="stock" ){?>
                                                     class="active-sub" 
                                                        <?php } ?> >
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                    <span class="menu-title">
                                        <?php echo translate('products');?>
                                    </span>
                                	<i class="fa arrow"></i>
                            </a>
            
                            <!--PRODUCT------------------>
                            <ul class="collapse <?php if($page_name=="category" || 
                                                            $page_name=="sub_category" ||  
                                                                $page_name=="product" || 
                                                                    $page_name=="brand" ||
                                                                        $page_name=="stock" ){?>
                                                                             in
                                                                                <?php } ?> >" >
                                
								<?php
                                    if($this->crud_model->admin_permission('category')){
                                ?>                                            
                                    <li <?php if($page_name=="category"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/admin/category">
                                        	<i class="fa fa-circle fs_i"></i>
                                        		<?php echo translate('category');?>
                                        </a>
                                    </li>
								<?php
									} if($this->crud_model->admin_permission('sub_category')){
                                ?>
                                    <li <?php if($page_name=="sub_category"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/admin/sub_category">
                                            <i class="fa fa-circle fs_i"></i>
                                            	<?php echo translate('sub-category');?>
                                        </a>
                                    </li>
								<?php
									} if($this->crud_model->admin_permission('brand')){
                                ?>
                                    <li <?php if($page_name=="brand"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/admin/brand">
                                        	<i class="fa fa-circle fs_i"></i>
                                            	<?php echo translate('brands');?>
                                        </a>
                                    </li>
								<?php
									} if($this->crud_model->admin_permission('product')){
                                ?>
                                    <li <?php if($page_name=="product"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/admin/product">
                                        	<i class="fa fa-circle fs_i"></i>
                                            	<?php echo translate('all_products');?>
                                        </a>
                                    </li>
								<?php
									} 
                                ?>
                                  
                            </ul>
                        </li>
                      
            			<?php
							}
						?>  
                        
                        <?php
                            if($this->crud_model->admin_permission('blog') ){
                        ?>
                        <li <?php if($page_name=="blog" || $page_name=="blog_category" ){?>
                                     class="active-sub" 
                                        <?php } ?> >
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span class="menu-title">
                                    News & Events
                                </span>
                                <i class="fa arrow"></i>
                            </a>
            
                            <ul class="collapse <?php if($page_name=="blog" || $page_name=="blog_category"){?>
                                                                 in
                                                                    <?php } ?>" >
                                
                                <?php
                                    if($this->crud_model->admin_permission('blog')){
                                ?>
                                <li <?php if($page_name=="blog"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>index.php/admin/blog/">
                                        <i class="fa fa-circle fs_i"></i>
                                            All News
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($this->crud_model->admin_permission('blog')){
                                ?>
                                <!--Menu list item-->
                                <li <?php if($page_name=="blog_category"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>index.php/admin/blog_category/">
                                        <i class="fa fa-circle fs_i"></i>
                                            News Categories
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>
                        <?php
                            }
                        ?>
                        


            			<?php
                        	if($this->crud_model->admin_permission('site_settings') ||
								$this->crud_model->admin_permission('banner')){
						?>
                        <!--<li <?php if($page_name=="banner" || 
										$page_name=="site_settings" ){?>
                                         class="active-sub" 
                                            <?php } ?> >
                            <a href="#">
                                <i class="fa fa-desktop"></i>
                                    <span class="menu-title">
                                		<?php echo translate('front_settings');?>
                                    </span>
                                		<i class="fa arrow"></i>
                            </a>
            
                            <ul class="collapse <?php if($page_name=="banner" || 
    														$page_name=="site_settings" ){?>
                                                             in
                                                                <?php } ?>" >
                                
								
								
                                <?php
                                    if($this->crud_model->admin_permission('banner')){
                                ?>
                                    <li <?php if($page_name=="banner"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/admin/banner/">
                                            <i class="fa fa-circle fs_i"></i>
                                            	<?php echo translate('banner_settings');?>
                                        </a>
                                    </li>
                                <?php
                                    }
                                ?>
								<?php
                                    if($this->crud_model->admin_permission('site_settings')){
                                ?>                      
                                    <li <?php if($page_name=="site_settings"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/admin/site_settings/general_settings/">
                                            <i class="fa fa-circle fs_i"></i>
                                            	<?php echo translate('site_settings');?>
                                        </a>
                                    </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>-->
						<?php
                            }
                        ?>
                       
                </div>
            </div>
        </div>
    </div>
</nav>
<style>
.activate_bar{
border-left: 3px solid #1ACFFC;	
transition: all .6s ease-in-out;
}
.activate_bar:hover{
border-bottom: 3px solid #1ACFFC;
transition: all .6s ease-in-out;
background:#1ACFFC !important;
color:#000 !important;	
}
</style>