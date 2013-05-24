<footer> &copy; 2012 - <?=date('Y');?> Copyright <a href="https://coderbits.com/stefanbc" title="Find me!" target="_blank">Stefan Cosma</a> | Powered by <a href="https://github.com/stefanbc/Asgar" title="Asgar" target="_blank">Asgar</a></footer>

<?php
if(asg_user_role() == 1 && asg_user_loggedin() == true){
    echo '<script src="' . ASSETS . 'editor/ckeditor.js"></script>';
    echo '<script>CKEDITOR.replace("editor");</script>';
}
?>
<script src="<?=THEMES.ACTIVE_THEME.THEME_JS?>analytics.min.js"></script>
<script src="<?=THEMES.ACTIVE_THEME.THEME_JS?>require.js"></script>
<script type="text/javascript">
    <?php
    if(asg_user_role() == 1 && asg_user_loggedin() == true){
    ?>
        require(['<?=JS_ADMIN?>require-config-admin.min'], function(){
            require(['log','jQuery','modal','sharrre','tipsy','zclip','functions','general_admin','general']);
        });
    <?
    } else {
    ?>
        require(['<?=THEMES.ACTIVE_THEME.THEME_JS?>require-config.min'], function(){
            require(['log','jQuery','modal','sharrre','tipsy','zclip','functions','general']);
        });
    <?
    }
    ?>
</script>
</body>
</html>