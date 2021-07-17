from gpiozero import Button
import time

# setup
pin = 18
input = Button(pin, False)

# Q [L/s] = fpulse/(5880).
def findLPS(input):
    count = 0
    interval = 0.1
    t_end = time.time() + interval
    while(time.time()<t_end):
        if(input.value):
            count+=1
    return count/5880*interval

def storeLPS(lps):
    f = open("lps.txt", "w")
    f.write(str(lps))
    f.close()


while 1:
    lps = findLPS(input)
    print(lps)
    storeLPS(lps)
