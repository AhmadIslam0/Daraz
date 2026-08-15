// Daraz App JavaScript Functionality

// Product Database
let productsData = [
    {
        id: "loreal-shampoo",
        title: "L'Oreal Paris Elvive Hyaluron Pure Shampoo - For Oily Scalp 175ML",
        price: 467,
        oldPrice: 599,
        discount: "-22%",
        image: "./loreal_shampoo.png",
        rating: 4.8,
        ratingCount: 153,
        soldCount: 207,
        brand: "L'Oreal Paris",
        category: "Beauty & Skincare",
        thumbnails: [
            "./loreal_shampoo.png",
            "./Tresseme.webp",
            "./pack.webp",
            "./soap.webp"
        ],
        description: `
            <p><strong>Product details of L'Oreal Paris Elvive Hyaluron Pure Shampoo - For Oily Scalp 175ML</strong></p>
            <p>Innovative dual-action formula with salicylic and hyaluronic acids removes up to 100 percent of residue leaving the scalp feeling refreshed and reinvigorated for up to 72H. Packaging may vary</p>
            <ul>
                <li>Inspired by Skincare - Infused with Salicylic and Hyaluronic Acids for 72H purified roots and hydrated, shiny, healthy-looking hair</li>
                <li>Fresh Fragrance - Indulge in a blend of bright berries, cherry blossom, sweet vanilla, and sandalwood</li>
                <li>Non-stripping formulas - The innovative combination removes impurities and leaves scalp feeling refreshed</li>
            </ul>
            <p><strong>How to Use:</strong><br>Apply a quarter-sized amount to wet roots, massage into a lather and rinse. Follow up with conditioner.</p>
        `,
        reviews: [
            { name: "Hina Shah", rating: 5, date: "2 days ago", comment: "acha hy.. tik received ho gaya hy fast time hi order kia hy or one time use kia hy acha hy Cleansing:good Scent:good Lather:ok" },
            { name: "Muhammad Ali", rating: 5, date: "1 week ago", comment: "Original product! Highly recommended, quick delivery by Daraz." },
            { name: "Saima K.", rating: 4, date: "2 weeks ago", comment: "Very good shampoo for oily scalp, leaves hair very soft." }
        ]
    },
    {
        id: "ztr-treadmill",
        title: "ZTR-15 Treadmill Heavy Duty Exercise Machine",
        price: 96499,
        oldPrice: 320000,
        discount: "-70%",
        image: "./ZTR-15 Treadmill.webp",
        rating: 4.7,
        ratingCount: 89,
        soldCount: 142,
        brand: "ZTR",
        category: "Sports & Fitness",
        thumbnails: ["./ZTR-15 Treadmill.webp", "./Dumbbells.avif"],
        description: "<p>Heavy duty electric treadmill with multi-functional LCD screen, heart rate monitor, foldability, and shock absorption system.</p>",
        reviews: [{ name: "Tariq M.", rating: 5, date: "3 days ago", comment: "Excellent build quality and very silent operation!" }]
    },
    {
        id: "ensure-milk",
        title: "Ensure Chocolate Milk Powder 400g",
        price: 2899,
        oldPrice: 3135,
        discount: "-8%",
        image: "./Ensure.webp",
        rating: 4.9,
        ratingCount: 310,
        soldCount: 520,
        brand: "Abbott Ensure",
        category: "Groceries",
        thumbnails: ["./Ensure.webp"],
        description: "<p>Complete balanced nutrition milk powder with delicious chocolate flavor. Rich in 28 essential vitamins & minerals.</p>",
        reviews: [{ name: "Fatima B.", rating: 5, date: "Yesterday", comment: "Original product with long expiry. Very satisfied!" }]
    },
    {
        id: "sereno-massage-chair",
        title: "Sereno Presage Massage Chair, Full Body Massage, Zero Gravity, 12 Auto Programs",
        price: 155899,
        oldPrice: 290000,
        discount: "-46%",
        image: "./mass.webp",
        rating: 4.9,
        ratingCount: 42,
        soldCount: 65,
        brand: "Sereno",
        category: "Health & Beauty",
        thumbnails: ["./mass.webp"],
        description: "<p>Ultimate luxury massage chair featuring zero gravity recliner, 3D body scan, 12 automated programs, and full body airbag therapy.</p>",
        reviews: [{ name: "Usman K.", rating: 5, date: "5 days ago", comment: "Worth every rupee. Feel like a new person after 15 mins massage." }]
    },
    {
        id: "repair-tape",
        title: "Waterproof Leakage Repair Tape Heavy Duty Super Strong",
        price: 61,
        oldPrice: 100,
        discount: "-39%",
        image: "./Tape.webp",
        rating: 4.3,
        ratingCount: 540,
        soldCount: 1200,
        brand: "Generic",
        category: "Home Improvement",
        thumbnails: ["./Tape.webp", "./repairtape.webp"],
        description: "<p>Super strong waterproof tape suitable for pipe repair, roof leak sealing, hose bonding and emergency fixes.</p>",
        reviews: [{ name: "Bilal R.", rating: 4, date: "1 week ago", comment: "Sticks very well on water pipes." }]
    },
    {
        id: "silicon-ice-roller",
        title: "Silicone Ice Cube Roller Massager for Face, Eyes and Neck Naturally Conditioning",
        price: 166,
        oldPrice: 250,
        discount: "-34%",
        image: "./Silicon Ice.webp",
        rating: 4.6,
        ratingCount: 230,
        soldCount: 610,
        brand: "Skincare Essentials",
        category: "Beauty & Skincare",
        thumbnails: ["./Silicon Ice.webp"],
        description: "<p>Reusable silicone ice roller for facial massage, puffiness reduction, skin tightening, and pore minimization.</p>",
        reviews: [{ name: "Ayesha N.", rating: 5, date: "4 days ago", comment: "Love using this every morning for face depuffing!" }]
    },
    {
        id: "mini-book-light",
        title: "Mini Book Light LED Clamp Reading Lamp Night Lights Bookmark Desk",
        price: 239,
        oldPrice: 618,
        discount: "-61%",
        image: "./minibook.webp",
        rating: 4.5,
        ratingCount: 180,
        soldCount: 430,
        brand: "LitUp",
        category: "Electronics",
        thumbnails: ["./minibook.webp"],
        description: "<p>Flexible clip-on LED reading lamp with adjustable brightness, perfect for reading books at night without disturbing others.</p>",
        reviews: [{ name: "Hamza A.", rating: 5, date: "6 days ago", comment: "Bright enough and battery lasts a long time!" }]
    },
    {
        id: "black-tea",
        title: "Premium Leaf Black Tea 500G Strong Refreshing Flavor",
        price: 526,
        oldPrice: 799,
        discount: "-34%",
        image: "./tea.webp",
        rating: 4.8,
        ratingCount: 390,
        soldCount: 890,
        brand: "Tealand",
        category: "Groceries",
        thumbnails: ["./tea.webp", "./danadar.webp"],
        description: "<p>Selected high-quality black tea leaves delivering rich aroma, deep amber color and authentic karak chai flavor.</p>",
        reviews: [{ name: "Zubair M.", rating: 5, date: "3 days ago", comment: "Best chai tea leaves in market!" }]
    },
    {
        id: "xiaomi-tv-43",
        title: "Xiaomi TV A 43″ FHD Smart Google TV (2026) – Bezel-less Metal Design",
        price: 57898,
        oldPrice: 71999,
        discount: "-20%",
        image: "./xiomi.avif",
        rating: 4.9,
        ratingCount: 210,
        soldCount: 340,
        brand: "Xiaomi",
        category: "Electronics",
        thumbnails: ["./xiomi.avif"],
        description: "<p>43 inch Full HD Smart Google TV with Dolby Audio, 20W stereo speakers, voice remote control, Chromecast built-in and 2 years official warranty.</p>",
        reviews: [{ name: "Imran S.", rating: 5, date: "2 days ago", comment: "Amazing display quality and Google TV works seamlessly!" }]
    },
    {
        id: "homecure-cream",
        title: "Home cure cream & sachet combo (guaranteed results in just 2 days)",
        price: 1154,
        oldPrice: 1412,
        discount: "-18%",
        image: "./homecure.webp",
        rating: 4.4,
        ratingCount: 95,
        soldCount: 210,
        brand: "HomeCure",
        category: "Beauty & Skincare",
        thumbnails: ["./homecure.webp"],
        description: "<p>Herbal skincare cream & sachet combo for clear, glowing, spot-free skin texture.</p>",
        reviews: [{ name: "Noreen G.", rating: 4, date: "4 days ago", comment: "Good results after a week of use." }]
    },
    {
        id: "butterfly-massager",
        title: "Mini Butterfly Body Massager – Rechargeable EMS Electric Muscle Massage Pad",
        price: 318,
        oldPrice: 700,
        discount: "-55%",
        image: "./butterfly.webp",
        rating: 4.6,
        ratingCount: 340,
        soldCount: 800,
        brand: "EMS Health",
        category: "Health & Beauty",
        thumbnails: ["./butterfly.webp"],
        description: "<p>Portable pulse electric massager for neck, back, shoulders, and legs. Relieves muscle pain and fatigue with USB recharging.</p>",
        reviews: [{ name: "Kamran T.", rating: 5, date: "5 days ago", comment: "Very useful for neck stiffness relief." }]
    },
    {
        id: "derma-roller",
        title: "Derma Roller With 540 Micro Needle Skin Therapy 0.5mm",
        price: 163,
        oldPrice: 300,
        discount: "-46%",
        image: "./roller.webp",
        rating: 4.5,
        ratingCount: 290,
        soldCount: 600,
        brand: "DermaCare",
        category: "Beauty & Skincare",
        thumbnails: ["./roller.webp"],
        description: "<p>Micro needle roller for collagen stimulation, skin regeneration, acne scar reduction, and hair growth stimulation.</p>",
        reviews: [{ name: "Sadaf W.", rating: 5, date: "1 week ago", comment: "High quality microneedles, smooth rolling." }]
    },
    {
        id: "mesh-tape",
        title: "Window Screen Repair Tape Self Adhesive Mesh Net Fix Patch",
        price: 133,
        oldPrice: 399,
        discount: "-67%",
        image: "./repairtape.webp",
        rating: 4.2,
        ratingCount: 150,
        soldCount: 380,
        brand: "Generic",
        category: "Home Improvement",
        thumbnails: ["./repairtape.webp"],
        description: "<p>Self-adhesive glass fiber mesh patch tape for quickly repairing holes and tears in window screens and mosquito doors.</p>",
        reviews: [{ name: "Asad H.", rating: 4, date: "3 days ago", comment: "Saved me from replacing the whole window screen." }]
    },
    {
        id: "tapal-danedar",
        title: "Tapal Danedar 430gm Pouch CP-Save Rs 70",
        price: 819,
        oldPrice: 830,
        discount: "-1%",
        image: "./danadar.webp",
        rating: 4.9,
        ratingCount: 820,
        soldCount: 1500,
        brand: "Tapal",
        category: "Groceries",
        thumbnails: ["./danadar.webp"],
        description: "<p>Pakistan's favorite tea brand! Tapal Danedar offering strong taste and rich color in every cup.</p>",
        reviews: [{ name: "Haris M.", rating: 5, date: "Yesterday", comment: "Fresh stock and fast delivery." }]
    },
    {
        id: "pack-powders",
        title: "Pack of 5 Powders + 2 Free | Rice, Multani, Rose, Orange Peel, Neem Powder",
        price: 431,
        oldPrice: 999,
        discount: "-57%",
        image: "./pack.webp",
        rating: 4.7,
        ratingCount: 180,
        soldCount: 400,
        brand: "Pure Herbs",
        category: "Beauty & Skincare",
        thumbnails: ["./pack.webp"],
        description: "<p>100% natural organic powder set for homemade face masks, skincare packs, and hair conditioning.</p>",
        reviews: [{ name: "Zainab F.", rating: 5, date: "4 days ago", comment: "All powders are 100% pure and smelling natural." }]
    },
    {
        id: "tresemme-shampoo",
        title: "Tresemme Keratin Smooth And Straight Shampoo 360ML",
        price: 751,
        oldPrice: 930,
        discount: "-19%",
        image: "./Tresseme.webp",
        rating: 4.8,
        ratingCount: 410,
        soldCount: 850,
        brand: "Tresemme",
        category: "Beauty & Skincare",
        thumbnails: ["./Tresseme.webp"],
        description: "<p>Infused with Keratin and Argan Oil for smooth, shiny, frizz-controlled hair for up to 72 hours.</p>",
        reviews: [{ name: "Mehwish K.", rating: 5, date: "3 days ago", comment: "Makes hair silky smooth without frizz!" }]
    },
    {
        id: "door-dust-stopper",
        title: "Door Dust Stopper Draft & Insect Twin Guard Seal",
        price: 50,
        oldPrice: 399,
        discount: "-87%",
        image: "./Door Dust.webp",
        rating: 4.4,
        ratingCount: 670,
        soldCount: 2100,
        brand: "TwinGuard",
        category: "Home Improvement",
        thumbnails: ["./Door Dust.webp"],
        description: "<p>Double-sided door bottom seal strip to prevent dust, insects, cold air leaks, and noise transmission.</p>",
        reviews: [{ name: "Waqas P.", rating: 4, date: "5 days ago", comment: "Fits under room door perfectly." }]
    },
    {
        id: "zext-pillow",
        title: "ZEXT Cozy Travel Pillow U Shaped Neck Cushion Car Neck Pillow",
        price: 654,
        oldPrice: 899,
        discount: "-27%",
        image: "./zext.webp",
        rating: 4.6,
        ratingCount: 130,
        soldCount: 290,
        brand: "ZEXT",
        category: "Travel & Lifestyle",
        thumbnails: ["./zext.webp"],
        description: "<p>Soft memory foam U-shaped neck travel pillow for ergonomic support during flight, train, or car journeys.</p>",
        reviews: [{ name: "Daniyal H.", rating: 5, date: "1 week ago", comment: "Very comfortable for long road trips." }]
    },
    {
        id: "urdu-novel",
        title: "Ishq-E-Aatish By Sadia Rajpoot Urdu Novel Romantic Fiction",
        price: 388,
        oldPrice: 1499,
        discount: "-74%",
        image: "./urdunoval.webp",
        rating: 4.8,
        ratingCount: 250,
        soldCount: 510,
        brand: "Book World",
        category: "Books",
        thumbnails: ["./urdunoval.webp"],
        description: "<p>Popular Urdu romantic novel printed on premium paper with clear readable typography.</p>",
        reviews: [{ name: "Maryam A.", rating: 5, date: "2 days ago", comment: "Beautiful story and neat printing!" }]
    },
    {
        id: "magsafe-case",
        title: "MAGSAFE JELLY CASE FOR SAMSUNG A06, A15, A56, S23, S24, S25 Ultra",
        price: 299,
        oldPrice: 450,
        discount: "-34%",
        image: "./cse.avif",
        rating: 4.7,
        ratingCount: 310,
        soldCount: 750,
        brand: "CasePro",
        category: "Electronics",
        thumbnails: ["./cse.avif"],
        description: "<p>Transparent shockproof corner jelly case supporting MagSafe wireless charging for Samsung Galaxy models.</p>",
        reviews: [{ name: "Shahzaib R.", rating: 5, date: "Yesterday", comment: "Strong magnet and perfect button click feeling." }]
    },
    {
        id: "foldable-fan",
        title: "Mini Desktop Foldable Fan Portable USB Rechargeable Retractable Mute Fan",
        price: 1599,
        oldPrice: 2500,
        discount: "-36%",
        image: "./foldable fan.avif",
        rating: 4.6,
        ratingCount: 190,
        soldCount: 420,
        brand: "CoolBreeze",
        category: "Electronics",
        thumbnails: ["./foldable fan.avif"],
        description: "<p>Height adjustable telescopic folding fan with long battery backup, low noise brushless motor, and multi-speed controls.</p>",
        reviews: [{ name: "Adnan T.", rating: 4, date: "4 days ago", comment: "Saves me during load shedding!" }]
    },
    {
        id: "track-suit-white",
        title: "Billionaire printed summer track suit for men white",
        price: 807,
        oldPrice: 1500,
        discount: "-46%",
        image: "./track.avif",
        rating: 4.5,
        ratingCount: 140,
        soldCount: 310,
        brand: "Billionaire",
        category: "Fashion",
        thumbnails: ["./track.avif"],
        description: "<p>Lightweight breathable summer cotton tracksuit set featuring stylish chest print logo for men.</p>",
        reviews: [{ name: "Omer Z.", rating: 5, date: "6 days ago", comment: "Fabric is soft and fitting is spot on." }]
    },
    {
        id: "soap-holder",
        title: "Luxury Soap Holder with Drain Tray, Waterproof Wall Mounted Soap Box",
        price: 166,
        oldPrice: 395,
        discount: "-58%",
        image: "./soap.avif",
        rating: 4.7,
        ratingCount: 520,
        soldCount: 1300,
        brand: "HomeDeco",
        category: "Home Improvement",
        thumbnails: ["./soap.avif"],
        description: "<p>Wall mounted drill-free soap dish with flip lid cover and removable drainage tray to keep soap dry.</p>",
        reviews: [{ name: "Sadia B.", rating: 5, date: "3 days ago", comment: "No drilling required, sticks firmly to tiles!" }]
    },
    {
        id: "camelo-sandals",
        title: "Camelo Sandals for Men Summer High-Quality Stylish Business Style",
        price: 292,
        oldPrice: 1500,
        discount: "-81%",
        image: "./sandals.avif",
        rating: 4.8,
        ratingCount: 460,
        soldCount: 980,
        brand: "Camelo",
        category: "Fashion",
        thumbnails: ["./sandals.avif"],
        description: "<p>Comfortable cushioned sole men's summer sandals crafted with durable synthetic leather straps.</p>",
        reviews: [{ name: "Nabeel Q.", rating: 5, date: "5 days ago", comment: "Very comfortable for everyday casual wear." }]
    },
    {
        id: "glass-water-bottle",
        title: "Beautiful Glass Water Bottle with Vacuum Sleeve & Carrying Loop (400 ML)",
        price: 345,
        oldPrice: 1200,
        discount: "-71%",
        image: "./bottle.avif",
        rating: 4.6,
        ratingCount: 280,
        soldCount: 670,
        brand: "HydroFit",
        category: "Home Improvement",
        thumbnails: ["./bottle.avif"],
        description: "<p>BPA-free heat resistant borosilicate glass water bottle with protective silicone sleeve and anti-leak cap.</p>",
        reviews: [{ name: "Iqra H.", rating: 4, date: "2 days ago", comment: "Looks aesthetic and leakproof." }]
    },
    {
        id: "mini-handheld-fan",
        title: "Mini Fan Rechargeable / Handheld Desktop USB Fan Electric Portable",
        price: 467,
        oldPrice: 800,
        discount: "-42%",
        image: "./Mini Fan.avif",
        rating: 4.7,
        ratingCount: 390,
        soldCount: 890,
        brand: "CoolBreeze",
        category: "Electronics",
        thumbnails: ["./Mini Fan.avif"],
        description: "<p>Compact rechargeable USB pocket fan with removable base stand for desktop or outdoor handheld use.</p>",
        reviews: [{ name: "Faisal V.", rating: 5, date: "3 days ago", comment: "Strong wind speed for small size." }]
    },
    {
        id: "dell-laptop-sleeve",
        title: "Dell Pro Sleeve 13\" Laptop Case Original Waterproof Cushion",
        price: 2899,
        oldPrice: 5500,
        discount: "-47%",
        image: "./Dell pro.avif",
        rating: 4.8,
        ratingCount: 160,
        soldCount: 330,
        brand: "Dell",
        category: "Electronics",
        thumbnails: ["./Dell pro.avif"],
        description: "<p>Original Dell protective laptop sleeve with soft fleece interior lining and water-resistant exterior finish.</p>",
        reviews: [{ name: "Sheraz P.", rating: 5, date: "1 week ago", comment: "Fits my 13 inch laptop like a glove!" }]
    },
    {
        id: "bathroom-slippers",
        title: "Non-Slip Washroom & Bathroom Slippers for Men & Women Quick-Dry",
        price: 229,
        oldPrice: 600,
        discount: "-62%",
        image: "./chapal.avif",
        rating: 4.7,
        ratingCount: 840,
        soldCount: 1900,
        brand: "ComfortFoot",
        category: "Fashion",
        thumbnails: ["./chapal.avif"],
        description: "<p>Ultra soft EVA anti-slip shower slides with drain holes for quick drying in bathroom and indoor floors.</p>",
        reviews: [{ name: "Adeel N.", rating: 5, date: "Yesterday", comment: "Super soft and non-slippery!" }]
    },
    {
        id: "chill-dumbbells",
        title: "CHILL FITNESS Rubber Coated Dumbbells with Anti Slip Metal Handles",
        price: 182,
        oldPrice: 600,
        discount: "-70%",
        image: "./Dumbbells.avif",
        rating: 4.9,
        ratingCount: 610,
        soldCount: 1400,
        brand: "CHILL FITNESS",
        category: "Sports & Fitness",
        thumbnails: ["./Dumbbells.avif"],
        description: "<p>Rubber hex dumbbell with knurled chrome steel handle for secure non-slip grip during home workouts.</p>",
        reviews: [{ name: "Kashif R.", rating: 5, date: "4 days ago", comment: "Good quality dumbbell, rubber coating prevents floor damage." }]
    },
    {
        id: "screen-magnifier",
        title: "F3 Mobile Screen Magnifier 3D Enlarged Display Stand for Smartphones",
        price: 460,
        oldPrice: 900,
        discount: "-49%",
        image: "./F3 Mobile.avif",
        rating: 4.5,
        ratingCount: 220,
        soldCount: 500,
        brand: "F3 Optics",
        category: "Electronics",
        thumbnails: ["./F3 Mobile.avif"],
        description: "<p>3D HD phone screen amplifier stand that enlarges your phone screen 3-4 times for comfortable movie watching.</p>",
        reviews: [{ name: "Suhail J.", rating: 4, date: "2 days ago", comment: "Clear lens and lightweight design." }]
    }
];

