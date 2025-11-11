# Cyber Mathrock - Personal Website

> Source code repository for my personal blog and portfolio website

A modern, lightweight personal website built with PHP, HTML, CSS, and JavaScript. Features a Wikipedia-inspired layout with a clean aesthetic, showcasing my work as a software engineer and musician.

## 🌟 Features

- **Personal Blog**: Wikipedia-inspired layout with sidebar navigation and article-style content
- **GitHub Portfolio**: Automatically displays pinned repositories from GitHub
- **Skills Visualization**: Interactive radar chart showcasing diverse skills (Programming, Music, Languages, Systems, Cloud, Reading, Composition, Linux)
- **Real-time Chat**: Simple chat system without login requirements
  - Messages automatically expire after 24 hours
  - File-based storage (no database needed)
  - Auto-refresh every 3 seconds
- **Responsive Design**: Beautiful light aesthetic theme that works perfectly on desktop and mobile
- **Orange Color Scheme**: Warm, modern color palette with orange accents
- **Photo Placeholders**: Ready-to-use spaces for personal photos

## 📸 Screenshots

### Home Page
![Home Page](images/screenshots/home.png)

### Portfolio Section
![Portfolio](images/screenshots/portfolio.png)

### Skills Visualization
![Skills](images/screenshots/skills.png)

### Chat Interface
![Chat](images/screenshots/chat.png)

*Note: Add your screenshots to the `images/screenshots/` directory*

## 🎵 Music & Videos

Check out my guitar covers on YouTube: [@moonguip](https://youtube.com/@moonguip)

## 🚀 Future Features

- [ ] Add more interactive elements
- [ ] Implement blog post system
- [ ] Add contact form
- [ ] Integrate music player
- [ ] Add dark mode toggle
- [ ] Implement search functionality

*Add your planned features here*

## 📋 Requirements

- PHP 7.4 or higher
- Apache or Nginx web server
- Write permissions for the `chat_messages.txt` file

## 🛠️ Installation

### Quick Install (Debian/Ubuntu/Arch)

Run the installation script:

```bash
chmod +x install.sh
sudo ./install.sh
```

The script will:
- Detect your Linux distribution
- Install PHP and Apache/Nginx
- Configure necessary modules
- Provide setup instructions

### Manual Installation

#### Debian/Ubuntu

```bash
sudo apt-get update
sudo apt-get install -y php php-cli php-common apache2
sudo a2enmod rewrite
sudo systemctl start apache2
sudo systemctl enable apache2
```

#### Arch Linux

```bash
sudo pacman -S php apache
sudo systemctl start httpd
sudo systemctl enable httpd
```

## 📁 Project Structure

```
projeto_droplet/
├── index.php              # Main website page
├── chat.php               # Chat API endpoints
├── chat_messages.txt      # Chat message storage (created automatically)
├── css/
│   └── style.css          # Stylesheet with orange theme
├── js/
│   └── main.js            # JavaScript for portfolio, charts, and chat
├── images/
│   └── placeholder/       # Image directory
│   └── screenshots/        # Screenshots directory (create if needed)
├── install.sh             # Installation script
└── README.md              # This file
```

## 🎯 Usage

### Portfolio

The portfolio section automatically fetches your pinned repositories from GitHub. If GraphQL API fails (requires authentication), it falls back to showing your 6 most recently updated repositories.

### Skills Chart

The skills radar chart displays 8 diverse skills. You can modify the data in `js/main.js` in the `initializeSkillsChart()` function.

### Chat

1. Enter your name in the "Your name" field
2. Type your message
3. Click "Send" or press Enter
4. Messages are automatically refreshed every 3 seconds
5. Messages expire after 24 hours automatically

### Adding Screenshots

1. Create a `screenshots` directory inside `images/`
2. Add your screenshot images
3. Update the image paths in the Screenshots section above

### Adding YouTube Videos

1. Get your YouTube video ID from the URL (e.g., `dQw4w9WgXcQ` from `https://youtube.com/watch?v=dQw4w9WgXcQ`)
2. Replace `VIDEO_ID` in the Music & Videos section with your actual video ID

## 🎨 Customization

### Changing Colors

Modify `css/style.css` and update the CSS variables in `:root`:
- `--link-color`: Primary orange color (#ff6b35)
- `--link-hover`: Hover orange color (#ff8c5a)
- `--accent-orange`: Soft orange accent (#ffb88c)

### Updating Skills Chart

Edit `js/main.js` and modify the `initializeSkillsChart()` function to change:
- Skill labels
- Skill values (0-100)
- Chart colors

### Chat Settings

Edit `chat.php` to modify:
- Message expiration time (currently 24 hours)
- Maximum messages stored
- Message refresh interval (change `3000` in `main.js`)

## 🔒 Security Notes

- This is a personal website. For production use, consider:
  - Adding rate limiting for chat messages
  - Implementing user authentication
  - Using a proper database instead of file storage
  - Adding CSRF protection
  - Implementing enhanced input validation and sanitization

## 🐛 Troubleshooting

### Chat not working

- Check file permissions: `chat_messages.txt` must be writable
- Check PHP error logs: `/var/log/apache2/error.log` (Debian/Ubuntu) or `/var/log/httpd/error_log` (Arch)
- Ensure PHP is properly configured

### Portfolio not loading

- Check browser console for JavaScript errors
- Verify GitHub API is accessible (check CORS if needed)
- GraphQL API may require authentication - fallback to REST API should work automatically

### Charts not displaying

- Check browser console for JavaScript errors
- Ensure internet connection (Chart.js is loaded from CDN)
- Verify that `js/main.js` is loading correctly

### Images not showing

- Check file permissions for the `images/` directory
- Verify image paths are correct
- Check browser console for 404 errors

## 📝 License

This project is provided as-is for personal use.

---

"너희는 먼저 그의 나라와 그의 의를 구하라 그리하면 이 모든 것을 너희에게 더하시리라" - 마태복음 6:33
