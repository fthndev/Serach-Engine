<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class LandingController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $rank = $request->input('rank');

       
        $process = new Process(array_merge(["python", "query.py", "output", $rank], explode(" ", $query)));
        
        try {
            $process->mustRun();
        } catch (ProcessFailedException $exception) {
            return response()->json(['error' => 'Failed to execute the Python script.'], 500);
        }

        $list_data = array_filter(explode("\n", $process->getOutput()));
        $data = [];

        foreach ($list_data as $book) {
            $dataj = json_decode($book, true);
            $data[] = '
            <div class="col-12 mb-3 ms-5" style="font-family: arial">
                <div>
                    <div class="row g-0">
                        <div class="col-md-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <img src = "'.$dataj["image-url"].'" class="image-fluid" alt="Recipe Image" id="img-food">
                                    <h5 class="text-primary"><a href="'.$dataj["URL"].'">' . $dataj['TranslatedRecipeName'] . '</a></h5>
                                </div>
                                <p>Dish from: '.$dataj['Cuisine'].'</p>
                                <div>
                                    <p>The Ingredients ' . $dataj['TranslatedIngredients'] .'.</p>
                                    <p>Total time cook '.$dataj["TotalTimeInMins"].'.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        return response()->json($data);
    }
}
