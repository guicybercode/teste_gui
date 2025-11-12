// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializePortfolio();
    initializeChat();
    initializeLazyLoading();
    initializeSkillsChart();
    initializeScrollAnimations();
    initializeScrollToTop();
    initializeMobileMenu();
});

// GitHub Portfolio
async function initializePortfolio() {
    console.log('Initializing portfolio...');
    const portfolioContainer = document.getElementById('portfolio-container');
    if (!portfolioContainer) {
        console.log('Portfolio container not found');
        return;
    }

    // Show loading state with skeleton screens
    function showSkeletonLoading() {
        portfolioContainer.innerHTML = '';
        for (let i = 0; i < 3; i++) {
            const skeletonCard = document.createElement('div');
            skeletonCard.className = 'skeleton-card';
            skeletonCard.innerHTML = `
                <div class="skeleton skeleton-title"></div>
                <div class="skeleton skeleton-text"></div>
                <div class="skeleton skeleton-text short"></div>
                <div class="skeleton-meta">
                    <div class="skeleton skeleton-badge"></div>
                    <div class="skeleton skeleton-badge"></div>
                </div>
            `;
            portfolioContainer.appendChild(skeletonCard);
        }
    }
    
    // Show loading state
    showSkeletonLoading();

    // Cache configuration
    const CACHE_KEY = 'github_repos_cache';
    const CACHE_TTL = 3600000; // 1 hour in milliseconds
    
    // Check cache first
    function getCachedRepos() {
        try {
            const cached = localStorage.getItem(CACHE_KEY);
            if (!cached) {
                console.log('No cache found');
                return null;
            }
            
            const cacheData = JSON.parse(cached);
            const now = Date.now();
            
            // Validate cache structure
            if (!cacheData.timestamp || !cacheData.repos) {
                console.log('Invalid cache structure, clearing cache');
                localStorage.removeItem(CACHE_KEY);
                return null;
            }
            
            // Check if cache is still valid
            if ((now - cacheData.timestamp) < CACHE_TTL) {
                console.log('Valid cache found');
                return cacheData.repos;
            }
            
            // Cache expired, remove it
            console.log('Cache expired, clearing cache');
            localStorage.removeItem(CACHE_KEY);
            return null;
        } catch (e) {
            console.error('Error reading cache:', e);
            localStorage.removeItem(CACHE_KEY);
            return null;
        }
    }
    
    // Save to cache
    function setCachedRepos(repos) {
        try {
            // Validate repos before caching
            if (!repos || !repos.repos || !Array.isArray(repos.repos)) {
                console.error('Invalid repos data, not caching');
                return;
            }
            
            const cacheData = {
                timestamp: Date.now(),
                repos: repos
            };
            localStorage.setItem(CACHE_KEY, JSON.stringify(cacheData));
            console.log('Cached', repos.repos.length, 'repositories');
        } catch (e) {
            console.error('Error saving cache:', e);
        }
    }

    // Try to load from cache first
    const cachedRepos = getCachedRepos();
    if (cachedRepos) {
        console.log('Loading repositories from cache');
        renderRepositories(cachedRepos, true);
        return;
    }

    try {
        // Try GraphQL API first for pinned repositories
        let repos = null;
        let useGraphQL = false;
        
        try {
            console.log('Attempting to fetch pinned repos via GraphQL...');
            const query = `
                {
                    user(login: "guicybercode") {
                        pinnedItems(first: 6, types: REPOSITORY) {
                            nodes {
                                ... on Repository {
                                    name
                                    description
                                    url
                                    languages(first: 1) {
                                        nodes {
                                            name
                                        }
                                    }
                                    stargazerCount
                                }
                            }
                        }
                    }
                }
            `;

            const graphqlResponse = await fetch('https://api.github.com/graphql', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ query })
            });

            console.log('GraphQL response status:', graphqlResponse.status);

            if (graphqlResponse.ok) {
                const graphqlData = await graphqlResponse.json();
                console.log('GraphQL response:', graphqlData);
                
                // Check for errors
                if (graphqlData.errors) {
                    console.log('GraphQL returned errors:', graphqlData.errors);
                } else if (graphqlData.data?.user?.pinnedItems?.nodes) {
                    repos = graphqlData.data.user.pinnedItems.nodes;
                    useGraphQL = true;
                    console.log('GraphQL successful, found', repos.length, 'pinned repositories');
                }
            }
        } catch (graphqlError) {
            console.log('GraphQL API failed, will use REST API fallback:', graphqlError);
        }

        // Fallback to REST API if GraphQL failed or returned no data
        if (!useGraphQL || !repos || repos.length === 0) {
            console.log('Using REST API fallback');
            const response = await fetch('https://api.github.com/users/guicybercode/repos?sort=updated&per_page=6');
            
            console.log('REST API response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`REST API error: ${response.status}`);
            }
            
            const restRepos = await response.json();
            console.log('REST API returned', restRepos.length, 'repositories');

            if (!Array.isArray(restRepos)) {
                throw new Error('Invalid response from GitHub API');
            }

            // Filter out forks
            repos = restRepos.filter(repo => !repo.fork).slice(0, 6);
            console.log('After filtering forks:', repos.length, 'repositories');
            useGraphQL = false;
        }

        // Validate repos before caching/rendering
        if (!repos || !Array.isArray(repos) || repos.length === 0) {
            throw new Error('No valid repositories found');
        }

        // Cache the results
        setCachedRepos({ repos, useGraphQL });

        // Render repositories
        renderRepositories({ repos, useGraphQL });
    } catch (error) {
        console.error('Error loading GitHub repositories:', error);
        portfolioContainer.innerHTML = `
            <div class="portfolio-error">
                <p>Unable to load projects. Please check your connection or try again later.</p>
                <p class="error-details">Error: ${error.message}</p>
                <button onclick="initializePortfolio()" style="margin-top: 1rem; padding: 0.5rem 1rem; background: var(--link-color); color: white; border: none; cursor: pointer;">Retry</button>
            </div>
        `;
    }
    
    // Render repositories function
    function renderRepositories(data, fromCache = false) {
        console.log('Rendering repositories...', fromCache ? '(from cache)' : '(from API)');
        
        // Validate data structure
        if (!data || typeof data !== 'object') {
            console.error('Invalid data structure:', data);
            portfolioContainer.innerHTML = '<p class="portfolio-error">Error rendering repositories.</p>';
            return;
        }
        
        const { repos, useGraphQL } = data;
        
        // Clear loading state
        portfolioContainer.innerHTML = '';

        if (!repos || !Array.isArray(repos) || repos.length === 0) {
            console.log('No repositories to display');
            portfolioContainer.innerHTML = '<p class="portfolio-empty">No repositories found.</p>';
            return;
        }

        console.log('Rendering', repos.length, 'repositories using', useGraphQL ? 'GraphQL' : 'REST', 'format');

        // Render repositories
        repos.forEach((repo, index) => {
            try {
                const repoCard = document.createElement('div');
                repoCard.className = 'portfolio-item fade-in';

                let name, url, description, language, stars;

                if (useGraphQL) {
                    name = repo.name || 'Unnamed';
                    url = repo.url || '#';
                    description = repo.description || 'No description available.';
                    language = repo.languages?.nodes?.[0]?.name || 'N/A';
                    stars = repo.stargazerCount || 0;
                } else {
                    name = repo.name || 'Unnamed';
                    url = repo.html_url || '#';
                    description = repo.description || 'No description available.';
                    language = repo.language || 'N/A';
                    stars = repo.stargazers_count || 0;
                }

                repoCard.innerHTML = `
                    <h3><a href="${url}" target="_blank" rel="noopener noreferrer">${name}</a></h3>
                    <p class="portfolio-description">${description}</p>
                    <div class="portfolio-meta">
                        <span class="portfolio-language">${language}</span>
                        <span class="portfolio-stars">⭐ ${stars}</span>
                    </div>
                    <a href="${url}" target="_blank" rel="noopener noreferrer" class="portfolio-link">View on GitHub →</a>
                `;

                portfolioContainer.appendChild(repoCard);
                console.log(`Rendered repository ${index + 1}: ${name}`);
            } catch (renderError) {
                console.error(`Error rendering repository ${index}:`, renderError, repo);
            }
        });
        
        console.log('Portfolio rendering complete');
    }
}

