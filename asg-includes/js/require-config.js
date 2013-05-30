requirejs.config({
    baseUrl: 'asg-includes/js/',
    paths: {
        log         : 'log',
        jQuery      : '//code.jquery.com/jquery-latest.min',
        modal       : 'modal.min',
        tipsy       : 'tipsy.min',
        functions   : 'functions.min',
        general     : 'general.min'
    },
    shim: {
        'modal'     : ['jQuery'],
        'tipsy'     : ['jQuery'],
        'functions' : ['jQuery'],
        'general'   : { deps: ['log','jQuery','functions','modal','tipsy'] },
    },
    waitSeconds: 15
});