// Application State
let cart = JSON.parse(localStorage.getItem('daraz_cart')) || [];
let activeProductId = "loreal-shampoo";
let currentQty = 1;

// DOM Content Loaded Handler
document.addEventListener('DOMContentLoaded', () => {
    initApp();
});

function initApp() {
    updateCartBadge();
    checkSessionAndUpdateHeader();
    bindGlobalEvents();
    fetchProductsFromDB();
    
    // Check initial route / hash
    const hash = window.location.hash;
    if (hash.startsWith('#product-')) {
        const pId = hash.replace('#product-', '');
        showProductDetail(pId, false);
    } else if (hash === '#cart') {
        showCartView(false);
    } else if (hash === '#checkout') {
        showCheckoutView(false);
    } else if (hash === '#login') {
        showLoginView(false);
    } else if (hash === '#signup') {
        showSignupView(false);
    } else {
        showHomeView(false);
    }
}

async function fetchProductsFromDB() {
    try {
        const response = await fetch('./api/get_products.php');
        const data = await response.json();
        if (data.success && data.products && data.products.length > 0) {
            productsData = data.products;
            renderHomeProducts();
            bindProductBoxClicks();
        }
    } catch (err) {
        console.warn('Using local fallback products:', err);
    }
}

function renderHomeProducts() {
    const flashSection = document.querySelector('#home-view .products');
    const justForYouSection = document.querySelector('#home-view .just-for-you');

    const flashProducts = productsData.filter(p => p.isFlashSale === 1 || p.isFlashSale === true);
    const justProducts = productsData.filter(p => p.isJustForYou === 1 || p.isJustForYou === true || !p.isFlashSale);

    if (flashSection && flashProducts.length > 0) {
        flashSection.innerHTML = flashProducts.map(p => `
            <div class="box" data-id="${p.id}" onclick="showProductDetail('${p.id}')">
                <img src="${p.image}" alt="${p.title}">
                <p class="title">${p.title}</p>
                <p class="price">Rs.${p.price.toLocaleString()}</p>
                <p class="old-price">Rs.${p.oldPrice ? p.oldPrice.toLocaleString() : ''} <span class="discount">${p.discount || ''}</span></p>
                ${p.stock !== undefined ? (p.stock <= 0 ? '<span class="badge bg-danger text-white mt-1 d-block">Out of Stock</span>' : (p.stock <= 5 ? `<span class="badge bg-warning text-dark mt-1 d-block">Only ${p.stock} left!</span>` : `<span class="fs-9 text-muted d-block mt-1">Stock: ${p.stock}</span>`)) : ''}
            </div>
        `).join('');
    }

    if (justForYouSection && justProducts.length > 0) {
        justForYouSection.innerHTML = justProducts.map(p => `
            <div class="box" data-id="${p.id}" onclick="showProductDetail('${p.id}')">
                <img src="${p.image}" alt="${p.title}">
                <p class="title">${p.title}</p>
                <p class="price">Rs.${p.price.toLocaleString()} ${p.discount ? `<span class="less">${p.discount}</span>` : ''}</p>
                <div class="mt-1">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                ${p.stock !== undefined ? (p.stock <= 0 ? '<span class="badge bg-danger text-white mt-1 d-block">Out of Stock</span>' : (p.stock <= 5 ? `<span class="badge bg-warning text-dark mt-1 d-block">Only ${p.stock} left!</span>` : `<span class="fs-9 text-muted d-block mt-1">Stock: ${p.stock}</span>`)) : ''}
            </div>
        `).join('');
    }
}