// Lazy Loading for images
function initializeLazyLoading() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        observer.unobserve(img);
                    }
                }
            });
        });

        // Observe all images with data-src attribute
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    } else {
        // Fallback for browsers without IntersectionObserver
        document.querySelectorAll('img[data-src]').forEach(img => {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
        });
    }
}

// Skills Visualization Chart
function initializeSkillsChart() {
    const canvas = document.getElementById('skillsChart');
    if (!canvas) {
        console.log('Skills chart canvas not found');
        return;
    }

    const skillsSection = canvas.closest('section');
    if (!skillsSection) {
        console.log('Skills section not found');
        return;
    }

    function createChart() {
        console.log('Creating skills chart...');
        const ctx = canvas.getContext('2d');
        
        try {
            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: ['Programming', 'Music', 'Languages', 'Systems', 'Cloud', 'Reading', 'Composition', 'Linux'],
                    datasets: [{
                        label: 'Skill Level',
                        data: [85, 80, 75, 80, 70, 85, 75, 85],
                        backgroundColor: 'rgba(255, 107, 53, 0.15)',
                        borderColor: 'rgba(255, 107, 53, 0.8)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(255, 107, 53, 1)',
                        pointBorderColor: '#ffffff',
                        pointHoverBackgroundColor: '#ffffff',
                        pointHoverBorderColor: 'rgba(255, 107, 53, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        r: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                stepSize: 20,
                                color: '#7a7a7a',
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: '#e8e5df'
                            },
                            pointLabels: {
                                color: '#4a4a4a',
                                font: {
                                    size: 12,
                                    family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif'
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.98)',
                            titleColor: '#2d2d2d',
                            bodyColor: '#4a4a4a',
                            borderColor: '#e8e5df',
                            borderWidth: 1,
                            padding: 12,
                            boxPadding: 6
                        }
                    }
                }
            });
            console.log('Skills chart created successfully');
        } catch (error) {
            console.error('Error creating chart:', error);
            canvas.parentElement.innerHTML = '<p>Error creating chart. Please refresh the page.</p>';
        }
    }

    function loadChartJS() {
        console.log('Loading Chart.js...');
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/chart.js';
        script.async = true;
        script.onload = () => {
            console.log('Chart.js loaded successfully');
            createChart();
        };
        script.onerror = () => {
            console.error('Failed to load Chart.js');
            canvas.parentElement.innerHTML = '<p>Chart library failed to load. Please refresh the page.</p>';
        };
        document.head.appendChild(script);
    }

    // Use IntersectionObserver to load Chart.js only when section is visible
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    console.log('Skills section is visible, loading chart...');
                    if (typeof Chart === 'undefined') {
                        loadChartJS();
                    } else {
                        createChart();
                    }
                    observer.unobserve(skillsSection);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '50px'
        });

        observer.observe(skillsSection);
    } else {
        // Fallback: load immediately if IntersectionObserver not supported
        console.log('IntersectionObserver not supported, loading chart immediately');
        if (typeof Chart === 'undefined') {
            loadChartJS();
        } else {
            createChart();
        }
    }
}

