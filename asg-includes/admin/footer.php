</div>
<!-- end content -->
</div>

<!-- begin footer -->
<footer> &copy; 2012 - <?=date('Y');?> Copyright <a href="https://coderbits.com/stefanbc" title="Find me!" target="_blank">Stefan Cosma</a> | Powered by <a href="https://github.com/stefanbc/Asgar" title="Asgar" target="_blank">Asgar</a></footer>

<!-- Asgar footer scripts -->
<?=asg_scripts('footer')?>

<!-- Load all script using requirejs -->
<script type="text/javascript">
require(['<?=INCLUDES.JS?>require-config'], function() {
    require(['jQuery','log','modal','tipsy','functions','general'], function () {
    	$.getScript("<?=INCLUDES.ADMIN_ASSETS_JS?>admin-style.js");
    });
});
</script>

</body>
</html>