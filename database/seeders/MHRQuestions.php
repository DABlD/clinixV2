<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Question;

class MHRQuestions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            "Personal Medical History" => [
                ["Ear Nose Throat disorder", "Dichotomous"],
                ["Eye Problem", "Dichotomous"],
                ["Asthma", "Dichotomous"],
                ["Tuberculosis", "Dichotomous"],
                ["Lung Disease", "Dichotomous"],
                ["Head or neck injury", "Dichotomous"],
                ["Cancer or Tumor", "Dichotomous"],
                ["Endocrine Disorder (Diabetes, Thyroid problem)", "Dichotomous"],
                ["Hypertension", "Dichotomous"],
                ["Kidney or GIT, GUT Disorder", "Dichotomous"],
                ["Heart Disease", "Dichotomous"],
                ["Neurologic Disorder(fainting spells, seizures, mental disorder, stroke)", "Dichotomous"],
                ["Sexually Transmitted Disease", "Dichotomous"],
                ["Viral Infections(Chicken Pox, Measles)", "Dichotomous"],
                ["Operations", "Dichotomous"],
                ["Allergy (food and medications)", "Dichotomous"],
                ["Others", "Text"]
            ],
            "Medication History" => [
                ["Current Medication", "Text"],
                ["Dosage", "Text"],
                ["Frequency", "Text"],
            ],
            "Family History and Personal-Social History" => [
                ["Asthma", "Dichotomous"],
                ["Blood Dyscrasia", "Dichotomous"],
                ["Cancer", "Dichotomous"],
                ["Diabetes mellitus", "Dichotomous"],
                ["Heart Disease", "Dichotomous"],
                ["Hypertension", "Dichotomous"],
                ["Thyroid Disease", "Dichotomous"],
                ["Tuberculosis", "Dichotomous"],
                ["Others", "Dichotomous"],
            ],
            "Smoking History" => [
                ["Previous smoker", "Dichotomous"],
                ["Current smoker", "Dichotomous"],
                ["Sticks per day", "Text"],
                ["For how many years", "Text"],
                ["Pack years computation", ""]
            ],
            "Drinking History" => [
                ["Alcohol drinking classification (non drinker, occasional, frequent, regular)", "Text"],
                ["Usual number of shots / glass alcohol intake", "Text"],
                ["Usual number of bottle alcohol consumption", "Text"]
            ],
            "Menstrual History" => [
                ["Age of first menstruation", "Text"],
                ["LMP", "Text"],
                ["PMP", "Text"],
                ["Duration", "Text"],
                ["Interval (days & regular or irregular)", "Text"],
                ["Pads per day", "Text"]
            ],
            "Obstetrical History" => [
                ["GP (TPAL) via NSD / CS", "Text"],
                ["Other Obstetric conditions (eg. PCOS, Endometriosis, etc)", "Text"]
            ],
            "Vital Signs" => [
                ["1st BP", "Text"],
                ["2nd BP", "Text"],
                ["3rd BP", "Text"],
                ["Pulse Rate", "Text"],
                ["Respiratory Rate", "Text"],
                ["Temperature", "Text"],
                ["02 saturation", "Text"]
            ],
            "Anthropometrics" => [
                ["Height in CM", "Text"],
                ["Weight in KG", "Text"],
                ["BMI", "Text"],
                ["Weight classification (Underweight, Normal, Overweight, Obese)", "Text"],
                ["IBW", "Text"]
            ],
            "Visual Acuity" => [
                ["Right", "Text"],
                ["Left", "Text"],
                ["Corrected", "Dichotomous"]
            ],
            "Systemic Examination" => [
                ["Skin", "Dichotomous"],
                ["Head, Neck, Scalp", "Dichotomous"],
                ["Eyes, external", "Dichotomous"],
                ["Pupils, Opthalmoscopic", "Dichotomous"],
                ["Ears", "Dichotomous"],
                ["Nose, Sinuses", "Dichotomous"],
                ["Mouth, Throat", "Dichotomous"],
                ["Neck, LN, Thyroid", "Dichotomous"],
                ["Chest, Breast, Axilia", "Dichotomous"],
                ["Lungs", "Dichotomous"],
                ["Heart", "Dichotomous"],
                ["Abdomen", "Dichotomous"],
                ["Back", "Dichotomous"],
                ["Anus-rectum", "Dichotomous"],
                ["Genitourinary System", "Dichotomous"],
                ["Inguinals, genitals", "Dichotomous"],
                ["Reflexes", "Dichotomous"],
                ["Extremeties", "Dichotomous"]
            ],
            "Diagnostic Examination" => [
                ["Complete Blood Count", "Dichotomous"],
                ["Urinalysis", "Dichotomous"],
                ["Fecalysis", "Dichotomous"],
                ["Chest X-RAY", "Dichotomous"],
                ["ECG", "Dichotomous"],
                ["Papsmear", "Text"],
                ["Blood Chemistry", "Text"],
                ["Others", "Text"]
            ],
        ];

        foreach($array as $key => $questions){
            $category = new Question();
            $category->name = $key;
            $category->type = "Category";
            $category->save();

            foreach($questions as $question){
                $q = new Question();
                $q->category_id = $category->id;
                $q->name = $question[0];
                $q->type = $question[1];
                $q->save();
            }
        }
    }
}
