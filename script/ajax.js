
/**
* Methode qui instancie XMLHttpRequest
*/	 
function getXhr(){
	var res=null;
	if(window.XMLHttpRequest) 
		res = new XMLHttpRequest(); 
	else
		if(window.ActiveXObject)
	    { 
				try
				{
					res = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e) 
				{
					res = new ActiveXObject("Microsoft.XMLHTTP");
				}
	    }
    else
    { 
			alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
			res = false; 
    }
	return res;
}

function ajax(file,arg,div){
	// Sablier le temps de chargement du contenu de la div
	document.body.style.cursor = 'wait';
	// instanciation de l'objet XMLHttpRequest
	var xhr = getXhr();
	// On defini ce qu'on va faire quand on aura la reponse
	xhr.onreadystatechange = function()
	{
		// readyState : Repr�sente l'�tat d'avancement de la requ�te
		// status : Repr�sente le code HTTP retourn� par la requ�te
			if(xhr.readyState == 4 && xhr.status == 200)
			{
			  reponse = xhr.responseText;
			 
			  if(typeof(div) != 'undefined')
			  {
				  document.getElementById(div).innerHTML = reponse ;
				  var allscript = document.getElementById(div).getElementsByTagName('script');
					for(var i=0;i< allscript.length;i++)
					{
						if (window.execScript)
							window.execScript(allscript[i].text);
						else
							window.eval(allscript[i].text);
					}
			}
		}
	}
	// open(method, url[, asynchrone[, user[, password]]]) : Initialise une requ�te en sp�cifiant la m�thode (method), l'URL (url), si le mode est asynchrone (asyncFlag vaut true ou false) et en indiquant d'�ventuelles informations d'identification (user et password).
	xhr.open("POST",file,true);
    //setRequestHeader(headerName, headerValue) : Sp�cifie un en-t�te HTTP (headerName et headerValue) � envoyer avec la requ�te.
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// send(data) : Envoie la requ�te HTTP au serveur en transmettant �ventuellement des donn�es (data doit alors �tre diff�rent de null) sous forme d'une � postable string � (je suis preneur pour une traduction) ou sous forme d'un objet DOM.
	xhr.send(arg);
    // Curseur normal
	document.body.style.cursor = 'auto';
}