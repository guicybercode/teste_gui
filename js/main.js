// Initialize charts when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeCharts();
    initializeChat();
});

// Chart initialization
function initializeCharts() {
    // Line Chart - Monthly Sales Trend
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Sales (in thousands)',
                data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 40, 38, 45],
                borderColor: 'rgba(255, 255, 255, 0.9)',
                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#e0e0e0',
                        font: {
                            size: 12
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#999999'
                    },
                    grid: {
                        color: '#404040'
                    }
                },
                x: {
                    ticks: {
                        color: '#999999'
                    },
                    grid: {
                        color: '#404040'
                    }
                }
            }
        }
    });

    // Bar Chart - Product Distribution
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Product A', 'Product B', 'Product C', 'Product D', 'Product E'],
            datasets: [{
                label: 'Units Sold',
                data: [65, 59, 80, 81, 56],
                backgroundColor: [
                    'rgba(255, 255, 255, 0.8)',
                    'rgba(224, 224, 224, 0.8)',
                    'rgba(255, 255, 255, 0.6)',
                    'rgba(224, 224, 224, 0.6)',
                    'rgba(255, 255, 255, 0.4)'
                ],
                borderColor: [
                    'rgba(255, 255, 255, 1)',
                    'rgba(224, 224, 224, 1)',
                    'rgba(255, 255, 255, 1)',
                    'rgba(224, 224, 224, 1)',
                    'rgba(255, 255, 255, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#e0e0e0',
                        font: {
                            size: 12
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#999999'
                    },
                    grid: {
                        color: '#404040'
                    }
                },
                x: {
                    ticks: {
                        color: '#999999'
                    },
                    grid: {
                        color: '#404040'
                    }
                }
            }
        }
    });

    // Pie Chart - Category Breakdown
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Category A', 'Category B', 'Category C', 'Category D'],
            datasets: [{
                data: [30, 25, 25, 20],
                backgroundColor: [
                    'rgba(255, 255, 255, 0.8)',
                    'rgba(224, 224, 224, 0.8)',
                    'rgba(255, 255, 255, 0.6)',
                    'rgba(224, 224, 224, 0.6)'
                ],
                borderColor: '#2a2a2a',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'right',
                    labels: {
                        color: '#e0e0e0',
                        font: {
                            size: 12
                        },
                        padding: 15
                    }
                }
            }
        }
    });
}

// Chat functionality
let chatPollingInterval;
let lastMessageCount = 0;

function initializeChat() {
    const sendBtn = document.getElementById('sendChatBtn');
    const messageInput = document.getElementById('chatMessage');
    const usernameInput = document.getElementById('chatUsername');

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
        .then(response => response.json())
        .then(data => {
            if (data.messages && data.messages.length > 0) {
                const messagesContainer = document.getElementById('chatMessages');
                
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
        });
}

function sendMessage() {
    const usernameInput = document.getElementById('chatUsername');
    const messageInput = document.getElementById('chatMessage');
    
    const username = usernameInput.value.trim();
    const message = messageInput.value.trim();
    
    if (!username || !message) {
        alert('Please enter both your name and a message');
        return;
    }
    
    // Disable button during send
    const sendBtn = document.getElementById('sendChatBtn');
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
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            messageInput.value = '';
            // Reload messages immediately
            loadChatMessages();
        } else {
            alert('Error sending message: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error sending message:', error);
        alert('Error sending message. Please try again.');
    })
    .finally(() => {
        sendBtn.disabled = false;
        sendBtn.textContent = 'Send';
        messageInput.focus();
    });
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

