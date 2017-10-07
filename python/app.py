#!/usr/bin/env python

import socket
import requests
import time

TCP_IP = '127.0.0.1'
TCP_PORT = 3332
BUFFER_SIZE = 1024
MESSAGE = "Hello, World!"

url = "http://fitness.local/tcpcommand"
#url = 'http://fitness.twinsen.de/tcpcommand'
while 1:
    try:
        response = requests.get(url)
        data = response.json()
        message = data["command"]
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.connect((TCP_IP, TCP_PORT))
        s.send(message)
        #data = s.recv(BUFFER_SIZE)
        s.close()

        print "Sended Command " + str(message)
    except socket.error as msg:
        print "There was an error with sending the message: " + str(msg)
        pass
    time.sleep(1)






