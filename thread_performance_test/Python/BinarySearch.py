import threading
import random
import time 
THREAD_MAX = 4
found = 0
MAX = 100000
part = 0
def binary_search(arr, x):
    global found
    global part 
    thread_part = part
    part=part+1
    mid = 0
    start = int(thread_part * (MAX / 4))
    end = int((thread_part + 1) * (MAX / 4))

    while(start<end):
        mid = int((end-start)/2+start)
        if(arr[mid]==x):
            found=1
            return
        elif (arr[mid]>x):
            end = mid-1
        else:
            start = mid+1  

  
if __name__ == '__main__': 
# Test array 
    search_arr = [] 
    x = 1
  
    for x in range(MAX): 
       search_arr.append(random.randint(0, 2147483647)%100)
# Function call
    start_time = time.time() 
    Threads = []
    # starting threads
    for d in range(THREAD_MAX):
        t = threading.Thread(target=binary_search, args=(search_arr,x))
        Threads.append(t)
        t.start()    

    for q in range(THREAD_MAX):
        Threads[q].join()
    end_time = time.time()   

    if found != 0: 
        print("Element is present in array") 
    else: 
        print("Element is not present in array")

    print("Time taken:", end_time - start_time, "seconds.")     