// Elementos que usaram o slide show
const knowMmoreArea = document.querySelector('.know-more-area');

// Caminhos das imagens
const imgPath = [
    "./assets/img/banner/pexels-riccardo-789382.jpg",
    "./assets/img/banner/pexels-h-emre-773471.jpg",
    "./assets/img/banner/pexels-nout-gons-378570.jpg",
    "./assets/img/banner/pexels-peng-liu-169647.jpg",
];

var index = 0;

var interval = setInterval(() => {

    if (index > imgPath.length - 1) {
        index = 0;
    }

    knowMmoreArea.style.cssText = `background-image: url(${imgPath[index]});`;

    index++
}, 10000);