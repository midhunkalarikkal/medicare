window.onload = function(){
    var pageTitle = document.title;
    var attentionMessage ="Medicare Webapp";
    var blinkEvent = null;

    document.addEventListener('visibilitychange', function(e){
        var isPageActive = !document.hidden;
        if(isPageActive){
            blink();
            }else{
                document.title = pageTitle;
                clearinterval(blinkEvent);
            }
    });

    function blink(){
        blinkEvent = setInterval(() => {
            if (document.title === attentionMessage) {
                document.title = pageTitle;
            }else{
                document.title = attentionMessage;
            }
        }, 1000);
    }
};