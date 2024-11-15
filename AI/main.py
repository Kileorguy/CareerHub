from flask import Flask, jsonify, Response
import pandas as pd
import uuid
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

@app.route("/csv_data")
def get_csv_data():
    final_data = pd.read_csv('./final_data.csv')
    # data = final_data.to_dict(orient='records')
    return Response(final_data.to_json(orient="records"), mimetype='application/json')
    # return jsonify(data)

if __name__ == "__main__":
    app.run(debug=True)