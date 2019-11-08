/* flags de controle */
var isA = true // determina qual input ('a' ou 'b') tem controle dos botões
var ext = false // controla exibição do resultado por extenso
var save = false // determina se o resultado foi salvo

var res // resultado da operação

/* setInput recebe um booleano (true caso tenha sido chamada pelo input a
e false caso chamada por 'b') e atribui o valor a isA */
function setInput(bool) {
    isA = bool
}

/* updateInput recebe um caractere digitado no teclado da calculadora
e atualiza o input */
function updateInput(char) {
    // atualização do input 'a'
    if (isA) {
        let a = document.getElementById('a')
        let value = a.getAttribute("value")
        a.setAttribute("value", value+char)
    }
    // atualização do input 'b'
    else {
        let b = document.getElementById('b')
        let value = b.getAttribute("value")
        b.setAttribute("value", value+char)
    }
}

function updateValue() {
    if (isA) {
        let a = document.getElementById('a')
        let value = a.getAttribute("value")
        a.setAttribute("value", value)
    }
    // atualização do input 'b'
    else {
        let b = document.getElementById('b')
        let value = b.getAttribute("value")
        b.setAttribute("value", value)
    }
}

/* extenso() exibe o resultado do cálculo por extenso */
function extenso() {
    ext = !ext // define alternância entre numérico e por extenso

    // salva o resultado
    if (!save) {
        res = document.getElementById("board").innerHTML
        save = !save
    }

    // condicional da exibição de reposta
    if (ext) { 
        document.getElementById("ext").style.display = "block"
        document.getElementById("board").style.display = "none"
    }
    else {
        document.getElementById("board").style.display = "block"
        document.getElementById("ext").style.display = "none"
        document.getElementById("board").innerHTML = res
    }
}
