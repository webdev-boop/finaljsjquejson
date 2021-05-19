<?php

    function validatePos() 
    {
        for($i=1; $i<=9; $i++) 
        {
            if ( ! isset($_POST['year'.$i]) ) continue;
            if ( ! isset($_POST['desc'.$i]) ) continue;

            $year = $_POST['year'.$i];
            $desc = $_POST['desc'.$i];

            if ( strlen($year) == 0 || strlen($desc) == 0 ) 
            {
                return "All fields are required";
            }

            if ( ! is_numeric($year) ) 
            {
                return "Year must be numeric";
            }
        
        }
        return true;
    }


    function validateEdu() 
    {
        for($i=1; $i<=9; $i++) 
        {
            if ( ! isset($_POST['edu_year'.$i]) ) continue;
            if ( ! isset($_POST['edu_school'.$i]) ) continue;

            $year = $_POST['edu_year'.$i];
            echo $school = $_POST['edu_school'.$i];

            if ( strlen($year) == 0 || strlen($school) == 0 ) 
            {
                return "All fields are required";
            }

            if ( ! is_numeric($year) ) 
            {
                return "Year must be numeric";
            }
        
        }

        // die();
        return true;
    }








    function validateProfile()
    {
        if ( strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 
                || strlen($_POST['headline']) < 1 
                || strlen($_POST['summary']) < 1 
        ) 
        {
            return "All fields are required";      

        }
        elseif ( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)   ) 
        {
            return "Email address must contain @";

        }
        return true;
    }
