//<script language="javascript">
//<!--


function lien_selection_goupe() {
  i = document.recherche_groupe.selection_groupe.selectedIndex;
  j = document.recherche_groupe.selection_fournisseur.selectedIndex;
  //if (i == 0) return;
  url = "liste_fte.php?selection_groupe=" + document.recherche_groupe.selection_groupe.options[i].value + "&selection_fournisseur=" + document.recherche_groupe.selection_fournisseur.options[j].value;
  parent.location.href = url;
}

function lien_selection_fournisseur() {
  i = document.recherche_groupe.selection_groupe.selectedIndex;
  j = document.recherche_groupe.selection_fournisseur.selectedIndex;
  //if (i == 0) return;
  url = "liste_fte.php?selection_groupe=" + document.recherche_groupe.selection_groupe.options[i].value + "&selection_fournisseur=" + document.recherche_groupe.selection_fournisseur.options[j].value;
  parent.location.href = url;
}

/* Mod�le de fonction
function fonction(var1,var2,var3,var4)
{
   //D�finition des variables

   //Corps de la fonction

}
*/



//-->
//</script>