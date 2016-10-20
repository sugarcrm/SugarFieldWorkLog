({
    /**
     * {@inheritDoc}
     */
    fieldTag: 'textarea',
    displayValue: '',

    /**
     * Default settings used when none are supplied through metadata.
     *
     * Supported settings:
     * - {Number} max_lines - The maximum number of line breaks (<br>) to be displayed before truncating the field.
     * - {Boolean} collapsed - Defines whether or not the textarea detail view should be collapsed on initial render.
     * - {Boolean} reverse_lines - Defines whether or not the last or first lines are shown for the worklog
     *
     *     'settings' => array(
     *         'max_lines' => 10,
     *         'collapsed' => false
     *         'reverse_lines => false
     *     ),
     *
     * @protected
     * @type {Object}
     */
    _defaultSettings: {
        collapsed: true,
        max_lines: 10,
        reverse_lines: true
    },

    /**
     * State variable that keeps track of whether or not the textarea field
     * is collapsed in detail view.
     *
     * @type {Boolean}
     */
    collapsed: undefined,

    /**
     * Settings after applying metadata settings on top of
     * {@link View.Fields.BaseTextareaField#_defaultSettings default settings}.
     *
     * @protected
     */
    _settings: {},

    /**
     * {@inheritDoc}
     */
    plugins: ['EllipsisInline'],

    /**
     * {@inheritDoc}
     */
    events: {
        'click [data-action=toggle]': 'toggleCollapsed'
    },

    /**
     * {@inheritDoc}
     *
     * Initializes settings on the field by calling
     * {@link View.Fields.BaseTextareaField#_initSettings _initSettings}.
     * Also sets {@link View.Fields.BaseTextareaField#collapsed collapsed}
     * to the value in `this._settings.collapsed` (either default or metadata).
     */
    initialize: function (options) {
        this._super('initialize', [options]);
        this._initSettings();
        this.collapsed = this._settings.collapsed;
    },

    /**
     * Initialize settings, default settings are used when none are supplied
     * through metadata.
     *
     * @return {View.Fields.BaseTextareaField} Instance of this field.
     * @protected
     */
    _initSettings: function () {
        this._settings = _.extend({},
            this._defaultSettings,
            this.def && this.def.settings || {}
        );
        return this;
    },

    /**
     * {@inheritDoc}
     *
     * Prevents editing the textarea field in a list view.
     *
     * @param {String} name The mode to set the field to.
     */
    setMode: function (name) {
        var mode = (this.tplName === 'list') && _.contains(['edit', 'disabled'], name) ? this.tplName : name;
        this._super('setMode', [mode]);
    },

    /**
     * {@inheritDoc}
     *
     * Formatter that always returns the value set on the textarea field. Sets
     * a `short` value for a truncated representation, if the lenght of the
     * value on the field exceeds that of `max_display_chars`. The return value
     * can either be a string, or an object such as {long: 'abc'} or
     * {long: 'abc', short: 'ab'}, for example.
     *
     * @param {String} value The value set on the textarea field.
     * @return {String|Object} The value set on the textarea field.
     */
    format: function (value) {

        if (this.tplName !== 'edit') {

            var long = this.model.get(this.name + '_history');

            if (_.isUndefined(long)) {
                long = '';
            }

            long = long.trim();

            if (!_.isUndefined(value) && !_.isEmpty(value)) {
                var escapedValue = $('<div/>').text(value).html();
                long = long + "<hr>" + escapedValue;
            }

            this.displayValue = {long: long, short: long};

            this._settings.max_lines = parseInt(this._settings.max_lines);

            var logLines = this.displayValue.long.split('<br>');

            if (_.size(logLines) > this._settings.max_lines) {
                var short = '';

                if (this._settings.reverse_lines) {
                    var offset = parseInt(_.size(logLines), 10) - this._settings.max_lines;
                    for (var i = offset; i < _.size(logLines); i++) {
                        short += logLines[i] + '<br>';
                    }
                }
                else {
                    for (var i = 0; i < this._settings.max_lines; i++) {
                        short += logLines[i] + '<br>';
                    }
                }

                this.displayValue.short = short.trim();
            }

        }

        return value;
    },

    /**
     * Toggles the field between displaying the truncated `short` or `long`
     * value for the field, and toggles the label for the 'more/less' link.
     */
    toggleCollapsed: function () {
        this.collapsed = !this.collapsed;
        this.render();
    }
})
