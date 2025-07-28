<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\{MHR, Patient, Question};

class MHRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();

        $questions = Question::all();
        $temp = array();
        foreach($questions as $question){
            array_push($temp, [
                "id" => $question->id,
                "question" => $question->name,
                "type" => $question->type,
                "answer" => null,
                "remark" => null
            ]);
        }

        foreach($patients as $patient){
            $mhr = new MHR();
            $mhr->user_id = $patient->user_id;
            $mhr->patient_id = $patient->id;
            $mhr->qwa = json_encode($temp);
            $mhr->save();
        }
    }
}
