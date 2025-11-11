// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializePortfolio();
    initializeChat();
    initializeLazyLoading();
    initializeSkillsChart();
    initializeScrollAnimations();
    initializeScrollToTop();
});

// GitHub Portfolio
async function initializePortfolio() {
    const portfolioContainer = document.getElementById('portfolio-container');
    if (!portfolioContainer) return;

    // Show loading state
    portfolioContainer.innerHTML = '<div class="portfolio-loading"><div class="loading-spinner"></div> Loading projects...</div>';

    try {
        // Try GraphQL API first for pinned repositories
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

        if (!graphqlResponse.ok) {
            throw new Error(`GraphQL API error: ${graphqlResponse.status}`);
        }

        const graphqlData = await graphqlResponse.json();

        // If GraphQL works, use it
        if (!graphqlData.errors && graphqlData.data?.user?.pinnedItems?.nodes) {
            const repos = graphqlData.data.user.pinnedItems.nodes;
            
            portfolioContainer.innerHTML = '';

            if (repos.length === 0) {
                portfolioContainer.innerHTML = '<p class="portfolio-empty">No pinned repositories found.</p>';
                return;
            }

            repos.forEach(repo => {
                const repoCard = document.createElement('div');
                repoCard.className = 'portfolio-item fade-in';

                const language = repo.languages?.nodes?.[0]?.name || 'N/A';
                const stars = repo.stargazerCount || 0;
                const description = repo.description || 'No description available.';

                repoCard.innerHTML = `
                    <h3><a href="${repo.url}" target="_blank" rel="noopener noreferrer">${repo.name}</a></h3>
                    <p class="portfolio-description">${description}</p>
                    <div class="portfolio-meta">
                        <span class="portfolio-language">${language}</span>
                        <span class="portfolio-stars">⭐ ${stars}</span>
                    </div>
                    <a href="${repo.url}" target="_blank" rel="noopener noreferrer" class="portfolio-link">View on GitHub →</a>
                `;

                portfolioContainer.appendChild(repoCard);
            });
            return;
        }

        // Fallback to REST API if GraphQL fails
        console.log('GraphQL failed, using REST API fallback');
        const response = await fetch('https://api.github.com/users/guicybercode/repos?sort=updated&per_page=6');
        
        if (!response.ok) {
            throw new Error(`REST API error: ${response.status}`);
        }
        
        const repos = await response.json();

        if (!Array.isArray(repos)) {
            throw new Error('Invalid response from GitHub API');
        }

        portfolioContainer.innerHTML = '';

        if (repos.length === 0) {
            portfolioContainer.innerHTML = '<p class="portfolio-empty">No repositories found.</p>';
            return;
        }

        repos.forEach(repo => {
            if (repo.fork) return; // Skip forked repositories

            const repoCard = document.createElement('div');
            repoCard.className = 'portfolio-item fade-in';

            const languages = repo.language || 'N/A';
            const stars = repo.stargazers_count || 0;
            const description = repo.description || 'No description available.';

            repoCard.innerHTML = `
                <h3><a href="${repo.html_url}" target="_blank" rel="noopener noreferrer">${repo.name}</a></h3>
                <p class="portfolio-description">${description}</p>
                <div class="portfolio-meta">
                    <span class="portfolio-language">${languages}</span>
                    <span class="portfolio-stars">⭐ ${stars}</span>
                </div>
                <a href="${repo.html_url}" target="_blank" rel="noopener noreferrer" class="portfolio-link">View on GitHub →</a>
            `;

            portfolioContainer.appendChild(repoCard);
        });
    } catch (error) {
        console.error('Error loading GitHub repositories:', error);
        portfolioContainer.innerHTML = `
            <div class="portfolio-error">
                <p>Unable to load projects. Please check your connection or try again later.</p>
                <p class="error-details">Error: ${error.message}</p>
            </div>
        `;
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
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    
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

function initializeChat() {
    const sendBtn = document.getElementById('sendChatBtn');
    const messageInput = document.getElementById('chatMessage');
    const usernameInput = document.getElementById('chatUsername');

    if (!sendBtn || !messageInput || !usernameInput) return;

    // Load existing messages
    loadChatMessages();

    // Start polling for new messages
    chatPollingInterval = setInterval(loadChatMessages, 3000);

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
                        textSpan.textContent = msg.message;
                        
                        const timeSpan = document.createElement('span');
                        timeSpan.className = 'chat-time';
                        timeSpan.textContent = formatTimestamp(msg.timestamp);
                        
                        messageDiv.appendChild(usernameSpan);
                        messageDiv.appendChild(textSpan);
                        messageDiv.appendChild(timeSpan);
                        messagesContainer.appendChild(messageDiv);
                    });
                    
                    // Auto-scroll to bottom
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
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
        alert('Please enter both your name and a message');
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
            // Show success feedback (visual, not alert)
            showChatFeedback('Message sent!', 'success');
        } else {
            throw new Error(data.error || 'Unknown error');
        }
    })
    .catch(error => {
        console.error('Error sending message:', error);
        showChatFeedback(error.message || 'Error sending message. Please try again.', 'error');
    })
    .finally(() => {
        sendBtn.disabled = false;
        sendBtn.textContent = 'Send';
        messageInput.focus();
    });
}

function showChatFeedback(message, type) {
    const chatContainer = document.querySelector('.chat-container');
    if (!chatContainer) return;
    
    // Remove existing feedback
    const existingFeedback = chatContainer.querySelector('.chat-feedback');
    if (existingFeedback) {
        existingFeedback.remove();
    }
    
    const feedback = document.createElement('div');
    feedback.className = `chat-feedback chat-feedback-${type}`;
    feedback.textContent = message;
    feedback.setAttribute('role', 'alert');
    feedback.setAttribute('aria-live', 'polite');
    
    chatContainer.insertBefore(feedback, chatContainer.firstChild);
    
    // Auto-remove after 3 seconds
    setTimeout(() => {
        feedback.remove();
    }, 3000);
}

function formatTimestamp(timestamp) {
    const date = new Date(timestamp * 1000);
    const now = new Date();
    const diff = now - date;
    
    if (diff < 60000) { // Less than 1 minute
        return 'Just now';
    } else if (diff < 3600000) { // Less than 1 hour
        const minutes = Math.floor(diff / 60000);
        return minutes + ' minute' + (minutes > 1 ? 's' : '') + ' ago';
    } else if (diff < 86400000) { // Less than 1 day
        const hours = Math.floor(diff / 3600000);
        return hours + ' hour' + (hours > 1 ? 's' : '') + ' ago';
    } else {
        return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
    }
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
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollButton.style.display = 'block';
        } else {
            scrollButton.style.display = 'none';
        }
    });
    
    // Scroll to top on click
    scrollButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}
