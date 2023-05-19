<?php
/* ----------------------------------------------------------------------
 * views/pageFormat/pageHeader.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014-2022 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */
$va_lightboxDisplayName = caGetLightboxDisplayName();
$vs_lightbox_sectionHeading = ucFirst($va_lightboxDisplayName["section_heading"]);
$va_classroomDisplayName = caGetClassroomDisplayName();
$vs_classroom_sectionHeading = ucFirst($va_classroomDisplayName["section_heading"]);

# Collect the user links: they are output twice, once for toggle menu and once for nav
$va_user_links = array();
if ($this->request->isLoggedIn()) {
	$va_user_links[] = '<li role="presentation" class="dropdown-header">' . trim($this->request->user->get("fname") . " " . $this->request->user->get("lname")) . ', ' . $this->request->user->get("email") . '</li>';
	$va_user_links[] = '<li class="divider nav-divider"></li>';
	if (caDisplayLightbox($this->request)) {
		$va_user_links[] = "<li>" . caNavLink($this->request, $vs_lightbox_sectionHeading, '', '', 'Lightbox', 'Index', array()) . "</li>";
	}
	if (caDisplayClassroom($this->request)) {
		$va_user_links[] = "<li>" . caNavLink($this->request, $vs_classroom_sectionHeading, '', '', 'Classroom', 'Index', array()) . "</li>";
	}
	$va_user_links[] = "<li>" . caNavLink($this->request, _t('User Profile'), '', '', 'LoginReg', 'profileForm', array()) . "</li>";
	$va_user_links[] = "<li>" . caNavLink($this->request, _t('Logout'), '', '', 'LoginReg', 'Logout', array()) . "</li>";
} else {
	if (!$this->request->config->get(['dontAllowRegistrationAndLogin', 'dont_allow_registration_and_login']) || $this->request->config->get('pawtucket_requires_login')) {
		$va_user_links[] = "<li><a href='#' onclick='caMediaPanel.showPanel(\"" . caNavUrl($this->request, '', 'LoginReg', 'LoginForm', array()) . "\"); return false;' >" . _t("Login") . "</a></li>";
	}
	if (!$this->request->config->get(['dontAllowRegistrationAndLogin', 'dont_allow_registration_and_login']) && !$this->request->config->get('dontAllowRegistration')) {
		$va_user_links[] = "<li><a href='#' onclick='caMediaPanel.showPanel(\"" . caNavUrl($this->request, '', 'LoginReg', 'RegisterForm', array()) . "\"); return false;' >" . _t("Register") . "</a></li>";
	}
}
$vb_has_user_links = (sizeof($va_user_links) > 0);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-XXXXX" crossorigin="anonymous" />
	<?php print MetaTagManager::getHTML(); ?>
	<?php print AssetLoadManager::getLoadHTML($this->request); ?>

	<title><?php print (MetaTagManager::getWindowTitle()) ? MetaTagManager::getWindowTitle() : $this->request->config->get("app_display_name"); ?></title>

	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#browse-menu').on('click mouseover mouseout mousemove mouseenter', function(e) {
				e.stopPropagation();
			});
		});
	</script>
	<?php
	if (Debug::isEnabled()) {
		//
		// Pull in JS and CSS for debug bar
		// 
		$o_debugbar_renderer = Debug::$bar->getJavascriptRenderer();
		$o_debugbar_renderer->setBaseUrl(__CA_URL_ROOT__ . $o_debugbar_renderer->getBaseUrl());
		print $o_debugbar_renderer->renderHead();
	}
	?>
</head>

