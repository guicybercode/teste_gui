# Simple Web Dashboard with Charts and Chat

A lightweight PHP web application featuring interactive charts, content sections, images, and a simple chat system without login requirements. Designed for easy server testing with minimal dependencies.

## Features

- **Interactive Charts**: Three types of charts powered by Chart.js
  - Line chart for time series data
  - Bar chart for comparative data
  - Pie chart for distribution data

- **Real-time Chat**: Simple chat system without login requirements
  - File-based message storage (no database needed)
  - Auto-refresh every 3 seconds
  - Message history up to 100 messages

- **Responsive Design**: Modern, clean interface that works on all devices

- **Image Gallery**: Display section for images with placeholder support

- **Statistics Cards**: Visual representation of key metrics

- **Content Sections**: Informational content areas

## Requirements

- PHP 7.4 or higher
- Apache or Nginx web server
- Write permissions for the `chat_messages.txt` file

## Installation

### Quick Install (Debian/Ubuntu/Arch)

Run the installation script:

```bash
chmod +x install.sh
sudo ./install.sh
```

The script will:
- Detect your Linux distribution
- Install PHP and Apache
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

## Setup

1. Copy the project files to your web server directory:
   - **Debian/Ubuntu**: `/var/www/html/` or your virtual host directory
   - **Arch Linux**: `/srv/http/` or your virtual host directory

2. Set proper permissions:
   ```bash
   sudo chown -R www-data:www-data /path/to/project  # Debian/Ubuntu
   sudo chown -R http:http /path/to/project           # Arch Linux
   ```

3. Make the chat file writable:
   ```bash
   sudo chmod 666 /path/to/project/chat_messages.txt
   ```

4. Access the application:
   - Open `http://localhost` in your browser
   - Or `http://your-server-ip` if accessing remotely

## Project Structure

```
projeto_droplet/
├── index.php              # Main dashboard page
├── chat.php               # Chat API endpoints
├── chat_messages.txt      # Chat message storage (created automatically)
├── css/
│   └── style.css          # Stylesheet
├── js/
│   └── main.js            # JavaScript for charts and chat
├── images/
│   └── placeholder/       # Image directory
├── install.sh             # Installation script
└── README.md              # This file
```

## Usage

### Charts

The charts are automatically initialized with sample data when the page loads. You can modify the data in `js/main.js` to use your own datasets.

### Chat

1. Enter your name in the "Your name" field
2. Type your message
3. Click "Send" or press Enter
4. Messages are automatically refreshed every 3 seconds
5. All users can see messages without login

### Images

Place your images in the `images/placeholder/` directory. The gallery will automatically display them. If images are missing, placeholder images will be shown.

## Customization

### Changing Chart Data

Edit `js/main.js` and modify the data arrays in the `initializeCharts()` function.

### Styling

Modify `css/style.css` to change colors, fonts, and layout.

### Chat Settings

Edit `chat.php` to modify:
- Maximum messages stored (`$maxMessages`)
- Message refresh interval (change `3000` in `main.js`)

## Security Notes

- This is a simple test application. For production use, consider:
  - Adding rate limiting for chat messages
  - Implementing user authentication
  - Using a proper database instead of file storage
  - Adding CSRF protection
  - Implementing input validation and sanitization improvements

## Troubleshooting

### Chat not working

- Check file permissions: `chat_messages.txt` must be writable
- Check PHP error logs: `/var/log/apache2/error.log` (Debian/Ubuntu) or `/var/log/httpd/error_log` (Arch)
- Ensure PHP is properly configured

### Charts not displaying

- Check browser console for JavaScript errors
- Ensure internet connection (Chart.js is loaded from CDN)
- Verify that `js/main.js` is loading correctly

### Images not showing

- Check file permissions for the `images/` directory
- Verify image paths are correct
- Check browser console for 404 errors

## License

This project is provided as-is for testing purposes.

---

"너희는 먼저 그의 나라와 그의 의를 구하라 그리하면 이 모든 것을 너희에게 더하시리라" - 마태복음 6:33

# teste_gui
# teste_gui
