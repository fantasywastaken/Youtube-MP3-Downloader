<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MP3 Converter Pro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <div class="logo">
            <span>MP3 Converter Pro</span>
        </div>
        <p class="tagline">Fast, easy and reliable YouTube to MP3 converter</p>
    </header>
    <form id="downloadForm" method="POST" action="download.php">
        <div class="download-form">
            <div class="form-group">
                <label for="video-url">YouTube Video URL</label>
                <input type="url" name="video_url" id="video-url" placeholder="https://www.youtube.com/watch?v=..." required>
            </div>
            <button type="submit" class="btn" id="download-btn">Download</button>
            <div class="loading">
                <div class="spinner"></div>
                <p>Download is being prepared, please wait...</p>
            </div>
            <div class="error-message">
                <p>Error: A problem occurred during the download process.</p>
            </div>
        </div>
    </form>
    <div class="features">
        <div class="feature">
            <div class="feature-icon">⚡</div>
            <h3>Fast Transformation</h3>
            <p>Convert your videos to high quality MP3 in seconds</p>
        </div>
        <div class="feature">
            <div class="feature-icon">🔒</div>
            <h3>Safe</h3>
            <p>Your privacy is important to us, your data is safe</p>
        </div>
        <div class="feature">
            <div class="feature-icon">💯</div>
            <h3>High Quality</h3>
            <p>320kbps high quality MP3 output</p>
        </div>
    </div>
</div>
<footer>
    <p>© 2025 YouTube MP3 Downloader. All rights reserved.</p>
</footer>
<script>
    document.getElementById('downloadForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = document.getElementById('download-btn');
        const loading = document.querySelector('.loading');
        const errorMsg = document.querySelector('.error-message');
        btn.disabled = true;
        loading.style.display = 'block';
        errorMsg.style.display = 'none';
        try {
            const formData = new FormData(this);
            const response = await fetch('download.php', {
                method: 'POST',
                body: formData
            });
            if (!response.ok) throw new Error('Server error.');
            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);
            const filename = `yt_${Date.now()}.mp3`;
            const a = document.createElement('a');
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            a.remove();
        } catch (error) {
            console.error('Error:', error);
            errorMsg.style.display = 'block';
        } finally {
            btn.disabled = false;
            loading.style.display = 'none';
        }
    });
</script>
</body>
</html>
