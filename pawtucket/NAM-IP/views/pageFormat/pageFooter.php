<?php
/* ----------------------------------------------------------------------
 * views/pageFormat/pageFooter.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2015-2021 Whirl-i-Gig
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
?>
<div style="clear:both; height:1px;"><!-- empty --></div>
</div><!-- end pageArea --></div><!-- end col --></div><!-- end row --></div><!-- end container -->
<!-- Start footer -->
<footer class="footer-section">
    <div class="container">
        <div class="footer-cta pt-5 pb-5 d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <div class="cta-text">
                            <h4>Nous appeler</h4>
                            <span><a href="tel:+32 81 34 64 99">+32 81 34 64 99</a></span>
                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <div class="cta-text">
                            <h4>Nous écrire</h4>
                            <span><a href="mailto:info@nam-ip.be">info@nam-ip.be</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <div class="cta-text">
                            <h4>Nous trouver</h4>
                            <span><a href="https://goo.gl/maps/gbRTzzK9xaqx1LcJ9">Rue Henri Blès 192A, 5000 Namur</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-content pt-5 pb-5">
            <div class="row">
                <div class="col-xl-4 col-lg-4 mb-50">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <img src="https://www.nam-ip.be/wp-content/uploads/2021/01/YJNAM-IP-logo2017R2-2.jpg" class="img-fluid" alt="logo">
                        </div>
                        <div class="footer-text">
                            <p>Le NAM-IP Museum est conscient de l'importance de la protection des données et au respect de la vie privée de ses clients et des utilisateurs de son site. Il s'engage à respecter la confidentialité des données à caractère personnel qu'il est amené à collecter et à traiter dans le cadre de ses activités, en tant que responsable du traitement.</p>
                        </div>
                    </div>
                </div>
                <div class="container-widget col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Liens utiles</h3>
                        </div>
                        <ul>
                            <li><a href="/ca/pawtucket/index.php">Accueil</a></li>
                            <li><a href="/ca/pawtucket/index.php/Search/advanced/objects">Recherche avancée</a></li>
                            <li><a href="/ca/pawtucket/index.php/Gallery/Index">Galeries</a></li>
                            <li><a href="/ca/pawtucket/index.php/Collections/index">Collections</a></li>
                        </ul>
                        <div class="social-icons">
                            <a href="https://www.instagram.com/computermuseumbelgium/" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://twitter.com/ComputerMuseumB" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/ComputerMuseumBelgium" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/company/computer-museum-belgium/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </div>

                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 text-lg-left">
                    <div class="copyright-text">
                        <p>Copyright &copy; 2022, Tous Droits Réservés <a href="https://www.nam-ip.be">NAM-IP</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer><!-- end footer -->
<?php
//
// Output HTML for debug bar
//
if (Debug::isEnabled()) {
    print Debug::$bar->getJavascriptRenderer()->render();
}
?>

<?php print TooltipManager::getLoadHTML(); ?>
<div id="caMediaPanel">
    <div id="caMediaPanelContentArea">

    </div>
</div>
<script type="text/javascript">
    /*
				Set up the "caMediaPanel" panel that will be triggered by links in object detail
				Note that the actual <div>'s implementing the panel are located here in views/pageFormat/pageFooter.php
			*/
    var caMediaPanel;
    jQuery(document).ready(function() {
        if (caUI.initPanel) {
            caMediaPanel = caUI.initPanel({
                panelID: 'caMediaPanel',
                /* DOM ID of the <div> enclosing the panel */
                panelContentID: 'caMediaPanelContentArea',
                /* DOM ID of the content area <div> in the panel */
                exposeBackgroundColor: '#FFFFFF',
                /* color (in hex notation) of background masking out page content; include the leading '#' in the color spec */
                exposeBackgroundOpacity: 0.7,
                /* opacity of background color masking out page content; 1.0 is opaque */
                panelTransitionSpeed: 400,
                /* time it takes the panel to fade in/out in milliseconds */
                allowMobileSafariZooming: true,
                mobileSafariViewportTagID: '_msafari_viewport',
                closeButtonSelector: '.close' /* anything with the CSS classname "close" will trigger the panel to close */
            });
        }
    });
    /*(function(e,d,b){var a=0;var f=null;var c={x:0,y:0};e("[data-toggle]").closest("li").on("mouseenter",function(g){if(f){f.removeClass("open")}d.clearTimeout(a);f=e(this);a=d.setTimeout(function(){f.addClass("open")},b)}).on("mousemove",function(g){if(Math.abs(c.x-g.ScreenX)>4||Math.abs(c.y-g.ScreenY)>4){c.x=g.ScreenX;c.y=g.ScreenY;return}if(f.hasClass("open")){return}d.clearTimeout(a);a=d.setTimeout(function(){f.addClass("open")},b)}).on("mouseleave",function(g){d.clearTimeout(a);f=e(this);a=d.setTimeout(function(){f.removeClass("open")},b)})})(jQuery,window,200);*/
</script>
</body>

</html>