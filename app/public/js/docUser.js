const docUser = {

    init: function(){

        const myProfilBtn = document.querySelector('.doc__user-profil>div>span');

        myProfilBtn.addEventListener('click', docUser.changeProfilContentOpen);


        const myAskBtn = document.querySelector('.doc__user-myAsk>div>span');

        myAskBtn.addEventListener('click', docUser.changeMyAskContentOpen);


        const doAskBtn = document.querySelector('.doc__user-doAsk>div>span');

        doAskBtn.addEventListener('click', docUser.changeDoAskContentOpen);

    },

    changeProfilContentOpen:function(event){

        event.preventDefault();

        const contentArea = document.querySelector('.text__area-profil');

        contentArea.classList.remove('display-none');

        const closeBtnProfil = document.querySelector('.close__doc-contentProfil');


        if(closeBtnProfil === null){

        const addCloseBtnProfil = document.createElement('div');

        addCloseBtnProfil.classList.add('close__doc-contentProfil');

        addCloseBtnProfil.textContent = 'Fermer';

        contentArea.append(addCloseBtnProfil);
        
        const closeBtnProfil = document.querySelector('.close__doc-contentProfil');
        
        closeBtnProfil.addEventListener('click', docUser.ChangeProfilContentClose)

        }


    },

    ChangeProfilContentClose: function(){

        const contentArea = document.querySelector('.text__area-profil');

        contentArea.classList.add('display-none');
    },

    changeMyAskContentOpen:function(event){

        event.preventDefault();

        const contentArea = document.querySelector('.text__area-myAsk');

        contentArea.classList.remove('display-none');

        const closeBtnMyAsk = document.querySelector('.close__doc-contentMyAsk');

        if(closeBtnMyAsk === null){

        const addCloseBtnMyAsk = document.createElement('div');

        addCloseBtnMyAsk.classList.add('close__doc-contentMyAsk');

        addCloseBtnMyAsk.textContent = 'Fermer';

        contentArea.append(addCloseBtnMyAsk);
        
        const closeBtnMyAsk = document.querySelector('.close__doc-contentMyAsk');
        
        closeBtnMyAsk.addEventListener('click', docUser.ChangeMyAskContentClose)

        }


    },

    ChangeMyAskContentClose: function(){

        const contentArea = document.querySelector('.text__area-myAsk');

        contentArea.classList.add('display-none');
    },


    changeDoAskContentOpen:function(event){

        event.preventDefault();

        const contentArea = document.querySelector('.text__area-doAsk');

        contentArea.classList.remove('display-none');

        const closeBtnDoAsk = document.querySelector('.close__doc-contentDoAsk');

        if(closeBtnDoAsk === null){

        const addCloseBtnDoAsk = document.createElement('div');

        addCloseBtnDoAsk.classList.add('close__doc-contentDoAsk');

        addCloseBtnDoAsk.textContent = 'Fermer';

        contentArea.append(addCloseBtnDoAsk);
        
        const closeBtnDoAsk = document.querySelector('.close__doc-contentDoAsk');
        
        closeBtnDoAsk.addEventListener('click', docUser.ChangeDoAskContentClose)

        }


    },

    ChangeDoAskContentClose: function(){

        const contentArea = document.querySelector('.text__area-doAsk');

        contentArea.classList.add('display-none');
    }




}




document.addEventListener('DOMContentLoaded', docUser.init);