// CPP code to search for element in a 
// very large file using Multithreading 
#include <stdlib.h>
#include <stdio.h>
#include <pthread.h>
#include <unistd.h>
#include <time.h> 


// Max size of array 
#define max 100000 

// Max number of threads to create 
#define thread_max 4 

//int a[max] = { 6, 8, 9, 10, 13, 16, 17, 
	//		19, 21, 23, 26, 28, 37, 
	//		54, 90, 280 }; 
int key = 202; 
int *a;

// Flag to indicate if key is found in a[] 
// or not. 
int f = 0; 

int current_thread = 0; 

// Linear search function which will 
// run for all the threads 
void* ThreadSearch(void* args) 
{ 
	int num = current_thread++; 

	for (int i = num * (max / 4); 
		i < ((num + 1) * (max / 4)); i++) 
	{ 
		if (a[i] == key) 
			f = 1; 
	} 
} 

// Driver Code 
int main() 
{ 
a = malloc(max*sizeof(int));
for (int i = 0; i < max; i++) 
		a[i] = rand(); 
 clock_t t1, t2; 
	t1 = clock(); 
	pthread_t thread[thread_max]; 
	
	for (int i = 0; i < thread_max; i++) { 
		pthread_create(&thread[i], NULL, 
					ThreadSearch, (void*)NULL); 
	} 

	for (int i = 0; i < thread_max; i++) { 
		pthread_join(thread[i], NULL); 
	} 

	      	t2 = clock(); 


	if (f == 1) 
    printf("%s\n","Key element found");
	else
    printf("%s\n","Key not present found");
	  printf("Time Taken: %f\n",(t2 - t1) / 
			(double)CLOCKS_PER_SEC);
	return 0; 
} 
