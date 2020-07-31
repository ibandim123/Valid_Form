//Mudar botão de aviso.
const fields = document.querySelectorAll("[required]")

console.log(fields);




    function customValidation(event){
        const field = event.target


        //Trocar mensagem de required 
        field.setCustomValidity("Esse campo é obrigatório!")
    }
    
for( field of fields) {
    field.addEventListener("Invalid", event =>{ //Regras de campo

    })
}












document.querySelector("form")
.addEventListener("submit", event => {//criando uma função de submit
    console.log('Enviando...')

    event.preventDefault()//paralisar o carregamento de envio
})

