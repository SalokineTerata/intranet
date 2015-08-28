<?php ?>
<script type='text/javascript'>
    function lien_selection(formu, list, listsuiv)
    {
        i = document.forms[formu].elements[list].selectedIndex;
        url = document.forms[formu].elements[list].options[i].value;
        parent.location.href = url;
    }

    function MM_openBrWindow(theURL, winName, features)
    { //v2.0
        window.open(theURL, winName, features);
    }

    function createRequestObject()
    {
        var http;
        if (window.XMLHttpRequest)
        { // Mozilla, Safari, ...
            http = new XMLHttpRequest();
        }
        else if (window.ActiveXObject)
        { // Internet Explorer
            http = new ActiveXObject('Microsoft.XMLHTTP');
        }
        return http;
    }

</script>