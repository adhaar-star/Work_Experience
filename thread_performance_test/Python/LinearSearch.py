import threading
import random
import time 
THREAD_MAX = 4
found = 0
MAX = 100000
current_part = 0
def linear_search(arr, x): 
    global found
    global current_part
    num = current_part
    current_part = current_part+1
    start = int(num*(MAX/4))
    end = int((num+1)*(MAX/4))
    for i in range(start,end): 
  
        if arr[i] == x:
            found=1    
            return 
  


if __name__ == '__main__': 
# Test array 
    search_arr = [] 
    x = 60

    for x in range(MAX): 
      search_arr.append(random.randint(0, 2147483647)%100)
  
# Function call
    start_time = time.time() 
    Threads = []
    # starting threads
    for d in range(THREAD_MAX):
        t = threading.Thread(target=linear_search, args=(search_arr,x))
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