
Ext.namespace('Knplabs.Cmf');

Knplabs.Cmf.PageEditor = Ext.extend(Ext.util.Observable, {

    config: {}
    ,form: null
    ,menu: null

    ,constructor: function(config) {
        this.addEvents('addPage');

        Ext.apply(this.config, config, {
        });

        this.menu = new Ext.ux.Menu('knp-cmf-menu', {
            transitionType: 'slide',
        });

        this.bindEvents();
    }

    ,bindEvents: function() {

        Ext.fly('add-content').on('click', function(event, target) {

            if(matches = this.matches(target)) {
                this.select(target, matches);
            }
            else {
                this.form.hide();
            }
        }, this);

        this.form.on('submit', function(event) {

            self = this;
            event.stopEvent();
            Ext.Ajax.request({
                form: 'knplabs-translator-form'
                ,method: 'POST'
                ,success: function() {
                    self.form.hide();
                }
            });
        }, this);
    }

    ,select: function(element, matches) {
        this.fireEvent('select', this, element, matches);

        Ext.fly('knplabs-translator-id').dom.value = matches.id;
        Ext.fly('knplabs-translator-domain').dom.value = matches.domain;
        Ext.fly('knplabs-translator-locale').dom.value = matches.locale;
        Ext.fly('knplabs-translator-value').dom.value = matches.value;

        this.form.setY(Ext.fly(element).getY());
        this.form.show();
    }

    ,createForm: function() {
        var form = Ext.DomHelper.append(document.body, {
            id:'knplabs-translator-container'
            ,children: [{
                tag: 'form'
                ,id:'knplabs-translator-form'
                ,action: this.config.url
                ,cls: 'translator-form'
                ,children: [
                     { tag: 'label', for: 'knplabs-translator-id', html: 'id' }
                    ,{ tag: 'input', type: 'text', name: 'id',     cls: 'id', id: 'knplabs-translator-id' }
                    ,{ tag: 'label', for: 'knplabs-translator-value', html: 'Value' }
                    ,{ tag: 'input', type: 'text', name: 'value',  cls: 'value', id: 'knplabs-translator-value' }
                    ,{ tag: 'label', for: 'knplabs-translator-domain', html: 'Domain' }
                    ,{ tag: 'input', type: 'text', name: 'domain', cls: 'domain', id: 'knplabs-translator-domain' }
                    ,{ tag: 'label', for: 'knplabs-translator-locale', html: 'Locale' }
                    ,{ tag: 'input', type: 'text', name: 'locale', cls: 'locale', id: 'knplabs-translator-locale' }
                    ,{ tag: 'input', type: 'submit', value: 'Submit' }
                    ,{ tag: 'input', type: 'hidden', name: '_method', value: 'PUT' }
                ]
            }]
        });

        return form;
    }
});
