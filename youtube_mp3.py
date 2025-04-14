import os
import sys
import logging
from yt_dlp import YoutubeDL

logging.basicConfig(level=logging.INFO, format="%(asctime)s - %(levelname)s - %(message)s")

def youtube_to_mp3(url, output_file):
    try:
        FFMPEG_PATH = 'C:\\Program Files\\ffmpeg\\ffmpeg.exe'
        TEMP_DIR = 'C:\\xampp\\htdocs\\youtube_mp3\\temp'
        OUTPUT_DIR = 'C:\\xampp\\htdocs\\youtube_mp3\\output'
        ydl_opts = {
            'format': 'bestaudio/best',
            'outtmpl': os.path.join(TEMP_DIR, '%(title)s.%(ext)s'),
            'ffmpeg_location': FFMPEG_PATH,
            'postprocessors': [{
                'key': 'FFmpegExtractAudio',
                'preferredcodec': 'mp3',
                'preferredquality': '320',
            }],
        }
        logging.info(f"Download started for: {url}")
        with YoutubeDL(ydl_opts) as ydl:
            info = ydl.extract_info(url, download=True)
            temp_file = ydl.prepare_filename(info)
            mp3_file = temp_file.rsplit('.', 1)[0] + ".mp3"
            if not os.path.exists(mp3_file):
                raise FileNotFoundError("MP3 file not found, conversion failed.")
            output_path = os.path.join(OUTPUT_DIR, output_file)
            os.rename(mp3_file, output_path)
        logging.info(f"File created: {output_path}")
        return output_path
    except Exception as e:
        logging.error(f"Conversion error: {str(e)}", exc_info=True)
        raise

if __name__ == "__main__":
    if len(sys.argv) != 3:
        logging.error("Invalid arguments.")
        sys.exit(1)
    try:
        youtube_url = sys.argv[1]
        output_filename = sys.argv[2]
        result = youtube_to_mp3(youtube_url, output_filename)
        print(result)
    except Exception as e:
        print(f"Error: {str(e)}")
        sys.exit(1)
