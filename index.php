<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



<?php
$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];


$person = [
    'Иванов Иван Иванович',
    'Степанова Наталья Степановна',
    'Пащенко Владимир Александрович',
    'Громов Александр Иванович',
    'Славин Семён Сергеевич',
    'Цой Владимир Антонович',
    'Быстрая Юлия Сергеевна',
    'Шматко Антонина Сергеевна',
    'аль-Хорезми Мухаммад ибн-Муса',
    'Бардо Жаклин Фёдоровна',
    'Шварцнегер Арнольд Густавович'
];

$str1='Громов Александр Иванович';
$str2='Степанова Наталья Степановна';




//1.1 Разбиение ФИО
//------ Функция getPartsFromFullname принимает как аргумент одну строку — склеенное ФИО. 
//------Возвращает как результат массив из трёх элементов с ключами ‘surname’, ‘name’  и ‘patronomyc’.
function getPartsFromFullname ($strFIO) {
    $templateOfPersonData= [            
        'Surname',                      
        'Name',
        'Patronomyc',
    ];
    $personFIO=array_combine($templateOfPersonData,explode(' ',$strFIO));
    return $personFIO;
}
//------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------


//1.2 Разбиение ФИО
//------ Функция getPartsFromFullname2 принимает как аргумент массив со значением строки — склеенное ФИО. 
//------Возвращает как результат массив из трёх элементов с ключами ‘surname’, ‘name’  и ‘patronomyc’.
function getPartsFromFullname2 ($array) {
    $templateOfPersonData= [            
        'Surname',                      
        'Name',
        'Patronomyc',
    ];

    for ($i=0; $i<count($array);$i++) {

     $personFIO[]=array_combine($templateOfPersonData,explode(' ',$array[$i]));

    }
    print_r($personFIO);
    echo '<br/>';
    echo '<br/>';
    return $personFIO;
}
//------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------



//2.Объединение ФИО
//-----Функция getFullnameFromParts принимает как аргумент три строки — фамилию, имя и отчество.
//-----Возвращает как результат их же, но склеенные через пробел.
function getFullnameFromParts ($surname, $name, $patronomic){
    return $surname.' '.$name.' '.$patronomic ;
}
//-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------


//3.Сокращение ФИО
//------Функция getShortName, принимает как аргумент строку,
//-----содержащую ФИО вида «Громов Александр Иванович» и возвращающую строку вида «Александр Г.»,
//-----где сокращается фамилия и отбрасывается отчество. 
Function getShortName ($strFIO) {
   $array1= getPartsFromFullname($strFIO);
   $login=$array1['Name'].' '.mb_substr($array1['Surname'], 0,1).'.';
    echo "$login";
}
//-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------


//-----4. Функция определения пола по ФИО getGenderFromName
//-----
function getGenderFromName($strFIO) {

    $array1=getPartsFromFullname($strFIO);
    $sum=0;
   
    if (mb_substr($array1['Surname'],-1)=='в'){ $sum++ ;
        }
    elseif (mb_substr($array1['Surname'],-2)=='ва'){ $sum-- ;
   }
    if (mb_substr($array1['Name'],-1)=='й'||'н'){$sum++; 
        }
    elseif ($array1['Name'][-1]=='а'){ $sum--;
        }

    if (mb_substr($array1['Patronomyc'],-2)=='ич') {$sum++;
       }
    elseif  (mb_substr($array1['Patronomyc'],-3)=='вна') {$sum--;
       }

       $a=$sum<=>0;
      $gender= (($a == 1 )?'М':(($a==-1) ? 'Ж':'Неопределено'));
      // $array1['пол']="$gender";
     //  print_r($array1).'<br/>';
         return $a;

    }

getGenderFromName($str2); 
getGenderFromName($str1); 
//-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------


//5.Определение возрастно-полового состава
//-----
function getGenderDescription ($array){
    $female=0;
    $male=0;
    $unknown=0;
    for ($i=0; $i<count($array); $i++){
    // $stringPerson=$array[$i]['fullname'];
       $gender=getGenderFromName($array[$i]['fullname']);
        if ($gender==1) $male++;
        elseif ($gender==-1) $female++;
        else $unknown++;
        }
        echo 'Гендерный состав аудитории:'.'<hr style="border-top: dotted 2px;">';
        echo 'Мужчины'.'        '.round((100/count($array))*$male,2).'%'.'<br>';
        echo 'Женщины'.'        '.round((100/count($array))*$female,2).'%'.'<br>';
        echo 'Не удалось определить'.'        '.round((100/count($array))*$unknown,2).'%'.'<br>';
}
getGenderDescription ($example_persons_array);

//-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------

//-----6. Идеальный подбор пары
//-----
function getPerfectPartner($surname,$name,$patronomic,$arrayPerson) {
    $stringFio=getFullnameFromParts($surname,$name,$patronomic);
      mb_convert_case($stringFio, MB_CASE_TITLE_SIMPLE);
     $gender1=getGenderFromName($stringFio);//пол первой персоны
     $gender2=getGenderFromName($arrayPerson[(rand(0,count($arrayPerson)-1))]['fullname']);//пол второй персоны
     if ($gender1!= $gender2) {
        getShortName ($stringFio);
        echo ' + ';
        getShortName ($arrayPerson[(rand(0,count($arrayPerson)-1))]['fullname']);
        echo ' = '.'<br>';
        $rnd=(50+lcg_value()*(abs(50)));
        echo "\u{1F497} Идеально на  ".round($rnd,2).'%'." \u{1F497}".'<br>';
  
}
else {
      return getPerfectPartner($surname,$name,$patronomic,$arrayPerson);
    }


}


//-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------
?>
</body>
</html>
