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
        <p class="tagline">Hızlı, kolay ve güvenilir YouTube MP3 dönüştürücü</p>
    </header>
    <form id="downloadForm" method="POST" action="download.php">
        <div class="download-form">
            <div class="form-group">
                <label for="video-url">YouTube Video URL'si</label>
                <input type="url" name="video_url" id="video-url" placeholder="https://www.youtube.com/watch?v=..." required>
            </div>
            <button type="submit" class="btn" id="download-btn">İndir</button>
            <div class="loading">
                <div class="spinner"></div>
                <p>İndirme hazırlanıyor, lütfen bekleyin...</p>
            </div>
            <div class="error-message">
                <p>Hata: İndirme işlemi sırasında bir sorun oluştu.</p>
            </div>
        </div>
    </form>
    <div class="features">
        <div class="feature">
            <div class="feature-icon">⚡</div>
            <h3>Hızlı Dönüşüm</h3>
            <p>Videolarınızı saniyeler içinde yüksek kaliteli MP3'e dönüştürün</p>
        </div>
        <div class="feature">
            <div class="feature-icon">🔒</div>
            <h3>Güvenli</h3>
            <p>Gizliliğiniz bizim için önemli, verileriniz güvende</p>
        </div>
        <div class="feature">
            <div class="feature-icon">💯</div>
            <h3>Yüksek Kalite</h3>
            <p>320kbps yüksek kaliteli MP3 çıktısı</p>
        </div>
    </div>
</div>
<footer>
    <p>© 2025 YouTube MP3 İndirici. Tüm hakları saklıdır.</p>
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