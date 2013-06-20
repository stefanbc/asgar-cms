</div>
<!-- end content -->
</div>

<!-- begin footer -->
<footer> &copy; 2012 - <?=date('Y');?> Copyright <a href="https://coderbits.com/stefanbc" title="Find me!" target="_blank">Stefan Cosma</a> | Powered by <a href="https://github.com/stefanbc/Asgar" title="Asgar" target="_blank">Asgar</a></footer>

<!-- Asgar footer scripts -->
<?=asg_scripts('footer')?>

<!-- Load all script using requirejs -->
<script type="text/javascript">
require(['<?=INCLUDES.JS?>require-config.min'], function() {
    require(['jQuery','log','modal','tipsy','functions','general'], function () {
    	// $.getScript("<?=asg_themefolder('js',false)?>jquery.sharrre-1.3.4.min.js");
    	// $.getScript("<?=asg_themefolder('js',false)?>jquery.zclip.min.js");
    	// $.getScript("<?=asg_themefolder('',false)?>custom.js");
    });
});
</script>

</body>
</html>