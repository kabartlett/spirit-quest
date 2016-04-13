<?php
    include_once('database.php');

    $id = "10001111";
    $db = new Database();
    $table = array(
        "Badge",
        "LRC_Appointment",
        "LRC_GetPlanner",
        "LRC_Quest",
        "LRC_SayingOnWall",
        "LRC_TopicsOfACC",
        "LRC_TypesOfCoaching",
        "LRC_Visit",
        "LRC_VisitLRCMathLab",
        "LRC_VisitWritingCenter",
        "LRC_WednesdayWorkshop",
        "User"
    );

    foreach ($table as $key=>$value)
        $db->query('DELETE FROM ' . $value . ' WHERE id="' . $id . '"');

    $db->close();
?>
