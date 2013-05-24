requirejs.config({
    baseUrl: 'asg-assets/js/',
    paths: {
        log         : 'modules/log',
        jQuery      : 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min',
        modal       : 'modules/jquery.modal.min',
        sharrre     : 'modules/jquery.sharrre-1.3.4.min',
        tipsy       : 'modules/jquery.tipsy.min',
        zclip       : 'modules/jquery.zclip.min',
        functions   : 'functions.min',
        general     : 'general.min'
    },
    shim: {
        'modal'     : ['jQuery'],
        'scrollTo'  : ['jQuery'],
        'sharrre'   : ['jQuery'],
        'tipsy'     : ['jQuery'],
        'zclip'     : ['jQuery'],
        'functions' : ['jQuery'],
        'general'   : { deps: ['log','jQuery','functions','modal','sharrre','tipsy','zclip'] },
    },
    waitSeconds: 15
});