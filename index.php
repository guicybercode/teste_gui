<?php
$pageTitle = 'Cyber Mathrock - Software Engineer & Music';
$pageDescription = 'Personal website of Cyber Mathrock - Software Engineer & Musician. Portfolio, skills, music covers, and blog.';
$canonicalUrl = rtrim(SITE_URL, '/') . '/';
include __DIR__ . '/includes/header.php';
?>
<div class="page-container">
    <?php include __DIR__ . '/includes/sidebar.php'; ?>
    
    <main class="main-content" id="main-content" role="main">
        <header class="article-header"></header>
        
        <?php include __DIR__ . '/includes/infobox.php'; ?>
        
        <article class="article-content">
            <!-- About Me Section -->
            <section id="about">
                <h2>About Me</h2>
                <p>Brazilian Christian software engineer and musician pursuing Information Systems. I bridge low-level programming (C, Rust), Linux systems (Gentoo, NixOS), and scalable development with Java, Python, TypeScript, and C#. Experienced with AWS, Azure, and Oracle OCI.</p>
                
                <p>Fluent in Portuguese and English, conversational in Korean, Thai, and Icelandic. As a composer and performer, I blend technical precision with creative intuition.</p>
                
                <p>I'm passionate about <strong>open source</strong> and actively contribute to various projects, including translations for <strong>NixOS</strong> and <strong>Arch Linux</strong>. I'm also a strong supporter of the <strong>free software movement</strong>, believing that software freedom is essential for empowering users and ensuring technology serves humanity.</p>
                
                <p>Beyond code and music, I'm an avid reader, a language enthusiast, and a church guitarist. My Christian faith is the foundation of everything I do, guiding my values and how I approach both my technical work and creative pursuits.</p>
                
                <!-- Photo placeholder -->
                <div class="photo-placeholder" role="img" aria-label="Photo placeholder for personal image"></div>
                
                <!-- Social Share -->
                <div class="social-share">
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($canonicalUrl); ?>&text=<?php echo urlencode($pageTitle); ?>" target="_blank" rel="noopener noreferrer" class="social-share-btn">
                        <i data-feather="twitter"></i>
                        <span>Share on Twitter</span>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($canonicalUrl); ?>" target="_blank" rel="noopener noreferrer" class="social-share-btn">
                        <i data-feather="facebook"></i>
                        <span>Share on Facebook</span>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($canonicalUrl); ?>" target="_blank" rel="noopener noreferrer" class="social-share-btn">
                        <i data-feather="linkedin"></i>
                        <span>Share on LinkedIn</span>
                    </a>
                </div>
            </section>

            <!-- Featured Cover: aespa -->
            <section id="featured-cover">
                <h2>Playing Guitar</h2>
                <div class="video-container">
                    <iframe 
                        width="560" 
                        height="315" 
                        src="https://www.youtube.com/embed/fvkk-S3XDEc?rel=0" 
                        title="aespa Cover" 
                        frameborder="0" 
                        loading="lazy"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
                <p><a href="https://youtube.com/shorts/fvkk-S3XDEc" target="_blank" rel="noopener noreferrer">Watch on YouTube →</a> | <a href="https://youtube.com/@moonguip" target="_blank" rel="noopener noreferrer">Check out more covers on my YouTube channel →</a></p>
            </section>
        </article>
    </main>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
