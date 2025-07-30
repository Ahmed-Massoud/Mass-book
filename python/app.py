from flask import Flask, request, redirect
import os
import requests
from ftplib import FTP

app = Flask(__name__)

@app.route('/signup', methods=['POST'])
def signup():
    name     = request.form['name']
    username = request.form['username']
    email    = request.form['email']
    password = request.form['password']

    # 1. تحميل القالب من الموقع
    try:
        response = requests.get("https://ahmedmassoud.rf.gd/Mass-book/profile/profile.htm")
        template_content = response.text
    except Exception as e:
        return f"فشل تحميل القالب: {e}", 500

    # 2. تعديل القالب
    updated_content = template_content.replace('{{name}}', name).replace('{{email}}', email)

    # 3. حفظ الملف محليًا
    output_filename = f'{username}.html'
    local_path = os.path.join('/tmp', output_filename)  # مسار مؤقت في PythonAnywhere

    with open(local_path, 'w') as f:
        f.write(updated_content)

    # 4. رفع الملف إلى InfinityFree عبر FTP
    try:
        ftp = FTP("ftpupload.net")
        ftp.login("epiz_34278868", "rvU6NBt1Bkp")  # ← استبدل ببياناتك الفعلية

        remote_path = f"/htdocs/Mass-book/profile/{output_filename}"

        with open(local_path, 'rb') as f:
            ftp.storbinary(f'STOR {remote_path}', f)

        ftp.quit()
    except Exception as e:
        return f"فشل رفع الملف عبر FTP: {e}", 500

    # 5. إرسال البيانات لـ PHP
    try:
        requests.post(
            "https://ahmedmassoud.rf.gd/Mass-book/create_account.php",
            data={
                'name': name,
                'username': username,
                'email': email,
                'password': password
            },
            timeout=5
        )
    except Exception as e:
        print("فشل إرسال البيانات لـ PHP:", e)

    # 6. إعادة التوجيه لملف البروفايل
    return redirect(f'https://ahmedmassoud.rf.gd/Mass-book/profile/{username}.html')


if __name__ == '__main__':
    app.run(debug=True)
