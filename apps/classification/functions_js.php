<script>

    function selection_proprietaire1_js() {
        proprietaire1 = document.recherche_groupe.selection_proprietaire1.selectedIndex;

        //if (i == 0) return;
        url = "index.php?selection_proprietaire1=" + document.recherche_groupe.selection_proprietaire1.options[proprietaire1].value

                ;
        parent.location.href = url;
    }
    function lien_selection_goupe() {
        i = document.recherche_groupe.selection_groupe.selectedIndex;
        j = document.recherche_groupe.selection_fournisseur.selectedIndex;
        //if (i == 0) return;
        url = "liste_fte.php?selection_groupe=" + document.recherche_groupe.selection_groupe.options[i].value + "&selection_fournisseur=" + document.recherche_groupe.selection_fournisseur.options[j].value;
        parent.location.href = url;
    }

    function selection_proprietaire2_js() {
        proprietaire1 = document.recherche_groupe.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.recherche_groupe.selection_proprietaire2.selectedIndex;

        //if (i == 0) return;
        url = "index.php?selection_proprietaire1=" + document.recherche_groupe.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.recherche_groupe.selection_proprietaire2.options[proprietaire2].value

                ;
        parent.location.href = url;
    }
    function selection_marque_js() {
        proprietaire1 = document.recherche_groupe.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.recherche_groupe.selection_proprietaire2.selectedIndex;
        marque = document.recherche_groupe.selection_marque.selectedIndex;

        url = "index.php?selection_proprietaire1=" + document.recherche_groupe.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.recherche_groupe.selection_proprietaire2.options[proprietaire2].value
                + "&selection_marque=" + document.recherche_groupe.selection_marque.options[marque].value

                ;
        parent.location.href = url;
    }
    function selection_activite_js() {
        proprietaire1 = document.recherche_groupe.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.recherche_groupe.selection_proprietaire2.selectedIndex;
        marque = document.recherche_groupe.selection_marque.selectedIndex;
        activite = document.recherche_groupe.selection_activite.selectedIndex;

        //if (i == 0) return;
        url = "index.php?selection_proprietaire1=" + document.recherche_groupe.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.recherche_groupe.selection_proprietaire2.options[proprietaire2].value
                + "&selection_marque=" + document.recherche_groupe.selection_marque.options[marque].value
                + "&selection_activite=" + document.recherche_groupe.selection_activite.options[activite].value

                ;
        parent.location.href = url;
    }
    function selection_rayon_js() {
        proprietaire1 = document.recherche_groupe.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.recherche_groupe.selection_proprietaire2.selectedIndex;
        marque = document.recherche_groupe.selection_marque.selectedIndex;
        activite = document.recherche_groupe.selection_activite.selectedIndex;
        rayon = document.recherche_groupe.selection_rayon.selectedIndex;

        //if (i == 0) return;
        url = "index.php?selection_proprietaire1=" + document.recherche_groupe.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.recherche_groupe.selection_proprietaire2.options[proprietaire2].value
                + "&selection_marque=" + document.recherche_groupe.selection_marque.options[marque].value
                + "&selection_activite=" + document.recherche_groupe.selection_activite.options[activite].value
                + "&selection_rayon=" + document.recherche_groupe.selection_rayon.options[rayon].value

                ;
        parent.location.href = url;
    }
    function selection_environnement_js() {
        proprietaire1 = document.recherche_groupe.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.recherche_groupe.selection_proprietaire2.selectedIndex;
        marque = document.recherche_groupe.selection_marque.selectedIndex;
        activite = document.recherche_groupe.selection_activite.selectedIndex;
        rayon = document.recherche_groupe.selection_rayon.selectedIndex;
        environnement = document.recherche_groupe.selection_environnement.selectedIndex;

        //if (i == 0) return;
        url = "index.php?selection_proprietaire1=" + document.recherche_groupe.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.recherche_groupe.selection_proprietaire2.options[proprietaire2].value
                + "&selection_marque=" + document.recherche_groupe.selection_marque.options[marque].value
                + "&selection_activite=" + document.recherche_groupe.selection_activite.options[activite].value
                + "&selection_rayon=" + document.recherche_groupe.selection_rayon.options[rayon].value
                + "&selection_environnement=" + document.recherche_groupe.selection_environnement.options[environnement].value

                ;
        parent.location.href = url;
    }
    function selection_reseau_js() {
        proprietaire1 = document.recherche_groupe.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.recherche_groupe.selection_proprietaire2.selectedIndex;
        marque = document.recherche_groupe.selection_marque.selectedIndex;
        activite = document.recherche_groupe.selection_activite.selectedIndex;
        rayon = document.recherche_groupe.selection_rayon.selectedIndex;
        environnement = document.recherche_groupe.selection_environnement.selectedIndex;
        reseau = document.recherche_groupe.selection_reseau.selectedIndex;

        //if (i == 0) return;
        url = "index.php?selection_proprietaire1=" + document.recherche_groupe.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.recherche_groupe.selection_proprietaire2.options[proprietaire2].value
                + "&selection_marque=" + document.recherche_groupe.selection_marque.options[marque].value
                + "&selection_activite=" + document.recherche_groupe.selection_activite.options[activite].value
                + "&selection_rayon=" + document.recherche_groupe.selection_rayon.options[rayon].value
                + "&selection_environnement=" + document.recherche_groupe.selection_environnement.options[environnement].value
                + "&selection_reseau=" + document.recherche_groupe.selection_reseau.options[reseau].value

                ;
        parent.location.href = url;
    }
    function selection_saisonnalite_js() {
        proprietaire1 = document.recherche_groupe.selection_proprietaire1.selectedIndex;
        proprietaire2 = document.recherche_groupe.selection_proprietaire2.selectedIndex;
        marque = document.recherche_groupe.selection_marque.selectedIndex;
        activite = document.recherche_groupe.selection_activite.selectedIndex;
        rayon = document.recherche_groupe.selection_rayon.selectedIndex;
        environnement = document.recherche_groupe.selection_environnement.selectedIndex;
        reseau = document.recherche_groupe.selection_reseau.selectedIndex;
        saisonnalite = document.recherche_groupe.selection_saisonnalite.selectedIndex;
        //if (i == 0) return;
        url = "index.php?selection_proprietaire1=" + document.recherche_groupe.selection_proprietaire1.options[proprietaire1].value
                + "&selection_proprietaire2=" + document.recherche_groupe.selection_proprietaire2.options[proprietaire2].value
                + "&selection_marque=" + document.recherche_groupe.selection_marque.options[marque].value
                + "&selection_activite=" + document.recherche_groupe.selection_activite.options[activite].value
                + "&selection_rayon=" + document.recherche_groupe.selection_rayon.options[rayon].value
                + "&selection_environnement=" + document.recherche_groupe.selection_environnement.options[environnement].value
                + "&selection_reseau=" + document.recherche_groupe.selection_reseau.options[reseau].value
                + "&selection_saisonnalite=" + document.recherche_groupe.selection_saisonnalite.options[saisonnalite].value
                ;
        parent.location.href = url;
    }

    /**
     * Rechargement de la page courante avec une nouvelle valeur
     * @returns {undefined}
     */
    function id_Activite_js() {
        current_page = document.form_action.current_page.value;
        id_Activite = document.getElementById('id_Activite').value ;
        url = current_page + "?id_Activite=" + id_Activite;
        parent.location.href = url;
    }
    /**
     * Rechargement de la page courante avec une nouvelle valeur
     * @returns {undefined}
     */
    function id_Marque_js() {
        current_page = document.form_action.current_page.value;
        id_Marque = document.getElementById('id_Marque').value ;
        url = current_page + "?id_Marque=" + id_Marque;
        parent.location.href = url;
    }


</script>