let formInputs = document.querySelectorAll(".register-form input");
let formBtn = document.querySelector(".register-form button");

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