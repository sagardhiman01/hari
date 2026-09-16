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

// ==========================================================================
// SCROLL REVEAL — IntersectionObserver driven animations
// ==========================================================================
(function () {
    const animatedEls = document.querySelectorAll('[data-animate]');
    if (!animatedEls.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const delay = el.getAttribute('data-delay') || '0';
                el.style.animationDelay = delay + 'ms';
                el.classList.add('is-visible');
                observer.unobserve(el);
            }
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -40px 0px'
    });

    animatedEls.forEach((el) => observer.observe(el));
})();

// ==========================================================================
// DEVOTEE REVIEW MODAL & SUBMISSION SYSTEM
// ==========================================================================
function openReviewModal() {
    const modal = document.getElementById('reviewModal');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        const form = document.getElementById('devoteeReviewForm');
        const success = document.getElementById('reviewSuccessMsg');
        if (form) form.style.display = 'block';
        if (success) success.style.display = 'none';
    }
}

function closeReviewModal() {
    const modal = document.getElementById('reviewModal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
}

function setStarRating(stars) {
    const input = document.getElementById('reviewRatingVal');
    if (input) input.value = stars;
    const starPicks = document.querySelectorAll('#starPicker .star-pick');
    starPicks.forEach((star) => {
        const val = parseInt(star.getAttribute('data-val'), 10);
        if (val <= stars) {
            star.classList.add('active');
        } else {
            star.classList.remove('active');
        }
    });
}

function handleReviewSubmit(e) {
    e.preventDefault();
    const name = document.getElementById('reviewerName').value.trim();
    const location = document.getElementById('reviewerLocation').value.trim();
    const product = document.getElementById('reviewerProduct').value.trim();
    const quote = document.getElementById('reviewerQuote').value.trim();
    const rating = parseInt(document.getElementById('reviewRatingVal').value, 10) || 5;

    if (!name || !location || !quote) {
        alert('Please fill out all required fields.');
        return;
    }

    const starsStr = '★'.repeat(rating) + '☆'.repeat(5 - rating);
    const initials = name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2) || 'DK';

    // Prepend new review card to testimonials grid
    const grid = document.querySelector('.testimonials-grid');
    if (grid) {
        const newCard = document.createElement('div');
        newCard.className = 'testimonial-card review-newly-added';
        newCard.style.animation = 'fadeInUp 0.6s ease forwards';
        newCard.innerHTML = `
            <div class="stars-rating">${starsStr}</div>
            <p class="review-quote">"${quote.replace(/"/g, '&quot;')}"</p>
            <div class="reviewer-meta">
                <div class="reviewer-avatar">${initials}</div>
                <div>
                    <div class="reviewer-name">${name} ${product ? '<span style="color:var(--gold-400);font-size:0.8rem;font-weight:400;">(' + product + ')</span>' : ''}</div>
                    <div class="reviewer-location">${location}</div>
                </div>
            </div>
        `;
        grid.prepend(newCard);
    }

    // Switch to blessing confirmation
    const form = document.getElementById('devoteeReviewForm');
    const success = document.getElementById('reviewSuccessMsg');
    if (form) form.style.display = 'none';
    if (success) success.style.display = 'block';
    if (form) form.reset();
}

// Close modals when clicking backdrop
window.addEventListener('click', function (e) {
    const quickModal = document.getElementById('quickViewModal');
    const reviewModal = document.getElementById('reviewModal');
    if (e.target === quickModal) closeQuickView();
    if (e.target === reviewModal) closeReviewModal();
});

