import java.util.*;
import java.math.BigDecimal;


/*
class MyTask extends Thread{
private int return_value;
private int search_array[];

public MyTask(int array[] ,int key){

}


}
*/

public class BinarySearch extends Thread{

     //   private int result;
        private int search_array[];
        static int found = 0;
        static int current_thread = 0;
        static int MAX = 100000;
        static int part = 0;

    

  //  static int arr[] = { 1, 6, 8, 11, 13, 14, 15, 19, 21, 23, 26, 28, 31, 65, 108, 220  }; 
           static int arr[] = new int[MAX];
static int search_key = 315; 




public void run(){
   
                int thread_part = part++;
   int mid;
   int start = thread_part * (MAX / 4); //set start and end using the thread part
   int end = (thread_part + 1) * (MAX / 4);
   // search for the key until low < high
   // or key is found in any portion of array
   while (start < end && found==0) { //if some other thread has got the element, it will stop
      mid = (end - start) / 2 + start;
      if (arr[mid] == search_key) {
          found = 1;
      //   found = true;
         break;
      }
      else if (arr[mid] > search_key)
         end = mid - 1;
      else
         start = mid + 1;
   }
            }
 



    public static void main(String [] args){
        
        int numberOfThreads = 4;
        long startTime = System.nanoTime();   
        Random rand = new Random();

        for(int x=0;x<MAX;x++){
           arr[x] = rand.nextInt();
        }

try{
      List<Thread> threads = new ArrayList<>(numberOfThreads);

        for (int x = 0; x < numberOfThreads; x++) {
            Thread t = new Thread(new BinarySearch());
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

    long endTime = System.nanoTime(); 
          
    long elapsedTime = endTime - startTime;


    double seconds = (double)elapsedTime / 1000000000;

       if(found==1){
System.out.println("Key Element Found");
       }
       else{
        System.out.println("Key Element Not Present");
       }
         
       System.out.println("Time Taken: "+BigDecimal.valueOf(seconds).toPlainString());

  // LinearSearch result = new LinearSearch();
   //System.out.println("Found " + t.getResult());





}
}