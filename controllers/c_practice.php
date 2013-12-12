<?php 
class practice_controller extends base_controller{
      public function test1(){
		  require(APP_PATH.'/libraries/Image.php');
		  
          // echo APP_PATH."<br>";   generates the path of the app
		  // echo DOC_ROOT."<br>"; generates the root foler of the app
		  
		  $imageObj= new Image('http://placekitten.com/1000/1000');
		  $imageObj->resize(200,200);
         //$imageObj->display();

		  }

      public function test2(){
		  
		  # Static
		  echo Time::now();
		  }


}