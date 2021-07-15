from gpiozero import Button
import time

# setup
pin = 24
input = Button(2)

# Q [L/s] = fpulse/(5880).
def findLPS(input):
    count = 0
    t_end = time.time() + 0.1
    while(time.time()<t_end):
        if(input.when_pressed):
            count+=1
    return count/588

def storeLPS(lps):
    f = open("lps.txt", "w")
    f.write(lps)
    f.close()


while 1:
    storeLPS(findLPS(input))
    sleep(0.1)