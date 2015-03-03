jQuery(document).ready(function($){

    $('#toggle-navigation').on('click', openNavigation );

    function openNavigation() {
        $('#menu-primary').toggleClass('open');
    }

    $('#search-button').on('click', openSearchBar );

    function openSearchBar() {
        var iconContainer = $('#icon-container')
        if( iconContainer.hasClass('open') ) {
            iconContainer.removeClass('open');
        } else {
            iconContainer.addClass('open')
        }
    }

    // add share buttons
    var shareButtons = new Share('.share-buttons', {
        ui: {
            flyout: 'middle right'
        }
    });

    // on button click
    $('#generate-keywords').on('click', function(){

        // get modifiers
        var modifiers = $('#keyword-modifiers').val();

        // trim
        modifiers = $.trim(modifiers);

        // convert by line to array
        modifiers = modifiers.split('\n');

        // get user inputted keywords
        var keywords = $('#user-keywords').val();

        // trim
        keywords = $.trim(keywords);

        // convert by line to array
        keywords = keywords.split('\n');

        // combine and output results
        outputKeywords(keywords, modifiers);

        $('#keyword-output').addClass('glow');

        setTimeout(function(){
            $('#keyword-output').removeClass('glow');
        }, 500);

        setTimeout(function(){
            shareButtons.open();
        }, 5000);
    });

    // combine user keywords with modifiers and output them
    function outputKeywords(keywords, modifiers) {

        // empty the keyword results textarea
        $('#keyword-output').empty();

        // output each keyword
        $.each(keywords, function( index, value){
            $('#keyword-output').append(value + "\n");
        });

        // output each keyword with each modifier before it
        $.each(keywords, function( keywordIndex, keywordValue){

            $.each(modifiers, function( modifierIndex, modifierValue){
                $('#keyword-output').append(modifierValue + ' ' + keywordValue + "\n");
            });
        });
    }
});