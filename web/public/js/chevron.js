// On récupere tous les liens de l'accordeon
var aElts = document.querySelectorAll('.menu-drop');

aElts.forEach(function (aElt) {
    // On ajoute un listener
    aElt.addEventListener('click', function (e) {
        if($(this).hasClass('collapsed')){
            $(this).children('h4').children('span').addClass("glyphicon-chevron-up").removeClass("glyphicon-chevron-down");
        }else{
            $(this).children('h4').children('span').addClass("glyphicon-chevron-down").removeClass("glyphicon-chevron-up");
        }
    })

})