// Scroll Animations
function initializeScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all sections
    document.querySelectorAll('section').forEach(section => {
        section.classList.add('fade-in');
        observer.observe(section);
    });

    // Observe portfolio items
    const portfolioObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('fade-in-visible');
                }, index * 100);
                portfolioObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe portfolio items after they're loaded
    setTimeout(() => {
        document.querySelectorAll('.portfolio-item').forEach(item => {
            item.classList.add('fade-in');
            portfolioObserver.observe(item);
        });
    }, 1000);
}

// Chat functionality
let chatPollingInterval;
let lastMessageCount = 0;
let pollingInterval = 3000; // Start with 3 seconds
let isUserScrolling = false;
let userScrollPosition = 0;
let shouldAutoScroll = true;

function initializeChat() {
    const sendBtn = document.getElementById('sendChatBtn');
    const messageInput = document.getElementById('chatMessage');
    const usernameInput = document.getElementById('chatUsername');
    const messagesContainer = document.getElementById('chatMessages');

    if (!sendBtn || !messageInput || !usernameInput || !messagesContainer) {
        console.log('Chat elements not found:', {
            sendBtn: !!sendBtn,
            messageInput: !!messageInput,
            usernameInput: !!usernameInput,
            messagesContainer: !!messagesContainer
        });
        return;
    }

    // Track user scroll behavior
    messagesContainer.addEventListener('scroll', function() {
        const isNearBottom = messagesContainer.scrollHeight - messagesContainer.scrollTop - messagesContainer.clientHeight < 100;
        shouldAutoScroll = isNearBottom;
        userScrollPosition = messagesContainer.scrollTop;
    });

    // Send message on button click
    sendBtn.addEventListener('click', sendMessage);

    // Send message on Enter key
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    usernameInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            messageInput.focus();
        }
    });

    // Load existing messages
    loadChatMessages();

    // Start adaptive polling for new messages
    startChatPolling();
}