function bindGlobalEvents() {
    // Search input enter & button listener
    const searchBtn = document.getElementById('search-btn');
    const searchInput = document.getElementById('search-input');

    if (searchBtn && searchInput) {
        searchBtn.addEventListener('click', handleSearch);
        searchInput.addEventListener('keyup', (e) => {
            if (e.key === 'Enter') handleSearch();
        });
    }

    // Logo click to Home
    const logoBox = document.querySelector('.logo-box');
    if (logoBox) {
        logoBox.addEventListener('click', () => showHomeView());
    }

    // Cart Icon click to Checkout
    const cartIcon = document.getElementById('nav-cart-icon');
    if (cartIcon) {
        cartIcon.addEventListener('click', () => showCartView());
    }

    // Category items click handlers
    const catItems = document.querySelectorAll('.cat');
    catItems.forEach(item => {
        item.addEventListener('click', () => {
            const catName = item.querySelector('p')?.innerText || '';
            filterByCategory(catName);
        });
    });

    // Make existing static product boxes clickable
    bindProductBoxClicks();
}

function bindProductBoxClicks() {
    const boxes = document.querySelectorAll('.box');
    boxes.forEach((box, index) => {
        // Set cursor pointer & hover effect
        box.style.cursor = 'pointer';
        
        // Find matching product data or map index
        let product = productsData[index] || productsData[0];
        
        // If box contains L'Oreal title or shampoo title
        const boxTitle = box.querySelector('.title')?.innerText || '';
        const found = productsData.find(p => p.title.toLowerCase().includes(boxTitle.substring(0, 15).toLowerCase()));
        if (found) {
            product = found;
        }

        box.setAttribute('data-id', product.id);
        
        box.onclick = () => {
            showProductDetail(product.id);
        };
    });
}

// Search Logic
function handleSearch() {
    const input = document.getElementById('search-input');
    if (!input) return;
    const query = input.value.trim().toLowerCase();
    
    showHomeView();
    
    const boxes = document.querySelectorAll('.box');
    let foundCount = 0;
    
    boxes.forEach(box => {
        const titleText = box.querySelector('.title')?.innerText.toLowerCase() || '';
        if (titleText.includes(query)) {
            box.style.display = 'block';
            foundCount++;
        } else {
            box.style.display = 'none';
        }
    });

    showToast(query ? `Found ${foundCount} items matching "${query}"` : "Showing all products");
}

function filterByTag(tagName) {
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.value = tagName;
        handleSearch();
    }
}

function filterByCategory(catName) {
    showHomeView();
    const boxes = document.querySelectorAll('.box');
    let matched = 0;
    boxes.forEach(box => {
        box.style.display = 'block';
        matched++;
    });
    showToast(`Filtering by category: ${catName}`);
}

// View Controllers
function showHomeView(updateHash = true) {
    document.getElementById('home-view').style.display = 'block';
    document.getElementById('product-view').style.display = 'none';
    document.getElementById('cart-view').style.display = 'none';
    const checkoutView = document.getElementById('checkout-view');
    if (checkoutView) checkoutView.style.display = 'none';
    const loginView = document.getElementById('login-view');
    if (loginView) loginView.style.display = 'none';
    const signupView = document.getElementById('signup-view');
    if (signupView) signupView.style.display = 'none';
    
    // Quick search tags visible ONLY on product details page
    const tagsEl = document.getElementById('navbar-search-tags');
    if (tagsEl) tagsEl.style.display = 'none';

    if (updateHash) window.location.hash = 'home';
    window.scrollTo(0, 0);
}

