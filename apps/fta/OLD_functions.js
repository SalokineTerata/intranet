function lien_selection_chapitre() {
    i = document.form_action.action.selectedIndex;
    if (i === "I")
        return;
    url = "transiter.php?id_fta=" + document.form_action.id_fta.value + "&action=" + document.form_action.action[i].value;
    parent.location.href = url;
}

function js_page_reload() {
    current_page = document.form_action.current_page.value;
    current_query = document.form_action.current_query.value;
    reload = document.form_action.page_reload.value;
    url = current_page + "?" + current_query + "&page_reload=" + reload;
    parent.location.href = url;
}

/*
 ajaxAutosave
 Gère les mises à jour de données AJAX en arrière plan.
 Icone trouvés sur http://preloaders.net/en/search/circle
 http://www.squalenet.net/fr/pc/articles/ajax-asynchronous-javascript-and-xml-premiers-pas.php5
 */

function ajaxAutosave(ParamTableName, ParamKeyName, ParamKeyValue, ParamFieldName)
{
    //Définition des variables
    var TableName = ParamTableName;
    var KeyName = ParamKeyName;
    var KeyValue = ParamKeyValue;
    var FieldName = ParamFieldName;
    var TagData = 'DATA_' + TableName + "_" + FieldName;
    var TagStatus = 'STATUS_' + TableName + "_" + FieldName;
    var Data = document.getElementById(TagData);
    var FieldValue = Data.value;
    var UrlParameter = 'TableName=' + TableName
            + '&KeyName=' + KeyName
            + '&KeyValue=' + KeyValue
            + '&FieldName=' + FieldName
            + '&FieldValue=' + FieldValue
            ;
    var HtmlImageLoading = '<img src=../lib/images/loading-mini.gif width=22  border=0 valign=middle />';
    var PhpAjaxFile = './modification_fiche_ajax.php';
    function handleAJAXReturnCustom()
    {
        var ParamTagStatus = TagStatus;
        var ParamHttp = http;
        handleAJAXReturn(ParamTagStatus, ParamHttp);
    }

    //Coeur de gestion du fonctionnement AJAX
    document.getElementById(TagStatus).innerHTML = HtmlImageLoading;
    var http = createRequestObject();
    http.open('get', PhpAjaxFile + '?' + UrlParameter, true);
    http.onreadystatechange = handleAJAXReturnCustom;
    http.send(null);
}

function handleAJAXReturn(ParamTagStatus, ParamHttp)
{
    //<?php echo Html::$DEFAULT_HTML_IMAGE_OK ?>
    
    //Définition des variables
    var TagStatus = ParamTagStatus;
    var Http = ParamHttp;
    var HtmlImageOk = '<?php echo Html::$DEFAULT_HTML_IMAGE_OK ?>';
    var HtmlImageFailed = '<?php echo Html::$DEFAULT_HTML_IMAGE_FAILED ?>';

    //Corps de la fonction
    if (Http.readyState === 4)
    {
        //Ici, possibilité d'ajouter du précontrôle si besoin...
        if (Http.status === 200)
        {
            document.getElementById(TagStatus).innerHTML = HtmlImageOk;
        }
        else
        {
            document.getElementById(TagStatus).innerHTML = HtmlImageFailed;
        }
    }
}
