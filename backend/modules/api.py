import google.generativeai as genai
import os
from dotenv import load_dotenv

load_dotenv()

genai.configure(api_key=os.environ['API_KEY'])

model = genai.GenerativeModel('gemini-1.0-pro-latest')

def generate_code(contents):
    response = model.generate_content(contents)
    return response.text

def generate_text(contents):
    response = model.generate_content(contents)
    return response.text

