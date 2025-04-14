# YouTube to MP3 Converter (Python + PHP)

<img src="https://i.imgur.com/tb2oVy8.png" width="1000px">

This project allows users to convert YouTube video URLs to high-quality MP3 files using Python, with PHP acting as the front-end handler. It's a lightweight, fast, and efficient solution that combines the strengths of both languages.

---

## 📌 How It Works

### 1. FFmpeg Setup
- Download the following FFmpeg files: `ffmpeg.exe`, `ffplay.exe`, and `ffprobe.exe`.
- Move them into the `C:\Program Files\ffmpeg` directory.
- Open *Environment Variables* settings on your system.
- Under *System Variables*, find and edit the `Path` variable.
- Click **New** and add:  `C:\Program Files\ffmpeg`
- This will allow FFmpeg to be accessible system-wide from any script or command.

### 2. Placing Python Script
- Move the provided Python script into the same directory as your `index.php` file.

### 3. Workflow
- When a user submits a YouTube URL through the `index.php` form, it triggers the Python script.
- The Python script uses `yt_dlp` to download the video and extract the best quality audio.
- FFmpeg then converts the downloaded audio into an MP3 file with the highest possible quality.

### 4. Python Dependency
The only Python library required is:
```python
from yt_dlp import YoutubeDL
```

Install it via pip if you haven’t:
```python
pip install yt-dlp
```

### 5. No Additional Configuration Needed
- The system is designed to work out of the box as long as:
- FFmpeg is properly installed and added to PATH
- Python is installed
- yt_dlp is installed
- PHP has permission to execute Python scripts on your server

### ⚠️ Disclaimer
This project has been developed for educational purposes only. Unauthorized system access is strictly prohibited and constitutes a criminal offense. The developer cannot be held responsible for any misuse.
