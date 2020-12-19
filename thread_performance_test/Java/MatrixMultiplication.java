import java.util.*;
import java.time.*;
import java.math.BigDecimal;


class MatrixMultiplication extends Thread {
    static int MAX = 1000;
    static int MAX_THREAD = 4;

    static int matA[][];
    static int matB[][];
    static int matC[][];
    static int step_i = 0;


    public void run(){
        int core = step_i++; 

	// Each thread computes 1/4th of matrix multiplication 
	for (int i = core * MAX / 5; i < (core + 1) * MAX / 5; i++) 
		for (int j = 0; j < MAX; j++) 
			for (int k = 0; k < MAX; k++) 
				matC[i][j] += matA[i][k] * matB[k][j]; 

              
    }
    public static void main(String [] args){

        matA = new int[MAX][MAX];
        matB = new int[MAX][MAX];
        matC = new int[MAX][MAX];

        Random rand = new Random();

        for (int i = 0; i < MAX; i++) { 
            for (int j = 0; j < MAX; j++) { 
                matA[i][j] = rand.nextInt(10); 
                matB[i][j] = rand.nextInt(10); 
            } 
        } 

        System.out.println("Matrix A");
        for (int i = 0; i < MAX; i++) { 
            for (int j = 0; j < MAX; j++){
                System.out.print(matA[i][j]+" ");
            }
            System.out.println();
        }

        System.out.println("Matrix B");
        for (int i = 0; i < MAX; i++) { 
            for (int j = 0; j < MAX; j++){
                System.out.print(matB[i][j]+" ");
            }
            System.out.println();
        }
        long startTime = System.nanoTime();   

        try{
            List<Thread> threads = new ArrayList<>(MAX_THREAD);
      
              for (int x = 0; x < MAX_THREAD; x++) {
                  Thread t = new Thread(new MatrixMultiplication());
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


          System.out.println();
          System.out.println("Multiplication of A and B");
          for (int i = 0; i < MAX; i++) { 
            for (int j = 0; j < MAX; j++){
                System.out.print(matC[i][j]+" ");
            }
            System.out.println();
        }
        System.out.println("Time Taken: "+BigDecimal.valueOf(seconds).toPlainString());

    }



}