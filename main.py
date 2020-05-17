# Importing modules
import serial
import os
import requests
import json
import urllib3
#from bs4 import BeautifulSoup
import spidev # To communicate with SPI devices
from numpy import interp    # To scale values
from time import sleep  # To add delay
import RPi.GPIO as GPIO # To use GPIO pins
# Start SPI connection
spi = spidev.SpiDev() # Created an object
spi.open(0,0)
# Initializing LED pin as OUTPUT pin
led_pin = 20
GPIO.setmode(GPIO.BCM)
GPIO.setup(led_pin, GPIO.OUT)
# Creating a PWM channel at 100Hz frequency
pwm = GPIO.PWM(led_pin, 100)
pwm.start(0)
# Read MCP3008 data
def analogInput(channel):
    spi.max_speed_hz = 1350000
    adc = spi.xfer2([1,(8+channel)<<4,0])
    data = ((adc[1]&3) << 8) + adc[2]
    return data
ser = serial.Serial ("/dev/ttyS0", 9600)
#waterlevelvals=[0,5,10,15,20,25,30,35,40]
actualheight=100
excessheight=0
while True:
    output = analogInput(0) # Reading from CH0
    #output=output*(5.0/1024.0)
    outputw=analogInput(1)
    #output1 = interp(output, [0, 1023], [0, 10])
    #output2 = interp(outputw, [0, 1023], [0, 10])
    output=(output/1023)*100
    print(output,outputw)
    if(outputw>=480 and outputw<530):
        excessheight=5
    elif(outputw>=530 and outputw<615):
        excessheight=10
    elif(outputw>=615 and outputw<660):
        excessheight=15
    elif(outputw>=660 and outputw<680):
        excessheight=20
    elif(outputw>=680 and outputw<690):
        excessheight=25
    elif(outputw>=690 and outputw<700):
        excessheight=30
    elif(outputw>=700 and outputw<705):
        excessheight=35
    elif(outputw>=705 and outputw<710):
        excessheight=40
    else:
        excessheight=0
    outputw=actualheight+excessheight
    #pwm.ChangeDutyCycle(output)
    sleep(1)
    received_data = ser.read()              #read serial port
    sleep(1)
    data_left = ser.inWaiting()             #check for remaining byte
    received_data += ser.read(data_left)
    received_data=str(received_data.decode("utf-8"))
    ph=received_data[received_data.index(":")+1:received_data.index(",")].strip()
    received_data=received_data[received_data.index(",")+1:]
    w=received_data[received_data.index(":")+1:received_data.index(",")].strip()
    received_data=received_data[received_data.index(",")+1:]
    l=received_data[received_data.index(":")+1:received_data.index(",")].strip()
    received_data=received_data[received_data.index(",")+1:]
    t=received_data[received_data.index(":")+1:received_data.index(",")].strip()
    #print (received_data.decode("utf-8  "))
    print (ph,w,l,t)
    http=urllib3.PoolManager()
    x=http.request('POST',"https://grievous-spot.000webhostapp.com/api/inswat.php?pH="+ph+"&turbidity="+str(output)+"&waterlevel="+str(outputw)+"&luminous="+l+"&temp="+t)
    print("---------")
    sleep(1)
