<?php
/**
 * @package Vending
 * @author Kekoa Vincent kekoa@pacificblueweb.com
 * @version 0.1
 * @filesource
*/

/**
 * Timer class that acts as a stopwatch to see how long execution takes.
 * 
 */

class Timer {
	private $startTime;
	private $endTime;

	/**
	 * Constructor - starts the timer upon object creation
	 */
	public function __construct() {
		self::Start();
	}

	/**
	 * Manual clock start function.  If clock is running, it resets and starts the clock
	 */
	public function Start() {
		$this->startTime = microtime(true);
		$this->endTime = 0;
		return $this->startTime;
	}

	/**
	 * Manual clock stop function.
	 */
	public function Stop() {
		$this->endTime = microtime(true);
		return self::GetElapsed();
	}

	/**
	 * Returns the number of seconds that have elapsed.  If the timer is still running, 
	 * it returns the current running time elapsed.  If it is stopped, it uses the time
	 * that was recorded when it was stopped.
	 *
	 * @return float The number of seconds that have elapsed.
	 */
	public function GetElapsed() {
		if(!$this->endTime) {
			return microtime(true) - $this->startTime;
		} else {
			return ($this->endTime - $this->startTime);
		}
	}
}

?>