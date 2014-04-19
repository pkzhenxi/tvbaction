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
