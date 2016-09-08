/**
 * Created by philippe on 06/09/16.
 */
var labelOptionElt = document.getElementById('options');
labelOptionElt.classList.add('col-sm-2');

var optionElts = document.querySelectorAll('div.checkbox');
for (var i = optionElts.length - 1; i >= 0; i--) {
    optionElts[i].style.display = "none";
}

var choixOptionElt = document.createElement("div");
choixOptionElt.id = 'choixOption';
choixOptionElt.innerHTML = "Choisisser une figurine pour acceder à ses options !";
var divOptionsElt = document.getElementById('figurine_army_equipements')
divOptionsElt.appendChild(choixOptionElt);
divOptionsElt.classList.add('col-sm-10');
divOptionsElt.classList.add('row');


document.getElementById('figurine_army_figurine').onchange = function(){
    choixOptionElt.remove();

    for (var i = optionElts.length - 1; i >= 0; i--) {
        optionElts[i].style.display = "none";
        optionElts[i].querySelector('input').checked = false;
    }

    var optionsVisiblesElts = document.querySelectorAll('input[data-'+this.value+']');
    for (var i = optionsVisiblesElts.length - 1; i >= 0; i--) {
        optionsVisiblesElts[i].parentNode.parentNode.style.display = "inline";
        optionsVisiblesElts[i].parentNode.parentNode.classList.add('col-sm-4');

    }

}