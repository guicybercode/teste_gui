/**
 * Theme Management - Dark Mode Toggle
 */
(function() {
    'use strict';
    
    const ThemeManager = {
        init: function() {
            // Check for saved theme preference or default to light
            const savedTheme = localStorage.getItem('theme') || 'light';
            this.setTheme(savedTheme);
            
            // Set up toggle button
            const toggleBtn = document.getElementById('themeToggle');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', () => this.toggleTheme());
                this.updateToggleIcon(savedTheme);
            }
            
            // Listen for system theme changes
            if (window.matchMedia) {
                const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
                mediaQuery.addEventListener('change', (e) => {
                    if (!localStorage.getItem('theme')) {
                        this.setTheme(e.matches ? 'dark' : 'light');
                    }
                });
            }
        },
        
        setTheme: function(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            this.updateToggleIcon(theme);
        },
        
        toggleTheme: function() {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            this.setTheme(newTheme);
        },
        
        updateToggleIcon: function(theme) {
            const toggleBtn = document.getElementById('themeToggle');
            if (!toggleBtn) return;
            
            const icon = toggleBtn.querySelector('i');
            if (icon) {
                icon.setAttribute('data-feather', theme === 'dark' ? 'sun' : 'moon');
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }
        }
    };
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => ThemeManager.init());
    } else {
        ThemeManager.init();
    }
})();

