<?php ?>
<script type="text/javascript">
    function envoi(champ)
    {
        if (champ.value !== "")
            principal.action = principal.format.options[principal.format.selectedIndex].value, principal.submit();
        else
            alert("Il faut remplir le niveau de confidentialit�");
    }

    function vide(champ, defoval)
    {
        if (champ.value === defoval)
            champ.value = "";
    }

    function envoi2(valeur)
    {
        if (valeur !== "")
            parent['frame2bas'].location.href = 'articleframe2.php?nomliste=valeur';
        else
            alert("Ca ne marche pas");
    }

    function MM_openBrWindow(theURL, winName, features)
    { //v2.0
        window.open(theURL, winName, features);
    }

    function MM_goToURL()
    { //v3.0
        var i, args = MM_goToURL.arguments;
        document.MM_returnValue = false;
        for (i = 0; i < (args.length - 1); i += 2)
            eval(args[i] + ".location='" + args[i + 1] + "'");
    }


    function oblig()
    {
        if (document.principal.nivo_conf.value === '')
        {
            principal.nivo_conf.focus();
            alert("Le champ du niveau de confidentialit� est obligatoire");
            return;
        }
        if ((document.principal.nivo_conf.value < 1) || (document.principal.nivo_conf.value > 10) || (isNaN(document.principal.nivo_conf.value) === 1))
        {
            principal.nivo_conf.focus();
            alert("Le niveau de confidentialit� doit �tre un nombre compris entre 1 et 10");
            return;
        }

        if (document.principal.titre_art.value === '')
        {
            principal.titre_art.focus();
            alert("Le champ de titre est obligatoire");
            return;
        }
        if (principal.sujet.value === '')
        {
            principal.sujet.focus();
            alert("Le champ de sujet est obligatoire");
            return;
        }
        document.principal.submit();
    }

    function nonvide()
    {
        if (salarie.sal_nom.value === '')
        {
            salarie.sal_nom.focus();
            alert("Le champ nom est obligatoire");
            return;
        }
        if (salarie.sal_prenom.value === '')
        {
            salarie.sal_prenom.focus();
            alert("Le champ pr�nom est obligatoire");
            return;
        }
        if (salarie.sal_login.value === '')
        {
            salarie.sal_login.focus();
            alert("Le champ login est obligatoire");
            return;
        }
        if (salarie.sal_pass.value === '')
        {
            salarie.sal_pass.focus();
            alert("Le champ mot de passe est obligatoire");
            return;
        }
        if (salarie.sal_mail.value === '')
        {
            salarie.sal_mail.focus();
            alert("Le champ mail est obligatoire");
            return;
        }
        document.salarie.submit();
    }


    function js_page_reload() {
        current_page = document.form_action.current_page.value;
        current_query = document.form_action.current_query.value;
        reload = document.form_action.page_reload.value;
        url = current_page + "?" + current_query + "&page_reload=" + reload;
        parent.location.href = url;
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

    function Change() {

        if ((document.getElementById('consultation').checked)) {
            var elems = document.getElementsByClassName("site");
            for (var i = 0; i < elems.length; i++) {
                elems[i].style.visibility = 'visible';
            }
            var elems2 = document.getElementsByClassName("id_fta_workflow");
            for (var i = 0; i < elems2.length; i++) {
                elems2[i].style.visibility = "visible";
            }

        } else {
            var elems = document.getElementsByClassName("site");
            for (var i = 0; i < elems.length; i++) {
                elems[i].style.visibility = 'hidden';
            }
            var elems2 = document.getElementsByClassName("id_fta_workflow");
            for (var i = 0; i < elems2.length; i++) {
                elems2[i].style.visibility = "hidden";
            }
        }
        if ((document.getElementById('modification').checked)) {
            var elem3 = document.getElementsByClassName("role");
            for (var i = 0; i < elem3.length; i++) {
                elem3[i].style.visibility = "visible";
            }
        }
        else {
            var elem3 = document.getElementsByClassName("role");
            for (var i = 0; i < elem3.length; i++) {
                elem3[i].style.visibility = "hidden";
            }
        }

    }

    function confirmation(paramIdUser) {
        var idUser = paramIdUser;
        {
            if (confirm('Vous etes sur le point de supprimer un utilisateur.'))
            {
                location.href = "gestion_salaries11.php?modifier=supprimer&sal_user=" + idUser;
            }
            else {
            }
        }
    }

    function confirmation_desactivation(paramIdUser) {
        var idUser = paramIdUser;
        {
            if (confirm('Vous êtes sur le point de désactiver ce compte utilisateur.'))
            {
                location.href = "gestion_salaries11.php?modifier=desactivation&sal_user=" + idUser;
            }
            else {
            }
        }
    }

</script>

