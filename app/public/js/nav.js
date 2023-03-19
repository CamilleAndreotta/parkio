const nav = {

    init:function(){

        const buttonHeader = document.querySelector('.header__button');
        buttonHeader.addEventListener('click', nav.changeNav);
    },


    changeNav:function(){

        let buttonHeader = document.querySelector('.header__button');

        if(buttonHeader.classList[1] === "nav-close"){
        
        buttonHeader.classList.remove('nav-close');

        buttonHeader.classList.add('nav-open');

        let line = document.querySelectorAll('.button__line');

        line[0].classList.add('button__line--display-true');
        line[1].classList.add('button__line--display-false');
        line[2].classList.add('button__line--display-true');

        let navSide = document.querySelector('.nav__side');
        navSide.classList.remove('nav__side-close');
        navSide.classList.add('nav__side-open');

        let contentContainer = document.querySelector('.content-container');
        contentContainer.classList.remove('content__mobile-open');
        contentContainer.classList.add('content__mobile-close');

        return;

        }

        if(buttonHeader.classList[1] === "nav-open"){

            buttonHeader.classList.remove('nav-open');
            buttonHeader.classList.add('nav-close');
    
            let line = document.querySelectorAll('.button__line');
    
            line[0].classList.remove('button__line--display-true');
            line[1].classList.remove('button__line--display-false');
            line[2].classList.remove('button__line--display-true');
    
            let navSide = document.querySelector('.nav__side');
            navSide.classList.remove('nav__side-open');
            navSide.classList.add('nav__side-close');
    
            let contentContainer = document.querySelector('.content-container');
            contentContainer.classList.remove('content__mobile-close');
            contentContainer.classList.add('content__mobile-open');

            return;
            
        }

    },


}


document.addEventListener('DOMContentLoaded', nav.init);