function startChatPolling() {
    // Clear existing interval
    if (chatPollingInterval) {
        clearInterval(chatPollingInterval);
    }
    
    // Adaptive polling: faster when active, slower when idle
    chatPollingInterval = setInterval(() => {
        loadChatMessages();
        // Increase interval gradually if no new messages (max 10 seconds)
        if (pollingInterval < 10000) {
            pollingInterval = Math.min(pollingInterval + 500, 10000);
        }
    }, pollingInterval);
}

function stopChatPolling() {
    if (chatPollingInterval) {
        clearInterval(chatPollingInterval);
        chatPollingInterval = null;
    }
}

function loadChatMessages() {
    fetch('chat.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.messages && data.messages.length > 0) {
                const messagesContainer = document.getElementById('chatMessages');
                if (!messagesContainer) return;
                
                // Only update if there are new messages
                if (data.messages.length !== lastMessageCount) {
                    messagesContainer.innerHTML = '';
                    
                    data.messages.forEach(msg => {
                        const messageDiv = document.createElement('div');
                        messageDiv.className = 'chat-message';
                        
                        const usernameSpan = document.createElement('span');
                        usernameSpan.className = 'chat-username';
                        usernameSpan.textContent = msg.username + ':';
                        
                        const textSpan = document.createElement('span');
                        textSpan.className = 'chat-text';
                        // Support emojis and basic HTML
                        textSpan.innerHTML = escapeHtml(msg.message).replace(/(\r\n|\n|\r)/g, '<br>');
                        
                        const timeSpan = createTimestampElement(msg.timestamp);
                        
                        messageDiv.appendChild(usernameSpan);
                        messageDiv.appendChild(textSpan);
                        messageDiv.appendChild(timeSpan);
                        messagesContainer.appendChild(messageDiv);
                    });
                    
                    // Intelligent auto-scroll: only scroll if user is near bottom
                    if (shouldAutoScroll) {
                        messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    }
                    
                    // Reset polling interval if new messages
                    if (data.messages.length > lastMessageCount) {
                        pollingInterval = 3000; // Reset to fast polling
                    }
                    
                    lastMessageCount = data.messages.length;
                }
            }
        })
        .catch(error => {
            console.error('Error loading chat messages:', error);
            // Don't show error to user on every poll, only log it
        });
}

