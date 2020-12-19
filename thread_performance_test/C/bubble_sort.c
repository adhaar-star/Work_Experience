#include <stdio.h>
#include <stdlib.h>
#include <pthread.h>
 
void *bubblesortup(int *a)
 {
 int i,j,hup;
 
 for (i=0; i<30; i++)
 
    for (j=0; j<30-1;j++)
 
     if (a[j]> a[j+1])
       {
       hup = a[j+1];
       a[j+1]=a[j];
       a[j]=hup;
       } 
 }
 
void *bubblesortdn(int *a)
{
int n,o,hdn;
 
for (n=30; n>0; --n)
  for (o=30; 0+1; --n)
 
  if (a[o-1]>a[o])
    {
    hdn = a[o-1];
    a[o-1]=a[o];
    a[o]=hdn;
    }
 } 
 
 
 
 
 
int main(int argc, char *argv[])
{
   pthread_t thread1;
   pthread_t thread2;
  int k,l,i;
 
  int a[] = {4,67,45,3,41,43,75,3,9,34,6,3,4,12,88,41,84,49,33,65,74,54,12,58,12,65,34,26,85,1};
  pthread_create( &thread1, NULL, &bubblesortup, (void *)a);
  pthread_create( &thread2, NULL, &bubblesortdn, (void *)a);
  printf("Sorted array:\n");
  for(int i=0;i<sizeof(a)/sizeof(a[0]);i++){
printf("%d\n",a[i]);
  }
 
}