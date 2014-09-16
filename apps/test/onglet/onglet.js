function creeXHR() //fonction qui va crée une instance pour les requete XML
{
    var request = false;
if (window.XMLHttpRequest) //vérifie les différent navigateur
		{
            request = new XMLHttpRequest();//pour FireFox,Opéra
            if (request.overrideMimeType) {
                request.overrideMimeType('text/xml');
            }
        }
       else if (window.ActiveXObject) 
		{
  			try 
 				 { // essaie de charger l'objet pour IE
   					 request = new ActiveXObject("Msxml2.XMLHTTP");
				  } 
		   catch (e) 
  				{
   				  try 
   					  { // essaie de charger l'objet pour une autre version IE
    					    request = new ActiveXObject("Microsoft.XMLHTTP");
					  } 
    			 catch (e) 
    					 {
     					   window.alert("Veuillez mettre a jour votre navigateur pour la navigation sur ce site");
							window.close;
 					    }
 			 } 
        }
if (!request) {//si la création de l'instance echoue une fenêtre vous annoncera qu'il ne pourra executer le script 
            alert('Abandon,impossible de créer une instance XMLHTTP');
            return false;
        }
    return request;
}

function onglet(ID)//fonction qui va gérer le contenu dans le div en récuperant les données 
	{
		var xhr=creeXHR();//création de l'instance
		var url="./requete.php?page="+ID;//ID va servir a la page requete pour chercher le contenu apartenant a l'ID
		xhr.open( "GET",url, true);//ouverture du fichier 
		xhr.onreadystatechange=function(){
		 if(xhr.readyState  == 4)//une fois les données charger
        			 {
               				 
							 if (xhr.status == 200)//qu'il n'y a pas d'erreur
							 {
               				 	var doc2=xhr.responseText;
							 	document.getElementById("contenu").innerHTML=doc2;//envoi les donner dans le div avec l'ID 'contenu'								
							 }
							 
							 for (i=0 ;i<compteur ;i++)//la variable compteur qui a été initialiser au debut de la page onglet.php qui indique le nombre d'onglet
							 {
							 		if (tabu[i]==ID)//change la classe de l'onglet actif
									{
							 			document.getElementById(tabu[i]).className="active";
									}
									if (tabu[i]!=ID)//change la classe de l'onglet en innactif
									{
							 			document.getElementById(tabu[i]).className="eteint";
							 		}
							 }
   					 }
					 };
		xhr.send("");//envoi des donnée au script requete.php (ici NULL) 
	}