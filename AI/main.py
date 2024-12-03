from flask import Flask, jsonify, Response, request
import pandas as pd
from flask_cors import CORS
import json
import os
from dotenv import load_dotenv
import heapq
import pymysql
from sklearn.metrics.pairwise import cosine_similarity
from sklearn.feature_extraction.text import CountVectorizer
from nltk import  word_tokenize
import string
import pandas as pd
from nltk.stem import PorterStemmer, WordNetLemmatizer
from nltk.tag import pos_tag

app = Flask(__name__)
CORS(app)

final_data = pd.read_csv('./final_data.csv')
port = PorterStemmer()
wnl = WordNetLemmatizer()

load_dotenv()
db_host = os.getenv('DB_HOST')
db_port = os.getenv('DB_PORT')
db_username = os.getenv('DB_USERNAME')
db_password = os.getenv('DB_PASSWORD')
db_database = os.getenv('DB_DATABASE')

class MaxHeapObj(object):
        def __init__(self, val): 
            self.val = val
        def __lt__(self, other): 
            col,cos = self.val
            col1,cos1 = other.val
            return cos > cos1
        def __eq__(self, other): 
            col,cos = self.val
            col1,cos1 = other.val
            return cos == cos1
def get_label(tag):
    if tag == 'jj':
        return 'a'
    elif tag in ['vb','nn','rb']:
        return tag[0]
    else:
        return None

def lemma(word_list):
    lem = []
    tags = pos_tag(word_list)
    for word, tag in tags:
        label = get_label(tag.lower())
        if(label!=None):
            lem.append(wnl.lemmatize(word,label))
        else:
            lem.append(wnl.lemmatize(word))

    return lem

def preProcess(text):
    tokenized = word_tokenize(text)
    tokenized = [port.stem(word) for word in tokenized if word.isalpha()]
    tokenized = lemma(tokenized)
    return tokenized

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
    to_string_data = ''.join(data.values())
    splitted = to_string_data.split(',')
    for idx,i in enumerate(splitted):
        string_data = i
        if string_data[0] ==' ':
            splitted[idx] = i[1:]

    return Response(json.dumps(splitted), status=200, mimetype='application/json')

@app.route("/get_user_recommendation")
def recommend():
    # user_id = '95b068aa-4320-38cf-bdfe-ed189b9d72fa'
    user_id = request.args.get('user_id') 

    conn = pymysql.connect(host=db_host, port=int(db_port), user=db_username, passwd=db_password, db=db_database)
    skills_dict = {}
    cur = conn.cursor()
    cur.execute('SELECT c.id, skill_name from companies as c JOIN company_jobs cj ON c.id = cj.company_id JOIN job_skills js ON js.job_id = cj.id')

    for row in cur:
        if skills_dict.get(row[0],'') in ('', None):
            skills_dict[row[0]] = ''.join(row[1].lower())
        else:
            final_string = skills_dict.get(row[0]) + ' ' + row[1].lower()
            skills_dict[row[0]] = final_string

    cur.close()

    user_skills_merged = ''


    cur = conn.cursor()
    cur.execute('SELECT skill_name FROM `user_skills` WHERE user_id = \''+ user_id+'\'')
    for row in cur:
        user_skills_merged = user_skills_merged + ' '+  row[0].lower()
    cur.close()

    

    vectorizer = CountVectorizer(tokenizer=preProcess,stop_words='english', binary=True) 
    sparse_matrix = vectorizer.fit_transform(list(skills_dict.values()))

    df = pd.DataFrame(
    sparse_matrix.todense(),
    columns=vectorizer.get_feature_names_out(),
    index=skills_dict.keys(),
    )

    sparse_matrix_user = vectorizer.transform([user_skills_merged])
    df_user = pd.DataFrame(
        sparse_matrix_user.todense(),
        columns=vectorizer.get_feature_names_out(),
        index = [user_id]
    )

    

    cosine_result = cosine_similarity(df,df_user)
    heap_result = []
    for col,cos in zip(df.index,cosine_result):
        data = (col,cos)
        heapq.heappush(heap_result, MaxHeapObj(data))


    result_arr =[]
    for i in range(5):
        res = heapq.heappop(heap_result).val
        if res:
            print(res)
            result_arr.append(res[0])
    
    conn.close()
    return Response(json.dumps(result_arr), status=200, mimetype='application/json')


if __name__ == "__main__":
    app.run(debug=True)