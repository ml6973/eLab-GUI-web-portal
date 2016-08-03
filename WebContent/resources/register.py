import MySQLdb
import json
import requests
import sys
import time

url = sys.argv[1]

body = {
	"api_uname":"webportal", 
	"api_pass":"greg123",
	"username":sys.argv[2],
	"email":sys.argv[3],
	"preferred_pass":sys.argv[4],
	"external_id":sys.argv[5]
}

my_headers = {"Content-Type": 'application/json'}

json_body = json.dumps(body)

while True:
	r = requests.post(url, json_body, headers=my_headers)
	if (r.status_code == requests.codes.created):
		break
	elif (r.status_code == requests.codes.SERVICE_UNAVAILABLE):
		time.sleep(7200)
	else:
		time.sleep(120)

if len(sys.argv) == 9:
	cnx = MySQLdb.connect(host='127.0.0.1', db=sys.argv[6], user=sys.argv[7], passwd=sys.argv[8])
else:
	cnx = MySQLdb.connect(host='127.0.0.1', db=sys.argv[6], user=sys.argv[7])
cursor = cnx.cursor()

query = ("UPDATE Registration SET complete = true WHERE userId = " + sys.argv[5])

cursor.execute(query)
cnx.commit()
cursor.close()
cnx.close()
exit()