function sendMessage() {
    const usernameInput = document.getElementById('chatUsername');
    const messageInput = document.getElementById('chatMessage');
    
    if (!usernameInput || !messageInput) return;
    
    const username = usernameInput.value.trim();
    const message = messageInput.value.trim();
    
    if (!username || !message) {
        toast.warning('Please enter both your name and a message');
        return;
    }
    
    // Disable button during send
    const sendBtn = document.getElementById('sendChatBtn');
    if (!sendBtn) return;
    
    sendBtn.disabled = true;
    sendBtn.textContent = 'Sending...';
    
    fetch('chat.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            username: username,
            message: message
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.error || `HTTP error! status: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            messageInput.value = '';
            // Reload messages immediately
            loadChatMessages();
            // Show success feedback
            toast.success('Message sent!');
            // Reset polling to fast
            pollingInterval = 3000;
        } else {
            throw new Error(data.error || 'Unknown error');
        }
    })
    .catch(error => {
        console.error('Error sending message:', error);
        toast.error(error.message || 'Error sending message. Please try again.');
    })
    .finally(() => {
        sendBtn.disabled = false;
        sendBtn.textContent = 'Send';
        messageInput.focus();
    });
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function formatTimestamp(timestamp) {
    if (!timestamp) return '';
    
    const now = Date.now();
    const messageTime = timestamp * 1000; // Convert to milliseconds
    const diff = now - messageTime;
    
    const seconds = Math.floor(diff / 1000);
    const minutes = Math.floor(seconds / 60);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);
    
    let relativeTime;
    if (seconds < 60) {
        relativeTime = 'just now';
    } else if (minutes < 60) {
        relativeTime = `${minutes}m ago`;
    } else if (hours < 24) {
        relativeTime = `${hours}h ago`;
    } else if (days < 7) {
        relativeTime = `${days}d ago`;
    } else {
        const date = new Date(messageTime);
        relativeTime = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    }
    
    return relativeTime;
}

function createTimestampElement(timestamp) {
    const timeSpan = document.createElement('span');
    timeSpan.className = 'chat-time';
    timeSpan.textContent = formatTimestamp(timestamp);
    const date = new Date(timestamp * 1000);
    timeSpan.setAttribute('title', date.toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    }));
    return timeSpan;
}

// Scroll to top button
function initializeScrollToTop() {
    // Create button
    const scrollButton = document.createElement('button');
    scrollButton.id = 'scrollToTop';
    scrollButton.className = 'scroll-to-top';
    scrollButton.setAttribute('aria-label', 'Scroll to top');
    scrollButton.innerHTML = '↑';
    scrollButton.style.display = 'none';
    document.body.appendChild(scrollButton);
    
    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Show/hide button based on scroll position (with debounce)
    const handleScroll = debounce(function() {
        if (window.pageYOffset > 300) {
            scrollButton.style.display = 'block';
        } else {
            scrollButton.style.display = 'none';
        }
    }, 100); // 100ms debounce
    
    window.addEventListener('scroll', handleScroll);
    
    // Scroll to top on click
    scrollButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Mobile Menu
function initializeMobileMenu() {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    if (!menuToggle || !navLinks) {
        console.log('Mobile menu elements not found');
        return;
    }
    
    menuToggle.addEventListener('click', function() {
        const isOpen = navLinks.classList.contains('mobile-menu-open');
        
        if (isOpen) {
            navLinks.classList.remove('mobile-menu-open');
            menuToggle.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
        } else {
            navLinks.classList.add('mobile-menu-open');
            menuToggle.classList.add('active');
            menuToggle.setAttribute('aria-expanded', 'true');
        }
    });
    
    // Close menu when clicking on a link
    const menuItems = navLinks.querySelectorAll('a');
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            navLinks.classList.remove('mobile-menu-open');
            menuToggle.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
        });
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!menuToggle.contains(event.target) && !navLinks.contains(event.target)) {
            navLinks.classList.remove('mobile-menu-open');
            menuToggle.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
        }
    });
}
