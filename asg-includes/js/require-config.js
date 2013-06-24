requirejs.config({
    baseUrl: 'asg-includes/js/',
    paths: {
        jQuery: '//code.jquery.com/jquery-latest.min',
        log: 'log',
        modal: 'modal.min',
        tipsy: 'tipsy.min',
        functions: 'functions',
        general: 'general'
    },
    shim: {
        'modal': ['jQuery'],
        'tipsy': ['jQuery'],
        'functions': ['jQuery'],
        'general': {
            deps: ['jQuery', 'log', 'functions', 'modal', 'tipsy']
        }
    },
    waitSeconds: 15
});