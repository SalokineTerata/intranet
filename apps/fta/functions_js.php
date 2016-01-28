<?php ?>
<script type="text/javascript">

    function lien_selection(formu, list, listsuiv)
    {
        i = document.forms[formu].elements[list].selectedIndex;
        url = document.forms[formu].elements[list].options[i].value;
        parent.location.href = url;
    }

    function lien_selection_chapitre() {
        i = document.form_action.action.selectedIndex;
        if (i === "I")
            return;
        url = "transiter.php?id_fta=" + document.form_action.id_fta.value
                + "&action=" + document.form_action.action[i].value
                + "&id_fta_role=" + document.form_action.id_fta_role.value
                + "&synthese_action=" + document.form_action.synthese_action.value
                + "&demande_abreviation_fta_transition=" + document.form_action.demande_abreviation_fta_transition.value
                ;
        parent.location.href = url;
    }

    function js_page_reload() {
        current_page = document.form_action.current_page.value;
        current_query = document.form_action.current_query.value;
        reload = document.form_action.page_reload.value;
        url = current_page + "?" + current_query + "&page_reload=" + reload;
        parent.location.href = url;
    }

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



    function handleAJAXReturn( ParamHttp, ParamCallbackFunction, ParamCallbackFunctionParameters)
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

    /**
     * Cette fonction gère l'affichage de l'étiquette colis
     * @returns {undefined}
     */
    function displayVerrouEtiq(Param) {

        var Parameters = Param.split(",", 2);
        var idElementVerrouEtiquette = Parameters[0];
        var idElementDataEtiquetteColis = Parameters[1];
        var idElementRowEtiquetteColis = '<?php echo Html::PREFIXE_ID_ROW . "_" ?>' + idElementDataEtiquetteColis;
        elementUniteFacturation = document.getElementById(idElementVerrouEtiquette);
        if (elementUniteFacturation.value != '<?php echo FtaModel::ETIQUETTE_COLIS_VERROUILLAGE_NON ?>')
        {
            displayFalseElementById(idElementRowEtiquetteColis);
            document.getElementById(idElementDataEtiquetteColis).onchange();
        } else {
            displayTrueElementById(idElementRowEtiquetteColis);
        }
    }

    function selection_proprietaire1_js() {
        proprietaire1 = document.form_action.selection_proprietaire1.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        //if (i == 0) return;
        url = "modification_fiche.php?id_fta=" + idFta
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire1.options[proprietaire1].value
                + "&checkIdFtaClasssification=1"

                ;
        parent.location.href = url;
    }

    function selection_proprietaire2_js() {
        proprietaire1 = document.form_action.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire2.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        //if (i == 0) return;
        url = "modification_fiche.php?id_fta=" + idFta
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire2.options[proprietaire2].value
                + "&checkIdFtaClasssification=1"
                ;
    }
    function selection_marque_js() {
        proprietaire1 = document.form_action.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire2.selectedIndex;
        marque = document.form_action.selection_marque.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        url = "modification_fiche.php?id_fta=" + idFta
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire2.options[proprietaire2].value
                + "&selection_marque=" + document.form_action.selection_marque.options[marque].value
                + "&checkIdFtaClasssification=1"

                ;
        parent.location.href = url;
    }
    function selection_activite_js() {
        proprietaire1 = document.form_action.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire2.selectedIndex;
        marque = document.form_action.selection_marque.selectedIndex;
        activite = document.form_action.selection_activite.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        //if (i == 0) return;
        url = "modification_fiche.php?id_fta=" + idFta
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire2.options[proprietaire2].value
                + "&selection_marque=" + document.form_action.selection_marque.options[marque].value
                + "&selection_activite=" + document.form_action.selection_activite.options[activite].value
                + "&checkIdFtaClasssification=1"

                ;
        parent.location.href = url;
    }
    function selection_rayon_js() {
        proprietaire1 = document.form_action.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire2.selectedIndex;
        marque = document.form_action.selection_marque.selectedIndex;
        activite = document.form_action.selection_activite.selectedIndex;
        rayon = document.form_action.selection_rayon.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        //if (i == 0) return;
        url = "modification_fiche.php?id_fta=" + idFta
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire2.options[proprietaire2].value
                + "&selection_marque=" + document.form_action.selection_marque.options[marque].value
                + "&selection_activite=" + document.form_action.selection_activite.options[activite].value
                + "&selection_rayon=" + document.form_action.selection_rayon.options[rayon].value
                + "&checkIdFtaClasssification=1"

                ;
        parent.location.href = url;
    }
    function selection_environnement_js() {
        proprietaire1 = document.form_action.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire2.selectedIndex;
        marque = document.form_action.selection_marque.selectedIndex;
        activite = document.form_action.selection_activite.selectedIndex;
        rayon = document.form_action.selection_rayon.selectedIndex;
        environnement = document.form_action.selection_environnement.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        //if (i == 0) return;
        url = "modification_fiche.php?id_fta=" + idFta
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire2.options[proprietaire2].value
                + "&selection_marque=" + document.form_action.selection_marque.options[marque].value
                + "&selection_activite=" + document.form_action.selection_activite.options[activite].value
                + "&selection_rayon=" + document.form_action.selection_rayon.options[rayon].value
                + "&selection_environnement=" + document.form_action.selection_environnement.options[environnement].value
                + "&checkIdFtaClasssification=1"

                ;
        parent.location.href = url;
    }
    function selection_reseau_js() {
        proprietaire1 = document.form_action.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire2.selectedIndex;
        marque = document.form_action.selection_marque.selectedIndex;
        activite = document.form_action.selection_activite.selectedIndex;
        rayon = document.form_action.selection_rayon.selectedIndex;
        environnement = document.form_action.selection_environnement.selectedIndex;
        reseau = document.form_action.selection_reseau.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        //if (i == 0) return;
        url = "modification_fiche.php?id_fta=" + idFta
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire2.options[proprietaire2].value
                + "&selection_marque=" + document.form_action.selection_marque.options[marque].value
                + "&selection_activite=" + document.form_action.selection_activite.options[activite].value
                + "&selection_rayon=" + document.form_action.selection_rayon.options[rayon].value
                + "&selection_environnement=" + document.form_action.selection_environnement.options[environnement].value
                + "&selection_reseau=" + document.form_action.selection_reseau.options[reseau].value
                + "&checkIdFtaClasssification=1"

                ;
        parent.location.href = url;
    }
    function selection_saisonnalite_js() {
        proprietaire1 = document.form_action.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire2.selectedIndex;
        marque = document.form_action.selection_marque.selectedIndex;
        activite = document.form_action.selection_activite.selectedIndex;
        rayon = document.form_action.selection_rayon.selectedIndex;
        environnement = document.form_action.selection_environnement.selectedIndex;
        reseau = document.form_action.selection_reseau.selectedIndex;
        saisonnalite = document.form_action.selection_saisonnalite.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        //if (i == 0) return;
        url = "modification_fiche.php?id_fta=" + idFta
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire2.options[proprietaire2].value
                + "&selection_marque=" + document.form_action.selection_marque.options[marque].value
                + "&selection_activite=" + document.form_action.selection_activite.options[activite].value
                + "&selection_rayon=" + document.form_action.selection_rayon.options[rayon].value
                + "&selection_environnement=" + document.form_action.selection_environnement.options[environnement].value
                + "&selection_reseau=" + document.form_action.selection_reseau.options[reseau].value
                + "&selection_saisonnalite=" + document.form_action.selection_saisonnalite.options[saisonnalite].value
                + "&checkIdFtaClasssification=1"
                ;
        parent.location.href = url;
    }
    function selection_proprietaire12_js() {
        proprietaire1 = document.form_action.selection_proprietaire12.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        id_fta_chapitre_encours = document.getElementById("id_fta_chapitre_encours").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        gestionnaire = document.getElementById("gestionnaire").value;

        //if (i == 0) return;
        url = "ajout_classification_chemin.php?id_fta=" + idFta
                + "&id_fta_chapitre_encours=" + id_fta_chapitre_encours
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire12.options[proprietaire1].value
                + "&checkIdFtaClasssification=1"
                + "&gestionnaire=" + gestionnaire;
        parent.location.href = url;
    }

    function selection_proprietaire22_js() {
        proprietaire1 = document.form_action.selection_proprietaire12.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire22.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        syntheseAction = document.getElementById("synthese_action").value;
        id_fta_chapitre_encours = document.getElementById("id_fta_chapitre_encours").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        gestionnaire = document.getElementById("gestionnaire").value;

        //if (i == 0) return;
        url = "ajout_classification_chemin.php?id_fta=" + idFta
                + "&id_fta_chapitre_encours=" + id_fta_chapitre_encours
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire12.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire22.options[proprietaire2].value
                + "&checkIdFtaClasssification=1"
                + "&gestionnaire=" + gestionnaire
                ;
        parent.location.href = url;
    }
    function selection_marque2_js() {
        proprietaire1 = document.form_action.selection_proprietaire12.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire22.selectedIndex;
        marque = document.form_action.selection_marque2.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        id_fta_chapitre_encours = document.getElementById("id_fta_chapitre_encours").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        gestionnaire = document.getElementById("gestionnaire").value;

        url = "ajout_classification_chemin.php?id_fta=" + idFta
                + "&id_fta_chapitre_encours=" + id_fta_chapitre_encours
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire12.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire22.options[proprietaire2].value
                + "&selection_marque=" + document.form_action.selection_marque2.options[marque].value
                + "&checkIdFtaClasssification=1"
                + "&gestionnaire=" + gestionnaire
                ;
        parent.location.href = url;
    }
    function selection_activite2_js() {
        proprietaire1 = document.form_action.selection_proprietaire12.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire22.selectedIndex;
        marque = document.form_action.selection_marque2.selectedIndex;
        activite = document.form_action.selection_activite2.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        id_fta_chapitre_encours = document.getElementById("id_fta_chapitre_encours").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        gestionnaire = document.getElementById("gestionnaire").value;

        //if (i == 0) return;
        url = "ajout_classification_chemin.php?id_fta=" + idFta
                + "&id_fta_chapitre_encours=" + id_fta_chapitre_encours
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire12.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire22.options[proprietaire2].value
                + "&selection_marque=" + document.form_action.selection_marque2.options[marque].value
                + "&selection_activite=" + document.form_action.selection_activite2.options[activite].value
                + "&checkIdFtaClasssification=1"
                + "&gestionnaire=" + gestionnaire
                ;
        parent.location.href = url;
    }
    function selection_rayon2_js() {
        proprietaire1 = document.form_action.selection_proprietaire12.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire22.selectedIndex;
        marque = document.form_action.selection_marque2.selectedIndex;
        activite = document.form_action.selection_activite2.selectedIndex;
        rayon = document.form_action.selection_rayon2.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        syntheseAction = document.getElementById("synthese_action").value;
        id_fta_chapitre_encours = document.getElementById("id_fta_chapitre_encours").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        gestionnaire = document.getElementById("gestionnaire").value;

        //if (i == 0) return;
        url = "ajout_classification_chemin.php?id_fta=" + idFta
                + "&id_fta_chapitre_encours=" + id_fta_chapitre_encours
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire12.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire22.options[proprietaire2].value
                + "&selection_marque=" + document.form_action.selection_marque2.options[marque].value
                + "&selection_activite=" + document.form_action.selection_activite2.options[activite].value
                + "&selection_rayon=" + document.form_action.selection_rayon2.options[rayon].value
                + "&checkIdFtaClasssification=1"
                + "&gestionnaire=" + gestionnaire
                ;
        parent.location.href = url;
    }
    function selection_environnement2_js() {
        proprietaire1 = document.form_action.selection_proprietaire12.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire22.selectedIndex;
        marque = document.form_action.selection_marque2.selectedIndex;
        activite = document.form_action.selection_activite2.selectedIndex;
        rayon = document.form_action.selection_rayon2.selectedIndex;
        environnement = document.form_action.selection_environnement2.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        id_fta_chapitre_encours = document.getElementById("id_fta_chapitre_encours").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        gestionnaire = document.getElementById("gestionnaire").value;

        //if (i == 0) return;
        url = "ajout_classification_chemin.php?id_fta=" + idFta
                + "&id_fta_chapitre_encours=" + id_fta_chapitre_encours
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire12.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire22.options[proprietaire2].value
                + "&selection_marque=" + document.form_action.selection_marque2.options[marque].value
                + "&selection_activite=" + document.form_action.selection_activite2.options[activite].value
                + "&selection_rayon=" + document.form_action.selection_rayon2.options[rayon].value
                + "&selection_environnement=" + document.form_action.selection_environnement2.options[environnement].value
                + "&checkIdFtaClasssification=1"
                + "&gestionnaire=" + gestionnaire
                ;
        parent.location.href = url;
    }
    function selection_reseau2_js() {
        proprietaire1 = document.form_action.selection_proprietaire12.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire22.selectedIndex;
        marque = document.form_action.selection_marque2.selectedIndex;
        activite = document.form_action.selection_activite2.selectedIndex;
        rayon = document.form_action.selection_rayon2.selectedIndex;
        environnement = document.form_action.selection_environnement2.selectedIndex;
        reseau = document.form_action.selection_reseau2.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        syntheseAction = document.getElementById("synthese_action").value;
        id_fta_chapitre_encours = document.getElementById("id_fta_chapitre_encours").value;
        gestionnaire = document.getElementById("gestionnaire").value;

//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        //if (i == 0) return;
        url = "ajout_classification_chemin.php?id_fta=" + idFta
                + "&id_fta_chapitre_encours=" + id_fta_chapitre_encours
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire12.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire22.options[proprietaire2].value
                + "&selection_marque=" + document.form_action.selection_marque2.options[marque].value
                + "&selection_activite=" + document.form_action.selection_activite2.options[activite].value
                + "&selection_rayon=" + document.form_action.selection_rayon2.options[rayon].value
                + "&selection_environnement=" + document.form_action.selection_environnement2.options[environnement].value
                + "&selection_reseau=" + document.form_action.selection_reseau2.options[reseau].value
                + "&checkIdFtaClasssification=1"
                + "&gestionnaire=" + gestionnaire
                ;
        parent.location.href = url;
    }
    function selection_saisonnalite2_js() {
        proprietaire1 = document.form_action.selection_proprietaire12.selectedIndex;
        proprietaire2 = document.form_action.selection_proprietaire22.selectedIndex;
        marque = document.form_action.selection_marque2.selectedIndex;
        activite = document.form_action.selection_activite2.selectedIndex;
        rayon = document.form_action.selection_rayon2.selectedIndex;
        environnement = document.form_action.selection_environnement2.selectedIndex;
        reseau = document.form_action.selection_reseau2.selectedIndex;
        saisonnalite = document.form_action.selection_saisonnalite2.selectedIndex;
        idFta = document.getElementById("id_fta").value;
        id_fta_chapitre_encours = document.getElementById("id_fta_chapitre_encours").value;
        syntheseAction = document.getElementById("synthese_action").value;
//        comeback = document.getElementById("comeback").value;
        idFtaEtat = document.getElementById("id_fta_etat").value;
        abreviationFtaEtat = document.getElementById("abreviation_fta_etat").value;
        idFtaRole = document.getElementById("id_fta_role").value;
        gestionnaire = document.getElementById("gestionnaire").value;

        //if (i == 0) return;
        url = "ajout_classification_chemin.php?id_fta=" + idFta
                + "&id_fta_chapitre_encours=" + id_fta_chapitre_encours
                + "&synthese_action=" + syntheseAction
//                + "&comeback=" + comeback
                + "&id_fta_etat=" + idFtaEtat
                + "&abreviation_fta_etat=" + abreviationFtaEtat
                + "&id_fta_role=" + idFtaRole
                + "&selection_proprietaire1=" + document.form_action.selection_proprietaire12.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.form_action.selection_proprietaire22.options[proprietaire2].value
                + "&selection_marque=" + document.form_action.selection_marque2.options[marque].value
                + "&selection_activite=" + document.form_action.selection_activite2.options[activite].value
                + "&selection_rayon=" + document.form_action.selection_rayon2.options[rayon].value
                + "&selection_environnement=" + document.form_action.selection_environnement2.options[environnement].value
                + "&selection_reseau=" + document.form_action.selection_reseau2.options[reseau].value
                + "&selection_saisonnalite=" + document.form_action.selection_saisonnalite2.options[saisonnalite].value
                + "&checkIdFtaClasssification=1"
                + "&gestionnaire=" + gestionnaire
                ;
        parent.location.href = url;
    }
</script>