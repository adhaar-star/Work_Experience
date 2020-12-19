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

public class LinearSearch extends Thread{

     //   private int result;
        private int search_array[];
        private int key;
        static int found = 0;
        static int current_thread = 0;
        static int max = 100000;

    

    static int array[] = new int[max];

static int search_key = 8; 




public void run(){
    int num = current_thread++;
    for (int i = num * (max / 4); 
		i < ((num + 1) * (max / 4)); i++) 
	{ 
   // for (int i = 0; i < search_array.length; i++) {
        
                if(array[i]==search_key){
                //    System.out.println("found");
                    found = 1;
                }  
        
                }
            }
 



    public static void main(String [] args){
        
        int numberOfThreads = 4;
int is_present = 0;

Random rand = new Random();

        for(int x=0;x<max;x++){
           array[x] = rand.nextInt();
        }

long startTime = System.nanoTime();   

try{
      List<Thread> threads = new ArrayList<>(numberOfThreads);

        for (int x = 0; x < numberOfThreads; x++) {
            Thread t = new Thread(new LinearSearch());
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