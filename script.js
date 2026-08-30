// ==========================================================================
// HARIHAR RATNA EMPORIUM - CLIENT INTERACTION SCRIPT
// ==========================================================================

document.addEventListener('DOMContentLoaded', () => {
    // Mobile Navigation Toggle
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mainNav = document.getElementById('mainNav');

    if (mobileBtn && mainNav) {
        mobileBtn.addEventListener('click', () => {
            if (mainNav.style.display === 'flex') {
                mainNav.style.display = 'none';
            } else {
                mainNav.style.display = 'flex';
                mainNav.style.flexDirection = 'column';
                mainNav.style.position = 'absolute';
                mainNav.style.top = '100%';
                mainNav.style.left = '0';
                mainNav.style.width = '100%';
                mainNav.style.background = '#140c08';
                mainNav.style.padding = '1.5rem';
                mainNav.style.borderBottom = '2px solid #d4af37';
            }
        });
    }

    // Modal Close on backdrop click & ESC key
    const modal = document.getElementById('quickViewModal');
    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeQuickView();
            }
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeQuickView();
        }
    });
});

// Category Filter Tabs
function filterProducts(category, btnElement) {
    // Update active button
    const buttons = document.querySelectorAll('.filter-pill');
    buttons.forEach(b => b.classList.remove('active'));
    if (btnElement) {
        btnElement.classList.add('active');
    }

    const searchInput = document.getElementById('productSearch');
    if (searchInput) searchInput.value = '';

    const cards = document.querySelectorAll('.product-card');
    cards.forEach(card => {
        const cardCat = card.getAttribute('data-category');
        if (category === 'all' || cardCat === category) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

// Category Card click to filter
function filterByCategory(category) {
    const productsSection = document.getElementById('products');
    if (productsSection) {
        productsSection.scrollIntoView({ behavior: 'smooth' });
    }

    const buttons = document.querySelectorAll('.filter-pill');
    buttons.forEach(btn => {
        if (btn.textContent.trim().toLowerCase().includes(category.toLowerCase()) || 
            (category === 'Rudraksha' && btn.textContent.includes('Rudraksha')) ||
            (category === 'Ratna (Gemstones)' && btn.textContent.includes('Gemstones')) ||
            (category === 'Malas & Rosaries' && btn.textContent.includes('Malas')) ||
            (category === 'Sacred Shankh' && btn.textContent.includes('Shankh')) ||
            (category === 'Siddh Yantras' && btn.textContent.includes('Yantras')) ||
            (category === 'Navratna Jewelry' && btn.textContent.includes('Navratna'))) {
            filterProducts(category, btn);
        }
    });
}

// Real-time Search Handler
function handleSearch() {
    const query = document.getElementById('productSearch').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.product-card');

    cards.forEach(card => {
        const searchableText = card.getAttribute('data-name') || '';
        if (searchableText.includes(query)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

// Open Quick View Modal with Product Specs
function openQuickView(product) {
    const modal = document.getElementById('quickViewModal');
    if (!modal || !product) return;

    document.getElementById('modalImg').src = 'uploads/' + (product.image_url || 'cat_rudraksha.jpg');
    document.getElementById('modalImg').alt = product.name;
    document.getElementById('modalCategory').textContent = product.category || 'Spiritual';
    document.getElementById('modalTitle').textContent = product.name;
    document.getElementById('modalPrice').textContent = '₹' + parseFloat(product.price).toLocaleString('en-IN', { minimumFractionDigits: 2 });
    
    const origPriceEl = document.getElementById('modalOriginalPrice');
    if (product.original_price && parseFloat(product.original_price) > parseFloat(product.price)) {
        origPriceEl.textContent = '₹' + parseFloat(product.original_price).toLocaleString('en-IN', { minimumFractionDigits: 2 });
        origPriceEl.style.display = 'inline';
    } else {
        origPriceEl.style.display = 'none';
    }

    // Specs
    const planetRow = document.getElementById('rowPlanet');
    const deityRow = document.getElementById('rowDeity');
    const benefitsRow = document.getElementById('rowBenefits');

    if (product.ruling_planet) {
        planetRow.style.display = 'table-row';
        document.getElementById('modalPlanet').textContent = product.ruling_planet;
    } else {
        planetRow.style.display = 'none';
    }

    if (product.ruling_deity) {
        deityRow.style.display = 'table-row';
        document.getElementById('modalDeity').textContent = product.ruling_deity;
    } else {
        deityRow.style.display = 'none';
    }

    if (product.benefits) {
        benefitsRow.style.display = 'table-row';
        document.getElementById('modalBenefits').textContent = product.benefits;
    } else {
        benefitsRow.style.display = 'none';
    }

    document.getElementById('modalDesc').textContent = product.description || '';

    // WhatsApp Direct URL
    const message = `Namaste Pt. Ji, I am interested in purchasing *${product.name}* (Price: ₹${parseFloat(product.price).toFixed(2)}) from Harihar Ratna Emporium. Please confirm availability and VPP postal dispatch.`;
    const waUrl = `https://wa.me/919927115354?text=${encodeURIComponent(message)}`;
    document.getElementById('modalWaBtn').href = waUrl;

    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeQuickView() {
    const modal = document.getElementById('quickViewModal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
}