function showProductDetail(productId, updateHash = true) {
    const product = productsData.find(p => p.id === productId || p.db_id == productId || String(p.id) === String(productId)) || productsData[0];
    activeProductId = product.id;
    currentQty = 1;

    document.getElementById('home-view').style.display = 'none';
    document.getElementById('product-view').style.display = 'block';
    document.getElementById('cart-view').style.display = 'none';
    const checkoutView = document.getElementById('checkout-view');
    if (checkoutView) checkoutView.style.display = 'none';
    const loginView = document.getElementById('login-view');
    if (loginView) loginView.style.display = 'none';
    const signupView = document.getElementById('signup-view');
    if (signupView) signupView.style.display = 'none';

    // Show quick search tags underneath search bar on product details page
    const tagsEl = document.getElementById('navbar-search-tags');
    if (tagsEl) tagsEl.style.display = 'flex';

    if (updateHash) window.location.hash = `product-${productId}`;

    // Render Product Detail HTML into #product-view
    const pContainer = document.getElementById('product-view');
    if (!pContainer) return;

    pContainer.innerHTML = `
        <div class="container py-3">
            <!-- Category Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb fs-7 mb-3">
                    <li class="breadcrumb-item"><a href="#" onclick="showHomeView(); return false;" class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">${product.category}</a></li>
                    <li class="breadcrumb-item active text-truncate max-w-300" aria-current="page">${product.title}</li>
                </ol>
            </nav>

            <!-- Main Product Card Area (Matches Daraz Screenshot) -->
            <div class="bg-white p-3 rounded-2 shadow-sm mb-4">
                <div class="row g-4">
                    <!-- Left Column: Gallery & Image -->
                    <div class="col-lg-4 col-md-5">
                        <div class="border rounded text-center p-2 mb-3 product-main-img-box">
                            <img id="main-product-img" src="${product.image}" alt="${product.title}" class="img-fluid rounded" style="max-height: 380px; object-fit: contain;">
                        </div>
                        <div class="d-flex align-items-center justify-content-center gap-2 overflow-auto py-1">
                            <button class="btn btn-sm btn-light border" onclick="prevImage()"><i class="fa-solid fa-chevron-left"></i></button>
                            <div id="thumbnail-row" class="d-flex gap-2">
                                ${product.thumbnails.map((t, idx) => `
                                    <img src="${t}" class="thumb-img border rounded ${idx === 0 ? 'border-orange' : ''}" style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;" onclick="changeMainImage('${t}', this)">
                                `).join('')}
                            </div>
                            <button class="btn btn-sm btn-light border" onclick="nextImage()"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>

                    <!-- Middle Column: Title, Ratings, Price, Quantity & Buttons -->
                    <div class="col-lg-5 col-md-7 border-end">
                        <!-- Flash Sale Banner -->
                        <div class="flash-sale-bar d-flex justify-content-between align-items-center bg-dark text-white p-2 rounded mb-3" style="background: linear-gradient(90deg, #222 0%, #111 100%);">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success font-bold fs-7">8.8 FLASH SALE</span>
                                <span class="text-warning fs-7"><i class="fa-regular fa-clock me-1"></i>Ends in <strong id="flash-timer">05:31:45</strong></span>
                            </div>
                            <span class="fs-7 text-muted">${product.soldCount} sold</span>
                        </div>

                        <!-- Brand Mall Tag & Title -->
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-primary fs-8 px-2 py-1" style="background-color: #7b1fa2 !important;">dm</span>
                            <h1 class="fs-5 text-dark fw-bold mb-0 leading-tight">${product.title}</h1>
                        </div>

                        <!-- Ratings & Share -->
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="text-warning fs-7">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                </div>
                                <a href="#reviews-sec" class="fs-7 text-primary text-decoration-none">${product.ratingCount} Ratings</a>
                            </div>
                            <div class="d-flex gap-3 text-muted fs-6">
                                <i class="fa-solid fa-share-nodes cursor-pointer" title="Share"></i>
                                <i class="fa-regular fa-heart cursor-pointer" title="Wishlist"></i>
                            </div>
                        </div>

                        <!-- Brand metadata -->
                        <div class="fs-7 text-muted mb-3">
                            Brand: <a href="#" class="text-primary text-decoration-none">${product.brand}</a> | 
                            <a href="#" class="text-primary text-decoration-none">More from ${product.brand}</a>
                        </div>

                        <!-- Price Section -->
                        <div class="bg-light p-3 rounded mb-3">
                            <div class="d-flex align-items-baseline gap-2">
                                <span class="fs-2 fw-bold text-orange" style="color: #f85606;">Rs. ${product.price.toLocaleString()}</span>
                            </div>
                            <div class="fs-7 text-muted">
                                <span class="text-decoration-line-through me-2">Rs. ${product.oldPrice.toLocaleString()}</span>
                                <span class="text-dark fw-bold">${product.discount}</span>
                            </div>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <span class="text-muted fs-7">Quantity</span>
                            <div class="input-group" style="width: 130px;">
                                <button class="btn btn-outline-secondary btn-sm" onclick="changeQty(-1)"><i class="fa-solid fa-minus"></i></button>
                                <input type="text" id="detail-qty-input" class="form-control form-control-sm text-center fw-bold" value="1" readonly>
                                <button class="btn btn-outline-secondary btn-sm" onclick="changeQty(1)"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>

                        <!-- Action Buttons (Square Sharp 90-degree Corners, Identical Dimensions & Smooth Hover Effects) -->
                        <div class="d-flex gap-3 mb-2" style="width: 100%;">
                            <button class="btn btn-lg btn-buy-now text-white fw-bold shadow-none py-2" onclick="buyNowCurrent()">Buy Now</button>
                            <button class="btn btn-lg btn-add-to-cart text-white fw-bold shadow-none py-2" onclick="addToCartCurrent()">Add to Cart</button>
                        </div>
                    </div>

                    <!-- Right Column: Delivery Options & Seller Info -->
                    <div class="col-lg-3 col-md-12 bg-light-gray p-3" style="border-radius: 0;">
                        <!-- Delivery Header -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fs-7 fw-bold text-muted">Delivery Options</span>
                            <i class="fa-solid fa-circle-info text-muted fs-7"></i>
                        </div>

                        <!-- Location -->
                        <div class="d-flex align-items-start gap-2 mb-3 border-bottom pb-2">
                            <i class="fa-solid fa-location-dot text-muted mt-1 fs-6"></i>
                            <div class="flex-fill fs-7">
                                <p class="mb-0 text-dark fw-semibold">Sindh, Karachi - Gulshan-e-Iqbal, Block 15</p>
                            </div>
                            <a href="#" class="fs-7 text-primary fw-bold text-decoration-none">CHANGE</a>
                        </div>

                        <!-- Standard Delivery -->
                        <div class="d-flex align-items-start gap-2 mb-3 border-bottom pb-2">
                            <i class="fa-solid fa-truck-fast text-muted mt-1 fs-6"></i>
                            <div class="flex-fill fs-7">
                                <p class="mb-0 fw-semibold">Standard Delivery</p>
                                <span class="text-muted fs-8">Get by 13-15 Aug</span>
                            </div>
                            <span class="fw-bold fs-7">Rs. 145</span>
                        </div>

                        <!-- Collection Point -->
                        <div class="d-flex align-items-start gap-2 mb-3 border-bottom pb-2">
                            <i class="fa-solid fa-store text-muted mt-1 fs-6"></i>
                            <div class="flex-fill fs-7">
                                <p class="mb-0 fw-semibold">Standard Collection Point</p>
                                <span class="text-muted fs-8">Get by 13-15 Aug</span>
                            </div>
                            <span class="fw-bold fs-7">Rs. 35</span>
                        </div>

                        <!-- Cash on Delivery -->
                        <div class="d-flex align-items-center gap-2 mb-4 border-bottom pb-3">
                            <i class="fa-solid fa-wallet text-muted fs-6"></i>
                            <span class="fs-7 fw-semibold">Cash on Delivery Available</span>
                        </div>

                        <!-- Return & Warranty -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fs-7 fw-bold text-muted">Return & Warranty</span>
                                <i class="fa-solid fa-circle-info text-muted fs-7"></i>
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-2 fs-7">
                                <i class="fa-solid fa-rotate-left text-muted"></i>
                                <span>14 days easy return</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-3 fs-7">
                                <i class="fa-solid fa-shield-halved text-muted"></i>
                                <span>Warranty not available</span>
                            </div>
                        </div>

                        <!-- Professional Barcode Scanner Box (Clean & Properly Aligned) -->
                        <div class="border p-2 bg-white mb-3" style="border-radius: 0; border-color: #e2e2e8 !important;">
                            <div class="d-flex align-items-center gap-2">
                                <div class="border p-1 bg-white" style="border-radius: 0; min-width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <svg width="42" height="42" viewBox="0 0 100 100" fill="#212121">
                                        <rect width="100" height="100" fill="white"/>
                                        <path d="M0,0 h30 v30 h-30 z M40,0 h20 v10 h-20 z M70,0 h30 v30 h-30 z M10,10 h10 v10 h-10 z M80,10 h10 v10 h-10 z M0,40 h10 v20 h-10 z M30,40 h30 v10 h-30 z M70,40 h10 v10 h-10 z M0,70 h30 v30 h-30 z M10,80 h10 v10 h-10 z M40,70 h20 v30 h-20 z M70,70 h30 v30 h-30 z M80,80 h10 v10 h-10 z"/>
                                    </svg>
                                </div>
                                <div class="fs-8">
                                    <div class="d-flex align-items-center gap-1 mb-1">
                                        <img src="./darazlogo.png" style="width: 14px; height: 14px; object-fit: contain;" alt="Daraz Logo">
                                        <strong class="text-dark" style="font-size: 11px;">Scan with mobile</strong>
                                    </div>
                                    <p class="mb-0 text-muted" style="font-size: 10px; line-height: 1.3;">Download app to enjoy exclusive discounts and free shipping!</p>
                                </div>
                            </div>
                        </div>

                        <!-- Seller Info Box -->
                        <div class="border p-3 bg-white" style="border-radius: 0; border-color: #e2e2e8 !important;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <span class="fs-8 text-muted d-block">Sold by</span>
                                    <strong class="fs-7 text-dark">${product.brand}</strong>
                                    <span class="badge bg-primary fs-8 ms-1" style="border-radius: 0;">Flagship Store</span>
                                </div>
                                <button class="btn btn-sm btn-outline-primary fs-7" style="border-radius: 0;"><i class="fa-regular fa-comments me-1"></i>Chat Now</button>
                            </div>
                            <div class="row text-center pt-2 border-top">
                                <div class="col-6 border-end">
                                    <span class="fs-8 text-muted d-block">Positive Ratings</span>
                                    <strong class="fs-7 text-success">94%</strong>
                                </div>
                                <div class="col-6">
                                    <span class="fs-8 text-muted d-block">Ship on Time</span>
                                    <strong class="fs-7 text-success">99%</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details Description Section (Expanded 2+ Full Paragraphs) -->
            <div class="bg-white p-4 shadow-sm mb-4" style="border-radius: 0; border: 1px solid #e2e2e8;">
                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">Product details of ${product.title}</h5>
                <div class="fs-7 text-dark lh-base">
                    ${product.description}
                    <p class="mt-3 mb-2">This <strong>${product.title}</strong> is manufactured under strict quality standards to ensure high reliability, optimal durability, and daily convenience. Designed to cater to everyday needs, it combines modern features with long-lasting build quality, making it a reliable addition to your collection.</p>
                    <p class="mb-0"><strong>Why Choose This Product:</strong> Certified authentic product sourced directly from verified ${product.brand} flagship suppliers. Comes backed by Daraz 100% Purchase Protection, safe doorstep delivery across Pakistan, and a hassle-free 14-day return guarantee.</p>
                </div>
            </div>

            <!-- Ratings & Reviews Section (Screenshot 4) -->
            <div id="reviews-sec" class="bg-white p-4 rounded-2 shadow-sm">
                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">Ratings & Reviews of ${product.title}</h5>
                
                <div class="row align-items-center mb-4">
                    <div class="col-md-3 text-center border-end">
                        <h1 class="display-4 fw-bold text-dark mb-0">${product.rating}<span class="fs-4 text-muted">/5</span></h1>
                        <div class="text-warning fs-5 my-1">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <span class="fs-7 text-muted">${product.ratingCount} Ratings</span>
                    </div>
                    <div class="col-md-6">
                        <!-- Rating breakdown bars -->
                        <div class="d-flex align-items-center gap-2 mb-1 fs-7">
                            <div class="text-warning" style="width: 80px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                            <div class="progress flex-fill" style="height: 10px;"><div class="progress-bar bg-warning" style="width: 85%;"></div></div>
                            <span class="text-muted" style="width: 30px;">135</span>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-1 fs-7">
                            <div class="text-warning" style="width: 80px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i></div>
                            <div class="progress flex-fill" style="height: 10px;"><div class="progress-bar bg-warning" style="width: 10%;"></div></div>
                            <span class="text-muted" style="width: 30px;">7</span>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-1 fs-7">
                            <div class="text-warning" style="width: 80px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></div>
                            <div class="progress flex-fill" style="height: 10px;"><div class="progress-bar bg-warning" style="width: 5%;"></div></div>
                            <span class="text-muted" style="width: 30px;">3</span>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-1 fs-7">
                            <div class="text-warning" style="width: 80px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></div>
                            <div class="progress flex-fill" style="height: 10px;"><div class="progress-bar bg-warning" style="width: 3%;"></div></div>
                            <span class="text-muted" style="width: 30px;">3</span>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-1 fs-7">
                            <div class="text-warning" style="width: 80px;"><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></div>
                            <div class="progress flex-fill" style="height: 10px;"><div class="progress-bar bg-warning" style="width: 2%;"></div></div>
                            <span class="text-muted" style="width: 30px;">3</span>
                        </div>
                    </div>
                </div>

                <!-- Customer Reviews -->
                <h6 class="fw-bold border-bottom pb-2 mb-3">Product Reviews</h6>
                <div class="customer-reviews-list">
                    ${product.reviews ? product.reviews.map(r => `
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="text-warning fs-8">
                                    ${'<i class="fa-solid fa-star"></i>'.repeat(r.rating)}
                                </div>
                                <span class="fs-8 text-muted">${r.date}</span>
                            </div>
                            <div class="fw-semibold fs-7 text-dark mb-1">by ${r.name} <span class="badge bg-success fs-9 ms-1"><i class="fa-solid fa-check me-1"></i>Verified Purchase</span></div>
                            <p class="fs-7 text-muted mb-0">${r.comment}</p>
                        </div>
                    `).join('') : '<p class="text-muted fs-7">No reviews yet.</p>'}
                </div>
            </div>
        </div>
    `;

    document.getElementById('home-view').style.display = 'none';
    document.getElementById('product-view').style.display = 'block';
    document.getElementById('cart-view').style.display = 'none';

    if (updateHash) window.location.hash = `product-${productId}`;
    window.scrollTo(0, 0);
}

