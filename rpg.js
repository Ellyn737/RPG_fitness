//which card is shown
var cardStatus = 1;
//time the card is shown (7 secs)
var cardTimer = 7000;

//start the loop
window.onload = function(){
    startCardLoop();
}

var startCardLoop = setInterval(function(){
    cardLoop();
}, cardTimer);


//changes the cards
function cardLoop(){

        if(cardStatus === 1){
        
            //img is invisible when it goes back in line
            document.getElementById("ranger").style.opacity = "0";   
            //after half a second
            //start moving the images
            setTimeout(function(){
                //first img fits in the container
                document.getElementById("warrior").style.right = "0px";
                document.getElementById("warrior").style.zIndex = "1000";
                //second img is put to the right of the container
                document.getElementById("ranger").style.right = "-400px";
                //positioning above the first img
                document.getElementById("ranger").style.zIndex = "1500";
                //third img is put to the left of the container
                document.getElementById("monk").style.right = "400px";
                //positioning under the first img
                document.getElementById("monk").style.zIndex = "500";
            }, 500);

            //after another half second change the opacity back
            setTimeout(function(){
                document.getElementById("ranger").style.opacity = "1";
            }, 1000);

            //change the status
            cardStatus = 2;
        }
    
    if(cardStatus === 2){
        
            //img is invisible when it goes back in line
            document.getElementById("monk").style.opacity = "0";   
            //after half a second
            //start moving the images
            setTimeout(function(){
                //first img fits in the container
                document.getElementById("ranger").style.right = "0px";
                document.getElementById("ranger").style.zIndex = "1000";
                //second img is put to the right of the container
                document.getElementById("monk").style.right = "-400px";
                //positioning above the first img
                document.getElementById("monk").style.zIndex = "1500";
                //third img is put to the left of the container
                document.getElementById("warrior").style.right = "400px";
                //positioning under the first img
                document.getElementById("warrior").style.zIndex = "500";
            }, 500);

            //after another half second change the opacity back
            setTimeout(function(){
                document.getElementById("monk").style.opacity = "1";
            }, 1000);

            //change the status
            cardStatus = 3;
        }
    
    if(cardStatus === 3){
        
            //img is invisible when it goes back in line
            document.getElementById("warrior").style.opacity = "0";   
            //after half a second
            //start moving the images
            setTimeout(function(){
                //first img fits in the container
                document.getElementById("monk").style.right = "0px";
                document.getElementById("monk").style.zIndex = "1000";
                //second img is put to the right of the container
                document.getElementById("warrior").style.right = "-400px";
                //positioning above the first img
                document.getElementById("warrior").style.zIndex = "1500";
                //third img is put to the left of the container
                document.getElementById("ranger").style.right = "400px";
                //positioning under the first img
                document.getElementById("ranger").style.zIndex = "500";
            }, 500);

            //after another half second change the opacity back
            setTimeout(function(){
                document.getElementById("warrior").style.opacity = "1";
            }, 1000);

            //change the status
            cardStatus = 1;
        }

}

//29:11

