'use strict'

const images = [
    {'id': '1', 'url': './img/banner.png'},
    {'id': '2', 'url': './img/banner2.jpg'},
    {'id': '3', 'url': './img/theLastofus.jpg'},
    {'id': '4', 'url': './img/banner3.jpg'}
]

const promocoes = [
    {'id': '1', 'titulo': 'Resident evil 8','url': './img/banner.png', 'valor': 179.99, 'desconto': 129.99},
    {'id': '2', 'titulo': 'Batman Arkhan Knight','url': './img/batman.jpg', 'valor': 100.00, 'desconto': 80.00},
    {'id': '3', 'titulo': 'Call od Duty: Black ops II','url': './img/cod.jpg', 'valor': 120.00, 'desconto': 100.00},
    {'id': '4', 'titulo': 'Assassins Creed','url': './img/assassins.jpg', 'valor': 99.99, 'desconto': 69.99},
    {'id': '5', 'titulo': 'Battlefield','url': './img/battlefield.jpg', 'valor': 199.99, 'desconto': 129.99},
    {'id': '6', 'titulo': 'Injustice 2','url': './img/injustice.jpg', 'valor': 99.99, 'desconto': 49.99},
    {'id': '7', 'titulo': 'Mortal Kombat 11','url': './img/mk.jpg', 'valor': 179.99, 'desconto': 120.99}
]

const containerItems = document.querySelector('#container-items')
const containerItemsPromocoes = document.querySelector('#container-items-promocoes')


const loadImages = (images, container) =>{
    
    images.forEach(image => {
        container.innerHTML += 
        `<div class='item'>
            <img src = '${image.url}'>
        </div>`        
    });
}

const loadImagesPromocoes = (promocoes, container) =>{
    
    promocoes.forEach(promocao => {
        container.innerHTML += 
        `<div class='item-promocao'>
          <img src = '${promocao.url}'>
            <div class='precos-promocoes'>
                <h3>${promocao.titulo}</h3>
                <p class ='desconto'>De:R$${promocao.valor}</p>
                <p class='valorAtual'>Por:R$${promocao.desconto}</p>
            </div>
        </div>`        
    });
}
loadImages(images, containerItems)
loadImagesPromocoes(promocoes, containerItemsPromocoes)

let items = document.querySelectorAll('.item')
let itemsPromocoes = document.querySelectorAll('.item-promocao')

const next = () =>{
    containerItems.appendChild(items[0])
    items = document.querySelectorAll('.item')
}

const nextPromocoes = () =>{
    containerItemsPromocoes.appendChild(itemsPromocoes[0])
    itemsPromocoes = document.querySelectorAll('.item-promocao')
}

const previous = () =>{
    const lastItem = itemsPromocoes[itemsPromocoes.length - 1]
    containerItemsPromocoes.insertBefore(lastItem, itemsPromocoes[0])
    itemsPromocoes = document.querySelectorAll('.item-promocao')
}

document.querySelector('#previous').addEventListener('click', previous)
document.querySelector('#next').addEventListener('click', nextPromocoes)

setInterval(next, 5000)