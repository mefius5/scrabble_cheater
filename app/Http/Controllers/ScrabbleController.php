<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLetters;
use Illuminate\Http\Request;
use Storage;

class ScrabbleController extends Controller
{
    private $generated_words;
    private $sum_of_words;
    private $dictionary;
    private $words_sum;
    private $data;


    public function index(StoreLetters $request)
    {
        $validated = $request->validated();
        $this->data = $request->input('letters');

        $letters = str_split(strtolower($this->data));

        $this->getDictionaryFromFile('dictionary.txt');

        $this->generateWords($this->dictionary);

        $words = $this->generated_words;

        $this->calculatePoints($this->generated_words);

        $sum = $this->sum_of_words;

        $this->createMergedArray($words, $sum);

        $words_sum = $this->words_sum;

        return view('welcome', compact('words_sum'));

    }

    public function getDictionaryFromFile($file_name)
    {
        if (Storage::exists($file_name)){
            $content = Storage::get($file_name);
            $content = mb_convert_encoding($content, 'UTF-8', 'UTF-8');
            $this->dictionary = explode("\n", $content);
            return $this->dictionary;
        }else{
            echo "false";
        }
    }

    public function generateWords($dictionary)
    {
        $this->generated_words=[];

        foreach ($dictionary as $word){

            $letters = str_split(strtolower($this->data));

            if(strlen($word)<=count($letters)){

                $word_array = str_split($word);
                $passed_word = [];
                foreach ($word_array as $value){
                    if (!in_array($value,$letters)){
                        break;
                    }else{
                        unset($letters[array_search($value,$letters)]);
                    }

                    array_push($passed_word, $value);
                }
                if($passed_word === $word_array){
                    array_push($this->generated_words, implode('', $passed_word));
                } 
                
            }else{
                continue;
            }
        }

        return $this->generated_words;
    }

    public function calculatePoints($words)
    {
        $letter_values = [
            "1" => ["a", "e", "i", "o", "u", "l", "n", "s", "t", "r"],
            "2" => ["d","g"],
            "3" => ["b","c", "m", "p"],
            "4" => ["f", "h", "v", "w", "y"],
            "5" => ["k"],
            "8" =>  ["j", "x"],
            "10" => ["q", "z"]
        ];

        $this->sum_of_words = [];
        foreach($words as $word){
            $word_array = str_split($word);
            $sum_word = 0;
            foreach($word_array as $letter){
                $letter_point = $this->searchPoint($letter_values, $letter);
                $sum_word += $letter_point;
            }
            array_push($this->sum_of_words, $sum_word);
        }
        return $this->sum_of_words;
    }

    public function searchPoint($letters, $letter)
    {
        foreach($letters as $key => $val_1){
            foreach($val_1 as $val_2){
                if(in_array($letter, $val_1)){
                    return $key;
                    break;
                }
            }
        }
    }

    public function createMergedArray($arr1, $arr2)
    {
        if(count($arr1) == count($arr2)){
            $this->words_sum =[];
            foreach($arr1 as $key1 => $val1){
                $this->words_sum[$key1][0] = $val1;
            }
            foreach($arr2 as $key2 => $val2){
                $this->words_sum[$key2][1] = $val2;
            }

            return $this->words_sum;
        }
    }
}
