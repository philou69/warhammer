/**
 * Created by philippe on 14/09/16.
 */
var armyElt = document.getElementById("army") ;
armyElt.style.display = "none";
var presenceElt = document.getElementById("participant_presence");

if(presenceElt.value == 3 ){
    armyElt.style.display = "inline";
}
presenceElt.onchange = function () {
    if(this.value == 3 ){
        armyElt.style.display = "inline";
    }
}