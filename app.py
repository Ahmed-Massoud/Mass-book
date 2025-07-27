from flask import Flask, request, redirect
import os
import requests

app = Flask(__name__)

@app.route('/signup', methods=['POST'])
def signup():
    name = request.form['name']
    username = request.form['username']
    email = request.form['email']
    password = request.form['password']

    template_path = 'profile/profile.htm'
    output_path = os.path.join('profile', f'{username}.html')
    
    with open(template_path, 'r') as template_file:
        template_content = template_file.read()

    updated_content = template_content.replace('{{name}}', name)
    updated_content=updated_content.replace('{{email}}', email)

    with open(output_path, 'w') as output_file:
        output_file.write(updated_content)
    respond = requests.post("http://localhost/create_account.php?",data={'name':name,'username':username,'email':email,'password':password})
    return redirect(f'http://localhost/profile/{username}.html')

if __name__ == '__main__':
    app.run(debug=True)