<!-- BEGIN GENERATED FOOTER -->
<div id="footer">
  <p>Copyright &copy; 2012</p>
</div>
</div><!-- END WRAPPER -->

<script type="text/javascript" rel="javascript" src="<?php echo asset_url(); ?>/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" rel="javascript" src="<?php echo asset_url(); ?>/js/jqueryui.js"></script>
<script type="text/javascript" rel="javascript" src="<?php echo asset_url(); ?>/bootstrap/js/bootstrap.min.js"></script>
<?php
// Inject any custom css if it's passed by our controller
if (isset($css)) {
	foreach ($css as $stylesheet) {
		echo '<script src="' . asset_url() .'/js/'. $stylesheet. '.js" type="text/javascript" rel="javascript"></script>';
	}
}
?>
</body>
</html>