function changeMainImage(src, element) {
    document.getElementById('main-product-img').src = src;
    document.querySelectorAll('.thumb-img').forEach(el => el.classList.remove('border-orange'));
    element.classList.add('border-orange');
}

function changeQty(delta) {
    const input = document.getElementById('detail-qty-input');
    if (!input) return;
    let val = parseInt(input.value) || 1;
    val += delta;
    if (val < 1) val = 1;
    input.value = val;
    currentQty = val;
}

function addToCartCurrent() {
    addToCart(activeProductId, currentQty);
}

function buyNowCurrent() {
    addToCart(activeProductId, currentQty);
    showCartView();
}

// Cart State Management
function addToCart(productId, quantity = 1) {
    const product = productsData.find(p => p.id === productId);
    if (!product) return;

    const existingIndex = cart.findIndex(item => item.id === productId);
    if (existingIndex > -1) {
        cart[existingIndex].quantity += quantity;
    } else {
        cart.push({
            id: product.id,
            title: product.title,
            price: product.price,
            oldPrice: product.oldPrice,
            image: product.image,
            brand: product.brand,
            quantity: quantity,
            selected: true
        });
    }

    saveCart();
    updateCartBadge();
    showToast(`Added ${quantity} x "${product.title.substring(0, 25)}..." to cart!`);
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    saveCart();
    updateCartBadge();
    renderCartView();
    showToast("Item removed from cart");
}

function updateCartQty(productId, delta) {
    const item = cart.find(i => i.id === productId);
    if (!item) return;

    item.quantity += delta;
    if (item.quantity <= 0) {
        removeFromCart(productId);
        return;
    }

    saveCart();
    updateCartBadge();
    renderCartView();
}

function toggleItemSelect(productId) {
    const item = cart.find(i => i.id === productId);
    if (item) {
        item.selected = !item.selected;
        saveCart();
        renderCartView();
    }
}

function toggleSelectAll(checkbox) {
    const isChecked = checkbox.checked;
    cart.forEach(item => item.selected = isChecked);
    saveCart();
    renderCartView();
}

function saveCart() {
    localStorage.setItem('daraz_cart', JSON.stringify(cart));
}

function updateCartBadge() {
    const totalCount = cart.reduce((sum, item) => sum + item.quantity, 0);
    const badge = document.getElementById('cart-badge');
    if (badge) {
        badge.innerText = totalCount;
        badge.style.display = totalCount > 0 ? 'inline-block' : 'none';
    }
}

// Checkout & Cart View Rendering
function showCartView(updateHash = true) {
    renderCartView();
    document.getElementById('home-view').style.display = 'none';
    document.getElementById('product-view').style.display = 'none';
    document.getElementById('cart-view').style.display = 'block';
    const checkoutView = document.getElementById('checkout-view');
    if (checkoutView) checkoutView.style.display = 'none';
    const loginView = document.getElementById('login-view');
    if (loginView) loginView.style.display = 'none';
    const signupView = document.getElementById('signup-view');
    if (signupView) signupView.style.display = 'none';

    const tagsEl = document.getElementById('navbar-search-tags');
    if (tagsEl) tagsEl.style.display = 'none';

    if (updateHash) window.location.hash = 'cart';
    window.scrollTo(0, 0);
}

function renderCartView() {
    const cartContainer = document.getElementById('cart-view');
    if (!cartContainer) return;

    const selectedItems = cart.filter(i => i.selected);
    const subtotal = selectedItems.reduce((sum, i) => sum + (i.price * i.quantity), 0);
    const shippingFee = selectedItems.length > 0 ? 145 : 0;
    const totalAmount = subtotal + shippingFee;

    const allSelected = cart.length > 0 && cart.every(i => i.selected);

    cartContainer.innerHTML = `
        <div class="container py-4">
            <h4 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-cart-shopping text-orange me-2" style="color: #f57224;"></i>Shopping Cart & Checkout</h4>
            
            ${cart.length === 0 ? `
                <div class="bg-white p-5 rounded text-center shadow-sm">
                    <i class="fa-solid fa-cart-arrow-down text-muted display-1 mb-3"></i>
                    <h5 class="text-dark fw-bold">Your Daraz Cart is empty!</h5>
                    <p class="text-muted fs-7 mb-4">Explore items and add them to your cart to start shopping.</p>
                    <button class="btn text-white fw-bold px-4 py-2" style="background-color: #f57224;" onclick="showHomeView()">CONTINUE SHOPPING</button>
                </div>
            ` : `
                <div class="row g-4">
                    <!-- Left: Cart Items List -->
                    <div class="col-lg-8">
                        <div class="bg-white p-3 shadow-sm mb-3" style="border-radius: 0; border: 1px solid #eaeaef;">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll" ${allSelected ? 'checked' : ''} onchange="toggleSelectAll(this)">
                                    <label class="form-check-label fw-bold text-dark fs-7" for="selectAll">SELECT ALL (${cart.length} ITEMS)</label>
                                </div>
                                <button class="btn btn-link text-muted fs-7 p-0 text-decoration-none" onclick="clearCart()"><i class="fa-solid fa-trash me-1"></i>Delete Selected</button>
                            </div>

                            <div class="cart-items-list">
                                ${cart.map(item => `
                                    <div class="cart-item-card border-bottom pb-3 mb-3">
                                        <div class="row align-items-center g-3">
                                            <div class="col-auto">
                                                <input class="form-check-input" type="checkbox" ${item.selected ? 'checked' : ''} onchange="toggleItemSelect('${item.id}')">
                                            </div>
                                            <div class="col-auto">
                                                <img src="${item.image}" alt="${item.title}" class="rounded border" style="width: 80px; height: 80px; object-fit: cover;">
                                            </div>
                                            <div class="col">
                                                <h6 class="fs-7 text-dark fw-semibold mb-1 text-truncate" style="max-width: 320px;">${item.title}</h6>
                                                <span class="fs-8 text-muted d-block mb-1">Brand: ${item.brand}</span>
                                                <span class="fs-7 fw-bold text-orange" style="color: #f57224;">Rs. ${item.price.toLocaleString()}</span>
                                                <span class="fs-8 text-muted text-decoration-line-through ms-2">Rs. ${item.oldPrice.toLocaleString()}</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="input-group input-group-sm" style="width: 110px;">
                                                    <button class="btn btn-outline-secondary" onclick="updateCartQty('${item.id}', -1)"><i class="fa-solid fa-minus fs-9"></i></button>
                                                    <input type="text" class="form-control text-center fw-bold" value="${item.quantity}" readonly>
                                                    <button class="btn btn-outline-secondary" onclick="updateCartQty('${item.id}', 1)"><i class="fa-solid fa-plus fs-9"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-auto text-end">
                                                <span class="fs-7 fw-bold text-dark d-block mb-1">Rs. ${(item.price * item.quantity).toLocaleString()}</span>
                                                <button class="btn btn-sm btn-light text-danger border-0 p-1" onclick="removeFromCart('${item.id}')" title="Delete item"><i class="fa-solid fa-trash fs-7"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    </div>

                    <!-- Right: Order Summary Section (Matches Reference Screenshot 100%) -->
                    <div class="col-lg-4">
                        <div class="bg-white p-3 p-md-4 shadow-sm mb-3" style="border-radius: 0; border: 1px solid #eaeaef;">
                            <h5 class="fw-normal text-dark mb-3" style="font-size: 18px; color: #212121;">Order Summary</h5>
                            
                            <div class="d-flex justify-content-between align-items-center mb-2" style="font-size: 14px;">
                                <span style="color: #757575;">Subtotal (${selectedItems.length} items)</span>
                                <span style="color: #212121; font-weight: 500;">Rs. ${subtotal.toLocaleString()}</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3" style="font-size: 14px;">
                                <span style="color: #757575;">Shipping Fee</span>
                                <span style="color: #212121; font-weight: 500;">Rs. ${shippingFee.toLocaleString()}</span>
                            </div>

                            <!-- Voucher Input & Apply Button Row (Exact Screenshot Parity) -->
                            <div class="d-flex gap-2 my-3" style="width: 100%;">
                                <input type="text" class="form-control" placeholder="Enter Voucher Code" style="flex: 1; height: 40px; border-radius: 0 !important; border: 1px solid #d9d9d9; font-size: 13px; padding: 8px 12px; box-shadow: none;">
                                <button class="btn btn-apply-voucher text-white px-4" type="button" style="height: 40px; background-color: #25a5d8; border: none; border-radius: 0 !important; font-size: 13px; font-weight: 500; letter-spacing: 0.5px; transition: background-color 0.2s ease;" onclick="showToast('Voucher code applied!')">APPLY</button>
                            </div>

                            <div class="d-flex justify-content-between align-items-center my-3">
                                <span style="color: #212121; font-size: 15px;">Total</span>
                                <span style="color: #f57224; font-size: 18px; font-weight: 500;">Rs. ${totalAmount.toLocaleString()}</span>
                            </div>

                            <button class="btn btn-proceed-checkout w-100 text-white py-2 mt-2" style="height: 44px; background-color: #f57224; border: none; border-radius: 0 !important; font-size: 14px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; transition: background-color 0.2s ease;" ${selectedItems.length === 0 ? 'disabled' : ''} onclick="showCheckoutView()">
                                PROCEED TO CHECKOUT(${selectedItems.length})
                            </button>
                        </div>
                    </div>
                </div>
            `}
        </div>
    `;
}

// ----------------------------------------------------
// OFFICIAL CHECKOUT PAGE CONTROLLERS (Matches Screenshots 1, 2 & 3)
// ----------------------------------------------------
let selectedDeliveryLabel = 'HOME';

function setDeliveryLabel(type) {
    selectedDeliveryLabel = type;
    const officeBtn = document.getElementById('label-office-btn');
    const homeBtn = document.getElementById('label-home-btn');
    if (officeBtn && homeBtn) {
        if (type === 'OFFICE') {
            officeBtn.className = 'checkout-label-btn active-office';
            homeBtn.className = 'checkout-label-btn';
        } else {
            officeBtn.className = 'checkout-label-btn';
            homeBtn.className = 'checkout-label-btn active-home';
        }
    }
}

function showCheckoutView(updateHash = true) {
    const selectedItems = cart.filter(i => i.selected);
    if (selectedItems.length === 0) {
        showToast("Please select at least one item to proceed to checkout!");
        return;
    }

    renderCheckoutView();
    document.getElementById('home-view').style.display = 'none';
    document.getElementById('product-view').style.display = 'none';
    document.getElementById('cart-view').style.display = 'none';
    const checkoutView = document.getElementById('checkout-view');
    if (checkoutView) checkoutView.style.display = 'block';
    const loginView = document.getElementById('login-view');
    if (loginView) loginView.style.display = 'none';
    const signupView = document.getElementById('signup-view');
    if (signupView) signupView.style.display = 'none';

    const tagsEl = document.getElementById('navbar-search-tags');
    if (tagsEl) tagsEl.style.display = 'none';

    if (updateHash) window.location.hash = 'checkout';
    window.scrollTo(0, 0);
}

function removeFromCheckout(productId) {
    removeFromCart(productId);
    const selectedItems = cart.filter(i => i.selected);
    if (selectedItems.length === 0) {
        showCartView();
    } else {
        renderCheckoutView();
    }
}

function placeOrderFromCheckout() {
    const fullName = document.getElementById('cust-fullname')?.value.trim();
    const phone = document.getElementById('cust-phone')?.value.trim();
    const address = document.getElementById('cust-address')?.value.trim();
    const province = document.getElementById('cust-province')?.value.trim() || '';
    const city = document.getElementById('cust-city')?.value.trim() || '';
    const building = document.getElementById('cust-building')?.value.trim() || '';
    const area = document.getElementById('cust-area')?.value.trim() || '';
    const colony = document.getElementById('cust-colony')?.value.trim() || '';

    if (!fullName || !phone || !address) {
        showToast("Please enter your full name, phone number, and delivery address!");
        return;
    }

    const selectedItems = cart.filter(i => i.selected);
    if (selectedItems.length === 0) {
        showToast("No items selected for checkout.");
        return;
    }

    const subtotal = selectedItems.reduce((sum, i) => sum + (i.price * i.quantity), 0);
    const deliveryFee = selectedItems.length > 0 ? 190 : 0;
    const platformFee = selectedItems.length > 0 ? 10 : 0;
    const totalAmount = subtotal + deliveryFee + platformFee;

    const payload = {
        full_name: fullName,
        phone: phone,
        address: address,
        province: province,
        city: city,
        building: building,
        area: area,
        colony: colony,
        delivery_label: typeof selectedDeliveryLabel !== 'undefined' ? selectedDeliveryLabel : 'HOME',
        payment_method: 'Cash on Delivery (COD)',
        items: selectedItems,
        subtotal: subtotal,
        delivery_fee: deliveryFee,
        platform_fee: platformFee,
        total_amount: totalAmount
    };

    fetch('api/checkout.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            cart = cart.filter(i => !i.selected);
            saveCart();
            updateCartBadge();

            const orderNum = data.order_number;

            const successMsgEl = document.getElementById('order-success-msg');
            if (successMsgEl) {
                successMsgEl.innerHTML = `
                    Thank you <strong>${fullName}</strong>!<br>
                    Your order <strong>#${orderNum}</strong> has been successfully placed and saved to MySQL.<br>
                    Delivery Address: <em>${address} (${typeof selectedDeliveryLabel !== 'undefined' ? selectedDeliveryLabel : 'HOME'})</em><br>
                    Payment Method: <strong>Cash on Delivery / Daraz Pay</strong>
                `;
            }

            const successModalEl = document.getElementById('successModal');
            if (successModalEl) {
                const successModal = new bootstrap.Modal(successModalEl);
                successModal.show();
            } else {
                showToast(`Order #${orderNum} placed successfully!`);
            }

            showHomeView();
        } else {
            showToast(data.message || 'Failed to place order.');
        }
    })
    .catch(err => {
        console.error(err);
        showToast('Error connecting to backend database.');
    });
}

