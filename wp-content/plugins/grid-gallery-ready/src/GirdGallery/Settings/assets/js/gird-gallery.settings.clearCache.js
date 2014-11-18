/*global jQuery*/
(function (app, $) {

    function clearCache(event) {
        event.preventDefault();

        this.request = app.Ajax.Post({
            module: 'settings',
            action: 'clearCache'
        });

        this.request.send(function () {
            $.jGrowl('Application\'s cache was be successfully cleared.');
        });
    }

    function toggleCacheSettings() {
        this.rows = ['#cacheTtlRow', '#cacheClearRow'];
        this.show = this.options[this.selectedIndex].value;

        if(parseInt(this.show)) {
            alert("Settings changes cant take part in gallery layout while this option is turned on");
        }

        $.each(this.rows, $.proxy(
            function (index, row) {
                var $row = $(row);
                parseInt(this.show, 10) === 0 ? $row.hide() : $row.show();
            }, this)
        );
    }

    $(document).ready(function () {
        $('#clearCache').on('click', clearCache);
        $('#cacheEnabled')
            .on('change', toggleCacheSettings)
            .trigger('change');
    });

}(window.ReadyGridGallery = window.ReadyGridGallery || {}, jQuery));