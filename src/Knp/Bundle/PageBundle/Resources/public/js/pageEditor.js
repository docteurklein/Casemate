
Ext.namespace('Knplabs.Cmf');

Knplabs.Cmf.PageEditor = Ext.extend(Ext.util.Observable, {

    config: {}
    ,form: null
    ,menu: null

    ,constructor: function(config) {
        this.addEvents('addPage');

        Ext.apply(this.config, config, {
            el: Ext.get('knp-cmf-add-content-menu')
        });

        this.menu = new Ext.ux.Menu(this.config.el, {
            transitionType: 'slide',
        });

        this.bindEvents();
    }

    ,bindEvents: function() {

        this.config.el.on('click', function(event, target) {
            event.stopEvent();
        }, this);
    }
});
