/**
 * Created by philippe on 15/09/16.
 */
var formElt = document.querySelector('.well');
var presenceElt = document.getElementById('presence');

if(formElt.id !== 4)
{
    formElt.style.display = "none";
}
else{
    presenceElt.style.display = "none";
}

var btnElt = document.getElementById("cachePresence");

btnElt.addEventListener('click', function(){
    formElt.style.display = "inline";
    presenceElt.style.display = "none";
})