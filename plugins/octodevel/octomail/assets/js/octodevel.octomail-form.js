$(document).ready(function(){

    var ShowRecipients = function(){
        var $reciver_name = $('.tab-content .tab-pane:last-child .form-group.widget-field').parent().find('.form-group.span-left');
        var $reciver_email = $('.tab-content .tab-pane:last-child .form-group.widget-field').parent().find('.form-group.span-right');

        if ($('#Form-field-Template-multiple_recipients').prop('checked')) {
            $('.tab-content .tab-pane:last-child .form-group.widget-field').slideDown();
            $reciver_name.eq(5).slideUp();
            $reciver_email.eq(3).slideUp();
        } else {
            $('.tab-content .tab-pane:last-child .form-group.widget-field').slideUp();
            $reciver_name.eq(5).slideDown();
            $reciver_email.eq(3).slideDown();
        }
    }

    $('#Form-field-Template-multiple_recipients').click(function(){
        ShowRecipients();
    });

    ShowRecipients();

});