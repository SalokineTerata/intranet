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

    function chargement() {
        document.getElementById('chargement').style.display = 'none';
        document.getElementById('site').style.visibility = 'visible';
    }
    function lockFields(ParamFieldName, ParamIdFta) {

        if (confirm("Etes vous certain de vouloir modifier l\'état de ce champ ? Car les Fta Secondaires seront aussi affectées."))
        {
            location.href = "modification_fta_primaire_etat.php?FieldName=" + ParamFieldName
                    + "&id_fta=" + ParamIdFta;
        }
        else {
        }

    }
    function desactivationLockFields(ParamIdFta, ParamIdFtaChapitreEncours, ParamSyntheseAction, ParamComeback, ParamIdFtaEtat, ParamAbreviationFtaEtat, ParamIdFtaRole) {

        if (confirm("Etes vous certain de vouloir désactiver le Code  Primaire de cette Fta ?"))
        {
            location.href = "modification_fta_primaire_desactivation.php?id_fta=" + ParamIdFta
                    + "&id_fta_chapitre_encours=" + ParamIdFtaChapitreEncours
                    + "&synthese_action=" + ParamSyntheseAction
                    + "&comeback=" + ParamComeback
                    + "&id_fta_etat=" + ParamIdFtaEtat
                    + "&abreviation_fta_etat=" + ParamAbreviationFtaEtat
                    + "&id_fta_role=" + ParamIdFtaRole;
        }
        else {
        }


    }
    function ajaxDoAction(ParamTagId, ParamCallFile, ParamUrlParameter, ParamCallbackFunction, ParamCallbackFunctionParameters) {


        var TagId = ParamTagId;
        var PhpAjaxFile = ParamCallFile;
        var CallbackFunction = ParamCallbackFunction;
        var CallbackFunctionParameters = ParamCallbackFunctionParameters;
        var TagData = TagId;
        var Data = document.getElementById(TagData);
        var FieldValue = Data.value;
//        var FieldValueForUrl = escape(FieldValue);
        var FieldValueForUrl = encodeURIComponent(FieldValue);
        //alert(FieldValueForUrl);

//        var HtmlImageLoading = '<?php echo Html::DEFAULT_HTML_IMAGE_LOADING ?>';
//        var TagStatus = '<?php echo Html::PREFIXE_ID_ICON_STATUS ?>' + '_' + TagId;
        var UrlParameter = ParamUrlParameter + '&FieldValue=' + FieldValueForUrl;
        function handleAJAXReturnCustom()
        {
//            var ParamTagStatus = TagStatus;
            var ParamHttp = http;
//            handleAJAXReturn(ParamTagStatus, ParamHttp, CallbackFunction, CallbackFunctionParameters);
            handleAJAXReturn(ParamHttp, CallbackFunction, CallbackFunctionParameters);
        }

        //Coeur de gestion du fonctionnement AJAX
//        document.getElementById(TagStatus).innerHTML = HtmlImageLoading;
        var http = createRequestObject();
        http.open('get', PhpAjaxFile + '?' + UrlParameter, true);
        http.onreadystatechange = handleAJAXReturnCustom;
        http.send(null);
    }



    function handleAJAXReturn(ParamHttp, ParamCallbackFunction, ParamCallbackFunctionParameters)
    {

        //Définition des variables
//        var TagStatus = ParamTagStatus;
        var Http = ParamHttp;
//        var HtmlImageOk = '<?php echo Html::DEFAULT_HTML_IMAGE_OK ?>';
//        var HtmlImageFailed = '<?php echo Html::DEFAULT_HTML_IMAGE_FAILED ?>';
        var CallbackFunction = ParamCallbackFunction;
        var CallbackFunctionParameters = ParamCallbackFunctionParameters;
        //Corps de la fonction
        //0 : L'objet XHR a été créé, mais pas encore initialisé (la méthode open n'a pas encore été appelée)
        //1 : L'objet XHR a été créé, mais pas encore envoyé (avec la méthode send )
        //2 : La méthode send vient d'être appelée
        //3 : Le serveur traite les informations et a commencé à renvoyer des données
        //4 : Le serveur a fini son travail, et toutes les données sont réceptionnées
        if (Http.readyState === 4)
        {
            //Ici, possibilité d'ajouter du précontrôle si besoin...
            if (Http.status === 200)
            {
//                document.getElementById(TagStatus).innerHTML = HtmlImageOk;

                //Si une fonction CallBack est définie, on l'exécute.
                if (CallbackFunction !== "") {
                    window[CallbackFunction](CallbackFunctionParameters);
                }
            }
//            else
//            {
//                document.getElementById(TagStatus).innerHTML = HtmlImageFailed;
//            }
        }
    }

</script>