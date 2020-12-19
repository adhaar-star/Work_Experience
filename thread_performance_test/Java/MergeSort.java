import java.util.*;
import java.time.*;
import java.math.BigDecimal;




public class MergeSort extends Thread{
    static int MAX = 100000;
    static int THREAD_MAX = 4;
    static int initial_time;
    private int final_time;
    static int part = 0;
    
    static int sort_array[];

   


    void merge(int low, int mid, int high) 
{ 
 
   // int *left = malloc(left_length*sizeof(int));
	int left[] = new int[mid - low + 1]; 
    int right[] = new int[high - mid]; 
	// n1 is size of left part and n2 is size 
	// of right part 
	int n1 = mid - low + 1, n2 = high - mid, i, j; 

	// storing values in left part 
	for (i = 0; i < n1; i++) 
		left[i] = sort_array[i + low]; 

	// storing values in right part 
	for (i = 0; i < n2; i++) 
		right[i] = sort_array[i + mid + 1]; 

	int k = low; 
	i = j = 0; 

	// merge left and right in ascending order 
	while (i < n1 && j < n2) { 
		if (left[i] <= right[j]) 
        sort_array[k++] = left[i++]; 
		else
        sort_array[k++] = right[j++]; 
	} 

	// insert remaining values from left 
	while (i < n1) { 
		sort_array[k++] = left[i++]; 
	} 

	// insert remaining values from right 
	while (j < n2) { 
		sort_array[k++] = right[j++]; 
	} 
} 

   public void merge_sort2(int low, int high) 
    { 
        // calculating mid point of array 
        int mid = low + (high - low) / 2; 
        if (low < high) { 
    
            // calling first half 
            merge_sort2(low, mid); 
    
            // calling second half 
            merge_sort2(mid + 1, high); 
    
            // merging the two halves 
            merge(low, mid, high); 
        } 
    } 

    
    
    public void run(){
//System.out.println("part-"+part);
        int thread_part = part++; 

	

	// calculating low and high 
	int low = thread_part * (MAX / 4); 
	int high = (thread_part + 1) * (MAX / 4) - 1; 

	// evaluating mid point 
	int mid = low + (high - low) / 2; 
	if (low < high) { 
		merge_sort2(low, mid); 
		merge_sort2(mid + 1, high); 
		merge(low, mid, high); 
	} 

    }
    public static void main(String [] args){
        int numberOfThreads = 4;
       sort_array = new int[MAX]; 
        
       Random rand = new Random();
        for (int i = 0; i < MAX; i++) 
        sort_array[i] =  rand.nextInt(100) ; 

        System.out.println("Before Array");
        for(int i=0;i<MAX;i++){
            System.out.print(sort_array[i]);
            System.out.print(" ");
        }
        
       long startTime = System.nanoTime();   

        try{
            List<Thread> threads = new ArrayList<>(numberOfThreads);
      
              for (int x = 0; x < numberOfThreads; x++) {
                  Thread t = new Thread(new MergeSort());
                  t.start();
      
      
                 threads.add(t);
                
                    
              // System.out.println("Get Result: " + t.getResult());
              
              }
              for (Thread t : threads) {
                  t.join();
               }
              
          }catch (Exception e) {
              e.printStackTrace();
          }  
      
          MergeSort m = new MergeSort();

       m.merge(0, (MAX / 2 - 1) / 2, MAX / 2 - 1); 
        m.merge(MAX / 2, MAX/2 + (MAX-1-MAX/2)/2, MAX - 1); 
        m.merge(0, (MAX - 1)/2, MAX - 1); 

      long endTime = System.nanoTime();  

      long elapsedTime = endTime - startTime;

      double seconds = (double)elapsedTime / 1000000000;
    
       // initial_time = t1.instant(); 
       System.out.println();
       System.out.println("Sorted Array");
       for(int i=0;i<MAX;i++){
           System.out.print(sort_array[i]);
           System.out.print(" ");
       }
       
       System.out.println("Time Taken: "+BigDecimal.valueOf(seconds).toPlainString());
      
    }


}