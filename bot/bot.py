from telegram import Update
from telegram.ext import Updater, MessageHandler, Filters, CallbackContext
import requests

TOKEN = "YOUR_BOT_TOKEN"
WEBHOOK_URL = "https://yourwebsite.com/upload.php"  # তোমার সার্ভারে ঠিক URL

def handle_media(update: Update, context: CallbackContext):
    if update.message.photo:
        file = update.message.photo[-1].get_file()
        filename = "photo_" + str(update.message.message_id) + ".jpg"
    elif update.message.video:
        file = update.message.video.get_file()
        filename = "video_" + str(update.message.message_id) + ".mp4"
    else:
        return

    file.download(filename)
    caption = update.message.caption or ""

    files = {'file': open(filename, 'rb')}
    data = {'caption': caption, 'filename': filename}
    requests.post(WEBHOOK_URL, files=files, data=data)
    print("Uploaded:", filename)

updater = Updater(TOKEN)
updater.dispatcher.add_handler(MessageHandler(Filters.photo | Filters.video, handle_media))
updater.start_polling()
updater.idle()
