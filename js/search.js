/**
 * Site Search Functionality
 */
(function() {
    'use strict';
    
    const SiteSearch = {
        searchIndex: null,
        searchInput: null,
        searchResults: null,
        
        init: function() {
            // Create search UI
            this.createSearchUI();
            this.buildSearchIndex();
            this.setupEventListeners();
        },
        
        createSearchUI: function() {
            // Add search button to nav if it doesn't exist
            const navLinks = document.querySelector('.nav-links');
            if (navLinks && !document.getElementById('searchBtn')) {
                const searchBtn = document.createElement('li');
                searchBtn.innerHTML = '<button id="searchBtn" class="nav-search-btn" aria-label="Search site"><i data-feather="search"></i></button>';
                navLinks.appendChild(searchBtn);
            }
            
            // Create search modal
            const searchModal = document.createElement('div');
            searchModal.id = 'searchModal';
            searchModal.className = 'search-modal';
            searchModal.innerHTML = `
                <div class="search-modal-content">
                    <div class="search-header">
                        <input type="text" id="searchInput" placeholder="Search..." autocomplete="off" aria-label="Search site">
                        <button id="closeSearch" aria-label="Close search"><i data-feather="x"></i></button>
                    </div>
                    <div id="searchResults" class="search-results"></div>
                </div>
            `;
            document.body.appendChild(searchModal);
            
            this.searchInput = document.getElementById('searchInput');
            this.searchResults = document.getElementById('searchResults');
        },
        
        buildSearchIndex: function() {
            // Simple search index based on page content
            this.searchIndex = [];
            const pages = [
                { url: 'index.php', title: 'Home', content: document.body.innerText },
                { url: 'professional.php', title: 'Professional', content: '' },
                { url: 'portfolio.php', title: 'Portfolio', content: '' },
                { url: 'music.php', title: 'Music', content: '' },
                { url: 'languages.php', title: 'Languages', content: '' },
                { url: 'reading.php', title: 'Reading', content: '' },
                { url: 'faith.php', title: 'Faith', content: '' }
            ];
            
            // Index current page
            const currentPage = pages.find(p => window.location.pathname.includes(p.url));
            if (currentPage) {
                currentPage.content = document.body.innerText.toLowerCase();
            }
            
            this.searchIndex = pages;
        },
        
        setupEventListeners: function() {
            const searchBtn = document.getElementById('searchBtn');
            const closeBtn = document.getElementById('closeSearch');
            const modal = document.getElementById('searchModal');
            
            if (searchBtn) {
                searchBtn.addEventListener('click', () => this.openSearch());
            }
            
            if (closeBtn) {
                closeBtn.addEventListener('click', () => this.closeSearch());
            }
            
            if (modal) {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) this.closeSearch();
                });
            }
            
            if (this.searchInput) {
                this.searchInput.addEventListener('input', (e) => this.performSearch(e.target.value));
                this.searchInput.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') this.closeSearch();
                });
            }
        },
        
        openSearch: function() {
            const modal = document.getElementById('searchModal');
            if (modal) {
                modal.classList.add('active');
                if (this.searchInput) {
                    this.searchInput.focus();
                }
            }
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        },
        
        closeSearch: function() {
            const modal = document.getElementById('searchModal');
            if (modal) {
                modal.classList.remove('active');
            }
            if (this.searchInput) {
                this.searchInput.value = '';
            }
            if (this.searchResults) {
                this.searchResults.innerHTML = '';
            }
        },
        
        performSearch: function(query) {
            if (!query || query.length < 2) {
                if (this.searchResults) {
                    this.searchResults.innerHTML = '';
                }
                return;
            }
            
            const results = [];
            const lowerQuery = query.toLowerCase();
            
            this.searchIndex.forEach(page => {
                if (page.content.includes(lowerQuery) || page.title.toLowerCase().includes(lowerQuery)) {
                    results.push(page);
                }
            });
            
            this.displayResults(results, query);
        },
        
        displayResults: function(results, query) {
            if (!this.searchResults) return;
            
            if (results.length === 0) {
                this.searchResults.innerHTML = '<p class="search-no-results">No results found</p>';
                return;
            }
            
            const html = results.map(page => `
                <a href="${page.url}" class="search-result-item">
                    <h4>${page.title}</h4>
                    <p>${page.url}</p>
                </a>
            `).join('');
            
            this.searchResults.innerHTML = html;
        }
    };
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => SiteSearch.init());
    } else {
        SiteSearch.init();
    }
})();