function renderCheckoutView() {
    const checkoutContainer = document.getElementById('checkout-view');
    if (!checkoutContainer) return;

    const selectedItems = cart.filter(i => i.selected);
    const subtotal = selectedItems.reduce((sum, i) => sum + (i.price * i.quantity), 0);
    const deliveryFee = selectedItems.length > 0 ? 190 : 0;
    const platformFee = selectedItems.length > 0 ? 10 : 0;
    const totalAmount = subtotal + deliveryFee + platformFee;

    checkoutContainer.innerHTML = `
        <div class="container py-4" style="max-width: 1240px;">
            <div class="row g-4">
                <!-- Left Column: Delivery Information Form & Package Details (Screenshots 1, 2 & 3) -->
                <div class="col-lg-8">
                    <!-- 1. Delivery Information Card -->
                    <div class="checkout-card mb-3">
                        <h5 class="fw-normal text-dark mb-4" style="font-size: 18px; color: #212121;">Delivery Information</h5>
                        
                        <form id="checkout-delivery-form" onsubmit="event.preventDefault();">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="checkout-field-label">Full name</label>
                                    <input type="text" id="cust-fullname" class="form-control checkout-input" placeholder="Enter your first and last name" value="">
                                </div>
                                <div class="col-md-6">
                                    <label class="checkout-field-label">Province</label>
                                    <select id="cust-province" class="form-select checkout-select">
                                        <option value="" selected disabled>Please choose your province</option>
                                        <option value="Sindh">Sindh</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="KPK">Khyber Pakhtunkhwa</option>
                                        <option value="Balochistan">Balochistan</option>
                                        <option value="Islamabad">Islamabad Capital</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="checkout-field-label">Phone Number</label>
                                    <input type="text" id="cust-phone" class="form-control checkout-input" placeholder="Please enter your phone number" value="">
                                </div>
                                <div class="col-md-6">
                                    <label class="checkout-field-label">City</label>
                                    <select id="cust-city" class="form-select checkout-select">
                                        <option value="" selected disabled>Please choose your city</option>
                                        <option value="Karachi">Karachi</option>
                                        <option value="Lahore">Lahore</option>
                                        <option value="Islamabad">Islamabad</option>
                                        <option value="Rawalpindi">Rawalpindi</option>
                                        <option value="Peshawar">Peshawar</option>
                                        <option value="Quetta">Quetta</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="checkout-field-label">Building / House No / Floor / Street</label>
                                    <input type="text" id="cust-building" class="form-control checkout-input" placeholder="Please enter" value="">
                                </div>
                                <div class="col-md-6">
                                    <label class="checkout-field-label">Area</label>
                                    <select id="cust-area" class="form-select checkout-select">
                                        <option value="" selected disabled>Please choose your area</option>
                                        <option value="Gulshan-e-Iqbal">Gulshan-e-Iqbal</option>
                                        <option value="Johar">Gulistan-e-Johar</option>
                                        <option value="DHA">DHA Phase 5</option>
                                        <option value="PECHS">PECHS Block 2</option>
                                        <option value="Nazimabad">North Nazimabad</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="checkout-field-label">Colony / Suburb / Locality / Landmark</label>
                                    <input type="text" id="cust-colony" class="form-control checkout-input" placeholder="Please enter" value="">
                                </div>
                                <div class="col-md-6">
                                    <label class="checkout-field-label">Address</label>
                                    <input type="text" id="cust-address" class="form-control checkout-input" placeholder="For Example: House# 123, Street# 123, ABC Road" value="">
                                </div>
                            </div>

                            <!-- Delivery Label Choice (Office vs Home - Screenshot 2) -->
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-2 border-top">
                                <div>
                                    <span class="fs-8 text-muted d-block mb-2">Select a label for effective delivery:</span>
                                    <div class="d-flex gap-2">
                                        <button type="button" id="label-office-btn" class="checkout-label-btn ${selectedDeliveryLabel === 'OFFICE' ? 'active-office' : ''}" onclick="setDeliveryLabel('OFFICE')">
                                            <i class="fa-solid fa-briefcase me-1"></i> OFFICE
                                        </button>
                                        <button type="button" id="label-home-btn" class="checkout-label-btn ${selectedDeliveryLabel === 'HOME' ? 'active-home' : ''}" onclick="setDeliveryLabel('HOME')">
                                            <i class="fa-solid fa-house me-1"></i> HOME
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="btn text-white px-4 py-2" style="height: 38px; background-color: #25a5d8; border: none; border-radius: 0 !important; font-size: 13px; font-weight: 500;" onclick="showToast('Delivery address saved successfully!')">SAVE</button>
                            </div>
                        </form>
                    </div>

                    <!-- 2. Package Card (Screenshots 2 & 3) -->
                    <div class="checkout-card mb-3">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="fw-bold text-dark" style="font-size: 15px;">Package 1 of 1</span>
                            <span class="fs-8 text-muted">Shipped by <strong class="text-dark">ZKM MALL</strong></span>
                        </div>

                        <!-- Delivery or Pickup Option Card (Matches Screenshot 2 & 3) -->
                        <div class="mb-4">
                            <span class="fs-8 text-muted d-block mb-2">Delivery or Pickup</span>
                            <div class="package-delivery-option">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="package-delivery-check"><i class="fa-solid fa-check"></i></span>
                                    <strong class="text-dark" style="font-size: 14px;">Rs. 190</strong>
                                </div>
                                <span class="fs-8 text-muted d-block ps-4">Standard Delivery</span>
                                <span class="fs-8 text-muted d-block ps-4" style="font-size: 11px;">Guaranteed by 15-17 Aug</span>
                            </div>
                        </div>

                        <!-- Selected Package Products List -->
                        <div class="checkout-package-items">
                            ${selectedItems.map(item => `
                                <div class="d-flex align-items-center gap-3 border-bottom pb-3 mb-3">
                                    <img src="${item.image}" alt="${item.title}" class="border" style="width: 75px; height: 75px; object-fit: cover; border-radius: 0;">
                                    <div class="flex-fill">
                                        <div class="d-flex align-items-center gap-1 mb-1">
                                            <span class="badge bg-success" style="font-size: 9px; border-radius: 0;">8.8 AZADI SALE</span>
                                            <h6 class="fs-7 text-dark fw-semibold mb-0 text-truncate" style="max-width: 340px;">${item.title}</h6>
                                        </div>
                                        <span class="fs-8 text-muted d-block mb-1">No Brand, Color Family:Multicolor</span>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fw-bold" style="color: #f57224; font-size: 15px;">Rs. ${item.price.toLocaleString()}</span>
                                            <span class="fs-8 text-muted text-decoration-line-through">Rs. ${item.oldPrice.toLocaleString()}</span>
                                            <span class="badge bg-light text-danger border fs-8" style="border-radius: 0;">-50%</span>
                                            <button class="btn btn-sm btn-link text-muted p-0 ms-2" onclick="removeFromCheckout('${item.id}')" title="Remove item"><i class="fa-regular fa-trash-can fs-7"></i></button>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="fs-7 text-muted fw-medium">Qty: ${item.quantity}</span>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </div>

                <!-- Right Column: Promotion, Invoice Info & Order Summary (Screenshots 1 & 2) -->
                <div class="col-lg-4">
                    <!-- 1. Promotion Code Card -->
                    <div class="checkout-card mb-3 p-3">
                        <h6 class="fw-normal text-dark mb-2" style="font-size: 15px;">Promotion</h6>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control checkout-input" placeholder="Enter Store/Daraz Code" style="flex: 1;">
                            <button class="btn btn-apply-voucher text-white px-3" type="button" onclick="showToast('Promotion code applied!')">APPLY</button>
                        </div>
                    </div>

                    <!-- 2. Invoice & Contact Info Card -->
                    <div class="checkout-card mb-3 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="fw-normal text-dark mb-0" style="font-size: 15px;">Invoice and Contact Info</h6>
                            <a href="#" class="fs-7 text-decoration-none fw-semibold" style="color: #25a5d8;" onclick="showToast('Edit contact details'); return false;">Edit</a>
                        </div>
                    </div>

                    <!-- 3. Order Summary Card (Exact Match to Screenshot 1) -->
                    <div class="checkout-card p-3 p-md-4">
                        <h5 class="fw-normal text-dark mb-3" style="font-size: 18px; color: #212121;">Order Summary</h5>

                        <div class="d-flex justify-content-between align-items-center mb-2" style="font-size: 14px;">
                            <span style="color: #757575;">Items Total (${selectedItems.length} items)</span>
                            <span style="color: #212121; font-weight: 500;">Rs. ${subtotal.toLocaleString()}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2" style="font-size: 14px;">
                            <span style="color: #757575;">Delivery Fee</span>
                            <span style="color: #212121; font-weight: 500;">Rs. ${deliveryFee.toLocaleString()}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3" style="font-size: 14px;">
                            <span style="color: #757575;">Platform Fee <i class="fa-solid fa-circle-question text-muted" title="Small platform service fee"></i></span>
                            <span style="color: #212121; font-weight: 500;">Rs. ${platformFee.toLocaleString()}</span>
                        </div>

                        <div class="border-top pt-3 my-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span style="color: #212121; font-size: 15px;">Total:</span>
                                <span style="color: #f57224; font-size: 20px; font-weight: 600;">Rs. ${totalAmount.toLocaleString()}</span>
                            </div>
                            <span class="fs-8 text-muted d-block text-end mb-3" style="font-size: 11px;">VAT included, where applicable</span>
                        </div>

                        <button class="btn btn-proceed-pay w-100 text-white py-2" onclick="placeOrderFromCheckout()" ${selectedItems.length === 0 ? 'disabled' : ''}>
                            Proceed to Pay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function clearCart() {
    cart = cart.filter(i => !i.selected);
    saveCart();
    updateCartBadge();
    renderCartView();
    showToast("Cleared selected items");
}

function processOrder(e) {
    if (e) e.preventDefault();
    const name = document.getElementById('cust-name')?.value.trim() || "Customer";
    const phone = document.getElementById('cust-phone')?.value.trim() || "";
    const address = document.getElementById('cust-address')?.value.trim() || "";

    let payMode = 'Cash on Delivery (COD)';
    if (document.getElementById('payCard')?.checked) payMode = 'Credit / Debit Card';
    if (document.getElementById('payWallet')?.checked) payMode = 'JazzCash / EasyPaisa';

    if (!name || !phone || !address) {
        showToast("Please fill in all shipping details!");
        return;
    }

    const selectedItems = cart.filter(i => i.selected);
    if (selectedItems.length === 0) {
        showToast("No items selected in cart.");
        return;
    }

    const subtotal = selectedItems.reduce((sum, i) => sum + (i.price * i.quantity), 0);
    const deliveryFee = selectedItems.length > 0 ? 145 : 0;
    const platformFee = 0;
    const totalAmount = subtotal + deliveryFee;

    const payload = {
        full_name: name,
        phone: phone,
        address: address,
        delivery_label: 'HOME',
        payment_method: payMode,
        items: selectedItems,
        subtotal: subtotal,
        delivery_fee: deliveryFee,
        platform_fee: platformFee,
        total_amount: totalAmount
    };

    fetch('api/checkout.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const checkoutModalEl = document.getElementById('checkoutModal');
            if (checkoutModalEl) {
                const modalInstance = bootstrap.Modal.getInstance(checkoutModalEl);
                if (modalInstance) modalInstance.hide();
            }

            cart = cart.filter(i => !i.selected);
            saveCart();
            updateCartBadge();

            const orderNum = data.order_number;

            const successMsgEl = document.getElementById('order-success-msg');
            if (successMsgEl) {
                successMsgEl.innerHTML = `
                    Thank you <strong>${name}</strong>!<br>
                    Your order <strong>#${orderNum}</strong> has been successfully placed and saved to MySQL.<br>
                    Shipping Address: <em>${address}</em><br>
                    Payment Mode: <strong>${payMode}</strong>
                `;
            }

            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            renderCartView();
        } else {
            showToast(data.message || 'Error processing checkout.');
        }
    })
    .catch(err => {
        console.error(err);
        showToast('Error connecting to backend database.');
    });
}

