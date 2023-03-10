<?php

namespace App;

class ArabicToRoman
{
    /**
     * Receive an arabic number and return a string with its roman counterpart
     *
     * @param int $arabicNumber Arabic number to be transformed (e.g. 121)
     *
     * @return string The roman number equivalent (e.g. CXXI)
     */
    public static function transform(int $arabicNumber): string
    {
        $romanNumber = '';




        if($arabicNumber >= 1000 || $arabicNumber <= 0){
            return 'el número no es válido';
        }
               
        //comprobamos que el numero no tenga valor fijo
        $romanNumber = self::numbers($arabicNumber);




        //si no tiene valor fijo
        if($romanNumber == ''){
            //separamos el numero en 1 posicion
            $separarNumero = str_split($arabicNumber,1);      
       
            //recorremos el array
            foreach($separarNumero as $key => $value){
                //comprobamos que el numero no sea 0
                if($value != 0){
                    //hayamos la posicion del número
                    $checkPosition = self::checkPosition($key,$value,$separarNumero);




                    $number = intval($checkPosition['number']);
                    $position = $checkPosition['position'];
               
                    //comprobamos si el numero tiene valor fijo
                    $letter = self::numbers($number);
                   
                    //si no tiene valor fijo realizamos los calculos
                    if($letter == ''){
                        $letter = self::checkNumber($number,$position);
                    }


                    //concatenamos el número
                    $romanNumber = $romanNumber.$letter;
                }
               
            }
           
        }
       
        return $romanNumber;
    }


   
    /**
     * Recibe un número árabico y comprueba si contiene valor
     *
     * @param int $number
     *
     * @return string Número romano equivalente
     */
   
    public static function numbers($number){




        switch($number){
            case 1:
                $letter = 'I';
                break;
            case 5:
                $letter = 'V';
                break;
            case 10:
                $letter = 'X';
                break;
            case 50:
                $letter = 'L';
                break;
            case 100:
                $letter = 'C';
                break;
            case 500:
                $letter = 'D';
                break;
            case 1000:
                $letter = 'M';
                break;  
            default:
                $letter = '';
                break;
        }




        return $letter;
    }




    /**
     * Recibe un numero y la posicion del numero
     *
     * @param int $number
     *
     * @param int $position
     *
     * @return string The roman number equivalent (e.g. CXXI)
     */


    public static function checkNumber($number,$position){


        //hayamos los valores de los números principales
        $letrasPrincipales = self::valuePosition($position);


        //comprobamos si el número es menor al valor intermedio
        if($number<$letrasPrincipales['intermediateValue']){
           
            //si el valor del número es menor de 1 del valor intermedio
            if($number == ($letrasPrincipales['intermediateValue']-$letrasPrincipales['value'])){
                //concatenamos la letra de menor valor con la letra intermedia
                $letter = $letrasPrincipales['smallLetter'].$letrasPrincipales['middleLetter'];
            }else{


                $letter = '';              
               
                $counter = 0;
                //realizamos un bucle no mas de 3 veces hasta hayar el numero
                for($i = 0;$i <=($letrasPrincipales['valueSmall']+3);$i++){
                    //si el numero no es correcto, añadimos la letra de menor valor hasta que el numero sea correcto
                    if($number == $counter){
                        break;
                    }else{
                        $letter = $letter.$letrasPrincipales['smallLetter'];
                        //controlamos que la suma se realize con el valor adecuado según la posición del número
                        $counter = $counter+$letrasPrincipales['value'];
                    }
                }
            }




        }else{
            //comprobamos si el valor del número es menor de 1 del valor mayor
            if($number == ($letrasPrincipales['bigValue']-$letrasPrincipales['value'])){
                //concatenamos la letra de menor valor con la letra mayor
                $letter = $letrasPrincipales['smallLetter'].$letrasPrincipales['bigLetter'];
            }else{
                //comenzamos con la letra intermedia
                $letter = $letrasPrincipales['middleLetter'];
                //controlamos que el contador comienze con el valor intermedio
                $counter = $letrasPrincipales['intermediateValue'];


                //realizamos un bucle no mas de 3 veces hasta hayar el numero
                for($i = $letrasPrincipales['intermediateValue'];$i <=($letrasPrincipales['intermediateValue']+3);){
                    //si el numero no es correcto, añadimos la letra de menor valor hasta que el numero sea correcto
                    if($number == $counter){
                        break;
                    }else{
                        $letter = $letter.$letrasPrincipales['smallLetter'];
                        //controlamos que la suma se realize con el valor adecuado según la posición del número
                        $counter = $counter+$letrasPrincipales['value'];
                    }
                }
            }




        }
        return $letter;
    }


    /**
     * Recibe la posicion del numero
     *
     * @param int $postion
     *
     * @return array con los valores de los números según la posición
     */


    public static function valuePosition($position){
        switch($position){
            case 2:
                $array = [
                    'smallLetter' => self::numbers(1),
                    'valueSmall' => 1,
                    'middleLetter' => self::numbers(5),
                    'intermediateValue' => 5,
                    'bigLetter' => self::numbers(10),
                    'bigValue' => 10,
                    'value' => 1,
                ];
                break;
            case 1:
                $array = [
                    'smallLetter' => self::numbers(10),
                    'valueSmall' => 10,
                    'middleLetter' => self::numbers(50),
                    'intermediateValue' => 50,
                    'bigLetter' => self::numbers(100),
                    'bigValue' => 100,
                    'value' => 10,
                ];
                break;
            case 0:
                $array = [
                    'smallLetter' => self::numbers(100),
                    'valueSmall' => 100,
                    'middleLetter' => self::numbers(500),
                    'intermediateValue' => 500,
                    'bigLetter' => self::numbers(1000),
                    'bigValue' => 1000,
                    'value' => 100
                ];
                break;
        }




        return $array;
    }


    /**
     * Comprueba la posicion del numero
     *
     * @param int $key
     *
     * @param int $number
     *
     * @param int $separarNumero
     *
     * @return array La posicion y el número
     */




    public static function checkPosition($key,$number,$separarNumero){




        if(count($separarNumero)==2 && $key == 0){
            $number = $number*10;
        }elseif(count($separarNumero)==3 && $key == 0){
            $number = $number*100;
        }elseif(count($separarNumero)==3 && $key == 1){
            $number = $number * 10;
        }
       
        if((($number%1000-$number%100)/100) > 0 ){
            return  ['position'=>0,'number'=>$number];
        }elseif((($number%100-$number%10)/10) > 0){
            return ['position' => 1,'number'=> $number];
        }elseif(($number%10) >0){
            return ['position' => 2,'number' => $number];
        }else{
            return['position'=>2,'number' => $number];
        }
       
    }



}
?>