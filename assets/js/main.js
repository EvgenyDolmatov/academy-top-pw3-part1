let formInputs = document.querySelectorAll(".validate-form input");
let formBtn = document.querySelector(".validate-form button");

formInputs.forEach(function (input){
    input.addEventListener("input", function (){
        let emptyFields = 0;
        for (let i = 0; i < formInputs.length; i++) {
           if (formInputs[i].value === "")
               emptyFields++;
        }
        formBtn.disabled = emptyFields !== 0;
    })
});