// Toast Notifications Helper
function showToast(message) {
    let toastContainer = document.getElementById('toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
        toastContainer.style.zIndex = '9999';
        document.body.appendChild(toastContainer);
    }

    const toastEl = document.createElement('div');
    toastEl.className = 'toast align-items-center text-white bg-dark border-0 show mb-2';
    toastEl.setAttribute('role', 'alert');
    toastEl.innerHTML = `
        <div class="d-flex">
            <div class="toast-body fs-7">
                <i class="fa-solid fa-circle-check text-success me-2"></i>${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;

    toastContainer.appendChild(toastEl);
    setTimeout(() => {
        toastEl.remove();
    }, 3000);
}

// ----------------------------------------------------
// LOGIN & SIGN UP PAGE CONTROLLERS (Matches Screenshots & User Requirements)
// ----------------------------------------------------

function showLoginView(updateHash = true) {
    renderLoginView();
    document.getElementById('home-view').style.display = 'none';
    document.getElementById('product-view').style.display = 'none';
    document.getElementById('cart-view').style.display = 'none';
    const checkoutView = document.getElementById('checkout-view');
    if (checkoutView) checkoutView.style.display = 'none';
    document.getElementById('login-view').style.display = 'block';
    document.getElementById('signup-view').style.display = 'none';

    const tagsEl = document.getElementById('navbar-search-tags');
    if (tagsEl) tagsEl.style.display = 'none';

    if (updateHash) window.location.hash = 'login';
    window.scrollTo(0, 0);
}

function showSignupView(updateHash = true) {
    renderSignupView();
    document.getElementById('home-view').style.display = 'none';
    document.getElementById('product-view').style.display = 'none';
    document.getElementById('cart-view').style.display = 'none';
    const checkoutView = document.getElementById('checkout-view');
    if (checkoutView) checkoutView.style.display = 'none';
    document.getElementById('login-view').style.display = 'none';
    document.getElementById('signup-view').style.display = 'block';

    const tagsEl = document.getElementById('navbar-search-tags');
    if (tagsEl) tagsEl.style.display = 'none';

    if (updateHash) window.location.hash = 'signup';
    window.scrollTo(0, 0);
}

function renderLoginView() {
    const loginContainer = document.getElementById('login-view');
    if (!loginContainer) return;

    loginContainer.innerHTML = `
        <div class="auth-wrapper">
            <div class="auth-card" style="max-width: 460px;">
                <!-- Header Tabs (Screenshot Parity) -->
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <div>
                        <span class="auth-tab active me-4">Password</span>
                        <span class="text-muted fs-7 cursor-pointer" onclick="showToast('Phone OTP login is currently in app only')">Phone Number</span>
                    </div>
                </div>

                <!-- Error Alert Box -->
                <div id="login-error-msg" class="alert alert-danger py-2 fs-7 mb-3 d-none" style="border-radius: 0;"></div>

                <!-- Login Form -->
                <form id="loginForm" onsubmit="event.preventDefault(); handleLoginSubmit();">
                    <div class="mb-3">
                        <label class="checkout-field-label">Phone Number or Email *</label>
                        <input type="text" id="login-email" class="form-control auth-input" placeholder="Please enter your Phone or Email">
                    </div>

                    <div class="mb-2">
                        <label class="checkout-field-label">Password *</label>
                        <div class="position-relative">
                            <input type="password" id="login-password" class="form-control auth-input" placeholder="Please enter your password">
                            <i class="fa-regular fa-eye position-absolute end-0 top-50 translate-middle-y me-3 cursor-pointer text-muted" id="toggle-login-pass" onclick="togglePasswordVisibility('login-password', 'toggle-login-pass')"></i>
                        </div>
                    </div>

                    <div class="text-end mb-3">
                        <a href="#" onclick="showToast('Password reset instructions sent!'); return false;" class="text-decoration-none text-muted fs-7">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn auth-btn-orange w-100 mb-3">LOGIN</button>

                    <div class="text-center text-muted fs-7 mb-4">
                        Don't have an account? <a href="#" onclick="showSignupView(); return false;" class="text-primary text-decoration-none fw-bold">Sign up</a>
                    </div>

                    <!-- Social Login -->
                    <div class="text-center text-muted fs-8 mb-3 position-relative">
                        <span class="bg-white px-2">Or, login with</span>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <button type="button" onclick="handleSocialLogin('Google')" class="btn auth-social-btn w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="fa-brands fa-google text-danger fs-6"></i> Google
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" onclick="handleSocialLogin('Facebook')" class="btn auth-social-btn w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="fa-brands fa-facebook text-primary fs-6"></i> Facebook
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    `;
}

function renderSignupView() {
    const signupContainer = document.getElementById('signup-view');
    if (!signupContainer) return;

    signupContainer.innerHTML = `
        <div class="auth-wrapper">
            <div class="auth-card" style="max-width: 500px;">
                <h4 class="fw-normal text-dark mb-4" style="font-size: 22px; color: #212121;">Create your Daraz Account</h4>

                <!-- Error Alert Box -->
                <div id="signup-error-msg" class="alert alert-danger py-2 fs-7 mb-3 d-none" style="border-radius: 0;"></div>

                <!-- Sign Up Form (Required fields: Username, Email, Password, Confirm Password) -->
                <form id="signupForm" onsubmit="event.preventDefault(); handleSignupSubmit();">
                    <div class="mb-3">
                        <label class="checkout-field-label">Username *</label>
                        <input type="text" id="signup-username" class="form-control auth-input" placeholder="Please enter your username">
                    </div>

                    <div class="mb-3">
                        <label class="checkout-field-label">Email *</label>
                        <input type="email" id="signup-email" class="form-control auth-input" placeholder="Please enter your email address">
                    </div>

                    <div class="mb-3">
                        <label class="checkout-field-label">Password *</label>
                        <div class="position-relative">
                            <input type="password" id="signup-password" class="form-control auth-input" placeholder="Minimum 6 characters with numbers & letters">
                            <i class="fa-regular fa-eye position-absolute end-0 top-50 translate-middle-y me-3 cursor-pointer text-muted" id="toggle-signup-pass" onclick="togglePasswordVisibility('signup-password', 'toggle-signup-pass')"></i>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="checkout-field-label">Confirm Password *</label>
                        <div class="position-relative">
                            <input type="password" id="signup-confirm-password" class="form-control auth-input" placeholder="Please re-enter your password">
                            <i class="fa-regular fa-eye position-absolute end-0 top-50 translate-middle-y me-3 cursor-pointer text-muted" id="toggle-signup-cpass" onclick="togglePasswordVisibility('signup-confirm-password', 'toggle-signup-cpass')"></i>
                        </div>
                    </div>

                    <div class="form-check mb-3 fs-7">
                        <input class="form-check-input" type="checkbox" id="signup-terms" checked>
                        <label class="form-check-label text-muted" for="signup-terms" style="font-size: 12px;">
                            By creating and/or using your account, you agree to our <a href="#" onclick="showToast('Terms of Use'); return false;" class="text-primary text-decoration-none">Terms of Use</a> and <a href="#" onclick="showToast('Privacy Policy'); return false;" class="text-primary text-decoration-none">Privacy Policy</a>.
                        </label>
                    </div>

                    <button type="submit" class="btn auth-btn-orange w-100 mb-3">SIGN UP</button>

                    <div class="text-center text-muted fs-7 mb-4">
                        Already have an account? <a href="#" onclick="showLoginView(); return false;" class="text-primary text-decoration-none fw-bold">Log in Now</a>
                    </div>

                    <!-- Social Sign Up -->
                    <div class="text-center text-muted fs-8 mb-3 position-relative">
                        <span class="bg-white px-2">Or, sign up with</span>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <button type="button" onclick="handleSocialLogin('Google')" class="btn auth-social-btn w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="fa-brands fa-google text-danger fs-6"></i> Google
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" onclick="handleSocialLogin('Facebook')" class="btn auth-social-btn w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="fa-brands fa-facebook text-primary fs-6"></i> Facebook
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    `;
}

// Form Submission Validation
function handleLoginSubmit() {
    const emailVal = document.getElementById('login-email')?.value.trim();
    const passVal = document.getElementById('login-password')?.value;
    const errorEl = document.getElementById('login-error-msg');

    if (errorEl) {
        errorEl.classList.add('d-none');
        errorEl.innerText = '';
    }

    if (!emailVal) {
        if (errorEl) {
            errorEl.innerText = 'Please enter your Phone or Email address.';
            errorEl.classList.remove('d-none');
        }
        return;
    }

    if (!passVal) {
        if (errorEl) {
            errorEl.innerText = 'Please enter your password.';
            errorEl.classList.remove('d-none');
        }
        return;
    }

    if (passVal.length < 6) {
        if (errorEl) {
            errorEl.innerText = 'Password must be at least 6 characters long.';
            errorEl.classList.remove('d-none');
        }
        return;
    }

    fetch('api/login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: emailVal, password: passVal })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const userObj = data.user || { username: data.username || emailVal, email: emailVal };
            localStorage.setItem('daraz_user', JSON.stringify(userObj));
            updateUserHeader();
            showToast(`Logged in successfully! Welcome back, ${userObj.username}.`);
            showHomeView();
        } else {
            if (errorEl) {
                errorEl.innerText = data.message || 'Invalid login details.';
                errorEl.classList.remove('d-none');
            }
        }
    })
    .catch(err => {
        console.error(err);
        showToast('Error connecting to backend database.');
    });
}

function handleSignupSubmit() {
    const usernameVal = document.getElementById('signup-username')?.value.trim();
    const emailVal = document.getElementById('signup-email')?.value.trim();
    const passVal = document.getElementById('signup-password')?.value;
    const cpassVal = document.getElementById('signup-confirm-password')?.value;
    const termsChecked = document.getElementById('signup-terms')?.checked;
    const errorEl = document.getElementById('signup-error-msg');

    if (errorEl) {
        errorEl.classList.add('d-none');
        errorEl.innerText = '';
    }

    if (!usernameVal || usernameVal.length < 3) {
        if (errorEl) {
            errorEl.innerText = 'Username is required (minimum 3 characters).';
            errorEl.classList.remove('d-none');
        }
        return;
    }

    const emailRegex = /\S+@\S+\.\S+/;
    if (!emailVal || !emailRegex.test(emailVal)) {
        if (errorEl) {
            errorEl.innerText = 'Please enter a valid email address (e.g. user@example.com).';
            errorEl.classList.remove('d-none');
        }
        return;
    }

    if (!passVal || passVal.length < 6) {
        if (errorEl) {
            errorEl.innerText = 'Password must be at least 6 characters long.';
            errorEl.classList.remove('d-none');
        }
        return;
    }

    if (passVal !== cpassVal) {
        if (errorEl) {
            errorEl.innerText = 'Confirm password does not match password.';
            errorEl.classList.remove('d-none');
        }
        return;
    }

    if (!termsChecked) {
        if (errorEl) {
            errorEl.innerText = 'You must agree to the Terms of Use and Privacy Policy.';
            errorEl.classList.remove('d-none');
        }
        return;
    }

    fetch('api/signup.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            username: usernameVal,
            email: emailVal,
            password: passVal,
            confirm_password: cpassVal
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            localStorage.setItem('daraz_registered_user', JSON.stringify({ username: usernameVal, email: emailVal }));
            showToast(data.message || 'Account created successfully! Please login with your credentials.');
            showLoginView();
        } else {
            if (errorEl) {
                errorEl.innerText = data.message || 'Signup failed.';
                errorEl.classList.remove('d-none');
            }
        }
    })
    .catch(err => {
        console.error(err);
        showToast('Error connecting to backend database.');
    });
}

function handleModalLoginSubmit(e) {
    if (e) e.preventDefault();
    const emailVal = document.getElementById('modal-login-email')?.value.trim();
    const passVal = document.getElementById('modal-login-password')?.value;

    if (!emailVal || !passVal) {
        showToast('Please enter your email and password.');
        return;
    }

    fetch('api/login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: emailVal, password: passVal })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const modalEl = document.getElementById('loginModal');
            if (modalEl) {
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) modalInstance.hide();
            }
            const userObj = data.user || { username: data.username || emailVal, email: emailVal };
            localStorage.setItem('daraz_user', JSON.stringify(userObj));
            updateUserHeader();
            showToast(`Logged in successfully! Welcome back, ${userObj.username}.`);
        } else {
            showToast(data.message || 'Login failed.');
        }
    })
    .catch(err => {
        console.error(err);
        showToast('Error connecting to backend database.');
    });
}

function togglePasswordVisibility(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (!input || !icon) return;

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function handleSocialLogin(provider) {
    const dummyUser = { username: `${provider}User`, email: `user@${provider.toLowerCase()}.com` };
    localStorage.setItem('daraz_user', JSON.stringify(dummyUser));
    updateUserHeader();
    showToast(`Logged in successfully with ${provider}!`);
    showHomeView();
}

function updateUserHeader() {
    const userNavBlock = document.getElementById('user-nav-block');
    if (!userNavBlock) return;

    const currentUser = JSON.parse(localStorage.getItem('daraz_user'));
    if (currentUser && currentUser.username) {
        userNavBlock.innerHTML = `
            <span class="text-white fw-semibold me-2" style="font-size: 12px;">
                <i class="fa-solid fa-circle-user text-warning me-1"></i>Hi, ${currentUser.username}
            </span>
            <a href="#" onclick="handleLogout(); return false;" style="font-weight: 700; color: #ffeb3b;">LOGOUT</a>
        `;
    } else {
        userNavBlock.innerHTML = `
            <a href="#" onclick="showLoginView(); return false;">LOGIN</a>
            <a href="#" onclick="showSignupView(); return false;">SIGN UP</a>
        `;
    }
}

function checkSessionAndUpdateHeader() {
    fetch('api/user.php')
    .then(res => res.json())
    .then(data => {
        if (data.logged_in && data.user) {
            localStorage.setItem('daraz_user', JSON.stringify(data.user));
        } else {
            localStorage.removeItem('daraz_user');
        }
        updateUserHeader();
    })
    .catch(() => {
        updateUserHeader();
    });
}

function handleLogout() {
    fetch('api/logout.php', { method: 'POST' })
    .then(() => {
        localStorage.removeItem('daraz_user');
        updateUserHeader();
        showToast("Logged out successfully");
        showHomeView();
    })
    .catch(() => {
        localStorage.removeItem('daraz_user');
        updateUserHeader();
        showToast("Logged out successfully");
        showHomeView();
    });
}
