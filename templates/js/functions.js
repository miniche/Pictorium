/**
 * 
 * Pictorium functions
 * 
 */

//
// Main vars
//
var is_mobile = false;
var mobile_width_limit = 600;

var current_window_width = 0;
var current_window_height = 0;

// Photos
var current_photo_width = 0;
var current_photo_height = 0;

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
    current_window_width = window.innerWidth;
    current_window_height = window.innerHeight;
    
    // Is a mobile version ?
    if(current_window_width <= 600)
    {
        is_mobile = true;
    }
    else
    {
        is_mobile = false;
    }
    
    console.log(window.innerWidth);
    
    // We draw the window.
    if(is_mobile)
    {
        document.getElementById("left_menu").style.width = current_window_width +"px";
        document.getElementById("main_right").style.width = current_window_width +"px";
    }
    else
    {
        document.getElementById("left_menu").style.width = "200px";
        document.getElementById("main_right").style.width = current_window_width +"px";
    }
    
    // For the left menu
    document.getElementById("left_menu").style.height = current_window_height - 40 +"px";
    document.getElementById("main_right").style.height = current_window_height - 40 +"px";
    
    
    // Resize the main photo
    designPhoto();
    
}

function designPhoto() {

    // Change size of the main image.
    // First, getting max sizes (from the window size)
    var max_width = current_window_width - 400;
    var max_height = current_window_height - 200;
    
    var new_width = 0;
    var new_height = 0;
    
    // The photo is bigger than max values ?
    if(current_photo_width > max_width)
    {
        // Yes, it's bigger!
            // Resizing the photo...
            new_width = max_width;
            
            // calculate the height
            new_height = parseFloat(new_width) * parseFloat(current_photo_height) / parseFloat(current_photo_width);
            console.log("Yeah ");
    }
    
    
    if(current_photo_height > max_height)
    {
        // Yes, it's bigger!

            // Resizing the photo...
            new_height = max_height;
            
            // calculate the width
            new_width = parseFloat(new_height) * parseFloat(current_photo_width) / parseFloat(current_photo_height);
            console.log("Oh");
    }
    
    /*
    if(current_photo_width > current_photo_height)
    {
        
        // Wider !
        if(current_photo_width > max_width)
        {
            
            
            // Verifying if the new_height isn't highter than max_height.
            if(new_height > max_height)
            {
                // It's heighter. We must resize for a second time!
                // We take the max_height as reference.
                new_height = max_height;
                new_width = new_height * current_photo_width / current_photo_height;
            }
        }
        else
        {
            // The photo is smaller than the limits
            new_width = current_photo_width;
            new_height = current_photo_height;
        }
    }
    else if(current_photo_width < current_photo_height)
    {
        
        // Taller!
        if(current_photo_height > max_height)
        {
            // Resizing the photo...
            new_height = max_height;
            
            // calculate the width
            new_width = parseFloat(new_height) * parseFloat(current_photo_width) / parseFloat(current_photo_height);
        }
        else
        {
            // The photo is smaller than the limits
            new_width = current_photo_width;
            new_height = current_photo_height;
        }
    }
    else
    {
        //Squarred photo!
        new_width = max_width;
        new_height = max_height;
    }
    */
   
    document.getElementById("main_photo_img").style.width = new_width +"px";
    document.getElementById("main_photo_img").style.height = new_height +"px";
}


function getLeftMenu()
{
    http_left_menu = createRequestObject();
    
    var url = "menu.php";
    var params = "";
    http_left_menu.open("POST", url, true);
	
    // Informations obligatoires pour POST
    http_left_menu.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //http_left_menu.setRequestHeader("Content-length", params.length);
    //http_left_menu.setRequestHeader("Connection", "close");
	
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
    //http_right_album.setRequestHeader("Content-length", params.length);
    //http_right_album.setRequestHeader("Connection", "close");
	
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
            document.getElementById('main_album').innerHTML =  reponse;
            
            // Display album
            returnToAlbum();

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
    //http_display_photo.setRequestHeader("Content-length", params.length);
    //http_display_photo.setRequestHeader("Connection", "close");
	
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
            // Parsing in JSON
            var datas = JSON.parse(reponse);
            
            // We verify the status
            if(datas.status == "ok")
            {
                // OK, we want to display this image!
                //alert("OK : "+ datas.name);
                
                document.getElementById('main_photo_title').innerHTML = datas.name;
                document.getElementById("main_photo_img").src = datas.url_compressed;
                document.getElementById("main_photo_btn_return_lib").innerHTML = datas.gallery;
                
                // Image size !
                current_photo_height = datas.height;
                current_photo_width = datas.width;
                document.getElementById("photo_input_datas_width").innerHTML = datas.width;
                document.getElementById("photo_input_datas_height").innerHTML = datas.height;
                
                // Displaying the image part !
                document.getElementById("main_photo_id").style.display='block';
                document.getElementById("main_album").style.display='none';
                
                // calculate image position
                designPhoto();
            }
            else
            {
                // An error...
                alert("Error : "+ datas.status);
            }
            
        // Updated che on 16th july 2012 : full ajax!
        //document.getElementById('main_right').innerHTML =  reponse;

        }
        else
        {
            alert('Oops... Fichier de traitement introuvable');
        }
    }
}


//
// Functions on a image
//

function returnToAlbum(){
    
    document.getElementById("main_photo_id").style.display='none';
    document.getElementById("main_album").style.display='block';
    
}
