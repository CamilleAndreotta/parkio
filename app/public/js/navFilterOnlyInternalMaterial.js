const navFilterOnlyInternalMaterial = {


    init : function(){
        
        let navFilterArea = document.querySelector('.spaceFilter__onlyInternalMaterial');

        navFilterArea.innerHTML = "<button class='col-2 btn btn-success m-2'>Disponible</button><button class='col-2 btn btn-danger m-2'>Indisponible</button><button class='col-2 btn btn-primary m-2'>Réinitialiser</button>";

        let allNavButton = document.querySelectorAll('button');
        
        for (button of allNavButton){
            button.addEventListener('click', navFilterOnlyInternalMaterial.handleButtonEvent);
        }

    },

    handleButtonEvent: function(event){

        let status = event.target.innerHTML;

        let rows = document.querySelectorAll('tbody tr');

        if(status === "Disponible"){
            
            for(row of rows){

                let status = row.dataset.status;

                row.classList.remove('row__display-none')

                if( status !== 'available' ){
                    row.classList.add('row__display-none')
                }
                
            }
        }

        if(status === "Indisponible"){
            for(row of rows){

                let status = row.dataset.status;

                row.classList.remove('row__display-none')

                if( status !== 'notAvailable' ){
                    row.classList.add('row__display-none')
                }
                
            }
        }

        if(status === "Réinitialiser"){
            for(row of rows){

                row.classList.remove('row__display-none')
                
            }
        }

    },

    

}

document.addEventListener('DOMContentLoaded', navFilterOnlyInternalMaterial.init())