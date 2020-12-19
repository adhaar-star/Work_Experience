import threading 
import random
import time

# Python program for implementation of MergeSort
MAX = 100000    
THREAD_MAX = 4
part = 0 
a = {}
def mergeSort(arr):
    if len(arr) > 1:
 
         # Finding the mid of the array
        mid = len(arr)//2
 
        # Dividing the array elements
        L = arr[:mid]
 
        # into 2 halves
        R = arr[mid:]
 
        # Sorting the first half
        mergeSort(L)
 
        # Sorting the second half
        mergeSort(R)
 
        i = j = k = 0
 
        # Copy data to temp arrays L[] and R[]
        while i < len(L) and j < len(R):
            if L[i] < R[j]:
                arr[k] = L[i]
                i += 1
            else:
                arr[k] = R[j]
                j += 1
            k += 1
 
        # Checking if any element was left
        while i < len(L):
            arr[k] = L[i]
            i += 1
            k += 1
 
        while j < len(R):
            arr[k] = R[j]
            j += 1
            k += 1
 
# Code to print the list

def merge(low, mid, high):
    left_length = mid-low+1
    right_length = high-mid
    left = {}
    right = {}
    n1 = mid-low+1
    n2 = high - mid
    for i  in range(n1):
        left.append(a[i+low])

    for i in range(n2):
        right.append(a[i+mid+1])

    k = low
    i = j = 0

    while(i<n1 and j<n2):
        if(left[i] <= right[j]):
            a[k+1] = left[i+1]
        else:
            a[k+1] = right[j+1]

    while(i<n1):
        a[k+1] = left[i+1]

    while(j<n2):
        a[k+1] = right[j+1]





def merge_sort2(low, high):
    mid = low + (high-low)/2
    if(low<high):
        merge_sort2(low,mid)
        merge_sort2(mid+1,high)
        merge(low,mid,high)

 
def merge_sort():
    thread_part = part+1

    low = thread_part * (MAX /4)
    high = (thread_part+1) * (MAX /4)-1

    mid = low + (high-low)/2
    if(low<high):
        merge_sort2(low, mid)
        merge_sort2(mid+1, high)
        merge_sort(low, mid, high)


    
 
def printList(arr):
    for i in range(len(arr)):
        print(arr[i], end=" ")
    print()
 
 
# Driver Code
if __name__ == '__main__':
    sort_array = []
    for x in range(MAX): 
      sort_array.append(random.randint(0, 2147483647)%100)
    print("Given array is", end="\n")
    printList(sort_array)
    start_time = time.time()
    Threads = []
    # starting threads
    for x in range(THREAD_MAX):
      t = threading.Thread(target=mergeSort, args=(sort_array,))
      Threads.append(t)
      t.start() 
    
   # wait until all threads are completely executed 
    for x in range(THREAD_MAX):
       Threads[x].join()
    end_time = time.time()
    print("Sorted array is: ", end="\n")
    printList(sort_array)
    print("Time taken:", end_time - start_time, "seconds.")
 