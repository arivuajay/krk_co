(function($)
{
    //Style for fullscreen mode
    var fullscreen = 'display:block; height: 100%; left: 0; position: fixed; top: 0; width: 100%; z-index: 9999;',
    fullscreenIframe = 'height: 100%; width: 100%;', 
    normalscreenIframe = 'height: 95%; width: 100%;', 
    style = '';

    // Define the fullscreen button
    $.cleditor.buttons.fullscreen = {
        name: 'fullscreen',
        image: 'fullscreen.gif',
        title: 'Fullscreen',
        command: '',
        popupName: '',
        popupClass: '',
        popupContent: '',
        getPressed: fullscreenGetPressed,
        buttonClick: fullscreenButtonClick,
    };

    // Add the button to the default controls before the bold button
    $.cleditor.defaultOptions.controls = $.cleditor.defaultOptions.controls.replace("bold", "fullscreen | bold");

    function fullscreenGetPressed(data)
    {
        return data.editor.$main.hasClass('fullscreen');
    };

    function fullscreenButtonClick(e, data)
    {
        var main = data.editor.$main;
        var iframe = data.editor.$frame;

        if (main.hasClass('fullscreen'))
        {
            main.attr('style', style).removeClass('fullscreen');
            iframe.attr('style', normalscreenIframe);
        }
        else
        {
            style = main.attr('style');
            main.attr('style', fullscreen).addClass('fullscreen');
            iframe.attr('style', fullscreenIframe).removeClass('fullscreen');
        };
        editor.refresh(data.editor);
        editor.focus();
        return false;
    }
})(jQuery);