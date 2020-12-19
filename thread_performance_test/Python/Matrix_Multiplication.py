
import threading
import random
import time


THREAD_MAX = 4
MAX = 1000
step_i = 0
matA = []
matB = []
matC = []
  
def multi(matA,matB,matC):
    global step_i
    core = step_i
    step_i = step_i+1
    start = int(core * MAX / 5)
    end = int((core + 1) * MAX / 5)

    for i in range(start,end):
        for j in range(0,MAX):
            for k in range(0,MAX):
                matC[i][j] += matA[i][k] * matB[k][j]


    return                


if __name__ == '__main__': 
# Test array 

    
  
# Function call 
    
    # starting threads
    for r in range(0, MAX):
        matA.append([random.randint(0, 2147483647)%10 for c in range(0, MAX)])

    for r in range(0, MAX):
        matB.append([random.randint(0, 2147483647)%10 for c in range(0, MAX)])


    for r in range(0, MAX):
       matC.append([0 for c in range(0, MAX)])    

    
    
    start_time = time.time()

    Threads = []
   
    for q in range(THREAD_MAX):
        t = threading.Thread(target=multi, args=(matA,matB,matC))
        Threads.append(t)
        t.start()

    for q in range(THREAD_MAX):    
        Threads[q].join()

    print()
    print("Matrix A")

    for i in range(0,MAX):
        for j in range(0,MAX):
            print(matA[i][j], end =" ")
        print()    

    print()
    print("Matrix B")

    for i in range(0,MAX):
        for j in range(0,MAX):
            print(matB[i][j], end =" ")
        print()    
                      

 
    print()
    print("Multiplication of A and B")

    for i in range(0,MAX):
        for j in range(0,MAX):
            print(matC[i][j], end =" ")
        print()

    print("Time taken:", time.time() - start_time, "seconds.")
        
           
