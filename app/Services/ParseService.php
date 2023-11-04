<?php

namespace App\Services;

use DOMDocument;


class ParseService
{
    public $semester_array = [];

    public function ParseHtml($html_string){        
        $parsed_array = $this->FindGrades($html_string);
        $clean_class_grades = $this->CleanData($parsed_array);

        return $clean_class_grades;
    }
    
    public function FindGrades($html_string){
        $doc = new DOMDocument();
        $doc->loadHTML($html_string);

        $thead_elements = $doc->getElementsByTagName('thead');
        $table_header = $thead_elements[0];     // locates first thead tag
        $row_elements = $table_header->childNodes; //locates 3rd row of thead
        $term_row = $row_elements[2]->childNodes;
        $term_array = [];

        foreach ($term_row as $element) {       // should always be n = 5
            array_push($term_array, $element->textContent);
        }
        unset($term_array[0]);  //removes first item 'Class'
        $this->semester_array = $term_array;    // saving headers to $semesters array

        $tbody_elements = $doc->getElementsByTagName('tbody');   // gets array of tables in email
        $class_table = $tbody_elements[2];     // targeted table with grades
        $th_elements = $class_table->childNodes;
        
        $class_array = [];
        foreach($th_elements as $element){      // iterates through every table row in targeted table (should always be n = 8 )
            $children = $element->childNodes;
            $array = [];
            foreach($children as $child){       // iterates through every column per table row (should always be n = 5)
                array_push($array, $child->textContent);
            }
            array_push($class_array, $array);
        }
        
        return $class_array;   
    }

    public function GetTerm(){
        return $this->semester_array;
    }

    public function CleanData($parsed_array){
        // Using class_array,create an array of objects that can be used to create entries in a table
        $class_array = [];
        foreach ($parsed_array as $value) {
            $class_string = $value[0];
            $class_pieces = explode('(Y)', $class_string);

            $class_name = trim(end($class_pieces));
            $class_period = trim($class_pieces[0]);

            $class_entry = (object) [
                'name' => $class_name,
                'period' => $class_period,
                'grades' => []      // grades to be processed below
            ];
            
            $grades_array = [];     // grades array for every class array
            for ($i=1; $i < count($value); $i++) {  // starts at 1 because the first item is the name of the class
                if($value[$i] != ""){       // make sure grade is not empty
                    
                    $grade_string = $value[$i];
                    $grade_pieces = explode(' / ', $grade_string);

                    $grade_letter = trim(end($grade_pieces));
                    $grade_gpa = trim($grade_pieces[0]);
                    $grade_semester = $this->semester_array[$i];

                    $grades_entry = (object) [
                        'letter' => $grade_letter,
                        'gpa' => $grade_gpa,
                        'semester' => $grade_semester
                    ];

                    array_push($grades_array, $grades_entry);
                }
                
            }
            $class_entry->grades = $grades_array;

            array_push($class_array, $class_entry);
        }

        return $class_array;
    }
}