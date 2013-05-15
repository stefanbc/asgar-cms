<footer> &copy; 2012 - <?=date('Y');?> Made by <a href="https://coderbits.com/stefanbc" title="Find me!" target="_blank">Stefan Cosma</a> with / for <a href="http://koding.com" target="_blank" title="Koding IDE">Koding</a> | Powered by <a href="https://github.com/stefanbc/Asgar" title="Asgar" target="_blank">Asgar</a></footer>

<?php
if(asg_user_role() == 1 && asg_user_loggedin() == true){
    echo '<script src="' . ASSETS . 'editor/ckeditor.js"></script>';
    echo '<script>CKEDITOR.replace("editor");</script>';
}
?>
<script src="<?=JS?>analytics.min.js"></script>
<script src="<?=JS?>require.js"></script>
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
        require(['<?=JS?>require-config.min'], function(){
            require(['log','jQuery','modal','sharrre','tipsy','zclip','functions','general']);
        });
    <?
    }
    ?>
</script>
</body>
</html>