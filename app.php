<?php 

class  App
{
public static function runTest()
{

echo "test";
 $ar= array('fruits'=> array('apple','banana','orange'),

                    'vegetables'=> array('carrot','broccoli','spinach')
                   );
            
                  
        $ar[0]= array('1'=> array('2'=>'test','new'=>'one') ,'2'=>'two');
         $ar[1]= array('3'=>'three','4'=>'four');
         $ar[2]= 'Test';

       
        function print_Recursive($ar){
                foreach($ar as $key => $value){
                    print "<pre>";
                    if(is_array($value)){
                        echo $key. " : \n";
                        print_Recursive($value)."\n";
                    }else{
                        echo $key. " : ". $value."\n";
                    }
                }
            }
         print_Recursive($ar);
           print "<pre>";
            print_r($ar);
}

}
 
 







?>