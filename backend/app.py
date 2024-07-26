from flask import Flask, request, jsonify
from flask_cors import CORS
from modules.api import generate_code, generate_text
from dotenv import load_dotenv
from flask_sqlalchemy import SQLAlchemy
import stripe
import os

load_dotenv()

app = Flask(__name__)
CORS(app)

# Initialize the database
app.config['SQLALCHEMY_DATABASE_URI'] = os.environ.get("DATABASE_URL")
db = SQLAlchemy(app)

stripe.api_key = os.environ.get("STRIPE_API_KEY")

languages = ["java", "cpp", "python", "javascript", "php"]

class Purchase(db.Model):
  purchase_id = db.Column(db.Integer, primary_key=True)
  user_id = db.Column(db.Integer, nullable=False)
  username = db.Column(db.String(50), nullable=False)
  email = db.Column(db.String(45), nullable=True)
  phone_number = db.Column(db.String(20), nullable=False)
  purchase_plan = db.Column(db.String(50), nullable=False)

  def __repr__(self):
    return f"Purchase('{self.purchase_id}', '{self.user_id}', '{self.username}', '{self.email}', '{self.phone_number}', '{self.purchase_plan}')"

def convert_code(target_language):
  # Get the code snippet from the request
  data = request.get_json()
  
  if not data or "code" not in data:
    return jsonify({"error": "Missing code in request body"}), 400

  user_id = data["id"]
  code = data["code"]

  purchase = Purchase.query.filter_by(user_id=user_id).first()
  plan = purchase.purchase_plan if purchase is not None else None

  # Generate the converted code using GenerativeAI
  prompt = f"Convert the following {code} code to {target_language} and display the output."
  try:
    response = generate_code(contents=prompt)

    # Split the text into lines
    lines = response.splitlines()

    max_line = any(len(line) > 50 for line in lines)
    message = ""

    if max_line and purchase is None:
      print("The generated content contains lines exceeding 50 characters.")
      return jsonify({"error": f"The generated content contains lines exceeding 50 characters. \nPlease upgrade your subscription. \nPlease purchase a subscription to get more lines."}), 400

    if plan == 'Weekly':
      max_line = any(len(line) > 100 for line in lines)
      message = "The generated content contains lines exceeding 100 characters."
    elif plan == 'Monthly':
      message = "The generated content contains lines exceeding 150 characters."
      max_line = any(len(line) > 200 for line in lines)
    else:
      max_line = False

    if max_line and purchase is not None:
      print(message)
      return jsonify({"error": f"{message} \nPlease upgrade your subscription. \nPlease purchase a subscription to get more lines."}), 400

    code = response.split("Output:")[0].strip()
    output = response.split("Output:")[1].replace("```", "").strip()
  except Exception as e:
    return jsonify({"error": f"Error converting code: {str(e)}"}), 500

  # Return the converted code
  return jsonify(code, output)

@app.route("/api/convert/<target_language>", methods=["POST"])
def convert(target_language):
  """
  Converts Python code to the specified target language.

  Args:
      target_language: The target language (e.g., java, cpp)

  Returns:
      JSON response containing the converted code or an error message.
  """
  # Validate target language
  if target_language not in languages:
    return jsonify({"error": f"Unsupported target language: {target_language}"}), 400
  
  return convert_code(target_language)


@app.route("/api/chatbot", methods=["POST"])
def chatbot():
    # Extract the user's message from the request
    data = request.get_json()
    
    if not data or "message" not in data:
        return jsonify({"error": "Missing message in request body"}), 400

    user_message = data["message"]

    # Generate a response using a hypothetical function
    try:
        chat_response = generate_text(contents=user_message)
    except Exception as e:
        return jsonify({"error": f"Error generating chat response: {str(e)}"}), 500

    # Return the chatbot's response
    return jsonify(chat_response)

@app.route("/api/payment/intent", methods=["POST"])
def checkout():
    try:
        data = request.get_json()

        # Create a PaymentIntent with the order amount and currency
        intent = stripe.PaymentIntent.create(
            amount=data['product']['price'],
            currency='myr',
            # In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
            automatic_payment_methods={
                'enabled': True,
            },
        )

        return jsonify({
            'clientSecret': intent['client_secret']
        })
    except Exception as e:
        return jsonify(error=str(e)), 403

if __name__ == "__main__":
    app.run(debug=True)
