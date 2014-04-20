var zen = {};
zen.title2div = function(css){
    var title;
    $('.'+css).hover(
        function(){
            title = this.title;
            this.title = '';
            $(this).css('cursor','pointer');
            $('body').append('<div id="titlediv_jq" class="title_div rounded">'+title+'</div>');
            var win_width = document.documentElement.clientWidth ? document.documentElement.clientWidth : (window.innerWidth ? window.innerWidth : (document.body.clientWidth ? document.body.clientWidth : 1024));
            var width = $('#titlediv_jq').width();
            var x = $(this).offset().left;
            var left = x < (win_width/2) ? x+$(this).width() : x-width;
            var top = $(this).offset().top + $(this).height();
            $('#titlediv_jq').css({'top':top+"px","left":left+"px","opacity":'0'});
            $('#titlediv_jq').animate({opacity:'0.9'},600);
        },
        function(){
            this.title = title;
            $('#titlediv_jq').remove();
        }
    );
}
function isViewState(){
    if (!$("#v_statebox").is(':checked')){
        $("#Data_state").val("");
    }
    $("#v_statespan").toggle();
}

function loadXML(xmlFile)
{
    var xmlDoc;
    try //Internet Explorer
    {
        xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async = false;
        xmlDoc.load(xmlFile);
    }
    catch (e) {
        try //Firefox, Mozilla, Opera
        {
            xmlDoc = document.implementation.createDocument("", "", null);
            xmlDoc.async = false;
            xmlDoc.load(xmlFile);
        }
        catch (e) {
            try //Google Chrome
            {
                var xmlhttp = new window.XMLHttpRequest();
                xmlhttp.open("GET", xmlFile, false);
                xmlhttp.send(null);
                xmlDoc = xmlhttp.responseXML;
            }
            catch (e) {
                error = e.message;
            }
        }
    }
    return xmlDoc;
    /*var xmlDoc;
     if(window.ActiveXObject)
     {
     xmlDoc = new ActiveXObject('Microsoft.XMLDOM');
     xmlDoc.async = false;
     xmlDoc.load(xmlFile);
     }
     else if (navigator.userAgent.indexOf("Firefox") > 0)
     {
     xmlDoc = document.implementation.createDocument('', '', null);
     xmlDoc.async = false;
     xmlDoc.load(xmlFile);
     }
     else
     {
     return null;
     }
     return xmlDoc;*/
}
