/* =============================================
   ESSENZA COFFEE — JavaScript
   ============================================= */

document.addEventListener('DOMContentLoaded', function () {

    // ── Navbar scroll effect ──────────────────
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        const updateNavbar = () => {
            if (window.scrollY > 60) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        };
        window.addEventListener('scroll', updateNavbar, { passive: true });
        updateNavbar();
    }

    // ── Mobile nav toggle ─────────────────────
    const navToggle = document.querySelector('.nav-toggle');
    const navMobile = document.querySelector('.nav-mobile');
    const navMobileClose = document.querySelector('.nav-mobile-close');

    if (navToggle && navMobile) {
        navToggle.addEventListener('click', () => {
            navMobile.classList.add('open');
            document.body.style.overflow = 'hidden';
        });
    }
    if (navMobileClose && navMobile) {
        navMobileClose.addEventListener('click', () => {
            navMobile.classList.remove('open');
            document.body.style.overflow = '';
        });
    }

    // ── Animate on scroll ─────────────────────
    const animateEls = document.querySelectorAll('.animate-on-scroll');
    if (animateEls.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        animateEls.forEach(el => observer.observe(el));
    }

    // ── Active nav link ───────────────────────
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-links a, .nav-mobile a').forEach(link => {
        const href = link.getAttribute('href');
        if (href && (currentPath === href || (href !== '/' && currentPath.startsWith(href)))) {
            link.classList.add('active');
        }
    });

    // ── Admin sidebar toggle ──────────────────
    const adminToggle = document.querySelector('.admin-toggle-sidebar');
    const adminSidebar = document.querySelector('.admin-sidebar');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');

    function openSidebar() {
        adminSidebar?.classList.add('open');
        sidebarOverlay?.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        adminSidebar?.classList.remove('open');
        sidebarOverlay?.classList.remove('open');
        document.body.style.overflow = '';
    }

    adminToggle?.addEventListener('click', openSidebar);
    sidebarOverlay?.addEventListener('click', closeSidebar);

    // ── Delete confirmation modal ─────────────
    const deleteModal = document.getElementById('deleteModal');
    let deleteForm = null;

    document.querySelectorAll('[data-delete]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            deleteForm = btn.closest('form') || document.querySelector(btn.dataset.delete);
            deleteModal?.classList.add('open');
        });
    });

    document.getElementById('deleteCancel')?.addEventListener('click', () => {
        deleteModal?.classList.remove('open');
        deleteForm = null;
    });
    document.getElementById('deleteConfirm')?.addEventListener('click', () => {
        deleteForm?.submit();
        deleteModal?.classList.remove('open');
    });

    // Click outside modal to close
    deleteModal?.addEventListener('click', (e) => {
        if (e.target === deleteModal) {
            deleteModal.classList.remove('open');
            deleteForm = null;
        }
    });

    // ── Image preview ─────────────────────────
    const fileInput = document.querySelector('input[type="file"][name="foto"]');
    const previewWrapper = document.querySelector('.image-preview-wrapper');
    const previewImg = previewWrapper?.querySelector('img');

    if (fileInput && previewWrapper && previewImg) {
        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImg.src = e.target.result;
                    previewWrapper.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // ── Auto dismiss alerts ───────────────────
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity .5s ease, transform .5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-8px)';
            setTimeout(() => alert.remove(), 500);
        }, 4000);
    });

    // ── Search with debounce ──────────────────
    const searchInput = document.querySelector('.filter-search input');
    if (searchInput) {
        let debounceTimer;
        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                searchInput.closest('form')?.submit();
            }, 600);
        });
    }

    // ── Smooth product card hover tilt ────────
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const cx = rect.width / 2;
            const cy = rect.height / 2;
            const tiltX = ((y - cy) / cy) * 3;
            const tiltY = ((x - cx) / cx) * -3;
            card.style.transform = `translateY(-6px) perspective(1000px) rotateX(${tiltX}deg) rotateY(${tiltY}deg)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });

});
