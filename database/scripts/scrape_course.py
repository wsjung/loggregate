from bs4 import BeautifulSoup
from requests import get
import time
import sqlite3

# constants
SQLITE_FILE = './../database.sqlite'
# SQLITE_FILE = './foo.sqlite'
URL='https://www.coursicle.com/pugetsound/courses/'

# sqlite db connection
connection = sqlite3.connect(SQLITE_FILE)
cursor = connection.cursor()
print('database connection opened')

# GET request the URL
response = get(URL).text

# beautiful soup
soup = BeautifulSoup(response, features='html.parser')

# extract list of departments
depts = soup.find_all('span', {'class' : 'tileElementText'})
depts = [d.text for d in depts]

print(depts)

for dept in depts:
	print(dept, flush=True)

	# response
	dept_resp = get(URL + dept).text
	# print(dept_resp)

	# soup creation
	dept_soup = BeautifulSoup(dept_resp, features='html.parser')

	# course numbers
	courses = dept_soup.find_all('span', {'class' : 'tileElementText'})
	courses = [c.text for c in courses]

	subjects = [c.split()[0] for c in courses]
	nums = [c.split()[1] for c in courses]

	# course titles
	titles = dept_soup.find_all('div', {'class' : 'tileElementHiddenText'})
	titles = [t.text.replace("\"","'") for t in titles]

	for s,n,t in zip(subjects,nums,titles):
		print("insert into Courses(subject, courseNum, name) values ('%s',%s,'%s')" % (s,n,t), flush=True)
		cursor.execute("insert into Courses(subject, courseNum, name) values ('%s',%s,\"%s\")" % (s,n,t))

connection.commit()
print('database changes committed')
connection.close()
print('database connection closed')