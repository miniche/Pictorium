/**
 * 
 * Pictorium functions
 * 
 */


//
// AJAX utilities
//
var http_left_menu;
var http_right_album;
var http_display_photo;
function createRequestObject()
{
    var http;
    if (window.XMLHttpRequest)
    { 
        // Mozilla, Safari, IE7 ...
        http = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        // Internet Explorer 6
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return http;
}




//
// Design the window
//
function onLoadDocument()
{
    designWindow();
    
    // Get the left menu with ajax
    getLeftMenu();
    
    document.title = "Pictorium loaded!";
}

function onResizeDocument()
{
    designWindow();
}

function designWindow(){
    
    // it's a smartphone/a small device or a computer/a tablet ?
    
    //alert(document.height);
    
    if(document.width <= 600)
    {
        document.getElementById("left_menu").style.width = document.width +"px";
    }
    else
    {
        document.getElementById("left_menu").style.width = "200px";
    }
    
    // For the left menu
    document.getElementById("left_menu").style.height = document.height - 40 +"px";
    
}


function getLeftMenu()
{
    http_left_menu = createRequestObject();
    
    var url = "menu.php";
    var params = "";
    http_left_menu.open("POST", url, true);
	
    // Informations obligatoires pour POST
    http_left_menu.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http_left_menu.setRequestHeader("Content-length", params.length);
    http_left_menu.setRequestHeader("Connection", "close");
	
    // Méthode appelée pour traitement du résultat
    http_left_menu.onreadystatechange = getLeftMenuResponse;
		
    http_left_menu.send(params);
}

function getLeftMenuResponse()
{
    if (http_left_menu.readyState == 4)
    {
        if (http_left_menu.status == 200)
        {
            var reponse = http_left_menu.responseText; 
            //alert(reponse);
            // On a reçu la réponse. Est-ce ok ?

            // Dans ce cas, le client existe déjà (du moins, son mail est enregistré).
            document.getElementById('left_menu').innerHTML =  reponse;

        }
        else
        {
            alert('Oops... Fichier de traitement introuvable');
        }
    }
}


//
// Functions on left menu
//
function getRightAlbum(gallery)
{
    http_right_album = createRequestObject();
    
    var url = "album.php";
    var params = "gallery="+ gallery;
    http_right_album.open("POST", url, true);
	
    // Informations obligatoires pour POST
    http_right_album.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http_right_album.setRequestHeader("Content-length", params.length);
    http_right_album.setRequestHeader("Connection", "close");
	
    // Méthode appelée pour traitement du résultat
    http_right_album.onreadystatechange = getRightAlbumResponse;
		
    http_right_album.send(params);
}


function getRightAlbumResponse()
{
    if (http_right_album.readyState == 4)
    {
        if (http_right_album.status == 200)
        {
            var reponse = http_right_album.responseText; 
            //alert(reponse);
            // On a reçu la réponse. Est-ce ok ?

            // Dans ce cas, le client existe déjà (du moins, son mail est enregistré).
            document.getElementById('right_album').innerHTML =  reponse;

        }
        else
        {
            alert('Oops... Fichier de traitement introuvable');
        }
    }
}


//
// Function on a album
//
function getDisplayPhoto(gallery,photo)
{
    http_display_photo = createRequestObject();
    
    var url = "photo.php";
    var params = "gallery="+ gallery +"&photo="+ photo;
    http_display_photo.open("POST", url, true);

    // Informations obligatoires pour POST
    http_display_photo.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http_display_photo.setRequestHeader("Content-length", params.length);
    http_display_photo.setRequestHeader("Connection", "close");
	
    // Méthode appelée pour traitement du résultat
    http_display_photo.onreadystatechange = getDisplayPhotoResponse;
		
    http_display_photo.send(params);
}


function getDisplayPhotoResponse()
{
    if (http_display_photo.readyState == 4)
    {
        if (http_display_photo.status == 200)
        {
            var reponse = http_display_photo.responseText; 
            //alert(reponse);
            // On a reçu la réponse. Est-ce ok ?

            // Dans ce cas, le client existe déjà (du moins, son mail est enregistré).
            document.getElementById('right_album').innerHTML =  reponse;

        }
        else
        {
            alert('Oops... Fichier de traitement introuvable');
        }
    }
}

