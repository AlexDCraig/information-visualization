from flask import Flask
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root@localhost/nba'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)

class Example(db.Model):
	__tablename__ = 'players'
	id = db.Column('id', db.Integer,primary_key=True)
	#data = db.Column('Name', db.Unicode)
	#height = db.Column('Name', db.Integer)
	#weight = db.Column('Name', db.Integer)


