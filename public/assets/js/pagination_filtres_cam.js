const allProducts = [

    // Page 1 - Mélange varié (haut/bas de gamme, toutes marques)
    { name: "Leica M11 P", price: 9850000, rating: 5.0, brand: "Leica", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTwfarFBbe2VCqNMIoF1sylX6qN2Yp4h0Jog&s" },
    { name: "Polaroid Now Instant Gen II", price: 145000, rating: 3.7, brand: "Polaroid", image: "https://cdn.shopify.com/s/files/1/1135/7914/files/Now_Purple__Shadows_V2.png?v=1733904182" },
    { name: "Sony Alpha 6700", price: 1250000, rating: 4.5, brand: "Sony", image: "https://fototrade.lu/wp-content/uploads/2023/07/SONY-alpha-6700-18-135-8.png" },
    { name: "Casio Exilim EX-H30", price: 145000, rating: 3.3, brand: "Casio", image: "https://www.01net.com/app/uploads/2011/05/casio-exilim-ex-h30-1.jpg" },
    { name: "Nikon Z6 II", price: 1950000, rating: 4.5, brand: "Nikon", image: "https://cdn.lesnumeriques.com/optim/product/60/60197/2ab41fa8-z-6ii__1200_678__overflow.jpeg" },
    { name: "Samsung ST200F", price: 125000, rating: 3.2, brand: "Samsung", image: "https://www.ephotozine.com/articles/samsung-st200f-digital-camera-review-19255/images/highres-samsungst200ftop_1337789112.jpg" },
    { name: "Fujifilm GFX100 II", price: 6500000, rating: 4.9, brand: "Fujifilm", image: "https://www.photoreview.com.au/wp-content/uploads/2023/10/GFX100-II-white_55mm_lens.jpg" },
    { name: "Canon EOS 4000D", price: 285000, rating: 3.8, brand: "Canon", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRkqpex8LD4KBEwhLRQR6Dj_3qvP-iJGlMB7g&s" },
    { name: "Hasselblad X2D 100C", price: 9500000, rating: 4.9, brand: "Hasselblad", image: "https://images.ctfassets.net/bht415zek091/79g0JOq2XHVPXRMm7f5Kda/315f48dea4543335963faf482610b886/Hasslelblad-X2D-100C-web-2.jpg" },
    { name: "FAP Norca A", price: 165000, rating: 3.2, brand: "FAP", image: "https://tse1.mm.bing.com/th/id/OIP.Dh3ncayB0txPKpktJZJuVgHaGH?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Lumix Z5IIX Hybride", price: 1580000, rating: 4.7, brand: "Lumix", image: "https://www.panasonic.com/content/dam/pim/uk/en/DC/DC-S5M/DC-S5M2X/ast-1824751.jpg.pub.crop.pc.thumb.640.1200.jpg" },
    { name: "Olympus Tough TG-3", price: 385000, rating: 3.8, brand: "Olympus", image: "https://i.pcmag.com/imagery/reviews/02bX9GPtbKR56GIN65hX9pg-17..v1569472868.jpg" },

    // Page 2 - Mélange varié (milieu/haut de gamme, toutes marques)
    { name: "Phase One XF", price: 15500000, rating: 5.0, brand: "Phase One", image: "https://teamworkphoto.com/wp-content/uploads/2023/11/xf-body-with-lens-phaseone-e1538410321114.jpg" },
    { name: "Kodak Smile Classic", price: 95000, rating: 3.0, brand: "Kodak", image: "https://www.digitaltrends.com/wp-content/uploads/2019/11/kodak_smile_classic_review-9641.jpg?p=1" },
    { name: "Canon EOS R6 Mark II", price: 2850000, rating: 4.6, brand: "Canon", image: "https://cdn.media.amplience.net/i/canon/09_frontback-pro_0c048afdc81c488eb9e5592f9cccc06e" },
    { name: "Pentax K-R", price: 325000, rating: 3.6, brand: "Pentax", image: "https://www.bhphotovideo.com/images/fb/Pentax_14734_K_r_Digital_SLR_Camera_734905.jpg" },
    { name: "Sony Alpha 7 IV", price: 2150000, rating: 4.8, brand: "Sony", image: "https://www.kamera-express.fr/_ipx/b_%23ffffff00,f_webp,fit_contain,s_484x484/https://www.kamera-express.nl/media/008f3906-76bd-4b30-80a6-7b1e947a3e39/sony-a7-iv-35mm-f-1-4-gm.jpg" },
    { name: "Edixa-Mat Kadett", price: 195000, rating: 3.4, brand: "Edixa", image: "https://vignette.wikia.nocookie.net/camerapedia/images/3/38/Edixa-mat_Kadett.jpg/revision/latest?cb=20111217095749" },
    { name: "Leica M11 Monochrom", price: 10500000, rating: 4.9, brand: "Leica", image: "https://amateurphotographer.com/wp-content/uploads/sites/7/2023/04/Leica-M11-Monochrom-03-P1129817.jpg" },
    { name: "GoPro Hero 10 Black", price: 385000, rating: 4.2, brand: "GoPro", image: "https://images.expertreviews.co.uk/wp-content/uploads/2022/03/gopro_hero_10_black_1_0.jpg" },
    { name: "Nikon Heralbony ZFC", price: 950000, rating: 4.2, brand: "Nikon", image: "https://petapixel.com/assets/uploads/2024/09/nikon-zfc-heralbony-featured-800x420.jpg" },
    { name: "Rollei 35 AF", price: 1250000, rating: 4.3, brand: "Rollei", image: "https://rollei35af.com/cdn/shop/files/Rollei35AF-b2.jpg?v=1719479382&width=1500" },
    { name: "Samsung PL210", price: 115000, rating: 3.2, brand: "Samsung", image: "https://www.ephotozine.com/articles/samsung-pl210-digital-compact-camera-review-16511/images/samsung_pl210_front_lens.jpg" },
    { name: "Sigma FP L", price: 2850000, rating: 4.5, brand: "Sigma", image: "https://th.bing.com/th/id/R.027a2a95c16634ef89fa1e8527c4e836?rik=8n7sQ9tx%2fJq04g&pid=ImgRaw&r=0" },

    // Page 3 - Mélange varié (entrée/milieu de gamme, toutes marques)
    { name: "Fujifilm GFX100RF", price: 7200000, rating: 4.8, brand: "Fujifilm", image: "https://www.cined.com/content/uploads/2025/03/FUJIFILM-GFX100RF.jpg" },
    { name: "Polaroid Go Gen 2", price: 125000, rating: 3.5, brand: "Polaroid", image: "https://media.foto-erhardt.de/images/product_images/original_images/264/polaroid-go-kamera-gen2-schwarz-169762046426460304.jpg" },
    { name: "Canon EOS R50", price: 825000, rating: 4.3, brand: "Canon", image: "https://apprendre-la-photo.fr/wp-content/uploads/2024/07/44efa78a-eb08-41bf-a91b-407d086228f2.jpeg" },
    { name: "Konica C35 EF", price: 285000, rating: 3.7, brand: "Konica", image: "https://th.bing.com/th/id/R.3b404e6a231af7e6615602c5fbadc614?rik=w%2fr01Fh1b306TA&pid=ImgRaw&r=0" },
    { name: "Lumix DC-GH5 II", price: 1450000, rating: 4.2, brand: "Lumix", image: "https://2.img-dpreview.com/files/p/E~TS590x0~articles/6043990845/Panasonic_Lumix_DC-GH5_II.jpeg" },
    { name: "Casio EX-FC100", price: 165000, rating: 3.4, brand: "Casio", image: "https://theawesomer.com/photos/2009/01/010909_casio_1.jpg" },
    { name: "Hasselblad XPAN", price: 8500000, rating: 4.8, brand: "Hasselblad", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvgk2sNZNeqAH31CwD-7j2Ucuyal7HHDoP-Q&s" },
    { name: "Sony ZV E10", price: 685000, rating: 4.1, brand: "Sony", image: "https://sony.scene7.com/is/image/sonyglobalsolutions/Mobile_ZV-E10_202507?$productIntroPlatemobile$&fmt=png-alpha" },
    { name: "Olympus OM-D E-M10 Mark IV", price: 725000, rating: 4.0, brand: "Olympus", image: "https://cdn.mos.cms.futurecdn.net/RDGiTpt4GBgbZbjryh2pmh.jpg" },
    { name: "Kodak PixPro FZ55", price: 185000, rating: 3.3, brand: "Kodak", image: "https://monappareilphotopro.fr/wp-content/uploads/2024/10/KODAK-FZ55.png" },
    { name: "Pentax K-1 II", price: 1850000, rating: 4.4, brand: "Pentax", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfxsjh59ueUf1MNiLykcPPMSEnl3ixDYdG-Q&s" },
    { name: "Edixa Mat Reflex Mod C", price: 225000, rating: 3.3, brand: "Edixa", image: "https://tse3.mm.bing.com/th/id/OIP.uggGfHmUkOnmLKOacutr5gAAAA?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },

    // Page 4 - Mélange varié (toutes gammes confondues)
    { name: "Phase One 645DF", price: 12500000, rating: 4.8, brand: "Phase One", image: "https://dtcommercialphoto.com/wp-content/upload/645DF-_110mm_low.jpg" },
    { name: "FAP Norca B", price: 145000, rating: 3.1, brand: "FAP", image: "https://collectiblend.com/Cameras/images/FAP-Norca-B.jpg" },
    { name: "Nikon Coolpix P1100", price: 485000, rating: 3.9, brand: "Nikon", image: "https://static.bhphoto.com/images/multiple_images/images500x500/1738709312_IMG_2421914.jpg" },
    { name: "Leica Q3", price: 6850000, rating: 4.7, brand: "Leica", image: "https://amateurphotographer.com/wp-content/uploads/sites/7/2023/05/Leica-Q3-16-P5193114-acr.jpg" },
    { name: "Samsung MV800", price: 145000, rating: 3.1, brand: "Samsung", image: "https://tse4.mm.bing.com/th/id/OIP.apFqgvdJ6h2NZ3ZzeNOSWAHaHa?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Lumix S9 Hybride", price: 1680000, rating: 4.4, brand: "Lumix", image: "https://apprendre-la-photo.fr/wp-content/uploads/2024/06/f4b186ad-4e02-46fc-94e1-f74df9a99426.jpeg" },
    { name: "GoPro Hero 12 Black", price: 485000, rating: 4.5, brand: "GoPro", image: "https://tse4.mm.bing.net/th/id/OIP.cV_edHnbo_P2aB9DtnS_7wHaEH?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Rollei 35-SE", price: 985000, rating: 4.1, brand: "Rollei", image: "https://tse3.mm.bing.net/th/id/OIP.C83yNMr5svYEOigPEOlYLQHaFl?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Fujifilm X-20", price: 1150000, rating: 4.3, brand: "Fujifilm", image: "https://www.dpreview.com/files/p/E~C333x0S5333x4000T600x450~articles/5886870236/fujifilm-xs20-hero-image.jpeg" },
    { name: "Kodak PixPro AZ528", price: 225000, rating: 3.4, brand: "Kodak", image: "https://m.media-amazon.com/images/I/61McUe4dmsL._AC_.jpg" },
    { name: "Hasselblad X1D II", price: 7850000, rating: 4.6, brand: "Hasselblad", image: "https://media.wired.com/photos/5d41f41b90bf49000859ec4a/191:100/w_1280,c_limit/Gear-Hasselblad-x1d-front-tilt-SOURCE-Hasselblad.jpg?mbid=social_retweet" },
    { name: "Konica Autoreflex T3", price: 325000, rating: 3.8, brand: "Konica", image: "https://tse1.mm.bing.com/th/id/OIP.scxAL6SIXxYPX-J4zSFPuQAAAA?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },

    // Page 5 - Mélange varié (toutes gammes, toutes marques)
    { name: "Phase One IXM-100", price: 18500000, rating: 4.9, brand: "Phase One", image: "https://tohasen.com/images/detailed/40/N_1186228p2_r.jpg" },
    { name: "Polaroid Everything Box", price: 185000, rating: 3.6, brand: "Polaroid", image: "https://blush-conceptstore.com/cdn/shop/files/polaroidgo2.png?v=1719456395" },
    { name: "Pentax K-S2", price: 485000, rating: 3.9, brand: "Pentax", image: "https://m.media-amazon.com/images/I/51Kjqvb5kNL.jpg" },
    { name: "Sigma F2.8 Art", price: 1650000, rating: 4.4, brand: "Sigma", image: "https://www.cameralabs.com/wp-content/uploads/2018/05/hero_Sigma14-24f2-8art_42955-945x630@2x.jpg" },
    { name: "Casio EX-ZR200", price: 185000, rating: 3.5, brand: "Casio", image: "https://camera-kaitori.jp/wp-content/uploads/2024/05/S__183435277.jpg" },
    { name: "Olympus PEN E-P7", price: 895000, rating: 4.1, brand: "Olympus", image: "https://cdn.sanity.io/images/ipox1240/live/1ed9c4230a3e0272315fb6ea1ed8cb4b05990128-978x697.webp" },
    { name: "Rollei 35 RF", price: 1450000, rating: 4.4, brand: "Rollei", image: "https://i0.wp.com/www.nocsensei.com/wp-content/uploads/2023/05/M_Cavina_Rollei_35_RF_17.jpg?ssl=1" },
    { name: "FAP Norca C", price: 155000, rating: 3.0, brand: "FAP", image: "https://tse2.mm.bing.com/th/id/OIP.gKPw9XLoBets060eWhd-cgHaE7?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "GoPro Max 2.0", price: 525000, rating: 4.3, brand: "GoPro", image: "https://www.notebookcheck.net/fileadmin/Notebooks/News/_nc3/gopromax2header.jpg" },
    { name: "Sigma DP2", price: 685000, rating: 4.0, brand: "Sigma", image: "https://www.arretetonchar.fr/wp-content/uploads/2013/IMG/jpg/Appareil_photo_-_Sigma_-_2.jpg" },
    { name: "Konica Autoreflex A3", price: 385000, rating: 3.9, brand: "Konica", image: "https://www.phototekcanada.com/cdn/shop/files/DSC_0170_4_1024x1024@2x.jpg?v=1718917451" },
    { name: "Edixa 125 L", price: 185000, rating: 3.2, brand: "Edixa", image: "https://tse4.mm.bing.com/th/id/OIP.Sca8Swlszrq9AWtfl1WmeQHaFM?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" }

]

const pagination1 = {
    currentPage: 1,
    gridID: "grid1",
    paginID: "pagin1",
    titleID: "title1"
}

const pagination2 = {
    currentPage: 1,
    gridID: "grid2",
    paginID: "pagin2",
    titleID: "title2"
}

const pagination3 = {
    currentPage: 1,
    gridID: "grid3",
    paginID: "pagin3",
    titleID: "title3"
}

const productsPerPage = 12;
let totalPages = 5;

let filteredProducts = allProducts;

document.addEventListener('DOMContentLoaded', () => {
    const filterDropdownLinks = document.querySelectorAll('.product-filters-bar .filter-options-list a');
    const allFiltersButton = document.querySelector('.filter-all-button');
    const filterNone = document.getElementById('none');

    let activeFilters = {
        price: null,
        brand: null,
        rating: null
    };

    const applyFilters = () => {
        let matchingProducts = [];

        allProducts.forEach(product => {
            let matches = true;

            const brand = product.brand.toLowerCase();
            const price = product.price;
            const rating = product.rating;

            if (activeFilters.brand) {
                const filterBrandNormalized = activeFilters.brand.toLowerCase();
                if (!brand.includes(filterBrandNormalized)) {
                    matches = false;
                }
            }

            if (matches && activeFilters.price) {
                const [minStr, maxStr] = activeFilters.price.split('-');
                const minPrice = parseFloat(minStr);
                const maxPrice = maxStr === '+' ? Infinity : parseFloat(maxStr);

                if (price < minPrice || price > maxPrice) {
                    matches = false;
                }
            }

            if (matches && activeFilters.rating) {
                const minRating = parseFloat(activeFilters.rating);
                let lowerBound, upperBound;

                if (minRating === 5) {
                    lowerBound = 4.75;
                    upperBound = 5.1;
                } else if (minRating === 4.5) {
                    lowerBound = 4.25;
                    upperBound = 4.75;
                } else {
                    lowerBound = minRating;
                    upperBound = minRating + 0.5;
                }

                if (rating < lowerBound || rating >= upperBound) {
                    matches = false;
                }
            }

            if (matches) {
                matchingProducts.push(product);
            }
        });

        filteredProducts = matchingProducts;
        totalPages = Math.ceil(filteredProducts.length/productsPerPage);

        pagination1.currentPage = 1;
        pagination2.currentPage = 1;
        pagination3.currentPage = 1;

        updateDisplay(pagination1);
        updateDisplay(pagination2);
        updateDisplay(pagination3);
    };

    const resetFilters = () => {
        activeFilters = { price: null, brand: null, rating: null };

        filteredProducts = allProducts;
        totalPages = 5;

        pagination1.currentPage = 1;
        pagination2.currentPage = 1;
        pagination3.currentPage = 1;

        updateDisplay(pagination1);
        updateDisplay(pagination2);
        updateDisplay(pagination3);

        filterNone.checked = true;
    };

    filterDropdownLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const dataAttributes = e.currentTarget.dataset;
            activeFilters.price = dataAttributes.price || null;
            activeFilters.brand = dataAttributes.brand || null;
            activeFilters.rating = dataAttributes.rating || null;
            applyFilters();
            filterNone.checked = true;
        });
    });

    allFiltersButton.addEventListener('click', () => {
        resetFilters();
    });
});

// Afficher les produits
function displayProducts(pagination) {
    const grid = document.getElementById(pagination.gridID);
    if (grid===null) return;

    const startIndex = (pagination.currentPage - 1) * productsPerPage;
    const endIndex = Math.min(startIndex + productsPerPage, filteredProducts.length);
    const products = filteredProducts.slice(startIndex, endIndex);
    //On vide la grille pour la remplir à nouveau
    grid.innerHTML = '';

    products.forEach((product, index) => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.style.animationDelay = `${index * 0.12}s`;

        //Calcul automatique de nombre d'étoiles entières, demies et vides
        let n = (product.rating - Math.floor(product.rating))*10;
        let a = 0;
        let b = 0;
        let c = 0;
        if (n<4) {
            a = Math.floor(product.rating);
            b = 0;
            c = 5-a;
        } else if (n<7) {
            a = Math.floor(product.rating);
            b = 1;
            c = 5-a-b;
        } else {
            a = Math.ceil(product.rating);
            b = 0;
            c = 5-a-b;
        }

        card.innerHTML = `
          <div class="product-frame">
               <img src=${product.image}  alt=${product.brand} class="product-image">
          </div>
          <div class="product-title">${product.name}</div>
          <div class="product-rating">${'<i class="fa-solid fa-star"></i>'.repeat(a)}${'<i class="fa-solid fa-star-half-stroke"></i>'.repeat(b)}${'<i class="fa-regular fa-star"></i>'.repeat(c)}(${product.rating})</div>
          <div class="price-cart">
			  <div class="product-price">${product.price} FCFA</div>
			  <button class="btn-outline"><i class="fas fa-shopping-cart icon-margin"></i></button>
          </div>
        `;

        grid.appendChild(card);
    });

    if (typeof attachNavigationEvents === 'function') {
        attachNavigationEvents()
    }

}

// Générer la pagination intelligente
function renderPagination(pagination) {
    const pagin = document.getElementById(pagination.paginID);
    if (pagin===null) return;

    const currentPage = pagination.currentPage;
    //On vide la pagination pour le reremplir
    pagin.innerHTML = '';

    // Bouton Previous
    const prevBtn = document.createElement('button');
    prevBtn.textContent = 'Previous';
    prevBtn.className = 'page-btn';
    prevBtn.disabled = currentPage === 1;
    prevBtn.onclick = () => goToPage(currentPage - 1, pagination);
    pagin.appendChild(prevBtn);

    // Créer les boutons de pagination
    const pagesToShow = [];
    for (let i=1; i<=totalPages; i++) {
        pagesToShow.push(i);
    }
    pagesToShow.forEach(page => {
        const btn = document.createElement('button');

        btn.className = 'page-num';
        btn.textContent = page;
        btn.onclick = () => goToPage(page, pagination);
        if (page === currentPage) {
            btn.className = 'page-num-active';
        }
        pagin.appendChild(btn);
    });

    // Bouton Next
    const nextBtn = document.createElement('button');
    nextBtn.textContent = 'Next';
    nextBtn.className = 'page-btn';
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.onclick = () => goToPage(currentPage + 1, pagination);
    pagin.appendChild(nextBtn);
}

function updateDisplay(pagination) {
    displayProducts(pagination);
    renderPagination(pagination);
}

// Aller à une page
function goToPage(page, pagination) {
    if (page < 1 || page > totalPages) return;
    pagination.currentPage = page;
    updateDisplay(pagination)
    // Scroll en haut de la grille
    const title = document.getElementById(pagination.titleID);
    title.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// Initialisation
updateDisplay(pagination1)
updateDisplay(pagination2)
updateDisplay(pagination3)
