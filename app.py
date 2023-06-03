import os
import json
import psycopg2
from flask import Flask, render_template
app = Flask(__name__)
conn = psycopg2.connect(
host="localhost",
database="constructora",
user='postgres',
password='123')

@app.route('/factura')
def index():
    cur = conn.cursor()
    cur.execute("select factura from factura;")
    factura = cur.fetchall()
    cur.close()
    conn.close()
    return factura

