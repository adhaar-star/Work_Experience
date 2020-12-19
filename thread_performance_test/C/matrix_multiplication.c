// C Program to multiply two matrix using pthreads 
#include <stdlib.h>
#include <stdio.h>
#include <pthread.h>
#include <unistd.h>
#include <time.h> 



// maximum size of matrix 
#define MAX 100 

// maximum number of threads 
#define MAX_THREAD 4 

int matA[MAX][MAX]; 
int matB[MAX][MAX]; 
int matC[MAX][MAX]; 
int step_i = 0; 

void* multi(void* arg) 
{ 
	int core = step_i++; 
    int start = core * MAX / 5;
	int end = (core + 1) * MAX / 5;
	//printf("core=%d\n",core);
	// Each thread computes 1/4th of matrix multiplication 
	for (int i = start; i < end; i++) 
		for (int j = 0; j < MAX; j++) 
			for (int k = 0; k < MAX; k++) 
				matC[i][j] += matA[i][k] * matB[k][j]; 

                return NULL;
} 

// Driver Code 
int main() 
{ 
	// Generating random values in matA and matB 
	for (int i = 0; i < MAX; i++) { 
		for (int j = 0; j < MAX; j++) { 
			matA[i][j] = rand() % 10; 
			matB[i][j] = rand() % 10; 
		} 
	} 

	// Displaying matA 
	
        printf("%s\n","Matrix A");
	for (int i = 0; i < MAX; i++) { 
		for (int j = 0; j < MAX; j++) 
        printf("%d\t",matA[i][j]);
         printf("%s\n"," ");
		//	cout << matA[i][j] << " "; 
		//cout << endl; 
	} 

	// Displaying matB 
   printf("%s\n","Matrix B");
	for (int i = 0; i < MAX; i++) { 
		for (int j = 0; j < MAX; j++) 
           printf("%d\t",matB[i][j]);
         printf("%s\n"," ");
			//cout << matB[i][j] << " ";		 
		//cout << endl; 
	} 

 clock_t t1, t2; 

	t1 = clock(); 
	// declaring four threads 
	pthread_t threads[MAX_THREAD]; 

	// Creating four threads, each evaluating its own part 
	for (int i = 0; i < MAX_THREAD; i++) { 
		int* p; 
		pthread_create(&threads[i], NULL, multi, (void*)(p)); 
	} 

	// joining and waiting for all threads to complete 
	for (int i = 0; i < MAX_THREAD; i++) 
		pthread_join(threads[i], NULL);	 

      	t2 = clock(); 

	// Displaying the result matrix 
     printf("\n");
      printf("%s\n","Multiplication of A and B");
	//cout << endl 
    
		//<< "Multiplication of A and B" << endl; 
	for (int i = 0; i < MAX; i++) { 
		for (int j = 0; j < MAX; j++) 
          printf("%d\t",matC[i][j]);
         printf("%s\n"," ");
		//	cout << matC[i][j] << " ";		 
		//cout << endl; 
	} 
	  printf("Time Taken: %f\n",(t2 - t1) / 
			(double)CLOCKS_PER_SEC);
	return 0; 
} 
