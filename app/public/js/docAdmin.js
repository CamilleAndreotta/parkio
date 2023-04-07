const docAdmin = {

    init: function(){

        const userBtn = document.querySelector('.doc__admin-user>div>span');

        userBtn.addEventListener('click', docAdmin.changeUserContentOpen);


        const locationBtn = document.querySelector('.doc__admin-location>div>span');

        locationBtn.addEventListener('click', docAdmin.changeLocationContentOpen);


        const materialBtn = document.querySelector('.doc__admin-material>div>span');

        materialBtn.addEventListener('click', docAdmin.changeMaterialContentOpen);

    },

    changeUserContentOpen:function(event){

        event.preventDefault();

        const contentArea = document.querySelector('.text__area-user');

        contentArea.classList.remove('display-none');

        const closeBtnUser = document.querySelector('.close__doc-contentUser');


        if(closeBtnUser === null){

        const addCloseBtnUser = document.createElement('div');

        addCloseBtnUser.classList.add('close__doc-contentUser');

        addCloseBtnUser.textContent = 'Fermer';

        contentArea.append(addCloseBtnUser);
        
        const closeBtnUser = document.querySelector('.close__doc-contentUser');
        
        closeBtnUser.addEventListener('click', docAdmin.ChangeUserContentClose)

        }


    },

    ChangeUserContentClose: function(){

        const contentArea = document.querySelector('.text__area-user');

        contentArea.classList.add('display-none');
    },

    changeLocationContentOpen:function(event){

        event.preventDefault();

        const contentArea = document.querySelector('.text__area-location');

        contentArea.classList.remove('display-none');

        const closeBtnLocation = document.querySelector('.close__doc-contentLocation');

        if(closeBtnLocation === null){

        const addCloseBtnLocation = document.createElement('div');

        addCloseBtnLocation.classList.add('close__doc-contentLocation');

        addCloseBtnLocation.textContent = 'Fermer';

        contentArea.append(addCloseBtnLocation);
        
        const closeBtnLocation = document.querySelector('.close__doc-contentLocation');
        
        closeBtnLocation.addEventListener('click', docAdmin.ChangeLocationContentClose)

        }


    },

    ChangeLocationContentClose: function(){

        const contentArea = document.querySelector('.text__area-location');

        contentArea.classList.add('display-none');
    },


    changeMaterialContentOpen:function(event){

        event.preventDefault();

        const contentArea = document.querySelector('.text__area-material');

        contentArea.classList.remove('display-none');

        const closeBtnMaterial = document.querySelector('.close__doc-contentMaterial');

        if(closeBtnMaterial === null){

        const addCloseBtnMaterial= document.createElement('div');

        addCloseBtnMaterial.classList.add('close__doc-contentMaterial');

        addCloseBtnMaterial.textContent = 'Fermer';

        contentArea.append(addCloseBtnMaterial);
        
        const closeBtnMaterial= document.querySelector('.close__doc-contentMaterial');
        
        closeBtnMaterial.addEventListener('click', docAdmin.ChangeMaterialContentClose)

        }


    },

    ChangeMaterialContentClose: function(){

        const contentArea = document.querySelector('.text__area-material');

        contentArea.classList.add('display-none');
    }




}




document.addEventListener('DOMContentLoaded', docAdmin.init);