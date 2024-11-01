<div class="page-sidebar navbar-collapse collapse">
	<ul class="page-sidebar-menu  page-header-fixed" data-slide-speed="200" data-auto-scroll="true" data-keep-expanded="false">
		<li class="nav-item <?php gsplActiveSubItem('gsupport'); ?>">
			<a href="?page=gsupport" title="Overview">
			<i class="icon-home"></i>
			<span class="title">
				<?php echo __('Overview'); ?>
			</span>
			<span class="selected"></span>
			</a>
		</li>
		<li class="nav-item <?php gsplActiveModel(); ?>">
			<a class="nav-link nav-toggle" href="javascript:;">
	            <i class="icon-diamond"></i>
	            <span class="title">Features</span>
	            <span class="selected"></span>
	            <span class="arrow"></span>
            </a>
			<ul class="sub-menu">
				<li class="nav-item <?php gsplActiveSubItem('gsheader'); ?>">
					<a class="nav-link" href="?page=gsheader" title="Header">
					<span class="title">
						<?php echo __('Header'); ?>
					</span>
					</a>
				</li>
				<li class="nav-item <?php gsplActiveSubItem('gstitlebar'); ?>">
					<a class="nav-link" href="?page=gstitlebar" title="Page title">
					<span class="title">
					<?php echo __('Title bar'); ?>
					</span>
					</a>
				</li>
				<li class="nav-item <?php gsplActiveSubItem('gsfooter'); ?>">
					<a class="nav-link" href="?page=gsfooter" title="Footer">
					<span class="title">
						<?php echo __('Footer'); ?>
					</span>
					</a>
				</li>
				<!--li class="nav-item <?php gsplActiveSubItem('gsingletemp'); ?>">
					<a class="nav-link" href="?page=gsingletemp" title="Single Template">
					<span class="title">
					<?php echo __('Single Template'); ?>
					</span>
					</a>
				</li-->
				<li class="nav-item <?php gsplActiveSubItem('gscustomcss'); ?>">
					<a class="nav-link" href="?page=gscustomcss" title="Custom CSS">
					<span class="title">
					<?php echo __('Custom CSS'); ?>
					</span>
					</a>
				</li>	
			</ul>
		</li>
	</ul>
</div>