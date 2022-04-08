'use strict'

const db = [
    {
        id: 1, 
        nome: 'Uncharted 4', 
        descricao: " O quarto título principal da série Uncharted e foi lançado exclusivamente para PlayStation 4 em 10 de maio de 2016. Um dos melhores jogos de 2016",  
        preco: 'R$' + 89.90, 
        imagem: './img/uncharted-produto.jpg'
    },
    {
        id: 2, 
        nome: 'God of War', 
        descricao: "God of War é uma série de jogos eletrônicos de ação-aventura criada por David Jaffe da Santa Monica Studio, da Sony. Iniciada em 2005 no console PlayStation 2",  
        preco: 'R$'+79.90, 
        parcelamento: 'ou 10x de 250 sem juros',
        imagem: './img/god.jpg'
    },
    {
        id: 3, 
        nome: 'Horizon Forbidden West', 
        descricao: "Horizon Zero Dawn é um jogo eletrônico de RPG de ação desenvolvido pela Guerrilla Games e publicado pela Sony Interactive Entertainment.", 
        preco: 'R$'+199.99, 
        imagem: './img/Horizon_Forbidden_West.jpg'
    },
    {
        id: 1, 
        nome: 'Uncharted 4', 
        descricao: " O quarto título principal da série Uncharted e foi lançado exclusivamente para PlayStation 4 em 10 de maio de 2016. Um dos melhores jogos de 2016",  
        preco: 'R$' + 89.90, 
        imagem: './img/uncharted-produto.jpg'
    },
    {
        id: 2, 
        nome: 'God of War', 
        descricao: "God of War é uma série de jogos eletrônicos de ação-aventura criada por David Jaffe da Santa Monica Studio, da Sony. Iniciada em 2005 no console PlayStation 2",  
        preco: 'R$'+79.90, 
        parcelamento: 'ou 10x de 250 sem juros',
        imagem: './img/god.jpg'
    },
    {
        id: 3, 
        nome: 'Horizon Forbidden West', 
        descricao: "Horizon Zero Dawn é um jogo eletrônico de RPG de ação desenvolvido pela Guerrilla Games e publicado pela Sony Interactive Entertainment.", 
        preco: 'R$'+199.99, 
        imagem: './img/Horizon_Forbidden_West.jpg'
    },
    {
        id: 1, 
        nome: 'Uncharted 4', 
        descricao: " O quarto título principal da série Uncharted e foi lançado exclusivamente para PlayStation 4 em 10 de maio de 2016. Um dos melhores jogos de 2016",  
        preco: 'R$' + 89.90, 
        imagem: './img/uncharted-produto.jpg'
    },
    {
        id: 2, 
        nome: 'God of War', 
        descricao: "God of War é uma série de jogos eletrônicos de ação-aventura criada por David Jaffe da Santa Monica Studio, da Sony. Iniciada em 2005 no console PlayStation 2",  
        preco: 'R$'+79.90, 
        parcelamento: 'ou 10x de 250 sem juros',
        imagem: './img/god.jpg'
    },
    {
        id: 3, 
        nome: 'Horizon Forbidden West', 
        descricao: "Horizon Zero Dawn é um jogo eletrônico de RPG de ação desenvolvido pela Guerrilla Games e publicado pela Sony Interactive Entertainment.", 
        preco: 'R$'+199.99, 
        imagem: './img/Horizon_Forbidden_West.jpg'
    },
    {
        id: 1, 
        nome: 'Uncharted 4', 
        descricao: " O quarto título principal da série Uncharted e foi lançado exclusivamente para PlayStation 4 em 10 de maio de 2016. Um dos melhores jogos de 2016",  
        preco: 'R$' + 89.90, 
        imagem: './img/uncharted-produto.jpg'
    },
    {
        id: 2, 
        nome: 'God of War', 
        descricao: "God of War é uma série de jogos eletrônicos de ação-aventura criada por David Jaffe da Santa Monica Studio, da Sony. Iniciada em 2005 no console PlayStation 2",  
        preco: 'R$'+79.90, 
        parcelamento: 'ou 10x de 250 sem juros',
        imagem: './img/god.jpg'
    },
    {
        id: 3, 
        nome: 'Horizon Forbidden West', 
        descricao: "Horizon Zero Dawn é um jogo eletrônico de RPG de ação desenvolvido pela Guerrilla Games e publicado pela Sony Interactive Entertainment.", 
        preco: 'R$'+199.99, 
        imagem: './img/Horizon_Forbidden_West.jpg'
    },
    {
        id: 1, 
        nome: 'Uncharted 4', 
        descricao: " O quarto título principal da série Uncharted e foi lançado exclusivamente para PlayStation 4 em 10 de maio de 2016. Um dos melhores jogos de 2016",  
        preco: 'R$' + 89.90, 
        imagem: './img/uncharted-produto.jpg'
    },
    {
        id: 2, 
        nome: 'God of War', 
        descricao: "God of War é uma série de jogos eletrônicos de ação-aventura criada por David Jaffe da Santa Monica Studio, da Sony. Iniciada em 2005 no console PlayStation 2",  
        preco: 'R$'+79.90, 
        parcelamento: 'ou 10x de 250 sem juros',
        imagem: './img/god.jpg'
    },
    {
        id: 3, 
        nome: 'Horizon Forbidden West', 
        descricao: "Horizon Zero Dawn é um jogo eletrônico de RPG de ação desenvolvido pela Guerrilla Games e publicado pela Sony Interactive Entertainment.", 
        preco: 'R$'+199.99, 
        imagem: './img/Horizon_Forbidden_West.jpg'
    },
    {
        id: 4, 
        nome: 'The last of us 2', 
        descricao: "The Last of Us é uma franquia de jogos eletrônicos de ação-aventura e survival horror exclusiva da PlayStation, criada por Neil Druckmann. ", 
        preco: 'R$'+149.99, 
        imagem: './img/theLastofus.jpg'
    }
    
]
const criarCard = (produto)=>{
    const card = document.createElement('div')
    card.classList.add('card-produto')
    card.innerHTML = `<h3>${produto.nome}</h3>
    <div class="imagem-produto">
        <img src="${produto.imagem}" alt="">
    </div>
    <span class="descricao-produto">
        ${produto.descricao}
    </span>
    <div class="valorEcompra">
        <span class="valor">${produto.preco}</span>
            <a href=""><button>Comprar</button></a>
        </div>`
        return card;
}
const carregarProdutos = (produtos)=>{
    const cards = document.querySelector('.cards')
    const produtosCards = produtos.map(criarCard)

    cards.replaceChildren(...produtosCards)
}
carregarProdutos(db)

function abrir() {
    document.querySelector(".menu-burger-container").classList.toggle("active");
  }
  function fechar() {
    document.querySelector(".menu-burger-container").classList.remove("active");
  }

    const filtro = document.querySelector(".filtro-produtos")
    const botaoFiltro = document.querySelector(".pesquisar-produto")
    const cancelarFiltro = document.querySelector(".cancelar-produto")

const abrirFiltro = ()=>{
    filtro.classList.add('exibir')
    botaoFiltro.classList.add('active')
    cancelarFiltro.classList.add('active2')
    
    
}

const fecharFiltro = ()=>{
    botaoFiltro.classList.remove("active")
    filtro.classList.remove('exibir')
    cancelarFiltro.classList.remove('active2')
}

document.querySelector(".menu-burger-container").addEventListener("click", abrir);
document.getElementById('pesquisarProduto').addEventListener('click', abrirFiltro)
document.getElementById('cancelarProduto').addEventListener('click', fecharFiltro)