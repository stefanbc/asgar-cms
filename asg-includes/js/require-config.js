requirejs.config({
    baseUrl: 'asg-includes/js/',
    paths: {
        jQuery      : '//code.jquery.com/jquery-latest.min',
        log         : 'log',
        modal       : 'modal.min',
        tipsy       : 'tipsy.min',
        functions   : 'functions.min',
        general     : 'general.min'
    },
    shim: {
        'jQuery'    : { exports: '$' },
        'modal'     : ['jQuery'],
        'tipsy'     : ['jQuery'],
        'editor'    : ['jQuery'],
        'functions' : ['jQuery'],
        'general'   : { deps: ['log','jQuery','functions','modal','tipsy'] }
    },
    waitSeconds: 15
});

require(['jQuery','log','modal','tipsy','functions','general']);