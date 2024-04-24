

/* function leftScroll() {
     const left = document.querySelector(".scrolling-wrapper");
left.scrollBy(200, 0);}




function rightScrol(){
    const right = document.querySelector(".scrolling-wrapper");
right.scrollBy(-200, 0);}


*/
/* function scrollWin(x, y) {
	window.scrollBy(x, y);

}
*/
   const buttonRight = document.getElementById('slideRight');
    const buttonLeft = document.getElementById('slideLeft');




    buttonRight.onclick = function () {

       document.getElementById('container').scrollLeft += 20;

    };
    buttonLeft.onclick = function () {
      document.getElementById('container').scrollLeft -= 20;
    };

    const buttonLeft = document.getElementById("slideLeft");
buttonLeft.addEventListener("click", moveleft);

function moveleft(){
document.getElementById('container').scrollLeft += 20;

}

const buttonRight = document.getElementById("slideRight");
buttonRight.addEventListener("click", moveright)

function moveright(){
  document.getElementById('container').scrollLeft -= 20;
}


/* window.addEventListener(scroll ,()=>{

    Console.log('scrolled');

  }); */