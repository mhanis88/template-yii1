/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


window.onresize = function (event) {
    CheckTabSize();
};

$('.nav-tabs li').click(function () {
    setTimeout(SetActiveTabsYourself, 10);
});

var ShownTabs = '.nav-tabs .tab[style!="display: none;"]';
var HiddenTabs = '.nav-tabs .tab[style*="display: none;"]';
function CheckTabSize() {
    //Get Tab Area
    var buttonWidth = $('#nav-buttons').width();
    var tabAreaWidth = $('.nav-tabs').width() - buttonWidth;
    var tabWidths = 0;
    var firstHidden;

    //Add Up the Tabs' Widths
    $.each($(ShownTabs), function (idx, obj) {
        tabWidths += $(obj).outerWidth(); //padding
    });

    //Find out which ones to hide
    while (tabWidths > tabAreaWidth) {
        var hider = $(ShownTabs).last();
        tabWidths -= $(hider).outerWidth();
        $(hider).hide();
    }

    //See if we can show any
    firstHidden = $(HiddenTabs).first();
    while (firstHidden.length > 0 && (tabWidths + firstHidden.width()) < tabAreaWidth) {
        tabWidths += $(firstHidden).outerWidth();
        $(firstHidden).show();
        firstHidden = $(HiddenTabs).first();
    }

    //Affect drop-down button
    if ($(HiddenTabs).length === 0) {
        $('#tabDrop').hide();
    } else {
        $('#tabDrop').show();
    }

    //Hide drop-down tabs as necessary
    var shown = $(ShownTabs);

    $.each($('#tabDropdown li'), function (idx, obj) {
        var isInShown = $.grep(shown, function (el) {
            return $(el).find('a').data('target') == $(obj).find('a').data('target');
        }).length > 0;
        if (isInShown) {
            $(obj).hide();
        } else {
            $(obj).show();
        }
    });
}
function SetActiveTabsYourself() {
    $('.nav-tabs li').removeClass('active');
    var activeTab = $('.tab-pane.active');
    if (activeTab.length > 0) {
        var activeID = $(activeTab[0]).attr('id');
        $('.nav-tabs li a[data-target=#' + activeID + ']').parent().addClass('active');
    }
}

setTimeout(CheckTabSize, 100);
setTimeout(SetActiveTabsYourself, 100);