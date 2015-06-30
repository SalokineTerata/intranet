<?php ?>
<script type="text/javascript">
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



    function changerCouleur(tableauFiche)
    {
        tableauFiche.style.backgroundColor = '#AAAAFF';
    }

$(document).ready(function changerCouleur() {
  $("#tableauFiche").on("click", "td", function changerCouleur(tableauFiche) {
    // Gestionnaire d'évènement unique pour l'ensemble des <td>
  });
});
    /**
     * AjaxAutosave
     * Gère les mises à jour de données AJAX en arrière plan.
     * Icone trouvés sur http://preloaders.net/en/search/circle
     * @link http://www.squalenet.net/fr/pc/articles/ajax-asynchronous-javascript-and-xml-premiers-pas.php5
     * @link http://fr.openclassrooms.com/informatique/cours/ajax-et-l-echange-de-donnees-en-javascript/l-objet-xmlhttprequest-1
     * @param {type} ParamTagId
     * @param {type} ParamCallFile
     * @param {type} ParamURL
     * @param {type} ParamCallbackFunction
     * @param {type} ParamCallbackFunctionParameters
     * @returns {undefined}
     */
    function ajaxAutosave(ParamTableName, ParamKeyName, ParamKeyValue, ParamFieldName, ParamCallbackFunction, ParamCallbackFunctionParameters)
    {

        //Définition des variables
        var TableName = ParamTableName;
        var KeyName = ParamKeyName;
        var KeyValue = ParamKeyValue;
        var FieldName = ParamFieldName;
        var ParamTagId = TableName + "_" + FieldName + "_" + KeyValue;
        var ParamUrlParameter = 'TableName=' + TableName
                + '&KeyName=' + KeyName
                + '&KeyValue=' + KeyValue
                + '&FieldName=' + FieldName
                ;
        var ParamCallFile = './modification_fiche_ajax.php';
        var ParamCallbackFunction = ParamCallbackFunction;
        var ParamCallbackFunctionParameters = ParamCallbackFunctionParameters;
        AjaxDoAction(ParamTagId, ParamCallFile, ParamUrlParameter, ParamCallbackFunction, ParamCallbackFunctionParameters);

    }
    function ajaxDoAction(ParamTagId, ParamCallFile, ParamUrlParameter, ParamCallbackFunction, ParamCallbackFunctionParameters) {


        var TagId = ParamTagId;
        var PhpAjaxFile = ParamCallFile;
        var CallbackFunction = ParamCallbackFunction;
        var CallbackFunctionParameters = ParamCallbackFunctionParameters;

        var TagData = TagId;
        var Data = document.getElementById(TagData);
        var FieldValue = Data.value;
        var FieldValueForUrl = escape(FieldValue);

        //alert(FieldValueForUrl);

        var HtmlImageLoading = '<?php echo Html::DEFAULT_HTML_IMAGE_LOADING ?>';
        var TagStatus = '<?php echo Html::PREFIXE_ID_ICON_STATUS ?>' + '_' + TagId;

        var UrlParameter = ParamUrlParameter + '&FieldValue=' + FieldValueForUrl;


        function handleAJAXReturnCustom()
        {
            var ParamTagStatus = TagStatus;
            var ParamHttp = http;
            handleAJAXReturn(ParamTagStatus, ParamHttp, CallbackFunction, CallbackFunctionParameters);
        }

        //Coeur de gestion du fonctionnement AJAX
        document.getElementById(TagStatus).innerHTML = HtmlImageLoading;
        var http = createRequestObject();
        http.open('get', PhpAjaxFile + '?' + UrlParameter, true);
        http.onreadystatechange = handleAJAXReturnCustom;
        http.send(null);
    }

    function handleAJAXReturn(ParamTagStatus, ParamHttp, ParamCallbackFunction, ParamCallbackFunctionParameters)
    {

        //Définition des variables
        var TagStatus = ParamTagStatus;
        var Http = ParamHttp;
        var HtmlImageOk = '<?php echo Html::DEFAULT_HTML_IMAGE_OK ?>';
        var HtmlImageFailed = '<?php echo Html::DEFAULT_HTML_IMAGE_FAILED ?>';
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
                document.getElementById(TagStatus).innerHTML = HtmlImageOk;

                //Si une fonction CallBack est définie, on l'exécute.
                if (CallbackFunction !== "") {
                    window[CallbackFunction](CallbackFunctionParameters);
                }
            }
            else
            {
                document.getElementById(TagStatus).innerHTML = HtmlImageFailed;
            }
        }
    }
    function displayTrueElementById(ParamId) {
        var targetElement;
        targetElement = document.getElementById(ParamId);
        targetElement.style.display = "";
    }
    function displayFalseElementById(ParamId) {
        var targetElement;
        targetElement = document.getElementById(ParamId);
        targetElement.style.display = "none";
    }

    function displayPoidsElem(Param) {

        var Parameters = Param.split(",", 2);
        var idElementUniteFacturation = Parameters[0];
        var idElementDataPoidsElem = Parameters[1];
        var idElementRowPoidsElem = '<?php echo Html::PREFIXE_ID_ROW . "_" ?>' + idElementDataPoidsElem;

        elementUniteFacturation = document.getElementById(idElementUniteFacturation);

        if (elementUniteFacturation.value === '<?php echo FtaModel::ID_POIDS_VARIABLE ?>')
        {
            displayFalseElementById(idElementRowPoidsElem);
            document.getElementById(idElementDataPoidsElem).value = "0";
            document.getElementById(idElementDataPoidsElem).onchange();

        } else {
            displayTrueElementById(idElementRowPoidsElem);
        }
    }
</script>