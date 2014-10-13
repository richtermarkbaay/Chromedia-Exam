$(document).ready(function() {
    SLNBar.isAuthenticated = false;
    SLNBar.urlConnectButton = '\x2Fsession\x2Fnew?target=' + document.URL;

        SLNBar.searchActive = true;
    SLNBar.searchUrl = '\x2Fsearch';
    SLNBar.searchUrlMethod = 'GET';
    SLNBar.searchUrlAutocomplete = '\x2Fsearch_autosuggest';
    SLNBar.searchUrlAutocompleteMethod = 'GET';

        SLNBar.searchAutocompleteSelect = function (event, ui) {
        if (ui.item.path) {
            $("#sln_autocomplete").val(ui.item.label);
            window.location.href = ui.item.path;

            return false;
        }
    }
    SLNBar.searchAutocompleteRenderItem = function (data) {
        var ul = data.ul;
        var item = data.item;
        var group = data.group;
        var first = data.first;

        var label = item.label;

        var regex = new RegExp($('#sln_autocomplete').val(), 'gi');
        label = label.replace(regex, '<strong>$&</strong>');

        return $("<li></li>")
            .addClass('ui-menusln')
            .addClass(first)
            .data("item.autocomplete", item)
            .append("<a class=\"item\">" + label + "</a>")
            .appendTo(ul)
        ;
    };

    $('#sln').html(SLNBar.render());
    SLNBar.bindEvents();
});
