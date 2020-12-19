#include <stdlib.h>
#include <stdio.h>
#include <pthread.h>
#include <unistd.h>
#include <time.h> 

#define MAX 5
#define MAX_THREAD 4
//place arr, key and other variables as global to access from different thread
int *arr;
int key = 1;
int found = 0;
int part = 0;
void* binary_search(void* arg) {
   // There are four threads, each will take 1/4th part of the list
   int thread_part = part++;
   int mid;
   int start = thread_part * (MAX / 4); //set start and end using the thread part
   int end = (thread_part + 1) * (MAX / 4);
   // search for the key until low < high
   // or key is found in any portion of array
   while (start < end && !found) { //if some other thread has got the element, it will stop
      mid = (end - start) / 2 + start;
      if (arr[mid] == key) {
          found = 1;
      //   found = true;
         break;
      }
      else if (arr[mid] > key)
         end = mid - 1;
      else
         start = mid + 1;
   }
}
int main() {
   arr = malloc(MAX*sizeof(int));
   for (int i = 0; i < MAX; i++){ 
		arr[i] = rand(); 
   printf("%d ",arr[i]);
   }
   clock_t t1, t2; 

	t1 = clock(); 
   pthread_t threads[MAX_THREAD];
   for (int i = 0; i < MAX_THREAD; i++)
      pthread_create(&threads[i], NULL, binary_search, (void*)NULL);
   for (int i = 0; i < MAX_THREAD; i++)
      pthread_join(threads[i], NULL); //wait, to join with the main thread

      	t2 = clock(); 

   if (found){
   printf("%d found in array\n",key);
   }
   else{
      printf("%d not found in array\n",key);
   }
   printf("Time Taken: %f\n",(t2 - t1) / 
			(double)CLOCKS_PER_SEC);
}