<body>
	<nav id="navbar" class="navbar navbar-default yamm" role="navigation">
		<div class="container menuBar">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<?php
				if ($vb_has_user_links) {
				?>
					<button type="button" class="navbar-toggle navbar-toggle-user" data-toggle="collapse" data-target="#user-navbar-toggle">
						<span class="sr-only">User Options</span>
						<span class="glyphicon glyphicon-user"></span>
					</button>
				<?php
				}
				?>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-main-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php
				print caNavLink($this->request, caGetThemeGraphic($this->request, 'logoNamip.jpg'), "navbar-brand logoNamip", "", "", "");
				?>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<!-- bs-user-navbar-collapse is the user menu that shows up in the toggle menu - hidden at larger size -->
			<?php
			if ($vb_has_user_links) {
			?>
				<div class="collapse navbar-collapse" id="user-navbar-toggle">
					<ul class="nav navbar-nav">
						<?php print join("\n", $va_user_links); ?>
					</ul>
				</div>
			<?php
			}
			?>
			<div class="collapse navbar-collapse" id="bs-main-navbar-collapse-1">
				<?php
				if ($vb_has_user_links) {
				?>
					<ul class="nav navbar-nav navbar-right" id="user-navbar">
						<li class="dropdown" style="position:relative;">
							<a href="#" class="dropdown-toggle icon" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></a>
							<ul class="dropdown-menu"><?php print join("\n", $va_user_links); ?></ul>
						</li>
					</ul>
				<?php
				}
				?>
				<form class="navbar-form navbar-right" role="search" action="<?php print caNavUrl($this->request, '', 'MultiSearch', 'Index'); ?>">
					<div class="formOutline">
					<button type="submit" class="btn-search" id="headerSearchButton"><span class="glyphicon glyphicon-search"></span></button>
						<div class="form-group">
							<input type="text" class="form-control" id="headerSearchInput" placeholder="Search" name="search" autocomplete="off" />
						</div>
						
					</div>
				</form>
				<script type="text/javascript">
					$(document).ready(function() {
						$('#headerSearchButton').prop('disabled', true);
						$('#headerSearchInput').on('keyup', function() {
							$('#headerSearchButton').prop('disabled', this.value == "" ? true : false);
						})
					});
				</script>
				<ul id="menu-items" class="nav navbar-nav navbar-right menuItems">
					<li id="mainSite"><a href="http://192.168.202.145/">Site principal</a></li>
					<?php print $this->render("pageFormat/browseMenu.php"); ?>
					<li id="advanced-search" <?php print (($this->request->getController() == "Search") && ($this->request->getAction() == "advanced")) ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("Advanced Search"), "", "", "Search", "advanced/objects"); ?></li>
					<li id="gallery" <?php print ($this->request->getController() == "Gallery") ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("Gallery"), "", "", "Gallery", "Index"); ?></li>
					<li id="collections" <?php print ($this->request->getController() == "Collections") ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("Collections"), "", "", "Collections", "index"); ?></li>
					<li id="lang-dropdown" class="dropdown" style="position:relative;">
						<a href="#" id="lang-toggle" class="dropdown-toggle mainhead top" data-toggle="dropdown"><?php print _t("Langues"); ?><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li id="lang-en" class="lang-en <?php print ($g_ui_locale == 'en_US') ? 'active' : ''; ?>"><?php print caChangeLocaleLink($this->request, 'en_US', '<span class="lang-text">English</span>', 'myClass', ['hreflang' => 'en', 'title' => 'English']); ?></li>
								<li id="lang-fr" class="lang-fr <?php print ($g_ui_locale == 'fr_FR') ? 'active' : ''; ?>"><?php print caChangeLocaleLink($this->request, 'fr_FR', '<span class="lang-text">Français</span>', 'myClass', ['hreflang' => 'fr', 'title' => 'French']); ?></li>
								<li id="lang-nl" class="lang-nl <?php print ($g_ui_locale == 'nl_NL') ? 'active' : ''; ?>"><?php print caChangeLocaleLink($this->request, 'nl_NL', '<span class="lang-text">Nederlands</span>', 'myClass', ['hreflang' => 'nl', 'title' => 'Dutch']); ?></li>
							</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- end container -->

	</nav>
	<div class="background_img">
		<?php echo caGetThemeGraphic($this->request, 'landing_page_img.jpg'); ?>
		<div class="arrow-down" onclick="location.href='#pageArea'"></div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div id="pageArea" <?php print caGetPageCSSClasses(); ?>>