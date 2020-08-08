<?php


include('../components/Db.php');
include('../models/Task.php');


function generateRandomName()
{
    $names = ["Aaran", "Aaren", "Abdihakim", "Abdirahman", "Abdisalam", "Abdul", "Abdul-Aziz", "Abdulbasir", "anas", "Alasdair", "Alastair", "Baillie", "Baley", "Balian", "Banan", "Barath", "Barkley", "Barney", "Baron", "Barrie", "Barry", "Bartlomiej", "Bartosz", "Basher", "Colm", "Colt", "Colton", "Colum", "Colvin", "Comghan", "Conal", "Conall", "Conan", "Conar", "Conghaile", "Conlan", "Conley", "Conli", "Conlin", "Conlly", "Conlon", "Conlyn", "Connal", "Connall", "Connan", "Connar", "Connel", "Connell", "Conner", "Connolly", "Connor", "Connor-David", "Conor", "Conrad", "Cooper", "Copeland", "Coray", "Corben", "Corbin", "Corey", "Corey-James", "Corey-Jay", "Cori", "Corie", "Corin", "Cormac", "Cormack", "Levi", "Levon", "Levy", "Lewie", "Lewin", "Lewis", "Lex", "Leydon", "Leyland", "Leylann", "Leyton", "Liall", "Liam", "Liam-Stephen", "Limo", "Lincoln", "Lincoln-John", "Lincon", "Linden", "Linton", "Lionel", "Lisandro", "Litrell", "Liyonela-Elam", "LLeyton", "Lliam", "Lloyd", "Lloyde", "Loche", "Lochlan", "Lochlann", "Lochlan-Oliver", "Lock", "Lockey"];
    return $names[rand(0, count($names) - 1)];
}
function generateRandomEmail()
{
    $emails = ['wainwrig@icloud.com', 'hampton@live.com', 'gospodin@aol.com', 'warrior@att.net', 'leakin@att.net', 'leslie@icloud.com', 'heroine@att.net', 'donev@sbcglobal.net', 'cliffordj@me.com', 'stakasa@me.com', 'ilyaz@verizon.net', 'rogerspl@icloud.com', 'mavilar@me.com', 'mcsporran@yahoo.com', 'arathi@mac.com', 'whimsy@outlook.com', 'wenzlaff@me.com', 'morain@hotmail.com', 'arathi@sbcglobal.net', 'flaviog@aol.com', 'presoff@sbcglobal.net', 'schwaang@icloud.com', 'ivoibs@msn.com', 'pappp@mac.com', 'anicolao@verizon.net', 'yxing@msn.com', 'mhouston@sbcglobal.net', 'luebke@live.com', 'campbell@icloud.com', 'mhanoh@msn.com', 'dburrows@optonline.net', 'rhialto@att.net', 'eidac@gmail.com', 'nwiger@sbcglobal.net', 'lbaxter@gmail.com', 'iamcal@msn.com', 'mpiotr@verizon.net', 'bdbrown@yahoo.com', 'wagnerch@comcast.net', 'formis@live.com', 'mhoffman@me.com', 'mosses@icloud.com', 'crusader@msn.com', 'magusnet@mac.com', 'plover@icloud.com', 'eimear@outlook.com', 'rfoley@mac.com', 'yamla@comcast.net', 'lbaxter@mac.com', 'raines@yahoo.com'];
    return $emails[rand(0, count($emails) - 1)];
}

function generateRandomDescription()
{
    $descriptions = ['Angiodysplasia of intestine (without mention of hemorrhage)', 'Malignant neoplasm of other specified sites of larynx', 'Screening examination for measles', 'Thoracic spondylosis without myelopathy', 'Disturbances of amino-acid transport', 'Open fracture of olecranon process of ulna', 'Benign neoplasm of other specified sites of female genital organs', 'Hereditary spherocytosis', 'Other specified anomalies of muscle, tendon, fascia, and connective tissue', 'Syphilis of mother, complicating pregnancy, childbirth, or the puerperium, delivered, with or without mention of antepartum condition', 'Chronic viral hepatitis B with hepatic coma without hepatitis delta', 'Toxic effect of chlorine gas', 'Aftercare for healing traumatic fracture of arm, unspecified', 'Papanicolaou smear of vagina with cytologic evidence of malignancy', 'Other retained organic fragments', 'Unspecified monoarthritis, pelvic region and thigh', 'Hemorrhagic detachment of retinal pigment epithelium', 'Retinal dystrophy in systemic or cerebroretinal lipidoses', 'Acute monocytic leukemia, in relapse', 'Other specified slow virus infection of central nervous system',];
    return $descriptions[rand(0, count($descriptions) - 1)];
}

function generateRandomStatus()
{
    $statuses = [ Task::$STATUS_NEW, Task::$STATUS_EDIT, Task::$STATUS_FINISHED ];
    return $statuses[rand(0, count($statuses) - 1)];
}

try {
    $table_name = 'task';
    $rows_count = 100;

    $db = Db::getConnection(true);
    if ($db) {

        $result = $db->query("SELECT 1 FROM " . $table_name . " LIMIT 1");
        if ($result) {

            $rows = "";
            for ($i = 0; $i < $rows_count; $i++) {

                $user_name = generateRandomName();
                $email = generateRandomEmail();
                $description = generateRandomDescription();
                if($i%2==0)
                $status = generateRandomStatus();
                else $status = generateRandomStatus().','.generateRandomStatus();


                if ($i != $rows_count - 1)
                    $row = "('" . $user_name . "', '" . $email . "', '" . $description . "', '".$status."'),";
                else $row = "('" . $user_name . "', '" . $email . "', '" . $description . "', '".$status."')";


                $rows .= $row;

            }

            $a = $db->query("INSERT INTO " . $table_name . " (`user_name`, `email`,`description`, `status`) VALUES " . $rows);
            if ($a) {
                echo $rows_count . " row added to table " . $table_name;
            }

        }


    }
} catch (PDOException $ex) {
    echo "Error " . $ex->getMessage();
}