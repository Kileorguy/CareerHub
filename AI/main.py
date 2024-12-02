from flask import Flask, jsonify, Response, request
import pandas as pd
from flask_cors import CORS
import json

app = Flask(__name__)
CORS(app)

final_data = pd.read_csv('./final_data.csv')

@app.route("/csv_data")
def get_csv_data():
    # data = final_data.to_dict(orient='records')
    return Response(final_data.to_json(orient="records"), mimetype='application/json')
    # return jsonify(data)

@app.route("/job_skills")
def get_job_skills():
    id = request.args.get('id') 
    
    skills = final_data[['id','job_skills']]
    cond = skills['id'] == id
    res = final_data.loc[cond,'job_skills']

    data = json.loads(res.to_json())
    if not data:
        return ''
    splitted = data['0'].split(',')
    for idx,i in enumerate(splitted):
        string_data = i
        if string_data[0] ==' ':
            splitted[idx] = i[1:]

    return splitted

if __name__ == "__main__":
    app.run(debug=True)